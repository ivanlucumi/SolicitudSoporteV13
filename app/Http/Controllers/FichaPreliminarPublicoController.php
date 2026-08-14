<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FichaPreliminar;
use App\Models\Despacho;
use App\Models\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Support\Str;


class FichaPreliminarPublicoController extends Controller
{
    
    
    public function index(){
        
        function permiteEnvioAhora(): bool
            {
                $now = Carbon::now();
                $dia = (int) $now->isoWeekday(); // 1 = Lunes ... 7 = Domingo
            
                // Marcas de tiempo base
                $inicioNocturno = $now->copy()->setTime(20, 0, 0); // 20:00
                $finManana      = $now->copy()->setTime(8, 0, 0);  // 08:00
            
                // --- Usuarios de semana (Lunes a Viernes) ---
                //if ($tipoUsuario === 'semana') {
                    // Lunes a Jueves: [20:00-24:00) y [00:00-08:00)
                    if ($dia >= 1 && $dia <= 4) {
                        $esNoche = $now->greaterThanOrEqualTo($inicioNocturno);
                        $esMadrugada = $now->lessThan($finManana);
                        return $esNoche || $esMadrugada;
                    }
            
                    // Viernes: [00:00-08:00)
                    if ($dia === 5) {
                        return $now->lessThan($finManana);
                    }
               // }
            
                // --- Usuarios de fin de semana (Viernes, Sábado y Domingo) ---
               // if ($tipoUsuario === 'finsemana') {
                    // Viernes tarde: [20:00-24:00)
                    if ($dia === 5 && $now->greaterThanOrEqualTo($inicioNocturno)) {
                        return true;
                    }
            
                    // Sábado: [00:00-08:00) y [20:00-24:00)
                    if ($dia === 6) {
                        $esMadrugada = $now->lessThan($finManana);
                        $esNoche = $now->greaterThanOrEqualTo($inicioNocturno);
                        return $esMadrugada || $esNoche;
                    }
            
                    // Domingo: [00:00-08:00)
                    if ($dia === 7) {
                        return $now->lessThan($finManana);
                    }
               // }
            
                // En cualquier otro caso no permitir
                return false;
            }
            
            // Uso en tu código:
            if (permiteEnvioAhora(/*auth()->user()->tipo_usuario*/)) { // 'semana' o 'finsemana'
                $despachoActivo = Despacho::where('notificacion_ficha_remision', true)->first();
            } else {
                $despachoActivo = null;
            }
        
        $tipoAudiencia = FichaPreliminar::tipoAudiencia();
        return view('externo.ArchivoPublico.Formulario',compact('tipoAudiencia','despachoActivo'));
        
    }
    
    
     public function Ficha_Preliminar_store(Request $request){
         //dd($request->all());
         
         /*if($request->numero_radicado_proceso == "76001999999999999999999"){
            Session::flash('error', 'datos enviados!');
            return Redirect::back(); 
         }*/
         
         $ErrorDisponible = null;
        
         $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha',
                'procesado'=>'required',
                'cedula_procesado'=>'required',
                'tipo_solicitud'=>'required|max:50',
                'telefono'=>'required|max:13',
                'numero_radicado_proceso'=>'required|numeric|digits:23',
                //'anexos'=>'required|max:4000',
                'email_notificacion'=>'required|max:120',
                'quien_solicita'=>'required|max:100',
                'cedula_quien_solicita'=>'required|max:13',
            ]);
            
        DB::beginTransaction();
         try{ 
        
        
        $extension= pathinfo($_FILES["anexos"]['name'], PATHINFO_EXTENSION);
        
        $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extension, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["demanda"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
            
        $nombredoc = $_FILES["anexos"]["name"];
        
        $separador = ".";
        $separada1 = explode($separador, $nombredoc);
        
        
            
        $shortCode = Str::random(6);
        
        $documento =$request->numero_radicado_proceso.strtoupper($request->tipo_solicitud).$shortCode.Carbon::now()->toDateTimeString().".pdf"/*".".$separada1[1]*/;
       
      
            
        //validacion de tama単o de Documentos
        $tamDemanda= intval($_FILES["anexos"]["size"])/1024000;    
        
        //dd($tamDemanda);
            
       
            //dd($request->all());
            
         
        
        
        if($tamDemanda > 0 || $tamDemanda < 17){
            //dd('hola1');
           \Storage::disk('fichapreliminar')->put($documento, \File::get($request->file('anexos')));
           
        }else{
          Session::flash('error', 'Verifique el tamaño del documento!');
            return Redirect::back();  
        }
        
           //codigo de seguimiento
           
            function generarCodigoUnico(int $longitud): string
            {
                do {
                    // Código aleatorio alfanumérico
                    $codigo = Str::upper(Str::random($longitud));
                } while (FichaPreliminar::where('seguimiento', $codigo)->exists());
            
                return $codigo;
            }
            
            $key = generarCodigoUnico(12);
         
            //dd($key);
                
          $reporte = FichaPreliminar::create([
            'numero_radicado_proceso'        => $request['numero_radicado_proceso'],
            'procesado'          => strtoupper($request->procesado),
            'cedula_procesado'          => $request->cedula_procesado,
            'tipo_solicitud'          => strtoupper($request->tipo_solicitud),
            'anexos'        =>  $documento,
            'email_notificacion'    =>  strtolower($request['email_notificacion']),
            'telefono'        => $request['telefono'],
            'despacho_remite'       => "Solicitud Externa ",
            'quien_solicita'   => $request['quien_solicita'],
            'cedula_quien_solicita'        => $request['cedula_quien_solicita'],
            'fecha_solicitud'          => Carbon::now()->toDateTimeString(),
            'ip'          =>  $request->ip(),
            'seguimiento'        => $key,
        ]);
         
         
         DB::commit();
            
           //dd($reporte);
            //
         
           
        $data              =  json_decode(json_encode($reporte), true);
        $asunto = "SOLICITUD  ".$reporte->tipo_solicitud." ".$key;
        $correoNotificacion = strtolower($request->email_notificacion);
        
        
        Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('avargasmo@cendoj.ramajudicial.gov.co');
                $mail->cc('soportesiris@outlook.com');
                $mail->subject($asunto);
                $mail->priority(1); // Alta prioridad
                //$mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            });  
            
        
            function permiteEnvioAhora(): bool
            {
                $now = Carbon::now();
                $dia = (int) $now->isoWeekday(); // 1 = Lunes ... 7 = Domingo
            
                // Marcas de tiempo base
                $inicioNocturno = $now->copy()->setTime(20, 0, 0); // 20:00
                $finManana      = $now->copy()->setTime(8, 0, 0);  // 08:00
            
                // --- Usuarios de semana (Lunes a Viernes) ---
                //if ($tipoUsuario === 'semana') {
                    // Lunes a Jueves: [20:00-24:00) y [00:00-08:00)
                    if ($dia >= 1 && $dia <= 4) {
                        $esNoche = $now->greaterThanOrEqualTo($inicioNocturno);
                        $esMadrugada = $now->lessThan($finManana);
                        return $esNoche || $esMadrugada;
                    }
            
                    // Viernes: [00:00-08:00)
                   /* if ($dia === 5) {
                        return $now->lessThan($finManana);
                    }
               
                    if ($dia === 5 && $now->greaterThanOrEqualTo($inicioNocturno)) {
                        return true;
                    }*/
                    
                    // --- Viernes ---
                        if ($dia === 5) {
                        
                            $esMadrugada = $now->lessThan($finManana);               // 00:00 - 07:59
                            $esNoche     = $now->greaterThanOrEqualTo($inicioNocturno); // 20:00 - 23:59
                        
                            return $esMadrugada || $esNoche;
                        }
            
                    // Sábado: [00:00-08:00) y [20:00-24:00)
                    if ($dia === 6) {
                        $esMadrugada = $now->lessThan($finManana);
                        $esNoche = $now->greaterThanOrEqualTo($inicioNocturno);
                        return $esMadrugada || $esNoche;
                    }
            
                    // Domingo: [00:00-08:00)
                    if ($dia === 7) {
                        return $now->lessThan($finManana);
                    }
               // }
            
                // En cualquier otro caso no permitir
                return false;
            }
            
            

                
                // Uso:
                if (permiteEnvioAhora()) {
                    try {
                        $despachoActivo = Despacho::where('notificacion_ficha_remision', true)->first();
                
                        if (!$despachoActivo) {
                            Log::warning('No se encontró un despacho activo para enviar notificación.');
                            return;
                        }
                
                        
                        $DespachoTurno=str_replace(" ", "",$despachoActivo->correoD);
                        
                        if($reporte->tipo_solicitud =='AUDIENCIA GARANTIAS ACTOS URGENTES'){
                            
                            // Manteniendo tu enfoque actual:
                            Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento, $asunto, $DespachoTurno) {
                                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                                $mail->to($DespachoTurno);
                                $mail->cc('soportesiris@outlook.com');
                                $mail->subject($asunto);
                                $mail->priority(1);
                                // $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento, ['mime' => "application/octet-stream"]);
                            });
                            
                             // Aquí agregamos la variable al $data para que llegue a la vista del correo
                            $data['despacho_turno'] = "Esta recibiendo este correo porque su solicitud ha sido asignada al Juzgado " 
                                . ($despachoActivo->nombreDespacho ?? 'no informado') 
                                . " (correo: " . ($despachoActivo->correoD ?? 'no informado') . "), conforme al turno vigente.";
                            
                            Mail::send('emails/fichas/CorreoFichaDespachoTurno', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                                    $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                                    $mail->to($correoNotificacion);
                                    $mail->subject($asunto);
                                    $mail->priority(1);
                                   // $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
                                }); 
                        }
                        
                        if ($despachoActivo) {
                            // Guardar en DB si aplica
                                $reporte->update([
                                    'despacho_turno' => $data['despacho_turno'],
                                ]);
                        }
                        
                
                        Log::info("Correo enviado exitosamente al despacho: {$DespachoTurno}");
                    } catch (\Throwable $e) {
                        Log::error('Error al enviar el correo de ficha preliminar: ' . $e->getMessage(), [
                            'exception' => get_class($e),
                            'trace' => $e->getTraceAsString(),
                        ]);
                        
                        $ErrorDisponible = "Si se presenta un error al enviar la solicitud, puede remitir un correo electrónico al juzgado de turno.
                                            Juzgado: {$despachoActivo->nombreDespacho}  Correo:".$despachoActivo->correoD;
                        
                    }
                } else {
                    Log::info('Envio bloqueado por ventana horaria.');
                   /* Log::info('Envio ficha preliminar', [
                        'seguimiento' => $key,
                        'radicado' => $reporte->numero_radicado_proceso,
                        'tipo' => $reporte->tipo_solicitud,
                        'hora_servidor' => now()->toDateTimeString(),
                        'ventana_habilitada' => $puedeEnviar,
                        'ip' => request()->ip(),
                    ]);*/
                }
        
        
            
        if($reporte->tipo_solicitud =='AUDIENCIA GARANTIAS ACTOS URGENTES'){
            
           Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('saspacali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->priority(1);
                //$mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            }); 
                    $text = "<b>Solicitud de Audiencia:</b>:\n"
                    . "<b>Quien Solicita: </b>\n"
                    . "$reporte->quien_solicita\n"
                    . "<b>Radicacion: </b>\n"
                    . "$reporte->numero_radicado_proceso\n"
                    . "<b>Tipo Solicitud: </b>\n"
                    . "$reporte->tipo_solicitud\n"
                    . "<b>Fecha Solicitud : </b>\n"
                    . "$reporte->fecha_solicitud";
                    Telegram::sendMessage([
                                        'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001666229135'),
                                        'parse_mode' => 'HTML',
                                        'text' => $text
                                ]);
        }
        
        
        if($reporte->tipo_solicitud =='AUDIENCIA GARANTIAS PROGRAMADAS'){
            
             Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                //$mail->to('saspacali@cendoj.ramajudicial.gov.co');
                $mail->to('reprograspacali@cendoj.ramajudicial.gov.co');
                $mail->cc('soportesiris@outlook.com');
                //$mail->cc('avargasmo@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->priority(1);
                //$mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            }); 
            
        }else{
            
            if($reporte->tipo_solicitud !='AUDIENCIA GARANTIAS ACTOS URGENTES'){ 
         
                 Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto) {
                        $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                        $mail->to('auxrecospa02cali@cendoj.ramajudicial.gov.co');
                        $mail->subject($asunto);
                        $mail->priority(1); // Alta prioridad
                        //$mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
                    }); 
                 
                 }
            
            
           
        }
        
        if (!permiteEnvioAhora()) {
            
        Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($correoNotificacion);
                $mail->subject($asunto);
                $mail->priority(1);
               // $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            }); 
            
        }
         Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('soportesiris@outlook.com');
                $mail->subject($asunto);
                $mail->priority(1);
                $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            });  
       
         
           
        // DB::commit();
        $fechaSolicitud =$reporte->fecha_solicitud;
        
        
        // Mensaje SweetAlert
        $mensaje = "Solicitud Realizada Con Éxito!!<br>
                    <strong>Código de seguimiento:</strong> {$key}<br>
                    <strong>Radicado:</strong> {$reporte->numero_radicado_proceso}<br>
                    <strong>Fecha Solicitud:</strong> {$fechaSolicitud}<br>
                    <strong>Se remitió respuesta a :</strong> {$correoNotificacion}";
    
        return redirect()->back()->with('success', $mensaje);
            
        // Session::flash('success','Solicitud Realizada Con Exito!!. Codigo de seguimiento es:   '.$key.'     En la fecha '.$fechaSolicitud .'.    Del Radicado'.$reporte->numero_radicado_proceso);
        //    return redirect()->back();    
            
       /* $consulta = FichaPreliminar::where('seguimiento',$key)
        ->where('numero_radicado_proceso',$reporte->numero_radicado_proceso)
        ->first();
        
        //dd($consulta);
        
        $tipoAudiencia = FichaPreliminar::tipoAudiencia();
        
        return view('fichaRemision.Preliminar.Consulta',compact('consulta','tipoAudiencia'));*/
            
        }catch (\Exception $e) {
            DB::rollback();
            
            if (permiteEnvioAhora()) {
                return back()->with('error', $ErrorDisponible)->withInput();
            }else{
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
            
        } catch (\Throwable $e) {
            DB::rollback();
            if (permiteEnvioAhora()) {
                return back()->with('error',$ErrorDisponible)->withInput();
            }else{
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
        }
        
    }
    
    public function Ficha_Preliminar_consulta(Request $request){
        
       return view('fichaRemision.Preliminar.FormConsulta'); 
        
    }
    
    public function Ficha_Preliminar_consulta_resultado(Request $request){
        $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha',
                'numero_radicado_proceso'=>'required|numeric|digits:23',
                'num_seguimiento'=>'required',
            ]);
        
        //dd($request->ALL());
        $consulta = FichaPreliminar::where('seguimiento',$request->num_seguimiento)
        ->where('numero_radicado_proceso',$request->numero_radicado_proceso)
        ->first();
        
        //dd($consulta);
        
        $tipoAudiencia = FichaPreliminar::tipoAudiencia();
        
        return view('fichaRemision.Preliminar.Consulta',compact('consulta','tipoAudiencia'));
        
    }
  
}


