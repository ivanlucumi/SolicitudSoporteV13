<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;


use App\Imports\InventarioAlmacenImport;


use App\Exports\AlmacenExport;

use Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\SolicitudAlmacen;
use App\Models\Despacho;
use App\Models\InventarioAlmacen;
use App\Models\InventarioCircuito;
use Maatwebsite\Excel\Facades\Excel;


use App\Mail\NotificacionAlmacen;
use App\Mail\NotificacionEntregaAlmacen;

class AlmacenController extends Controller
{
    //

     public function __construct(){
        $this->middleware('auth');
        //$this->middleware('cambiopass');
        $this->middleware('almacen');
        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd('hola');
        
        return view('Almacen.Index');

    }
    public function Solicitudes(Request $request)
    {
        $circuitos =  auth()->user()->circuito_almacen;
        
        $circuito = explode(',',$circuitos);
        
        //dd($circuito);
        
        
        
        
        if(!empty($request->all())){
       /* $Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
        ->where('id_despacho',$request->despacho)
        ->where('num_seguimiento',null)
        ->where('fecha_respuesta',null)
        ->whereIn('circuito', $circuito)
        ->select('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada')
        ->groupBy('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada')
        ->get();*/
        
        
         $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
        ->where('id_despacho', $request->despacho)
        ->where('estado_solicitud','!=', 'REALIZADO')
        ->whereNull('fecha_respuesta')
        ->whereIn('circuito', $circuito)
        ->selectRaw(
            'id_despacho, 
            id_quien_atendio,
            num_seguimiento,
            fecha_solicitud,
            COUNT(DISTINCT elemento) as total_elementos, 
            SUM(cantidad) as total_cantidad, 
            GROUP_CONCAT(observaciones SEPARATOR ", ") as observaciones_combinadas'
        )
        ->groupBy('id_despacho', 'num_seguimiento','id_quien_atendio','fecha_solicitud') // Asegúrate de incluir num_seguimiento aquí
        ->orderBy('fecha_solicitud', 'asc') // orden ascendente
        ->get();
        
        //dd($Solicitudes);
        $despacho =$request->despacho;
        }else{
         /* $Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
        ->where('num_seguimiento',null)
        ->where('fecha_respuesta',null)
        ->whereIn('circuito', $circuito)
        ->select('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada')
        ->groupBy('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada')
        ->get();*/
        
        $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
        //->where('id_despacho', $request->despacho)
        ->where('estado_solicitud','!=', 'REALIZADO')
        ->whereNull('fecha_respuesta')
        ->whereIn('circuito', $circuito)
        ->selectRaw(
            'id_despacho, 
            id_quien_atendio,
            num_seguimiento,
            fecha_solicitud,
            COUNT(DISTINCT elemento) as total_elementos, 
            SUM(cantidad) as total_cantidad, 
            GROUP_CONCAT(observaciones SEPARATOR ", ") as observaciones_combinadas'
        )
        ->groupBy('id_despacho', 'num_seguimiento','id_quien_atendio','fecha_solicitud') // Asegúrate de incluir num_seguimiento aquí
        ->orderBy('fecha_solicitud', 'asc') // orden ascendente
        ->get();
        
        //dd($Solicitudes);
        
        $despacho =null;
        }
        
        
       // dd($Solicitudes);
        $despachos = SolicitudAlmacen::where('estado_solicitud','ENVIADO')
        //->where('num_seguimiento',null)
        ->where('fecha_respuesta',null)
        ->whereIn('circuito', $circuito)
        ->distinct('id_despacho')
        ->pluck('despacho','id_despacho');
        //dd($despacho);
        return view('Almacen.Solicitudes',compact('Solicitudes','despachos','despacho'));
       
        
    }
    
