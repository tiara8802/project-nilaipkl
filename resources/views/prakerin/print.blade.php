<!-- resources/views/prakerin/cetak-sertifikat.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sertifikat PKL - {{ $prakerin->nama ?? 'SISWA' }} | SMKN 1 CIREBON</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ========== SISWA THEME - SMK NEGERI 1 KOTA CIREBON ========== */
        :root {
            --siswa-blue: #0d47a1;
            --siswa-dark: #0a3a7a;
            --siswa-light: #e3f2fd;
            --siswa-accent: #ffb300;
            --siswa-gold: #ff8f00;
            --siswa-gray: #263238;
            --siswa-soft: #f5f9ff;
            --siswa-white: #ffffff;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        
        /* PRINT OPTIMIZATION */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .certificate-wrapper {
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }
            @page {
                size: A4 landscape;
                margin: 1cm;
            }
        }
        
        /* CERTIFICATE WRAPPER */
        .certificate-wrapper {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto 30px;
            position: relative;
        }
        
        /* MAIN CERTIFICATE */
        .certificate-siswa {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(13, 71, 161, 0.25);
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(13, 71, 161, 0.15);
        }
        
        /* HEADER - SMKN 1 CIREBON */
        .certificate-header {
            background: linear-gradient(135deg, var(--siswa-blue) 0%, var(--siswa-dark) 100%);
            padding: 30px 40px;
            position: relative;
            border-bottom: 5px solid var(--siswa-accent);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .school-logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2);
            border: 3px solid var(--siswa-accent);
        }
        
        .logo-icon i {
            font-size: 45px;
            color: var(--siswa-blue);
        }
        
        .school-text h1 {
            color: white;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        
        .school-text p {
            color: rgba(255,255,255,0.9);
            font-size: 16px;
            font-weight: 500;
        }
        
        .siswa-badge {
            background: var(--siswa-accent);
            padding: 12px 30px;
            border-radius: 40px;
            text-align: center;
        }
        
        .siswa-badge h2 {
            color: var(--siswa-dark);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 3px;
        }
        
        .siswa-badge span {
            color: var(--siswa-dark);
            font-size: 12px;
            font-weight: 600;
            opacity: 0.9;
        }
        
        /* CONTENT */
        .certificate-content {
            padding: 50px 60px;
            position: relative;
            background: white;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.03;
            z-index: 0;
        }
        
        .watermark i {
            font-size: 280px;
            color: var(--siswa-blue);
        }
        
        .content-inner {
            position: relative;
            z-index: 2;
        }
        
        /* TITLE */
        .certificate-title {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .certificate-title p {
            color: var(--siswa-blue);
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 6px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        
        .certificate-title h2 {
            color: var(--siswa-dark);
            font-size: 40px;
            font-weight: 800;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .certificate-title h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--siswa-accent), var(--siswa-gold));
            border-radius: 2px;
        }
        
        /* STUDENT NAME */
        .student-name-area {
            text-align: center;
            margin: 40px 0 20px;
        }
        
        .student-name {
            font-size: 48px;
            font-weight: 800;
            color: var(--siswa-dark);
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 20px;
            padding: 15px 40px;
            display: inline-block;
            border-bottom: 3px solid var(--siswa-accent);
            border-top: 3px solid var(--siswa-accent);
        }
        
        /* STUDENT DETAILS */
        .student-details {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            background: var(--siswa-soft);
            border-radius: 50px;
            border: 1px solid rgba(13, 71, 161, 0.2);
        }
        
        .detail-item i {
            font-size: 18px;
            color: var(--siswa-blue);
            width: 24px;
        }
        
        .detail-item span {
            color: var(--siswa-gray);
            font-weight: 600;
            font-size: 16px;
        }
        
        /* COMPANY */
        .company-info {
            text-align: center;
            margin: 30px 0;
        }
        
        .company-label {
            color: var(--siswa-gray);
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .company-name {
            background: linear-gradient(135deg, var(--siswa-light) 0%, white 100%);
            padding: 15px 50px;
            border-radius: 50px;
            font-size: 28px;
            font-weight: 700;
            color: var(--siswa-dark);
            display: inline-block;
            border: 2px solid var(--siswa-blue);
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.1);
        }
        
        /* PERIOD */
        .period-info {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin: 40px 0;
            padding: 25px;
            background: linear-gradient(135deg, #f8fbff, white);
            border-radius: 20px;
            border: 1px solid rgba(13, 71, 161, 0.15);
        }
        
        .period-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .period-icon {
            width: 50px;
            height: 50px;
            background: var(--siswa-blue);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .period-icon i {
            font-size: 24px;
            color: white;
        }
        
        .period-text h4 {
            color: var(--siswa-soft-gray);
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .period-text p {
            color: var(--siswa-dark);
            font-size: 20px;
            font-weight: 700;
        }
        
        /* SCORE TABLE */
        .score-section {
            margin: 50px 0;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .section-header i {
            font-size: 28px;
            color: var(--siswa-blue);
            padding: 12px;
            background: var(--siswa-light);
            border-radius: 15px;
        }
        
        .section-header h3 {
            color: var(--siswa-dark);
            font-size: 22px;
            font-weight: 700;
        }
        
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(13, 71, 161, 0.2);
        }
        
        .score-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .score-table thead {
            background: linear-gradient(135deg, var(--siswa-blue), var(--siswa-dark));
        }
        
        .score-table th {
            padding: 16px;
            color: white;
            font-weight: 600;
            font-size: 15px;
            text-align: left;
            text-transform: uppercase;
        }
        
        .score-table tbody tr {
            border-bottom: 1px solid rgba(13, 71, 161, 0.1);
            transition: all 0.2s;
        }
        
        .score-table tbody tr:hover {
            background: var(--siswa-light);
        }
        
        .score-table td {
            padding: 14px 16px;
            color: var(--siswa-gray);
        }
        
        /* ========== NILAI BADGE - FORMAL (TANPA WARNA) ========== */
        .nilai-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 14px;
            background-color: #f8f9fa;
            color: #212529;
            border: 1px solid #dee2e6;
        }
        
        /* SEMUA NILAI PAKAI STYLE YANG SAMA - TANPA WARNA */
        .nilai-sangat-baik,
        .nilai-baik,
        .nilai-cukup {
            background-color: #f8f9fa;
            color: #212529;
            border: 1px solid #dee2e6;
        }
        
        /* SUMMARY */
        .summary-box {
            background: linear-gradient(135deg, var(--siswa-dark) 0%, var(--siswa-blue) 100%);
            border-radius: 16px;
            padding: 30px 40px;
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .average-box {
            text-align: center;
        }
        
        .average-box h5 {
            color: rgba(255,255,255,0.8);
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .average-number {
            font-size: 52px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }
        
        .predikat-box {
            text-align: right;
        }
        
        .predikat-badge {
            background: var(--siswa-accent);
            color: var(--siswa-dark);
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 2px;
        }
        
        /* ========== SIGNATURE AREA - FIXED POSISI TENGAH ========== */
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            padding-top: 40px;
            border-top: 2px dashed rgba(13, 71, 161, 0.3);
        }
        
        .signature-box {
            text-align: center;
            width: 45%;
        }
        
        .signature-date {
            color: var(--siswa-gray);
            margin-bottom: 20px;
            font-size: 16px;
        }
        
        .signature-line {
            width: 80%;
            height: 2px;
            background: var(--siswa-dark);
            margin: 15px auto 10px;
        }
        
        .signature-name {
            font-weight: 700;
            color: var(--siswa-dark);
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .signature-title {
            color: var(--siswa-soft-gray);
            font-size: 15px;
            font-weight: 500;
        }
        
        .pembimbing-info {
            text-align: center;
            margin-bottom: 20px;
        }
        
        /* FOOTER */
        .certificate-footer {
            margin-top: 40px;
            padding: 20px;
            background: var(--siswa-soft);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(13, 71, 161, 0.2);
        }
        
        .verification {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .verification i {
            font-size: 28px;
            color: var(--siswa-blue);
        }
        
        .verification-code {
            font-family: monospace;
            font-size: 18px;
            font-weight: 700;
            color: var(--siswa-dark);
            letter-spacing: 2px;
        }
        
        .siswa-footer {
            color: var(--siswa-soft-gray);
            font-size: 14px;
        }
        
        /* BUTTONS */
        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin: 30px 0 50px;
        }
        
        .btn-custom {
            padding: 15px 35px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(13, 71, 161, 0.2);
        }
        
        .btn-print {
            background: linear-gradient(135deg, var(--siswa-blue), var(--siswa-dark));
            color: white;
        }
        
        .btn-print:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(13, 71, 161, 0.4);
        }
        
        .btn-back {
            background: white;
            color: var(--siswa-blue);
            border: 2px solid var(--siswa-blue);
        }
        
        .btn-back:hover {
            background: var(--siswa-light);
            transform: translateY(-3px);
        }
        
        /* RESPONSIVE */
        @media (max-width: 992px) {
            .certificate-content {
                padding: 30px;
            }
            .student-name {
                font-size: 36px;
            }
            .header-content {
                flex-direction: column;
                gap: 20px;
            }
            .summary-box {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            .signature-area {
                flex-direction: column;
                align-items: center;
                gap: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .student-name {
                font-size: 28px;
                padding: 10px 20px;
            }
            .company-name {
                font-size: 22px;
                padding: 12px 30px;
            }
            .period-info {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- ACTION BUTTONS - NO PRINT -->
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn btn-print btn-custom">
            <i class="fas fa-print"></i>
            Cetak Sertifikat
        </button>
        <a href="{{ route('prakerin.index') }}" class="btn btn-back btn-custom">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- SERTIFIKAT PKL - SMK NEGERI 1 KOTA CIREBON -->
    <div class="certificate-wrapper">
        <div class="certificate-siswa">
            
            <!-- HEADER SMKN 1 CIREBON -->
            <div class="certificate-header">
                <div class="header-content">
                    <div class="school-logo">
                        <div class="logo-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="school-text">
                            <h1>SMK NEGERI 1</h1>
                            <p>KOTA CIREBON</p>
                        </div>
                    </div>
                    <div class="siswa-badge">
                        <h2>SISWA</h2>
                        <span>SISTEM INFORMASI SISWA & WALI</span>
                    </div>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="certificate-content">
                <div class="watermark">
                    <i class="fas fa-certificate"></i>
                </div>
                
                <div class="content-inner">
                    <!-- TITLE -->
                    <div class="certificate-title">
                        <p>SERTIFIKAT PRAKTIK KERJA LAPANGAN</p>
                        <h2>PENGHARGAAN</h2>
                    </div>
                    
                    <!-- STUDENT NAME -->
                    <div class="student-name-area">
                        <div class="student-name">
                            {{ $prakerin->nama ?? '__________________' }}
                        </div>
                    </div>
                    
                    <!-- STUDENT DETAILS -->
                    <div class="student-details">
                        <div class="detail-item">
                            <i class="fas fa-id-card"></i>
                            <span>NIS: {{ $prakerin->nis ?? '__________' }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $prakerin->ttl ?? '__________________' }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-code"></i>
                            <span>{{ $prakerin->keahlian ?? 'Rekayasa Perangkat Lunak' }}</span>
                        </div>
                    </div>
                    
                    <!-- DESCRIPTION -->
                    <div style="text-align: center; margin: 30px 0; color: #37474f; font-size: 18px;">
                        <p>Telah melaksanakan Praktik Kerja Lapangan dengan baik di</p>
                    </div>
                    
                    <!-- COMPANY -->
                    <div class="company-info">
                        <div class="company-name">
                            {{ $prakerin->tempat_pkl ?? '________________________________' }}
                        </div>
                    </div>
                    
                    <!-- INTERNSHIP PERIOD -->
                    <div class="period-info">
                        <div class="period-item">
                            <div class="period-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <div class="period-text">
                                <h4>Tanggal Mulai</h4>
                                <p>{{ isset($prakerin->tgl_mulai) ? \Carbon\Carbon::parse($prakerin->tgl_mulai)->translatedFormat('d F Y') : '________________' }}</p>
                            </div>
                        </div>
                        <div class="period-item">
                            <div class="period-icon">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <div class="period-text">
                                <h4>Tanggal Selesai</h4>
                                <p>{{ isset($prakerin->tgl_selesai) ? \Carbon\Carbon::parse($prakerin->tgl_selesai)->translatedFormat('d F Y') : '________________' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SCORE TABLE -->
                    <div class="score-section">
                        <div class="section-header">
                            <i class="fas fa-star"></i>
                            <h3>HASIL PENILAIAN PKL</h3>
                        </div>
                        
                        <div class="table-container">
                            <table class="score-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aspek Penilaian</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $aspek_penilaian = [
                                            'disiplin' => 'Disiplin',
                                            'tanggung_jawab' => 'Tanggung Jawab',
                                            'inisiatif' => 'Inisiatif',
                                            'loyalitas' => 'Loyalitas',
                                            'kerjasama' => 'Kerjasama',
                                            'pengambilan_keputusan' => 'Pengambilan Keputusan',
                                            'jiwa_entrepreneur' => 'Jiwa Entrepreneur',
                                            'kejujuran' => 'Kejujuran',
                                            'kemampuan_bekerja' => 'Kemampuan Bekerja',
                                            'hasil_kerja' => 'Hasil Kerja'
                                        ];
                                        $total_nilai = 0;
                                        $jumlah_aspek = 0;
                                    @endphp
                                    
                                    @foreach($aspek_penilaian as $field => $label)
                                        @php
                                            $nilai = $prakerin->$field ?? 0;
                                            $total_nilai += $nilai;
                                            $jumlah_aspek++;
                                            
                                            if($nilai >= 90) {
                                                $keterangan = 'Sangat Baik';
                                                $class = 'nilai-sangat-baik';
                                            } elseif($nilai >= 80) {
                                                $keterangan = 'Baik';
                                                $class = 'nilai-baik';
                                            } elseif($nilai >= 70) {
                                                $keterangan = 'Cukup';
                                                $class = 'nilai-cukup';
                                            } else {
                                                $keterangan = 'Kurang';
                                                $class = 'nilai-cukup';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $label }}</td>
                                            <td>
                                                <span class="nilai-badge {{ $class }}">
                                                    {{ $nilai }}
                                                </span>
                                            </td>
                                            <td>{{ $keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- SUMMARY -->
                        @php
                            $rata_rata = $jumlah_aspek > 0 ? round($total_nilai / $jumlah_aspek, 2) : 0;
                            if($rata_rata >= 90) {
                                $predikat = 'SANGAT BAIK';
                            } elseif($rata_rata >= 80) {
                                $predikat = 'BAIK';
                            } elseif($rata_rata >= 70) {
                                $predikat = 'CUKUP';
                            } else {
                                $predikat = 'LULUS';
                            }
                        @endphp
                        
                        <div class="summary-box">
                            <div class="average-box">
                                <h5>Nilai Rata-rata</h5>
                                <div class="average-number">{{ $rata_rata }}</div>
                                <div style="font-size: 16px; opacity: 0.9;">dari 100</div>
                            </div>
                            <div class="predikat-box">
                                <h5 style="color: rgba(255,255,255,0.8); margin-bottom: 10px; text-transform: uppercase;">Predikat</h5>
                                <div class="predikat-badge">
                                    {{ $predikat }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ========== SIGNATURE AREA - FIXED: SEMUA DI TENGAH ========== -->
                    <div class="signature-area">
                        <!-- KIRI: Pimpinan/Direktur -->
                        <div class="signature-box">
                            <div class="pembimbing-info">
                                <p class="small text-muted mb-1">Mengetahui,</p>
                                <p class="fw-bold text-gray-800">Pimpinan/Direktur Perusahaan</p>
                            </div>
                            <br><br><br>
                            <div class="signature-line"></div>
                            <div class="signature-name">
                                {{ $prakerin->nama_pimpinan ?? '______________________' }}
                            </div>
                            <div class="signature-title">
                                {{ $prakerin->tempat_pkl ?? 'Perusahaan/Instansi' }}
                            </div>
                        </div>
                        
                        <!-- KANAN: Guru Pembimbing -->
                        <div class="signature-box">
                            <div class="signature-date">
                                Cirebon, {{ isset($prakerin->tanggal_sertifikat) ? \Carbon\Carbon::parse($prakerin->tanggal_sertifikat)->translatedFormat('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                            </div>
                            <p class="small text-muted mb-1">Guru Pembimbing,</p>
                            <br><br><br>
                            <div class="signature-line"></div>
                            <div class="signature-name">
                                {{ $prakerin->nama_pembimbing ?? '______________________' }}
                            </div>
                            <div class="signature-title">
                                Guru Pembimbing PKL
                            </div>
                        </div>
                    </div>
                    
                    <!-- FOOTER -->
                    <div class="certificate-footer">
                        <div class="verification">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <div style="font-weight: 600; color: var(--siswa-dark);">Kode Verifikasi</div>
                                <div class="verification-code">
                                    {{ 'PKL-' . strtoupper(substr(md5($prakerin->id . $prakerin->nis . $prakerin->tgl_mulai), 0, 8)) }}
                                </div>
                            </div>
                        </div>
                        <div class="siswa-footer">
                            <i class="fas fa-database"></i> SISWA v1.0 - SMKN 1 Kota Cirebon
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generatePDF() {
            window.print();
        }
        
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('print') === 'true') {
                setTimeout(() => {
                    window.print();
                }, 500);
            }
        };
    </script>
</body>
</html>