<!-- resources/views/prakerin/print-all.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data PKL - SMKN 1 Cirebon</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Inter Font Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            @page {
                size: A4 landscape;
                margin: 1.5cm;
            }
            body {
                font-family: 'Inter', sans-serif;
                font-size: 11pt;
            }
            .print-shadow {
                box-shadow: none !important;
            }
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 30px;
            min-height: 100vh;
        }
        
        .certificate-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            border: 1px solid rgba(30, 64, 175, 0.1);
        }
        
        .header-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #3b82f6 100%);
            padding: 30px 40px;
            position: relative;
            overflow: hidden;
        }
        
        .header-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .header-content {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .school-logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 30px -10px rgba(0,0,0,0.3);
            border: 3px solid #fbbf24;
        }
        
        .logo-icon i {
            font-size: 36px;
            color: #1e3a8a;
        }
        
        .school-text h1 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }
        
        .school-text p {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            font-weight: 500;
        }
        
        .report-badge {
            background: #fbbf24;
            padding: 12px 30px;
            border-radius: 50px;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2);
        }
        
        .report-badge h2 {
            color: #1e3a8a;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
        }
        
        .report-badge span {
            color: #1e3a8a;
            font-size: 12px;
            font-weight: 600;
            opacity: 0.8;
        }
        
        .period-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 20px 30px;
            margin: 30px 40px;
            border-left: 6px solid #3b82f6;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .period-box i {
            font-size: 28px;
            color: #3b82f6;
        }
        
        .period-box p {
            color: #334155;
            font-weight: 500;
        }
        
        .table-container {
            margin: 20px 40px 40px 40px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }
        
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .modern-table thead tr {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }
        
        .modern-table th {
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
            padding: 16px 12px;
            text-align: left;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        
        .modern-table th:last-child {
            border-right: none;
        }
        
        .modern-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }
        
        .modern-table tbody tr {
            transition: all 0.2s ease;
        }
        
        .modern-table tbody tr:hover {
            background: #f8fafc;
        }
        
        .modern-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }
        
        .modern-table tbody tr:nth-child(even):hover {
            background: #f1f5f9;
        }
        
        .text-center {
            text-align: center;
        }
        
        .badge-score {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
        }
        
        .badge-predikat {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
        }
        
        .summary-row {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
            font-weight: 700;
        }
        
        .summary-row td {
            font-weight: 700;
            color: #0f172a;
        }
        
        .signature-section {
            margin: 40px;
            padding-top: 20px;
            border-top: 2px dashed #cbd5e1;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .info-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        
        .info-box p {
            color: #334155;
            margin-bottom: 8px;
        }
        
        .signature-box {
            text-align: center;
            min-width: 300px;
        }
        
        .signature-line {
            width: 250px;
            height: 2px;
            background: #334155;
            margin: 10px auto;
        }
        
        .signature-name {
            font-weight: 700;
            color: #0f172a;
            font-size: 16px;
        }
        
        .signature-title {
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }
        
        .footer {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 16px 40px;
            text-align: center;
            color: #475569;
            font-size: 12px;
            border-top: 1px solid #cbd5e1;
        }
        
        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
            display: flex;
            gap: 10px;
        }
        
        .btn-modern {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-print {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
        }
        
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(30, 64, 175, 0.3);
        }
        
        .btn-back {
            background: white;
            color: #1e3a8a;
            border: 2px solid #1e3a8a;
        }
        
        .btn-back:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <!-- Action Buttons - No Print -->
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn-modern btn-print">
            <i class="fas fa-print"></i>
            Cetak / Simpan PDF
        </button>
        
        <a href="{{ route('prakerin.index') }}" class="btn-modern btn-back no-print">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Main Container -->
    <div class="certificate-container animate-in">
        <!-- Modern Header -->
        <div class="header-gradient">
            <div class="header-content">
                <div class="school-logo">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="school-text">
                        <h1>SMK NEGERI 1 KOTA CIREBON</h1>
                        <p><i class="fas fa-map-marker-alt mr-1"></i> Jl. Perjuangan No. 10, Kesambi</p>
                        <p><i class="fas fa-phone mr-1"></i> (0231) 123456 | <i class="fas fa-envelope mr-1"></i> info@smkn1-cirebon.sch.id</p>
                    </div>
                </div>
                <div class="report-badge">
                    <h2>LAPORAN PKL</h2>
                    <span>DATA PRAKTIK KERJA LAPANGAN</span>
                </div>
            </div>
        </div>

        <!-- Period Info -->
        <div class="period-box">
            <i class="fas fa-calendar-alt"></i>
            <div>
                <p class="text-lg font-semibold">Periode Laporan: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="text-sm text-gray-600">Laporan data Praktik Kerja Lapangan siswa SMK Negeri 1 Kota Cirebon</p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Sertifikat</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Tempat PKL</th>
                        <th>Periode</th>
                        <th>Rata-rata</th>
                        <th>Predikat</th>
                        <th>Pembimbing</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_nilai = 0;
                        $jumlah_data = 0;
                    @endphp
                    
                    @forelse($prakerins as $index => $prakerin)
                    @php
                        $total_nilai += $prakerin->rata_rata;
                        $jumlah_data++;
                    @endphp
                    <tr>
                        <td class="text-center font-medium">{{ $index + 1 }}</td>
                        <td class="font-mono text-xs">{{ $prakerin->no_sertifikat }}</td>
                        <td class="text-center">{{ $prakerin->nis }}</td>
                        <td class="font-medium">{{ $prakerin->nama }}</td>
                        <td>{{ $prakerin->tempat_pkl }}</td>
                        <td class="text-center">
                            <div>{{ \Carbon\Carbon::parse($prakerin->tgl_mulai)->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-500">- {{ \Carbon\Carbon::parse($prakerin->tgl_selesai)->format('d/m/Y') }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge-score">{{ number_format($prakerin->rata_rata, 2) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge-predikat">{{ $prakerin->predikat ?? '-' }}</span>
                        </td>
                        <td>{{ $prakerin->nama_pembimbing }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3 block text-gray-300"></i>
                            Tidak ada data PKL
                        </td>
                    </tr>
                    @endforelse
                    
                    @if($jumlah_data > 0)
                    <tr class="summary-row">
                        <td colspan="6" class="text-right font-bold">RATA-RATA KESELURUHAN:</td>
                        <td class="text-center font-bold">{{ number_format($total_nilai / $jumlah_data, 2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <!-- Info Box -->
            <div class="info-box">
                <p><i class="fas fa-database w-5 text-blue-600 mr-2"></i> <span class="font-medium">Jumlah Data:</span> {{ $prakerins->count() }} Siswa</p>
                <p><i class="fas fa-print w-5 text-blue-600 mr-2"></i> <span class="font-medium">Tanggal Cetak:</span> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p><i class="fas fa-clock w-5 text-blue-600 mr-2"></i> <span class="font-medium">Waktu Cetak:</span> {{ \Carbon\Carbon::now()->format('H:i:s') }} WIB</p>
            </div>

            <!-- Signature Box - NAMA KEPSEK DIUBAH -->
            <div class="signature-box">
                <p>Cirebon, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="font-medium mt-2">Kepala SMK Negeri 1 Kota Cirebon,</p>
                <br><br><br>
                <div class="signature-line"></div>
                <p class="signature-name"><strong>Ikhwanudin, S.Pd., M.Si.</strong></p>
                <p class="signature-title">NIP. 19750310 202501 1 005</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer no-print">
            <p>Dokumen ini dicetak melalui Sistem Pengelolaan Nilai PKL SMKN 1 Kota Cirebon v2.0</p>
            <p class="text-xs mt-1">© {{ date('Y') }} SMK Negeri 1 Kota Cirebon. All rights reserved.</p>
        </div>
    </div>

    <!-- Print Script -->
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('print') === 'true') {
                setTimeout(() => {
                    window.print();
                }, 500);
            }
        }

        // Auto-hide action buttons when printing
        window.onbeforeprint = function() {
            document.querySelectorAll('.no-print').forEach(el => el.style.display = 'none');
        };
        
        window.onafterprint = function() {
            document.querySelectorAll('.no-print').forEach(el => el.style.display = 'flex');
        };
    </script>
</body>
</html>