    /*public function SolicitudDespacho(Request $request,$id){
        
        //dd($id);
        $circuitos =  auth()->user()->circuito_almacen;
        
        $circuito = explode(',',$circuitos);
       // dd($circuito);
        
        
        
        $Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
        //->where('id_despacho',$id)
        ->where('num_seguimiento',$id)
        //->where('fecha_respuesta',null)
        ->where('estado_solicitud','!=', 'REALIZADO')
        //->whereIn('circuito', $circuito)
        ->select('id_despacho','num_seguimiento','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada')
        ->groupBy('id_despacho','num_seguimiento','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada')
        ->get();
        //dd($Solicitudes);
        
        
        if(empty($Solicitudes->id_quien_atendio) || $Solicitudes->id_quien_atendio ==  auth()->user()->id ){
           $solicitudFinal = SolicitudAlmacen::where('num_seguimiento',$request->id)
                //->where('mes_solicitud', $mes)
                ->where('estado_solicitud', 'ENVIADO')
                ->update(['id_quien_atendio' =>  auth()->user()->id,
                          'quien_atendio'=> auth()->user()->name." ". auth()->user()->lastname]); 
        }else{
          return redirect()->back()->with('error', 'ESTE REQUERIMIENTO YA ESTA SIENDO ATENTIDO.');  
        }
        
        
        if( auth()->user()->circuito_almacen != "CALI"){
            
            
            
              $Solicitudes->each(function ($elemento) {
                  
                //ELEMENTOS DEL INVENTARIODEL CIRCUITO
                $elementosDisponible = InventarioCircuito::where('user_id', auth()->id())
                ->where('inventario_general_id', $elemento->id_elemento)
                ->sum('cantidad_disponible');
                  
                // Sumar todas las cantidades ASIGNADAS DESDE ALMACEN CALI para este elemento (de la tabla despachos)
                $totalAsignado = SolicitudAlmacen::where('id_elemento', $elemento->id)
                ->where('id_despacho', auth()->user()->codigo_oficina_apoyo)
                    ->sum('cantidad_entregada');
                    
                // Sumar todas las cantidades ENTREGADAS A LOS JUZGADOS DE LOS CIRCUITOS (de la tabla inventario_circuito)
                $totalEntregado = SolicitudAlmacen::where('id_elemento', $elemento->id_elemento)
                ->where('id_quien_atendio', auth()->id())
                ->sum('cantidad_entregada');
                
                //DD($totalAsignado,$totalEntregado,$elementosDisponible,$elemento);
                    
                // Calcular disponibilidad
                $elemento->disponible = max(0, ($elementosDisponible + $totalAsignado) - $totalEntregado);
            });   
            
           // DD($Solicitudes);
            
        }
        
        
        
        
        
        
        $nombreDespacho = $Solicitudes[0]->NomDespacho->nombreDespacho;
        
        //dd($nombreDespacho);
        
        return view('Almacen.Resolver',compact('Solicitudes'));
        
    }*/
    
