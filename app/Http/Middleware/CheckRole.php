<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::guard('guru')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login dulu!');
        }

        $user = Auth::guard('guru')->user();
        
        // CEK ROLE BERDASARKAN is_admin
        foreach ($roles as $role) {
            if ($role === 'admin' && $user->is_admin) {
                return $next($request);
            }
            if ($role === 'guru' && !$user->is_admin) {
                return $next($request);
            }
        }

        abort(403, 'FORBIDDEN! Anda bukan ' . implode(' atau ', $roles));
    }
}