# Laravel Lelo — Sistem Informasi Lelang (Auction System)

Aplikasi web berbasis **Laravel** untuk mengelola proses lelang barang secara digital, mulai dari pendataan produk, penjadwalan sesi lelang, pengajuan penawaran (bid) oleh peserta, hingga pembuatan laporan hasil lelang.

## Deskripsi

Laravel Lelo adalah sistem lelang online dengan tiga peran pengguna:

| Peran | Tanggung Jawab |
| --- | --- |
| **Admin** | Mengelola akun admin, petugas lelang (officer), dan peserta lelang (bidder) |
| **Officer** | Mengelola produk & kategori, membuat sesi lelang, memverifikasi bid, serta menyusun laporan |
| **Bidder** | Melihat daftar lelang yang tersedia, mengajukan penawaran, dan melihat riwayat bid |

Setiap penawaran yang masuk dicatat beserta statusnya, dan sesi lelang yang selesai akan tersimpan pada riwayat lelang untuk keperluan pelaporan.

## Fitur Utama

- **Autentikasi & Otorisasi** — login multi-role (admin, officer, bidder) dengan middleware pengecekan level.
- **Manajemen Produk** — CRUD produk lelang beserta gambar dan kategori.
- **Manajemen Kategori** — pengelompokan produk lelang.
- **Manajemen Sesi Lelang** — pembukaan, penjadwalan, dan penutupan sesi lelang.
- **Penawaran (Bidding)** — peserta mengajukan harga, petugas memverifikasi status bid.
- **Riwayat Lelang** — pencatatan otomatis hasil lelang yang telah selesai.
- **Laporan** — laporan lelang & riwayat, lengkap dengan ekspor (CSV/Excel).
- **Manajemen Pengguna** — pengelolaan akun admin, officer, dan bidder.
- **Dashboard** — ringkasan aktivitas untuk masing-masing peran.

## Teknologi

- **PHP 8.3** & **Laravel 13**
- Laravel Jetstream + Fortify (autentikasi, profil, 2FA)
- Laravel Passport & Sanctum (API token)
- Blade Template, Bootstrap / Material Dashboard, AdminLTE
- Vite (asset bundling)
- PHPUnit (pengujian)

## Skema Data Utama

- `users`, `roles`, `role_user` — pengguna dan peran
- `tb_officers` — data petugas lelang
- `categories` — kategori produk
- `products` — produk/barang lelang
- `biddings` — penawaran yang diajukan
- `bidders` — data peserta lelang
- `auctions` & `auction_histories` — sesi lelang dan riwayat hasilnya

## Instalasi

```bash
# 1. Clone repository
git clone https://github.com/Tqim88/Laravel-lelo.git
cd Laravel-lelo

# 2. Install dependency
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 4. Sesuaikan kredensial database pada .env, lalu jalankan migrasi
php artisan migrate --seed

# 5. Build asset & jalankan aplikasi
npm run build
php artisan serve
```

Aplikasi dapat diakses pada `http://localhost:8000`.

## Struktur Direktori Penting

```
app/
├── Http/Controllers/   # Admin, Officer, Product, Auction, Bid, Report, dll.
├── Http/Middleware/    # CekLevel (otorisasi berbasis peran)
└── Models/             # Product, Auction, bidding, bidder, category, dll.
database/migrations/    # Skema tabel lelang
resources/views/        # Tampilan Blade per modul
routes/web.php          # Definisi seluruh route & pengelompokan middleware
```

## Lisensi

Proyek ini dibuat untuk keperluan pembelajaran/pengembangan sistem lelang.
