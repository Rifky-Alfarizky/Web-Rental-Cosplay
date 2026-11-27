<?php
// ============================================================
// HALAMAN UTAMA (MENU AWAL)
// Menampilkan katalog kostum dari file data/kostum.php
// ============================================================
require_once 'includes/auth.php';
require_once 'data/kostum.php';

$judul_halaman = "Beranda";
include 'includes/header.php';
?>

<!-- ===== Bagian banner atas ===== -->
<section class="hero">
    <div class="container">
        <h1>Sewa Kostum Cosplay Impianmu 🎭</h1>
        <p>Pilih kostum favorit, sewa harian, tampil percaya diri di event berikutnya.</p>
        <?php if (!sudah_login()): ?>
            <a href="register.php" class="btn btn-besar">Mulai Sekarang</a>
        <?php else: ?>
            <a href="#katalog" class="btn btn-besar">Lihat Katalog</a>
        <?php endif; ?>
    </div>
</section>

<!-- ===== Katalog kostum ===== -->
<section class="container katalog" id="katalog">
    <h2>Katalog Kostum</h2>

    <!-- Tombol filter kategori (diatur oleh assets/js/script.js) -->
    <div class="filter">
        <button class="filter-btn aktif" data-kategori="Semua">Semua</button>
        <button class="filter-btn" data-kategori="Anime">Anime</button>
        <button class="filter-btn" data-kategori="Game">Game</button>
        <button class="filter-btn" data-kategori="Fantasi">Fantasi</button>
        <button class="filter-btn" data-kategori="Tradisional">Tradisional</button>
    </div>

    <div class="grid">
        <?php foreach ($daftar_kostum as $k): ?>
            <!-- Satu kartu = satu kostum. Diulang otomatis oleh foreach -->
            <article class="kartu" data-kategori="<?= e($k['kategori']) ?>">
                <!-- Gambar diambil dari folder assets/img/kostum/ -->
                <img src="assets/img/kostum/<?= e($k['gambar']) ?>" alt="<?= e($k['nama']) ?>">

                <div class="kartu-isi">
                    <span class="label"><?= e($k['kategori']) ?></span>
                    <h3><?= e($k['nama']) ?></h3>
                    <p class="info">Ukuran: <?= e($k['ukuran']) ?></p>
                    <p class="harga">Rp <?= number_format($k['harga'], 0, ',', '.') ?> <small>/ hari</small></p>

                    <?php if ($k['tersedia']): ?>
                        <span class="status ada">Tersedia</span>
                    <?php else: ?>
                        <span class="status habis">Sedang disewa</span>
                    <?php endif; ?>

                    <?php if ($k['tersedia']): ?>
                        <!-- Fitur sewa dibuat di milestone berikutnya -->
                        <a href="<?= sudah_login() ? '#' : 'login.php' ?>" class="btn btn-penuh">Sewa</a>
                    <?php else: ?>
                        <button class="btn btn-penuh btn-mati" disabled>Tidak tersedia</button>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
