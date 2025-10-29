<?php
// Panggil config
require_once 'config.php';

// Atur judul halaman dinamis
$page_title = 'Materi Limit Fungsi Aljabar';

// Muat header
include 'partials/header.php';
?>

<script>
MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']], // Delimiter untuk inline math
    displayMath: [['$$', '$$'], ['\\[', '\\]']] // Delimiter untuk display math
  },
  svg: {
    fontCache: 'global'
  }
};
</script>
<script type="text/javascript" id="MathJax-script" async
  src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
</script>
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
        max-height: 2000px; /* Lebih tinggi untuk konten math */
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
        list-style-type: decimal; /* Pakai nomor */
        list-style-position: outside;
        margin-left: 1.25rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        line-height: 1.75;
    }
    .materi-list li::marker {
        color: #1d4ed8; /* Warna nomor list */
        font-weight: 600;
    }
    .highlight-math {
        background-color: #e0f2fe; /* Latar biru muda */
        color: #0c4a6e; /* Teks biru tua */
        padding: 0.1rem 0.4rem;
        border-radius: 0.25rem;
        font-family: monospace; /* Font berbeda untuk kode/math */
    }
    .contoh-box {
        background-color: #f1f5f9;
        border-left: 4px solid #64748b;
        padding: 1rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
    }
    .penting-box {
         background-color: #fefce8;
        border-left: 4px solid #ca8a04;
        padding: 1rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        color: #713f12;
    }
</style>

