<?php
// --- PENGATURAN DATABASE ---
$db_host = 'localhost';     // Biasanya 'localhost'
$db_name = 'study'; // Ganti dengan nama DB kamu
$db_user = 'root';          // Ganti dengan username DB kamu
$db_pass = 'root';              // Ganti dengan password DB kamu
// --------------------------

// --- DATA ADMIN BARU ---
$admin_username = 'admin';              // Ganti dengan username yang kamu inginkan
$admin_password = 'Alekpedia#11'; // Ganti dengan password kuat
// -----------------------

try {
    // 1. Buat koneksi PDO
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    // 2. Hash password
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

    // 3. Masukkan ke database
    $sql = "INSERT INTO admin_users (username, password_hash) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$admin_username, $hashed_password]);

    echo "<h1>BERHASIL!</h1>";
    echo "<p>User admin '<strong>" . htmlspecialchars($admin_username) . "</strong>' telah dibuat.</p>";
    echo "<p>Silakan <strong>HAPUS</strong> file 'buat_admin.php' ini sekarang juga!</p>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>