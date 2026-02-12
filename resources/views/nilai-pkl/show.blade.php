@extends('layouts.dashboard')

@section('content')
<div class="main-content">
    <!-- Topbar -->
    <div class="topbar">
        <div class="page-title">
            <h1>Detail Nilai PKL</h1>
            <p>Detail lengkap nilai Praktik Kerja Lapangan</p>
        </div>
        
        <div class="topbar-actions">
            <div class="user-menu">
                <button class="user-btn">
                    <div class="user-avatar-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info-sm">
                        <div class="user-name">{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</div>
                        <div class="user-role">{{ Auth::guard('guru')->user()->is_admin ? 'Admin' : 'Guru' }}</div>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('nilai-pkl.index') }}">Nilai PKL</a></li>
            <li class="breadcrumb-item active">Detail Nilai</li>
        </ol>
    </nav>
    
    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
        <div>
            <a href="{{ route('nilai-pkl.cetak', $nilaiPkl->id) }}" class="btn btn-success" target="_blank">
                <i class="fas fa-print"></i> Cetak Sertifikat
            </a>
            <a href="{{ route('nilai-pkl.edit', $nilaiPkl->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
    
    <!-- Informasi Surat dan Siswa -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-file-alt"></i> Informasi Surat</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">No. Surat</th>
                            <td>: <strong>{{ $nilaiPkl->no_surat }}</strong></td>
                        </tr>
                        <tr>
                            <th>Tanggal Surat</th>
                            <td>: {{ $nilaiPkl->tanggal_surat->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Pembimbing</th>
                            <td>: {{ $nilaiPkl->pembimbing }}</td>
                        </tr>
                        <tr>
                            <th>Direktur</th>
                            <td>: {{ $nilaiPkl->direktur }}</td>
                        </tr>
                        <tr>
                            <th>Penilai</th>
                            <td>: {{ $nilaiPkl->guru->nama ?? 'Tidak diketahui' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Informasi Siswa</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Nama Siswa</th>
                            <td>: <strong>{{ $nilaiPkl->siswa->nama }}</strong></td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>: {{ $nilaiPkl->siswa->nis }}</td>
                        </tr>
                        <tr>
                            <th>Tempat/Tgl Lahir</th>
                            <td>: {{ $nilaiPkl->siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($nilaiPkl->siswa->tanggal_lahir)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Paket Keahlian</th>
                            <td>: {{ $nilaiPkl->siswa->paket_keahlian }}</td>
                        </tr>
                        <tr>
                            <th>Tempat PKL</th>
                            <td>: {{ $nilaiPkl->siswa->tempat_pkl }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detail Nilai -->
    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Detail Nilai PKL</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>NO</th>
                            <th>ASPEK YANG DINILAI</th>
                            <th>NILAI ANGKA</th>
                            <th>NILAI HURUF</th>
                            <th>VERIFIKASI</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $aspek = [
                                'disiplin' => 'Disiplin',
                                'tanggung_jawab' => 'Tanggung Jawab',
                                'inisiatif' => 'Inisiatif',
                                'loyalitas' => 'Loyalitas',
                                'kerjasama' => 'Kerjasama',
                                'pengambilan_keputusan' => 'Pengambilan Keputusan',
                                'jiwa_entrepreneur' => 'Jiwa Entrepreneur',
                                'kejujuran' => 'Kejujuran',
                                'kemampuan_bekerja' => 'Kemampuan bekerja',
                                'hasil_kerja' => 'Hasil Kerja',
                            ];
                        @endphp
                        
                        @foreach($aspek as $key => $label)
                        @php
                            $nilai = $nilaiPkl->$key;
                            $huruf = App\Models\NilaiPkl::konversiHuruf($nilai);
                            $verif = App\Models\NilaiPkl::verifikasiNilai($nilai);
                            $keterangan = App\Models\NilaiPkl::getKeterangan($nilai);
                            
                            $badgeClass = '';
                            if ($huruf == 'A') $badgeClass = 'bg-success';
                            elseif ($huruf == 'B') $badgeClass = 'bg-info';
                            elseif ($huruf == 'C') $badgeClass = 'bg-warning';
                            elseif ($huruf == 'D') $badgeClass = 'bg-danger';
                            else $badgeClass = 'bg-dark';
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><strong>{{ $label }}</strong></td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $nilai }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $badgeClass }}">{{ $huruf }}</span>
                            </td>
                            <td class="text-center">
                                @if($verif == 'Lulus')
                                    <span class="badge bg-success">{{ $verif }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $verif }}</span>
                                @endif
                            </td>
                            <td>{{ $keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <td colspan="2" class="text-end"><strong>JUMLAH NILAI</strong></td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $nilaiPkl->jumlah_nilai }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $badgeClass }}">{{ $nilaiPkl->jumlah_huruf }}</span>
                            </td>
                            <td class="text-center">
                                @if($nilaiPkl->jumlah_verifikasi == 'Lulus')
                                    <span class="badge bg-success">{{ $nilaiPkl->jumlah_verifikasi }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $nilaiPkl->jumlah_verifikasi }}</span>
                                @endif
                            </td>
                            <td>Total semua aspek penilaian</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end"><strong>NILAI RATA-RATA</strong></td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ number_format($nilaiPkl->rata_rata, 2) }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $badgeClass }}">{{ $nilaiPkl->huruf_rata_rata }}</span>
                            </td>
                            <td class="text-center">
                                @if(App\Models\NilaiPkl::verifikasiNilai($nilaiPkl->rata_rata) == 'Lulus')
                                    <span class="badge bg-success">{{ App\Models\NilaiPkl::verifikasiNilai($nilaiPkl->rata_rata) }}</span>
                                @else
                                    <span class="badge bg-danger">{{ App\Models\NilaiPkl::verifikasiNilai($nilaiPkl->rata_rata) }}</span>
                                @endif
                            </td>
                            <td>Rata-rata semua aspek penilaian</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Ringkasan -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center bg-light">
                        <div class="card-body">
                            <h3 class="text-primary">{{ number_format($nilaiPkl->rata_rata, 1) }}</h3>
                            <p class="mb-0">Rata-rata Nilai</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center {{ $badgeClass }} text-white">
                        <div class="card-body">
                            <h3>{{ $nilaiPkl->huruf_rata_rata }}</h3>
                            <p class="mb-0">Nilai Huruf</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center {{ App\Models\NilaiPkl::verifikasiNilai($nilaiPkl->rata_rata) == 'Lulus' ? 'bg-success' : 'bg-danger' }} text-white">
                        <div class="card-body">
                            <h3>{{ App\Models\NilaiPkl::verifikasiNilai($nilaiPkl->rata_rata) }}</h3>
                            <p class="mb-0">Status Kelulusan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Catatan -->
            <div class="alert alert-info mt-4">
                <h6><i class="fas fa-info-circle"></i> Informasi:</h6>
                <p class="mb-0">Nilai ini diinput pada {{ $nilaiPkl->created_at->format('d F Y H:i') }} oleh {{ $nilaiPkl->guru->nama ?? 'tidak diketahui' }}</p>
            </div>
        </div>
    </div>
</div>

<style>
.table th {
    text-align: center;
    vertical-align: middle;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-size: 0.9rem;
    padding: 8px 12px;
    min-width: 60px;
}

.card .card-body h3 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}
</style>
@endsection