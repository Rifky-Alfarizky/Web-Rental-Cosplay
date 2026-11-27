<?php
// ============================================================
// HALAMAN LOGIN
// Alur: user isi form -> PHP cek ke database -> buat SESSION
//       -> kalau "Ingat saya" dicentang, buat COOKIE juga
// ============================================================
require_once 'includes/auth.php';

// Kalau sudah login, tidak perlu lihat halaman login lagi
if (sudah_login()) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $ingat    = isset($_POST['ingat']);

    // 1. Cari user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // 2. Cocokkan password dengan hash di database
    if ($user && password_verify($password, $user['password'])) {

        // 3. Simpan data ke SESSION (ingatan sementara di server)
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama_lengkap'];

        // 4. Kalau "Ingat saya" dicentang -> buat COOKIE (ingatan di browser, 30 hari)
        if ($ingat) {
            $token = bin2hex(random_bytes(32));   // token acak
            $upd = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
            $upd->execute([hash('sha256', $token), $user['id']]);

            setcookie('remember_me', $user['id'] . ':' . $token, [
                'expires'  => time() + (30 * 24 * 60 * 60),
                'path'     => '/',
                'httponly' => true,       // tidak bisa dibaca JavaScript (lebih aman)
                'samesite' => 'Lax',
            ]);
        }

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}

$sukses = isset($_GET['daftar']) ? "Akun berhasil dibuat! Silakan login." : "";
$judul_halaman = "Login";
include 'includes/header.php';
?>

<main class="halaman-form">
    <div class="kartu-form">
        <h1>Selamat Datang 👋</h1>
        <p class="sub">Login untuk mulai menyewa kostum.</p>

        <?php if ($sukses): ?><div class="alert alert-sukses"><?= e($sukses) ?></div><?php endif; ?>
        <?php if ($error):  ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

        <form method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required
                   value="<?= e($_POST['username'] ?? '') ?>">

            <label for="password">Password</label>
            <div class="kolom-password">
                <input type="password" id="password" name="password" required>
                <button type="button" class="lihat-password" data-target="password">Lihat</button>
            </div>

            <label class="centang">
                <input type="checkbox" name="ingat"> Ingat saya (30 hari)
            </label>

            <button type="submit" class="btn btn-penuh">Login</button>
        </form>

        <p class="link-bawah">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
