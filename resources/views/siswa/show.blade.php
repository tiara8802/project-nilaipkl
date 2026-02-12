{{-- resources/views/siswa/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Detail Data Siswa')
@section('page-title', 'Detail Data Siswa')
@section('page-subtitle', 'Informasi lengkap data siswa')

@section('content')
<div class="content-card fade-in">
    <div class="card-header-custom">
        <h2>
            <i class="fas fa-user-circle text-info"></i>
            Detail Data Siswa
        </h2>
        <div class="btn-group">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            @if(!$siswa->sudahMemilikiNilaiPkl())
                <a href="{{ route('nilai-pkl.create.siswa', $siswa->id) }}" class="btn btn-success">
                    <i class="fas fa-file-alt me-2"></i> Buat Nilai PKL
                </a>
            @else
                <a href="{{ route('nilai-pkl.show', $siswa->nilaiPkl->id) }}" class="btn btn-primary">
                    <i class="fas fa-eye me-2"></i> Lihat Nilai PKL
                </a>
            @endif
        </div>
    </div>
    
    <div class="row">
        <!-- Informasi Siswa -->
        <div class="col-md-8">
            <div class="row">
                <!-- Data Pribadi -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-id-card me-2"></i> Data Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                                <div class="info-value fw-bold fs-5">{{ $siswa->nama }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small mb-1">NIS</label>
                                    <div class="info-value">
                                        <span class="badge badge-primary-custom">{{ $siswa->nis }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small mb-1">Paket Keahlian</label>
                                    <div class="info-value">{{ $siswa->paket_keahlian }}</div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small mb-1">Tempat Lahir</label>
                                    <div class="info-value">{{ $siswa->tempat_lahir }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small mb-1">Tanggal Lahir</label>
                                    <div class="info-value">{{ $siswa->tanggal_lahir->format('d/m/Y') }}</div>
                                    <div class="small text-muted">({{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->age }} tahun)</div>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <label class="form-label text-muted small mb-1">Asal Lembaga</label>
                                <div class="info-value">{{ $siswa->asal_lembaga }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Data PKL -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i> Data PKL</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Tempat PKL</label>
                                <div class="info-value fw-bold">{{ $siswa->tempat_pkl ?? '-' }}</div>
                            </div>
                            
                            @if($siswa->alamat_pkl)
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Alamat PKL</label>
                                <div class="info-value">{{ $siswa->alamat_pkl }}</div>
                            </div>
                            @endif
                            
                            @if($siswa->telepon_pkl)
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Telepon PKL</label>
                                <div class="info-value">{{ $siswa->telepon_pkl }}</div>
                            </div>
                            @endif
                            
                            <div class="info-item">
                                <label class="form-label text-muted small mb-1">Status PKL</label>
                                <div class="info-value">
                                    <span class="status-badge status-{{ $siswa->status_color }}">
                                        {{ $siswa->status_pkl }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Periode PKL -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Periode PKL</h5>
                        </div>
                        <div class="card-body">
                            @if($siswa->tanggal_mulai_pkl && $siswa->tanggal_selesai_pkl)
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Tanggal Mulai</label>
                                <div class="info-value fw-bold">
                                    {{ $siswa->tanggal_mulai_pkl->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Tanggal Selesai</label>
                                <div class="info-value fw-bold">
                                    {{ $siswa->tanggal_selesai_pkl->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Durasi PKL</label>
                                <div class="info-value">
                                    <span class="badge bg-primary">{{ $siswa->durasi_pkl }} hari</span>
                                </div>
                            </div>
                            
                            <div class="progress mb-3" style="height: 10px;">
                                @php
                                    $totalDays = $siswa->durasi_pkl;
                                    $daysPassed = min($totalDays, max(0, now()->diffInDays($siswa->tanggal_mulai_pkl)));
                                    $percentage = $totalDays > 0 ? ($daysPassed / $totalDays) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: {{ $percentage }}%;" 
                                     aria-valuenow="{{ $percentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            
                            <div class="small text-muted">
                                {{ $daysPassed }} hari dari {{ $totalDays }} hari
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Periode PKL belum ditentukan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Pembimbing -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i> Pembimbing</h5>
                        </div>
                        <div class="card-body">
                            @if($siswa->nama_pembimbing)
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Nama Pembimbing</label>
                                <div class="info-value fw-bold">{{ $siswa->nama_pembimbing }}</div>
                            </div>
                            
                            @if($siswa->jabatan_pembimbing)
                            <div class="info-item mb-3">
                                <label class="form-label text-muted small mb-1">Jabatan</label>
                                <div class="info-value">{{ $siswa->jabatan_pembimbing }}</div>
                            </div>
                            @endif
                            
                            @if($siswa->telepon_pembimbing)
                            <div class="info-item">
                                <label class="form-label text-muted small mb-1">Telepon</label>
                                <div class="info-value">
                                    <i class="fas fa-phone me-2 text-muted"></i>
                                    {{ $siswa->telepon_pembimbing }}
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Data pembimbing belum diisi</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar & Aksi -->
        <div class="col-md-4">
            <!-- Status Card -->
            <div class="card mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Status</h5>
                </div>
                <div class="card-body text-center">
                    <div class="avatar-lg mx-auto mb-3">
                        <div class="avatar-initial rounded-circle bg-light-primary text-primary" style="width: 80px; height: 80px; line-height: 80px; font-size: 32px;">
                            {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                        </div>
                    </div>
                    <h5 class="mb-1">{{ $siswa->nama }}</h5>
                    <p class="text-muted mb-3">{{ $siswa->paket_keahlian }}</p>
                    
                    <div class="d-flex justify-content-around mb-3">
                        <div class="text-center">
                            <div class="fw-bold fs-4">{{ $siswa->durasi_pkl }}</div>
                            <div class="text-muted small">Hari PKL</div>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold fs-4">
                                @if($siswa->nilaiPkl)
                                {{ number_format($siswa->nilaiPkl->rata_rata, 1) }}
                                @else
                                -
                                @endif
                            </div>
                            <div class="text-muted small">Nilai Rata-rata</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <span class="badge bg-{{ $siswa->status_color }} fs-6 px-3 py-2">
                            {{ $siswa->status_pkl }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i> Edit Data Siswa
                        </a>
                        
                        @if(!$siswa->sudahMemilikiNilaiPkl())
                            <a href="{{ route('nilai-pkl.create.siswa', $siswa->id) }}" class="btn btn-success">
                                <i class="fas fa-file-alt me-2"></i> Buat Nilai PKL
                            </a>
                        @else
                            <a href="{{ route('nilai-pkl.show', $siswa->nilaiPkl->id) }}" class="btn btn-info">
                                <i class="fas fa-eye me-2"></i> Lihat Nilai PKL
                            </a>
                            <a href="{{ route('nilai-pkl.cetak', $siswa->nilaiPkl->id) }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-print me-2"></i> Cetak Sertifikat
                            </a>
                        @endif
                        
                        @if(!$siswa->sudahMemilikiNilaiPkl())
                            <button onclick="confirmDelete({{ $siswa->id }}, '{{ $siswa->nama }}')" 
                                    class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i> Hapus Data Siswa
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Informasi Tambahan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="small text-muted">
                        <p><i class="fas fa-calendar-plus me-2"></i> Dibuat: {{ $siswa->created_at->format('d/m/Y H:i') }}</p>
                        <p><i class="fas fa-calendar-edit me-2"></i> Diupdate: {{ $siswa->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `<p>Apakah Anda yakin ingin menghapus data siswa:</p>
               <p class="fw-bold text-danger">"${nama}"</p>
               <p class="text-muted">Data yang dihapus tidak dapat dikembalikan.</p>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = '/siswa/' + id;
            form.submit();
        }
    });
}
</script>

<style>
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    padding: 15px 20px;
}

.card-body {
    padding: 20px;
}

.info-item {
    margin-bottom: 15px;
}

.info-item label {
    display: block;
    margin-bottom: 5px;
}

.info-value {
    font-size: 1rem;
    color: #333;
}

.avatar-lg {
    display: flex;
    justify-content: center;
}

.avatar-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.bg-light-primary {
    background-color: rgba(67, 97, 238, 0.1) !important;
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.btn {
    border-radius: 10px;
    padding: 10px 15px;
    font-weight: 500;
}
</style>
@endsection