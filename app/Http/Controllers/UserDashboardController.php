<?php

namespace App\Http\Controllers;

use App\Models\AnakPanti;
use App\Models\Donasi;
use App\Models\KebutuhanPanti;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Show the user dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get stats from database
        $totalAnakPanti = AnakPanti::where('status', 'aktif')->count();
        $totalKebutuhan = KebutuhanPanti::where('status', 'belum_terpenuhi')->count();
        $kebutuhanTerpenuhi = KebutuhanPanti::where('status', 'terpenuhi')->count();
        
        // Get user's donation data
        $totalDonasiBelumDiterima = Donasi::where('jenis_donasi', 'uang')->sum('jumlah_donasi');
        $userDonasiBelumDiterima = Donasi::where('user_id', $user->id ?? null)
            ->where('jenis_donasi', 'uang')
            ->sum('jumlah_donasi');
        
        $userDonationCount = Donasi::where('user_id', $user->id ?? null)->count();
        
        // Get kebutuhan with progress
        $kebutuhanTerbaru = KebutuhanPanti::orderBy('tanggal_pengajuan', 'desc')
            ->limit(3)
            ->get()
            ->map(function($item) {
                // Calculate progress
                $totalKebutuhan = $item->jumlah_kebutuhan;
                $terpenuhi = $totalKebutuhan * 0.65; // Placeholder - bisa diganti dengan relasi
                $progress = $totalKebutuhan > 0 ? ($terpenuhi / $totalKebutuhan) * 100 : 0;
                $item->progress = (int)$progress;
                return $item;
            });
        
        // Get user donation history
        $riwayatDonasi = Donasi::with('donatur')
            ->where('user_id', $user->id ?? null)
            ->orderBy('tanggal_donasi', 'desc')
            ->limit(4)
            ->get();
        
        // Get anak panti terbaru
        $anakPantiTerbaru = AnakPanti::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        $totalAnakAktif = AnakPanti::where('status', 'aktif')->count();

        return view('dashboard.user-index', [
            'totalAnakPanti' => $totalAnakPanti,
            'totalAnakAktif' => $totalAnakAktif,
            'totalDonasiBelumDiterima' => $totalDonasiBelumDiterima,
            'userDonasiBelumDiterima' => $userDonasiBelumDiterima,
            'userDonationCount' => $userDonationCount,
            'totalKebutuhan' => $totalKebutuhan,
            'kebutuhanTerpenuhi' => $kebutuhanTerpenuhi,
            'kebutuhanTerbaru' => $kebutuhanTerbaru,
            'riwayatDonasi' => $riwayatDonasi,
            'anakPantiTerbaru' => $anakPantiTerbaru,
        ]);
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        return view('dashboard.profile');
    }

    /**
     * Show user donation form
     */
    public function donasiCreate()
    {
        return view('dashboard.user-donasi');
    }

    /**
     * Show user donation history
     */
    public function donasiHistory()
    {
        $riwayatDonasi = Donasi::where('user_id', auth()->id())
            ->orderBy('tanggal_donasi', 'desc')
            ->get();

        return view('dashboard.user-donasi-history', compact('riwayatDonasi'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        auth()->user()->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
