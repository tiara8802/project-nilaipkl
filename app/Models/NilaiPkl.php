<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'disiplin',
        'tanggung_jawab',
        'inisiatif',
        'loyalitas',
        'kerjasama',
        'pengambilan_keputusan',
        'jiwa_entrepreneur',
        'kejujuran',
        'kemampuan_bekerja',
        'hasil_kerja',
        'no_surat',
        'tanggal_surat',
        'pembimbing',
        'direktur',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    // RELASI
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // KONVERSI NILAI KE HURUF
    public function konversiHuruf($nilai)
    {
        if ($nilai >= 86) return 'A';
        if ($nilai >= 71) return 'B';
        if ($nilai >= 56) return 'C';
        if ($nilai >= 41) return 'D';
        return 'E';
    }

    public function verifikasiNilai($nilai)
    {
        return $nilai >= 56 ? 'Lulus' : 'Tidak Lulus';
    }

    // HITUNG SEMUA NILAI OTOMATIS
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Hitung jumlah nilai
            $jumlah = $model->disiplin + $model->tanggung_jawab + $model->inisiatif + 
                     $model->loyalitas + $model->kerjasama + $model->pengambilan_keputusan + 
                     $model->jiwa_entrepreneur + $model->kejujuran + $model->kemampuan_bekerja + 
                     $model->hasil_kerja;
            
            $model->jumlah_nilai = $jumlah;
            
            // Hitung rata-rata
            $model->rata_rata = $jumlah / 10;
            
            // Konversi ke huruf
            $model->huruf_rata_rata = $model->konversiHuruf($model->rata_rata);
        });
    }

    // GETTER UNTUK VIEW
    public function getDisiplinHurufAttribute()
    {
        return $this->konversiHuruf($this->disiplin);
    }

    public function getDisiplinVerifikasiAttribute()
    {
        return $this->verifikasiNilai($this->disiplin);
    }

    public function getHasilKerjaHurufAttribute()
    {
        return $this->konversiHuruf($this->hasil_kerja);
    }

    public function getHasilKerjaVerifikasiAttribute()
    {
        return $this->verifikasiNilai($this->hasil_kerja);
    }

    public function getJumlahHurufAttribute()
    {
        return $this->konversiHuruf($this->jumlah_nilai / 10);
    }

    public function getJumlahVerifikasiAttribute()
    {
        return $this->verifikasiNilai($this->jumlah_nilai / 10);
    }
}