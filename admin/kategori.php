<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// --- Ambil SEMUA kategori (untuk dropdown Induk) ---
// Kita butuh ini untuk form tambah/edit, terlepas dari filter
$stmt_all_cats_dropdown = $pdo->prepare("SELECT id, name FROM categories ORDER BY name ASC");
$stmt_all_cats_dropdown->execute();
$all_categories_for_dropdown = $stmt_all_cats_dropdown->fetchAll();

// --- LOGIKA FILTER, PENCARIAN, SORT, & PAGINATION KATEGORI ---

// 1. Tentukan variabel
$limit = 10; // Jumlah kategori per halaman

// Ambil parameter dari URL
$search_term = $_GET['search'] ?? '';
$sort_order = $_GET['sort'] ?? 'nama_asc'; // Default: Nama A-Z
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// 2. Bangun query SQL
$base_sql = "FROM categories";
$where_sql = " WHERE 1=1";
$params = []; // Parameter untuk prepared statement

// Tambahkan filter pencarian (berdasarkan nama)
if (!empty($search_term)) {
    $where_sql .= " AND name LIKE ?";
    $params[] = '%' . $search_term . '%';
}

// Tentukan urutan (ORDER BY)
$sort_sql = " ORDER BY ";
switch ($sort_order) {
    case 'nama_desc':
        $sort_sql .= "name DESC";
        break;
    case 'id_desc': // Anggap ID merepresentasikan 'terbaru'
        $sort_sql .= "id DESC";
        break;
    case 'id_asc': // Anggap ID merepresentasikan 'terlama'
        $sort_sql .= "id ASC";
        break;
    case 'nama_asc':
    default:
        $sort_sql .= "name ASC";
        break;
}

// 3. Query untuk MENGHITUNG TOTAL KATEGORI (untuk pagination)
$stmt_count = $pdo->prepare("SELECT COUNT(id) $base_sql $where_sql");
$stmt_count->execute($params);
$total_categories = (int)$stmt_count->fetchColumn();
$total_pages = ceil($total_categories / $limit);

// 4. Query untuk MENGAMBIL DATA KATEGORI (sesuai halaman)
// Kita juga perlu mengambil nama induknya
$data_sql = "SELECT cat.id, cat.name, cat.parent_id, parent_cat.name AS parent_name
             $base_sql cat
             LEFT JOIN categories parent_cat ON cat.parent_id = parent_cat.id
             $where_sql $sort_sql LIMIT ? OFFSET ?";

// Tambahkan parameter pagination
$data_params = $params;
$data_params[] = $limit;
$data_params[] = $offset;

$stmt_data = $pdo->prepare($data_sql);

// Binding parameter
$param_index = 1;
foreach ($params as $param) {
    $stmt_data->bindValue($param_index++, $param, PDO::PARAM_STR); // Asumsikan semua filter string
}
$stmt_data->bindValue($param_index++, $limit, PDO::PARAM_INT);
$stmt_data->bindValue($param_index++, $offset, PDO::PARAM_INT);

$stmt_data->execute();
$kategori_list = $stmt_data->fetchAll(); // Hasil filter & pagination

// 5. Siapkan query string untuk link pagination
$query_params = [];
if (!empty($search_term)) $query_params['search'] = $search_term;
if ($sort_order !== 'nama_asc') $query_params['sort'] = $sort_order;

// --- AKHIR LOGIKA ---

// (CREATE) Proses penambahan Kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kategori'])) {
    // ... (Logika Tambah Kategori tidak berubah) ...
     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
     $kategori_nama = trim($_POST['kategori_nama']);
     $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
     if (!empty($kategori_nama)) {
         try {
             $sql = "INSERT INTO categories (name, parent_id) VALUES (?, ?)";
             $stmt = $pdo->prepare($sql);
             $stmt->execute([$kategori_nama, $parent_id]);
             $_SESSION['pesan_sukses'] = 'Kategori berhasil ditambahkan.';
         } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
     }
     header('Location: kategori'); exit;
}

