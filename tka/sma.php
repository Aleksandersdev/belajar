<?php
// Panggil config (Gunakan path aman __DIR__ untuk naik satu level)
require_once __DIR__ . '/../config.php';

// Atur judul halaman dinamis untuk tag <title> di header
$page_title = 'TKA SMA / SMK / MA';
$show_tka_modal = true;

// --- Data Modal Kustom untuk SMA ---
$modal_nomor_sk = "Nomor 049/H/AN/2025"; // (Ini contoh nomor SK, ganti jika perlu)
$modal_tentang_sk = "Tentang Kerangka Asesmen Tes Kemampuan Akademik Jenjang SMA/MA/Sederajat dan SMK/MAK";
$modal_tanggal_sk = "Tertanggal: 26 Juli 2025"; // (Ini contoh tanggal, ganti jika perlu)

// Muat header (Gunakan path aman __DIR__)
include __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            
            <div class="flex flex-col items-center space-y-3 mb-4" data-aos="fade-up">
                <div class="flex-shrink-0 bg-teal-100 p-3 rounded-xl"> <i data-lucide="zap" class="w-8 h-8 text-teal-600"></i>
                </div>
                <div class="text-center">
                     <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800">TKA SMA / SMK / MA</h1>
                     <p class="text-lg text-slate-600">Pilih mata pelajaran untuk mulai belajar.</p>
                </div>
            </div>

            <nav class="flex items-center justify-center text-sm text-slate-500" data-aos="fade-up">
                <a href="/" class="hover:underline">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <a href="/tka" class="hover:underline">Portal TKA</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <span class="font-medium text-slate-700">TKA SMA / SMK / MA</span>
            </nav>
            
        </div>
    </section>

   <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-8">
    
                <aside class="w-full md:w-1/4 order-2 md:order-1" data-aos="fade-right">
                    <div class="sticky top-28 space-y-4">
                        <h3 class="text-lg font-bold text-slate-800">Navigasi</h3>
                        <a href="/" class="flex items-center justify-center w-full px-4 py-3 rounded-lg text-sm font-semibold transition bg-white border border-slate-300 text-slate-700 hover:bg-slate-50">
                            <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                            Kembali Ke Home
                        </a>
                        <a href="#" class="flex items-center justify-center w-full px-4 py-3 rounded-lg text-sm font-semibold transition bg-green-500 text-white hover:bg-green-600">
                            <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i> 
                            Gabung Saluran WA
                        </a>
                    </div>
                </aside>

                <div class="w-full md:w-3/4 order-1 md:order-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-red-500/20" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-red-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                                    <i data-lucide="calculator" class="w-7 h-7 text-red-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Matematika Wajib</h3>
                                    <p class="text-sm text-slate-500">Latihan soal Aljabar, Trigonometri, Kalkulus dasar, dan Statistika.</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20" data-aos="fade-up" data-aos-delay="150">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                                    <i data-lucide="book" class="w-7 h-7 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Bahasa Indonesia</h3>
                                    <p class="text-sm text-slate-500">Analisis teks bacaan, PUEBI, pemahaman wacana, dan sastra.</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-500/20" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-cyan-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                                    <i data-lucide="languages" class="w-7 h-7 text-cyan-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Bahasa Inggris</h3>
                                    <p class="text-sm text-slate-500">Latih kemampuan grammar, vocabulary, dan reading comprehension.</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/20" data-aos="fade-up" data-aos-delay="250">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-amber-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                                    <i data-lucide="star" class="w-7 h-7 text-amber-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Mapel Pilihan</h3>
                                    <p class="text-sm text-slate-500">Soal Saintek (Fisika, Kimia, Biologi) dan Soshum (Ekonomi, Sejarah, Geo).</p>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</main>

<?php
// Muat footer
include __DIR__ . '/../partials/footer.php';
?>