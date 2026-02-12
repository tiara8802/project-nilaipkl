<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'tempat_lahir',
        'tanggal_lahir',
        'paket_keahlian',
        'asal_lembaga',
        'tempat_pkl',
        'alamat_pkl',
        'telepon_pkl',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',
        'status_pkl',
        'nama_pembimbing',
        'jabatan_pembimbing',
        'telepon_pembimbing',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_mulai_pkl' => 'date',
        'tanggal_selesai_pkl' => 'date',
    ];

    public function nilaiPkl(): HasOne
    {
        return $this->hasOne(NilaiPkl::class);
    }

    // Method untuk cek apakah siswa sudah memiliki nilai PKL
    public function sudahMemilikiNilaiPkl(): bool
    {
        return $this->nilaiPkl()->exists();
    }

    // Method untuk mendapatkan status PKL
    public function getStatusPklAttribute(): string
    {
        $today = now();
        $start = $this->tanggal_mulai_pkl;
        $end = $this->tanggal_selesai_pkl;

        if (!$start || !$end) {
            return 'Belum PKL';
        }

        if ($today->between($start, $end)) {
            return 'Sedang PKL';
        }

        if ($today->gt($end)) {
            return 'Selesai PKL';
        }

        return 'Akan PKL';
    }

    // Method untuk mendapatkan warna badge status
    public function getStatusColorAttribute(): string
    {
        return match($this->status_pkl) {
            'Sedang PKL' => 'success',
            'Selesai PKL' => 'primary',
            'Akan PKL' => 'warning',
            default => 'secondary'
        };
    }

    // Method untuk mendapatkan durasi PKL dalam hari
    public function getDurasiPklAttribute(): int
    {
        if (!$this->tanggal_mulai_pkl || !$this->tanggal_selesai_pkl) {
            return 0;
        }

        return $this->tanggal_mulai_pkl->diffInDays($this->tanggal_selesai_pkl);
    }
}