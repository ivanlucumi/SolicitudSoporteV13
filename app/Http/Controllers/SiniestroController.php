<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;


use App\Models\Siniestro;

use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SiniestroController extends Controller
{
     public function __construct(){
         $this->middleware('auth');
        // $this->middleware('Reparto');

     }
     
     public function index(){
         
         
         
         if( auth()->user()->rol == 17 &&  auth()->user()->tipo_rol !="COORDINADOR"){
             $siniestros= Siniestro::where('informe_onsite',null)
             ->where('reporte_tecnico',null)
             ->where('tecnico_id', auth()->user()->id)
             ->get();
            return view('soporte.siniestros.Index',compact('siniestros')); 
         }
         if( auth()->user()->rol == 17 &&  auth()->user()->tipo_rol=="COORDINADOR"){
             //dd('entro');
             $siniestros= Siniestro::all();
            return view('soporte.siniestros.Index',compact('siniestros')); 
         }
         
         if( auth()->user()->rol == 1 &&  auth()->user()->tipo_rol=="ADMINISTRACION"){
             $siniestros= Siniestro::where('aprobado','!=',null)
             ->where('fecha_envio_admon','!=', null)->get();
            return view('administrador.siniestros.index',compact('siniestros')); 
         }
         if( auth()->user()->rol == 1 &&  auth()->user()->tipo_rol!="ADMINISTRACION"){
             $siniestros= Siniestro::all();
            return view('administrador.siniestros.index',compact('siniestros')); 
         }
        
       
    }
    
    public function edit(Request $request,$id){
         
         $siniestro= Siniestro::findOrFail($id);
         //dd($siniestro);
         
         if( auth()->user()->rol == 17){
            return view('soporte.siniestros.edit',compact('siniestro')); 
         }
         
         if( auth()->user()->rol == 1){
            return view('administrador.siniestros.edit',compact('siniestro'));
         }
        
        
    }
    
    public function update(Request $request,$id){
         
         $siniestro= Siniestro::findOrFail($id);
          //dd($request->ALL());
         
         if(!empty($request->file('informe_onsite'))){
        $file = $request->file('informe_onsite');
        //dd($file);
        $documento = $_FILES["informe_onsite"]["name"];
        $extension= pathinfo($_FILES["informe_onsite"]['name'], PATHINFO_EXTENSION);
        $nombreinforme_onsite ="/".$request['num_caso']."/informe_onsite_". $request['num_caso']."-".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('siniestros')->put($nombreinforme_onsite, \File::get($file));
        $siniestro->informe_onsite = $nombreinforme_onsite;
        }
        
        if(!empty($request->file('reporte_tecnico'))){
        $file = $request->file('reporte_tecnico');
        $documento = $_FILES["reporte_tecnico"]["name"];
        $extension= pathinfo($_FILES["reporte_tecnico"]['name'], PATHINFO_EXTENSION);
        $nombrereporte_tecnico ="/".$request['num_caso']."/reporte_tecnico_". $request['num_caso']."-".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('siniestros')->put($nombrereporte_tecnico, \File::get($file));
        $siniestro->reporte_tecnico = $nombrereporte_tecnico;
        }
        
        if(!empty($request->file('reporte_aseguradora'))){
        $file = $request->file('reporte_aseguradora');
        $documento = $_FILES["reporte_aseguradora"]["name"];
        $extension= pathinfo($_FILES["reporte_aseguradora"]['name'], PATHINFO_EXTENSION);
        $nombrereporte_aseguradora ="/".$request['num_caso']."/reporte_aseguradora_". $request['num_caso']."-".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('siniestros')->put($nombrereporte_aseguradora, \File::get($file));
        $siniestro->reporte_aseguradora = $nombrereporte_aseguradora;
        }
        
        if(!empty($request->file('liquidacion_siniestro'))){
        $file = $request->file('liquidacion_siniestro');
        $documento = $_FILES["liquidacion_siniestro"]["name"];
        $extension= pathinfo($_FILES["liquidacion_siniestro"]['name'], PATHINFO_EXTENSION);
        $nombreliquidacion_siniestro ="/".$request['num_caso']."/liquidacion_siniestro_". $request['num_caso']."-".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('siniestros')->put($nombreliquidacion_siniestro, \File::get($file));
        $siniestro->liquidacion_siniestro = $nombreliquidacion_siniestro;
        
        }
        
        if(!empty($request->file('ingreso_almacen'))){
        $file = $request->file('ingreso_almacen');
        $documento = $_FILES["ingreso_almacen"]["name"];
        $extension= pathinfo($_FILES["ingreso_almacen"]['name'], PATHINFO_EXTENSION);
        $nombreingreso_almacen ="/".$request['num_caso']."/ingreso_almacen_". $request['num_caso']."-".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('siniestros')->put($nombreingreso_almacen, \File::get($file));
        $siniestro->ingreso_almacen =$nombreingreso_almacen;
        }
        $siniestro->save();
       // dd($siniestro->save(),$siniestro);
        
        Session::flash('message', 'DOCUMENTOS SUBIDOS CON EXITO!');
        if( auth()->user()->rol == 17){
            return redirect()->route("tecnico.siniestro");
        }else{
            
        }
    }
    
    public function aprobar(Request $request,$id){
       $siniestro= Siniestro::findOrFail($id);
       
       if(empty($siniestro->informe_onsite) && empty($siniestro->reporte_tecnico)){
         Session::flash('message','No se puede aprobar sin Documentos de Soporte');
        return Redirect::back();  
       }
       
       $siniestro->fecha_envio_admon=Carbon::now()->toDateTimeString();
        $siniestro->aprobado = "Aprobo User id ". auth()->user()->id;
        $siniestro->save();
         $data              =  json_decode(json_encode($siniestro), true); 
         
         $mail1 = "gmstdesajvalle@cendoj.ramajudicial.gov.co";
         $mail2 = "gasdesajvalle@cendoj.ramajudicial.gov.co";
         $mail3 = "teccoorseccali@cendoj.ramajudicial.gov.co";
         $mail4 = "mfernandp@cendoj.ramajudicial.gov.co";
         
         $informe_onsite= $siniestro->informe_onsite;
         $reporte_tecnico = $siniestro->reporte_tecnico;
         
         
            
            try{
                        
                         Mail::send('emails.Email_Siniestro',$data, function ($message) use ($mail1,$mail2,$mail3,$mail4,$informe_onsite,$reporte_tecnico) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($mail2);
                                        $message->cc($mail1);
                                        $message->cc($mail3);
                                        $message->cc($mail4);
                                        $message->subject('REPORTE DE SINIESTRO APROBADO');
                                        
                                        //$message->attach("/home/disajcal/public_html/siniestros". $informe_onsite,[  'mime' => "application/octet-stream", ]);
                                        
                                        //$message->attach("/home/disajcal/public_html/siniestros". $reporte_tecnico,[  'mime' => "application/octet-stream", ]);
                                        
                                       
                         });
                        
                      
            }catch(Exception $e){
                          Session::flash('success', 'Error al enviar correo Electrónico !');
                          return Redirect::back();
                        }
        if( auth()->user()->rol == 17){
            return redirect()->route("tecnico.siniestro");
        }else{
           return redirect()->route("administrador.siniestro"); 
        }
       
    }
    
     public function denegar(Request $request,$id){
       $siniestro= Siniestro::findOrFail($id);
       
        $siniestro->aprobado = "Negado por User id ". auth()->user()->id;
        $siniestro->save();
        
        
        
        if( auth()->user()->rol == 17){
            return redirect()->route("tecnico.siniestro");
        }else{
           return redirect()->route("administrador.siniestro"); 
        }
       
    }
    
    public function Delete(Request $request,$id){
        
        //dd($siniestro= Siniestro::findOrFail($id));
       $siniestro= Siniestro::findOrFail($id);
        $siniestro->destroy($id);
        Session::flash('message','Siniestro Eliminado Correctamente');
        return Redirect::back();
       
    }
}
