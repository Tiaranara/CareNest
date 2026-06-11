<?php

use App\Http\Controllers\AnakPantiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\KebutuhanPantiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserDashboardController;
use App\Models\AnakPanti;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\KebutuhanPanti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Login & Logout Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'user',
    ]);

    Auth::login($user);

    return redirect('/dashboard');
})->middleware('guest');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Kredensial tidak cocok.',
    ])->onlyInput('email');
})->middleware('guest');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Landing page & Home redirect
Route::get('/', function () {
    $totalAnakPanti = AnakPanti::count();
    $totalDonatur = Donatur::count();
    $totalDonasi = Donasi::where('jenis_donasi', 'uang')->sum('jumlah_donasi');
    $totalKebutuhan = KebutuhanPanti::count();
    $recentAnakPanti = AnakPanti::orderByDesc('id')->get();
    $unfulfilledKebutuhan = KebutuhanPanti::where('status', 'belum_terpenuhi')
        ->orderByDesc('id')
        ->take(4)
        ->get();

    return view('landing', compact(
        'totalAnakPanti',
        'totalDonatur',
        'totalDonasi',
        'totalKebutuhan',
        'recentAnakPanti',
        'unfulfilledKebutuhan'
    ));
})->name('landing');

Route::get('/home', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

Route::middleware('auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            if (auth()->user()->isAdmin()) {
                return app(DashboardController::class)->index();
            }

            return redirect()->route('user.dashboard');
        })->name('dashboard');

        // User Dashboard Routes
        Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/donasi/buat', [UserDashboardController::class, 'donasiCreate'])->name('user.donasi.create');
        Route::get('/donasi/riwayat', [UserDashboardController::class, 'donasiHistory'])->name('user.donasi.history');
        Route::get('/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
        Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
        Route::put('/password', [UserDashboardController::class, 'updatePassword'])->name('user.password.update');
    // Anak Panti Routes
    Route::resource('anak-panti', AnakPantiController::class);

    // Donasi store for authenticated users
    Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

    // Donatur & Donasi management (admin only)
    Route::middleware('admin')->group(function () {
        Route::resource('donatur', DonaturController::class);
        Route::resource('donasi', DonasiController::class)->except(['store']);
    });

    // Kebutuhan Panti Routes
    Route::resource('kebutuhan-panti', KebutuhanPantiController::class);
    Route::post('/kebutuhan-panti/{kebutuhanPanti}/update-status', [KebutuhanPantiController::class, 'updateStatus'])
        ->name('kebutuhan-panti.update-status');

    // Reports Routes (Admin Only)
    Route::middleware('admin')->group(function () {
        Route::get('/reports/donasi', [ReportController::class, 'donasiReport'])->name('reports.donasi');
        Route::get('/reports/donasi-pdf', [ReportController::class, 'generateDonasiPdf'])->name('reports.generate-donasi-pdf');
        Route::get('/reports/kebutuhan', [ReportController::class, 'kebutuhanReport'])->name('reports.kebutuhan');
        Route::get('/reports/kebutuhan-pdf', [ReportController::class, 'generateKebutuhanPdf'])->name('reports.generate-kebutuhan-pdf');
    });
});
