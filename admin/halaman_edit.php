<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

/**
 * Mengambil semua kategori dari database dan mengaturnya dalam struktur hierarki (pohon).
 * (Fungsi yang sama seperti di halaman_tambah.php)
 */


// Pastikan ID ada di URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../halaman'); 
    exit;
}
$halaman_id = $_GET['id'];

// Ambil data halaman yang akan di-edit
$stmt = $pdo->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$halaman_id]);
$halaman = $stmt->fetch();

if (!$halaman) {
    $_SESSION['pesan_error'] = 'Halaman tidak ditemukan.';
    header('Location: ../halaman'); 
    exit;
}

// Ambil daftar kategori secara hierarkis
$hierarchical_categories = getHierarchicalCategories($pdo);

// Muat header
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Edit Halaman</h1>
                
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="../halaman_proses" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <input type="hidden" name="halaman_id" value="<?php echo $halaman['id']; ?>">
                    <input type="hidden" name="old_icon" value="<?php echo htmlspecialchars($halaman['icon_path']); ?>">
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Judul Halaman</label>
                        <input type="text" id="title" name="title" required 
                               value="<?php echo htmlspecialchars($halaman['title'], ENT_QUOTES, 'UTF-8'); ?>"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                        <select id="category_id" name="category_id" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                             <?php foreach ($hierarchical_categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" 
                                        <?php echo ($cat['id'] == $halaman['category_id']) ? 'selected' : ''; ?>>
                                    <?php 
                                    echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['level']); 
                                    echo htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8'); 
                                    ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-slate-700 mb-2">Konten</label>
                        <textarea id="content" name="content" rows="20" 
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($halaman['content']); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="icon" class="block text-sm font-medium text-slate-700 mb-2">Upload Ikon Baru (Opsional)</label>
                        
                        <?php if (!empty($halaman['icon_path'])): ?>
                            <div class="my-2">
                                <img src="../uploads/<?php echo htmlspecialchars($halaman['icon_path']); ?>" alt="Ikon saat ini" class="w-16 h-16 rounded-lg object-cover">
                                <p class="text-xs text-slate-500 mt-1">Ikon saat ini: <?php echo htmlspecialchars($halaman['icon_path']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <input type="file" id="icon" name="icon" 
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-slate-500 mt-1">Biarkan kosong jika tidak ingin mengubah ikon.</p>
                    </div>

                    <div class="mb-4">
    <label for="access_code" class="block text-sm font-medium text-slate-700 mb-2">Kode Akses Halaman (Opsional)</label>
    <input type="text" id="access_code" name="access_code"
           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
           placeholder="Biarkan kosong jika publik"
           value="<?php echo htmlspecialchars($halaman['access_code'] ?? ''); // <-- PERIKSA BAGIAN INI ?>">
    <p class="text-xs text-slate-500 mt-1">Hanya pengguna dengan kode ini yang bisa akses halaman ini.</p>
</div>

                    <div class="flex items-center justify-between">
                        <button type="submit" name="update_halaman" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                            Update
                        </button>
                        <a href="../halaman" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php 
require_once __DIR__ . '/../partials/footer.php'; 
?>