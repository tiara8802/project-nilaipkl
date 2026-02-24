<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prakerins', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada
            if (!Schema::hasColumn('prakerins', 'nama_pimpinan')) {
                $table->string('nama_pimpinan')->nullable()->after('nama_pembimbing');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prakerins', function (Blueprint $table) {
            if (Schema::hasColumn('prakerins', 'nama_pimpinan')) {
                $table->dropColumn('nama_pimpinan');
            }
        });
    }
};