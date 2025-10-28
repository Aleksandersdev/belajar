<?php
// Panggil Penjaga Keamanan
// Path ini benar karena file ini ada di folder 'admin'
require_once __DIR__ . '/auth_check.php';

// Lokasi folder upload (relatif dari folder 'admin')
define('UPLOAD_DIR', __DIR__ . '/../uploads/');

// ================================================
// FUNGSI UNTUK UPLOAD FILE
// ================================================
/**
 * Menangani upload file ikon dengan aman.
 * @return string|null|false Nama file yang di-upload, null jika tidak ada file, false jika error.
 */
function handleFileUpload($fileInputName) {
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] == UPLOAD_ERR_NO_FILE) {
        return null; // Tidak ada file
    }
    if ($_FILES[$fileInputName]['error'] != UPLOAD_ERR_OK) {
        $_SESSION['pesan_error'] = 'Gagal upload file. Error code: ' . $_FILES[$fileInputName]['error'];
        return false; // Error upload
    }
    $file = $_FILES[$fileInputName];
    $fileName = basename($file['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    if (!in_array($fileType, $allowedTypes)) {
        $_SESSION['pesan_error'] = 'Tipe file tidak diizinkan. Harap upload: jpg, png, gif, atau svg.';
        return false;
    }
    if ($file['size'] > 2 * 1024 * 1024) { // Maks 2MB
        $_SESSION['pesan_error'] = 'Ukuran file terlalu besar. Maksimal 2MB.';
        return false;
    }
    $newFileName = uniqid('', true) . '.' . $fileType;
    $targetPath = UPLOAD_DIR . $newFileName;
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return $newFileName; // Sukses
    } else {
        $_SESSION['pesan_error'] = 'Gagal memindahkan file yang di-upload.';
        return false; // Gagal pindah
    }
}

// Fungsi untuk membuat 'slug' (URL cantik) dari judul
function createSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    if (empty($text)) { return 'n-a-' . time(); }
    return $text;
}

// Cek Metode Request (Harus POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { die('Akses dilarang.'); }
// Validasi CSRF
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }

// === PROSES TAMBAH HALAMAN ===
if (isset($_POST['tambah_halaman'])) {

    // 1. Handle Upload Ikon
    $iconFileName = handleFileUpload('icon');
    if ($iconFileName === false) { // Cek jika upload GAGAL
        header('Location: halaman_tambah'); // Redirect ke URL bersih
        exit;
    }

    // 2. Ambil data teks & kode akses
    $title = trim($_POST['title']);
    $category_id = $_POST['category_id'];
    $content = $_POST['content']; // Menggunakan textarea biasa
    $access_code = !empty($_POST['access_code']) ? trim($_POST['access_code']) : null; // Ambil kode akses

    if (empty($title) || empty($category_id) || empty($content)) {
        $_SESSION['pesan_error'] = 'Judul, Kategori, dan Konten wajib diisi.';
        header('Location: halaman_tambah');
        exit;
    }

    // 3. Buat slug unik
    $slug = createSlug($title);
    $stmt = $pdo->prepare("SELECT id FROM pages WHERE slug = ?");
    $stmt->execute([$slug]);
    if ($stmt->fetch()) {
        $slug = $slug . '-' . time();
    }

    // 4. Masukkan ke DB
    try {
        $sql = "INSERT INTO pages (category_id, title, content, slug, icon_path, access_code) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id, $title, $content, $slug, $iconFileName, $access_code]);

        $_SESSION['pesan_sukses'] = 'Halaman baru berhasil diterbitkan.';
        header('Location: halaman'); // Redirect ke URL bersih
        exit;
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal menerbitkan halaman: ' . $e->getMessage();
        header('Location: halaman_tambah');
        exit;
    }
}


// === PROSES UPDATE HALAMAN ===
if (isset($_POST['update_halaman'])) {

    $halaman_id = $_POST['halaman_id'];
    $old_icon = $_POST['old_icon'];

    // 1. Handle Upload Ikon (jika ada file baru)
    $iconFileName = handleFileUpload('icon');
    if ($iconFileName === false) { // Cek jika upload GAGAL
        header("Location: halaman_edit/$halaman_id"); // Redirect ke URL bersih
        exit;
    }

    if ($iconFileName !== null) { // Ada file baru di-upload
        // Hapus file ikon lama, jika ada
        if (!empty($old_icon) && file_exists(UPLOAD_DIR . $old_icon)) {
            unlink(UPLOAD_DIR . $old_icon);
        }
        $finalIconName = $iconFileName;
    } else {
        // Tidak ada file baru, pakai nama ikon lama
        $finalIconName = $old_icon;
    }

    // 2. Ambil data teks & kode akses
    $title = trim($_POST['title']);
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];
    $access_code = !empty($_POST['access_code']) ? trim($_POST['access_code']) : null; // Ambil kode akses

    if (empty($title) || empty($category_id) || empty($content) || empty($halaman_id)) {
        $_SESSION['pesan_error'] = 'Judul, Kategori, dan Konten wajib diisi.';
        header("Location: halaman_edit/$halaman_id");
        exit;
    }

    // 3. Update DB
    try {
        $sql = "UPDATE pages SET category_id = ?, title = ?, content = ?, icon_path = ?, access_code = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id, $title, $content, $finalIconName, $access_code, $halaman_id]);

        $_SESSION['pesan_sukses'] = 'Halaman berhasil diperbarui.';
        header('Location: halaman'); // Redirect ke URL bersih
        exit;
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal memperbarui halaman: ' . $e->getMessage();
        header("Location: halaman_edit/$halaman_id");
        exit;
    }
}


// === PROSES HAPUS HALAMAN ===
if (isset($_POST['hapus_halaman'])) {
    $halaman_id = $_POST['halaman_id'];

    try {
        // 1. Ambil nama ikon sebelum dihapus
        $stmt = $pdo->prepare("SELECT icon_path FROM pages WHERE id = ?");
        $stmt->execute([$halaman_id]);
        $halaman = $stmt->fetch();
        $icon_to_delete = $halaman['icon_path'] ?? null;

        // 2. Hapus data dari DB
        $sql = "DELETE FROM pages WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$halaman_id]);

        // 3. Hapus file ikon dari server
        if (!empty($icon_to_delete) && file_exists(UPLOAD_DIR . $icon_to_delete)) {
            unlink(UPLOAD_DIR . $icon_to_delete);
        }

        $_SESSION['pesan_sukses'] = 'Halaman berhasil dihapus.';
        header('Location: halaman'); // Redirect ke URL bersih
        exit;
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal menghapus halaman: ' . $e->getMessage();
        header('Location: halaman');
        exit;
    }
}

// Fallback jika tidak ada aksi yang cocok
header('Location: halaman');
exit;
?>