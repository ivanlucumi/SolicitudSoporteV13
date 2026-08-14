<?php

namespace App\Http\Controllers\VigilanciaJudicial;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

use Illuminate\Support\Str;


use App\Models\Despacho;
use App\Models\VigilanciaJudicial;


class VigilanciaJudicialController extends Controller
{
    //
    
    public function Inicio(Request $request){
      $despachos = Despacho::where('tipo','DESPACHO')->pluck('nombreDespacho','codigoDespacho');  
      return view('externo.VigilanciaJudicial.Inicio',compact('despachos'));
    }

   
    
    public function saveInicio(Request $request)
    {
        
       // dd($request->all());
        
    
            // ✅ VALIDACIÓN
            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
                'tipo_solicitante'=>'required|max:30',
                'nombre_apellido'=>'required|max:150',
                'cedula'=>'required|max:15',
                'direccion'=>'required|max:100',
                'correo'=>'required|max:150',
                'telefono'=>'required|max:30',
                'barrio'=>'required|max:100',
                'municipio'=>'required|max:100',
                'codigo_despacho'=>'required|max:15',
                'tipo_proceso'=>'required|max:200',
                'num_radicado'=>'required|numeric|digits:23',
                'demandante'=>'required|max:200',
                'demandado'=>'required|max:200',
                'tratamientoDeDatos'=>'required',
            ]);
            
            DB::beginTransaction();
    
            try {
    
            // ✅ DESPACHO
            $despacho = Despacho::where('codigoDespacho', $request->codigo_despacho)->firstOrFail();
    
            // ✅ SEGUIMIENTO ÚNICO
            do {
                $key = Str::random(12);
            } while (VigilanciaJudicial::where('seguimiento', $key)->exists());
    
            // ✅ ARCHIVOS
            if (!$request->hasFile('formato')) {
                throw new \Exception('El archivo principal es obligatorio');
            }
    
            $nombre = null;
            $nombre_anexos = null;
    
            if ($request->file('formato')->getClientOriginalExtension() !== 'pdf') {
                throw new \Exception('El archivo debe ser PDF');
            }
    
            $nombre = $key.'_formato.pdf';
            Storage::disk('VigilanciaJudicial')->put($nombre, file_get_contents($request->file('formato')));
    
            if ($request->hasFile('anexos')) {
                $nombre_anexos = $key.'_anexos.pdf';
                Storage::disk('VigilanciaJudicial')->put($nombre_anexos, file_get_contents($request->file('anexos')));
            }
    
            // ✅ GUARDAR
            $reporte = VigilanciaJudicial::create([
                'seguimiento' => $key,
                'tipo_solicitante' => $request->tipo_solicitante,
                'nombre_apellido' => $request->nombre_apellido,
                'cedula' => $request->cedula,
                'direccion' => $request->direccion,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'barrio' => $request->barrio,
                'municipio' => $request->municipio,
                'despacho_encuentra' => $despacho->nombreDespacho,
                'codigo_despacho' => $request->codigo_despacho,
                'tipo_proceso' => $request->tipo_proceso,
                'num_radicado' => $request->num_radicado,
                'demandante' => $request->demandante,
                'demandado' => $request->demandado,
                'descrip_otro' => $request->descrip_otro,
                'formato' => $nombre,
                'anexos' => $nombre_anexos,
                'fecha_recibido' => now(),
            ]);
    
            DB::commit();
            
            
            $data = json_decode(json_encode($reporte), true);
            $notificacion=str_replace(" ", "", $reporte->correo);
            $formato= $reporte->formato;
            $anexos= $reporte->anexos;
            
            Mail::send('emails.NotificacionVigilancia',$data, function ($message) use ($notificacion,$formato,$anexos)
            { $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->cc($notificacion); $message->subject('Notificacion solicitud Vigilancia'); 
            
            });
            
    
            /*return redirect()
                ->route('publico.vigilancia.judicial.index')
                ->with('success', 'Solicitud registrada con éxito');*/
                
            // Mensaje SweetAlert
        $mensaje = "Solicitud Realizada Con Éxito!!<br>
                    <strong>Código de seguimiento:</strong> {$key}<br>
                    <strong>Radicado:</strong> {$reporte->num_radicado}<br>
                    <strong>Fecha Solicitud:</strong> {$reporte->fecha_recibido}<br>
                    <strong>Se remitió respuesta a :</strong> {$notificacion}";
    
        return redirect()->back()->with('success', $mensaje);
        
    
        } catch (\Throwable $e) {
    
            DB::rollBack();
    
            return back()
                ->with('error', 'Error: '.$e->getMessage())
                ->withInput();
        }
    }

    
    
    

}
