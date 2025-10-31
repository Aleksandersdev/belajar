<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// --- Ambil SEMUA kategori kuis (untuk dropdown "Tambah Kuis") ---
$stmt_all_cats_dropdown = $pdo->prepare("SELECT id, name FROM kuis_kategori ORDER BY name ASC");
$stmt_all_cats_dropdown->execute();
$all_categories_for_dropdown = $stmt_all_cats_dropdown->fetchAll();

// --- LOGIKA FILTER, PENCARIAN, SORT, & PAGINATION KUIS ---
$limit = 15;
$search_term = $_GET['search'] ?? '';
$sort_order = $_GET['sort'] ?? 'id_desc';
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

$base_sql = "FROM kuis k LEFT JOIN kuis_kategori kc ON k.kategori_kuis_id = kc.id";
$where_sql = " WHERE 1=1";
$params = [];
if (!empty($search_term)) {
    $where_sql .= " AND k.judul LIKE ?";
    $params[] = '%' . $search_term . '%';
}
$sort_sql = " ORDER BY ";
switch ($sort_order) { /* ... (logika sort sama seperti kuis_kategori) ... */ }

// Query TOTAL & DATA
$stmt_count = $pdo->prepare("SELECT COUNT(k.id) $base_sql $where_sql");
$stmt_count->execute($params);
$total_kuis = (int)$stmt_count->fetchColumn();
$total_pages = ceil($total_kuis / $limit);
$data_sql = "SELECT k.id, k.judul, k.deskripsi, kc.name AS category_name $base_sql $where_sql $sort_sql LIMIT ? OFFSET ?";
$data_params = $params; $data_params[] = $limit; $data_params[] = $offset;
$stmt_data = $pdo->prepare($data_sql);
// ... (binding parameter) ...
$stmt_data->execute($data_params); // Ganti jika binding berbeda
$kuis_list = $stmt_data->fetchAll();
$query_params = [];
if (!empty($search_term)) $query_params['search'] = $search_term;
if ($sort_order !== 'id_desc') $query_params['sort'] = $sort_order;

// (CREATE) Proses penambahan Kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kuis'])) {
     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
     $judul = trim($_POST['judul']);
     $deskripsi = trim($_POST['deskripsi']);
     $kategori_kuis_id = (int)$_POST['kategori_kuis_id'];
     if (!empty($judul) && $kategori_kuis_id > 0) {
         try {
             $sql = "INSERT INTO kuis (judul, deskripsi, kategori_kuis_id) VALUES (?, ?, ?)";
             $stmt = $pdo->prepare($sql);
             $stmt->execute([$judul, $deskripsi, $kategori_kuis_id]);
             $_SESSION['pesan_sukses'] = 'Kuis baru berhasil ditambahkan.';
         } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
     } else {
         $_SESSION['pesan_error'] = 'Judul dan Kategori Kuis wajib diisi.';
     }
     header('Location: kelola_kuis'); exit;
}

// (DELETE) Proses penghapusan Kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_kuis'])) {
     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
     $kuis_id = (int)$_POST['kuis_id'];
     try {
         $sql = "DELETE FROM kuis WHERE id = ?";
         $stmt = $pdo->prepare($sql);
         $stmt->execute([$kuis_id]);
         $_SESSION['pesan_sukses'] = 'Kuis (dan semua soal di dalamnya) berhasil dihapus.';
     } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
     header('Location: kelola_kuis'); exit;
}

// Muat header
$page_title = "Kelola Kuis";
require_once __DIR__ . '/../partials/header.php';
?>
<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Kelola Kuis TKA</h1>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200 mb-8 max-w-lg">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Tambah Kuis Baru</h2>
                <?php if (isset($_SESSION['pesan_sukses'])): /* Pesan sukses */ endif; ?>
                <?php if (isset($_SESSION['pesan_error'])): /* Pesan error */ endif; ?>
                <form action="kelola_kuis" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-slate-700 mb-2">Judul Kuis (Wajib)</label>
                        <input type="text" id="judul" name="judul" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi (Opsional)</label>
                        <textarea id="deskripsi" name="deskripsi" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="kategori_kuis_id" class="block text-sm font-medium text-slate-700 mb-2">Kategori Kuis (Wajib)</label>
                        <select id="kategori_kuis_id" name="kategori_kuis_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($all_categories_for_dropdown as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="tambah_kuis" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">Tambah Kuis</button>
                </form>
            </div>
            <div class="mb-6 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
                <form action="kelola_kuis" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    </form>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Daftar Kuis</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Judul Kuis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($kuis_list as $kuis): ?>
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-slate-900"><?php echo htmlspecialchars($kuis['judul']); ?></div>
                                        <div class="text-sm text-slate-500"><?php echo htmlspecialchars($kuis['deskripsi']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500"><?php echo htmlspecialchars($kuis['category_name'] ?? 'N/A'); ?></td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <a href="kelola_soal?kuis_id=<?php echo $kuis['id']; ?>" class="bg-green-600 text-white px-3 py-1 rounded-md text-xs font-semibold hover:bg-green-700 mr-2">
                                            Kelola Soal
                                        </a>
                                        <a href="kuis_edit/<?php echo $kuis['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                        <form action="kelola_kuis" method="POST" class="inline-block" onsubmit="return confirm('Yakin? SEMUA SOAL di dalamnya akan terhapus.');">
                                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                            <input type="hidden" name="kuis_id" value="<?php echo $kuis['id']; ?>">
                                            <button type="submit" name="hapus_kuis" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav class="mt-8 flex items-center justify-center space-x-2">
                 <?php if ($total_pages > 1): ?>
                    <?php endif; ?>
            </nav>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>