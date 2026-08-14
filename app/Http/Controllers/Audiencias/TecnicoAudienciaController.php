<?php

namespace App\Http\Controllers\Audiencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB; 

//Paginate

use Illuminate\Pagination\Paginator;

use App\Models\SolicitudAudiencia;
use App\Models\Detenido;
use Illuminate\Support\Carbon;




class TecnicoAudienciaController extends Controller
{
  
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');        
        $this->middleware('tecnico');
    }


    public function index(Request $request)
    { 
        $fechaCon = $request->fecha;   
        $radicado = $request->radicado;
        $email = $request->email;
        
        //contar Que no se puedan cger mas de 4
        $conteReservasTecnico = SolicitudAudiencia::where('enlace',null)
        ->where('quien_asigno', auth()->user()->id)
        ->where('id_conexion',null)
        ->where('quien_asigno', auth()->user()->id)
        ->count();
            
        if(empty($request->all()) ){

        $fecha = Carbon::now()->subDays(1)->toDateString();
        //dd($fecha);
        $fechademas = Carbon::now();
        $fechademas->addDays(300)->toDateString(); 
           

        $solicitudes = SolicitudAudiencia::where('enlace',null)
        //->where('quien_asigno','!=', auth()->user()->id)
        //->where('quien_asigno','=', auth()->user()->id)
        ->where('id_conexion',null)
        //->orWhere('quien_asigno','=', null)
        ->whereBetween('fecha_prgramada', [$fecha, $fechademas])
        //->fecha($fechaCon)
        ->ubicacion('CALI')
        //->paginate(1);
        ->orderBy('fecha_prgramada','ASC')
        ->get();
 
        }else{

        $solicitudes = SolicitudAudiencia::where('enlace',null)
        //->where('quien_asigno','!=', auth()->user()->id)
        //->where('quien_asigno','=', auth()->user()->id)
        ->where('id_conexion',null)
        //->orWhere('quien_asigno','=', null)
        //->whereBetween('fecha_prgramada', [$fecha, $fechademas])
        ->fecha($fechaCon)
        ->ubicacion('CALI')
        ->radicado($radicado)
        ->email($email)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        }
       
        //dd($fechaCon);

        //dd($solicitudes);

        $solicitudAudiencia = new SolicitudAudiencia();

        return view('audiencias.tecnico.cali',compact('solicitudes','solicitudAudiencia','fechaCon','conteReservasTecnico'));
    }

    
    public function mcipios(Request $request)
    { 
        $fechaCon = $request->fecha;
        $radicado = $request->radicado;
        $email = $request->email;

        //contar Que no se puedan cger mas de 4
        $conteReservasTecnico = SolicitudAudiencia::where('enlace',null)
        ->where('quien_asigno', auth()->user()->id)
        ->where('id_conexion',null)
        ->count();
        
        
      
            
        if(empty($request->all())){

            $fecha = Carbon::now()->subDays(1)->toDateString();
            //dd($fecha);
            $fechademas = Carbon::now();
            $fechademas->addDays(300)->toDateString(); 
            

        $solicitudes = SolicitudAudiencia::where('enlace',null)
        //->where('quien_asigno','!=', auth()->user()->id)
        //->where('quien_asigno','=', auth()->user()->id)
        ->where('id_conexion',null)
        //->orWhere('quien_asigno','=', null)
        ->whereBetween('fecha_prgramada', [$fecha, $fechademas])
        //->fecha($fechaCon)
        ->ubicacionm('CALI')
        //->paginate(1);
        ->orderBy('fecha_prgramada','ASC')
        ->get();
 
        }else{
            $solicitudes = SolicitudAudiencia::where('enlace',null)
        //->where('quien_asigno','!=', auth()->user()->id)
        //->where('quien_asigno','=', auth()->user()->id)
        ->where('id_conexion',null)
        //->orWhere('quien_asigno','=', null)
        //->whereBetween('fecha_prgramada', [$fecha, $fechademas])
        ->fecha($fechaCon)
        ->ubicacionm('CALI')
        //->paginate(1);
        ->radicado($radicado)
        ->email($email)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        }

        //dd($solicitudes);
            $solicitudAudiencia = new SolicitudAudiencia();
            //dd($fechaCon);
        return view('audiencias.tecnico.municipios',compact('solicitudes','solicitudAudiencia','fechaCon','conteReservasTecnico'));
    }


