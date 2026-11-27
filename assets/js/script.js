// ============================================================
// SCRIPT.JS - JavaScript sederhana untuk interaksi halaman
// ============================================================

// 1) Tombol hamburger (menu di HP)
const tombolMenu = document.getElementById('tombolMenu');
const menu = document.getElementById('menu');
if (tombolMenu) {
    tombolMenu.addEventListener('click', function () {
        menu.classList.toggle('buka');   // tambah/hapus class "buka"
    });
}

// 2) Tombol "Lihat" untuk menampilkan / menyembunyikan password
document.querySelectorAll('.lihat-password').forEach(function (tombol) {
    tombol.addEventListener('click', function () {
        const input = document.getElementById(tombol.dataset.target);
        if (input.type === 'password') {
            input.type = 'text';
            tombol.textContent = 'Sembunyi';
        } else {
            input.type = 'password';
            tombol.textContent = 'Lihat';
        }
    });
});

// 3) Filter kategori kostum di halaman utama
const tombolFilter = document.querySelectorAll('.filter-btn');
const semuaKartu = document.querySelectorAll('.kartu');

tombolFilter.forEach(function (tombol) {
    tombol.addEventListener('click', function () {
        // Ubah tombol yang aktif
        tombolFilter.forEach(function (t) { t.classList.remove('aktif'); });
        tombol.classList.add('aktif');

        // Tampilkan kartu yang kategorinya cocok
        const pilihan = tombol.dataset.kategori;
        semuaKartu.forEach(function (kartu) {
            if (pilihan === 'Semua' || kartu.dataset.kategori === pilihan) {
                kartu.style.display = 'block';
            } else {
                kartu.style.display = 'none';
            }
        });
    });
});
