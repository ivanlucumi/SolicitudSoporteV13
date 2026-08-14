<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Validation\Rule;

use Illuminate\Support\Collection;

use App\Models\RegistroIp;


use App\Models\Segmento;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use App\Models\Despacho;

class RegistroIpController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
         //$this->middleware('Uticom');
         
     }

     public function index(){
        
        return view('soporte.index');
    }

    public function listado(Request $request){
        //dd($request->all());
       // $listado= RegistroIp::orderBy('ip', 'ASC')->get();
       
       if(empty($request->all())){
        $listado= RegistroIp::where('sede', 'PALACIO JUSTICIA')
        ->where('municipio','CALI')
        ->get();
       }else{
           if(empty($request->ip)){
                $listado= RegistroIp::where('sede',$request->sede)
                ->where('municipio',$request->municipio)
                ->get();  
        //dd($listado);
           }else{
              $listado= RegistroIp::where('ip',$request->ip)
                //->where('municipio',$request->municipio)
                ->get();  
           }
        
       }
        $despacho = Despacho::all();
        //where('codCiudad',76001)
        //->orWhere('codCiudad',76736)
       // ->get(); 
        $despachos = collect($despacho);
        $equipos=RegistroIp::equipos();
        $municipios=RegistroIp::municipios();
        $sedes=RegistroIp::sedes();
        //dd($despachos);
        if( auth()->user()->rol == "1") {
        
        //dd($equipos,$municipios,$sedes);
        return view('administrador.RegistroIp.ListadoIp',compact('listado','despachos','equipos','municipios','sedes'));
        }elseif( auth()->user()->rol == "2"){
          return view('audiencias.tecnico.listadoIp',compact('listado'));  
        }else{
         return view('soporte.ListadoIp',compact('listado','despachos','equipos','municipios','sedes'));   
        }
        
    }

    public function editar_registro_ip(Request $request,$id){
        $ip =RegistroIp::FindOrFail($id); 
        //dd($ip);
        $listado= RegistroIp::all();
        $despacho = Despacho::all();
        //$despacho = Despacho::where('codCiudad',76001)->get();
        $despachos = collect($despacho);
        $equipos=RegistroIp::equipos();
        $municipios=RegistroIp::municipios();
        $sedes=RegistroIp::sedes();
        if( auth()->user()->rol == "1") {
        return view('administrador.RegistroIp.editarRegistrIp',compact('ip','listado','despachos','equipos','municipios','sedes'));
        }else{
        return view('soporte.editarRegistrIp',compact('ip','listado','despachos','equipos','municipios','sedes'));
        }
    }
    
    public function registro_store(Request $request){
       //dd($request->all());
        
        if($request->despacho == "OTRO"){
           $this->validate($request, [
                'despacho'=>'required',
                'oficina'=>'required|max:100',
                'tipo_equipo'=>'required',
                'nombre_equipo'=>'required|max:100',
                'ip'=>'required|max:15|unique:registro_ips',
                ]);  
        }else{
            $this->validate($request, [
                'despacho'=>'required',
                'tipo_equipo'=>'required',
                'nombre_equipo'=>'required|max:100',
                'ip'=>'required|max:15|unique:registro_ips',
                ]);
        }
        
        
                
         $reporte = new RegistroIp();
          // $reporte->codigo_despacho = $key;
          $reporte->municipio = $request->municipio;
           $reporte->sede = $request->sede;
           $reporte->despacho = $request->despacho;
           $reporte->oficina = strtoupper($request->oficina);
           $reporte->tipo_equipo =strtoupper($request->tipo_equipo) ;
           $reporte->nombre_equipo = strtoupper($request->nombre_equipo);
           $reporte->ip = $request->ip;
           $reporte->usuario_creador =  auth()->user()->name." ". auth()->user()->lastname;
           $reporte ->save();
           
            Session::flash('success','IP RESERVADA CON EXITO!');
            return redirect()->back();  
           
    }
    
    public function put_registro_ip(Request $request,$id){
           //dd($request->all());
        $reporte =  RegistroIp::findOrFail($id);
        if($request->despacho == "OTRO"){
           $this->validate($request, [
               'municipio'=>'required',
               'sede'=>'required',
                'despacho'=>'required',
                'oficina'=>'required|max:100',
                'tipo_equipo'=>'required',
                'nombre_equipo'=>'required|max:100',
                 'ip' => [
                'required',
                Rule::unique('registro_ips')->ignore($reporte->id) 
            ]
                ]);  
        }else{
            $this->validate($request, [
                'municipio'=>'required',
               'sede'=>'required',
                'despacho'=>'required',
                'tipo_equipo'=>'required',
                'nombre_equipo'=>'required|max:100',
                //'ip'=>'required|max:15',
                'ip' => [
                'required',
                Rule::unique('registro_ips')->ignore( $reporte->id ) 
            ]
                ]);
        }
        
        
                
         
          // $reporte->codigo_despacho = $key;
           $reporte->municipio = $request->municipio;
           $reporte->sede = $request->sede;
           $reporte->despacho = $request->despacho;
           $reporte->oficina = strtoupper($request->oficina);
           $reporte->tipo_equipo =strtoupper($request->tipo_equipo) ;
           $reporte->nombre_equipo = strtoupper($request->nombre_equipo);
           $reporte->ip = $request->ip;
           //$reporte->usuario_creador =  auth()->user()->name." ". auth()->user()->lastname;
           $reporte ->save();
          // dd($reporte);
           
            Session::flash('success','IP RESERVADA EDITADA CON EXITO!'); ///tecnico/soporte/listado/ips
            
            if( auth()->user()->rol == "1") {
            return Redirect::to('/administrador/listado/ips');
        }else{
             return Redirect::to('/tecnico/soporte/listado/ips');  
        }
    }
    
    
     public function eliminarIp(Request $request,$id){
         $mensaje =null;
        if($request->ajax())
         {
             $registro = RegistroIp::findOrFail($id);
             $registro = RegistroIp::destroy($id);
             
             //dd($registro);
             $mensaje = "IP ELIMINADA!";
             }else{
             $mensaje ="ERROR AL ELIMINAR IP";   
             }
            
             //$solicitudUsuarioSoporte->delete();
                  
             return response()->json($mensaje);
         }
         
    public function segmento(Request $request){
        
        
        $seccional = RegistroIp::Seccionales();
        $municipios=RegistroIp::municipios();
        $sedes=RegistroIp::sedes();
        
        $segmentos = Segmento::all();
        $Result_segmento = new Segmento();
        
        
        return view('soporte.Segmento',compact('segmentos','seccional','municipios','sedes','Result_segmento')); 
        
    }
    
   
    public function editar_segmento(Request $request,$id){
        
        $seccional = RegistroIp::Seccionales();
        $municipios=RegistroIp::municipios();
        $sedes=RegistroIp::sedes();
        
        $segmentos = Segmento::all();
        
        $Result_segmento =Segmento::findOrFail($id);
        
        
        return view('soporte.Segmento',compact('segmentos','seccional','municipios','sedes','Result_segmento')); 
        
    }
    
     
    //
    public function save_segmento(Request $request){
        
        //dd($request->all());
        
        if(!empty($request->id)){
           $segmento = Segmento::find($request->id);
           
            $segmento->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
            $segmento->save();
           Session::flash('success','SEGMENTO ACTUALIZADO  CON EXITO!');
        }else{
            $segmento = new Segmento();
            $segmento->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
            $segmento->save(); 
           Session::flash('success','SEGMENTO ALMACENADO CON EXITO!');
        }
        return redirect()->route('tecnico.soporte.editar.segmento.ip');
   
        
    }
    
    
    public function delete_segmento(Request $request,$id){
        //dd('segmento');
         $mensaje =null;
        if($request->ajax())
         {
             $registro = Segmento::findOrFail($id);
             $registro = Segmento::destroy($id);
             
             //dd($registro);
             $mensaje = "SEGMENTO ELIMINADO!";
             }else{
             $mensaje ="ERROR AL ELIMINAR SEGMENTO";   
             }
            
             //$solicitudUsuarioSoporte->delete();
                  
             return response()->json($mensaje); 
    }
        
    
}
