<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nis',
        'paket_keahlian',
        'asal_lembaga',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',
        'tempat_pkl',
        'alamat_pkl',
        'telepon_pkl',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_mulai_pkl' => 'date',
        'tanggal_selesai_pkl' => 'date',
    ];

    public function nilaiPkls()
    {
        return $this->hasMany(NilaiPkl::class);
    }

    public function getTtlAttribute()
    {
        return $this->tempat_lahir . ', ' . $this->tanggal_lahir->format('d-m-Y');
    }
}