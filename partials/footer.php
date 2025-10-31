<?php
// Mencegah file ini diakses secara langsung dari browser
defined('APP_RUNNING') or die('Access denied');
?>

<footer class="bg-white border-t border-slate-200">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="mb-6 md:mb-0">
                <h3 class="text-2xl font-bold text-blue-800 mb-4">Rangkumanmateri.com</h3>
                <p class="text-slate-500 text-sm">Platform terintegrasi untuk pengembangan kompetensi akademik dan profesional.</p>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 mb-4">Dukungan</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-slate-500 hover:text-indigo-600 transition-colors">Materi TKA</a></li>
                    <li><a href="#" class="text-slate-500 hover:text-indigo-600 transition-colors">Bank Soal</a></li>
                    <li><a href="#" class="text-slate-500 hover:text-indigo-600 transition-colors">Tryout Online</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 mb-4">Bantuan & Panduan</h3>
                <ul class="space-y-3">
                    <li><a href="/tentang-kami" class="text-slate-500 hover:text-indigo-600 transition-colors">Tentang Kami</a></li>
                    <li><a href="/kontak" class="text-slate-500 hover:text-indigo-600 transition-colors">Kontak Kami</a></li>
                    <li><a href="/kebijakan-privasi" class="text-slate-500 hover:text-indigo-600 transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="/disclaimer" class="text-slate-500 hover:text-indigo-600 transition-colors">Disclaimer</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-semibold text-slate-900 mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="https://facebook.com/rangkumanmaterii" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="facebook" class="w-6 h-6"></i></a>
                    <a href="https://twitter.com/catatanmaterii" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="twitter" class="w-6 h-6"></i></a>
                    <a href="https://www.instagram.com/rangkumanmateri_/" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="instagram" class="w-6 h-6"></i></a>
                    <a href="#" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="linkedin" class="w-6 h-6"></i></a>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-slate-200 pt-8 text-center text-slate-500 text-sm">
            <p>© 2025 Rangkumanmateri.com. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>    
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
       AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out-cubic',
        });

        // Initialize Lucide icons
        lucide.createIcons();

        // Particles.js config (Hanya jalankan jika elemennya ada)
        if (document.getElementById('particles-js')) {
            particlesJS('particles-js', {
                "particles": { "number": { "value": 160, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#ffffff" }, "shape": { "type": "circle", "stroke": { "width": 0, "color": "#000000" } }, "opacity": { "value": 0.8, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 4, "random": true, "anim": { "enable": false } }, "line_linked": { "enable": false }, "move": { "enable": true, "speed": 1.5, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false } },
                "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "bubble": { "distance": 250, "size": 6, "duration": 2, "opacity": 1, "speed": 3 }, "push": { "particles_nb": 4 } } },
                "retina_detect": true
            });
        }
        
        // Counter animation (Hanya jalankan jika elemennya ada)
        const counters = document.querySelectorAll('.counter');
        if (counters.length > 0) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = +counter.getAttribute('data-target');
                        let current = 0;
                        const increment = target / 100;
                        const updateCounter = () => {
                            if (current < target) {
                                current += increment;
                                counter.innerText = Math.ceil(current);
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        updateCounter();
                        observer.unobserve(counter);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(counter => observer.observe(counter));
        }

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        }
        
        // Anti-inspect
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === "F12" || ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'I' || e.key === 'J')) || ((e.ctrlKey || e.metaKey) && e.key === 'U')) {
                e.preventDefault();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Targetkan link di dalam sidebar (lebih spesifik)
            const categoryLinks = document.querySelectorAll('aside ul a[data-category-id]'); // Selector diperbaiki

            categoryLinks.forEach(link => {
                const categoryId = link.dataset.categoryId;
                const hasChildren = link.dataset.hasChildren === 'true';
                const icon = link.querySelector('i[data-lucide="chevron-down"]');

                // Cari sub-menu (ul) SETELAH link ini
                const subMenu = link.nextElementSibling;

                // Cek apakah link ini aktif atau leluhur (berdasarkan kelas dari PHP)
                const isActive = link.classList.contains('bg-blue-100'); // Kelas untuk aktif
                const isAncestor = link.classList.contains('font-medium') && !isActive; // Kelas untuk leluhur (bukan yg aktif)

                // Jika link adalah leluhur ATAU aktif DAN punya anak, buka sub-menunya
                if ((isActive || isAncestor) && hasChildren && subMenu && subMenu.tagName === 'UL') { // Pastikan nextSibling adalah UL
                    subMenu.classList.remove('hidden'); // Tampilkan sub-menu
                    if (icon) icon.classList.add('rotate-180'); // Putar panah
                }

                // Tambahkan event listener HANYA jika punya anak
                if (hasChildren) {
                    link.addEventListener('click', function (event) {
                        // Mencegah navigasi hanya jika subMenu ditemukan dan itu adalah UL
                        if (subMenu && subMenu.tagName === 'UL') {
                             event.preventDefault(); // Hentikan pindah halaman
                             subMenu.classList.toggle('hidden'); // Buka/tutup sub-menu
                             if (icon) icon.classList.toggle('rotate-180'); // Putar panah

                             // Tutup sub-menu lain di level yang sama (opsional)
                             // const parentUl = link.closest('ul');
                             // if (parentUl) {
                             //     parentUl.querySelectorAll(':scope > li > ul').forEach(otherSubMenu => {
                             //         if (otherSubMenu !== subMenu) {
                             //            otherSubMenu.classList.add('hidden');
                             //            const otherIcon = otherSubMenu.previousElementSibling.querySelector('i[data-lucide="chevron-down"]');
                             //            if (otherIcon) otherIcon.classList.remove('rotate-180');
                             //         }
                             //     });
                             // }
                        }
                        // Jika tidak ada subMenu atau bukan UL, biarkan link berjalan normal
                    });
                }
            });

             // Inisialisasi ulang ikon Lucide jika ada ikon baru
             if (typeof lucide !== 'undefined') {
                lucide.createIcons();
             }
        });
    </script>    

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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Logika FAQ Accordion (Simple) ---
        const accordionHeaders = document.querySelectorAll('.accordion-header');
        
        if (accordionHeaders.length > 0) {
            accordionHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const content = header.nextElementSibling;
                    const icon = header.querySelector('.accordion-icon');
                    const isOpen = content.style.maxHeight; // Cek apakah style maxHeight sudah di-set

                    // Tutup semua accordion lain
                    accordionHeaders.forEach(h => {
                        if (h !== header) {
                            h.nextElementSibling.style.maxHeight = null;
                            const otherIcon = h.querySelector('.accordion-icon');
                            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                            h.classList.remove('open'); // Hapus kelas 'open' jika ada
                        }
                    });
                    
                    // Buka/tutup yang diklik
                    if (isOpen) {
                        content.style.maxHeight = null; // Tutup
                        if(icon) icon.style.transform = 'rotate(0deg)';
                        header.classList.remove('open');
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px"; // Buka
                        if(icon) icon.style.transform = 'rotate(180deg)';
                        header.classList.add('open');
                    }
                });
            });
        }
        
        // ... (Skrip lain seperti Counter, Lottie, dll. biarkan di sini) ...
    });
</script>

    
</body>
</html>