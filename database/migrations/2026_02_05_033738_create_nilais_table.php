<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPklsTable extends Migration
{
    public function up()
    {
        Schema::create('nilai_pkls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            
            // Data surat
            $table->string('no_surat', 100);
            $table->date('tanggal_surat');
            $table->string('pembimbing', 255);
            $table->string('direktur', 255);
            
            // Nilai-nilai
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
            
            // Nilai otomatis
            $table->integer('jumlah_nilai')->nullable();
            $table->decimal('rata_rata', 5, 2)->nullable();
            $table->string('huruf_rata_rata', 1)->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_pkls');
    }
}