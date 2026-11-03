# 🚀 Project Setup & Planning

## Overview
Buat project Laravel baru di folder ini dengan admin panel (Filament), authentication API (Sanctum), role-based access control (Spatie Permission), dan file storage (Local/S3). Database menggunakan MySQL.

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 13 (latest) |
| Admin Panel | Filament v5 |
| API Auth | Laravel Sanctum v4 |
| Roles & Permissions | Spatie Laravel-Permission v8 |
| File Storage | Laravel Storage (Local + S3 ready) |
| Database | MySQL |

---

## Phase 1: Project Initialization

- [x] Install Laravel project baru (latest version)
- [x] Setup `.env` dengan konfigurasi MySQL (database, user, password)
- [x] Jalankan initial migration untuk memastikan koneksi DB berjalan

## Phase 2: Package Installation

- [x] Install & setup **Filament** (admin panel)
  - Publish config & assets
  - Buat admin user
- [x] Install & setup **Laravel Sanctum**
  - Publish config
  - Jalankan migration Sanctum
  - Setup middleware di `api` route
- [x] Install & setup **Spatie Laravel-Permission**
  - Publish config & migration
  - Jalankan migration
  - Register middleware (`role`, `permission`)
- [x] Konfigurasi **Laravel Storage**
  - Setup disk `local` dan `s3` di `config/filesystems.php`
  - Buat symbolic link (`php artisan storage:link`)

## Phase 3: Authentication & Authorization

- [x] Setup User model dengan Sanctum traits (`HasApiTokens`) dan Spatie traits (`HasRoles`)
- [x] Buat **Seeder** untuk roles & permissions dasar (misal: `admin`, `user`)
- [x] Buat **Seeder** untuk admin user default
- [x] Buat API auth routes: `register`, `login`, `logout`, `me`
- [x] Integrasikan Filament dengan Spatie Permission (resource untuk manage roles/permissions)

## Phase 4: File Storage Setup

- [x] Buat helper/service untuk upload file (support local & S3)
- [x] Tambahkan konfigurasi S3 di `.env.example`
- [x] Test upload & retrieve file via local disk

## Phase 5: Finalisasi

- [x] Buat `DatabaseSeeder` yang menjalankan semua seeder
- [x] Pastikan `php artisan migrate --seed` berjalan tanpa error
- [x] Update `README.md` dengan instruksi setup project
- [x] Test akses Filament admin panel
- [x] Test API auth endpoints via Sanctum

---

## Notes

- Semua konfigurasi sensitif (DB credentials, S3 keys) sudah di `.env`, bukan hardcode.
- `.env.example` sudah disesuaikan dan up-to-date.
- Test suite otomatis (`php artisan test`) mencakup 14 feature tests yang lulus 100%.

