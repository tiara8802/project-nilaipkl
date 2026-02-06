<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\NilaiPkl;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // ========== CRUD SISWA ========== //
    public function index()
    {
        $siswas = Siswa::orderBy('nama')->paginate(10);
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $paketKeahlian = [
            'Teknik Komputer dan Jaringan (TKJ)',
            'Rekayasa Perangkat Lunak (RPL)',
            'Multimedia',
            'Akuntansi',
            'Administrasi Perkantoran',
            'Pemasaran',
            'Tata Boga',
            'Tata Busana',
            'Teknik Kendaraan Ringan (TKR)',
            'Teknik dan Bisnis Sepeda Motor (TBSM)',
        ];
        
        return view('siswa.create', compact('paketKeahlian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'nis' => 'required|string|unique:siswas|max:20',
            'paket_keahlian' => 'required|string|max:100',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'tempat_pkl' => 'required|string|max:255',
            'alamat_pkl' => 'nullable|string',
            'telepon_pkl' => 'nullable|string|max:20',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nis' => $request->nis,
            'paket_keahlian' => $request->paket_keahlian,
            'asal_lembaga' => 'SMK NEGERI 1 KOTA CIREBON',
            'tanggal_mulai_pkl' => $request->tanggal_mulai_pkl,
            'tanggal_selesai_pkl' => $request->tanggal_selesai_pkl,
            'tempat_pkl' => $request->tempat_pkl,
            'alamat_pkl' => $request->alamat_pkl,
            'telepon_pkl' => $request->telepon_pkl,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        $siswa = Siswa::with('nilaiPkls')->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $paketKeahlian = [
            'Teknik Komputer dan Jaringan (TKJ)',
            'Rekayasa Perangkat Lunak (RPL)',
            'Multimedia',
            'Akuntansi',
            'Administrasi Perkantoran',
            'Pemasaran',
            'Tata Boga',
            'Tata Busana',
            'Teknik Kendaraan Ringan (TKR)',
            'Teknik dan Bisnis Sepeda Motor (TBSM)',
        ];
        
        return view('siswa.edit', compact('siswa', 'paketKeahlian'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'nis' => 'required|string|unique:siswas,nis,' . $id . '|max:20',
            'paket_keahlian' => 'required|string|max:100',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'tempat_pkl' => 'required|string|max:255',
            'alamat_pkl' => 'nullable|string',
            'telepon_pkl' => 'nullable|string|max:20',
        ]);

        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        if ($siswa->nilaiPkls()->exists()) {
            return back()->with('error', 'Tidak bisa hapus siswa yang sudah punya nilai!');
        }
        
        $siswa->delete();
        return back()->with('success', 'Siswa berhasil dihapus!');
    }

    // ========== CRUD NILAI PKL (10 ASPEK SESUAI FOTO) ========== //
    public function createNilai($siswaId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        return view('nilai.create', compact('siswa'));
    }

    public function storeNilai(Request $request, $siswaId)
    {
        $request->validate([
            // 10 ASPEK NILAI (0-100)
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
            
            // DATA SURAT
            'no_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'pembimbing' => 'required|string',
            'direktur' => 'required|string',
        ]);

        // HITUNG OTOMATIS
        $jumlah_nilai = $request->disiplin + $request->tanggung_jawab + $request->inisiatif + 
                       $request->loyalitas + $request->kerjasama + $request->pengambilan_keputusan + 
                       $request->jiwa_entrepreneur + $request->kejujuran + $request->kemampuan_bekerja + 
                       $request->hasil_kerja;
        
        $rata_rata = $jumlah_nilai / 10;
        
        // KONVERSI HURUF
        if ($rata_rata >= 86) $huruf = 'A';
        elseif ($rata_rata >= 71) $huruf = 'B';
        elseif ($rata_rata >= 56) $huruf = 'C';
        elseif ($rata_rata >= 41) $huruf = 'D';
        else $huruf = 'E';

        NilaiPkl::create([
            'siswa_id' => $siswaId,
            'guru_id' => auth()->id(), // guru yang login
            
            // 10 ASPEK NILAI
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
            
            // DATA SURAT
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pembimbing' => $request->pembimbing,
            'direktur' => $request->direktur,
            
            // OTOMATIS
            'jumlah_nilai' => $jumlah_nilai,
            'rata_rata' => $rata_rata,
            'huruf_rata_rata' => $huruf,
        ]);

        return redirect()->route('siswa.show', $siswaId)->with('success', 'Nilai berhasil disimpan!');
    }

    public function editNilai($siswaId, $nilaiId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        $nilai = NilaiPkl::where('id', $nilaiId)
                        ->where('siswa_id', $siswaId)
                        ->firstOrFail();
        
        return view('nilai.edit', compact('siswa', 'nilai'));
    }

    public function updateNilai(Request $request, $siswaId, $nilaiId)
    {
        $nilai = NilaiPkl::where('id', $nilaiId)
                        ->where('siswa_id', $siswaId)
                        ->firstOrFail();

        $request->validate([
            // 10 ASPEK NILAI
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
            
            // DATA SURAT
            'no_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'pembimbing' => 'required|string',
            'direktur' => 'required|string',
        ]);

        // HITUNG ULANG
        $jumlah_nilai = $request->disiplin + $request->tanggung_jawab + $request->inisiatif + 
                       $request->loyalitas + $request->kerjasama + $request->pengambilan_keputusan + 
                       $request->jiwa_entrepreneur + $request->kejujuran + $request->kemampuan_bekerja + 
                       $request->hasil_kerja;
        
        $rata_rata = $jumlah_nilai / 10;
        
        if ($rata_rata >= 86) $huruf = 'A';
        elseif ($rata_rata >= 71) $huruf = 'B';
        elseif ($rata_rata >= 56) $huruf = 'C';
        elseif ($rata_rata >= 41) $huruf = 'D';
        else $huruf = 'E';

        $nilai->update([
            // 10 ASPEK
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
            
            // SURAT
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pembimbing' => $request->pembimbing,
            'direktur' => $request->direktur,
            
            // OTOMATIS
            'jumlah_nilai' => $jumlah_nilai,
            'rata_rata' => $rata_rata,
            'huruf_rata_rata' => $huruf,
        ]);

        return redirect()->route('siswa.show', $siswaId)->with('success', 'Nilai berhasil diperbarui!');
    }

    public function destroyNilai($siswaId, $nilaiId)
    {
        $nilai = NilaiPkl::where('id', $nilaiId)
                        ->where('siswa_id', $siswaId)
                        ->firstOrFail();
        
        $nilai->delete();
        return back()->with('success', 'Nilai berhasil dihapus!');
    }

    public function cetakNilai($siswaId, $nilaiId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        $nilai = NilaiPkl::where('id', $nilaiId)
                        ->where('siswa_id', $siswaId)
                        ->firstOrFail();
        
        // FUNGSI KONVERSI
        $konversiHuruf = function($nilai) {
            if ($nilai >= 86) return 'A';
            if ($nilai >= 71) return 'B';
            if ($nilai >= 56) return 'C';
            if ($nilai >= 41) return 'D';
            return 'E';
        };
        
        $verifikasi = function($nilai) {
            return $nilai >= 56 ? 'Lulus' : 'Tidak Lulus';
        };
        
        return view('nilai.cetak', compact('siswa', 'nilai', 'konversiHuruf', 'verifikasi'));
    }
}