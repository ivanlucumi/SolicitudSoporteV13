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

use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\ActividadDespacho;
use App\Models\usuarioSgde;


use App\Imports\NormalizacionImport;


use App\Models\NormalizacionAsignados;
use App\Models\User;

use App\Models\ActividadContratista;



class NormalizacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Digitalizacion');
        
    }
    

    public function Index(Request $requets){
        
       $mesActual = Carbon::now()->month;
       //dd( auth()->user()->id);
       
       $RadicadoTomado=$requets->RadicadoTomado;
       
       $Normalizacion = Normalizacion::where('id_user', auth()->user()->id)
       ->where('mes',$mesActual)
       ->get();
        $total = Normalizacion::where('id_user', auth()->user()->id)
        ->select('id')
        ->count();
       //dd($total);
        $mesesNomralizados = Normalizacion::selectRaw('mes, count(id) as Total')
                ->where('id_user', auth()->user()->id)
                ->orderBy('mes', 'asc')
                ->groupBy('mes')
                ->get();
        //dd($meses);
        
       
       $repositorio=[
           'BESTDOC'=>'BESTDOC','ONEDRIVE'=>'ONEDRIVE'
           ];
        
        $despachos= Despacho::where('tipo','despacho')->pluck('nombreDespacho','codigoDespacho');
       
       $estadisticaNormalizacion=$Normalizacion->count();
       //dd($estadisticaNormalizacion);
    	
        $meses = ['1' => 'ENERO', '2' => 'FEBRERO', '3' => 'MARZO','4'=>'ABRIL','5'=>'MAYO','6' => 'JUNIO', '7' => 'JULIO',
        '8' => 'AGOSTO','9'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
    	
    	return view('Normalizacion.Index',compact('meses','estadisticaNormalizacion','Normalizacion','repositorio','despachos','mesesNomralizados','total','RadicadoTomado')); 
  
    }
    
    public function save(Request $request){
        //dd($request->all());
        $this->validate($request, [
                'despacho_id' => 'required',
                'radicacion'=>'required|numeric|digits:23',
                'folios'=>'required',
                'indice'=>'required',
                'repositorio'=>'required|max:13',
                'observaciones'=>'required',
            ]);
        $mesActual = Carbon::now()->month;    
        //DB::beginTransaction();
         try{ 
             $NormalizacionV = Normalizacion::where('radicacion',$request->radicacion)
             ->where('despacho_id',$request->despacho_id)
               ->first();
               
             if(!empty($NormalizacionV)){
                Session::flash('error','La radicacion '.$request->radicacion.' ya esta registrada para este Despacho!!');
                //
                return redirect()->route('digitalizacion.inicio');
                //return redirect()->back(); 
             } 
             
             
             
             $despacho = Despacho::where('CodigoDespacho',$request->despacho_id)
             ->first();
             
             if(empty($despacho)){
                Session::flash('error','No se puede encontrar despacho!!');
                return redirect()->route('digitalizacion.inicio');
             }
             
             
             if(empty($NormalizacionV)){
             
                   $reporte = new Normalizacion();
                   $reporte->despacho_id =  $request->despacho_id;
                   $reporte->despacho = strtoupper($despacho->nombreDespacho);
                   $reporte->radicacion = $request->radicacion;
                   $reporte->folios = $request->folios;
                   $reporte->indice = $request->indice;
                   $reporte->repositorio = $request->repositorio;
                   $reporte->revisado_por = auth()->user()->name." ". auth()->user()->lastname;
                   $reporte->id_user =  auth()->user()->id;
                   $reporte->fecha_revision=Carbon::now()->toDateString();
                   $reporte->mes=$mesActual;
                   $reporte->observaciones = $request->observaciones;
                   //$reporte->ip = $request->ip();
                   $reporte ->save();
                   
                //DB::commit();
                
                $normalizado = NormalizacionAsignados::where('radicacion',$reporte->radicacion)
                ->where('user', auth()->user()->id)
                ->first();
                
                $normalizado->codigo_despacho=$reporte->despacho_id;
                $normalizado->despacho= $reporte->despacho;
                $normalizado->registrado="REGISTRADO";
                $normalizado ->save();
                
                
                
                Session::flash('success','Registro realizado!!');
                return redirect()->route('digitalizacion.inicio');
             }else{
                 Session::flash('error','La radicacion '.$request->radicacion.' ya esta registrada para este Despacho!!');
                return redirect()->back(); 
             }
            
            }catch (\Exception $e) {
                //DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            } catch (\Throwable $e) {
               // DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
    
            
    }
    
    public function Todos(Request $request){
        
      $mesActual = Carbon::now()->month;
      
      if(!empty($request->radicacion)){
          $radicadoNormalizado = DB::table('normalizacion')
        ->join('users', 'normalizacion.id_user', '=', 'users.id')
        ->select('normalizacion.radicacion','normalizacion.despacho', 'normalizacion.revisado_por')
        ->where('normalizacion.radicacion', $request->radicacion)
        ->first();
        
        //NormalizacionAsignados
        
        $radicadoAsignado = DB::table('normallizacion_asignado')
        ->join('users', 'normallizacion_asignado.user', '=', 'users.id')
        ->select('normallizacion_asignado.radicacion','normallizacion_asignado.despacho', 'users.name')
        ->where('normallizacion_asignado.radicacion', $request->radicacion)
        ->first();
      }else{
          $radicadoNormalizado =null;
          $radicadoAsignado =null;
      }
      
      
     //dd($request->all());
      
      if( auth()->user()->email =="mmaldonzap@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="dachitop@cendoj.ramajudicial.gov.co"){
          $CANTIDAD = Normalizacion::selectRaw('revisado_por, count(id) as Total')
                ->where('despacho_id','760017188001')
                ->orderBy('revisado_por', 'asc')
                ->groupBy('revisado_por')
                ->get();
          
      }else{
          $CANTIDAD = Normalizacion::selectRaw('revisado_por, count(id) as Total')
          //->where('despacho_id','760017188001')
                ->orderBy('revisado_por', 'asc')
                ->groupBy('revisado_por')
                ->get();
                
      }
      
      $personas = Normalizacion::select('id_user','revisado_por')->distinct()->orderby('revisado_por','ASC')->pluck('revisado_por','id_user');
      //dd($personas);
      //$personasAsignar = User::where('rol',11)->orderby('name','ASC')->pluck('name','id');
      
      //dd($personasAsignar);
      
      
      
       
        $meses = ['1' => 'ENERO', '2' => 'FEBRERO', '3' => 'MARZO','4'=>'ABRIL','5'=>'MAYO','6' => 'JUNIO', '7' => 'JULIO',
        '8' => 'AGOSTO','9'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        
        
        if(empty($request->all())){
             if( auth()->user()->email =="mmaldonzap@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="dachitop@cendoj.ramajudicial.gov.co"){
                 $Normalizacion = Normalizacion::where('mes',$mesActual)
                  ->where('despacho_id','760017188001')
                  ->get(); 
                  
                  $CANTIDAD = Normalizacion::selectRaw('revisado_por, count(id) as Total')
                ->where('despacho_id','760017188001')
                ->where('mes',$mesActual)
                ->orderBy('revisado_por', 'asc')
                ->groupBy('revisado_por')
                ->get();
                
             }else{
                 $Normalizacion = Normalizacion::where('mes',$request->mes)
                  //->where('despacho_id','760017188001')
                  ->get(); 
                  $CANTIDAD = Normalizacion::selectRaw('revisado_por, count(id) as Total')
                 //->where('despacho_id','760017188001')
                 //->where('mes',$request->mes)
                ->orderBy('revisado_por', 'asc')
                ->groupBy('revisado_por')
                ->get();
             }
            
          
          //dd($Normalizacion);
        }else{
            if( auth()->user()->email =="mmaldonzap@cendoj.ramajudicial.gov.co" ||  auth()->user()->email =="dachitop@cendoj.ramajudicial.gov.co"){
                 $Normalizacion = Normalizacion::where('mes',$request->mes)
                  ->where('despacho_id','760017188001')
                  ->get(); 
                  
                  $CANTIDAD = Normalizacion::selectRaw('revisado_por, count(id) as Total')
                 ->where('despacho_id','760017188001')
                 ->where('mes',$request->mes)
                ->orderBy('revisado_por', 'asc')
                ->groupBy('revisado_por')
                ->get();
                  
             }else{
                 $Normalizacion = Normalizacion::where('mes',$request->mes)
                  //->where('despacho_id','760017188001')
                  ->get(); 
                  
                 $CANTIDAD = Normalizacion::selectRaw('revisado_por, count(id) as Total')
                 //->where('despacho_id','760017188001')
                 ->where('mes',$request->mes)
                ->orderBy('revisado_por', 'asc')
                ->groupBy('revisado_por')
                ->get();
             }
        }
        
        /*$radicadoNormalizado =null;
          $radicadoAsignado =null;*/
       
       	return view('Normalizacion.Todo',compact('Normalizacion','meses','CANTIDAD','personas','mesActual','radicadoNormalizado','radicadoAsignado')); 
  
    }
    
    public function TrasladoMes(Request $request){
        
        //dd($request->all());
        
        try{ 
        
                $meses = ['1' => '01', '2' => '02', '3' => '03','4'=>'04','5'=>'05','6' => '06', '7' => '07',
                '8' => '08','9'=>'09','10'=>'10','11' => '11', '12' => '11'];
                
                $cambioMes =$meses[$request->mesCambio];
                $MesActual =$meses[$request->mesNormalizado];
                //dd($MesActual,$cambioMes);
                
                $Normali = Normalizacion::where('id_user',$request->persona)
                ->where('mes', $request->mesNormalizado)->count();
                
                $persona = User::findOrFail($request->persona);
                //dd($Normali,$persona->name);
                
                $Normalizacion = DB::table('normalizacion')
                ->where('mes', $request->mesNormalizado)
                ->where('id_user', $request->persona)
                ->update([
                    'fecha_revision' => DB::raw("CONCAT(YEAR(fecha_revision), '-" . $cambioMes . "-', DAY(fecha_revision))"),
                    'mes' => $request->mesCambio,
                ]);
        
                
                Session::flash('success','Se realizo cambio de mes de '.$persona->name.' la cantidad de '.$Normali);
                return redirect()->back();
             
            
            }catch (\Exception $e) {
                //DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            } catch (\Throwable $e) {
               // DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
        
    }
    
    public function AsignacionExpedientes(Request $request){
        
        //dd($request->all());
        
        $file = $request->file('file');
        //dd($file);
        
        set_time_limit (920);
        ini_set('memory_limit','512M');
        
        
        //$import = new ProtocoloDosImportar();
        $import = new NormalizacionImport($request->persona);
        //dd($import);
        $data = Excel::import($import, $file);
        
        

        Session::flash('success','Se realizo la carga de Radciaciones ');
        return redirect()->back();
        
        
    }
    
    public function BuscarRadicado(Request $request){
        
        //Normalizacion
        
        $radicadoNormalizado = DB::table('normalizacion')
        ->join('users', 'normalizacion.id_user', '=', 'users.id')
        ->select('normalizacion.despacho_id','normalizacion.despacho', 'normalizacion.revisado_por','users.name')
        ->where('normalizacion.radicacion', $request->radicacion)
        ->first();
        
        //NormalizacionAsignados
        
        $radicadoAsignado = DB::table('normallizacion_asignado')
        ->join('users', 'normallizacion_asignado.user', '=', 'users.id')
        ->select('normallizacion_asignado.radicacion','normallizacion_asignado.codigo_despacho','normallizacion_asignado.despacho', 'users.name')
        ->where('normallizacion_asignado.radicacion', $request->radicacion)
        ->first();
        
        return $this->Todos($radicadoNormalizado,$radicadoAsignado);
        
        
    }
 

 
    
    //REGISTRO INVENTARIO
    
    public function registroNormalizacion(Request $request){
        //dd('hola');
        $despachosRegistrados = RegistroDigitalizacion::distinct()->pluck('despacho','id_despacho');
        
        if(count($request->all())== 0){
    	  $inventarios = RegistroDigitalizacion::paginate(200);
    	//dd($digitalizado[0]);  
    	}else{
    	    $inventarios = RegistroDigitalizacion::where('id_despacho',$request->id_despacho)
        ->paginate(500);
    	}
        
         //$inventarios = Administrador::InventarioDigitalizacion()->paginate(200);
         
        //dd($inventarios);
        return view('digitalizacionPDos.InventarioDigitalizacion',compact('inventarios','despachosRegistrados'));
        
    }
    
    //DESCARGAR INVENTARIO DIGITALIZACION
    public function DescargarInvetarioD(Request $request){
        
        $Normalizaciones = Normalizacion::where('id_user', auth()->user()->id)
       ->where('mes',$request->mes)
       ->get();
       
       dd($Normalizaciones);
       
       $cantidad =  count($Normalizaciones);
       
       $meses = ['1' => 'ENERO', '2' => 'FEBRERO', '3' => 'MARZO','4'=>'ABRIL','5'=>'MAYO','6' => 'JUNIO', '7' => 'JULIO',
        '8' => 'AGOSTO','9'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
       $mes_reporte =$meses[$request->mes];
       
       //dd($mes_reporte);
       
       
        
        
        if($Normalizaciones->isEmpty()){
            Session::flash('error','No hay registros para descargar!!');
           return redirect()->back(); 
            
    	}else{
    	     $Normalizacion= $data              =  json_decode(json_encode($Normalizaciones), true);  
            
               /* $pdf = Pdf::loadView('Normalizacion.Pdf',compact('Normalizaciones','cantidad','mes_reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
                  
                $nombrePdf = auth()->user()->name." ". auth()->user()->lastname." Estadistica.pdf";
                return $pdf->download($nombrePdf);*/
                
            $pdf = Pdf::loadView('Normalizacion.Pdf', [
                        'Normalizaciones' => $Normalizaciones,
                        'cantidad' => $cantidad,
                        'mes_reporte' => $mes_reporte
                    ])
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'defaultFont' => 'DejaVu Sans', // Fuente nativa y estable
                        'isRemoteEnabled' => false,     // Solo activar si usas imágenes externas
                        'dpi' => 110                     // DPI estable para A4
                    ]);
            
            $nombrePdf =  auth()->user()->name . " " .
                          auth()->user()->lastname .
                         " Estadistica.pdf";
            
            return $pdf->download($nombrePdf);
    	    
    	   
    	}
        
  
    
        }
        
        //TOMAR EXPEDIENTES
    public function tomar(Request $request){
        
        $tomar=NormalizacionAsignados::where('radicacion',$request->RTomar)
        ->where('user',NULL)
        ->first();
        if(!empty($tomar)){
            $tomar->user = auth()->user()->id;
            $tomar->save();
        }else{
            Session::flash('message', 'EXPEDIENTE NO SE PUEDE TOMAR, YA ESTA OCUPADO');
        return redirect()->back();
        }
        $expedientes =NormalizacionAsignados::where('registrado',NULL)->GET();
        
    }
    
    //INFORME DE ACTIVIDADES DIARIAS
    
    public function Informe(Request $request){
       $today = Carbon::today();
    $now = Carbon::now();
    
    $isAfterNoon = $now->hour >= 12;
    $hasRegisteredToday = ActividadContratista::where('activity_date', $today)
        ->where('user_id',  auth()->id())
        ->exists();
        
    $todayActivity = ActividadContratista::where('activity_date', $today)
        ->where('user_id',  auth()->id())
        ->first();

    // Obtener historial ordenado ascendente por fecha
    $activitiesHistory = ActividadContratista::where('user_id',  auth()->id())
    ->whereYear('activity_date', '>=', 2026)
    ->orderBy('activity_date', 'desc')
    ->paginate(100);
        
       // dd($activitiesHistory);
        
    $totalActivities = ActividadContratista::where('user_id',  auth()->id())->count();

    return view('Normalizacion.InformeActividades', compact(
        'isAfterNoon',
        'hasRegisteredToday',
        'today',
        'todayActivity',
        'activitiesHistory',
        'totalActivities'
    ));
            
       // return view('Normalizacion.InformeActividades', compact('isAfterNoon', 'hasRegisteredToday', 'today'));
    
        
    }
    
     public function InformeStore(Request $request){
         
         //dd($request->all());
      $today = Carbon::today();
        $now = Carbon::now();
        
        // Validar que sea después del mediodía
        if ($now->hour < 12) {
           // return back()->with('error', 'El registro de actividades solo está disponible después del mediodía.');
        }
        
        // Validar que no haya registrado hoy
       /* $hasRegisteredToday = ActividadContratista::where('activity_date', $today)
            ->where('user_id',  auth()->id())
            ->exists();
            
        if ($hasRegisteredToday) {
            return back()->with('error', 'Ya has registrado tus actividades para hoy.');
        }*/
        
        $request->validate([
            'description' => 'required|min:10',
            'plataforma'  => 'required'
        ]);
        
        $actividad = ActividadContratista::create([
            'activity_date' => $today,
            'description' => $request->description,
            'plataforma'  => $request->plataforma,
            'user_id' =>  auth()->id()
        ]);
        
        //dd($actividad);
        
        return redirect()->route('activities.create')
            ->with('success', 'Actividades registradas correctamente. No podrás registrar más actividades hasta mañana después del mediodía.'); 
        
    }
    
    public function generateMonthlyReport(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);
        
        //dd($request->month);
        
        $date = Carbon::createFromFormat('Y-m', $request->month);
        $startDate = $date->copy()->startOfMonth();
        $endDate = $date->copy()->endOfMonth();
        
        $activities = ActividadContratista::with('user')
            ->where('user_id',  auth()->id())
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->orderBy('activity_date')
            ->get();
            
        if ($activities->isEmpty()) {
            return back()->with('error', 'No hay actividades registradas para el mes seleccionado.');
        }
        
        // Bloquear las actividades después de generar el reporte
        //ActividadContratista::lockMonthlyActivities($date->year, $date->month,  auth()->id());
        
        $pdf = Pdf::loadView('Normalizacion.reportePdf', [
            'activities' => $activities,
            'monthName' => $date->translatedFormat('F Y'),
            'userName' =>  auth()->user()->name ." ".  auth()->user()->lastname
        ]);
        
        return $pdf->download('reporte-actividades-'.$date->format('m-Y').'.pdf');
    }
    
   /* public function indexActividadDespacho()
    {
        $user =  auth()->user();
    
        // Despachos asignados para el formulario
        $despachos = $user->despachosAsignados()->get();
    
        // Solo despachos que ya tienen registros (actividades)
        $actividadesAgrupadas = ActividadDespacho::with('despacho')
            ->where('user_id', $user->id)
            ->get()
            ->groupBy('despacho_id');
            
        //dd($actividadesAgrupadas);
    
        return view('Normalizacion.ActividadesDespacho', compact('despachos', 'actividadesAgrupadas'));
    }*/

   public function indexActividadDespacho()
    {
        $user =  auth()->user();
    
        // Obtén despachos con conteo de actividades del usuario actual
        $despachos = $user->despachosAsignados()
            ->withCount(['actividadesDespacho as actividades_count' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }])
            ->get();
            
       // dd($despachos);
    
        return view('Normalizacion.ActividadesDespacho', compact('despachos'));
    }
        

    public function createActividadDespacho(Request $request)
    {
        $user =  auth()->user();
        $despachoId = $request->query('despacho_id');
    
        if (!$despachoId) {
            return redirect()->route('actividades.index')
                ->with('warning', 'Debe seleccionar un despacho para continuar.');
        }
    
        // Validar despacho
        $despachoSeleccionado = Despacho::findOrFail($despachoId);
    
        // Empleados del despacho
        $empleados = usuarioSgde::where('codigo_despacho', $despachoId)->get();
    
        // Despachos asignados al usuario
        $despachos = $user->despachosAsignados()->get();
    
        // Buscar la última actividad de ese despacho por ese usuario
        $actividad = ActividadDespacho::where('user_id', $user->id)
            ->where('codigoDespacho', $despachoId)
            ->latest()
            ->first();
    
        // Preparar datos para la vista (si no hay, mandar seguros)
        $observaciones = $actividad && $actividad->observaciones
            ? json_decode($actividad->observaciones, true)
            : [];
    
        $observacionesCapacitacion = $actividad && $actividad->observaciones_capacitaciones
            ? json_decode($actividad->observaciones_capacitaciones, true)
            : [];
            
        
        //dd($observaciones,!empty($observaciones),$observacionesCapacitacion);
    
        return view('Normalizacion.actividad-despacho-form', [
            'despachoSeleccionado' => $despachoSeleccionado,
            'empleados' => $empleados,
            'despachos' => $despachos,
            'actividad' => $actividad,
            'observaciones' => $observaciones,
            'observacionesCapacitacion' => $observacionesCapacitacion,
        ]);
    }


   public function storeActividadDespacho(Request $request)
    {
        //dd($request->all());
        // Validar datos básicos
        $validated = $request->validate([
            'despacho_id' => 'required|exists:despachos,codigoDespacho',
            'usuarios_data' => 'nullable|json',
            'observaciones' => 'nullable|json',
            'observaciones_capacitacion' => 'nullable|json',
        ]);
    
        // Intentar recuperar la actividad ya existente para este despacho
        $actividad = ActividadDespacho::where('codigoDespacho', $validated['despacho_id'])->first();
    
        if ($actividad) {
            // Actualizar solo flags (visitado, capacitado, etc.)
            $actividad->visitado = $request->has('visitado');
            $actividad->capacitado = $request->has('capacitado');
            $actividad->con_usuarios = $request->has('datos_usuarios');
            $actividad->en_produccion = $request->has('usando_sgde');
            $actividad->usuarios_solicitados = $validated['usuarios_data'];
            $actividad->user_id = auth()->id();
    
            // ** Fusionar observaciones **
            $prevObservaciones = json_decode($actividad->observaciones ?? '[]', true);
            $newObservaciones = json_decode($validated['observaciones'] ?? '[]', true);
            $actividad->observaciones = json_encode(array_merge($prevObservaciones, $newObservaciones));
    
            // ** Fusionar observaciones de capacitación **
            $prevCapacitaciones = json_decode($actividad->observaciones_capacitaciones ?? '[]', true);
            $newCapacitaciones = json_decode($validated['observaciones_capacitacion'] ?? '[]', true);
            $actividad->observaciones_capacitaciones = json_encode(array_merge($prevCapacitaciones, $newCapacitaciones));
    
            $actividad->save();
    
        } else {
            // Crear nueva actividad con todos los datos
            $actividad = new ActividadDespacho();
            $actividad->codigoDespacho = $validated['despacho_id'];
            $actividad->visitado = $request->has('visitado');
            $actividad->capacitado = $request->has('capacitado');
            $actividad->con_usuarios = $request->has('datos_usuarios');
            $actividad->en_produccion = $request->has('usando_sgde');
            $actividad->usuarios_solicitados = $validated['usuarios_data'];
            $actividad->observaciones = $validated['observaciones'];
            $actividad->observaciones_capacitaciones = $validated['observaciones_capacitacion'];
            $actividad->user_id = auth()->id();
            $actividad->save();
        }
    
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Actividad registrada correctamente.']);
        }
        
        return redirect()->route('actividades.create', ['despacho_id' => $actividad->codigoDespacho])
                 ->with('success', 'Actividad registrada correctamente.');
    
        //return redirect()->route('actividades.create')->with('success', 'Actividad registrada correctamente.');
    }


    public function editActividadDespacho($id)
    {
        $actividad = ActividadDespacho::findOrFail($id);
    
        // Decodificar los arrays almacenados
        $usuarios = json_decode($actividad->usuarios_solicitados, true) ?? [];
        $observaciones = json_decode($actividad->observaciones, true) ?? [];
        $observacionesCapacitacion = json_decode($actividad->observaciones_capacitaciones, true) ?? [];
    
        return view('tu.vista.blade', compact(
            'actividad',
            'usuarios',
            'observaciones',
            'observacionesCapacitacion'
        ));
    }


    public function updateActividadDespacho(Request $request, $id)
    {
        $actividad = ActividadDespacho::findOrFail($id);

        $validated = $request->validate([
            'despacho_id' => 'required|exists:despachos,id',
            'observaciones' => 'nullable|string|max:2000',
        ]);

        $validated['visitado'] = $request->has('visitado');
        $validated['capacitado'] = $request->has('capacitado');
        $validated['datos_usuarios'] = $request->has('datos_usuarios');
        $validated['usando_sgde'] = $request->has('usando_sgde');

        $actividad->update($validated);

        return redirect()->route('actividades.create')->with('success', 'Actividad actualizada.');
    }

    public function updateObservaciones(Request $request, $id)
    {
        $actividad = ActividadDespacho::findOrFail($id);

        $request->validate([
            'observaciones' => 'required|string|max:2000',
        ]);

        $nuevaObservacion = trim($request->observaciones);
        $usuarioNombre =  auth()->user()->name ?? 'Usuario';
        $fechaHora = Carbon::now()->format('Y-m-d H:i');

        $lineaNueva = "[$fechaHora - $usuarioNombre]: $nuevaObservacion";

        if (!empty($actividad->observaciones)) {
            $actividad->observaciones .= "\n" . $lineaNueva;
        } else {
            $actividad->observaciones = $lineaNueva;
        }

        $actividad->save();

        return redirect()->route('actividades.create')->with('success', 'Observación agregada exitosamente.');
    }
    
    
    
}
