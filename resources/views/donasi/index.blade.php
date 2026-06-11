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
                <div class="col-md-7">
                    <input type="text" name="search" class="form-control" placeholder="Cari donatur..." value="{{ $search }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="terbaru" {{ (isset($sort) && $sort === 'terbaru') ? 'selected' : '' }}>Paling Baru</option>
                        <option value="terlama" {{ (isset($sort) && $sort === 'terlama') ? 'selected' : '' }}>Paling Lama</option>
                    </select>
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
                            <td>
                                @if($item->jenis_donasi === 'uang')
                                    Rp {{ number_format((float) $item->jumlah_donasi, 0, ',', '.') }}
                                @else
                                    {{ $item->jumlah_donasi }}
                                @endif
                            </td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-nowrap">
                                    @if($item->bukti_transfer)
                                        <a href="{{ Storage::url($item->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-success" title="Lihat Bukti Transfer">
                                            <i class="fas fa-image"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('donasi.show', $item) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('donasi.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('donasi.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
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
            <div class="mt-3">
                {{ $donasi->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
