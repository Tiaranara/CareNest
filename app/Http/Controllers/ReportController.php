<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\KebutuhanPanti;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show donasi report page
     */
    public function donasiReport(): View
    {
        return view('reports.donasi');
    }

    /**
     * Generate donasi report PDF
     */
    public function generateDonasiPdf(Request $request): mixed
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $donasi = Donasi::query()
            ->with('donatur')
            ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                return $query->whereDate('tanggal_donasi', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                return $query->whereDate('tanggal_donasi', '<=', $tanggalAkhir);
            })
            ->orderBy('tanggal_donasi', 'desc')
            ->get();

        return view('reports.donasi-pdf', [
            'donasi' => $donasi,
            'tanggalMulai' => $tanggalMulai,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    /**
     * Show kebutuhan report page
     */
    public function kebutuhanReport(): View
    {
        return view('reports.kebutuhan');
    }

    /**
     * Generate kebutuhan report PDF
     */
    public function generateKebutuhanPdf(Request $request): mixed
    {
        $status = $request->input('status');

        $kebutuhan = KebutuhanPanti::query()
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('reports.kebutuhan-pdf', [
            'kebutuhan' => $kebutuhan,
            'status' => $status,
        ]);
    }
}
