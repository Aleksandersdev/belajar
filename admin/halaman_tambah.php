<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

/**
 * Mengambil semua kategori dari database dan mengaturnya dalam struktur hierarki (pohon).
 *
 * @param PDO $pdo Objek koneksi PDO.
 * @param int $parentId ID dari induk kategori yang ingin diambil anaknya (default 0 untuk root).
 * @param int $level Tingkat kedalaman saat ini (untuk indentasi).
 * @return array Array kategori yang sudah diurutkan secara hierarkis.
 */
function getHierarchicalCategories(PDO $pdo, int $parentId = 0, int $level = 0): array {
    $categories = [];
    $stmt = $pdo->prepare("SELECT id, name FROM categories WHERE parent_id = ? ORDER BY name ASC");
    $stmt->execute([$parentId]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['level'] = $level; // Simpan level untuk indentasi
        $categories[] = $row;
        $children = getHierarchicalCategories($pdo, $row['id'], $level + 1);
        $categories = array_merge($categories, $children);
    }
    return $categories;
}

// Ambil daftar kategori secara hierarkis
$hierarchical_categories = getHierarchicalCategories($pdo);

// Muat header
// Path ini sudah benar karena menggunakan __DIR__
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Tambah Halaman Baru</h1>
                
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="../halaman_proses" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Judul Halaman</label>
                        <input type="text" id="title" name="title" required 
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                        <select id="category_id" name="category_id" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($hierarchical_categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>">
                                    <?php 
                                    // Tambahkan indentasi (misal: '    ') berdasarkan level
                                    echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['level']); // 4 spasi per level
                                    echo htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8'); 
                                    ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-slate-700 mb-2">Konten</label>
                        <textarea id="content" name="content" rows="20" 
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="icon" class="block text-sm font-medium text-slate-700 mb-2">Upload Ikon (Opsional)</label>
                        <input type="file" id="icon" name="icon" 
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" name="tambah_halaman" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                            Terbitkan
                        </button>
                        <a href="../halaman" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php 
// Path ini sudah benar karena menggunakan __DIR__
require_once __DIR__ . '/../partials/footer.php'; 
?>