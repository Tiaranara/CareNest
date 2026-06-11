<?php

namespace App\Http\Controllers;

use App\Models\AnakPanti;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\KebutuhanPanti;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index(): View
    {
        $totalAnakPanti = AnakPanti::where('status', 'aktif')->count();
        $totalDonatur = Donatur::count();
        $totalDonasi = Donasi::where('jenis_donasi', 'uang')->sum('jumlah_donasi');
        $totalKebutuhan = KebutuhanPanti::where('status', 'belum_terpenuhi')->count();

        // Get current month
        $currentMonth = now()->month;
        
        // Get monthly donation data for months up to current month
        $donasiPerBulan = Donasi::selectRaw('MONTH(tanggal_donasi) as bulan, SUM(jumlah_donasi) as total')
            ->where('jenis_donasi', 'uang')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        // Create array for months from 1 to current month
        $allMonthsData = [];
        for ($month = 1; $month <= $currentMonth; $month++) {
            $allMonthsData[] = [
                'bulan' => $month,
                'total' => $donasiPerBulan->has($month) ? $donasiPerBulan[$month]->total : 0
            ];
        }

        return view('dashboard.index', [
            'totalAnakPanti' => $totalAnakPanti,
            'totalDonatur' => $totalDonatur,
            'totalDonasi' => $totalDonasi,
            'totalKebutuhan' => $totalKebutuhan,
            'donasiPerBulan' => $allMonthsData,
        ]);
    }
}
