<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\NilaiPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   
    public function index()
    {
        // PAKAI GUARD GURU
        $guru = Auth::guard('guru')->user();
        
        // Statistik lengkap
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_nilai' => NilaiPkl::count(),
            'nilai_terverifikasi' => NilaiPkl::where('is_verified', true)->count(),
            'nilai_belum_verifikasi' => NilaiPkl::where('is_verified', false)->count(),
            'nilai_rata_rata_semua' => NilaiPkl::avg('nilai_rata_rata') ?? 0,
            'nilai_tertinggi' => NilaiPkl::max('nilai_rata_rata') ?? 0,
            'nilai_terendah' => NilaiPkl::min('nilai_rata_rata') ?? 0,
            'total_guru' => Guru::count(),
        ];
        
        // Nilai terbaru
        $recentNilai = NilaiPkl::with('siswa')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('dashboard', compact('stats', 'recentNilai', 'guru'));
    }
}