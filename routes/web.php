<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruLoginController;
use App\Http\Controllers\PrakerinController;

// ========== PUBLIC ROUTES ==========
Route::get('/login', [GuruLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [GuruLoginController::class, 'login'])->name('login.process');

// ========== PROTECTED ROUTES ==========
Route::middleware(['auth:guru'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [GuruLoginController::class, 'logout'])->name('logout');
    
    // ============================================
    // ✅ ROUTE PRAKERIN - CRUD LENGKAP
    // ============================================
    Route::resource('prakerin', PrakerinController::class);
    
    // ✅ Route cetak sertifikat individu
    Route::get('prakerin/{prakerin}/cetak', [PrakerinController::class, 'cetak'])
        ->name('prakerin.cetak');
    
    // ✅ Route cetak semua data (laporan)
    Route::get('cetak-semua-prakerin', [PrakerinController::class, 'cetakSemua'])
        ->name('prakerin.cetak.semua');
    
    // ✅ Route cetak sertifikat berdasarkan NIS (dari database CICWA)
    Route::get('cetak-sertifikat/{nis}', [PrakerinController::class, 'cetakSertifikat'])
        ->name('sertifikat.cetak');
    
    // ✅ Route search
    Route::get('cari-prakerin', [PrakerinController::class, 'search'])
        ->name('prakerin.search');
    
    // ✅ Route filter status
    Route::get('filter-prakerin/{status}', [PrakerinController::class, 'filterStatus'])
        ->name('prakerin.filter');
    
    // ✅ Route API / JSON
    Route::get('api-prakerin', [PrakerinController::class, 'apiIndex'])
        ->name('api.prakerin.index');
    
    Route::get('api-prakerin/{prakerin}', [PrakerinController::class, 'apiShow'])
        ->name('api.prakerin.show');
    
    // ✅ Route statistics
    Route::get('statistik-prakerin', [PrakerinController::class, 'getStatistics'])
        ->name('prakerin.statistics');
    
});

// ========== ROOT REDIRECT ==========
Route::get('/', function () {
    if (auth()->guard('guru')->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});