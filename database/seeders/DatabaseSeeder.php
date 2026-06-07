<?php

namespace Database\Seeders;

use App\Models\AnakPanti;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\KebutuhanPanti;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin CareNest',
            'email' => 'admin@carenest.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '08123456789',
        ]);

        // Create regular user
        User::create([
            'name' => 'User CareNest',
            'email' => 'user@carenest.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '08987654321',
        ]);

        // Create sample anak panti
        AnakPanti::create([
            'nama' => 'Ahmad Ridho',
            'tanggal_lahir' => '2015-03-10',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'status' => 'aktif',
        ]);

        AnakPanti::create([
            'nama' => 'Siti Nur Azizah',
            'tanggal_lahir' => '2014-07-22',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Jend. Sudirman, Bandung',
            'status' => 'aktif',
        ]);

        AnakPanti::create([
            'nama' => 'Budi Santoso',
            'tanggal_lahir' => '2016-11-05',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Gatot Subroto, Surabaya',
            'status' => 'aktif',
        ]);

        // Create sample donatur
        $donatur1 = Donatur::create([
            'nama' => 'PT. Maju Jaya Indonesia',
            'alamat' => 'Jl. Sudirman Kav. 1, Jakarta',
            'nomor_hp' => '02155555555',
            'email' => 'info@majujaya.co.id',
        ]);

        $donatur2 = Donatur::create([
            'nama' => 'Dr. Bambang Subagyo',
            'alamat' => 'Jl. Kuningan 25, Jakarta Selatan',
            'nomor_hp' => '081234567890',
            'email' => 'bambang@email.com',
        ]);

        $donatur3 = Donatur::create([
            'nama' => 'Ibu Rina Kusuma',
            'alamat' => 'Kompleks Bukit Indah Blok D, Bandung',
            'nomor_hp' => '082345678901',
            'email' => 'rina@email.com',
        ]);

        // Create sample donasi
        Donasi::create([
            'donatur_id' => $donatur1->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '3000000',
            'tanggal_donasi' => '2026-01-15',
            'keterangan' => 'Donasi tahun baru',
        ]);

        Donasi::create([
            'donatur_id' => $donatur2->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '2500000',
            'tanggal_donasi' => '2026-02-20',
            'keterangan' => 'Donasi rutin',
        ]);

        Donasi::create([
            'donatur_id' => $donatur3->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '4000000',
            'tanggal_donasi' => '2026-03-10',
            'keterangan' => 'Donasi kemanusiaan',
        ]);

        Donasi::create([
            'donatur_id' => $donatur1->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '5500000',
            'tanggal_donasi' => '2026-04-25',
            'keterangan' => 'Donasi untuk pembangunan',
        ]);

        Donasi::create([
            'donatur_id' => $donatur1->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '5000000',
            'tanggal_donasi' => '2026-05-10',
            'keterangan' => 'Donasi untuk kebutuhan operasional panti',
        ]);

        Donasi::create([
            'donatur_id' => $donatur2->id,
            'jenis_donasi' => 'barang',
            'jumlah_donasi' => '20 buku tulis, 10 pensil',
            'tanggal_donasi' => '2026-05-15',
            'keterangan' => 'Donasi perlengkapan sekolah',
        ]);

        Donasi::create([
            'donatur_id' => $donatur3->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '2000000',
            'tanggal_donasi' => '2026-05-20',
            'keterangan' => 'Donasi bulanan',
        ]);

        Donasi::create([
            'donatur_id' => $donatur1->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '3500000',
            'tanggal_donasi' => '2026-06-12',
            'keterangan' => 'Donasi bantuan',
        ]);

        Donasi::create([
            'donatur_id' => $donatur2->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '4500000',
            'tanggal_donasi' => '2026-07-18',
            'keterangan' => 'Donasi cuti bersama',
        ]);

        Donasi::create([
            'donatur_id' => $donatur3->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '2800000',
            'tanggal_donasi' => '2026-08-22',
            'keterangan' => 'Donasi libur musim panas',
        ]);

        Donasi::create([
            'donatur_id' => $donatur1->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '6000000',
            'tanggal_donasi' => '2026-09-15',
            'keterangan' => 'Donasi awal tahun ajaran',
        ]);

        Donasi::create([
            'donatur_id' => $donatur2->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '3200000',
            'tanggal_donasi' => '2026-10-10',
            'keterangan' => 'Donasi hari besar',
        ]);

        Donasi::create([
            'donatur_id' => $donatur3->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '4800000',
            'tanggal_donasi' => '2026-11-20',
            'keterangan' => 'Donasi akhir tahun',
        ]);

        Donasi::create([
            'donatur_id' => $donatur1->id,
            'jenis_donasi' => 'uang',
            'jumlah_donasi' => '7000000',
            'tanggal_donasi' => '2026-12-25',
            'keterangan' => 'Donasi penutup tahun',
        ]);

        // Create sample kebutuhan panti
        KebutuhanPanti::create([
            'nama_kebutuhan' => 'Susu Formula',
            'jumlah_kebutuhan' => 50,
            'tanggal_pengajuan' => '2026-05-01',
            'status' => 'terpenuhi',
            'keterangan' => 'Kebutuhan susu untuk bayi panti',
        ]);

        KebutuhanPanti::create([
            'nama_kebutuhan' => 'Buku Pelajaran SD',
            'jumlah_kebutuhan' => 30,
            'tanggal_pengajuan' => '2026-05-10',
            'status' => 'belum_terpenuhi',
            'keterangan' => 'Buku pelajaran untuk anak sekolah dasar',
        ]);

        KebutuhanPanti::create([
            'nama_kebutuhan' => 'Kasur Tidur',
            'jumlah_kebutuhan' => 10,
            'tanggal_pengajuan' => '2026-05-15',
            'status' => 'belum_terpenuhi',
            'keterangan' => 'Kasur untuk tempat tidur anak-anak',
        ]);
    }
}

