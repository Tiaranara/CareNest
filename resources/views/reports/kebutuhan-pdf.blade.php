<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Kebutuhan Panti</title>
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
        .status-terpenuhi {
            color: green;
            font-weight: bold;
        }
        .status-belum {
            color: red;
            font-weight: bold;
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
        <h2>LAPORAN KEBUTUHAN PANTI ASUHAN</h2>
        <p>SISTEM INFORMASI MANAJEMEN PANTI ASUHAN CARENEST</p>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>

    @if($status)
        <div class="filter-info">
            <strong>Filter Status:</strong>
            @if($status === 'belum_terpenuhi')
                Belum Terpenuhi
            @else
                Terpenuhi
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kebutuhan</th>
                <th>Jumlah</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kebutuhan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kebutuhan }}</td>
                    <td>{{ $item->jumlah_kebutuhan }}</td>
                    <td>{{ $item->tanggal_pengajuan->format('d/m/Y') }}</td>
                    <td>
                        @if($item->status === 'terpenuhi')
                            <span class="status-terpenuhi">✓ Terpenuhi</span>
                        @else
                            <span class="status-belum">✗ Belum Terpenuhi</span>
                        @endif
                    </td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data kebutuhan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right;">
        <p><strong>Total Kebutuhan:</strong> {{ $kebutuhan->count() }}</p>
        <p><strong>Terpenuhi:</strong> {{ $kebutuhan->where('status', 'terpenuhi')->count() }}</p>
        <p><strong>Belum Terpenuhi:</strong> {{ $kebutuhan->where('status', 'belum_terpenuhi')->count() }}</p>
    </div>

    <div class="footer">
        <p>Dikeluarkan oleh: Sistem CareNest</p>
    </div>

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()" class="btn btn-primary">Cetak / Save PDF</button>
        <a href="{{ route('reports.kebutuhan') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
