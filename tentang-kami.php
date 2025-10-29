<?php
// Panggil config (database, session, dll.)
require_once 'config.php';

// Atur judul halaman dinamis untuk header
$page_title = 'Tentang Kami';

// Muat header
include 'partials/header.php';
?>

<style>
    /* Tambahkan style spesifik untuk halaman ini jika perlu */
    /* Style accordion dari referensi */
    .philosophy-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .philosophy-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .philosophy-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-out, padding 0.5s ease-out;
        padding-left: 1.5rem; /* Tambah padding kiri untuk konten */
        padding-right: 1.5rem;
    }
    .philosophy-content.open {
        max-height: 500px; /* Sesuaikan jika perlu */
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
</style>

<main>
    <section id="hero" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-slate-50">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up">
                Bukan Sekadar Rangkuman Materi,
            </h1>
            <h2 class="text-3xl md:text-5xl font-semibold text-blue-700 mb-8" data-aos="fade-up" data-aos-delay="100">
                Kami Adalah Mitra Belajar Anda
            </h2>
            <p class="max-w-3xl mx-auto text-lg text-slate-600 mb-12" data-aos="fade-up" data-aos-delay="200">
                Di @rangkumanmateri_, kami hadir sebagai platform di mana pemahaman materi dan persiapan ujian tidak hanya diasah, tetapi juga dibuat mudah diakses.
            </p>
            <a href="https://www.instagram.com/rangkumanmateri_/" target="_blank" rel="noopener noreferrer" class="cta-gradient text-white font-bold py-3 px-8 rounded-full inline-block text-lg shadow-lg hover:scale-105 transform transition" data-aos="fade-up" data-aos-delay="300">
                Ikuti Kami di Instagram
            </a>
        </div>
    </section>

    <section id="cerita" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-slate-800">Cerita Kami</h2>
                <p class="text-lg text-slate-500 mt-2">Menyediakan Akses Mudah ke Pengetahuan</p>
                <div class="w-24 h-1 bg-blue-700 mx-auto mt-4"></div>
            </div>
            <div class="max-w-4xl mx-auto text-lg text-slate-700 leading-relaxed text-justify" data-aos="fade-up">
                <p class="mb-6">
                    @rangkumanmateri_ lahir dari pengamatan sederhana: banyak pelajar kesulitan menemukan rangkuman materi yang padat, jelas, dan mudah dipahami di satu tempat. Informasi sering tersebar, sulit diakses, atau kurang terstruktur. Kami melihat kebutuhan akan sebuah platform yang menyajikan inti sari pelajaran dengan cara yang efisien.
                </p>
                <p>
                    Oleh karena itu, kami membangun @rangkumanmateri_ sebagai solusi. Sebuah sumber daya terpusat yang tidak hanya menyediakan rangkuman, tetapi juga latihan soal dan tips belajar untuk membantu siswa mencapai potensi akademis terbaik mereka. Misi kami adalah membuat belajar menjadi lebih efektif dan mengurangi stres dalam persiapan ujian.
                </p>
            </div>
        </div>
    </section>

    <section id="filosofi" class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-slate-800">Filosofi Kami</h2>
                <p class="text-lg text-slate-500 mt-2">Apa yang Membuat Kami Berbeda? Klik setiap pilar untuk detailnya.</p>
                 <div class="w-24 h-1 bg-blue-700 mx-auto mt-4"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto" data-aos="fade-up">

                <div class="philosophy-card-container">
                    <div class="philosophy-card cursor-pointer bg-white p-6 rounded-lg shadow-sm border border-slate-200" data-target="content-1">
                        <h3 class="text-xl font-bold mb-2 text-slate-800">Ringkas & Tepat Sasaran</h3>
                        <p class="text-sm text-slate-500">Fokus pada inti materi yang paling penting.</p>
                    </div>
                    <div id="content-1" class="philosophy-content text-slate-700 bg-white rounded-b-lg border border-t-0 border-slate-200">
                         Kami menyaring informasi penting dan menyajikannya dalam format yang mudah dicerna, menghemat waktu belajar Anda dan memastikan pemahaman konsep kunci.
                    </div>
                </div>

                <div class="philosophy-card-container">
                    <div class="philosophy-card cursor-pointer bg-white p-6 rounded-lg shadow-sm border border-slate-200" data-target="content-2">
                        <h3 class="text-xl font-bold mb-2 text-slate-800">Aksesibilitas adalah Kunci</h3>
                        <p class="text-sm text-slate-500">Belajar kapan saja, di mana saja.</p>
                    </div>
                    <div id="content-2" class="philosophy-content text-slate-700 bg-white rounded-b-lg border border-t-0 border-slate-200">
                         Platform kami dirancang agar mudah diakses dari berbagai perangkat, memungkinkan Anda belajar sesuai kecepatan dan kenyamanan Anda sendiri.
                    </div>
                </div>

                <div class="philosophy-card-container">
                    <div class="philosophy-card cursor-pointer bg-white p-6 rounded-lg shadow-sm border border-slate-200" data-target="content-3">
                        <h3 class="text-xl font-bold mb-2 text-slate-800">Latihan Terstruktur</h3>
                        <p class="text-sm text-slate-500">Menguji pemahaman dengan soal relevan.</p>
                    </div>
                     <div id="content-3" class="philosophy-content text-slate-700 bg-white rounded-b-lg border border-t-0 border-slate-200">
                        Selain rangkuman, kami menyediakan latihan soal yang dirancang untuk memperkuat pemahaman dan mempersiapkan Anda menghadapi ujian dengan lebih percaya diri.
                    </div>
                </div>

                <div class="philosophy-card-container">
                     <div class="philosophy-card cursor-pointer bg-white p-6 rounded-lg shadow-sm border border-slate-200" data-target="content-4">
                        <h3 class="text-xl font-bold mb-2 text-slate-800">Komunitas Belajar</h3>
                        <p class="text-sm text-slate-500">Berkembang bersama melalui interaksi.</p>
                    </div>
                    <div id="content-4" class="philosophy-content text-slate-700 bg-white rounded-b-lg border border-t-0 border-slate-200">
                        Melalui platform seperti Instagram, kami membangun komunitas di mana siswa dapat saling berbagi tips, bertanya, dan memotivasi satu sama lain.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="visi-misi" class="py-20 bg-white">
        <div class="container mx-auto px-6">
             <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-slate-800">Visi & Misi Kami</h2>
                <p class="text-lg text-slate-500 mt-2">Tujuan dan Komitmen Kami untuk Anda</p>
                <div class="w-24 h-1 bg-blue-700 mx-auto mt-4"></div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap gap-10 max-w-6xl mx-auto" data-aos="fade-up">
                <div class="w-full md:w-1/3">
                    <div class="bg-slate-50 p-8 rounded-lg h-full border border-slate-200">
                        <h3 class="text-2xl font-bold text-blue-700 mb-4">Visi</h3>
                        <p class="text-slate-700 leading-relaxed">
                            Menjadi platform rangkuman materi dan persiapan belajar terdepan yang paling mudah diakses dan efektif bagi pelajar di Indonesia.
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-2/3">
                     <h3 class="text-2xl font-bold text-slate-800 mb-4">Misi</h3>
                     <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="text-xl text-blue-700 mr-4 font-bold">1.</span>
                            <span class="text-slate-700"><strong>Menyajikan Konten Berkualitas:</strong> Menyediakan rangkuman materi yang akurat, ringkas, dan relevan dengan kurikulum terkini.</span>
                        </li>
                         <li class="flex items-start">
                            <span class="text-xl text-blue-700 mr-4 font-bold">2.</span>
                            <span class="text-slate-700"><strong>Memudahkan Akses Belajar:</strong> Memastikan platform mudah digunakan dan diakses oleh semua pelajar, kapan pun dan di mana pun.</span>
                        </li>
                         <li class="flex items-start">
                            <span class="text-xl text-blue-700 mr-4 font-bold">3.</span>
                            <span class="text-slate-700"><strong>Menyediakan Latihan Efektif:</strong> Menawarkan soal latihan dan try out yang membantu mengukur dan meningkatkan pemahaman.</span>
                        </li>
                         <li class="flex items-start">
                            <span class="text-xl text-blue-700 mr-4 font-bold">4.</span>
                            <span class="text-slate-700"><strong>Membangun Komunitas Supportif:</strong> Memfasilitasi interaksi antar pelajar untuk saling mendukung dalam proses belajar.</span>
                        </li>
                     </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-20 bg-slate-50">
         <div class="container mx-auto px-6 text-center" data-aos="fade-up">
             <h2 class="text-4xl font-bold text-slate-800 mb-4">Siap Belajar Lebih Efektif?</h2>
             <p class="max-w-2xl mx-auto text-lg text-slate-600 mb-8">
                 Temukan rangkuman materi, latihan soal, dan tips belajar terbaik di platform kami. Mulai perjalanan belajarmu sekarang!
             </p>
             <a href="/" class="cta-gradient text-white font-bold py-4 px-10 rounded-full inline-block text-lg shadow-lg hover:scale-105 transform transition">
                Mulai Belajar
            </a>
         </div>
    </section>
</main>

<?php
// Muat footer
include 'partials/footer.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const philosophyCards = document.querySelectorAll('.philosophy-card');
        philosophyCards.forEach(card => {
            card.addEventListener('click', () => {
                const targetId = card.getAttribute('data-target');
                const content = document.getElementById(targetId);

                document.querySelectorAll('.philosophy-content.open').forEach(openContent => {
                    if (openContent !== content) {
                        openContent.classList.remove('open');
                    }
                });
                content.classList.toggle('open');
            });
        });

        // Hapus script navigasi scroll jika sudah ada di footer.php
    });
</script>