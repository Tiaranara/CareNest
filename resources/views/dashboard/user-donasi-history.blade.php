@extends('layouts.app')

@section('title', 'Riwayat Donasi')

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
        max-width: 1280px;
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
        display: inline-block;
    }

    .btn-banner-ghost:hover {
        background: rgba(255,255,255,0.26);
        color: #fff;
    }

    .btn-banner-primary {
        background: #fff;
        color: #6349ed;
        border: none;
        border-radius: 999px;
        padding: 0.55rem 1.4rem;
        font-weight: 700;
        font-size: 0.9rem;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        text-decoration: none;
        position: relative;
        z-index: 1;
        display: inline-block;
    }

    .btn-banner-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.13);
        color: #4a2dd4;
    }

    /* Banner stat pills */
    .banner-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-top: 1.25rem;
    }

    .banner-stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 99px;
        padding: 0.4rem 0.9rem;
        font-size: 0.82rem;
        font-weight: 600;
        color: #fff;
        backdrop-filter: blur(4px);
    }

    .banner-stat-pill .stat-num {
        font-size: 1rem;
        font-weight: 800;
    }

    /* =====================
       SIDEBAR
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

    .nav-link-item.active { font-weight: 700; }
    .nav-link-item.active i { opacity: 1; }

    /* =====================
       SUMMARY CARDS
    ===================== */
    .summary-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 8px 20px rgba(99, 73, 237, 0.05);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(99, 73, 237, 0.1);
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .summary-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #9490b5;
        margin-bottom: 0.2rem;
    }

    .summary-value {
        font-size: 1.45rem;
        font-weight: 800;
        color: #1f1d2b;
        line-height: 1.1;
    }

    /* =====================
       TABLE CARD
    ===================== */
    .table-main-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 16px 40px rgba(99, 73, 237, 0.07);
        overflow: hidden;
    }

    .table-main-header {
        padding: 1.35rem 1.75rem;
        border-bottom: 1px solid rgba(99, 73, 237, 0.07);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .table-main-header h5 {
        font-weight: 700;
        color: #1f1d2b;
        margin: 0;
        font-size: 1.05rem;
    }

    .table-main-header p {
        color: #9490b5;
        font-size: 0.85rem;
        margin: 0.15rem 0 0;
    }

    /* Search & filter bar */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        align-items: center;
    }

    .search-wrap {
        position: relative;
        flex: 1 1 200px;
    }

    .search-wrap i {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: #b0adcc;
        font-size: 0.85rem;
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        border: 1.5px solid #e8e3f9;
        background: #faf8ff;
        border-radius: 12px;
        padding: 0.6rem 1rem 0.6rem 2.2rem;
        font-size: 0.9rem;
        color: #1f1d2b;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-input:focus {
        border-color: #9b7ff7;
        box-shadow: 0 0 0 3px rgba(124, 92, 196, 0.1);
    }

    .filter-select {
        border: 1.5px solid #e8e3f9;
        background: #faf8ff;
        border-radius: 12px;
        padding: 0.6rem 0.9rem;
        font-size: 0.88rem;
        color: #4b4a64;
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .filter-select:focus {
        border-color: #9b7ff7;
    }

    /* Table */
    .riwayat-table {
        width: 100%;
        border-collapse: collapse;
    }

    .riwayat-table thead tr th {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.09em;
        color: #9490b5;
        padding: 0.9rem 1.25rem;
        background: #faf7ff;
        border-bottom: 1px solid rgba(99, 73, 237, 0.07);
        white-space: nowrap;
    }

    .riwayat-table tbody tr td {
        padding: 1rem 1.25rem;
        font-size: 0.93rem;
        color: #3a3850;
        border-bottom: 1px solid rgba(99, 73, 237, 0.06);
        vertical-align: middle;
    }

    .riwayat-table tbody tr:last-child td {
        border-bottom: none;
    }

    .riwayat-table tbody tr {
        transition: background 0.15s;
    }

    .riwayat-table tbody tr:hover td {
        background: #faf7ff;
    }

    /* Row no. circle */
    .row-no {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #f3f0fa;
        color: #7c5cf4;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Jenis icon */
    .jenis-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        border-radius: 99px;
        padding: 0.35rem 0.8rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .jenis-uang     { background: #edf9f0; color: #2f8a4b; }
    .jenis-makanan  { background: #fff8e6; color: #b17b0a; }
    .jenis-pakaian  { background: #e8f1ff; color: #1d5db8; }
    .jenis-sekolah  { background: #fef2fe; color: #9b27af; }
    .jenis-mainan   { background: #fff3ea; color: #c05621; }
    .jenis-lainnya  { background: #f3f0fa; color: #5d3bef; }

    /* Metode badge */
    .metode-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #f3f0fa;
        color: #5d3bef;
        border-radius: 10px;
        padding: 0.3rem 0.7rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Nominal */
    .nominal-text {
        font-weight: 700;
        color: #1f1d2b;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(124, 92, 196, 0.08);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #c4b5fd;
        margin: 0 auto 1.25rem;
    }

    .empty-state h6 {
        font-weight: 700;
        color: #1f1d2b;
        margin-bottom: 0.4rem;
    }

    .empty-state p {
        color: #9490b5;
        font-size: 0.93rem;
        margin-bottom: 1.5rem;
    }

    .btn-submit-primary {
        background: linear-gradient(135deg, #7c5cf4 0%, #a78bfa 100%);
        border: none;
        color: #fff;
        font-weight: 700;
        padding: 0.7rem 1.75rem;
        border-radius: 14px;
        font-size: 0.95rem;
        box-shadow: 0 6px 18px rgba(124, 92, 196, 0.25);
        transition: opacity 0.2s, transform 0.18s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-submit-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        color: #fff;
    }

    /* Color tokens */
    .bg-purple-soft { background: rgba(124, 92, 196, 0.12); }
    .text-purple    { color: #6349ed; }
    .bg-green-soft  { background: rgba(34, 197, 94, 0.12); }
    .text-green     { color: #16a34a; }
    .bg-amber-soft  { background: rgba(245, 158, 11, 0.12); }
    .text-amber     { color: #d97706; }

    @media (max-width: 767px) {
        .banner-card { padding: 1.75rem; border-radius: 20px; }
        .table-main-header { padding: 1rem 1.25rem; }
        .riwayat-table thead tr th,
        .riwayat-table tbody tr td { padding: 0.8rem 0.85rem; }
    }
</style>
@endsection

@section('content')
<div class="dashboard-user-page container-fluid py-5">
    <div class="page-inner mx-auto">

        {{-- Banner --}}
        <div class="banner-card mb-4">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <div style="position:relative; z-index:1;">
                    <span class="banner-label"><i class="fas fa-history me-1"></i> CareNest</span>
                    <h1 class="banner-title">Riwayat Donasi</h1>
                    <p class="banner-desc">Semua kontribusi Anda tercatat di sini. Terima kasih telah berbagi kebaikan!</p>
                    @php
                        $totalUang = $riwayatDonasi->where('jenis_donasi', 'uang')->sum('jumlah_donasi');
                        $totalTrx  = $riwayatDonasi->count();
                        $jenisList = $riwayatDonasi->pluck('jenis_donasi')->unique()->count();
                    @endphp
                    <div class="banner-stats">
                        <span class="banner-stat-pill">
                            <i class="fas fa-receipt"></i>
                            <span><span class="stat-num">{{ $totalTrx }}</span> Transaksi</span>
                        </span>
                        <span class="banner-stat-pill">
                            <i class="fas fa-wallet"></i>
                            <span><span class="stat-num">Rp {{ number_format($totalUang, 0, ',', '.') }}</span> Total Uang</span>
                        </span>
                        <span class="banner-stat-pill">
                            <i class="fas fa-layer-group"></i>
                            <span><span class="stat-num">{{ $jenisList }}</span> Jenis Donasi</span>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2" style="position:relative; z-index:1;">
                    <a href="{{ route('user.dashboard') }}" class="btn-banner-ghost">
                        <i class="fas fa-arrow-left me-1"></i> Dashboard
                    </a>
                    <a href="{{ route('user.donasi.create') }}" class="btn-banner-primary">
                        <i class="fas fa-plus me-1"></i> Donasi Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">

            {{-- Sidebar --}}
            <div class="col-lg-3">
                <div class="sidebar-card">
                    <p class="sidebar-nav-label">Menu Utama</p>
                    <a href="{{ route('user.dashboard') }}" class="nav-link-item">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('user.donasi.create') }}" class="nav-link-item">
                        <i class="fas fa-hand-holding-heart"></i> Form Donasi
                    </a>
                    <a href="{{ route('user.donasi.history') }}" class="nav-link-item active">
                        <i class="fas fa-history"></i> Riwayat Donasi
                    </a>
                    <a href="{{ route('user.profile') }}" class="nav-link-item">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                    <div style="border-top:1px solid rgba(99,73,237,0.08); margin: 1rem 0 0.75rem;"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100" style="font-size:0.9rem; border-radius:999px; padding: 0.55rem 1rem;">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9">

                @if($riwayatDonasi->count() > 0)

                    {{-- Summary Micro Cards --}}
                    <div class="row g-3 mb-4">
                        <div class="col-sm-4">
                            <div class="summary-card">
                                <div class="summary-icon bg-purple-soft text-purple">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div>
                                    <div class="summary-label">Total Transaksi</div>
                                    <div class="summary-value">{{ $totalTrx }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="summary-card">
                                <div class="summary-icon bg-green-soft text-green">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div>
                                    <div class="summary-label">Donasi Uang</div>
                                    <div class="summary-value" style="font-size:1.1rem;">Rp {{ number_format($totalUang, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="summary-card">
                                <div class="summary-icon bg-amber-soft text-amber">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div>
                                    <div class="summary-label">Donasi Non-Uang</div>
                                    <div class="summary-value">{{ $riwayatDonasi->where('jenis_donasi', '!=', 'uang')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Table Card --}}
                    <div class="table-main-card">
                        <div class="table-main-header">
                            <div>
                                <h5>Semua Riwayat Donasi</h5>
                                <p>{{ $totalTrx }} donasi tercatat dalam akun Anda.</p>
                            </div>
                            <div class="filter-bar">
                                <div class="search-wrap">
                                    <i class="fas fa-search"></i>
                                    <input class="search-input" type="text" id="searchInput" placeholder="Cari donasi...">
                                </div>
                                <select class="filter-select" id="filterJenis">
                                    <option value="">Semua Jenis</option>
                                    <option value="uang">Uang</option>
                                    <option value="makanan">Makanan</option>
                                    <option value="pakaian">Pakaian</option>
                                    <option value="perlengkapan sekolah">Perlengkapan Sekolah</option>
                                    <option value="mainan">Mainan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="riwayat-table" id="riwayatTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Nominal / Jumlah</th>
                                        <th>Metode Penyaluran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($riwayatDonasi as $i => $donasi)
                                        @php
                                            $jenis = $donasi->jenis_donasi;
                                            $jenisClass = match(true) {
                                                $jenis === 'uang'                  => 'jenis-uang',
                                                $jenis === 'makanan'               => 'jenis-makanan',
                                                $jenis === 'pakaian'               => 'jenis-pakaian',
                                                $jenis === 'perlengkapan sekolah'  => 'jenis-sekolah',
                                                $jenis === 'mainan'                => 'jenis-mainan',
                                                default                            => 'jenis-lainnya',
                                            };
                                            $jenisIcon = match(true) {
                                                $jenis === 'uang'                  => 'fa-wallet',
                                                $jenis === 'makanan'               => 'fa-utensils',
                                                $jenis === 'pakaian'               => 'fa-shirt',
                                                $jenis === 'perlengkapan sekolah'  => 'fa-book',
                                                $jenis === 'mainan'                => 'fa-gamepad',
                                                default                            => 'fa-box-open',
                                            };
                                            $metodeIcon = match(true) {
                                                str_contains($donasi->metode_penyaluran ?? '', 'Transfer')  => 'fa-building-columns',
                                                str_contains($donasi->metode_penyaluran ?? '', 'Wallet')    => 'fa-mobile-screen',
                                                str_contains($donasi->metode_penyaluran ?? '', 'Langsung')  => 'fa-location-dot',
                                                str_contains($donasi->metode_penyaluran ?? '', 'Dijemput')  => 'fa-truck',
                                                default                                                     => 'fa-circle-dot',
                                            };
                                        @endphp
                                        <tr data-jenis="{{ $jenis }}" data-search="{{ strtolower($jenis . ' ' . ($donasi->keterangan ?? '') . ' ' . ($donasi->metode_penyaluran ?? '')) }}">
                                            <td><span class="row-no">{{ $i + 1 }}</span></td>
                                            <td>
                                                <div style="font-weight:600; color:#1f1d2b;">{{ $donasi->tanggal_donasi->format('d M Y') }}</div>
                                                <div style="font-size:0.78rem; color:#b0adcc;">{{ $donasi->tanggal_donasi->format('l') }}</div>
                                            </td>
                                            <td>
                                                <span class="jenis-chip {{ $jenisClass }}">
                                                    <i class="fas {{ $jenisIcon }}"></i>
                                                    {{ ucfirst($jenis) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="nominal-text">
                                                    @if($jenis === 'uang')
                                                        Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}
                                                    @else
                                                        {{ $donasi->jumlah_barang ?? $donasi->jumlah_donasi ?? '—' }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if($donasi->metode_penyaluran)
                                                    <span class="metode-badge">
                                                        <i class="fas {{ $metodeIcon }}"></i>
                                                        {{ $donasi->metode_penyaluran }}
                                                    </span>
                                                @else
                                                    <span style="color:#c4b5fd;">—</span>
                                                @endif
                                            </td>
                                            <td style="max-width:200px;">
                                                <span style="font-size:0.87rem; color:#6b6885;">
                                                    {{ $donasi->keterangan ? \Illuminate\Support\Str::limit($donasi->keterangan, 50) : '—' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- No results row (hidden by default) --}}
                        <div id="noResults" class="empty-state" style="display:none;">
                            <div class="empty-state-icon"><i class="fas fa-search"></i></div>
                            <h6>Tidak ditemukan</h6>
                            <p>Tidak ada donasi yang cocok dengan pencarian Anda.</p>
                        </div>
                    </div>

                @else
                    {{-- Full Empty State --}}
                    <div class="table-main-card">
                        <div class="empty-state">
                            <div class="empty-state-icon"><i class="fas fa-inbox"></i></div>
                            <h6>Belum Ada Riwayat Donasi</h6>
                            <p>Anda belum pernah melakukan donasi. Yuk mulai berbagi kebaikan hari ini!</p>
                            <a href="{{ route('user.donasi.create') }}" class="btn-submit-primary">
                                <i class="fas fa-hand-holding-heart me-2"></i> Donasi Pertama Saya
                            </a>
                        </div>
                    </div>
                @endif

            </div>{{-- end col-lg-9 --}}
        </div>{{-- end row --}}
    </div>
</div>

<script>
    const searchInput   = document.getElementById('searchInput');
    const filterJenis   = document.getElementById('filterJenis');
    const tableBody     = document.getElementById('tableBody');
    const noResults     = document.getElementById('noResults');

    function applyFilter() {
        if (!tableBody) return;

        const keyword = searchInput ? searchInput.value.toLowerCase() : '';
        const jenis   = filterJenis ? filterJenis.value.toLowerCase() : '';
        const rows    = tableBody.querySelectorAll('tr');
        let visible   = 0;

        rows.forEach(row => {
            const rowJenis  = (row.dataset.jenis  || '').toLowerCase();
            const rowSearch = (row.dataset.search || '').toLowerCase();

            const matchJenis  = !jenis   || rowJenis === jenis;
            const matchSearch = !keyword || rowSearch.includes(keyword);

            if (matchJenis && matchSearch) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noResults) {
            noResults.style.display = visible === 0 ? 'block' : 'none';
        }
    }

    if (searchInput) searchInput.addEventListener('input', applyFilter);
    if (filterJenis) filterJenis.addEventListener('change', applyFilter);
</script>
@endsection
