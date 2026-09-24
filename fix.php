<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    \Illuminate\Support\Facades\DB::unprepared("
        SET SESSION sql_mode='';
        ALTER TABLE seguridad_st MODIFY updated_at TIMESTAMP NULL DEFAULT NULL;
        ALTER TABLE seguridad_st MODIFY created_at TIMESTAMP NULL DEFAULT NULL;
        ALTER TABLE seguridad_st ADD COLUMN ubicacion VARCHAR(255) NULL DEFAULT 'SST';
    ");
    echo "Success!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
