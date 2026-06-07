@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Profile Section -->
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

        <!-- Edit Profile Form -->
        <div class="col-lg-8">
            <!-- Edit Data Pribadi -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0"><i class="fas fa-edit text-primary"></i> Edit Data Pribadi</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Masukkan email" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" value="{{ Auth::user()->phone ?? '' }}" placeholder="Masukkan nomor telepon">
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
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0"><i class="fas fa-lock text-warning"></i> Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="oldPassword" placeholder="Masukkan password lama" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleOld">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="newPassword" placeholder="Masukkan password baru" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleNew">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted d-block mt-2">
                                Minimal 8 karakter, kombinasi huruf, angka, dan simbol
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Konfirmasi password baru" required>
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

            <!-- Notifikasi & Preferensi -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0"><i class="fas fa-bell text-danger"></i> Preferensi Notifikasi</h5>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                        <label class="form-check-label" for="emailNotif">
                            <strong>Email Notification</strong>
                            <br>
                            <small class="text-muted">Terima notifikasi via email untuk aktivitas penting</small>
                        </label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="donasiNotif" checked>
                        <label class="form-check-label" for="donasiNotif">
                            <strong>Notifikasi Donasi</strong>
                            <br>
                            <small class="text-muted">Beritahu saya ketika ada update status donasi saya</small>
                        </label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="kebutuhanNotif" checked>
                        <label class="form-check-label" for="kebutuhanNotif">
                            <strong>Notifikasi Kebutuhan Baru</strong>
                            <br>
                            <small class="text-muted">Beritahu saya tentang kebutuhan panti yang baru</small>
                        </label>
                    </div>

                    <button class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Preferensi
                    </button>
                </div>
            </div>

            <!-- Keamanan Akun -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0"><i class="fas fa-shield-alt text-info"></i> Keamanan Akun</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Two-Factor Authentication</h6>
                            <p class="text-muted">Tambahkan lapisan keamanan ekstra ke akun Anda</p>
                            <button class="btn btn-sm btn-outline-info">
                                <i class="fas fa-qrcode"></i> Aktifkan 2FA
                            </button>
                        </div>
                        <div class="col-md-6">
                            <h6>Riwayat Login</h6>
                            <p class="text-muted">Lihat semua perangkat yang login ke akun Anda</p>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-history"></i> Lihat Riwayat
                            </button>
                        </div>
                    </div>

                    <hr>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h6 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Zona Berbahaya</h6>
                        <p class="mb-2">Hapus akun Anda secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="fas fa-trash"></i> Hapus Akun
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-circle"></i> Hapus Akun Secara Permanen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2"><strong>Peringatan:</strong> Tindakan ini akan menghapus akun Anda secara permanen.</p>
                <ul class="mb-3">
                    <li>Semua data pribadi akan dihapus</li>
                    <li>Riwayat donasi akan disimpan untuk audit</li>
                    <li>Akun tidak dapat dipulihkan</li>
                </ul>
                <div class="mb-3">
                    <label class="form-label">Masukkan password Anda untuk mengkonfirmasi:</label>
                    <input type="password" class="form-control" placeholder="Masukkan password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.getElementById('toggleOld').addEventListener('click', function() {
        const input = document.getElementById('oldPassword');
        if (input.type === 'password') {
            input.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            input.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    document.getElementById('toggleNew').addEventListener('click', function() {
        const input = document.getElementById('newPassword');
        if (input.type === 'password') {
            input.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            input.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    document.getElementById('toggleConfirm').addEventListener('click', function() {
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
@endsection
