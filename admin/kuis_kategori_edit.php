<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// Validasi ID Kategori Kuis dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../kuis_kategori'); exit;
}
$kategori_id_to_edit = (int)$_GET['id'];

// Ambil SEMUA kategori kuis LAINNYA (untuk dropdown)
$stmt_all_cats_dropdown = $pdo->prepare("SELECT id, name FROM kuis_kategori WHERE id != ? ORDER BY name ASC");
$stmt_all_cats_dropdown->execute([$kategori_id_to_edit]);
$all_other_categories = $stmt_all_cats_dropdown->fetchAll();

// (UPDATE) Proses update Kategori Kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_kategori'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
    
    $kategori_nama = trim($_POST['kategori_nama']);
    $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
    $access_code = !empty($_POST['access_code']) ? trim($_POST['access_code']) : null;

    if (!empty($kategori_nama)) {
        try {
            $sql = "UPDATE kuis_kategori SET name = ?, parent_id = ?, access_code = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$kategori_nama, $parent_id, $access_code, $kategori_id_to_edit]);
            $_SESSION['pesan_sukses'] = 'Kategori kuis berhasil diperbarui.';
            header('Location: ../kuis_kategori'); exit;
        } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
    } else {
        $_SESSION['pesan_error'] = 'Nama kategori wajib diisi.';
    }
    header("Location: ../kuis_kategori_edit/$kategori_id_to_edit"); exit;
}

// (READ) Ambil data kategori yang akan di-edit
$stmt_cat = $pdo->prepare("SELECT * FROM kuis_kategori WHERE id = ?");
$stmt_cat->execute([$kategori_id_to_edit]);
$kategori = $stmt_cat->fetch();
if (!$kategori) {
    $_SESSION['pesan_error'] = 'Kategori kuis tidak ditemukan.';
    header('Location: ../kuis_kategori'); exit;
}

// Muat header
$page_title = "Edit Kategori Kuis";
require_once __DIR__ . '/../partials/header.php';
?>
<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-lg">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Edit Kategori Kuis</h1>
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?></div>
                <?php endif; ?>
                <form action="../kuis_kategori_edit/<?php echo $kategori_id_to_edit; ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="mb-4">
                        <label for="kategori_nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori</label>
                        <input type="text" id="kategori_nama" name="kategori_nama" required class="w-full px-4 py-2 border border-slate-300 rounded-lg" value="<?php echo htmlspecialchars($kategori['name']); ?>">
                    </div>
                    <div class="mb-4">
                        <label for="parent_id" class="block text-sm font-medium text-slate-700 mb-2">Induk Kategori (Opsional)</label>
                        <select id="parent_id" name="parent_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                            <option value="0">-- Tidak Ada Induk --</option>
                            <?php foreach ($all_other_categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $kategori['parent_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="access_code" class="block text-sm font-medium text-slate-700 mb-2">Kode Akses (Opsional)</label>
                        <input type="text" id="access_code" name="access_code" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Biarkan kosong jika publik" value="<?php echo htmlspecialchars($kategori['access_code'] ?? ''); ?>">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="update_kategori" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">Update Kategori</button>
                        <a href="../kuis_kategori" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>