// (DELETE) Proses penghapusan Kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_kategori'])) {
    // ... (Logika Hapus Kategori tidak berubah) ...
     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
     $kategori_id = $_POST['kategori_id'];
     try {
         // Hati-hati: Mungkin perlu logika tambahan untuk anak kategori
         $sql = "DELETE FROM categories WHERE id = ?";
         $stmt = $pdo->prepare($sql);
         $stmt->execute([$kategori_id]);
         $_SESSION['pesan_sukses'] = 'Kategori berhasil dihapus.';
     } catch (PDOException $e) { $_SESSION['pesan_error'] = 'Gagal: ' . $e->getMessage(); }
     header('Location: kategori'); exit;
}

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
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_sukses']; unset($_SESSION['pesan_sukses']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?></div>
                <?php endif; ?>
                <form action="kategori" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="mb-4">
                        <label for="kategori_nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori</label>
                        <input type="text" id="kategori_nama" name="kategori_nama" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="parent_id" class="block text-sm font-medium text-slate-700 mb-2">Induk Kategori (Opsional)</label>
                        <select id="parent_id" name="parent_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0">-- Tidak Ada Induk --</option>
                            <?php foreach ($all_categories_for_dropdown as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="tambah_kategori" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">Tambah</button>
                </form>
            </div>

            <div class="mb-6 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
                <form action="kategori" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Cari Nama</label>
                        <input type="search" name="search" id="search"
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Ketik nama kategori..."
                               value="<?php echo htmlspecialchars($search_term); ?>">
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-slate-700 mb-1">Urutkan</label>
                        <select name="sort" id="sort"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="nama_asc" <?php echo ($sort_order == 'nama_asc') ? 'selected' : ''; ?>>Nama A-Z</option>
                            <option value="nama_desc" <?php echo ($sort_order == 'nama_desc') ? 'selected' : ''; ?>>Nama Z-A</option>
                            <option value="id_desc" <?php echo ($sort_order == 'id_desc') ? 'selected' : ''; ?>>Terbaru</option>
                            <option value="id_asc" <?php echo ($sort_order == 'id_asc') ? 'selected' : ''; ?>>Terlama</option>
                        </select>
                    </div>
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md h-full">Filter</button>
                        <a href="kategori" class="flex items-center justify-center bg-slate-200 text-slate-700 font-semibold px-4 py-2 rounded-lg shadow-md h-full">Reset</a>
                    </div>
                </form>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Daftar Kategori</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Induk Kategori</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php if (empty($kategori_list)): ?>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-slate-500">
                                        Tidak ada kategori ditemukan
                                        <?php if(!empty($search_term)) echo "sesuai pencarian Anda."; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        <?php echo htmlspecialchars($kategori['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        <?php echo $kategori['parent_id'] == 0 ? '-' : htmlspecialchars($kategori['parent_name'] ?? 'N/A'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="kategori_edit/<?php echo $kategori['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                        <form action="kategori" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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

             <nav class="mt-8 flex items-center justify-center space-x-2" data-aos="fade-up">
                <?php if ($total_pages > 1): ?>
                    <?php if ($current_page > 1): ?>
                        <a href="?<?php echo http_build_query(array_merge($query_params, ['page' => $current_page - 1])); ?>"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 shadow-md border border-slate-200 hover:bg-slate-100 transition">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?<?php echo http_build_query(array_merge($query_params, ['page' => $i])); ?>"
                           class="flex items-center justify-center w-10 h-10 rounded-full shadow-md border border-slate-200 transition
                                  <?php echo ($i == $current_page) ? 'bg-blue-600 text-white font-bold' : 'bg-white text-slate-700 hover:bg-slate-100'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                    <?php if ($current_page < $total_pages): ?>
                        <a href="?<?php echo http_build_query(array_merge($query_params, ['page' => $current_page + 1])); ?>"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 shadow-md border border-slate-200 hover:bg-slate-100 transition">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
            </div>
    </section>
</main>

<?php
require_once __DIR__ . '/../partials/footer.php';
?>