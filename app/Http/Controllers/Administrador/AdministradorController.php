<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Administrador;
use App\Models\Seccional;
use App\Models\Inventario;
use App\Models\Elemento;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Especial;
use App\Models\Noticias;
use App\Models\User;
use App\Models\SolicitudUsuario;
use App\Models\Seguimiento;
use App\Models\Despacho;
use App\Models\TipoRequerimiento;
use App\Models\SolicitudAudiencia;
use App\Models\Digitalizacion;

use App\Models\ActividadContratista;
use App\Models\ActividadDespacho;

use Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\RegistroDigitalizacion;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Vacunacion;
use App\Models\Hora;

use App\Models\EsquemaVacuna;
use App\Models\JornadaSalud;
use App\Models\HoraJornadaSalud;

class AdministradorController extends Controller
{
    //

     public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        $this->middleware('administrador');
        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $solicitudes = SolicitudUsuario::with('usuarioSoli','requerimientoSoli','categoriaSoli','elementosSoli','AtSoli')->get();
        $contsolicitudes = SolicitudUsuario::where('tecnico','!=',null)->get();
        $todascont  = count($solicitudes);
        $solitcont  = count($contsolicitudes);
        if($todascont == $solitcont){
            $solitcont = 0;
        }
        //dd($solicitudes->toArray());
       // dd($todascont);
        $inventarios = Elemento::pluck('nombreElemento', 'id');
        $actualizarN = Noticias::actualizarEstadoN();
        $actualizarB = Banner::actualizarEstadoB();
        $actualizarE = Especial::actualizarEstadoE();

        $select = Administrador::selectEmpleados();
        
