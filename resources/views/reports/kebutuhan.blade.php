@extends('layouts.app')

@section('title', 'Laporan Kebutuhan Panti')

@section('content')
<div class="page-header mb-4">
    <h2><i class="fas fa-file-pdf"></i> Laporan Kebutuhan Panti</h2>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('reports.generate-kebutuhan-pdf') }}" method="GET">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Kebutuhan</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="belum_terpenuhi">Belum Terpenuhi</option>
                            <option value="terpenuhi">Terpenuhi</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Generate PDF</button>
                        <a href="{{ route('kebutuhan-panti.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
