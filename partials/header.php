<?php
// Mencegah file ini diakses secara langsung dari browser
defined('APP_RUNNING') or die('Access denied');
// --- PENGATURAN META TAG DINAMIS ---
// Nilai default (jika tidak di-set oleh halaman pemanggil)
$default_description = "Rangkuman Materi Pelajaran Lengkap dan Latihan Soal untuk persiapan ujian Anda."; // Ganti dengan deskripsi default websitemu
$default_keywords = "Kampus Impian, rangkuman materi, latihan soal, bimbel, try out, UTBK, masuk PTN"; // Ganti dengan kata kunci umum websitemu
$site_name = "Kampus Impian"; // Nama websitemu
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


// Gunakan nilai dari halaman pemanggil jika ada, jika tidak pakai default
$meta_title = isset($page_title) ? htmlspecialchars($page_title) . ' | ' . $site_name : $site_name;
$meta_description = isset($page_description) ? htmlspecialchars($page_description) : $default_description;
$meta_keywords = isset($page_keywords) ? htmlspecialchars($page_keywords) : $default_keywords;
$meta_image = isset($page_image) ? htmlspecialchars($page_image) : $default_image_url; // Gambar spesifik per halaman (opsional)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <title><?php echo isset($page_title) ? $page_title : 'Beranda'; ?> | kampusimpian.com</title>
   <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="robots" content="index, follow"> <meta name="author" content="@rangkumanmateri_"> <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_description; ?>">
    <meta property="og:type" content="website"> <meta property="og:url" content="<?php echo $current_url; ?>">
    <meta property="og:image" content="<?php echo $meta_image; ?>"> <meta property="og:site_name" content="<?php echo $site_name; ?>">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
            background-color: #f8fafc; /* Latar default terang */
            color: #1e293b; 
        }
        /* ... (Semua style CSS kustom kamu dari file HTML asli) ... */
        .hero-bg { background-color: #111827; position: relative; overflow: hidden; }
        #particles-js { position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0; }
        .hero-content { position: relative; z-index: 1; }
        .cta-gradient { background-image: linear-gradient(to right, #581c87, #0e7490); transition: all 0.3s ease; }
        .cta-gradient:hover { box-shadow: 0 10px 20px -10px rgba(34, 211, 238, 0.4); transform: translateY(-2px); }
        .text-gradient-cyan { background-image: linear-gradient(to right, #67e8f9, #22d3ee); -webkit-background-clip: text; background-clip: text; color: transparent; }
        .glow-card { transition: all 0.4s ease; border: 1px solid #374151; background-color: #1f2937; }
        .glow-card:hover { transform: translateY(-8px) scale(1.03); box-shadow: 0 0 40px rgba(34, 211, 238, 0.25); border-color: #22d3ee; }
        .accordion-content { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
        .prose a { color: #22d3ee; text-decoration: none; }
        .prose a:hover { text-decoration: underline; }
    </style>

    
</head>
<body class="bg-slate-50"> 
<header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="text-2xl font-bold text-blue-800">
            Rangkuman Materi
        </a>
        <div class="hidden md:flex items-center space-x-8">
            <a href="https://domainanda.com/#layanan" class="text-gray-600 hover:text-blue-700 font-medium">Layanan</a>
            <a href="https://domainanda.com/tka" class="text-gray-600 hover:text-blue-700 font-medium">Latihan TKA</a>
            <a href="https://domainanda.com/#keunggulan" class="text-gray-600 hover:text-blue-700 font-medium">Keunggulan</a>
            <a href="https://domainanda.com/#blog" class="text-gray-600 hover:text-blue-700 font-medium">Blog</a>
            <a href="https://domainanda.com/kontak" class="text-gray-600 hover:text-blue-700 font-medium">Kontak</a>
            <?php 
            // TAMBAHKAN BLOK PHP INI
            // Cek apakah admin sedang login (session ini dibuat di process_login.php)
            if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): 
            ?>
                <a href="/admin/dashboard.php" class="font-semibold text-blue-700 hover:text-blue-900">Dashboard</a>
                <a href="/logout.php" class="font-semibold text-red-600 hover:text-red-800">Logout</a>
            
            <?php else: ?>
                <?php endif; ?>
        </div>
        <a href="#" target="_blank" class="hidden md:block cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
            Mulai Belajar
        </a>
        <button id="mobile-menu-button" class="md:hidden">
            <i data-lucide="menu" class="w-6 h-6 text-gray-600"></i>
        </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
        <a href="https://domainanda.com/#layanan" class="block py-2 text-gray-600 hover:text-blue-700">Layanan</a>
        <a href="https://domainanda.com/latihan-tka" class="block py-2 text-gray-600 hover:text-blue-700">Latihan TKA</a>
        <a href="https://domainanda.com/#keunggulan" class="block py-2 text-gray-600 hover:text-blue-700">Keunggulan</a>
        <a href="https://domainanda.com/#blog" class="block py-2 text-gray-600 hover:text-blue-700">Blog</a>
        <a href="https://domainanda.com/kontak" class="block py-2 text-gray-600 hover:text-blue-700">Kontak</a>
        <a href="#/" target="_blank" class="block mt-4 cta-gradient text-white text-center font-semibold px-6 py-2 rounded-lg shadow-md">
            Mulai Belajar
        </a>
    </div>
</header>