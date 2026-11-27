<?php
// ============================================================
// KONEKSI DATABASE
// Kalau pakai XAMPP, biasanya pengaturan di bawah sudah benar.
// ============================================================
$host   = "localhost";
$dbname = "rental_cosplay";
$dbuser = "root";
$dbpass = "";          // XAMPP default: kosong

try {
    // PDO = cara PHP terhubung ke MySQL dengan aman
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
