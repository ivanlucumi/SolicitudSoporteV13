<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Validator;


use App\Models\FichaRemision;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\OficinasReparto;
use App\Models\GrupoReparto;
use App\Models\OficinaJudicialReparto;
use App\Models\OperarioReparto;
use App\Models\User;
use App\Models\Despacho;



use Auth;


class OficinaJudicialRepartoController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        //$this->middleware('Reparto');
        
    }
    
    public function Noticias(){
        
         return view('usuario.reparto.Noticias');
    }
    
    //VENTANILLA VIRTUAL
    public function oficina(Request $request){
        
       
       
        $operariosR= User::where('rol',16)->get()->pluck('full_name','id');
       /*dd($operariosR);
        if( auth()->user()->rol == 15){
        $repartos = OficinaJudicialReparto::where('acta_reparto',NULL)
        ->where('asignado_a', NULL)
        ->where('OficinaReparto', auth()->user()->oficina_reparto)->orderby('fecha_recibido','ASC')->get();
        
        }else{
            $repartos = OficinaJudicialReparto::where('acta_reparto',NULL)/*->where('fecha_rechazo','!=',NULL)->where('asignado_a', auth()->user()->id)*///->orderby('fecha_recibido','ASC')->get();
       // }
       
       
        $repartos = OficinaJudicialReparto::where('acta_reparto',NULL)
        ->where('asignado_a', NULL)
        ->where('OficinaReparto', auth()->user()->oficina_reparto)->orderby('fecha_recibido','ASC')->get();
        //dd( auth()->user()->oficina_reparto,$repartos);
        
        return view('usuario.reparto.index',compact('repartos','operariosR'));
    }
    
    //REPARTO ASIGNADO
    
    public function asignado(){
       $operariosR= User::where('rol',16)->get()->pluck('full_name','id');
        $repartos = OficinaJudicialReparto::where('acta_reparto',NULL)
        ->where('OficinaReparto', auth()->user()->oficina_reparto)
        ->where('asignado_a','!=', NULL)->orderby('fecha_recibido','ASC')->get();
        return view('usuario.reparto.index',compact('repartos','operariosR'));
    }
    
    public function conReparto(){
        
       $operariosR= User::where('oficina_reparto', auth()->user()->oficina_reparto)->get()->pluck('full_name','id');
        if( auth()->user()->rol == 15){
           $repartos = OficinaJudicialReparto::where('acta_reparto','!=',NULL)
           ->where('OficinaReparto', auth()->user()->oficina_reparto)
           ->orderby('fecha_recibido','asc')
           ->get();
         
        }else{
            $repartos = OficinaJudicialReparto::where('acta_reparto','!=',NULL)
            ->where('OficinaReparto', auth()->user()->oficina_reparto)
            ->where('reparto_asignado_a','!=', NULL)
            ->where('asignado_a', auth()->user()->id)
            ->orderby('fecha_recibido','asc')
            ->get();
        
        }
        //dd($repartos);
        
        return view('usuario.reparto.conReparto',compact('repartos','operariosR'));
        
    }
    
    public function traslado(Request $request,$id){
        $reparto = OficinaJudicialReparto::findOrFail($id);
        $gruposRe = GrupoReparto::pluck('especialidad','id');
        //dd($reparto, auth()->user()->id);
        $grupo=GrupoReparto::find($reparto->especialidad);
        
         $oficinas = OficinasReparto::pluck('nombre','email');
         
         $ciudad = Despacho::where('correoD',/* auth()->user()->oficina_reparto*/"conecttate.net@gmail.com")->first();
         //dd($ciudad, auth()->user()->oficina_reparto);
         
         if($ciudad != null){
             $despachos = Despacho::where('codCiudad',$ciudad->codCiudad)
             ->orderby('especialidad','asc')
             ->pluck('nombreDespacho','correoD');
         }else{
           $despachos = Despacho::where('especialidad','LIKE','%' .$grupo->especialidad.'%')->pluck('nombreDespacho','correoD');  
         }
        
        //
        
        
        
        //dd($despachos);
        
        if($reparto->estado == null || $reparto->estado ==  auth()->user()->id ||  auth()->user()->rol == 15){
         $reparto->estado =  auth()->user()->id;
         $reparto->asignado_a =   auth()->user()->id;
         $reparto->save();
        return view('usuario.reparto.asignar',compact('reparto','gruposRe','despachos', 'oficinas'));
        }else{
            
            if( $reparto->estado ==  auth()->user()->id || $reparto->estado ==  auth()->user()->id )
           {
                return view('usuario.reparto.asignar',compact('reparto','gruposRe','despachos', 'oficinas'));
            }else{
         Session::flash('warning', 'El traslado ya esta siendo Tramitado !');
                        return Redirect::to('/oficina/reparto/pendientes');
            }
        }
    }
    
    public function enviarReparto(Request $request,$id){
        
        $reporte = OficinaJudicialReparto::findOrFail($id);
        
        $Demanda= $reporte->demanda;
        $poder= $reporte->poder;
        $anexos= $reporte->anexos;
        
        $emailD =$request->reparto_asignado_a;
        $emailU = $reporte->email;
        $nombreD=Despacho::where('correoD',$request->reparto_asignado_a)->select('nombreDespacho')->first();
        //dd($nombreD,$reporte);
        
        $nombreDespacho=$nombreD->nombreDespacho; 
        $oficinaDereparto = $reporte->oficinaReparto;
        
        
        
        $file = $request->file('acta_reparto');
        
        $nombreActa = $_FILES["acta_reparto"]["name"];
        
        $tamDemanda= intval($_FILES["acta_reparto"]["size"]);
        
        $total= ($tamDemanda)/1000000;
        
        if ($total > 24.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tamaño Permitido, debe ser máximo 20 MB");
           return Redirect::back();
        }
        
        
        $key = $reporte->seguimiento;
        $separador = ".";
        $separada1 = explode($separador, $nombreActa);
        
        
        $nombre = $key." ".preg_replace('([^A-Za-z0-9])', ' ', $separada1[0]).".".$separada1[1];
        
        if($tamDemanda > 0){
        \Storage::disk('reparto')->put($nombre, \File::get($file));
        }
        
           $reporte->fill(['acta_reparto' => $nombre,
            'reparto_asignado_a'=>$request->reparto_asignado_a,
            'fecha_reparto'=>Carbon::now(),
            'asignado_a'=> auth()->user()->id
            ]);
           $reporte ->save();
           
           
            $data              =  json_decode(json_encode($reporte), true); 
            
            try{
                        
                         Mail::send('emails.RepartoAdespacho',$data, function ($message) use ($reporte,$nombre,$emailD,$tamDemanda,$Demanda,$poder,$anexos,$oficinaDereparto,$nombreDespacho) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($emailD);
                                        $message->cc($oficinaDereparto);
                                        $message->subject('El reparto le correspondió a su Despacho:' .$nombreDespacho);
                                        if($tamDemanda > 0){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $nombre,[  'mime' => "application/octet-stream", ]);
                                        }
                                        if(!empty($Demanda)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $Demanda,[  'mime' => "application/octet-stream", ]);
                                        }
                                       /* if(!empty($poder)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $poder,[  'mime' => "application/octet-stream", ]);
                                        }*/
                                        if(!empty($anexos)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $anexos,[  'mime' => "application/octet-stream", ]);
                                        }
                         });
                        
                       Mail::send('emails.RepartoAsignadoUsuario', $data, function ($message) use ($reporte,$nombre,$emailU,$tamDemanda,$Demanda,$poder,$anexos,$nombreDespacho) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($emailU);
                                        $message->subject('Reparto Asignado a: '.$nombreDespacho);
                                        if($tamDemanda > 0){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $nombre,[  'mime' => "application/octet-stream", ]);
                                        }
                                       
                         }); 
                        
            }catch(Exception $e){
                          Session::flash('success', 'Error al enviar correo Electrónico !');
                          return Redirect::back();
                        }
        Session::flash('success', 'Reparto Realizado con éxito !');
                        return Redirect::to('/oficina/reparto/pendientes');
    }
    
    public function asignarFuncionario(Request $request){
       // dd($request->all());
        
        if(!empty($request->lista)){
        
        foreach($request->lista as $lista){
           $lista = OficinaJudicialReparto::FindOrFail($lista) ;
           $lista->asignado_a = $request->asignado_a;
           $lista->estado = NULL;
           $lista->save();
           
        }
       Session::flash('success', 'Asignación Realizada con éxito !');
        }else{
           Session::flash('warning', 'Debe seleccionar Proceso para asignar!'); 
        }
            return Redirect::to('/oficina/reparto/pendientes'); 
        
    }
    
    public function cambiaGrupo(Request $request,$id){
        
        //dd($request);
     $nombreEspecialidad= GrupoReparto::findOrFail($request->especialidad);
    
       $reporte = OficinaJudicialReparto::findOrFail($id);
       
       $reporte->fill(['especialidad' => $request->especialidad,
            'nombre_grupo'=>$request->nombre_grupo,
           'nombre_especialidad' => $nombreEspecialidad->especialidad
            ]);
      $reporte ->save();
       
       
       Session::flash('message', "Cambió Nombre Grupo");
           return Redirect::back();
        
    }
    
    public function Estadistica(Request $request){
        //dd(Carbon::now()->format('Y-m'));
        
        if(!empty($request->all())){
          //dd($request->all());  
          $totalMes = OficinaJudicialReparto::TotalOperarioMesFechas($request->inicio,$request->fin);
          
        }else{
          $totalMes = OficinaJudicialReparto::TotalOperarioMes();
         // dd($totalMes);
        }
        
        $total = OficinaJudicialReparto::TotalEnvioReparto();
        $faltantes=  OficinaJudicialReparto::TotalFaltantes();
        //dd($total[0]->total);
        $asignado=OficinaJudicialReparto::TotalAsignado();
        $conReparto= OficinaJudicialReparto::TotalConReparto();
        $Operarios= OficinaJudicialReparto::TotalOperarios();
        $despachos =  OficinaJudicialReparto::TotalDespachos();
        return view('usuario.reparto.Estadistica',compact('total','asignado','conReparto','Operarios','totalMes','faltantes'));
    }
    
    public function trasladar(Request $request,$id){
           $lista = OficinaJudicialReparto::FindOrFail($id) ;
           $lista->oficinaReparto = $request->oficinaReparto;
           $lista->asignado_a = NULL;
           $lista->estado = NULL;
           $lista->traslado = $request->traslado;
           $lista->fecha_traslado = Carbon::now();
           $lista->save();
           
           
           $data              =  json_decode(json_encode($lista), true); 
           $Demanda= $lista->demanda;
           $anexos= $lista->anexos;
           $oficinaDereparto = $lista->oficinaReparto;
           $emailNotificacion= $lista->email;
           
            Mail::send('emails.NotificacionTraslado',$data, function ($message) use ($lista,$Demanda,$anexos,$oficinaDereparto,$emailNotificacion) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($oficinaDereparto);
                                        $message->cc($emailNotificacion);
                                        $message->subject('Traslado de proceso por competencia');
                                        if(!empty($Demanda)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $Demanda,[  'mime' => "application/octet-stream", ]);
                                        }
                                       /* if(!empty($poder)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $poder,[  'mime' => "application/octet-stream", ]);
                                        }*/
                                        if(!empty($anexos)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $anexos,[  'mime' => "application/octet-stream", ]);
                                        }
                         });
           
           Session::flash('success', 'Demanda Trasladad con Exito !');
                        return Redirect::to('/oficina/reparto/pendientes');
    }
    
    public function Rechazar(Request $request,$id){
         $lista = OficinaJudicialReparto::FindOrFail($id) ;
           $lista->asignado_a = $request->asignado_a;
           $lista->fecha_rechazo = Carbon::now();
           $lista->save();
           
           $data              =  json_decode(json_encode($lista), true); 
           $Demanda= $lista->demanda;
           $anexos= $lista->anexos;
           $oficinaDereparto = $lista->oficinaReparto;
           $emailNotificacion= $lista->email;
           
            Mail::send('emails.NotificacionRechazo',$data, function ($message) use ($lista,$Demanda,$anexos,$oficinaDereparto,$emailNotificacion) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($emailNotificacion);
                                        $message->cc($oficinaDereparto);
                                        $message->subject('Rechazo de Demanda');
                                        if(!empty($Demanda)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $Demanda,[  'mime' => "application/octet-stream", ]);
                                        }
                                       /* if(!empty($poder)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $poder,[  'mime' => "application/octet-stream", ]);
                                        }*/
                                        if(!empty($anexos)){
                                        $message->attach("/home/disajcal/public_html/Reparto/" . $anexos,[  'mime' => "application/octet-stream", ]);
                                        }
                         });
           
           Session::flash('error', 'Demanda Rechazada!');
                        return Redirect::to('/oficina/reparto/pendientes');
    }
    
    public function ficha_Remision(){
         $fichas = FichaRemision::where('estado',null)
         ->where('circuito', auth()->user()->oficina_ficha_remision)
         ->get();
         //dd($fichas);
         return view('fichaRemision.index',compact('fichas'));
    }
    
     public function historico(){
         
         
         //diego segura dsegurao@cendoj.ramajudicial.gov.co
         // RENE ZAPATA  BECERRA	 	rzapatab@cendoj.ramajudicial.gov.co
         //	Jorge Olmedo Mayor Ruiz	jmayorr@cendoj.ramajudicial.gov.co
         
         $formatos_permitidos =  array('dsegurao@cendoj.ramajudicial.gov.co','rzapatab@cendoj.ramajudicial.gov.co','jmayorr@cendoj.ramajudicial.gov.co'/*,'gmstdesajvalle2@cendoj.ramajudicial.gov.co'*/);
        if(in_array( auth()->user()->email,$formatos_permitidos) ) {
            $fichas = FichaRemision::where('estado','!=',null)
         ->where('circuito', auth()->user()->oficina_ficha_remision)
         ->orderBy('created_at','DESC')
         ->get();
         //dd('entro');
            }else{
                $fichas = FichaRemision::where('estado','!=',null)
         ->where('circuito', auth()->user()->oficina_ficha_remision)
         ->where('user_id', auth()->user()->id)
         ->orderBy('created_at','DESC')
         ->get();  
            }
         
         //dd($fichas);
         return view('fichaRemision.historico',compact('fichas'));
    }
    
    public function generarFicha(Request $request,$id){
         $reporte = FichaRemision::findOrFail($id);
         $data              =  json_decode(json_encode($reporte), true); 
         view()->share('reporte', $reporte);
         
         $pdf = Pdf::loadView('emails/soporte/fichaRemisionPdf',$data)->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'300']);
         
         $nombrePdf ="FICHA REMISION-".$reporte->numero_radicado_proceso."-".$reporte->despacho_remite.".pdf";  //
         return $pdf->download($nombrePdf);
        
    }
    
    public function responderFicha(Request $request,$id){
        
         $remision = FichaRemision::findOrFail($id);
         
          //marca de trabajo
        if(empty($remision->user_id) ||  $remision->user_id ==  auth()->user()->id){
            $remision->user_id =  auth()->user()->id;
            $remision->save();
        }else{
            Session::flash('message', 'OTRO USUARIO ESTA DANDO RESPUESTA EL CONCEPTO!');
            return Redirect::back();
        }
         
         $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
         //dd($remision);
        return view('fichaRemision.respoderFicha',compact('remision','despachos'));
        
    }
    
    public function fichaUpdate(Request $request,$id){
         $reporte = FichaRemision::findOrFail($id);
          $file = $request->file('acta_reparto');
          $consulta = $request->file('consulta');
          
          $despachoAsignado = Despacho::where('codigoDespacho',$request->despacho_corresponde)->first();
          
          //dd($despachoAsignado);
          
          if(!empty($consulta)){
            $nombreconsulta = $_FILES["consulta"]["name"];
              $tamconsulta= intval($_FILES["consulta"]["size"]);
              $nombreConsultaPdf ="CONSULTA-".$reporte->numero_radicado_proceso."-".Carbon::now()->toDateTimeString().".pdf"; 
               if($tamconsulta > 0){
                \Storage::disk('fichaRemision')->put($nombreConsultaPdf, \File::get($consulta));
                }  
          }else{
             $nombreConsultaPdf = NULL; 
          }
          
          //dd($despachoAsignado,$request->reparto_asignado_a,$request->all());
          $nombreActa = $_FILES["acta_reparto"]["name"];
          $tamDemanda= intval($_FILES["acta_reparto"]["size"]);
          $nombrePdf ="ACTA_REPARTO-".$reporte->numero_radicado_proceso."-".Carbon::now()->toDateTimeString().".pdf"; 
           if($tamDemanda > 0){
            \Storage::disk('fichaRemision')->put($nombrePdf, \File::get($file));
            }
        
         
        $reporte->id_despacho_corresponde = $request->despacho_corresponde;
        $reporte->despacho_corresponde = $despachoAsignado->nombreDespacho;
        $reporte->acta_reparto = $nombrePdf;
        $reporte->consulta = $nombreConsultaPdf;
        $reporte->estado = "Se Remite Acta";
        $reporte->save();
        $reporte->usuario_quien_realiza =  auth()->user()->name." ". auth()->user()->lastname;
        
        //SE REMITE CORREO CON LOS DATODS 
        $data              =  json_decode(json_encode($reporte), true);
        //dd($data);
        $correoReparto = auth()->user()->email;
        $correoDespachoAsignado = $despachoAsignado->correoD;
        $despachoOrigen = $reporte->email_despacho;
        $asunto ="POR REPARTO LE CORRESPONDE A".$despachoAsignado->nombreDespacho;
        
        Mail::send('emails/soporte/correoFichaRemision', $data, function ($mail) use ($correoReparto,$nombrePdf,$nombreConsultaPdf,$asunto,$correoDespachoAsignado,$despachoOrigen) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                //$mail->cc($correoReparto);
                //$mail->cc($correoDespachoAsignado);
                $mail->attach("/home/disajcal/public_html/fichaRemision/" . $nombrePdf,[  'mime' => "application/octet-stream", ]);
                if(!empty($nombreConsultaPdf)){
                  $mail->attach("/home/disajcal/public_html/fichaRemision/" . $nombreConsultaPdf,[  'mime' => "application/octet-stream", ]);  
                }
                                        
            });  
        Session::flash('message', 'SOLICITUD REALIZADA CON EXITO!');
        return redirect()->route("reparto.ficha.remisiones");
        
    }
    
    
  
    
}
