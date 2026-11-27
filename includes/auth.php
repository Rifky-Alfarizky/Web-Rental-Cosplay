<?php
// ============================================================
// FILE INI DIPANGGIL DI SEMUA HALAMAN
// Tugasnya: 1) menyalakan SESSION
//           2) cek COOKIE "ingat saya" supaya user otomatis login
// ============================================================
session_start();
require_once __DIR__ . '/../config/koneksi.php';

// Fungsi bantu: apakah user sedang login?
function sudah_login() {
    return isset($_SESSION['user_id']);
}

// Fungsi bantu: mengamankan teks sebelum ditampilkan di HTML
function e($teks) {
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

// ---- Cek cookie "remember_me" ----
// Isi cookie formatnya:  idUser:tokenAcak
if (!sudah_login() && isset($_COOKIE['remember_me'])) {
    $bagian = explode(':', $_COOKIE['remember_me']);

    if (count($bagian) === 2) {
        $id    = (int) $bagian[0];
        $token = $bagian[1];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        // Token di database disimpan dalam bentuk hash, jadi dibandingkan dengan hash juga
        if ($user && $user['remember_token'] && hash_equals($user['remember_token'], hash('sha256', $token))) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama']    = $user['nama_lengkap'];
        } else {
            // Cookie tidak valid -> hapus
            setcookie('remember_me', '', time() - 3600, '/');
        }
    }
}
