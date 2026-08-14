<?php

namespace App\Http\Controllers\Administrador;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Administrador;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

//Paginate

use Illuminate\Pagination\Paginator;

use App\Models\SolicitudAudiencia;
use App\Models\Detenido;
use App\Models\User;
use Illuminate\Support\Carbon;



class AudienciasAdminController extends Controller
{
       public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        $this->middleware('administrador');
        
    }
    
    public function audiencias(Request $request)
    {
        $fechaCon = $request->fecha;   
        $radicado = $request->radicado;
        $email = $request->email;
        
         //dd($request->all());
            
        if(empty($request->fecha) && empty($request->radicado) && empty($request->email)){

        $fecha = Carbon::now()->toDateString();
        //dd($fecha);
        $fechademas = Carbon::now();
        $fechademas->addDays(2)->toDateString(); 
           

        $solicitudes = SolicitudAudiencia::
        where('fecha_prgramada', $fecha)
        //->fecha($fechaCon)
        //->paginate(1);
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        //dd($solicitudes);
        }else{

        $solicitudes = SolicitudAudiencia::
        fecha($fechaCon)
        ->radicado($radicado)
        ->email($email)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        
        }
        
        $solicitudAudiencia = new SolicitudAudiencia();
        return view('administrador.audiencias.audiencias', compact('solicitudes','solicitudAudiencia'));
       
    }
    
    public function audienciasEditar(Request $request, $id)
    {
        //dd($request->all());
        
      $tecnicos=User::where('rol',2)->pluck('name','id');
      //dd($tecnicos);
      $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
      //$solicitudAudiencia->Detenidos;
      //dd($solicitudAudiencia);
      return view('administrador.audiencias.edit',compact('solicitudAudiencia','tecnicos'));
        
        
    }
    
    
     public function actualizarAudiencia(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'numero_radicado_proceso'=> 'required|numeric|digits:23',
            'fecha_prgramada' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',           
            'ciudad_destino' => 'required|max:150',
            'entidad_destino' => 'required|max:250',
            'declarante_indiciado' => 'required|max:250',
            //'quien_asigno' => 'required',
            'telefono' => 'required|max:30',
            'audiencia_privada' => 'required',
            'detenido' => 'required'
            ]);
            $solicitudAudiencia = SolicitudAudiencia::findOrFail($id);
            $solicitudAudiencia->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
            $solicitudAudiencia->save();
            
            Session::flash('success', 'Audiencia actualizada correctamente!');
           
            return Redirect::to('administrador/solicitudes/audiencias');    
           
    }
    
    
}
