<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    // Helper method untuk cek auth
    private function checkAuth()
    {
        if (!Auth::guard('guru')->check()) {
            return redirect()->route('login');
        }
        return null;
    }

    // Daftar semua siswa
    public function index(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $query = Siswa::query();
        
        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('tempat_pkl', 'like', "%{$search}%")
                  ->orWhere('paket_keahlian', 'like', "%{$search}%");
            });
        }
        
        // Filter paket keahlian
        if ($request->filled('paket_keahlian')) {
            $query->where('paket_keahlian', $request->paket_keahlian);
        }
        
        // Filter status PKL
        if ($request->filled('status')) {
            $status = $request->status;
            $today = now();
            
            switch ($status) {
                case 'active':
                    $query->where('status_pkl', 'Sedang PKL')
                          ->orWhere(function($q) use ($today) {
                              $q->whereDate('tanggal_mulai_pkl', '<=', $today)
                                ->whereDate('tanggal_selesai_pkl', '>=', $today);
                          });
                    break;
                case 'completed':
                    $query->where('status_pkl', 'Selesai PKL')
                          ->orWhereDate('tanggal_selesai_pkl', '<', $today);
                    break;
                case 'upcoming':
                    $query->where('status_pkl', 'Belum PKL')
                          ->orWhereDate('tanggal_mulai_pkl', '>', $today);
                    break;
            }
        }
        
        $siswas = $query->orderBy('nama')->paginate(10);
        
        // Daftar paket keahlian untuk filter
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
        
        return view('siswa.index', compact('siswas', 'paketKeahlian'));
    }

    // Form tambah siswa
    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
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

    // Simpan data siswa
    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'paket_keahlian' => 'required|string|max:100',
            'asal_lembaga' => 'nullable|string|max:255',
            'tempat_pkl' => 'nullable|string|max:255',
            'alamat_pkl' => 'nullable|string',
            'telepon_pkl' => 'nullable|string|max:20',
            'tanggal_mulai_pkl' => 'nullable|date',
            'tanggal_selesai_pkl' => 'nullable|date|after_or_equal:tanggal_mulai_pkl',
            'nama_pembimbing' => 'nullable|string|max:255',
            'jabatan_pembimbing' => 'nullable|string|max:100',
            'telepon_pembimbing' => 'nullable|string|max:20',
        ]);
        
        // Tentukan status PKL berdasarkan tanggal
        $statusPkl = 'Belum PKL';
        if ($request->tanggal_mulai_pkl && $request->tanggal_selesai_pkl) {
            $today = now();
            $mulai = \Carbon\Carbon::parse($request->tanggal_mulai_pkl);
            $selesai = \Carbon\Carbon::parse($request->tanggal_selesai_pkl);
            
            if ($today->between($mulai, $selesai)) {
                $statusPkl = 'Sedang PKL';
            } elseif ($today->gt($selesai)) {
                $statusPkl = 'Selesai PKL';
            }
        }
        
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'paket_keahlian' => $request->paket_keahlian,
            'asal_lembaga' => $request->asal_lembaga ?? 'SMK NEGERI 1 KOTA CIREBON',
            'tempat_pkl' => $request->tempat_pkl,
            'alamat_pkl' => $request->alamat_pkl,
            'telepon_pkl' => $request->telepon_pkl,
            'tanggal_mulai_pkl' => $request->tanggal_mulai_pkl,
            'tanggal_selesai_pkl' => $request->tanggal_selesai_pkl,
            'status_pkl' => $statusPkl,
            'nama_pembimbing' => $request->nama_pembimbing,
            'jabatan_pembimbing' => $request->jabatan_pembimbing,
            'telepon_pembimbing' => $request->telepon_pembimbing,
            'created_by' => Auth::guard('guru')->id(),
        ]);
        
        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Tampilkan detail siswa
    public function show($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $siswa = Siswa::with('nilaiPkl')->findOrFail($id);
        
        return view('siswa.show', compact('siswa'));
    }

    // Form edit siswa
    public function edit($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
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

    // Update data siswa
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $siswa = Siswa::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'paket_keahlian' => 'required|string|max:100',
            'asal_lembaga' => 'nullable|string|max:255',
            'tempat_pkl' => 'nullable|string|max:255',
            'alamat_pkl' => 'nullable|string',
            'telepon_pkl' => 'nullable|string|max:20',
            'tanggal_mulai_pkl' => 'nullable|date',
            'tanggal_selesai_pkl' => 'nullable|date|after_or_equal:tanggal_mulai_pkl',
            'nama_pembimbing' => 'nullable|string|max:255',
            'jabatan_pembimbing' => 'nullable|string|max:100',
            'telepon_pembimbing' => 'nullable|string|max:20',
        ]);
        
        // Tentukan status PKL berdasarkan tanggal
        $statusPkl = 'Belum PKL';
        if ($request->tanggal_mulai_pkl && $request->tanggal_selesai_pkl) {
            $today = now();
            $mulai = \Carbon\Carbon::parse($request->tanggal_mulai_pkl);
            $selesai = \Carbon\Carbon::parse($request->tanggal_selesai_pkl);
            
            if ($today->between($mulai, $selesai)) {
                $statusPkl = 'Sedang PKL';
            } elseif ($today->gt($selesai)) {
                $statusPkl = 'Selesai PKL';
            }
        }
        
        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'paket_keahlian' => $request->paket_keahlian,
            'asal_lembaga' => $request->asal_lembaga ?? 'SMK NEGERI 1 KOTA CIREBON',
            'tempat_pkl' => $request->tempat_pkl,
            'alamat_pkl' => $request->alamat_pkl,
            'telepon_pkl' => $request->telepon_pkl,
            'tanggal_mulai_pkl' => $request->tanggal_mulai_pkl,
            'tanggal_selesai_pkl' => $request->tanggal_selesai_pkl,
            'status_pkl' => $statusPkl,
            'nama_pembimbing' => $request->nama_pembimbing,
            'jabatan_pembimbing' => $request->jabatan_pembimbing,
            'telepon_pembimbing' => $request->telepon_pembimbing,
            'updated_by' => Auth::guard('guru')->id(),
        ]);
        
        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Hapus data siswa
    public function destroy($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        
        $siswa = Siswa::findOrFail($id);
        
        // Cek apakah siswa memiliki nilai PKL
        if ($siswa->nilaiPkl) {
            return redirect()->route('siswa.index')
                ->with('error', 'Tidak dapat menghapus siswa yang sudah memiliki nilai PKL!');
        }
        
        $siswa->delete();
        
        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }

    // API untuk mendapatkan data siswa berdasarkan NIS (untuk select2)
    public function getByNis(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');
            
            $siswas = Siswa::where('nis', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->limit(10)
                ->get()
                ->map(function ($siswa) {
                    return [
                        'id' => $siswa->id,
                        'text' => $siswa->nis . ' - ' . $siswa->nama . ' (' . $siswa->paket_keahlian . ')'
                    ];
                });
            
            return response()->json(['results' => $siswas]);
        }
    }
}