@extends('layouts.dashboard')

@section('title', 'Input Nilai PKL')
@section('page-title', 'Input Nilai PKL')
@section('page-subtitle', 'Form input nilai Praktik Kerja Lapangan')

@section('content')
<div class="content-card fade-in">
    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 2px solid #f1f3f9;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #212529; margin: 0; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-file-alt text-primary"></i>
            Form Input Nilai PKL
        </h2>
        <div>
            <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    {{-- 🔴 CEK APAKAH ADA PARAMETER SISWA? --}}
    @if(isset($siswa))
        {{-- ============= BAGIAN 2: FORM INPUT NILAI (SUDAH PUNYA SISWA) ============= --}}
        
        {{-- Alert Error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                Terdapat kesalahan! Harap periksa kembali form anda.
            </div>
        @endif

        {{-- Card Informasi Siswa --}}
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; padding: 25px; margin-bottom: 30px; color: white;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255,255,255,0.3);">
                    <span style="font-size: 32px; font-weight: 700; color: white;">
                        {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                    </span>
                </div>
                <div style="flex: 1;">
                    <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 5px; color: white;">{{ $siswa->nama }}</h3>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <span style="background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-id-card me-2"></i> NIS: {{ $siswa->nis }}
                        </span>
                        <span style="background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-code-branch me-2"></i> {{ $siswa->paket_keahlian }}
                        </span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('nilai-pkl.create') }}" style="background: rgba(255,255,255,0.2); color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-arrow-left"></i> Ganti Siswa
                    </a>
                </div>
            </div>
        </div>

        {{-- FORM INPUT NILAI --}}
        <form action="{{ route('nilai-pkl.store') }}" method="POST" id="formNilaiPkl">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

            {{-- Form 2 kolom --}}
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 25px;">
                {{-- Kiri: Info Surat --}}
                <div style="background: white; border-radius: 16px; padding: 25px; border: 1px solid #e9ecef;">
                    <h4 style="font-size: 1.1rem; font-weight: 700; color: #495057; margin-bottom: 20px;">
                        <i class="fas fa-file-signature text-primary me-2"></i>
                        Informasi Surat
                    </h4>
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Nomor Surat *</label>
                        <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat', $noSurat ?? '') }}" placeholder="PKL/001/SMKN1/01/2024">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Tanggal Surat *</label>
                        <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', date('Y-m-d')) }}">
                    </div>
                </div>

                {{-- Kanan: Tempat PKL --}}
                <div style="background: white; border-radius: 16px; padding: 25px; border: 1px solid #e9ecef;">
                    <h4 style="font-size: 1.1rem; font-weight: 700; color: #495057; margin-bottom: 20px;">
                        <i class="fas fa-building text-success me-2"></i>
                        Tempat PKL
                    </h4>
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Nama Tempat PKL *</label>
                        <input type="text" name="tempat_pkl" class="form-control" value="{{ old('tempat_pkl', $siswa->tempat_pkl ?? '') }}">
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div>
                            <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Tanggal Mulai *</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai', $siswa->tanggal_mulai_pkl ?? '') }}">
                        </div>
                        <div>
                            <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Tanggal Selesai *</label>
                            <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai', $siswa->tanggal_selesai_pkl ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pembimbing & Pimpinan --}}
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 25px;">
                <div style="background: white; border-radius: 16px; padding: 25px; border: 1px solid #e9ecef;">
                    <h4 style="font-size: 1.1rem; font-weight: 700; color: #495057; margin-bottom: 20px;">
                        <i class="fas fa-user-tie text-info me-2"></i>
                        Pembimbing Lapangan
                    </h4>
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Nama Pembimbing *</label>
                        <input type="text" name="pembimbing_nama" class="form-control" value="{{ old('pembimbing_nama') }}">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Jabatan Pembimbing *</label>
                        <input type="text" name="pembimbing_jabatan" class="form-control" value="{{ old('pembimbing_jabatan') }}">
                    </div>
                </div>
                <div style="background: white; border-radius: 16px; padding: 25px; border: 1px solid #e9ecef;">
                    <h4 style="font-size: 1.1rem; font-weight: 700; color: #495057; margin-bottom: 20px;">
                        <i class="fas fa-user-tie text-warning me-2"></i>
                        Pimpinan Perusahaan
                    </h4>
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Nama Pimpinan *</label>
                        <input type="text" name="pimpinan_nama" class="form-control" value="{{ old('pimpinan_nama') }}">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Jabatan Pimpinan *</label>
                        <input type="text" name="pimpinan_jabatan" class="form-control" value="{{ old('pimpinan_jabatan') }}">
                    </div>
                </div>
            </div>

            {{-- Tabel Nilai --}}
            <div style="background: white; border-radius: 16px; padding: 25px; border: 1px solid #e9ecef; margin-bottom: 25px;">
                <h4 style="font-size: 1.1rem; font-weight: 700; color: #495057; margin-bottom: 20px;">
                    <i class="fas fa-star text-warning me-2"></i>
                    Aspek Penilaian
                </h4>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 15px; text-align: left;">No</th>
                                <th style="padding: 15px; text-align: left;">Aspek Penilaian</th>
                                <th style="padding: 15px; text-align: left;">Nilai (0-100) *</th>
                                <th style="padding: 15px; text-align: left;">Predikat</th>
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
                                    'kemampuan_kerja' => 'Kemampuan Kerja',
                                    'hasil_kerja' => 'Hasil Kerja'
                                ];
                            @endphp
                            @foreach($aspek as $field => $label)
                            <tr>
                                <td style="padding: 12px 15px;">{{ $loop->iteration }}</td>
                                <td style="padding: 12px 15px; font-weight: 500;">{{ $label }}</td>
                                <td style="padding: 12px 15px;">
                                    <input type="number" name="{{ $field }}_angka" class="form-control nilai-input" 
                                           style="width: 120px;" min="0" max="100" oninput="updatePredikat('{{ $field }}', this.value)">
                                </td>
                                <td style="padding: 12px 15px;">
                                    <span id="{{ $field }}_predikat" style="padding: 5px 15px; border-radius: 20px; background: #e9ecef;">-</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Total & Rata-rata --}}
                <div style="margin-top: 25px; padding: 20px; background: #f8f9fa; border-radius: 12px; display: flex; justify-content: flex-end; gap: 30px;">
                    <div style="text-align: right;">
                        <div style="color: #6c757d;">Total Nilai</div>
                        <div style="font-size: 2rem; font-weight: 700; color: #4361ee;" id="totalNilai">0</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #6c757d;">Rata-rata</div>
                        <div style="font-size: 2rem; font-weight: 700; color: #28a745;" id="rataRata">0.0</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #6c757d;">Predikat</div>
                        <div style="font-size: 2rem; font-weight: 700; color: #ffc107;" id="predikatAkhir">-</div>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div style="display: flex; justify-content: flex-end; gap: 15px;">
                <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" id="btnSubmit">
                    <i class="fas fa-save me-2"></i> Simpan Nilai PKL
                </button>
            </div>
        </form>

    @else
        {{-- ============= BAGIAN 1: PILIH SISWA DULU ============= --}}
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; padding: 30px; margin-bottom: 30px; color: white;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-plus" style="font-size: 30px;"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 5px;">Pilih Siswa</h3>
                    <p style="margin: 0; opacity: 0.9;">Silakan pilih siswa yang akan diinput nilai PKL</p>
                </div>
            </div>
        </div>

        {{-- Search & Filter --}}
        <div style="background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e9ecef;">
            <form method="GET" action="{{ route('nilai-pkl.create') }}">
                <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px;">
                    <div>
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Cari Siswa</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Nama atau NIS..." 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 12px;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block;">Paket Keahlian</label>
                        <select name="paket_keahlian" style="width: 100%; padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 12px;">
                            <option value="">Semua Paket</option>
                            @php
                                $paketList = [
                                    'Teknik Komputer dan Jaringan (TKJ)',
                                    'Rekayasa Perangkat Lunak (RPL)',
                                    'Multimedia',
                                    'Akuntansi',
                                    'Administrasi Perkantoran',
                                    'Pemasaran',
                                    'Tata Boga',
                                    'Tata Busana',
                                    'Teknik Kendaraan Ringan (TKR)',
                                    'Teknik dan Bisnis Sepeda Motor (TBSM)'
                                ];
                            @endphp
                            @foreach($paketList as $paket)
                                <option value="{{ $paket }}" {{ request('paket_keahlian') == $paket ? 'selected' : '' }}>{{ $paket }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: flex-end;">
                        <button type="submit" style="background: #4361ee; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600;">
                            <i class="fas fa-search me-2"></i> Cari
                        </button>
                        @if(request('search') || request('paket_keahlian'))
                            <a href="{{ route('nilai-pkl.create') }}" style="background: #6c757d; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none;">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Daftar Siswa --}}
        @if(isset($siswaList) && $siswaList->count() > 0)
            <div style="background: white; border-radius: 16px; border: 1px solid #e9ecef; overflow: hidden;">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 16px; text-align: left;">No</th>
                                <th style="padding: 16px; text-align: left;">Nama Siswa</th>
                                <th style="padding: 16px; text-align: left;">NIS</th>
                                <th style="padding: 16px; text-align: left;">Paket Keahlian</th>
                                <th style="padding: 16px; text-align: left;">Kelas</th>
                                <th style="padding: 16px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswaList as $index => $item)
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 16px;">{{ $loop->iteration }}</td>
                                <td style="padding: 16px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #4361ee, #3a0ca3); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">{{ $item->nama }}</div>
                                            <small style="color: #6c757d;">{{ $item->asal_lembaga ?? 'SMK N 1 Cirebon' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 16px;">
                                    <span style="background: rgba(67,97,238,0.08); color: #4361ee; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem;">
                                        {{ $item->nis }}
                                    </span>
                                </td>
                                <td style="padding: 16px;">{{ $item->paket_keahlian }}</td>
                                <td style="padding: 16px;">{{ $item->kelas ?? '-' }}</td>
                                <td style="padding: 16px; text-align: center;">
                                    <a href="{{ route('nilai-pkl.create', ['siswa' => $item->id]) }}" 
                                       style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 8px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-plus-circle"></i>
                                        Input Nilai
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if(method_exists($siswaList, 'links'))
                <div style="margin-top: 25px;">
                    {{ $siswaList->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div style="background: white; border-radius: 16px; padding: 60px 20px; text-align: center; border: 2px dashed #e9ecef;">
                <div style="width: 100px; height: 100px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-user-graduate" style="font-size: 40px; color: #adb5bd;"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #495057; margin-bottom: 10px;">Tidak Ada Siswa Tersedia</h3>
                <p style="color: #6c757d; margin-bottom: 20px;">Semua siswa sudah memiliki nilai PKL atau belum ada data siswa.</p>
                <a href="{{ route('siswa.create') }}" style="display: inline-flex; align-items: center; gap: 10px; background: #4361ee; color: white; padding: 12px 30px; border-radius: 12px; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Siswa Baru
                </a>
            </div>
        @endif
    @endif
</div>

<script>
    // Fungsi update predikat
    function updatePredikat(field, nilai) {
        const span = document.getElementById(field + '_predikat');
        let predikat = '', warna = '';
        
        if (nilai >= 90) { predikat = 'A'; warna = '#28a745'; }
        else if (nilai >= 80) { predikat = 'B'; warna = '#17a2b8'; }
        else if (nilai >= 70) { predikat = 'C'; warna = '#ffc107'; }
        else if (nilai >= 56) { predikat = 'D'; warna = '#fd7e14'; }
        else { predikat = 'E'; warna = '#dc3545'; }
        
        span.textContent = predikat;
        span.style.background = warna + '20';
        span.style.color = warna;
        span.style.fontWeight = '700';
        
        hitungTotal();
    }

    // Fungsi hitung total
    function hitungTotal() {
        const inputs = document.querySelectorAll('.nilai-input');
        let total = 0, count = 0;
        
        inputs.forEach(input => {
            if (input.value) {
                total += parseInt(input.value);
                count++;
            }
        });
        
        document.getElementById('totalNilai').textContent = total;
        
        if (count > 0) {
            const rata = total / count;
            document.getElementById('rataRata').textContent = rata.toFixed(1);
            
            let predikat = '', warna = '';
            if (rata >= 90) { predikat = 'A'; warna = '#28a745'; }
            else if (rata >= 80) { predikat = 'B'; warna = '#17a2b8'; }
            else if (rata >= 70) { predikat = 'C'; warna = '#ffc107'; }
            else if (rata >= 56) { predikat = 'D'; warna = '#fd7e14'; }
            else { predikat = 'E'; warna = '#dc3545'; }
            
            const el = document.getElementById('predikatAkhir');
            el.textContent = predikat;
            el.style.background = warna + '20';
            el.style.color = warna;
        }
    }

    // Validasi tanggal
    document.addEventListener('DOMContentLoaded', function() {
        const tglMulai = document.getElementById('tgl_mulai');
        const tglSelesai = document.getElementById('tgl_selesai');
        if (tglMulai && tglSelesai) {
            tglMulai.addEventListener('change', () => tglSelesai.min = tglMulai.value);
        }
    });
</script>

<style>
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 16px;
        width: 100%;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67,97,238,0.1);
        outline: none;
    }
    .btn {
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
    }
    .btn:hover { transform: translateY(-3px); }
    .btn-primary { background: linear-gradient(135deg, #4361ee, #3a0ca3); color: white; }
    .btn-secondary { background: #6c757d; color: white; }
    .btn-primary:hover { box-shadow: 0 10px 30px rgba(67,97,238,0.3); }
    
    @media (max-width: 768px) {
        div[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection