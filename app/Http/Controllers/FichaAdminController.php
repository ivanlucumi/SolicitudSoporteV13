<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FichaPreliminar;
use App\Models\Despacho;
use App\Models\User;
use App\Models\DespachoHistorial;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class FichaAdminController extends Controller
{
    //

    public function __construct()
    {
        
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        $this->middleware('fichas');
    }
    
    public function index(Request $request){
        
        $tipos =  auth()->user()->ficha_preliminar;
        $separador = ",";
        $Visualizar_solicitudes = explode($separador, $tipos);
        
       //dd($Visualizar_solicitudes);
       if( auth()->user()->email == "recospacali@cendoj.ramajudicial.gov.co"){
           $fichas = FichaPreliminar::where('acta_reparto',null)
            ->orderby('fecha_solicitud','ASC')
            ->get();
       }else{
          $fichas = FichaPreliminar::whereIn('tipo_solicitud',$Visualizar_solicitudes)
           ->where('acta_reparto',null)
            ->orderby('fecha_solicitud','ASC')
            ->get(); 
       }
            
            
        
        //$fichas = FichaPreliminar::all();
        //dd($request->ip(),$fichas,$Visualizar_solicitudes);
        $tipoAudiencia = FichaPreliminar::tipoAudiencia();
        return view('fichaRemision.Preliminar.Ficha',compact('fichas','tipoAudiencia'));
        
    }
      
    public function cambiarTipo(Request $request){
        
         //DB::beginTransaction();
        try{ 
        
            $tipo = FichaPreliminar::findOrFail($request->id);
            $observ = $tipo->observaciones;
            
        if(empty($tipo->id_usuario_atiende) ||  $tipo->id_usuario_atiende ==  auth()->user()->id){
            
            $tipo->tipo_solicitud = $request->tipo_solicitud;
            $tipo->observaciones = $observ. "  ".Carbon::now()->toDateTimeString()." ". auth()->user()->name ." ". auth()->user()->lastname.":".$request->observaciones.".    ";
            $tipo->id_usuario_cambia_solicitud =  auth()->user()->id;
            $tipo->usuario_cambia_solicitud =  auth()->user()->name ." ". auth()->user()->lastname;
            $tipo->id_usuario_atiende = NULL;
            
            $tipo->save();
        }else{
            Session::flash('message', 'NO SE PUEDE REALIZAR CAMBIO, ESTA EN PROCESO POR OTRO USUARIO!');
            return Redirect::back();
        }
        
        $tipo->id_usuario_cambia= auth()->user()->name ." ". auth()->user()->lastname;
        
        $data              =  json_decode(json_encode($tipo), true);
        
        $notificacion = User::where('ficha_preliminar','LIKE','%'.$request->tipo_solicitud.'%')
        ->select('email')
        ->first();
        
        //dd($notificacion,$notificacion->email);
        $asunto = "Notificacion de Cambio de Tipo Solicitud ";
        
        $anexo =$tipo->anexos;
        $correoNotificacion = $tipo->email_notificacion;
        $email_noti=str_replace(" ", "",$notificacion->email);
        $responsable = auth()->user()->email;
        $email_historico ="avargasmo@cendoj.ramajudicial.gov.co";
        //  auxrecospa02cali@cendoj.ramajudicial.gov.co
            
        
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CambioTipoSolicitud',
            $data,
            $responsable,
            null,
            $asunto,
            []
        );
            
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CambioTipoSolicitud',
            $data,
            $email_historico,
            null,
            $asunto,
            []
        );
            
            
         if($tipo->tipo_solicitud =='AUDIENCIA GARANTIAS ACTOS URGENTES'){ 
             
                $text = "<b>Cambio de Tipo Solicitud de Audiencia:</b>:\n"
                            . "<b>Quien Solicita: </b>\n"
                            . "$tipo->quien_solicita\n"
                            . "<b>Radicacion: </b>\n"
                            . "$tipo->numero_radicado_proceso\n"
                            . "<b>Tipo Solicitud: </b>\n"
                            . "$tipo->tipo_solicitud\n"
                            . "<b>Fecha Solicitud : </b>\n"
                            . "$tipo->fecha_solicitud";
                            Telegram::sendMessage([
                                                'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001666229135'),
                                                'parse_mode' => 'HTML',
                                                'text' => $text
                                        ]);
                                        
                \App\Services\CorreoService::encolarYEnviar(
                    $tipo->id,
                    'emails/fichas/CambioTipoSolicitud',
                    $data,
                    'saspacali@cendoj.ramajudicial.gov.co',
                    null,
                    $asunto,
                    []
                );
         }
         
         if($tipo->tipo_solicitud !='AUDIENCIA GARANTIAS ACTOS URGENTES'){ 
             
             \App\Services\CorreoService::encolarYEnviar(
                    $tipo->id,
                    'emails/fichas/CambioTipoSolicitud',
                    $data,
                    $email_noti,
                    'auxrecospa02cali@cendoj.ramajudicial.gov.co',
                    $asunto,
                    []
                );
         
         }
        
         //DB::commit();
         
        Session::flash('error', 'Se cambio Tipo Solicitud!');
        return Redirect::back();
         
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        Session::flash('error', 'Se cambio Tipo Solicitud!');
        return Redirect::back();
            
    }
    
    public function solicitud(Request $request,$id){
        
       if(empty($remision->id_usuario_atiende) ||  $remision->id_usuario_atiende ==  auth()->user()->id){
           $ficha = FichaPreliminar::findOrFail($id); 
           $ficha->id_usuario_atiende =  auth()->user()->id;
           $ficha->save();
        }else{
            Session::flash('message', 'OTRO USUARIO ESTA DANDO RESPUESTA AL CONCEPTO!');
            return Redirect::back();
        }
    
       $despachos = Despacho::orderby('nombreDespacho','ASC')->pluck('nombreDespacho','codigoDespacho');
       
       $tipoAudiencia = FichaPreliminar::tipoAudiencia();
       //dd($ficha);
       return view('fichaRemision.Preliminar.Responder',compact('ficha','tipoAudiencia','despachos'));
    }
    
    public function remitirSolicitud(Request $request,$id){
        
       
       //DB::beginTransaction();
        try{  
            
            $despacho = Despacho::where('CodigoDespacho',$request->despacho_reparto)
        ->select('nombreDespacho','correoD')
        ->first();
        
        //dd($request->All(),$despacho);
            
        $nombredoc = $_FILES["acta_reparto"]["name"];
        
        $separador = ".";
        $separada1 = explode($separador, $nombredoc);
        
        $documento =$request->numero_radicado_proceso." ACTA REPARTO ".Carbon::now()->toDateTimeString().".pdf"/*".".$separada1[1]*/;
         //validacion de tama単o de Documentos
        $tamDemanda= intval($_FILES["acta_reparto"]["size"]);
        
        if($tamDemanda > 0 || $tamDemanda < 3.9){
            //dd('hola1');
           \Storage::disk('fichapreliminar')->put($documento, \File::get($request->file('acta_reparto')));
           
        }else{
          Session::flash('error', 'Verifique el Peso del Documento!');
            return Redirect::back();  
        }
        
        $tipo = FichaPreliminar::findOrFail($id);
        //dd($tipo,$request->despacho_reparto);
        
        if(!empty($tipo->acta_reparto)){
           Session::flash('message', 'ESTA RADICACION YA FUE REPARTIDA!');
            return Redirect::back(); 
        }
        
        
         $nombre = auth()->user()->name ." ". auth()->user()->lastname;
        
        $tipo->acta_reparto = $documento;
        $tipo->id_despacho_reparto = $request->despacho_reparto;
        $tipo->despacho_reparto = $despacho->nombreDespacho;
        $tipo->observaciones_reparto = $request->observaciones_reparto;
        $tipo->nombre_usuario_atiende = $nombre;
        $tipo->fecha_solucion = Carbon::now()->toDateTimeString();
        $tipo->fecha_reparto = Carbon::now()->toDateTimeString();
        
        
        $tipo->save();
        
        $anexo= $tipo->anexos;
        
         $data              =  json_decode(json_encode($tipo), true);
        
        

        $asunto = $despacho->nombreDespacho."  REPARTO REALIZADO ";
        
        //dd($reporte);
        
        $correoDes = str_replace(" ", "",$despacho->correoD);
        $correoNotificacion = $tipo->email_notificacion;
        $responsable = auth()->user()->email;
        $email_historico ="avargasmo@cendoj.ramajudicial.gov.co";
        $email_historico2 ="yordoneg@cendoj.ramajudicial.gov.co";
        
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            'soportesiris@outlook.com',
            null,
            $asunto,
            []
        );

        
        // Lista de correos a los que NO se debe enviar notificación en copia
        $correosBloqueados = [
            'pctoes01cali@cendoj.ramajudicial.gov.co',
            'pctoes02cali@cendoj.ramajudicial.gov.co',
            'pctoes03cali@cendoj.ramajudicial.gov.co',
            'pctoes04cali@cendoj.ramajudicial.gov.co',
            'pctoes05cali@cendoj.ramajudicial.gov.co',
            'j06pctoespcali@cendoj.ramajudicial.gov.co',
        ];
        
        $correoDes = strtolower(trim($correoDes));
        $cc_array = [];
        if (!in_array($correoDes, $correosBloqueados)) {
            $cc_array[] = $correoDes;
        }

        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            $responsable,
            $cc_array,
            $asunto,
            []
        );
        
        
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            $email_historico,
            null,
            $asunto,
            []
        );
         
            
        
        
             // Define allowed solicitud types
        $allowedTypes = [
            'PRESENTACION ESCRITO ACUSACION',
            'PRESENTACION PRECLUSION',
            'PRESENTACION IPS',
            'PRESENTACION PREACUERDO'
        ];
        
        $tipoSolicitud = strtoupper($request->tipo_solicitud); //auxrecospa02cali@cendoj.ramajudicial.gov.co

        // Check if the type is in the allowed array
        if (in_array($tipoSolicitud, $allowedTypes)) {
            \App\Services\CorreoService::encolarYEnviar(
                $tipo->id,
                'emails/fichas/CorreoFichaDespacho',
                $data,
                'recospacali@cendoj.ramajudicial.gov.co',
                null,
                $asunto,
                []
            );
            
        }
        
         \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFicha',
            $data,
            $correoNotificacion,
            'soportesiris@outlook.com',
            $asunto,
            []
        );
            
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            $email_historico2,
            null,
            $asunto,
            []
        );
           
         //DB::commit();
         Session::flash('success', 'Se Remitio solicitud con Exito!');
        return redirect()->route('adminfichas.index');
         
         
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        Session::flash('success', 'Se Remitio solicitud con Exito!');
        return redirect()->route('adminfichas.index');
      
            
    }
    
    
    
    
     public function historicos(Request $request){
         if(!empty($request->all())){
            //dd($request->radicado);
            $fichas = FichaPreliminar::where('id_despacho_reparto','!=',NULL)
            ->radicado($request->radicado)
            ->procesado($request->procesado)
            ->fecha($request->fecha_reparto)
            ->orderby('fecha_solucion','DESC')
            ->get();
            
            //dd($fichas);
            
        }else{
            $fichas = FichaPreliminar::where('id_despacho_reparto','!=',NULL)
            ->where('acta_reparto','!=',NULL)
             ->orderby('fecha_solucion','DESC')
             ->paginate(1000); 
             //dd($fichas);
        }
         
         //dd($fichas, auth()->user()->id);
         $tipoAudiencia = FichaPreliminar::tipoAudiencia();
         $historico = null;
         return view('fichaRemision.Preliminar.Historico',compact('fichas','tipoAudiencia','historico'));
        
    }
    
     public function misRegistros(Request $request){
         if( auth()->user()->email == "yordoneg@cendoj.ramajudicial.gov.co"){
           $fichas = FichaPreliminar::where('id_usuario_atiende','!=',null)
           ->where('fecha_solucion','>=', Carbon::now()->subDays(30))
            //->latest()  // Ordenar por fecha más reciente
           // ->take(1000) // Traer solo 1000 registros
            ->get();
           // dd($fichas);
         }else{
         $fichas = FichaPreliminar::where('id_usuario_atiende', auth()->user()->id)
         ->orderby('fecha_solucion','DESC')
         ->get(); }
         //dd($fichas, auth()->user()->id);
         $tipoAudiencia = FichaPreliminar::tipoAudiencia();
         $historico = null;
         return view('fichaRemision.Preliminar.MisRegistros',compact('fichas','tipoAudiencia','historico'));
        
    }
    
    
    //REENVIAR SOLICITUD DE CORREO
    public function remitirSolicitudReenvio(Request $request,$id){
         DB::beginTransaction();
        try{
        
        
        $nombre = auth()->user()->name ." ". auth()->user()->lastname;
        
        $tipo = FichaPreliminar::findOrFail($id);
        
        $despacho = Despacho::where('CodigoDespacho',$tipo->id_despacho_reparto)
        ->select('nombreDespacho','correoD')
        ->first();
        
        $anexo= $tipo->anexos;
        
         $data              =  json_decode(json_encode($tipo), true);
        
        

        $asunto = " RV: ".$despacho->nombreDespacho."Reparto Realizado ";
        
        //dd($reporte);
        
        $correoDes = str_replace(" ", "",$despacho->correoD);
        $correoNotificacion = $tipo->email_notificacion;
        $responsable = auth()->user()->email;
        $email_historico ="avargasmo@cendoj.ramajudicial.gov.co";
        
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            'auxrecospa02cali@cendoj.ramajudicial.gov.co',
            null,
            $asunto,
            [
                "/home/disajcal/public_html/fichaPreliminar/" . $documento,
                "/home/disajcal/public_html/fichaPreliminar/" . $anexo
            ]
        );
            
        
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            $responsable,
            $correoDes,
            $asunto,
            [
                "/home/disajcal/public_html/fichaPreliminar/" . $documento,
                "/home/disajcal/public_html/fichaPreliminar/" . $anexo
            ]
        );
        
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFichaDespacho',
            $data,
            $email_historico,
            null,
            $asunto,
            [
                "/home/disajcal/public_html/fichaPreliminar/" . $documento,
                "/home/disajcal/public_html/fichaPreliminar/" . $anexo
            ]
        );
         
            
        \App\Services\CorreoService::encolarYEnviar(
            $tipo->id,
            'emails/fichas/CorreoFicha',
            $data,
            $correoNotificacion,
            null,
            $asunto,
            [
                "/home/disajcal/public_html/fichaPreliminar/" . $documento,
                "/home/disajcal/public_html/fichaPreliminar/" . $anexo
            ]
        );
        
        
         DB::commit();
         
         Session::flash('success', 'Se realizo Reenvio de Solicitud con Exito!');
        return Redirect::back();
         
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
      
            
    }
    
    
   /*public function despachoDisponible(){
       $despachos = Despacho::orderby('nombreDespacho','ASC')->get();
       $historial = DespachoHistorial::with('despacho', 'user')->latest()->take(10)->get();
       
        $fecha = Carbon::now(); // Puedes usar cualquier fecha
        $diaSemana = $fecha->dayOfWeek; // Devuelve un número: 0 (domingo) a 6 (sábado)
        $horaActual = $fecha->hour; //hora actual
        $nombreDia = $fecha->locale('es')->dayName; // Devuelve el nombre del día en español
        
        $diaSemana = $fecha->dayOfWeek; // 0 (domingo) a 6 (sábado)

        // Validar día laboral (lunes=1 a viernes=5)
        $esDiaLaboral = ($diaSemana >= 1 && $diaSemana <= 5);
        
        // Validar horario nocturno (8 PM a 8 AM)
        $esHorarioNocturno = ($horaActual >= 20 || $horaActual < 8);
        
        
        if($esDiaLaboral && $esHorarioNocturno){
            dd($esDiaLaboral,$esHorarioNocturno);
        }else{
          dd($fecha, $diaSemana,$horaActual,$nombreDia);  
        }
        
        //dd($diaSemana,$nombreDia,$historial,$despachos); 
       
       return view('fichaRemision.Preliminar.DespachoDisponible',compact('despachos','historial'));
   }*/
   
   public function despachoDisponible()
{
    $despachos = Despacho::whereRaw("(estado IS NULL OR LOWER(TRIM(estado)) != 'Inactivo')")
    ->where('nombreDespacho', 'LIKE', '%penal%')
    ->where('circuito', 'CALI')
    ->orderBy('nombreDespacho')
    ->get();
    $despachoActivo = Despacho::where('notificacion_ficha_remision', true)->first();
    $historial = DespachoHistorial::with(['despacho', 'user'])->latest()->take(20)->get();

    return view('fichaRemision.Preliminar.DespachoDisponible', compact('despachos', 'despachoActivo', 'historial'));
}

