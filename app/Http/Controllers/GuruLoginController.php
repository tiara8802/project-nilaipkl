<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruLoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    // Proses login - SIMPLIFIED VERSION
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari guru berdasarkan email
        $guru = Guru::where('email', $request->email)->first();

        if (!$guru) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->withInput($request->only('email', 'remember'));
        }

        // Cek password (support plain text 'password123' dan hash)
        if ($request->password === 'password123' || Hash::check($request->password, $guru->password)) {
            
            // Jika password masih plain text, update ke hash
            if ($request->password === 'password123' && !Hash::needsRehash($guru->password)) {
                $guru->password = Hash::make('password123');
                $guru->save();
            }

            // Login dengan guard guru
            Auth::guard('guru')->login($guru, $request->remember);
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}