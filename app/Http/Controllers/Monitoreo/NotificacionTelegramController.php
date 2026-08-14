<?php

namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\NotificacionTelegram;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Http;


class NotificacionTelegramController extends Controller
{
    protected $telegramToken;
    
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->telegramToken = env('TELEGRAM_BOT_TOKEN_4'); // Asegúrate de definir esto en tu archivo .env
        
    }

    public function index()
    {
        $notificaciones = NotificacionTelegram::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('monitoreo.Notificacion.Index', compact('notificaciones'));
    }

    public function create()
    {
        return view('monitoreo.Notificacion.Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ciudad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'edificio' => 'required|string|max:255',
        ], [
            'usuario.required' => 'El campo usuario es obligatorio',
            'descripcion.required' => 'La descripción es obligatoria',
            'ciudad.required' => 'La ciudad es obligatoria',
            'direccion.required' => 'La dirección es obligatoria',
            'edificio.required' => 'El edificio es obligatorio',
        ]);

        $notificacion = NotificacionTelegram::create([
            'usuario' => $request->usuario,
            'descripcion' => $request->descripcion,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'edificio' => $request->edificio,
            'user_id' =>  auth()->id(),
        ]);

        try {
            
             $mensaje =
            "<b>🔔 NUEVA NOVEDAD REGISTRADA</b>\n\n"
            . "👤 <b>Usuario:</b> {$notificacion->usuario}\n"
            . "🏙️ <b>Ciudad:</b> {$notificacion->ciudad}\n"
            . "🏢 <b>Edificio:</b> {$notificacion->edificio}\n"
            . "📍 <b>Dirección:</b> {$notificacion->direccion}\n"
            . "📝 <b>Descripción:</b> {$notificacion->descripcion}\n"
            . "📅 <b>Fecha:</b> " . $notificacion->created_at->format('d/m/Y H:i:s');
            
            
            $response = Http::post("https://api.telegram.org/bot{$this->telegramToken}/sendMessage", [
            'chat_id' => env('TELEGRAM_CHANNEL_ID_4'),
            'parse_mode' => 'HTML',
            'text'    => $mensaje,
        ]); 
                                
            return redirect()->route('notificaciones.index')
                ->with('success', 'Novedad registrada y notificación enviada a Telegram correctamente');
            
        } catch (\Exception $e) {
            
            return redirect()->route('notificaciones.index')
                ->with('warning', 'Novedad registrada pero hubo un error al enviar la notificación a Telegram'. $e->getMessage());
            
        }
       
    }
}