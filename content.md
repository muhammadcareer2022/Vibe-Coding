# 📋 Task Planning: Content Management & Homepage (Filament CMS)

## 📌 Ringkasan Tugas
Buat sistem **Content Management** di Filament Admin Panel untuk mengelola konten halaman **Homepage**. Admin dapat mengedit semua bagian homepage (Hero, Video, Benefit, Mitra, Footer) dari dashboard Filament, dan halaman homepage akan menarik data tersebut secara dinamis.

---

## 🏠 Struktur Halaman Homepage

Homepage terdiri dari **5 section** utama:

```
┌──────────────────────────────────────────┐
│              HERO SECTION                │
│  Judul + Subjudul + Search Bar Skema     │
├──────────────────────────────────────────┤
│              VIDEO SECTION               │
│  [Video Player]  |  [Teks Deskripsi]     │
├──────────────────────────────────────────┤
│            BENEFIT SECTION               │
│  Judul + Deskripsi + 3 Kartu Benefit     │
│  + Teks Penutup                          │
├──────────────────────────────────────────┤
│             MITRA SECTION                │
│  Judul + Logo Carousel (bergerak)        │
├──────────────────────────────────────────┤
│               FOOTER                     │
│  Info LSP | Menu Navigasi | Kontak       │
└──────────────────────────────────────────┘
```

---

## 📝 Spesifikasi Konten Per Section

### 1. Hero Section
| Field | Tipe | Contoh Nilai |
|---|---|---|
| `hero_title` | `string` | Lembaga Sertifikasi Profesi |
| `hero_subtitle` | `string` | Bidang TIK Berlisensi BNSP |
| `hero_search_placeholder` | `string` | Cari nama skema... |

> 💡 Search bar akan mengirimkan query pencarian ke halaman/endpoint daftar skema.

### 2. Video Section
| Field | Tipe | Contoh Nilai |
|---|---|---|
| `video_url` | `string (URL)` | https://www.youtube.com/embed/xxxxx |
| `video_heading` | `string` | Buktikan Kompetensimu dengan Sertifikasi LSP TIK Global! |
| `video_description` | `text (nullable)` | Deskripsi opsional di bawah heading |

### 3. Benefit Section
| Field | Tipe | Contoh Nilai |
|---|---|---|
| `benefit_heading` | `string` | Mengapa Memilih Sertifikasi di LSP TIK Global? |
| `benefit_description` | `text` | Bukan sekadar dokumen, ini adalah investasi terbaik... |
| `benefit_items` | `JSON array` | Array berisi 3 objek: `{ title, description, icon }` |
| `benefit_closing` | `text` | Dengan sertifikasi LSP TIK Global, kompetensimu tidak hanya diakui... |

**Isi `benefit_items` (default):**
```json
[
  {
    "title": "Sertifikat Kompetensi Diakui Secara Nasional",
    "description": "Memiliki sertifikat kompetensi resmi dari BNSP RI sebagai bukti sah keterampilan Anda.",
    "icon": "heroicon-o-check-badge"
  },
  {
    "title": "Skema Sertifikasi Berbasis SKKNI",
    "description": "Seluruh skema sertifikasi mengacu pada SKKNI dan peraturan ESDM terbaru serta kebutuhan industri.",
    "icon": "heroicon-o-document-text"
  },
  {
    "title": "Jaringan TUK di Berbagai Daerah",
    "description": "Memiliki jaringan Tempat Uji Kompetensi (TUK) yang luas dan tersebar di berbagai wilayah Indonesia.",
    "icon": "heroicon-o-map-pin"
  }
]
```

### 4. Mitra Section
| Field | Tipe | Contoh Nilai |
|---|---|---|
| `mitra_heading` | `string` | Dipercaya oleh berbagai perusahaan dan institusi pendidikan |

Logo mitra dikelola di tabel terpisah (lihat bagian database).

### 5. Footer
| Field | Tipe | Contoh Nilai |
|---|---|---|
| `footer_description` | `text` | LSP TIK Global – Lembaga Sertifikasi Profesi bidang Teknologi Informasi & Komunikasi berlisensi BNSP, siap mencetak SDM TIK unggul dan kompeten. |
| `footer_license` | `string` | Lisensi BNSP: BNSP-LSP-2150-ID |
| `footer_phone` | `string` | 021-27651353 / +6285195533360 |
| `footer_email` | `string` | info@lspglobal.id |
| `footer_address` | `text` | Jl. Lebak Bulus Raya Komplek Ruko Victory 88 No. 88 B Cilandak Jakarta Selatan |

