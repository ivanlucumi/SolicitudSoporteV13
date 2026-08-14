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
use App\Models\DespachoEscalafon;

use Auth;


class DespachoEscalafonController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        //$this->middleware('Reparto');
        
    }
    
    public function Index(Request $request){
        
       // dd($escalafonDespacho,$escalafonDespacho->Carrera);
        $escalafonDespacho = DespachoEscalafon::where('codigo_despacho',/* auth()->user()->cedula*/'761093103001')->get();
        
        //dd($request->ALL(),$escalafonDespacho);
        
         return view('Escalafon.Despacho.Index',compact('escalafonDespacho'));
    }
    
    
    public function Incorporacion(Request $request){
        
        //dd(DespachoEscalafon::find($request->all()));
        //dd($request->all());
        $listaCargos= DespachoEscalafon::where('id',$request->id)->pluck('cargo','estado_nomina');
        
        //dd($listaCargos);
        
        $id=$request->id;
        
       return view('Escalafon.Despacho.Incorporacion',compact('listaCargos','id'));
    }
    
    public function saveIncorporacion(Request $request){
        
        dd($request->all());
        
        $listaCargos= DespachoEscalafon::where('codigo_despacho',/* auth()->user()->cedula*/'761093103001')->pluck('cargo','estado_nomina');
        
        //dd($listaCargos);
        
       return view('Escalafon.Despacho.Incorporacion',compact('listaCargos'));
    }
    
  
   
    
   
  
    
}
