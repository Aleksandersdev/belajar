<?php
// Panggil config menggunakan __DIR__ (path absolut)
require_once __DIR__ . '/config.php';

// Ambil slug dari URL
if (!isset($_GET['slug'])) {
    die('Halaman tidak ditemukan. (Slug tidak ada)');
}
$slug = $_GET['slug'];

// Ambil data halaman dari database
try {
    $sql = "SELECT p.title, p.content, p.created_at, c.name AS category_name
            FROM pages p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.slug = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$slug]);
    $halaman = $stmt->fetch();

} catch (PDOException $e) {
    die("Error database: ". $e->getMessage());
}

// Cek jika halaman tidak ditemukan
if (!$halaman) {
    header('Location: /'); 
    exit;
}

// Muat header
$page_title = htmlspecialchars($halaman['title'], ENT_QUOTES, 'UTF-8');
include __DIR__ . '/partials/header.php'; 
?>

<main>
    <?php echo $halaman['content']; ?>
</main>

<?php
// Muat footer menggunakan __DIR__ (path absolut)
include __DIR__ . '/partials/footer.php';
?>