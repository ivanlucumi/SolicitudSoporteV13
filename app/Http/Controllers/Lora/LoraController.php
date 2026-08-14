<?php

namespace App\Http\Controllers\Lora;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class LoraController extends Controller
{
    //

     public function __construct(){
        //$this->middleware('auth');
       // $this->middleware('checarsesion');
        //$this->middleware('cambiopass');
       // $this->middleware('administrador');
        
    }
    
    public function Index(Request $request)
    {
        
         
    
        
        
        
        // Obtener valores enviados por Arduino
        $mensaje = $request->input('mensaje');
        $paquete = $request->input('paquete');

        // Construir línea de log
        $linea = sprintf(
            "[%s] Mensaje: %s | Paquete: %s%s",
            now()->toDateTimeString(),
            $mensaje,
            $paquete,
            PHP_EOL
        );

        // Guardar en archivo datos_lora.txt dentro de storage/app
        try {
            // Guarda en storage/app/public/datos_lora.txt
            Storage::disk('local')->append('datos_lora.txt', $linea);
            // Guardar en log dedicado (storage/logs/lora.log)
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/lora.log'),
            ])->info($linea);
            
        } catch (\Exception $e) {
            return response("Error al guardar: " . $e->getMessage(), 500);
        }

        // Responder al Arduino
        return response("OK - Datos recibidos".$linea, 200);
    }
    
    
    
  
  
}