<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan guard yang digunakan
    protected $guard = 'guru';  // <-- TAMBAHKAN INI

    protected $fillable = [
        'nama',
        'email',
        'password',
        'kode_guru',
        'nip',
        'jabatan',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function nilaiPkls()
    {
        return $this->hasMany(NilaiPkl::class);
    }
}