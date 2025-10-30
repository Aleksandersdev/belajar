<?php
// Panggil config
require_once 'config.php';

// Atur judul halaman dinamis
$page_title = 'Materi Kelompok Sosial';

// Muat header
include 'partials/header.php';
?>

<style>
    /* Style untuk Accordion (Sama seperti halaman lain) */
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out, padding 0.4s ease-out;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
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
        list-style-type: disc; /* Pakai bullet */
        list-style-position: outside;
        margin-left: 1.25rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        line-height: 1.75;
    }
    .materi-list li::marker {
        color: #a855f7; /* Warna bullet point (ungu) */
    }
    .highlight-sosiologi {
        background-color: #f3e8ff; /* Latar ungu muda */
        color: #581c87; /* Teks ungu tua */
        padding: 0.1rem 0.4rem;
        border-radius: 0.25rem;
        font-weight: 600;
    }
     .definisi-box {
        background-color: #f0f9ff;
        border-left: 4px solid #0284c7;
        padding: 1rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        font-style: italic;
    }
    .penting-box {
         background-color: #fffbeb;
        border-left: 4px solid #f59e0b;
        padding: 1rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        color: #78350f;
    }
</style>

<main>
    <section id="hero-materi-sosiologi" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-gradient-to-br from-purple-50 to-pink-100">
        <div class="container mx-auto px-6 text-center">
            <span class="inline-block bg-purple-100 text-purple-800 text-sm font-semibold px-4 py-1 rounded-full mb-3" data-aos="fade-up">Sosiologi</span>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up" data-aos-delay="100">
                Kelompok Sosial
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-slate-600" data-aos="fade-up" data-aos-delay="200">
                Memahami Hakikat Manusia sebagai Makhluk Sosial dan Dinamika Interaksi dalam Kelompok.
            </p>
        </div>
    </section>

    <section id="konten-materi" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">

            <p class="text-lg text-slate-700 leading-relaxed mb-12" data-aos="fade-up">
                Selamat berjumpa kembali, para pemikir sosial! Hari ini kita akan mengkaji salah satu konsep paling mendasar dalam sosiologi, yaitu **Kelompok Sosial**. Sejak lahir, kita tidak pernah lepas dari kelompok, mulai dari keluarga hingga pertemanan dan organisasi. Mengapa kelompok terbentuk? Apa saja jenisnya? Mari kita telaah bersama.
            </p>

            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button open w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="users" class="w-5 h-5 mr-3 text-purple-600"></i>
                            1. Definisi Kelompok Sosial
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0 rotate-180"></i>
                    </button>
                    <div class="accordion-content open text-slate-700 leading-relaxed">
                        <p>Manusia pada hakikatnya adalah *zoon politicon* (makhluk sosial) yang tidak dapat hidup sendiri. Kebutuhan untuk berinteraksi dan berhubungan dengan sesama inilah yang mendorong terbentuknya kelompok sosial.</p>
                        <div class="definisi-box">
                            <p>Secara sederhana, **Kelompok Sosial** adalah <span class="highlight-sosiologi">himpunan atau kesatuan manusia yang hidup bersama karena saling berhubungan di antara mereka secara timbal balik dan saling memengaruhi</span>.</p>
                            <p class="mt-2 text-sm">— (Definisi umum, bisa ditambahkan definisi menurut ahli seperti Soerjono Soekanto atau Robert K. Merton)</p>
                        </div>
                        <p class="mt-2">Jadi, tidak semua kumpulan orang bisa disebut kelompok sosial. Penonton bioskop atau orang-orang di halte bus, misalnya, umumnya bukan kelompok sosial karena interaksi dan kesadaran bersamanya bersifat sementara dan longgar.</p>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="list-checks" class="w-5 h-5 mr-3 text-pink-600"></i>
                             2. Syarat dan Ciri Kelompok Sosial
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                        <p>Menurut Soerjono Soekanto, suatu himpunan manusia dapat disebut kelompok sosial apabila memenuhi beberapa syarat berikut:</p>
                        <ul class="materi-list">
                            <li>Adanya <span class="highlight-sosiologi">kesadaran</span> sebagai bagian dari kelompok yang bersangkutan. Setiap anggota merasa 'kita'.</li>
                            <li>Adanya <span class="highlight-sosiologi">hubungan timbal balik</span> (interaksi) antar anggota.</li>
                            <li>Adanya suatu <span class="highlight-sosiologi">faktor pengikat</span> yang dimiliki bersama, seperti kepentingan yang sama, tujuan yang sama, ideologi, atau kesamaan garis keturunan.</li>
                            <li>Memiliki <span class="highlight-sosiologi">struktur, kaidah, dan pola perilaku</span> yang sama. Ada aturan (tertulis atau tidak) dan kebiasaan yang diikuti bersama.</li>
                            <li>Bersistem dan berproses. Kelompok mengalami dinamika seiring waktu.</li>
                        </ul>
                         <div class="penting-box">
                           <strong>Ingat:</strong> Kesadaran kolektif dan interaksi yang relatif kontinu adalah kunci utama pembeda kelompok sosial dari sekadar kerumunan.
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="shapes" class="w-5 h-5 mr-3 text-emerald-600"></i>
                             3. Tipe-tipe Kelompok Sosial
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-4">
                        <p>Sosiolog mengklasifikasikan kelompok sosial berdasarkan berbagai kriteria. Beberapa tipe utama yang perlu Ananda ketahui:</p>
                        <div>
                            <h4 class="font-semibold text-slate-800 mb-1">A. Berdasarkan Derajat Interaksi (Charles H. Cooley):</h4>
                             <ul class="materi-list">
                                <li><strong>Kelompok Primer (Primary Group):</strong> Hubungan antaranggota sangat akrab, personal, intim, dan langgeng. Contoh: <span class="highlight-sosiologi">keluarga, sahabat dekat</span>. Kelompok ini sangat penting dalam pembentukan kepribadian.</li>
                                <li><strong>Kelompok Sekunder (Secondary Group):</strong> Hubungan bersifat formal, impersonal, didasarkan pada tujuan atau kepentingan tertentu, dan cenderung temporer. Contoh: <span class="highlight-sosiologi">organisasi profesi, rekan kerja di kantor besar, partai politik</span>.</li>
                             </ul>
                        </div>
                        <div>
                             <h4 class="font-semibold text-slate-800 mb-1">B. Berdasarkan Identifikasi Diri (W.G. Sumner):</h4>
                             <ul class="materi-list">
                                 <li><strong>In-group:</strong> Kelompok sosial di mana individu mengidentifikasikan dirinya sebagai anggota ('kita'). Ada rasa memiliki dan solidaritas.</li>
                                 <li><strong>Out-group:</strong> Kelompok sosial yang oleh individu diartikan sebagai lawan atau kelompok di luar in-groupnya ('mereka'). Seringkali muncul stereotip atau prasangka.</li>
                             </ul>
                        </div>
                        <div>
                             <h4 class="font-semibold text-slate-800 mb-1">C. Berdasarkan Ikatan Batin (Ferdinand Tönnies):</h4>
                             <ul class="materi-list">
                                 <li><strong>Paguyuban (Gemeinschaft):</strong> Kelompok sosial yang anggotanya memiliki ikatan batin yang murni, alami, dan kekal. Hubungan bersifat personal dan intim. Contoh: <span class="highlight-sosiologi">keluarga, kelompok kerabat, rukun tetangga di desa</span>. Tipe: berdasarkan ikatan darah (by blood), tempat (by place), pikiran/ideologi (of mind).</li>
                                 <li><strong>Patembayan (Gesellschaft):</strong> Kelompok sosial yang ikatannya bersifat sementara, formal, impersonal, berdasarkan pada kepentingan rasional (kontrak/perjanjian). Contoh: <span class="highlight-sosiologi">ikatan antara pedagang, organisasi buruh/pengusaha</span>.</li>
                             </ul>
                        </div>
                         <div>
                             <h4 class="font-semibold text-slate-800 mb-1">D. Berdasarkan Status Keanggotaan (Robert K. Merton):</h4>
                             <ul class="materi-list">
                                 <li><strong>Membership Group:</strong> Kelompok di mana individu secara fisik dan administratif menjadi anggota.</li>
                                 <li><strong>Reference Group (Kelompok Acuan):</strong> Kelompok sosial yang menjadi acuan bagi seseorang (bukan anggota) dalam membentuk pribadi dan perilakunya. Bisa positif (ingin meniru) atau negatif (ingin menghindari).</li>
                             </ul>
                        </div>
                         <div>
                             <h4 class="font-semibold text-slate-800 mb-1">E. Berdasarkan Derajat Organisasi:</h4>
                             <ul class="materi-list">
                                  <li><strong>Kelompok Formal:</strong> Memiliki peraturan tegas yang sengaja dibuat, struktur organisasi jelas, status anggota terperinci. Contoh: <span class="highlight-sosiologi">sekolah, perusahaan, negara</span>.</li>
                                  <li><strong>Kelompok Informal:</strong> Terbentuk karena pertemuan berulang tanpa peraturan formal yang ketat, tidak ada struktur baku. Contoh: <span class="highlight-sosiologi">kelompok teman bermain, klik (clique)</span>.</li>
                             </ul>
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="check-square" class="w-5 h-5 mr-3 text-lime-600"></i>
                             4. Fungsi dan Manfaat Kelompok Sosial
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Kelompok sosial memiliki peran yang sangat penting bagi individu dan masyarakat, antara lain:</p>
                         <ul class="materi-list">
                            <li>Memenuhi kebutuhan dasar manusia (kasih sayang, keamanan, pengakuan).</li>
                            <li>Sebagai sarana <span class="highlight-sosiologi">sosialisasi</span> (mempelajari nilai dan norma masyarakat).</li>
                            <li>Membentuk kepribadian individu.</li>
                            <li>Sebagai sarana pemecahan masalah (problem solving).</li>
                            <li>Memberikan status dan peran sosial bagi anggotanya.</li>
                            <li>Menjaga <span class="highlight-sosiologi">keteraturan sosial</span> melalui norma kelompok.</li>
                            <li>Sebagai sarana untuk mencapai tujuan bersama yang sulit dicapai sendirian.</li>
                        </ul>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="graduation-cap" class="w-5 h-5 mr-3 text-gray-600"></i>
                             5. Kesimpulan
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Kelompok sosial adalah inti dari kehidupan bermasyarakat. Memahami definisi, syarat, tipe, dan fungsinya membantu kita menganalisis berbagai fenomena sosial di sekitar kita, mulai dari dinamika keluarga hingga kompleksitas organisasi modern.</p>
                        <p class="mt-2">Teruslah mengamati lingkungan sosial Ananda dan cobalah identifikasi berbagai kelompok sosial yang ada serta bagaimana kelompok-kelompok tersebut memengaruhi individu di dalamnya. Selamat belajar!</p>
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
            // Cek jika accordion harus terbuka di awal
            const content = button.nextElementSibling;
            if (button.classList.contains('open') && content) {
                 content.classList.add('open');
                 // Pastikan ikon juga sesuai
                 const icon = button.querySelector('.chevron');
                 if (icon) icon.classList.add('rotate-180');
            }

            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                if (!content) return;

                const isOpen = content.classList.contains('open');
                const icon = button.querySelector('.chevron');

                // Tutup semua accordion lain (opsional)
                accordionButtons.forEach(otherButton => {
                     const otherContent = otherButton.nextElementSibling;
                     const otherIcon = otherButton.querySelector('.chevron');
                     if (otherContent !== content && otherContent && otherContent.classList.contains('open')) {
                         otherContent.classList.remove('open');
                         otherButton.classList.remove('open');
                         if (otherIcon) otherIcon.classList.remove('rotate-180');
                     }
                 });

                // Buka/tutup yang ini
                content.classList.toggle('open');
                button.classList.toggle('open');
                if (icon) icon.classList.toggle('rotate-180');
            });
        });

        // Inisialisasi ikon Lucide
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>