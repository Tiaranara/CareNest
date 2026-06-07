@extends('layouts.app')

@section('title', 'Edit Kebutuhan Panti')

@section('content')
<div class="page-header mb-4">
    <h2><i class="fas fa-edit"></i> Edit Kebutuhan Panti</h2>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kebutuhan-panti.update', $kebutuhan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_kebutuhan" class="form-label">Nama Kebutuhan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kebutuhan" id="nama_kebutuhan" class="form-control @error('nama_kebutuhan') is-invalid @enderror" 
                               value="{{ old('nama_kebutuhan', $kebutuhan->nama_kebutuhan) }}" required>
                        @error('nama_kebutuhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_kebutuhan" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_kebutuhan" id="jumlah_kebutuhan" class="form-control @error('jumlah_kebutuhan') is-invalid @enderror" 
                               value="{{ old('jumlah_kebutuhan', $kebutuhan->jumlah_kebutuhan) }}" min="1" required>
                        @error('jumlah_kebutuhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" 
                               class="form-control @error('tanggal_pengajuan') is-invalid @enderror" 
                               value="{{ old('tanggal_pengajuan', $kebutuhan->tanggal_pengajuan->format('Y-m-d')) }}" required>
                        @error('tanggal_pengajuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="belum_terpenuhi" {{ old('status', $kebutuhan->status) === 'belum_terpenuhi' ? 'selected' : '' }}>Belum Terpenuhi</option>
                            <option value="terpenuhi" {{ old('status', $kebutuhan->status) === 'terpenuhi' ? 'selected' : '' }}>Terpenuhi</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" 
                                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $kebutuhan->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('kebutuhan-panti.show', $kebutuhan) }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
