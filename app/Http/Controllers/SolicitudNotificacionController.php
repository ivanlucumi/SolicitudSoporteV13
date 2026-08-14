<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudNotificacion;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SolicitudNotificacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');

        $this->middleware('usuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificacion = new SolicitudNotificacion();
        $TipoAudiencia = SolicitudNotificacion::clase_audiencia();
        $TipoIdentificacion = SolicitudNotificacion::tipo_identificacion();
        $TipoParte = SolicitudNotificacion::tipo_parte();
        $TipoNotificacion = SolicitudNotificacion::tipo_notificacion();
        return view('usuario.notificacion.registro',compact('notificacion','TipoAudiencia','TipoIdentificacion','TipoParte','TipoNotificacion'));
    }

    public function historico(Request $request)
    {
      $notificaciones = Notificacion::select('id_seguimiento','despacho','numero_radicado_proceso','delito','clase_audiencia', 'fecha_audiencia', 'hora_inicio', 'lugar')
      ->where('codigoDespacho', auth()->user()->cedula)
      ->groupBy('id_seguimiento','despacho','numero_radicado_proceso','fecha_audiencia','hora_inicio','delito','clase_audiencia', 'lugar')
      ->get();  
    
        //dd($notificaciones);
     return view('usuario.notificacion.historico',compact('notificaciones'));
        
    }
    
     public function mostrarSolicitud(Request $request,$id_seguimiento){
       $notificacion = Notificacion::where('id_seguimiento',$id_seguimiento)
      ->get(); 
      
      //dd($notificacion[0]);
      
      return view('usuario.notificacion.solicitudes',compact('notificacion'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
        'codigoDespacho' =>'required',
        'correo_despacho' =>'required',
        'despacho' =>'required',
        'numero_radicado_proceso' =>'required|numeric|digits:23',
        //'oficio' =>'required',
        'delito' =>'required',
        'clase_audiencia' =>'required',
        'fecha_audiencia' =>'required',
        'hora_inicio' =>'required',
        'lugar' =>'required',
        /*'tipo_identificacion' =>'required',
        'nombre_apellido' =>'required',
        'tipo_parte' =>'required',
        'tipo_notificacion' =>'required',*/
        ]);
        //dd(count($request->tipo_identificacion),$request->tipo_identificacion);
        
       


        $notificacion = new SolicitudNotificacion();
        $notificacion->codigoDespacho =  auth()->user()->cedula;
        $notificacion->correo_despacho =  auth()->user()->email;
        $notificacion->despacho =  auth()->user()->name."  ". auth()->user()->lastname;
        $notificacion->numero_radicado_proceso = $request->numero_radicado_proceso;
        $notificacion->oficio = $request->oficio;
        $notificacion->delito = $request->delito;
        $notificacion->clase_audiencia = $request->clase_audiencia;
        $notificacion->fecha_audiencia = $request->fecha_audiencia;
        $notificacion->hora_inicio = $request->hora_inicio;
        $notificacion->lugar = $request->lugar;
        $notificacion->fecha_recibido = Carbon::now();

        /*$notificacion->tipo_identificacion = $request->tipo_identificacion;
        $notificacion->identificacion = $request->identificacion;
        $notificacion->nombre_apellido = $request->nombre_apellido;
        $notificacion->tipo_parte = $request->tipo_parte;
        $notificacion->tipo_notificacion = $request->tipo_notificacion;
        $notificacion->direccion = $request->direccion;
        $notificacion->ciudad = $request->ciudad;
        $notificacion->telefono_citado = $request->telefono_citado;
        $notificacion->observaciones = $request->observaciones;
        */
        //$notificacion ->save();
        //dd($notificacion);

        //$mensaje=   $this->notificados($notificacion);

        //return redirect()->route('usuario.solicitud.vincular.notificacion', array('id' =>$notificacion));
        $notificacion = $notificacion;
        $TipoAudiencia = SolicitudNotificacion::clase_audiencia();
        $TipoIdentificacion = SolicitudNotificacion::tipo_identificacion();
        $TipoParte = SolicitudNotificacion::tipo_parte();
        $TipoNotificacion = SolicitudNotificacion::tipo_notificacion();
       // dd($notificaciones);

        $notificaciones = Notificacion::where('numero_radicado_proceso',$notificacion->numero_radicado_proceso)->get();
        //dd($notificaciones);
        return view('usuario.notificacion.index',compact('notificacion','TipoAudiencia','TipoIdentificacion','TipoParte','TipoNotificacion','notificaciones'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SolicitudNotificacion  $solicitudNotificacion
     * @return \Illuminate\Http\Response
     */
    private function notificados($notificacion)
    {
       // dd($notificacion);
    	$notificaciones = $notificacion;
        $TipoAudiencia = SolicitudNotificacion::clase_audiencia();
        $TipoIdentificacion = SolicitudNotificacion::tipo_identificacion();
        $TipoParte = SolicitudNotificacion::tipo_parte();
        $TipoNotificacion = SolicitudNotificacion::tipo_notificacion();
        //dd($notificacion , $id);

        //$notificaciones = Notificacion::where('numero_radicado_proceso',$notificacion->numero_radicado_proceso)->get();
        //dd($notificaciones);
        return view('usuario.notificacion.index',compact('notificacion','TipoAudiencia','TipoIdentificacion','TipoParte','TipoNotificacion','notificaciones'));

        //dd($solicitudNotificacion);

    }
    public function save_notificados(Request $request)
    {

        //dd($request->all());


        $this->validate($request, [
        'codigoDespacho' =>'required',
        'correo_despacho' =>'required',
        'despacho' =>'required',
        'numero_radicado_proceso' =>'required|numeric|digits:23',
        //'oficio' =>'required',
        'delito' =>'required',
        //'clase_audiencia' =>'required',
        'fecha_audiencia' =>'required',
        'hora_inicio' =>'required',
        'lugar' =>'required',
        'tipo_identificacion' =>'required',
        'nombre_apellido' =>'required',
        'tipo_parte' =>'required',
        'tipo_notificacion' =>'required',
        ]);

        $contador= count($request->tipo_identificacion);
        
          $elementos = "";
        $id_seguimiento = '';
        $pattern = '1234567890-ABCDEFGHIJKLMNOPQRSTUVWXYZ&$#@';
        $max     = strlen($pattern)-1;
        
   
        for ($p = 0; $p < 10; $p++)
        {
            $id_seguimiento .= ($p%2) ? $pattern[mt_rand(19, 23)] : $pattern[mt_rand(0, 18)];
        }
        
        



        for ($i=0; $i < $contador; $i++) {
            $notificacion = new Notificacion();
            
            $notificacion->id_seguimiento = $id_seguimiento;
            $notificacion->codigoDespacho =  auth()->user()->cedula;
            $notificacion->correo_despacho =  auth()->user()->email;
            $notificacion->despacho =  auth()->user()->name."  ". auth()->user()->lastname;
            $notificacion->numero_radicado_proceso = $request->numero_radicado_proceso;
            //$notificacion->oficio = $request->oficio;
            $notificacion->delito = $request->delito;
            $notificacion->clase_audiencia = $request->clase_audiencia;
            $notificacion->fecha_audiencia = $request->fecha_audiencia;
            $notificacion->hora_inicio = $request->hora_inicio;
            $notificacion->lugar = $request->lugar;
            //$notificacion->telefono_despacho = $request->telefono_despacho;
            $notificacion->fecha_recibido = Carbon::now();

            $notificacion->tipo_identificacion = $request->tipo_identificacion[$i];
            $notificacion->identificacion = $request->identificacion[$i];
            $notificacion->nombre_apellido = $request->nombre_apellido[$i];
            $notificacion->tipo_parte = $request->tipo_parte[$i];
            $notificacion->tipo_notificacion = $request->tipo_notificacion[$i];
            $notificacion->direccion = $request->direccion[$i];
            $notificacion->ciudad = $request->ciudad[$i];
            $notificacion->telefono_citado = $request->telefono_citado[$i];
            $notificacion->correo_citado = $request->correo_citado[$i];
            $notificacion->observaciones = $request->observaciones[$i];

            $notificacion ->save();
        }

        //dd($notificacion);


        Session::flash('message', 'Notificacion almacenada correctamente');
        return redirect()->back();

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SolicitudNotificacion  $solicitudNotificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitudNotificacion $solicitudNotificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SolicitudNotificacion  $solicitudNotificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolicitudNotificacion $solicitudNotificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SolicitudNotificacion  $solicitudNotificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitudNotificacion $solicitudNotificacion)
    {
        //
    }
}
