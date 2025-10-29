<?php
// Panggil Penjaga Keamanan
// Path ini benar karena file ini ada di folder 'admin'
require_once __DIR__ . '/auth_check.php'; // Ini akan memuat config.php juga

// Lokasi folder upload (relatif dari folder 'admin')
define('UPLOAD_DIR', __DIR__ . '/../uploads/');

// ================================================
// FUNGSI UNTUK UPLOAD FILE
// ================================================
/**
 * Menangani upload file ikon dengan aman.
 * @return string|null|false Nama file yang di-upload, null jika tidak ada file, false jika error.
 */

// Fungsi untuk membuat 'slug' (URL cantik) dari judul
function createSlug($text) {
    // ... (fungsi createSlug tetap sama) ...
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    try { $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); } catch (Exception $e) {}
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-'); $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text); if (empty($text)) { return 'n-a-' . time(); }
    return $text;
}

// Cek Metode Request (Harus POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { die('Akses dilarang.'); }
// Validasi CSRF
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
// === PROSES TAMBAH HALAMAN ===
if (isset($_POST['tambah_halaman'])) {

    // 1. Ambil data teks, kode akses, dan NAMA IKON
    $title = trim($_POST['title']);
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];
    $access_code = !empty($_POST['access_code']) ? trim($_POST['access_code']) : null;
    // Ambil nama ikon dari input teks, jadikan NULL jika kosong
    $icon_name = !empty($_POST['icon_name']) ? trim($_POST['icon_name']) : null;

    if (empty($title) || empty($category_id) || !isset($content)) {
        $_SESSION['pesan_error'] = 'Judul dan Kategori wajib diisi.';
        header('Location: halaman_tambah'); exit;
    }

    // 3. Buat slug unik
    $slug = createSlug($title);
    $stmt = $pdo->prepare("SELECT id FROM pages WHERE slug = ?");
    $stmt->execute([$slug]);
    if ($stmt->fetch()) {
        $slug = $slug . '-' . time();
    }

    // 3. Masukkan ke DB (Gunakan $icon_name untuk kolom icon_path)
    try {
        // Query disesuaikan, kolom icon_path diisi $icon_name
        $sql = "INSERT INTO pages (category_id, title, content, slug, icon_path, access_code) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id, $title, $content, $slug, $icon_name, $access_code]); // Ganti $iconFileName -> $icon_name

        $_SESSION['pesan_sukses'] = 'Halaman baru berhasil diterbitkan.';
        header('Location: halaman'); exit;
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal menerbitkan halaman: ' . $e->getMessage();
        header('Location: halaman_tambah'); exit;
    }
}


// === PROSES UPDATE HALAMAN ===
if (isset($_POST['update_halaman'])) {

    $halaman_id = $_POST['halaman_id'];
    // HAPUS $old_icon = $_POST['old_icon'];

    // Ambil dan bersihkan slug baru
$new_slug_raw = trim($_POST['slug'] ?? '');
// Validasi format slug (hanya huruf kecil, angka, strip)
$new_slug = preg_replace('/[^a-z0-9-]+/', '', strtolower($new_slug_raw));
// Fallback jika slug kosong setelah dibersihkan
if (empty($new_slug)) {
    $_SESSION['pesan_error'] = 'Slug tidak valid atau kosong.';
    header("Location: halaman_edit/$halaman_id"); exit;
}

    // HAPUS Logika Handle Upload & Hapus File Lama
    // $iconFileName = handleFileUpload('icon'); ...
    // unlink(...) ...

    // 1. Ambil data teks, kode akses, dan NAMA IKON
    $title = trim($_POST['title']);
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];
    $access_code = !empty($_POST['access_code']) ? trim($_POST['access_code']) : null;
    // Ambil nama ikon dari input teks, jadikan NULL jika kosong
    $icon_name = !empty($_POST['icon_name']) ? trim($_POST['icon_name']) : null;


    if (empty($title) || empty($category_id) || !isset($content) || empty($halaman_id)) {
        $_SESSION['pesan_error'] = 'Judul dan Kategori wajib diisi.';
        header("Location: halaman_edit/$halaman_id"); exit;
    }
// === PENGECEKAN KEUNIKAN SLUG ===
$stmt_check_slug = $pdo->prepare("SELECT id FROM pages WHERE slug = ? AND id != ?");
$stmt_check_slug->execute([$new_slug, $halaman_id]);
if ($stmt_check_slug->fetch()) {
    // Slug sudah digunakan oleh halaman lain!
    $_SESSION['pesan_error'] = 'Slug "' . htmlspecialchars($new_slug) . '" sudah digunakan oleh halaman lain. Harap gunakan slug yang unik.';
    header("Location: halaman_edit/$halaman_id");
    exit;
}
// === AKHIR PENGECEKAN ===
    // 2. Update DB (Gunakan $icon_name untuk kolom icon_path)
    try {
        // Query disesuaikan, kolom icon_path diisi $icon_name
       $sql = "UPDATE pages SET category_id = ?, title = ?, content = ?, slug = ?, icon_path = ?, access_code = ?, updated_at = NOW() WHERE id = ?"; // <-- Tambah slug = ?
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id, $title, $content, $new_slug, $icon_name, $access_code, $halaman_id]);
        $_SESSION['pesan_sukses'] = 'Halaman berhasil diperbarui.';
        header('Location: halaman'); exit;
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal memperbarui halaman: ' . $e->getMessage();
        header("Location: halaman_edit/$halaman_id"); exit;
    }
}


// === PROSES HAPUS HALAMAN ===
if (isset($_POST['hapus_halaman'])) {
    $halaman_id = $_POST['halaman_id'];

    try {
        // HAPUS Logika ambil nama ikon dan hapus file
        // $stmt = $pdo->prepare("SELECT icon_path..."); ...
        // unlink(...) ...

        // Hapus data dari DB
        $sql = "DELETE FROM pages WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$halaman_id]);

        $_SESSION['pesan_sukses'] = 'Halaman berhasil dihapus.';
        header('Location: halaman'); exit;
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal menghapus halaman: ' . $e->getMessage();
        header('Location: halaman'); exit;
    }
}

// Fallback jika tidak ada aksi yang cocok
header('Location: halaman');
exit;
?>