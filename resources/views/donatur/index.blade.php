@extends('layouts.app')

@section('title', 'Data Donatur')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-users"></i> Data Donatur</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('donatur.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('donatur.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ $search }}">
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
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Total Donasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donatur as $item)
                        <tr>
                            <td>{{ ($donatur->currentPage() - 1) * $donatur->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email ?? '-' }}</td>
                            <td>{{ $item->nomor_hp ?? '-' }}</td>
                            <td>Rp {{ number_format($item->getTotalDonasi(), 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-nowrap">
                                    <a href="{{ route('donatur.show', $item) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('donatur.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('donatur.destroy', $item) }}" method="POST" class="d-inline">
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

        @if($donatur->total())
            <div class="mt-3">
                {{ $donatur->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
