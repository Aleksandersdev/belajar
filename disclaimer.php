<?php
// Panggil config
require_once 'config.php';

// Atur judul halaman dinamis
$page_title = 'Disclaimer';

// Muat header
include 'partials/header.php';

// Ambil email dari config atau definisikan di sini
$email_address = 'info@rangkumanmateri.com'; // Ganti jika perlu
?>

<style>
    /* Style untuk Accordion (Sama seperti Kebijakan Privasi) */
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        padding-left: 1.5rem; /* Indentasi konten */
        padding-right: 1.5rem;
    }
    .accordion-content.open {
        max-height: 1000px; /* Tinggi maksimal saat terbuka */
        padding-top: 1rem;
        padding-bottom: 1.5rem;
    }
    .accordion-button svg.chevron { /* Target spesifik ikon chevron */
        transition: transform 0.3s ease;
    }
    .accordion-button.open svg.chevron {
        transform: rotate(180deg);
    }
</style>

<main>
    <section id="hero-disclaimer" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-slate-50">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up">
                Disclaimer
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-slate-600" data-aos="fade-up" data-aos-delay="100">
                Penting untuk memahami batasan informasi yang disajikan di website ini.
            </p>
            <p class="text-sm text-slate-500 mt-4" data-aos="fade-up" data-aos-delay="150">Terakhir diperbarui: 29 Oktober 2025</p> </div>
    </section>

    <section id="konten-disclaimer" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">

             <div class="mb-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800 text-sm" data-aos="fade-up">
                <strong>Perhatian:</strong> Informasi di halaman ini bersifat umum. Harap sesuaikan dengan kebutuhan spesifik website Anda dan konsultasikan dengan profesional hukum jika diperlukan.
             </div>

            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="alert-triangle" class="w-5 h-5 mr-3 text-orange-600"></i>
                            1. Informasi Bersifat Umum
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Informasi yang disediakan oleh @rangkumanmateri_ (selanjutnya disebut "kami") di https://www.websiteanda.com/ (selanjutnya disebut "Situs") adalah untuk tujuan informasi umum saja. Semua informasi di Situs disediakan dengan itikad baik, namun kami tidak membuat pernyataan atau jaminan apa pun, tersurat maupun tersirat, mengenai keakuratan, kecukupan, validitas, keandalan, ketersediaan, atau kelengkapan informasi apa pun di Situs.</p>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="file-warning" class="w-5 h-5 mr-3 text-orange-600"></i>
                             2. Akurasi dan Kelengkapan
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                        <p>Kami berusaha untuk menjaga informasi tetap mutakhir dan benar, namun kami tidak membuat jaminan tentang kelengkapan, keakuratan, keandalan, kesesuaian, atau ketersediaan sehubungan dengan Situs atau informasi, produk, layanan, atau grafik terkait yang terdapat di Situs untuk tujuan apa pun. Setiap ketergantungan yang Anda tempatkan pada informasi tersebut sepenuhnya merupakan risiko Anda sendiri.</p>
                        <p>Konten dapat berubah tanpa pemberitahuan sebelumnya dan mungkin tidak selalu mencerminkan informasi atau perkembangan terbaru.</p>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="briefcase" class="w-5 h-5 mr-3 text-orange-600"></i>
                             3. Bukan Nasihat Profesional
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                         <p>Informasi yang terkandung di Situs ini bukan merupakan, dan tidak boleh dianggap sebagai, nasihat profesional. Konten seperti [Jelaskan jenis kontenmu, misal: rangkuman materi pelajaran, tips belajar] disajikan hanya untuk tujuan pendidikan dan informasi.</p>
                         <p>Anda tidak boleh mengandalkan informasi di Situs ini sebagai alternatif nasihat dari [Sebutkan profesional yang relevan, misal: guru, konselor pendidikan, ahli hukum, dll.] yang memenuhi syarat. Jika Anda memiliki pertanyaan spesifik tentang masalah apa pun, Anda harus berkonsultasi dengan profesional yang sesuai.</p>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="link" class="w-5 h-5 mr-3 text-blue-600"></i>
                             4. Tautan Eksternal
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Situs ini mungkin berisi (atau Anda mungkin dikirim melalui Situs) tautan ke situs web lain atau konten milik atau berasal dari pihak ketiga atau tautan ke situs web dan fitur dalam spanduk atau iklan lainnya. Tautan eksternal semacam itu tidak diselidiki, dipantau, atau diperiksa keakuratannya, kecukupannya, validitasnya, keandalannya, ketersediaannya, atau kelengkapannya oleh kami.</p>
                        <p>KAMI TIDAK MENJAMIN, MENDUKUNG, MENJAMIN, ATAU BERTANGGUNG JAWAB ATAS KEAKURATAN ATAU KEANDALAN INFORMASI APA PUN YANG DITAWARKAN OLEH SITUS WEB PIHAK KETIGA YANG TERKAIT MELALUI SITUS ATAU FITUR APA PUN YANG TERKAIT DALAM SPANDUK ATAU IKLAN LAINNYA.</p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="dollar-sign" class="w-5 h-5 mr-3 text-green-600"></i>
                             5. Disclaimer Afiliasi (Jika Berlaku)
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Situs ini mungkin berisi tautan ke produk atau layanan afiliasi, yang berarti kami dapat menerima komisi jika Anda mengklik tautan dan melakukan pembelian, tanpa biaya tambahan kepada Anda.</p>
                        <p><em>(Hapus bagian ini jika Anda tidak menggunakan link afiliasi. Jika ya, jelaskan lebih lanjut jenis program afiliasi yang Anda ikuti).</em></p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="shield-off" class="w-5 h-5 mr-3 text-red-600"></i>
                             6. Batasan Tanggung Jawab
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>DALAM KEADAAN APA PUN KAMI TIDAK BERTANGGUNG JAWAB KEPADA ANDA ATAU SIAPA PUN ATAS KEPUTUSAN YANG DIBUAT ATAU TINDAKAN YANG DIAMBIL DENGAN MENGANDALKAN INFORMASI YANG DIBERIKAN DI SITUS ATAU ATAS KERUSAKAN KONSEKUENSIAL, KHUSUS, ATAU SERUPA, BAHKAN JIKA DIBERITAHU TENTANG KEMUNGKINAN KERUSAKAN TERSEBUT.</p>
                        <p>Penggunaan Anda atas Situs dan ketergantungan Anda pada informasi apa pun di Situs sepenuhnya merupakan risiko Anda sendiri.</p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="refresh-cw" class="w-5 h-5 mr-3 text-blue-600"></i>
                             7. Perubahan pada Disclaimer Ini
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Kami berhak untuk mengubah Disclaimer ini kapan saja. Setiap perubahan akan efektif segera setelah diposting di Situs. Penggunaan Situs secara berkelanjutan setelah perubahan tersebut merupakan penerimaan Anda terhadap Disclaimer yang direvisi.</p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="mail" class="w-5 h-5 mr-3 text-blue-600"></i>
                             8. Hubungi Kami
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Jika Anda memiliki pertanyaan mengenai Disclaimer ini, silakan hubungi kami melalui:</p>
                        <ul class="list-disc list-outside ml-5 mt-2 space-y-1">
                            <li>Email: <a href="mailto:<?php echo htmlspecialchars($email_address); ?>" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($email_address); ?></a></li>
                            <li>Instagram: <a href="https://www.instagram.com/rangkumanmateri_/" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">@rangkumanmateri_</a></li>
                        </ul>
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
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const isOpen = content.classList.contains('open');

                // Opsional: Tutup semua accordion lain
                // accordionButtons.forEach(otherButton => { ... });

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