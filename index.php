<?php
// Panggil config (sekarang berisi fungsi hierarki)
require_once 'config.php';

// --- Ambil Kategori Hierarkis (untuk Sidebar) ---
// Kita panggil fungsi dari config.php
// --- Bangun Struktur Pohon Kategori ---
$categoryTree = buildCategoryTree($pdo);

// --- LOGIKA PENCARIAN & PAGINATION (Untuk SEMUA Artikel) ---

// 1. Tentukan variabel
$limit = 10; // Jumlah postingan per halaman
$search_term = $_GET['search'] ?? ''; // Ambil istilah pencarian
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Ambil halaman saat ini
$offset = ($current_page - 1) * $limit; // Hitung offset

// 2. Siapkan query SQL
$base_sql = "FROM pages p LEFT JOIN categories c ON p.category_id = c.id";
$where_sql = "";
$params = []; // Parameter untuk prepared statement

// Tambahkan kondisi WHERE jika ada pencarian
if (!empty($search_term)) {
    $where_sql = " WHERE p.title LIKE ?";
    $params[] = '%' . $search_term . '%';
}

// 3. Query untuk MENGHITUNG TOTAL POSTINGAN (untuk pagination)
$count_query = "SELECT COUNT(p.id) " . $base_sql . $where_sql;
$stmt_count = $pdo->prepare($count_query);
$stmt_count->execute($params);
$total_posts = (int)$stmt_count->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// 4. Query untuk MENGAMBIL DATA POSTINGAN (untuk halaman ini)
$data_query = "SELECT p.title, p.slug, p.icon_path, c.name AS category_name "
            . $base_sql . $where_sql
            . " ORDER BY p.created_at DESC LIMIT ? OFFSET ?";

$stmt_data = $pdo->prepare($data_query);
$param_index = 1;
if (!empty($search_term)) {
    $stmt_data->bindValue($param_index++, $params[0], PDO::PARAM_STR);
}
$stmt_data->bindValue($param_index++, $limit, PDO::PARAM_INT);
$stmt_data->bindValue($param_index++, $offset, PDO::PARAM_INT);
$stmt_data->execute();
$posts = $stmt_data->fetchAll();

// 5. Siapkan array desain (untuk warna-warni kartu & ikon default)
$design_elements = [
    ['color' => 'blue', 'icon' => 'file-text'],
    ['color' => 'purple', 'icon' => 'file-text'],
    ['color' => 'teal', 'icon' => 'file-text'],
    ['color' => 'rose', 'icon' => 'file-text'],
    ['color' => 'amber', 'icon' => 'file-text'],
    ['color' => 'sky', 'icon' => 'file-text'],
    ['color' => 'indigo', 'icon' => 'file-text'],
    ['color' => 'lime', 'icon' => 'file-text'],
    ['color' => 'orange', 'icon' => 'file-text']
];

// 6. Siapkan parameter URL untuk link pagination
$query_params = [];
if (!empty($search_term)) $query_params['search'] = $search_term;

// --- AKHIR LOGIKA ---

// Memuat bagian header
$page_title = 'Beranda'; // Atur judul halaman dinamis
include 'partials/header.php';
?>

<main>
    
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-12">

                <aside class="w-full md:w-1/4 order-2 md:order-1" data-aos="fade-up">
                    <div class="sticky top-28 space-y-8">

                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-4">Cari Artikel</h3>
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
                            <h3 class="text-xl font-bold text-slate-800 mb-4">Filter Kategori</h3>
                            <div class="rounded-lg max-h-[70vh] overflow-y-auto border border-slate-200 shadow-sm bg-white p-2">
    <ul class="space-y-1">
        <li>
            <a href="/" class="block w-full px-4 py-3 rounded-lg text-sm font-semibold transition bg-blue-100 text-blue-700">
                Semua Kategori
            </a>
        </li>
    </ul>
    <?php
    // Panggil fungsi render sidebar
    // Di beranda, tidak ada kategori aktif (ID 0) dan tidak ada leluhur
    echo renderCategorySidebar($categoryTree, 0, []);
    ?>
</div>
                        </div>

                    </div> </aside>

                <div class="w-full md:w-3/4 order-1 md:order-2">

                    <nav class="flex mb-4 text-sm text-slate-500" data-aos="fade-up">
                        <a href="/" class="hover:underline">Home</a>
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                        <span class="font-medium text-slate-700">Semua Artikel</span>
                    </nav>
                    <div class="flex items-center space-x-3 mb-10" data-aos="fade-up">
                         <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                            <i data-lucide="book-open" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-slate-800">Artikel & Materi Kami</h2>
                            <p class="text-slate-500">Menampilkan semua artikel dan materi.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <?php if (empty($posts)): ?>
                            <div class="col-span-full text-center py-10">
                                <h3 class="text-2xl font-bold text-slate-700">Tidak Ditemukan</h3>
                                <p class="text-slate-500 mt-2">
                                    <?php if (!empty($search_term)): ?>
                                        Kami tidak menemukan artikel dengan judul "<?php echo htmlspecialchars($search_term); ?>".
                                    <?php else: ?>
                                        Belum ada artikel untuk ditampilkan di sini.
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

                                <a href="halaman/<?php echo $post['slug']; ?>"
                                   class="group block bg-white rounded-2xl p-4 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-<?php echo $color; ?>-500/20"
                                   data-aos="fade-up"
                                   data-aos-delay="<?php echo ($index % 2) * 100; ?>">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0 w-16 h-16 rounded-xl flex items-center justify-center overflow-hidden <?php echo !empty($post['icon_path']) ? 'bg-slate-100' : 'bg-' . $color . '-100'; ?>">
                                            <?php if (!empty($post['icon_path'])): ?>
                                                <img src="uploads/<?php echo htmlspecialchars($post['icon_path']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-full object-cover">
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
// Memuat bagian footer
include 'partials/footer.php';
?>