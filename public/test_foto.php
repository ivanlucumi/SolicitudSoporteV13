<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$empleado = App\Models\Empleado::where('cedulaE', '1061429858')->first();
if ($empleado) {
    echo "EMPLEADO FOUND\n";
    echo "FOTO DB: " . var_export($empleado->foto, true) . "\n";
    echo "FOTO_URL: " . var_export($empleado->foto_url, true) . "\n";
} else {
    echo "EMPLEADO NOT FOUND\n";
}

$conductor = App\Models\Conductor::where('cedula', '1061429858')->first();
if ($conductor) {
    echo "CONDUCTOR FOUND\n";
} else {
    echo "CONDUCTOR NOT FOUND\n";
}
