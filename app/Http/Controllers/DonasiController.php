<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Display a listing of donasi
     */
    public function index(): View
    {
        $search = request('search');
        $tanggalMulai = request('tanggal_mulai');
        $tanggalAkhir = request('tanggal_akhir');
        
        $donasi = Donasi::query()
            ->with('donatur')
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('donatur', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                return $query->whereDate('tanggal_donasi', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                return $query->whereDate('tanggal_donasi', '<=', $tanggalAkhir);
            })
            ->orderBy('tanggal_donasi', 'desc')
            ->paginate(10);

        return view('donasi.index', [
            'donasi' => $donasi,
            'search' => $search,
            'tanggalMulai' => $tanggalMulai,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    /**
     * Show form for creating a new donasi
     */
    public function create(): View
    {
        $donatur = Donatur::all();
        return view('donasi.create', ['donatur' => $donatur]);
    }

    /**
     * Store a newly created donasi
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'donatur_id' => 'required|exists:donatur,id',
            'jenis_donasi' => 'required|in:uang,barang',
            'jumlah_donasi' => 'required|string',
            'tanggal_donasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Donasi::create($validated);

        return redirect()->route('donasi.index')->with('success', 'Data donasi berhasil ditambahkan.');
    }

    /**
     * Display the specified donasi
     */
    public function show(Donasi $donasi): View
    {
        return view('donasi.show', ['donasi' => $donasi]);
    }

    /**
     * Show form for editing donasi
     */
    public function edit(Donasi $donasi): View
    {
        $donatur = Donatur::all();
        return view('donasi.edit', ['donasi' => $donasi, 'donatur' => $donatur]);
    }

    /**
     * Update the specified donasi
     */
    public function update(Request $request, Donasi $donasi): RedirectResponse
    {
        $validated = $request->validate([
            'donatur_id' => 'required|exists:donatur,id',
            'jenis_donasi' => 'required|in:uang,barang',
            'jumlah_donasi' => 'required|string',
            'tanggal_donasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $donasi->update($validated);

        return redirect()->route('donasi.show', $donasi)->with('success', 'Data donasi berhasil diperbarui.');
    }

    /**
     * Delete the specified donasi (admin only)
     */
    public function destroy(Donasi $donasi): RedirectResponse
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin menghapus data.');
        }

        $donasi->delete();

        return redirect()->route('donasi.index')->with('success', 'Data donasi berhasil dihapus.');
    }
}
