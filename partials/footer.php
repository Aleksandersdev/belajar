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
                <h3 class="font-semibold text-slate-900 mb-4">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="https://domainanda.com/page/tentang-kami" class="text-slate-500 hover:text-indigo-600 transition-colors">Tentang Kami</a></li>
                    <li><a href="https://domainanda.com/#layanan" class="text-slate-500 hover:text-indigo-600 transition-colors">Layanan</a></li>
                    <li><a href="https://domainanda.com/#blog" class="text-slate-500 hover:text-indigo-600 transition-colors">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 mb-4">Dukungan</h3>
                <ul class="space-y-3">
                    <li><a href="https://domainanda.com/#faq" class="text-slate-500 hover:text-indigo-600 transition-colors">FAQ</a></li>
                    <li><a href="https://domainanda.com/kontak" class="text-slate-500 hover:text-indigo-600 transition-colors">Kontak Kami</a></li>
                    <li><a href="https://domainanda.com/kebijakan-privasi" class="text-slate-500 hover:text-indigo-600 transition-colors">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="facebook" class="w-6 h-6"></i></a>
                    <a href="#" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="twitter" class="w-6 h-6"></i></a>
                    <a href="#" class="text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all transform"><i data-lucide="instagram" class="w-6 h-6"></i></a>
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
    
</body>
</html>