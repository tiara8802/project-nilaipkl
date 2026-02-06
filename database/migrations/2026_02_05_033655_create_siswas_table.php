// database/migrations/xxxx_xx_xx_create_all_tables.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table users (guru)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['guru', 'admin'])->default('guru');
            $table->rememberToken();
            $table->timestamps();
        });

        // Table siswa
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nis')->unique();
            $table->string('paket_keahlian');
            $table->string('asal_lembaga')->default('SMK NEGERI 1 KOTA CIREBON');
            $table->date('tanggal_mulai_pkl');
            $table->date('tanggal_selesai_pkl');
            $table->string('tempat_pkl');
            $table->text('alamat_pkl')->nullable();
            $table->string('telepon_pkl')->nullable();
            $table->timestamps();
        });

        // Table nilai_pkls (untuk 10 aspek di foto)
        Schema::create('nilai_pkls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            
            // 10 ASPEK NILAI SESUAI FOTO (skala 0-100)
            $table->integer('disiplin');
            $table->integer('tanggung_jawab');
            $table->integer('inisiatif');
            $table->integer('loyalitas');
            $table->integer('kerjasama');
            $table->integer('pengambilan_keputusan');
            $table->integer('jiwa_entrepreneur');
            $table->integer('kejujuran');
            $table->integer('kemampuan_bekerja');
            $table->integer('hasil_kerja');
            
            // DATA SURAT KETERANGAN
            $table->string('no_surat')->nullable();
            $table->date('tanggal_surat');
            $table->string('pembimbing');
            $table->string('direktur');
            
            // OTOMATIS DARI 10 ASPEK DI ATAS
            $table->integer('jumlah_nilai')->default(0);
            $table->float('rata_rata')->default(0);
            $table->string('huruf_rata_rata')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_pkls');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('users');
    }
};