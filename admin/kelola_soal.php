<?php
// Panggil Penjaga Keamanan
require_once __DIR__ . '/auth_check.php';

// --- VALIDASI ID KUIS ---
if (!isset($_GET['kuis_id']) || !is_numeric($_GET['kuis_id'])) {
    $_SESSION['pesan_error'] = 'ID Kuis tidak valid.';
    header('Location: kelola_kuis'); // Redirect kembali ke daftar kuis
    exit;
}
$kuis_id = (int)$_GET['kuis_id'];

// Ambil info kuis untuk judul
$stmt_kuis_info = $pdo->prepare("SELECT judul FROM kuis WHERE id = ?");
$stmt_kuis_info->execute([$kuis_id]);
$kuis = $stmt_kuis_info->fetch();
if (!$kuis) {
    $_SESSION['pesan_error'] = 'Kuis tidak ditemukan.';
    header('Location: kelola_kuis');
    exit;
}
$kuis_judul = $kuis['judul'];


// --- (DELETE) LOGIKA HAPUS SOAL ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_soal'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }
    
    $soal_id_to_delete = (int)$_POST['soal_id'];
    
    try {
        // Hapus dari tabel 'soal'. 'pilihan_jawaban' akan terhapus otomatis
        // karena kita mengatur "ON DELETE CASCADE" di database.
        $stmt_delete = $pdo->prepare("DELETE FROM soal WHERE id = ? AND kuis_id = ?");
        $stmt_delete->execute([$soal_id_to_delete, $kuis_id]);
        
        $_SESSION['pesan_sukses'] = 'Soal berhasil dihapus.';
    } catch (PDOException $e) {
        $_SESSION['pesan_error'] = 'Gagal menghapus soal: ' . $e->getMessage();
    }
    header("Location: kelola_soal?kuis_id=$kuis_id"); // Refresh halaman
    exit;
}

// --- (CREATE) LOGIKA TAMBAH SOAL BARU ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_soal'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) { die('Token CSRF tidak valid.'); }

    // Ambil data form
    $stimulus = !empty($_POST['stimulus']) ? trim($_POST['stimulus']) : null;
    $pertanyaan_teks = trim($_POST['pertanyaan_teks']);
    $pembahasan = trim($_POST['pembahasan']);
    $pilihan = $_POST['pilihan']; // Ini adalah array [1 => "Teks A", 2 => "Teks B", ...]
    $jawaban_benar = (int)$_POST['jawaban_benar']; // Ini adalah index (1, 2, 3, 4, atau 5)
    $tipe_soal = $_POST['tipe_soal'] ?? 'mcq'; // 'mcq' (1 jawaban) atau 'mcma' (banyak)
    
    // Validasi
    if (empty($pertanyaan_teks) || empty($pembahasan) || count($pilihan) < 2 || $jawaban_benar == 0) {
        $_SESSION['pesan_error'] = 'Pertanyaan, Pembahasan, Pilihan Jawaban, dan Kunci Jawaban wajib diisi.';
    } else {
        try {
            // Mulai Transaksi Database (PENTING!)
            $pdo->beginTransaction();
            
            // 1. Masukkan ke tabel 'soal'
            $sql_soal = "INSERT INTO soal (kuis_id, stimulus, pertanyaan_teks, pembahasan, tipe_soal) 
                         VALUES (?, ?, ?, ?, ?)";
            $stmt_soal = $pdo->prepare($sql_soal);
            $stmt_soal->execute([$kuis_id, $stimulus, $pertanyaan_teks, $pembahasan, $tipe_soal]);
            
            // Dapatkan ID soal yang baru saja dibuat
            $soal_id = $pdo->lastInsertId();
            
            // 2. Masukkan ke tabel 'pilihan_jawaban'
            $sql_pilihan = "INSERT INTO pilihan_jawaban (soal_id, pilihan_teks, apakah_benar) 
                            VALUES (?, ?, ?)";
            $stmt_pilihan = $pdo->prepare($sql_pilihan);
            
            foreach ($pilihan as $index => $teks) {
                if (!empty($teks)) { // Hanya masukkan jika pilihan tidak kosong
                    $apakah_benar = ($index == $jawaban_benar) ? 1 : 0;
                    $stmt_pilihan->execute([$soal_id, $teks, $apakah_benar]);
                }
            }
            
            // Selesaikan Transaksi
            $pdo->commit();
            $_SESSION['pesan_sukses'] = 'Soal baru berhasil ditambahkan.';
            
        } catch (Exception $e) {
            // Jika ada error, batalkan semua
            $pdo->rollBack();
            $_SESSION['pesan_error'] = 'Gagal menambah soal: ' . $e->getMessage();
        }
    }
    header("Location: kelola_soal?kuis_id=$kuis_id"); // Refresh halaman
    exit;
}


