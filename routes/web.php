<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiPklController;

// SIMPLE AUTH (tanpa controller terpisah)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// TANPA MIDDLEWARE GROUP - Controller handle auth sendiri
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

// Nilai PKL Routes
Route::get('/nilai-pkl', [NilaiPklController::class, 'index'])->name('nilai-pkl.index');
Route::get('/nilai-pkl/create', [NilaiPklController::class, 'create'])->name('nilai-pkl.create');
Route::post('/nilai-pkl', [NilaiPklController::class, 'store'])->name('nilai-pkl.store');
Route::get('/nilai-pkl/{id}', [NilaiPklController::class, 'show'])->name('nilai-pkl.show');
Route::get('/nilai-pkl/{id}/edit', [NilaiPklController::class, 'edit'])->name('nilai-pkl.edit');
Route::put('/nilai-pkl/{id}', [NilaiPklController::class, 'update'])->name('nilai-pkl.update');
Route::delete('/nilai-pkl/{id}', [NilaiPklController::class, 'destroy'])->name('nilai-pkl.destroy');
Route::get('/nilai-pkl/{id}/cetak', [NilaiPklController::class, 'cetak'])->name('nilai-pkl.cetak');
Route::post('/nilai-pkl/{id}/verifikasi', [NilaiPklController::class, 'verifikasi'])->name('nilai-pkl.verifikasi');

// Redirect root
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});