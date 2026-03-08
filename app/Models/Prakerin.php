<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prakerin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_sertifikat',
        'nama',
        'nis',
        'ttl',
        'keahlian',
        'lembaga',
        'perusahaan_id',
        'tgl_mulai',
        'tgl_selesai',
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
        'verifikasi_disiplin',
        'verifikasi_tanggung_jawab',
        'verifikasi_inisiatif',
        'verifikasi_loyalitas',
        'verifikasi_kerjasama',
        'verifikasi_pengambilan_keputusan',
        'verifikasi_jiwa_entrepreneur',
        'verifikasi_kejujuran',
        'verifikasi_kemampuan_bekerja',
        'verifikasi_hasil_kerja',
        'total_nilai',
        'rata_rata',
        'predikat',
        'guru_id',
        'nama_pimpinan',
        'tanggal_sertifikat',
        'status',
        'catatan',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
        'tanggal_sertifikat' => 'date',
        'disiplin' => 'integer',
        'tanggung_jawab' => 'integer',
        'inisiatif' => 'integer',
        'loyalitas' => 'integer',
        'kerjasama' => 'integer',
        'pengambilan_keputusan' => 'integer',
        'jiwa_entrepreneur' => 'integer',
        'kejujuran' => 'integer',
        'kemampuan_bekerja' => 'integer',
        'hasil_kerja' => 'integer',
        'verifikasi_disiplin' => 'boolean',
        'verifikasi_tanggung_jawab' => 'boolean',
        'verifikasi_inisiatif' => 'boolean',
        'verifikasi_loyalitas' => 'boolean',
        'verifikasi_kerjasama' => 'boolean',
        'verifikasi_pengambilan_keputusan' => 'boolean',
        'verifikasi_jiwa_entrepreneur' => 'boolean',
        'verifikasi_kejujuran' => 'boolean',
        'verifikasi_kemampuan_bekerja' => 'boolean',
        'verifikasi_hasil_kerja' => 'boolean',
        'total_nilai' => 'integer',
        'rata_rata' => 'float',
    ];

    /**
     * ============================================
     * ✅ RELASI KE GURU (PEMBIMBING)
     * ============================================
     */
    public function guru()
    {
       return $this->belongsTo(Guru::class, 'guru_id');
    }
    public function perusahaan()
    {
       return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    /**
     * ============================================
     * SCOPES
     * ============================================
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeArsip($query)
    {
        return $query->where('status', 'arsip');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopePerbaikan($query)
    {
        return $query->where('status', 'perbaikan');
    }

    /**
     * ============================================
     * METHODS
     * ============================================
     */
    public static function generateNoSertifikat()
    {
        $year = date('Y');
        $month = date('m');
        
        $lastRecord = self::where('no_sertifikat', 'like', "PKL/{$year}/{$month}/%")
            ->orderBy('no_sertifikat', 'desc')
            ->first();
        
        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->no_sertifikat, -4);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }
        
        return "PKL/{$year}/{$month}/{$nextNumber}";
    }

    public function hitungNilai()
    {
        $nilaiFields = [
            'disiplin', 'tanggung_jawab', 'inisiatif', 'loyalitas', 'kerjasama',
            'pengambilan_keputusan', 'jiwa_entrepreneur', 'kejujuran',
            'kemampuan_bekerja', 'hasil_kerja'
        ];
        
        $total = 0;
        foreach ($nilaiFields as $field) {
            $total += $this->$field ?? 0;
        }
        
        $this->total_nilai = $total;
        $this->rata_rata = $total / count($nilaiFields);
        $this->predikat = $this->getPredikat($this->rata_rata);
        
        return $this;
    }

    public function getPredikat($nilai)
    {
        if ($nilai >= 90) return 'SANGAT BAIK';
        if ($nilai >= 80) return 'BAIK';
        if ($nilai >= 70) return 'CUKUP';
        if ($nilai >= 60) return 'KURANG';
        return 'SANGAT KURANG';
    }

    /**
     * ============================================
     * ACCESSORS & MUTATORS
     * ============================================
     */
    public function getTtlFormattedAttribute()
    {
        return ucwords(strtolower($this->ttl ?? ''));
    }

    public function getNamaFormattedAttribute()
    {
        return strtoupper($this->nama);
    }

    public function getKeahlianFormattedAttribute()
    {
        return strtoupper($this->keahlian);
    }

    public function getLembagaFormattedAttribute()
    {
        return strtoupper($this->lembaga);
    }

    public function getTempatPklFormattedAttribute()
    {
        return strtoupper($this->perusahaan_id);
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'aktif' => '<span class="badge bg-info text-white">Aktif</span>',
            'arsip' => '<span class="badge bg-secondary text-white">Arsip</span>',
            'pending' => '<span class="badge bg-warning text-dark">Pending</span>',
            'selesai' => '<span class="badge bg-success text-white">Selesai</span>',
            'perbaikan' => '<span class="badge bg-danger text-white">Perbaikan</span>',
        ];
        
        return $labels[$this->status] ?? '<span class="badge bg-light text-dark">-</span>';
    }

    public function getPredikatLabelAttribute()
    {
        $labels = [
            'SANGAT BAIK' => '<span class="badge bg-success">SANGAT BAIK</span>',
            'BAIK' => '<span class="badge bg-primary">BAIK</span>',
            'CUKUP' => '<span class="badge bg-warning text-dark">CUKUP</span>',
            'KURANG' => '<span class="badge bg-danger">KURANG</span>',
            'SANGAT KURANG' => '<span class="badge bg-dark">SANGAT KURANG</span>',
        ];
        
        return $labels[$this->predikat] ?? '<span class="badge bg-light text-dark">-</span>';
    }

    public function getTglMulaiIndoAttribute()
    {
        return $this->tgl_mulai ? $this->tgl_mulai->translatedFormat('d F Y') : '-';
    }

    public function getTglSelesaiIndoAttribute()
    {
        return $this->tgl_selesai ? $this->tgl_selesai->translatedFormat('d F Y') : '-';
    }

    public function getTanggalSertifikatIndoAttribute()
    {
        return $this->tanggal_sertifikat ? $this->tanggal_sertifikat->translatedFormat('d F Y') : '-';
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtoupper($value);
    }

    public function setKeahlianAttribute($value)
    {
        $this->attributes['keahlian'] = strtoupper($value);
    }

    public function setLembagaAttribute($value)
    {
        $this->attributes['lembaga'] = strtoupper($value);
    }

    public function setTempatPklAttribute($value)
    {
        $this->attributes['perusahaan_id'] = strtoupper($value);
    }

    public function setNoSertifikatAttribute($value)
    {
        $this->attributes['no_sertifikat'] = strtoupper($value);
    }
}