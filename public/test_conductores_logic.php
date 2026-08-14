<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Conductor;

        // Obtener conductores de la tabla users (rol 27)
        $usersConductores = User::where('rol', 27)->get()->map(function($u) {
            return [
                'cedula' => $u->cedula,
                'name' => $u->name,
                'lastname' => $u->lastname
            ];
        })->toArray();
        
        // Obtener conductores de la tabla conductores y mapear atributos
        $tablaConductores = Conductor::all()->map(function($c) {
            return [
                'cedula' => $c->cedula,
                'name' => $c->nameE,
                'lastname' => $c->lastnameE
            ];
        })->toArray();
        
        // Unir ambos arrays y eliminar duplicados por cédula
        $todos = array_merge($usersConductores, $tablaConductores);
        $conductoresUnicos = [];
        foreach ($todos as $c) {
            if (!empty($c['cedula'])) {
                $conductoresUnicos[$c['cedula']] = (object) $c;
            }
        }
        
        $conductores = collect(array_values($conductoresUnicos))->sortBy('name')->values();

echo "Count: " . count($conductores) . "\n";
echo json_encode($conductores);
