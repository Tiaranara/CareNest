@extends('layouts.app')

@section('title', 'Detail Data Anak Panti')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-child"></i> Detail Data Anak Panti</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('anak-panti.edit', $anakPanti) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('anak-panti.destroy', $anakPanti) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            @endif
            <a href="{{ route('anak-panti.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Anak Panti
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama</th>
                        <td>{{ $anakPanti->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $anakPanti->tanggal_lahir->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td>{{ $anakPanti->getUmur() }} tahun</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $anakPanti->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $anakPanti->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($anakPanti->status === 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @elseif($anakPanti->status === 'keluar')
                                <span class="badge bg-warning">Keluar</span>
                            @else
                                <span class="badge bg-secondary">{{ $anakPanti->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Input</th>
                        <td>{{ $anakPanti->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $anakPanti->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-file-alt"></i> Ringkasan
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>ID:</strong> #{{ $anakPanti->id }}
                </div>
                <div class="mb-3">
                    <strong>Status Saat Ini:</strong>
                    @if($anakPanti->status === 'aktif')
                        <span class="badge bg-success">Aktif</span>
                    @elseif($anakPanti->status === 'keluar')
                        <span class="badge bg-warning">Keluar</span>
                    @else
                        <span class="badge bg-secondary">{{ $anakPanti->status }}</span>
                    @endif
                </div>
                @if($anakPanti->deleted_at)
                    <div class="alert alert-warning">
                        <strong>Catatan:</strong> Data ini telah dihapus pada {{ $anakPanti->deleted_at->format('d/m/Y H:i') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
