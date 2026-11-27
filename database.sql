-- ============================================================
-- DATABASE RENTAL COSPLAY (Milestone Minggu 2)
-- Cara pakai: buka phpMyAdmin -> tab "Import" -> pilih file ini
-- ============================================================
CREATE DATABASE IF NOT EXISTS rental_cosplay CHARACTER SET utf8mb4;
USE rental_cosplay;

CREATE TABLE IF NOT EXISTS users (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap   VARCHAR(100) NOT NULL,
    username       VARCHAR(50)  NOT NULL UNIQUE,
    email          VARCHAR(100) NOT NULL UNIQUE,
    password       VARCHAR(255) NOT NULL,   -- disimpan dalam bentuk hash, bukan teks asli
    remember_token VARCHAR(64)  NULL,       -- dipakai fitur "Ingat saya" (cookie)
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
