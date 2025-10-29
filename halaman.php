<?php
// Panggil config
require_once __DIR__ . '/config.php';

// --- DEFINISIKAN META TAG SPESIFIK UNTUK HALAMAN INI ---
$page_title = $halaman['title']; // Judul artikel
// Buat deskripsi singkat (misal: 160 karakter pertama dari konten, hapus HTML)

// --- AKHIR DEFINISI META ---

// Ambil slug dari URL
if (!isset($_GET['slug'])) {
    header('Location: /'); exit;
}
$slug = $_GET['slug'];

// Ambil data lengkap halaman (termasuk ID dan access_code)
try {
    $sql = "SELECT p.id, p.title, p.content, p.created_at, p.access_code, c.name AS category_name
            FROM pages p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.slug = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$slug]);
    $halaman = $stmt->fetch();

} catch (PDOException $e) {
    die("Error database: ". $e->getMessage());
}

// Jika halaman tidak ditemukan
if (!$halaman) {
    header('Location: /'); exit;
}

// --- *** LOGIKA PENGECEKAN KODE AKSES HALAMAN (BERDASARKAN KODE) *** ---
$page_id = $halaman['id']; // ID halaman (mungkin masih perlu untuk hal lain)
$page_required_code = $halaman['access_code']; // Kode yang dibutuhkan halaman ini
$has_page_access = false;

// Ambil daftar kode yang sudah di-grant dari session
$granted_codes_list = $_SESSION['granted_access_codes'] ?? [];

if ($page_required_code === null) {
    // 1. Halaman ini publik (tidak butuh kode)
    $has_page_access = true;
} elseif (in_array($page_required_code, $granted_codes_list)) {
    // 2. Kode yang dibutuhkan halaman ini SUDAH ADA di session
    $has_page_access = true;
}
// 3. Jika tidak keduanya, $has_page_access tetap false, tampilkan form
// --- *** AKHIR LOGIKA KODE AKSES *** ---

// Muat header
$page_title = htmlspecialchars($halaman['title'], ENT_QUOTES, 'UTF-8');
include __DIR__ . '/partials/header.php';
?>

<main>
   

            <?php if ($has_page_access): ?>
                <?php echo $halaman['content']; // Tampilkan HTML mentah ?>
            <?php else: ?>
                <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 max-w-md mx-auto" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-slate-800 text-center mb-2">Konten Terbatas</h3>
                    <p class="text-slate-600 text-center mb-6">Masukkan kode akses untuk melihat halaman "<?php echo htmlspecialchars($halaman['title']); ?>".</p>

                    <?php if (isset($_SESSION['page_access_error'])): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                            <?php echo $_SESSION['page_access_error']; unset($_SESSION['page_access_error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php $csrf_token = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32)); ?>
                    <form action="/process_page_access" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
                        <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

                        <div class="mb-4">
                            <label for="access_code" class="sr-only">Kode Akses</label>
                            <input type="text" id="access_code" name="access_code" required
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Masukkan Kode Akses">
                        </div>
                        <button type="submit" class="w-full cta-gradient text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                            Buka Akses
                        </button>
                    </form>
                    <p class="mt-6 text-center text-sm text-slate-500">
                        Belum memiliki kode akses? Silakan hubungi
                        <a href="https://www.instagram.com/rangkumanmateri_/" target="_blank" rel="noopener noreferrer" class="font-medium text-blue-600 hover:underline">
                            admin
                        </a>.
                    </p>
                </div>
            <?php endif; ?>
       
 
</main>

<?php
// Muat footer
include __DIR__ . '/partials/footer.php';
?>