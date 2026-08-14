<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Despacho;
use App\Models\Normalizacion;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


use App\Models\Empleado;

use App\Mail\NotificacionSolicitudAlmacen;

use App\Models\SolicitudAlmacen;
use App\Models\InventarioAlmacen;
use App\Models\InventarioCircuito;

class SolicitudAlmacenController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        //$this->middleware('cambiopass');
        //$this->middleware('almacen');
        
        $this->middleware('usuario');
        
    }
    
    public function index()
    {
        $user = auth()->user()->cedula;
           $fecha=Carbon::Now();
           // $dia_semana=$fecha->dayOfWeek;
           $mes = $fecha->month;
       
        $solicitudes=SolicitudAlmacen::where('mes_solicitud',$mes)
        ->where('fecha_respuesta',null)
        ->where('id_despacho',$user)
        ->get();
        
        $Estado=SolicitudAlmacen::where('mes_solicitud',$mes)
        ->where('id_despacho',$user)
        ->where('estado_solicitud','ENVIADO')
        ->where('cantidad_entregada','!=',null)
        ->count();
        
        //dd($Estado);
        
        $despacho = Despacho::where('codigoDespacho', auth()->user()->cedula)->first();
        
        if(!$despacho){
          $inventario=InventarioAlmacen::where('status','Disponible')->
            orderBy('descripcion', 'ASC')
            ->get();   
        }else{
        
          
            
           $inventario =InventarioCircuito::InventarioAlmacenCircuito2($despacho->circuito); 
           
           
        }
        
        /*$inventario=InventarioAlmacen::where('status','Disponible')->
        orderBy('descripcion', 'ASC')
        ->get();
        
        if( auth()->user()->email =="siriscali@cendoj.ramajudicial.gov.co"){
            
             // $despacho = Despacho::where('codigoDespacho', auth()->user()->cedula)->first();   ///$despacho->circuito
             $despacho = Despacho::where('codigoDespacho',1020218772)->first();
             
             //DD($despacho->circuito);
             
            
        
        if($despacho){
            
            //dd($despacho);
            
            
            $inventario =InventarioCircuito::InventarioAlmaceCircuito($despacho->circuito);
            
            dd($inventario);
            
            if(empty($inventario)){
                
                
               $inventario=InventarioAlmacen::where('status','Disponible')->
                orderBy('descripcion', 'ASC')
                ->get();  
                
                dd("entro a vacio",$inventario);
                
            }
            
        }else{
          $inventario=InventarioAlmacen::where('status','Disponible')->
            orderBy('descripcion', 'ASC')
            ->get();  
            
        }
            
        }*/
        //dd($solicitudes);
        return view('usuario.Almacen.Index',compact('solicitudes','inventario','Estado'));
    }
    public function Historico()
    {
        $user = auth()->user()->cedula;
           
       
        $Solicitudes=SolicitudAlmacen::where('fecha_respuesta','!=',null)
        ->where('id_despacho',$user)
        ->get();
        
        //dd($Solicitudes);
        return view('usuario.Almacen.Historico',compact('Solicitudes'));
    }
    
    //Historico

    public function store(Request $request)
    {
        
        //DD($request->ALL());
        $this->validate($request, [
                'elemento' => 'required',
                'cantidad'=>'required|numeric',
                //'observaciones'=>'required',
            ]);
        
        DB::beginTransaction();
        try{    
        
        $despacho = Despacho::where('codigoDespacho', auth()->user()->cedula) 
        ->select('circuito')
        ->first();
        
        if(Empty($despacho)){
           Session::flash('error', 'No tiene Tiene Circuito Asignado!');
            return Redirect::back(); 
        }
        
        
        $fecha=Carbon::Now();
       // $dia_semana=$fecha->dayOfWeek;
       $mes = $fecha->month;
        
        $consulta = SolicitudAlmacen::where('elemento',$request->elemento)
        ->where('id_despacho', auth()->user()->cedula)
        ->where('mes_solicitud',$mes)->first();
        
        //DD($consulta);
        
        if(!empty($consulta)){
           return response()->json(['error' => 'El elemento ya está registrado en este mes.']);
       
        }
        
        if(empty($request->observaciones)){
            $observaciones='N/A';
        }else{
           $observaciones= $request->observaciones;
        }
        
        $Elemento = InventarioAlmacen::where('descripcion',$request->elemento)->first();
        
        if(empty($Elemento)){
            $Elemento = InventarioAlmacen::where('descripcion','OTRO')->first();
        }
        
        //dd($Elemento,'valor');
        
        
        $elementos = new SolicitudAlmacen();
        $elementos->id_elemento = $Elemento->inventario_id;
        $elementos->elemento = $request->elemento;
        $elementos->cantidad = $request->cantidad;
        $elementos->observaciones = $request->observaciones;
        $elementos->id_despacho = auth()->user()->cedula;
        $elementos->despacho = auth()->user()->name." ". auth()->user()->lastname;
        if( auth()->user()->tipo_rol =="OFICINA"){
            $elementos->circuito = "CALI";
        }else{
        $elementos->circuito = $despacho->circuito;
        }
        
        $elementos->correo_despacho =  auth()->user()->email;
        $elementos->mes_solicitud =$mes;
        $elementos->fecha_solicitud =$fecha;
        $elementos->save();
        
        
       /* if(!empty( auth()->user()->codigo_oficina_almacen)){
             InventarioCircuito::updateOrCreate(
            [
                'inventario_general_id' => $Elemento->inventario_id,
                'circuito' =>  auth()->user()->circuito,
            ],
            [
                'user_id' =>  auth()->user()->codigo_oficina_almacen,
                //'cantidad_disponible' => $request->cantidad_disponible,
                'status' => 'Disponible'
            ]
        );
        }*/
        
        
            
        DB::commit();
        
        // dd($request->all());
        //$item = SolicitudAlmacen::create($request->all());
        return response()->json($elementos);
        
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
       
    }

    public function destroy($id)
    {
        SolicitudAlmacen::destroy($id);
        return response()->json(['success' => true]);
    }
    
    public function CerrarSolicitud(Request $request){
        
        //dd($request->all());
        
        //codigo de seguimiento
            $key = '';
            $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ$abcdefghijklmnopqrstuvwxyz';
            $max     = strlen($pattern)-1;
       
            for ($p = 0; $p < 12; $p++)
            {
                $key .= ($p%2) ? $pattern[mt_rand(27, 49)] : $pattern[mt_rand(0, 28)];
            }
       
       DB::beginTransaction();
        try{ 
        
        $user=   auth()->user()->cedula;
        //$user= $request->id_despacho;
        
        // Obtener la fecha y otros datos necesarios
        $fecha = Carbon::now();
        $mes = $fecha->month;
        
        $Solicitud = SolicitudAlmacen::where('id_despacho',$user)
            ->where('mes_solicitud', $mes)
            ->where('estado_solicitud', null)
            ->get();
            
        //dd($Solicitud->isEmpty(),$Solicitud);
        if($Solicitud->isEmpty()){
           Session::flash('error', 'No tiene Elementos Pendientes por Enviar!');
            return Redirect::back(); 
        }else{
          $Solici = SolicitudAlmacen::where('id_despacho',$user)
            ->where('mes_solicitud', $mes)
            ->where('estado_solicitud', null)
            ->first(); 
         $nombreDespacho = $Solici->NomDespacho->nombreDespacho ?? 'Nombre no disponible';
         
         // Actualizar el estado de las solicitudes
            SolicitudAlmacen::where('id_despacho', $user)
                ->where('mes_solicitud', $mes)
                ->where('estado_solicitud', null)
                ->update(['estado_solicitud' => 'ENVIADO',
                'cedula'=>$request->cedula,
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido,
                'num_seguimiento'=>$key]);
        }
        
        $despacho = Despacho::where('codigoDespacho', auth()->user()->cedula) 
        ->select('circuito')
        ->first();
        
        if(Empty($despacho)){
           Session::flash('error', 'No tiene Tiene Circuito Asignado!');
            return Redirect::back(); 
        }
        
        $mailOficina = SolicitudAlmacen::Oficinas($despacho->circuito);
        
        //$mailOficina ='siriscali@cendoj.ramajudicial.gov.co';
        
        $email =  auth()->user()->email;
        //$email = 'gmstdesajvalle3@cendoj.ramajudicial.gov.co';
        //$email = $request->correo_despacho;
        
        $elementos = $Solicitud->toArray();
        
        //dd($elementos);
        
        if($despacho->circuito != "CALI"){
           // Enviar el correo utilizando un Mailable
            Mail::to([$email,$mailOficina])->send(new NotificacionSolicitudAlmacen($elementos, $nombreDespacho)); 
        }
        
        
        
        DB::commit();
        
        Session::flash('success', 'Se Ha realizado Solicitud a Almacen!');
        return Redirect::back();
        
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
        
    }
    
        public function consultaCedulaE(Request $request,$id){
         
         //dd($id);
        
                
                $empleado = Empleado::where('cedulaE',$id)->get();
                
                //dd($empleado);
                
               // dd($empleado,$empleado->count() );
                
                if($empleado->count() >= 2){
                 //$persona = Empleado::where('cedulaE',$id)->where('clase_nombramiento','PROVISIONALIDAD')->first(); 
                 $persona = DB::table('empleados')
                    ->where('cedulaE', $id)
                    ->where('clase_nombramiento','PROVISIONALIDAD')
                    ->join('despachos', 'empleados.cod_despacho', '=', 'despachos.codigoDespacho')
                    ->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
                    ->select('empleados.*', 'despachos.*', 'ciudades.*')
                    ->get();
                  //dd('entros a 0');
                }else{
                 //$persona = Empleado::where('cedulaE',$id)->first();   
                 $persona = DB::table('empleados')
                    ->where('cedulaE', $id)
                    //->where('clase_nombramiento','PROVISIONALIDAD')
                    ->join('despachos', 'empleados.cod_despacho', '=', 'despachos.codigoDespacho')
                    ->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
                    ->select('empleados.*', 'despachos.*', 'ciudades.*')
                    ->get();
                }
            $persona->asignacion="Empleado";
       
        
        
        
        if($request->ajax())
        {
         
          return response()->json($persona);
        }
        
        
    }
    
    
    
}
