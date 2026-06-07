@extends('layouts.app')

@section('title', 'Laporan Donasi')

@section('content')
<div class="page-header mb-4">
    <h2><i class="fas fa-file-pdf"></i> Laporan Donasi</h2>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('reports.generate-donasi-pdf') }}" method="GET">
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Generate PDF</button>
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