public function activar(Request $request)
{
    
    $request->validate([
        'despacho_id' => 'required|integer|exists:despachos,codigoDespacho'
    ]);

    $user =  auth()->user();
    $despachoId = $request->despacho_id;
    $despacho = Despacho::findOrFail($despachoId);

    // Verificar si el despacho ya está activo
    if (!$despacho->notificacion_ficha_remision) {
        // Solo desactivar los despachos que están actualmente activos
        $despachosActivos = Despacho::where('notificacion_ficha_remision', true)->get();

        foreach ($despachosActivos as $despachoActivo) {
            $despachoActivo->update(['notificacion_ficha_remision' => false]);
            
            //dd($despachoActivo->codigoDespacho,$despachosActivos);
            
            // Registrar historial de desactivación solo para los que estaban activos
            DespachoHistorial::create([
                'despacho' => $despachoActivo->nombreDespacho,
                'email' => $despachoActivo->correoD,
                'user_id' => $user->id,
                'accion' => 'desactivar'
            ]);
        }

        // Activar el nuevo despacho seleccionado
        $despacho->update(['notificacion_ficha_remision' => true]);

        // Registrar historial de activación
        DespachoHistorial::create([
            'despacho' => $despacho->nombreDespacho,
            'email' => $despacho->correoD,
            'user_id' => $user->id,
            'accion' => 'activar'
        ]);

        return redirect()->route('adminfichas.despacho.disponible')
                        ->with('success', 'Despacho activado correctamente');
    }

    return redirect()->route('adminfichas.despacho.disponible')
                    ->with('info', 'El despacho seleccionado ya está activo');
}

