<?php

namespace App\Http\Controllers;

use App\Models\AnakPanti;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnakPantiController extends Controller
{
    /**
     * Display a listing of anak panti
     */
    public function index(): View
    {
        $search = request('search');
        
        $anakPanti = AnakPanti::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('anak-panti.index', ['anakPanti' => $anakPanti, 'search' => $search]);
    }

    /**
     * Show form for creating a new anak panti
     */
    public function create(): View
    {
        return view('anak-panti.create');
    }

    /**
     * Store a newly created anak panti
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'status' => 'required|in:aktif,keluar,lainnya',
        ]);

        AnakPanti::create($validated);

        return redirect()->route('anak-panti.index')->with('success', 'Data anak panti berhasil ditambahkan.');
    }

    /**
     * Display the specified anak panti
     */
    public function show(AnakPanti $anakPanti): View
    {
        return view('anak-panti.show', ['anakPanti' => $anakPanti]);
    }

    /**
     * Show form for editing anak panti
     */
    public function edit(AnakPanti $anakPanti): View
    {
        return view('anak-panti.edit', ['anakPanti' => $anakPanti]);
    }

    /**
     * Update the specified anak panti
     */
    public function update(Request $request, AnakPanti $anakPanti): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'status' => 'required|in:aktif,keluar,lainnya',
        ]);

        $anakPanti->update($validated);

        return redirect()->route('anak-panti.show', $anakPanti)->with('success', 'Data anak panti berhasil diperbarui.');
    }

    /**
     * Delete the specified anak panti (admin only)
     */
    public function destroy(AnakPanti $anakPanti): RedirectResponse
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin menghapus data.');
        }

        $anakPanti->delete();

        return redirect()->route('anak-panti.index')->with('success', 'Data anak panti berhasil dihapus.');
    }
}
