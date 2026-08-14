<?php

namespace App\Http\Controllers\Audiencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\SolicitudAudiencia;
use App\Models\Detenido;
use App\Models\Despacho;
use App\Models\Persona;

use App\Models\ReservaSalas;
use App\Models\PersonalActivo;
use App\Models\Disponible;

use App\Models\ReservaSalaAudiencia;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use PDF;
use Telegram\Bot\Laravel\Facades\Telegram;



class SolicitudAudienciaController extends Controller
{

   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');        
        $this->middleware('usuario');
    }

    public function updatedActivity()
{
    $text = 'Solicitud de audiencia ';

Telegram::sendMessage([
    'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001666229135'),
    'parse_mode' => 'HTML',
    'text' => $text
]);
    $activity = Telegram::getUpdates();
    dd($activity);
}
  
    public function index(Request $request)
    {
        
        $despacho = Despacho::select('correoD','nombreDespacho','codCiudad','codigoDespacho')->where('codigoDespacho','=', auth()->user()->cedula)->first();
        //dd($despacho);
        if($despacho){   
           //dd($despacho->correoD);
           $solicitudAudiencia = new SolicitudAudiencia();
          
           $solicitudAudiencia->email = $despacho->correoD;
           $solicitudAudiencia->nombre_entidad = $despacho->nombreDespacho;
           $solicitudAudiencia->ciudad_destino = $despacho->ciudad->nombreCiudad;
           //dd('hola');
           $solicitudAudiencia->codigoDespacho = $despacho->codigoDespacho;
           //dd($despacho->codigoDespacho);
           $solicitudes = new SolicitudAudiencia();
       //dd( auth()->user()->email);
        //return view('usuario.audiencias',compact('solicitudes'));
        
       
        
        if(Carbon::now()->toTimeString() > "18:00"){
            $disponible = Disponible::where('estado','ACTIVO')->first();
        }else{
            $disponible =null;
        }
        
        
        return view('audiencias.index',compact('solicitudAudiencia','disponible'));
          }else{
            Session::flash('warning', 'No tiene Despacho Asignado para Solicitar una Audiencia. Comuníquese con el administrador para asignarle uno');  
            return redirect()->back();

          }
    }


    public function store(Request $request)
    {
         if(Carbon::now()->toTimeString() > "18:00"){
            $disponible = Disponible::where('estado','ACTIVO')->first();
        }else{
            $disponible =null;
        }
        //dd($request->all());
        $this->validate($request, [
            'numero_radicado_proceso'=> 'required|numeric|digits:23',
            'fecha_prgramada' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'email' => 'required|string|email',
            'nombre_entidad' => 'required|string|max:200',            
            'ciudad_destino' => 'required|max:150',
            'entidad_destino' => 'required|max:250',
            'declarante_indiciado' => 'required|max:250',
            //'direccion' => 'required',
            'telefono' => 'required|max:15',
            'audiencia_privada' => 'required',
            'detenido' => 'required',
            'audiencia_privada'=>'required',
            'detenido'=> 'required'
        ]);
        //$numero_radicado_proceso=(string)$request->numero_radicado_proceso;
        $solicitud = SolicitudAudiencia::where("numero_radicado_proceso",'=',$request->numero_radicado_proceso)
                                        ->where("fecha_prgramada",'=',$request->fecha_prgramada)
                                        ->where("hora_inicio",'=',$request->hora_inicio)
                                        ->where("hora_fin",'=',$request->hora_fin)
                                        //->where("email",'=',$request->email)
                                        //->where("nombre_entidad",'=',$request->nombre_entidad)
                                        //->where("ciudad_destino",'=',$request->ciudad_destino)
                                        //->where("entidad_destino",'=',$request->entidad_destino)
                                        //->where("declarante_indiciado",'=',$request->declarante_indiciado)
                                        //->where("direccion",'=',$request->direccion)
                                        //->where("telefono",'=',$request->telefono)
                                        //->where("audiencia_privada",'=',$request->audiencia_privada)
                                        //->where("detenido",'=',$request->detenido)                                     
                                        ->first();

           //validacion de fecha y dia
      

         // dd($solicitud);                     
        if($solicitud === null){
            //dd('primer if');
        $solicitudAudiencia = new SolicitudAudiencia();

           $solicitudAudiencia->fecha_prgramada = $request->fecha_prgramada;
           $solicitudAudiencia->hora_inicio = $request->hora_inicio;
           $solicitudAudiencia->hora_fin = $request->hora_fin;
           $solicitudAudiencia->email = $request->email;
           $solicitudAudiencia->codigo_despacho = $request->codigoDespacho;
           $solicitudAudiencia->nombre_entidad = $request->nombre_entidad;
           $solicitudAudiencia->ciudad_destino = $request->ciudad_destino;
           $solicitudAudiencia->entidad_destino = $request->entidad_destino;
           $solicitudAudiencia->numero_radicado_proceso = $request->numero_radicado_proceso;
           $solicitudAudiencia->declarante_indiciado = $request->declarante_indiciado;
           $solicitudAudiencia->direccion = $request->direccion;
           $solicitudAudiencia->telefono = $request->telefono;
           $solicitudAudiencia->audiencia_privada = $request->audiencia_privada;
           $solicitudAudiencia->detenido = $request->detenido;
           $solicitudAudiencia->id_conexion = null;
           $solicitudAudiencia->codigo = null;
           $solicitudAudiencia->num_agendamiento = null;
           $solicitudAudiencia->sala = null;
           $solicitudAudiencia->enlace = null;
           $solicitudAudiencia->fecha_solicitud = Carbon::now()->toDateTimeString();
           if($request->detenido){
               //si el fomulario contiene que asistirà detenido, puede editar el formulario para agregarlo
            $solicitudAudiencia->editar = 1;
           }else{
               //si el formulario no trae citacion con detenido, se cierra su edicion 
            $solicitudAudiencia->editar = 0;
           }
           
           if(Carbon::parse($request->fecha_prgramada)->toDateString() == Carbon::now()->toDateString() && Carbon::parse($request->hora_inicio)->toTimeString() < Carbon::now()->toTimeString()){
              Session::flash('error','No se puede programar la audiencia. La hora no pueden ser inferior a la actual!');
          
            return view('audiencias.index',compact('solicitudAudiencia','disponible'));  
           }
           


           if(Carbon::parse($request->fecha_prgramada)->toDateString() < Carbon::now()->toDateString() ){
            //dd('ff');
            Session::flash('error','No se puede programar la audiencia. La fecha o la hora no pueden ser inferior a la actual!');
          
            return view('audiencias.index',compact('solicitudAudiencia','disponible'));
        }else{
            if(Carbon::parse($request->hora_inicio)->toTimeString()  < Carbon::parse($request->hora_fin)->toTimeString() ){
                if($solicitudAudiencia ->save()){
                    //CORTAR NOMBRE DE DEMANDADO
                    $indiciado = explode(" ", $request->declarante_indiciado);
                    //almacenar datos en la reserva de salas con el formulario de solicitud de audiencias virtuales
                    
                    $ciudad = Despacho::where('codigoDespacho', auth()->user()->cedula)->select('codCiudad')->first();
                   
                    
                    if($ciudad->codCiudad == 76001){
                        
                    
                    $evento = ReservaSalas::create([
                        'rs_sala'              =>null,
                        'rs_numero_radicado'   => $request->numero_radicado_proceso,
                        'rs_nombre_fiscal'     => 'FISCALÍA',
                        'rs_nombre_indiciado'  => strtoupper($indiciado[0].' @@@@@'),
                        'rs_fecha'             => $request->fecha_prgramada,
                        'rs_hora_inicio'       => $request->hora_inicio,
                        'rs_fecha_fin'         => $request->fecha_prgramada,
                        'rs_hora_fin'          => $request->hora_fin,
                        'rs_estado'            => 'SIN PUBLICAR',
                        'rs_codigo_juzgado'    => $request->codigoDespacho,
                        'color'                => null,
                        'textcolor'            => null,
                        'rs_creador'           => $request->nombre_entidad, 
                        'solicitud_audiencia_id'=>$solicitudAudiencia->id,
                    ]);
                    
                    //dd('entro');
                    }
                    //dd('no entro');
  
                    //dd($correo, $despacho);                 
                    //envio de correo de confirmacion
                    $data              =  json_decode(json_encode($solicitudAudiencia), true);
                    
                    Mail::send('emails.solicitudAudienciaAgendada', $data, function ($message) use ($solicitudAudiencia) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                        $message->to($solicitudAudiencia->email, $solicitudAudiencia->nombre_entidad);
                        $message->subject('Agendamiento de Solicitud Audiencia Virtual');
                        
                    });

                    $text = "<b>Solicitud de Audiencia:</b>:\n"
                    . "<b>Responsable: </b>\n"
                    . "$request->nombre_entidad\n"
                    . "<b>Nombre Indiciado: </b>\n"
                    . "$request->declarante_indiciado\n"
                    . "<b>Hora Inicio: </b>\n"
                    . "$request->hora_inicio\n"
                    . "<b>Fecha : </b>\n"
                    . "$request->fecha_prgramada";
                    
                     
                    
                           if(Carbon::now()->toDateString() == $request->fecha_prgramada && Carbon::now()->toTimeString() > "17:00"){
                                Telegram::sendMessage([
                                        'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001666229135'),
                                        'parse_mode' => 'HTML',
                                        'text' => $text
                                ]);
                           } 
                           
                           if(Carbon::now()->toDateString() == $request->fecha_prgramada && Carbon::now()->toTimeString() < "06:00" ){
                                Telegram::sendMessage([
                                        'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001666229135'),
                                        'parse_mode' => 'HTML',
                                        'text' => $text
                                ]);
                           } 
                           
                           if(Carbon::now()->toDateString() == $request->fecha_prgramada && Carbon::now()->toTimeString() > "11:30" &&  Carbon::now()->toDateString() == $request->fecha_prgramada && Carbon::now()->toTimeString() < "13:10"){
                                Telegram::sendMessage([
                                        'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001666229135'),
                                        'parse_mode' => 'HTML',
                                        'text' => $text
                                ]);
                           }
                    

                    if($request->detenido){
                        $detenido = New Detenido();
                        Session::flash('success', 'Ingresa los datos de los detenidos');
                        return Redirect::to('usuarios/solicitud/audiencia/virtual/det/log-4512'.$solicitudAudiencia->id.'455248')->with('mensaje', $solicitudAudiencia, $detenido);
                        
                    }else{                        
                        
                        Session::flash('success', 'Solicitud audiencia se creó correctamente!');
                       return Redirect::to('usuarios/');
                       //return Redirect::back();
                    }
                }else{
                    Session::flash('warning', 'No se ha podido Generar la solicitud de audiencia');
                    return view('audiencias.index',compact('solicitudAudiencia','disponible'));
                }
            }  else{
                Session::flash('warning', 'La hora de finalización de la audiencia no puede ser menor o igual que la de inicio');
                return view('audiencias.index',compact('solicitudAudiencia','disponible'));
            }             
        }

        }else{
            Session::flash('warning', 'No se ha podido Solicitar la Audiencia, esta audiencia ya esta reservada con estos datos');        
            return Redirect::to('usuarios/solicitud/audiencia/virtual');
        }
           
    }

    public function storedetenido(Request $request){
        
         if(Carbon::now()->toTimeString() > "18:00"){
            $disponible = Disponible::where('estado','ACTIVO')->first();
        }else{
            $disponible =null;
        }
        //dd($request->id);
        $solicitudAudiencia = SolicitudAudiencia::findOrFail($request->id);
        $detenido = New Detenido();
        //dd($solicitudAudiencia->editar);
        //return view('audiencias.detenidos',compact('detenido','solicitudAudiencia')); 

        if($solicitudAudiencia->editar){
           return view('audiencias.detenidos',compact('detenido','solicitudAudiencia','disponible')); 
        }else{
            Session::flash('warning', 'No tiene permitodo agregar detenido a la audiencia');        
            return Redirect::to('usuarios/');
        }
        
    }

    public function detenido(Request $request){


        if($request->ajax()){
         $detenido = new Detenido();

           $detenido->solicitud_audiencias_id = $request->solicitud_audiencias_id;
           $detenido->nombre_interno = $request->nombre_interno;
           $detenido->ciudad = $request->ciudad;
           $detenido->nombre_estalecimiento = $request->nombre_estalecimiento;
           $detenido ->save();
           //dd($detenido);
           
           }
    }


    public function confirmarAudiencia(Request $request)
    {
        /*dd($request->id);

        $despacho = Despacho::select('correoD','nombreDespacho','codCiudad','codigoDespacho')->where('correoD','=', auth()->user()->email)->first();

        $solicitudAudiencia = new SolicitudAudiencia();

           $solicitudAudiencia->fecha_prgramada = $request->fecha_prgramada;
           $solicitudAudiencia->hora_inicio = $request->hora_inicio;
           $solicitudAudiencia->hora_fin = $request->hora_fin;

           $solicitudAudiencia->email = $despacho->correoD;
           $solicitudAudiencia->nombre_entidad = $despacho->nombreDespacho;

           $solicitudAudiencia->ciudad_destino = $request->ciudad_destino;
           $solicitudAudiencia->entidad_destino = $request->entidad_destino;
           $solicitudAudiencia->numero_radicado_proceso = $request->numero_radicado_proceso;
           $solicitudAudiencia->declarante_indiciado = $request->declarante_indiciado;
           $solicitudAudiencia->direccion = $request->direccion;
           $solicitudAudiencia->telefono = $request->telefono;
           $solicitudAudiencia->audiencia_privada = $request->audiencia_privada;

           $solicitudAudiencia->detenido = $request->detenido;

           $solicitudAudiencia->editar = 0;
           
           $solicitudAudiencia ->save();*/

            $solicitudAudiencia = SolicitudAudiencia::findOrFail($request->id);
            $solicitudAudiencia->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
            $solicitudAudiencia->save();

           


           Session::flash('success', 'Solicitud de Audiencia solicitada Correctamente!');  
           return Redirect::to('usuarios/');
           
    }


    public function verificarCorreo(Request $request)
    {
           $despacho = Despacho::select('correoD','nombreDespacho','codCiudad','codigoDespacho')->where('correoD','=',$request->email)->first();
           //dd($despacho->ciudad);
           $solicitudAudiencia = new SolicitudAudiencia();

           $solicitudAudiencia->email = $despacho->correoD;
           $solicitudAudiencia->nombre_entidad = $despacho->nombreDespacho;
           $solicitudAudiencia->ciudad_destino = $despacho->ciudad->nombreCiudad;
           $solicitudAudiencia->codigoDespacho = $despacho->codigoDespacho;

        return view('audiencias.index',compact('solicitudAudiencia','disponible'));
    }

 
    public function destroy(Request $request, $id)
    {
        //dd($id);
        if($request->ajax()){ 
        $detenido = Detenido::findOrFail($id);
        //dd($detenido);
        $detenido = Detenido::destroy($id);
        return 1;
        }
    }
    
    
    //funcion para crear pdf y consulta de empleaados activos
    
    public function empleados(Request $request){
        //dd( auth()->user()->cedula);
       $empleados = Persona::where('despacho_id', auth()->user()->cedula/*760014103006*/)->get();
       //dd($empleados);
       return view('usuario.empleados',compact('empleados'));
    }
    
    public function confirmarEmpleados(Request $request){
       // dd($request);
        
        
        
        $realiza = Persona::where('cedula',$request->haceFormato)
        ->select('nombre','apellidos','descripcion_cargo')
        ->first();
        
        if(empty($realiza)){
          Session::flash('warning', 'Verifica la cédula de los del Nominador, no esta registrado en los empleados');  
                    return redirect()->back();   
        }
        //dd($realiza);
        $empleados =  $request->cedEmpleado;
        $remplazos =  $request->cedulaReemplazo;
        $cargo =  $request->desCargo;
        //dd($remplazos);
        
        foreach($remplazos as $reemplazo){
            if($reemplazo != null){
                $result =Persona::where('cedula',$reemplazo)->first();
                if(empty($result)){
                  Session::flash('warning', 'Verifica la cédula de los reemplazos, no esta registrado en los empleados');  
                    return redirect()->back();  
                }
            }
        }
        
        
          $borrarSiEsta = PersonalActivo::where('despacho', auth()->user()->cedula)
        ->get();
        //dd($borrarSiEsta->all());
        
        if(!empty($borrarSiEsta->all())){
            //dd('ingreso');
          $elementos = DB::select('delete FROM `personal_activo` where despacho='. auth()->user()->cedula);  
        }
        
        
        /*$empl = PersonalActivo::find(275);
        dd($empl->remplazoDes);*/
        
       $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse(Carbon::now());
        $mes = $meses[($fecha->format('n')) - 1];
        $fecha = '('.$fecha->format('d').') '.'dias' . ' del mes de ' . $mes . ' de ' . $fecha->format('Y');
        //dd($fecha);
            
        for ($i=0; $i < sizeof($empleados) ; $i++) { 
           
                $personal = new PersonalActivo();
                $personal->despacho = $request->despacho;
                $personal->empleado = $empleados[$i];
                $personal->cargo = $cargo[$i];
                if ($remplazos[$i] == null){
                    $personal->estado = 'Activo' ; 
                }else{
                    $personal->estado = 'Licencia' ;   
                }
                
                $personal->reemplazo = $remplazos[$i];
                $personal->save();
            }
            

       $empleadosActivos = PersonalActivo::where('despacho',  auth()->user()->cedula)->get();
        //dd($empleadosActivos);
       /*  return view('usuario.pdfEmpleados',compact('empleadosActivos','realiza','fecha'));*/
       
       DB::table('users')
            ->where('cedula',  auth()->user()->cedula)
            ->update(['certifico_personal' => 1]);
        
        $pdf   = Pdf::loadView('usuario.pdfEmpleados',['empleadosActivos'=> $empleadosActivos],compact('realiza','fecha'))->setPaper('carta', 'portrait');
            //$dompdf->load_html(utf8_encode($salida_html));
            return $pdf->download('Certificacion Despacho.pdf');
        
    }
    
    public function ReservaSalas(Request $request){
        
        $fecha = Carbon::now()->toDateString();
        
        $eventos = ReservaSalaAudiencia::where('despacho_id', auth()->user()->cedula)
        //->where('fecha_inicio','>=',$fecha)
        ->orderBy('fecha_inicio','asc')
        ->orderBy('hora_inicio','asc')
        ->get();
        //dd($eventos);
       return view('usuario.ReservasSalas',compact('eventos')); 
        
    }
    
  
    
    
}