# VibeCoding - Laravel + Filament + Sanctum + Spatie Permission + S3

Full-stack Laravel project with **Filament v5** Admin Panel, **Laravel Sanctum** API Authentication, **Spatie Laravel-Permission** Role-Based Access Control (RBAC), and **Local / AWS S3** File Storage.

---

## 🛠 Tech Stack

- **Framework:** Laravel 13 (PHP 8.3+)
- **Database:** MySQL / MariaDB
- **Admin Panel:** Filament v5
- **API Authentication:** Laravel Sanctum v4
- **Roles & Permissions:** Spatie Laravel-Permission v8
- **File Storage:** Laravel Storage (Local + AWS S3 / MinIO compatible)

---

## 🚀 Quick Setup & Installation

### 1. Clone & Dependencies
```bash
git clone https://github.com/muhammadcareer2022/Vibe-Coding.git
cd VibeCoding
composer install
```

### 2. Environment Configuration
Copy `.env.example` to `.env` and generate app key:
```bash
cp .env.example .env
php artisan key:generate
```

Pastikan konfigurasi MySQL di `.env` sudah sesuai:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vibe_coding
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migration & Seeder
Jalankan migrasi database beserta seeder bawaan:
```bash
php artisan migrate --seed
```

Seeder akan membuat:
- **Permissions:** `access-admin`, `manage-users`, `manage-roles`, `upload-files`, `view-files`
- **Roles:**
  - `admin` (semua permissions)
  - `user` (`upload-files`, `view-files`)
- **Default Accounts:**
  - **Super Admin:** `admin@example.com` / `password` (akses Filament `/admin`)
  - **Demo User:** `user@example.com` / `password`

### 4. Storage Link
Hubungkan storage disk publik:
```bash
php artisan storage:link
```

### 5. Jalankan Aplikasi
```bash
php artisan serve
```
- Web / Home: `http://localhost:8000`
- Filament Admin Panel: `http://localhost:8000/admin`

---

## 📡 API Endpoints

### Authentication (Sanctum)
| Method | Endpoint | Description | Auth Required |
|---|---|---|---|
| `POST` | `/api/auth/register` | Register new user (default role: `user`) | No |
| `POST` | `/api/auth/login` | Login and receive Bearer token | No |
| `GET` | `/api/auth/me` | Get current authenticated user + roles & permissions | Bearer Token |
| `POST` | `/api/auth/logout` | Revoke current access token | Bearer Token |

### File Storage API
| Method | Endpoint | Description | Auth Required |
|---|---|---|---|
| `POST` | `/api/files/upload` | Upload file (`file`, `disk: local\|public\|s3`, `directory`) | Bearer Token (`upload-files` permission) |

---

## ☁️ AWS S3 / MinIO Storage Configuration

Untuk menggunakan S3 / MinIO, isi variabel berikut di `.env`:
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
AWS_ENDPOINT=https://your-s3-or-minio-endpoint.com # Opsional untuk MinIO / Cloudflare R2
AWS_USE_PATH_STYLE_ENDPOINT=false
```

---

## 🧪 Testing

Jalankan test suite menggunakan PHPUnit:
```bash
php artisan test
```
Semua 14 tests (Sanctum Auth, File Upload, Filament Access) siap dijalankan secara otomatis.
