<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\NilaiPkl;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder untuk Guru
        $gurus = [
            [
                'nama' => 'Administrator Sistem',
                'email' => 'admin@pkl.smk1cirebon.sch.id',
                'password' => Hash::make('password123'),
                'kode_guru' => 'ADM001',
                'nip' => '198001012000011001',
                'jabatan' => 'Admin Sistem PKL',
                'is_admin' => true,
            ],
            [
                'nama' => 'Dr. Surya Adi, M.Pd.',
                'email' => 'surya.adi@smk1cirebon.sch.id',
                'password' => Hash::make('password123'),
                'kode_guru' => 'GUR001',
                'nip' => '197502152000032002',
                'jabatan' => 'Kepala Program TKJ',
                'is_admin' => false,
            ],
            [
                'nama' => 'Diana Putri, S.Pd.',
                'email' => 'diana.putri@smk1cirebon.sch.id',
                'password' => Hash::make('password123'),
                'kode_guru' => 'GUR002',
                'nip' => '198003202005042003',
                'jabatan' => 'Guru Produktif RPL',
                'is_admin' => false,
            ],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }

        // Seeder untuk Nilai PKL contoh
        NilaiPkl::create([
            'siswa_id' => 1,
            'guru_id' => 2,
            'disiplin' => 85,
            'tanggung_jawab' => 90,
            'inisiatif' => 80,
            'loyalitas' => 85,
            'kerjasama' => 88,
            'pengambilan_keputusan' => 82,
            'jiwa_entrepreneur' => 75,
            'kejujuran' => 95,
            'kemampuan_bekerja' => 85,
            'hasil_kerja' => 88,
            'jumlah_nilai' => 853,
            'nilai_rata_rata' => 85.3,
            'nilai_huruf' => 'A',
            'nama_pembimbing' => 'Dr. Surya Adi, M.Pd.',
            'nama_direktur' => 'Drs. H. Ahmad Fadilah, M.M.',
            'nomor_surat' => '001/SKP-PKL/SMK1/II/2025',
            'tanggal_surat' => '2025-04-15',
            'is_verified' => true,
            'verified_at' => '2025-04-16 10:30:00',
        ]);
    }
}