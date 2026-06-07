@extends('layouts.app')

@section('title', 'Detail Data Donasi')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-receipt"></i> Detail Data Donasi</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('donasi.edit', $donasi) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('donasi.destroy', $donasi) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            @endif
            <a href="{{ route('donasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Donasi
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Donatur</th>
                        <td>
                            <a href="{{ route('donatur.show', $donasi->donatur) }}">
                                {{ $donasi->donatur->nama }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Jenis Donasi</th>
                        <td>
                            @if($donasi->jenis_donasi === 'uang')
                                <span class="badge bg-success">Uang</span>
                            @else
                                <span class="badge bg-info">Barang</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Donasi</th>
                        <td>{{ $donasi->jumlah_donasi }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Donasi</th>
                        <td>{{ $donasi->tanggal_donasi->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $donasi->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Input</th>
                        <td>{{ $donasi->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $donasi->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
