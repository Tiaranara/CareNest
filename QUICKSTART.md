# 🚀 CareNest - Quick Start Guide

Panduan cepat untuk menjalankan aplikasi CareNest di mesin Anda.

## ⚡ Persiapan Awal (5 Menit)

### 1. Buat Database

```sql
CREATE DATABASE carenest;
```

### 2. Clone/Setup Project

```bash
# Navigate ke folder project
cd c:\Users\TIARA\CareNest

# Install dependencies
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
copy .env.example .env

# Generate APP KEY
php artisan key:generate
```

### 4. Setup Database di .env

Edit file `.env` dan update database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=carenest
DB_USERNAME=root
DB_PASSWORD=           (kosongkan jika menggunakan default)
```

### 5. Jalankan Migrations & Seeding

```bash
# Jalankan semua migrations
php artisan migrate

# Seed database dengan data sampel
php artisan db:seed
```

### 6. Build Assets

```bash
# Production build
npm run build

# Development mode dengan hot reload
npm run dev
```

### 7. Jalankan Server

Buka terminal baru dan jalankan:

```bash
php artisan serve
```

## ✅ Testing Login

Aplikasi sekarang berjalan di `http://localhost:8000`

### Akun Admin

- **Email**: admin@carenest.com
- **Password**: password
- **Akses**: Full access ke semua fitur

### Akun User

- **Email**: user@carenest.com
- **Password**: password
- **Akses**: Limited access (hanya bisa melihat dan input data)

## 📊 Fitur yang Siap Digunakan

### ✓ Sudah Tersedia

- [x] Dashboard dengan statistik
- [x] Manajemen Anak Panti (CRUD)
- [x] Manajemen Donatur (CRUD)
- [x] Manajemen Donasi (CRUD)
- [x] Manajemen Kebutuhan Panti (CRUD)
- [x] Laporan Donasi (PDF export)
- [x] Laporan Kebutuhan Panti (PDF export)
- [x] Role-based access control
- [x] Multi-user login system
- [x] Responsive design

### 🔄 Data Sampel Tersedia

- 2 User (1 Admin, 1 User)
- 3 Anak Panti
- 3 Donatur
- 3 Data Donasi
- 3 Kebutuhan Panti

## 🎯 Navigasi Utama

Setelah login, Anda akan melihat dashboard dengan menu sidebar:

| Menu            | Akses | Fungsi                        |
| --------------- | ----- | ----------------------------- |
| Dashboard       | Semua | Statistik & grafik donasi     |
| Data Anak Panti | Semua | CRUD anak panti               |
| Data Donatur    | Semua | CRUD donatur + riwayat donasi |
| Data Donasi     | Semua | CRUD donasi                   |
| Kebutuhan Panti | Semua | CRUD kebutuhan panti          |
| Laporan (Admin) | Admin | Export laporan ke PDF         |

## 🔍 Fitur Penting

### 1. Search & Filter

Semua halaman list memiliki fitur:

- Search by name
- Filter by status/date
- Pagination

### 2. Dashboard Charts

- Grafik donasi bulanan
- Real-time statistics
- Quick access links

### 3. PDF Reports

Admin dapat generate:

- Laporan donasi dengan filter tanggal
- Laporan kebutuhan dengan filter status
- Print langsung dari browser

### 4. Role-Based Views

Menu dan fitur berbeda sesuai role:

- **Admin**: Lihat semua menu + laporan
- **User**: Lihat hanya menu utama (tanpa laporan)

## 🐛 Troubleshooting

### Masalah: Page blank atau error 500

**Solusi:**

```bash
php artisan cache:clear
php artisan config:cache
php artisan view:clear
```

### Masalah: Database connection error

**Solusi:**

1. Pastikan MySQL running
2. Check .env database credentials
3. Jalankan ulang:

```bash
php artisan migrate:fresh --seed
```

### Masalah: Assets tidak load (CSS/JS tidak work)

**Solusi:**

```bash
npm run build
php artisan serve
```

### Masalah: Login redirect loop

**Solusi:**

```bash
php artisan cache:clear
php artisan session:table
php artisan migrate
```

## 💾 Backup & Restore

### Backup Database

```bash
mysqldump -u root carenest > backup_carenest.sql
```

### Restore Database

```bash
mysql -u root carenest < backup_carenest.sql
```

## 📝 Development Notes

### Menambah User Baru

```bash
php artisan tinker
User::create(['name' => 'Nama', 'email' => 'email@test.com', 'password' => Hash::make('password'), 'role' => 'user'])
```

### Reset Database

```bash
php artisan migrate:fresh --seed
```

### Customization

- Warna sidebar: Edit `resources/views/layouts/app.blade.php` `:root` CSS
- Logo/Brand: Edit sidebar-brand section
- Default pagination: Edit controller `->paginate(10)`

## 🔒 Security Notes

⚠️ **IMPORTANT:**

- Jangan share `.env` file
- Pastikan `APP_DEBUG=false` di production
- Gunakan strong password untuk database
- Regular backup database

## 📞 Bantuan

Untuk bantuan lebih lanjut:

1. Cek file [README.md](README.md)
2. Cek console browser (F12) untuk error messages
3. Lihat Laravel logs di `storage/logs/`

---

**Happy Managing! 🎉**
