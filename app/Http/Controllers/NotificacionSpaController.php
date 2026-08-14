<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\SolicitudNotificacion;
use App\Models\Notificacion;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\NotificacionExport;


class NotificacionSpaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('Digitalizacion');

    }
    //

    public function index(){

        $notificaciones = Notificacion::where('oficio',null)
        // ->where('estado',null)
        ->get();
        //dd($notificaciones);
        return view('notificaciones.index',compact('notificaciones'));
        //dd('hola mundo');
    }

    public function enProceso(){

        $notificaciones = Notificacion::where('oficio','!=',null)
        //->where('estado','!=',null)
        ->get();
        //dd($notificaciones);
        $estado =  Notificacion::estado();
        return view('notificaciones.historico',compact('notificaciones','estado'));
        //dd('hola mundo');
    }
    
     public function solicitudes(){

      $notificaciones = Notificacion::select('id_seguimiento','despacho','numero_radicado_proceso','delito','clase_audiencia', 'fecha_audiencia', 'hora_inicio', 'lugar','telefono_despacho')
      ->groupBy('id_seguimiento','despacho','numero_radicado_proceso','delito','clase_audiencia', 'fecha_audiencia', 'hora_inicio', 'lugar','telefono_despacho')
      ->get();
      
      // dd($notificaciones);
        return view('notificaciones.Notificacion',compact('notificaciones'));
        //dd('hola mundo');
    }
    
    public function mostrarNotificacion(Request $request,$id_seguimiento){
       $notificacion = Notificacion::where('id_seguimiento',$id_seguimiento)
      ->get(); 
      
      //dd($notificacion[0]);
      
      return view('notificaciones.solicitud',compact('notificacion'));

    }

    public function guardarOficio(Request $request,$id){
       //dd($request->oficio+$id);
        /*$this->validate($request, [
            'oficio'+$id => 'required'
            ]);*/

        if($request->ajax()){
            $notificacion = Notificacion::findOrFail($id);
            $notificacion->oficio = $request->oficio;
            $notificacion ->save();
            return $request->oficio+$id;
             }

    }

    public function excel(Request $request){

        $noti = $request->dinamico;

        $reportar =$request->dinamico;
        
        if(empty($reportar)){
            Session::flash('success', 'No se puede Descargar el Excel si no selecciona Datos !');
            return Redirect::back();
        }

        foreach( $reportar as $notificacion){
           $notific = Notificacion::findOrFail($notificacion);
           $notific->estado = "En Proceso De Notificacion";
           $notific->save();
        }

        //$Notificacion = $noti->toArray();

        //dd( $noti);

        $notificaciones = Notificacion::select(
            
            "fecha_recibido",
            "oficio" ,
            
            
            "despacho" ,
            "numero_radicado_proceso" ,
            
            "delito",
            "clase_audiencia",
            "fecha_audiencia",
            "hora_inicio" ,
            "lugar" ,
            "tipo_parte" ,
            "tipo_identificacion",
            "identificacion" ,
            "nombre_apellido" ,
            "direccion" ,
            "correo_citado" ,
            "telefono_citado",
            "ciudad" ,
            "tipo_notificacion" ,
            "observaciones" ,
            
            "codigoDespacho" ,
            "correo_despacho",
            "telefono_despacho"
            
        )
        ->whereIn('id', $noti)
        ->get();

        //dd($notificaciones);

        return (new NotificacionExport($notificaciones))->download('NOTIFICACIONES_SPA.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


}
