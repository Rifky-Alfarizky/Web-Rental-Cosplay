<?php
// Header + menu navigasi (dipakai di semua halaman)
// Variabel $judul_halaman diisi dari tiap halaman
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Baris di bawah WAJIB agar tampilan responsif di HP -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($judul_halaman ?? 'Rental Cosplay') ?> | CosRent</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="navbar">
    <div class="container nav-isi">
        <a href="index.php" class="logo">🎭 CosRent</a>

        <!-- Tombol hamburger (muncul di HP saja) -->
        <button class="tombol-menu" id="tombolMenu" aria-label="Buka menu">☰</button>

        <nav class="menu" id="menu">
            <a href="index.php">Beranda</a>
            <a href="index.php#katalog">Katalog Kostum</a>

            <?php if (sudah_login()): ?>
                <span class="sapaan">Halo, <?= e($_SESSION['nama']) ?></span>
                <a href="logout.php" class="btn btn-garis">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-garis">Login</a>
                <a href="register.php" class="btn">Daftar</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
