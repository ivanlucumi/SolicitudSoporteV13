<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramService
{
    protected $botToken;
    protected $chatId;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN_5');
        $this->chatId = env('TELEGRAM_CHANNEL_ID_5');
    }

    public function enviarNotificacion($notificacion)
    {
        $mensaje =
            "<b>🔔 NUEVA NOVEDAD REGISTRADA</b>\n\n"
            . "👤 <b>Usuario:</b> {$notificacion->usuario}\n"
            . "🏙️ <b>Ciudad:</b> {$notificacion->ciudad}\n"
            . "🏢 <b>Edificio:</b> {$notificacion->edificio}\n"
            . "📍 <b>Dirección:</b> {$notificacion->direccion}\n"
            . "📝 <b>Descripción:</b> {$notificacion->descripcion}\n"
            . "📅 <b>Fecha:</b> " . $notificacion->created_at->format('d/m/Y H:i:s');

        try {
            
             Telegram::sendMessage([
                                        'chat_id' => env('TELEGRAM_CHANNEL_ID', $this->chatId),
                                        'parse_mode' => 'HTML',
                                        'text' => $mensaje
                                ]);
            
            
           /* $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                'chat_id' => $this->chatId,
                'text' => $mensaje,
                'parse_mode' => 'Markdown'
            ]);*/

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Error al enviar notificación a Telegram: ' . $e->getMessage());
            return false;
        }
    }
}

/*$text = "<b>Solicitud de Servicio:</b>\n"
      . "<b>Usuario:</b> {$request->usuario}\n"
      . "<b>Descripción:</b> {$request->descripcion}\n"
      . "<b>Ciudad:</b> {$request->ciudad}\n"
      . "<b>Dirección:</b> {$request->direccion}\n"
      . "<b>Edificio:</b> {$request->edificio}\n"
      . "<b>ID Usuario Sistema:</b> " .  auth()->id();

        
        Telegram::sendMessage([
                                        'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1002465165284'),
                                        'parse_mode' => 'HTML',
                                        'text' => $text
                                ]);*/