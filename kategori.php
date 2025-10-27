<?php
// Panggil config (gunakan __DIR__)
require_once __DIR__ . '/config.php';

// --- Ambil Kategori Hierarkis (untuk Sidebar) ---
// Panggil fungsi dari config.php
$hierarchical_categories = getHierarchicalCategories($pdo); // Untuk sidebar lama

// --- Bangun Struktur Pohon Kategori (untuk Sidebar BARU) ---
$categoryTree = buildCategoryTree($pdo); // Untuk sidebar accordion


// --- 1. DAPATKAN KATEGORI DARI ID DI URL ---
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /'); exit;
}
$category_id = (int)$_GET['id']; // ID Kategori yang sedang dilihat

// Ambil info nama kategori dan parent_id
$stmt_cat_info = $pdo->prepare("SELECT name, parent_id FROM categories WHERE id = ?");
$stmt_cat_info->execute([$category_id]);
$category_info = $stmt_cat_info->fetch();
if (!$category_info) {
    header('Location: /'); exit;
}
$category_name = $category_info['name'];

// --- Fungsi untuk mendapatkan Breadcrumbs ---
// (Fungsi ini ada di config.php atau bisa ditaruh di sini jika belum)
if (!function_exists('getBreadcrumbs')) {
    function getBreadcrumbs(PDO $pdo, int $catId): array {
        $breadcrumbs = [];
        $currentId = $catId;
        while ($currentId != 0) {
            $stmt = $pdo->prepare("SELECT id, name, parent_id FROM categories WHERE id = ?");
            $stmt->execute([$currentId]);
            $cat = $stmt->fetch();
            if (!$cat) break;
            array_unshift($breadcrumbs, $cat);
            $currentId = $cat['parent_id'];
        }
        return $breadcrumbs;
    }
}
$breadcrumbs = getBreadcrumbs($pdo, $category_id);
// Dapatkan ID leluhur (untuk logika sidebar)
$ancestor_ids = array_map(function($crumb) { return $crumb['id']; }, $breadcrumbs);
// --- Akhir fungsi Breadcrumbs ---


// --- Dapatkan ID Induk + Semua Keturunannya ---
// Panggil fungsi dari config.php
$category_ids_to_fetch = getCategoryDescendants($pdo, $category_id);

// --- 2. LOGIKA PENCARIAN & PAGINATION ---
$limit = 6;
$search_term = $_GET['search'] ?? '';
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Siapkan query (Mengambil artikel dari kategori ini DAN keturunannya)
$base_sql = "FROM pages p LEFT JOIN categories c ON p.category_id = c.id";
$placeholders = implode(',', array_fill(0, count($category_ids_to_fetch), '?'));
$where_sql = " WHERE p.category_id IN ($placeholders)";
$params = $category_ids_to_fetch;

if (!empty($search_term)) {
    $where_sql .= " AND p.title LIKE ?";
    $params[] = '%' . $search_term . '%';
}

// 3. Query TOTAL POSTINGAN
$count_query = "SELECT COUNT(p.id) " . $base_sql . $where_sql;
$stmt_count = $pdo->prepare($count_query);
$stmt_count->execute($params);
$total_posts = (int)$stmt_count->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// 4. Query DATA POSTINGAN
$data_query = "SELECT p.title, p.slug, p.icon_path, c.name AS category_name "
            . $base_sql . $where_sql
            . " ORDER BY p.created_at DESC LIMIT ? OFFSET ?";

$stmt_data = $pdo->prepare($data_query);
$data_params = $params;
$data_params[] = $limit;
$data_params[] = $offset;
$param_index = 1;
foreach ($data_params as $param) {
    // Tentukan tipe data secara eksplisit saat binding
    if (is_int($param)) {
        $type = PDO::PARAM_INT;
    } elseif (is_string($param)) {
        $type = PDO::PARAM_STR;
    } else {
        // Fallback jika tipe tidak terdeteksi (misal: array parameter IN)
        // Kita perlu handle array secara berbeda saat execute, bukan bindValue
         $type = PDO::PARAM_STR; // Default ke string jika ragu
    }
     // Penyesuaian: Jangan bind array langsung, PDO akan handle saat execute
     if(!is_array($param)){
       $stmt_data->bindValue($param_index++, $param, $type);
     }
}
// Eksekusi ulang dengan parameter asli yang mungkin berisi array
$stmt_data->execute($data_params); // PDO handle array in IN clause
$posts = $stmt_data->fetchAll();


// 5. Siapkan array desain
$design_elements = [
    ['color' => 'blue', 'icon' => 'file-text'],
    ['color' => 'purple', 'icon' => 'book-open'],
    ['color' => 'teal', 'icon' => 'clipboard-check'],
    ['color' => 'rose', 'icon' => 'award'],
    ['color' => 'amber', 'icon' => 'lightbulb'],
    ['color' => 'sky', 'icon' => 'pen-tool'],
    ['color' => 'indigo', 'icon' => 'target'],
    ['color' => 'lime', 'icon' => 'feather'],
    ['color' => 'orange', 'icon' => 'compass']
];

// 6. Siapkan parameter URL untuk pagination
$query_params = [];
if (!empty($search_term)) $query_params['search'] = $search_term;

// --- AKHIR LOGIKA ---

// Muat header
$page_title = 'Kategori: ' . htmlspecialchars($category_name);
include __DIR__ . '/partials/header.php';
?>

