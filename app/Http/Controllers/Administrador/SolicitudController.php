<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SolicitudUsuario;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Support\Facades\DB;


use App\Exports\SeguimientoPresencialidadExport;

use App\Models\Despacho;
use App\Models\User;

use App\Models\SolicitudUsuarioSoporte;
use App\Models\SolicitudTrabajoRemoto;


use App\Models\Teletrabajo2024;
use App\Models\SeguimientoPresencialidad;

use Telegram\Bot\Laravel\Facades\Telegram;

class SolicitudController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $solicitudesP = SolicitudTrabajoRemoto::distinct("funcionario_identificacion")->get()->count();
        $esperaArl=SolicitudTrabajoRemoto::where("estado","EN ESPERA CONCEPTO ARL")->count();
        $rechazados=SolicitudTrabajoRemoto::where("estado","FORMATOS RECHAZADOS")->count();
        $formalizacion=SolicitudTrabajoRemoto::where("estado","APROBADO Y EN ESPERA DE FORMALILZACION")->count();//
        $esperarh=SolicitudTrabajoRemoto::where("estado","FORMATOS EN ESPERA DE REVISION DE R.H")->count();
        
        //dd($solicitudes,$esperaArl,$rechazados,$esperarh);
        
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud();
        if( auth()->user()->tipo_rol !="ARL"){
            
        $solicitudes=SolicitudTrabajoRemoto::distinct("funcionario_identificacion")
        //->max('id');
        //dd($solicitudes);
        ->orderBy('created_at','asc')
        ->get();
        }else{
            
            $solicitudes=SolicitudTrabajoRemoto::where('pasar_arl','APROBADO')
            ->where('fecha_concepto',null)
            ->orderBy('created_at','asc')
            ->get();
         return view('administrador.solicitudes.remoto.arl',compact('solicitudes','tipo_solicitud'));
        }
        
        //dd($solicitudes);
        return view('administrador.solicitudes.remoto.index',compact('solicitudes','tipo_solicitud','tipo_solicitud','solicitudesP','esperaArl','rechazados','esperarh','formalizacion'));
    }
    public function historico(){
        
         $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud();
         $solicitudes=SolicitudTrabajoRemoto::where('pasar_arl','APROBADO')
            ->where('fecha_concepto','!=',null)
            ->orderBy('created_at','asc')
            ->get();
         return view('administrador.solicitudes.remoto.arl',compact('solicitudes','tipo_solicitud'));
        
    }
    
    public function tramite()
    {
        //FORMATOS RECHAZADOS
        $solicitudes=SolicitudTrabajoRemoto::where('estado',"!=","FORMATOS RECHAZADOS");
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud();
        //dd($solicitudes);
        return view('administrador.solicitudes.remoto.index',compact('solicitudes','tipo_solicitud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conceptoArl(Request $request,$id)
    {
        $solicitud = SolicitudTrabajoRemoto::findOrFail($id);
        //marca de trabajo
        if(empty($solicitud->id_teletrabajo) ||  $solicitud->id_teletrabajo ==  auth()->user()->id){
            $solicitud->id_teletrabajo =  auth()->user()->id;
            $solicitud->save();
        }else{
            Session::flash('message', 'OTRO USUARIO ESTA EMITIENDO EL CONCEPTO!');
            return Redirect::back();
        }
        
        
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        $viabilidad=SolicitudUsuarioSoporte::tipo_viabilidad_remoto();
        return view('administrador.solicitudes.remoto.conceptoArl',compact('solicitud','tipo_solicitud','viabilidad'));
        
    }
    
    public function nuevoConceptoArl(Request $request,$id)
    {
        $solicitud = SolicitudTrabajoRemoto::findOrFail($id);
        //marca de trabajo
        /*if(empty($solicitud->id_teletrabajo) ||  $solicitud->id_teletrabajo ==  auth()->user()->id){
            $solicitud->id_teletrabajo =  auth()->user()->id;
            $solicitud->save();
        }else{
            Session::flash('message', 'OTRO USUARIO ESTA EMITIENDO EL CONCEPTO!');
            return Redirect::back();
        }*/
        
        
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        $viabilidad=SolicitudUsuarioSoporte::tipo_viabilidad_remoto();
        return view('administrador.solicitudes.remoto.resubirConcepto',compact('solicitud','tipo_solicitud','viabilidad'));
        
    }
    
    public function saveConceptoArl(Request $request,$id)
    {
         // dd($request);
        
      /*  $extensionlista= pathinfo($_FILES["lista"]['name'], PATHINFO_EXTENSION);
        $extensiondocumento_concepto= pathinfo($_FILES["documento_concepto"]['name'], PATHINFO_EXTENSION);
        //dd($extensionformalizacion);
        
         $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extensionlista, $formatos_permitidos) || !in_array($extensiondocumento_concepto, $formatos_permitidos)) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
            */
        /*$tamlista= intval($_FILES["lista"]["size"]);
        
        $totallista= ($tamlista)/1000000;
        
        if ($totallista > 9.9) {
            //dd('hola1',$total);
           Session::flash('message',  "Documentos Superan el Tamaño Permitido, debe ser máximo 10 MB");
           return Redirect::back();
        }
        
        $tamdocumento_concepto= intval($_FILES["documento_concepto"]["size"]);
        
        $totaldocumento_concepto= ($tamdocumento_concepto)/1000000;
        
        if ($totaldocumento_concepto > 9.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tamaño Permitido, debe ser máximo 10 MB");
           return Redirect::back();
        }*/
            
       //dd($request->all()); 
       if(!empty($request->file('lista'))){
        $file = $request->file('lista');
        $documento = $_FILES["lista"]["name"];
        $extension= pathinfo($_FILES["lista"]['name'], PATHINFO_EXTENSION);
        $nombrelista =$request['funcionario_identificacion']." - LISTA ARL ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombrelista, \File::get($file));
        }else{
            $nombrelista=null;
        }
        
        if(!empty($request->file('documento_concepto'))){
        $file = $request->file('documento_concepto');
        $documento = $_FILES["documento_concepto"]["name"];
        $extension= pathinfo($_FILES["documento_concepto"]['name'], PATHINFO_EXTENSION);
        $nombredocumento_concepto =$request['funcionario_identificacion']." - CONCEPTO ARL ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombredocumento_concepto, \File::get($file));
        }else{
            $nombredocumento_concepto=null;
        }
        
        //definir estado
        if($request['viabilidad'] == "SI"){
            $ESTADO="APROBADO Y EN ESPERA DE FORMALILZACION";
        }else{
           $ESTADO="DENEGADO"; 
        }
        
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->fecha_concepto = $request['fecha_concepto'];
        $registro->viabilidad = $request['viabilidad'];
        $registro->concepto_arl = $request['concepto_arl'];
        $registro->lista = $nombrelista;
        $registro->documento_concepto = $nombredocumento_concepto;
        $registro->estado = $ESTADO;
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "CONCEPTO ARL :".Carbon::now();
        
        $registro->logs_de_acciones = $logs . " "."SE CARGA CONCEPTO ARL".Carbon::now()->toTimeString();
        $registro->save();
        
        //dd($registro);
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        
        Session::flash('message', 'Concepto Almacenado Con Exito!');
        return Redirect::to('administrador/solicitud/trabajo/remoto');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function definirSolicitud(Request $request,$id)
    {
       // dd($request->all());
        $solicitud = SolicitudTrabajoRemoto::findOrFail($id);
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        $viabilidad=SolicitudUsuarioSoporte::tipo_viabilidad_remoto();
        $estado=SolicitudUsuarioSoporte::estado();
        return view('administrador.solicitudes.remoto.definirSolicitud',compact('solicitud','tipo_solicitud','viabilidad','estado'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function definirEstadoSolicitud(Request $request,$id)
    {
        //dd($request->all());
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->estado = $request['estado'];
        $registro->observaciones = $request['observaciones'];
        
        $registro->logs_de_acciones = $logs . " "."DEFINEN ESTADO DE SOLICITUD".Carbon::now()->toTimeString();
        $registro->save();
        
        Session::flash('message', 'ESTADO DE PETICION ACTUALIZADA!');
        return Redirect::to('administrador/solicitud/trabajo/remoto');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function definirEstado(Request $request, $id)
    {
        $solicitud = SolicitudTrabajoRemoto::findOrFail($id);
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        $viabilidad=SolicitudUsuarioSoporte::tipo_viabilidad_remoto();
        return view('administrador.solicitudes.remoto.trasladarArl',compact('solicitud','tipo_solicitud','viabilidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SaveEstadoSolicitud(Request $request, $id)
    {
     // dd($request->all());
       $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->estado="FORMATOS RECHAZADOS";
        $registro->pasar_arl = $request['pasar_arl'];
        $registro->concepto_talento_humano = $request['concepto_talento_humano'];
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "FORMATOS RECHAZADOS :".Carbon::now();
        
        $registro->logs_de_acciones = $logs . " "."SE EMITE REGISTRO DE RECHAZO". $request['pasar_arl'].$request['concepto_talento_humano'] .Carbon::now()->toTimeString();
        $registro->save();
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        
        Session::flash('message', 'ESTADO DE PETICION RECHAZADA!');
        return Redirect::to('administrador/solicitud/trabajo/remoto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SaveAprobarSolicitud(Request $request, $id)
    {
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->estado="EN ESPERA CONCEPTO ARL";
        $registro->pasar_arl = 'APROBADO';
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "EN ESPERA CONCEPTO ARL :".Carbon::now();
        $registro->logs_de_acciones = $logs . " "."SE EMITE REGISTRO DE APROBACION".Carbon::now()->toTimeString();
        $registro->save();
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->to($correoDespacho);
            $message->cc("coordtecnica.rama@positiva.gov.co");
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        //dd($registro);
        Session::flash('message', 'FORMATOS APROBADOS!');
        return Redirect::back();
        //
    }
    
    public function ReenviarCorreo(Request $request, $id)
    {
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->to("coordtecnica.rama@positiva.gov.co");
            $message->cc("siriscali@cendoj.ramajudicial.gov.co");
            if(!empty($correoFuncionario)){
                //$message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        //dd($registro);
        Session::flash('message', 'Reenvio de correo!');
        return Redirect::back();
        //
    }
    
    public function SolicitudTrabajo_Remoto(){
        //$despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
       
        //$solicitudes=SolicitudTrabajoRemoto::where('id_despacho', auth()->user()->cedula)->get();
       // $tipo_usuarios =SolicitudUsuarioSoporte::tipo_usuario();
        
        //$tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud_remoto();
        
        //distinct("funcionario_identificacion")
        $solicitudes=SolicitudTrabajoRemoto::all();
        //$solicitudes=SolicitudTrabajoRemoto::select('id','funcionario_identificacion','funcionario_nombre','funcionario_apellido','solicitud','anuencia','formalizacion','estado','observaciones','concepto_arl')->get();
        //dd($solicitudes);
        return view('administrador.solicitudes.remoto.SubirRemoto',compact('solicitudes'/*,'tipo_solicitud','tipo_usuarios','despachos'*/));
        
    }
    
    public function SolicitudSave(Request $request){
        // dd($request->all());
        
        $user = User::where('cedula',$request['despacho'])->first();
        
        //dd($user,$request->all(),$request->file('solicitud'),$request->file('anuencia'));
       
       
       $registro = SolicitudTrabajoRemoto::where('funcionario_identificacion',$request['funcionario_identificacion'])->first();
       
       if(!empty( $registro)){
          // if($registro->estado =="FORMATOS EN ESPERA DE REVISION DE R.H"){
               Session::flash('message', 'Su Solicitud No Se Puede Realizar, Elimine el registro y vuelva a cargar nuevamente ');
               return redirect()->back();
               
          // }
       }
       
       $extensionsolicitud= pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION);
       
       
        
        
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
        $nombresolicitud =$request['funcionario_identificacion']."-SOLICITUD". $request['despacho']."-".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombresolicitud, \File::get($file));
        }else{
            $nombresolicitud=null;
        }
        
        if(!empty($request->file('anuencia'))){
        $file = $request->file('anuencia');
        $documento = $_FILES["anuencia"]["name"];
        $extension= pathinfo($_FILES["anuencia"]['name'], PATHINFO_EXTENSION);
        $nombreanuencia =$request['funcionario_identificacion']."-ANUENCIA".$request['despacho']."-".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreanuencia, \File::get($file));
        }else{
            $nombreanuencia=null;
        }
          $correoDespacho= $user->email; 
          $idUser = $user->cedula;
      //dd($correoDespacho);
        
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
        'estado_solicitud'=> "FORMATOS EN ESPERA DE REVISION DE R.H",
       
        ]);
        
        Session::flash('message', 'Solicitud de Teletrabajo registrada con Exito.');
        return redirect()->route('manual.solicitud.trabajo.remoto');
        
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
        $nombreanuencia =$request['funcionario_identificacion']."-ANUENCIA". $request['despacho']."-".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreanuencia, \File::get($file));
        }else{
            $nombreanuencia=null;
        }
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->anuencia = $nombreanuencia;
        $registro->concepto_talento_humano = NULL;
        $registro->pasar_arl = NULL;
        $registro->logs_de_acciones = $logs . " "."SE CARGA ANUENCIA MANUAL".Carbon::now();
        $registro->estado = "FORMATOS EN ESPERA DE REVISION DE R.H";
        //'fecha_concepto',
        //'viabilidad',
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "SE CARGA ANUENCIA MANUAL :".Carbon::now();
        $registro->estado_solicitud= "FORMATOS EN ESPERA DE REVISION DE R.H";
        $registro->save();
        
        
        Session::flash('message', 'Se carga Anuencia!');
        return redirect()->route('manual.solicitud.trabajo.remoto');
        
    }
    
     public function SubirSolicitudTrabajoRemoto(Request $request,$id){
        
        //dd($request->all(),$request->file('solicitud'));
        $formatos_permitidos =  array('pdf','PDF');
        $extensionsolicitud= pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION);
            
           if(!in_array($extensionsolicitud, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            } 
            
        if(!empty($request->file('solicitud'))){
        $file = $request->file('solicitud');
        $documento = $_FILES["solicitud"]["name"];
        $extension= pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION);
        $nombresolicitud =$request['funcionario_identificacion']."-SOLICITUD". $request['despacho']."-".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombresolicitud, \File::get($file));
        }else{
            $nombresolicitud=null;
        }
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        $logs= $registro->logs_de_acciones;
        $registro->solicitud = $nombresolicitud;
        $registro->concepto_talento_humano = NULL;
        $registro->pasar_arl = NULL;
        $registro->logs_de_acciones = $logs . " "."SE CARGA SOLICITUD MANUAL".Carbon::now();
        $registro->estado = "FORMATOS EN ESPERA DE REVISION DE R.H";
        //'fecha_concepto',
        //'viabilidad',
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "SE CARGA SOLICITUD MANUAL :".Carbon::now();
        $registro->estado_solicitud= "FORMATOS EN ESPERA DE REVISION DE R.H";
        $registro->save();
        
        
        Session::flash('message', 'Se carga Solicitud!');
        return redirect()->route('manual.solicitud.trabajo.remoto');
        
    }
    
     public function SubirFormalizacionTrabajoRemoto(Request $request,$id){
        
        //dd($request->all(),$request->file('solicitud'),$id);
        $formatos_permitidos =  array('pdf','PDF');
        $extensionformalizacion= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
            
           if(!in_array($extensionformalizacion, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            } 
        //dd($request->file('formalizacion'));
        
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
            
        if(!empty($request->file('formalizacion'))){
        $file = $request->file('formalizacion');
        $documento = $_FILES["formalizacion"]["name"];
        $extension= pathinfo($_FILES["formalizacion"]['name'], PATHINFO_EXTENSION);
        $nombreformalizacion =$registro->funcionario_identificacion."-FORMALIZACION". $request['despacho']."-".Carbon::now()->toDateTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombreformalizacion, \File::get($file));
        }else{
            $nombreformalizacion=null;
        }
        
        $logs= $registro->logs_de_acciones;
        $registro->formalizacion = $nombreformalizacion;
        //$registro->concepto_talento_humano = NULL;
        $registro->logs_de_acciones = $logs . " "."SE CARGA FORMALIZACION  MANUAL".Carbon::now();
        $registro->estado = "APROBADO";
        //'fecha_concepto',
        //'viabilidad',
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "SE CARGA FORMALIZACION MANUAL :".Carbon::now();
        //$registro->estado_solicitud= "APROBADO";
        $registro->save();
        
        
        Session::flash('message', 'Se carga Formalizacion!');
        return redirect()->route('manual.solicitud.trabajo.remoto');
        
    }
    
    public function  RecargaConceptoArl(Request $request,$id)
    {
     
            
       //dd($request->all()); 
       
       
        $registro = SolicitudTrabajoRemoto::findOrFail($id);
        
       if(!empty($request->file('lista'))){
        $file = $request->file('lista');
        $documento = $_FILES["lista"]["name"];
        $extension= pathinfo($_FILES["lista"]['name'], PATHINFO_EXTENSION);
        $nombrelista =$request['funcionario_identificacion']." - LISTA ARL ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombrelista, \File::get($file));
        
        $registro->lista = $nombrelista;
        }else{
            
        }
        
        if(!empty($request->file('documento_concepto'))){
        $file = $request->file('documento_concepto');
        $documento = $_FILES["documento_concepto"]["name"];
        $extension= pathinfo($_FILES["documento_concepto"]['name'], PATHINFO_EXTENSION);
        $nombredocumento_concepto =$request['funcionario_identificacion']." - CONCEPTO ARL ". $request['despacho']." -  ".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('remoto')->put($nombredocumento_concepto, \File::get($file));
        }else{
            $nombredocumento_concepto=null;
        }
        
        //definir estado
        if($request['viabilidad'] == "SI"){
            $ESTADO="APROBADO Y EN ESPERA DE FORMALILZACION";
        }else{
           $ESTADO="DENEGADO"; 
        }
        
        
        $logs= $registro->logs_de_acciones;
        $registro->fecha_concepto = $request['fecha_concepto'];
        $registro->viabilidad = $request['viabilidad'];
        $registro->concepto_arl = $request['concepto_arl'];
        
        $registro->documento_concepto = $nombredocumento_concepto;
        //$registro->estado = $ESTADO;
        $segui =$registro->seguimiento;
        $registro->seguimiento =$segui."     ". "CONCEPTO ARL :".Carbon::now();
        
        $registro->logs_de_acciones = $logs . " "."SE CARGA CONCEPTO ARL".Carbon::now()->toTimeString();
        $registro->save();
        
        //dd($registro);
        
        $data              =  json_decode(json_encode($registro), true); 
        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.ConfirmacionRemoto',$data, function ($message) use ($correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Novedad de Registro Solicitud Teletrabajo');
                                        
        });
        
        Session::flash('message', 'Concepto Almacenado Con Exito!');
        return Redirect::to('administrador/solicitud/trabajo/remoto');
        
    }
    
    public function SubirDesistimientoRemoto(Request $request,$id){
        
        
        
       // DB::beginTransaction();
        try{
            $registro = SolicitudTrabajoRemoto::findOrFail($request->id);
            
            
            
            $formatos_permitidos =  array('pdf','PDF');
            $extensionformalizacion= pathinfo($_FILES["desistimiento"]['name'], PATHINFO_EXTENSION);
            
           if(!in_array($extensionformalizacion, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["solicitud"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            } 
            
                
            if(!empty($request->file('desistimiento'))){
            $file = $request->file('desistimiento');
            $documento = $_FILES["desistimiento"]["name"];
            $extension= pathinfo($_FILES["desistimiento"]['name'], PATHINFO_EXTENSION);
            $nombredesistimiento =$registro->funcionario_identificacion."DESISTIMIENTO". $request['despacho'].Carbon::now()->toDateTimeString().".".$extension;
            \Storage::disk('remoto')->put($nombredesistimiento, \File::get($file));
            }else{
                $nombredesistimiento=null;
            }
            
            $logs= $registro->logs_de_acciones;
            $registro->desistimiento = $nombredesistimiento;
            //$registro->concepto_talento_humano = NULL;
            $registro->logs_de_acciones = $logs . " "."SE CARGA DESISTIMIENTO  MANUAL".Carbon::now();
            $registro->estado = "DESISTIMIENTO";
            //'fecha_concepto',
            //'viabilidad',
            $segui =$registro->seguimiento;
            $registro->seguimiento =$segui."     ". "SE CARGA DESISTIMIENTO MANUAL :".Carbon::now();
            //$registro->estado_solicitud= "APROBADO";
            //dd($registro,$nombredesistimiento,$documento);
            $registro->save();
        
        
         //DB::commit();
         
         Session::flash('error', 'Se Sube Desistimiento!');
        //return Redirect::back();
        return redirect()->route('manual.solicitud.trabajo.remoto');
         
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
        
    }
    
    public function seguimientoTeletrabajo(Request $request){
        
        $meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO','04'=>'ABRIL','05'=>'MAYO','06' => 'JUNIO', '07' => 'JULIO',
   '08' => 'AGOSTO','09'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $fecha=Carbon::Now();
       // $dia_semana=$fecha->dayOfWeek;
       $mes = $fecha->month;
       $fecha = '2024-0'.$mes;
       //dd($fecha);
       $resultado = SeguimientoPresencialidad::where('fecha_registro_asistencia','like',$fecha.'-%')->get();
       // ->groupBy('codigoDespacho_id');
        //->orderBy('created_at','ASC');
       //dd($resultado,$fecha);
       
       return view('administrador.solicitudes.teletrabajo.Index',compact('resultado','meses'));
        
    }
    
     public function solicitudesTeletrabajo(Request $request){
       $resultado = Teletrabajo2024::orderBy('codigo_despacho','ASC')->get();
       // ->groupBy('codigoDespacho_id');
        //->orderBy('created_at','ASC');
       //dd($resultado);
       
       return view('administrador.solicitudes.teletrabajo.Solicitudes',compact('resultado'));
        
    }
    
    public function EditarTeletrabajo(Teletrabajo2024 $Teletrabajo2024){
        //dd($Teletrabajo2024);
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        return view('administrador.solicitudes.teletrabajo.EditarSolicitud',compact('Teletrabajo2024','despachos'));
    }
    
    public function UpdateTeletrabajo(Request $request,Teletrabajo2024 $Teletrabajo2024){
        //dd($request->all());
        
        if(!empty($request->dias_teletrabajo)){
         $dias = implode(' ', $request->dias_teletrabajo);   
        }
        
        
        //$dias = implode(' ', $request->dias_teletrabajo);
        //dd($dias,$request->input(),$Teletrabajo2024->id);
        try{
            
        $despacho= Despacho::findOrFail($request->codigo_despacho);
        
        $teletrabajo = Teletrabajo2024::findOrFail($Teletrabajo2024->id);
        $teletrabajo->despacho = $despacho->nombreDespacho;
        if(!empty($request->dias_teletrabajo)){
        $teletrabajo->dias_teletrabajo = $dias;
        }
        $teletrabajo->codigo_despacho = $Teletrabajo2024->codigo_despacho;
        $teletrabajo->identificacion = $Teletrabajo2024->identificacion;
        $teletrabajo->nombre_servidor = $Teletrabajo2024->nombre_servidor;
        $teletrabajo->cargo = $Teletrabajo2024->cargo;
        $teletrabajo->nombre_servidor = $Teletrabajo2024->nombre_servidor;
        $teletrabajo->save();
            
            
        
        
        /*$Teletrabajo2024->despacho = $despacho->nombreDespacho;
        $Teletrabajo2024->dias_teletrabajo = $dias;
            
        $Teletrabajo2024->update($request->input());*/
        
        Session::flash('message', 'Informacion actualizada!  '.$Teletrabajo2024->nombre_servidor );
        return redirect()->route('admin.solicitudes.teletrabajo.registro');
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
    }
    
    
         //DESCARGAR FACTURA DE CUMPLIMIENTO
   public function SeguimientoExcel(Request $request){
       
       $fecha=Carbon::Now();
       // $dia_semana=$fecha->dayOfWeek;
       $mes = $fecha->month;
       $fecha = '2024-0'.$mes;
       //dd($request->mes);

        if(empty($request->all())){
            $solicitudes = SeguimientoPresencialidad::select('codigo_despacho_r','despacho_r','identificacion','nombre_servidor', 'cargo','teletrabajo','novedad','fecha_registro_asistencia')
            ->where('fecha_registro_asistencia','like',$fecha.'-%')
            ->get();
        }else{
            $fechaD = '2024-'.$request->mes;
            //dd($fechaD);
            $solicitudes = SeguimientoPresencialidad::select('codigo_despacho_r','despacho_r','identificacion','nombre_servidor', 'cargo','teletrabajo','novedad','fecha_registro_asistencia')
            //->where('id_despacho',$request->despacho)
            ->where('fecha_registro_asistencia','like',$fechaD.'-%')
            ->get();
        }
        
        if($solicitudes->isEmpty()){
          Session::flash('error', 'No hay registros disponibles en ese mes!');
            return Redirect::back();  
        }
        


        //dd($notificaciones);

        return (new SeguimientoPresencialidadExport($solicitudes))->download('Teletrabajo_2024.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    
    
    
    
    

}
