<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$siniestros = App\Models\EncuestaSiniestro::with('elementos')->orderBy('id', 'desc')->take(3)->get();
$elementos = App\Models\EncuestaSiniestroElemento::orderBy('id', 'desc')->take(5)->get();

file_put_contents(__DIR__.'/../storage/logs/mi_log.txt', print_r([
    'siniestros' => $siniestros->toArray(),
    'elementos' => $elementos->toArray()
], true));

echo "OK";