<main>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-12">

                <aside class="w-full md:w-1/4 order-2 md:order-1" data-aos="fade-up">
                    <div class="sticky top-28 space-y-8">

                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-4">Cari Kategori Ini</h3>
                            <form action="" method="GET" class="relative">
                                <input type="search" name="search"
                                       class="w-full pl-4 pr-10 py-2.5 rounded-lg shadow-sm border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Ketik judul..."
                                       value="<?php echo htmlspecialchars($search_term); ?>">
                                <button type="submit" class="absolute right-0 top-0 h-full px-2.5 text-slate-400 hover:text-blue-600 transition-colors">
                                    <i data-lucide="search" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-4">Kategori</h3>
                            <div class="rounded-lg max-h-[70vh] overflow-y-auto border border-slate-200 shadow-sm bg-white p-2">
                                <ul class="space-y-1">
                                    <li>
                                        <a href="/" class="block w-full px-4 py-3 rounded-lg text-sm font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                                            Semua Kategori
                                        </a>
                                    </li>
                                </ul>
                                <?php
                                // Panggil fungsi render sidebar dari config.php
                                // Kirim ID kategori aktif ($category_id) dan ID leluhurnya ($ancestor_ids)
                                echo renderCategorySidebar($categoryTree, $category_id, $ancestor_ids);
                                ?>
                            </div>
                        </div>

                    </div> </aside>


                <div class="w-full md:w-3/4 order-1 md:order-2">

                    <nav class="flex items-center flex-wrap mb-4 text-sm text-slate-500" data-aos="fade-up">
                        <a href="/" class="hover:underline">Home</a>
                        <?php foreach ($breadcrumbs as $index => $crumb): ?>
                            <i data-lucide="chevron-right" class="w-4 h-4 mx-1 flex-shrink-0"></i>
                            <?php if ($index < count($breadcrumbs) - 1): ?>
                                <a href="/kategori/<?php echo $crumb['id']; ?>" class="hover:underline whitespace-nowrap">
                                    <?php echo htmlspecialchars($crumb['name']); ?>
                                </a>
                            <?php else: ?>
                                <span class="font-medium text-slate-700 whitespace-nowrap">
                                    <?php echo htmlspecialchars($crumb['name']); ?>
                                </span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>

                    <div class="flex items-center space-x-3 mb-10" data-aos="fade-up">
                        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                             <i data-lucide="folder" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <div>
                             <h2 class="text-3xl font-extrabold text-slate-800"><?php echo htmlspecialchars($category_name); ?></h2>
                             <p class="text-slate-500">Menampilkan semua artikel dalam kategori ini.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <?php if (empty($posts)): ?>
                             <div class="col-span-full text-center py-10">
                                <h3 class="text-2xl font-bold text-slate-700">Tidak Ditemukan</h3>
                                <p class="text-slate-500 mt-2">
                                    <?php if (!empty($search_term)): ?>
                                        Kami tidak menemukan artikel dengan judul "<?php echo htmlspecialchars($search_term); ?>" di kategori ini.
                                    <?php else: ?>
                                        Belum ada artikel untuk ditampilkan di kategori ini.
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($posts as $index => $post): ?>
                                <?php
                                $design = $design_elements[$index % count($design_elements)];
                                $color = $design['color'];
                                $default_icon = $design['icon'];
                                ?>

                                <a href="../halaman/<?php echo $post['slug']; ?>"
                                   class="group block bg-white rounded-2xl p-4 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-<?php echo $color; ?>-500/20"
                                   data-aos="fade-up"
                                   data-aos-delay="<?php echo ($index % 2) * 100; ?>">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0 w-16 h-16 rounded-xl flex items-center justify-center overflow-hidden <?php echo !empty($post['icon_path']) ? 'bg-slate-100' : 'bg-' . $color . '-100'; ?>">
                                            <?php if (!empty($post['icon_path'])): ?>
                                                <img src="../uploads/<?php echo htmlspecialchars($post['icon_path']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <i data-lucide="<?php echo $default_icon; ?>" class="w-8 h-8 text-<?php echo $color; ?>-600"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-slate-800 mb-1 group-hover:text-<?php echo $color; ?>-700 transition-colors"><?php echo htmlspecialchars($post['title']); ?></h3>
                                            <?php if (!empty($post['category_name'])): ?>
                                                <span class="inline-block bg-<?php echo $color; ?>-100 text-<?php echo $color; ?>-800 text-xs font-medium px-2.5 py-0.5 rounded-full"><?php echo htmlspecialchars($post['category_name']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                    <nav class="mt-16 flex items-center justify-center space-x-2" data-aos="fade-up">
                        <?php if ($total_pages > 1): ?>
                            <?php if ($current_page > 1): ?>
                                <a href="?<?php echo http_build_query(array_merge($query_params, ['page' => $current_page - 1])); ?>" class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 shadow-md border border-slate-200 hover:bg-slate-100 transition">
                                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                                </a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?<?php echo http_build_query(array_merge($query_params, ['page' => $i])); ?>" class="flex items-center justify-center w-10 h-10 rounded-full shadow-md border border-slate-200 transition <?php echo ($i == $current_page) ? 'bg-blue-600 text-white font-bold' : 'bg-white text-slate-700 hover:bg-slate-100'; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <a href="?<?php echo http_build_query(array_merge($query_params, ['page' => $current_page + 1])); ?>" class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 shadow-md border border-slate-200 hover:bg-slate-100 transition">
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </nav>

                </div> </div> </div>
    </section>
</main>

<?php
// Muat footer
include __DIR__ . '/partials/footer.php';
?>