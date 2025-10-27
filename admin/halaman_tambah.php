<?php
// Panggil Penjaga Keamanan
require_once 'auth_check.php';

// Ambil daftar kategori untuk dropdown
$kategori_list = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

// Muat header
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

                <form action="halaman_proses" method="POST" enctype="multipart/form-data">
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
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo $kategori['id']; ?>">
                                    <?php echo htmlspecialchars($kategori['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-slate-700 mb-2">Konten</label>
                       <textarea id="content" name="content" rows="20" 
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" name="tambah_halaman" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                            Terbitkan
                        </button>
                        <div class="mb-4">
    <label for="icon" class="block text-sm font-medium text-slate-700 mb-2">Upload Ikon (Opsional)</label>
    <input type="file" id="icon" name="icon" 
           class="w-full px-3 py-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4
                  file:rounded-full file:border-0 file:text-sm file:font-semibold
                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
</div>


                        <a href="halaman" class="text-sm text-slate-600 hover:text-slate-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>