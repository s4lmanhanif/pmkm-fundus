# Gestational Fundus (Laravel)

Refaktor dari aplikasi PHP lama menjadi proyek Laravel 11 dengan Blade + Bootstrap. Fitur utama:
- Login admin sederhana.
- Pencarian/CRUD data ibu dan kehamilan (etnis, paritas, tinggi/berat, EDD, kelamin janin).
- Input riwayat pengukuran tinggi fundus.
- Grafik pertumbuhan janin (GA 24-42 minggu) menggunakan pChart dengan penyesuaian populasi dan faktor ibu/janin.

## Menjalankan
1) Pastikan PHP 8.2+, ekstensi GD aktif, Composer, dan MySQL tersedia.
2) Masuk ke folder `laravel-app` lalu jalankan:
```
composer install --no-dev
```
3) Salin/atur `.env` (sudah diisi ke database `gestation`, user `root` tanpa password). Sesuaikan jika perlu.
4) Migrasi tabel:
```
php artisan migrate
```
Jika ingin contoh struktur awal, file `schema.sql` lama masih ada di akar repo.
5) Jalankan server:
```
php artisan serve
```
6) Login: credensial default ada di `.env` (`ADMIN_USER`/`ADMIN_PASSWORD`, bawaan `admin/admin`).

## Catatan Teknis
- Grafik dihasilkan lewat `App\Services\FundusChartService` dengan library pChart yang disalin ke `public/pChart`.
- Session driver diset ke `file` untuk menghindari kebutuhan tabel sesi.
- Model/tabel mempertahankan nama lama: `mother`, `embrio`, `measurement`.
- UI menggunakan Bootstrap 5; template utama di `resources/views/patients/index.blade.php`.
