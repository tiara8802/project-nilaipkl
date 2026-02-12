<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\NilaiPkl;
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
        
        // Hitung statistik
        $totalSiswa = Siswa::count();
        $totalNilai = NilaiPkl::count();
        $nilaiSaya = NilaiPkl::where('guru_id', $guru->id)->count();
        $nilaiRataRataSemua = NilaiPkl::avg('rata_rata') ?? 0;

        // Nilai PKL terbaru (5 data terakhir)
        $recentNilai = NilaiPkl::with('siswa')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'total_siswa' => $totalSiswa,
            'total_nilai' => $totalNilai,
            'nilai_saya' => $nilaiSaya,
            'nilai_rata_rata_semua' => $nilaiRataRataSemua,
        ];

        return view('layouts.dashboard', compact('stats', 'recentNilai', 'guru'));
    }
}