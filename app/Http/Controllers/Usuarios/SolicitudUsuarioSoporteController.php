<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Support\Facades\DB;

use App\Models\SolicitudUsuarioSoporte;
use App\Models\SolicitudTrabajoRemoto;
use App\Models\Teletrabajo2024;
use App\Models\Empleado;
use App\Http\Controllers\Controller;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Http;



class SolicitudUsuarioSoporteController extends Controller
{
    protected $telegramToken;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('usuario');
        
        $this->telegramToken = env('TELEGRAM_BOT_TOKEN_3'); // Aseg��rate de definir esto en tu archivo .env
        
    }
    public function index()
    {
        $solicitudes=SolicitudUsuarioSoporte::where('id_despacho', auth()->user()->cedula)
        ->orderBy('created_at', 'DESC')
        ->take(300)  // equivalente a limit(300)
        ->get();
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud();
        //dd($solicitudes);
        return view('usuario.solicitudes.index',compact('solicitudes','tipo_solicitud'));
    }

   
    public function store(Request $request)
    {
        //dd($request->file('anexos'));
        if(!empty($request->file('anexos'))){
        $file = $request->file('anexos');
        $documento = $_FILES["anexos"]["name"];
        $extension= pathinfo($_FILES["anexos"]['name'], PATHINFO_EXTENSION);
        $nombre = $request['id_funcionario']." ".$request['tipo_solicitud']." ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('soportes')->put($nombre, \File::get($file));
        }else{
            $nombre=null;
        }
        
        if(!empty($request->file('acta_nombramiento'))){
        $file = $request->file('acta_nombramiento');
        $documento = $_FILES["acta_nombramiento"]["name"];
        $extension= pathinfo($_FILES["acta_nombramiento"]['name'], PATHINFO_EXTENSION);
        $nombreActa = $request['id_funcionario']." Acta -  ".$request['tipo_solicitud']." ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('soportes')->put($nombreActa, \File::get($file));
        }else{
            $nombreActa=null;
        }
        
       
        
        $solicitud = SolicitudUsuarioSoporte::create([
        'id_despacho' =>  auth()->user()->cedula,
        'email_despacho' =>  auth()->user()->email,
        'despacho' =>  auth()->user()->name. auth()->user()->lastname, 
        'id_funcionario' => $request['id_funcionario'],
        'funcionario' => $request['funcionario'],
        'tipo_solicitud' => $request['tipo_solicitud'],
        'solicitud' => $request['solicitud'],
        'anexo' =>$nombre,
        'acta' => $nombreActa,
        'fecha_solicitud' => Carbon::now(),
        'estado' => "ABIERTO",
         /*'respuesta' => $request['respuesta'],        
        'fecha_solucion' => $request['fecha_solucion'],
        'id_user' => $request['idUser'],
        'quien_da_solucion' => $request['quien_da_solucion']*/
        ]);
        
        
        if($request['tipo_solicitud']=="BANCO AGRARIO"){
            
            
        
         $text = "<b>Solicitud de Audiencia:</b>:\n"
                    . "<b>Responsable: </b>\n"
                    . "$solicitud->despacho\n"
                    . "<b>Nombre Indiciado: </b>\n"
                    . "$request->tipo_solicitud\n"
                    . "<b>Fecha Solicitud: </b>\n"
                    . "$request->fecha_solicitud\n"
                    . "<b>Solicitud : </b>\n"
                    . "$solicitud->solicitud";
                    
        $response = Http::post("https://api.telegram.org/bot{$this->telegramToken}/sendMessage", [
            'chat_id' => env('TELEGRAM_CHANNEL_ID_3'),
            'parse_mode' => 'HTML',
            'text'    => $text,
        ]); 
        
        
                    
          //return $response->successful();                
        }                       
                           
        
        Session::flash('message','Requerimiento Registrado!');
        return redirect()->back();  
    }

   
    public function destroy(Request $request,SolicitudUsuarioSoporte $solicitudUsuarioSoporte,$id)
    {
        $mensaje =null;
        if($request->ajax())
         {
             $registro = SolicitudUsuarioSoporte::findOrFail($id);
             //dd($detenido);
             if($registro->id_user == NULL){
             $solicitudUsuarioSoporte::destroy($id);
             if($registro->anexo != null){
                Storage::disk('soportes')->delete($registro->anexo); 
             }
             $mensaje = "Eliminado!";
             }else{
               $mensaje ="El soporte ya esta en gestion, no se puede eliminar";   
             }
            
             //$solicitudUsuarioSoporte->delete();
                  
             return response()->json($mensaje);
         }
    }
    
    
    public function SolicitudTrabajoRemoto(){
        
        $solicitudes=SolicitudTrabajoRemoto::where('id_despacho', auth()->user()->cedula)->get();
        $tipo_usuarios =SolicitudUsuarioSoporte::tipo_usuario();
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        //dd($tipo_solicitud);
        return view('usuario.solicitudes.Remoto',compact('solicitudes','tipo_solicitud','tipo_usuarios'));
        
    }
    
    public function SolicitudSave(Request $request){
        
       // dd($request->all());
       
       
       $registro = SolicitudTrabajoRemoto::where('funcionario_identificacion',$request['funcionario_identificacion'])->first();
       
       if(!empty( $registro)){
          // if($registro->estado =="FORMATOS EN ESPERA DE REVISION DE R.H"){
               Session::flash('message', 'Su Solicitud No Se Puede Realizar, Elimine el registro y vuelva a cargar nuevamente ');
               return redirect()->back();
               
          // }
       }
       
       $extensionsolicitud= pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION);
       //$extensionformalizacion= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
       
       
       
      /* $tamsolicitud= intval($_FILES["solicitud"]["size"]);
        
        $totalsolicitud= ($tamsolicitud)/1000000;
        
        if ($totalsolicitud > 9.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tama�0�9o Permitido, debe ser m��ximo 10 MB");
           return Redirect::back();
        }
        
        $tamanuencia= intval($_FILES["anuencia"]["size"]);
        
        $totalanuencia= ($tamanuencia)/1000000;
        
        if ($totalanuencia > 9.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tama�0�9o Permitido, debe ser m��ximo 10 MB");
           return Redirect::back();
        }*/
        
        //dd($extensionsolicitud,$extensionformalizacion,$extensionanuencia);
        
        
         $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extensionsolicitud, $formatos_permitidos)  ) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
        if(!empty($request->file('anuencia'))){
            $extensionanuencia= pathinfo($_FILES["anuencia"]['name'], PATHINFO_EXTENSION);
            
           if(!in_array($extensionanuencia, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }  
        }
       
        
         if(!empty($request->file('solicitud'))){
        $file = $request->file('solicitud');
        $documento = $_FILES["solicitud"]["name"];
        $extension= pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION);
        $nombresolicitud =$request['funcionario_identificacion']."- SOLICITUD ". $request['despacho']." - ".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombresolicitud, \File::get($file));
        }else{
            $nombresolicitud=null;
        }
        
        /*if(!empty($request->file('formalizacion'))){
        $file = $request->file('formalizacion');
        $documento = $_FILES["formalizacion"]["name"];
        $extension= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
        $nombreformalizacion =$request['funcionario_identificacion']." - FORMALIZACION ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreformalizacion, \File::get($file));
        }else{
            $nombreformalizacion=null;
        }*/
        
        if(!empty($request->file('anuencia'))){
        $file = $request->file('anuencia');
        $documento = $_FILES["anuencia"]["name"];
        $extension= pathinfo($_FILES["anuencia"]['name'], PATHINFO_EXTENSION);
        $nombreanuencia =$request['funcionario_identificacion']." - ANUENCIA ". $request['despacho']." -  ".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreanuencia, \File::get($file));
        }else{
            $nombreanuencia=null;
        }
        
        
        
        
        if( auth()->user()->email == "registroteletrabajocali@disajcali.gov.co" ){
           $correoDespacho= "sdisajcali@cendoj.ramajudicial.gov.co"; 
           //$idUser = 1443;
           $idUser = 760011200000;
        }else{
          $correoDespacho=  auth()->user()->email; 
           $idUser =  auth()->user()->cedula;
        }
        
        
        $solicitud = SolicitudTrabajoRemoto::create([
        'id_despacho' => $idUser,
        'email_despacho' => $correoDespacho,
        'despacho' =>  auth()->user()->name. auth()->user()->lastname, 
        'funcionario_identificacion' => $request['funcionario_identificacion'],
        'funcionario_nombre' => $request['funcionario_nombre'],
        'funcionario_apellido' => $request['funcionario_apellido'],
        'email_funcionario' => $request['email_funcionario'],
        'tipo_solicitud' => $request['tipo_solicitud'],
        'solicitud' => $nombresolicitud,
        'seguimiento' =>"SE REGISTRA LA SOLICITUD :".Carbon::now(),
        'anuencia' => $nombreanuencia,
        'fecha_solicitud' => Carbon::now(),
        'estado' => "FORMATOS EN ESPERA DE REVISION DE R.H",
        'tipo_usuario'=> $request['tipo_usuario'],
        //'viabilidad',
        'estado_solicitud'=> "FORMATOS EN ESPERA DE REVISION DE R.H",
        /*'respuesta' => $request['respuesta'],        
        'fecha_solucion' => $request['fecha_solucion'],
        'id_user' => $request['idUser'],
        'quien_da_solucion' => $request['quien_da_solucion']*/
        ]);
        
         $data              =  json_decode(json_encode($solicitud), true); 
        
        $correoFuncionario = $request['email_funcionario'];
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($solicitud,$correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS �C DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Notificacion de Registro Solicitud Teletrabajo');
                                        
        });
        
        Session::flash('message', 'Solicitud de Teletrabajo registrada con Exito. En espera de concepto ARL!');
        return Redirect::to('usuarios/solicitud/funcionarios/teletrabajo');
        
    }
    
    public function SolicitudRevocarTrabajoRemoto(Request $request,$id){
        $solicitud = SolicitudTrabajoRemoto::findOrFail($id);
         $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        return view('usuario.solicitudes.revocarRemoto',compact('solicitud','tipo_solicitud'));
    }
    public function SubirRevocarTrabajoRemoto(Request $request,$id){
        
        $extensionformalizacion= pathinfo($_FILES["revocar"]['name'], PATHINFO_EXTENSION);
        //dd($extensionsolicitud,$extensionformalizacion,$extensionanuencia);
        
         $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extensionformalizacion, $formatos_permitidos)) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
       //dd($request->all()); 
       if(!empty($request->file('revocar'))){
        $file = $request->file('revocar');
        $documento = $_FILES["revocar"]["name"];
        $extension= pathinfo($_FILES["revocar"]['name'], PATHINFO_EXTENSION);
        $nombreRevocar =$request['funcionario_identificacion']." - REVOCAR ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreRevocar, \File::get($file));
        }else{
            $nombreRevocar=null;
        }
        
        //dd($nombreRevocar);
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        
        $registro->documento_revocado = $nombreRevocar;
        $registro->observaciones_revocado = $request['observaciones_revocado'];
        $registro->estado = "REVOCADO";
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "REVOCADO :".Carbon::now();
        $registro->logs_de_acciones = $logs . " "."SE CARGA DOCUMENTO REVOCAR";
        $registro->save();
        
        //dd( $registro);
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS �C DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        
        Session::flash('message', 'Solicitud de Revocar quedo registrada!');
        return Redirect::to('usuarios/solicitud/funcionarios/trabajo/remoto');
        
        
        
    }
    public function SolicitudFormallizacionTrabajoRemoto(Request $request,$id){
        $solicitud = SolicitudTrabajoRemoto::findOrFail($id);
         $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        return view('usuario.solicitudes.formalizacionRemoto',compact('solicitud','tipo_solicitud'));
    }
    
    public function SubirAnuenciaTrabajoRemoto(Request $request,$id){
        
        //dd($request->all(),$request->file('anuencia'));
        $formatos_permitidos =  array('pdf','PDF');
        $extensionanuencia= pathinfo($_FILES["anuencia"]['name'], PATHINFO_EXTENSION);
            
           if(!in_array($extensionanuencia, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            } 
            
        if(!empty($request->file('anuencia'))){
        $file = $request->file('anuencia');
        $documento = $_FILES["anuencia"]["name"];
        $extension= pathinfo($_FILES["anuencia"]['name'], PATHINFO_EXTENSION);
        $nombreanuencia =$request['funcionario_identificacion']." - ANUENCIA ". $request['despacho']." -  ".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreanuencia, \File::get($file));
        }else{
            $nombreanuencia=null;
        }
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->anuencia = $nombreanuencia;
        $registro->concepto_talento_humano = NULL;
        $registro->pasar_arl = NULL;
        $registro->logs_de_acciones = $logs . " "."SE CARGA ANUENCIA".Carbon::now();
        $registro->estado = "FORMATOS EN ESPERA DE REVISION DE R.H";
        //'fecha_concepto',
        //'viabilidad',
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "SE CARGA ANUENCIA :".Carbon::now();
        $registro->estado_solicitud= "FORMATOS EN ESPERA DE REVISION DE R.H";
        $registro->save();
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS �C DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        
        Session::flash('message', 'Se carga Anuencia!');
        return Redirect::to('usuarios/solicitud/funcionarios/teletrabajo');
        
    }
    
     public function SubirFormallizacionTrabajoRemoto(Request $request,$id){
         
         //dd($request);
        
        $extensionformalizacion= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
        //dd($extensionformalizacion);
        
         $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extensionformalizacion, $formatos_permitidos)) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
            
        // $extensionsolicitud= pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION);
       //$extensionformalizacion= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
      // $extensionanuencia= pathinfo($_FILES["anuencia"]['name'], PATHINFO_EXTENSION);
       
       
      /* $tamformalizacion= intval($_FILES["formalizacion"]["size"]);
        
        $totalformalizacion= ($tamformalizacion)/1000000;
        
        if ($totalformalizacion > 14.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tama�0�9o Permitido, debe ser m��ximo 14 MB");
           return Redirect::back();
        }*/
        
           
            
        
       //dd($request->all()); 
       if(!empty($request->file('formalizacion'))){
        $file = $request->file('formalizacion');
        $documento = $_FILES["formalizacion"]["name"];
        $extension= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
        $nombreformalizacion =$request['funcionario_identificacion']." - FORMALIZACION ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreformalizacion, \File::get($file));
        }else{
            $nombreformalizacion=null;
        }
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->formalizacion = $nombreformalizacion;
        $registro->logs_de_acciones = $logs . " "."SE CARGA FORMALIZACION";
        $registro->estado = "APROBADO";
        //'fecha_concepto',
        //'viabilidad',
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "SE CARGA FORMALIZACION :".Carbon::now();
        $registro->estado_solicitud= "APROBADO";
        $registro->save();
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        $notificacionBaos = "jbaosm@cendoj.ramajudicial.gov.co";
        
        Mail::send('emails.remoto.novedadTeletrabajo',$data, function ($message) use ($registro,$correoFuncionario,$correoDespacho,$notificacionBaos) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS �C DISAJ CALI');
            $message->to($correoDespacho);
            $message->cc($notificacionBaos);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($registro,$correoDespacho,$correoFuncionario) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS �C DISAJ CALI');
                                        $message->to("teletrabajocali@cendoj.ramajudicial.gov.co");
                                        $message->cc($correoDespacho);
                                        $message->cc("coordtecnica.rama@positiva.gov.co");
                                        if(!empty($correoFuncionario)){
                                                $message->cc($correoFuncionario); 
                                            }
                                        $message->subject($registro->funcionario_identificacion." ".$registro->despacho);
                                        if($registro->solicitud != null){
                                        $message->attach("/home/disajcal/public_html/SoportesRemoto/" . $registro->solicitud ,[  'mime' => "application/octet-stream", ]);
                                        }
                                        if(!empty($registro->anuencia)){
                                        $message->attach("/home/disajcal/public_html/SoportesRemoto/" . $registro->anuencia,[  'mime' => "application/octet-stream", ]);
                                        }
                                        if(!empty($registro->formalizacion)){
                                        $message->attach("/home/disajcal/public_html/SoportesRemoto/" . $registro->formalizacion,[  'mime' => "application/octet-stream", ]);
                                        }
                                        if(!empty($registro->lista)){
                                        $message->attach("/home/disajcal/public_html/SoportesRemoto/" . $registro->lista,[  'mime' => "application/octet-stream", ]);
                                        }
                                        if(!empty($registro->documento_concepto)){
                                        $message->attach("/home/disajcal/public_html/SoportesRemoto/" . $registro->documento_concepto,[  'mime' => "application/octet-stream", ]);
                                        }
                         });
        
        
       
        
        Session::flash('message', 'Formalizacion de Teletrabajo Registrada con Exito!');
        return Redirect::to('usuarios/solicitud/funcionarios/teletrabajo');
        
        
        
    }
    public function SolicitudRevocar(Request $request,$id){
         $mensaje =null;
        if($request->ajax())
         {
             $registro = SolicitudTrabajoRemoto::findOrFail($id);
             //dd($detenido);
             if($registro->estado != "REVOCADO"){
                 $registro->estado = "REVOCADO";
                 $registro->save();
             $mensaje = "SOLICITUD SE ENCUENTRA EN TRAMITE!";
             }else{
             $mensaje ="LA SOLICITUD YA SE ENCUENTRA EN ESTADO REVOCADO";   
             }
            
             //$solicitudUsuarioSoporte->delete();
                  
             return response()->json($mensaje);
         }
        
    }
    
      public function consultaCedulaE(Request $request,$id){
         
         //dd($request->all(),$id);
        
        $empleado = Empleado::where('cedulaE',$id)->first();
        
        if($request->ajax())
        {
         
          return response()->json($empleado);
        }
        
        
    }
    
     public function consultaCedulaAnuencia(Request $request,$id){
         
         //dd($request->all(),$id);
        
        $empleado = SolicitudTrabajoRemoto::where('funcionario_identificacion',$id)->first();
        
        if($request->ajax())
        {
         
          return response()->json($empleado);
        }
        
        
    }
    
    public function destroySolicitud($id)
    {
        //
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
       
       if(!empty( $registro)){
           if($registro->estado =="FORMATOS EN ESPERA DE REVISION DE R.H"){
               \Storage::disk('remoto')->delete($registro->anuencia);
               \Storage::disk('remoto')->delete($registro->solicitud);
               $eliminar = SolicitudTrabajoRemoto::destroy($id);
               Session::flash('message','Eliminado Correctamente');
        
        $data              =  json_decode(json_encode($registro), true);        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.novedadTeletrabajo',$data, function ($message) use ($registro,$correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS �C DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Se Elimino Registro por Parte del Despacho');
                                        
        });
               
               return redirect()->back();
               
           }else{
               Session::flash('message','Solicitud no se puede Tramitar. Debe estar en estado "FORMATOS EN ESPERA DE REVISION DE R.H" para que se pueda Eliminar');
               return redirect()->back();
           }
       }
        
            }
            
    public function ConsultaFormalizacion(Request $request,$id){
         
         //dd($request->all(),$id);
        
        $empleado = Teletrabajo2024::where('cedula',$id)->first();
        
        if($request->ajax())
        {
         
          return response()->json($empleado);
        }
    }
            
    public function soporteTeletrabajo24(){
        
        $empleados = Teletrabajo2024::where('documento',"!=",null)
        ->get();
        return view('usuario.solicitudes.teletrabajo',compact('empleados'));
        
    }    
    
    public function AlmacenarTeletrabajo2024(Request $request){
        
       // dd($request->all());
        
        if(empty($request->dias_teletrabajo)){
           Session::flash('error','DEBE SELECCIONAR LOS DIAS REPORTADOS PARA TELETRABAJO');
          return redirect()->back();  
        }
        
        if(empty($request->id)){
          Session::flash('error','DEBE COMUNICARSE CON RECURSOS HUMANOS, NO ESTA REGISTRADO PARA CARGAR EL DOCUMENTO GENERADO EN TELETRABAJO');
          return redirect()->back();  
        }
        
        $dias =$request->dias_teletrabajo;
        
        $dia_teletrabajo= "";
        
       foreach($dias as $dia){
           
          $dia_teletrabajo .= $dia." ";
           
       }
       
       $empleado = Teletrabajo2024::find($request->id);
        
        if(!empty($empleado->documento)){
          Session::flash('error','YA SE HA CARGADO EL DOCUMENTO, NO PUEDE REEMPLAZARLO');
          return redirect()->back();   
        }
       
      // dd($dia_teletrabajo);
      
      if(!empty($request->file('documento'))){
        $file = $request->file('documento');
        $extension= pathinfo($_FILES["documento"]['name'], PATHINFO_EXTENSION);
        $documento_nombre ="/".$request['funcionario_identificacion']."/". $request['funcionario_nombre']."-".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('teletrabajo')->put($documento_nombre, \File::get($file));
        
        }
        
        
        
        
        
        $empleado->codigo_despacho =  auth()->user()->cedula;
        $empleado->correo_despacho =  auth()->user()->email;
        $empleado->dias_teletrabajo =$dia_teletrabajo;
        $empleado->documento =$documento_nombre;
        
        //dd($empleado);
        
        $empleado->save();
        Session::flash('message','DOCUMENTO ALMACENADO CORRECTAMENTE');
        return redirect()->route('usuario.docuemntos.trabajo.remoto');
        
        
    }
            
}
