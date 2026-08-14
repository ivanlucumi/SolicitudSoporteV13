<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Conductor;

echo "--- USUARIOS ROL 27 ---\n";
$users = User::where('rol', 27)->get(['cedula', 'name', 'lastname']);
echo "Cantidad: " . $users->count() . "\n";
if ($users->count() > 0) {
    echo json_encode($users->take(5), JSON_PRETTY_PRINT) . "\n";
} else {
    // Si no hay 27, veamos qué roles existen
    $roles = User::select('rol', \DB::raw('count(*) as total'))->groupBy('rol')->get();
    echo "Roles existentes en tabla users:\n";
    echo json_encode($roles, JSON_PRETTY_PRINT) . "\n";
}

echo "\n--- TABLA CONDUCTORES ---\n";
$conductores = Conductor::all();
echo "Cantidad: " . $conductores->count() . "\n";
if ($conductores->count() > 0) {
    echo json_encode($conductores->take(5), JSON_PRETTY_PRINT) . "\n";
}
