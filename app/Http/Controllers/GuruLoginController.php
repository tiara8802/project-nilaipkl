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
        // Jika sudah login, redirect ke dashboard
        if (Auth::guard('guru')->check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.guru-login');
    }

    // Proses login - PAKAI AUTH::GUARD('GURU')
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // PAKAI GUARD GURU
        if (Auth::guard('guru')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        // Cek password default
        $guru = Guru::where('email', $request->email)->first();
        
        if ($guru) {
            // Cek password default 'password123'
            if ($request->password === 'password123') {
                // Update password ke hash
                $guru->password = Hash::make('password123');
                $guru->save();
                
                // Login dengan guard guru
                Auth::guard('guru')->login($guru);
                $request->session()->regenerate();
                
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            }
            
            // Cek password yang sudah di-hash
            if (Hash::check($request->password, $guru->password)) {
                Auth::guard('guru')->login($guru);
                $request->session()->regenerate();
                
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Logout - PAKAI GUARD GURU JUGA
    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}