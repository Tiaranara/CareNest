@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('styles')
<style>
    /* =====================
       BASE
    ===================== */
    .dashboard-user-page {
        background: #f5f3ff;
        color: #1f1d2b;
        min-height: 100vh;
    }

    .dashboard-page-inner {
        max-width: 1280px;
    }

    /* =====================
       BANNER
    ===================== */
    .banner-card {
        background: linear-gradient(135deg, #6349ed 0%, #9b7ff7 60%, #c4b5fd 100%);
        border-radius: 28px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
        color: #fff;
        margin-bottom: 1.75rem;
        box-shadow: 0 20px 60px rgba(99, 73, 237, 0.28);
    }

    .banner-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 260px;
        height: 260px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .banner-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: 80px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .banner-label {
        display: inline-block;
        background: rgba(255,255,255,0.18);
        color: #fff;
        border-radius: 99px;
        padding: 0.35rem 0.9rem;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 1rem;
        backdrop-filter: blur(4px);
    }

    .banner-title {
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 0.75rem;
        color: #fff;
    }

    .banner-desc {
        color: rgba(255,255,255,0.82);
        font-size: 1rem;
        line-height: 1.7;
        max-width: 520px;
        margin-bottom: 1.5rem;
    }

    .btn-banner-primary {
        background: #fff;
        color: #6349ed;
        border: none;
        border-radius: 999px;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.95rem;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        text-decoration: none;
        display: inline-block;
    }

    .btn-banner-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.15);
        color: #4a2dd4;
    }

    .btn-banner-ghost {
        background: rgba(255,255,255,0.15);
        color: #fff;
        border: 1.5px solid rgba(255,255,255,0.4);
        border-radius: 999px;
        padding: 0.63rem 1.4rem;
        font-weight: 600;
        font-size: 0.95rem;
        backdrop-filter: blur(4px);
        transition: background 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-banner-ghost:hover {
        background: rgba(255,255,255,0.25);
        color: #fff;
    }

    /* Summary pill inside banner */
    .banner-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-top: 1.25rem;
    }

    .banner-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.28);
        color: #fff;
        border-radius: 99px;
        padding: 0.35rem 0.85rem;
        font-size: 0.82rem;
        font-weight: 600;
        backdrop-filter: blur(4px);
    }

    /* Right side summary box */
    .banner-summary-box {
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.22);
        border-radius: 20px;
        padding: 1.75rem;
        backdrop-filter: blur(8px);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .banner-summary-label {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.65);
        margin-bottom: 0.4rem;
    }

    .banner-summary-number {
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 0.35rem;
        line-height: 1.1;
    }

    .banner-summary-sub {
        font-size: 0.88rem;
        color: rgba(255,255,255,0.72);
        margin-bottom: 1rem;
    }

    /* =====================
       STAT CARDS
    ===================== */
    .stat-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 10px 24px rgba(99, 73, 237, 0.05);
        padding: 1.5rem;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 36px rgba(99, 73, 237, 0.1);
    }

    .stat-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #8e8aaf;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.9rem;
        font-weight: 800;
        color: #1f1d2b;
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }

    .stat-footer {
        font-size: 0.87rem;
        color: #8e8aaf;
        margin: 0;
    }

    .bg-purple-soft { background: rgba(124, 92, 196, 0.12); }
    .text-purple    { color: #6349ed; }
    .bg-blue-soft   { background: rgba(59, 130, 246, 0.12); }
    .text-blue      { color: #2563eb; }
    .bg-green-soft  { background: rgba(34, 197, 94, 0.12); }
    .text-green     { color: #16a34a; }
    .bg-orange-soft { background: rgba(249, 115, 22, 0.12); }
    .text-orange    { color: #f97316; }
    .bg-indigo-soft { background: rgba(99, 73, 237, 0.1); }
    .text-indigo    { color: #6349ed; }

    /* =====================
       SIDEBAR NAV CARD
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
        font-size: 0.95rem;
        transition: background 0.18s ease, color 0.18s ease;
        margin-bottom: 0.4rem;
    }

    .nav-link-item i {
        width: 18px;
        text-align: center;
        font-size: 0.88rem;
        opacity: 0.8;
    }

    .nav-link-item:hover,
    .nav-link-item.active {
        background: rgba(124, 92, 196, 0.12);
        color: #3f338f;
    }

    .nav-link-item.active {
        font-weight: 700;
    }

    .nav-link-item.active i {
        opacity: 1;
    }

    /* =====================
       SECTION BLOCKS
    ===================== */
    .section-block {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(112, 96, 247, 0.08);
        box-shadow: 0 10px 24px rgba(99, 73, 237, 0.05);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .section-block-header {
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid rgba(99, 73, 237, 0.07);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .section-block-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f1d2b;
        margin: 0;
    }

    .section-block-sub {
        font-size: 0.87rem;
        color: #8e8aaf;
        margin: 0.15rem 0 0;
    }

    .section-block-body {
        padding: 1.5rem 1.75rem;
    }

    /* =====================
       KEBUTUHAN ITEM CARDS
    ===================== */
    .item-card {
        background: #faf8ff;
        border-radius: 16px;
        border: 1px solid rgba(112, 96, 247, 0.09);
        padding: 1.25rem;
        height: 100%;
        transition: box-shadow 0.18s, transform 0.18s;
    }

    .item-card:hover {
        box-shadow: 0 8px 24px rgba(99, 73, 237, 0.1);
        transform: translateY(-2px);
    }

    .item-card h6 {
        font-weight: 700;
        color: #1f1d2b;
        margin-bottom: 0.2rem;
        font-size: 0.97rem;
    }

    /* Progress bar */
    .prog-track {
        height: 8px;
        background: rgba(124, 92, 196, 0.1);
        border-radius: 99px;
        overflow: hidden;
        margin: 0.85rem 0 0.6rem;
    }

    .prog-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, #7c5cf4, #a78bfa);
        transition: width 0.6s ease;
    }

    .prog-fill.done {
        background: linear-gradient(90deg, #22c55e, #4ade80);
    }

    /* =====================
       ANAK PANTI LIST
    ===================== */
    .child-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.9rem 0;
        border-bottom: 1px solid rgba(99, 73, 237, 0.06);
        gap: 1rem;
    }

    .child-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .child-item:first-child {
        padding-top: 0;
    }

    .avatar-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 0.95rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(99, 73, 237, 0.1);
    }

    .child-name {
        font-weight: 700;
        font-size: 0.97rem;
        color: #1f1d2b;
        margin: 0;
    }

    .child-meta {
        font-size: 0.83rem;
        color: #8e8aaf;
        margin: 0;
    }

    .child-date-label {
        font-size: 0.75rem;
        color: #b0adcc;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .child-date-val {
        font-size: 0.87rem;
        color: #5b5b6a;
        font-weight: 600;
    }

    /* =====================
       DONASI TABLE
    ===================== */
    .donasi-table {
        width: 100%;
        border-collapse: collapse;
    }

    .donasi-table thead tr th {
        font-size: 0.73rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.09em;
        color: #9490b5;
        padding: 0 0.75rem 0.85rem;
        border-bottom: 1px solid rgba(99, 73, 237, 0.08);
    }

    .donasi-table tbody tr td {
        padding: 0.9rem 0.75rem;
        font-size: 0.93rem;
        color: #3a3850;
        border-bottom: 1px solid rgba(99, 73, 237, 0.06);
    }

    .donasi-table tbody tr:last-child td {
        border-bottom: none;
    }

    .donasi-table tbody tr:hover td {
        background: #faf7ff;
    }

    /* =====================
       BADGES
    ===================== */
    .badge-soft-purple {
        background: rgba(124, 92, 196, 0.12);
        color: #6f47d3;
        border-radius: 16px;
        padding: 0.38rem 0.8rem;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-outline {
        background: #f4f0ff;
        color: #5d3bef;
        border-radius: 16px;
        padding: 0.38rem 0.75rem;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-pill-success { background: #eaf9ee; color: #2f8a4b; border-radius: 99px; padding: 0.35rem 0.75rem; font-weight: 600; font-size: 0.78rem; }
    .badge-pill-danger  { background: #ffeaea; color: #c72b3f; border-radius: 99px; padding: 0.35rem 0.75rem; font-weight: 600; font-size: 0.78rem; }
    .badge-pill-warning { background: #fff4d9; color: #b17b3f; border-radius: 99px; padding: 0.35rem 0.75rem; font-weight: 600; font-size: 0.78rem; }
    .badge-pill-info    { background: #e8f4ff; color: #1d72b8; border-radius: 99px; padding: 0.35rem 0.75rem; font-weight: 600; font-size: 0.78rem; }

    /* =====================
       EMPTY STATE
    ===================== */
    .empty-state {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #b0adcc;
    }

    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 0.85rem;
        display: block;
        opacity: 0.4;
    }

    .empty-state p {
        margin: 0;
        font-size: 0.95rem;
    }

    /* =====================
       BUTTONS
    ===================== */
    .btn-pill { border-radius: 999px; padding-left: 1.3rem; padding-right: 1.3rem; }

    .btn-outline-sec {
        border: 1.5px solid #e0d9f7;
        color: #5b5b6a;
        background: #fff;
        border-radius: 999px;
        padding: 0.5rem 1.2rem;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.18s, border-color 0.18s, color 0.18s;
        display: inline-block;
    }

    .btn-outline-sec:hover {
        background: rgba(124, 92, 196, 0.07);
        border-color: #c4b5fd;
        color: #3f338f;
    }

    /* =====================
       RESPONSIVE
    ===================== */
    @media (max-width: 991px) {
        .banner-card { padding: 2rem; }
    }

    /* Live clock */
    .live-clock-wrap {
        text-align: center;
        margin-bottom: 0;
    }

    .live-time {
        font-size: clamp(2.2rem, 4vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        letter-spacing: 0.04em;
        line-height: 1;
        font-variant-numeric: tabular-nums;
        font-family: 'Courier New', monospace;
    }

    .live-date {
        font-size: 0.88rem;
        color: rgba(255,255,255,0.75);
        margin-top: 0.35rem;
        font-weight: 500;
    }

    @media (max-width: 767px) {
        .banner-card {
            padding: 1.75rem;
            border-radius: 20px;
        }

        .stat-card,
        .sidebar-card,
        .section-block,
        .item-card {
            border-radius: 16px;
        }

        .section-block-body {
            padding: 1.25rem;
        }

        .stat-value {
            font-size: 1.65rem;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-user-page container-fluid py-5">
    <div class="dashboard-page-inner mx-auto">

        {{-- ===================== BANNER ===================== --}}
        <div class="banner-card mb-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <span class="banner-label"><i class="fas fa-heart me-1"></i> CareNest</span>
                    <h1 class="banner-title">Halo, {{ Auth::user()->name }}! 👋</h1>
                    <p class="banner-desc">Selamat datang kembali di dashboard CareNest. Bersama-sama kita wujudkan masa depan lebih baik untuk anak-anak panti asuhan.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('user.donasi.create') }}" class="btn-banner-primary">
                            <i class="fas fa-hand-holding-heart me-1"></i> Donasi Sekarang
                        </a>
                        <a href="{{ route('user.donasi.history') }}" class="btn-banner-ghost">
                            <i class="fas fa-history me-1"></i> Riwayat Donasi
                        </a>
                    </div>
                    <div class="banner-pills">
                        <span class="banner-pill"><i class="fas fa-receipt"></i> {{ $userDonationCount }} Transaksi</span>
                        <span class="banner-pill"><i class="fas fa-child"></i> {{ $totalAnakAktif }} Anak Panti Aktif</span>
                        <span class="banner-pill"><i class="fas fa-list-check"></i> {{ $kebutuhanTerpenuhi }} Kebutuhan Terpenuhi</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner-summary-box">
                        {{-- Jam & Tanggal Real-time --}}
                        <div class="live-clock-wrap">
                            <div class="live-time" id="liveClock">--:--:--</div>
                            <div class="live-date" id="liveDate">Memuat...</div>
                        </div>
                        <div style="border-top:1px solid rgba(255,255,255,0.18); margin: 1rem 0;"></div>
                        <div class="banner-summary-label">Total Donasi Anda</div>
                        <div class="banner-summary-number">Rp {{ number_format($userDonasiBelumDiterima, 0, ',', '.') }}</div>
                        <div class="banner-summary-sub">Sejak bergabung di CareNest.</div>
                        <a href="{{ route('user.profile') }}" class="btn-banner-ghost d-inline-flex align-items-center gap-2" style="width:fit-content; font-size:0.88rem;">
                            <i class="fas fa-user-circle"></i> Lihat Profil Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== STAT CARDS ===================== --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
            <div class="col">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <p class="stat-label mb-0">Donasi Saya</p>
                        <div class="stat-card-icon bg-purple-soft text-purple"><i class="fas fa-wallet"></i></div>
                    </div>
                    <div>
                        <div class="stat-value">Rp {{ number_format($userDonasiBelumDiterima, 0, ',', '.') }}</div>
                        <p class="stat-footer">{{ $userDonationCount }} transaksi dilakukan</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <p class="stat-label mb-0">Anak Panti</p>
                        <div class="stat-card-icon bg-blue-soft text-blue"><i class="fas fa-child"></i></div>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalAnakPanti }}</div>
                        <p class="stat-footer">{{ $totalAnakAktif }} masih aktif</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <p class="stat-label mb-0">Kebutuhan Terpenuhi</p>
                        <div class="stat-card-icon bg-green-soft text-green"><i class="fas fa-circle-check"></i></div>
                    </div>
                    <div>
                        <div class="stat-value">{{ $kebutuhanTerpenuhi }}</div>
                        <p class="stat-footer">dari {{ $kebutuhanTerpenuhi + $totalKebutuhan }} total item</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <p class="stat-label mb-0">Permintaan Aktif</p>
                        <div class="stat-card-icon bg-orange-soft text-orange"><i class="fas fa-hand-holding-heart"></i></div>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalKebutuhan }}</div>
                        <p class="stat-footer">kebutuhan belum terpenuhi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== MAIN CONTENT ===================== --}}
        <div class="row g-4">

            {{-- Sidebar Nav --}}
            <div class="col-lg-3">
                <div class="sidebar-card">
                    <p class="sidebar-nav-label">Menu Utama</p>
                    <a href="{{ route('user.dashboard') }}" class="nav-link-item active">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('user.donasi.create') }}" class="nav-link-item">
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
                        <button type="submit" class="btn btn-outline-danger btn-pill w-100" style="font-size:0.92rem;">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            {{-- Main Sections --}}
            <div class="col-lg-9">

                {{-- Kebutuhan Panti --}}
                <div class="section-block">
                    <div class="section-block-header">
                        <div>
                            <h2 class="section-block-title">Kebutuhan Panti Terbaru</h2>
                            <p class="section-block-sub">Kebutuhan prioritas yang memerlukan dukungan Anda.</p>
                        </div>
                        <span class="badge-soft-purple">{{ $kebutuhanTerbaru->count() }} Item</span>
                    </div>
                    <div class="section-block-body">
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            @forelse($kebutuhanTerbaru as $kebutuhan)
                                <div class="col">
                                    <div class="item-card">
                                        <div class="d-flex align-items-start justify-content-between gap-2">
                                            <div>
                                                <h6 class="mb-1">{{ $kebutuhan->nama_kebutuhan }}</h6>
                                                <p class="text-muted mb-0" style="font-size:0.85rem;">Jumlah: {{ $kebutuhan->jumlah_kebutuhan }}</p>
                                            </div>
                                            @if($kebutuhan->status === 'terpenuhi')
                                                <span class="badge-pill-success flex-shrink-0">Terpenuhi</span>
                                            @else
                                                <span class="badge-pill-danger flex-shrink-0">Dibutuhkan</span>
                                            @endif
                                        </div>
                                        <div class="prog-track">
                                            <div class="prog-fill {{ $kebutuhan->status === 'terpenuhi' ? 'done' : '' }}"
                                                 style="width: {{ $kebutuhan->progress }}%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center" style="font-size:0.82rem; color:#9490b5;">
                                            <span>{{ $kebutuhan->progress }}% terpenuhi</span>
                                            <span><i class="fas fa-calendar-alt me-1" style="opacity:0.6;"></i>{{ $kebutuhan->tanggal_pengajuan->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open"></i>
                                        <p>Belum ada kebutuhan panti terbaru saat ini.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Anak Panti --}}
                <div class="section-block">
                    <div class="section-block-header">
                        <div>
                            <h2 class="section-block-title">Anak Panti Terbaru</h2>
                            <p class="section-block-sub">Profil anak panti yang baru bergabung.</p>
                        </div>
                        <a href="{{ route('anak-panti.index') }}" class="btn-outline-sec">
                            Lihat Semua <i class="fas fa-arrow-right ms-1" style="font-size:0.82rem;"></i>
                        </a>
                    </div>
                    <div class="section-block-body" style="padding-top: 0.5rem;">
                        @forelse($anakPantiTerbaru as $anak)
                            <div class="child-item">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle bg-indigo-soft text-indigo" style="font-size:0.85rem;">
                                        {{ strtoupper(substr($anak->nama, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="child-name">{{ $anak->nama }}</p>
                                        <p class="child-meta">Usia {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }} tahun</p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="child-date-label">Masuk</div>
                                    <div class="child-date-val">{{ $anak->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Belum ada data anak panti.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Riwayat Donasi Preview --}}
                <div class="section-block" id="riwayat">
                    <div class="section-block-header">
                        <div>
                            <h2 class="section-block-title">Riwayat Donasi Terakhir</h2>
                            <p class="section-block-sub">Ringkasan donasi terbaru Anda.</p>
                        </div>
                        <a href="{{ route('user.donasi.history') }}" class="btn-outline-sec">
                            Lihat Semua <i class="fas fa-arrow-right ms-1" style="font-size:0.82rem;"></i>
                        </a>
                    </div>
                    <div class="section-block-body" style="padding-top: 0.5rem;">
                        @if($riwayatDonasi->count() > 0)
                            <div class="table-responsive">
                                <table class="donasi-table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Metode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($riwayatDonasi as $donasi)
                                            <tr>
                                                <td>{{ $donasi->tanggal_donasi->format('d M Y') }}</td>
                                                <td>
                                                    @if($donasi->jenis_donasi === 'uang')
                                                        <span class="badge-pill-success">Uang</span>
                                                    @else
                                                        <span class="badge-pill-info">{{ ucfirst($donasi->jenis_donasi) }}</span>
                                                    @endif
                                                </td>
                                                <td style="font-weight:600;">
                                                    @if($donasi->jenis_donasi === 'uang')
                                                        Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}
                                                    @else
                                                        {{ $donasi->jumlah_barang ?? $donasi->jumlah_donasi ?? '—' }}
                                                    @endif
                                                </td>
                                                <td>{{ $donasi->metode_penyaluran ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada riwayat donasi. <a href="{{ route('user.donasi.create') }}" style="color:#6349ed; font-weight:600;">Donasi sekarang →</a></p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>{{-- end col-lg-9 --}}
        </div>{{-- end row main --}}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const liveClock = document.getElementById('liveClock');
        const liveDate = document.getElementById('liveDate');
        
        function updateClock() {
            if (!liveClock || !liveDate) return;
            
            const now = new Date();
            
            // Format waktu (jam:menit:detik)
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            liveClock.textContent = now.toLocaleTimeString('id-ID', timeOptions).replace(/\./g, ':');
            
            // Format tanggal (Hari, Tanggal Bulan Tahun)
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            liveDate.textContent = now.toLocaleDateString('id-ID', dateOptions);
        }
        
        setInterval(updateClock, 1000);
        updateClock(); // Panggil fungsi segera saat halaman dimuat
    });
</script>
@endsection
