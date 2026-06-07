# CareNest - Sistem Informasi Manajemen Panti Asuhan

CareNest adalah aplikasi web berbasis Laravel dan MySQL yang dirancang untuk membantu pengelolaan data panti asuhan secara digital. Aplikasi ini menyediakan fitur lengkap untuk mengelola data anak panti, donatur, donasi, dan kebutuhan panti.

## 🎯 Fitur Utama

### 1. **Autentikasi & Otorisasi**

- Sistem login, logout, dan registrasi
- Multi-role access control (Admin dan User)
- Manajemen hak akses berdasarkan peran

### 2. **Dashboard**

- Statistik real-time:
    - Total anak panti aktif
    - Total donatur
    - Total donasi
    - Kebutuhan belum terpenuhi
- Grafik donasi bulanan interaktif

### 3. **Manajemen Data Anak Panti**

- Tambah, edit, hapus, dan lihat detail anak panti
- Pencarian data anak panti
- Tracking status anak (aktif, keluar, lainnya)
- Data yang disimpan:
    - Nama, tanggal lahir, jenis kelamin
    - Alamat, status

### 4. **Manajemen Donatur**

- Tambah, edit, hapus, dan lihat detail donatur
- Pencarian donatur
- View riwayat donasi dari donatur
- Data yang disimpan:
    - Nama, alamat, nomor HP, email

### 5. **Manajemen Donasi**

- Input donasi uang atau barang
- Riwayat donasi lengkap
- Filter donasi berdasarkan tanggal
- Data yang disimpan:
    - Nama donatur, jenis donasi, jumlah
    - Tanggal donasi, keterangan

### 6. **Manajemen Kebutuhan Panti**

- Tambah, edit, hapus kebutuhan panti
- Update status kebutuhan (terpenuhi/belum terpenuhi)
- Filter berdasarkan status
- Data yang disimpan:
    - Nama kebutuhan, jumlah, tanggal pengajuan, status

### 7. **Laporan & Export**

- Cetak laporan donasi (dengan filter tanggal)
- Cetak laporan kebutuhan panti (dengan filter status)
- Export ke PDF menggunakan browser print

## 🔐 Perbedaan Hak Akses

### Admin

✅ Akses penuh ke semua fitur

- Kelola semua data (anak panti, donatur, donasi, kebutuhan)
- Hapus data
- Lihat dashboard lengkap
- Akses laporan penuh dan export PDF
- Kelola akun pengguna

### User (Pengguna Biasa)

✅ Akses terbatas

- Lihat data anak panti
- Lihat data donatur
- Input donasi
- Lihat kebutuhan panti
- Lihat riwayat donasi
  ❌ Tidak dapat menghapus data
  ❌ Tidak dapat mengelola akun

## 📋 Struktur Database

```
users
├── id
├── name
├── email
├── password
├── role (admin/user)
├── phone
└── timestamps

anak_panti
├── id
├── nama
├── tanggal_lahir
├── jenis_kelamin
├── alamat
├── status (aktif/keluar/lainnya)
└── timestamps

donatur
├── id
├── nama
├── alamat
├── nomor_hp
├── email
└── timestamps

donasi
├── id
├── donatur_id (foreign key)
├── jenis_donasi (uang/barang)
├── jumlah_donasi
├── tanggal_donasi
├── keterangan
└── timestamps

kebutuhan_panti
├── id
├── nama_kebutuhan
├── jumlah_kebutuhan
├── tanggal_pengajuan
├── status (belum_terpenuhi/terpenuhi)
├── keterangan
└── timestamps
```

## 🚀 Instalasi & Setup

### Prasyarat

- PHP 8.2 atau lebih
- Composer
- MySQL 8.0 atau lebih
- Node.js (untuk development)

### Langkah Instalasi

1. **Clone atau Download Repository**

```bash
cd c:\Users\TIARA\CareNest
```

2. **Install Dependencies**

```bash
composer install
npm install
```

3. **Setup Environment**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**
   Edit file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=carenest
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan Migrations**

```bash
php artisan migrate
```

6. **Seed Sample Data**

```bash
php artisan db:seed
```

7. **Build Assets (Vite)**

