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
            $asunto = "Reporte de Siniestro No. {$consecutivo} – {$nombreDespacho}";
            
            Mail::send('encuesta_siniestro.correo', compact('siniestro'), function ($mail) use ($destinatarios, $asunto, $pdfPath) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                
                $to = array_shift($destinatarios);
                $mail->to($to);

                foreach ($destinatarios as $cc) {
                    $mail->cc($cc);
                }

                $mail->subject($asunto);
                $mail->priority(1);

                if ($pdfPath && file_exists($pdfPath)) {
                    $mail->attach($pdfPath, ['mime' => 'application/pdf']);
                }

                if (method_exists($mail, 'withSymfonyMessage')) {
                    $mail->withSymfonyMessage(function (\Symfony\Component\Mime\Email $message) {
                        try {
                            $rawMessage = $message->toString();
                            
                            $host = env('IMAP_HOST', 'mail.disajcali.gov.co');
                            $port = env('IMAP_PORT', 993);
                            $user = env('IMAP_USERNAME', 'informacion@disajcali.gov.co');
                            $pass = env('IMAP_PASSWORD');
                            
                            $imapPath = '{' . $host . ':' . $port . '/imap/ssl}Sent';
                            
                            $imapStream = @imap_open($imapPath, $user, $pass);
                            
                            if ($imapStream) {
                                $folders = imap_list($imapStream, '{'.$host.':'.$port.'/imap/ssl}', '*');
                                \Illuminate\Support\Facades\Log::info("Carpetas IMAP disponibles:", ['folders' => $folders]);
                                
                                $sentFolder = $imapPath; // default
                                if (is_array($folders)) {
                                    $possibleNames = ['Sent', 'INBOX.Sent', 'Enviados', 'Elementos enviados', 'Sent Items'];
                                    foreach ($folders as $folder) {
                                        foreach ($possibleNames as $name) {
                                            if (str_ends_with(strtolower($folder), strtolower($name))) {
                                                $sentFolder = $folder;
                                                break 2;
                                            }
                                        }
                                    }
                                }
                                
                                \Illuminate\Support\Facades\Log::info("Guardando en carpeta IMAP:", ['folder' => $sentFolder]);
                                imap_append($imapStream, $sentFolder, $rawMessage . "\r\n");
                                imap_close($imapStream);
                            }
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error("Error IMAP Siniestro: " . $e->getMessage());
                        }
                    });
                }
            });

            return [
                'enviado'       => true,
                'error'         => null,
                'destinatarios' => $listaDest,
            ];

        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Error encolando correo siniestro {$consecutivo}: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return [
                'enviado'       => false,
                'error'         => 'Excepción: ' . $e->getMessage(),
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