public function inactivar()
{
    $user =  auth()->user();
    
    // Desactivar todos los despachos
   $despachosActivos = Despacho::where('notificacion_ficha_remision', true)->get();

        foreach ($despachosActivos as $despachoActivo) {
            $despachoActivo->update(['notificacion_ficha_remision' => false]);
            
            //dd($despachoActivo->codigoDespacho,$despachosActivos);
            
            // Registrar historial de desactivación solo para los que estaban activos
            DespachoHistorial::create([
                'despacho' => $despachoActivo->nombreDespacho,
                'email' => $despachoActivo->correoD,
                'user_id' => $user->id,
                'accion' => 'desactivar'
            ]);
        }
    
    return redirect()->back()->with('info', 'Todos los despachos han sido desactivados');
}
    

        public function auditoriaCorreos(Request $request)
    {
        // Restricción: Solo permitir al correo específico
        if (auth()->user()->email !== 'yordoneg@cendoj.ramajudicial.gov.co') {
            return redirect()->route('adminfichas.index')->with('error', 'No tiene permisos para acceder a la auditoría de correos.');
        }

        $correos = \App\Models\RegistroCorreo::orderBy('created_at', 'desc')->paginate(50);
        return view('fichaRemision.Preliminar.CorreosAuditoria', compact('correos'));
    }

    public function reenviarCorreoAuditoria($id)
    {
        if (auth()->user()->email !== 'yordoneg@cendoj.ramajudicial.gov.co') {
            return redirect()->route('adminfichas.index')->with('error', 'No tiene permisos.');
        }

        $registro = \App\Models\RegistroCorreo::findOrFail($id);
        
        $exito = \App\Services\CorreoService::enviarDesdeRegistro($registro);

        if ($exito) {
            return redirect()->back()->with('success', 'El correo fue reenviado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'El correo volvió a fallar. Revise el mensaje de error.');
        }
    }
}
