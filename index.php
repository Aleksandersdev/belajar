<?php
// Panggil config, set meta tag dinamis untuk SEO
require_once 'config.php';
$site_name = "@rangkumanmateri_";
$page_title = 'Beranda';
$meta_title = 'Raih Kampus Idamanmu Bersama ' . $site_name;
$meta_description = "Latihan UTBK SNBT mirip aslinya: CBT, penilaian IRT, materi dan pembahasan lengkap, ranking jurusan, dan rasionalisasi. Akses di mana saja.";
$meta_keywords = "rangkuman materi, latihan soal, bimbel, try out, UTBK, SNBT, CBT, IRT";

// Muat header
include 'partials/header.php';
?>

<style>
    /* ... (Semua style Anda sebelumnya seperti .hero-cta-gradient, .hero-btn-outline, .service-card, dll. tetap di sini) ... */
    .hero-cta-gradient {
        background: linear-gradient(to right, #581c87, #3b82f6);
        box-shadow: 0 4px 15px -5px rgba(99, 102, 241, 0.6);
        transition: all 0.3s ease;
    }
    .hero-cta-gradient:hover {
        background: linear-gradient(to right, #4c1a73, #2563eb);
        box-shadow: 0 10px 20px -10px rgba(99, 102, 241, 0.8);
        transform: translateY(-2px);
    }
    .hero-btn-outline {
        background-color: transparent;
        border: 2px solid #3b82f6;
        color: #3b82f6;
        transition: all 0.3s ease;
    }
    .hero-btn-outline:hover {
        background-color: #eff6ff;
        color: #2563eb;
    }
    .service-card { transition: all 0.3s ease; }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .glow-card:hover {
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.3); 
    }
    .accordion-content { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
    .accordion-header .accordion-icon { transition: transform 0.3s ease; }
    .accordion-header.open .accordion-icon { transform: rotate(180deg); }
</style>

<main>
    <section id="hero" class="bg-white pt-24 pb-16 md:pt-32 md:pb-32 relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                
                <div class="md:w-1/2 text-center md:text-left" data-aos="fade-right">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900 mb-6">
                        Rangkuman <span class="text-blue-600"> Materi</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 max-w-xl mx-auto md:mx-0 mb-10">
                        Cari Rangkuman Materi dan Latihan Soal Lengkap, untuk belajar persiapan Ujian Sekolah, TKA, dan UTBK.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="/materi" class="hero-cta-gradient text-white font-bold px-8 py-4 rounded-lg shadow-lg hover:scale-105 transform transition inline-flex items-center justify-center">
                            <i data-lucide="play" class="w-5 h-5 mr-2"></i>
                            Mulai Belajar
                        </a>
                        <a href="/" class="hero-btn-outline font-bold px-8 py-4 rounded-lg shadow-sm hover:scale-105 transform transition inline-flex items-center justify-center">
                            <i data-lucide="arrow-right" class="w-5 h-5 mr-2"></i>
                            Sudah Punya Akun
                        </a>
                    </div>
                </div>
                
                <div class="md:w-1/2 flex justify-center md:justify-end" data-aos="fade-left" data-aos-delay="200">
                    <img src="https://rangkumanmateri.com/uploads/rangkuman.png" 
                         alt="Rangkumanmateri.com - Rangkuman Materi dan Latihan Soal Lengkap" 
                         class="w-full max-w-lg rounded-lg"> 
                         </div>
            </div>
        </div>
    </section>

    <section id="hero-features" class="relative z-10 -mt-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 bg-white p-6 rounded-lg shadow-xl border border-gray-100" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center p-4">
                    <div class="flex-shrink-0 bg-blue-100 text-blue-600 p-3 rounded-full mr-4">
                        <i data-lucide="monitor-play" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Tryout Berbasis CBT</h4>
                        <p class="text-sm text-gray-600">Sistem ujian mirip asli.</p>
                    </div>
                </div>
                <div class="flex items-center p-4">
                    <div class="flex-shrink-0 bg-green-100 text-green-600 p-3 rounded-full mr-4">
                        <i data-lucide="file-check-2" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Latihan Soal + Bahas</h4>
                        <p class="text-sm text-gray-600">Ribuan soal terverifikasi.</p>
                    </div>
                </div>
                <div class="flex items-center p-4">
                    <div class="flex-shrink-0 bg-purple-100 text-purple-600 p-3 rounded-full mr-4">
                        <i data-lucide="siren" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Kisi-Kisi Terbaru</h4>
                        <p class="text-sm text-gray-600">Selalu update sesuai standar.</p>
                    </div>
                </div>
                <div class="flex items-center p-4">
                    <div class="flex-shrink-0 bg-orange-100 text-orange-600 p-3 rounded-full mr-4">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Oleh Tim Ahli</h4>
                        <p class="text-sm text-gray-600">Disusun oleh pembuat soal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section id="layanan" class="py-20 bg-white"> <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up">Jelajahi Semua Fitur Kami</h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Semua yang Anda butuhkan untuk sukses ada di sini.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <a href="/tryout" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="clipboard-check" class="w-7 h-7 text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Try Out Bersama</h3>
                            <p class="text-sm text-slate-500">Banyak latihan soal UTBK dengan Tryout!</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-purple-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="target" class="w-7 h-7 text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Ukur Peluang</h3>
                            <p class="text-sm text-slate-500">Lolos SNBP dengan strategi pilih prodi dan PTN impian!</p>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-teal-500/20" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-teal-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="school" class="w-7 h-7 text-teal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Bimbel</h3>
                            <p class="text-sm text-slate-500">Persiapkan UTBK 2026 bareng Bimbel Masuk PTN!</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-rose-500/20" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-rose-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="building-2" class="w-7 h-7 text-rose-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Update Kampus</h3>
                            <p class="text-sm text-slate-500">Cek berita kampus impian kamu yang up to date!</p>
                        </div>
                    </div>
                </a>

                <a href="/materi" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/20" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-amber-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="book-copy" class="w-7 h-7 text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Materi Pelajaran</h3>
                            <p class="text-sm text-slate-500">Ringkasan Materi Mudah Dimengerti.</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-sky-500/20" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-sky-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="flame" class="w-7 h-7 text-sky-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Tips dan Motivasi</h3>
                            <p class="text-sm text-slate-500">Yuk up booster dan semangat kamu disini ya!</p>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-lime-500/20" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-lime-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="lightbulb" class="w-7 h-7 text-lime-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Tes Minat Bakat</h3>
                            <p class="text-sm text-slate-500">Kenali potensi diri melalui Tes Minat dan Bakat.</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/20" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="messages-square" class="w-7 h-7 text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Konseling Peminatan</h3>
                            <p class="text-sm text-slate-500">Bingung pilih PTN dan Prodi? Yuk konsultasikan!</p>
                        </div>
                    </div>
                </a>

                <a href="/materi" class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-500/20" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-orange-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="newspaper" class="w-7 h-7 text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Artikel</h3>
                            <p class="text-sm text-slate-500">Artikel berita seputar info perkuliahan disini!</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>
    
    <section id="faq" class="py-20 bg-white"> <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Tanya Jawab</h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Temukan jawaban atas pertanyaan yang paling sering diajukan.</p>
            </div>
            
            <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-up" data-aos-delay="200">

                <div class="border border-slate-200 rounded-lg bg-gray-50 overflow-hidden">
                    <button class="accordion-header w-full flex justify-between items-center p-5 font-semibold text-left text-slate-800">
                        <span>Apakah semua materi di sini gratis?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform accordion-icon flex-shrink-0 text-slate-500"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="p-5 pt-0 text-gray-600 prose prose-sm max-w-none">
                            <p>Sebagian besar materi kami sediakan secara gratis. Namun, untuk beberapa materi atau latihan soal premium, kami mungkin menerapkan kode akses. Hubungi kami di Instagram untuk info lebih lanjut!</p>
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg bg-gray-50 overflow-hidden">
                    <button class="accordion-header w-full flex justify-between items-center p-5 font-semibold text-left text-slate-800">
                        <span>Bagaimana cara mendapatkan kode akses?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform accordion-icon flex-shrink-0 text-slate-500"></i>
                    </button>
                    <div class="accordion-content">
                       <div class="p-5 pt-0 text-gray-600 prose prose-sm max-w-none">
                            <p>Anda bisa mendapatkan kode akses dengan mengikuti program bimbingan kami atau melalui promosi khusus di media sosial kami. Silakan hubungi <a href="https://www.instagram.com/rangkumanmateri_/" target="_blank" class="text-blue-600 hover:underline">@rangkumanmateri_</a> untuk detailnya.</p>
                        </div>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg bg-gray-50 overflow-hidden">
                    <button class="accordion-header w-full flex justify-between items-center p-5 font-semibold text-left text-slate-800">
                        <span>Apakah saya bisa request materi pelajaran lain?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform accordion-icon flex-shrink-0 text-slate-500"></i>
                    </button>
                    <div class="accordion-content">
                       <div class="p-5 pt-0 text-gray-600 prose prose-sm max-w-none">
                            <p>Tentu! Kami selalu terbuka untuk masukan. Silakan sampaikan request Anda melalui DM Instagram atau halaman Kontak kami. Tim kami akan meninjau dan menambahkannya ke daftar prioritas kami.</p>
                        </div>
                    </div>
                </div>
                
                 <div class="border border-slate-200 rounded-lg bg-gray-50 overflow-hidden">
                    <button class="accordion-header w-full flex justify-between items-center p-5 font-semibold text-left text-slate-800">
                        <span>Apakah websitenya responsif di HP?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform accordion-icon flex-shrink-0 text-slate-400"></i>
                    </button>
                    <div class="accordion-content">
                       <div class="p-5 pt-0 text-gray-600 prose max-w-none">
                            <p>Ya, website ini dirancang untuk responsif penuh. Tata letak, sidebar, dan kuis interaktif akan menyesuaikan secara otomatis agar tetap nyaman digunakan baik di perangkat desktop maupun di ponsel Anda.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
// Muat footer
include 'partials/footer.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        
        // --- 1. Lottie Animation DIHAPUS ---
        // const lottieContainer = document.getElementById('lottie-hero-animation');
        // ... (seluruh blok lottie dihapus) ...
        
        // --- 2. Animasi Counter (TETAP ADA) ---
        const counters = document.querySelectorAll('.counter');
        if (counters.length > 0) {
            // ... (kode counter Anda) ...
        }

        // --- 3. Logika FAQ Accordion (TETAP ADA) ---
        const accordionHeaders = document.querySelectorAll('.accordion-header');
        accordionHeaders.forEach(header => {
            // ... (kode accordion Anda) ...
        });
        
        // --- 4. Pastikan Lucide di-render ---
        // (Ini seharusnya sudah ada di footer.php Anda)
        // if (typeof lucide !== 'undefined') {
        //     lucide.createIcons();
        // }
    });
</script>