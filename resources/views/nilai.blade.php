@extends('layouts.guru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Input Nilai PKL</h1>
    
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Nilai Praktik Kerja Lapangan</h5>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('nilai-pkl.store') }}">
                @csrf
                
                <!-- Data Siswa -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">A. Data Siswa</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Pilih Siswa *</label>
                            <select name="siswa_id" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nama }} - NIS: {{ $siswa->nis }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Penilaian Aspek -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">B. Penilaian Aspek Kompetensi</h5>
                    <p class="text-muted">Nilai 0-100</p>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">NO</th>
                                    <th>ASPEK YANG DINILAI</th>
                                    <th width="20%">NILAI (0-100)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $aspek = [
                                        'Disiplin',
                                        'Tanggung Jawab',
                                        'Inisiatif',
                                        'Loyalitas',
                                        'Kerjasama',
                                        'Pengambilan Keputusan',
                                        'Jiwa Entrepreneur',
                                        'Kejujuran',
                                        'Kemampuan bekerja',
                                        'Hasil Kerja'
                                    ];
                                @endphp
                                
                                @foreach($aspek as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item }}</td>
                                    <td>
                                        <input type="number" 
                                               name="{{ Str::slug($item, '_') }}" 
                                               class="form-control nilai-input"
                                               min="0" max="100" 
                                               value="{{ old(Str::slug($item, '_')) }}" 
                                               required>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>JUMLAH NILAI</strong></td>
                                    <td><span id="jumlah-nilai" class="fw-bold">0</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>NILAI RATA-RATA</strong></td>
                                    <td><span id="rata-rata" class="fw-bold">0.00</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <!-- Data Surat -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">C. Data Surat Keterangan</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Nomor Surat *</label>
                            <input type="text" name="nomor_surat" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Surat *</label>
                            <input type="date" name="tanggal_surat" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Pembimbing *</label>
                            <input type="text" name="nama_pembimbing" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Direktur/Pimpinan *</label>
                            <input type="text" name="nama_direktur" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="verifikasi_pembimbing" id="verifikasi">
                        <label class="form-check-label" for="verifikasi">
                            Sudah diverifikasi oleh pembimbing
                        </label>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Nilai PKL</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Hitung otomatis jumlah dan rata-rata nilai
    document.querySelectorAll('.nilai-input').forEach(input => {
        input.addEventListener('input', hitungNilai);
    });
    
    function hitungNilai() {
        let total = 0;
        let count = 0;
        
        document.querySelectorAll('.nilai-input').forEach(input => {
            const value = parseInt(input.value) || 0;
            total += value;
            count++;
        });
        
        document.getElementById('jumlah-nilai').textContent = total;
        document.getElementById('rata-rata').textContent = (total / count).toFixed(2);
    }
    
    // Inisialisasi hitung nilai
    hitungNilai();
</script>
@endpush
@endsection