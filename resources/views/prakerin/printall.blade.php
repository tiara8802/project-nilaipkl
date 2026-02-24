<!-- resources/views/prakerin/print-all.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Semua Data PKL - SMKN 1 Cirebon</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
                font-size: 12pt;
            }
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 20px;
            background: white;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .header h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            border: 1px solid #000;
        }
        
        .table td {
            padding: 8px;
            border: 1px solid #000;
            vertical-align: middle;
        }
        
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        
        .signature {
            margin-top: 80px;
            width: 100%;
        }
        
        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn btn-primary btn-print no-print">
        <i class="fas fa-print me-2"></i>Cetak / Simpan PDF
    </button>
    
    <a href="{{ route('prakerin.index') }}" class="btn btn-secondary btn-print no-print" style="right: 180px;">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>

    <div class="header">
        <h1>SMK NEGERI 1 KOTA CIREBON</h1>
        <p>Jl. Perjuangan No. 10, Kesambi, Kota Cirebon, Jawa Barat 45133</p>
        <p>Telp: (0231) 123456 | Email: info@smkn1-cirebon.sch.id</p>
        <hr style="border: 2px solid #000; margin: 20px 0;">
        <h2>LAPORAN DATA PRAKTIK KERJA LAPANGAN (PKL)</h2>
        <p>Periode: {{ date('d F Y') }}</p>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">No. Sertifikat</th>
                <th width="10%">NIS</th>
                <th width="15%">Nama Siswa</th>
                <th width="15%">Tempat PKL</th>
                <th width="15%">Periode</th>
                <th width="10%">Rata-rata</th>
                <th width="8%">Predikat</th>
                <th width="10%">Pembimbing</th>
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
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $prakerin->no_sertifikat }}</td>
                <td>{{ $prakerin->nis }}</td>
                <td>{{ $prakerin->nama }}</td>
                <td>{{ $prakerin->tempat_pkl }}</td>
                <td>{{ \Carbon\Carbon::parse($prakerin->tgl_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($prakerin->tgl_selesai)->format('d/m/Y') }}</td>
                <td class="text-center">{{ number_format($prakerin->rata_rata, 2) }}</td>
                <td class="text-center">{{ $prakerin->predikat ?? '-' }}</td>
                <td>{{ $prakerin->nama_pembimbing }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data PKL</td>
            </tr>
            @endforelse
            
            @if($jumlah_data > 0)
            <tr class="fw-bold">
                <td colspan="6" class="text-end">RATA-RATA KESELURUHAN:</td>
                <td class="text-center">{{ number_format($total_nilai / $jumlah_data, 2) }}</td>
                <td colspan="2"></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-md-6">
            <p>Jumlah Data: {{ $prakerins->count() }} Siswa</p>
            <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>
        <div class="col-md-6 text-end">
            <div class="signature">
                <p>Cirebon, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Kepala SMK Negeri 1 Kota Cirebon,</p>
                <br><br><br>
                <p><strong>Drs. H. SYAFI'I, M.Pd.</strong></p>
                <p>NIP. 19750310 202501 1 005</p>
            </div>
        </div>
    </div>

    <div class="footer no-print">
        <hr>
        <p class="text-muted">Dokumen ini dicetak melalui Sistem Pengelolaan Nilai PKL SMKN 1 Cirebon</p>
    </div>

    <script>
        window.onload = function() {
            // Auto print jika ada parameter print
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('print') === 'true') {
                setTimeout(() => {
                    window.print();
                }, 500);
            }
        }
    </script>
</body>
</html>