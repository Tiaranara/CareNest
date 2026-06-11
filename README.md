# CareNest - Sistem Informasi Manajemen Panti Asuhan

CareNest adalah sebuah website Sistem untuk Manajemen Administrasi Panti Asuhan yang dirancang untuk membantu proses pengelolahan data dan administrasi panti asuhan secara digital. Website ini memudahkan pengelola untuk mengelola data anak panti, donatur, donasi, serta kebutuhan panti secara lebih terstruktur dan efisien.

Selain membantu pengelolaan data, CareNest juga menyediakan layanan bagi pengguna atau donatur untuk melihat informasi panti, mengetahui kebutuhan yang sedang dibutuhkan, dan melakukan donasi secara online. Dengan adanya sistem ini, proses pencatatan data menjadi lebih cepat, transparan, dan mengurangi risiko kesalahan yang sering terjadi pada pencatatan manual.

# Tujuan 
- Membantu pengelolaan data panti asuhan secara digital
- Memudahkan proses pencatatan dan pengelolaan donasi
- Menyediakan informasi kebutuhan panti secara transparan
- Mempermudah donatur dalam memberikan bantuan
- Meningkatkan efisiensi administrasi panti asuhan

# Fitur Website
- Landing Page
    -Home
    - Tentang Kami
    - Data Anak Panti
    - Kebutuhan Panti
    - Donasi
    - Kontak
    - Login
    - Register

- Fitur Admin
     Dashboard Admin
        Total Anak Panti
        Total Donatur
        Total Donasi
        Total Kebutuhan Panti
        Grafik Donasi Bulanan
        Data Donasi Terbaru

    Manajemen Anak Panti
        Tambah Data Anak Panti
        Edit Data Anak Panti
        Hapus Data Anak Panti
        Detail Data Anak Panti

    Manajemen Donatur
        Tambah Data Donatur
        Edit Data Donatur
        Hapus Data Donatur
        Detail Data Donatur

    Manajemen Donasi
        Melihat Seluruh Donasi
        Verifikasi Donasi
        Edit Data Donasi
        Hapus Data Donasi

    Manajemen Kebutuhan Panti
        Tambah Kebutuhan
        Edit Kebutuhan
        Hapus Kebutuhan
        Update Status Kebutuhan

    Manajemen Pengguna
        Melihat Data Pengguna
        Mengelola Akun Pengguna
    
    Laporan
        Laporan Donasi
        Laporan Kebutuhan Panti
        Cetak PDF

- Fitur Pengguna
    Dashboard Pengguna
        Melihat Statistik Donasi
        Melihat Kebutuhan Panti
        Melihat Informasi Anak Panti

    Donasi
        Melakukan Donasi Uang
        Melakukan Donasi Barang
        Upload Bukti Donasi
        Melihat Riwayat Donasi

    Profil
        Melihat Profil
        Edit Profil
        Ganti Password

## 📋 Struktur Database
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

## 👤 Akun Default

Setelah menjalankan seeder, Anda dapat login dengan:

**Admin:**

- Email: `admin@carenest.com`
- Password: `password`
- Role: Admin

**User:**

- Email: `Hinarakeylana@gmail.com`
- Password: `Hinarakey`
- Role: User

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
