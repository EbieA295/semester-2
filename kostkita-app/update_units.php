<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Unit;

// Convert Reguler -> Standar, Eksklusif -> Premium
Unit::where('tipe', 'Reguler')->update([
    'tipe' => 'Standar', 
    'harga' => 800000
]);

Unit::where('tipe', 'Eksklusif')->update([
    'tipe' => 'Premium',
    'harga' => 1200000
]);

Unit::where('tipe', 'Premium')->update([
    'harga' => 1200000
]);

echo "Berhasil update tipe dan harga unit!";
