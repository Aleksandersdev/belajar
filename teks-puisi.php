<?php
// Panggil config
require_once 'config.php';

// Atur judul halaman dinamis
$page_title = 'Materi Teks Puisi';

// Muat header
include 'partials/header.php';

// (Opsional) Ambil email dari config atau definisikan di sini
// $email_address = 'info@rangkumanmateri.com';
?>

<style>
    /* Style untuk Accordion (Sama seperti halaman lain) */
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out, padding 0.4s ease-out;
        padding-left: 1.5rem; /* Indentasi konten */
        padding-right: 1.5rem;
        background-color: #f8fafc; /* Latar sedikit beda untuk konten */
        border-top: 1px solid #e2e8f0; /* Garis pemisah tipis */
    }
    .accordion-content.open {
        max-height: 1500px; /* Tinggi maksimal besar */
        padding-top: 1rem;
        padding-bottom: 1.5rem;
    }
    .accordion-button svg.chevron {
        transition: transform 0.3s ease;
    }
    .accordion-button.open svg.chevron {
        transform: rotate(180deg);
    }
    /* Styling tambahan untuk konten materi */
    .materi-list {
        list-style-type: disc;
        list-style-position: outside;
        margin-left: 1.25rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        line-height: 1.75;
    }
    .materi-list li::marker {
        color: #3b82f6; /* Warna bullet point */
    }
    .highlight {
        background-color: #dbeafe; /* Latar biru muda */
        color: #1e40af; /* Teks biru tua */
        padding: 0.1rem 0.4rem;
        border-radius: 0.25rem;
        font-weight: 600;
    }
</style>

