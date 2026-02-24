@extends('layouts.app')

@section('title', 'Detail Data PKL - ' . $prakerin->nama)
@section('page-title', 'Detail Data PKL')
@section('page-description', 'Informasi lengkap Praktik Kerja Lapangan')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header dengan gradient navy modern -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-xl position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); border-radius: 20px;">
                <div class="position-absolute top-0 end-0 mt-n10 me-n10 w-40 h-40 bg-white/10 rounded-circle"></div>
                <div class="position-absolute bottom-0 start-0 mb-n10 ms-n10 w-40 h-40 bg-white/10 rounded-circle"></div>
                
                <div class="card-body p-5 position-relative">
                    <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl me-4">
                                <i class="fas fa-user-graduate text-white fa-2x"></i>
                            </div>
                            <div>
                                <h1 class="h2 fw-bold text-white mb-2">
                                    Detail Data PKL
                                </h1>
                                <p class="text-white-50 fs-6 mb-0">
                                    {{ $prakerin->nama }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-white/20 backdrop-blur-sm text-white rounded-pill px-3 py-2">
                                <i class="fas fa-id-card me-1"></i> {{ $prakerin->no_sertifikat }}
                            </span>
                            <span class="badge bg-white/20 backdrop-blur-sm text-white rounded-pill px-3 py-2">
                                <i class="fas fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($prakerin->tanggal_sertifikat)->format('d/m/Y') }}
                            </span>
                            <span class="badge rounded-pill px-3 py-2 
                                @if($prakerin->status == 'selesai') bg-success 
                                @elseif($prakerin->status == 'perbaikan') bg-warning 
                                @elseif($prakerin->status == 'aktif') bg-info 
                                @else bg-secondary @endif">
                                {{ strtoupper($prakerin->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Back -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('prakerin.index') }}" class="btn btn-link text-blue-600 hover-text-blue-800 text-decoration-none p-0 d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i>
                <span class="d-none d-sm-inline">Kembali ke Daftar PKL</span>
                <span class="d-inline d-sm-none">Kembali</span>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column - Profile & Basic Info -->
        <div class="col-lg-8">
            <div class="row g-4">
                <!-- Profile Card -->
                <div class="col-12">
                    <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                    <i class="fas fa-user-circle text-white"></i>
                                </div>
                                <h2 class="h5 fw-bold text-white mb-0">
                                    Profil Siswa
                                </h2>
                            </div>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="row g-4">
                                <!-- Tanpa kolom avatar/kocong, langsung full width untuk detail -->
                                <div class="col-12">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="border-bottom pb-2">
                                                <small class="text-muted d-block">Nama Lengkap</small>
                                                <strong class="fs-6">{{ $prakerin->nama }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border-bottom pb-2">
                                                <small class="text-muted d-block">NIS</small>
                                                <strong class="fs-6">{{ $prakerin->nis }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border-bottom pb-2">
                                                <small class="text-muted d-block">Tempat, Tanggal Lahir</small>
                                                <span class="fs-6">{{ $prakerin->ttl ?? '-' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border-bottom pb-2">
                                                <small class="text-muted d-block">Paket Keahlian</small>
                                                <span class="fs-6">{{ $prakerin->keahlian }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="border-bottom pb-2">
                                                <small class="text-muted d-block">Asal Lembaga</small>
                                                <span class="fs-6">{{ $prakerin->lembaga }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PKL Information -->
                <div class="col-12">
                    <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                                <h2 class="h5 fw-bold text-white mb-0">
                                    Informasi PKL
                                </h2>
                            </div>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2">
                                        <small class="text-muted d-block">Tempat PKL</small>
                                        <strong class="fs-6">{{ $prakerin->tempat_pkl }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2">
                                        <small class="text-muted d-block">No. Sertifikat</small>
                                        <span class="fs-6">{{ $prakerin->no_sertifikat }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2">
                                        <small class="text-muted d-block">Tanggal Mulai</small>
                                        <span class="fs-6">{{ \Carbon\Carbon::parse($prakerin->tgl_mulai)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2">
                                        <small class="text-muted d-block">Tanggal Selesai</small>
                                        <span class="fs-6">{{ \Carbon\Carbon::parse($prakerin->tgl_selesai)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2">
                                        <small class="text-muted d-block">Durasi</small>
                                        <span class="fs-6">
                                            @php
                                                $start = new DateTime($prakerin->tgl_mulai);
                                                $end = new DateTime($prakerin->tgl_selesai);
                                                $interval = $start->diff($end);
                                                $result = [];
                                                if ($interval->y > 0) $result[] = $interval->y . ' thn';
                                                if ($interval->m > 0) $result[] = $interval->m . ' bln';
                                                if ($interval->d > 0 || empty($result)) $result[] = $interval->d . ' hr';
                                                echo implode(' ', $result);
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nilai Detail -->
                <div class="col-12">
                    <div class="card border-0 shadow-lg hover-shadow-xl transition-all duration-300" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                        <i class="fas fa-chart-bar text-white"></i>
                                    </div>
                                    <h2 class="h5 fw-bold text-white mb-0">
                                        Detail Penilaian
                                    </h2>
                                </div>
                                <span class="badge bg-blue-100 text-blue-900 rounded-pill px-3 py-2">
                                    Total 10 Aspek Penilaian
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="row g-4">
                                @php
                                    $aspek_nilai = [
                                        ['name' => 'disiplin', 'label' => 'Disiplin', 'icon' => 'fa-clock', 'color' => 'primary'],
                                        ['name' => 'tanggung_jawab', 'label' => 'Tanggung Jawab', 'icon' => 'fa-tasks', 'color' => 'success'],
                                        ['name' => 'inisiatif', 'label' => 'Inisiatif', 'icon' => 'fa-lightbulb', 'color' => 'warning'],
                                        ['name' => 'loyalitas', 'label' => 'Loyalitas', 'icon' => 'fa-handshake', 'color' => 'info'],
                                        ['name' => 'kerjasama', 'label' => 'Kerjasama', 'icon' => 'fa-users', 'color' => 'secondary'],
                                        ['name' => 'pengambilan_keputusan', 'label' => 'Pengambilan Keputusan', 'icon' => 'fa-brain', 'color' => 'danger'],
                                        ['name' => 'jiwa_entrepreneur', 'label' => 'Jiwa Entrepreneur', 'icon' => 'fa-chart-line', 'color' => 'dark'],
                                        ['name' => 'kejujuran', 'label' => 'Kejujuran', 'icon' => 'fa-gem', 'color' => 'primary'],
                                        ['name' => 'kemampuan_bekerja', 'label' => 'Kemampuan Bekerja', 'icon' => 'fa-cogs', 'color' => 'success'],
                                        ['name' => 'hasil_kerja', 'label' => 'Hasil Kerja', 'icon' => 'fa-trophy', 'color' => 'warning']
                                    ];
                                @endphp
                                
                                @foreach($aspek_nilai as $aspek)
                                <div class="col-md-6 col-lg-4">
                                    <div class="bg-light bg-gradient p-4 rounded-3 border border-gray-200 h-100">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-{{ $aspek['color'] }} bg-opacity-10 p-2 me-3">
                                                    <i class="fas {{ $aspek['icon'] }} text-{{ $aspek['color'] }}"></i>
                                                </div>
                                                <span class="fw-medium text-gray-800">{{ $aspek['label'] }}</span>
                                            </div>
                                            <span class="h5 fw-bold text-{{ $aspek['color'] }} mb-0">
                                                {{ $prakerin->{$aspek['name']} }}
                                            </span>
                                        </div>
                                        
                                        <!-- Progress Bar -->
                                        <div class="progress mb-2" style="height: 8px;">
                                            <div class="progress-bar bg-{{ $aspek['color'] }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $prakerin->{$aspek['name']} }}%;" 
                                                 aria-valuenow="{{ $prakerin->{$aspek['name']} }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                        
                                        <!-- Verifikasi -->
                                        <div class="d-flex justify-content-between align-items-center small">
                                            <span class="text-muted">Verifikasi</span>
                                            <span class="text-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                {{ $prakerin->{'verifikasi_' . $aspek['name']} ?? '✓' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Summary & Actions -->
        <div class="col-lg-4">
            <div class="row g-4">
                <!-- Summary Card -->
                <div class="col-12">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <h2 class="h5 fw-bold text-white mb-0">
                                Ringkasan Nilai
                            </h2>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <div class="d-inline-block p-4 rounded-circle bg-gradient-to-r from-blue-100 to-blue-50 border border-4 border-white shadow-lg mb-3">
                                    <span class="display-5 fw-bold text-blue-800">{{ $prakerin->rata_rata }}</span>
                                </div>
                                <p class="text-muted small">Nilai Rata-rata</p>
                            </div>
                            
                            <div class="vstack gap-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Total Nilai</span>
                                    <span class="h5 fw-bold text-blue-800 mb-0">{{ $prakerin->total_nilai }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Predikat</span>
                                    @php
                                        $rata = $prakerin->rata_rata;
                                        $predikat = $prakerin->predikat ?? (
                                            $rata >= 90 ? 'SANGAT BAIK' : 
                                            ($rata >= 80 ? 'BAIK' : 
                                            ($rata >= 70 ? 'CUKUP' : 
                                            ($rata >= 60 ? 'KURANG' : 'SANGAT KURANG')))
                                        );
                                        $badgeClass = $rata >= 90 ? 'bg-success' : 
                                                    ($rata >= 80 ? 'bg-primary' : 
                                                    ($rata >= 70 ? 'bg-warning' : 
                                                    ($rata >= 60 ? 'bg-danger' : 'bg-dark')));
                                    @endphp
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
                                        {{ $predikat }}
                                    </span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Status</span>
                                    <span class="badge rounded-pill px-3 py-2
                                        @if($prakerin->status == 'selesai') bg-success
                                        @elseif($prakerin->status == 'perbaikan') bg-warning
                                        @elseif($prakerin->status == 'aktif') bg-info
                                        @else bg-secondary @endif">
                                        {{ strtoupper($prakerin->status) }}
                                    </span>
                                </div>
                                
                                <!-- Progress Ring -->
                                <div class="mt-4 text-center">
                                    <div class="position-relative d-inline-block">
                                        <canvas id="progressRing" width="150" height="150"></canvas>
                                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                                            <span class="h3 fw-bold text-gray-800">{{ $prakerin->rata_rata }}</span>
                                            <span class="d-block small text-muted">dari 100</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pembimbing Card (MODIFIED) -->
                <div class="col-12">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                    <i class="fas fa-user-tie text-white"></i>
                                </div>
                                <h2 class="h5 fw-bold text-white mb-0">
                                    Penandatangan Sertifikat
                                </h2>
                            </div>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <div class="rounded-circle bg-gradient-to-r from-blue-800 to-blue-600 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-signature text-white fa-2x"></i>
                                </div>
                                <h3 class="h6 fw-bold text-gray-800 mb-1">{{ $prakerin->nama_pembimbing }}</h3>
                                <p class="small text-muted mb-0">Guru Pembimbing PKL</p>
                            </div>
                            
                            <!-- Nama Pimpinan/Direktur -->
                            <div class="vstack gap-2 mt-4 pt-3 border-top border-gray-200">
                                <div class="d-flex justify-content-between align-items-center small">
                                    <span class="text-muted">Nama Pimpinan/Direktur</span>
                                    <span class="fw-medium text-gray-800">{{ $prakerin->nama_pimpinan ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center small">
                                    <span class="text-muted">Tanggal Sertifikat</span>
                                    <span class="fw-medium text-gray-800">{{ \Carbon\Carbon::parse($prakerin->tanggal_sertifikat)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center small">
                                    <span class="text-muted">No. Sertifikat</span>
                                    <span class="fw-medium text-gray-800 text-truncate ms-2" style="max-width: 180px;" title="{{ $prakerin->no_sertifikat }}">
                                        {{ $prakerin->no_sertifikat }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center small">
                                    <span class="text-muted">Dibuat Tanggal</span>
                                    <span class="fw-medium text-gray-800">{{ $prakerin->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-12">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <h2 class="h5 fw-bold text-white mb-0">
                                Aksi
                            </h2>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="vstack gap-3">
                                <a href="{{ route('prakerin.cetak', $prakerin->id) }}" target="_blank" 
                                   class="btn btn-primary py-3 rounded-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-print me-2"></i>
                                    Cetak Sertifikat
                                </a>
                                
                                <a href="{{ route('prakerin.edit', $prakerin->id) }}" 
                                   class="btn btn-success py-3 rounded-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Data
                                </a>
                                
                                <button type="button" class="btn btn-outline-secondary d-lg-none py-3 rounded-3 d-flex align-items-center justify-content-center" 
                                        onclick="window.history.back()">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </button>
                                
                                <form action="{{ route('prakerin.destroy', $prakerin->id) }}" method="POST" class="d-inline" 
                                      onsubmit="event.preventDefault(); confirmDelete(this, '{{ $prakerin->nama }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger py-3 rounded-3 w-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-trash me-2"></i>
                                        Hapus Data
                                    </button>
                                </form>
                            </div>
                            
                            <!-- QR Code untuk Verifikasi -->
                            <div class="mt-5 pt-4 border-top border-gray-200">
                                <div class="text-center">
                                    <div class="small fw-medium text-gray-700 mb-2">Verifikasi QR Code</div>
                                    <div class="d-inline-block p-3 bg-light rounded-3">
                                        <div class="bg-white p-3 rounded-3" style="width: 120px; height: 120px;">
                                            <div class="h-100 w-100 d-flex flex-column align-items-center justify-content-center">
                                                <i class="fas fa-qrcode text-primary" style="font-size: 60px;"></i>
                                                <span class="small text-primary mt-2 font-monospace">
                                                    {{ substr($prakerin->no_sertifikat, -6) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="small text-muted mt-2">Scan untuk verifikasi keaslian sertifikat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                @if($prakerin->catatan)
                <div class="col-12">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header bg-gradient-to-r from-blue-900 to-blue-700 border-bottom border-blue-800 py-4 px-5" style="background: linear-gradient(90deg, #0f172a 0%, #1e3a8a 100%);">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg me-3">
                                    <i class="fas fa-sticky-note text-white"></i>
                                </div>
                                <h2 class="h5 fw-bold text-white mb-0">
                                    Catatan Khusus
                                </h2>
                            </div>
                        </div>
                        
                        <div class="card-body p-5">
                            <div class="bg-blue-50 border-start border-4 border-blue-800 p-4 rounded-end-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-blue-800"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="small text-blue-800 mb-0">{{ $prakerin->catatan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Metadata -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="small text-muted">
                <p class="mb-1">Data terakhir diperbarui: {{ $prakerin->updated_at->translatedFormat('d F Y H:i') }}</p>
                <p class="mb-0">ID: {{ $prakerin->id }} • Created by: {{ $prakerin->created_by ?? 'System' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress Ring Canvas
    const canvas = document.getElementById('progressRing');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        const nilai = {{ $prakerin->rata_rata }};
        const radius = 60;
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        
        // Background circle
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
        ctx.strokeStyle = '#e5e7eb';
        ctx.lineWidth = 10;
        ctx.stroke();
        
        // Progress circle
        const progress = (nilai / 100) * 2 * Math.PI;
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, -0.5 * Math.PI, progress - 0.5 * Math.PI);
        ctx.strokeStyle = '#0d6efd';
        ctx.lineWidth = 10;
        ctx.stroke();
    }
});

// Confirm Delete Function
function confirmDelete(form, nama) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `<p class="fs-6">Apakah Anda yakin ingin menghapus data PKL <strong>${nama}</strong>?</p>
               <p class="small text-danger">Data yang dihapus tidak dapat dikembalikan!</p>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
        reverseButtons: true,
        background: '#fff',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endpush