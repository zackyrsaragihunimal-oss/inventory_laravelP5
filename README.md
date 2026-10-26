# Inventory Management System — Laravel 11

Aplikasi ini adalah implementasi ulang proyek P4 Inventory Management System dari PHP native ke Laravel. Fitur utama dipertahankan: dashboard, CRUD produk/kategori/pemasok, pencarian dan filter produk, transaksi stok masuk/keluar, riwayat pergerakan stok, laporan, login, dan role admin/staff.

## Persyaratan
- PHP 8.2+ dan ekstensi PHP yang dibutuhkan Laravel (`openssl`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, `bcmath` disarankan).
- Composer 2+
- MySQL/MariaDB melalui XAMPP

## Instalasi Windows + XAMPP
1. Ekstrak ZIP, lalu pindahkan folder `inventory-laravel` ke `C:\xamp\htdocs\inventory-laravel` (atau lokasi kerja pilihan).
2. Buka terminal pada folder proyek.
3. Jalankan `composer install` untuk mengunduh dependensi Laravel. Folder `vendor` memang tidak disertakan di ZIP.
4. Salin `.env.example` menjadi `.env`.
5. Buat database kosong bernama `inventory_app` melalui phpMyAdmin.
6. Pastikan `.env` berisi `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=inventory_app`, `DB_USERNAME=root`, dan `DB_PASSWORD=` (sesuaikan bila MySQL Anda memakai password).
7. Jalankan `php artisan key:generate`.
8. Jalankan `php artisan migrate --seed`.
9. Jalankan `php artisan serve`.
10. Buka `http://127.0.0.1:8000`.

> Jangan mengimpor `database.sql` P4 ke database Laravel yang sama sebelum migrasi. Laravel membuat struktur melalui migration dan data awal melalui seeder. Jika ingin mempertahankan data produksi P4, ekspor data terlebih dahulu dan lakukan proses pemetaan/import terpisah setelah skema Laravel diverifikasi.

## Akun demo
Seeder membuat akun demo berikut:
- Admin: username `admin`, password `Admin12345!`
- Staff: username `staff`, password `Staff12345!`

Ganti kredensial demo sebelum aplikasi dipakai di lingkungan nyata.

## Fitur dan implementasi MVC
- **Model / Eloquent:** `Product`, `Category`, `Supplier`, `StockMovement`, `User`; relasi produk-kategori, produk-pemasok (many-to-many), dan riwayat stok.
- **Controller:** validasi request dan logika bisnis dipisahkan dari tampilan.
- **View / Blade:** layout konsisten dan template halaman per fitur.
- **Routing:** resource routes untuk CRUD produk/kategori/pemasok; route khusus untuk login, dashboard, stok, laporan, dan pengguna.
- **Migration & Seeder:** skema database terkontrol dan data demo yang dapat dibuat ulang.
- **Validasi & keamanan:** CSRF pada form, hash password, middleware auth/admin, validasi server, pembatasan stok keluar, dan proteksi penghapusan data yang masih memiliki relasi.
- **Pencarian:** pencarian produk berdasarkan nama/SKU, filter kategori, sorting, dan pagination.

## Alur demo yang disarankan
1. Login sebagai admin.
2. Tunjukkan dashboard dan ringkasan stok.
3. Tambahkan kategori atau pemasok.
4. Tambahkan produk, lalu demonstrasikan pencarian/filter/sorting.
5. Catat transaksi stok masuk, lalu stok keluar. Coba jumlah keluar melebihi stok untuk memperlihatkan validasi.
6. Buka detail produk untuk melihat riwayat stok.
7. Tunjukkan laporan persediaan.
8. Logout, login sebagai staff, dan tunjukkan bahwa menu master data/admin tidak ditampilkan.

## Pemeriksaan
Setelah `composer install`, jalankan:
- `php artisan route:list`
- `php artisan migrate:fresh --seed` (PERINGATAN: menghapus seluruh tabel/data pada database yang dikonfigurasi; hanya gunakan untuk database pengujian)
- `php artisan test`

Uji manual tetap diperlukan di lingkungan lokal untuk memastikan konfigurasi PHP/MySQL cocok. ZIP ini tidak menyertakan `vendor`, `.env`, cache, atau rahasia konfigurasi.
