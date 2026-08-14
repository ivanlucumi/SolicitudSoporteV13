<?php

namespace App\Http\Controllers\Escalafon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Collection;


use App\Models\FichaRemision;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\EscalafonProvisionalidad;
use App\Models\EscalafonCarrera;
use App\Models\EscalafonDespacho;

use Auth;


class EscalafonController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        //$this->middleware('Reparto');
        
    }
    
    public function index(Request $request){
        
       // dd($escalafonDespacho,$escalafonDespacho->Carrera);
        $escalafonDespacho = EscalafonDespacho::paginate(10);
        
        //dd($request->ALL(),$escalafonDespacho->Carrera);
        
         return view('Escalafon.Index',compact('escalafonDespacho'));
    }
    
    
    public function show(Request $request,$id){
        
        $escalafonDespacho = EscalafonDespacho::findOrFail($id);
        //dd($escalafonDespacho);
        
         return view('Escalafon.Show',compact('escalafonDespacho'));
    }
    
    public function propiedadA(Request $request,$id){
         dd($request->ALL());
        $escalafonDespacho = EscalafonDespacho::findOrFail($id);
        //dd($escalafonDespacho);
        //dd($request);
        $escalafonDespacho = EscalafonCarrera::findOrFail($id);
        $escalafonDespacho->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $escalafonDespacho->save();
        Session::flash('message', "PROPIEDAD ACTUALIZADA CORRECTAMENTE");
         return Redirect::back();
    }
    
    public function provisionalidadA(Request $request,$id){
        dd($request->ALL());
        $escalafonDespacho = EscalafonProvisionalidad::findOrFail($id);
        $escalafonDespacho->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $escalafonDespacho->save();
        Session::flash('message', "PROPIEDAD ACTUALIZADA CORRECTAMENTE");
         return Redirect::back();
    }
    
    public function funcionarios(Request $request){
       
        $escalafonDespacho = EscalafonDespacho::where('codigo_despacho','761093103001')->get();
        
        $cargos = EscalafonDespacho::select('estado_nomina','cargo')->where('codigo_despacho','761093103001')->pluck('cargo','estado_nomina');
        $empleados =EscalafonDespacho::select('id')->where('codigo_despacho','761093103001')->get();
        
        
        
        $propiedad =EscalafonCarrera::whereIn('escalafon_despacho_id',$empleados->toArray())->get();
        $provisionalidad =EscalafonProvisionalidad::whereIn('escalafon_despacho_id',$empleados->toArray())->get();
        
        //dd($propiedad,$provisionalidad);
        
        return view('Escalafon.Funcionarios',compact('escalafonDespacho','cargos','provisionalidad','propiedad'));
    }
    
    public function cargos(Request $request){
        
       //dd($request->cedulaemp) ;
        $ocupado = EscalafonDespacho::where('estado_nomina',$request->cargo)
        ->where('codigo_despacho','761093103001'/*$request->despacho*/)->with('Carrera','Provisionalidad')->get();
        
        
        $estado = collect($ocupado);
        
        $empleadoC =EscalafonCarrera::where('cedula_propiedad',$request->cedulaemp)->first();
          
        
        if(empty($empleadoC)){
          
        $empleadoP = EscalafonProvisionalidad::where('cedula_provisionalidad',$request->cedulaemp)->first(); 
        
        if(empty($empleadoP)){
           $empleado= new Collection([
               'cedula' =>"VACIO",
               'funcionario' =>"VACIO",
                'tipo_nombramiento' =>"VACIO",
                'mensaje'=>"0"
               ]);
            
                }else{
                    
                    $empleado= new Collection(
                        [
                            'cedula'=>$empleadoP->cedula_provisionalidad,
                            'funcionario' =>$empleadoP->nombre_provisionalidad." ".$empleadoP->apellido_provisionalidad,
                            'tipo_nombramiento' =>"PROVISIONALIDAD",
                            'mensaje'=>"1"
                            
                            ]);
                }
        
        }else{
            $empleado= new Collection([
                'cedula' =>$empleadoC->cedula_propiedad,
                'funcionario' =>$empleadoC->nombres_propiedad." ".$empleadoC->apellido_propiedad,
                'tipo_nombramiento' =>$empleadoC->tipo_nombramiento,
                'mensaje'=>"1"
                ]);
            
        }
        
        $emplead = collect($empleado);
        //dd($empleado);
        
         if($request->ajax())
        {
         return response()->json([
         $estado,$emplead
        ]);
        }
        
    
    }
    
    public function SaveInscripcion(Request $request){
        
        dd($request->all());
        
    }
    
   
  
    
}
