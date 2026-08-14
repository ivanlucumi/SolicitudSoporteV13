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

class FichaPublicoController extends Controller
{
    //
    
    
    public function index(){
        //dd($request->ip());
        $tipoAudiencia = FichaPreliminar::tipoAudiencia();
        return view('externo.ArchivoPublico.Formulario',compact('tipoAudiencia'));
        
    }
    
    
     public function Ficha_Preliminar_store(Request $request){
         //dd($request->all());
        
         /*$this->validate($request, [
                'g-recaptcha-response' => 'required|captcha',
                'procesado'=>'required|max:200',
                'tipo_solicitud'=>'required|max:50',
                'telefono'=>'required|max:13',
                'numero_radicado_proceso'=>'required|numeric|digits:23',
                //'anexos'=>'required|max:4000',
                'email_notificacion'=>'required|max:120',
                'quien_solicita'=>'required|max:100',
                'cedula_quien_solicita'=>'required|max:13',
            ]);
            */
            
         
        $extension= pathinfo($_FILES["anexos"]['name'], PATHINFO_EXTENSION);
        
        $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extension, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["demanda"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('success', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
            
        $nombredoc = $_FILES["anexos"]["name"];
        
        $separador = ".";
        $separada1 = explode($separador, $nombredoc);
        
        $documento =$request->numero_radicado_proceso.strtoupper($request->tipo_solicitud).Carbon::now()->toDateTimeString().".pdf"/*".".$separada1[1]*/;
            
        //validacion de tama単o de Documentos
        $tamDemanda= intval($_FILES["anexos"]["size"])/1024000;    
        
        //dd($tamDemanda);
            
       
            //dd($request->all());
            
         
        
        
        if($tamDemanda > 0 || $tamDemanda < 15){
            //dd('hola1');
           \Storage::disk('fichapreliminar')->put($documento, \File::get($request->file('anexos')));
           
        }else{
          Session::flash('success', 'Verifique el tamaño del documento!');
            return Redirect::back();  
        }
        
           //codigo de seguimiento
            $key = '';
            $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ+#&/*.?¡=)(/%$[{]}~abcdefghijklmnopqrstuvwxyz';
            $max     = strlen($pattern)-1;
       
            for ($p = 0; $p < 12; $p++)
            {
                $key .= ($p%2) ? $pattern[mt_rand(27, 49)] : $pattern[mt_rand(0, 28)];
            }
         

                
           $reporte = new FichaPreliminar();
           $reporte->numero_radicado_proceso =  $request->numero_radicado_proceso;
           $reporte->procesado = strtoupper($request->procesado);
           $reporte->tipo_solicitud = strtoupper($request->tipo_solicitud);
           //$reporte->url_expediente = $request->url_expediente;
           $reporte->anexos = $documento;
           $reporte->email_notificacion = $request->email_notificacion;
           $reporte->telefono = $request->telefono;
           $reporte->despacho_remite = "Solicitud Externa ";
           $reporte->quien_solicita=$request->quien_solicita;
           $reporte->cedula_quien_solicita=$request->cedula_quien_solicita;
           $reporte->fecha_solicitud = Carbon::now()->toDateTimeString();
           $reporte->ip = $request->ip();
           $reporte->seguimiento=$key;
           $reporte ->save();
         DB::beginTransaction();
         try{ 
         
           
              $data              =  json_decode(json_encode($reporte), true);

        $asunto = "Solicitud Audiencia Preliminar  ".$key;
        
        //dd($reporte);
        //$correoDes = auth()->user()->email;
        $correoNotificacion = $request->email_notificacion;
        
        /*Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($correoNotificacion);
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            });  
            
        if($reporte->tipo_solicitud =='AUDIENCIAS GARANTIAS ACTOS URGENTES'){
           Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('reprograspacali@cendoj.ramajudicial.gov.co');
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            });   
        }
        elseif($reporte->tipo_solicitud =='AUDIENCIAS GARANTIAS PROGRAMADAS'){
             Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('saspacali@cendoj.ramajudicial.gov.co');
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            }); 
        }else{
             Mail::send('emails/fichas/CorreoFicha', $data, function ($mail) use ($documento,$asunto,$correoNotificacion) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('auxrecospa02cali@cendoj.ramajudicial.gov.co');
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->attach("/home/disajcal/public_html/fichaPreliminar/" . $documento,[  'mime' => "application/octet-stream", ]);
            }); 
        }*/
         
           
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }

           
         
            
        Session::flash('success','Solicitud Realizada Con Exito!!');
        return redirect()->back(); 
            
        
        
    }
  
   
}
