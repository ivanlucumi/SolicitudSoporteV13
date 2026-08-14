<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Mover elementos de siniestros 'borrador' abandonados al siniestro 'registrado' o 'enviado' más reciente del mismo despacho.
$borradores = App\Models\EncuestaSiniestro::where('estado', 'borrador')->with('elementos')->get();

$fixCount = 0;
foreach ($borradores as $borrador) {
    if ($borrador->elementos->count() > 0) {
        $finalizado = App\Models\EncuestaSiniestro::where('despacho_codigo', $borrador->despacho_codigo)
            ->whereIn('estado', ['registrado', 'enviado'])
            ->where('id', '>', $borrador->id)
            ->orderBy('id', 'asc')
            ->first();

        if ($finalizado) {
            foreach ($borrador->elementos as $elem) {
                $elem->encuesta_siniestro_id = $finalizado->id;
                $elem->save();
                $fixCount++;
            }
            $borrador->delete(); // Eliminar el borrador huérfano
        }
    }
}

echo "Elementos corregidos: " . $fixCount;
