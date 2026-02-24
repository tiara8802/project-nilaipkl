<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========== HAPUS DULU DATA LAMA ==========
        DB::table('gurus')->truncate();
        
        // ========== SEEDER GURU PAKAI DB FACADE ==========
        $gurus = [
            [
                'nama' => 'Administrator Sistem',
                'email' => 'admin@pkl.smk1cirebon.sch.id',
                'password' => Hash::make('password123'),
                'kode_guru' => 'ADM001',
                'nip' => '198001012000011001',
                'jabatan' => 'Admin Sistem PKL',
                'is_admin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
             [
                'nama' => 'DUDUNG ZULKIPLI, S.KOM., M.M.',
                'email' => 'dudung@smk1cirebon.sch.id',
                'password' => Hash::make('dudung123'),
                'kode_guru' => 'ADM002',
                'nip' => '198001012000011002',
                'jabatan' => 'Admin Sistem PKL',
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'nama' => 'ARIS PANDU WINATA, S.Si.',
                'email' => 'pandu@smk1cirebon.sch.id',
                'password' => Hash::make('pandu123'),
                'kode_guru' => 'ADM003',
                'nip' => '198001012000011003',
                'jabatan' => 'Admin Sistem PKL',
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        DB::table('gurus')->insert($gurus);

        $this->command->info('✅ Seeder Guru berhasil dijalankan!');
        $this->command->info('📊 Guru: ' . Guru::count() . ' data');
        
        // ========== DEBUG: CEK EMAIL YANG MASUK ==========
        $cekEmail = DB::table('gurus')->where('email', 'admin@pkl.smk1cirebon.sch.id')->first();
        if ($cekEmail) {
            $this->command->info('✅ Email admin ditemukan!');
            $this->command->info('📧 Email: ' . $cekEmail->email);
            $this->command->info('🔐 Password: password123');
        } else {
            $this->command->error('❌ Email admin TIDAK DITEMUKAN di database!');
        }
    }
}