//audiencias virtuales hoy
    public function fecha(Request $request){
        
       //dd($request->all(),empty($request->all()));

        $fecha =Carbon::now()->toDateString();
        //dd($fecha);
        
        if(empty($request->all())){
          $solicitudes = SolicitudAudiencia::where('fecha_prgramada',$fecha)
        ->where('id_conexion','!=', null)
        ->where('enlace','!=', null)
        //->orWhere('id_conexion',null)
        //->orWhere('quien_asigno','=', null)
        ->orderBy('hora_inicio')
        ->get();  
        //dd($solicitudes);
            
        }else{
            
        $fechaCon = $request->fecha;
        $radicado = $request->radicado;
        $email = $request->email;
            
        $solicitudes = SolicitudAudiencia::where('id_conexion','!=', null)
        ->where('enlace','!=', null)
        //->fecha($fechaCon)  
        //->radicado($radicado)  
        ->email($email)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        
        //dd($solicitudes);
            
        }
            $solicitudAudiencia = new SolicitudAudiencia();
        return view('audiencias.tecnico.porfecha',compact('solicitudes','solicitudAudiencia'));
    }

    public function todos(Request $request){
        //dd($request->all()== null);
        
        //contar Que no se puedan cger mas de 4
        $conteReservasTecnico = SolicitudAudiencia::where('enlace',null)
        ->where('quien_asigno', auth()->user()->id)
        ->where('id_conexion',null)
        ->count();
       
        $fechaA =Carbon::now()->toDateString();

        $fecha = $request->fecha;        
        $ciudad = $request->ciudad;
        $email = $request->email;
        $radicado = $request->radicado;
        $entidad = $request->entidad;

        if($request->all() == null){
                
       $solicitudes = SolicitudAudiencia::where('id_conexion', null)
        ->where('enlace', null)
        ->where('id_conexion',null)        
        ->where('fecha_prgramada','>=',$fechaA)
        ->ciudad($ciudad)
        ->email($email)
        ->radicado($radicado)
        ->entidad($entidad)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        //->paginate(200);
        }else{
           $solicitudes = SolicitudAudiencia::where('id_conexion', null)
        ->where('enlace', null)
        ->where('id_conexion',null)        
        ->fecha($fecha)
        ->ciudad($ciudad)
        ->email($email)
        ->radicado($radicado)
        ->entidad($entidad)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        //->paginate(200);
            
        }
        //dd($solicitudes);
            $solicitudAudiencia = new SolicitudAudiencia();
        return view('audiencias.tecnico.todo',compact('solicitudes','solicitudAudiencia','conteReservasTecnico'));
    }

       public function pendiente(Request $request){
        $solicitudes = SolicitudAudiencia::where('quien_asigno', auth()->user()->id)
        ->where('id_conexion',null)
        ->where('enlace',null)
        ->get();
        //dd($solicitudes);
            $solicitudAudiencia = new SolicitudAudiencia();
        return view('audiencias.tecnico.pendientes',compact('solicitudes','solicitudAudiencia'));
    }

    public function show(Request $request){
        //dd($request->id);
        if($request->ajax()){
        $solicitud = SolicitudAudiencia::findOrFail($request->id);
        return $solicitud;

        }


    }
    
    
    public function almacenar(Request $request){
      
        $asignar = SolicitudAudiencia::findOrFail($request->id_r);
        $asignar->id_conexion = $request->id_conexion;
        $asignar->enlace = $request->url_conexion;
        $asignar->fecha_asignacion = date("Y-m-d");
        $asignar->save();
        
        $data              =  json_decode(json_encode($asignar), true);
        
        //dd($asignar->email,$data);
        Mail::send('emails.correoInformativoEnlaceAudiencia', $data, function ($message) use ($asignar) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                        $message->to($asignar->email, $asignar->nombre_entidad);
                        $message->subject('Enlace Agendamiento de Solicitud Audiencia Virtual');
                        
                    });
        
        
        
       
    return Redirect::to('/tecnico/solicitud/audiencia/virtual'); 
        
    }


