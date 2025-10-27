<?php
// Panggil Penjaga Keamanan
require_once 'auth_check.php';

// (CREATE) Proses penambahan Kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kategori'])) {
    // Validasi CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Token CSRF tidak valid.');
    }
    
    $kategori_nama = trim($_POST['kategori_nama']);
    if (!empty($kategori_nama)) {
        try {
            $sql = "INSERT INTO categories (name) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$kategori_nama]);
            $_SESSION['pesan_sukses'] = 'Kategori berhasil ditambahkan.';
        } catch (PDOException $e) {
            $_SESSION['pesan_error'] = 'Gagal menambahkan kategori: ' . $e->getMessage();
        }
    }
    header('Location: kategori.php');
    exit;
}

// (DELETE) Proses penghapusan Kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_kategori'])) {
    // Validasi CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Token CSRF tidak valid.');
    }
    
    $kategori_id = $_POST['kategori_id'];
    try {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$kategori_id]);
        $_SESSION['pesan_sukses'] = 'Kategori berhasil dihapus.';
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal menghapus kategori: ' . $e->getMessage();
    }
    header('Location: kategori.php');
    exit;
}

// (READ) Ambil semua kategori dari DB
$kategori_list = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

// Muat header
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Kelola Kategori</h1>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200 mb-8 max-w-lg">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Tambah Kategori Baru</h2>
                
                <?php if (isset($_SESSION['pesan_sukses'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo $_SESSION['pesan_sukses']; unset($_SESSION['pesan_sukses']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="kategori" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="mb-4">
                        <label for="kategori_nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori</label>
                        <input type="text" id="kategori_nama" name="kategori_nama" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" name="tambah_kategori" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                        Tambah
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Daftar Kategori</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php if (empty($kategori_list)): ?>
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-slate-500">Belum ada kategori.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        <?php echo htmlspecialchars($kategori['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="kategori_edit.php?id=<?php echo $kategori['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                        
                                        <form action="kategori.php" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Semua halaman di dalamnya juga akan terhapus.');">
                                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                            <input type="hidden" name="kategori_id" value="<?php echo $kategori['id']; ?>">
                                            <button type="submit" name="hapus_kategori" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>