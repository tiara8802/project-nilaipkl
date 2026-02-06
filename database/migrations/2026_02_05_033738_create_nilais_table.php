// database/migrations/xxxx_xx_xx_create_nilai_pkls_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai_pkls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            
            // 10 ASPEK NILAI (1-100)
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
            
            // DATA SURAT
            $table->string('no_surat')->nullable();
            $table->date('tanggal_surat');
            $table->string('pembimbing');
            $table->string('direktur');
            
            // OTOMATIS
            $table->integer('jumlah_nilai')->default(0);
            $table->float('rata_rata')->default(0);
            $table->string('huruf_rata_rata')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_pkls');
    }
};