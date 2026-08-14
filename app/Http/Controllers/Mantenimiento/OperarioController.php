<?php

namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\Operario;
use App\Models\ReporteIncidente;
use App\Models\User;

use App\Models\Despacho;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Models\InventarioAlmacen;
use App\Models\SolicitudAlmacen;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OperarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');        
        $this->middleware('Operario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $incidentes = ReporteIncidente::where('asignado_a', auth()->user()->name)
        ->where('estado','!=','REALIZADO')
        ->get();  
        
        
        $categorias = array();
        
        $solicitudes= new SolicitudAlmacen();
        $solicitud=null;
        
        $inventario=InventarioAlmacen::where('status','Disponible')->
        orderBy('descripcion', 'ASC')
        ->get();
        
        //dd($inventario);
        
        return view('mantenimiento.operario.index',compact('incidentes','inventario','solicitudes','solicitud'));
        
    }
    

    public function Revision(Request $request,$id){
        
        $incidente = ReporteIncidente::find($id);
        
        if($request->ajax())
        {
         
          return response()->json($incidente = ReporteIncidente::find($id));
        }

        //$solicitud = ReporteIncidente::findOrFail($id);
        //return view('mantenimiento.reporte',compact('solicitud','operario','mantenimiento'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->all(),isset($request->respuesta_tecnico)!= null);
       $reporte = ReporteIncidente::find($request->id);
       //dd($reporte);
       $reporte->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
      
       $reporte->save();
       
      $email=User::where('cedula',$reporte->id_usuario)
      ->select('email')->first();

        if($reporte->estado == 'REALIZADO'){
             $data              =  json_decode(json_encode($reporte), true);

        Mail::send('emails.Mantenimiento.NotificacionCierre', $data, function ($message) use ($reporte,$email) {
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
            $message->to($email->email);
            $message->cc('gmstdesajvalle3@cendoj.ramajudicial.gov.co');
            $message->subject('Registro de incidente Cerrado ');
        });
        
        $mantenimiento= User::where('rol',13)
        ->where('estado_rol','PRINCIPAL')
        ->select('email')
        ->get();
        //dd($mantenimiento[0]->email);
        
        foreach($mantenimiento as $manteni){
            
          Mail::send('emails.reporteIncidente', $data, function ($message) use ($reporte,$manteni) {
              
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
            $message->cc('gmstdesajvalle3@cendoj.ramajudicial.gov.co');
            $message->to($manteni->email);
            $message->subject('Registro de incidente Cerrado ');
        });  
        }
        
        
        }
        
        
       Session::flash('message', ' actualizado correctamente');
       return Redirect::to('reporte/incidentes/operario');
    }
    
     public function comentar(Request $request)
    {
       //dd($request->all(),isset($request->respuesta_tecnico)!= null,$request->comentarios_internos);
       $reporte = ReporteIncidente::find($request->id);
       //dd($reporte);
       
       $reporte->estado = $request->estado;
       $reporte->comentarios_internos =$reporte->comentarios_internos."       ".  auth()->user()->name.": ". $request->comentarios_internos.".";
      
       $reporte->save();
        
       Session::flash('message', 'Comentario Realizado');
       return Redirect::to('reporte/incidentes/operario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operario  $operario
     * @return \Illuminate\Http\Response
     */
     
     
    public function Ver(){
        
        $incidentes = ReporteIncidente::where('asignado_a', auth()->user()->name)
        ->where('estado','REALIZADO')
        ->get();  
        
        $inventario=InventarioAlmacen::where('status','Disponible')->
        orderBy('descripcion', 'ASC')
        ->get();
        
        //dd($inventario);
        
        
        $categorias = array();
        
        return view('mantenimiento.operario.cerrado',compact('incidentes','inventario'));
        
    } 
     
     
    public function pedirElementos(Request $request, $id)
    {
        //dd($request->all(), $id);
        $reporte = ReporteIncidente::find($id);
        //dd($reporte);
        
        $inventario=InventarioAlmacen::where('status','Disponible')->
        orderBy('descripcion', 'ASC')
        ->get();
        
        $solicitudes= SolicitudAlmacen::where('id_almacen',$id)->get();
        
        
        
        
         return view('mantenimiento.operario.PedirElementos',compact('reporte','inventario','solicitudes'));
    }

   
    public function SolicitarAlmacen(Request $request)
    {
        
        //DD($request->ALL());
        $this->validate($request, [
                'caso'=>'required',
                'elemento' => 'required',
                'cantidad'=>'required|numeric',
                //'observaciones'=>'required',
            ]);
        
         
            
        
        $reporte = ReporteIncidente::find($request->caso);
        //dd($reporte);
        
        $despacho = Despacho::where('codigoDespacho',$reporte->id_usuario) 
        ->select('circuito')
        ->first();
        
        //dd($despacho,$reporte);
        
        $reporte = ReporteIncidente::find($request->caso);
        //dd($reporte);
        
        $user= User::where('cedula',$reporte->id_usuario)
        ->select("email")->first();
        
        //dd($email);
          
         
        if(Empty($despacho)){
          // Session::flash('error', 'No tiene Tiene Circuito Asignado!');
          //  return Redirect::back(); 
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
        
        
        
        DB::beginTransaction();
        try{  
        
        $elementos = new SolicitudAlmacen();
        $elementos->id_elemento = $Elemento->inventario_id;
        $elementos->elemento = $request->elemento;
        $elementos->cantidad = $request->cantidad;
        $elementos->observaciones = $request->observaciones;
        $elementos->id_despacho =  $reporte->id_usuario;
        $elementos->despacho = $reporte->nombre_usuario;
        $elementos->circuito = "MANTENIMIENTO";
        $elementos->correo_despacho = $user->email;
        $elementos->mes_solicitud =$mes;
        $elementos->fecha_solicitud =$fecha;
        $elementos->id_almacen = $request->caso;
        $elementos->save();
        
        
            
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
       // dd($id);
        SolicitudAlmacen::destroy($id);
        return response()->json(['success' => true]);
    }
    
    //EnviarAlmacen
     public function EnviarAlmacen(Request $request){
        
        //dd($request->all());
        
        $this->validate($request, [
                'caso'=>'required|numeric',
                'comentarios_internos'=>'required',
            ]);
        
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
        
        $Solicitud = SolicitudAlmacen::where('id_almacen',$request->caso)
            //->where('mes_solicitud', $mes)
            ->where('estado_solicitud', null)
            ->get();
            
        //dd($Solicitud->isEmpty(),$Solicitud);
        if($Solicitud->isEmpty()){
           Session::flash('error', 'No tiene Elementos Pendientes por Enviar!');
            return Redirect::back(); 
        }else{
          $Solici = SolicitudAlmacen::where('id_almacen',$request->caso)
            //->where('mes_solicitud', $mes)
            ->where('estado_solicitud', null)
            ->first(); 
         $nombreDespacho = $Solici->NomDespacho->nombreDespacho ?? 'Nombre no disponible';
         
         // Actualizar el estado de las solicitudes
            SolicitudAlmacen::where('id_almacen', $request->caso)
                ->where('mes_solicitud', $mes)
                ->where('estado_solicitud', null)
                ->update(['estado_solicitud' => 'ENVIADO',
                'cedula'=> auth()->user()->cedula,
                'nombre'=>"MANTENIMIENTO: ". auth()->user()->name,
                'apellido'=> auth()->user()->lastname,
                'num_seguimiento'=>$key]);
        }
        
       
        //$mailOficina = SolicitudAlmacen::Oficinas($despacho->circuito);
        
        $mailOficina ='siriscali@cendoj.ramajudicial.gov.co';
        
        $email =  auth()->user()->email;
        //$email = 'gmstdesajvalle3@cendoj.ramajudicial.gov.co';
        //$email = $request->correo_despacho;
        
        $elementos = $Solicitud->toArray();
        
        //dd($elementos);
        
        // Enviar el correo utilizando un Mailable
        Mail::to([$email,$mailOficina])->send(new NotificacionSolicitudAlmacen($elementos, $nombreDespacho));
        
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
    
}
