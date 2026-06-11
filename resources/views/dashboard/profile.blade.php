@extends('layouts.app')

@section('title', 'Profil Saya')

@section('styles')
<style>
    /* === Base === */
    .dashboard-user-page {
        background: #f5f3ff;
        color: #1f1d2b;
        min-height: 100vh;
    }

    .dashboard-page-inner {
        max-width: 1240px;
    }

    /* === Banner === */
    .banner-card {
        background: #ffffff;
        border-radius: 28px;
        box-shadow: 0 28px 70px rgba(99, 73, 237, 0.08);
        border: 1px solid rgba(99, 73, 237, 0.08);
        padding: 2rem 2.5rem;
        margin-bottom: 1.75rem;
    }

    .banner-card h2 {
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        color: #1f1d2b;
        margin-bottom: 0.3rem;
    }

    .banner-card p {
        color: #5b5b6a;
        margin-bottom: 0;
    }

    /* === Nav card === */
    .sidebar-card,
    .profile-card,
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 16px 28px rgba(99, 73, 237, 0.05);
    }

    .sidebar-card {
        padding: 1.5rem;
    }

    .nav-link-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        border-radius: 14px;
        color: #4b4a64;
        background: #faf7ff;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s ease, color 0.2s ease;
        margin-bottom: 0.4rem;
    }

    .nav-link-item:hover,
    .nav-link-item.active {
        background: rgba(124, 92, 196, 0.12);
        color: #3f338f;
    }

    .nav-link-item i {
        width: 18px;
        text-align: center;
        font-size: 0.9rem;
    }

    /* === Avatar Card === */
    .profile-card {
        padding: 2rem;
        text-align: center;
    }

    .avatar-wrapper {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7c5cf4 0%, #a78bfa 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.4rem;
        margin: 0 auto 1.2rem;
        box-shadow: 0 12px 32px rgba(124, 92, 196, 0.28);
        position: relative;
    }

    .avatar-initials {
        font-weight: 800;
        font-size: 2rem;
        line-height: 1;
        letter-spacing: -1px;
    }

    .profile-card h4 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1f1d2b;
        margin-bottom: 0.25rem;
    }

    .profile-card .email-text {
        color: #6b6885;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    /* === Info Card === */
    .info-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 16px 28px rgba(99, 73, 237, 0.05);
        overflow: hidden;
    }

    .info-card-header {
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid rgba(99, 73, 237, 0.08);
        font-weight: 700;
        color: #2f2b50;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 1rem;
    }

    .info-card-header i {
        color: #7c5cf4;
    }

    .info-card-body {
        padding: 1.25rem 1.5rem;
    }

    .info-row {
        margin-bottom: 1rem;
    }

    .info-row:last-child {
        margin-bottom: 0;
    }

    .info-label {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #8e8aaf;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 0.97rem;
        color: #2f2b50;
        font-weight: 500;
    }

    /* === Form Card === */
    .form-card {
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .form-card-header {
        padding: 1.1rem 1.75rem;
        border-bottom: 1px solid rgba(99, 73, 237, 0.08);
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 700;
        color: #2f2b50;
        font-size: 1.05rem;
    }

    .form-card-header i {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .form-card-header i.icon-edit {
        background: rgba(99, 73, 237, 0.1);
        color: #6349ed;
    }

    .form-card-header i.icon-lock {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }

    .form-card-body {
        padding: 1.75rem;
    }

    /* === Form Controls === */
    .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #6b6885;
        margin-bottom: 0.4rem;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        border: 1.5px solid #e8e3f9;
        background: #faf8ff;
        color: #1f1d2b;
        padding: 0.7rem 1rem;
        font-size: 0.97rem;
        box-shadow: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #9b7ff7;
        box-shadow: 0 0 0 3px rgba(124, 92, 196, 0.12);
        background: #fff;
    }

    .form-control[readonly] {
        background: #f3f0fa;
        color: #8b87a8;
        cursor: not-allowed;
    }

    .form-control.is-invalid {
        border-color: #f87171;
        box-shadow: none;
    }

    .invalid-feedback {
        font-size: 0.82rem;
        color: #e53e3e;
        margin-top: 0.3rem;
    }

    /* === Input group (password toggle) === */
    .input-group {
        flex-wrap: nowrap;
    }

    .input-group .form-control {
        flex: 1 1 auto;
        min-width: 0;
        border-right: none;
        border-radius: 12px 0 0 12px;
    }

    .input-group .btn-toggle-pw {
        flex: 0 0 auto;
        border: 1.5px solid #e8e3f9;
        border-left: none;
        background: #faf8ff;
        border-radius: 0 12px 12px 0;
        padding: 0 1rem;
        color: #8b87a8;
        transition: color 0.2s, background 0.2s;
    }

    .input-group .btn-toggle-pw:hover {
        background: rgba(124, 92, 196, 0.07);
        color: #6349ed;
    }

    .form-hint {
        font-size: 0.82rem;
        color: #9490b5;
        margin-top: 0.35rem;
    }

    /* === Buttons === */
    .btn-pill {
        border-radius: 999px;
        padding-left: 1.4rem;
        padding-right: 1.4rem;
    }

    .btn-primary-purple {
        background: linear-gradient(135deg, #7c5cf4 0%, #a78bfa 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        border-radius: 12px;
        transition: opacity 0.2s, transform 0.15s;
        box-shadow: 0 6px 18px rgba(124, 92, 196, 0.22);
    }

    .btn-primary-purple:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        color: #fff;
    }

    .btn-amber {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        border-radius: 12px;
        transition: opacity 0.2s, transform 0.15s;
        box-shadow: 0 6px 18px rgba(245, 158, 11, 0.22);
    }

    .btn-amber:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        color: #fff;
    }

    .btn-outline-back {
        border: 1.5px solid #e8e3f9;
        color: #5b5b6a;
        background: #fff;
        border-radius: 999px;
        padding: 0.55rem 1.3rem;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }

    .btn-outline-back:hover {
        background: rgba(124, 92, 196, 0.06);
        color: #3f338f;
        border-color: #c4b5fd;
    }

    /* === Badges === */
    .badge-soft-purple {
        background: rgba(124, 92, 196, 0.12);
        color: #6f47d3;
        border-radius: 16px;
        padding: 0.45rem 0.85rem;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .badge-active {
        background: #eaf9ee;
        color: #2f8a4b;
        border-radius: 999px;
        padding: 0.4rem 0.85rem;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-role {
        background: rgba(99, 73, 237, 0.1);
        color: #5330d6;
        border-radius: 999px;
        padding: 0.4rem 0.85rem;
        font-weight: 600;
        font-size: 0.8rem;
    }

    /* === Alerts === */
    .alert-success-custom {
        background: #edf9f0;
        border: 1px solid #86efac;
        color: #166534;
        border-radius: 14px;
        padding: 0.9rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .alert-error-custom {
        background: #fff2f2;
        border: 1px solid #fca5a5;
        color: #b91c1c;
        border-radius: 14px;
        padding: 0.9rem 1.25rem;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .alert-error-custom ul {
        margin: 0.4rem 0 0 1rem;
        padding: 0;
    }

    /* === Responsive === */
    @media (max-width: 767px) {
        .banner-card {
            padding: 1.5rem;
        }

        .form-card-body {
            padding: 1.25rem;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-user-page container-fluid py-5">
    <div class="dashboard-page-inner mx-auto">

        {{-- Banner --}}
        <div class="banner-card d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <span class="badge badge-soft-purple mb-2">CareNest</span>
                <h2 class="mb-1">Profil Saya</h2>
                <p>Kelola data pribadi dan keamanan akun Anda di halaman ini.</p>
            </div>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-back">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="row g-4">

            {{-- LEFT COLUMN --}}
            <div class="col-12 col-lg-4 d-flex flex-column gap-4">

                {{-- Avatar Card --}}
                <div class="profile-card">
                    <div class="avatar-wrapper mx-auto">
                        <span class="avatar-initials">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(strstr(Auth::user()->name . ' ', ' '), 1, 1)) }}
                        </span>
                    </div>
                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="email-text">{{ Auth::user()->email }}</p>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge-active"><i class="fas fa-circle-check me-1"></i>Member Aktif</span>
                        <span class="badge-role">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                </div>

                {{-- Info Account --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="fas fa-info-circle"></i> Informasi Akun
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <div class="info-label">Nomor Telepon</div>
                            <div class="info-value">{{ Auth::user()->phone ?? '—' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Bergabung Sejak</div>
                            <div class="info-value">{{ Auth::user()->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Terakhir Diperbarui</div>
                            <div class="info-value">{{ Auth::user()->updated_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="sidebar-card">
                    <p class="text-muted small fw-bold text-uppercase mb-3" style="letter-spacing:0.08em; font-size:0.75rem;">Navigasi</p>
                    <a href="{{ route('user.dashboard') }}" class="nav-link-item"><i class="fas fa-home"></i> Dashboard</a>
                    <a href="{{ route('user.donasi.create') }}" class="nav-link-item"><i class="fas fa-hand-holding-heart"></i> Form Donasi</a>
                    <a href="{{ route('user.donasi.history') }}" class="nav-link-item"><i class="fas fa-history"></i> Riwayat Donasi</a>
                    <a href="{{ route('user.profile') }}" class="nav-link-item active"><i class="fas fa-user"></i> Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-pill w-100">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="col-12 col-lg-8">

                {{-- Global success / error alerts --}}
                @if(session('success'))
                    <div class="alert-success-custom">
                        <i class="fas fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-error-custom">
                        <strong><i class="fas fa-triangle-exclamation me-1"></i> Terjadi kesalahan:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Edit Profile --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-pen icon-edit"></i> Edit Data Pribadi
                    </div>
                    <div class="form-card-body">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', Auth::user()->name) }}"
                                        placeholder="Masukkan nama lengkap"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                    <div class="form-hint">Email tidak dapat diubah.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="tel" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', Auth::user()->phone) }}"
                                        placeholder="Contoh: 08123456789">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary-purple btn-pill">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Change Password --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-lock icon-lock"></i> Ubah Password
                    </div>
                    <div class="form-card-body">
                        <form action="{{ route('user.password.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" name="old_password" id="oldPassword"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            placeholder="Masukkan password lama"
                                            required>
                                        <button class="btn-toggle-pw" type="button" id="toggleOld" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('old_password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="newPassword"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Min. 8 karakter"
                                            required>
                                        <button class="btn-toggle-pw" type="button" id="toggleNew" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirmPassword"
                                            class="form-control"
                                            placeholder="Ulangi password baru"
                                            required>
                                        <button class="btn-toggle-pw" type="button" id="toggleConfirm" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-amber btn-pill">
                                    <i class="fas fa-key me-2"></i> Ubah Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>{{-- end right col --}}
        </div>{{-- end row --}}
    </div>
</div>

<script>
    function togglePassword(inputId, btnId) {
        const input = document.getElementById(inputId);
        const btn = document.getElementById(btnId);
        btn.addEventListener('click', function () {
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            this.innerHTML = isHidden
                ? '<i class="fas fa-eye-slash"></i>'
                : '<i class="fas fa-eye"></i>';
        });
    }

    togglePassword('oldPassword',     'toggleOld');
    togglePassword('newPassword',     'toggleNew');
    togglePassword('confirmPassword', 'toggleConfirm');
</script>
@endsection
