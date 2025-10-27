<?php
// 1. Panggil Penjaga Keamanan
// Ini harus ada di baris PALING ATAS
require_once 'auth_check.php';

$page_title = 'Dashboard Admin';

// 2. Jika lolos, muat header
// Perhatikan path '../' untuk naik satu folder
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            
            <div class="bg-white p-8 md:p-12 rounded-2xl shadow-lg border border-slate-200">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-4">
                    Selamat Datang di Dashboard Admin
                </h1>
                
                <p class="text-lg text-slate-600 mb-6">
                    Halo, <strong><?php echo htmlspecialchars($_SESSION['admin_username'], ENT_QUOTES, 'UTF-8'); ?></strong>!
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <a href="halaman.php" class="block bg-blue-50 p-6 rounded-lg border border-blue-200 hover:bg-blue-100 transition">
                        <h3 class="text-lg font-bold text-blue-800 mb-1">Kelola Halaman</h3>
                        <p class="text-sm text-blue-600">Tambah, edit, atau hapus artikel/halaman.</p>
                    </a>
                    <a href="kategori.php" class="block bg-indigo-50 p-6 rounded-lg border border-indigo-200 hover:bg-indigo-100 transition">
                        <h3 class="text-lg font-bold text-indigo-800 mb-1">Kelola Kategori</h3>
                        <p class="text-sm text-indigo-600">Atur kategori untuk halaman.</p>
                    </a>
                </div>
                <div>
                    <a href="../logout.php" class="text-red-600 hover:text-red-800 font-medium">
                        Logout
                    </a>
                </div>
            </div>

        </div>
    </section>
</main>

<?php
// 3. Muat footer
require_once __DIR__ . '/../partials/footer.php';
?>