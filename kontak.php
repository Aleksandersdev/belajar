<?php
// Panggil config (database, session, dll.)
require_once 'config.php';

// Atur judul halaman dinamis untuk header
$page_title = 'Kontak Kami';

// Muat header
include 'partials/header.php';

// Definisikan variabel sosial media (ganti URL dan followers jika perlu)
$social_media = [
    'instagram' => ['url' => 'https://www.instagram.com/rangkumanmateri_/', 'icon' => 'instagram', 'name' => 'Instagram', 'followers' => '+15K Pengikut'], // Contoh
    'tiktok'    => ['url' => '#', 'icon' => 'tiktok', 'name' => 'TikTok', 'followers' => '+5K Pengikut'],       // Contoh, ganti '#'
    'twitter'   => ['url' => '#', 'icon' => 'twitter', 'name' => 'Twitter', 'followers' => '+1K Pengikut'],     // Contoh, ganti '#'
    'facebook'  => ['url' => '#', 'icon' => 'facebook', 'name' => 'Facebook', 'followers' => '+2K Pengikut'],    // Contoh, ganti '#'
    'threads'   => ['url' => '#', 'icon' => 'message-circle', 'name' => 'Threads', 'followers' => '+500 Pengikut'], // Contoh, ganti '#' (ikon Lucide mungkin perlu diganti)
];
$email_address = 'info@rangkumanmateri.com'; // Ganti dengan email Anda

?>

<style>
    /* Tambahkan style spesifik jika perlu */
    .social-link {
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .social-link:hover {
        transform: scale(1.03); /* Sedikit lebih halus */
    }
    /* Ganti ikon TikTok & Threads jika Lucide tidak punya */
    [data-lucide="tiktok"]::before { content: "?"; /* Placeholder */ }
    [data-lucide="threads"]::before { content: "?"; /* Placeholder */ }
</style>

<main>
    <section id="hero-kontak" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-slate-50">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up">
                Hubungi Kami
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-slate-600 mb-8" data-aos="fade-up" data-aos-delay="100">
                Punya pertanyaan, saran, atau ingin berkolaborasi? Kami siap mendengarkan!
            </p>
        </div>
    </section>

    <section id="detail-kontak" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">

                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800">Tetap Terhubung</h2>
                    <p class="text-lg text-slate-500 mt-2">Temukan kami di berbagai platform.</p>
                    <div class="w-24 h-1 bg-blue-700 mx-auto mt-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    <div data-aos="fade-right">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6">Media Sosial</h3>
                        <div class="space-y-5">
                            <?php foreach ($social_media as $platform => $data): ?>
                                <a href="<?php echo htmlspecialchars($data['url']); ?>" target="_blank" rel="noopener noreferrer"
                                   class="social-link flex items-center space-x-4 p-4 bg-slate-50 rounded-lg border border-slate-200 hover:bg-slate-100 group">
                                    <i data-lucide="<?php echo $data['icon']; ?>" class="w-8 h-8 text-blue-600 group-hover:text-blue-800 transition-colors flex-shrink-0"></i>
                                    <div>
                                        <p class="font-semibold text-slate-700 group-hover:text-slate-900 flex items-center flex-wrap"> <?php echo $data['name']; ?>
                                            <?php if (!empty($data['followers'])): ?>
                                                <span class="ml-2 mt-1 md:mt-0 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full font-medium whitespace-nowrap"> <?php echo htmlspecialchars($data['followers']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        <p class="text-sm text-slate-500">Ikuti kami di <?php echo $data['name']; ?></p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div data-aos="fade-left">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6">Kontak Langsung</h3>
                        <div class="space-y-5">
                            <div class="flex items-start space-x-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <i data-lucide="mail" class="w-8 h-8 text-blue-600 mt-1 flex-shrink-0"></i>
                                <div>
                                    <p class="font-semibold text-slate-700">Email</p>
                                    <p class="text-sm text-slate-500 mb-2">Untuk pertanyaan umum atau kerjasama:</p>
                                    <a href="mailto:<?php echo htmlspecialchars($email_address); ?>" class="font-medium text-blue-600 hover:underline break-all">
                                        <?php echo htmlspecialchars($email_address); ?>
                                    </a>
                                </div>
                            </div>

                            </div>
                    </div>

                </div> </div>
        </div>
    </section>

</main>

<?php
// Muat footer
include 'partials/footer.php';
?>

<script>
    // Pastikan ikon Lucide di-render
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>