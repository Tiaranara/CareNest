@extends('layouts.app')

@section('title', 'Tambah Data Donasi')

@section('content')
<div class="page-header mb-4">
    <h2><i class="fas fa-plus-circle"></i> Tambah Data Donasi</h2>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('donasi.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="donatur_id" class="form-label">Donatur <span class="text-danger">*</span></label>
                        <select name="donatur_id" id="donatur_id" class="form-select @error('donatur_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Donatur --</option>
                            @foreach($donatur as $item)
                                <option value="{{ $item->id }}" {{ old('donatur_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('donatur_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_donasi" class="form-label">Jenis Donasi <span class="text-danger">*</span></label>
                        <select name="jenis_donasi" id="jenis_donasi" class="form-select @error('jenis_donasi') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="uang" {{ old('jenis_donasi') === 'uang' ? 'selected' : '' }}>Uang</option>
                            <option value="barang" {{ old('jenis_donasi') === 'barang' ? 'selected' : '' }}>Barang</option>
                        </select>
                        @error('jenis_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_donasi" class="form-label">Jumlah Donasi <span class="text-danger">*</span></label>
                        <input type="text" name="jumlah_donasi" id="jumlah_donasi" class="form-control @error('jumlah_donasi') is-invalid @enderror" 
                               value="{{ old('jumlah_donasi') }}" placeholder="Rp 100.000 atau nama barang" required>
                        @error('jumlah_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_donasi" class="form-label">Tanggal Donasi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_donasi" id="tanggal_donasi" 
                               class="form-control @error('tanggal_donasi') is-invalid @enderror" 
                               value="{{ old('tanggal_donasi', date('Y-m-d')) }}" required>
                        @error('tanggal_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" 
                                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
