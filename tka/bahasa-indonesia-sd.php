<?php
// Panggil config (Naik DUA level dari folder /materi/tka/)
require_once __DIR__ . '/../config.php';

// Atur judul halaman dinamis
$page_title = 'TKA Bahasa Indonesia SD/MI';

// Muat header (Naik DUA level)
include __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            
            <div class="flex flex-col items-center space-y-3 mb-4" data-aos="fade-up">
                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-xl"> <i data-lucide="book-marked" class="w-8 h-8 text-blue-600"></i>
                </div>
                <div class="text-center">
                     <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800">Bahasa Indonesia</h1>
                     <p class="text-lg text-slate-600">Latihan Soal TKA SD/MI</p>
                </div>
            </div>

            <nav class="flex items-center justify-center text-sm text-slate-500" data-aos="fade-up">
                <a href="/" class="hover:underline">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <a href="/tka" class="hover:underline">Portal TKA</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <a href="/tka/sd-mi" class="hover:underline">TKA SD/MI</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <span class="font-medium text-slate-700">Bahasa Indonesia</span>
            </nav>
            
        </div>
    </section>

   <section class="py-12 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <p class="text-center text-lg text-slate-600 mb-10" data-aos="fade-up" data-aos-delay="100">
                Silakan pilih paket soal yang ingin Kamu kerjakan di bawah ini.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <a href="../../latihan-soal?id=1" 
                   class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20" 
                   data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="clipboard-check" class="w-7 h-7 text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Mulai Paket 1</h3>
                            <p class="text-sm text-slate-500">Latihan dasar pemahaman teks dan kosa kata.</p>
                        </div>
                    </div>
                </a>
                
                <a href="../../latihan-soal?id=2" 
                   class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20" 
                   data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-purple-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="list-checks" class="w-7 h-7 text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Mulai Paket 2</h3>
                            <p class="text-sm text-slate-500">Soal latihan PUEBI dan struktur kalimat.</p>
                        </div>
                    </div>
                </a>
                
                <a href="../../latihan-soal?id=3" 
                   class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-green-500/20" 
                   data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-green-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="award" class="w-7 h-7 text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Mulai Paket 3</h3>
                            <p class="text-sm text-slate-500">Latihan soal bacaan panjang dan ide pokok.</p>
                        </div>
                    </div>
                </a>

                <a href="../../latihan-soal?id=4" 
                   class="group block bg-white rounded-2xl p-6 shadow-lg border border-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-red-500/20" 
                   data-aos="fade-up" data-aos-delay="250">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-red-100 p-3 rounded-xl transform transition-transform duration-300 group-hover:scale-110">
                            <i data-lucide="timer" class="w-7 h-7 text-red-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">TryOut</h3>
                            <p class="text-sm text-slate-500">Simulasi ujian lengkap 40 soal.</p>
                        </div>
                    </div>
                </a>

                <div class="group block bg-slate-50 opacity-70 cursor-not-allowed rounded-2xl p-6 shadow-sm border border-slate-200" 
                     data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-slate-200 p-3 rounded-xl">
                            <i data-lucide="loader" class="w-7 h-7 text-slate-500"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">Paket 4 (Segera Hadir)</h3>
                            <p class="text-sm text-slate-500">Nantikan paket soal menantang lainnya!</p>
                        </div>
                    </div>
                </div>
                
                 <div class="group block bg-slate-50 opacity-70 cursor-not-allowed rounded-2xl p-6 shadow-sm border border-slate-200" 
                     data-aos="fade-up" data-aos-delay="350">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 bg-slate-200 p-3 rounded-xl">
                            <i data-lucide="loader" class="w-7 h-7 text-slate-500"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">Paket 5 (Segera Hadir)</h3>
                            <p class="text-sm text-slate-500">Nantikan paket soal menantang lainnya!</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
// Muat footer (Naik DUA level)
include __DIR__ . '/../partials/footer.php';
?>