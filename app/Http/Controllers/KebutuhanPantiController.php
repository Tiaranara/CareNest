<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanPanti;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KebutuhanPantiController extends Controller
{
    /**
     * Display a listing of kebutuhan panti
     */
    public function index(): View
    {
        $search = request('search');
        $status = request('status');
        
        $kebutuhan = KebutuhanPanti::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_kebutuhan', 'like', "%{$search}%");
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(10);

        return view('kebutuhan-panti.index', [
            'kebutuhan' => $kebutuhan,
            'search' => $search,
            'status' => $status,
        ]);
    }

    /**
     * Show form for creating a new kebutuhan panti
     */
    public function create(): View
    {
        return view('kebutuhan-panti.create');
    }

    /**
     * Store a newly created kebutuhan panti
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kebutuhan' => 'required|string|max:255',
            'jumlah_kebutuhan' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:belum_terpenuhi,terpenuhi',
            'keterangan' => 'nullable|string',
        ]);

        KebutuhanPanti::create($validated);

        return redirect()->route('kebutuhan-panti.index')->with('success', 'Kebutuhan panti berhasil ditambahkan.');
    }

    /**
     * Display the specified kebutuhan panti
     */
    public function show(KebutuhanPanti $kebutuhanPanti): View
    {
        return view('kebutuhan-panti.show', ['kebutuhan' => $kebutuhanPanti]);
    }

    /**
     * Show form for editing kebutuhan panti
     */
    public function edit(KebutuhanPanti $kebutuhanPanti): View
    {
        return view('kebutuhan-panti.edit', ['kebutuhan' => $kebutuhanPanti]);
    }

    /**
     * Update the specified kebutuhan panti
     */
    public function update(Request $request, KebutuhanPanti $kebutuhanPanti): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kebutuhan' => 'required|string|max:255',
            'jumlah_kebutuhan' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:belum_terpenuhi,terpenuhi',
            'keterangan' => 'nullable|string',
        ]);

        $kebutuhanPanti->update($validated);

        return redirect()->route('kebutuhan-panti.show', $kebutuhanPanti)->with('success', 'Kebutuhan panti berhasil diperbarui.');
    }

    /**
     * Delete the specified kebutuhan panti (admin only)
     */
    public function destroy(KebutuhanPanti $kebutuhanPanti): RedirectResponse
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin menghapus data.');
        }

        $kebutuhanPanti->delete();

        return redirect()->route('kebutuhan-panti.index')->with('success', 'Kebutuhan panti berhasil dihapus.');
    }

    /**
     * Update status kebutuhan (admin only)
     */
    public function updateStatus(Request $request, KebutuhanPanti $kebutuhanPanti): RedirectResponse
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin mengubah status.');
        }

        $validated = $request->validate([
            'status' => 'required|in:belum_terpenuhi,terpenuhi',
        ]);

        $kebutuhanPanti->update($validated);

        return redirect()->route('kebutuhan-panti.show', $kebutuhanPanti)->with('success', 'Status kebutuhan berhasil diperbarui.');
    }
}
