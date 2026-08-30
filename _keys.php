<?php

$base='D:/Dev_Projects/Laravel_Projects/taramid/projectfiles/allfilesbackupstaramid';
require $base.'/vendor/autoload.php';
$app=require $base.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$k=[]; foreach(config('translatable.sections') as $f){ $k=array_merge($k,$f); }
echo json_encode(array_values(array_unique($k)));
