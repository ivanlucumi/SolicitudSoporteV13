<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::where('rol', 27)->get(['cedula', 'name', 'lastname']);

$roles = \App\Models\User::select('rol', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
    ->groupBy('rol')
    ->get();

$conductores = \App\Models\Conductor::all();

echo json_encode([
    'users_rol_27_count' => $users->count(),
    'roles_existentes' => $roles,
    'conductores_tabla_count' => $conductores->count(),
]);
