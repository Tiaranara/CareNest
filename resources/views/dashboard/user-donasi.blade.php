@extends('layouts.app')

@section('title', 'Form Donasi')

@section('styles')
<style>
    /* =====================
       BASE
    ===================== */
    .dashboard-user-page {
        background: #f5f3ff;
        min-height: 100vh;
        color: #1f1d2b;
    }

    .page-inner {
        max-width: 1100px;
    }

    /* =====================
       BANNER
    ===================== */
    .banner-card {
        background: linear-gradient(135deg, #6349ed 0%, #9b7ff7 60%, #c4b5fd 100%);
        border-radius: 28px;
        padding: 2.25rem 2.5rem;
        position: relative;
        overflow: hidden;
        color: #fff;
        margin-bottom: 2rem;
        box-shadow: 0 20px 60px rgba(99, 73, 237, 0.28);
    }

    .banner-card::before {
        content: '';
        position: absolute;
        top: -70px; right: -70px;
        width: 240px; height: 240px;
        background: rgba(255,255,255,0.07);
        border-radius: 50%;
    }

    .banner-card::after {
        content: '';
        position: absolute;
        bottom: -60px; right: 60px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .banner-label {
        display: inline-block;
        background: rgba(255,255,255,0.18);
        color: #fff;
        border-radius: 99px;
        padding: 0.3rem 0.85rem;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
    }

    .banner-title {
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 0.4rem;
    }

    .banner-desc {
        color: rgba(255,255,255,0.80);
        font-size: 0.97rem;
        margin: 0;
    }

    .btn-banner-ghost {
        background: rgba(255,255,255,0.16);
        color: #fff;
        border: 1.5px solid rgba(255,255,255,0.38);
        border-radius: 999px;
        padding: 0.55rem 1.3rem;
        font-weight: 600;
        font-size: 0.9rem;
        backdrop-filter: blur(4px);
        transition: background 0.2s;
        text-decoration: none;
        white-space: nowrap;
        position: relative;
        z-index: 1;
    }

    .btn-banner-ghost:hover {
        background: rgba(255,255,255,0.26);
        color: #fff;
    }

    /* =====================
       LAYOUT
    ===================== */
    .sidebar-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 10px 24px rgba(99, 73, 237, 0.05);
        padding: 1.5rem;
    }

    .sidebar-nav-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #9490b5;
        margin-bottom: 0.85rem;
    }

    .nav-link-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.8rem 1rem;
        border-radius: 14px;
        color: #4b4a64;
        background: #faf7ff;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.93rem;
        transition: background 0.18s ease, color 0.18s ease;
        margin-bottom: 0.4rem;
    }

    .nav-link-item i {
        width: 18px;
        text-align: center;
        font-size: 0.88rem;
        opacity: 0.75;
    }

    .nav-link-item:hover,
    .nav-link-item.active {
        background: rgba(124, 92, 196, 0.12);
        color: #3f338f;
    }

    .nav-link-item.active {
        font-weight: 700;
    }

    .nav-link-item.active i { opacity: 1; }

    /* =====================
       FORM CARD
    ===================== */
    .form-main-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 16px 40px rgba(99, 73, 237, 0.07);
        overflow: hidden;
    }

    .form-main-header {
        padding: 1.35rem 1.75rem;
        border-bottom: 1px solid rgba(99, 73, 237, 0.07);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-main-header .header-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(99, 73, 237, 0.1);
        color: #6349ed;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .form-main-header h5 {
        font-weight: 700;
        color: #1f1d2b;
        margin: 0;
        font-size: 1.05rem;
    }

    .form-main-header p {
        color: #9490b5;
        font-size: 0.85rem;
        margin: 0;
    }

    .form-main-body {
        padding: 1.75rem;
    }

    /* =====================
       FORM CONTROLS
    ===================== */
    .form-label {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
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
        font-size: 0.96rem;
        box-shadow: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #9b7ff7;
        box-shadow: 0 0 0 3px rgba(124, 92, 196, 0.12);
        background: #fff;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #f87171;
    }

    .invalid-feedback {
        font-size: 0.82rem;
        color: #dc2626;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    .form-hint {
        font-size: 0.8rem;
        color: #9490b5;
        margin-top: 0.3rem;
    }

    /* Jenis donasi grid */
    .jenis-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.6rem;
    }

    @media (max-width: 575px) {
        .jenis-grid { grid-template-columns: repeat(2, 1fr); }
    }

    .jenis-option {
        display: none;
    }

    .jenis-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.85rem 0.5rem;
        border-radius: 14px;
        border: 1.5px solid #e8e3f9;
        background: #faf8ff;
        cursor: pointer;
        font-size: 0.82rem;
        font-weight: 600;
        color: #6b6885;
        text-align: center;
        transition: border-color 0.2s, background 0.2s, color 0.2s;
    }

    .jenis-label i {
        font-size: 1.3rem;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    .jenis-option:checked + .jenis-label {
        border-color: #7c5cf4;
        background: rgba(124, 92, 196, 0.08);
        color: #5d3bef;
    }

    .jenis-option:checked + .jenis-label i {
        opacity: 1;
    }

    /* Amount quick-pick */
    .amount-presets {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }

    .preset-btn {
        border: 1.5px solid #e8e3f9;
        background: #faf8ff;
        color: #5d3bef;
        border-radius: 99px;
        padding: 0.38rem 1rem;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, border-color 0.2s;
    }

    .preset-btn:hover {
        background: rgba(124, 92, 196, 0.1);
        border-color: #c4b5fd;
    }

    /* Divider */
    .form-divider {
        border: none;
        border-top: 1px solid rgba(99, 73, 237, 0.08);
        margin: 1.5rem 0;
    }

    /* Submit btn */
    .btn-submit-primary {
        background: linear-gradient(135deg, #7c5cf4 0%, #a78bfa 100%);
        border: none;
        color: #fff;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 14px;
        font-size: 1rem;
        box-shadow: 0 8px 22px rgba(124, 92, 196, 0.28);
        transition: opacity 0.2s, transform 0.18s;
    }

    .btn-submit-primary:hover {
        opacity: 0.92;
        transform: translateY(-2px);
        color: #fff;
    }

    /* Success alert */
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

    /* File input */
    .file-drop {
        border: 2px dashed #d8d2ff;
        background: #faf8ff;
        border-radius: 14px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        position: relative;
    }

    .file-drop:hover {
        border-color: #9b7ff7;
        background: rgba(124, 92, 196, 0.04);
    }

    .file-drop input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .file-drop-icon {
        font-size: 1.8rem;
        color: #c4b5fd;
        margin-bottom: 0.5rem;
    }

    .file-drop-text {
        font-size: 0.88rem;
        color: #9490b5;
        margin: 0;
    }

    .file-drop-name {
        margin-top: 0.4rem;
        font-size: 0.82rem;
        font-weight: 600;
        color: #5d3bef;
    }

    @media (max-width: 767px) {
        .banner-card { padding: 1.75rem; border-radius: 20px; }
        .form-main-body { padding: 1.25rem; }
    }
</style>
@endsection

@section('content')
<div class="dashboard-user-page container-fluid py-5">
    <div class="page-inner mx-auto">

        {{-- Banner --}}
        <div class="banner-card d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
            <div style="position:relative; z-index:1;">
                <span class="banner-label"><i class="fas fa-heart me-1"></i> CareNest</span>
                <h1 class="banner-title">Form Donasi</h1>
                <p class="banner-desc">Lengkapi detail donasi Anda agar tim kami dapat menyalurkan bantuan secara tepat sasaran.</p>
            </div>
            <a href="{{ route('user.dashboard') }}" class="btn-banner-ghost flex-shrink-0">
                <i class="fas fa-arrow-left me-1"></i> Dashboard
            </a>
        </div>

        <div class="row g-4">

            {{-- Sidebar --}}
            <div class="col-lg-3">
                <div class="sidebar-card">
                    <p class="sidebar-nav-label">Menu Utama</p>
                    <a href="{{ route('user.dashboard') }}" class="nav-link-item">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('user.donasi.create') }}" class="nav-link-item active">
                        <i class="fas fa-hand-holding-heart"></i> Form Donasi
                    </a>
                    <a href="{{ route('user.donasi.history') }}" class="nav-link-item">
                        <i class="fas fa-history"></i> Riwayat Donasi
                    </a>
                    <a href="{{ route('user.profile') }}" class="nav-link-item">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                    <div style="border-top:1px solid rgba(99,73,237,0.08); margin: 1rem 0 0.75rem;"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-pill w-100" style="font-size:0.9rem; border-radius:999px; padding: 0.55rem 1rem;">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            {{-- Main Form --}}
            <div class="col-lg-9">

                {{-- Alerts --}}
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

                <div class="form-main-card">
                    <div class="form-main-header">
                        <div class="header-icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <div>
                            <h5>Buat Donasi Baru</h5>
                            <p>Isi informasi donasi berikut untuk membantu anak panti.</p>
                        </div>
                    </div>

                    <div class="form-main-body">
                        <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Section: Data Donatur --}}
                            <p class="sidebar-nav-label mb-3">Informasi Donatur</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Donatur</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', Auth::user()->name) }}"
                                        placeholder="Nama lengkap Anda"
                                        required>
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        placeholder="Email aktif Anda"
                                        required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="tel" name="nomor_hp"
                                        class="form-control @error('nomor_hp') is-invalid @enderror"
                                        value="{{ old('nomor_hp', Auth::user()->phone) }}"
                                        placeholder="Contoh: 08123456789"
                                        required>
                                    @error('nomor_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alamat <span style="font-weight:400; text-transform:none; color:#b0adcc;">(opsional)</span></label>
                                    <input type="text" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        value="{{ old('alamat') }}"
                                        placeholder="Alamat Anda">
                                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr class="form-divider">

                            {{-- Section: Jenis Donasi --}}
                            <p class="sidebar-nav-label mb-3">Jenis Donasi</p>
                            <div class="jenis-grid mb-1">
                                @php
                                    $jenisList = [
                                        'uang'                 => ['icon' => 'fas fa-wallet',        'label' => 'Uang'],
                                        'makanan'              => ['icon' => 'fas fa-utensils',       'label' => 'Makanan'],
                                        'pakaian'              => ['icon' => 'fas fa-shirt',          'label' => 'Pakaian'],
                                        'perlengkapan sekolah' => ['icon' => 'fas fa-book',           'label' => 'Perlengkapan Sekolah'],
                                        'mainan'               => ['icon' => 'fas fa-gamepad',        'label' => 'Mainan'],
                                        'lainnya'              => ['icon' => 'fas fa-box-open',       'label' => 'Lainnya'],
                                    ];
                                @endphp
                                @foreach($jenisList as $val => $item)
                                    <div>
                                        <input type="radio" name="jenis_donasi" id="jenis_{{ $loop->index }}"
                                            class="jenis-option @error('jenis_donasi') is-invalid @enderror"
                                            value="{{ $val }}"
                                            {{ old('jenis_donasi') === $val ? 'checked' : '' }}
                                            required>
                                        <label class="jenis-label" for="jenis_{{ $loop->index }}">
                                            <i class="{{ $item['icon'] }}"></i>
                                            {{ $item['label'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('jenis_donasi')<div class="invalid-feedback d-block mb-2">{{ $message }}</div>@enderror

                            <hr class="form-divider">

                            {{-- Section: Detail Donasi --}}
                            <p class="sidebar-nav-label mb-3">Detail Donasi</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nominal / Jumlah</label>
                                    <input type="text" name="jumlah_donasi" id="jumlahInput"
                                        class="form-control @error('jumlah_donasi') is-invalid @enderror"
                                        value="{{ old('jumlah_donasi') }}"
                                        placeholder="Contoh: 100000 atau 5 paket"
                                        required>
                                    @error('jumlah_donasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    {{-- Quick pick (only relevant for uang) --}}
                                    <div class="amount-presets" id="presetContainer">
                                        <button type="button" class="preset-btn" data-val="10000">Rp 10K</button>
                                        <button type="button" class="preset-btn" data-val="25000">Rp 25K</button>
                                        <button type="button" class="preset-btn" data-val="50000">Rp 50K</button>
                                        <button type="button" class="preset-btn" data-val="100000">Rp 100K</button>
                                        <button type="button" class="preset-btn" data-val="500000">Rp 500K</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Donasi</label>
                                    <input type="date" name="tanggal_donasi"
                                        class="form-control @error('tanggal_donasi') is-invalid @enderror"
                                        value="{{ old('tanggal_donasi', now()->format('Y-m-d')) }}"
                                        required>
                                    @error('tanggal_donasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Metode Penyaluran</label>
                                    <div class="row g-2">
                                        @php
                                            $metodeList = [
                                                'Transfer Bank'          => 'fa-building-columns',
                                                'E-Wallet'               => 'fa-mobile-screen',
                                                'Antar Langsung ke Panti'=> 'fa-location-dot',
                                                'Dijemput Petugas'       => 'fa-truck',
                                            ];
                                        @endphp
                                        @foreach($metodeList as $metode => $icon)
                                            <div class="col-6 col-md-3">
                                                <input type="radio" name="metode_penyaluran" id="metode_{{ $loop->index }}"
                                                    class="jenis-option @error('metode_penyaluran') is-invalid @enderror"
                                                    value="{{ $metode }}"
                                                    {{ old('metode_penyaluran') === $metode ? 'checked' : '' }}
                                                    required>
                                                <label class="jenis-label" for="metode_{{ $loop->index }}" style="font-size:0.78rem;">
                                                    <i class="fas {{ $icon }}"></i>
                                                    {{ $metode }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('metode_penyaluran')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Keterangan <span style="font-weight:400; text-transform:none; color:#b0adcc;">(opsional)</span></label>
                                    <textarea name="keterangan"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Tambahkan pesan atau catatan donasi Anda...">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr class="form-divider">

                            {{-- Section: Bukti --}}
                            <p class="sidebar-nav-label mb-3">Bukti Donasi <span style="font-weight:400; text-transform:none; color:#b0adcc;">(opsional)</span></p>
                            <div class="file-drop" id="fileDrop">
                                <input type="file" name="bukti_transfer" id="buktiInput"
                                    accept="image/*,.pdf"
                                    onchange="updateFileName(this)">
                                <div class="file-drop-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                <p class="file-drop-text">Klik atau seret file bukti transfer ke sini</p>
                                <p class="file-drop-text" style="margin-top:0.2rem; font-size:0.76rem; opacity:0.7;">JPG, PNG, atau PDF • Maks. 2MB</p>
                                <p class="file-drop-name" id="fileNameDisplay"></p>
                            </div>
                            @error('bukti_transfer')<div class="invalid-feedback d-block mt-1">{{ $message }}</div>@enderror

                            <div class="mt-4 d-flex align-items-center gap-3 flex-wrap">
                                <button type="submit" class="btn-submit-primary">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Donasi
                                </button>
                                <a href="{{ route('user.dashboard') }}" style="color:#9490b5; font-size:0.9rem; text-decoration:none;">
                                    Batalkan
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>{{-- end col-lg-9 --}}
        </div>{{-- end row --}}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File name display
        const buktiInput = document.getElementById('buktiInput');
        if (buktiInput) {
            buktiInput.addEventListener('change', function() {
                const display = document.getElementById('fileNameDisplay');
                if (display) {
                    display.textContent = this.files[0] ? '📎 ' + this.files[0].name : '';
                }
            });
        }

        // Format angka dengan pemisah titik ribuan
        function formatRupiah(angka) {
            if (!angka) return '';
            let number_string = angka.toString().replace(/[^,\d]/g, ''),
                split   = number_string.split(','),
                sisa    = split[0].length % 3,
                rupiah  = split[0].substr(0, sisa),
                ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
                
            if(ribuan){
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        const jumlahInput = document.getElementById('jumlahInput');
        const presetContainer = document.getElementById('presetContainer');
        const jenisInputs = document.querySelectorAll('[name="jenis_donasi"]');

        function togglePresets() {
            const selected = document.querySelector('[name="jenis_donasi"]:checked');
            if (selected && selected.value === 'uang') {
                if (presetContainer) presetContainer.style.display = 'flex';
                if (jumlahInput) {
                    jumlahInput.value = formatRupiah(jumlahInput.value);
                }
            } else {
                if (presetContainer) presetContainer.style.display = 'none';
            }
        }

        if (jumlahInput) {
            // Event listener saat user mengetik nominal
            jumlahInput.addEventListener('input', function(e) {
                const selected = document.querySelector('[name="jenis_donasi"]:checked');
                if (selected && selected.value === 'uang') {
                    this.value = formatRupiah(this.value);
                }
            });
        }

        // Quick preset amounts
        document.querySelectorAll('.preset-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (jumlahInput) {
                    jumlahInput.value = formatRupiah(btn.dataset.val);
                }
            });
        });

        jenisInputs.forEach(r => r.addEventListener('change', togglePresets));
        togglePresets(); // run on load
    });
</script>
@endsection

