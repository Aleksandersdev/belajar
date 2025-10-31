<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// --- Ambil SEMUA kategori kuis (untuk dropdown Induk) ---
$stmt_all_cats_dropdown = $pdo->prepare("SELECT id, name FROM kuis_kategori ORDER BY name ASC");
$stmt_all_cats_dropdown->execute();
$all_categories_for_dropdown = $stmt_all_cats_dropdown->fetchAll();

// --- LOGIKA FILTER, PENCARIAN, SORT, & PAGINATION ---
$limit = 15;
$search_term = $_GET['search'] ?? '';
$sort_order = $_GET['sort'] ?? 'nama_asc';
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

$base_sql = "FROM kuis_kategori";
$where_sql = " WHERE 1=1";
$params = [];
if (!empty($search_term)) {
    $where_sql .= " AND name LIKE ?";
    $params[] = '%' . $search_term . '%';
}
$sort_sql = " ORDER BY ";
switch ($sort_order) {
    case 'nama_desc': $sort_sql .= "name DESC"; break;
    case 'id_desc': $sort_sql .= "id DESC"; break;
    case 'id_asc': $sort_sql .= "id ASC"; break;
    default: $sort_sql .= "name ASC"; break;
}

$stmt_count = $pdo->prepare("SELECT COUNT(id) $base_sql $where_sql");
$stmt_count->execute($params);
$total_categories = (int)$stmt_count->fetchColumn();
$total_pages = ceil($total_categories / $limit);

$data_sql = "SELECT cat.id, cat.name, cat.parent_id, cat.access_code, parent_cat.name AS parent_name
             $base_sql cat
             LEFT JOIN kuis_kategori parent_cat ON cat.parent_id = parent_cat.id
             $where_sql $sort_sql LIMIT ? OFFSET ?";

$data_params = $params; $data_params[] = $limit; $data_params[] = $offset;
$stmt_data = $pdo->prepare($data_sql);
$param_index = 1;
foreach ($params as $param) { $stmt_data->bindValue($param_index++, $param, PDO::PARAM_STR); }
$stmt_data->bindValue($param_index++, $limit, PDO::PARAM_INT);
$stmt_data->bindValue($param_index++, $offset, PDO::PARAM_INT);
$stmt_data->execute();
$kategori_list = $stmt_data->fetchAll();

$query_params = [];
if (!empty($search_term)) $query_params['search'] = $search_term;
if ($sort_order !== 'nama_asc') $query_params['sort'] = $sort_order;

// (CREATE) Proses penambahan Kategori Kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kategori'])) {
     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
     $kategori_nama = trim($_POST['kategori_nama']);
     $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
     $access_code = !empty($_POST['access_code']) ? trim($_POST['access_code']) : null;
     if (!empty($kategori_nama)) {
         try {
             $sql = "INSERT INTO kuis_kategori (name, parent_id, access_code) VALUES (?, ?, ?)";
             $stmt = $pdo->prepare($sql);
             $stmt->execute([$kategori_nama, $parent_id, $access_code]);
             $_SESSION['pesan_sukses'] = 'Kategori kuis berhasil ditambahkan.';
         } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
     }
     header('Location: kuis_kategori'); exit;
}

// (DELETE) Proses penghapusan Kategori Kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_kategori'])) {
     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
     $kategori_id = $_POST['kategori_id'];
     try {
         $sql = "DELETE FROM kuis_kategori WHERE id = ?";
         $stmt = $pdo->prepare($sql);
         $stmt->execute([$kategori_id]);
         $_SESSION['pesan_sukses'] = 'Kategori kuis berhasil dihapus.';
     } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
     header('Location: kuis_kategori'); exit;
}

// Muat header
$page_title = "Kelola Kategori Kuis";
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Kelola Kategori Kuis TKA</h1>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200 mb-8 max-w-lg">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Tambah Kategori Kuis Baru</h2>
                <?php if (isset($_SESSION['pesan_sukses'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_sukses']; unset($_SESSION['pesan_sukses']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?></div>
                <?php endif; ?>
                <form action="kuis_kategori" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="mb-4">
                        <label for="kategori_nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori</label>
                        <input type="text" id="kategori_nama" name="kategori_nama" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="parent_id" class="block text-sm font-medium text-slate-700 mb-2">Induk Kategori (Opsional)</label>
                        <select id="parent_id" name="parent_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                            <option value="0">-- Tidak Ada Induk (Induk Utama) --</option>
                            <?php foreach ($all_categories_for_dropdown as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="access_code" class="block text-sm font-medium text-slate-700 mb-2">Kode Akses (Opsional)</label>
                        <input type="text" id="access_code" name="access_code" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Biarkan kosong jika publik">
                    </div>
                    <button type="submit" name="tambah_kategori" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">Tambah</button>
                </form>
            </div>
            <div class="mb-6 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
                <form action="kuis_kategori" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    </form>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Daftar Kategori Kuis</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Induk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Kode Akses</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($kategori_list as $kategori): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900"><?php echo htmlspecialchars($kategori['name']); ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-500"><?php echo $kategori['parent_id'] == 0 ? '-' : htmlspecialchars($kategori['parent_name'] ?? 'N/A'); ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-500"><?php echo !empty($kategori['access_code']) ? htmlspecialchars($kategori['access_code']) : '-'; ?></td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <a href="kuis_kategori_edit/<?php echo $kategori['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                        <form action="kuis_kategori" method="POST" class="inline-block" onsubmit="return confirm('Yakin?');">
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
            <nav class="mt-8 flex items-center justify-center space-x-2">
                 <?php if ($total_pages > 1): ?>
                    <?php endif; ?>
            </nav>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>