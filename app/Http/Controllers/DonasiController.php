<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $sort = request('sort', 'terbaru');
        
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
            ->when($sort === 'terlama', function ($query) {
                return $query->orderBy('tanggal_donasi', 'asc')->orderBy('created_at', 'asc');
            }, function ($query) {
                return $query->orderBy('tanggal_donasi', 'desc')->orderBy('created_at', 'desc');
            })
            ->paginate(10)
            ->withQueryString();

        return view('donasi.index', [
            'donasi' => $donasi,
            'search' => $search,
            'tanggalMulai' => $tanggalMulai,
            'tanggalAkhir' => $tanggalAkhir,
            'sort' => $sort,
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
            'donatur_id' => 'nullable|exists:donatur,id',
            'nama' => 'required_without:donatur_id|string|max:255',
            'email' => 'required_without:donatur_id|email|max:255',
            'nomor_hp' => 'required_without:donatur_id|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_donasi' => 'required|in:uang,barang,makanan,pakaian,perlengkapan sekolah,mainan,lainnya',
            'jumlah_donasi' => 'nullable|string',
            'jumlah_barang' => 'nullable|string',
            'metode_penyaluran' => 'required|in:Transfer Bank,E-Wallet,Antar Langsung ke Panti,Dijemput Petugas',
            'tanggal_donasi' => 'required|date',
            'bukti_transfer' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if (!empty($validated['donatur_id'])) {
            $donatur = Donatur::find($validated['donatur_id']);
        } else {
            $donatur = Donatur::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'nama' => $validated['nama'],
                    'nomor_hp' => $validated['nomor_hp'],
                    'alamat' => $validated['alamat'] ?? null,
                ]
            );
        }

        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('donasi', 'public');
        }

        $jenisAsli = $validated['jenis_donasi'];
        $jenisDB = ($jenisAsli === 'uang') ? 'uang' : 'barang';

        $jumlahDonasi = $jenisDB === 'uang'
            ? preg_replace('/[^0-9]/', '', $validated['jumlah_donasi'] ?? '0')
            : ($validated['jumlah_barang'] ?? $validated['jumlah_donasi'] ?? '');

        $jumlahBarang = $jenisDB === 'barang'
            ? ($validated['jumlah_barang'] ?? $validated['jumlah_donasi'] ?? '')
            : null;

        $keterangan = $validated['keterangan'] ?? null;
        if ($jenisDB === 'barang' && $jenisAsli !== 'barang') {
            $prefix = ucfirst($jenisAsli);
            $keterangan = $keterangan ? "$prefix - $keterangan" : $prefix;
        }

        $donasiData = [
            'donatur_id' => $donatur->id,
            'user_id' => auth()->id(),
            'jenis_donasi' => $jenisDB,
            'jumlah_donasi' => $jumlahDonasi,
            'jumlah_barang' => $jumlahBarang,
            'tanggal_donasi' => $validated['tanggal_donasi'],
            'metode_penyaluran' => $validated['metode_penyaluran'],
            'bukti_transfer' => $validated['bukti_transfer'] ?? null,
            'keterangan' => $keterangan,
        ];

        Donasi::create($donasiData);

        if (auth()->user()->isAdmin()) {
            return redirect()->route('donasi.index')->with('success', 'Data donasi berhasil ditambahkan.');
        }

        return redirect()->route('user.dashboard')->with('success', 'Donasi Anda berhasil dikirim.');
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

        if ($validated['jenis_donasi'] === 'uang') {
            $validated['jumlah_donasi'] = preg_replace('/[^0-9]/', '', $validated['jumlah_donasi']);
        }

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