**Menu Footer (hardcoded atau dari config):**
| Label | URL |
|---|---|
| Beranda | / |
| Profil | /profil |
| Skema | /skema |
| Tempat Uji Kompetensi | /tempat-uji-kompetensi |
| Lisensi | /lisensi |
| Kontak | /kontak |

---

## 🗄️ Spesifikasi Database

### Tabel `homepage_settings` (Single-row settings pattern)
Tabel ini menyimpan seluruh konten homepage dalam satu baris data.

| Kolom | Tipe | Nullable | Keterangan |
|---|---|---|---|
| `id` | `BIGINT AI` | No | Primary Key |
| `hero_title` | `VARCHAR(255)` | No | Judul hero section |
| `hero_subtitle` | `VARCHAR(255)` | Yes | Sub-judul hero section |
| `hero_search_placeholder` | `VARCHAR(255)` | Yes | Placeholder search bar |
| `video_url` | `VARCHAR(500)` | Yes | URL embed video (YouTube) |
| `video_heading` | `VARCHAR(500)` | Yes | Judul di samping video |
| `video_description` | `TEXT` | Yes | Deskripsi video (opsional) |
| `benefit_heading` | `VARCHAR(500)` | Yes | Judul section benefit |
| `benefit_description` | `TEXT` | Yes | Deskripsi section benefit |
| `benefit_items` | `JSON` | Yes | Array objek benefit `[{title, description, icon}]` |
| `benefit_closing` | `TEXT` | Yes | Teks penutup benefit |
| `mitra_heading` | `VARCHAR(500)` | Yes | Judul section mitra |
| `footer_description` | `TEXT` | Yes | Deskripsi footer |
| `footer_license` | `VARCHAR(255)` | Yes | Nomor lisensi BNSP |
| `footer_phone` | `VARCHAR(255)` | Yes | No. telepon |
| `footer_email` | `VARCHAR(255)` | Yes | Email kontak |
| `footer_address` | `TEXT` | Yes | Alamat kantor |
| `created_at` | `TIMESTAMP` | Yes | Auto timestamp |
| `updated_at` | `TIMESTAMP` | Yes | Auto timestamp |

### Tabel `mitra_logos`
Tabel terpisah untuk menyimpan logo-logo mitra yang akan ditampilkan sebagai carousel bergerak.

| Kolom | Tipe | Nullable | Keterangan |
|---|---|---|---|
| `id` | `BIGINT AI` | No | Primary Key |
| `name` | `VARCHAR(255)` | No | Nama perusahaan / institusi |
| `logo` | `VARCHAR(500)` | No | Path file gambar logo |
| `url` | `VARCHAR(500)` | Yes | URL website mitra (opsional) |
| `is_active` | `BOOLEAN` | No | Status aktif / tampil |
| `sort_order` | `INT` | No | Urutan tampilan (default: 0) |
| `created_at` | `TIMESTAMP` | Yes | Auto timestamp |
| `updated_at` | `TIMESTAMP` | Yes | Auto timestamp |

---

## 🏗️ Struktur File yang Harus Dibuat / Diubah

```
database/
├── migrations/
│   ├── xxxx_create_homepage_settings_table.php     <-- Migration tabel homepage_settings
│   └── xxxx_create_mitra_logos_table.php            <-- Migration tabel mitra_logos
├── seeders/
│   └── HomepageSettingsSeeder.php                   <-- Seeder konten default

app/
├── Models/
│   ├── HomepageSetting.php                          <-- Model single-row setting
│   └── MitraLogo.php                                <-- Model logo mitra
├── Filament/
│   └── Resources/
│       ├── HomepageSettings/                        <-- Filament Page (bukan Resource biasa)
│       │   └── ManageHomepageSettings.php            <-- Single-page edit form
│       └── MitraLogos/                              <-- Filament Resource CRUD
│           ├── MitraLogoResource.php
│           ├── Pages/
│           ├── Schemas/
│           └── Tables/
├── Http/
│   └── Controllers/
│       └── HomeController.php                       <-- Controller halaman homepage
├── Services/
│   └── HomepageService.php                          <-- Service: ambil data homepage

resources/
├── views/
│   ├── home.blade.php                               <-- View utama homepage
│   └── components/                                  <-- Blade components per section
│       ├── hero-section.blade.php
│       ├── video-section.blade.php
│       ├── benefit-section.blade.php
│       ├── mitra-section.blade.php
│       └── footer.blade.php

routes/
└── web.php                                          <-- Route GET / -> HomeController
```

---

## 🚀 Tahapan Implementasi (Step-by-Step)

### Tahap 1: Buat Migration & Model

#### 1a. Migration `homepage_settings`
- [ ] Jalankan:
  ```bash
  php artisan make:migration create_homepage_settings_table
  ```
