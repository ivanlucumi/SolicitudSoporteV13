<?php

namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use App\Models\ControlIngreso;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Despacho;
use App\Models\Persona;
use App\Models\ContratoActivo;
use App\Models\Parqueadero;
use App\Models\RestriccionLaboral;


use App\Models\EmpleadoExterno;
use App\Models\EmpleadoExternoIngreso;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RegistroIngreoEmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('parqueadero');
    }
    
    
       public function index()
    {
        
        $fechaA = Carbon::now()->toDateString();
        $ingresos = EmpleadoExternoIngreso::where('fecha_ingreso','=',$fechaA)
        ->get();
        
        return view('monitoreo.IngresoPersonal.Index',compact('ingresos'));
    }
    
    public function registrarIngreso(Request $request,$cedula){
       //dd($request->all());
       
      // dd($cedula);
      
      $cedula = intval($cedula);
      
      //dd($cedula);
       
       
        $fechaA = Carbon::now()->toDateString();
       
        $hora = Carbon::now()->totimeString();
       
        $ingreso = EmpleadoExterno::where('cedula',$cedula)
        ->first();
        
        $ingreso->registro =$request->registro;
        
        
        
        $registro = New EmpleadoExternoIngreso(); 
        $registro->emplead_externo_id = $ingreso->id;
        $registro->fecha_ingreso = $fechaA;
        $registro->registro =  $request->registro;
        $registro->hora_evento =  $hora;
        $registro->save();
            
        
           
                    
        if($request->ajax())
        {
            
           return $ingreso;
        }
            
        }
        
    public function listado(Request $request){
       
        
        $ingreso = EmpleadoExternoIngreso::latest()->first();
        //dd($ingresos);
        $ingresos = New EmpleadoExternoIngreso();
        $ingresos->cedula = $ingreso->Empleado->cedula;	
        $ingresos->nombre =$ingreso->Empleado->nombre	;
        $ingresos->cargo =$ingreso->Empleado->cargo	;
        $ingresos->empresa =$ingreso->Empleado->empresa;	
        $ingresos->fecha_ingreso =$ingreso->fecha_ingreso;
        $ingresos->registro =$ingreso->registro ." ".$ingreso->hora_evento;
       
      // dd($ingresos);
       
        if($request->ajax()){                    
            
            return $ingresos;
            
        }
                 exit();   
                
         
    }
      
        
    
    
}
