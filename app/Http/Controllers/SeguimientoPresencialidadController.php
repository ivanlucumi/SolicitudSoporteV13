<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;


use Auth;

use App\Models\Despacho;
use App\Models\Levantamiento;
use App\Models\Teletrabajo2024;

use App\Models\SeguimientoPresencialidad;

class SeguimientoPresencialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ip = $request->ip();
        $fecha=Carbon::Now();
        $fecha_act=$fecha->toDateString();
        $dia_semana=$fecha->dayOfWeek;
        dd($dia_semana);
        $despacho  =  Despacho::despachoPresencial( auth()->user()->circuito);
        return view('usuario.SegumientoPresencialidad.Index',compact('despacho','dia_semana','fecha_act','ip'));
    }
    public function indexDespacho(Request $request)
    {
         $ip = $request->ip();
        $fecha=Carbon::Now();
        $fecha_act=$fecha->toDateString();
        $dia_semana=$fecha->dayOfWeek;
        //dd($dia_semana);
        $despacho  =  Despacho::despachoPresencialD( auth()->user()->cedula);
        $asistencias= Despacho::asistencia( auth()->user()->cedula);
        //dd($despacho);
        return view('usuario.SegumientoPresencialidad.IndexDespacho',compact('despacho','dia_semana','fecha_act','asistencias','ip'));
    }

    public function store(Request $request)
    {
        //DB::beginTransaction();
        try{ 
            
            $this->validate($request, [
                'codigoDespacho_id'=>'required'
                
            ]);
        $fecha=Carbon::Now();
        
        $dia_semana=$fecha->dayOfWeek;
        
        if($dia_semana == 1){
            $dia="LUNES";
        }elseif($dia_semana == 2){
            $dia="MARTE";
        }elseif($dia_semana == 3){
            $dia="MIERCOLES";
        }elseif($dia_semana == 4){
            $dia="JUEVES";
        }elseif($dia_semana == 5){
            $dia="VIERNES";
        }else{
            Session::flash('success', 'NO SE PUEDE REGISTRAR ESE DIA');
            return Redirect::back(); 
        }
        
        $seguimiento = New SeguimientoPresencialidad();
        $seguimiento->codigoDespacho_id=$request->codigoDespacho_id;
        $seguimiento->asistencia=$dia;
        $seguimiento->jornada="OFICINA A";
        $seguimiento->fecha_registro_asistencia=$fecha->toDateString();
        $seguimiento->hora=$fecha->toTimeString();
        $seguimiento->codigo_despacho_r= auth()->user()->cedula;
        $seguimiento->despacho_r= auth()->user()->name." ". auth()->user()->lastname;
        $seguimiento->save();
        
         //DB::commit();
         
        Session::flash('success', 'ASISTENCIA REGISTRADA');
        return Redirect::back(); 
         
         
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
       
        
        
        //dd($seguimiento,$request->all(),$dia);
    }
    
    public function storeDespacho(Request $request)
    {
        //DB::beginTransaction();
        try{ 
            
            $this->validate($request, [
                'num_funcionarios'=>'required|numeric',
                
            ]);
        $fecha=Carbon::Now();
        
        $dia_semana=$fecha->dayOfWeek;
        
        //dd($request->all());
        
        if($dia_semana == 1){
            $dia="LUNES";
        }elseif($dia_semana == 2){
            $dia="MARTE";
        }elseif($dia_semana == 3){
            $dia="MIERCOLES";
        }elseif($dia_semana == 4){
            $dia="JUEVES";
        }elseif($dia_semana == 5){
            $dia="VIERNES";
        }else{
            Session::flash('success', 'NO SE PUEDE REGISTRAR ESE DIA');
            return Redirect::back(); 
        }
        
        $fecha_at=$fecha->format('Y/m/d');
        
        //dd($fecha_at);
        
        $seguimiento = New SeguimientoPresencialidad();
        $seguimiento->codigoDespacho_id= auth()->user()->cedula;
        $seguimiento->asistencia=$dia;
        $seguimiento->jornada="PROPIO";
        $seguimiento->fecha_registro_asistencia=$fecha_at;
        $seguimiento->hora=$fecha->toTimeString();
        $seguimiento->num_funcionarios=$request->num_funcionarios;
        $seguimiento->codigo_despacho_r= auth()->user()->cedula;
        $seguimiento->despacho_r= auth()->user()->name." ". auth()->user()->lastname;
        $seguimiento->save();
        
         //DB::commit();
         
         Session::flash('success', 'ASISTENCIA REGISTRADA');
        return Redirect::back(); 
        
        
        }catch (\Exception $e) {
            //DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            //DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
        
        //dd($seguimiento,$request->all(),$dia);
    }
    
    
    public function excel(Request $request){
        
        $reportar=SeguimientoPresencialidad::where('codigo_despacho_r', auth()->user()->cedula)->first();
        if(empty($reportar)){
            Session::flash('error', 'No se puede Descargar el Excel, no hay registros !');
            return Redirect::back();
        }
        
        $seguimiento =DB::select('select  despachos.codigoDespacho,
        despachos.nombreDespacho,
        despachos.districto,
        despachos.circuito,
        seguimiento_presencialidad.asistencia,
        seguimiento_presencialidad.fecha_registro_asistencia,
        seguimiento_presencialidad.hora,
        seguimiento_presencialidad.num_funcionarios
        FROM despachos,seguimiento_presencialidad 
        WHERE seguimiento_presencialidad.codigoDespacho_id = despachos.codigoDespacho and codigo_despacho_r='. auth()->user()->cedula);

        $seguimiento= collect($seguimiento);

        //dd($seguimiento);

        return (new PresencialidadExport($seguimiento))->download('SeguimientoPresencialidad.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

        public function excelTodo(Request $request){
            
        $reportar=SeguimientoPresencialidad::first();
        if(empty($reportar)){
            Session::flash('error', 'No se puede Descargar el Excel, no hay registros !');
            return Redirect::back();
        }

        
        $seguimiento =DB::select('select despachos.codigoDespacho,
        despachos.nombreDespacho,
        despachos.districto,
        despachos.circuito,
        seguimiento_presencialidad.asistencia,
        seguimiento_presencialidad.fecha_registro_asistencia,
        seguimiento_presencialidad.hora,
        seguimiento_presencialidad.num_funcionarios,
        seguimiento_presencialidad.num_funcionarios 
        FROM despachos,seguimiento_presencialidad 
        WHERE seguimiento_presencialidad.codigoDespacho_id = despachos.codigoDespacho;;
        ');

        $seguimiento= collect($seguimiento);

        //dd($seguimiento);

        return (new PresencialidadExport($seguimiento))->download('RegistroAtencionPublico.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    
    
     public function levantamiento(Request $request)
    {
        $Consulta=Levantamiento::where('despacho_id', auth()->user()->cedula)->first();
        $registro = 1;
        
        if(empty($Consulta)){
           $Consulta = New Levantamiento(); 
           $registro = null;
        }
        
        
        
        
        //dd($Consulta);
        return view('usuario.Levantamiento.Index',compact('Consulta','registro'));
    }
     public function levantamientoStore(Request $request)
    {
        //dd($request->all());
        
        $Consulta=Levantamiento::where('despacho_id', auth()->user()->cedula)->first();
        
        if(!empty($Consulta)){
            Session::flash('error', 'Ya se ha respondido esta encuesta anteriormente, por lo tanto, solo se permite una única participación.!');
            return Redirect::back();
        }
        
        //DB::beginTransaction();
        try{ 
            
             $this->validate($request, [
                'procesos_act_sin_sentencia'=>'required',
                'procesos_act_con_tramite_post'=>'required',
                'cantidas_exp_cumplimiento_pena'=>'required',
                'cantidad_onedrive_ver_uno'=>'required',
                "cantidad_onedrive_ver_dos" => 'required',
                "cantidad_bestdoc" => 'required',
                "cantidad_samai" => 'required',
                "cantidad_just_xxi_web" => 'required',
                //'ip'=>'required|max:15|unique:registro_ips',
                ]);
            
            
           $levantamiento = New Levantamiento();
            $levantamiento->despacho_id= auth()->user()->cedula;
            $levantamiento->despacho= auth()->user()->name." ". auth()->user()->lastname;
            $levantamiento->correo_despacho= auth()->user()->email;
            $levantamiento->procesos_act_sin_sentencia=$request->procesos_act_sin_sentencia;
            $levantamiento->procesos_act_con_tramite_post=$request->procesos_act_con_tramite_post;
            $levantamiento->cantidas_exp_cumplimiento_pena=$request->cantidas_exp_cumplimiento_pena;
            $levantamiento->cantidad_onedrive_ver_uno=$request->cantidad_onedrive_ver_uno;
            $levantamiento->cantidad_onedrive_ver_dos=$request->cantidad_onedrive_ver_dos;
            $levantamiento->cantidad_bestdoc=$request->cantidad_bestdoc;
            $levantamiento->cantidad_samai=$request->cantidad_samai;
            $levantamiento->cantidad_just_xxi_web=$request->cantidad_just_xxi_web;
            
            //dd($levantamiento);
            
            $levantamiento->save(); 
            
            
        //DB::commit();
        
        Session::flash('success', 'SE REGISTRARON LOS DATOS DE FORMA EXITOSA');
        return Redirect::back();
        
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
    }
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios\SeguimientoPresencialidadController  $seguimientoPresencialidadController
     * @return \Illuminate\Http\Response
     */
    public function teletrabajo(Request $request)
    {
        $ip = $request->ip();
        $fecha=Carbon::Now();
        $fecha_act=$fecha->toDateString();
        $dia_semana=$fecha->dayOfWeek;
        //dd($dia_semana);
        $dia =array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
        
        $user =  auth()->user()->cedula;// '761473333002'
        
        $dia_semana=$dia[$dia_semana-1];
        //dd($dia_semana1,$dia_semana);
        
        $despacho  =  Teletrabajo2024::where('codigo_despacho',$user)
        ->where('dias_teletrabajo',"like",'%'.$dia_semana.'%')
        ->where('vigencia_solicitud',2025)
        ->get();
        
        $despachousuario  =  Teletrabajo2024::where('codigo_despacho',$user)
        ->where('vigencia_solicitud',2025)
        ->get();
        
        //dd($despacho,$dia_semana);
        return view('usuario.SegumientoPresencialidad.Teletrabajo',compact('despacho','dia_semana','fecha_act','ip','despachousuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios\SeguimientoPresencialidadController  $seguimientoPresencialidadController
     * @return \Illuminate\Http\Response
     */
    public function saveTeletrabajo(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
                'codigoDespacho_id'=>'required',
                'dia'=>'required',
                'identificacion'=>'required',
                'nombre_servidor'=>'required',
                'cargo'=>'required',
                'teletrabajo'=>'required',
            ]);
            
         
            
            $this->validate($request, [
                'codigoDespacho_id'=>'required'
                
            ]);
        //DB::beginTransaction();
        try{ 
        
        $fecha=Carbon::Now();
        
        $dia_semana=$fecha->dayOfWeek;
        
        
        
        $seguimiento = New SeguimientoPresencialidad();
        $seguimiento->codigoDespacho_id=$request->codigoDespacho_id;
        $seguimiento->identificacion=$request->identificacion;
        $seguimiento->nombre_servidor=$request->nombre_servidor;
        $seguimiento->cargo=$request->cargo;
        $seguimiento->teletrabajo=$request->teletrabajo;
        $seguimiento->asistencia=$request->dia;
        $seguimiento->jornada="OFICINA A";
        $seguimiento->fecha_registro_asistencia=$fecha->toDateString();
        $seguimiento->hora=$fecha->toTimeString();
        $seguimiento->codigo_despacho_r= auth()->user()->cedula;
        $seguimiento->despacho_r= auth()->user()->name." ". auth()->user()->lastname;
        $seguimiento->novedad = $request->observaciones;
        $seguimiento->vigencia_solicitud = 2025;
        $seguimiento->save();
        
        
        // DB::commit();
         
         Session::flash('success', 'ASISTENCIA REGISTRADA');
        return Redirect::back(); 
        
        }catch (\Exception $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
           // DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
        
        
    }
    
    
   
    
    
    
    

    
}
