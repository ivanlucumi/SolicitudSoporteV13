<?php

namespace App\Services;

use App\Models\EncuestaSiniestro;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

/**
 * Servicio para generar el PDF de la Encuesta de Siniestros.
 */
class PdfSiniestroService
{
    /**
     * Genera el PDF, lo guarda en disco y actualiza el modelo.
     *
     * @param  EncuestaSiniestro  $siniestro
     * @return string  Ruta relativa del PDF en storage/app/public/
     */
    public function generar(EncuestaSiniestro $siniestro): string
    {
        @ini_set('max_execution_time', '300');
        @ini_set('memory_limit', '512M');

        // Las relaciones ya vienen cargadas desde el controlador, no recargamos para evitar blanquear la colección.

        // Generar PDF desde la vista blade
        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'chroot' => storage_path('app/public')
        ])->loadView('encuesta_siniestro.pdf', compact('siniestro'));

        // Definir ruta de guardado
        $carpeta       = "EncuestaSiniestro/pdf";
        $nombreArchivo = "siniestro-{$siniestro->consecutivo}-" . now()->format('YmdHis') . '.pdf';
        $rutaRelativa  = "{$carpeta}/{$nombreArchivo}";

        // Crear directorio si no existe
        $dirCompleto = storage_path("app/public/{$carpeta}");
        if (!file_exists($dirCompleto)) {
            mkdir($dirCompleto, 0755, true);
        }

        // Guardar PDF en disco
        $rutaCompleta = storage_path("app/public/{$rutaRelativa}");
        file_put_contents($rutaCompleta, $pdf->output());

        // Actualizar el modelo
        $siniestro->update([
            'pdf_path'        => $rutaRelativa,
            'pdf_generado_at' => now(),
        ]);

        return $rutaRelativa;
    }

    /**
     * Descarga el PDF como response HTTP (para el botón descargar)
     */
    public function descargar(EncuestaSiniestro $siniestro): \Symfony\Component\HttpFoundation\Response
    {
        $siniestro->load('elementos.fotos', 'user');

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('encuesta_siniestro.pdf', compact('siniestro'));

        return $pdf->download("Siniestro-{$siniestro->consecutivo}.pdf");
    }
}
