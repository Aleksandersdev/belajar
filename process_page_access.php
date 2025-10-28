<?php
// PASTIKAN SESSION DIMULAI DI AWAL
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Panggil config (untuk $pdo)
require_once 'config.php'; // Pastikan $pdo tersedia

// Hanya proses jika metodenya POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

// Validasi CSRF
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('Token CSRF tidak valid.');
}

// Ambil data form
$submitted_code = $_POST['access_code'] ?? '';
$page_id = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 0;
// Ambil URL redirect, default ke beranda JIKA TIDAK ADA (fallback)
$redirect_url = $_POST['redirect_url'] ?? '/';

// Validasi input
if (empty($submitted_code) || $page_id <= 0) {
    $_SESSION['page_access_error'] = 'Kode akses tidak boleh kosong.';
    // PERBAIKAN: Selalu redirect ke URL asal
    header('Location: ' . $redirect_url);
    exit;
}

// Cek kode di database
try {
    $stmt = $pdo->prepare("SELECT id, access_code FROM pages WHERE id = ?");
    $stmt->execute([$page_id]);
    $page = $stmt->fetch();

    if ($page && $page['access_code'] !== null && $submitted_code === $page['access_code']) {
        // --- Kode Benar ---
       // --- KODE BENAR ---
    // Simpan KODE AKSES yang berhasil dimasukkan ke session
    if (!isset($_SESSION['granted_access_codes'])) {
        $_SESSION['granted_access_codes'] = [];
    }
    // Tambahkan KODE ini ke session (pastikan unik)
    $valid_code = $page['access_code']; // Ambil kode yang benar dari DB
    if (!in_array($valid_code, $_SESSION['granted_access_codes'])) {
        $_SESSION['granted_access_codes'][] = $valid_code;
    }

    unset($_SESSION['page_access_error']); // Hapus pesan error jika ada
    // Redirect kembali ke halaman asal
    header('Location: ' . $redirect_url);
    exit;
    } else {
        // --- Kode Salah ---
        $_SESSION['page_access_error'] = 'Kode akses salah.';
        // PERBAIKAN: Selalu redirect ke URL asal
        header('Location: ' . $redirect_url);
        exit;
    }

} catch (PDOException $e) {
    // Error database
    $_SESSION['page_access_error'] = 'Terjadi kesalahan database.';
    // Catat error $e->getMessage() di log server
    // PERBAIKAN: Selalu redirect ke URL asal
    header('Location: ' . $redirect_url);
    exit;
}
?>