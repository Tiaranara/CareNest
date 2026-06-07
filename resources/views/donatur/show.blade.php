@extends('layouts.app')

@section('title', 'Detail Data Donatur')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-user"></i> Detail Data Donatur</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('donatur.edit', $donatur) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('donatur.destroy', $donatur) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            @endif
            <a href="{{ route('donatur.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Donatur
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Nama</th>
                        <td>{{ $donatur->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $donatur->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>HP</th>
                        <td>{{ $donatur->nomor_hp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $donatur->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-pie"></i> Ringkasan
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Total Donasi:</strong> Rp {{ number_format($donatur->getTotalDonasi(), 0, ',', '.') }}
                </div>
                <div class="mb-2">
                    <strong>Jumlah Donasi:</strong> {{ $donatur->donasi->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-hand-holding-heart"></i> Riwayat Donasi
            </div>
            <div class="card-body">
                @if($donasiList->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donasiList as $item)
                                    <tr>
                                        <td>{{ $item->tanggal_donasi->format('d/m/Y') }}</td>
                                        <td>
                                            @if($item->jenis_donasi === 'uang')
                                                <span class="badge bg-success">Uang</span>
                                            @else
                                                <span class="badge bg-info">Barang</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->jumlah_donasi }}</td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('donasi.show', $item) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mt-3">
                        <div class="text-muted small">
                            Menampilkan {{ $donasiList->firstItem() }} - {{ $donasiList->lastItem() }} dari {{ $donasiList->total() }} donasi
                        </div>
                        <nav aria-label="Paginasi Donasi">
                            {{ $donasiList->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                @else
                    <p class="text-muted">Belum ada riwayat donasi</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
