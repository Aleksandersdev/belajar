<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// Pastikan ID ada di URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../kategori'); 
    exit;
}
$kategori_id_to_edit = $_GET['id'];

// --- Ambil SEMUA kategori LAIN untuk dropdown Induk ---
// Kita tidak ingin kategori ini menjadi induk bagi dirinya sendiri
$stmt_all_cats = $pdo->prepare("SELECT id, name FROM categories WHERE id != ? ORDER BY name ASC");
$stmt_all_cats->execute([$kategori_id_to_edit]);
$all_other_categories = $stmt_all_cats->fetchAll();
// --- Akhir ---


// (UPDATE) Proses update Kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_kategori'])) {
    // Validasi CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Token CSRF tidak valid.');
    }
    
    $kategori_nama = trim($_POST['kategori_nama']);
    // Ambil parent_id dari form
    $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
    
    if (!empty($kategori_nama)) {
        try {
            // PERBAIKAN: Tambahkan parent_id ke query UPDATE
            $sql = "UPDATE categories SET name = ?, parent_id = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$kategori_nama, $parent_id, $kategori_id_to_edit]);
            $_SESSION['pesan_sukses'] = 'Kategori berhasil diperbarui.';
            header('Location: ../kategori');
            exit;
        } catch (PDOException $e) {
            $_SESSION['pesan_error'] = 'Gagal memperbarui kategori: ' . $e->getMessage();
        }
    }
    header("Location: ../kategori_edit/$kategori_id_to_edit");
    exit;
}

// (READ) Ambil data kategori yang akan di-edit
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$kategori_id_to_edit]);
$kategori = $stmt->fetch();

if (!$kategori) {
    $_SESSION['pesan_error'] = 'Kategori tidak ditemukan.';
    header('Location: ../kategori');
    exit;
}

// Muat header
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-lg">
            
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Edit Kategori</h1>
                
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="../kategori_edit/<?php echo $kategori_id_to_edit; ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div class="mb-4">
                        <label for="kategori_nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori</label>
                        <input type="text" id="kategori_nama" name="kategori_nama" required 
                               value="<?php echo htmlspecialchars($kategori['name'], ENT_QUOTES, 'UTF-8'); ?>"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="parent_id" class="block text-sm font-medium text-slate-700 mb-2">Induk Kategori (Opsional)</label>
                        <select id="parent_id" name="parent_id"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0">-- Tidak Ada Induk (Jadikan Induk Utama) --</option>
                            <?php foreach ($all_other_categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"
                                    <?php echo ($cat['id'] == $kategori['parent_id']) ? 'selected' : ''; // Pilih induk saat ini ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-xs text-slate-500 mt-1">Pilih kategori induk jika ini adalah sub-kategori.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="update_kategori" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                            Update
                        </button>
                        <a href="../kategori" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php 
require_once __DIR__ . '/../partials/footer.php'; 
?>