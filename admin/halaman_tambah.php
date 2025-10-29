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

                <form action="/admin/halaman_proses" method="POST" enctype="multipart/form-data">
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
    <label for="icon_name" class="block text-sm font-medium text-slate-700 mb-2">Nama Ikon Lucide (Opsional)</label>
    <input type="text" id="icon_name" name="icon_name"
           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
           placeholder="Contoh: book-open, file-text, award">
    <p class="text-xs text-slate-500 mt-1">
        Lihat nama ikon di <a href="https://lucide.dev/icons/" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">lucide.dev/icons/</a>. Kosongkan jika tidak perlu ikon khusus.
    </p>
</div>

                    <div class="mb-4">
    <label for="access_code" class="block text-sm font-medium text-slate-700 mb-2">Kode Akses Halaman (Opsional)</label>
    <input type="text" id="access_code" name="access_code"
           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
           placeholder="Biarkan kosong jika publik">
    <p class="text-xs text-slate-500 mt-1">Hanya pengguna dengan kode ini yang bisa akses halaman ini.</p>
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