        return view('administrador.solicitudes.admin',compact('solicitudes','inventarios','select','solitcont'));

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('solicitudes.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);   

        if(isset($request->idPlaca))
        {
        $idPlaca = (implode(' ',$request->idPlaca));
         }else{
         $idPlaca = "";} 

        Seguimiento::create([
            'idReporte'        => $request['idSolicitud'],
            'seccional'        => $request['seccional'],
            'presentacion'     => $request['presentacion'],
            'solucion'         => $request['solucion'],
            'cargo_tecnico'    => $request['cargo_tecnico'],
            'estado'           => $request['estado'],
            'id_placa'         => $idPlaca,
            'observaciones'    => $request['observaciones'],
        ]);

        $asigAdmin = SolicitudUsuario::findOrFail($request['idSolicitud']);
        //dd($asigAdmin);
        $asigAdmin->fill(['estado_solicitud' => $request['estado'],
                      ]);/*metodo fill sirve para actualizar informacion en la bd */
        
        $asigAdmin->save(); 

        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administrador)
    {
         
       //$solicitudes = Administrador::getSolicitudAsignada( auth()->user()->id);
       $solicitudes = SolicitudUsuario::with('usuarioSoli','requerimientoSoli','categoriaSoli','elementosSoli','AtSoli')->get();
       //dd($solicitudes);
        //$solicitudes = Administrador::with('elementos');
        //dd($solicitudes);
        //$inventarios =  Administrador::Inventario(); 
        $uLogueado =  auth()->user()->id;
        $contsolicitudes = SolicitudUsuario::where('tecnico','=', auth()->user()->id)->where('estado_solicitud','=',null)->get();
        $solitcont = count($contsolicitudes);
        $inventarios = Elemento::pluck('nombreElemento', 'id');
        //dd($inventario);
        return view('administrador.solicitudes.asigAdmin',compact('solicitudes','inventarios', 'uLogueado','solitcont')); 
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //dd($id);
        $fecha = Carbon::now()->format('d/m/Y');
        //$solicitud = Administrador::getSolicitudId($id);
       // dd($solicitud);
        $solicitud = SolicitudUsuario::where('id',$id)->with('usuarioSoli','requerimientoSoli','categoriaSoli','elementosSoli','AtSoli')->get();
        //dd($solicitud->toArray());
        $inventario =  Administrador::getinventario($id);
        //dd($inventario);
        //$elementosInve =  explode(" ", $inventario[0]->elementos);
        //$SelectInventarios = Inventario::invetarioJuzgado($solicitud[0]->IdUser); 
        //$placas = Inventario::where('codigoJuzgado',$solicitud[0]->codigoDespacho)->pluck('placaInventario','id');
        $placas = Inventario::select(
            DB::raw("CONCAT(placaInventario,' ',marca) AS placaInventario"),'id')
            ->where('codigoJuzgado', $solicitud[0]->codigoDespacho)
            ->pluck('placaInventario', 'id');
        /*if($placas->all() == null){
            $placas = null;
        }*/
        //dd($placas);
        $seccionales = Seccional::All();
        $tipoSolicitudes = $tipoSolicitud = array('WEB');
        $estados = $estado = array('ARCHIVADA','RESUELTA');

        return view('administrador.solicitudes.formularioAdmin',compact('solicitud','elementosInve','SelectInventarios','seccionales','tipoSolicitudes','estados','placas','fecha'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd(Carbon::parse($request['fechavisita']));
        //dd($request);
        $asigAdmin = SolicitudUsuario::findOrFail($id);
        //dd($asigTecnico);
        $asigAdmin->fill(['tecnico' => $request['tecnico'],
                          'fecha_visita' => Carbon::parse($request['fechavisita']),
                      ]);/*metodo fill sirve para actualizar informacion en la bd */
        
        $asigAdmin->save(); 

        $a = @get_headers('http://www.google.com');
        if (is_array($a)) {
            AdministradorController::solicitudSend($id);
        }

        Session::flash('message', 'Asignado correctamente');
        return Redirect::to('/administrador/');  
    }

    public function solicitudSend($dato){
       
      $eventos           =  SolicitudUsuario::where('id',$dato)->first();
      $usuario           =  User::where('id',$eventos->tecnico)->first(); 
      $nombreD           =  Despacho::where('codigoDespacho',$eventos->codigoDespacho)->first();
      $requetD           =  TipoRequerimiento::where('id',$eventos->idrequerimiento)->first();
      //dd($eventos);
      $eventos->nameD    =  $nombreD->nombreDespacho;
      $eventos->distD    =  $nombreD->districto;
      $eventos->name     =  $usuario->name;
      $eventos->lastname =  $usuario->lastname;
      $eventos->requerim =  $requetD->nombreRequerimiento;
      $correo            =  $usuario->email;
      $asunto            =  "Tecnico Asignado  - SIRIS CALI";       
      $data              =  json_decode(json_encode($eventos), true);
      Mail::send('emails.TecnicoAsignado',$data, function($msj) use ($correo,$asunto){
        $msj->to($correo);
        $msj->subject($asunto);
      });  
    }
    
    public function estadistica(Request $request){
        
        //dd($request->all());
        
        /*
          "agendadorMesi" => "2020-11-01"
          "agendadorMesf" => "2020-11-30"
          
          "despachosMesi" => "2020-11-02"
          "despachosMesf" => "2020-11-12"
        
        */
        $despachoI=$request->despachosMesi;
        $despachoF=$request->despachosMesf;
        
        $agendadorI=$request->agendadorMesi;
        $agendadorF=$request->agendadorMesf;
        
        
        
         $fecha = Carbon::now();
         $mesAg = $fecha->format('Y-m');
         $mesDes = $fecha->format('Y-m');
        
        if(empty($request->all())){
            
             $estadisticadespachoMes = Administrador::estadisticaDespachoMes($mesDes);
             $estadisticaAgendadoresMes = Administrador::estadisticaAgendadoresMes($mesAg);
            
        }else{
            
            if($request->agendadorMesi != null && $request->agendadorMesf != null){
              
                $estadisticaAgendadoresMes = Administrador::estadisticaAgendadoresMesF($agendadorI,$agendadorF);  
            }else{
                $estadisticaAgendadoresMes = Administrador::estadisticaAgendadoresMes($mesAg); 
            }
            
            if($request->despachosMesi != null && $request->despachosMesf != null){
              
                $estadisticadespachoMes = Administrador::estadisticaDespachoMesF($despachoI,$despachoF);
            }else{
               $estadisticadespachoMes = Administrador::estadisticaDespachoMes($mesDes); 
            }
          
           
        }
        
    
        
       $estadistica = Administrador::estadisticaDespacho();
       $estadisticaAgendadores = Administrador::estadisticaAgendadores();
       
       //dd($estadistica);
       
      
       
       //dd($estadisticaAgendadores, $estadisticaAgendadoresMes);
       
       $despachosCertificados = Administrador::despachosCertificados();
       //dd($estadistica, $estadisticaAgendadores, $estadisticadespachoMes, $estadisticaAgendadoresMes, $despachosCertificados);
       
       
       return view('administrador.estadistica.index',compact('estadistica', 'estadisticaAgendadores', 'estadisticadespachoMes', 'estadisticaAgendadoresMes', 'despachosCertificados','mesAg'));
    }
    
    
     public function resultadoEncuesta(){
        $resultadoEncuesta= Digitalizacion::all();
        
        //dd($resultadoEncuesta);
        
        return view('administrador.formularios.encuestadigitalizacion.index',compact('resultadoEncuesta'));
    }
    
    
    public function inventarioDigitalizacion(Request $request){
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
        return view('administrador.formularios.inventariodigitalizacion.index',compact('inventarios','despachosRegistrados'));
        
        
    }
    
     //DESCARGAR INVENTARIO DIGITALIZACION
    public function DescargarInvetarioD(Request $request){
    
       $despacho =$request->id_despacho;
        
        if(count($request->all())== 0){
        	 $verificar = RegistroDigitalizacion::all();
    
            if($verificar != null){
                
                //dd('entro sin rquest');
                Excel::create('Inventario Digitalizacion', function($excel) {
                    $excel->sheet('Inventario Digitalizacion', function($sheet) {
                        $products = DB::select("select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho");
                        
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('csv');
            }else{
                Session::flash('message', 'No se encontraron datos para generar el excel');
                
        	    // $revisar=   $this->inventarioDigitalizacion();
        	     //return $revisar;
        	     return Redirect::back();
        	  
            }
    	//dd($digitalizado[0]);  
    	}else{
    	     $verificar = RegistroDigitalizacion::where('id_despacho',$request->id_despacho)->first();
             $despacho =$request->id_despacho;
            if($verificar != null){
                Excel::create('Inventario Digitalizacion', function($excel)use($despacho) {
                    
                    $excel->sheet('Inventario Digitalizacion', function($sheet)use($despacho) {
                        //dd($despacho);
                        //otra opci贸n -> $products = Product::select('name')->get();
                        //$products = HistoricoComprobanteEntrega::excelcomprobante();
                        $products = DB::select('select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE id_despacho = "'.$despacho.'" ORDER BY id_despacho');
                        //dd($products);
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('csv');
            }else{
                Session::flash('message', 'No se encontraron datos para generar el excel');
                
        	    // $revisar=   $this->inventarioDigitalizacion();
        	    // return $revisar;
        	    return Redirect::back();
        	  
            }
    	    
    	}
        

    }
    
    public function RegistroVacunacion(){
       $vacunaciones = Vacunacion::all(); 
       
       return view('administrador.vacuna.index',compact('vacunaciones'));
        
        
    }
    //jornada Salud
    public function RegistroJornadaSalud(){
         $jornadaSalud = JornadaSalud::all(); 
       
       return view('administrador.jornadaSalud.index',compact('jornadaSalud'));
    }
    
    public function ElimiRegistroVacunacion(Request $request,$id){
        //dd($request,$id);
        $vacunacion = Vacunacion::findOrFail($id);
        $cedula=$vacunacion->cedula;
        $eliminar = Vacunacion::destroy($id);
        
        $hora = Hora::where('cedula',$cedula)->first();
        $hora->cedula= NULL;
        $hora->confirmado = NULL;
        $hora->save();
        
        Session::flash('message','Eliminado Correctamente!!');
        return Redirect::back();
    }
    
    public function ResultadoEsquemaVacunacion(){
        $Result = DB::select('select codigo_despacho,cedula, nombre, cargo,vacuna, dosis, (select name from users where users.cedula = esquema_vacunacion.codigo_despacho) as name  from esquema_vacunacion ');
        $collection = collect($Result);
    //dd($collection);
        $Resultado = $collection;
             //dd($Resultado);
           return view('administrador.excel.encuestaEsquemaVacunacion',compact('Resultado'));
            
    }
    
    public function descargarArchivo()
    {
        $nombreArchivo="BkFull_disajcali.sql.gz";
        $rutaArchivo = storage_path('/../../backups/' . $nombreArchivo);
        
       /* if (!file_exists($rutaArchivo)) {
            abort(404);
        }
    
        return response()->download($rutaArchivo)->deleteFileAfterSend(true);*/

        
        
    $nombreArchivo="BkFull_disajcali.sql.gz";
    $rutaArchivo = storage_path('/../../backups/' . $nombreArchivo);
    
    

    // Almacenar el archivo en Azure Storage
    \Storage::disk('azure')->put('contenedorprueba/' . $nombreArchivo, $rutaArchivo);

    dd('Archivo subido exitosamente a Azure Storage.');
   

    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        dd(response()->download($rutaArchivo));
       try { 
           //return response()->download($rutaArchivo);
        //return Response::download($rutaArchivo);
        //return response()->file($rutaArchivo);
    //return Response::download($rutaArchivo, $nombreArchivo, $headers);
    return response()->download($rutaArchivo)->deleteFileAfterSend(true);
    
    } catch (\Exception $e) {
        // Manejo de errores
        \Log::error($e);
        return response()->json(['error' => 'Error al descargar el archivo'], 500);
    }
        
    }
    // En caso de que el archivo no exista
    abort(404, 'Archivo no encontrado');
}

    public function ActividadContratista()
        {
            //A�0�5O
            $year = 2026;
            
            // Trae los informes con la relación de usuario (contratista)
                //$activitiesHistory = ActividadContratista::with('user')->orderBy('activity_date', 'desc')->get();
                
                $activitiesHistory = ActividadContratista::with('user')
                ->whereYear('created_at', $year)
                ->orderBy('created_at', 'desc') // FECHA + HORA
                ->get();

            
                // Gráfico: contar actividades por contratista usando la relación
                /*$conteoPorContratista = ActividadContratista::with('user')
                    ->select('user_id', DB::raw('COUNT(*) as total'))
                    ->groupBy('user_id')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nombre' => optional($item->user)->name ." ".optional($item->user)->lastname ?? 'Sin nombre',
                            'total' => $item->total
                        ];
                    });*/
                $conteoPorContratista = ActividadContratista::with('user')
                    ->whereYear('created_at', $year)
                    ->select('user_id', DB::raw('COUNT(*) as total'))
                    ->groupBy('user_id')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nombre' => optional($item->user)->name . ' ' . optional($item->user)->lastname ?: 'Sin nombre',
                            'total'  => $item->total
                        ];
                    });
            
            // Obtener lista de contratistas para el filtro
           /* $contratistas=   ActividadContratista::whereNotNull('user_id')
                            ->whereHas('user')
                            ->with('user:id,name,lastname') 
                            ->get()
                            ->pluck('user') // Extrae solo los usuarios
                            ->unique('id')  // Elimina duplicados
                            ->values();       // Reindexa la colecci��n*/
            $contratistas = ActividadContratista::whereYear('created_at', $year)
            ->whereNotNull('user_id')
            ->whereHas('user')
            ->with('user:id,name,lastname')
            ->orderBy('created_at', 'desc') // FECHA + HORA
            ->get()
            ->pluck('user')
            ->unique('id')
            ->values();
            //dd($activitiesHistory);
            
                return view('administrador.ActividadesContratista.Index', compact('activitiesHistory', 'conteoPorContratista','contratistas'));


        }
    
   public function actividadesDespachos(Request $request){
    // Contadores totales
    $totales = [
        'visitados' => ActividadDespacho::where('visitado', 1)->count(),
        'capacitaciones' => ActividadDespacho::where('capacitado', 1)->count(),
        'con_usuarios' => ActividadDespacho::where('con_usuarios', 1)->count(),
        'usando_sgde' => ActividadDespacho::where('en_produccion', 1)->count(),
    ];

    // Datos detallados por despacho (para la tabla general)
    $despachos = Despacho::with(['actividadesDespacho' => function($q) {
        $q->select('codigoDespacho', 'visitado', 'capacitado', 'con_usuarios', 'en_produccion');
    }])
    ->withCount('actividadesDespacho')
    ->whereRaw('LOWER(nombreDespacho) NOT LIKE ?', ['%laboral%'])
    //->where('tipo', 'DESPACHO')
    ->whereNull('estado')
    ->orderByDesc('actividades_despacho_count')
    ->get();
    
    //dd($despachos);

    // Obtener lista ��nica de circuitos
    $circuitos = $despachos->pluck('circuito')
        ->filter()
        ->unique()
        ->sort()
        ->values();

    // Organizar despachos por circuito
    $despachosPorCircuito = [];
    
    foreach($circuitos as $circuito) {
        $despachosDelCircuito = $despachos->where('circuito', $circuito);
        
        // Calcular totales por circuito
        $totalesCircuito = [
            'visitados' => 0,
            'capacitaciones' => 0,
            'con_usuarios' => 0,
            'usando_sgde' => 0,
        ];
        
        foreach($despachosDelCircuito as $despacho) {
            $actividad = $despacho->actividadesDespacho->last();
            if($actividad) {
                if($actividad->visitado) $totalesCircuito['visitados']++;
                if($actividad->capacitado) $totalesCircuito['capacitaciones']++;
                if($actividad->con_usuarios) $totalesCircuito['con_usuarios']++;
                if($actividad->en_produccion) $totalesCircuito['usando_sgde']++;
            }
        }
        
        $despachosPorCircuito[$circuito] = [
            'despachos' => $despachosDelCircuito,
            'totales' => $totalesCircuito
        ];
    }

    return view('administrador.ActividadesContratista.actividades-dashboard', 
        compact('totales', 'despachos', 'circuitos', 'despachosPorCircuito'));
}
    
   
  
}
