<?php
// Panggil Penjaga Keamanan
// PERBAIKAN: Gunakan __DIR__ untuk path absolut
require_once __DIR__ . '/auth_check.php';

// --- LOGIKA FILTER & PAGINATION ---

// 1. Ambil semua kategori (untuk dropdown filter)
$all_categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

// 2. Tentukan variabel filter & pagination
$limit = 10;
$search_term = $_GET['search'] ?? '';
$category_filter = $_GET['category'] ?? '';
$sort_order = $_GET['sort'] ?? 'update_terbaru'; // Default: di-update terbaru
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// 3. Bangun query SQL secara dinamis
$base_sql = "FROM pages p LEFT JOIN categories c ON p.category_id = c.id";
$where_sql = " WHERE 1=1";
$params = [];

if (!empty($search_term)) {
    $where_sql .= " AND p.title LIKE ?";
    $params[] = '%' . $search_term . '%';
}
if (!empty($category_filter)) {
    $where_sql .= " AND p.category_id = ?";
    $params[] = (int)$category_filter;
}

$sort_sql = " ORDER BY ";
switch ($sort_order) {
    case 'update_terlama': // Opsi baru
        $sort_sql .= "p.updated_at ASC";
        break;
    case 'terbaru': // Berdasarkan tanggal dibuat
        $sort_sql .= "p.created_at DESC";
        break;
    case 'terlama': // Berdasarkan tanggal dibuat
        $sort_sql .= "p.created_at ASC";
        break;
    case 'nama_asc':
        $sort_sql .= "p.title ASC";
        break;
    case 'nama_desc':
        $sort_sql .= "p.title DESC";
        break;
    case 'update_terbaru': // Opsi baru & Default
    default:
        $sort_sql .= "p.updated_at DESC";
        break;
}

// 4. Query COUNT
$stmt_count = $pdo->prepare("SELECT COUNT(p.id) $base_sql $where_sql");
$stmt_count->execute($params);
$total_posts = (int)$stmt_count->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// 5. Query untuk MENGAMBIL DATA (sesuai halaman saat ini)
$data_sql = "SELECT p.id, p.title, p.slug, p.created_at, p.access_code, c.name AS category_name
             $base_sql $where_sql $sort_sql LIMIT ? OFFSET ?"; // <-- Ditambahkan p.access_code
             
$data_params = $params;
$data_params[] = $limit;
$data_params[] = $offset;
$stmt_data = $pdo->prepare($data_sql);

$param_index = 1;
foreach ($params as $param) {
    // Tentukan tipe data
    $stmt_data->bindValue($param_index++, $param, is_int($param) ? PDO::PARAM_INT : PDO::PARAM_STR); 
}
$stmt_data->bindValue($param_index++, $limit, PDO::PARAM_INT);
$stmt_data->bindValue($param_index++, $offset, PDO::PARAM_INT);

$stmt_data->execute();
$halaman_list = $stmt_data->fetchAll();

// 6. Siapkan query string untuk link pagination
$query_params = [];
if (!empty($search_term)) $query_params['search'] = $search_term;
if (!empty($category_filter)) $query_params['category'] = $category_filter;
if ($sort_order !== 'update_terbaru') $query_params['sort'] = $sort_order; // Gunakan default baru

// --- AKHIR LOGIKA ---

// Muat header (Path ini sudah benar)
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-extrabold text-slate-800">Kelola Halaman/Artikel</h1>
                <a href="halaman_tambah" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                    Tambah Halaman Baru
                </a>
            </div>

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

            <div class="mb-6 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
                <form action="halaman" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    
                    <div>
                        <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Cari Judul</label>
                        <input type="search" name="search" id="search"
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Ketik judul..."
                               value="<?php echo htmlspecialchars($search_term); ?>">
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <select name="category" id="category"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($all_categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"
                                    <?php echo ($category_filter == $cat['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="sort" class="block text-sm font-medium text-slate-700 mb-1">Urutkan</label>
                        <select name="sort" id="sort" class="w-full ...">
    <option value="update_terbaru" <?php echo ($sort_order == 'update_terbaru') ? 'selected' : ''; ?>>Update Terbaru</option>
    <option value="update_terlama" <?php echo ($sort_order == 'update_terlama') ? 'selected' : ''; ?>>Update Terlama</option>
    <option value="terbaru" <?php echo ($sort_order == 'terbaru') ? 'selected' : ''; ?>>Dibuat Terbaru</option>
    <option value="terlama" <?php echo ($sort_order == 'terlama') ? 'selected' : ''; ?>>Dibuat Terlama</option>
    <option value="nama_asc" <?php echo ($sort_order == 'nama_asc') ? 'selected' : ''; ?>>Judul A-Z</option>
    <option value="nama_desc" <?php echo ($sort_order == 'nama_desc') ? 'selected' : ''; ?>>Judul Z-A</option>
</select>
                    </div>

                    <div class="flex items-end space-x-2">
                        <button type="submit" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md h-full">
                            Filter
                        </button>
                        <a href="halaman" class="flex items-center justify-center bg-slate-200 text-slate-700 font-semibold px-4 py-2 rounded-lg shadow-md h-full">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
        <th class="px-6 py-3 text-left ...">Judul</th>
        <th class="px-6 py-3 text-left ...">Kategori</th>
        <th class="px-6 py-3 text-left ...">Tanggal</th>
        <th class="px-6 py-3 text-left ...">Kode Akses</th> <th class="px-6 py-3 text-right ...">Aksi</th>
    </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            
                            <?php if (empty($halaman_list)): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-slate-500">
                                        Tidak ada halaman yang ditemukan
                                        <?php if(!empty($search_term) || !empty($category_filter)) echo "sesuai filter Anda."; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($halaman_list as $halaman): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        <?php echo htmlspecialchars($halaman['title'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        <?php echo htmlspecialchars($halaman['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        <?php echo date('d M Y, H:i', strtotime($halaman['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
    <?php
        // Tampilkan kode akses atau '-' jika publik (NULL)
        echo !empty($halaman['access_code']) ? htmlspecialchars($halaman['access_code']) : '-';
    ?>
</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="../halaman/<?php echo $halaman['slug']; ?>" target="_blank" class="text-green-600 hover:text-green-900 mr-4">Lihat</a>
                                        <a href="halaman_edit/<?php echo $halaman['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                        <form action="halaman_proses" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus halaman ini?');">
                                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                            <input type="hidden" name="halaman_id" value="<?php echo $halaman['id']; ?>">
                                            <button type="submit" name="hapus_halaman" class="text-red-600 hover:text-red-900">Hapus</button>
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
                                  <?php echo ($i == $current_page) 
                                         ? 'bg-blue-600 text-white font-bold' 
                                         : 'bg-white text-slate-700 hover:bg-slate-100'; ?>">
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
// Path ini sudah benar
require_once __DIR__ . '/../partials/footer.php'; 
?>