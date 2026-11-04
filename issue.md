# 📋 Task Planning: API Registrasi Pengguna Baru (Service Pattern)

## 📌 Ringkasan Tugas
Buat endpoint API untuk registrasi user baru dengan endpoint `POST /api/users`. Implementasi harus menerapkan arsitektur **Service Pattern** untuk memisahkan logika bisnis dari controller.

Dokumen ini ditujukan sebagai panduan langkah-demi-langkah bagi programmer/AI model untuk mengimplementasikan fitur ini secara rapi, aman, dan teruji.

---

## 🗄️ Spesifikasi Database

Pastikan tabel `users` memiliki struktur kolom sebagai berikut:

| Nama Kolom | Tipe Data | Keterangan |
|---|---|---|
| `id` | `BIGINT` / `INT` (Auto Increment) | Primary Key |
| `name` | `VARCHAR(255)` | Wajib diisi |
| `email` | `VARCHAR(255)` | Wajib diisi, Unik |
| `password` | `VARCHAR(255)` | Hashed (bcrypt) |
| `created_at` | `TIMESTAMP` | Nullable / Auto timestamp |
| `updated_at` | `TIMESTAMP` | Nullable / Auto timestamp |

> 💡 *Catatan:* Di Laravel, tabel `users` default biasanya sudah memiliki struktur ini. Cek file migrasi di `database/migrations/` dan pastikan kolom-kolom di atas tersedia.

---

## 🌐 Spesifikasi API Endpoint

- **Method:** `POST`
- **URL Endpoint:** `/api/users`
- **Header:**
  - `Content-Type: application/json`
  - `Accept: application/json`

### 1. Request Body (JSON)
```json
{
  "name": "muhammad",
  "email": "admin@gmail.com",
  "password": "123456"
}
```

### 2. Aturan Validasi
- `name`: `required|string|max:255`
- `email`: `required|email|max:255`
- `password`: `required|string|min:6` (atau sesuaikan dengan kebutuhan)

### 3. Response Berhasil (HTTP 201 Created atau 200 OK)
```json
{
  "data": "ok"
}
```

### 4. Response Gagal / Email Sudah Terdaftar (HTTP 422 Unprocessable Entity / 400 Bad Request)
Jika email sudah digunakan oleh user lain:
```json
{
  "error": "email sudah terdaftar"
}
```

---

## 🏗️ Struktur File & Arsitektur (Service Pattern)

Gunakan **Service Pattern** dengan membagi kode ke dalam lapisan berikut:

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── UserController.php        <-- Menerima request & mengembalikan format response
│   └── Requests/
│       └── RegisterUserRequest.php       <-- Validasi input request (opsional/disarankan)
├── Services/
│   └── UserService.php                   <-- Logika bisnis: cek email, hashing password, simpan data
└── Models/
    └── User.php                          <-- Definisi model & fillable attribute
routes/
└── api.php                               <-- Pendaftaran route POST /users
tests/
└── Feature/
    └── UserRegistrationTest.php          <-- Pengujian otomatis API
```

---

## 🚀 Tahapan Implementasi (Step-by-Step)

### Tahap 1: Verifikasi Database & Model
- [ ] Periksa file migrasi tabel `users` di `database/migrations/`.
- [ ] Pastikan kolom `name`, `email`, `password`, `created_at`, dan `updated_at` telah tersedia.
- [ ] Buka `app/Models/User.php`, pastikan `$fillable` berisi:
  ```php
  protected $fillable = [
      'name',
      'email',
      'password',
  ];
  ```

### Tahap 2: Buat Form Request (Validasi Input)
- [ ] Buat file Request untuk validasi data registrasi:
  ```bash
  php artisan make:request RegisterUserRequest
  ```
  *(Lokasi: `app/Http/Requests/RegisterUserRequest.php`)*
- [ ] Set `authorize()` me-return `true`.
- [ ] Tentukan `rules()`:
  - `name`: `['required', 'string', 'max:255']`
  - `email`: `['required', 'string', 'email', 'max:255']`
  - `password`: `['required', 'string', 'min:6']`

### Tahap 3: Buat Business Logic di Service (`UserService`)
- [ ] Buat file `app/Services/UserService.php` jika belum ada folder `Services`.
- [ ] Buat method `register(array $data): User`:
  1. Periksa apakah email sudah terdaftar di database:
     ```php
     if (User::where('email', $data['email'])->exists()) {
         throw new \Exception("email sudah terdaftar");
     }
     ```
  2. Lakukan hashing pada password sebelum disimpan:
     ```php
     $data['password'] = Hash::make($data['password']);
     ```
  3. Simpan user baru ke database:
     ```php
     return User::create($data);
     ```

### Tahap 4: Buat Controller (`UserController`)
- [ ] Buat controller API:
  ```bash
  php artisan make:controller Api/UserController
  ```
  *(Lokasi: `app/Http/Controllers/Api/UserController.php`)*
- [ ] Inject `UserService` ke dalam method atau constructor controller.
- [ ] Buat method `store` (atau `register`):
  1. Tangkap data yang sudah divalidasi dari request.
  2. Panggil `UserService::register($data)` dalam blok `try - catch`.
  3. Jika berhasil, return response JSON:
     ```php
     return response()->json(['data' => 'ok'], 201);
     ```
  4. Jika terjadi error / exception (email duplikat), tangkap exception dan return response JSON:
     ```php
     return response()->json(['error' => 'email sudah terdaftar'], 422);
     ```

### Tahap 5: Daftarkan Route di `routes/api.php`
- [ ] Buka `routes/api.php`.
- [ ] Tambahkan route POST `/users`:
  ```php
  use App\Http\Controllers\Api\UserController;

  Route::post('/users', [UserController::class, 'store']);
  ```

### Tahap 6: Pengujian (Testing)
- [ ] Buat Feature Test untuk memastikan endpoint berjalan sesuai spesifikasi:
  ```bash
  php artisan make:test UserRegistrationTest
  ```
- [ ] Skenario yang harus diuji:
  1. **Registrasi Sukses:** Kirim payload yang valid, pastikan status response 201/200 dan body `{"data": "ok"}`.
  2. **Registrasi Gagal (Email Duplikat):** Kirim payload dengan email yang sudah ada, pastikan response mengembalikan `{"error": "email sudah terdaftar"}`.
  3. **Password Ter-enkripsi:** Pastikan password yang tersimpan di database dalam bentuk hash, bukan plain text.
- [ ] Jalankan test suite:
  ```bash
  php artisan test --filter=UserRegistrationTest
  ```

---

## ⚠️ Catatan Penting untuk Implementor
1. **Jangan Menyimpan Password Plain-Text:** Selalu gunakan `Hash::make()` atau bcrypt.
2. **Format Response Harus Tepat:** Pastikan key JSON sesuai spesifikasi (`data: "ok"` saat sukses, `error: "email sudah terdaftar"` saat gagal).
3. **Pemisahan Tanggung Jawab:** Controller hanya bertugas menangani HTTP request & response. Semua query database dan logika penyimpanan harus berada di dalam `UserService`.
