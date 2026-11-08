# 📋 Task Planning: Pembuatan Akun Super Admin Filament

## 📌 Ringkasan Tugas
Buat dan masukkan data akun **Super Admin** ke tabel `users` agar dapat login dan mengakses dashboard admin panel **Filament** (`/admin`).

Dokumen ini disusun sebagai panduan langkah-demi-langkah bagi programmer atau model AI untuk mengimplementasikan fitur ini secara aman, dapat diulang (*idempotent*), dan terintegrasi dengan sistem otorisasi (Filament & Spatie Permission).

---

## 👤 Detail Kredensial Super Admin

| Field | Nilai | Keterangan |
|---|---|---|
| **Name** | `muhammad` | Nama lengkap pengguna |
| **Email** | `admin@gmail.com` | Email login (harus unik) |
| **Password** | `123456` | Wajib di-hash menggunakan `Hash::make()` / `bcrypt` |
| **Role** | `admin` | Role Spatie Permission untuk hak akses panel admin |
| **Email Verified At** | `now()` | Otomatis terverifikasi |

---

## 🔑 Prasyarat Sistem Otorisasi Filament

Pada project ini, akses ke panel Filament dilindungi oleh method `canAccessPanel()` di model `User` (`app/Models/User.php`):
```php
public function canAccessPanel(Panel $panel): bool
{
    return $this->hasRole('admin') || $this->hasPermissionTo('access-admin');
}
```
> ⚠️ **Penting:** Selain memasukkan data ke tabel `users`, akun ini **wajib** diberikan role `admin` atau permission `access-admin` agar Filament mengizinkan akun ini masuk ke dashboard `/admin`.

---

## 🚀 Tahapan Implementasi (Pilihan Metode)

Terdapat 3 cara untuk mengimplementasikan tugas ini. **Metode 1 (Database Seeder) sangat direkomendasikan** agar akun otomatis terbuat saat deployment atau migrasi database.

---

### METODE 1: Menggunakan Database Seeder (Direkomendasikan) 🌟

Metode ini memastikan data selalu konsisten dan bisa dijalankan ulang kapan saja (*idempotent*).

#### Langkah 1: Buat atau Perbarui Seeder
Buka file seeder admin di `database/seeders/AdminUserSeeder.php` (atau buat baru jika belum ada):
```bash
php artisan make:seeder AdminUserSeeder
```

#### Langkah 2: Tulis Logika Seeding
Isi `database/seeders/AdminUserSeeder.php` dengan kode berikut:
```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan role 'admin' sudah tersedia
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // 2. Buat atau perbarui akun Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'muhammad',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Assign role 'admin' ke user
        $superAdmin->syncRoles([$adminRole]);
    }
}
```

#### Langkah 3: Daftarkan ke `DatabaseSeeder.php`
Pastikan `AdminUserSeeder` dipanggil di `database/seeders/DatabaseSeeder.php`:
```php
$this->call([
    RoleAndPermissionSeeder::class,
    AdminUserSeeder::class,
]);
```

#### Langkah 4: Jalankan Seeder
Eksekusi seeder melalui terminal:
```bash
php artisan db:seed --class=AdminUserSeeder
```
Atau jika ingin refresh seluruh database beserta seed:
```bash
php artisan migrate:fresh --seed
```

---

### METODE 2: Menggunakan Artisan Command Filament

Filament menyediakan command bawaan untuk membuat user admin secara interaktif:

```bash
php artisan make:filament-user
```
**Input yang harus diisi saat prompt muncul:**
1. **Name:** `muhammad`
2. **Email address:** `admin@gmail.com`
3. **Password:** `123456`

Setelah user dibuat, berikan role `admin` via Artisan command Spatie:
```bash
php artisan permission:assign-role "admin" "admin@gmail.com"
```

---

### METODE 3: Menggunakan Laravel Tinker (Manual via CLI)

Jika ingin membuat akun secara langsung tanpa mengubah file kode:

1. Buka Tinker di terminal:
   ```bash
   php artisan tinker
   ```
2. Jalankan perintah PHP berikut:
   ```php
   $user = \App\Models\User::updateOrCreate(
       ['email' => 'admin@gmail.com'],
       [
           'name' => 'muhammad',
           'password' => \Illuminate\Support\Facades\Hash::make('123456'),
           'email_verified_at' => now(),
       ]
   );

   $user->assignRole('admin');
   ```
3. Ketik `exit` untuk keluar dari Tinker.

---

## ✅ Tahap Verifikasi & Pengujian

Setelah salah satu metode di atas selesai dijalankan, lakukan verifikasi:

1. [x] **Verifikasi Database:**
   User tersimpan di tabel `users` dengan password yang ter-hash, email terverifikasi, dan role `admin` terhubung di `model_has_roles`.

2. [x] **Verifikasi Akses Login Filament Web:**
   Akun dapat login ke dashboard Filament `/admin` menggunakan kredensial:
   - **Email:** `admin@gmail.com`
   - **Password:** `123456`

3. [x] **Verifikasi Automated Test:**
   Automated test `FilamentPanelAccessTest` mencakup pengujian akun super admin ini dan lulus 100%:
   ```bash
   php artisan test --filter=FilamentPanelAccessTest
   ```

---

## ⚠️ Checklist Implementor
- [x] Password **TIDAK** disimpan dalam bentuk plain text (`123456`), melainkan di-hash dengan `Hash::make('123456')`.
- [x] Menggunakan `updateOrCreate` agar seeder aman dijalankan berulang kali tanpa error duplikasi email.
- [x] Role `admin` terhubung ke user tersebut di tabel pivot `model_has_roles`.
