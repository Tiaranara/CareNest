@extends('layouts.app')

@section('title', 'Data Anak Panti')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-children"></i> Data Anak Panti</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('anak-panti.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('anak-panti.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau alamat..." value="{{ $search }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anakPanti as $item)
                        <tr>
                            <td>{{ ($anakPanti->currentPage() - 1) * $anakPanti->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tanggal_lahir->format('d/m/Y') }} <span class="text-muted small">({{ $item->getUmur() }} th)</span></td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>
                                @if($item->status === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($item->status === 'keluar')
                                    <span class="badge bg-warning">Keluar</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-nowrap">
                                    <a href="{{ route('anak-panti.show', $item) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('anak-panti.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('anak-panti.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($anakPanti->total())
            <div class="mt-3">
                {{ $anakPanti->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
