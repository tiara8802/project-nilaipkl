<?php

namespace App\Http\Controllers;

use App\Models\NilaiPkl;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiPklController extends Controller
{
    // Menampilkan semua nilai
    public function index(Request $request)
    {
        $query = NilaiPkl::with('siswa');
        
        // Filter pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }
        
        // Filter status verifikasi
        if ($request->has('status')) {
            if ($request->status == 'verified') {
                $query->where('is_verified', true);
            } elseif ($request->status == 'unverified') {
                $query->where('is_verified', false);
            }
        }
        
        $nilaiPkls = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('guru.nilai-pkl.index', compact('nilaiPkls'));
    }

    // Form input nilai
    public function create()
    {
        $siswas = Siswa::orderBy('nama')->get();
        
        return view('guru.nilai-pkl.create', compact('siswas'));
    }

    // Simpan nilai baru
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'disiplin' => 'required|integer|min=0|max=100',
            'tanggung_jawab' => 'required|integer|min=0|max=100',
            'inisiatif' => 'required|integer|min=0|max=100',
            'loyalitas' => 'required|integer|min=0|max=100',
            'kerjasama' => 'required|integer|min=0|max=100',
            'pengambilan_keputusan' => 'required|integer|min=0|max=100',
            'jiwa_entrepreneur' => 'required|integer|min=0|max=100',
            'kejujuran' => 'required|integer|min=0|max=100',
            'kemampuan_bekerja' => 'required|integer|min=0|max=100',
            'hasil_kerja' => 'required|integer|min=0|max=100',
            'nama_pembimbing' => 'required|string|max:255',
            'nama_direktur' => 'required|string|max:255',
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
        ]);

        // Hitung total dan rata-rata
        $nilaiArray = [
            $request->disiplin,
            $request->tanggung_jawab,
            $request->inisiatif,
            $request->loyalitas,
            $request->kerjasama,
            $request->pengambilan_keputusan,
            $request->jiwa_entrepreneur,
            $request->kejujuran,
            $request->kemampuan_bekerja,
            $request->hasil_kerja,
        ];
        
        $jumlahNilai = array_sum($nilaiArray);
        $nilaiRataRata = $jumlahNilai / count($nilaiArray);
        
        // Konversi ke huruf
        $nilaiHuruf = $this->konversiNilaiKeHuruf($nilaiRataRata);

        // Simpan data
        $nilaiPkl = NilaiPkl::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => auth()->id(),
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
            'jumlah_nilai' => $jumlahNilai,
            'nilai_rata_rata' => $nilaiRataRata,
            'nilai_huruf' => $nilaiHuruf,
            'nama_pembimbing' => $request->nama_pembimbing,
            'nama_direktur' => $request->nama_direktur,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'is_verified' => $request->has('is_verified'),
        ]);

        return redirect()->route('nilai-pkl.index')
            ->with('success', 'Nilai PKL berhasil disimpan!');
    }

    // Detail nilai
    public function show($id)
    {
        $nilaiPkl = NilaiPkl::with('siswa')->findOrFail($id);
        return view('guru.nilai-pkl.show', compact('nilaiPkl'));
    }

    // Form edit nilai
    public function edit($id)
    {
        $nilaiPkl = NilaiPkl::findOrFail($id);
        $siswas = Siswa::orderBy('nama')->get();
        
        return view('guru.nilai-pkl.edit', compact('nilaiPkl', 'siswas'));
    }

    // Update nilai
    public function update(Request $request, $id)
    {
        $nilaiPkl = NilaiPkl::findOrFail($id);
        
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'disiplin' => 'required|integer|min=0|max=100',
            'tanggung_jawab' => 'required|integer|min=0|max=100',
            'inisiatif' => 'required|integer|min=0|max=100',
            'loyalitas' => 'required|integer|min=0|max=100',
            'kerjasama' => 'required|integer|min=0|max=100',
            'pengambilan_keputusan' => 'required|integer|min=0|max=100',
            'jiwa_entrepreneur' => 'required|integer|min=0|max=100',
            'kejujuran' => 'required|integer|min=0|max=100',
            'kemampuan_bekerja' => 'required|integer|min=0|max=100',
            'hasil_kerja' => 'required|integer|min=0|max=100',
            'nama_pembimbing' => 'required|string|max:255',
            'nama_direktur' => 'required|string|max:255',
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
        ]);

        // Hitung ulang
        $nilaiArray = [
            $request->disiplin,
            $request->tanggung_jawab,
            $request->inisiatif,
            $request->loyalitas,
            $request->kerjasama,
            $request->pengambilan_keputusan,
            $request->jiwa_entrepreneur,
            $request->kejujuran,
            $request->kemampuan_bekerja,
            $request->hasil_kerja,
        ];
        
        $jumlahNilai = array_sum($nilaiArray);
        $nilaiRataRata = $jumlahNilai / count($nilaiArray);
        $nilaiHuruf = $this->konversiNilaiKeHuruf($nilaiRataRata);

        $nilaiPkl->update([
            'siswa_id' => $request->siswa_id,
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
            'jumlah_nilai' => $jumlahNilai,
            'nilai_rata_rata' => $nilaiRataRata,
            'nilai_huruf' => $nilaiHuruf,
            'nama_pembimbing' => $request->nama_pembimbing,
            'nama_direktur' => $request->nama_direktur,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'is_verified' => $request->has('is_verified'),
        ]);

        return redirect()->route('nilai-pkl.index')
            ->with('success', 'Nilai PKL berhasil diperbarui!');
    }

    // Hapus nilai
    public function destroy($id)
    {
        $nilaiPkl = NilaiPkl::findOrFail($id);
        $nilaiPkl->delete();
        
        return redirect()->route('nilai-pkl.index')
            ->with('success', 'Nilai PKL berhasil dihapus!');
    }

    // Cetak PDF
    public function cetak($id)
    {
        $nilaiPkl = NilaiPkl::with('siswa')->findOrFail($id);
        
        $pdf = Pdf::loadView('guru.nilai-pkl.cetak', compact('nilaiPkl'));
        
        return $pdf->download('surat-keterangan-pkl-' . $nilaiPkl->siswa->nis . '.pdf');
    }

    // Verifikasi nilai
    public function verifikasi($id)
    {
        $nilaiPkl = NilaiPkl::findOrFail($id);
        $nilaiPkl->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);
        
        return back()->with('success', 'Nilai berhasil diverifikasi!');
    }

    // Fungsi konversi nilai
    private function konversiNilaiKeHuruf($nilai)
    {
        if ($nilai >= 90) return 'A';
        if ($nilai >= 80) return 'B';
        if ($nilai >= 70) return 'C';
        if ($nilai >= 60) return 'D';
        return 'E';
    }
}