- [ ] Definisikan semua kolom sesuai spesifikasi database di atas.
- [ ] Kolom `benefit_items` bertipe `json()`.

#### 1b. Migration `mitra_logos`
- [ ] Jalankan:
  ```bash
  php artisan make:migration create_mitra_logos_table
  ```
- [ ] Definisikan kolom: `name`, `logo` (string), `url` (nullable), `is_active` (boolean, default true), `sort_order` (integer, default 0).

#### 1c. Model `HomepageSetting`
- [ ] Buat model:
  ```bash
  php artisan make:model HomepageSetting
  ```
- [ ] Buat `$fillable` berisi semua kolom (kecuali `id`, `created_at`, `updated_at`).
- [ ] Tambahkan `$casts`:
  ```php
  protected $casts = [
      'benefit_items' => 'array',
  ];
  ```
- [ ] Tambahkan helper method static untuk mengambil data single-row:
  ```php
  public static function getSettings(): self
  {
      return self::firstOrCreate([], [/* default values */]);
  }
  ```

#### 1d. Model `MitraLogo`
- [ ] Buat model:
  ```bash
  php artisan make:model MitraLogo
  ```
- [ ] Buat `$fillable`: `name`, `logo`, `url`, `is_active`, `sort_order`.
- [ ] Scope untuk yang aktif saja:
  ```php
  public function scopeActive($query) { return $query->where('is_active', true); }
  ```

#### 1e. Jalankan Migration
- [ ] Jalankan:
  ```bash
  php artisan migrate
  ```

---

### Tahap 2: Buat Seeder Konten Default

- [ ] Buat seeder:
  ```bash
  php artisan make:seeder HomepageSettingsSeeder
  ```
- [ ] Masukkan data default sesuai spesifikasi konten di atas (hero title, subtitle, benefit items, footer, dll).
- [ ] Daftarkan di `DatabaseSeeder.php`.
- [ ] Jalankan:
  ```bash
  php artisan db:seed --class=HomepageSettingsSeeder
  ```

---

### Tahap 3: Buat Filament Admin untuk Homepage Settings

Karena `homepage_settings` hanya punya 1 baris data, **buat sebagai Filament Custom Page** (bukan Resource CRUD biasa).

- [ ] Buat custom page Filament:
  ```bash
  php artisan make:filament-page ManageHomepageSettings
  ```
- [ ] Implementasikan form edit dengan section/tabs:
  - **Tab 1 - Hero:** `TextInput` untuk `hero_title`, `hero_subtitle`, `hero_search_placeholder`.
  - **Tab 2 - Video:** `TextInput` untuk `video_url`, `video_heading`, `Textarea` untuk `video_description`.
  - **Tab 3 - Benefit:** `TextInput` untuk `benefit_heading`, `Textarea` untuk `benefit_description`, `Repeater` untuk `benefit_items` (tiap item: `title`, `description`, `icon`), `Textarea` untuk `benefit_closing`.
  - **Tab 4 - Mitra:** `TextInput` untuk `mitra_heading`.
  - **Tab 5 - Footer:** `Textarea` untuk `footer_description`, `TextInput` untuk `footer_license`, `footer_phone`, `footer_email`, `Textarea` untuk `footer_address`.
- [ ] Pada method `mount()`, isi form dengan data dari `HomepageSetting::getSettings()`.
- [ ] Pada method `save()`, update data ke database.

---

### Tahap 4: Buat Filament Resource untuk Mitra Logos

Mitra logos memiliki banyak data (CRUD), jadi gunakan **Filament Resource** biasa.

- [ ] Buat resource:
  ```bash
  php artisan make:filament-resource MitraLogo --generate
  ```
- [ ] Form fields:
  - `TextInput::make('name')` → required
  - `FileUpload::make('logo')` → required, accept image, directory `mitra-logos`
  - `TextInput::make('url')` → nullable, url
  - `Toggle::make('is_active')` → default true
  - `TextInput::make('sort_order')` → numeric, default 0
- [ ] Table columns:
  - `ImageColumn::make('logo')`
  - `TextColumn::make('name')` → searchable
  - `ToggleColumn::make('is_active')`
  - `TextColumn::make('sort_order')` → sortable
- [ ] Aktifkan fitur **reorder** (drag & drop) jika Filament mendukung.

---

### Tahap 5: Buat Homepage Service

- [ ] Buat file `app/Services/HomepageService.php`.
- [ ] Method `getHomepageData()` yang mengembalikan array/object berisi:
  - Data dari `HomepageSetting::getSettings()`
  - Data dari `MitraLogo::active()->orderBy('sort_order')->get()`
