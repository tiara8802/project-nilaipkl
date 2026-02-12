<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\NilaiPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class NilaiPklController extends Controller
{
    // Helper method untuk cek auth
    private function checkAuth()
    {
        if (!Auth::guard('guru')->check()) {
            return redirect()->route('login');
        }
        return null;
    }

    // ============= INDEX =============
    public function index(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $query = NilaiPkl::with(['siswa', 'guru'])
            ->orderBy('created_at', 'desc');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('paket_keahlian')) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('paket_keahlian', $request->paket_keahlian);
            });
        }
        
        if ($request->filled('bulan')) {
            $bulan = $request->bulan;
            $query->whereYear('tanggal_surat', substr($bulan, 0, 4))
                  ->whereMonth('tanggal_surat', substr($bulan, 5, 2));
        }
        
        $nilaiPkls = $query->paginate(10);
        $totalNilai = NilaiPkl::count();
        $rataRata = NilaiPkl::avg('rata_rata') ?? 0;
        
        return view('nilai-pkl.index', compact('nilaiPkls', 'totalNilai', 'rataRata'));
    }

    /**
     * ============= CREATE =============
     * 1. Ada parameter ?siswa=ID → Form input nilai
     * 2. Tidak ada parameter → Daftar siswa untuk dipilih
     */
    public function create(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        // CEK APAKAH ADA PARAMETER SISWA?
        if ($request->has('siswa')) {
            // ========== MODE 1: FORM INPUT NILAI ==========
            $siswa = Siswa::findOrFail($request->siswa);
            
            // Cek apakah siswa sudah punya nilai
            if ($siswa->nilaiPkl()->exists()) {
                return redirect()->route('nilai-pkl.show', $siswa->nilaiPkl->id)
                                 ->with('error', 'Siswa ini sudah memiliki nilai PKL!');
            }
            
            $guru = Auth::guard('guru')->user();
            
            // Generate nomor surat
            $currentYear = date('Y');
            $count = NilaiPkl::whereYear('created_at', $currentYear)->count() + 1;
            $noSurat = 'PKL/' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/SMKN1/' . date('m') . '/' . $currentYear;
            
            return view('nilai-pkl.create', compact('siswa', 'guru', 'noSurat'));
            
        } else {
            // ========== MODE 2: PILIH SISWA ==========
            $query = Siswa::whereDoesntHave('nilaiPkl');
            
            // Filter pencarian
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%");
                });
            }
            
            // Filter paket keahlian
            if ($request->filled('paket_keahlian')) {
                $query->where('paket_keahlian', $request->paket_keahlian);
            }
            
            $siswaList = $query->paginate(10);
            
            return view('nilai-pkl.create', compact('siswaList'));
        }
    }

    /**
     * ============= STORE =============
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id|unique:nilai_pkls,siswa_id',
            'no_surat' => 'required|string|max:100|unique:nilai_pkls,no_surat',
            'tanggal_surat' => 'required|date',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'tempat_pkl' => 'required|string|max:255',
            'pembimbing_nama' => 'required|string|max:255',
            'pembimbing_jabatan' => 'required|string|max:100',
            'pimpinan_nama' => 'required|string|max:255',
            'pimpinan_jabatan' => 'required|string|max:100',
            'disiplin_angka' => 'required|integer|min:0|max:100',
            'tanggung_jawab_angka' => 'required|integer|min:0|max:100',
            'inisiatif_angka' => 'required|integer|min:0|max:100',
            'loyalitas_angka' => 'required|integer|min:0|max:100',
            'kerjasama_angka' => 'required|integer|min:0|max:100',
            'pengambilan_keputusan_angka' => 'required|integer|min:0|max:100',
            'jiwa_entrepreneur_angka' => 'required|integer|min:0|max:100',
            'kejujuran_angka' => 'required|integer|min:0|max:100',
            'kemampuan_kerja_angka' => 'required|integer|min:0|max:100',
            'hasil_kerja_angka' => 'required|integer|min:0|max:100',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);
        $guru = Auth::guard('guru')->user();

        // Hitung total nilai
        $totalNilai = 
            $request->disiplin_angka +
            $request->tanggung_jawab_angka +
            $request->inisiatif_angka +
            $request->loyalitas_angka +
            $request->kerjasama_angka +
            $request->pengambilan_keputusan_angka +
            $request->jiwa_entrepreneur_angka +
            $request->kejujuran_angka +
            $request->kemampuan_kerja_angka +
            $request->hasil_kerja_angka;
        
        $rataRata = $totalNilai / 10;
        $hurufRataRata = $this->konversiKeHuruf($rataRata);
        
        // Konversi per aspek
        $disiplin_huruf = $this->konversiKeHuruf($request->disiplin_angka);
        $tanggung_jawab_huruf = $this->konversiKeHuruf($request->tanggung_jawab_angka);
        $inisiatif_huruf = $this->konversiKeHuruf($request->inisiatif_angka);
        $loyalitas_huruf = $this->konversiKeHuruf($request->loyalitas_angka);
        $kerjasama_huruf = $this->konversiKeHuruf($request->kerjasama_angka);
        $pengambilan_keputusan_huruf = $this->konversiKeHuruf($request->pengambilan_keputusan_angka);
        $jiwa_entrepreneur_huruf = $this->konversiKeHuruf($request->jiwa_entrepreneur_angka);
        $kejujuran_huruf = $this->konversiKeHuruf($request->kejujuran_angka);
        $kemampuan_kerja_huruf = $this->konversiKeHuruf($request->kemampuan_kerja_angka);
        $hasil_kerja_huruf = $this->konversiKeHuruf($request->hasil_kerja_angka);

        // Simpan data
        NilaiPkl::create([
            'siswa_id' => $siswa->id,
            'guru_id' => $guru->id,
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'tempat_pkl' => $request->tempat_pkl,
            'pembimbing_nama' => $request->pembimbing_nama,
            'pembimbing_jabatan' => $request->pembimbing_jabatan,
            'pimpinan_nama' => $request->pimpinan_nama,
            'pimpinan_jabatan' => $request->pimpinan_jabatan,
            
            // Nilai angka
            'disiplin_angka' => $request->disiplin_angka,
            'tanggung_jawab_angka' => $request->tanggung_jawab_angka,
            'inisiatif_angka' => $request->inisiatif_angka,
            'loyalitas_angka' => $request->loyalitas_angka,
            'kerjasama_angka' => $request->kerjasama_angka,
            'pengambilan_keputusan_angka' => $request->pengambilan_keputusan_angka,
            'jiwa_entrepreneur_angka' => $request->jiwa_entrepreneur_angka,
            'kejujuran_angka' => $request->kejujuran_angka,
            'kemampuan_kerja_angka' => $request->kemampuan_kerja_angka,
            'hasil_kerja_angka' => $request->hasil_kerja_angka,
            
            // Nilai huruf
            'disiplin_huruf' => $disiplin_huruf,
            'tanggung_jawab_huruf' => $tanggung_jawab_huruf,
            'inisiatif_huruf' => $inisiatif_huruf,
            'loyalitas_huruf' => $loyalitas_huruf,
            'kerjasama_huruf' => $kerjasama_huruf,
            'pengambilan_keputusan_huruf' => $pengambilan_keputusan_huruf,
            'jiwa_entrepreneur_huruf' => $jiwa_entrepreneur_huruf,
            'kejujuran_huruf' => $kejujuran_huruf,
            'kemampuan_kerja_huruf' => $kemampuan_kerja_huruf,
            'hasil_kerja_huruf' => $hasil_kerja_huruf,
            
            // Total dan rata-rata
            'jumlah_nilai_angka' => $totalNilai,
            'jumlah_nilai_huruf' => $hurufRataRata,
            'rata_rata' => round($rataRata, 2),
            'huruf_rata_rata' => $hurufRataRata,
        ]);

        return redirect()->route('nilai-pkl.index')
            ->with('success', 'Nilai PKL berhasil disimpan!');
    }

    // ============= SHOW =============
    public function show($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $nilaiPkl = NilaiPkl::with(['siswa', 'guru'])->findOrFail($id);
        
        return view('nilai-pkl.show', compact('nilaiPkl'));
    }

    // ============= EDIT =============
    public function edit($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $nilaiPkl = NilaiPkl::with(['siswa', 'guru'])->findOrFail($id);
        
        return view('nilai-pkl.edit', compact('nilaiPkl'));
    }

    // ============= UPDATE =============
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $nilaiPkl = NilaiPkl::findOrFail($id);
        
        $request->validate([
            'no_surat' => 'required|string|max:100|unique:nilai_pkls,no_surat,' . $id,
            'tanggal_surat' => 'required|date',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'tempat_pkl' => 'required|string|max:255',
            'pembimbing_nama' => 'required|string|max:255',
            'pembimbing_jabatan' => 'required|string|max:100',
            'pimpinan_nama' => 'required|string|max:255',
            'pimpinan_jabatan' => 'required|string|max:100',
            'disiplin_angka' => 'required|integer|min:0|max:100',
            'tanggung_jawab_angka' => 'required|integer|min:0|max:100',
            'inisiatif_angka' => 'required|integer|min:0|max:100',
            'loyalitas_angka' => 'required|integer|min:0|max:100',
            'kerjasama_angka' => 'required|integer|min:0|max:100',
            'pengambilan_keputusan_angka' => 'required|integer|min:0|max:100',
            'jiwa_entrepreneur_angka' => 'required|integer|min:0|max:100',
            'kejujuran_angka' => 'required|integer|min:0|max:100',
            'kemampuan_kerja_angka' => 'required|integer|min:0|max:100',
            'hasil_kerja_angka' => 'required|integer|min:0|max:100',
        ]);

        $totalNilai = 
            $request->disiplin_angka +
            $request->tanggung_jawab_angka +
            $request->inisiatif_angka +
            $request->loyalitas_angka +
            $request->kerjasama_angka +
            $request->pengambilan_keputusan_angka +
            $request->jiwa_entrepreneur_angka +
            $request->kejujuran_angka +
            $request->kemampuan_kerja_angka +
            $request->hasil_kerja_angka;
        
        $rataRata = $totalNilai / 10;
        $hurufRataRata = $this->konversiKeHuruf($rataRata);
        
        $disiplin_huruf = $this->konversiKeHuruf($request->disiplin_angka);
        $tanggung_jawab_huruf = $this->konversiKeHuruf($request->tanggung_jawab_angka);
        $inisiatif_huruf = $this->konversiKeHuruf($request->inisiatif_angka);
        $loyalitas_huruf = $this->konversiKeHuruf($request->loyalitas_angka);
        $kerjasama_huruf = $this->konversiKeHuruf($request->kerjasama_angka);
        $pengambilan_keputusan_huruf = $this->konversiKeHuruf($request->pengambilan_keputusan_angka);
        $jiwa_entrepreneur_huruf = $this->konversiKeHuruf($request->jiwa_entrepreneur_angka);
        $kejujuran_huruf = $this->konversiKeHuruf($request->kejujuran_angka);
        $kemampuan_kerja_huruf = $this->konversiKeHuruf($request->kemampuan_kerja_angka);
        $hasil_kerja_huruf = $this->konversiKeHuruf($request->hasil_kerja_angka);

        $nilaiPkl->update([
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'tempat_pkl' => $request->tempat_pkl,
            'pembimbing_nama' => $request->pembimbing_nama,
            'pembimbing_jabatan' => $request->pembimbing_jabatan,
            'pimpinan_nama' => $request->pimpinan_nama,
            'pimpinan_jabatan' => $request->pimpinan_jabatan,
            
            'disiplin_angka' => $request->disiplin_angka,
            'tanggung_jawab_angka' => $request->tanggung_jawab_angka,
            'inisiatif_angka' => $request->inisiatif_angka,
            'loyalitas_angka' => $request->loyalitas_angka,
            'kerjasama_angka' => $request->kerjasama_angka,
            'pengambilan_keputusan_angka' => $request->pengambilan_keputusan_angka,
            'jiwa_entrepreneur_angka' => $request->jiwa_entrepreneur_angka,
            'kejujuran_angka' => $request->kejujuran_angka,
            'kemampuan_kerja_angka' => $request->kemampuan_kerja_angka,
            'hasil_kerja_angka' => $request->hasil_kerja_angka,
            
            'disiplin_huruf' => $disiplin_huruf,
            'tanggung_jawab_huruf' => $tanggung_jawab_huruf,
            'inisiatif_huruf' => $inisiatif_huruf,
            'loyalitas_huruf' => $loyalitas_huruf,
            'kerjasama_huruf' => $kerjasama_huruf,
            'pengambilan_keputusan_huruf' => $pengambilan_keputusan_huruf,
            'jiwa_entrepreneur_huruf' => $jiwa_entrepreneur_huruf,
            'kejujuran_huruf' => $kejujuran_huruf,
            'kemampuan_kerja_huruf' => $kemampuan_kerja_huruf,
            'hasil_kerja_huruf' => $hasil_kerja_huruf,
            
            'jumlah_nilai_angka' => $totalNilai,
            'jumlah_nilai_huruf' => $hurufRataRata,
            'rata_rata' => round($rataRata, 2),
            'huruf_rata_rata' => $hurufRataRata,
        ]);

        return redirect()->route('nilai-pkl.index')
            ->with('success', 'Nilai PKL berhasil diperbarui!');
    }

    // ============= DESTROY =============
    public function destroy($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $nilaiPkl = NilaiPkl::findOrFail($id);
        $nilaiPkl->delete();
        
        return redirect()->route('nilai-pkl.index')
            ->with('success', 'Nilai PKL berhasil dihapus!');
    }

    // ============= CETAK PDF =============
    public function cetak($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $nilaiPkl = NilaiPkl::with(['siswa', 'guru'])->findOrFail($id);
        
        $pdf = PDF::loadView('nilai-pkl.cetak', compact('nilaiPkl'))
                  ->setPaper('a4', 'portrait');
        
        return $pdf->download('Sertifikat-PKL-' . $nilaiPkl->siswa->nis . '.pdf');
    }

    // ============= HELPER KONVERSI NILAI =============
    private function konversiKeHuruf($nilai)
    {
        if ($nilai >= 90) return 'A';
        if ($nilai >= 80) return 'B';
        if ($nilai >= 70) return 'C';
        if ($nilai >= 56) return 'D';
        return 'E';
    }
}