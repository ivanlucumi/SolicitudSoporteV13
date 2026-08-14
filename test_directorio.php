<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$directorios = Illuminate\Support\Facades\DB::table('directorios')->limit(2)->get();
print_r($directorios);
