<?php
// ============================================================
// DAFTAR KOSTUM  (di sinilah tempat mengubah isi katalog!)
//
// CARA MENGGANTI GAMBAR KOSTUM:
//  1. Simpan foto kostum kamu di folder:  assets/img/kostum/
//  2. Ubah isi 'gambar' di bawah dengan nama file foto kamu
//     contoh:  'gambar' => 'foto-ninja.jpg'
//
// CARA MENAMBAH KOSTUM: salin satu blok [ ... ], lalu tempel di bawahnya.
// Untuk minggu ini data memakai array agar sederhana.
// Minggu depan bisa dipindah ke database.
// ============================================================
$daftar_kostum = [
    [
        'nama'     => 'Ninja Shadow',
        'kategori' => 'Anime',
        'ukuran'   => 'M, L',
        'harga'    => 75000,          // harga per hari (Rupiah)
        'tersedia' => true,
        'gambar'   => 'kostum1.svg',  // <-- ganti nama file gambar di sini
    ],
    [
        'nama'     => 'Maid Cafe Classic',
        'kategori' => 'Anime',
        'ukuran'   => 'S, M',
        'harga'    => 60000,
        'tersedia' => true,
        'gambar'   => 'kostum2.svg',
    ],
    [
        'nama'     => 'Sailor School Uniform',
        'kategori' => 'Anime',
        'ukuran'   => 'S, M, L',
        'harga'    => 55000,
        'tersedia' => false,
        'gambar'   => 'kostum3.svg',
    ],
    [
        'nama'     => 'Knight Silver Armor',
        'kategori' => 'Fantasi',
        'ukuran'   => 'L, XL',
        'harga'    => 120000,
        'tersedia' => true,
        'gambar'   => 'kostum4.svg',
    ],
    [
        'nama'     => 'Witch Magician',
        'kategori' => 'Fantasi',
        'ukuran'   => 'S, M, L',
        'harga'    => 80000,
        'tersedia' => true,
        'gambar'   => 'kostum5.svg',
    ],
    [
        'nama'     => 'Vampire Prince',
        'kategori' => 'Fantasi',
        'ukuran'   => 'M, L',
        'harga'    => 90000,
        'tersedia' => true,
        'gambar'   => 'kostum6.svg',
    ],
    [
        'nama'     => 'Kebaya Pahlawan',
        'kategori' => 'Tradisional',
        'ukuran'   => 'S, M, L',
        'harga'    => 70000,
        'tersedia' => true,
        'gambar'   => 'kostum7.svg',
    ],
    [
        'nama'     => 'Pixel Hero Gamer',
        'kategori' => 'Game',
        'ukuran'   => 'M, L, XL',
        'harga'    => 85000,
        'tersedia' => false,
        'gambar'   => 'kostum8.svg',
    ],
];
