<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoArchivoJudicial;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class IngresoArchivoJudicialController extends Controller
{
    
     public function __construct(){
         $this->middleware('auth');
        // $this->middleware('Reparto');

     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $solicitudes = IngresoArchivoJudicial::where('despacho_id', auth()->user()->cedula)->get();
        
        return view('usuario.archivo.Index',compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function firmaDespacho(Request $request)
    {
       //dd($request->all());
       $solicitude = IngresoArchivoJudicial::findOrFail($request->id);
       //dd($solicitude,$request->id);
       $solicitude->firma_titular_despacho =$request->firma_titular_despacho;
       $solicitude->save();
         
       Session::flash('message', 'AUTORIZACION FINALIZADA!');
       return Redirect::back(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $this->validate($request, [
            'funcionario_titular' => 'required|max:100',
            'persona_que_autoriza'=> 'required|max:100',
            'cedula' => 'required|max:15',
            'eps' => 'required|max:30',
            'arl' => 'required|max:30',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'required|date',            
            'horario_permanencia' => 'required|max:30',
            'empleado_responsable' => 'required|max:100',
            'cargo' => 'required|max:100',
            'contacto_emergencia' => 'required|max:100',
            'telefono_emergencia' => 'required|max:30',            
            'actividad_realiza' => 'required'
        ]);
        
        /* if(!empty($request->file('doc_autorizacion'))){
        $file = $request->file('doc_autorizacion');
        //dd($file);
        $documento = $_FILES["doc_autorizacion"]["name"];
        $extension= pathinfo($_FILES["doc_autorizacion"]['name'], PATHINFO_EXTENSION);
        $nombredoc_autorizacion ="/".$request['despacho_id']."/AUTORIZACION_". $request['cedula'].Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('ArchivoJudicial')->put($nombredoc_autorizacion, \File::get($file));
        
        }else{
           Session::flash('success', 'Es necesario subir todos los formatos, doc_autorizacion!');
           return Redirect::back(); 
        }*/
        
        if(!empty($request->file('doc_responsabilidad'))){
        $file = $request->file('doc_responsabilidad');
        $documento = $_FILES["doc_responsabilidad"]["name"];
        $extension= pathinfo($_FILES["doc_responsabilidad"]['name'], PATHINFO_EXTENSION);
        $nombredoc_responsabilidad ="/".$request['despacho_id']."/EXONERACION_". $request['cedula'].Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('ArchivoJudicial')->put($nombredoc_responsabilidad, \File::get($file));
        
        }else{
           Session::flash('success', 'Es necesario subir todos los formatos, doc_responsabilidad!');
           return Redirect::back(); 
        }
        
         $ingreso_archivo = new IngresoArchivoJudicial();
         
         $ingreso_archivo->fecha_solicitud = Carbon::now()->toDateString();
         $ingreso_archivo->despacho_id =  auth()->user()->cedula;
         $ingreso_archivo->despacho =  auth()->user()->name." ". auth()->user()->lastname;
         
         $ingreso_archivo->funcionario_titular = $request->funcionario_titular;
         $ingreso_archivo->persona_que_autoriza = $request->persona_que_autoriza;
         $ingreso_archivo->cedula = $request->cedula;
         $ingreso_archivo->eps = $request->eps;
         $ingreso_archivo->arl = $request->arl;
         $ingreso_archivo->fecha_ingreso = $request->fecha_ingreso;
         $ingreso_archivo->fecha_salida = $request->fecha_salida;
         $ingreso_archivo->horario_permanencia = $request->horario_permanencia;
         $ingreso_archivo->empleado_responsable = $request->empleado_responsable;
         $ingreso_archivo->cargo = $request->cargo;
         $ingreso_archivo->contacto_emergencia = $request->contacto_emergencia;
         $ingreso_archivo->telefono_emergencia = $request->telefono_emergencia;
         $ingreso_archivo->actividad_realiza = $request->actividad_realiza;
         //$ingreso_archivo->doc_autorizacion = $nombredoc_autorizacion;
         $ingreso_archivo->doc_responsabilidad = $nombredoc_responsabilidad;
         
         $ingreso_archivo->save();
         
          Session::flash('message', 'SOLICITUD REALIZADA CON EXITO!');
            return redirect()->route("usuario.solicitud.ingreso.archivo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IngresoArchivoJudicial  $ingresoArchivoJudicial
     * @return \Illuminate\Http\Response
     */
   /* public function autorizarIngreso(Request $request)
    {
          
        $solicitudes = IngresoArchivoJudicial::where('ofjudicial_autoriza',"AUTORIZADO")
        ->where('disaj_autoriza',NULL)
        ->get();
        $autoriza =IngresoArchivoJudicial::estado();
        
        return view('usuario.archivo.Autorizar',compact('solicitudes','autoriza'));
    }*/
    
     public function autorizarIngreso(Request $request,$id)
    {
          
        $solicitud = IngresoArchivoJudicial::findOrFail($id);
        $solicitud->disaj_autoriza = $request->disaj_autoriza;
        
        Session::flash('success', 'REgistro Almacenado con Exito!');
         return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IngresoArchivoJudicial  $ingresoArchivoJudicial
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IngresoArchivoJudicial  $ingresoArchivoJudicial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IngresoArchivoJudicial  $ingresoArchivoJudicial
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request,$id)
    {
        //
    }
    public function descarga()
    {
        $soporte= IngresoArchivoJudicial::first();
        //dd($soporte);
         view()->share('soporte', $soporte);
         
         $pdf = Pdf::loadView('usuario/archivo/DocPdf1',compact('soporte'))->setPaper('A4', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'300']);
         //dd($pdf);
         return $pdf->download('comprobante.pdf');
        //$despacho= Despacho::where('codigoDespacho',$soporte->despacho_id)->first();
        //dd($despacho,$soporte);
        
        //return $pdf->download('comprobante.pdf'); teccoorseccali@cendoj.ramajudicial.gov.co
    }
}