//almacenarmunicipio

  public function almacenarmunicipio(Request $request){
      
     
        $asignar = SolicitudAudiencia::findOrFail($request->id_r);
        $asignar->id_conexion = $request->id_conexion;
        $asignar->enlace = $request->url_conexion;
        $asignar->fecha_asignacion = date("Y-m-d");
        $asignar->save();
        
        $data              =  json_decode(json_encode($asignar), true);
        
        //dd($asignar->email,$data);
        Mail::send('emails.correoInformativoEnlaceAudiencia', $data, function ($message) use ($asignar) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                        $message->to($asignar->email, $asignar->nombre_entidad);
                        $message->subject('Enlace Agendamiento de Solicitud Audiencia Virtual');
                        
                    });
        
        return Redirect::to('/tecnicos/mcipios'); 
        
    }

//almacenamiento por la opcion todos
    
     public function almacenartodo(Request $request){
      
     
        $asignar = SolicitudAudiencia::findOrFail($request->id_r);
        $asignar->id_conexion = $request->id_conexion;
        $asignar->enlace = $request->url_conexion;
         $asignar->fecha_asignacion = date("Y-m-d");
        $asignar->save();
        $data              =  json_decode(json_encode($asignar), true);
        
        //dd($asignar->email,$data);
        Mail::send('emails.correoInformativoEnlaceAudiencia', $data, function ($message) use ($asignar) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                        $message->to($asignar->email, $asignar->nombre_entidad);
                        $message->subject('Enlace Agendamiento de Solicitud Audiencia Virtual');
                        
                    });
        
        return Redirect::to('/tecnico/solicitud/audiencias/totales'); 
        
    }

    public function verificarEstado(Request $request){
        //dd($request->id);
       
        if($request->ajax()){
            $solicitud = SolicitudAudiencia::where('id',$request->id)->where('quien_asigno', '!=', null)->first();
            
            if(empty($solicitud)){
                 // no esta asignado
                $asignar = SolicitudAudiencia::findOrFail($request->id);
                $asignar->quien_asigno =  auth()->user()->id;
                
                $asignar->save(); 
               // dd($asignar);
                return 0;
            }else{
                return 1;  // esta asignado
            }

        }


    }
    
     public function soltarEstado(Request $request){
        //dd($request->id);
       
        
            $solicitud = SolicitudAudiencia::where('id',$request->id)->where('quien_asigno', auth()->user()->id)->first();
            //dd($solicitud);
            if(!empty($solicitud)){
                 // no esta asignado
                $asignar = SolicitudAudiencia::findOrFail($request->id);
                $asignar->quien_asigno = NULL;
                
                $asignar->save(); 
               // dd($asignar);
               
               return Redirect::to('/tecnico/solicitud/audiencia/virtual');
           

        }
        return Redirect::to('/tecnicos');


    }
    
     public function soltarEstadoM(Request $request){
        //dd($request->id);
       
        
            $solicitud = SolicitudAudiencia::where('id',$request->id)->where('quien_asigno', auth()->user()->id)->first();
            //dd($solicitud);
            if(!empty($solicitud)){
                 // no esta asignado
                $asignar = SolicitudAudiencia::findOrFail($request->id);
                $asignar->quien_asigno = NULL;
                
                $asignar->save(); 
               // dd($asignar);
               
               return Redirect::to('/tecnicos/mcipios');
           

        }
        return Redirect::to('/tecnicos/mcipios');


    }
    
      public function soltarEstadotodo(Request $request){
        //dd($request->id);
       
        
            $solicitud = SolicitudAudiencia::where('id',$request->id)->where('quien_asigno', auth()->user()->id)->first();
            //dd($solicitud);
            if(!empty($solicitud)){
                 // no esta asignado
                $asignar = SolicitudAudiencia::findOrFail($request->id);
                $asignar->quien_asigno = NULL;
                
                $asignar->save(); 
               // dd($asignar);
               
               return Redirect::to('/tecnico/solicitud/audiencias/totales');
           

        }
        return Redirect::to('/tecnicos/mcipios');


    }
    

   //EDITAR LAS SOLICITUDES ASIGNADAS POR TECNICO
   
   public function asignadaTecnico(Request $request){
        //dd($request->all()== null);
       
        $fechaA =Carbon::now()->toDateString();

        $fecha = $request->fecha;        
        $ciudad = $request->ciudad;
        $email = $request->email;
        $radicado = $request->radicado;
        $entidad = $request->entidad;

        if($request->all() == null){
                
       $solicitudes = SolicitudAudiencia::where('fecha_asignacion','>=',$fechaA)
        ->where('quien_asigno', auth()->user()->id)
        ->orderBy('fecha_asignacion','ASC')
        ->get();
        }else{
           $solicitudes = SolicitudAudiencia::where('quien_asigno',  auth()->user()->id)
        ->fecha($fecha)
        ->ciudad($ciudad)
        ->email($email)
        ->radicado($radicado)
        ->entidad($entidad)
        ->orderBy('fecha_asignacion','ASC')
        ->get();
            
        }
        //dd($solicitudes);
            $solicitudAudiencia = new SolicitudAudiencia();
        return view('audiencias.tecnico.asignadasTec',compact('solicitudes','solicitudAudiencia'));
    }
    
    public function audienciasEditar(Request $request, $id)
    {
       
        $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
      
      return view('audiencias.tecnico.edit',compact('solicitudAudiencia'));
        
        
    }
    
    public function actualizarAudiencia(Request $request, $id)
    {
        //dd($request->all());
        
            
        $this->validate($request, [
            'numero_radicado_proceso'=> 'required|numeric|digits:23',
            'fecha_prgramada' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',           
            'ciudad_destino' => 'required|max:150',
            'entidad_destino' => 'required|max:250',
            'declarante_indiciado' => 'required|max:250',
            //'quien_asigno' => 'required',
            'telefono' => 'required|max:30',
            //'audiencia_privada' => 'required',
            //'detenido' => 'required',
            'enlace' => 'required',
            'id_conexion' => 'required'
            ]);
            
        //$asignar = SolicitudAudiencia::findOrFail($id);
        $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
        
        
        if( auth()->user()->id == $solicitudAudiencia->quien_asigno){
        //dd($asignar); numero_radicado_proceso
        //$solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
            $solicitudAudiencia->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
            $solicitudAudiencia->save();
       /* $asignar->fecha_prgramada = $request->fecha_prgramada;
        $asignar->hora_inicio = $request->hora_inicio;
        $asignar->hora_fin = $request->hora_fin;
        $asignar->numero_radicado_proceso = $request->numero_radicado_proceso;
        $asignar->id_conexion = $request->id_conexion;
        $asignar->enlace = $request->enlace;
        $asignar->save();*/
            
        }else{
           Session::flash('success', 'Prohibido Actualizar, no fue agendada Usted!');
           
        return Redirect::to('tecnico/solicitudes/agendadas');  
        }
            
        Session::flash('success', 'Agendamiento actualizado correctamente!');
           
        return Redirect::to('tecnico/solicitudes/agendadas');    
           
    }
    //solicitude de consolidad de audiencias
    
     public function IndexSolicitudAudiencia(Request $request){
         
         $date = Carbon::now();
         $date2 = Carbon::now();

         $date = $date->format('Y-m-d');
         
         $anho = $date2->format('Y');
         $anhos = array();
         
         for ($i=2020; $i<=$anho; $i++) {
            array_push($anhos,$i);
        }
                 
         //dd($request->anho.'-'.$request->mes);
         
         
             
             $solicitudes = SolicitudAudiencia::where('created_at','like','%'.$date.'%')->paginate(400);
             //dd($solicitudes);
             
         
      
      return view('audiencias.tecnico.consolidadoAudiencias',compact('solicitudes','anhos','date'));

   }
   
    
    
    public function DescargarSolicitudAudiencia(){
        Excel::create('Directorio Siris', function($excel) {
                $excel->sheet('Directorio Siris', function($sheet) {
                    $directorio = DB::select("select codigo_despacho,email, nombre_entidad as Despacho,
                   fecha_prgramada,hora_inicio,hora_fin,ciudad_destino as Ciudad,entidad_destino,numero_radicado_proceso,
                   id_conexion, enlace, created_at as Solicitada, updated_at as asignada FROM solicitud_audiencias");
                    //dd(json_encode($directorio));
                    $data= json_decode( json_encode($directorio), true);    
                    //dd($data);
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('xlsx');

           
       
           Session::flash('message', 'No se encontraron datos para generar el excel');
           
            $revisar=   $this->IndexSolicitudAudiencia();
            return $revisar;
         
       

   }
   
   public function EstadisticaAudiencias(){
       $Estadisticas = EstadisticaDigitalizacion::despacho($requets->despacho)
        ->distrito($requets->distrito)
        ->id_despacho($requets->id_despacho)
        ->especialidad($requets->especialidad)
        ->ciudad($requets->ciudad)
        ->orderBy('id_despacho','ASC')
        ->get();    
   }
   
   public function audienciasBuscar(Request $request)
    {
        $fechaCon = $request->fecha;   
        $radicado = $request->radicado;
        $email = $request->email;
        
         //dd($request->all());
            
        if(empty($request->fecha) && empty($request->radicado) && empty($request->email)){

        $fecha = Carbon::now()->toDateString();
        //dd($fecha);
        $fechademas = Carbon::now();
        $fechademas->addDays(2)->toDateString(); 
           

        $solicitudes = SolicitudAudiencia::
        where('fecha_prgramada', $fecha)
        //->fecha($fechaCon)
        //->paginate(1);
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        //dd($solicitudes);
        }else{

        $solicitudes = SolicitudAudiencia::
        fecha($fechaCon)
        ->radicado($radicado)
        ->email($email)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        
        }
        
        $solicitudAudiencia = new SolicitudAudiencia();
        return view('audiencias.tecnico.editar.audiencias', compact('solicitudes','solicitudAudiencia'));
       
    }
    
    public function audienciasCambio(Request $request, $id)
    {
        //dd($request->all());
        
      $tecnicos=User::where('rol',2)->pluck('name','id');
      //dd($tecnicos);
      $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
      //$solicitudAudiencia->Detenidos;
      //dd($solicitudAudiencia);
      return view('audiencias.tecnico.editar.edit',compact('solicitudAudiencia','tecnicos'));
        
        
    }
    
    
     public function actualizarAudienciaBuscar(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'numero_radicado_proceso'=> 'required|numeric|digits:23',
            'fecha_prgramada' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',           
            //'ciudad_destino' => 'required|max:150',
            //'entidad_destino' => 'required|max:250',
            'declarante_indiciado' => 'required|max:250',
            //'quien_asigno' => 'required',
            'telefono' => 'required|max:30',
            //'audiencia_privada' => 'required',
            //'detenido' => 'required'
            ]);
            
            //dd($request->all());
        
            $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
            $solicitudAudiencia->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
            $solicitudAudiencia->save();
            
            $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
            $solicitudAudiencia->fill($request->All());
            $solicitudAudiencia->save();
            
            Session::flash('success', 'Audiencia actualizada correctamente!');
           
            return Redirect::to('tecnicos');    
           
    }
    
    
    
}
