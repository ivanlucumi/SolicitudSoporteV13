<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Illuminate\Support\Facades\Mail;

class EmailHandler extends AbstractProcessingHandler
{
    /**
     * Escribe el registro de log enviándolo por correo.
     *
     * @param  \Monolog\LogRecord|array  $record
     * @return void
     */
    protected function write(LogRecord|array $record): void
    {
        // En Laravel 10/11+ Monolog usa objetos LogRecord.
        $levelName = is_array($record) ? ($record['level_name'] ?? 'ERROR') : $record->level->getName();
        $message = is_array($record) ? ($record['message'] ?? 'Error desconocido') : $record->message;
        $context = is_array($record) ? ($record['context'] ?? []) : $record->context;
        
        $body = "🔴 Ha ocurrido un evento/error en la aplicación.\n\n";
        $body .= "NIVEL: " . $levelName . "\n";
        $body .= "MENSAJE: " . (is_string($message) ? $message : json_encode($message)) . "\n";
        $body .= "FECHA: " . now()->toDateTimeString() . "\n\n";
        
        // Agregar detalles de la Petición Web
        if (request()) {
            $body .= "--- 🌐 DETALLES DE LA PETICIÓN ---\n";
            $body .= "URL: " . request()->fullUrl() . "\n";
            $body .= "MÉTODO: " . request()->method() . "\n";
            $body .= "IP: " . request()->ip() . "\n";
            if (auth()->check()) {
                $body .= "USUARIO AUTENTICADO (ID): " . auth()->id() . "\n";
            }
            $body .= "\n";
        }

        // Si se envió una Excepción (Error de código, controlador, modelo, etc.)
        $exception = $context['exception'] ?? null;
        if ($exception && $exception instanceof \Throwable) {
            $body .= "--- ⚠️ DETALLES DE LA EXCEPCIÓN ---\n";
            $body .= "TIPO DE ERROR: " . get_class($exception) . "\n";
            $body .= "ARCHIVO: " . $exception->getFile() . "\n";
            $body .= "LÍNEA: " . $exception->getLine() . "\n\n";
            $body .= "TRAZA DEL ERROR (Primeras 15 líneas):\n";
            
            // Extraer y limitar el stack trace
            $trace = explode("\n", $exception->getTraceAsString());
            $body .= implode("\n", array_slice($trace, 0, 15)) . "\n\n";
            
            // Remover la excepción del contexto para no duplicar datos
            unset($context['exception']);
        }
        
        if (!empty($context)) {
            $body .= "--- 📦 CONTEXTO ADICIONAL ---\n" . json_encode($context, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
        }
        
        try {
            Mail::raw($body, function ($message) use ($levelName) {
                $message->to('ilucumig@cendoj.ramajudicial.gov.co')
                        ->subject('Alerta de Sistema [' . $levelName . '] - ' . config('app.name'));
            });
        } catch (\Exception $e) {
            // Si el correo falla, no queremos hacer crash de la aplicación.
            // Ignoramos el error de envío del log.
        }
    }
}
