<?php
// 1. Panggil Penjaga Keamanan
// File ini akan mengecek apakah user sudah login atau belum.
require_once 'auth_check.php';

// 2. Arahkan ke Dashboard
// Jika user lolos dari 'auth_check.php' (artinya sudah login),
// kita langsung arahkan dia ke halaman dashboard yang sebenarnya.
// Kita gunakan URL bersih (tanpa .php)
header('Location: dashboard');
exit;
?>