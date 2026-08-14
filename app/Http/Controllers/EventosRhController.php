<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use App\Models\DiaFamilia;


class EventosRhController extends Controller
{
    public function Index(Request $request){
        
        return view('Eventos.Index');
        
    }
    
    public function Listado(Request $request,$cedula){
        
        
        $Listado =DiaFamilia::where('identificacion',$cedula)->first();
       // dd($cedula,$Listado);
        
        return view('Eventos.Resultado',compact('Listado'));
        
    }
    
     public function ListadoView(Request $request){
        
       
        $Listado =DiaFamilia::where('identificacion',$request->identificacion)->first();
       //dd($request->identificacion,$Listado);
       
        if(!empty($Listado->confirma)){
            
           return back()->with('error', "ASISTENCIA YA ESTA CONFIRMADA "); 
        }
        
        return view('Eventos.Resultado',compact('Listado'));
        
    }
    
    
    
    public function save(Request $request){
        
        //dd($request->all());
        //DB::beginTransaction();
        try{
        $Listado =DiaFamilia::where('identificacion',$request->identificacion)->first();
        
        
        if(!empty($Listado->confirma)){
            
            Session::flash('error', 'Respuesta almacenada con Exito!!');
           return back()->with('error', "ASISTENCIA YA ESTA CONFIRMADA "); 
        }
        
        $Listado->confirma=$request->confirma;
        $Listado->confirma_1=$request->confirma_1;
        $Listado->confirma_2=$request->confirma_2;
        $Listado->observaciones =$request->observaciones;
        $Listado->save();
        
        //DB::commit();
        
        Session::flash('success', 'Respuesta almacenada con Exito!!');
        return redirect()->route('dia.familia.index');
        
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
      
        
        
    }
    
    public function ListadoAsistencia(Request $request){
        $Listado =DiaFamilia::All();
    }
}
