@extends('layouts.app')

@section('title', 'Kebutuhan Panti')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-list"></i> Kebutuhan Panti</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('kebutuhan-panti.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kebutuhan
                </a>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kebutuhan-panti.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama kebutuhan..." value="{{ $search }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="belum_terpenuhi" {{ $status === 'belum_terpenuhi' ? 'selected' : '' }}>Belum Terpenuhi</option>
                        <option value="terpenuhi" {{ $status === 'terpenuhi' ? 'selected' : '' }}>Terpenuhi</option>
                    </select>
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
                        <th>Nama Kebutuhan</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kebutuhan as $item)
                        <tr>
                            <td>{{ ($kebutuhan->currentPage() - 1) * $kebutuhan->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->nama_kebutuhan }}</td>
                            <td>{{ $item->jumlah_kebutuhan }}</td>
                            <td>{{ $item->tanggal_pengajuan->format('d/m/Y') }}</td>
                            <td>
                                @if($item->status === 'terpenuhi')
                                    <span class="badge bg-success">Terpenuhi</span>
                                @else
                                    <span class="badge bg-warning">Belum Terpenuhi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kebutuhan-panti.show', $item) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('kebutuhan-panti.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kebutuhan-panti.destroy', $item) }}" method="POST" class="d-inline">
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
                            <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kebutuhan->total())
            <div class="mt-3">
                {{ $kebutuhan->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
