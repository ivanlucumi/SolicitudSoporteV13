<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FichaPreliminar;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class FichaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }
    
    public function index(){
        //dd($request->ip());
        return view('usuario.noticias');
        
    }
      
    public function Ficha_Preliminar(Request $request){
        
        $tipoAudiencia = FichaPreliminar::tipoAudiencia();
        
        return view('usuario.reparto.Ficha_Preliminar',compact('tipoAudiencia'));
    }
    
    
     public function Conocimiento(Request $request){
         //dd($request->subcategoria_id);
         $ciudad = Despacho::where('codigoDespacho', auth()->user()->cedula)
         ->select('codCiudad')
         ->first();
         
         //dd($ciudad);
         
         $despachos = Despacho::where('ficha_remision',$request->subcategoria_id)
         ->select('nombreDespacho')
         ->where('codCiudad',$ciudad->codCiudad)->get();
         
         //dd($ciudad,$despachos,$request->subcategoria_id);
         
         
         if($request->ajax()){
            return response()->json($despachos);
        }
        
    }
    public function grupo_reparto(Request $request){
         //dd($request->gr_reparto);
         $grupo_reparto = FichaGrReparto::where('especialidad',$request->gr_reparto)
         ->get();
         
         if($request->ajax()){
            return response()->json($grupo_reparto);
        }
        
    }
    
     public function Ficha_Preliminar_store(Request $request){
         
        DB::beginTransaction();
        try{ 
            
            $this->validate($request, [
                'procesado'=>'required|max:200',
                'tipo_solicitud'=>'required',
                'numero_radicado_proceso'=>'required|numeric|digits:23',
                'anexos'=>'required|max:4000',
                
            ]);
            
            if(!empty($request->url_expediente)){
               $this->validate($request, [
                'url_expediente'=>'required|max:200',
                
            ]); 
            }
            
            //dd($request->all());
            
          $extension= pathinfo($_FILES["anexos"]['name'], PATHINFO_EXTENSION);
        
        $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extension, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["demanda"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
            
        $nombredoc = $_FILES["anexos"]["name"];
        
        $separador = ".";
        $separada1 = explode($separador, $nombredoc);
        
        $documento =$request->numero_radicado_proceso.strtoupper($request->tipo_solicitud).Carbon::now()->toDateTimeString().".pdf"/*$separada1[1]*/;
            
        //validacion de tamaño de Documentos
        $tamDemanda= intval($_FILES["anexos"]["size"]);
        
        if($tamDemanda > 0 || $tamDemanda < 3.9){
            //dd('hola1');
           \Storage::disk('fichapreliminar')->put($documento, \File::get($request->file('anexos')));
           
        }else{
          Session::flash('error', 'Verifique el tamaño del documento!');
            return Redirect::back();  
        }
          
          
        
           
        
                
           $reporte = new FichaPreliminar();
           $reporte->numero_radicado_proceso =  $request->numero_radicado_proceso;
           $reporte->procesado = strtoupper($request->procesado);
           $reporte->tipo_solicitud = strtoupper($request->tipo_solicitud);
           $reporte->url_expediente = $request->url_expediente;
           $reporte->anexos = $documento;
           $reporte->email_notificacion =  auth()->user()->email;
           $reporte->id_despacho_remite =  auth()->user()->id;
           $reporte->despacho_remite =  auth()->user()->name." ". auth()->user()->lastname ;
           $reporte->fecha_solicitud = Carbon::now();
           $reporte->ip = $request->ip();
           $reporte->cedula_quien_solicita =  auth()->user()->cedula;
           $reporte->quien_solicita =  auth()->user()->name." ". auth()->user()->lastname;
           $reporte ->save();
           
            /*$data              =  json_decode(json_encode($reporte), true);

            $asunto = "notificacion de cargar de solicitud";
            
            //dd($reporte);
            $correoDes = auth()->user()->email;
            $correoNotificacion = $request->email_notificacion;
            
            Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion,$correoDes) {
                    $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                    //$mail->to($correoNotificacion); 
                    $mail->to($correoDes); 
                    //$mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                    $mail->subject($asunto);
                    $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
                }); */ 
            
         DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
            
        Session::flash('success','Solicitud Realizada Con Exito!!');
        return redirect()->back(); 
            
        
        
    }
    public function historicoFicha(Request $request){
          if(!empty($request->all())){
           // dd($request->radicado);
            $fichas = FichaPreliminar::where('id_despacho_remite', auth()->user()->id)
            ->radicado($request->radicado)
            ->procesado($request->procesado)
            ->fecha($request->fecha_reparto)
            ->orderby('created_at','DESC')
            ->get();
            
            //dd($fichas);
            
        }else{
            $fichas = FichaPreliminar::where('id_despacho_remite', auth()->user()->id)
         ->orderBy('created_at','DESC')
         ->paginate(1000);
            
        }
         //dd($reporte);
         return view('usuario.reparto.HistoricoFichaPreliminar',compact('fichas'));
         
        
    }
    
    public function generarFicha(Request $request,$id){
         $reporte = FichaRemision::findOrFail($id);
         view()->share('reporte', $reporte);
         
         $pdf = Pdf::loadView('emails/soporte/fichaRemisionPdf',$data)->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'300']);
         return $pdf->download('archivo.pdf');
        
    }
    

   
}
