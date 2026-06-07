@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                            <p class="mb-0 opacity-75">Terima kasih telah menjadi bagian dari komunitas CareNest</p>
                        </div>
                        <div>
                            <i class="fas fa-heart" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="nav nav-tabs card border-0 shadow-sm" id="dashboardTabs" role="tablist">
                <button class="nav-link active" id="tab-dashboard" data-bs-toggle="tab" data-bs-target="#content-dashboard" type="button" role="tab">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </button>
                <button class="nav-link" id="tab-donasi" data-bs-toggle="tab" data-bs-target="#content-donasi" type="button" role="tab">
                    <i class="fas fa-hand-holding-heart"></i> Form Donasi
                </button>
                <button class="nav-link" id="tab-riwayat" data-bs-toggle="tab" data-bs-target="#content-riwayat" type="button" role="tab">
                    <i class="fas fa-history"></i> Riwayat Donasi
                </button>
                <button class="nav-link" id="tab-profil" data-bs-toggle="tab" data-bs-target="#content-profil" type="button" role="tab">
                    <i class="fas fa-user-circle"></i> Profil Saya
                </button>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="dashboardTabContent">
        <!-- Dashboard Tab -->
        <div class="tab-pane fade show active" id="content-dashboard" role="tabpanel">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-1">Total Donasi Saya</h6>
                                    <h3 class="mb-0" style="color: #667eea;">
                                        Rp {{ number_format($userDonasiBelumDiterima, 0, ',', '.') }}
                                    </h3>
                                    <small class="text-success"><i class="fas fa-arrow-up"></i> {{ $userDonationCount }} donasi</small>
                                </div>
                                <div style="font-size: 2.5rem; color: #667eea; opacity: 0.2;">
                                    <i class="fas fa-gift"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-1">Total Donatur</h6>
                                    <h3 class="mb-0" style="color: #764ba2;">{{ $totalDonatur }}</h3>
                                    <small class="text-info"><i class="fas fa-users"></i> Orang</small>
                                </div>
                                <div style="font-size: 2.5rem; color: #764ba2; opacity: 0.2;">
                                    <i class="fas fa-handshake"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-1">Kebutuhan Terpenuhi</h6>
                                    <h3 class="mb-0" style="color: #28a745;">{{ $kebutuhanTerpenuhi }} / {{ $kebutuhanTerpenuhi + $totalKebutuhan }}</h3>
                                    <small class="text-warning"><i class="fas fa-clock"></i> {{ $totalKebutuhan }} sedang diproses</small>
                                </div>
                                <div style="font-size: 2.5rem; color: #28a745; opacity: 0.2;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Kebutuhan Panti Terbaru -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-list text-info"></i> Kebutuhan Panti Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($kebutuhanTerbaru as $kebutuhan)
                                    <div class="list-group-item px-0 py-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">{{ $kebutuhan->nama_kebutuhan }}</h6>
                                                <small class="text-muted">Dibutuhkan: {{ $kebutuhan->jumlah_kebutuhan }}</small>
                                            </div>
                                            <span class="badge @if($kebutuhan->status === 'terpenuhi') bg-success @elseif($kebutuhan->status === 'belum_terpenuhi') bg-danger @else bg-warning @endif">
                                                {{ ucfirst(str_replace('_', ' ', $kebutuhan->status)) }}
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar @if($kebutuhan->status === 'terpenuhi') bg-success @elseif($kebutuhan->status === 'belum_terpenuhi') bg-danger @else bg-warning @endif" style="width: {{ $kebutuhan->progress }}%;"></div>
                                        </div>
                                        <small class="text-muted d-block mt-2">
                                            {{ $kebutuhan->progress }}% terpenuhi • 
                                            Deadline: {{ $kebutuhan->tanggal_pengajuan->format('d M Y') }}
                                        </small>
                                    </div>
                                @empty
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle"></i> Tidak ada kebutuhan panti saat ini
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top">
                            <a href="/kebutuhan-panti" class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-eye"></i> Lihat Semua Kebutuhan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Informasi Anak Panti -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-users text-warning"></i> Informasi Anak Panti</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="card border-0" style="background: #f8f9fa;">
                                        <div class="card-body text-center">
                                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem;">
                                                <i class="fas fa-child"></i>
                                            </div>
                                            <h6 class="mb-1">Total Anak</h6>
                                            <h3 class="mb-0" style="color: #667eea;">{{ $totalAnakPanti }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0" style="background: #f8f9fa;">
                                        <div class="card-body text-center">
                                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem;">
                                                <i class="fas fa-heart-pulse"></i>
                                            </div>
                                            <h6 class="mb-1">Status Aktif</h6>
                                            <h3 class="mb-0" style="color: #28a745;">{{ $totalAnakAktif }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-3">Anak Panti Terbaru</h6>
                                @forelse($anakPantiTerbaru as $anak)
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: white;">
                                            <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $anak->nama }}</h6>
                                            <small class="text-muted">Usia: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }} tahun | Masuk: {{ $anak->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle"></i> Belum ada data anak panti
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top">
                            <a href="/anak-panti" class="btn btn-sm btn-outline-warning w-100">
                                <i class="fas fa-users"></i> Lihat Semua Anak Panti
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Donasi Tab -->
        <div class="tab-pane fade" id="content-donasi" role="tabpanel">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-hand-holding-heart text-danger"></i> Form Donasi</h5>
                        </div>
                        <div class="card-body">
                            <form id="donasiForm">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Jenis Donasi</strong></label>
                                    <select class="form-select form-select-lg" required>
                                        <option value="">-- Pilih Jenis Donasi --</option>
                                        <option value="uang">💰 Donasi Uang</option>
                                        <option value="barang">📦 Donasi Barang</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Nominal / Jumlah</strong></label>
                                    <input type="text" class="form-control form-control-lg" placeholder="Masukkan nominal atau jumlah barang" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Keterangan</strong></label>
                                    <textarea class="form-control" rows="4" placeholder="Tulis keterangan donasi (opsional)"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Upload Bukti Donasi</strong></label>
                                    <input type="file" class="form-control" accept="image/*,.pdf">
                                    <small class="text-muted d-block mt-2">Format: JPG, PNG, PDF (Max 5MB)</small>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-paper-plane"></i> Kirim Donasi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-info-circle text-info"></i> Informasi</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <strong>Terima Kasih!</strong><br/>
                                Donasi Anda sangat membantu anak-anak panti asuhan. Proses verifikasi biasanya memakan waktu 1-2 hari kerja.
                            </div>
                            <ul style="list-style: none; padding: 0;">
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Proses cepat & mudah</li>
                                <li class="mb-2"><i class="fas fa-lock text-success"></i> Data aman & terlindungi</li>
                                <li class="mb-2"><i class="fas fa-receipt text-success"></i> Bukti donasi tersimpan</li>
                                <li><i class="fas fa-heart text-success"></i> Berdampak langsung untuk anak panti</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Donasi Tab -->
        <div class="tab-pane fade" id="content-riwayat" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-history text-success"></i> Riwayat Donasi Saya</h5>
                        </div>
                        <div class="card-body">
                            @if($riwayatDonasi->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead style="background: #f8f9fa;">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Jenis</th>
                                                <th>Nominal</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($riwayatDonasi as $donasi)
                                                <tr>
                                                    <td><strong>{{ $donasi->tanggal_donasi->format('d M Y') }}</strong></td>
                                                    <td>
                                                        <span class="badge @if($donasi->jenis_donasi === 'uang') bg-primary @else bg-info @endif">
                                                            {{ ucfirst($donasi->jenis_donasi) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($donasi->jenis_donasi === 'uang')
                                                            <strong>Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</strong>
                                                        @else
                                                            {{ $donasi->jumlah_donasi }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $donasi->keterangan ?? '-' }}</td>
                                                    <td><span class="badge bg-success">Terverifikasi</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info text-center mb-0">
                                    <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2">Belum ada riwayat donasi</p>
                                    <button class="btn btn-primary btn-sm" onclick="document.getElementById('tab-donasi').click()">
                                        Mulai Berdonasi
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profil Saya Tab -->
        <div class="tab-pane fade" id="content-profil" role="tabpanel">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                                <i class="fas fa-user"></i>
                            </div>
                            <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                            <p class="mb-0">
                                <span class="badge bg-success">Member Aktif</span>
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Nomor Telepon</small>
                                <p class="mb-0">{{ Auth::user()->phone ?? '-' }}</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Role</small>
                                <p class="mb-0"><span class="badge bg-primary">{{ ucfirst(Auth::user()->role) }}</span></p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Bergabung Sejak</small>
                                <p class="mb-0">{{ Auth::user()->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Terakhir Update</small>
                                <p class="mb-0">{{ Auth::user()->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- Edit Data Pribadi -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-edit text-primary"></i> Edit Data Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Nama Lengkap</strong></label>
                                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Email</strong></label>
                                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Masukkan email" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Nomor Telepon</strong></label>
                                            <input type="tel" class="form-control" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="Masukkan nomor telepon">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0"><i class="fas fa-lock text-warning"></i> Ubah Password</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label class="form-label"><strong>Password Lama</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="oldPassword" name="old_password" placeholder="Masukkan password lama" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleOld">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Password Baru</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="newPassword" name="password" placeholder="Masukkan password baru" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleNew">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        Minimal 8 karakter, kombinasi huruf, angka, dan simbol
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Konfirmasi Password Baru</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi password baru" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-key"></i> Ubah Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .list-group-item {
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #666;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        color: #667eea;
        border-bottom-color: #667eea;
    }

    .nav-tabs .nav-link.active {
        background-color: transparent;
        color: #667eea;
        border-bottom-color: #667eea;
        border-bottom-width: 3px;
    }
</style>

<script>
    // Toggle password visibility
    document.getElementById('toggleOld')?.addEventListener('click', function() {
        const input = document.getElementById('oldPassword');
        if (input.type === 'password') {
            input.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            input.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    document.getElementById('toggleNew')?.addEventListener('click', function() {
        const input = document.getElementById('newPassword');
        if (input.type === 'password') {
            input.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            input.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    document.getElementById('toggleConfirm')?.addEventListener('click', function() {
        const input = document.getElementById('confirmPassword');
        if (input.type === 'password') {
            input.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            input.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
</script>

