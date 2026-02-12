<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiPklController;
use App\Http\Controllers\GuruLoginController;

// ========== PUBLIC ROUTES ==========
Route::get('/login', [GuruLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [GuruLoginController::class, 'login'])->name('login.process');

// ========== PROTECTED ROUTES ==========
Route::middleware(['auth:guru'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [GuruLoginController::class, 'logout'])->name('logout');
    
    // ===== SISWA CRUD =====
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('index');
        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/', [SiswaController::class, 'store'])->name('store');
        Route::get('/{siswa}', [SiswaController::class, 'show'])->name('show');
        Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update');
        Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy');
    });
    
  // ===== NILAI PKL CRUD =====
    Route::prefix('nilai-pkl')->name('nilai-pkl.')->group(function () {
        Route::get('/', [NilaiPklController::class, 'index'])->name('index');
        
        // 🔴 SATU ROUTE UNTUK DUA FUNGSI!
        Route::get('/create', [NilaiPklController::class, 'create'])->name('create');
        
        Route::post('/', [NilaiPklController::class, 'store'])->name('store');
        Route::get('/{nilaiPkl}', [NilaiPklController::class, 'show'])->name('show');
        Route::get('/{nilaiPkl}/edit', [NilaiPklController::class, 'edit'])->name('edit');
        Route::put('/{nilaiPkl}', [NilaiPklController::class, 'update'])->name('update');
        Route::delete('/{nilaiPkl}', [NilaiPklController::class, 'destroy'])->name('destroy');
        Route::get('/{nilaiPkl}/cetak', [NilaiPklController::class, 'cetak'])->name('cetak');
    });
});

// ========== ROOT REDIRECT ==========
Route::get('/', function () {
    if (auth()->guard('guru')->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});