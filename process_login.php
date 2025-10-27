<?php
// Memuat konfigurasi (database, session, $pdo)
require_once 'config.php';

// 1. Cek Metode Request (Harus POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Akses dilarang.');
}

// 2. Verifikasi Token CSRF (Mencegah Serangan CSRF)
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['login_error'] = 'Token keamanan tidak valid.';
    header('Location: login.php');
    exit;
}

// 3. Ambil dan bersihkan data
$username = trim($_POST['username']);
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = 'Username dan password tidak boleh kosong.';
    header('Location: login.php');
    exit;
}

try {
    // 4. Cari user di database (Mencegah SQL Injection)
    $sql = "SELECT * FROM admin_users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // 5. Verifikasi Password
    // $user = user ditemukan, password_verify = cek kesamaan hash
    if ($user && password_verify($password, $user['password_hash'])) {
        
        // --- LOGIN BERHASIL ---

        // 6. Regenerasi Session ID (Mencegah Session Fixation)
        session_regenerate_id(true);

        // 7. Simpan status login di session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];

        // 8. Arahkan ke dashboard
        header('Location: admin/dashboard.php');
        exit;

    } else {
        // --- LOGIN GAGAL ---
        $_SESSION['login_error'] = 'Username atau password salah.';
        header('Location: login.php');
        exit;
    }

} catch (PDOException $e) {
    // Tangani error database
    $_SESSION['login_error'] = 'Terjadi masalah pada server. Coba lagi nanti.';
    // Di produksi, log error $e->getMessage()
    header('Location: login.php');
    exit;
}
?>