    public function SolicitudDespacho(Request $request, $id)
{
    $circuitos =  auth()->user()->circuito_almacen;
    $circuito = explode(',', $circuitos);

    $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
        ->where('num_seguimiento', $id)
        ->where('estado_solicitud', '!=', 'REALIZADO')
        ->select(
            'id_despacho',
            'num_seguimiento',
            'id',
            'elemento',
            'id_elemento',
            'cantidad',
            'fecha_solicitud',
            'observaciones',
            'cantidad_entregada',
            'cedula',
            'nombre',
            'apellido'
        )
        ->groupBy(
            'id_despacho',
            'num_seguimiento',
            'id',
            'elemento',
            'id_elemento',
            'cantidad',
            'fecha_solicitud',
            'observaciones',
            'cantidad_entregada',
            'cedula',
            'nombre',
            'apellido'
        )
        ->get();

    // Verificar si puede atender la solicitud
    if (empty($Solicitudes->first()->id_quien_atendio) || $Solicitudes->first()->id_quien_atendio ==  auth()->user()->id) {
        SolicitudAlmacen::where('num_seguimiento', $request->id)
            ->where('estado_solicitud', 'ENVIADO')
            ->update([
                'id_quien_atendio' =>  auth()->user()->id,
                'quien_atendio' =>  auth()->user()->name . ' ' .  auth()->user()->lastname
            ]);
    } else {
        return redirect()->back()->with('error', 'ESTE REQUERIMIENTO YA ESTÁ SIENDO ATENDIDO.');
    }

    // Calcular disponibilidad si no es CALI
    if ( auth()->user()->circuito_almacen != 'CALI') {
        $Solicitudes->each(function ($elemento) {
            $cantidadCircuito = InventarioCircuito::where('user_id', auth()->id())
                ->where('inventario_general_id', $elemento->id_elemento)
                ->sum('cantidad_disponible');

            $totalAsignado = SolicitudAlmacen::where('id_elemento', $elemento->id_elemento)
                ->where('id_despacho',  auth()->user()->codigo_oficina_apoyo)
                ->sum('cantidad_entregada');

            $totalEntregado = SolicitudAlmacen::where('id_elemento', $elemento->id_elemento)
                ->where('id_quien_atendio', auth()->id())
                ->sum('cantidad_entregada');

            $elemento->disponible = max(0, ($cantidadCircuito + $totalAsignado) - $totalEntregado);
        });
    }

    $nombreDespacho = $Solicitudes->first()->NomDespacho->nombreDespacho;

    return view('Almacen.Resolver', compact('Solicitudes', 'nombreDespacho'));
}

    
    
    
    public function Historial(Request $request)
    {
        $mesActual = Carbon::now()->month;
        
        
        if($mesActual < 3){
           $mesActual = 11; 
        }else{
            $mesActual =$mesActual-2;
        }
        $circuitos =  auth()->user()->circuito_almacen;
        
        $circuito = explode(',',$circuitos);
        
        $meses = ['1' => 'ENERO', '2' => 'FEBRERO', '3' => 'MARZO','4'=>'ABRIL','5'=>'MAYO','6' => 'JUNIO', '7' => 'JULIO',
                  '8' => 'AGOSTO','9'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
                  
        
        
        if(!empty($request->all())){
            if( auth()->user()->circuito_almacen =="CALI"){
                
                $despachos = SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                ->distinct('id_despacho')
                ->pluck('despacho','id_despacho');
                
                /* $Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                ->where('id_despacho',$request->despacho)
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                ->where('mes_solicitud',$request->mes)
                ->select('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->groupBy('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->get();*/
                
                $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
                ->where('id_despacho', $request->despacho)
                ->whereNotNull('num_seguimiento')
                ->whereNotNull('fecha_respuesta')
                ->where('mes_solicitud', $request->mes)
                ->select('id_despacho', 'num_seguimiento', 'elemento', 'id_elemento', 'cantidad', 'fecha_solicitud', 'observaciones', 'cantidad_entregada', 'quien_atendio')
                ->get()
                ->groupBy(['id_despacho', 'num_seguimiento']);
                
                //dd($Solicitudes);
                $despacho =$request->despacho;
                $mes = $request->mes;
                
            }else{
                
                 $despachos = SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                ->whereNotNull('num_seguimiento')
                ->whereNotNull('fecha_respuesta')
                ->whereIn('circuito', $circuito)
                ->distinct('id_despacho')
                ->pluck('despacho','id_despacho');
                
                /*$Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                ->where('id_despacho',$request->despacho)
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                ->whereIn('circuito', $circuito)
                ->where('mes_solicitud',$request->mes)
                ->select('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->groupBy('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->get();*/
                
                $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
                ->where('id_despacho', $request->despacho)
                ->whereNotNull('num_seguimiento')
                ->whereNotNull('fecha_respuesta')
                ->whereIn('circuito', $circuito)
                ->where('mes_solicitud', $request->mes)
                ->select('id_despacho', 'num_seguimiento', 'elemento', 'id_elemento', 'cantidad', 'fecha_solicitud', 'observaciones', 'cantidad_entregada', 'quien_atendio')
                ->get()
                ->groupBy(['id_despacho', 'num_seguimiento']);
                
                //dd($Solicitudes,' SIN NADA');
                $despacho =$request->despacho;
                $mes = $request->mes;
                
            }
                
        }else{
            
            
            if( auth()->user()->circuito_almacen =="CALI"){
                //dd( auth()->user()->circuito_almacen);
                $despachos = SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                ->distinct('id_despacho')
                ->pluck('despacho','id_despacho');
                
               /*  $Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                //->where('id_despacho',$request->despacho)
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                //->where('mes_solicitud','>=',$mesActual)
                ->select('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->groupBy('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->paginate(3000);*/
                //->get();
                $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
                //->where('id_despacho', $request->despacho)
                ->whereNotNull('num_seguimiento')
                ->whereNotNull('fecha_respuesta')
                //->where('mes_solicitud','>',$mesActual)
                ->select('id_despacho', 'num_seguimiento', 'elemento', 'id_elemento', 'cantidad', 'fecha_solicitud', 'observacion_cierre', 'cantidad_entregada', 'quien_atendio')
                ->get()
                ->groupBy(['id_despacho', 'num_seguimiento']);
                //->paginate(3000);
                
                
                
                //dd($Solicitudes,'entro',$mesActual);
                
            }else{
                
                 $despachos = SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                ->whereIn('circuito', $circuito)
                ->distinct('id_despacho')
                ->pluck('despacho','id_despacho');
                
               /* $Solicitudes =SolicitudAlmacen::where('estado_solicitud','ENVIADO')
                //->where('id_despacho',$request->despacho)
                ->where('num_seguimiento','!=',null)
                ->where('fecha_respuesta','!=',null)
                ->whereIn('circuito', $circuito)
                //->where('mes_solicitud','>=',$mesActual)
                ->select('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->groupBy('id_despacho','id','elemento','id_elemento','cantidad','fecha_solicitud','observaciones','cantidad_entregada','num_seguimiento','quien_atendio')
                ->paginate(3000);*/
                //->get();
                
                $Solicitudes = SolicitudAlmacen::where('estado_solicitud', 'ENVIADO')
                //->where('id_despacho', $request->despacho)
                ->whereNotNull('num_seguimiento')
                ->whereNotNull('fecha_respuesta')
                ->whereIn('circuito', $circuito)
                //->where('mes_solicitud','>=',$mesActual)
                ->select('id_despacho', 'num_seguimiento', 'elemento', 'id_elemento', 'cantidad', 'fecha_solicitud', 'observaciones', 'cantidad_entregada', 'quien_atendio')
                ->get()
                ->groupBy(['id_despacho', 'num_seguimiento']);
                //->paginate(3000);
                
                
                
            }; 
            $despacho =null;
            $mes = null;
        }
        
        //dd($Solicitudes);
        return view('Almacen.Historico',compact('Solicitudes','despachos','despacho','meses','mes'));
    }
    
    
    
     public function generateCsv($num_seguimiento)
    {
        // Filtrar las solicitudes por número de seguimiento
        $solicitudes = SolicitudAlmacen::where('num_seguimiento', $num_seguimiento)->get();

        // Verificar si hay solicitudes
        if ($solicitudes->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron solicitudes con ese número de seguimiento.');
        }
        //dd($solicitudes);
        
        // Validar que todas las solicitudes tengan cantidad entregada
        foreach ($solicitudes as $solicitud) {
            if ($solicitud->cantidad_entregada === null || $solicitud->cantidad_entregada === '') {
                return redirect()->back()->with('error', 'Debe completarse todos los campos de cantidad entregada.');
            }
        }
        

        // Construir el contenido del archivo con formato tabulado
            $contenido = '';
            foreach ($solicitudes as $solicitud) {
                $contenido .= "{$solicitud->id_elemento}\t{$solicitud->cantidad_entregada}\t{$solicitud->id_despacho}\n";
            }
        
            // Nombre y ruta del archivo
            $fileName = "solicitudes_{$num_seguimiento}.txt";
            $filePath = storage_path("app/public/{$fileName}");
        
            // Guardar el contenido en el archivo
            file_put_contents($filePath, $contenido);
        
            // Retornar el archivo para su descarga y eliminarlo después del envío
            return Response::download($filePath)->deleteFileAfterSend(true);
    }
    
    public function generateCsvPedido($num_seguimiento)
    {
        // Obtener las solicitudes filtradas por número de seguimiento
        $solicitudes = SolicitudAlmacen::where('num_seguimiento', $num_seguimiento)
        ->where('estado_solicitud', "ENVIADO")
        ->get();
        //dd($solicitudes);

        // Verificar si hay solicitudes
        if ($solicitudes->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron solicitudes con ese número de seguimiento.');
        }

        // Validar que todas las solicitudes tengan cantidad entregada
        foreach ($solicitudes as $solicitud) {
            if (empty($solicitud->cantidad_entregada)) {
                return redirect()->back()->with('error', 'Debe completarse todos los campos de cantidad entregada.');
            }
        }

        // Crear el contenido del archivo
        // Construir el contenido del archivo con formato tabulado
        $contenido = '';
        foreach ($solicitudes as $solicitud) {
            $contenido .= "{$solicitud->id_elemento}\t{$solicitud->cantidad_entregada}\t{$solicitud->id_despacho}\n";
        }
    
        // Nombre y ruta del archivo
        $fileName = "solicitudes_{$num_seguimiento}.txt";
        $filePath = storage_path("app/public/{$fileName}");
    
        // Guardar el contenido en el archivo
        file_put_contents($filePath, $contenido);
    
        // Retornar el archivo para su descarga y eliminarlo después del envío
        return Response::download($filePath)->deleteFileAfterSend(true);
    }
    
   
    
    
    
    public function Elementos()
    {
        $elementos= InventarioAlmacen::all();
       // ->get();
        //dd($elementos);
        return view('Almacen.Elementos',compact('elementos'));
    }
    
    public function cambiarEstado(Request $request)
        {
            $elemento = InventarioAlmacen::find($request->id);
            if ($elemento) {
                $elemento->status = $request->estado;
                $elemento->save();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
        }
    
    
    // AlmacenController.php
    public function updateCantidad(Request $request)
    {
       /* if( auth()->user()->circuito_almacen != "CALI"){
          $solicitud = SolicitudAlmacen::find($request->id);  
          
          $elemento = InventarioCircuito::where('inventario_general_id', $solicitud->id_elemento)
            ->where('user_id',  auth()->user()->id)
            ->select('cantidad_disponible')
            ->first();
          
          //dd($solicitud,$elemento);
          if ($elemento && $elemento->cantidad_disponible < $request->cantidad_entregada) {
                return response()->json([
                    'success' => false,
                    'message' => 'No está disponible la cantidad solicitada de: ' . $solicitud->elemento. '.   Hay disponible '.$elemento->cantidad_disponible
                ]);
            }
            
        }*/
        
        
        $solicitud = SolicitudAlmacen::find($request->id);
        $solicitud->cantidad_entregada = $request->cantidad_entregada;
        $solicitud->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Elemento Asignado']);
    }
    
    
    
    public function sendEmail(Request $request)
    {
        
        //dd($request->all());
        
        $fecha = Carbon::now();
        $mes = $fecha->month;
        $circuitos =  auth()->user()->circuito_almacen;
        
        $circuito = explode(',',$circuitos);
        
        //dd($circuito[0]);
        
        
        
        $validatedData = $request->validate([
            'despacho_id' => 'required',
            'seguimiento' => 'required',
            'observaciones' => 'required|string',
        ]);
        
        DB::beginTransaction();
        try{   

        $user =$request->despacho_id;
        $observaciones = $request->observaciones;
        
        
         
         
         /*$Solicitud = SolicitudAlmacen::where('id_despacho',$user)
           // ->where('mes_solicitud', $mes)
            ->where('estado_solicitud', 'ENVIADO')
            //->where('num_seguimiento',$request->id)
            ->where('fecha_respuesta',null)
            ->whereIn('num_seguimiento',$request->id)
            ->get();*/
            
        $Solicitud = SolicitudAlmacen::where('num_seguimiento',$request->id)
           // ->where('mes_solicitud', $mes)
            ->where('estado_solicitud', 'ENVIADO')
            ->get();
            
        //dd($Solicitud);
        
        if($Solicitud->isEmpty()){
           return redirect()->route('almacen.Solicitudes')->with('error', 'La Solicitud ya se soluciono.'); 
        }
         
        // Actualizar el estado de las solicitudes
           $solicitudFinal = SolicitudAlmacen::where('num_seguimiento',$request->id)
                //->where('mes_solicitud', $mes)
                ->where('estado_solicitud', 'ENVIADO')
                ->update(['fecha_respuesta' => $fecha,
                          'quien_atendio'=> auth()->user()->name,
                          'id_quien_atendio'=> auth()->user()->id,
                          'observacion_cierre'=>$request->observaciones]);
        
          
                
         $Solici = SolicitudAlmacen::where('id_despacho',$user)
           // ->where('mes_solicitud', $mes)
           // ->where('estado_solicitud', 'ENVIADO')
            ->first(); 
         // dd($solicitudFinal,$Solici);
            
         $nombreDespacho = $Solici->NomDespacho->nombreDespacho ?? 'Nombre no disponible';
        //$email = 'gmstdesajvalle3@cendoj.ramajudicial.gov.co';
        $email = $Solici->correo_despacho;
        $elementos = $Solicitud->toArray();
        
        //$mailOficina = SolicitudAlmacen::Oficinas($circuito[0]);
        $mailOficina ="gmstdesajvalle3@cendoj.ramajudicial.gov.co";
        
       //dd($mailOficina);
       
        // Enviar el correo utilizando un Mailable
      //  Mail::to([$email,$mailOficina])->send(new NotificacionEntregaAlmacen($elementos, $nombreDespacho,$observaciones));
        
        //
        
        DB::commit();
        
      return redirect()->route('almacen.Solicitudes')->with('success', 'Correo enviado exitosamente.');
         
        
        
        
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
    }
    
    
    
    
      //DESCARGAR FACTURA DE CUMPLIMIENTO
   public function solicitudExcel(Request $request){
       
       $circuitos =  auth()->user()->circuito_almacen;
        
        $circuito = explode(',',$circuitos);
       
       $fecha=Carbon::Now();
       // $dia_semana=$fecha->dayOfWeek;
       $mes = $fecha->month;
       
       $solicitudes = SolicitudAlmacen::select('id_despacho', 'despacho', 'id_elemento', 'elemento', 'cantidad', 'fecha_solicitud', 'observaciones','fecha_respuesta','cantidad_entregada','cedula','nombre','apellido')
            ->where('num_seguimiento', null)
            ->where('fecha_respuesta', null)
            ->where('mes_solicitud', $mes);
        
        if (empty($request->all())) {
            if ($circuitos != "CALI") {
                $solicitudes = $solicitudes->whereIn('circuito', $circuito);
            }
        } else {
            if ($circuitos != "CALI") {
                $solicitudes = $solicitudes->whereIn('circuito', $circuito);
                
            }
            $solicitudes->where('id_despacho', $request->despacho);
            
            
        }
        $solicitudes = $solicitudes->get();
       // dd($solicitudes);

       if ($solicitudes->isEmpty()) {
          return back()->with('error', 'No hay informacion para descargar.');  
        }
        //dd($notificaciones);

        return (new AlmacenExport($solicitudes))->download('Solicitud_Elementos.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


     //DESCARGAR EXCEL DEL HOSTORIAL
   public function solicitudExcelHistorial(Request $request){
       
       $fecha=Carbon::Now();
       // $dia_semana=$fecha->dayOfWeek;
       $mes = $request->mes;
       $circuitos =  auth()->user()->circuito_almacen;
        
        $circuito = explode(',',$circuitos);
       
        $solicitudes = SolicitudAlmacen::select('id_despacho', 'despacho', 'id_elemento', 'elemento', 'cantidad', 'fecha_solicitud', 'observaciones','fecha_respuesta','cantidad_entregada','cedula','nombre','apellido','quien_atendio')
            ->where('num_seguimiento', '!=',null)
            ->where('fecha_respuesta', '!=',null)
            ->where('mes_solicitud', $mes);
        
        if (empty($request->all())) {
            if ($circuitos != "CALI") {
                $solicitudes = $solicitudes->whereIn('circuito', $circuito);
            }
        } else {
            if ($circuitos != "CALI") {
                $solicitudes = $solicitudes->whereIn('circuito', $circuito);
            }
            
        }
        
        $solicitudes = $solicitudes->get();

       if ($solicitudes->isEmpty()) {
          return back()->with('error', 'No hay informacion para descargar.');  
        }

        
        
        $nombre = "Historico_Solicitud_Elementos_Mes_".$mes.".xlsx";

        //dd($notificaciones);

        return (new AlmacenExport($solicitudes))->download($nombre, \Maatwebsite\Excel\Excel::XLSX);
    }
    
    public function indexExcel()
    {
        return view('Almacen.IndexExcel');
    }

    public function importarExcel(Request $request)
    {
         try {
            $request->validate([
                'archivo' => 'required|file|mimes:xlsx,xls,csv'
            ]);
    
            // Verifica que el archivo exista físicamente
            if (!$request->hasFile('archivo')) {
                return redirect()->back()->with('error', 'No se ha cargado ningún archivo.');
            }
            
            dd($request->hasFile('archivo'));
    
            Excel::import(new InventarioAlmacenImport, $request->file('archivo'));
    
            return redirect()->back()->with('success', 'Inventario actualizado correctamente.');
    
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                Log::error('Error en importación Excel fila ' . $failure->row() . ': ' . implode(', ', $failure->errors()));
            }
            return redirect()->back()->with('error', 'Error de validación en el archivo Excel.');
    
        } catch (\Throwable $e) {
            Log::error('Error al importar Excel: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()->back()->with('error', 'Ocurrió un error durante la importación. Revisa el log.');
        }
    }
    
    
    
    //elementos de los circuito  
    public function ElementoCircuito(Request $request){
        // Obtener todos los inventarios ordenados
        $inventarios = InventarioAlmacen::orderBy('descripcion', 'ASC')->get();
        
        // Obtener elementos asignados al usuario actual
        $elementos = InventarioCircuito::where('user_id', auth()->id())
            ->whereHas('inventario')
            ->with('inventario')
            ->get();
            
        //dd($elementos);
            
         // Calcular disponibilidad para cada inventario
        $elementos->each(function ($elemento) {
            // Sumar todas las cantidades ASIGNADAS DESDE ALMACEN CALI para este elemento (de la tabla despachos)
            $totalAsignado = SolicitudAlmacen::where('id_elemento', $elemento->id)
            ->where('id_despacho', auth()->user()->codigo_oficina_apoyo)
                ->sum('cantidad_entregada');
                
            // Sumar todas las cantidades ENTREGADAS A LOS JUZGADOS DE LOS CIRCUITOS (de la tabla inventario_circuito)
            $totalEntregado = SolicitudAlmacen::where('id_elemento', $elemento->id)
            ->where('id_quien_atendio', auth()->id())
            ->sum('cantidad_entregada');
            
            
                
            // Calcular disponibilidad
            $elemento->disponible = max(0, ($elemento->cantidad_disponible + $totalAsignado) - $totalEntregado);
        });    
        
        //dd($elementos);
            
    //dd($elementos);
        return view('Almacen.ElementosCircuito', compact('inventarios','elementos'));
    }
    
     public function ElementoCircuitoSave(Request $request){
         
        $request->validate([
            'inventario_general_id' => 'nullable|exists:inventarios_almacen,inventario_id',
            'nuevo_codigo' => 'nullable|required_without:inventario_general_id',
            'nueva_descripcion' => 'nullable|required_with:nuevo_codigo',
            'cantidad_disponible' => 'required|integer|min:0',
            //'circuito' => 'required|string|max:100',
        ]);
        
        //dd($request->all(), auth()->user()->circuito);

        // Si el usuario seleccionó "otro", creamos un nuevo registro en inventarios_almacen
        if ($request->inventario_general_id == '1000000') {
            $nuevo = InventarioAlmacen::create([
                'inventario_id' => $request->nuevo_codigo,
                'codigo_interno' => $request->nuevo_codigo,
                'descripcion' => $request->nueva_descripcion,
                'cantidad_final' => $request->cantidad_disponible,
                'status' => 'No_Disponible',
            ]);
            $inventario_general_id = $nuevo->inventario_id;
        } else {
            $inventario_general_id = $request->inventario_general_id;
        }

        InventarioCircuito::updateOrCreate(
            [
                'inventario_general_id' => $inventario_general_id,
                'circuito' =>  auth()->user()->circuito,
            ],
            [
                'user_id' => auth()->id(),
                'cantidad_disponible' => $request->cantidad_disponible,
                'status' => 'Disponible'
            ]
        );

        return redirect()->back()->with('success', 'Inventario registrado correctamente.');
    }
     public function cambiarEstadoCircuito(Request $request)
        {
            $elemento = InventarioCircuito::find($request->id);
            if ($elemento) {
                $elemento->status = $request->estado;
                $elemento->save();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
        }
    
    
    
    public function dashboard(Request $request)
    {
        $query = SolicitudAlmacen::query();
        
        // Aplicar filtros
        $this->applyFilters($query, $request);
        
        $solicitudes = $query->orderBy('fecha_solicitud', 'desc')->paginate(20);
        
        // Obtener estadísticas
        $estadisticas = $this->getStatistics($request);
        
        // En el método dashboard, antes del return view, agregar:
        $despachos = SolicitudAlmacen::select('despacho')
            ->distinct()
            ->orderBy('despacho')
            ->pluck('despacho');
        
        $circuitos = SolicitudAlmacen::select('circuito')
            ->distinct()
            ->orderBy('circuito')
            ->pluck('circuito');
        
        return view('Almacen.dashboard', compact('solicitudes', 'estadisticas', 'despachos', 'circuitos'));
    }
    
    protected function applyFilters($query, $request)
    {
        // Filtro por fechas
        if ($request->filled('fecha_inicio')) {
            $query->where('fecha_solicitud', '>=', $request->fecha_inicio);
        }
        
        if ($request->filled('fecha_fin')) {
            $query->where('fecha_solicitud', '<=', $request->fecha_fin);
        }
        
        // Filtro por elemento
        if ($request->filled('elemento')) {
            $query->where('elemento', 'like', '%'.$request->elemento.'%');
        }
        
        // Filtro por estado (simplificado)
        if ($request->filled('estado')) {
            if ($request->estado == 'ENVIADO') {
                $query->where('estado_solicitud', 'ENVIADO');
            } elseif ($request->estado == 'NO_ENVIADO') {
                $query->whereNull('estado_solicitud');
            }
        }
        
        // Filtro por despacho
        if ($request->filled('despacho')) {
            $query->where('despacho', 'like', '%'.$request->despacho.'%');
        }
        
        // Filtro por mes
        if ($request->filled('mes')) {
            $query->where('mes_solicitud', $request->mes);
        }
        
        // Filtro por circuito
        if ($request->filled('circuito')) {
            $query->where('circuito', $request->circuito);
        }
        
        // Filtro por entrega
        if ($request->filled('entrega')) {
            if ($request->entrega == 'ENTREGADO') {
                $query->whereNotNull('quien_atendio');
            } elseif ($request->entrega == 'NO_ENTREGADO') {
                $query->whereNull('quien_atendio');
            }
        }
    }
    
    protected function getStatistics($request)
    {
        $baseQuery = SolicitudAlmacen::query();
        $this->applyFilters($baseQuery, $request);
        
        return [
            'total' => $baseQuery->count(),
            'enviadas' => $baseQuery->clone()->where('estado_solicitud', 'ENVIADO')->count(),
            'no_enviadas' => $baseQuery->clone()->whereNull('estado_solicitud')->count(),
            'entregadas' => $baseQuery->clone()->whereNotNull('quien_atendio')->count(),
            'no_entregadas' => $baseQuery->clone()->whereNull('quien_atendio')->count(),
            'por_mes' => $this->getSolicitudesPorMes($baseQuery),
            'por_elemento' => $this->getSolicitudesPorElemento($baseQuery),
            'por_despacho' => $this->getSolicitudesPorDespacho($baseQuery),
            'por_circuito' => $this->getSolicitudesPorCircuito($baseQuery),
        ];
    }
    
    protected function getSolicitudesPorMes($baseQuery)
    {
        return $baseQuery->clone()
            ->select(
                DB::raw('mes_solicitud as mes'),
                DB::raw('count(*) as total'),
                DB::raw('sum(case when estado_solicitud = "ENVIADO" then 1 else 0 end) as enviadas'),
                DB::raw('sum(case when estado_solicitud is null then 1 else 0 end) as no_enviadas'),
                DB::raw('sum(case when quien_atendio is not null then 1 else 0 end) as entregadas'),
                DB::raw('sum(case when quien_atendio is null then 1 else 0 end) as no_entregadas')
            )
            ->groupBy('mes_solicitud')
            ->orderBy('mes_solicitud')
            ->get();
    }
    
    protected function getSolicitudesPorElemento($baseQuery)
    {
        return $baseQuery->clone()
            ->select(
                'elemento',
                DB::raw('count(*) as total'),
                DB::raw('sum(cantidad) as cantidad_total'),
                DB::raw('sum(cantidad_entregada) as cantidad_entregada'),
                DB::raw('sum(case when estado_solicitud = "ENVIADO" then 1 else 0 end) as enviadas'),
                DB::raw('sum(case when estado_solicitud is null then 1 else 0 end) as no_enviadas'),
                DB::raw('sum(case when quien_atendio is not null then 1 else 0 end) as entregadas'),
                DB::raw('sum(case when quien_atendio is null then 1 else 0 end) as no_entregadas')
            )
            ->groupBy('elemento')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
    }
    
    protected function getSolicitudesPorDespacho($baseQuery)
    {
        return $baseQuery->clone()
            ->select(
                'despacho',
                'circuito',
                DB::raw('count(*) as total'),
                DB::raw('sum(case when estado_solicitud = "ENVIADO" then 1 else 0 end) as enviadas'),
                DB::raw('sum(case when estado_solicitud is null then 1 else 0 end) as no_enviadas'),
                DB::raw('sum(case when quien_atendio is not null then 1 else 0 end) as entregadas'),
                DB::raw('sum(case when quien_atendio is null then 1 else 0 end) as no_entregadas')
            )
            ->groupBy('despacho', 'circuito')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
    }
    
    protected function getSolicitudesPorCircuito($baseQuery)
    {
        return $baseQuery->clone()
            ->select(
                'circuito',
                DB::raw('count(*) as total'),
                DB::raw('sum(case when estado_solicitud = "ENVIADO" then 1 else 0 end) as enviadas'),
                DB::raw('sum(case when estado_solicitud is null then 1 else 0 end) as no_enviadas'),
                DB::raw('sum(case when quien_atendio is not null then 1 else 0 end) as entregadas'),
                DB::raw('sum(case when quien_atendio is null then 1 else 0 end) as no_entregadas')
            )
            ->groupBy('circuito')
            ->orderBy('total', 'desc')
            ->get();
    }
    
    
    
    public function importarElementosDesdeExcelCircuito(Request $request)
    {
        //dd($request->all(),$request->file('archivo_excel'));
        
        $request->validate([
            'archivo_excel' => 'required|mimes:xlsx,xls,csv',
        ]);
    
        $archivo = $request->file('archivo_excel');
        $datos = Excel::toArray([], $archivo)[0]; // solo primera hoja
    
        // Quitar la primera fila si tiene encabezados
        if (strtolower($datos[0][0]) === 'codigo') {
            array_shift($datos);
        }
    
        $circuito =  auth()->user()->circuito;
    
        foreach ($datos as $fila) {
            
            //dd($fila);
            $codigo = trim($fila[0] ?? '');
            $descripcion = trim($fila[1] ?? '');
            $cantidad = intval($fila[2] ?? 0);
    
            if (empty($codigo)) continue; // Saltar si el código está vacío
    
            // Verificar si ya existe el elemento
            $inventario = InventarioAlmacen::where('inventario_id', $codigo)->first();
    
            if (!$inventario) {
                // Crear el elemento si no existe
                $inventario = InventarioAlmacen::create([
                    'inventario_id' => $codigo,
                    'codigo_interno' => $codigo,
                    'descripcion' => $descripcion ?: 'Sin descripción',
                    'cantidad_final' => 0,
                    'status' => 'No_Disponible',
                ]);
            }
    
            // Crear o actualizar el registro en inventario_circuito
            InventarioCircuito::updateOrCreate(
                [
                    'inventario_general_id' => $inventario->inventario_id,
                    'circuito' => $circuito,
                ],
                [
                    'user_id' => auth()->id(),
                    'cantidad_disponible' => $cantidad,
                    'status' => 'Disponible'
                ]
            );
        }
    
        return back()->with('success', 'Elementos cargados correctamente desde el Excel.');
    }
    
    public function misSolicitudes(Request $request){
        //dd($request->all());
        
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
            
        $inventario =InventarioCircuito::InventarioAlmacenCircuito2( auth()->user()->circuito); 
        
        return view('Almacen.MisPedidos',compact('inventario','Estado','solicitudes'));
    }
   
}
