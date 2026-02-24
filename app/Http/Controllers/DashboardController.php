<?php

namespace App\Http\Controllers;

use App\Models\Prakerin; // UBAH: dari NilaiPkl ke Prakerin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah login sebagai guru
        if (!Auth::guard('guru')->check()) {
            return redirect()->route('login');
        }

        $guru = Auth::guard('guru')->user();
        
        // ===== HITUNG STATISTIK =====
        
        // HAPUS BARIS INI (karena ga pake tabel Siswa)
        // $totalSiswa = Siswa::count();
        
        // Total semua data PKL
        $totalNilai = Prakerin::count();
        
        // Data PKL yang dibimbing guru ini (berdasarkan nama_pembimbing)
        $nilaiSaya = Prakerin::where('nama_pembimbing', $guru->nama)->count();
        
        // Rata-rata nilai semua PKL
        $nilaiRataRataSemua = Prakerin::avg('rata_rata') ?? 0;

        // Data PKL terbaru (5 data terakhir)
        $recentNilai = Prakerin::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $stats = [
            // HAPUS total_siswa
            // 'total_siswa' => $totalSiswa,
            'total_nilai' => $totalNilai,
            'nilai_saya' => $nilaiSaya,
            'nilai_rata_rata_semua' => $nilaiRataRataSemua,
        ];

        return view('layouts.dashboard', compact('stats', 'recentNilai', 'guru'));
    }
}