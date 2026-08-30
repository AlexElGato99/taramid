<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = new User();
$user->account_type = 'admin';
$user->username = 'Developer';
$user->name = 'Administrator';
$user->email = 'admin@pod.com';
$user->password = Hash::make('admin123');
$user->save();

echo "Admin user created successfully!\n";
echo "Email: admin@pod.com\n";
echo "Password: admin123\n";
