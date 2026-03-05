<?php

namespace Database\Seeders;

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
        
        // ========== SEEDER ==========
        DB::table('gurus')->insert([
            // ADMIN
            [
                'nama' => 'Administrator',
                'email' => 'admin@pkl.smk1cirebon.sch.id',
                'password' => Hash::make('admin123'),
                'kode_guru' => 'ADMIN',
                'nip' => '111111111111111111',
                'jabatan' => 'Admin',
                'is_admin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // GURU (1 EMAIL DOANG)
            [
                'nama' => 'Guru Pembimbing',
                'email' => 'guru@pkl.smk1cirebon.sch.id',
                'password' => Hash::make('guru123'),
                'kode_guru' => 'GURU',
                'nip' => '222222222222222222',
                'jabatan' => 'Guru',
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        $this->command->info('✅ SEEDER BERHASIL!');
        $this->command->info('📧 Admin  : admin@cirebon.sch.id | pass: admin123');
        $this->command->info('📧 Guru   : guru@cirebon.sch.id | pass: guru123');
    }
}