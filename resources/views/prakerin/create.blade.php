<!-- resources/views/prakerin/create.blade.php -->
@extends('layouts.app')

@php
// CEK ROLE USER YANG LOGIN
use Illuminate\Support\Facades\Auth;
$user = Auth::guard('guru')->user();
$isAdmin = $user->is_admin; // true = admin, false = guru
$isGuru = !$user->is_admin;
@endphp

@section('title', 'Input Data PKL Baru - Sistem PKL SMKN 1 Cirebon')
@section('page-title', 'Form Input Data PKL')
@section('page-description', 'Isi data siswa dan nilai sesuai dengan sertifikat PKL')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- ROLE INFO BANNER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert {{ $isAdmin ? 'alert-primary' : 'alert-info' }} alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas {{ $isAdmin ? 'fa-user-cog' : 'fa-chalkboard-teacher' }} fa-2x"></i>
                    </div>
                    <div>
                        <strong>Anda login sebagai: {{ $isAdmin ? 'ADMIN SEKOLAH' : 'GURU PEMBIMBING' }}</strong>
                        <br>
                        <small>
                            @if($isAdmin)
                                ✅ Anda dapat menginput data siswa dan melihat nilai (readonly)
                            @else
                                ✅ Anda hanya dapat menginput nilai (data siswa readonly)
                            @endif
                        </small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>

    <!-- Header dengan gradient navy modern -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-xl position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); border-radius: 20px;">
                <div class="position-absolute top-0 end-0 mt-n10 me-n10 w-40 h-40 bg-white/10 rounded-circle"></div>
                <div class="position-absolute bottom-0 start-0 mb-n10 ms-n10 w-40 h-40 bg-white/10 rounded-circle"></div>
                
                <div class="card-body p-5 position-relative">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl me-4">
                            <i class="fas fa-file-alt text-white fa-2x"></i>
                        </div>
                        <div>
                            <h1 class="display-6 fw-bold text-white mb-2">
                                Form Input Data PKL
                            </h1>
                            <p class="text-white-50 fs-6 mb-0">
                                Isi data siswa dan nilai sesuai dengan sertifikat PKL
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <span class="badge bg-white/20 backdrop-blur-sm text-white rounded-pill px-3 py-2">
                            <i class="fas fa-asterisk text-danger me-1"></i> Wajib diisi
                        </span>
                        <span class="badge bg-white/20 backdrop-blur-sm text-white rounded-pill px-3 py-2">
                            <i class="fas fa-calculator me-1"></i> Hitung otomatis
                        </span>
                        @if($isGuru)
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                            <i class="fas fa-pen me-1"></i> Anda sebagai guru pembimbing
                        </span>
                        @else
                        <span class="badge bg-success text-white rounded-pill px-3 py-2">
                            <i class="fas fa-database me-1"></i>  Anda sebagai admin
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('prakerin.store') }}" id="form-prakerin" onsubmit="return handleFormSubmit(event)" class="space-y-8">
        @csrf
        
        <!-- DATA SISWA - MODERN CARD -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                    <!-- Card Header dengan Biru Navy Gradasi -->
                    <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                <i class="fas fa-user-graduate text-white"></i>
                            </div>
                            <h2 class="h5 fw-bold text-white mb-0">
                                Data Siswa
                            </h2>
                            @if($isGuru)
                            <span class="ms-3 badge bg-warning text-dark">
                                <i class="fas fa-lock me-1"></i> Hanya Admin
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="card-body p-5">
                        <div class="row g-4">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" name="nama" 
                                               value="{{ old('nama') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               placeholder="Nama Siswa" id="nama"
                                               oninput="hideAsterisk('nama')"
                                               required>
                                    </div>
                                    @if($isGuru)
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Data siswa hanya bisa diubah oleh Admin
                                    </div>
                                    @else
                                    <div class="form-text text-muted">Minimal 3 karakter</div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- NIS -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        NIS <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                        <input type="text" name="nis" 
                                               value="{{ old('nis') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               placeholder="12345678"
                                               id="nis"
                                               maxlength="8"
                                               oninput="hideAsterisk('nis')"
                                               required>
                                    </div>
                                    @if(!$isGuru)
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="small text-muted me-2">8 digit angka</span>
                                        <div id="nis-validation" class="small d-none">
                                            <span class="px-2 py-1 rounded-pill bg-danger bg-opacity-10 text-danger">
                                                <i class="fas fa-exclamation-circle me-1"></i> Harus 8 digit
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- TTL -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Tempat, Tanggal Lahir <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <input type="text" name="ttl" 
                                               value="{{ old('ttl') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               placeholder="Cirebon, 15 Januari 2008"
                                               id="ttl"
                                               oninput="hideAsterisk('ttl')"
                                               required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Keahlian -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Paket Keahlian
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-code"></i>
                                        </span>
                                        <input type="text" name="keahlian" 
                                               value="Rekayasa Perangkat Lunak"
                                               readonly
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl bg-gray-50 text-gray-700">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Asal Lembaga -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Asal Lembaga
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-school"></i>
                                        </span>
                                        <input type="text" name="lembaga" 
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl bg-gray-50 text-gray-700"
                                               value="SMK NEGERI 1 KOTA CIREBON" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tempat PKL -->
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Tempat PKL <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <input type="text" name="tempat_pkl" 
                                               value="{{ old('tempat_pkl') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               placeholder="Nama Perusahaan/Instansi"
                                               id="tempat_pkl"
                                               oninput="if({{ $isAdmin ? 'true' : 'false' }}) cekTempatPKL(); hideAsterisk('tempat_pkl')"
                                               required>
                                    </div>
                                    @if($isAdmin)
                                    <div id="tempat_pkl_suggestions" class="position-absolute z-3 w-100 bg-white border border-gray-200 rounded-xl shadow-xl mt-1 p-3 d-none">
                                        <p class="small fw-medium text-blue-600 mb-2 d-flex align-items-center">
                                            <i class="fas fa-lightbulb me-2"></i> Saran Tempat PKL:
                                        </p>
                                        <div id="suggestions_list" class="d-flex flex-column gap-1"></div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Tanggal Mulai -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Tanggal Mulai PKL <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-play-circle"></i>
                                        </span>
                                        <input type="date" name="tgl_mulai" 
                                               value="{{ old('tgl_mulai') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               id="tgl_mulai"
                                               onchange="if({{ $isAdmin ? 'true' : 'false' }}) hideAsterisk('tgl_mulai')"
                                               required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tanggal Selesai -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Tanggal Selesai PKL <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-flag-checkered"></i>
                                        </span>
                                        <input type="date" name="tgl_selesai" 
                                               value="{{ old('tgl_selesai') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               id="tgl_selesai"
                                               onchange="if({{ $isAdmin ? 'true' : 'false' }}) hideAsterisk('tgl_selesai')"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PENILAIAN 10 ASPEK - MODERN CARD -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                    <!-- Card Header dengan Biru Navy Gradasi -->
                    <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                    <i class="fas fa-chart-bar text-white"></i>
                                </div>
                                <div>
                                    <h2 class="h5 fw-bold text-white mb-1">
                                        Penilaian 10 Aspek PKL (0-100)
                                    </h2>
                                    <p class="small text-white-50 mb-0">
                                        @if($isAdmin)
                                            Admin: Lihat nilai (readonly)
                                        @else
                                            Input nilai di sini
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span id="total-nilai-display" class="badge bg-blue-100 text-blue-900 rounded-pill px-3 py-2 fw-bold">
                                    0
                                </span>
                                <span id="rata-rata-display" class="badge bg-green-100 text-green-800 rounded-pill px-3 py-2 fw-bold">
                                    0
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table Container -->
                    <div class="card-body p-5">
                        <div class="table-responsive rounded-xl border border-gray-200">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                                    <tr>
                                        <th class="px-4 py-3 text-uppercase small fw-semibold text-gray-700">
                                            <i class="fas fa-hashtag me-1"></i> No
                                        </th>
                                        <th class="px-4 py-3 text-uppercase small fw-semibold text-gray-700">
                                            <i class="fas fa-list-alt me-1"></i> Aspek Penilaian
                                        </th>
                                        <th class="px-4 py-3 text-uppercase small fw-semibold text-gray-700">
                                            <i class="fas fa-star me-1"></i> Nilai <span class="text-danger">*</span>
                                        </th>
                                        <th class="px-4 py-3 text-uppercase small fw-semibold text-gray-700">
                                            <i class="fas fa-check-circle me-1"></i> Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $aspek_nilai = [
                                        ['name' => 'disiplin', 'label' => 'Disiplin', 'icon' => 'fas fa-clock'],
                                        ['name' => 'tanggung_jawab', 'label' => 'Tanggung Jawab', 'icon' => 'fas fa-tasks'],
                                        ['name' => 'inisiatif', 'label' => 'Inisiatif', 'icon' => 'fas fa-lightbulb'],
                                        ['name' => 'loyalitas', 'label' => 'Loyalitas', 'icon' => 'fas fa-handshake'],
                                        ['name' => 'kerjasama', 'label' => 'Kerjasama', 'icon' => 'fas fa-users'],
                                        ['name' => 'pengambilan_keputusan', 'label' => 'Pengambilan Keputusan', 'icon' => 'fas fa-brain'],
                                        ['name' => 'jiwa_entrepreneur', 'label' => 'Jiwa Entrepreneur', 'icon' => 'fas fa-chart-line'],
                                        ['name' => 'kejujuran', 'label' => 'Kejujuran', 'icon' => 'fas fa-gem'],
                                        ['name' => 'kemampuan_bekerja', 'label' => 'Kemampuan Bekerja', 'icon' => 'fas fa-cogs'],
                                        ['name' => 'hasil_kerja', 'label' => 'Hasil Kerja', 'icon' => 'fas fa-trophy']
                                    ];
                                    ?>
                                    
                                    @foreach($aspek_nilai as $index => $aspek)
                                    <tr class="transition-all duration-150">
                                        <td class="px-4 py-4 text-center">
                                            <div class="d-flex align-items-center justify-content-center mx-auto bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg" style="width: 32px; height: 32px;">
                                                <span class="fw-semibold text-blue-700">{{ $index + 1 }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 bg-gradient-to-r from-gray-100 to-gray-50 rounded-lg me-3">
                                                    <i class="{{ $aspek['icon'] }} text-gray-600"></i>
                                                </div>
                                                <span class="fw-medium text-gray-800">{{ $aspek['label'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative" style="width: 100px;">
                                                    <input type="number" name="{{ $aspek['name'] }}" 
                                                           required min="0" max="100" 
                                                           class="form-control text-center fw-semibold nilai-input {{ $isAdmin ? 'bg-light' : '' }}"
                                                           style="width: 100px; height: 45px; font-size: 16px; padding-right: 35px; display: inline-block; border-radius: 10px;"
                                                           onchange="hitungTotal(); checkAllNilaiFilled()" 
                                                           value="0" 
                                                           id="nilai_{{ $aspek['name'] }}"
                                                           {{ $isAdmin ? 'readonly' : '' }}>
                                                    <span class="position-absolute end-0 top-50 translate-middle-y me-2 text-muted small fw-bold">
                                                        /100
                                                    </span>
                                                </div>
                                                <div id="indicator-{{ $aspek['name'] }}" class="ms-3 rounded-circle shadow-sm" 
                                                     style="width: 20px; height: 20px; background-color: #e9ecef; border: 2px solid white;"></div>
                                            </div>
                                            @if($isAdmin)
                                            <small class="text-muted d-block mt-1">Hanya guru yang dapat menginput nilai</small>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="px-3 py-1 bg-gradient-to-r from-green-100 to-green-50 border border-green-200 rounded-pill">
                                                    <span class="small fw-medium text-green-700 d-flex align-items-center">
                                                        <i class="fas fa-check-circle me-1"></i> Disetujui
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    <!-- Summary Row -->
                                    <tr class="bg-gradient-to-r from-blue-50 to-blue-100 border-top-2 border-blue-200">
                                        <td colspan="2" class="px-4 py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg me-3">
                                                    <i class="fas fa-calculator text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="fw-bold text-gray-800 mb-0">Ringkasan Nilai</p>
                                                    <p class="small text-gray-600 mb-0">Total dan Rata-rata</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <div class="text-center">
                                                        <p class="small text-gray-600 mb-1">Total</p>
                                                        <p id="total-nilai" class="h4 fw-bold text-blue-600 mb-0">0</p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-center">
                                                        <p class="small text-gray-600 mb-1">Rata-rata</p>
                                                        <p id="rata-rata" class="h4 fw-bold text-green-600 mb-0">0</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div id="predikat-container" class="text-center">
                                                <p class="small text-gray-600 mb-1">Predikat</p>
                                                <p id="predikat" class="h6 fw-bold text-gray-800 mb-0">-</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Score Indicator Legend -->
                        <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl">
                            <p class="small fw-medium text-gray-700 mb-2">Indikator Nilai:</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle me-2" style="width: 16px; height: 16px; background-color: #dc3545;"></div>
                                    <span class="small text-gray-600">Rendah (0-69)</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle me-2" style="width: 16px; height: 16px; background-color: #ffc107;"></div>
                                    <span class="small text-gray-600">Cukup (70-79)</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle me-2" style="width: 16px; height: 16px; background-color: #0d6efd;"></div>
                                    <span class="small text-gray-600">Baik (80-89)</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle me-2" style="width: 16px; height: 16px; background-color: #198754;"></div>
                                    <span class="small text-gray-600">Sangat Baik (90-100)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TANDA TANGAN & VALIDASI - MODERN CARD -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                    <!-- Card Header dengan Biru Navy Gradasi -->
                    <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                <i class="fas fa-signature text-white"></i>
                            </div>
                            <h2 class="h5 fw-bold text-white mb-0">
                                Tanda Tangan & Validasi
                            </h2>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="card-body p-5">
                        <div class="row g-4">
                            <!-- Nama Pembimbing - OTOMATIS TERISI DARI USER YANG LOGIN -->
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Nama Pembimbing <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <input type="text" name="nama_pembimbing" 
                                               value="{{ old('nama_pembimbing', $user->nama) }}"
                                               {{ $isGuru ? 'readonly' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light' : '' }}"
                                               placeholder="Nama Guru Pembimbing"
                                               id="nama_pembimbing"
                                               oninput="cekGuruPembimbing(); hideAsterisk('nama_pembimbing')"
                                               required>
                                    </div>
                                    <div id="guru_pembimbing_suggestions" class="position-absolute z-3 w-100 bg-white border border-gray-200 rounded-xl shadow-xl mt-1 p-3 d-none">
                                        <p class="small fw-medium text-blue-600 mb-2 d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher me-2"></i> Saran Guru Pembimbing:
                                        </p>
                                        <div id="guru_suggestions_list" class="d-flex flex-column gap-1"></div>
                                    </div>
                                    @if($isGuru)
                                    <small class="text-muted">
                                        <i class="fas fa-check-circle text-success me-1"></i> 
                                        Nama Anda: <strong>{{ $user->nama }}</strong>
                                    </small>
                                    @else
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1 text-blue-500"></i> 
                                        Nama pembimbing (bisa diganti jika diperlukan)
                                    </small>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Nama Pimpinan/Direktur -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Nama Pimpinan/Direktur <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <input type="text" name="nama_pimpinan" 
                                               value="{{ old('nama_pimpinan') }}"
                                               {{ $isGuru ? 'readonly disabled' : '' }}
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200 {{ $isGuru ? 'bg-light text-muted' : '' }}"
                                               placeholder="Nama Pimpinan/Direktur Perusahaan"
                                               id="nama_pimpinan"
                                               oninput="if({{ $isAdmin ? 'true' : 'false' }}) hideAsterisk('nama_pimpinan')"
                                               required>
                                    </div>
                                    @if($isGuru)
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1 text-blue-500"></i> 
                                        Nama pimpinan hanya bisa diisi Admin
                                    </div>
                                    @else
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1 text-blue-500"></i> 
                                        Nama yang akan tercantum di sertifikat sebagai penanda tangan
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Hidden field untuk tanggal sertifikat (otomatis hari ini) -->
                            <input type="hidden" name="tanggal_sertifikat" value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <!-- Signature Preview -->
                        <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-dashed border-gray-300">
                            <div class="d-flex align-items-center">
                                <div class="p-3 bg-white rounded-lg me-4 shadow-sm">
                                    <i class="fas fa-stamp text-gray-400 fa-2x"></i>
                                </div>
                                <div>
                                    <p class="fw-medium text-gray-800 mb-1">Validasi Digital</p>
                                    <p class="small text-gray-600 mb-0">
                                        Data akan divalidasi secara otomatis setelah disimpan. 
                                        Tanggal sertifikat akan menggunakan tanggal hari ini: <strong>{{ date('d/m/Y') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="sticky-bottom bg-white border-top p-3" style="border-radius: 16px 16px 0 0; box-shadow: 0 -5px 20px rgba(0,0,0,0.05);">
                    <div class="container-fluid">
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2">
                            <!-- Back Button -->
                            <a href="{{ route('prakerin.index') }}" 
                                class="btn btn-outline-primary px-4 py-2 d-flex align-items-center justify-content-center order-2 order-sm-1 w-100 w-sm-auto"
                                style="border-radius: 10px; border-width: 1.5px;">
                                <i class="fas fa-chevron-left me-2"></i>
                                <span class="fw-semibold">Kembali ke Dashboard</span>
                            </a>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-sm-auto order-1 order-sm-2">
                                <button type="submit" 
                                        class="btn btn-success px-4 py-2 d-flex align-items-center justify-content-center"
                                        style="background: linear-gradient(135deg, #059669, #047857); border: none; border-radius: 10px;">
                                    <i class="fas fa-save me-2"></i>
                                    <span class="fw-semibold">Simpan Data PKL</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Form Status -->
                        <div id="form-status" class="mt-3 text-center d-none">
                            <div class="d-inline-flex align-items-center gap-2 bg-light px-3 py-1 rounded-pill">
                                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                <span class="small fw-medium text-primary">Memvalidasi data...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
/* Custom Navy Blue Color Palette */
:root {
    --navy-50: #eff6ff;
    --navy-100: #dbeafe;
    --navy-200: #bfdbfe;
    --navy-300: #93c5fd;
    --navy-400: #60a5fa;
    --navy-500: #3b82f6;
    --navy-600: #2563eb;
    --navy-700: #1d4ed8;
    --navy-800: #1e40af;
    --navy-900: #1e3a8a;
    --navy-950: #172554;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #1e3a8a, #172554);
    border-radius: 10px;
    border: 2px solid #f1f1f1;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #1e40af, #1e3a8a);
}

/* Modern Input Focus Effects */
input:focus, select:focus {
    transform: translateY(-1px);
    box-shadow: 0 15px 30px -10px rgba(30, 64, 175, 0.15), 0 10px 15px -5px rgba(30, 64, 175, 0.1);
    border-color: #1e40af !important;
}

/* Disabled input style */
input:disabled, input[readonly] {
    background-color: #f8f9fa !important;
    cursor: not-allowed;
    opacity: 0.8;
}

/* Modern Card Hover Effects */
.card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
}

/* Modern Table Row Hover */
tbody tr {
    transition: all 0.2s ease;
}

tbody tr:hover {
    background: linear-gradient(90deg, rgba(30, 64, 175, 0.05), rgba(37, 99, 235, 0.05));
}

/* Modern Validation States */
.valid-input {
    border-color: #10b981 !important;
    background: linear-gradient(90deg, rgba(16, 185, 129, 0.05), rgba(34, 197, 94, 0.05));
}

.invalid-input {
    border-color: #ef4444 !important;
    background: linear-gradient(90deg, rgba(239, 68, 68, 0.05), rgba(220, 38, 38, 0.05));
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .sticky-bottom {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 50;
        border-radius: 16px 16px 0 0 !important;
        padding: 1rem !important;
    }
    
    .container-fluid {
        padding-bottom: env(safe-area-inset-bottom, 0);
    }
}

/* Bootstrap Overrides */
.form-control {
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.25);
}

.btn {
    border-radius: 0.75rem;
    padding: 0.5rem 1.25rem;
    font-size: 0.95rem;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

.badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
}

.table {
    margin-bottom: 0;
}

.table th {
    background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #dee2e6;
}

/* Sticky Bottom Fix */
.sticky-bottom {
    position: sticky;
    bottom: 0;
    z-index: 1020;
}
</style>
@endpush

@push('scripts')
<script>
// Database tempat PKL - HANYA UNTUK ADMIN
const tempatPKLDatabase = [
    "PT. NUSABOT",
    "PT. BIN ARIS CORP",
    "CV. LOVRINZ DIGITAL",
    "PT. KAZAH MEDIA",
    "PT. ARKA INFORMATIKA",
    "PT. PINTAR KAPAN SAJA",
    "PT. ELYPHSOFT",
    "PT. CENTRAL COMPUTER",
    "PT. DIGITAL NUSANTARA",
];

// Database guru pembimbing     
const guruPembimbingDatabase = [
    "DUDUNG ZULKIPLI, S.KOM., M.M.",
    "AGUS TRIWIDYANTO, S.T.",
    "RIZAL MURTIYONO, S.KOM.",
    "HERRI HERIYANTO, S.KOM.",
    "DWI PUTRI HANDAYANI, S.PD.",
    "AFIKA AWWALIYAH ROZZAQ, S.PD.",
    "NURHIKMAH, S.KOM.",
    "BAMBANG TRISETIADI, S.KOM.",
];

// CEK ROLE DARI PHP
const isAdmin = {{ $isAdmin ? 'true' : 'false' }};
const isGuru = {{ $isGuru ? 'true' : 'false' }};

// Enhanced hitungTotal with visual indicators
function hitungTotal() {
    let inputs = document.querySelectorAll('.nilai-input');
    let total = 0;
    let jumlahInput = 0;
    
    inputs.forEach(input => {
        let nilai = parseInt(input.value) || 0;
        if (nilai < 0) nilai = 0;
        if (nilai > 100) nilai = 100;
        input.value = nilai;
        total += nilai;
        jumlahInput++;
        
        // Update visual indicator
        updateScoreIndicator(input, nilai);
        
        // Cek apakah nilai sudah diisi
        if (nilai > 0) {
            hideAsterisk(input.id);
        }
    });
    
    let rataRata = jumlahInput > 0 ? (total / jumlahInput).toFixed(2) : 0;
    
    // Update displays
    document.getElementById('total-nilai').textContent = total;
    document.getElementById('rata-rata').textContent = rataRata;
    document.getElementById('total-nilai-display').textContent = total;
    document.getElementById('rata-rata-display').textContent = rataRata;
    
    // Update predikat
    updatePredikat(rataRata);
    
    // Cek apakah semua nilai sudah diisi
    checkAllNilaiFilled();
}

// Update score indicator color
function updateScoreIndicator(input, nilai) {
    const indicator = document.getElementById('indicator-' + input.name);
    if (indicator) {
        indicator.className = 'ms-3 rounded-circle shadow-sm ';
        if (nilai >= 90) {
            indicator.classList.add('bg-success');
        } else if (nilai >= 80) {
            indicator.classList.add('bg-primary');
        } else if (nilai >= 70) {
            indicator.classList.add('bg-warning');
        } else {
            indicator.classList.add('bg-danger');
        }
    }
}

// Update predikat based on average
function updatePredikat(rataRata) {
    const predikatElement = document.getElementById('predikat');
    
    let predikat = '-';
    let colorClass = 'text-gray-800';
    
    if (rataRata >= 90) {
        predikat = 'SANGAT BAIK';
        colorClass = 'text-success';
    } else if (rataRata >= 80) {
        predikat = 'BAIK';
        colorClass = 'text-primary';
    } else if (rataRata >= 70) {
        predikat = 'CUKUP';
        colorClass = 'text-warning';
    } else if (rataRata >= 60) {
        predikat = 'KURANG';
        colorClass = 'text-danger';
    } else if (rataRata > 0) {
        predikat = 'SANGAT KURANG';
        colorClass = 'text-danger fw-bold';
    }
    
    predikatElement.textContent = predikat;
    predikatElement.className = `h6 fw-bold ${colorClass} mb-0`;
}

// Function to handle form submission
function handleFormSubmit(event) {
    event.preventDefault();
    showConfirmAlert('Konfirmasi Simpan', 'Apakah Anda yakin ingin menyimpan data PKL ini?', 'warning', false);
    return false;
}

// Confirmation alert function
function showConfirmAlert(title, message, type = 'warning', isReset = false) {
    const alertHtml = `
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);" id="confirmModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-2xl">
                    <div class="modal-body p-5">
                        <div class="d-flex align-items-start mb-4">
                            <div class="p-3 rounded-3 ${type === 'warning' ? 'bg-warning bg-opacity-10 border border-warning' : 'bg-primary bg-opacity-10 border border-primary'} me-3">
                                <i class="fas ${type === 'warning' ? 'fa-exclamation-triangle text-warning' : 'fa-question-circle text-primary'} fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-2">${title}</h5>
                                <p class="text-muted small mb-0">${message}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button onclick="closeConfirmAlert(false, ${isReset})" 
                                    class="btn btn-light px-4 py-2 rounded-3 border">
                                <i class="fas fa-times me-2"></i> Tidak, Batalkan
                            </button>
                            <button onclick="closeConfirmAlert(true, ${isReset})" 
                                    class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                                <i class="fas fa-check me-2"></i> Ya, Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    const existingAlert = document.getElementById('confirmModal');
    if (existingAlert) existingAlert.remove();
    document.body.insertAdjacentHTML('beforeend', alertHtml);
}

// Function to handle confirmation result
function closeConfirmAlert(result, isReset = false) {
    const alert = document.getElementById('confirmModal');
    if (alert) alert.remove();
    
    if (!result) {
        window.location.href = "{{ route('prakerin.index') }}";
    } else if (result && !isReset) {
        performValidationAndSubmit();
    }
}

// Function to perform validation and submit
function performValidationAndSubmit() {
    const submitBtn = document.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Memproses...';
    submitBtn.disabled = true;
    
    const formStatus = document.getElementById('form-status');
    formStatus.classList.remove('d-none');
    
    // Validation logic - NIS only for admin
    if (isAdmin) {
        const nis = document.getElementById('nis').value;
        const nisRegex = /^[0-9]{8}$/;
        
        if (!nisRegex.test(nis)) {
            showModernAlert('error', 'Validasi NIS Gagal', 'NIS harus tepat 8 digit angka.');
            resetButtonState();
            return false;
        }
    }
    
    const nilaiInputs = document.querySelectorAll('.nilai-input');
    let validNilai = true;
    
    nilaiInputs.forEach(input => {
        const nilai = parseInt(input.value);
        if (isNaN(nilai) || nilai < 0 || nilai > 100) {
            validNilai = false;
            input.classList.add('invalid-input');
        }
    });
    
    if (!validNilai) {
        showModernAlert('error', 'Validasi Nilai Gagal', 'Semua nilai harus antara 0-100!');
        resetButtonState();
        return false;
    }
    
    setTimeout(() => {
        document.getElementById('form-prakerin').submit();
    }, 500);
    
    return true;
}

// Modern alert function
function showModernAlert(type, title, message) {
    const alertHtml = `
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);" id="alertModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-2xl">
                    <div class="modal-body p-5">
                        <div class="d-flex align-items-start mb-4">
                            <div class="p-3 rounded-3 ${type === 'error' ? 'bg-danger bg-opacity-10 border border-danger' : 'bg-success bg-opacity-10 border border-success'} me-3">
                                <i class="fas ${type === 'error' ? 'fa-exclamation-circle text-danger' : 'fa-check-circle text-success'} fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-2">${title}</h5>
                                <p class="text-muted small mb-0">${message}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button onclick="closeModernAlert()" class="btn btn-primary px-4 py-2 rounded-3">
                                Mengerti
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    const existingAlert = document.getElementById('alertModal');
    if (existingAlert) existingAlert.remove();
    document.body.insertAdjacentHTML('beforeend', alertHtml);
}

function closeModernAlert() {
    const alert = document.getElementById('alertModal');
    if (alert) alert.remove();
}

function resetButtonState() {
    const submitBtn = document.querySelector('button[type="submit"]');
    const formStatus = document.getElementById('form-status');
    
    submitBtn.innerHTML = '<i class="fas fa-save me-2"></i><span class="fw-semibold">Simpan Data PKL</span>';
    submitBtn.disabled = false;
    formStatus.classList.add('d-none');
}

// Fungsi untuk cek tempat PKL (HANYA UNTUK ADMIN)
function cekTempatPKL() {
    if (!isAdmin) return; // Hanya admin yang bisa
    
    const input = document.getElementById('tempat_pkl');
    const suggestionsDiv = document.getElementById('tempat_pkl_suggestions');
    const suggestionsList = document.getElementById('suggestions_list');
    
    const value = input.value.trim().toLowerCase();
    suggestionsList.innerHTML = '';
    
    if (value === '') {
        suggestionsDiv.classList.add('d-none');
        return;
    }
    
    const matches = tempatPKLDatabase.filter(tempat => 
        tempat.toLowerCase().includes(value)
    ).slice(0, 5);
    
    if (matches.length > 0) {
        suggestionsDiv.classList.remove('d-none');
        
        matches.forEach(match => {
            const suggestionBtn = document.createElement('button');
            suggestionBtn.type = 'button';
            suggestionBtn.className = 'btn btn-sm bg-blue-50 hover-bg-blue-100 text-blue-700 rounded-lg mb-1 text-start d-flex align-items-center';
            suggestionBtn.style.padding = '0.5rem 1rem';
            suggestionBtn.innerHTML = `<i class="fas fa-building me-2 text-blue-500"></i> ${match}`;
            suggestionBtn.onclick = function() {
                input.value = match;
                suggestionsDiv.classList.add('d-none');
                hideAsterisk('tempat_pkl');
            };
            suggestionsList.appendChild(suggestionBtn);
        });
    } else {
        suggestionsDiv.classList.remove('d-none');
        const noMatchMsg = document.createElement('p');
        noMatchMsg.className = 'small text-gray-600 text-center py-2 mb-0';
        noMatchMsg.innerHTML = '<i class="fas fa-info-circle me-2 text-blue-500"></i> Lanjutkan mengetik manual';
        suggestionsList.appendChild(noMatchMsg);
    }
}

// Fungsi untuk cek guru pembimbing
function cekGuruPembimbing() {
    const input = document.getElementById('nama_pembimbing');
    const suggestionsDiv = document.getElementById('guru_pembimbing_suggestions');
    const suggestionsList = document.getElementById('guru_suggestions_list');
    
    const value = input.value.trim().toLowerCase();
    suggestionsList.innerHTML = '';
    
    if (value === '') {
        suggestionsDiv.classList.add('d-none');
        return;
    }
    
    const matches = guruPembimbingDatabase.filter(guru => 
        guru.toLowerCase().includes(value)
    ).slice(0, 5);
    
    if (matches.length > 0) {
        suggestionsDiv.classList.remove('d-none');
        
        matches.forEach(match => {
            const suggestionBtn = document.createElement('button');
            suggestionBtn.type = 'button';
            suggestionBtn.className = 'btn btn-sm bg-green-50 hover-bg-green-100 text-green-700 rounded-lg mb-1 text-start d-flex align-items-center';
            suggestionBtn.style.padding = '0.5rem 1rem';
            suggestionBtn.innerHTML = `<i class="fas fa-chalkboard-teacher me-2 text-green-500"></i> ${match}`;
            suggestionBtn.onclick = function() {
                input.value = match;
                suggestionsDiv.classList.add('d-none');
                hideAsterisk('nama_pembimbing');
            };
            suggestionsList.appendChild(suggestionBtn);
        });
    } else {
        suggestionsDiv.classList.remove('d-none');
        const noMatchMsg = document.createElement('p');
        noMatchMsg.className = 'small text-gray-600 text-center py-2 mb-0';
        noMatchMsg.innerHTML = '<i class="fas fa-info-circle me-2 text-blue-500"></i> Lanjutkan mengetik manual';
        suggestionsList.appendChild(noMatchMsg);
    }
}

// Fungsi untuk menyembunyikan tanda *
function hideAsterisk(fieldId) {
    const input = document.getElementById(fieldId);
    const label = document.querySelector(`label[for="${fieldId}"]`);
    
    if (input && label) {
        if (input.value.trim() !== '') {
            label.innerHTML = label.innerHTML.replace('<span class="text-danger">*</span>', '');
        } else {
            if (!label.innerHTML.includes('text-danger')) {
                label.innerHTML = label.innerHTML + ' <span class="text-danger">*</span>';
            }
        }
    }
}

function checkAllNilaiFilled() {
    const nilaiInputs = document.querySelectorAll('.nilai-input');
    let allFilled = true;
    
    nilaiInputs.forEach(input => {
        if (input.value === '' || input.value === '0') {
            allFilled = false;
        }
    });
    
    const nilaiLabel = document.querySelector('th:nth-child(3)');
    if (nilaiLabel && allFilled) {
        nilaiLabel.innerHTML = nilaiLabel.innerHTML.replace('<span class="text-danger">*</span>', '');
    }
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    hitungTotal();
    
    document.addEventListener('click', function(event) {
        const tempatPKLSuggestions = document.getElementById('tempat_pkl_suggestions');
        const tempatPKLInput = document.getElementById('tempat_pkl');
        
        if (tempatPKLSuggestions && !tempatPKLSuggestions.contains(event.target) && event.target !== tempatPKLInput) {
            tempatPKLSuggestions.classList.add('d-none');
        }
        
        const guruSuggestions = document.getElementById('guru_pembimbing_suggestions');
        const guruInput = document.getElementById('nama_pembimbing');
        
        if (guruSuggestions && !guruSuggestions.contains(event.target) && event.target !== guruInput) {
            guruSuggestions.classList.add('d-none');
        }
    });
    
    document.querySelectorAll('input[required]').forEach(input => {
        // Skip disabled inputs for validation
        if (!input.disabled) {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('invalid-input');
                    this.classList.remove('valid-input');
                } else {
                    this.classList.add('valid-input');
                    this.classList.remove('invalid-input');
                }
            });
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('form-prakerin').submit();
        }
        if (e.ctrlKey && e.key === 'h') {
            e.preventDefault();
            hitungTotal();
        }
        if (e.key === 'Escape') {
            document.querySelectorAll('.suggestions-div').forEach(div => {
                div.classList.add('d-none');
            });
        }
    });
});
</script>
@endpush