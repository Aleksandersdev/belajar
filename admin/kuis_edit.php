<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// Validasi ID Kuis dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { header('Location: ../kelola_kuis'); exit; }
$kuis_id_to_edit = (int)$_GET['id'];

// Ambil SEMUA kategori kuis (untuk dropdown)
$stmt_all_cats_dropdown = $pdo->prepare("SELECT id, name FROM kuis_kategori ORDER BY name ASC");
$stmt_all_cats_dropdown->execute();
$all_categories_for_dropdown = $stmt_all_cats_dropdown->fetchAll();

// (UPDATE) Proses update Kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_kuis'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
    
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $kategori_kuis_id = (int)$_POST['kategori_kuis_id'];

    if (!empty($judul) && $kategori_kuis_id > 0) {
        try {
            $sql = "UPDATE kuis SET judul = ?, deskripsi = ?, kategori_kuis_id = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$judul, $deskripsi, $kategori_kuis_id, $kuis_id_to_edit]);
            $_SESSION['pesan_sukses'] = 'Kuis berhasil diperbarui.';
            header('Location: ../kelola_kuis'); exit;
        } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
    } else {
        $_SESSION['pesan_error'] = 'Judul dan Kategori Kuis wajib diisi.';
    }
    header("Location: ../kuis_edit/$kuis_id_to_edit"); exit;
}

// (READ) Ambil data kuis
$stmt_kuis = $pdo->prepare("SELECT * FROM kuis WHERE id = ?");
$stmt_kuis->execute([$kuis_id_to_edit]);
$kuis = $stmt_kuis->fetch();
if (!$kuis) { $_SESSION['pesan_error'] = 'Kuis tidak ditemukan.'; header('Location: ../kelola_kuis'); exit; }

// Muat header
$page_title = "Edit Kuis";
require_once __DIR__ . '/../partials/header.php';
?>
<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-lg">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Edit Kuis</h1>
                <?php if (isset($_SESSION['pesan_error'])): /* Pesan error */ endif; ?>
                <form action="../kuis_edit/<?php echo $kuis_id_to_edit; ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-slate-700 mb-2">Judul Kuis (Wajib)</label>
                        <input type="text" id="judul" name="judul" required class="w-full px-4 py-2 border border-slate-300 rounded-lg" value="<?php echo htmlspecialchars($kuis['judul']); ?>">
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi (Opsional)</label>
                        <textarea id="deskripsi" name="deskripsi" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg"><?php echo htmlspecialchars($kuis['deskripsi']); ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="kategori_kuis_id" class="block text-sm font-medium text-slate-700 mb-2">Kategori Kuis (Wajib)</label>
                        <select id="kategori_kuis_id" name="kategori_kuis_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($all_categories_for_dropdown as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $kuis['kategori_kuis_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="update_kuis" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">Update Kuis</button>
                        <a href="../kelola_kuis" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>