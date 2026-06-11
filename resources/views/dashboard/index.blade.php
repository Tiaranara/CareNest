@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #1e3a5f 100%);
        border-radius: 20px;
        padding: 32px 36px;
        margin-bottom: 32px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, transparent 70%);
        border-radius: 50%;
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: 120px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .dashboard-hero h1 {
        font-size: 1.75rem;
        font-weight: 800;
        margin: 0 0 6px 0;
        letter-spacing: -0.5px;
    }

    .dashboard-hero p {
        margin: 0;
        opacity: 0.75;
        font-size: 0.95rem;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border-radius: 50px;
        padding: 5px 14px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
        color: #a5f3fc;
    }

    .hero-date {
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.08);
        border-radius: 10px;
        padding: 8px 16px;
        font-size: 0.85rem;
        opacity: 0.85;
        margin-top: 12px;
        width: fit-content;
    }

    /* Stat Cards */
    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card-new {
        background: white;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card-new:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.1);
    }

    .stat-card-new::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        border-radius: 0 18px 0 80px;
        opacity: 0.08;
    }

    .stat-card-new.anak::after    { background: #3b82f6; }
    .stat-card-new.donatur::after { background: #10b981; }
    .stat-card-new.donasi::after  { background: #f59e0b; }
    .stat-card-new.kebutuhan::after { background: #ef4444; }

    .stat-card-new .icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 16px;
    }

    .stat-card-new.anak .icon-wrap    { background: #eff6ff; color: #3b82f6; }
    .stat-card-new.donatur .icon-wrap { background: #ecfdf5; color: #10b981; }
    .stat-card-new.donasi .icon-wrap  { background: #fffbeb; color: #f59e0b; }
    .stat-card-new.kebutuhan .icon-wrap { background: #fef2f2; color: #ef4444; }

    .stat-card-new .stat-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #94a3b8;
        margin-bottom: 6px;
    }

    .stat-card-new .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-card-new.donasi .stat-value {
        font-size: 1.4rem;
    }

    .stat-card-new .stat-sub {
        font-size: 0.78rem;
        color: #94a3b8;
    }

    .stat-card-new.anak .stat-sub span    { color: #3b82f6; font-weight: 600; }
    .stat-card-new.donatur .stat-sub span { color: #10b981; font-weight: 600; }
    .stat-card-new.donasi .stat-sub span  { color: #f59e0b; font-weight: 600; }
    .stat-card-new.kebutuhan .stat-sub span { color: #ef4444; font-weight: 600; }

    /* Chart & Info Cards */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .panel-card {
        background: white;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .panel-card .panel-header {
        padding: 20px 24px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-card .panel-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .panel-card .panel-header h6 .panel-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .panel-body {
        padding: 20px 24px;
    }

    /* Quick Actions */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 18px 12px;
        border-radius: 14px;
        text-decoration: none;
        font-size: 0.78rem;
        font-weight: 600;
        text-align: center;
        transition: all 0.2s ease;
        border: 1.5px solid transparent;
    }

    .quick-action-btn .qa-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all 0.2s ease;
    }

    .quick-action-btn:hover {
        transform: translateY(-3px);
    }

    .qa-blue  { background: #eff6ff; color: #3b82f6; border-color: #dbeafe; }
    .qa-blue .qa-icon { background: #dbeafe; color: #3b82f6; }
    .qa-blue:hover { background: #dbeafe; }

    .qa-green { background: #ecfdf5; color: #10b981; border-color: #d1fae5; }
    .qa-green .qa-icon { background: #d1fae5; color: #10b981; }
    .qa-green:hover { background: #d1fae5; }

    .qa-amber { background: #fffbeb; color: #d97706; border-color: #fef3c7; }
    .qa-amber .qa-icon { background: #fef3c7; color: #d97706; }
    .qa-amber:hover { background: #fef3c7; }

    .qa-purple { background: #f5f3ff; color: #7c3aed; border-color: #ede9fe; }
    .qa-purple .qa-icon { background: #ede9fe; color: #7c3aed; }
    .qa-purple:hover { background: #ede9fe; }

    .qa-red   { background: #fef2f2; color: #ef4444; border-color: #fee2e2; }
    .qa-red .qa-icon { background: #fee2e2; color: #ef4444; }
    .qa-red:hover { background: #fee2e2; }

    /* Access list */
    .access-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .access-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
        font-size: 0.875rem;
        color: #475569;
    }

    .access-list li:last-child { border-bottom: none; }

    .access-list .check-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ecfdf5;
        color: #10b981;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        flex-shrink: 0;
    }

    @media (max-width: 1200px) {
        .stat-cards-grid { grid-template-columns: repeat(2, 1fr); }
        .content-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
        .stat-cards-grid { grid-template-columns: 1fr 1fr; }
        .quick-actions-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection

@section('content')

{{-- Hero Header --}}
<div class="dashboard-hero">
    <div class="hero-badge">
        <i class="fas fa-circle" style="font-size:0.5rem; color:#4ade80;"></i>
        SISTEM AKTIF
    </div>
    <h1>👋 Selamat datang, {{ auth()->user()->name }}!</h1>
    <p>Kelola semua data panti asuhan dari satu tempat — CareNest Admin Dashboard.</p>
    <div class="hero-date">
        <i class="fas fa-calendar-alt"></i>
        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

{{-- Stat Cards --}}
<div class="stat-cards-grid">
    {{-- Total Anak Panti --}}
    <div class="stat-card-new anak">
        <div class="icon-wrap"><i class="fas fa-children"></i></div>
        <div class="stat-label">Total Anak Panti</div>
        <div class="stat-value">{{ $totalAnakPanti }}</div>
        <div class="stat-sub"><span>Anak aktif</span> saat ini</div>
    </div>

    {{-- Total Donatur --}}
    <div class="stat-card-new donatur">
        <div class="icon-wrap"><i class="fas fa-users"></i></div>
        <div class="stat-label">Total Donatur</div>
        <div class="stat-value">{{ $totalDonatur }}</div>
        <div class="stat-sub"><span>Donatur</span> terdaftar</div>
    </div>

    {{-- Total Donasi --}}
    <div class="stat-card-new donasi">
        <div class="icon-wrap"><i class="fas fa-hand-holding-heart"></i></div>
        <div class="stat-label">Total Donasi</div>
        <div class="stat-value">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
        <div class="stat-sub"><span>Donasi uang</span> masuk</div>
    </div>

    {{-- Kebutuhan Belum Terpenuhi --}}
    <div class="stat-card-new kebutuhan">
        <div class="icon-wrap"><i class="fas fa-clipboard-list"></i></div>
        <div class="stat-label">Kebutuhan Pending</div>
        <div class="stat-value">{{ $totalKebutuhan }}</div>
        <div class="stat-sub"><span>Belum</span> terpenuhi</div>
    </div>
</div>

{{-- Chart + Info --}}
<div class="content-grid">
    {{-- Chart Panel --}}
    <div class="panel-card">
        <div class="panel-header">
            <h6>
                <span class="panel-icon" style="background:#eff6ff; color:#3b82f6;">
                    <i class="fas fa-chart-line"></i>
                </span>
                Grafik Donasi Bulanan
            </h6>
            <span style="font-size:0.75rem; color:#94a3b8; font-weight:600;">{{ now()->year }}</span>
        </div>
        <div class="panel-body">
            <canvas id="donasiChart" height="90"></canvas>
        </div>
    </div>

    {{-- Quick Access Panel --}}
    <div class="panel-card">
        <div class="panel-header">
            <h6>
                <span class="panel-icon" style="background:#f5f3ff; color:#7c3aed;">
                    <i class="fas fa-bolt"></i>
                </span>
                Akses Cepat
            </h6>
        </div>
        <div class="panel-body">
            <div class="quick-actions-grid">
                <a href="{{ route('anak-panti.index') }}" class="quick-action-btn qa-blue">
                    <span class="qa-icon"><i class="fas fa-children"></i></span>
                    Data Anak
                </a>
                <a href="{{ route('donatur.index') }}" class="quick-action-btn qa-green">
                    <span class="qa-icon"><i class="fas fa-users"></i></span>
                    Donatur
                </a>
                <a href="{{ route('donasi.index') }}" class="quick-action-btn qa-amber">
                    <span class="qa-icon"><i class="fas fa-hand-holding-heart"></i></span>
                    Donasi
                </a>
                <a href="{{ route('kebutuhan-panti.index') }}" class="quick-action-btn qa-red">
                    <span class="qa-icon"><i class="fas fa-clipboard-list"></i></span>
                    Kebutuhan
                </a>
                <a href="{{ route('reports.donasi') }}" class="quick-action-btn qa-purple">
                    <span class="qa-icon"><i class="fas fa-file-pdf"></i></span>
                    Laporan
                </a>
            </div>

            <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                <p style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.6px; color:#94a3b8; margin-bottom:10px;">
                    <i class="fas fa-shield-alt" style="margin-right:5px;"></i>Hak Akses Anda
                </p>
                <ul class="access-list">
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Kelola semua data panti</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Lihat laporan lengkap</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Kelola akun pengguna</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Export laporan PDF</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const donasiData = @json($donasiPerBulan);
        const labels = [];
        const data = [];
        const bulanNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                           'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        donasiData.forEach(item => {
            labels.push(bulanNames[item.bulan] || 'Bln ' + item.bulan);
            data.push(item.total);
        });

        const ctx = document.getElementById('donasiChart').getContext('2d');

        // Gradient fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.25)');
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0.01)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Donasi (Rp)',
                    data: data,
                    borderColor: '#6366f1',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#6366f1',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#4f46e5',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                animation: {
                    duration: 1200,
                    easing: 'easeInOutQuart',
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 10,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 13 },
                        callbacks: {
                            label: function(context) {
                                return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false },
                        border: { display: false },
                        ticks: {
                            font: { size: 11 },
                            color: '#94a3b8',
                            callback: function(value) {
                                if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(0) + 'jt';
                                if (value >= 1000) return 'Rp ' + (value/1000).toFixed(0) + 'rb';
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        border: { display: false },
                        ticks: { font: { size: 11 }, color: '#94a3b8' }
                    }
                }
            }
        });
    });
</script>
@endsection
