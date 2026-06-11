@extends('layouts.app')

@section('title', 'Edit Data Donasi')

@section('content')
<div class="page-header mb-4">
    <h2><i class="fas fa-edit"></i> Edit Data Donasi</h2>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('donasi.update', $donasi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="donatur_id" class="form-label">Donatur <span class="text-danger">*</span></label>
                        <select name="donatur_id" id="donatur_id" class="form-select @error('donatur_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Donatur --</option>
                            @foreach($donatur as $item)
                                <option value="{{ $item->id }}" {{ old('donatur_id', $donasi->donatur_id) == $item->id ? 'selected' : '' }}>
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
                            <option value="uang" {{ old('jenis_donasi', $donasi->jenis_donasi) === 'uang' ? 'selected' : '' }}>Uang</option>
                            <option value="barang" {{ old('jenis_donasi', $donasi->jenis_donasi) === 'barang' ? 'selected' : '' }}>Barang</option>
                        </select>
                        @error('jenis_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_donasi" class="form-label">Jumlah Donasi <span class="text-danger">*</span></label>
                        <input type="text" name="jumlah_donasi" id="jumlah_donasi" class="form-control @error('jumlah_donasi') is-invalid @enderror" 
                               value="{{ old('jumlah_donasi', $donasi->jumlah_donasi) }}" required>
                        @error('jumlah_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_donasi" class="form-label">Tanggal Donasi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_donasi" id="tanggal_donasi" 
                               class="form-control @error('tanggal_donasi') is-invalid @enderror" 
                               value="{{ old('tanggal_donasi', $donasi->tanggal_donasi->format('Y-m-d')) }}" required>
                        @error('tanggal_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" 
                                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $donasi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('donasi.show', $donasi) }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahInput = document.getElementById('jumlah_donasi');
        const jenisSelect = document.getElementById('jenis_donasi');

        function formatRupiah(angka) {
            let number_string = angka.toString().replace(/[^,\d]/g, ''),
                split   = number_string.split(','),
                sisa    = split[0].length % 3,
                rupiah  = split[0].substr(0, sisa),
                ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
                
            if(ribuan){
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        function formatIfUang() {
            if (jenisSelect.value === 'uang') {
                jumlahInput.value = formatRupiah(jumlahInput.value);
            }
        }

        if(jumlahInput && jenisSelect) {
            jumlahInput.addEventListener('input', formatIfUang);
            jenisSelect.addEventListener('change', formatIfUang);
            formatIfUang();
        }
    });
</script>
@endsection