- [ ] Data di-cache untuk performa (opsional tapi direkomendasikan):
  ```php
  return Cache::remember('homepage_data', 3600, function () { ... });
  ```

---

### Tahap 6: Buat HomeController & Route

- [ ] Buat controller:
  ```bash
  php artisan make:controller HomeController
  ```
- [ ] Method `index()`:
  ```php
  public function index(HomepageService $homepageService)
  {
      $data = $homepageService->getHomepageData();
      return view('home', $data);
  }
  ```
- [ ] Daftarkan route di `routes/web.php`:
  ```php
  Route::get('/', [HomeController::class, 'index'])->name('home');
  ```

---

### Tahap 7: Buat Blade Views

#### 7a. Layout utama `home.blade.php`
- [ ] Buat view utama yang memanggil tiap section component.

#### 7b. Blade Components per Section

- [ ] **`hero-section.blade.php`:**
  - Background gradient atau gambar.
  - Judul `{{ $settings->hero_title }}` dan subjudul `{{ $settings->hero_subtitle }}`.
  - Form search bar dengan `action` mengarah ke halaman skema.

- [ ] **`video-section.blade.php`:**
  - Layout 2 kolom:
    - Kolom kiri: `<iframe>` embed video dari `{{ $settings->video_url }}`.
    - Kolom kanan: Heading `{{ $settings->video_heading }}` dan deskripsi.

- [ ] **`benefit-section.blade.php`:**
  - Heading dan deskripsi utama.
  - Loop `@foreach($settings->benefit_items as $item)` untuk menampilkan 3 kartu benefit (judul, deskripsi, icon).
  - Teks penutup `{{ $settings->benefit_closing }}`.

- [ ] **`mitra-section.blade.php`:**
  - Heading `{{ $settings->mitra_heading }}`.
  - Logo carousel (infinite scroll/marquee animation) menggunakan CSS animation atau library JS ringan.
  - Loop `@foreach($mitras as $mitra)` menampilkan `<img>` logo.

- [ ] **`footer.blade.php`:**
  - Layout 3 kolom:
    - **Kolom 1:** Deskripsi LSP `{{ $settings->footer_description }}` dan lisensi `{{ $settings->footer_license }}`.
    - **Kolom 2:** Menu navigasi (hardcoded atau dari config).
    - **Kolom 3:** Info kontak: telepon, email, alamat.

---

### Tahap 8: Styling & Animasi

- [ ] Gunakan **Tailwind CSS** (sudah terinstall via Laravel Vite) untuk styling.
- [ ] Logo mitra carousel: Gunakan CSS `@keyframes` marquee atau library JS kecil (misalnya Swiper.js).
- [ ] Responsive design: Pastikan semua section tampil baik di mobile, tablet, dan desktop.
- [ ] Build asset frontend:
  ```bash
  npm install
  npm run build
  ```

---

### Tahap 9: Pengujian

- [ ] **Test Homepage Response:**
  ```bash
  php artisan make:test HomepageTest
  ```
  Skenario:
  1. `GET /` mengembalikan status 200.
  2. Response berisi teks hero title, benefit heading, dan footer description.
  3. Logo mitra aktif ditampilkan, logo tidak aktif tidak ditampilkan.

- [ ] **Test Filament Admin:**
  1. Admin dapat mengakses halaman `ManageHomepageSettings`.
  2. Admin dapat mengedit dan menyimpan data homepage settings.
  3. Admin dapat CRUD data mitra logos.

- [ ] Jalankan semua test:
  ```bash
  php artisan test
  ```

---

## ⚠️ Catatan Penting untuk Implementor

1. **Single-Row Pattern:** Tabel `homepage_settings` hanya berisi **1 baris data**. Gunakan `firstOrCreate` atau `updateOrCreate` agar tidak terjadi duplikasi.
2. **File Upload Logo Mitra:** Simpan logo di disk `public` (`storage/app/public/mitra-logos/`), pastikan `php artisan storage:link` sudah dijalankan.
3. **Benefit Items:** Kolom `benefit_items` bertipe JSON. Di Filament gunakan `Repeater` component agar admin bisa menambah/mengurangi item benefit secara dinamis.
4. **Video Embed:** Simpan URL dalam format embed YouTube (`https://www.youtube.com/embed/VIDEO_ID`), bukan URL biasa.
5. **Cache:** Jika menggunakan cache pada `HomepageService`, pastikan cache di-flush saat admin menyimpan data baru di Filament (gunakan event/observer atau flush manual setelah save).
6. **Footer Menu:** Menu footer bisa di-hardcode di Blade karena jarang berubah. Jika ingin dinamis, buat tabel `menu_items` tambahan.

