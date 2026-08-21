<?php

namespace App\Services;

use App\Models\EncuestaSiniestro;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Servicio para enviar el correo del siniestro con el PDF adjunto.
 */
class CorreoSiniestroService
{
    /**
     * Envía el correo de notificación del siniestro.
     *
     * @param  EncuestaSiniestro  $siniestro
     * @return array{enviado: bool, error: string|null, destinatarios: string}
     */
    public function enviar(EncuestaSiniestro $siniestro): array
    {
        $destinatarios = $this->resolverDestinatarios($siniestro);

        if (empty($destinatarios)) {
            return [
                'enviado'       => false,
                'error'         => 'No hay correos configurados para el despacho.',
                'destinatarios' => '',
            ];
        }

        $pdfPath = null;
        if ($siniestro->pdf_path) {
            $pdfPath = storage_path('app/public/' . $siniestro->pdf_path);
            if (!file_exists($pdfPath)) {
                $pdfPath = null;
            }
        }

        $consecutivo    = $siniestro->consecutivo;
        $nombreDespacho = $siniestro->despacho_nombre;
        $listaDest      = implode(', ', $destinatarios);

        try {
            Mail::send(
                'encuesta_siniestro.correo',
                compact('siniestro'),
                function ($message) use ($destinatarios, $consecutivo, $nombreDespacho, $pdfPath) {
                    $message->from(
                        config('mail.from.address', 'informacion@disajcali.gov.co'),
                        'SISTEMA SIRIS CALI – Gestión de Siniestros'
                    );

                    $message->to(array_shift($destinatarios));

                    foreach ($destinatarios as $cc) {
                        $message->cc($cc);
                    }

                    $message->subject(
                        "Reporte de Siniestro No. {$consecutivo} – {$nombreDespacho}"
                    );

                    if ($pdfPath) {
                        $message->attach($pdfPath, [
                            'as'   => "Siniestro-{$consecutivo}.pdf",
                            'mime' => 'application/pdf',
                        ]);
                    }
                }
            );

            return [
                'enviado'       => true,
                'error'         => null,
                'destinatarios' => $listaDest,
            ];

        } catch (\Exception $e) {
            Log::error("Error enviando correo siniestro {$consecutivo}: " . $e->getMessage());
            return [
                'enviado'       => false,
                'error'         => $e->getMessage(),
                'destinatarios' => $listaDest,
            ];
        }
    }

    /**
     * Resuelve la lista de destinatarios del correo
     */
    private function resolverDestinatarios(EncuestaSiniestro $siniestro): array
    {
        $destinatarios = [];

        // Correo principal del despacho
        if (!empty($siniestro->despacho_correo)) {
            $destinatarios[] = trim($siniestro->despacho_correo);
        }

        // Correo del titular si es diferente al del despacho
        if (!empty($siniestro->titular_correo) &&
            $siniestro->titular_correo !== $siniestro->despacho_correo) {
            $destinatarios[] = trim($siniestro->titular_correo);
        }

        // Filtrar correos vacíos o inválidos
        return array_values(array_filter($destinatarios, function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }));
    }
}
