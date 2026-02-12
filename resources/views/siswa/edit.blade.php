{{-- resources/views/siswa/edit.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Edit Data Siswa')
@section('page-title', 'Edit Data Siswa')
@section('page-subtitle', 'Perbarui data siswa')

@section('content')
<div class="content-card fade-in">
    <div class="card-header-custom">
        <h2>
            <i class="fas fa-user-edit text-warning"></i>
            Edit Data Siswa
        </h2>
        <div>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-info">
                <i class="fas fa-eye me-2"></i> Lihat Detail
            </a>
        </div>
    </div>
    
    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" id="siswaForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Data Pribadi -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i> Data Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-custom @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-custom @error('nis') is-invalid @enderror" 
                                       id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" required>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="paket_keahlian" class="form-label">Paket Keahlian <span class="text-danger">*</span></label>
                                <select class="form-control form-control-custom @error('paket_keahlian') is-invalid @enderror" 
                                        id="paket_keahlian" name="paket_keahlian" required>
                                    <option value="">Pilih Paket Keahlian</option>
                                    @foreach($paketKeahlian as $paket)
                                        <option value="{{ $paket }}" {{ (old('paket_keahlian', $siswa->paket_keahlian) == $paket) ? 'selected' : '' }}>
                                            {{ $paket }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('paket_keahlian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-custom @error('tempat_lahir') is-invalid @enderror" 
                                       id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-custom @error('tanggal_lahir') is-invalid @enderror" 
                                       id="tanggal_lahir" name="tanggal_lahir" 
                                       value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}" required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="asal_lembaga" class="form-label">Asal Lembaga</label>
                            <input type="text" class="form-control form-control-custom @error('asal_lembaga') is-invalid @enderror" 
                                   id="asal_lembaga" name="asal_lembaga" value="{{ old('asal_lembaga', $siswa->asal_lembaga) }}">
                            @error('asal_lembaga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Data PKL -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i> Data Tempat PKL</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tempat_pkl" class="form-label">Nama Tempat PKL</label>
                            <input type="text" class="form-control form-control-custom @error('tempat_pkl') is-invalid @enderror" 
                                   id="tempat_pkl" name="tempat_pkl" value="{{ old('tempat_pkl', $siswa->tempat_pkl) }}">
                            @error('tempat_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat_pkl" class="form-label">Alamat PKL</label>
                            <textarea class="form-control form-control-custom @error('alamat_pkl') is-invalid @enderror" 
                                      id="alamat_pkl" name="alamat_pkl" rows="3">{{ old('alamat_pkl', $siswa->alamat_pkl) }}</textarea>
                            @error('alamat_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="telepon_pkl" class="form-label">Telepon PKL</label>
                            <input type="text" class="form-control form-control-custom @error('telepon_pkl') is-invalid @enderror" 
                                   id="telepon_pkl" name="telepon_pkl" value="{{ old('telepon_pkl', $siswa->telepon_pkl) }}">
                            @error('telepon_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Periode PKL dan Pembimbing -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Periode PKL & Pembimbing</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal_mulai_pkl" class="form-label">Tanggal Mulai PKL</label>
                                <input type="date" class="form-control form-control-custom @error('tanggal_mulai_pkl') is-invalid @enderror" 
                                       id="tanggal_mulai_pkl" name="tanggal_mulai_pkl" 
                                       value="{{ old('tanggal_mulai_pkl', $siswa->tanggal_mulai_pkl ? $siswa->tanggal_mulai_pkl->format('Y-m-d') : '') }}">
                                @error('tanggal_mulai_pkl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai_pkl" class="form-label">Tanggal Selesai PKL</label>
                                <input type="date" class="form-control form-control-custom @error('tanggal_selesai_pkl') is-invalid @enderror" 
                                       id="tanggal_selesai_pkl" name="tanggal_selesai_pkl" 
                                       value="{{ old('tanggal_selesai_pkl', $siswa->tanggal_selesai_pkl ? $siswa->tanggal_selesai_pkl->format('Y-m-d') : '') }}">
                                @error('tanggal_selesai_pkl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nama_pembimbing" class="form-label">Nama Pembimbing</label>
                                <input type="text" class="form-control form-control-custom @error('nama_pembimbing') is-invalid @enderror" 
                                       id="nama_pembimbing" name="nama_pembimbing" value="{{ old('nama_pembimbing', $siswa->nama_pembimbing) }}">
                                @error('nama_pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="jabatan_pembimbing" class="form-label">Jabatan Pembimbing</label>
                                <input type="text" class="form-control form-control-custom @error('jabatan_pembimbing') is-invalid @enderror" 
                                       id="jabatan_pembimbing" name="jabatan_pembimbing" value="{{ old('jabatan_pembimbing', $siswa->jabatan_pembimbing) }}">
                                @error('jabatan_pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="telepon_pembimbing" class="form-label">Telepon Pembimbing</label>
                                <input type="text" class="form-control form-control-custom @error('telepon_pembimbing') is-invalid @enderror" 
                                       id="telepon_pembimbing" name="telepon_pembimbing" value="{{ old('telepon_pembimbing', $siswa->telepon_pembimbing) }}">
                                @error('telepon_pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-2"></i> Update Data Siswa
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2
    $('#paket_keahlian').select2({
        theme: 'bootstrap-5',
        placeholder: 'Pilih Paket Keahlian'
    });
    
    // Date validation
    const tglMulai = document.getElementById('tanggal_mulai_pkl');
    const tglSelesai = document.getElementById('tanggal_selesai_pkl');
    
    if (tglMulai && tglSelesai) {
        tglMulai.addEventListener('change', function() {
            if (this.value) {
                tglSelesai.min = this.value;
            }
        });
        
        tglSelesai.addEventListener('change', function() {
            if (tglMulai.value && this.value < tglMulai.value) {
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Tanggal selesai tidak boleh sebelum tanggal mulai',
                    icon: 'warning',
                    confirmButtonColor: '#4361ee'
                });
                this.value = tglMulai.value;
            }
        });
    }
});
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
    padding: 25px;
}

.select2-container--bootstrap-5 .select2-selection {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    min-height: 45px;
    display: flex;
    align-items: center;
}
</style>
@endsection