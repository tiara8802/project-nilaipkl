<?php
// test-db-fixed.php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== TEST DATABASE PKL ===\n\n";

try {
    // 1. Test koneksi
    $pdo = DB::connection()->getPdo();
    echo "✅ KONEKSI BERHASIL!\n";
    
    // 2. Cek file database
    $dbPath = DB::connection()->getDatabaseName();
    echo "📁 File: " . $dbPath . "\n";
    echo "📊 Size: " . (file_exists($dbPath) ? filesize($dbPath) : 0) . " bytes\n";
    
    // 3. Cek tabel
    echo "\n📋 CEK TABEL:\n";
    $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table'");
    
    if (empty($tables)) {
        echo "❌ Tidak ada tabel! Jalankan: php artisan migrate\n";
    } else {
        echo "✅ Ada " . count($tables) . " tabel:\n";
        foreach ($tables as $table) {
            echo "   - " . $table->name . "\n";
        }
    }
    
    // 4. Cek khusus tabel prakerins
    echo "\n🔍 CEK TABEL PRAKERINS:\n";
    $prakerinExists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='prakerins'");
    
    if (empty($prakerinExists)) {
        echo "❌ Tabel 'prakerins' belum ada!\n";
        echo "   Jalankan: php artisan migrate\n";
    } else {
        echo "✅ Tabel 'prakerins' sudah ada\n";
        
        // Cek kolom
        $columns = DB::select("PRAGMA table_info(prakerins)");
        echo "   Kolom: " . count($columns) . " kolom\n";
        
        // Tampilkan 5 kolom pertama
        echo "   Contoh kolom:\n";
        foreach (array_slice($columns, 0, 5) as $col) {
            echo "   - " . $col->name . " (" . $col->type . ")\n";
        }
    }
    
} catch (Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "\n💡 SOLUSI:\n";
    echo "1. Pastikan file database ada: database/database.sqlite\n";
    echo "2. Buat jika belum ada: php -r \"touch('database/database.sqlite');\"\n";
    echo "3. Jalankan migration: php artisan migrate\n";
}

echo "\n=== SELESAI ===\n";