<?php
// ============================================================
// HALAMAN CREATE ACCOUNT (DAFTAR)
// Alur: validasi input -> cek username/email belum dipakai
//       -> password di-hash -> simpan ke database
// ============================================================
require_once 'includes/auth.php';

if (sudah_login()) {
    header("Location: index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama_lengkap'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $konfirm  = $_POST['konfirmasi'] ?? '';

    // ---- Validasi ----
    if ($nama === '' || $username === '' || $email === '' || $password === '') {
        $errors[] = "Semua kolom wajib diisi.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
    if (!preg_match('/^[A-Za-z0-9_]{4,20}$/', $username)) {
        $errors[] = "Username 4-20 karakter (huruf, angka, atau underscore).";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter.";
    }
    if ($password !== $konfirm) {
        $errors[] = "Konfirmasi password tidak sama.";
    }

    // ---- Cek username / email sudah dipakai atau belum ----
    if (empty($errors)) {
        $cek = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $cek->execute([$username, $email]);
        if ($cek->fetch()) {
            $errors[] = "Username atau email sudah terdaftar.";
        }
    }

    // ---- Simpan ke database ----
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT); // password diacak, tidak disimpan asli
        $simpan = $pdo->prepare(
            "INSERT INTO users (nama_lengkap, username, email, password) VALUES (?, ?, ?, ?)"
        );
        $simpan->execute([$nama, $username, $email, $hash]);

        header("Location: login.php?daftar=berhasil");
        exit;
    }
}

$judul_halaman = "Buat Akun";
include 'includes/header.php';
?>

<main class="halaman-form">
    <div class="kartu-form">
        <h1>Buat Akun Baru ✨</h1>
        <p class="sub">Gratis dan cuma butuh satu menit.</p>

        <?php foreach ($errors as $pesan): ?>
            <div class="alert alert-error"><?= e($pesan) ?></div>
        <?php endforeach; ?>

        <form method="post">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" required
                   value="<?= e($_POST['nama_lengkap'] ?? '') ?>">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required
                   value="<?= e($_POST['username'] ?? '') ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required
                   value="<?= e($_POST['email'] ?? '') ?>">

            <label for="password">Password</label>
            <div class="kolom-password">
                <input type="password" id="password" name="password" required>
                <button type="button" class="lihat-password" data-target="password">Lihat</button>
            </div>

            <label for="konfirmasi">Ulangi Password</label>
            <div class="kolom-password">
                <input type="password" id="konfirmasi" name="konfirmasi" required>
                <button type="button" class="lihat-password" data-target="konfirmasi">Lihat</button>
            </div>

            <button type="submit" class="btn btn-penuh">Daftar</button>
        </form>

        <p class="link-bawah">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