```bash
npm run build
# atau untuk development dengan hot reload
npm run dev
```

8. **Jalankan Aplikasi**

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 👤 Akun Default

Setelah menjalankan seeder, Anda dapat login dengan:

**Admin:**

- Email: `admin@carenest.com`
- Password: `password`
- Role: Admin

**User:**

- Email: `user@carenest.com`
- Password: `password`
- Role: User

## 🎨 Desain & UI

- **Framework CSS**: Bootstrap 5
- **Icons**: Font Awesome 6
- **Charts**: Chart.js untuk grafik donasi
- **Design**: Modern, responsive, dan user-friendly
- **Sidebar Navigation**: Menu navigasi tetap dengan dark theme
- **Color Scheme**: Professional blue, gradient backgrounds

## 📁 Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── AnakPantiController.php
│   │   ├── DonaturController.php
│   │   ├── DonasiController.php
│   │   ├── KebutuhanPantiController.php
│   │   └── ReportController.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       └── UserMiddleware.php
├── Models/
│   ├── User.php
│   ├── AnakPanti.php
│   ├── Donatur.php
│   ├── Donasi.php
│   └── KebutuhanPanti.php
└── ...

database/
├── migrations/
│   ├── 2026_05_21_000000_modify_users_table.php
│   ├── 2026_05_21_000001_create_anak_panti_table.php
│   ├── 2026_05_21_000002_create_donatur_table.php
│   ├── 2026_05_21_000003_create_donasi_table.php
│   └── 2026_05_21_000004_create_kebutuhan_panti_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── dashboard/
│   │   └── index.blade.php
│   ├── anak-panti/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   ├── donatur/
│   ├── donasi/
│   ├── kebutuhan-panti/
│   └── reports/

routes/
└── web.php

bootstrap/
└── app.php
```

## 🔄 Routes

| Aksi              | URL                     | Method | Auth | Role  |
| ----------------- | ----------------------- | ------ | ---- | ----- |
| Dashboard         | `/dashboard`            | GET    | ✓    | All   |
| Anak Panti List   | `/anak-panti`           | GET    | ✓    | All   |
| Anak Panti Create | `/anak-panti/create`    | GET    | ✓    | Admin |
| Anak Panti Store  | `/anak-panti`           | POST   | ✓    | Admin |
| Anak Panti Show   | `/anak-panti/{id}`      | GET    | ✓    | All   |
| Anak Panti Edit   | `/anak-panti/{id}/edit` | GET    | ✓    | Admin |
| Anak Panti Update | `/anak-panti/{id}`      | PUT    | ✓    | Admin |
| Anak Panti Delete | `/anak-panti/{id}`      | DELETE | ✓    | Admin |
| Donasi Report     | `/reports/donasi`       | GET    | ✓    | Admin |
| Kebutuhan Report  | `/reports/kebutuhan`    | GET    | ✓    | Admin |

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Bootstrap 5, Vue.js (optional)
- **Database**: MySQL 8.0
- **CSS**: Bootstrap, Custom CSS
- **JavaScript**: Chart.js, Bootstrap JS
- **Icons**: Font Awesome 6
- **Build Tool**: Vite

## 📝 Catatan Pengembangan

### Middleware Protection

- `/dashboard` dan semua CRUD routes dilindungi middleware `auth`
- Routes `/reports/*` dilindungi middleware `admin`
- Validasi penghapusan data di controller level

### Soft Deletes

- Semua model menggunakan soft deletes untuk data protection
- Data yang dihapus tidak benar-benar dihapus, hanya di-mark sebagai deleted

### Relasi Database

- Donasi memiliki foreign key ke Donatur
- Cascade delete untuk donasi ketika donatur dihapus

## 🐛 Troubleshooting

### Database Connection Error

```bash
php artisan migrate:fresh --seed
```

### Missing Assets

```bash
npm run build
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:cache
```

## 📞 Support

Untuk pertanyaan atau bantuan, silakan hubungi tim development.

## 📄 License

MIT License - Silakan bebas menggunakan dan memodifikasi sesuai kebutuhan.

---

**Developed with ❤️ for Orphanage Management**
