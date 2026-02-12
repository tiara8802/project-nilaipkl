@extends('layouts.dashboard')

@section('title', 'Edit Nilai PKL')
@section('page-title', 'Edit Nilai PKL')
@section('page-subtitle', 'Perbarui nilai sesuai format sertifikat')

@section('content')
<div class="recent-card fade-in" data-aos="fade-up">
    <div class="section-header">
        <h3><i class="fas fa-edit me-2 text-warning"></i> Edit Nilai PKL</h3>
        <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('nilai-pkl.update', $nilaiPkl->id) }}" id="form-edit-nilai">
        @csrf
        @method('PUT')
        
        <!-- Data Siswa (Readonly) -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-user-graduate me-2"></i> Data Siswa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" value="{{ $nilaiPkl->siswa->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" class="form-control" value="{{ $nilaiPkl->siswa->nis }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Paket Keahlian</label>
                            <input type="text" class="form-control" value="{{ $nilaiPkl->siswa->paket_keahlian }}" readonly>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="siswa_id" value="{{ $nilaiPkl->siswa_id }}">
            </div>
        </div>

        <!-- Data Sertifikat -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-file-contract me-2"></i> Data Sertifikat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" name="no_surat" id="no_surat" 
                                   class="form-control @error('no_surat') is-invalid @enderror"
                                   value="{{ old('no_surat', $nilaiPkl->no_surat) }}" required>
                            @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tanggal_surat">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" 
                                   class="form-control @error('tanggal_surat') is-invalid @enderror"
                                   value="{{ old('tanggal_surat', $nilaiPkl->tanggal_surat->format('Y-m-d')) }}" required>
                            @error('tanggal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai PKL <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" 
                                   class="form-control @error('tgl_mulai') is-invalid @enderror"
                                   value="{{ old('tgl_mulai', $nilaiPkl->tgl_mulai->format('Y-m-d')) }}" required>
                            @error('tgl_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai PKL <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_selesai" id="tgl_selesai" 
                                   class="form-control @error('tgl_selesai') is-invalid @enderror"
                                   value="{{ old('tgl_selesai', $nilaiPkl->tgl_selesai->format('Y-m-d')) }}" required>
                            @error('tgl_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tempat_pkl">Tempat PKL <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_pkl" id="tempat_pkl" 
                                   class="form-control @error('tempat_pkl') is-invalid @enderror"
                                   value="{{ old('tempat_pkl', $nilaiPkl->tempat_pkl) }}" required>
                            @error('tempat_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Penilaian -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-table me-2"></i> Penilaian PKL (0-100)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">NO</th>
                                <th>ASPEK YANG DINILAI</th>
                                <th width="15%">NILAI DENGAN ANGKA</th>
                                <th width="15%">HURUF</th>
                                <th width="15%">VERIFIKASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $aspekPenilaian = [
                                    1 => 'Disiplin',
                                    2 => 'Tanggung Jawab',
                                    3 => 'Inisiatif',
                                    4 => 'Loyalitas',
                                    5 => 'Kerjasama',
                                    6 => 'Pengambilan Keputusan',
                                    7 => 'Jiwa Entrepreneur',
                                    8 => 'Kejujuran',
                                    9 => 'Kemampuan bekerja',
                                    10 => 'Hasil Kerja'
                                ];
                            @endphp
                            
                            @foreach($aspekPenilaian as $index => $aspek)
                                @php
                                    $fieldName = strtolower(str_replace(' ', '_', $aspek));
                                    $angkaValue = old($fieldName . '_angka', $nilaiPkl->{$fieldName . '_angka'});
                                    $hurufValue = old($fieldName . '_huruf', $nilaiPkl->{$fieldName . '_huruf'});
                                    $verifikasiValue = old($fieldName . '_verifikasi', $nilaiPkl->{$fieldName . '_verifikasi'});
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index }}</td>
                                    <td>{{ $aspek }}</td>
                                    <td>
                                        <input type="number" 
                                               name="{{ $fieldName }}_angka" 
                                               class="form-control nilai-input"
                                               min="0" max="100" step="0.01"
                                               value="{{ $angkaValue }}"
                                               onchange="updateHurufDanVerifikasi(this, '{{ $fieldName }}')"
                                               required>
                                    </td>
                                    <td>
                                        <input type="text" 
                                               name="{{ $fieldName }}_huruf" 
                                               class="form-control huruf-output" 
                                               readonly
                                               value="{{ $hurufValue }}">
                                    </td>
                                    <td>
                                        <input type="text" 
                                               name="{{ $fieldName }}_verifikasi" 
                                               class="form-control verifikasi-output" 
                                               readonly
                                               value="{{ $verifikasiValue }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <td colspan="2" class="text-end"><strong>JUMLAH NILAI</strong></td>
                                <td><input type="text" id="total_nilai" class="form-control" readonly value="{{ old('jumlah_nilai_angka', $nilaiPkl->jumlah_nilai_angka) }}"></td>
                                <td><input type="text" id="total_huruf" class="form-control" readonly value="{{ old('jumlah_nilai_huruf', $nilaiPkl->jumlah_nilai_huruf) }}"></td>
                                <td><input type="text" id="total_verifikasi" class="form-control" readonly value="{{ old('jumlah_nilai_verifikasi', $nilaiPkl->jumlah_nilai_verifikasi) }}"></td>
                            </tr>
                            <tr class="table-info">
                                <td colspan="2" class="text-end"><strong>NILAI RATA-RATA</strong></td>
                                <td colspan="3">
                                    <div class="d-flex">
                                        <input type="text" id="rata_rata_angka" class="form-control me-2" 
                                               readonly value="{{ number_format(old('rata_rata', $nilaiPkl->rata_rata), 2) }}">
                                        <input type="text" id="rata_rata_huruf" class="form-control" 
                                               readonly value="{{ old('huruf_rata_rata', $nilaiPkl->huruf_rata_rata) }}">
                                        <input type="hidden" name="rata_rata" id="rata_rata_input" value="{{ old('rata_rata', $nilaiPkl->rata_rata) }}">
                                        <input type="hidden" name="huruf_rata_rata" id="huruf_rata_rata_input" value="{{ old('huruf_rata_rata', $nilaiPkl->huruf_rata_rata) }}">
                                        <input type="hidden" name="jumlah_nilai_angka" id="jumlah_nilai_angka_input" value="{{ old('jumlah_nilai_angka', $nilaiPkl->jumlah_nilai_angka) }}">
                                        <input type="hidden" name="jumlah_nilai_huruf" id="jumlah_nilai_huruf_input" value="{{ old('jumlah_nilai_huruf', $nilaiPkl->jumlah_nilai_huruf) }}">
                                        <input type="hidden" name="jumlah_nilai_verifikasi" id="jumlah_nilai_verifikasi_input" value="{{ old('jumlah_nilai_verifikasi', $nilaiPkl->jumlah_nilai_verifikasi) }}">
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Pembimbing dan Pimpinan -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i> Tanda Tangan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pembimbing_nama">Nama Pembimbing <span class="text-danger">*</span></label>
                            <input type="text" name="pembimbing_nama" id="pembimbing_nama" 
                                   class="form-control @error('pembimbing_nama') is-invalid @enderror"
                                   value="{{ old('pembimbing_nama', $nilaiPkl->pembimbing_nama) }}" required>
                            @error('pembimbing_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pembimbing_jabatan">Jabatan Pembimbing <span class="text-danger">*</span></label>
                            <input type="text" name="pembimbing_jabatan" id="pembimbing_jabatan" 
                                   class="form-control @error('pembimbing_jabatan') is-invalid @enderror"
                                   value="{{ old('pembimbing_jabatan', $nilaiPkl->pembimbing_jabatan) }}" required>
                            @error('pembimbing_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pimpinan_nama">Nama Pimpinan/Direktur <span class="text-danger">*</span></label>
                            <input type="text" name="pimpinan_nama" id="pimpinan_nama" 
                                   class="form-control @error('pimpinan_nama') is-invalid @enderror"
                                   value="{{ old('pimpinan_nama', $nilaiPkl->pimpinan_nama) }}" required>
                            @error('pimpinan_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pimpinan_jabatan">Jabatan Pimpinan/Direktur <span class="text-danger">*</span></label>
                            <input type="text" name="pimpinin_jabatan" id="pimpinan_jabatan" 
                                   class="form-control @error('pimpinan_jabatan') is-invalid @enderror"
                                   value="{{ old('pimpinan_jabatan', $nilaiPkl->pimpinan_jabatan) }}" required>
                            @error('pimpinan_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-times me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save me-1"></i> Update Nilai PKL
            </button>
        </div>
    </form>
</div>

<script>
// Fungsi untuk update huruf dan verifikasi
function updateHurufDanVerifikasi(input, fieldName) {
    const nilai = parseFloat(input.value) || 0;
    
    // Update huruf
    const hurufField = input.closest('tr').querySelector('.huruf-output');
    const huruf = konversiKeHuruf(nilai);
    hurufField.value = huruf;
    
    // Update verifikasi
    const verifikasiField = input.closest('tr').querySelector('.verifikasi-output');
    const verifikasi = verifikasiNilai(nilai);
    verifikasiField.value = verifikasi;
    
    // Hitung total dan rata-rata
    hitungTotalDanRataRata();
}

// Konversi angka ke huruf
function konversiKeHuruf(nilai) {
    if (nilai >= 90) return 'A';
    if (nilai >= 80) return 'B';
    if (nilai >= 70) return 'C';
    if (nilai >= 56) return 'D';
    return 'E';
}

// Verifikasi nilai (Lulus/Tidak)
function verifikasiNilai(nilai) {
    return nilai >= 56 ? 'Lulus' : 'Tidak Lulus';
}

// Hitung total dan rata-rata
function hitungTotalDanRataRata() {
    let total = 0;
    let jumlahAspek = 0;
    
    // Hitung total nilai
    document.querySelectorAll('.nilai-input').forEach(input => {
        const nilai = parseFloat(input.value) || 0;
        total += nilai;
        jumlahAspek++;
    });
    
    // Update total nilai
    document.getElementById('total_nilai').value = total.toFixed(2);
    
    // Hitung rata-rata
    const rataRata = jumlahAspek > 0 ? total / jumlahAspek : 0;
    
    // Update rata-rata
    document.getElementById('rata_rata_angka').value = rataRata.toFixed(2);
    document.getElementById('rata_rata_huruf').value = konversiKeHuruf(rataRata);
    
    // Update total huruf dan verifikasi
    const totalHuruf = konversiKeHuruf(rataRata);
    const totalVerifikasi = verifikasiNilai(rataRata);
    document.getElementById('total_huruf').value = totalHuruf;
    document.getElementById('total_verifikasi').value = totalVerifikasi;
    
    // Set nilai hidden untuk form submission
    document.getElementById('rata_rata_input').value = rataRata.toFixed(2);
    document.getElementById('huruf_rata_rata_input').value = totalHuruf;
    document.getElementById('jumlah_nilai_angka_input').value = total;
    document.getElementById('jumlah_nilai_huruf_input').value = totalHuruf;
    document.getElementById('jumlah_nilai_verifikasi_input').value = totalVerifikasi;
}

// Validasi form sebelum submit
document.getElementById('form-edit-nilai').addEventListener('submit', function(e) {
    let isValid = true;
    let errorMessage = '';
    
    // Validasi semua input angka
    document.querySelectorAll('.nilai-input').forEach(input => {
        const nilai = parseFloat(input.value);
        if (isNaN(nilai) || nilai < 0 || nilai > 100) {
            isValid = false;
            input.classList.add('is-invalid');
            errorMessage = 'Nilai harus antara 0-100 untuk semua aspek!';
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    // Validasi tanggal
    const tglMulai = document.getElementById('tgl_mulai').value;
    const tglSelesai = document.getElementById('tgl_selesai').value;
    
    if (tglMulai && tglSelesai) {
        if (new Date(tglSelesai) < new Date(tglMulai)) {
            isValid = false;
            errorMessage = 'Tanggal selesai tidak boleh sebelum tanggal mulai!';
        }
    }
    
    if (!isValid) {
        e.preventDefault();
        Swal.fire({
            title: 'Validasi Error',
            text: errorMessage,
            icon: 'error',
            confirmButtonColor: '#dc3545'
        });
    }
});

// Inisialisasi perhitungan awal
document.addEventListener('DOMContentLoaded', function() {
    // Set nilai default untuk semua input
    document.querySelectorAll('.nilai-input').forEach(input => {
        updateHurufDanVerifikasi(input, input.name.replace('_angka', ''));
    });
    
    hitungTotalDanRataRata();
    
    // Auto format tanggal untuk input
    const tglMulaiInput = document.getElementById('tgl_mulai');
    const tglSelesaiInput = document.getElementById('tgl_selesai');
    
    if (tglMulaiInput && tglSelesaiInput) {
        tglMulaiInput.addEventListener('change', function() {
            if (!tglSelesaiInput.value) {
                tglSelesaiInput.min = this.value;
            }
        });
        
        tglSelesaiInput.addEventListener('change', function() {
            if (this.value < tglMulaiInput.value) {
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Tanggal selesai tidak boleh sebelum tanggal mulai!',
                    icon: 'warning',
                    confirmButtonColor: '#fd7e14'
                });
                this.value = tglMulaiInput.value;
            }
        });
    }
    
    // Auto-focus ke input pertama
    const firstInput = document.querySelector('.nilai-input');
    if (firstInput) {
        firstInput.focus();
    }
});

// Real-time validation for number inputs
document.querySelectorAll('.nilai-input').forEach(input => {
    input.addEventListener('input', function() {
        const nilai = parseFloat(this.value);
        if (nilai > 100) {
            this.value = 100;
            updateHurufDanVerifikasi(this, this.name.replace('_angka', ''));
        } else if (nilai < 0) {
            this.value = 0;
            updateHurufDanVerifikasi(this, this.name.replace('_angka', ''));
        }
    });
    
    // Highlight perubahan nilai
    const originalValue = parseFloat(input.value) || 0;
    input.addEventListener('change', function() {
        const newValue = parseFloat(this.value) || 0;
        if (newValue !== originalValue) {
            this.style.backgroundColor = '#fff3cd';
            this.style.borderColor = '#ffc107';
            
            // Reset warna setelah 2 detik
            setTimeout(() => {
                this.style.backgroundColor = '';
                this.style.borderColor = '';
            }, 2000);
        }
    });
});

// Confirm sebelum meninggalkan halaman jika ada perubahan
let formChanged = false;
document.querySelectorAll('input, select, textarea').forEach(element => {
    element.addEventListener('change', () => {
        formChanged = true;
    });
});

window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Confirm sebelum batal edit
document.querySelector('a[href*="nilai-pkl.index"]').addEventListener('click', function(e) {
    if (formChanged) {
        e.preventDefault();
        Swal.fire({
            title: 'Ada perubahan yang belum disimpan',
            text: 'Anda yakin ingin meninggalkan halaman ini? Perubahan yang belum disimpan akan hilang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, tinggalkan halaman',
            cancelButtonText: 'Lanjutkan edit'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = this.href;
            }
        });
    }
});
</script>

<style>
.nilai-input {
    text-align: center;
    font-weight: bold;
}

.nilai-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    border-color: #28a745;
}

.huruf-output, .verifikasi-output {
    text-align: center;
    font-weight: bold;
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.form-control:read-only {
    background-color: #f8f9fa;
}

.table th {
    background-color: #28a745;
    color: white;
    position: sticky;
    top: 0;
}

.card-header h5 {
    font-size: 1.1rem;
    font-weight: 600;
}

/* Style for validation */
.is-invalid {
    border-color: #dc3545 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

/* Highlight untuk nilai yang berubah */
.nilai-input.changed {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
}
</style>
@endsection