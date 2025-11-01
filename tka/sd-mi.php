<?php
// Panggil config (Gunakan path aman __DIR__ untuk naik satu level)
require_once __DIR__ . '/../config.php';

// Atur judul halaman dinamis untuk tag <title> di header
$page_title = 'TKA SD / MI';
$show_tka_modal = true;

// --- Data Modal Kustom untuk SD ---
$modal_nomor_sk = "Nomor 047/H/AN/2025";
$modal_tentang_sk = "Tentang Kerangka Asesmen Tes Kemampuan Akademik Jenjang SD/MI/Sederajat dan SMP/MTs/Sederajat";
$modal_tanggal_sk = "Tertanggal: 24 Juli 2025";

// Muat header (Gunakan path aman __DIR__)
include __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            
            <div class="flex flex-col items-center space-y-3 mb-4" data-aos="fade-up">
                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-xl"> <i data-lucide="book-marked" class="w-8 h-8 text-blue-600"></i>
                </div>
                <div class="text-center">
                     <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800">TKA SD / MI</h1>
                     <p class="text-lg text-slate-600">Pilih mata pelajaran untuk mulai belajar.</p>
                </div>
            </div>

            <nav class="flex items-center justify-center text-sm text-slate-500" data-aos="fade-up">
                <a href="/" class="hover:underline">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <a href="/tka" class="hover:underline">Portal TKA</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <span class="font-medium text-slate-700">TKA SD / MI</span>
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

                        <a href="/tka/bahasa-indonesia-sd" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                                    <i data-lucide="book" class="w-7 h-7 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Bahasa Indonesia</h3>
                                    <p class="text-sm text-slate-500">Kumpulan soal latihan membaca, kosa kata, dan pemahaman teks.</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="/tka/matematika-sd" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-red-500/20" data-aos="fade-up" data-aos-delay="150">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-red-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                                    <i data-lucide="calculator" class="w-7 h-7 text-red-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Matematika</h3>
                                    <p class="text-sm text-slate-500">Asah kemampuan berhitung, logika, dan pemecahan masalah dasar.</p>
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