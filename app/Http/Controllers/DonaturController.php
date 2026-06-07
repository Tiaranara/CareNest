<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    /**
     * Display a listing of donatur
     */
    public function index(): View
    {
        $search = request('search');
        
        $donatur = Donatur::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('donatur.index', ['donatur' => $donatur, 'search' => $search]);
    }

    /**
     * Show form for creating a new donatur
     */
    public function create(): View
    {
        return view('donatur.create');
    }

    /**
     * Store a newly created donatur
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        Donatur::create($validated);

        return redirect()->route('donatur.index')->with('success', 'Data donatur berhasil ditambahkan.');
    }

    /**
     * Display the specified donatur
     */
    public function show(Donatur $donatur): View
    {
        $donasiList = $donatur->donasi()->paginate(10);
        return view('donatur.show', ['donatur' => $donatur, 'donasiList' => $donasiList]);
    }

    /**
     * Show form for editing donatur
     */
    public function edit(Donatur $donatur): View
    {
        return view('donatur.edit', ['donatur' => $donatur]);
    }

    /**
     * Update the specified donatur
     */
    public function update(Request $request, Donatur $donatur): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $donatur->update($validated);

        return redirect()->route('donatur.show', $donatur)->with('success', 'Data donatur berhasil diperbarui.');
    }

    /**
     * Delete the specified donatur (admin only)
     */
    public function destroy(Donatur $donatur): RedirectResponse
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin menghapus data.');
        }

        $donatur->delete();

        return redirect()->route('donatur.index')->with('success', 'Data donatur berhasil dihapus.');
    }
}
