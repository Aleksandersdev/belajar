<?php
// Panggil config
require_once 'config.php';

// Atur judul halaman dinamis
$page_title = 'Kebijakan Privasi';

// Muat header
include 'partials/header.php';

// Ambil email dari config atau definisikan di sini
$email_address = 'info@rangkumanmateri.com'; // Ganti jika perlu
?>

<style>
    /* Style untuk Accordion */
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
    .accordion-button svg {
        transition: transform 0.3s ease;
    }
    .accordion-button.open svg {
        transform: rotate(180deg);
    }
</style>

<main>
    <section id="hero-kebijakan" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-slate-50">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up">
                Kebijakan Privasi
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-slate-600" data-aos="fade-up" data-aos-delay="100">
                Privasi Anda penting bagi kami. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.
            </p>
            <p class="text-sm text-slate-500 mt-4" data-aos="fade-up" data-aos-delay="150">Terakhir diperbarui: 29 Oktober 2025</p> </div>
    </section>

    <section id="konten-kebijakan" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">

            <div class="space-y-4" data-aos="fade-up">

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="info" class="w-5 h-5 mr-3 text-blue-600"></i>
                            1. Pendahuluan
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Selamat datang di Kebijakan Privasi @rangkumanmateri_. Kami menghargai privasi Anda dan berkomitmen melindungi informasi pribadi Anda. Kebijakan ini menjelaskan jenis informasi yang kami kumpulkan, bagaimana kami menggunakannya, dan langkah-langkah perlindungan saat Anda menggunakan website kami https://www.websiteanda.com/.</p>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="database" class="w-5 h-5 mr-3 text-blue-600"></i>
                             2. Informasi yang Kami Kumpulkan
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                        <p>Kami dapat mengumpulkan jenis informasi berikut:</p>
                        <ul class="list-disc list-outside ml-5 space-y-2">
                            <li><strong>Informasi yang Anda Berikan Secara Langsung:</strong> Saat mendaftar (jika ada), mengisi formulir kontak, dll. Contoh: nama, email.</li>
                            <li><strong>Informasi Penggunaan:</strong> Alamat IP, jenis browser, halaman dikunjungi, waktu kunjungan, dll.</li>
                            <li><strong>Cookie dan Teknologi Pelacakan Serupa:</strong> Untuk info aktivitas penjelajahan. Kontrol via browser Anda.</li>
                        </ul>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="settings-2" class="w-5 h-5 mr-3 text-blue-600"></i>
                             3. Bagaimana Kami Menggunakan Informasi Anda
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                         <p>Kami menggunakan informasi untuk:</p>
                        <ul class="list-disc list-outside ml-5 space-y-2">
                            <li>Menyediakan dan memelihara website.</li>
                            <li>Meningkatkan dan mempersonalisasi website.</li>
                            <li>Menganalisis penggunaan website.</li>
                            <li>Berkomunikasi dengan Anda (layanan pelanggan, pembaruan, promosi jika setuju).</li>
                            <li>Mengirim email (jika berlangganan).</li>
                            <li>Mencegah penipuan.</li>
                            <li>Memproses permintaan (misal: verifikasi kode akses).</li>
                        </ul>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="shield-check" class="w-5 h-5 mr-3 text-blue-600"></i>
                             4. Keamanan Data
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Kami mengambil langkah keamanan wajar untuk melindungi data Anda. Namun, tidak ada transmisi internet atau penyimpanan elektronik yang 100% aman.</p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="cookie" class="w-5 h-5 mr-3 text-blue-600"></i>
                             5. Cookie
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Website kami mungkin menggunakan cookie untuk meningkatkan pengalaman. Browser Anda menempatkan cookie untuk pencatatan dan pelacakan. Anda bisa menolak cookie via pengaturan browser, namun beberapa bagian situs mungkin tidak berfungsi.</p>
                         <p class="mt-2 text-sm"><em>(Sebutkan jenis cookie spesifik jika Anda tahu, misal: Google Analytics).</em></p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="user-check" class="w-5 h-5 mr-3 text-blue-600"></i>
                             6. Hak Anda
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Anda mungkin memiliki hak untuk mengakses, memperbaiki, menghapus, atau membatasi penggunaan data pribadi Anda. Hubungi kami jika ingin menggunakan hak ini.</p>
                         <p class="mt-2 text-sm"><em>(Sesuaikan sesuai UU PDP atau hukum privasi lain yang relevan).</em></p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="refresh-cw" class="w-5 h-5 mr-3 text-blue-600"></i>
                             7. Perubahan pada Kebijakan Ini
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Kami dapat memperbarui kebijakan ini. Perubahan akan diposting di halaman ini dengan tanggal pembaruan yang baru. Harap tinjau secara berkala.</p>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="mail" class="w-5 h-5 mr-3 text-blue-600"></i>
                             8. Hubungi Kami
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Jika ada pertanyaan, hubungi kami melalui:</p>
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
                const content = button.nextElementSibling; // div.accordion-content
                const isOpen = content.classList.contains('open');

                // Tutup semua accordion lain (opsional)
                // accordionButtons.forEach(otherButton => {
                //     const otherContent = otherButton.nextElementSibling;
                //     if (otherContent !== content && otherContent.classList.contains('open')) {
                //         otherContent.classList.remove('open');
                //         otherButton.classList.remove('open');
                //     }
                // });

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