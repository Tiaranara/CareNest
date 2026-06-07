@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header mb-4">
    <h2><i class="fas fa-chart-line"></i> Dashboard</h2>
    <p class="text-muted">Selamat datang di sistem informasi manajemen panti asuhan CareNest</p>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stat-card anak">
            <div class="card-body">
                <i class="fas fa-children"></i>
                <p>Total Anak Panti</p>
                <h4>{{ $totalAnakPanti }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card stat-card donatur">
            <div class="card-body">
                <i class="fas fa-users"></i>
                <p>Total Donatur</p>
                <h4>{{ $totalDonatur }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card stat-card donasi">
            <div class="card-body">
                <i class="fas fa-money-bill-wave"></i>
                <p>Total Donasi</p>
                <h4>Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card stat-card kebutuhan">
            <div class="card-body">
                <i class="fas fa-exclamation-circle"></i>
                <p>Kebutuhan Belum Terpenuhi</p>
                <h4>{{ $totalKebutuhan }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line"></i> Grafik Donasi Bulanan
            </div>
            <div class="card-body">
                <canvas id="donasiChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Cepat
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Akses Aplikasi</h6>
                    @if(auth()->user()->isAdmin())
                        <p class="text-muted">Anda memiliki akses penuh ke seluruh fitur aplikasi sebagai Admin.</p>
                        <ul class="small">
                            <li>Kelola semua data panti</li>
                            <li>Lihat laporan lengkap</li>
                            <li>Kelola akun pengguna</li>
                            <li>Export laporan PDF</li>
                        </ul>
                    @else
                        <p class="text-muted">Anda memiliki akses terbatas sebagai Pengguna.</p>
                        <ul class="small">
                            <li>Lihat data anak panti</li>
                            <li>Lihat data donatur</li>
                            <li>Input data donasi</li>
                            <li>Lihat kebutuhan panti</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prepare data for chart
        const donasiData = @json($donasiPerBulan);
        const labels = [];
        const data = [];
        const bulanNames = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                           'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        donasiData.forEach(item => {
            labels.push(bulanNames[item.bulan] || 'Bulan ' + item.bulan);
            data.push(item.total);
        });

        const ctx = document.getElementById('donasiChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Donasi (Rp)',
                    data: data,
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39, 174, 96, 0.15)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 6,
                    pointBackgroundColor: '#27ae60',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#229954',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart',
                    delay: (context) => {
                        let delay = 0;
                        if (context.type === 'data') {
                            delay = context.dataIndex * 100 + context.datasetIndex * 100;
                        } else if (context.type === 'label') {
                            delay = context.index * 100;
                        }
                        return delay;
                    },
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 13,
                                weight: '500'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
