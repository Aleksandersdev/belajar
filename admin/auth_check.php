<?php
// Memuat konfigurasi. Path '../' artinya 'naik satu folder'.
require_once __DIR__ . '/../config.php';

// Periksa apakah admin sudah login atau belum
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    
    // Jika belum, kirim pesan error dan lempar kembali ke halaman login
    $_SESSION['login_error'] = 'Anda harus login untuk mengakses halaman ini.';
    header('Location: ../login.php'); // Arahkan ke login.php di folder root
    exit;
}

// Jika sudah login, biarkan script berlanjut.
?>