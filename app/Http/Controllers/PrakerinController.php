<?php

namespace App\Http\Controllers;

use App\Models\Prakerin;
use App\Models\Guru;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PrakerinController extends Controller
{
    /**
     * CONSTRUCTOR - KOSONGIN!
     */
    public function __construct()
    {
        // KOSONGIN!
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SEMUA BISA (admin & guru)
        $prakerins = Prakerin::orderBy('created_at', 'desc')->get();
        return view('prakerin.index', compact('prakerins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // SEMUA BISA (admin & guru)
        $gurus = Guru::all();
        $perusahaans = Perusahaan::all();
        return view('prakerin.create', compact('gurus', 'perusahaans'));
    }

    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // SEMUA BISA (admin & guru)
    
    // Validasi data
    $validated = $request->validate([
        // Data Siswa
        'nama' => 'required|string|max:100|min:3',
        'ttl' => 'required|string|max:100',
        'nis' => 'required|string|size:8|regex:/^[0-9]+$/',
        'keahlian' => 'required|string|max:50',
        'lembaga' => 'required|string|max:100',
        
        // Waktu & Tempat
        'tgl_mulai' => 'required|date',
        'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        'perusahaan_id' => 'required|exists:perusahaans,id', // <-- PASTIKAN VALIDASI INI ADA
        
        // 10 Aspek Nilai (0-100)
        'disiplin' => 'required|integer|min:0|max:100',
        'tanggung_jawab' => 'required|integer|min:0|max:100',
        'inisiatif' => 'required|integer|min:0|max:100',
        'loyalitas' => 'required|integer|min:0|max:100',
        'kerjasama' => 'required|integer|min:0|max:100',
        'pengambilan_keputusan' => 'required|integer|min:0|max:100',
        'jiwa_entrepreneur' => 'required|integer|min:0|max:100',
        'kejujuran' => 'required|integer|min:0|max:100',
        'kemampuan_bekerja' => 'required|integer|min:0|max:100',
        'hasil_kerja' => 'required|integer|min:0|max:100',
        
        // Tanda Tangan
        'guru_id' => 'required|exists:gurus,id',
        'tanggal_sertifikat' => 'required|date',
        'nama_pimpinan' => 'required|string|max:100|min:3',
    ]);
    
    // Generate nomor sertifikat unik
    $no_sertifikat = 'PKL-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
    
    // Hitung total nilai
    $nilai_aspek = [
        $request->disiplin,
        $request->tanggung_jawab,
        $request->inisiatif,
        $request->loyalitas,
        $request->kerjasama,
        $request->pengambilan_keputusan,
        $request->jiwa_entrepreneur,
        $request->kejujuran,
        $request->kemampuan_bekerja,
        $request->hasil_kerja
    ];
    
    $total_nilai = array_sum($nilai_aspek);
    $rata_rata = round($total_nilai / 10, 2);
    
    // Tentukan predikat berdasarkan rata-rata
    $predikat = $this->getPredikat($rata_rata);
    
    // Tentukan status berdasarkan predikat
    $status = $rata_rata >= 75 ? 'selesai' : 'perbaikan';
    
    // Simpan data
    $prakerin = Prakerin::create([
        'no_sertifikat' => $no_sertifikat,
        
        // Data Siswa
        'nama' => $request->nama,
        'ttl' => $request->ttl,
        'nis' => $request->nis,
        'keahlian' => $request->keahlian,
        'lembaga' => $request->lembaga,
        
        // Waktu & Tempat
        'tgl_mulai' => $request->tgl_mulai,
        'tgl_selesai' => $request->tgl_selesai,
        'perusahaan_id' => $request->perusahaan_id, // <-- TAMBAHKAN INI!
        
        // 10 Aspek Nilai
        'disiplin' => $request->disiplin,
        'tanggung_jawab' => $request->tanggung_jawab,
        'inisiatif' => $request->inisiatif,
        'loyalitas' => $request->loyalitas,
        'kerjasama' => $request->kerjasama,
        'pengambilan_keputusan' => $request->pengambilan_keputusan,
        'jiwa_entrepreneur' => $request->jiwa_entrepreneur,
        'kejujuran' => $request->kejujuran,
        'kemampuan_bekerja' => $request->kemampuan_bekerja,
        'hasil_kerja' => $request->hasil_kerja,
        
        // Verifikasi (default ✓)
        'verifikasi_disiplin' => '✓',
        'verifikasi_tanggung_jawab' => '✓',
        'verifikasi_inisiatif' => '✓',
        'verifikasi_loyalitas' => '✓',
        'verifikasi_kerjasama' => '✓',
        'verifikasi_pengambilan_keputusan' => '✓',
        'verifikasi_jiwa_entrepreneur' => '✓',
        'verifikasi_kejujuran' => '✓',
        'verifikasi_kemampuan_bekerja' => '✓',
        'verifikasi_hasil_kerja' => '✓',
        
        // Total & Rata-rata
        'total_nilai' => $total_nilai,
        'rata_rata' => $rata_rata,
        'predikat' => $predikat,
        
        // Tanda Tangan
        'tanggal_sertifikat' => $request->tanggal_sertifikat,
        'guru_id' => $request->guru_id,
        'nama_pimpinan' => $request->nama_pimpinan,
        
        // Status
        'status' => $status,
        
        // Metadata
        'created_by' => Auth::guard('guru')->id() ?? null,
    ]);
    
    return redirect()->route('prakerin.index')
        ->with('success', 'Data PKL berhasil disimpan! No. Sertifikat: ' . $no_sertifikat);
}
    /**
     * Display the specified resource.
     */
    public function show(Prakerin $prakerin)
    {
        // SEMUA BISA (admin & guru)
        return view('prakerin.show', compact('prakerin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prakerin $prakerin)
    {
        // SEMUA BISA (admin & guru)
    $gurus = Guru::all();
    $perusahaans = Perusahaan::all();
    
    // KIRIM DATA PRAKERIN KE VIEW!
    return view('prakerin.edit', compact('prakerin', 'gurus', 'perusahaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prakerin $prakerin)
{
    // Validasi data untuk update
    $validated = $request->validate([
        // Data Siswa
        'nama' => 'required|string|max:100|min:3',
        'ttl' => 'required|string|max:100',
        'nis' => 'required|string|size:8|regex:/^[0-9]+$/',
        'keahlian' => 'required|string|max:50',
        'lembaga' => 'required|string|max:100',
        
        // Waktu & Tempat
        'tgl_mulai' => 'required|date',
        'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        'perusahaan_id' => 'required|integer|exists:perusahaans,id', // PERBAIKI: integer, bukan string|min
        
        // 10 Aspek Nilai (0-100)
        'disiplin' => 'required|integer|min:0|max:100',
        'tanggung_jawab' => 'required|integer|min:0|max:100',
        'inisiatif' => 'required|integer|min:0|max:100',
        'loyalitas' => 'required|integer|min:0|max:100',
        'kerjasama' => 'required|integer|min:0|max:100',
        'pengambilan_keputusan' => 'required|integer|min:0|max:100',
        'jiwa_entrepreneur' => 'required|integer|min:0|max:100',
        'kejujuran' => 'required|integer|min:0|max:100',
        'kemampuan_bekerja' => 'required|integer|min:0|max:100',
        'hasil_kerja' => 'required|integer|min:0|max:100',
        
        // Tanda Tangan - PERBAIKI: gunakan guru_id, bukan nama_pembimbing
        'guru_id' => 'required|integer|exists:gurus,id',
        'tanggal_sertifikat' => 'required|date',
        'nama_pimpinan' => 'required|string|max:100|min:3',
        
        // Status
        'status' => 'nullable|string|in:aktif,arsip,pending,selesai,perbaikan',
        'catatan' => 'nullable|string|max:500',
    ]);
    
    // Ambil data guru untuk mendapatkan nama pembimbing
    $guru = Guru::find($request->guru_id);
    
    // Hitung ulang total nilai
    $nilai_aspek = [
        $request->disiplin,
        $request->tanggung_jawab,
        $request->inisiatif,
        $request->loyalitas,
        $request->kerjasama,
        $request->pengambilan_keputusan,
        $request->jiwa_entrepreneur,
        $request->kejujuran,
        $request->kemampuan_bekerja,
        $request->hasil_kerja
    ];
    
    $total_nilai = array_sum($nilai_aspek);
    $rata_rata = round($total_nilai / 10, 2);
    $predikat = $this->getPredikat($rata_rata);
    
    // Update data
    $prakerin->update([
        // Data Siswa
        'nama' => $request->nama,
        'ttl' => $request->ttl,
        'nis' => $request->nis,
        'keahlian' => $request->keahlian,
        'lembaga' => $request->lembaga,
        
        // Waktu & Tempat
        'tgl_mulai' => $request->tgl_mulai,
        'tgl_selesai' => $request->tgl_selesai,
        'perusahaan_id' => $request->perusahaan_id,
        
        // 10 Aspek Nilai
        'disiplin' => $request->disiplin,
        'tanggung_jawab' => $request->tanggung_jawab,
        'inisiatif' => $request->inisiatif,
        'loyalitas' => $request->loyalitas,
        'kerjasama' => $request->kerjasama,
        'pengambilan_keputusan' => $request->pengambilan_keputusan,
        'jiwa_entrepreneur' => $request->jiwa_entrepreneur,
        'kejujuran' => $request->kejujuran,
        'kemampuan_bekerja' => $request->kemampuan_bekerja,
        'hasil_kerja' => $request->hasil_kerja,
        
        // Total & Rata-rata
        'total_nilai' => $total_nilai,
        'rata_rata' => $rata_rata,
        'predikat' => $predikat,
        
        // Tanda Tangan - PERBAIKI: gunakan guru_id dan nama_pembimbing dari relasi
        'tanggal_sertifikat' => $request->tanggal_sertifikat,
        'guru_id' => $request->guru_id,
        'nama_pembimbing' => $guru->nama, // ISI DENGAN NAMA GURU
        'nama_pimpinan' => $request->nama_pimpinan,
        
        // Status
        'status' => $request->status ?? ($rata_rata >= 75 ? 'selesai' : 'perbaikan'),
        'catatan' => $request->catatan,
        
        // Metadata
        'updated_by' => Auth::guard('guru')->id() ?? null,
    ]);
    
    return redirect()->route('prakerin.index')
        ->with('success', 'Data PKL berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     * HANYA ADMIN YANG BISA HAPUS!
     */
    public function destroy(Prakerin $prakerin)
    {
        // CEK APAKAH USER ADALAH ADMIN
        if (!Auth::guard('guru')->user()->is_admin) {
            return redirect()->back()->with('error', 'Hanya admin yang bisa menghapus data!');
        }
        
        // Simpan info sebelum dihapus untuk notifikasi
        $deletedData = [
            'no_sertifikat' => $prakerin->no_sertifikat,
            'nama' => $prakerin->nama,
            'nis' => $prakerin->nis,
        ];
        
        // Hapus data
        $prakerin->delete();
        
        // Redirect dengan pesan sukses
        return redirect()->route('prakerin.index')
            ->with('success', 'Data PKL ' . $deletedData['nama'] . ' (NIS: ' . $deletedData['nis'] . ') berhasil dihapus!');
    }
    
    /**
     * Cetak sertifikat individu
     * SEMUA BISA (admin & guru)
     */
    public function cetak(Prakerin $prakerin)
    {
        return view('prakerin.print', compact('prakerin'));
    }
    
    /**
     * Cetak semua data (laporan)
     * HANYA ADMIN YANG BISA!
     */
    public function cetakSemua()
    {
        // CEK APAKAH USER ADALAH ADMIN
        if (!Auth::guard('guru')->user()->is_admin) {
            return redirect()->back()->with('error', 'Hanya admin yang bisa mencetak semua data!');
        }
        
        $prakerins = Prakerin::orderBy('nama', 'asc')->get();
        
        if ($prakerins->isEmpty()) {
            return redirect()->route('prakerin.index')
                ->with('warning', 'Tidak ada data untuk dicetak!');
        }
        
        return view('prakerin.print-all', compact('prakerins'));
    }
    
    /**
     * 🔥 CETAK SERTIFIKAT OTOMATIS DARI CICWA PAKE NIS 🔥
     * HANYA ADMIN YANG BISA!
     */
    public function cetakSertifikat($nis)
    {
        // CEK APAKAH USER ADALAH ADMIN
        if (!Auth::guard('guru')->user()->is_admin) {
            return redirect()->back()->with('error', 'Hanya admin yang bisa mencetak sertifikat dari CICWA!');
        }
        
        try {
            // CEK KONEKSI DATABASE CICWA
            try {
                DB::connection('mysql_cicwa')->getPdo();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'KONEKSI DATABASE CICWA GAGAL! Cek config .env');
            }
            
            // AMBIL DATA SISWA DARI CICWA
            $siswa = DB::connection('mysql_cicwa')
                ->table('siswa')
                ->where('nis', $nis)
                ->first();
            
            if (!$siswa) {
                return redirect()->back()->with('error', 'SISWA DENGAN NIS ' . $nis . ' TIDAK DITEMUKAN DI DATABASE CICWA!');
            }
            
            // AMBIL DATA KELAS
            $kelas = DB::connection('mysql_cicwa')
                ->table('kelas')
                ->where('id', $siswa->kelas_id ?? 0)
                ->first();
            
            // AMBIL DATA JURUSAN
            $jurusan = DB::connection('mysql_cicwa')
                ->table('jurusan')
                ->where('id', $kelas->jurusan_id ?? 0)
                ->first();
            
            // AMBIL DATA PRAKERIN SISWA
            $prakerin = DB::connection('mysql_cicwa')
                ->table('prakerin')
                ->where('siswa_id', $siswa->id)
                ->orderBy('tgl_selesai', 'desc')
                ->first();
            
            // AMBIL DATA NILAI PKL
            $nilai = DB::connection('mysql_cicwa')
                ->table('nilai_pkl')
                ->where('prakerin_id', $prakerin->id ?? 0)
                ->get();
            
            // AMBIL DATA PEMBIMBING
            $pembimbing = DB::connection('mysql_cicwa')
                ->table('guru')
                ->where('id', $prakerin->pembimbing_id ?? 1)
                ->first();
            
            // AMBIL DATA KEPALA SEKOLAH/DIREKTUR
            $direktur = DB::connection('mysql_cicwa')
                ->table('pegawai')
                ->where('jabatan', 'like', '%kepala%')
                ->orWhere('jabatan', 'like', '%direktur%')
                ->first();
            
            // HITUNG TOTAL & RATA-RATA
            $totalNilai = 0;
            $jumlahNilai = $nilai->count();
            
            if ($jumlahNilai > 0) {
                foreach ($nilai as $n) {
                    $totalNilai += $n->nilai;
                }
                $rataRata = $totalNilai / $jumlahNilai;
            } else {
                // DATA DEFAULT KALO KOSONG
                $totalNilai = 877.3;
                $rataRata = 87.73;
                
                // BUAT DATA NILAI DEFAULT
                $nilai = collect([
                    (object) ['aspek' => 'Design', 'nilai' => 87.3, 'huruf' => 'A-'],
                    (object) ['aspek' => 'Tanggung Jawab', 'nilai' => 89.5, 'huruf' => 'A'],
                    (object) ['aspek' => 'Inisiatif', 'nilai' => 85.0, 'huruf' => 'B+'],
                    (object) ['aspek' => 'Loyalitas', 'nilai' => 90.0, 'huruf' => 'A'],
                    (object) ['aspek' => 'Kerjasama', 'nilai' => 88.5, 'huruf' => 'A'],
                    (object) ['aspek' => 'Pengambilan Keputusan', 'nilai' => 86.0, 'huruf' => 'B+'],
                    (object) ['aspek' => 'Jiwa Entrepreneur', 'nilai' => 84.5, 'huruf' => 'B+'],
                    (object) ['aspek' => 'Kejujuran', 'nilai' => 91.0, 'huruf' => 'A'],
                    (object) ['aspek' => 'Kemampuan Bekerja', 'nilai' => 88.0, 'huruf' => 'A-'],
                    (object) ['aspek' => 'Hasil Kerja', 'nilai' => 87.5, 'huruf' => 'A-'],
                ]);
            }
            
            // FORMAT DATA UNTUK VIEW
            $data = [
                'siswa' => [
                    'nama' => strtoupper($siswa->nama ?? 'KAYSA SHUBHI EL HANIF'),
                    'ttl' => strtoupper($siswa->tempat_lahir ?? 'CIREBON') . ', ' . Carbon::parse($siswa->tanggal_lahir ?? '2007-08-17')->translatedFormat('d F Y'),
                    'nis' => $siswa->nis ?? '12329236',
                    'paket' => strtoupper($jurusan->nama_jurusan ?? 'REKAYASA PERANGKAT LUNAK'),
                    'sekolah' => 'SMK NEGERI 1 KOTA CIREBON',
                ],
                'pkl' => [
                    'no_sertifikat' => str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) . '/PKL/SMKN1-CBN/' . date('m') . '/' . date('Y'),
                    'perusahaan' => strtoupper($prakerin->perusahaan_id ?? 'PT. NUSABOT TEKNOLOGI INDONESIA'),
                    'tgl_mulai' => Carbon::parse($prakerin->tgl_mulai ?? '2025-08-01')->translatedFormat('d F Y'),
                    'tgl_selesai' => Carbon::parse($prakerin->tgl_selesai ?? '2025-10-30')->translatedFormat('d F Y'),
                    'tgl_sertifikat' => 'Cirebon, ' . Carbon::now()->translatedFormat('d F Y'),
                ],
                'nilai' => $nilai,
                'total_format' => number_format($totalNilai, 1),
                'rata_rata' => number_format($rataRata, 2),
                'predikat' => $this->getPredikat($rataRata),
                'pembimbing' => [
                    'nama' => strtoupper($pembimbing->nama ?? 'DUDUNG ZULKIPLI, S.KOM., M.M.'),
                    'nip' => 'NIP. ' . ($pembimbing->nip ?? '19870512 202501 1 001'),
                ],
                'direktur' => [
                    'nama' => strtoupper($direktur->nama ?? 'DRS. H. SYAFI\'I, M.PD.'),
                    'nip' => 'NIP. ' . ($direktur->nip ?? '19750310 202501 1 005'),
                ],
            ];
            
            // PAKE VIEW SERTIFIKAT
            return view('prakerin.sertifikat-cicwa', $data);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ERROR: ' . $e->getMessage());
        }
    }
    
    /**
     * Helper function untuk menentukan predikat
     */
    private function getPredikat($nilai)
    {
        if ($nilai >= 90) {
            return 'SANGAT BAIK';
        } elseif ($nilai >= 80) {
            return 'BAIK';
        } elseif ($nilai >= 70) {
            return 'CUKUP';
        } elseif ($nilai >= 60) {
            return 'KURANG';
        } else {
            return 'SANGAT KURANG';
        }
    }
    
    /**
     * API untuk mendapatkan data dalam format JSON
     * HANYA ADMIN YANG BISA!
     */
    public function apiIndex()
    {
        // CEK APAKAH USER ADALAH ADMIN
        if (!Auth::guard('guru')->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang bisa akses API'
            ], 403);
        }
        
        $prakerins = Prakerin::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $prakerins,
            'count' => $prakerins->count(),
            'average' => $prakerins->avg('rata_rata') ?? 0,
        ]);
    }
    
    /**
     * API untuk mendapatkan data spesifik
     * HANYA ADMIN YANG BISA!
     */
    public function apiShow(Prakerin $prakerin)
    {
        // CEK APAKAH USER ADALAH ADMIN
        if (!Auth::guard('guru')->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang bisa akses API'
            ], 403);
        }
        
        return response()->json([
            'success' => true,
            'data' => $prakerin,
        ]);
    }
    
    /**
     * Search functionality
     * SEMUA BISA (admin & guru)
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $prakerins = Prakerin::where('nama', 'LIKE', "%{$search}%")
            ->orWhere('nis', 'LIKE', "%{$search}%")
            ->orWhere('no_sertifikat', 'LIKE', "%{$search}%")
            ->orWhere('perusahaan_id', 'LIKE', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('prakerin.index', compact('prakerins'));
    }
    
    /**
     * Filter berdasarkan status
     * SEMUA BISA (admin & guru)
     */
    public function filterStatus($status)
    {
        $prakerins = Prakerin::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('prakerin.index', compact('prakerins'))
            ->with('filter_status', $status);
    }
    
    /**
     * Get statistics for dashboard
     * HANYA ADMIN YANG BISA!
     */
    public function getStatistics()
    {
        // CEK APAKAH USER ADALAH ADMIN
        if (!Auth::guard('guru')->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang bisa akses statistik'
            ], 403);
        }
        
        $total = Prakerin::count();
        $average = Prakerin::avg('rata_rata') ?? 0;
        $completed = Prakerin::where('status', 'selesai')->count();
        $needImprovement = Prakerin::where('status', 'perbaikan')->count();
        
        return [
            'total' => $total,
            'average' => round($average, 2),
            'completed' => $completed,
            'need_improvement' => $needImprovement,
            'completion_rate' => $total > 0 ? round(($completed / $total) * 100, 1) : 0,
        ];
    }
}