<main>
    <section id="hero-materi-math" class="pt-28 pb-16 md:pt-40 md:pb-24 flex items-center bg-gradient-to-br from-green-50 to-cyan-100">
        <div class="container mx-auto px-6 text-center">
            <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-1 rounded-full mb-3" data-aos="fade-up">Matematika</span>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800 mb-4" data-aos="fade-up" data-aos-delay="100">
                Limit Fungsi Aljabar
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-slate-600" data-aos="fade-up" data-aos-delay="200">
                Memahami konsep pendekatan nilai suatu fungsi saat variabel mendekati titik tertentu.
            </p>
        </div>
    </section>

    <section id="konten-materi" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">

            <p class="text-lg text-slate-700 leading-relaxed mb-12" data-aos="fade-up">
                Selamat pagi/siang/sore, para siswa cerdas! Hari ini kita akan menyelami salah satu konsep fundamental dalam kalkulus, yaitu **Limit Fungsi Aljabar**. Konsep limit ini bagaikan 'melihat' perilaku suatu fungsi saat ia *mendekati* suatu nilai, bukan tepat *di* nilai tersebut. Mari kita pahami bersama melalui bagian-bagian berikut.
            </p>

            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button open w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="brain" class="w-5 h-5 mr-3 text-cyan-600"></i>
                            1. Apa Itu Limit Fungsi? (Konsep Intuitif)
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0 rotate-180"></i>
                    </button>
                    <div class="accordion-content open text-slate-700 leading-relaxed">
                        <p>Bayangkan Anda berjalan di sepanjang grafik fungsi $y = f(x)$. Limit bertanya: "Saat nilai $x$ Anda semakin dekat dan dekat ke suatu titik $c$, nilai $y$ (atau $f(x)$) akan mendekati nilai apa?"</p>
                        <p class="mt-2">Secara formal, kita tulis:</p>
                        $$ \lim_{x \to c} f(x) = L $$
                        <p>Ini dibaca: "Limit dari $f(x)$ saat $x$ mendekati $c$ adalah $L$."</p>
                        <p class="mt-2">Penting dicatat, kita hanya peduli nilai $f(x)$ di **sekitar** $c$, bukan **tepat di** $c$. Fungsi $f(x)$ bahkan tidak perlu terdefinisi di $x=c$ agar limitnya ada!</p>
                        <div class="penting-box">
                           <strong>Poin Kunci:</strong> Limit adalah tentang **pendekatan**, bukan nilai fungsi di titik itu sendiri.
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="arrow-right-circle" class="w-5 h-5 mr-3 text-green-600"></i>
                             2. Metode Substitusi Langsung
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                        <p>Cara paling sederhana untuk mencari limit $\lim_{x \to c} f(x)$ adalah dengan **mensubstitusikan** nilai $c$ ke dalam fungsi $f(x)$.</p>
                        <p>Jika hasilnya adalah **bilangan real** (bukan bentuk tak tentu seperti $\frac{0}{0}$ atau $\frac{\infty}{\infty}$), maka itulah nilai limitnya.</p>
                        <div class="contoh-box">
                            <strong>Contoh 1:</strong> Hitung $\lim_{x \to 2} (3x^2 - 5x + 1)$.
                            <br>
                            Substitusi $x=2$:
                            $$ 3(2)^2 - 5(2) + 1 = 3(4) - 10 + 1 = 12 - 10 + 1 = 3 $$
                            Karena hasilnya 3 (bilangan real), maka $\lim_{x \to 2} (3x^2 - 5x + 1) = 3$.
                        </div>
                         <div class="contoh-box">
                            <strong>Contoh 2:</strong> Hitung $\lim_{x \to 1} \frac{x+1}{x^2+3}$.
                            <br>
                            Substitusi $x=1$:
                            $$ \frac{1+1}{1^2+3} = \frac{2}{1+3} = \frac{2}{4} = \frac{1}{2} $$
                            Hasilnya $\frac{1}{2}$ (bilangan real), maka $\lim_{x \to 1} \frac{x+1}{x^2+3} = \frac{1}{2}$.
                        </div>
                         <div class="penting-box">
                           <strong>Kapan Digunakan:</strong> Metode ini adalah langkah pertama. Selalu coba substitusi langsung. Jika hasilnya bilangan real, selesai! Jika hasilnya bentuk tak tentu, gunakan metode lain.
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="scissors" class="w-5 h-5 mr-3 text-red-600"></i>
                             3. Mengatasi Bentuk Tak Tentu $\frac{0}{0}$: Pemfaktoran
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed space-y-3">
                        <p>Jika substitusi langsung menghasilkan bentuk $\frac{0}{0}$, ini menandakan ada faktor yang sama di pembilang dan penyebut yang menyebabkan nol. Kita bisa menghilangkannya dengan **memfaktorkan**.</p>
                        <div class="contoh-box">
                            <strong>Contoh:</strong> Hitung $\lim_{x \to 3} \frac{x^2 - 9}{x - 3}$.
                            <br>
                            Substitusi $x=3$ menghasilkan $\frac{3^2 - 9}{3 - 3} = \frac{9-9}{0} = \frac{0}{0}$ (Tak Tentu).
                            <br>
                            Faktorkan pembilang: $x^2 - 9 = (x-3)(x+3)$.
                            <br>
                            Maka limitnya menjadi:
                            $$ \lim_{x \to 3} \frac{(x-3)(x+3)}{x - 3} $$
                            Karena $x$ mendekati 3 (tapi $x \neq 3$), kita bisa membatalkan faktor $(x-3)$:
                            $$ \lim_{x \to 3} (x+3) $$
                            Sekarang, substitusi $x=3$:
                            $$ 3 + 3 = 6 $$
                            Jadi, $\lim_{x \to 3} \frac{x^2 - 9}{x - 3} = 6$.
                        </div>
                         <div class="penting-box">
                           <strong>Kapan Digunakan:</strong> Ketika substitusi menghasilkan $\frac{0}{0}$ dan ekspresi (pembilang dan/atau penyebut) dapat difaktorkan.
                        </div>
                    </div>
                </div>

                 <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="repeat" class="w-5 h-5 mr-3 text-indigo-600"></i>
                             4. Mengatasi Bentuk Tak Tentu $\frac{0}{0}$: Perkalian Sekawan
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Jika bentuk tak tentu $\frac{0}{0}$ melibatkan **bentuk akar**, metode yang sering digunakan adalah mengalikan pembilang dan penyebut dengan **bentuk sekawan** dari ekspresi yang mengandung akar.</p>
                        <p>Ingat: Sekawan dari $(\sqrt{a} - \sqrt{b})$ adalah $(\sqrt{a} + \sqrt{b})$, dan sebaliknya. Hasil perkaliannya: $(\sqrt{a} - \sqrt{b})(\sqrt{a} + \sqrt{b}) = a - b$.</p>
                        <div class="contoh-box">
                             <strong>Contoh:</strong> Hitung $\lim_{x \to 0} \frac{\sqrt{x+4} - 2}{x}$.
                             <br>
                             Substitusi $x=0$ menghasilkan $\frac{\sqrt{0+4}-2}{0} = \frac{\sqrt{4}-2}{0} = \frac{2-2}{0} = \frac{0}{0}$.
                             <br>
                             Kalikan dengan sekawan dari pembilang, yaitu $\frac{\sqrt{x+4} + 2}{\sqrt{x+4} + 2}$:
                             $$ \lim_{x \to 0} \frac{\sqrt{x+4} - 2}{x} \times \frac{\sqrt{x+4} + 2}{\sqrt{x+4} + 2} $$
                             $$ = \lim_{x \to 0} \frac{(x+4) - 2^2}{x(\sqrt{x+4} + 2)} $$
                             $$ = \lim_{x \to 0} \frac{x+4 - 4}{x(\sqrt{x+4} + 2)} $$
                             $$ = \lim_{x \to 0} \frac{x}{x(\sqrt{x+4} + 2)} $$
                             Batalkan faktor $x$ (karena $x \neq 0$):
                             $$ = \lim_{x \to 0} \frac{1}{\sqrt{x+4} + 2} $$
                             Substitusi $x=0$:
                             $$ = \frac{1}{\sqrt{0+4} + 2} = \frac{1}{\sqrt{4} + 2} = \frac{1}{2 + 2} = \frac{1}{4} $$
                             Jadi, $\lim_{x \to 0} \frac{\sqrt{x+4} - 2}{x} = \frac{1}{4}$.
                        </div>
                         <div class="penting-box">
                           <strong>Kapan Digunakan:</strong> Ketika substitusi menghasilkan $\frac{0}{0}$ dan terdapat bentuk akar dalam ekspresi.
                        </div>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button class="accordion-button w-full flex justify-between items-center text-left p-5 bg-slate-50 hover:bg-slate-100 transition">
                        <span class="text-lg font-semibold text-slate-800 flex items-center">
                             <i data-lucide="infinity" class="w-5 h-5 mr-3 text-sky-600"></i>
                             5. Limit Menuju Tak Hingga ($\infty$)
                        </span>
                        <i data-lucide="chevron-down" class="chevron w-5 h-5 text-slate-500 flex-shrink-0"></i>
                    </button>
                    <div class="accordion-content text-slate-700 leading-relaxed">
                        <p>Kita juga bisa mencari limit saat $x$ mendekati tak hingga ($\infty$) atau negatif tak hingga ($-\infty$). Ini berguna untuk melihat perilaku fungsi pada 'ujung-ujung' grafiknya.</p>
                        <p>Untuk fungsi rasional (pecahan polinomial), cara umumnya adalah **membagi pembilang dan penyebut dengan pangkat tertinggi dari $x$ yang ada di penyebut**.</p>
                         <div class="contoh-box">
                             <strong>Contoh:</strong> Hitung $\lim_{x \to \infty} \frac{3x^2 - 2x + 5}{2x^2 + x - 1}$.
                             <br>
                             Pangkat tertinggi $x$ di penyebut adalah $x^2$. Bagi semua suku dengan $x^2$:
                             $$ \lim_{x \to \infty} \frac{\frac{3x^2}{x^2} - \frac{2x}{x^2} + \frac{5}{x^2}}{\frac{2x^2}{x^2} + \frac{x}{x^2} - \frac{1}{x^2}} $$
                             $$ = \lim_{x \to \infty} \frac{3 - \frac{2}{x} + \frac{5}{x^2}}{2 + \frac{1}{x} - \frac{1}{x^2}} $$
                             Ingat bahwa saat $x \to \infty$, suku seperti $\frac{k}{x}$, $\frac{k}{x^2}$, dst., akan mendekati 0.
                             $$ = \frac{3 - 0 + 0}{2 + 0 - 0} = \frac{3}{2} $$
                             Jadi, limitnya adalah $\frac{3}{2}$.
                        </div>
                        <div class="penting-box">
                           <strong>Tips Cepat (Fungsi Rasional):</strong>
                           <ul class="materi-list !text-sm">
                               <li>Jika pangkat tertinggi pembilang < pangkat tertinggi penyebut, limitnya 0.</li>
                               <li>Jika pangkat tertinggi pembilang = pangkat tertinggi penyebut, limitnya adalah rasio koefisien pangkat tertinggi.</li>
                               <li>Jika pangkat tertinggi pembilang > pangkat tertinggi penyebut, limitnya $\infty$ atau $-\infty$ (perlu analisis tanda).</li>
                           </ul>
                        </div>
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
            const content = button.nextElementSibling;
            // Buka accordion pertama secara default
            if (button.classList.contains('open') && content) {
                 content.classList.add('open');
            }
            button.addEventListener('click', () => {
                if (!content) return;
                const isOpen = content.classList.contains('open');
                // Tutup yang lain (opsional)
                 accordionButtons.forEach(otherButton => { /* ... kode tutup lain ... */ });
                content.classList.toggle('open');
                button.classList.toggle('open');
                // Render ulang MathJax jika perlu setelah animasi selesai
                setTimeout(() => {
                    if (typeof MathJax !== 'undefined' && typeof MathJax.typesetPromise === 'function') {
                        MathJax.typesetPromise();
                    }
                }, 400); // Sesuaikan delay dengan durasi transisi
            });
        });
        // Inisialisasi ikon Lucide
        if (typeof lucide !== 'undefined') { lucide.createIcons(); }
        // Render MathJax awal
        if (typeof MathJax !== 'undefined' && typeof MathJax.typesetPromise === 'function') { MathJax.typesetPromise(); }
    });
</script>