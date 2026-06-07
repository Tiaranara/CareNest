@extends('layouts.app')

@section('title', 'Detail Kebutuhan Panti')

@section('content')
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h2><i class="fas fa-info-circle"></i> Detail Kebutuhan Panti</h2>
        </div>
        <div class="col-auto">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('kebutuhan-panti.edit', $kebutuhan) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('kebutuhan-panti.destroy', $kebutuhan) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            @endif
            <a href="{{ route('kebutuhan-panti.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-details"></i> Informasi Kebutuhan
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Kebutuhan</th>
                        <td>{{ $kebutuhan->nama_kebutuhan }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $kebutuhan->jumlah_kebutuhan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td>{{ $kebutuhan->tanggal_pengajuan->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($kebutuhan->status === 'terpenuhi')
                                <span class="badge bg-success">Terpenuhi</span>
                            @else
                                <span class="badge bg-warning">Belum Terpenuhi</span>
                            @endif
                        </td>
                    </tr>
                    @if($kebutuhan->keterangan)
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $kebutuhan->keterangan }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Tanggal Input</th>
                        <td>{{ $kebutuhan->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $kebutuhan->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if(auth()->user()->isAdmin() && $kebutuhan->status === 'belum_terpenuhi')
            <div class="card mt-3">
                <div class="card-header">
                    <i class="fas fa-check-circle"></i> Tandai Sebagai Terpenuhi
                </div>
                <div class="card-body">
                    <form action="{{ route('kebutuhan-panti.update-status', $kebutuhan) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="status" class="form-label">Ubah Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="belum_terpenuhi" selected>Belum Terpenuhi</option>
                                <option value="terpenuhi">Terpenuhi</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Perbarui Status
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
