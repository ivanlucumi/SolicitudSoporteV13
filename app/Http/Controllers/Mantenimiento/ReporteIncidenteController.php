<?php

namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\RequerimientoDespacho;
use App\Models\RequerimientoElemento;
use App\Models\RequerimientoCategoria;
use App\Models\Despacho;


use App\Models\CategoriaIncidente;
use App\Models\CategoriaIncidenteItem;
use App\Models\ReporteIncidente;

use App\Models\Categoria;
use App\Models\TipoRequerimiento;
use App\Models\Empleado;
use App\Models\Inventario;


class ReporteIncidenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');      
        $this->middleware('Mantenimiento');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( auth()->user()->estado_rol == "PRINCIPAL") {
            $incidentes = ReporteIncidente::where('reportado_a', 'PRINCIPAL')
                ->where('estado', '!=', 'REALIZADO')
                ->get();
               // dd($incidentes,'principal');
        }else{
            $incidentes = ReporteIncidente::where(function ($query) {
                $query->where('id_asignado_a',  auth()->id())
                      ->orWhere('id_trasladado_a',  auth()->id());
            })
            ->where('estado', '!=', 'REALIZADO')
            ->get();
           // dd($incidentes,'otro');
            
        }
         
        
        /*if(){
             $incidentes = ReporteIncidente::where(function ($query) {
                    $query->where('reportado_a', 'PRINCIPAL')
                          ->orWhere('trasladado_a',  auth()->id());
                })
                ->where('estado', '!=', 'REALIZADO')
                ->get(); 
        }*/
        
        //DD($incidentes);
        
        $categorias= RequerimientoCategoria::all();
        
       // $operario= User::where('rol',14)->pluck('name','name');
        
        $operario = User::where('rol', 14)
        ->select(DB::raw("CONCAT_WS(' ', name, lastname, CONCAT('(', circuito, ')')) AS nombre_completo, id"))
        ->whereNotNull('name')
        ->whereNotNull('lastname')
        ->whereNotNull('circuito') // opcional, si deseas forzar que circuito tambi谷n exista
        ->pluck('nombre_completo', 'id');
        
        //dd($operario);
        
        $mantenimiento = User::where('rol', 13)
        ->select(DB::raw("CONCAT_WS(' ', name, lastname, CONCAT('(', circuito, ')')) AS nombre_completo, id"))
        ->whereNotNull('name')
        ->whereNotNull('lastname')
        ->whereNotNull('circuito') // opcional, si deseas forzar que circuito tambi谷n exista
        ->pluck('nombre_completo', 'id');
        
        return view('mantenimiento.index',compact('categorias','incidentes','operario','mantenimiento'));
        
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        //dd($request);
        $banner = ReporteIncidente::find($id);
        $banner->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $banner->save();

        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('mantenimiento/reporte/incidentes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       //dd($request->estado,$request->all());
       
        $reporte = ReporteIncidente::find($request->id);
        
        $comentariosInterno =$reporte->comentarios_internos;
        
        if($request->estado != "REALIZADO" ){
            if(isset($request->asignado_a)){
               $user= User::find($request->asignado_a);
               $asignado = true;
            }
            if(isset($request->trasladado_a)){
               $user= User::find($request->trasladado_a);
               $traslado = true;
            }
            
        }
       // dd("no entr車");
        
        
        
        $categoria =RequerimientoCategoria::where('nombre',$request->categoria)->first();
        
        //dd($categoria,$request->categoria,$request->all());
        
        if(!empty($categoria)){
            
            $category = $categoria->nombre;
            $items = RequerimientoElemento::where('elemento',$request->reporte)
            ->select('elemento')
            ->first();
            $item=$items->elemento;
        }else{
             $category = $request->categoria;
            $item = $request->reporte;
        }
        //dd($reporte);
        $reporte->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        
        
        $reporte->categoria = $category;
        if(isset($asignado)){
            $reporte->id_asignado_a = $request->asignado_a;
            $reporte->asignado_a = $user->name." ".$user->lastname;
            $reporte->estado = $request->estado;
            
        }
        if(isset($traslado)){
            $reporte->id_trasladado_a = $request->trasladado_a;
            $reporte->trasladado_a = $user->name." ".$user->lastname;
            
        }
        $reporte->item = $item;
        $reporte->comentarios_internos = $comentariosInterno."    .  ". auth()->user()->name." ". auth()->user()->lastname.": " .$request->comentarios_internos  ;
      // dd($reporte);
        $reporte->save();

        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('mantenimiento/reporte/incidentes');
    }
    
    public function cerrar(Request $request)
    {
        DB::beginTransaction();
        try{ 
       
       // dd($request->all());
       
        $reporte = ReporteIncidente::find($request->id);
        
       
       // dd("no entr車");
        
        
        
        $categoria =RequerimientoCategoria::find($request->categoria);
        
        if(!empty($categoria)){
            
            $category = $categoria->nombre;
            $items = RequerimientoElemento::where('id',$request->item)
            ->select('elemento')
            ->first();
            $item=$items->elemento;
        }else{
             $category = $request->categoria;
            $item = $request->item;
        }
        //dd($reporte);
        $reporte->fecha_cerrado = $request->fecha_reporte;
        $reporte->estado = $request->estado;
        $reporte->observaciones = $request->observaciones;
        $reporte->respuesta_tecnico = $request->respuesta_tecnico;
        $reporte->save();
        
         DB::commit();
        
        $reporte->comentarios_notificacion =$request->comentarios_notificacion;
        
        if(isset($request->correos_destinatarios)){
            
            $data              =  json_decode(json_encode($reporte), true); 
            $correoNotificacion = $request->correos_destinatarios;
            $destinatarios = array_filter(array_map('trim', explode(';', $correoNotificacion)));
            $asunto='Notificacion de Cierre Requerimiento SARA';
            
            if (!empty($destinatarios)) {
                 // Función para enviar correos (evita duplicar código)
                $enviarCorreo = function ($destinatarios) use ($data, $asunto) {
                    Mail::send('emails.Mantenimiento.NotificacionCierre', $data, function ($mail) use ($data,$destinatarios, $asunto) {
                        $mail->from('informacion@disajcali.gov.co', 'SIRISCALI')
                             //->to($destinatarios)
                             ->to('gmstdesajvalle3@cendoj.ramajudicial.gov.co')
                             ->subject($asunto);
                    });
                };
                
                 $enviarCorreo($destinatarios);
                
                }
        }
            
            // dd($reporte);
        
       
       
       

        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('mantenimiento/reporte/incidentes');
        
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cerrados()
    {
        if( auth()->user()->estado_rol== "PRINCIPAL"){
            $incidentes = ReporteIncidente::where('reportado_a',"PRINCIPAL")
            ->where('estado',"REALIZADO")->get();
        }else{
            $incidentes = ReporteIncidente::where('trasladado_a', auth()->user())
            ->where('estado',"REALIZADO")->get();  
        }
        
        $categorias = array();
        
        $operario= User::where('rol',14)->pluck('name','name');
        $mantenimiento = User::where('rol',13)->pluck('name','name');
        return view('mantenimiento.cerrado',compact('categorias','incidentes','operario','mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Solicitudes(Request $request)
    {
      
       $requerimientodespachos= RequerimientoDespacho::where('fecha_cerrado', null)->get();
       
       return view('mantenimiento.SolicitudDespacho',compact('requerimientodespachos')); 
    }

    public function ver(Request $request, $id)
    {
        
        $requerimientodespachos=RequerimientoDespacho::findOrFail($id);
        //dd($reporte->id_user, auth()->user());
        if($requerimientodespachos->id_user == null || $requerimientodespachos->id_user== auth()->user()->id){
            $requerimientodespachos->estado = "EN GESTION";
            $requerimientodespachos->id_user =  auth()->user()->id;
            $requerimientodespachos->quien_atiende =  auth()->user()->name." ". auth()->user()->lastname;
            $requerimientodespachos->save();
    
           // dd($requerimientodespachos);
            return view('mantenimiento.verSolicitud',compact('requerimientodespachos'));
        }

        Session::flash('message', 'Ya esta siendo Resuelta');
        return redirect()->route('reporte.incidentes.solicitudes');
    }

    
    public function guardar(Request $request,$id)
    {
        
        //dd($request->all(),isset($request->respuesta_tecnico)!= null);
        
        $this->validate($request, [
                'respuesta' => 'required',
                 'estado' => 'required|in:ARREGLO PARCIAL,PENDIENTE,REALIZADO', // Valida que el campo sea requerido y tenga uno de los valores permitidos
                ]);
        
        DB::beginTransaction();
        try{     
        $requerimientodespachos=RequerimientoDespacho::findOrFail($id);
        $requerimientodespachos->respuesta = $request->respuesta;
        $requerimientodespachos->fecha_cerrado = Carbon::Now();
        $requerimientodespachos->estado = $request->estado;
        $requerimientodespachos->save();
        
        //dd($request->all(),$requerimientodespachos);
        DB::commit();
         
        Session::flash('message', 'SE CAMBIA ESTA A '.$request->estado);
        return redirect()->route('reporte.incidentes.solicitudes');
         
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
        
    }
    
    public function soltar(Request $request,$id)
    {
        $requerimientodespachos=RequerimientoDespacho::findOrFail($id);
            $requerimientodespachos->estado = NULL;
            $requerimientodespachos->id_user = NULL;
            $requerimientodespachos->quien_atiende = NULL;
            $requerimientodespachos->save();
            Session::flash('message', 'Se libera solicitud');
        return redirect()->route('reporte.incidentes.solicitudes');
    }
    
    
    public function CrearSolicitud(Request $request){
        
        $incidentes = ReporteIncidente::where('id_usuario', auth()->user()->cedula)
        ->select('id','consecutivo','categoria','item','descripcion','created_at','estado','observaciones')
        ->orderby('created_at','DESC')
        ->get();
        
        $despachos = Despacho::select('codigoDespacho','nombreDespacho')->get();
        
        
        $categorias= RequerimientoCategoria::all();
        
        
        return view('mantenimiento.CrearSolicitud',compact('categorias','incidentes','despachos'));
        
    }
    
    public function SaveSolicitud(Request $request){
        $rules = [
            'categoria' => 'required|array',
            'item' => 'required|array',
            'identificacion' => 'required|max:15',
            'nombre_funcionario' => 'required|max:120',
            'descripcion' => 'required',
            'despacho_id'=> 'required',
            'ubicacion'=> 'required',
            'piso'=> 'required',
        ];
        
        $request->validate($rules);
        
        $codigo = (string) $request->despacho_id;

        $despacho = $codigo === '7600100000'
            ? (object) [
                'codigoDespacho' =>  auth()->user()->cedula,
                'nombreDespacho' => 'ZONA COMUN',
                'correoD'        =>  auth()->user()->email,
            ]
            : Despacho::where('codigoDespacho', $codigo)->firstOrFail();
        
        
        
        // Validar campos "otro_item" si alguno de los requerimientos es "otro"
        foreach ($request->item as $index => $val) {
            if ($val === 'otro' && empty($request->otro_item[$index])) {
                return back()->withErrors(['Debe especificar el requerimiento en la opción OTRO.'])->withInput();
            }
        }
        
        //genarar radicado 
        $date=Carbon::now();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $d=rand(1,30);
        $aleat = substr(md5(time()), 0, 3);
        
        
        //dd($request->all(),$categoria,$item);
        
        //lamacenar varios requermientos
        foreach ($request->categoria as $index => $categoria_id) {
            
            $consecutivo= $date->format('Y').$date->format('m')."-".rand(1,30).substr(md5(time()), 0, 10);

            $categoria = RequerimientoCategoria::findOrFail($categoria_id);
            
            if ($request->item[$index] === 'otro') {
                $item_nombre = $request->otro_item[$index];
            } else {
                $item = RequerimientoElemento::where('id', $request->item[$index])->first();
                $item_nombre = $item->elemento;
            }
        
            $Incidentes = new ReporteIncidente();
            $Incidentes->consecutivo = $consecutivo;
            $Incidentes->id_usuario = $despacho->codigoDespacho;
            $Incidentes->nombre_despacho =$despacho->nombreDespacho;
            $Incidentes->email_despacho = $despacho->correoD;
            $Incidentes->identificacion = $request->identificacion;
            $Incidentes->nombre_funcionario = $request->nombre_funcionario;
            $Incidentes->categoria = $categoria->nombre;
            $Incidentes->item = $item_nombre;
            $Incidentes->descripcion = $request->descripcion;
            $Incidentes->estado = "RECIBIDO";
            $Incidentes->reportado_a = "PRINCIPAL";
            $Incidentes->save();
        }

        
        
        
        $data              =  json_decode(json_encode($Incidentes), true);

       /* Mail::send('emails.reporteIncidente', $data, function ($message) use ($Incidentes) {
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
            $message->to( auth()->user()->email);
            $message->subject('Registro de incidente ');
        });*/
        
        $mantenimiento= User::where('rol',13)
        ->where('estado_rol','PRINCIPAL')
        ->select('email')
        ->get();
        //dd($mantenimiento[0]->email);
        
        foreach($mantenimiento as $manteni){
            
         /* Mail::send('emails.reporteIncidente', $data, function ($message) use ($Incidentes,$manteni) {
              
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
           
            $message->to($manteni->email);
            $message->subject('Registro de incidente ');
        }); */ 
        }

        Session::flash('message','Se registro Incidente!!');
        return redirect()->back(); 
        //return Redirect::to('usuarios/reporte/incidente');
 
    }
    
    
    public function ElementosMantenimietno(Request $request, $id){
        
        //dd($request->all(),$id);
        
        $items = RequerimientoElemento::where('category_id',$id)->get();
        
        return $items;
        
        //return response()->json($elements);
    }

    public function reporteIncidenteSelect(Request $request,$id){

        $items = CategoriaIncidenteItem::where('categoria_item_id',$id)->get();
        //dd($items);
        return $items;
    }
    
    
}
