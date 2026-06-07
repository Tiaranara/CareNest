@extends('layouts.app')

@section('title', 'Data Donasi')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-hand-holding-heart"></i> Data Donasi</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin() || auth()->user()->isUser())
                <a href="{{ route('donasi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Donasi
                </a>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('donasi.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama donatur..." value="{{ $search }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Donatur</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasi as $item)
                        <tr>
                            <td>{{ ($donasi->currentPage() - 1) * $donasi->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->tanggal_donasi->format('d/m/Y') }}</td>
                            <td>{{ $item->donatur->nama }}</td>
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
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('donasi.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('donasi.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donasi->total())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 mt-3">
                <div class="pagination-summary text-muted small">
                    Menampilkan {{ $donasi->firstItem() }} - {{ $donasi->lastItem() }} dari {{ $donasi->total() }} data
                </div>
                <nav aria-label="Paginasi Donasi" class="pagination-nav">
                    {{ $donasi->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>
</div>
@endsection
