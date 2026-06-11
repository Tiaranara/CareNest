<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi - CareNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 40px;
            color: #334155;
            background-color: #f8fafc;
        }
        .report-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 25px;
            border-bottom: 2px solid #e2e8f0;
        }
        .header h2 {
            margin: 0 0 8px 0;
            color: #1e293b;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 4px 0;
            font-size: 14px;
            color: #64748b;
        }
        .filter-info {
            background-color: #f1f5f9;
            padding: 14px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 14px;
            color: #475569;
            border-left: 4px solid #6366f1;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 16px 14px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }
        table td {
            padding: 16px 14px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            vertical-align: top;
            color: #334155;
        }
        table tbody tr:nth-child(even) {
            background-color: #fafaf9;
        }
        .total-row {
            font-weight: 700;
            background-color: #f1f5f9 !important;
            color: #0f172a;
        }
        .total-row td {
            border-top: 2px solid #cbd5e1;
            border-bottom: none;
            padding: 18px 14px;
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #64748b;
            page-break-inside: avoid; /* Prevent footer from splitting across pages */
        }
        .signature-box {
            text-align: center;
            width: 220px;
            white-space: nowrap;
        }
        .signature-line {
            margin-top: 60px;
            padding-top: 10px;
            font-weight: 600;
            color: #334155;
        }
        .no-print {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
        }
        .btn {
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            display: inline-block;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #6366f1;
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }
        .btn-primary:hover {
            background-color: #4f46e5;
            transform: translateY(-1px);
        }
        .btn-secondary {
            background-color: #e2e8f0;
            color: #475569;
            margin-left: 12px;
        }
        .btn-secondary:hover {
            background-color: #cbd5e1;
        }
        @page {
            size: A4 portrait;
            margin: 15mm;
        }
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .report-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
                border-radius: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="header">
            <h2>LAPORAN DATA DONASI</h2>
            <p><strong>SISTEM INFORMASI MANAJEMEN PANTI ASUHAN CARENEST</strong></p>
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
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $totalUang = 0; @endphp
                @forelse($donasi as $item)
                    @if($item->jenis_donasi === 'uang')
                        @php $totalUang += (float) $item->jumlah_donasi; @endphp
                    @endif
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_donasi->format('d/m/Y') }}</td>
                        <td>{{ $item->donatur->nama }}</td>
                        <td>{{ ucfirst($item->jenis_donasi) }}</td>
                        <td style="white-space: nowrap;">
                            @if($item->jenis_donasi === 'uang')
                                Rp {{ number_format((float) $item->jumlah_donasi, 0, ',', '.') }}
                            @else
                                <span style="color: #94a3b8;">-</span>
                            @endif
                        </td>
                        <td>{!! nl2br(e($item->keterangan ?? '-')) !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px; color: #64748b;">Tidak ada data donasi untuk periode ini.</td>
                    </tr>
                @endforelse
                @if($donasi->count() > 0)
                    <tr class="total-row">
                        <td colspan="4" style="text-align: right;">Total Pemasukan Uang:</td>
                        <td colspan="2">Rp {{ number_format($totalUang, 0, ',', '.') }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="footer">
            <div class="print-info">
                <p>Dokumen ini di-generate otomatis oleh Sistem CareNest.</p>
                <p>Status: Sah</p>
            </div>
            <div class="signature-box">
                <p>Mengetahui,</p>
                <p>Pengurus Panti</p>
                <div class="signature-line">
                    ( ......................................... )
                </div>
            </div>
        </div>
    </div>

    <div class="no-print">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak / Save PDF</button>
        <a href="{{ route('reports.donasi') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