// --- (READ) LOGIKA AMBIL DAFTAR SOAL ---
// Ambil semua soal untuk kuis ini
$stmt_read_soal = $pdo->prepare("SELECT * FROM soal WHERE kuis_id = ? ORDER BY id ASC");
$stmt_read_soal->execute([$kuis_id]);
$soal_list = $stmt_read_soal->fetchAll();

// Ambil semua pilihan jawaban untuk semua soal ini (untuk efisiensi)
$soal_ids = array_map(function($s) { return $s['id']; }, $soal_list);
$pilihan_list = [];
if (!empty($soal_ids)) {
    $placeholders = implode(',', array_fill(0, count($soal_ids), '?'));
    $stmt_read_pilihan = $pdo->prepare("SELECT * FROM pilihan_jawaban WHERE soal_id IN ($placeholders) ORDER BY id ASC");
    $stmt_read_pilihan->execute($soal_ids);
    while ($pilihan = $stmt_read_pilihan->fetch()) {
        $pilihan_list[$pilihan['soal_id']][] = $pilihan; // Kelompokkan berdasarkan soal_id
    }
}


// Muat header
$page_title = "Kelola Soal";
require_once __DIR__ . '/../partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-extrabold text-slate-800">
                    Kelola Soal untuk Kuis: "<?php echo htmlspecialchars($kuis_judul); ?>"
                </h1>
                <a href="kelola_kuis" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                    Kembali ke Daftar Kuis
                </a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200 mb-8">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Tambah Soal Baru</h2>
                
                <?php if (isset($_SESSION['pesan_sukses'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_sukses']; unset($_SESSION['pesan_sukses']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['pesan_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?></div>
                <?php endif; ?>
                
                <form action="kelola_soal?kuis_id=<?php echo $kuis_id; ?>" method="POST" class="space-y-4">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div>
                        <label for="stimulus" class="block text-sm font-medium text-slate-700 mb-1">Teks Stimulus (Opsional)</label>
                        <textarea id="stimulus" name="stimulus" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Masukkan teks bacaan jika ada..."></textarea>
                    </div>
                    
                    <div>
                        <label for="pertanyaan_teks" class="block text-sm font-medium text-slate-700 mb-1">Teks Pertanyaan (Wajib)</label>
                        <textarea id="pertanyaan_teks" name="pertanyaan_teks" rows="3" required class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Masukkan teks pertanyaan..."></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="pilihan_1" class="block text-sm font-medium text-slate-700 mb-1">Pilihan A</label>
                            <input type="text" id="pilihan_1" name="pilihan[1]" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Teks Pilihan A">
                        </div>
                         <div>
                            <label for="pilihan_2" class="block text-sm font-medium text-slate-700 mb-1">Pilihan B</label>
                            <input type="text" id="pilihan_2" name="pilihan[2]" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Teks Pilihan B">
                        </div>
                         <div>
                            <label for="pilihan_3" class="block text-sm font-medium text-slate-700 mb-1">Pilihan C</label>
                            <input type="text" id="pilihan_3" name="pilihan[3]" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Teks Pilihan C">
                        </div>
                         <div>
                            <label for="pilihan_4" class="block text-sm font-medium text-slate-700 mb-1">Pilihan D</label>
                            <input type="text" id="pilihan_4" name="pilihan[4]" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Teks Pilihan D">
                        </div>
                         <div>
                            <label for="pilihan_5" class="block text-sm font-medium text-slate-700 mb-1">Pilihan E (Opsional)</label>
                            <input type="text" id="pilihan_5" name="pilihan[5]" class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Teks Pilihan E">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="jawaban_benar" class="block text-sm font-medium text-slate-700 mb-1">Kunci Jawaban (Wajib)</Vnsul
                            <select id="jawaban_benar" name="jawaban_benar" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                                <option value="0">-- Pilih Kunci Jawaban --</option>
                                <option value="1">Pilihan A</option>
                                <option value="2">Pilihan B</option>
                                <option value="3">Pilihan C</option>
                                <option value="4">Pilihan D</option>
                                <option value="5">Pilihan E</option>
                            </select>
                        </div>
                         <div>
                            <label for="tipe_soal" class="block text-sm font-medium text-slate-700 mb-1">Tipe Soal</label>
                            <select id="tipe_soal" name="tipe_soal" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                                <option value="mcq">Pilihan Ganda (1 Jawaban Benar)</option>
                                <option value="mcma">Pilihan Ganda Kompleks (Banyak Jawaban)</option>
                            </select>
                        </div>
                    </div>

                     <div>
                        <label for="pembahasan" class="block text-sm font-medium text-slate-700 mb-1">Pembahasan (Wajib)</label>
                        <textarea id="pembahasan" name="pembahasan" rows="3" required class="w-full px-4 py-2 border border-slate-300 rounded-lg" placeholder="Masukkan teks pembahasan..."></textarea>
                    </div>

                    <button type="submit" name="tambah_soal" class="cta-gradient text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                        <i data-lucide="plus" class="w-4 h-4 inline-block -mt-1"></i> Tambah Soal
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <h2 class="text-xl font-bold text-slate-700 mb-4">Daftar Soal (<?php echo count($soal_list); ?>)</h2>
                <div class="space-y-4">
                    <?php if (empty($soal_list)): ?>
                        <p class="text-slate-500 text-center py-4">Belum ada soal untuk kuis ini. Silakan tambahkan soal baru di atas.</p>
                    <?php endif; ?>
                    
                    <?php foreach ($soal_list as $index => $soal): ?>
                        <div class="border border-slate-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="prose prose-sm max-w-none">
                                    <p class="font-semibold text-slate-800">Soal <?php echo $index + 1; ?> (ID: <?php echo $soal['id']; ?>)</p>
                                    <?php if (!empty($soal['stimulus'])): ?>
                                        <blockquote class="text-xs italic"><strong>Stimulus:</strong> <?php echo htmlspecialchars(substr($soal['stimulus'], 0, 100)); ?>...</blockquote>
                                    <?php endif; ?>
                                    <p><?php echo htmlspecialchars($soal['pertanyaan_teks']); ?></p>
                                    <ul class="text-sm">
                                        <?php if (isset($pilihan_list[$soal['id']])): ?>
                                            <?php foreach ($pilihan_list[$soal['id']] as $pilihan): ?>
                                                <li class="<?php echo $pilihan['apakah_benar'] ? 'font-bold text-green-600' : 'text-slate-600'; ?>">
                                                    <?php echo htmlspecialchars($pilihan['pilihan_teks']); ?>
                                                    <?php echo $pilihan['apakah_benar'] ? ' (Jawaban Benar)' : ''; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="flex-shrink-0 ml-4 space-x-2">
                                    <a href="soal_edit/<?php echo $soal['id']; ?>" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                    
                                    <form action="kelola_soal?kuis_id=<?php echo $kuis_id; ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus soal ini?');">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                        <input type="hidden" name="soal_id" value="<?php echo $soal['id']; ?>">
                                        <button type="submit" name="hapus_soal" class_text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    </section>
</main>

<?php
require_once __DIR__ . '/../partials/footer.php';
?>