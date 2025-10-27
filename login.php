<?php
// Memuat konfigurasi (database, session, csrf token)
require_once 'config.php';

$page_title = 'Login Admin';

// Jika sudah login, lempar ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin/dashboard.php');
    exit;
}

// Memuat header
include 'partials/header.php';
?>

<main>
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-lg">
            
            <div class="bg-white p-8 md:p-12 rounded-2xl shadow-lg border border-slate-200">
                <h2 class="text-3xl font-extrabold text-slate-800 text-center mb-6">
                    Admin Login
                </h2>

                <?php
                // Tampilkan pesan error jika ada (dari process_login.php)
                if (isset($_SESSION['login_error'])):
                ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $_SESSION['login_error']; ?></span>
                    </div>
                <?php
                    // Hapus pesan error setelah ditampilkan
                    unset($_SESSION['login_error']);
                endif;
                ?>

                <form action="process_login" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                        <input type="text" id="username" name="username" required 
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full cta-gradient text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-transform transform hover:scale-105">
                            Login
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</main>

<?php
// Memuat footer
include 'partials/footer.php';
?>