<main>
    <section id="hero-materi" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="container mx-auto px-6 text-center">
            <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-1 rounded-full mb-3" data-aos="fade-up">Bahasa Indonesia</span>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up" data-aos-delay="100">
                Memahami Teks Puisi
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-slate-600" data-aos="fade-up" data-aos-delay="200">
                Menyelami keindahan bahasa, struktur, dan makna dalam karya sastra puisi.
            </p>
        </div>
    </section>

    <section id="konten-materi" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">

            <p class="text-lg text-slate-700 leading-relaxed mb-12" data-aos="fade-up">
                Selamat datang, Ananda sekalian! Pada kesempatan ini, kita akan bersama-sama menjelajahi dunia Teks Puisi. Puisi bukan sekadar rangkaian kata indah, tetapi sebuah karya seni yang memiliki struktur, unsur, dan makna mendalam. Mari kita bedah bersama melalui penjelasan berikut. Klik setiap bagian untuk membukanya.
            </p>

            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button open w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="book-open" class="w-5 h-5 mr-3 text-purple-600"></i>
                            1. Apa Itu Teks Puisi?
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0 rotate-180"></i>
                    </button>
                    <div class="accordion-content open text-slate-700 leading-relaxed">
                        <p>Puisi adalah ragam sastra yang bahasanya terikat oleh <span class="highlight">irama, matra, rima, serta penyusunan larik dan bait</span>. Puisi mengungkapkan pikiran dan perasaan penyair secara imajinatif dan disusun dengan memfokuskan semua kekuatan bahasa pada struktur fisik dan struktur batinnya.</p>
                        <p class="mt-2">Sederhananya, puisi adalah cara penyair 'berbicara' melalui bahasa yang dipadatkan, penuh makna, dan seringkali menggunakan permainan bunyi untuk menciptakan keindahan dan kesan mendalam.</p>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="layers" class="w-5 h-5 mr-3 text-teal-600"></i>
                             2. Struktur Teks Puisi
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-4">
                        <p>Secara umum, struktur puisi dibagi menjadi dua bagian utama:</p>
                        <div>
                            <h4 class="font-semibold text-slate-800 mb-1">A. Struktur Fisik (Struktur Lahir)</h4>
                            <p class="text-sm text-slate-500 mb-2">Aspek kasat mata atau bentuk visual puisi.</p>
                            <ul class="materi-list">
                                <li><strong>Tipografi (Perwajahan):</strong> Bentuk puisi secara visual, seperti penataan baris, batas tepi, hingga penggunaan huruf kapital.</li>
                                <li><strong>Diksi:</strong> Pemilihan kata yang cermat oleh penyair untuk mendapatkan efek tertentu (akan dibahas lebih lanjut di Unsur Puisi).</li>
                                <li><strong>Imaji (Citraan):</strong> Kata atau susunan kata yang dapat mengungkapkan pengalaman indrawi (penglihatan, pendengaran, perabaan).</li>
                                <li><strong>Kata Konkret:</strong> Kata yang dapat ditangkap oleh indra yang memungkinkan munculnya imaji.</li>
                                <li><strong>Gaya Bahasa (Majas):</strong> Penggunaan bahasa yang menghidupkan atau memberikan efek konotatif (akan dibahas lebih lanjut).</li>
                                <li><strong>Rima/Irama:</strong> Persamaan bunyi pada puisi, baik di awal, tengah, maupun akhir baris puisi. Irama (ritme) adalah naik turunnya nada secara teratur.</li>
                            </ul>
                        </div>
                         <div>
                            <h4 class="font-semibold text-slate-800 mb-1">B. Struktur Batin (Struktur Hakikat)</h4>
                            <p class="text-sm text-slate-500 mb-2">Aspek makna yang terkandung dalam puisi.</p>
                            <ul class="materi-list">
                                <li><strong>Tema:</strong> Gagasan pokok atau makna utama yang ingin disampaikan penyair.</li>
                                <li><strong>Rasa (Feeling):</strong> Sikap penyair terhadap pokok permasalahan dalam puisinya (misalnya: sedih, gembira, simpati, protes).</li>
                                <li><strong>Nada (Tone):</strong> Sikap penyair terhadap pembacanya (misalnya: menggurui, menasihati, merayu, mengejek).</li>
                                <li><strong>Amanat (Pesan):</strong> Maksud atau pesan yang ingin disampaikan penyair kepada pembaca.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="atom" class="w-5 h-5 mr-3 text-rose-600"></i>
                             3. Unsur-unsur Kebahasaan Puisi
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-4">
                        <p>Untuk memahami puisi lebih dalam, mari kita cermati unsur-unsur kebahasaan yang sering digunakan:</p>
                        <ul class="materi-list">
                            <li><strong>Diksi (Pemilihan Kata):</strong> Penyair memilih kata dengan sangat hati-hati, mempertimbangkan makna <span class="highlight">denotatif</span> (makna lugas/sebenarnya) dan <span class="highlight">konotatif</span> (makna kiasan/tambahan).</li>
                            <li><strong>Imaji (Citraan):</strong> Penggunaan kata-kata yang merangsang panca indra pembaca.
                                <ul class="materi-list !ml-4">
                                    <li>Citraan Penglihatan (Visual): Seolah-olah kita melihat objeknya.</li>
                                    <li>Citraan Pendengaran (Auditif): Seolah-olah kita mendengar suaranya.</li>
                                    <li>Citraan Perabaan (Taktil): Seolah-olah kita merasakan permukaannya.</li>
                                    <li>Citraan Penciuman (Olfaktif) & Pengecapan (Gustatif) juga mungkin digunakan.</li>
                                </ul>
                            </li>
                            <li><strong>Majas (Gaya Bahasa):</strong> Bahasa kiasan yang digunakan untuk menciptakan kesan tertentu dan memperindah puisi. Beberapa majas umum:
                                 <ul class="materi-list !ml-4">
                                    <li>Metafora: Perbandingan langsung tanpa kata pembanding (contoh: engkau <span class="highlight">belahan jiwa</span>ku).</li>
                                    <li>Simile: Perbandingan menggunakan kata pembanding (seperti, bagai, laksana) (contoh: wajahnya <span class="highlight">bagai bulan purnama</span>).</li>
                                    <li>Personifikasi: Memberikan sifat manusia pada benda mati (contoh: <span class="highlight">angin berbisik</span> lembut).</li>
                                    <li>Hiperbola: Melebih-lebihkan sesuatu (contoh: teriakannya <span class="highlight">mengguncang dunia</span>).</li>
                                    <li>Ironi: Sindiran halus (makna sebaliknya).</li>
                                 </ul>
                             </li>
                            <li><strong>Rima dan Ritma:</strong> Pengulangan bunyi (rima) dan alunan naik-turunnya suara (ritma) yang menciptakan musikalitas dalam puisi.</li>
                        </ul>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="library" class="w-5 h-5 mr-3 text-amber-600"></i>
                             4. Jenis-Jenis Puisi
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Berdasarkan bentuk dan isinya, puisi dapat diklasifikasikan menjadi beberapa jenis, antara lain:</p>
                         <ul class="materi-list">
                            <li><strong>Puisi Naratif:</strong> Puisi yang bercerita atau mengisahkan suatu peristiwa (contoh: Balada, Epos).</li>
                            <li><strong>Puisi Lirik:</strong> Puisi yang mengungkapkan perasaan atau pikiran pribadi penyair (contoh: Elegi, Serenada, Ode).</li>
                            <li><strong>Puisi Deskriptif:</strong> Puisi yang menggambarkan suatu objek atau keadaan.</li>
                             <li><strong>Puisi Lama:</strong> Terikat aturan bait, baris, rima (contoh: Pantun, Syair, Gurindam, Mantra).</li>
                             <li><strong>Puisi Baru:</strong> Lebih bebas bentuknya, tidak terlalu terikat aturan (contoh: Puisi bebas, Soneta modern).</li>
                        </ul>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="scan-eye" class="w-5 h-5 mr-3 text-indigo-600"></i>
                             5. Mengapresiasi Puisi
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Mengapresiasi puisi berarti memahami, menghargai, dan menikmati keindahan serta makna yang terkandung di dalamnya. Beberapa cara untuk mengapresiasi puisi:</p>
                        <ul class="materi-list">
                            <li>Membaca puisi berulang kali.</li>
                            <li>Memperhatikan diksi, imaji, dan majas yang digunakan.</li>
                            <li>Mencoba memahami tema, rasa, nada, dan amanatnya.</li>
                            <li>Mendeklamasikan atau membacakan puisi dengan penghayatan.</li>
                            <li>Menulis parafrase (mengubah puisi menjadi prosa) untuk memahami maknanya.</li>
                            <li>Mencoba menulis puisi sendiri!</li>
                        </ul>
                         <p class="mt-4">Semoga penjelasan ini membantu Ananda dalam memahami Teks Puisi. Teruslah membaca dan berlatih!</p>
                    </div>
                </div>

            </div> </div>
    </section>
</main>

<?php
// Muat footer
include 'partials/footer.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const accordionButtons = document.querySelectorAll('.accordion-button');

        accordionButtons.forEach(button => {
            // Cek apakah accordion harus terbuka di awal
            const content = button.nextElementSibling;
            if (button.classList.contains('open') && content) {
                 content.classList.add('open');
            }

            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                if (!content) return; // Keluar jika tidak ada konten setelah tombol

                const isOpen = content.classList.contains('open');

                // Opsional: Tutup semua accordion lain
                accordionButtons.forEach(otherButton => {
                     const otherContent = otherButton.nextElementSibling;
                     if (otherContent !== content && otherContent && otherContent.classList.contains('open')) {
                         otherContent.classList.remove('open');
                         otherButton.classList.remove('open');
                     }
                 });

                // Buka/tutup yang ini
                content.classList.toggle('open');
                button.classList.toggle('open');
            });
        });

        // Inisialisasi ikon Lucide
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>