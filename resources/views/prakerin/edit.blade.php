<!-- resources/views/prakerin/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Data PKL - ' . $prakerin->nama)
@section('page-title', 'Form Edit Data PKL')
@section('page-description', 'Edit data siswa dan nilai sesuai dengan sertifikat PKL')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header dengan gradient navy modern -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white shadow-xl position-relative overflow-hidden" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-radius: 20px;">
                <div class="position-absolute top-0 end-0 mt-n10 me-n10 w-40 h-40 bg-white/10 rounded-circle"></div>
                <div class="position-absolute bottom-0 start-0 mb-n10 ms-n10 w-40 h-40 bg-white/10 rounded-circle"></div>
                
                <div class="card-body p-5 position-relative">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl me-4">
                            <i class="fas fa-edit text-white fa-2x"></i>
                        </div>
                        <div>
                            <h1 class="display-6 fw-bold text-white mb-2">
                                Form Edit Data PKL
                            </h1>
                            <p class="text-white-50 fs-6 mb-0">
                                Edit data siswa dan nilai sesuai dengan sertifikat PKL
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
                        <span class="badge bg-white/20 backdrop-blur-sm text-white rounded-pill px-3 py-2">
                            <i class="fas fa-lightbulb me-1"></i> Saran input
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('prakerin.update', $prakerin->id) }}" id="form-prakerin" onsubmit="return handleFormSubmit(event)" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- DATA SISWA - MODERN CARD -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-to-r from-blue-50 to-blue-100 border-bottom border-blue-200 py-4 px-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg me-3">
                                <i class="fas fa-user-graduate text-white"></i>
                            </div>
                            <h2 class="h5 fw-bold text-white mb-0">
                                Data Siswa
                            </h2>
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
                                        <input type="text" name="nama" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               placeholder="Nama Siswa" id="nama"
                                               value="{{ old('nama', $prakerin->nama) }}"
                                               oninput="hideAsterisk('nama')">
                                    </div>
                                    <div class="form-text text-muted">Minimal 3 karakter</div>
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
                                        <input type="text" name="nis" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               placeholder="12345678"
                                               id="nis"
                                               maxlength="8"
                                               value="{{ old('nis', $prakerin->nis) }}"
                                               oninput="hideAsterisk('nis')">
                                    </div>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="small text-muted me-2">8 digit angka</span>
                                        <div id="nis-validation" class="small d-none">
                                            <span class="px-2 py-1 rounded-pill bg-danger bg-opacity-10 text-danger">
                                                <i class="fas fa-exclamation-circle me-1"></i> Harus 8 digit
                                            </span>
                                        </div>
                                    </div>
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
                                        <input type="text" name="ttl" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               placeholder="Cirebon, 15 Januari 2008"
                                               id="ttl"
                                               value="{{ old('ttl', $prakerin->ttl) }}"
                                               oninput="hideAsterisk('ttl')">
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
                                               value="{{ old('keahlian', $prakerin->keahlian) }}"
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
                                               value="{{ old('lembaga', $prakerin->lembaga) }}" readonly>
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
                                        <input type="text" name="tempat_pkl" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               placeholder="Nama Perusahaan/Instansi"
                                               id="tempat_pkl"
                                               value="{{ old('tempat_pkl', $prakerin->tempat_pkl) }}"
                                               oninput="cekTempatPKL(); hideAsterisk('tempat_pkl')">
                                    </div>
                                    <div id="tempat_pkl_suggestions" class="position-absolute z-3 w-100 bg-white border border-gray-200 rounded-xl shadow-xl mt-1 p-3 d-none">
                                        <p class="small fw-medium text-blue-600 mb-2 d-flex align-items-center">
                                            <i class="fas fa-lightbulb me-2"></i> Saran Tempat PKL:
                                        </p>
                                        <div id="suggestions_list" class="d-flex flex-column gap-1"></div>
                                    </div>
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
                                        <input type="date" name="tgl_mulai" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               id="tgl_mulai"
                                               value="{{ old('tgl_mulai', $prakerin->tgl_mulai) }}"
                                               onchange="hideAsterisk('tgl_mulai')">
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
                                        <input type="date" name="tgl_selesai" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               id="tgl_selesai"
                                               value="{{ old('tgl_selesai', $prakerin->tgl_selesai) }}"
                                               onchange="hideAsterisk('tgl_selesai')">
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
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-to-r from-blue-50 to-blue-100 border-bottom border-blue-200 py-4 px-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg me-3">
                                    <i class="fas fa-chart-bar text-white"></i>
                                </div>
                                <div>
                                    <h2 class="h5 fw-bold text-white mb-1">
                                        Penilaian 10 Aspek PKL (0-100)
                                    </h2>
                                    <p class="small text-white mb-0">Edit nilai untuk setiap aspek penilaian</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span id="total-nilai-display" class="badge bg-gradient-to-r from-blue-100 to-blue-50 border border-blue-200 rounded-pill px-3 py-2 fw-bold text-blue-700">
                                    {{ 
                                        $prakerin->disiplin + $prakerin->tanggung_jawab + $prakerin->inisiatif + 
                                        $prakerin->loyalitas + $prakerin->kerjasama + $prakerin->pengambilan_keputusan + 
                                        $prakerin->jiwa_entrepreneur + $prakerin->kejujuran + $prakerin->kemampuan_bekerja + 
                                        $prakerin->hasil_kerja 
                                    }}
                                </span>
                                <span id="rata-rata-display" class="badge bg-gradient-to-r from-green-100 to-green-50 border border-green-200 rounded-pill px-3 py-2 fw-bold text-green-700">
                                    {{ 
                                        number_format((
                                            $prakerin->disiplin + $prakerin->tanggung_jawab + $prakerin->inisiatif + 
                                            $prakerin->loyalitas + $prakerin->kerjasama + $prakerin->pengambilan_keputusan + 
                                            $prakerin->jiwa_entrepreneur + $prakerin->kejujuran + $prakerin->kemampuan_bekerja + 
                                            $prakerin->hasil_kerja 
                                        ) / 10, 2) 
                                    }}
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
                                    @php
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
                                    @endphp
                                    
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
                                                    <input type="number" name="{{ $aspek['name'] }}" required min="0" max="100" 
                                                           class="form-control text-center fw-semibold nilai-input"
                                                           style="width: 100px; height: 45px; font-size: 16px; padding-right: 35px; display: inline-block; border-radius: 10px;"
                                                           onchange="hitungTotal(); checkAllNilaiFilled()" 
                                                           value="{{ old($aspek['name'], $prakerin->{$aspek['name']}) }}" 
                                                           id="nilai_{{ $aspek['name'] }}">
                                                    <span class="position-absolute end-0 top-50 translate-middle-y me-2 text-muted small fw-bold">
                                                        /100
                                                    </span>
                                                </div>
                                                <div id="indicator-{{ $aspek['name'] }}" class="ms-3 rounded-circle shadow-sm" 
                                                     style="width: 20px; height: 20px; background-color: 
                                                        @php
                                                            $nilai = $prakerin->{$aspek['name']};
                                                            if($nilai >= 90) echo '#198754';
                                                            elseif($nilai >= 80) echo '#0d6efd';
                                                            elseif($nilai >= 70) echo '#ffc107';
                                                            else echo '#dc3545';
                                                        @endphp;"></div>
                                            </div>
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
                                                        <p id="total-nilai" class="h4 fw-bold text-blue-600 mb-0">
                                                            {{ 
                                                                $prakerin->disiplin + $prakerin->tanggung_jawab + $prakerin->inisiatif + 
                                                                $prakerin->loyalitas + $prakerin->kerjasama + $prakerin->pengambilan_keputusan + 
                                                                $prakerin->jiwa_entrepreneur + $prakerin->kejujuran + $prakerin->kemampuan_bekerja + 
                                                                $prakerin->hasil_kerja 
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-center">
                                                        <p class="small text-gray-600 mb-1">Rata-rata</p>
                                                        <p id="rata-rata" class="h4 fw-bold text-green-600 mb-0">
                                                            {{ 
                                                                number_format((
                                                                    $prakerin->disiplin + $prakerin->tanggung_jawab + $prakerin->inisiatif + 
                                                                    $prakerin->loyalitas + $prakerin->kerjasama + $prakerin->pengambilan_keputusan + 
                                                                    $prakerin->jiwa_entrepreneur + $prakerin->kejujuran + $prakerin->kemampuan_bekerja + 
                                                                    $prakerin->hasil_kerja 
                                                                ) / 10, 2) 
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div id="predikat-container" class="text-center">
                                                <p class="small text-gray-600 mb-1">Predikat</p>
                                                <p id="predikat" class="h6 fw-bold text-gray-800 mb-0">
                                                    @php
                                                        $rataRata = (
                                                            $prakerin->disiplin + $prakerin->tanggung_jawab + $prakerin->inisiatif + 
                                                            $prakerin->loyalitas + $prakerin->kerjasama + $prakerin->pengambilan_keputusan + 
                                                            $prakerin->jiwa_entrepreneur + $prakerin->kejujuran + $prakerin->kemampuan_bekerja + 
                                                            $prakerin->hasil_kerja 
                                                        ) / 10;
                                                        
                                                        if ($rataRata >= 90) echo 'SANGAT BAIK';
                                                        elseif ($rataRata >= 80) echo 'BAIK';
                                                        elseif ($rataRata >= 70) echo 'CUKUP';
                                                        elseif ($rataRata >= 60) echo 'KURANG';
                                                        else echo 'SANGAT KURANG';
                                                    @endphp
                                                </p>
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

        <!-- TANDA TANGAN & VALIDASI - MODERN CARD (FIXED) -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-to-r from-blue-50 to-blue-100 border-bottom border-blue-200 py-4 px-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg me-3">
                                <i class="fas fa-signature text-white"></i>
                            </div>
                            <h2 class="h5 fw-bold text-white mb-1">
                                Tanda Tangan & Validasi
                            </h2>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="card-body p-5">
                        <div class="row g-4">
                            <!-- Nama Pembimbing -->
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-semibold text-gray-700">
                                        Nama Pembimbing <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-gray-400">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <input type="text" name="nama_pembimbing" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               placeholder="Nama Guru Pembimbing"
                                               id="nama_pembimbing"
                                               value="{{ old('nama_pembimbing', $prakerin->nama_pembimbing) }}"
                                               oninput="cekGuruPembimbing(); hideAsterisk('nama_pembimbing')">
                                    </div>
                                    <div id="guru_pembimbing_suggestions" class="position-absolute z-3 w-100 bg-white border border-gray-200 rounded-xl shadow-xl mt-1 p-3 d-none">
                                        <p class="small fw-medium text-green-600 mb-2 d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher me-2"></i> Saran Guru Pembimbing:
                                        </p>
                                        <div id="guru_suggestions_list" class="d-flex flex-column gap-1"></div>
                                    </div>
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
                                        <input type="text" name="nama_pimpinan" required
                                               class="form-control ps-5 py-3 border-gray-300 rounded-xl focus-ring-2 focus-ring-blue-600 focus-border-blue-500 transition-all duration-200"
                                               placeholder="Nama Pimpinan/Direktur Perusahaan"
                                               id="nama_pimpinan"
                                               value="{{ old('nama_pimpinan', $prakerin->nama_pimpinan ?? '') }}"
                                               oninput="hideAsterisk('nama_pimpinan')">
                                    </div>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1 text-blue-500"></i> 
                                        Nama yang akan tercantum di sertifikat sebagai penanda tangan
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FIX: Tanggal sertifikat otomatis update ke hari ini -->
                            <input type="hidden" name="tanggal_sertifikat" value="{{ date('Y-m-d') }}">
                            
                            <!-- Tampilkan informasi tanggal sertifikat -->
                            <div class="col-12">
                                <div class="alert alert-info bg-blue-50 border border-blue-200 rounded-xl p-3 mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-blue-600 me-3 fa-lg"></i>
                                        <div>
                                            <small class="text-blue-800 d-block">
                                                <span class="fw-semibold">Tanggal Sertifikat:</span> {{ date('d/m/Y') }} (otomatis mengikuti tanggal hari ini)
                                            </small>
                                            <small class="text-blue-600 d-block mt-1">
                                                <i class="fas fa-clock me-1"></i> Setiap kali update, tanggal sertifikat akan diperbarui ke hari ini
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        Data akan divalidasi secara otomatis setelah diperbarui. 
                                        Tanggal sertifikat akan menggunakan tanggal hari ini: <strong class="text-blue-600">{{ date('d/m/Y') }}</strong>
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
                                <button type="button" onclick="hitungTotal(); checkAllNilaiFilled()" 
                                        class="btn btn-primary px-4 py-2 d-flex align-items-center justify-content-center"
                                        style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; border-radius: 10px;">
                                    <i class="fas fa-calculator me-2"></i>
                                    <span class="fw-semibold">Hitung Ulang</span>
                                </button>
                                
                                <button type="submit" 
                                        class="btn btn-success px-4 py-2 d-flex align-items-center justify-content-center"
                                        style="background: linear-gradient(135deg, #059669, #047857); border: none; border-radius: 10px;">
                                    <i class="fas fa-save me-2"></i>
                                    <span class="fw-semibold">Update Data PKL</span>
                                </button>
                                
                                <button type="button" onclick="showConfirmAlert('Konfirmasi Reset', 'Apakah Anda yakin ingin mengembalikan semua data ke nilai awal? Semua perubahan akan hilang.', 'warning', true)"
                                        class="btn btn-warning px-4 py-2 d-flex align-items-center justify-content-center"
                                        style="background: linear-gradient(135deg, #f59e0b, #d97706); border: none; border-radius: 10px;">
                                    <i class="fas fa-undo me-2"></i>
                                    <span class="fw-semibold">Reset</span>
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

@push('scripts')
<script>
// Database tempat PKL
const tempatPKLDatabase = [
    "PT. NUSABOT TEKNOLOGI INDONESIA",
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

// Store original values for reset
let originalValues = {};

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
    showConfirmAlert('Konfirmasi Update', 'Apakah Anda yakin ingin mengupdate data PKL ini?', 'warning', false);
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
                                <i class="fas fa-check me-2"></i> Ya, Update
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
    
    if (result && isReset) {
        resetFormData();
    } else if (!result) {
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
    
    // Validation logic
    const nis = document.getElementById('nis').value;
    const nisRegex = /^[0-9]{8}$/;
    
    if (!nisRegex.test(nis)) {
        showModernAlert('error', 'Validasi NIS Gagal', 'NIS harus tepat 8 digit angka.');
        resetButtonState();
        return false;
    }
    
    const nama = document.getElementById('nama').value;
    if (nama.length < 3) {
        showModernAlert('error', 'Validasi Nama Gagal', 'Nama harus minimal 3 karakter!');
        resetButtonState();
        return false;
    }
    
    const tglMulai = document.getElementById('tgl_mulai').value;
    const tglSelesai = document.getElementById('tgl_selesai').value;
    
    if (tglMulai && tglSelesai) {
        const mulai = new Date(tglMulai);
        const selesai = new Date(tglSelesai);
        
        if (selesai < mulai) {
            showModernAlert('error', 'Validasi Tanggal Gagal', 'Tanggal selesai harus setelah tanggal mulai!');
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
        } else {
            input.classList.remove('invalid-input');
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
    
    submitBtn.innerHTML = '<i class="fas fa-save me-2"></i><span class="fw-semibold">Update Data PKL</span>';
    submitBtn.disabled = false;
    formStatus.classList.add('d-none');
}

// Function to reset form data
function resetFormData() {
    Object.keys(originalValues).forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (field) {
            field.value = originalValues[fieldName];
        }
    });
    
    hitungTotal();
    showModernAlert('success', 'Reset Berhasil', 'Semua data telah dikembalikan ke nilai awal.');
}

// Fungsi untuk cek tempat PKL
function cekTempatPKL() {
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
    // Store original values for reset
    document.querySelectorAll('input, select, textarea').forEach(input => {
        if (input.name) {
            originalValues[input.name] = input.value;
        }
    });
    
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
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('invalid-input');
                this.classList.remove('valid-input');
            } else {
                this.classList.add('valid-input');
                this.classList.remove('invalid-input');
            }
        });
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