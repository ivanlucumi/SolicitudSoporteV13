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

use App\Models\BiometriaIngreso;
use App\Models\BiometriaIngresoRegistro;

class SalidaController extends Controller
{
      
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('salidaporteria');
    }
    
    
       public function index()
    {
        
        $fechaA = Carbon::now()->toDateString();
        
        $ingresos = ControlIngreso::where('fecha_ingreso','>=',$fechaA)
        //->where('vehiculo_autorizado','!=',"AUTORIZADO")
        //->where('ingreso',null)
        //->where('salida',null)
        ->get();
        
        //dd($ingresos);
        
         
         $ingresos=BiometriaIngresoRegistro::where('accion','INGRESO')
         ->where('id_porteria','1850')
         ->where('fecha',$fechaA)
         ->count();
         $salidas=BiometriaIngresoRegistro::where('accion','SALIDA')
         ->where('id_porteria','1851')
         ->where('fecha',$fechaA)
         ->count();
        
        $contarUsuario = ControlIngreso::where('salida',null)
        ->where('ingreso','!=',null)
        ->where('fecha_ingreso',$fechaA)
        ->count();
        $verificacion = null;
        //dd($contarUsuario);
        return view('monitoreo.salida.RegistroSalida',compact('ingresos','contarUsuario','verificacion','ingresos','salidas'));
    }
    
    
    public function enviarsectionajax(){
        $view = View::make('monitoreo.parqueadero',compact('comprobanteEntregas','estados','contador','consecutivo'));
		if($request->ajax())
        {

			$sections = $view->renderSections();
            return Response::json($sections['content']); 
        }else return $view;
    
    }
    
    public function registrarIngreso(Request $request, $id){
        //dd($id);
        
        $hora = Carbon::now()->totimeString();
        
        if($request->ajax())
        {
            
            $control = ControlIngreso::find($id);
            
            if($control->ingreso === null){
                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                 $control->save(); 
            }else{
                $control->salida = NULL;
                 $control->save(); 
            }
        }
        
    }
    

    public function verificaringreso(Request $request, $id){ 
            //dd($id);
        $solicitudeUsuario = null;
        $results = array();
        
         $fechaA = Carbon::now()->toDateString();
         //hora actual menos 30 min
         $hora = Carbon::now()->totimeString();
         $horaA = Carbon::now()->subMinutes(20); 
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
            
                             if($control->ingreso != null){
                                    $control->salida = NULL;
                                     $control->hora_salida = NULL;
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
                        
                        
                                if($solicitudeUsuario->tipo_solicitud == 'VISITANTE'){
                        //dd($solicitudeUsuario);
                        if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                        && $solicitudeUsuario->hora_ingreso <= $horaM10){
                            
                            //dd('hola');
                            
                             $control = ControlIngreso::find($solicitudeUsuario->id);
            
                                            if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->salida = NULL;
                                                 $control->save(); 
                                            }
                                            
                                            if($control->ingreso != null){
                                                 $control->salida = NULL;
                                                 $control->hora_salida = NULL;
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
        $id = intval($id);
        $fechaA = Carbon::now()->toDateString();
         $hora = Carbon::now()->totimeString();
        
        $UsuarioHora = ControlIngreso::where('identificacion',$id)
        ->where('fecha_ingreso',$fechaA)
        //->where('ingreso','!=', null)
        //->where('hora_ingreso','<', $hora)
        ->where('salida', null)
        ->get();
        
       // dd($UsuarioHora->count());
        
        if($UsuarioHora->count() != 0 ){
            
           foreach ($UsuarioHora as  $value) {
            //dd($value,$value->id ,'hola');
           $control = ControlIngreso::find($value->id); 
           $control->salida =  auth()->user()->name.' a las '.$hora;
           $control->hora_salida = $hora;
           $control->save(); 
          }
          
          $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz día!!'];
          
        
        
        }else{
            //dd($UsuarioHora);
            $mensaje = ['mensaje' => 'No ha reportado ingreso o ya lo realizó la Salida <br>Feliz día!'];
            
        }
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
        
        
        
        //dd($UsuarioHora);
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
    
         /*public function registrarSalidaPorteria(Request $request, $id){
       $id = intval($id);
        $fechaA = Carbon::now()->toDateString();
         $hora = Carbon::now()->totimeString();
         
         
         $ingresos=BiometriaIngresoRegistro::where('accion','INGRESO')
         ->where('id_porteria','1850')
         ->where('fecha',$fechaA)
         ->count();
         $salidas=BiometriaIngresoRegistro::where('accion','SALIDA')
         ->where('id_porteria','1851')
         ->where('fecha',$fechaA)
         ->count();
         
        
        $verificacion = BiometriaIngreso::where('identificacion',$id)
        ->first();
        
       // dd($verificacion->count());
        
        if(!empty($verificacion)){
            
           
            $BiometriaIngresoRegistro = New BiometriaIngresoRegistro();
             
                    $BiometriaIngresoRegistro->biometria_ingresos_id = $verificacion->id;
                    $BiometriaIngresoRegistro->accion = "SALIDA";
                    $BiometriaIngresoRegistro->fecha = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->fecha_salida = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->hora_salida = Carbon::now()->toTimeString();
                    $BiometriaIngresoRegistro->id_porteria =  auth()->user()->id;
                    $BiometriaIngresoRegistro->porteria_salida =  auth()->user()->direccion_porteria;
                    $BiometriaIngresoRegistro->save();
          //DD($BiometriaIngresoRegistro);
          
          
          $ingresos=BiometriaIngresoRegistro::where('accion','INGRESO')
         ->where('id_porteria','1850')
         ->where('fecha',$fechaA)
         ->count();
         $salidas=BiometriaIngresoRegistro::where('accion','SALIDA')
         ->where('id_porteria','1851')
         ->where('fecha',$fechaA)
         ->count();
          
          
          $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz día!!','codigo'=>'1','SALIDAS'=>$salidas,'INGRESOS'=>$ingresos];
          
        
        
        }else{
            //dd($UsuarioHora);
            $mensaje = ['mensaje' => 'Error al Registra la salida, cedula ' . $id .' no esta registrada <br>Feliz día!','codigo'=>'1','SALIDAS'=>$salidas,'INGRESOS'=>$ingresos];
            
        }
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
        
        
        
        //dd($UsuarioHora); 
    }*/
    
 public function registrarSalidaPorteria(Request $request, $id)
    {
        $id = intval($id);
        $fechaActual = Carbon::now()->toDateString();
        $horaActual = Carbon::now()->toTimeString();
        $usuario =  auth()->user();
    
        // Buscar la persona en BiometriaIngreso
        $persona = BiometriaIngreso::where('identificacion', $id)->first();
    
        if (!$persona) {
            return response()->json([
                'mensaje' => "❌ Error: la cédula {$id} no está registrada en el sistema.",
                'codigo' => '0',
            ]);
        }
        
    
        
    
        // Usamos transacción para evitar race conditions
        $resultado = DB::transaction(function () use ($persona, $fechaActual, $horaActual, $usuario) {
    
            // Bloqueamos los registros del día para esta persona para conteos consistentes
            $registrosHoy = BiometriaIngresoRegistro::where('biometria_ingresos_id', $persona->id)
                ->where('fecha', $fechaActual)
                ->lockForUpdate()
                ->get();
    
            // Contar ingresos y salidas **solo para esta persona**
            $ingresosPersona = $registrosHoy->where('accion', 'INGRESO')->count();
            $salidasPersona = $registrosHoy->where('accion', 'SALIDA')->count();
            
            $ingresos=BiometriaIngresoRegistro::where('accion','INGRESO')
             ->where('id_porteria','1850')
             ->where('fecha',$fechaActual)
             ->count();
             $salidas=BiometriaIngresoRegistro::where('accion','SALIDA')
             ->where('id_porteria','1851')
             ->where('fecha',$fechaActual)
             ->count();
            
    
            // Si no hay ingresos para la persona hoy => no se permite registrar salida
            if ($ingresosPersona === 0) {
                return [
                    'mensaje' => "⚠️ No se puede registrar salida: la cédula {$persona->identificacion} no tiene ingresos registrados para hoy ({$fechaActual}).",
                    'codigo' => '0',
                    'SALIDAS' => $salidas,
                    'INGRESOS' => $ingresos
                ];
            }
            
            $ingresos=BiometriaIngresoRegistro::where('accion','INGRESO')
             ->where('id_porteria','1850')
             ->where('fecha',$fechaActual)
             ->count();
             $salidas=BiometriaIngresoRegistro::where('accion','SALIDA')
             ->where('id_porteria','1851')
             ->where('fecha',$fechaActual)
             ->count();
    
            // Si hay menos salidas que ingresos para esta persona => registrar salida
            if ($salidasPersona < $ingresosPersona) {
                $registro = new BiometriaIngresoRegistro();
                $registro->biometria_ingresos_id = $persona->id;
                $registro->accion = "SALIDA";
                $registro->fecha = $fechaActual;
                $registro->fecha_salida = $fechaActual;
                $registro->hora_salida = $horaActual;
                $registro->id_porteria = $usuario->id;
                $registro->porteria_salida = $usuario->direccion_porteria ?? null;
                $registro->save();
    
                return [
                    'mensaje' => "✅ Salida registrada correctamente a las {$horaActual}.",
                    'codigo' => '1',
                    'SALIDAS' => $salidas,
                    'INGRESOS' => $ingresos
                ];
            }
    
            // Si las salidas ya alcanzaron/incluso superan los ingresos => actualizar la última salida de la persona hoy
            $ultimaSalida = $registrosHoy->where('accion', 'SALIDA')->sortByDesc('id')->first();
    
            if ($ultimaSalida) {
                $ultimaSalida->hora_salida = $horaActual;
                $ultimaSalida->fecha_salida = $fechaActual;
                $ultimaSalida->id_porteria = $usuario->id;
                $ultimaSalida->porteria_salida = $usuario->direccion_porteria ?? null;
                $ultimaSalida->save();
    
                return [
                    'mensaje' => "ℹ️ Ya existen tantas salidas como ingresos para esta persona. Se actualizó el último registro de salida a las {$horaActual}.",
                    'codigo' => '2',
                    'SALIDAS' => $salidas,
                    'INGRESOS' => $ingresos
                ];
            }
    
            // Caso borde: no hay salida para actualizar (aunque salidasPersona >= ingresosPersona)
            return [
                'mensaje' => "⚠️ No se pudo registrar ni actualizar salida: estado inconsistente, contacte al administrador.",
                'codigo' => '0',
                'SALIDAS' => $salidas,
                'INGRESOS' => $ingresos
            ];
        }); // fin transaction
    
        return response()->json($resultado);
    }

    
  
}
