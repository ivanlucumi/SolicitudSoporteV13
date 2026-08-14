<?php

namespace App\Http\Controllers\Comodato;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Support\Facades\Log;

use App\Models\TodoEnUno;

use App\Models\User;

use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\TodoEnUnoInstalacion;
use App\Models\AsignacionEquipo;
use App\Models\Empleado;

class TodoEnUnoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Uticom');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $soporte = New TodoEnUnoInstalacion();
        return view('Comodato.TodoEnUno.Index',compact('soporte','ciudades','despachos'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
        
         
        
        
        $request->validate([
            'fecha_instalacion' => 'required|date',
            'numero_cedula' => 'required|max:11',
            'nombre_contacto' => 'required|max:200',
            'usuario_dominio'=> 'required|max:30',
            'correo_personal_inst'=> 'required|max:180',
            'seccional' => 'required|max:50',
            'ciudad' => 'required|max:80',
            'direccion' => 'required|max:120',
            'telefono' => 'required|max:30',
            'email' => 'required|max:180',
            'despacho' => 'required|max:12',
            'placa_equipo' => 'required|max:25',
            'serial_equipo' => 'required|max:25|unique:todo_en_uno_instalacion',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:30',
            'placa_teclado'=> 'required|max:25',
            'serial_teclado'=> 'required|max:25',
            'placa_mouse'=> 'required|max:25',
            'serial_mouse'=> 'required|max:25',
            
            'ip'=>'required|max:15|unique:todo_en_uno_instalacion',
            'descripcion_servicio' => 'required|max:200',
            'observaciones' => 'required|max:200',
            'firma' => 'required',
            ]);
            
        
        DB::beginTransaction();
        try{
        $despacho= Despacho::where('codigoDespacho',$request->despacho)->first();
        //dd($request->all(),$request->despacho,$despacho);
        
        $portatil =  TodoEnUno::where('serial_equipo',$request->serial_equipo)
        ->where('estado','SIN ASIGNAR')
        ->first();
        
       //dd($portatil);
        
        if(empty($portatil)){
               Session::flash('error', 'No se puede asignar TODO EN UNO!');
                return Redirect::back();
           }
        
         //dd($portatil);
        
        $reporte = new TodoEnUnoInstalacion();
                        $reporte->id_despacho =  $request->despacho;
             			$reporte->fecha_instalacion =  $request->fecha_instalacion;
				    	$reporte->numero_cedula =  $request->numero_cedula;
				    	$reporte->nombre_contacto =  ucwords($request->nombre_contacto);
				    	$reporte->usuario_dominio =  ucwords($request->usuario_dominio);
				    	$reporte->correo_personal_inst =  ucwords($request->correo_personal_inst);
				    	
             			$reporte->seccional =  ucwords($request->seccional);
				    	$reporte->ciudad =  ucwords($request->ciudad);
             			$reporte->direccion =  ucwords($request->direccion);
				    	$reporte->telefono =  $request->telefono;
             			$reporte->email =  $request->email;
				    	$reporte->despacho =  ucwords($despacho->nombreDespacho);
             			$reporte->placa_equipo =  strtoupper($request->placa_equipo);
				    	$reporte->serial_equipo =  strtoupper($request->serial_equipo);
				    	$reporte->marca =  strtoupper($request->marca);
				    	$reporte->modelo =  strtoupper($request->modelo);
				    	
				    	$reporte->placa_teclado =  strtoupper($request->placa_teclado);
				    	$reporte->serial_teclado =  strtoupper($request->serial_teclado);
				    	$reporte->placa_mouse =  strtoupper($request->placa_mouse);
				    	$reporte->serial_mouse =  strtoupper($request->serial_mouse);
				    	
				    	
             			$reporte->ip =  $request->ip;
				    	$reporte->descripcion_servicio =  ucwords($request->descripcion_servicio);
             			$reporte->observaciones =  ucwords($request->observaciones);
				    	$reporte->firma_funcionario =  $request->firma;
				    	$reporte->id_user =  auth()->user()->id;
                        $reporte ->save();
                        
                        $reporte ->firma_tecnico =  auth()->user()->firma;
                        $reporte ->cedula_tecnico =  auth()->user()->cedula;
                        
                        //dd($reporte ->firma_tecnico);
        
        
        
           if(!empty($portatil)){
            $portatil->estado="ASIGNADO";
        	$portatil->tecnico_id = auth()->user()->id;
            $portatil->instalacion_todo_en_uno_id=$reporte->id;
            $portatil ->save();
           }
         
         
         $data              =  json_decode(json_encode($reporte), true);               
        
        $pdf = Pdf::loadView('emails/soporte/PfdTodoEnUnoInstalacion',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
          
        $nombrePdf =$reporte->serial_equipo."-".$despacho->nombreDespacho."-".".pdf";
        //return $pdf->download($nombrePdf);
        $correoDes=str_replace(" ", "", $despacho->correoD);
        $supervisor ='jortegas@cendoj.ramajudicial.gov.co';
        $correoTec='alvarolasso99@hotmail.com';
        $almacen ='almacali@cendoj.ramajudicial.gov.co';
        $tecnico=  auth()->user()->email;
        $asunto="ACTA DE INSTALACION TODO EN UNO"." ".$request->fecha_instalacion;//." ".$reporte->serial."-".$reporte->marca."-".$reporte->modelo;
         Mail::send('emails/soporte/TodoEnUnoCorreo', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$correoTec,$asunto,$supervisor,$almacen,$tecnico) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($tecnico);
                $mail->cc($correoTec);
                $mail->cc($supervisor);
                //$mail->cc($almacen);
                $mail->subject($asunto);
                $mail->attachData($pdf->output(), $nombrePdf);
            });
         
         
          DB::commit();
          //dd($reporte);
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        
            Session::flash('success', 'Entrega de Todo En Uno con Exito!');
            return redirect()->route('tecnico.firma.todo_en_uno');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$caja)
    {
        /*$portatil=InventarioImpresoraComodato::where('serie',$serie)
        ->where('estado','SIN ASIGNAR')
        ->first();*/
        $portatil=TodoEnUno::where('num_caja',$caja)
        ->where('estado','SIN ASIGNAR')
        ->first();
        
        //dd($portatil);
        if(empty($portatil)){
            $portatil=TodoEnUno::where('num_caja',$caja)
            ->where('estado','ASIGNADO')
            ->first();
            
            if(!empty($portatil)){
                 $portatil = [
                    "placa_equipo" => "TODO EN UNO ASIGNADO",
                    "marca" => "TODO EN UNO ASIGNADO",
                    "modelo" => "TODO EN UNO ASIGNADO",
                    "serial_equipo" => "TODO EN UNO ASIGNADO",
                    'serial_teclado'=> "TODO EN UNO ASIGNADO",
                    'placa_teclado'=> "TODO EN UNO ASIGNADO",
                    'serial_mouse'=> "TODO EN UNO ASIGNADO",
                    'placa_mouse'=> "TODO EN UNO ASIGNADO",
                ];
                
            }else{
                $portatil = [
                    "placa_equipo" => "NO EXISTE, VALIDA NUM CAJA",
                    "marca" => "NO EXISTE, VALIDA NUM CAJA",
                    "modelo" => "NO EXISTE, VALIDA NUM CAJA",
                    "serial_equipo" => "NO EXISTE, VALIDA NUM CAJA",
                    'serial_teclado'=> "NO EXISTE, VALIDA NUM CAJA",
                    'placa_teclado'=> "NO EXISTE, VALIDA NUM CAJA",
                    'serial_mouse'=> "NO EXISTE, VALIDA NUM CAJA",
                    'placa_mouse'=> "NO EXISTE, VALIDA NUM CAJA",
                ]; 
            }
        }
        
        //dd($portatil);
        
        if($request->ajax())
        {
         
          return response()->json($portatil);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function listado(Request $request)
    {
        $impresoras = TodoEnUnoInstalacion::orderBy('updated_at','DESC')->get();
       // dd($impresoras,$impresoras->Intalacion);
       //dd($impresoras);
       
       return view('administrador.Comodato.Index',compact('impresoras'));
    }
    
    public function listadoTec(Request $request)
    {
        $portatiles = TodoEnUno::orderBy('updated_at','DESC')->get();
        //dd($portatiles->InstalacionP);
       //dd($impresoras);
       
       return view('soporte.ListadoPortatil',compact('portatiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
     
     public function descargarPdf(Request $request)
    {
        // Aumentar tiempo m��ximo de ejecuci��n
        set_time_limit(0);
        ini_set('max_execution_time', 0);
    
        // Seriales a consultar (puedes recibirlos por request o configurarlos ac��)
        //$seriales = ['8CN43505LF', '8CN43505DV', '8CN43505HT']; 
    
        // Obtener reportes
        //$reportes = TodoEnUnoInstalacion::whereIn('serial_equipo', $seriales)->get();
        $reportes = TodoEnUnoInstalacion::all();
    
        if ($reportes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron reportes.'], 404);
        }
    
        foreach ($reportes as $reporte) {
            try {
                // Buscar informaci��n relacionada
                $caja = TodoEnUno::where('serial_equipo', $reporte->serial_equipo)->first();
                $user = User::findOrFail($reporte->id_user);
    
                // Agregar firma y c��dula al reporte
                $reporte->firma_tecnico  = $user->firma;
                $reporte->cedula_tecnico = $user->cedula;
    
                // Nombre del PDF
                $nombrePdf = "{$caja->num_caja}-caja-{$reporte->serial_equipo}-{$reporte->despacho}.pdf";
    
                // Generar PDF
                $pdf = Pdf::loadView('emails.soporte.PfdTodoEnUnoInstalacion', compact('reporte'))
                    ->setPaper('legal', 'portrait')
                    ->setOptions([
                        
                        'isRemoteEnabled' => true,
                        'dpi' => 620
                    ]);
    
                
                // Guardar PDF
                \Storage::disk('backups')->put($nombrePdf, $pdf->output());
                
    
                Log::info("PDF generado: {$nombrePdf}");
    
                echo "�7�3 PDF generado: {$reporte->serial_equipo}<br>";
                ob_flush();
                flush();
    
                // Esperar unos segundos para no saturar CPU/memoria
                sleep(5);
    
            } catch (\Exception $e) {
                Log::error("Error generando PDF para {$reporte->serial_equipo}: " . $e->getMessage());
                echo "�7�4 Error con {$reporte->serial_equipo}: {$e->getMessage()}<br>";
            }
        }
    
        return response()->json(['message' => 'PDFs generados correctamente.'], 200);
    }

     
     public function descargarPdfEmail(Request $request)
    {
       //$reportes = TodoEnUnoInstalacion::all();
       
      // $reportes = TodoEnUnoInstalacion::WHERE('fecha_instalacion','>=','2024-11-01')->get();
      // $reportes = TodoEnUnoInstalacion::WHERE('serial_equipo','8CN43504NC')->get();
      
      // Seriales a consultar
        $seriales = [
            /*'8CN43505DV', '8CN43504RL', '8CN435045W', '8CN43505HT', '8CN43505NG',
            '8CN43504SP', '8CN4520J9F', '8CN4520HB2', '8CN4520H4Y', '8CN4520HBF',
            '8CN4520JCS', '8CN4520FZ6', '8CN4520JC0', '8CN4520HBC', '8CN4520JF0',
            '8CN4520H9G', '8CN4520JGL', '8CN4520JDV', '8CN4520FVK', '8CN4520FT0',
            '8CN4520HCF', '8CN4520JC5', '8CN4520J1X', '8CN4520JBC', '8CN4520J3V',
            '8CN4520J18', '8CN4520JGN', '8CN4520J1B', '8CN4520J3W', '8CN43505BV',
            '8CN43505N0', '8CN4520JBB', '8CN4520JHT', '8CN4520J94', '8CN43505MQ',
            '8CN43505KY', '8CN4520JHL', '8CN43505MZ', '8CN4520J4Y', '8CN43505L5',
            '8CN4520JB1', '8CN43505LH'*/
        ];
        
        $seriales = ['8CN43505LF'];

        // Aumentar tiempo máximo de ejecución
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        // Obtener reportes por serial
        $reportes = TodoEnUnoInstalacion::whereIn('serial_equipo', $seriales)->get();
        //dd($reportes);
        
       // $reportes = TodoEnUnoInstalacion::WHERE('fecha_instalacion','>=','2025-02-07')->get();

        foreach ($reportes as $index => $reporte) {
            try {
                // Buscar info relacionada
                $caja = TodoEnUno::where('serial_equipo', $reporte->serial_equipo)->first();
                $user = User::findOrFail($reporte->id_user);
                $reporte->firma_tecnico = $user->firma;
                $reporte->cedula_tecnico = $user->cedula;

                // Generar PDF
                $nombrePdf = "{$caja->num_caja}caja-{$reporte->serial_equipo}-{$reporte->despacho}.pdf";
                $pdf = Pdf::loadView('emails.soporte.PfdTodoEnUnoInstalacion', compact('reporte'))
                    ->setPaper('legal', 'portrait')
                    ->setOptions([
                        
                        'isRemoteEnabled' => true,
                        'dpi' => '620'
                    ]);

                // Guardar PDF
                \Storage::disk('backups')->put($nombrePdf, $pdf->output());
                
                
                //return $pdf->download($nombrePdf);
                
                //url descargar descarga/listado/todo_en_uno/

                // Enviar correo
                $asunto = 'ACTA DE INSTALACION CONTRATO DE COMODATO DE IMPRESORAS 001 DE 2023';
                $data = json_decode(json_encode($reporte), true);
                
                $supervisor ='jortegas@cendoj.ramajudicial.gov.co';
                $correoTec='teccoorseccali@cendoj.ramajudicial.gov.co';

               Mail::send('emails.soporte.ComprobanteComodato', $data, function ($mail) use ($pdf, $nombrePdf, $asunto,$supervisor,$correoTec) {
                    $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                    $mail->to($supervisor);
                    $mail->cc($correoTec);
                    $mail->subject($asunto);
                    $mail->attachData($pdf->output(), $nombrePdf);
                });

                Log::info("Correo enviado: {$reporte->serial_equipo}");

                // Mensaje de progreso (opcional si ejecutas desde consola o navegador)
                echo "Correo enviado a: {$correoTec} - {$reporte->serial_equipo}<br>";
                ob_flush();
                flush();

                // Esperar 20 segundos
                sleep(5);

            } catch (\Exception $e) {
               // Log::error("Error enviando correo: " . $e->getMessage());
            }
        }

        echo "Proceso completado.";
    
       
    }
   
    
       public function consultaCedulaE(Request $request,$id){
         
         //dd($request->all(),$id);
         
        //CONSULTAR ASIGNACION
        $asignacion = AsignacionEquipo::where('cedula',$id)->first();
        
        if(Empty($asignacion)){
                
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
        }else{
            
            
            
           $persona= AsignacionEquipo::where('cedula',$id)->first();
           
           $despacho=Despacho::where('codigoDespacho',$persona->despacho_id)->first();
           
           $persona->asignacion="asignado";
           $persona->direccion =$despacho->direccion;
           $persona->telefono =$despacho->telefono;
           $persona->extension =$despacho->extension;
           $persona->correoD =$despacho->correoD;
           $persona->cod_despacho =$persona->despacho_id;
        }
        
        
        
    
       //dd($persona,$despacho);
        
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($persona);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
