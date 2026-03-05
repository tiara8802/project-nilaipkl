<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prakerins', function (Blueprint $table) {
            $table->id();
            
            // ===== DATA SERTIFIKAT =====
            $table->string('no_sertifikat')->unique();
            $table->date('tanggal_sertifikat')->nullable();
            
            // ===== DATA SISWA =====
            $table->string('nama');
            $table->string('nis');
            $table->string('ttl')->nullable(); // Tempat, Tanggal Lahir
            $table->string('keahlian');
            $table->string('lembaga');
            
            // ===== DATA PKL =====
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->onDelete('cascade');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            
            // ===== KOMPONEN NILAI (0-100) =====
            $table->integer('disiplin')->default(0);
            $table->integer('tanggung_jawab')->default(0);
            $table->integer('inisiatif')->default(0);
            $table->integer('loyalitas')->default(0);
            $table->integer('kerjasama')->default(0);
            $table->integer('pengambilan_keputusan')->default(0);
            $table->integer('jiwa_entrepreneur')->default(0);
            $table->integer('kejujuran')->default(0);
            $table->integer('kemampuan_bekerja')->default(0);
            $table->integer('hasil_kerja')->default(0);
            
            // ===== VERIFIKASI =====
            $table->boolean('verifikasi_disiplin')->default(false);
            $table->boolean('verifikasi_tanggung_jawab')->default(false);
            $table->boolean('verifikasi_inisiatif')->default(false);
            $table->boolean('verifikasi_loyalitas')->default(false);
            $table->boolean('verifikasi_kerjasama')->default(false);
            $table->boolean('verifikasi_pengambilan_keputusan')->default(false);
            $table->boolean('verifikasi_jiwa_entrepreneur')->default(false);
            $table->boolean('verifikasi_kejujuran')->default(false);
            $table->boolean('verifikasi_kemampuan_bekerja')->default(false);
            $table->boolean('verifikasi_hasil_kerja')->default(false);
            
            // ===== TOTAL & STATUS =====
            $table->integer('total_nilai')->default(0);
            $table->float('rata_rata', 8, 2)->default(0);
            $table->string('predikat')->nullable(); // ✅ TAMBAH INI!
            $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');
            $table->enum('status', ['aktif', 'arsip', 'pending', 'selesai', 'perbaikan'])->default('aktif');
            $table->text('catatan')->nullable();
            
            // ===== TRACKING USER =====
            $table->unsignedBigInteger('created_by')->nullable(); // ✅ TAMBAH INI!
            $table->unsignedBigInteger('updated_by')->nullable(); // ✅ TAMBAH INI!
            
            $table->timestamps();
            
            // ===== INDEX =====
            $table->index('nis');
            $table->index('status');
            $table->index('no_sertifikat');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prakerins');
    }
};