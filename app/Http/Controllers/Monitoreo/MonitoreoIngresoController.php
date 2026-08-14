<?php

namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Carbon;

use App\Models\ControlIngreso;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Despacho;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;


class MonitoreoIngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('monitoreo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $fechaA = Carbon::now()->toDateString();
        
        $ingresos = ControlIngreso::where('fecha_ingreso','>=',$fechaA)
        //->where('vehiculo_autorizado','!=',"AUTORIZADO")
       // ->where('ingreso',null)
        //->where('salida',null)
        
        ->get();
        
      
        return view('monitoreo.index',compact('ingresos'));
    }

    public function verificaringreso(Request $request, $id){ 
            //dd($id);
        $solicitudeUsuario = null;
        $results = array();
        
         $fechaA = Carbon::now()->toDateString();
         //hora actual menos 30 min
         $hora = Carbon::now()->totimeString();
         $horaA = Carbon::now()->subMinutes(10); 
         $horaMenos30 = $horaA->totimeString();

         //hora actual mas 10 mmin
         $horaM = Carbon::now()->totimeString();
         $horaM = Carbon::now()->addMinutes(10); 
         $horaM10 = $horaM->totimeString();
         
         //dd($hora);
         $UsuarioHoras = ControlIngreso::where('identificacion',$id)
            ->where('fecha_ingreso',$fechaA)
            ->get(); 
//dd($UsuarioHoras);
         //salir si no se encuentra resultado
            if($UsuarioHoras == null){
                $solicitudeUsuario = null;
                if($request->ajax())
                    {                    
                    return response()->json($solicitudeUsuario);
                    }
            }
            

            foreach ($UsuarioHoras as $solicitudeUsuario1) {
                
                        if($solicitudeUsuario1->tipo_solicitud == 'EMPLEADO'){
                            $control = ControlIngreso::find($solicitudeUsuario1->id);
            
                                    if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->save(); 
                                            }
                            //dd($solicitudeUsuario1->vehiculo_autorizado);
                            if($solicitudeUsuario1->vehiculo_autorizado === "AUTORIZADO"){
                                        
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo); 
                                    //dd($vehiculoIng );
                                    }else{
                                    $vehiculoIng = null; 
                                    }
                                    
                                            
                                    array_push($results,$solicitudeUsuario1);
                                    array_push($results, $vehiculoIng);
                                    
                                    
                                
                                    $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario,'entro');
                                    if($request->ajax())
                                        { 
                                        
                                        return response()->json($solicitudeUsuario);
                                        } 
                                                    
                            

                        }
                        

                    }
                    //PROVEEDOR
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                        if($solicitudeUsuario->tipo_solicitud == 'PROVEEDOR'){
                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                            && $solicitudeUsuario->hora_ingreso <= $horaM10){
                                
                                 $control = ControlIngreso::find($solicitudeUsuario->id);
            
                                            if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->save(); 
                                            }

                                //dd($solicitudeUsuario);
                                if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                    //dd($vehiculoIng);  
                                    }else{
                                        $vehiculoIng = null; 
                                        }
                                        array_push($results,$solicitudeUsuario);
                                        array_push($results, $vehiculoIng);
                                        
                                        $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario);
                                        if($request->ajax())
                                            {
                                                
                                            
                                            return response()->json($solicitudeUsuario);
                                            }
                            }

                                    }
            
               }

                            //visitante
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                                if($solicitudeUsuario->tipo_solicitud == 'VISTANTE'){
                        //dd($solicitudeUsuario);
                        if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                        && $solicitudeUsuario->hora_ingreso <= $horaM10){
                            
                             $control = ControlIngreso::find($solicitudeUsuario->id);
            
                                            if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->save(); 
                                            }

                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                //dd($vehiculoIng);  
                                }else{
                                    $vehiculoIng = null; 
                                    }
                                    
                                    array_push($results,$solicitudeUsuario);
                                    array_push($results, $vehiculoIng);
                                    
                                    $solicitudeUsuario =$results;
                            //dd($solicitudeUsuario);
                                    if($request->ajax())
                                        {
                                           
                                        
                                        return response()->json($solicitudeUsuario);
                                        }
                        }

                                }
                    
                       }
     
      

    }

    

    //CoordVerificarIngreso
    public function CoordVerificarIngreso(Request $request, $id){ 
        //dd($id);
        $solicitudeUsuario = null;
        $results = array();
        
         $fechaA = Carbon::now()->toDateString();
         //hora actual menos 30 min
         $hora = Carbon::now()->totimeString();
         $horaA = Carbon::now()->subMinutes(10); 
         $horaMenos30 = $horaA->totimeString();

         //hora actual mas 10 mmin
         $horaM = Carbon::now()->totimeString();
         $horaM = Carbon::now()->addMinutes(10); 
         $horaM10 = $horaM->totimeString();
         
         //dd($hora);
         $UsuarioHoras = ControlIngreso::where('identificacion',$id)
            ->where('fecha_ingreso',$fechaA)
            ->get(); 
//dd($UsuarioHoras);
         //salir si no se encuentra resultado
            if($UsuarioHoras == null){
                $solicitudeUsuario = null;
                if($request->ajax())
                    {                    
                    return response()->json($solicitudeUsuario);
                    }
            }
            

            foreach ($UsuarioHoras as $solicitudeUsuario1) {
                
                        if($solicitudeUsuario1->tipo_solicitud == 'EMPLEADO'){

                            //dd($solicitudeUsuario1->vehiculo_autorizado);
                            if($solicitudeUsuario1->vehiculo_autorizado === "AUTORIZADO"){
                                        
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo); 
                                    //dd($vehiculoIng );
                                    }else{
                                    $vehiculoIng = null; 
                                    }
                                    $control = ControlIngreso::find($solicitudeUsuario1->id);
                                    
                                            
                                    array_push($results,$solicitudeUsuario1);
                                    array_push($results, $vehiculoIng);
                                
                                    $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario,'entro');
                                    if($request->ajax())
                                        {                                        
                                        return response()->json($solicitudeUsuario);
                                        } 
                                                    
                            

                        }
                        

                    }
                    //PROVEEDOR
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                        if($solicitudeUsuario->tipo_solicitud == 'PROVEEDOR'){
                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                            && $solicitudeUsuario->hora_ingreso <= $horaM10){

                                //dd($solicitudeUsuario);
                                if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                    //dd($vehiculoIng);  
                                    }else{
                                        $vehiculoIng = null; 
                                        }
                                        array_push($results,$solicitudeUsuario);
                                        array_push($results, $vehiculoIng);
                                        
                                        $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario);
                                        if($request->ajax())
                                            {
                                            
                                            return response()->json($solicitudeUsuario);
                                            }
                            }

                                    }
            
               }

                            //visitante
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                                if($solicitudeUsuario->tipo_solicitud == 'VISTANTE'){
                        //dd($solicitudeUsuario);
                        if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                        && $solicitudeUsuario->hora_ingreso <= $horaM10){

                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                //dd($vehiculoIng);  
                                }else{
                                    $vehiculoIng = null; 
                                    }
                                    array_push($results,$solicitudeUsuario);
                                    array_push($results, $vehiculoIng);
                                    
                                    $solicitudeUsuario =$results;
                            //dd($solicitudeUsuario);
                                    if($request->ajax())
                                        {
                                        
                                        return response()->json($solicitudeUsuario);
                                        }
                        }

                                }
                    
                       }

                       
    }
   

    public function contarUsuarios(Request $request){
        $fechaA = Carbon::now()->toDateString();
        $contarUsuario = ControlIngreso::where('hora_salida',null)
        ->where('ingreso','!=',null)
        ->where('fecha_ingreso',$fechaA)
        ->count();
        //dd($contarUsuario);
        if($request->ajax())
        {
         
          return response()->json($contarUsuario);
        }

        
    }
    
     public function verificarVehiculo(Request $request,$id)
    {
        //dd($id);
        $vehiculo = ControlIngreso::find($id);
        //dd($vehiculo);
        
        
        
        if($request->ajax())
        {
            if( $vehiculo != null){
                if( $vehiculo->vehiculo != null){
               $vehiculoIng = Vehiculo::find($vehiculo->vehiculo);
               //dd($vehiculoIng);
                return response()->json($vehiculoIng);
           }else{
               $vehiculoIng = null;
                return response()->json($vehiculoIng);
           }
        }
         
          
        }
    }
    
     public function autorizarVehiculo(Request $request,$id)
    {
        //dd($id);
        $ControlIngreso = ControlIngreso::find($id);
        //dd($ControlIngreso);
        
        
        $mensaje = ['mensaje' => 'No se puede autorizar Vehiculo <br> Feliz día!!'];
        $fechaA = Carbon::now()->toDateString();
        
        if( $ControlIngreso != null){
        $ingresos = ControlIngreso::where('identificacion',$ControlIngreso->identificacion)
        ->where('quien_solicito',$ControlIngreso->quien_solicito)
        ->where('vehiculo',$ControlIngreso->vehiculo)
        ->get();
        //dd($ingresos);
        
        foreach ($ingresos as  $value) {
            //dd($value->id);
            if($value->vehiculo_autorizado == "PENDIENTE" || $value->vehiculo_autorizado == "NEGADO") {
                if($fechaA <= $value->fecha_ingreso   ){
                   $value->vehiculo_autorizado = "AUTORIZADO";
                   $value->save();  
                }
               
               }   
                
            }
               
               $mensaje = ['mensaje' => 'Vehículo Autorizado <br> Feliz día!!'];
           
        }else{
            $mensaje = ['mensaje' => 'No se puede autorizar Vehiculo <br> Feliz día!!']; 
        }
        
       
        
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
    }
    
     public function denegarVehiculo(Request $request,$id)
    {
        //dd($id);
        $ControlIngreso = ControlIngreso::find($id);
        //dd($ControlIngreso);
        
        
        $mensaje = ['mensaje' => 'Error al Negar Ingreso de Vehículo <br> Feliz día!!'];
        $fechaA = Carbon::now()->toDateString();
        
        if( $ControlIngreso != null){
        $ingresos = ControlIngreso::where('identificacion',$ControlIngreso->identificacion)
        ->where('quien_solicito',$ControlIngreso->quien_solicito)
        ->where('vehiculo',$ControlIngreso->vehiculo)
        ->get();
        //dd($ingresos);
        
        foreach ($ingresos as  $value) {
            //dd($value->id);
            if($value->vehiculo_autorizado == "PENDIENTE") {
                if($fechaA <= $value->fecha_ingreso   ){
                   $value->vehiculo_autorizado = "NEGADO";
                   $value->save();  
                }
               
               }   
                
            }
               
               $mensaje = ['mensaje' => 'Se Negó El ingreso de este Vehiculo <br> Feliz día!!'];
           
        }else{
            $mensaje = ['mensaje' => 'Error al Negar Ingreso de Vehículo <br> Feliz día!!']; 
        }
        
       
        
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
    }
    
    
    public function reportarSalida(Request $request, $id){
        
        $fechaA = Carbon::now()->toDateString();
         $hora = Carbon::now()->totimeString();
        
        $UsuarioHora = ControlIngreso::where('identificacion',$id)
        ->where('fecha_ingreso',$fechaA)
        ->where('ingreso','!=', null)
        ->where('hora_ingreso','<', $hora)
        ->where('salida', null)
        ->get();
        
        //dd($UsuarioHora->count());
        
        if($UsuarioHora->count() != 0 ){
            
           foreach ($UsuarioHora as  $value) {
            //dd($value,$value->id ,'hola');
           $control = ControlIngreso::find($value->id); 
           $control->salida =  auth()->user()->name.' a las '.$hora;
           $control->save(); 
          }
          
          $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz día!!'];
          
        
        
        }else{
            //dd($UsuarioHora);
            $mensaje = ['mensaje' => 'No ha reportado ingreso o ya lo realizó <br>Feliz día!'];
            
        }
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
        
        
        
        //dd($UsuarioHora);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function registroIngreso(Request $request)
    {
        if($request['cedula'] == null){
            $fecha = Carbon::now()->toDateString();
        }else{
           $fecha = $request['fecha'];
        }
        
        
        //dd($request['cedula']);
        $ingresos = ControlIngreso::where('quien_solicito', auth()->user()->id)
        ->cedulai($request['cedula'])
        ->fechai($fecha)
        ->radicadoi($request['radicado'])
        ->orderBy('fecha_ingreso', 'ASC')
        ->orderBy('hora_ingreso', 'ASC')
        ->get();
        
        return view('monitoreo.reg_ingreso.index',compact('ingresos'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agendamiento()
    {
        $despacho = Despacho::select('nombreDespacho')->where('correoD','=', auth()->user()->email)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
        //dd($nombreDespacho);
       return view('monitoreo.reg_ingreso.agendamiento',compact('nombreDespacho'));
    }

    public function agendamientoStore(Request $request)
    {
        $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->nombre = $request['nombre'];
            $visita->apellidos = $request['apellidos'];
            $visita->fecha_ingreso = $request['fecha_ingreso'];
            $visita->hora_ingreso = $request['hora_ingreso'];
            $visita->radicado = $request['radicado'];
            $visita->despacho = $request['nombre_despacho'];
            $visita->save();
            return redirect()->back();
    }
    
  

   
}
