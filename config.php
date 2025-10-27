<?php
// Mendefinisikan konstanta keamanan
define('APP_RUNNING', true);

// --- PENGATURAN DATABASE ---
$db_host = 'localhost';     // Sesuaikan dengan host DB kamu
$db_name = 'study'; // Sesuaikan dengan nama DB kamu
$db_user = 'root';          // Sesuaikan dengan username DB kamu
$db_pass = 'root';              // Sesuaikan dengan password DB kamu
// --------------------------

// Memulai sesi di setiap halaman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Membuat Token CSRF untuk keamanan form
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Koneksi Database (PDO)
try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    // Variabel $pdo akan digunakan di file lain
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Di mode produksi, jangan tampilkan error detail
    // Cukup log error dan tampilkan pesan umum
    die("Koneksi database gagal: " . $e->getMessage()); 
}

// Set pengaturan error (sesuai dari langkah sebelumnya)
ini_set('display_errors', 0); // Matikan di produksi
ini_set('log_errors', 1);
// ini_set('error_log', '/path/ke/php-error.log'); // Tentukan path log error
error_reporting(E_ALL);

?>