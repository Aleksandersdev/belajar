<?php
// Muat config untuk memulai session
require_once 'config.php';

// Hancurkan semua data session
session_unset();
session_destroy();

// Arahkan kembali ke halaman login dengan pesan sukses
// Kita bisa gunakan session lagi (karena session_start() akan dipanggil di login.php)
session_start();
$_SESSION['login_success'] = 'Anda telah berhasil logout.';
header('Location: login.php');
exit;
?>