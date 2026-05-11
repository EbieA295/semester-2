<?php

use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (User::all() as $user) {
    echo "ID: {$user->id}\n";
    echo "Email: {$user->email}\n";
    echo "Role: '{$user->role}' (Length: " . strlen($user->role) . ")\n";
    echo "Trimmed Role: '" . trim($user->role) . "'\n";
    echo "-------------------\n";
}
