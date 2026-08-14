<?php

namespace App\Services;

use App\Models\RegistroCorreo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CorreoService
{
    /**
     * Encola la intención de envío en la base de datos y lanza el intento inmediatamente.
     * Si falla, el registro queda en estado FALLIDO para ser rescatado luego.
     *
     * @param int|null $fichaId
     * @param string $vista
     * @param array $datos
     * @param string|array $destinatarios
     * @param string|array|null $cc
     * @param string $asunto
     * @param array|null $adjuntos (rutas completas a archivos)
     */
    public static function encolarYEnviar($fichaId, $vista, $datos, $destinatarios, $cc, $asunto, $adjuntos = [])
    {
        // Convertir arreglos a strings separados por coma si es necesario
        $destinatarioStr = is_array($destinatarios) ? implode(',', $destinatarios) : $destinatarios;
        $ccStr = is_array($cc) ? implode(',', $cc) : $cc;

        // Crear el registro de seguimiento
        $registro = RegistroCorreo::create([
            'ficha_id' => $fichaId,
            'vista' => $vista,
            'datos_json' => json_encode($datos),
            'destinatario' => $destinatarioStr,
            'con_copia' => $ccStr,
            'asunto' => $asunto,
            'adjuntos_json' => json_encode($adjuntos),
            'estado' => 'PENDIENTE',
            'intentos' => 0
        ]);

        self::enviarDesdeRegistro($registro);

        return $registro;
    }

    /**
     * Intenta enviar el correo tomando la información de un modelo RegistroCorreo.
     *
     * @param RegistroCorreo $registro
     * @return bool
     */
    public static function enviarDesdeRegistro(RegistroCorreo $registro)
    {
        try {
            $registro->intentos = $registro->intentos + 1;

            $datos = json_decode($registro->datos_json, true) ?? [];
            
            // Re-hidratar modelo si es un correo de siniestro
            if ($registro->vista === 'encuesta_siniestro.correo' && isset($datos['siniestro']['id'])) {
                $datos['siniestro'] = \App\Models\EncuestaSiniestro::with('elementos.fotos', 'user')->find($datos['siniestro']['id']);
            }

            $destinatarios = array_filter(array_map('trim', explode(',', $registro->destinatario)));
            $cc = $registro->con_copia ? array_filter(array_map('trim', explode(',', $registro->con_copia))) : [];
            $asunto = $registro->asunto;
            $adjuntos = $registro->adjuntos_json ? json_decode($registro->adjuntos_json, true) : [];

            Mail::send($registro->vista, $datos, function ($mail) use ($destinatarios, $cc, $asunto, $adjuntos) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                
                foreach ($destinatarios as $to) {
                    $mail->to($to);
                }

                if ($archiveBcc = config('mail.archive_bcc')) {
                    $mail->bcc($archiveBcc);
                }

                foreach ($cc as $copia) {
                    $mail->cc($copia);
                }

                $mail->subject($asunto);
                $mail->priority(1);

                if (is_array($adjuntos)) {
                    foreach ($adjuntos as $adjunto) {
                        // Adjuntar si el archivo existe
                        if (file_exists($adjunto)) {
                            //$mail->attach($adjunto, ['mime' => 'application/octet-stream']);
                        }
                    }
                }

            });

            // Si pasa esta línea, el envío fue exitoso
            $registro->estado = 'ENVIADO';
            $registro->mensaje_error = null;
            $registro->save();

            return true;
        } catch (\Exception $e) {
            $registro->estado = 'FALLIDO';
            $registro->mensaje_error = 'Exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString();
            $registro->save();
            
            Log::error('Error enviando correo de la bandeja de salida: ' . $e->getMessage(), [
                'registro_id' => $registro->id
            ]);

            return false;
        } catch (\Throwable $t) {
            $registro->estado = 'FALLIDO';
            $registro->mensaje_error = 'Throwable: ' . $t->getMessage() . "\n" . $t->getTraceAsString();
            $registro->save();
            
            Log::error('Fallo grave enviando correo de la bandeja de salida: ' . $t->getMessage(), [
                'registro_id' => $registro->id
            ]);

            return false;
        }
    }
}
