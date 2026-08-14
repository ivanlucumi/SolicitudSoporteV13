<?php

namespace App\Http\Controllers;

use App\Models\ProgramacionCapcitacion;
use App\Models\ProgramacionVisitaSiugj;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;



use App\Models\AProgramacionCapacitacionSiugj;
use App\Models\ACapacitacionSiugj;

class ProgramacionCapcitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('checarsesion');
        
        //$this->middleware('usuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->rol == 1){
          $users=ProgramacionCapcitacion::where('created_at','>','2025-10-27 00:00:00')
          //->where('tipo_capacitacion','PRESENCIAL')
          ->get();  
          
          //DD($users);
        }
        if( auth()->user()->rol == 3){
           $users=ProgramacionCapcitacion::where('codigo_despacho', auth()->user()->cedula)
           //->where('tipo_capacitacion','PRESENCIAL')
           ->where('created_at','>','2025-10-27 00:00:00')
        ->get(); 
        
        }      

        $TotalRegistro = ProgramacionCapcitacion::TotalRegistros();
        //dd($TotalRegistro);

        $fecha= ProgramacionCapcitacion::fecha();
        $jornada= ProgramacionCapcitacion::jornada();        
        $participacion= ProgramacionCapcitacion::participacion();
        
        $cantidadJorn = ProgramacionCapcitacion::selectRaw('jornada, COUNT(*) as total')
        ->groupBy('jornada')
        ->get();
        //dd($cantidadJorn);
        
        if( auth()->user()->rol == 1){
            Session::flash('message', 'Solo Los Despachos Pueden Agendar Capacitacion');
            return Redirect::to('/');
           //return view ('administrador.capacitacion.index',compact('users','fecha','jornada','participacion','TotalRegistro','cantidadJorn'));

          }
          if( auth()->user()->rol == 3){
            return view ('usuario.Capacitacion.index',compact('users','fecha','jornada','participacion','TotalRegistro','cantidadJorn'));
    }
          } 
        
        
        

    public function store(Request $request)
    {
        //dd($request->all());
        
        $this->validate($request, [
                'codigo_despacho' => 'required|numeric',
                'despacho'=>'required',
                'identificacion'=>'required|numeric',//|unique:programacion_capacitacion,identificacion
                'nombre'=>'required',
                'correo'=>'required|email',
                'fecha'=>'required',
                'jornada'=>'required',
            ]);

        $Consulta=ProgramacionCapcitacion::where('jornada',$request->jornada)
        ->where('fecha',$request->fecha)
        ->where('tipo_capacitacion','PRESENCIAL')
        ->count();

        
        if($Consulta > 30){
            $mensaje='Ya no esta disponible este horario, el registro ya se asigno. Agradecemos escoger un horario diferente a '.$request->fecha.' en la jornada '.$request->jornada;
            Session::flash('error',$mensaje);
           return Redirect::back();
        }else{
           $lista = new ProgramacionCapcitacion() ;
           $lista->codigo_despacho = $request->codigo_despacho;
           $lista->despacho = $request->despacho;
           $lista->identificacion = $request->identificacion;
           $lista->nombre = $request->nombre;
           $lista->correo = $request->correo;
           $lista->fecha = $request->fecha;
           $lista->jornada = $request->jornada;
           $lista->tipo_capacitacion = "PRESENCIAL";//$request->tipo_capacitacion;
           
           $lista->save();
        }
        Session::flash('message', ' Registro Exitoso!');
       return Redirect::to('usuarios/solicitud/capacitacion');

        
    }

    public function reporteCapacitacion(){
       //$resultado=ProgramacionCapcitacion::all();
       $users=ProgramacionCapcitacion::all();

       

        $TotalRegistro = ProgramacionCapcitacion::TotalRegistros();
        //dd($TotalRegistro);


        $fecha= ProgramacionCapcitacion::fecha();
        $jornada= ProgramacionCapcitacion::jornada();        
        $participacion= ProgramacionCapcitacion::participacion();

        

        return view ('administrador.capacitacion.index',compact('users','fecha','jornada','participacion','TotalRegistro'));
    }
    
    public function verificarCupo(Request $request){
        
        //dd($request->all());
        
    $fecha = $request->input('fecha');
    $jornada = $request->input('jornada');
    
    // Consulta para contar cuántas personas están inscritas en esa fecha y jornada
    $cantidadInscritos = ProgramacionCapcitacion::where('fecha', $fecha)
        ->where('jornada', $jornada)
        ->count();
    

    $cupoMaximo = 30;

    // Si hay espacio, retornamos una respuesta positiva
    if ($cantidadInscritos < $cupoMaximo) {
        return response()->json(['disponible' => true]);
    } else {
        return response()->json(['disponible' => false]);
    }
        
    }
    
    
    
    public function Siugj(Request $request){
        
        $fechaSiugj= ProgramacionCapcitacion::fechaSiugj();
        $jornada= ProgramacionCapcitacion::jornadaSiugj();        
        $participacion= ProgramacionCapcitacion::participacion();
        
        $TotalRegistro = ProgramacionCapcitacion::TotalRegistrosSiugj();
        
        $users=ProgramacionCapcitacion::where('tipo_capacitacion','SIUGJ')
        ->where('codigo_despacho', auth()->user()->cedula)
        ->get();  
        $jornadaSiugj= ProgramacionCapcitacion::jornadaSiugj();
        return view ('usuario.Capacitacion.Siugj',compact('users','jornadaSiugj','fechaSiugj','TotalRegistro'));
        
    }
    
    public function storeSiugj(Request $request)
    {
        //dd($request->all());
        
        $this->validate($request, [
                'codigo_despacho' => 'required|numeric',
                'despacho'=>'required',
                'identificacion'=>'required|numeric|unique:programacion_capacitacion,identificacion',
                'nombre'=>'required',
                'correo'=>'required|email',
                'fecha'=>'required',
                'jornada'=>'required',
            ]);

        $Consulta=ProgramacionCapcitacion::where('jornada',$request->jornada)
        ->where('fecha',$request->fecha)
        ->where('tipo_capacitacion','SIUGJ')
        ->count();

        
        if($Consulta > 30){
            $mensaje='Ya no esta disponible este horario, el registro ya se asigno. Agradecemos escoger un horario diferente a '.$request->fecha.' en la jornada '.$request->jornada;
            Session::flash('error',$mensaje);
           return Redirect::back();
        }else{
           $lista = new ProgramacionCapcitacion() ;
           $lista->codigo_despacho = $request->codigo_despacho;
           $lista->despacho = $request->despacho;
           $lista->identificacion = $request->identificacion;
           $lista->nombre = $request->nombre;
           $lista->correo = $request->correo;
           $lista->fecha = $request->fecha;
           $lista->jornada = $request->jornada;
           $lista->tipo_capacitacion = "SIUGJ";//$request->tipo_capacitacion;
           
           $lista->save();
        }
        Session::flash('message', ' Registro Exitoso!');
       return Redirect::to('usuarios/solicitud/capacitacion/siugj');

        
    }
    public function verificarCupoSiugj(Request $request){
        
        //dd($request->all());
        
    $fecha = $request->input('fecha');
    $jornada = $request->input('jornada');
    
    // Consulta para contar cuántas personas están inscritas en esa fecha y jornada
    $cantidadInscritos = ProgramacionCapcitacion::where('fecha', $fecha)
        ->where('jornada', $jornada)
        ->where('tipo_capacitacion', "SIUGJ")
        ->count();
    

    $cupoMaximo = 30;

    // Si hay espacio, retornamos una respuesta positiva
    if ($cantidadInscritos < $cupoMaximo) {
        return response()->json(['disponible' => true]);
    } else {
        return response()->json(['disponible' => false]);
    }
        
    }
    
    
    
     public function Visita()
    {
        if( auth()->user()->rol == 1){
          $users=ProgramacionVisitaSiugj::where('codigo_despacho', auth()->user()->cedula)
          ->get();  
          
          //DD($users);
        }
        if( auth()->user()->rol == 3){
           $users=ProgramacionVisitaSiugj::where('codigo_despacho', auth()->user()->cedula)
           //->where('tipo_capacitacion','PRESENCIAL')
        ->get(); 
        
        }      

        $TotalRegistro = ProgramacionVisitaSiugj::TotalRegistros();
        //dd($TotalRegistro);
        

        $fecha= ProgramacionVisitaSiugj::fechaVisita();
        $jornada= ProgramacionVisitaSiugj::jornadaVisita();        
        
        $cantidadJorn = ProgramacionVisitaSiugj::selectRaw('jornada, COUNT(*) as total')
        ->groupBy('jornada')
        ->get();
        //dd($cantidadJorn);
        
        if( auth()->user()->rol == 1){
            return view ('administrador.capacitacion.Visita',compact('users','fecha','jornada','TotalRegistro','cantidadJorn'));

          }
          if( auth()->user()->rol == 3){
            return view ('usuario.Capacitacion.Visita',compact('users','fecha','jornada','TotalRegistro','cantidadJorn'));
    }
          } 
          
    
     public function storeVisita(Request $request)
    {
        //dd($request->all());
        
        $this->validate($request, [
                'codigo_despacho' => 'required|numeric',
                'despacho'=>'required',
                'direccion'=>'required',
                'telefono'=>'required',
                //'correo'=>'required|email',
                'numero_colaboradores'=>'required|numeric|max:999',
                'fecha_visita'=>'required',
                'jornada'=>'required',
            ]);
            
        DB::beginTransaction();
         try{ 

        $Consulta=ProgramacionVisitaSiugj::where('jornada',$request->jornada)
        ->where('fecha_visita',$request->fecha_visita)
        //->where('tipo_capacitacion','PRESENCIAL')
        ->count();
        
        $validar = ProgramacionVisitaSiugj::where('codigo_despacho', auth()->user()->cedula)
        ->count();
        
        if($validar > 2){
            $mensaje='SOLO SE PUEDE REGISTRAR UNA SOLA VEZ A LA SOLICITUD DE VISITA';
            Session::flash('error',$mensaje);
           return Redirect::back();
        }

        
        if($Consulta > 3){
            $mensaje='Ya no esta disponible este horario, el registro ya se asigno. Agradecemos escoger un horario diferente a '.$request->fecha_visita.' en la jornada '.$request->jornada;
            Session::flash('error',$mensaje);
           return Redirect::back();
        }else{
           $lista = new ProgramacionVisitaSiugj() ;
           $lista->codigo_despacho =  auth()->user()->cedula;
           $lista->despacho =  auth()->user()->name.' '.  auth()->user()->lastname ;
           $lista->direccion = $request->direccion;
           $lista->telefono = $request->telefono;
           $lista->correo =  auth()->user()->email;
           $lista->fecha_visita = $request->fecha_visita;
           $lista->jornada = $request->jornada;
           $lista->numero_colaboradores = $request->numero_colaboradores;
           
           $lista->save();
        }
        
    
     DB::commit();
            
         Session::flash('message', ' Registro Exitoso!');
       return Redirect::to('usuarios/solicitud/visita/siugj');   
            
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        
        

        
    }
    
    public function verificarCupoVisita(Request $request){
        
        //dd($request->all());
        
    $fecha = $request->input('fecha');
    $jornada = $request->input('jornada');
    
    // Consulta para contar cuántas personas están inscritas en esa fecha y jornada
    $cantidadInscritos = ProgramacionVisitaSiugj::where('fecha_visita', $fecha)
        ->where('jornada', $jornada)
        ->count();
    

    $cupoMaximo = 3;

    // Si hay espacio, retornamos una respuesta positiva
    if ($cantidadInscritos < $cupoMaximo) {
        return response()->json(['disponible' => true]);
    } else {
        return response()->json(['disponible' => false]);
    }
        
    }
    
    
    
    
    public function ListaCapacitacionSiugj(Request $request){
        
        $fechaConHora = Carbon::now(); // Obtiene la fecha y hora actual
        $fechaSoloFecha = $fechaConHora->format('Y-m-d');
        
        //dd($fechaSoloFecha);
        
       $capacitacionesUnica = ACapacitacionSiugj::where('fecha',">=",$fechaSoloFecha)->where('categoria','Unica Instancia')->get();
       $capacitacionesPrimera = ACapacitacionSiugj::where('fecha',">=",$fechaSoloFecha)->where('categoria','Primera Instancia')->get();
      // dd($capacitacionesUnica);
        
        return view('usuario.Capacitacion.CapacitacionSiugj2',compact('capacitacionesUnica','capacitacionesPrimera'));
        
    }
    
     public function ListastoreSiugj(Request $request){
         
        // dd($request->all());
         
          $this->validate($request, [
                'identificacion' => 'required|numeric',
                'nombre'=>'required',
                'tipoCapacitacion'=>'required',
                'categoria'=>'required',
                'role'=>'required',
                'fecha'=>'required',
                'horario'=>'required',
                
            ]);
            
        DB::beginTransaction();
         try{ 
            
        $Datos = ACapacitacionSiugj::where('categoria',$request->categoria)
        ->where('role',$request->role)
         ->where('fecha',$request->fecha)
          ->where('horario',$request->horario)
          ->first();
          
         //dd($Datos,$Datos->fecha);
         
         
        
        if($Datos->cantidad >25){
          Session::flash('error', ' Ya no se Pueden Registrar a la fecha Seleccionada, Cupo Lleno!');
           return Redirect::back();    
        }
        
        //dd( $request->all(),$Datos);
        
        $Asistencia = new AProgramacionCapacitacionSiugj();
        
        $Asistencia->codigo_despacho =  auth()->user()->cedula;
           $Asistencia->despacho =  auth()->user()->name.' '.  auth()->user()->lastname ;
           $Asistencia->identificacion = $request->identificacion;
           $Asistencia->nombre = $request->nombre;
           $Asistencia->correo = $request->correo;
           $Asistencia->modalidad = $request->tipoCapacitacion;
           $Asistencia->fecha = $Datos->fecha;
           $Asistencia->horario = $Datos->horario;
           $Asistencia->ubicacion = $Datos->ubicacion;
           $Asistencia->categoria = $Datos->categoria;
           $Asistencia->role = $request->role;
           $Asistencia->tipo_capacitacion = $request->tipoCapacitacion;
           
           $Asistencia->save();
           
           if($request->tipoCapacitacion =="Presencial"){
             
             // Sumar 1 a la cantidad
            $Datos->cantidad += 1;
            // Guardar el cambio en la base de datos
            $Datos->save();
             //dd($DatosR);
           }
        
         DB::commit();
         
         Session::flash('message', ' Registro Exitoso!');
           return Redirect::back();  
         
         
            
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
    }
    
    public function obtenerEventos()
    {
        // Obtener todos los eventos desde la base de datos
        $fechaConHora = Carbon::now(); // Obtiene la fecha y hora actual
        $fechaSoloFecha = $fechaConHora->format('Y-m-d');
        
        //dd($fechaSoloFecha);
        
       $eventos = ACapacitacionSiugj::where('fecha',">=",$fechaSoloFecha)->get();
        $eventos = ACapacitacionSiugj::all();
        return response()->json($eventos);
    } 
          
          
          
    
    
    
    
}
