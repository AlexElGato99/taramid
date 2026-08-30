<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('username', 'admin')->first();
if ($user) {
    $user->password = Hash::make('admin123');
    $user->save();
    echo "Admin password reset successfully!\n";
    echo "\n=== ADMIN CREDENTIALS ===\n";
    echo "Email: " . $user->email . "\n";
    echo "Username: " . $user->username . "\n";
    echo "Password: admin123\n";
    echo "==========================\n";
} else {
    echo "Admin user not found!\n";
}
