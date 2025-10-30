<?php
// Panggil config
require_once 'config.php';

// Atur judul halaman dinamis
$page_title = 'Latihan: Kelompok Sosial';

// Muat header
include 'partials/header.php';
?>

<script>
MathJax = {
  tex: { inlineMath: [['$', '$']], displayMath: [['$$', '$$']] },
  svg: { fontCache: 'global' }
};
</script>
<script type="text/javascript" id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js"></script>

<style>
    /* CSS Kustom untuk Tampilan Ujian BARU */
    body {
        background-color: #f8fafc; /* Latar abu-abu muda */
    }
    main {
        padding-top: 6rem; /* Kurangi padding atas agar tidak terlalu jauh */
        padding-bottom: 4rem;
    }

    /* === Sidebar Navigasi === */
    #quiz-sidebar {
        background-color: white;
        border-radius: 0.75rem; /* rounded-xl */
        border: 1px solid #e2e8f0; /* slate-200 */
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05); /* shadow-lg */
        padding: 1.5rem; /* p-6 */
        align-self: flex-start; /* Mencegah sidebar meregang */
    }
    
    .nav-grid-btn {
        width: 2.75rem; /* w-11 */
        height: 2.75rem; /* h-11 */
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        border-radius: 0.5rem; /* rounded-lg */
        border: 2px solid #e5e7eb; /* gray-200 */
        color: #374151; /* gray-700 */
        transition: all 0.2s ease;
    }
    .nav-grid-btn:hover { background-color: #f3f4f6; /* gray-100 */ }
    .nav-grid-btn.active {
        background-color: #3b82f6; /* blue-500 */
        color: white; border-color: #3b82f6;
    }
    .nav-grid-btn.answered-correct {
        background-color: #dcfce7; /* green-100 */
        color: #166534; /* green-800 */
        border-color: #22c55e; /* green-500 */
    }
    .nav-grid-btn.answered-incorrect {
        background-color: #fee2e2; /* red-100 */
        color: #991b1b; /* red-800 */
        border-color: #ef4444; /* red-500 */
    }

    /* === Konten Utama Soal === */
    #quiz-main-content {
        background-color: white;
        border-radius: 0.75rem; /* rounded-xl */
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
    }
    
    /* Opsi Jawaban (Desain Tombol) */
    .option-label-btn { /* Ini adalah <label> */
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 1rem; /* p-4 */
        border: 2px solid #e5e7eb; /* gray-200 */
        border-radius: 0.5rem; /* rounded-lg */
        margin-bottom: 0.75rem; /* mb-3 */
        transition: all 0.2s ease;
        background-color: white;
    }
    .option-label-btn:hover {
        border-color: #9ca3af; /* gray-400 */
        background-color: #f9fafb; /* gray-50 */
    }
    /* Kotak Huruf (A, B, C) */
    .option-label-btn .option-letter {
        width: 2.25rem; /* w-9 */
        height: 2.25rem; /* h-9 */
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #9ca3af; /* gray-400 */
        border-radius: 0.25rem; /* rounded */
        font-weight: 600;
        color: #4b5563; /* gray-600 */
        transition: all 0.2s ease;
        margin-right: 1rem; /* mr-4 */
    }
    .option-label-btn .option-text {
        color: #374151; /* gray-700 */
        font-weight: 500;
    }

    /* Styling saat radio (peer) dipilih */
    input[type="radio"]:checked + .option-label-btn {
        border-color: #3b82f6; /* blue-500 */
        background-color: #eff6ff; /* blue-50 */
    }
    input[type="radio"]:checked + .option-label-btn .option-letter {
        background-color: #3b82f6; /* blue-500 */
        border-color: #3b82f6;
        color: white;
    }
    input[type="radio"]:checked + .option-label-btn .option-text {
        color: #1e3a8a; /* blue-800 */
        font-weight: 600;
    }
    
    /* Styling Umpan Balik (setelah konfirmasi) */
    input[type="radio"]:disabled + .option-label-btn {
         opacity: 0.9;
         cursor: not-allowed;
    }
    input[type="radio"]:disabled + .option-label-btn.correct {
        border-color: #22c55e; /* green-500 */
        background-color: #dcfce7; /* green-100 */
    }
    input[type="radio"]:disabled + .option-label-btn.correct .option-letter {
        background-color: #22c55e; border-color: #166534; color: white;
    }
     input[type="radio"]:disabled + .option-label-btn.correct .option-text { color: #15803d; }
    
    input[type="radio"]:disabled + .option-label-btn.incorrect {
        border-color: #ef4444; /* red-500 */
        background-color: #fee2e2; /* red-100 */
        text-decoration: line-through;
    }
    input[type="radio"]:disabled + .option-label-btn.incorrect .option-letter {
        background-color: #ef4444; border-color: #991b1b; color: white;
    }
    input[type="radio"]:disabled + .option-label-btn.incorrect .option-text { color: #b91c1c; }
    
    /* Pembahasan */
    #quiz-explanation {
        display: none;
        padding: 1.25rem; /* p-5 */
        margin-top: 1rem; /* mt-4 */
        background-color: #f8fafc; /* slate-50 */
        border-radius: 0.5rem;
    }
    #quiz-explanation.show { display: block; }

    /* Navigasi Bawah */
    .bottom-nav-btn {
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: #f1f5f9; /* slate-100 */
        color: #475569; /* slate-600 */
        transition: all 0.2s ease;
    }
    .bottom-nav-btn:hover { background-color: #e2e8f0; /* slate-200 */ }
    .bottom-nav-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    .bottom-nav-btn.confirm {
        flex-grow: 1;
        background: linear-gradient(to right, #e0e7ff, #c7d2fe); /* indigo-100 to indigo-200 */
        color: #3730a3; /* indigo-800 */
        font-weight: 600;
    }
    .bottom-nav-btn.confirm:hover { background: linear-gradient(to right, #c7d2fe, #a5b4fc); }
    .bottom-nav-btn.confirm.answered {
        background: #f1f5f9; color: #64748b; cursor: not-allowed;
    }
</style>

<main>
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row gap-8">

            <aside class="w-full md:w-1/4 order-2 md:order-1 mt-8 md:mt-0" data-aos="fade-right">
                <div id="quiz-sidebar" class="sticky top-28">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Navigasi Soal</h3>
                    <div id="nav-grid-container" class="grid grid-cols-5 gap-2 mb-6">
                        </div>

                    <h4 class="font-semibold text-slate-700 mb-3">Legenda:</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center"><span class="w-4 h-4 rounded-full bg-blue-500 mr-2 border border-blue-600"></span> Saat ini</li>
                        <li class="flex items-center"><span class="w-4 h-4 rounded-full bg-green-100 mr-2 border border-green-500"></span> Benar</li>
                        <li class="flex items-center"><span class="w-4 h-4 rounded-full bg-red-100 mr-2 border border-red-500"></span> Salah</li>
                        <li class="flex items-center"><span class="w-4 h-4 rounded-full bg-white mr-2 border border-gray-400"></span> Belum dijawab</li>
                    </ul>

                    <hr class="my-6">
                    
                    <a href="/" class="flex items-center justify-center w-full px-4 py-3 rounded-lg text-sm font-semibold transition bg-slate-100 text-slate-700 hover:bg-slate-200">
                         <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                         Keluar Latihan
                    </a>
                </div>
            </aside>

            <div class="w-full md:w-3/4 order-1 md:order-2" data-aos="fade-up" data-aos-delay="100">
                <div id="quiz-main-content">
                    
                    <div class="p-6 border-b border-slate-200">
                        <h2 id="question-title" class="text-2xl font-bold text-slate-800">Soal 1</h2>
                        <p id="question-text" class="text-slate-700 mt-2 text-lg">Memuat pertanyaan...</p>
                    </div>

                    <div class="p-6">
                        <h4 class="font-semibold text-slate-600 mb-4">Pilih Jawaban:</h4>
                        <div id="options-list">
                            </div>

                        <div id="quiz-explanation">
                            <h4 id="quiz-explanation-title" class="font-bold text-lg mb-2"></h4>
                            <p id="quiz-explanation-text" class="text-slate-700 leading-relaxed"></p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 border-t border-slate-200 flex justify-between items-center space-x-3">
                        <button id="prev-btn" class="bottom-nav-btn"><i data-lucide="arrow-left" class="w-5 h-5"></i></button>
                        <button id="confirm-btn" class="bottom-nav-btn confirm">Pilih Jawaban...</button>
                        <button id="next-btn" class="bottom-nav-btn"><i data-lucide="arrow-right" class="w-5 h-5"></i></button>
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

        // =======================================================
        // DATA KUIS (DATABASE SOAL)
        // =======================================================
        const quizData = [
            {
                question: "Himpunan manusia yang memiliki kesadaran bersama akan keanggotaannya dan saling berinteraksi secara timbal balik adalah definisi dari...",
                options: ["Kerumunan (Crowd)", "Kelompok Sosial (Social Group)", "Kategori Sosial (Social Category)", "Publik (Public)"],
                correctAnswer: 1, // Indeks jawaban benar (B)
                explanation: "Jawaban: B. Kelompok Sosial. Syarat utama kelompok sosial adalah (1) kesadaran sebagai bagian kelompok (we-feeling) dan (2) interaksi sosial yang kontinu."
            },
            {
                question: "Klasifikasi kelompok sosial menjadi Paguyuban (Gemeinschaft) dan Patembayan (Gesellschaft) dikemukakan oleh...",
                options: ["Charles H. Cooley", "W.G. Sumner", "Robert K. Merton", "Ferdinand Tönnies"],
                correctAnswer: 3,
                explanation: "Jawaban: D. Ferdinand Tönnies. Ia membedakan kelompok berdasarkan sifat ikatan: Gemeinschaft (ikatan batin murni, cth: keluarga) dan Gesellschaft (ikatan rasional, cth: serikat pekerja)."
            },
            {
                question: "Keluarga dan kelompok sahabat dekat merupakan contoh utama dari kelompok...",
                options: ["Primer", "Sekunder", "Formal", "Referensi"],
                correctAnswer: 0,
                explanation: "Jawaban: A. Primer. Menurut Charles H. Cooley, kelompok primer ditandai oleh hubungan yang akrab, tatap muka, dan fundamental dalam membentuk kepribadian."
            },
            {
                question: "Siswa SMA yang mengidolakan klub sepak bola Real Madrid dan meniru gaya hidup pemainnya, menjadikan Real Madrid sebagai...",
                options: ["Membership Group", "Reference Group (Kelompok Acuan)", "Out-group", "Paguyuban (Gemeinschaft)"],
                correctAnswer: 1,
                explanation: "Jawaban: B. Reference Group. Ini adalah kelompok yang dijadikan acuan oleh seseorang (meski bukan anggota) untuk membentuk perilaku."
            },
            {
                question: "Munculnya sentimen 'kami' (in-group) yang berlawanan dengan 'mereka' (out-group) adalah konsep yang dikemukakan oleh...",
                options: ["Emile Durkheim", "Karl Marx", "Ferdinand Tönnies", "W.G. Sumner"],
                correctAnswer: 3,
                explanation: "Jawaban: D. W.G. Sumner. Ia mempopulerkan istilah in-group (kelompok kami) dan out-group (kelompok mereka)."
            },
            // --- TAMBAHKAN 15 SOAL LAINNYA DI SINI ---
            { question: "Soal 6...", options: ["A", "B", "C", "D"], correctAnswer: 0, explanation: "Penjelasan 6..." },
            { question: "Soal 7...", options: ["A", "B", "C", "D"], correctAnswer: 1, explanation: "Penjelasan 7..." },
            { question: "Soal 8...", options: ["A", "B", "C", "D"], correctAnswer: 2, explanation: "Penjelasan 8..." },
            { question: "Soal 9...", options: ["A", "B", "C", "D"], correctAnswer: 3, explanation: "Penjelasan 9..." },
            { question: "Soal 10...", options: ["A", "B", "C", "D"], correctAnswer: 0, explanation: "Penjelasan 10..." },
            { question: "Soal 11...", options: ["A", "B", "C", "D"], correctAnswer: 1, explanation: "Penjelasan 11..." },
            { question: "Soal 12...", options: ["A", "B", "C", "D"], correctAnswer: 2, explanation: "Penjelasan 12..." },
            { question: "Soal 13...", options: ["A", "B", "C", "D"], correctAnswer: 3, explanation: "Penjelasan 13..." },
            { question: "Soal 14...", options: ["A", "B", "C", "D"], correctAnswer: 0, explanation: "Penjelasan 14..." },
            { question: "Soal 15...", options: ["A", "B", "C", "D"], correctAnswer: 1, explanation: "Penjelasan 15..." },
            { question: "Soal 16...", options: ["A", "B", "C", "D"], correctAnswer: 2, explanation: "Penjelasan 16..." },
            { question: "Soal 17...", options: ["A", "B", "C", "D"], correctAnswer: 3, explanation: "Penjelasan 17..." },
            { question: "Soal 18...", options: ["A", "B", "C", "D"], correctAnswer: 0, explanation: "Penjelasan 18..." },
            { question: "Soal 19...", options: ["A", "B", "C", "D"], correctAnswer: 1, explanation: "Penjelasan 19..." },
            { question: "Soal 20...", options: ["A", "B", "C", "D"], correctAnswer: 2, explanation: "Penjelasan 20..." },
        ];
        // =======================================================

        // Elemen UI
        const navGridContainer = document.getElementById('nav-grid-container');
        const questionTitle = document.getElementById('question-title');
        const questionText = document.getElementById('question-text');
        const optionsList = document.getElementById('options-list');
        const explanationBox = document.getElementById('quiz-explanation');
        const explanationTitle = document.getElementById('quiz-explanation-title');
        const explanationText = document.getElementById('quiz-explanation-text');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const confirmBtn = document.getElementById('confirm-btn');

        // Status Kuis
        let currentQuestionIndex = 0;
        let userAnswers = new Array(quizData.length).fill(null); // Menyimpan indeks jawaban
        let questionStates = new Array(quizData.length).fill('untouched'); // 'untouched', 'correct', 'incorrect'

        function loadQuestion(index) {
            currentQuestionIndex = index;
            const q = quizData[index];
            const state = questionStates[index];
            const userAnswer = userAnswers[index];

            questionTitle.textContent = `Soal ${index + 1}`;
            questionText.textContent = q.question;
            optionsList.innerHTML = '';
            explanationBox.classList.remove('show');

            // Buat Pilihan Jawaban (Radio Button)
            q.options.forEach((option, i) => {
                const optionId = `q${index}_option${i}`;
                
                // Input Radio (dibuat dulu, disembunyikan)
                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = `question_${index}`;
                radio.id = optionId;
                radio.value = i;
                radio.className = 'hidden'; // Sembunyikan radio button asli
                
                // Label (sekarang menjadi tombol)
                const label = document.createElement('label');
                label.className = 'option-label-btn'; // Kelas CSS baru
                label.htmlFor = optionId;

                // Box Huruf (A, B, C...)
                const optionLetter = document.createElement('div');
                optionLetter.className = 'option-letter';
                optionLetter.textContent = String.fromCharCode(65 + i); // A, B, C...

                // Teks Opsi
                const optionText = document.createElement('span');
                optionText.className = 'option-text';
                optionText.textContent = option;
                
                // Masukkan radio (tersembunyi) dan label ke container
                optionsList.appendChild(radio); 
                optionsList.appendChild(label);
                
                // Susun elemen di dalam label
                label.appendChild(optionLetter);
                label.appendChild(optionText);

                // Jika soal sudah dijawab, tampilkan status
                if (state !== 'untouched') {
                    radio.disabled = true;
                    const isCorrect = state === 'correct';
                    if (i === userAnswer) {
                        label.classList.add(isCorrect ? 'correct' : 'incorrect');
                        radio.checked = true;
                    } else if (i === q.correctAnswer && !isCorrect) {
                        // Tampilkan jawaban benar jika pilihan user salah
                        label.classList.add('correct');
                    }
                } else {
                    // Jika belum dijawab, tambahkan event listener
                    radio.addEventListener('change', () => {
                        userAnswers[index] = i;
                        updateConfirmButtonState();
                    });
                }
            });

            // Tampilkan Penjelasan jika sudah dijawab
            if (state !== 'untouched') {
                const isCorrect = state === 'correct';
                explanationTitle.textContent = isCorrect ? "Pembahasan (Benar)" : "Pembahasan (Kurang Tepat)";
                explanationTitle.className = `font-bold text-lg mb-2 ${isCorrect ? 'text-green-700' : 'text-red-700'}`;
                explanationText.textContent = q.explanation;
                explanationBox.classList.add('show');
            }
            
            updateNavGrid();
            updateBottomNav();
            
            if (typeof MathJax !== 'undefined') MathJax.typesetPromise();
        }

        // Render grid navigasi
        function renderNavGrid() {
            navGridContainer.innerHTML = '';
            for (let i = 0; i < quizData.length; i++) {
                const btn = document.createElement('button');
                btn.className = 'nav-grid-btn';
                btn.textContent = i + 1;
                
                if (questionStates[i] === 'correct') {
                    btn.classList.add('answered-correct');
                } else if (questionStates[i] === 'incorrect') {
                    btn.classList.add('answered-incorrect');
                }

                if (i === currentQuestionIndex) {
                    btn.classList.add('active');
                }

                btn.addEventListener('click', () => loadQuestion(i));
                navGridContainer.appendChild(btn);
            }
        }
        
        // Update grid (lebih efisien daripada render ulang)
        function updateNavGrid() {
             navGridContainer.querySelectorAll('.nav-grid-btn').forEach((btn, i) => {
                btn.classList.remove('active');
                if (i === currentQuestionIndex) {
                    btn.classList.add('active');
                }
                
                btn.classList.remove('answered-correct', 'answered-incorrect');
                 if (questionStates[i] === 'correct') {
                    btn.classList.add('answered-correct');
                } else if (questionStates[i] === 'incorrect') {
                    btn.classList.add('answered-incorrect');
                }
            });
        }
        
        function updateConfirmButtonState() {
             if (userAnswers[currentQuestionIndex] !== null) {
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Konfirmasi Jawaban';
                confirmBtn.classList.remove('answered');
            } else {
                 confirmBtn.disabled = true;
                 confirmBtn.textContent = 'Pilih Jawaban...';
                 confirmBtn.classList.remove('answered');
            }
        }

        function updateBottomNav() {
            prevBtn.disabled = currentQuestionIndex === 0;
            nextBtn.disabled = currentQuestionIndex === quizData.length - 1;

            if (questionStates[currentQuestionIndex] !== 'untouched') {
                confirmBtn.textContent = 'Jawaban Terkonfirmasi';
                confirmBtn.disabled = true;
                confirmBtn.classList.add('answered');
            } else {
                 updateConfirmButtonState();
            }
        }

        function konfirmasiJawaban() {
            const userAnswer = userAnswers[currentQuestionIndex];
            if (userAnswer === null) {
                 alert('Silakan pilih satu jawaban terlebih dahulu.');
                 return;
            }
            
            const q = quizData[currentQuestionIndex];
            const isCorrect = (userAnswer === q.correctAnswer);
            
            questionStates[currentQuestionIndex] = isCorrect ? 'correct' : 'incorrect';
            
            loadQuestion(currentQuestionIndex); // Muat ulang soal (mode "dijawab")
        }

        // Event Listeners
        prevBtn.addEventListener('click', () => {
            if (currentQuestionIndex > 0) loadQuestion(currentQuestionIndex - 1);
        });
        nextBtn.addEventListener('click', () => {
            if (currentQuestionIndex < quizData.length - 1) loadQuestion(currentQuestionIndex + 1);
        });
        confirmBtn.addEventListener('click', konfirmasiJawaban);

        // Mulai kuis
        renderNavGrid(); // Render grid navigasi
        loadQuestion(0); // Muat soal pertama
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>