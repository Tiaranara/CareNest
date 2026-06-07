<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
        }
        .header p {
            margin: 5px 0;
            font-size: 0.9rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background-color: #f0f0f0;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .filter-info {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        @media print {
            body {
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA DONASI</h2>
        <p>SISTEM INFORMASI MANAJEMEN PANTI ASUHAN CARENEST</p>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>

    @if($tanggalMulai || $tanggalAkhir)
        <div class="filter-info">
            <strong>Filter Periode:</strong>
            {{ $tanggalMulai ? date('d/m/Y', strtotime($tanggalMulai)) : 'Awal' }} 
            s/d 
            {{ $tanggalAkhir ? date('d/m/Y', strtotime($tanggalAkhir)) : 'Akhir' }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Donatur</th>
                <th>Jenis Donasi</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal_donasi->format('d/m/Y') }}</td>
                    <td>{{ $item->donatur->nama }}</td>
                    <td>{{ ucfirst($item->jenis_donasi) }}</td>
                    <td>{{ $item->jumlah_donasi }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data donasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dikeluarkan oleh: Sistem CareNest</p>
    </div>

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()" class="btn btn-primary">Cetak / Save PDF</button>
        <a href="{{ route('reports.donasi') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
