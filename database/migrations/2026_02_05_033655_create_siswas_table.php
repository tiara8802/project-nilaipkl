<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('paket_keahlian');
            $table->string('asal_lembaga')->default('SMK NEGERI 1 KOTA CIREBON');
            $table->string('tempat_pkl')->nullable();
            $table->text('alamat_pkl')->nullable();
            $table->string('telepon_pkl')->nullable();
            $table->date('tanggal_mulai_pkl')->nullable();
            $table->date('tanggal_selesai_pkl')->nullable();
            $table->enum('status_pkl', ['Belum PKL', 'Sedang PKL', 'Selesai PKL'])->default('Belum PKL');
            $table->string('nama_pembimbing')->nullable();
            $table->string('jabatan_pembimbing')->nullable();
            $table->string('telepon_pembimbing')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('gurus')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('gurus')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};