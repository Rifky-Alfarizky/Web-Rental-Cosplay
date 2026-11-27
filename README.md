# Web-Rental-Cosplay
WEB PENGELOLA RENTAL COSPLAY YANG SANGAT SAYANG SEKALI JIKA ANDA LEWATKAN, PUSING DENGAN MENGATUR SEGALA KEPERLUAN COSPLAY SEGALA MACAM???????? TENANG DI WEBSITE INI ANDA AKAN MENDAPATKAN PENGALAMAN YANG SANGAT AMAT HEBAT MANTAP LUAR BIASA, HANYA DENGAN SATU WEBSITE INI SAJA SEMUA KEBUTUHAN COSPLAY ANDA AKAN TERSEDIA SEMUA😹😹😹😹😹😹😹😹😹😹😹😹
----------------------------------------------------------------------------------------------------------------------------------------------------------------
# 🎭 CosRent - Web Rental Cosplay

Website pengelola rental kostum cosplay yang dibuat bertahap sebagai tugas mata kuliah Pemrograman Web. Website dibuat sederhana, responsif, dan mudah dipahami oleh pemula.

## Status Pengembangan

| Milestone | Isi | Status |
|---|---|---|
| Tahap 1 | Rancangan awal antarmuka (HTML, CSS, JS) | Selesai |
| Tahap 2 | Halaman login, create account, dan halaman utama (katalog kostum) | Selesai |
| Tahap 3 | Fitur penyewaan kostum | Belum dikerjakan |

## Fitur (Tahap 2)

- **Halaman utama**: banner dan katalog kostum lengkap dengan gambar, kategori, ukuran, harga sewa per hari, dan status ketersediaan.
- **Filter kategori**: Semua, Anime, Game, Fantasi, dan Tradisional.
- **Create account**: validasi input, pengecekan username dan email yang sudah terdaftar, password disimpan dalam bentuk hash.
- **Login**: memakai session, dengan opsi "Ingat saya" yang menyimpan cookie selama 30 hari agar pengguna otomatis login kembali.
- **Logout**: menghapus session, cookie, dan token di database.
- **Responsif**: tampilan menyesuaikan HP, tablet, dan desktop, termasuk menu hamburger di layar kecil.

## Teknologi

- PHP (native, dengan PDO)
- MySQL
- HTML dan CSS (Grid, Flexbox, Media Query)
- JavaScript (vanilla, tanpa library)
- Laragon sebagai web server lokal

## Struktur Folder

```
Web-Rental-Cosplay/
├── index.php              # Halaman utama dan katalog kostum
├── login.php              # Halaman login
├── register.php           # Halaman create account
├── logout.php             # Proses logout
├── database.sql           # Struktur database
├── README.md
├── config/
│   └── koneksi.php        # Koneksi database (PDO)
├── includes/
│   ├── auth.php           # Session dan pengecekan cookie "Ingat saya"
│   ├── header.php         # Bagian atas halaman + menu navigasi
│   └── footer.php         # Bagian bawah halaman
├── data/
│   └── kostum.php         # Daftar kostum (nama, harga, gambar, dll)
└── assets/
    ├── css/style.css      # Seluruh tampilan dan aturan responsif
    ├── js/script.js       # Menu HP, lihat password, filter kategori
    └── img/kostum/        # Folder gambar kostum
```

## Cara Menjalankan dengan Laragon

### 1. Siapkan proyek

Letakkan folder proyek di dalam folder `www` milik Laragon:

```bash
cd C:\laragon\www
git clone https://github.com/Rifky-Alfarizky/Web-Rental-Cosplay.git
cd Web-Rental-Cosplay
git checkout Minggu2
```

Kalau tidak memakai Git, unduh proyek sebagai ZIP, ekstrak, lalu salin foldernya ke `C:\laragon\www\`.

### 2. Nyalakan server

Buka Laragon, lalu klik **Start All**. Pastikan Apache dan MySQL berstatus berjalan.

### 3. Impor database

Pilih salah satu cara:

**Lewat terminal Laragon** (klik tombol *Terminal*, masuk ke folder proyek):

```bash
mysql -u root < database.sql
```

**Lewat HeidiSQL** (klik tombol *Database* di Laragon):
1. Buka koneksi ke MySQL.
2. Pilih menu **File → Run SQL file...**
3. Pilih file `database.sql`, lalu jalankan.

Perintah ini akan membuat database `rental_cosplay` beserta tabel `users`.

### 4. Buka website

- `http://localhost/Web-Rental-Cosplay/`
- atau `http://web-rental-cosplay.test` jika fitur *Auto virtual hosts* Laragon aktif.

Belum ada akun bawaan. Buka halaman **Daftar** untuk membuat akun, lalu login.

### Pengaturan koneksi database

Pengaturan bawaan Laragon sudah sesuai dengan isi `config/koneksi.php`:

| Pengaturan | Nilai |
|---|---|
| Host | `localhost` |
| Database | `rental_cosplay` |
| User | `root` |
| Password | (kosong) |

Kalau password MySQL di komputermu berbeda, ubah nilai `$dbpass` di `config/koneksi.php`.

## Cara Mengganti Gambar Kostum

1. Simpan foto kostum di folder `assets/img/kostum/`.
2. Buka `data/kostum.php`.
3. Ubah nilai `'gambar'` sesuai nama file, misalnya `'gambar' => 'ninja.jpg'`.

Di file yang sama kamu juga bisa mengubah nama, kategori, ukuran, harga, dan status ketersediaan kostum, atau menambah kostum baru dengan menyalin satu blok data.

## Alur Kerja Login dan Cookie

1. Pengguna mengisi username dan password di `login.php`.
2. PHP mencari username di tabel `users`, lalu mencocokkan password dengan hash menggunakan `password_verify()`.
3. Jika cocok, data pengguna disimpan di **session**.
4. Jika "Ingat saya" dicentang, dibuat token acak. Hash token disimpan di database, dan token dikirim ke browser sebagai **cookie** `remember_me` yang berlaku 30 hari.
5. Setiap halaman memanggil `includes/auth.php`. File ini mengecek cookie dan melakukan login otomatis jika tokennya cocok dengan database.
6. Saat logout, session, cookie, dan token di database dihapus.

## Struktur Database

Tabel `users`:

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | INT (auto increment) | Primary key |
| nama_lengkap | VARCHAR(100) | Nama pengguna |
| username | VARCHAR(50) | Unik |
| email | VARCHAR(100) | Unik |
| password | VARCHAR(255) | Password dalam bentuk hash |
| remember_token | VARCHAR(64) | Hash token fitur "Ingat saya" |
| created_at | TIMESTAMP | Waktu akun dibuat |

## Alur Branch

- `master`: branch utama, hanya berisi dokumentasi (README).
- `Minggu1`: pengerjaan milestone Tahap 1.
- `Minggu2`: pengerjaan milestone Tahap 2 (branch ini).
- `chore`: pembaruan dokumentasi.

## Pengembang

Rifky Alfarizky
