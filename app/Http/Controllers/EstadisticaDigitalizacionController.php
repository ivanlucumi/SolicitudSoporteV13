<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\EstadisticaDigitalizacion;
use App\Models\RegistroDigitalizacion;


class EstadisticaDigitalizacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('Digitalizacion');
        
    }

    public function index(Request $requets){
        
        //dd($requets->all());
        
        $Reportado = EstadisticaDigitalizacion::SumaTotal();
        $pReportados= number_format($Reportado[0]->total, 0) ;
        
        
        
        $digitalizado = EstadisticaDigitalizacion::Digitalizados();
        $rDigitalizado = number_format($digitalizado[0]->total, 0);
        
        $Folios = EstadisticaDigitalizacion::foliosR();
        $FoliosR = number_format($Folios[0]->total, 0);
        
        $porcentaje = $digitalizado[0]->total/$Reportado[0]->total*100;
        
        $porcentaje =round($porcentaje, 2);
        
        
        $despachosRegistrados = EstadisticaDigitalizacion::distinct()->pluck('despacho','id_despacho');
        
        $especialidad =EstadisticaDigitalizacion::EspecialidadDespacho();

        $distrito = array('CALI'=>'CALI','BUGA'=>'BUGA');
        
        $validacionOnD=  EstadisticaDigitalizacion::validacionOd();
        $migracionOneD=  EstadisticaDigitalizacion::migracionOd();
        
        $capacitacionE=  EstadisticaDigitalizacion::capacitacionE();
        
        $puntoDig = EstadisticaDigitalizacion::distinct()->pluck('ciudad','ciudad');
       // dd($puntoDig);
        
        
        if(empty($requets->all()) ){
            $Estadisticas =EstadisticaDigitalizacion::paginate(20);
            $mostrar = 0;
        }else{
            $mostrar = 1;
        $Estadisticas = EstadisticaDigitalizacion::despacho($requets->despacho)
        ->distrito($requets->distrito)
        ->id_despacho($requets->id_despacho)
        ->especialidad($requets->especialidad)
        ->ciudad($requets->ciudad)
        ->orderBy('id_despacho','ASC')
        ->get();
        }
        
        //dd($Estadisticas);
        
        //dd($Estadisticas,$despachosRegistrados,$especialidad,$distrito,$pReportados,$rDigitalizado,$FoliosR,$porcentaje);
        
        return view('Estadistica.index',compact('Estadisticas','despachosRegistrados','especialidad','distrito','pReportados','rDigitalizado','FoliosR','porcentaje','mostrar','puntoDig','validacionOnD','migracionOneD','capacitacionE'));
        
        
    }
    
    public function actualizar(Request $requets,$id){
        
        //dd($id,$requets->all());
       
        $asignar = EstadisticaDigitalizacion::findOrFail($id);
        $asignar->especialidad = $requets->especialidad;
        $asignar->digitalizacion_fisico = $requets->digitalizacion_fisico;
        $asignar->procesos_digitalizados = $requets->procesos_digitalizados;
        $asignar->validacion_onedrive = $requets->validacion_onedrive;
        $asignar->fecha_validacion_onedrive = $requets->fecha_validacion_onedrive;
        $asignar->migracion_onedrive = $requets->migracion_onedrive;
        $asignar->fecha_migracion_onedrive = $requets->fecha_migracion_onedrive;
        $asignar->capacitacion = $requets->capacitacion;
        $asignar->fecha_capacitacion = $requets->fecha_capacitacion;
        $asignar->estrega_usuarios = $requets->estrega_usuarios;
        $asignar->fecha_estrega_usuarios = $requets->fecha_estrega_usuarios;
        $asignar->puesta_en_marcha = $requets->puesta_en_marcha;
        $asignar->save();
        
        Session::flash('success', 'Informacion Almacenada Correctamente!');
        return Redirect::back();
        
    }
}
