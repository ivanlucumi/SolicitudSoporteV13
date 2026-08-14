<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\SolicitudServicio;
use App\Mail\SolicitudCreadaMail;
use Illuminate\Support\Facades\Log;

class SendSolicitudCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $solicitud;
    public $tries = 3; // Reintentos en caso de fallo

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SolicitudServicio $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // 1. Enviar Correo al administrador (o al grupo) y con copia al solicitante si aplica
            $correoDestino = 'sdisajcali@cendoj.ramajudicial.gov.co'; // Correo admin por defecto
            
            Mail::to($correoDestino)
                ->cc($this->solicitud->dependencia_email ?? [])
                ->send(new SolicitudCreadaMail($this->solicitud));

            // 2. Notificar por Telegram
            $telegramToken = env('TELEGRAM_BOT_TOKEN_3');
            $chatId = env('TELEGRAM_CHANNEL_ID_3');

            if ($telegramToken && $chatId) {
                $text = "<b>Nueva Solicitud Creada ({$this->solicitud->numero_solicitud})</b>\n"
                    . "<b>Responsable/Dependencia: </b>\n"
                    . "{$this->solicitud->dependencia_nombre}\n"
                    . "<b>Solicitante: </b>\n"
                    . "{$this->solicitud->solicitante_nombre}\n"
                    . "<b>Tipo: </b>\n"
                    . "{$this->solicitud->tipo_solicitud}\n"
                    . "<b>Descripción: </b>\n"
                    . "{$this->solicitud->descripcion}\n";

                Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'parse_mode' => 'HTML',
                    'text'    => $text,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error al enviar notificaciones de solicitud: ' . $e->getMessage());
            throw $e; // Lanzamos de nuevo para que la cola lo intente otra vez
        }
    }
}
