<?php

namespace App\Http\Controllers\RecursosHumanos;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;

use App\Models\Certificacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CertificacionController extends Controller
{
    public function index() {
        return view('RecursosHumanos.form');
    }

    public function enviar(Request $request)
    {
        // VALIDACIÓN
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'identificacion' => 'required|numeric',
            'eps'            => 'required|string',
            'pension'        => 'required|string',
            'correo'         => 'required|email'
        ]);
        
        DB::beginTransaction();
        try{ 
    
        // CONSULTAR EMPLEADO
        $empleado = Certificacion::where('identificacion', $request->identificacion)->first();
        
      /* if($request->correo =="olmogollo@hotmail.com"){
           dd($empleado);
       }*/
    
        if (!$empleado) {
            
            return back()->with([
                'swal_error' => 'La identificacion no se encuentra. Por favor comuníquese al correo para recibir asistencia',
                'correo_solicitud' => 'cldisajcali@cendoj.ramajudicial.gov.co',
            ]);
        }
    
        if ($empleado->eps !== $request->eps) {
            return back()->with([
                'swal_error' => 'La Eps no coincide. Por favor comuníquese al correo para recibir asistencia',
                'correo_solicitud' => 'cldisajcali@cendoj.ramajudicial.gov.co',
            ]);
        }
    
        if ($empleado->pension !== $request->pension) {
            return back()->with([
                'swal_error' => 'El fondo de pensiones no coincide. Por favor comuníquese al correo para recibir asistencia',
                'correo_solicitud' => 'cldisajcali@cendoj.ramajudicial.gov.co',
            ]);
        }
    
        // ARCHIVO EN DISCO RecursosHumanos
        $fileName = $empleado->identificacion. '.pdf';
    
        
        
        if (!Storage::disk('RecursosHumanos')->exists($fileName)) {
            return back()->with([
                'swal_error' => 'El documento no se encuentra generado. Por favor comuníquese al correo para recibir asistencia',
                'correo_solicitud' => 'cldisajcali@cendoj.ramajudicial.gov.co',
            ]);
        }
        
        
    
        // RUTA DEL ARCHIVO
        $rutaDocumento = Storage::disk('RecursosHumanos')->path($fileName);
    
        // URL FIRMADA 24 HORAS
        $url = URL::temporarySignedRoute(
            'certificacion.descargar',
            now()->addHours(24),
            ['cedula' => $empleado->identificacion]
        );
    
        // DATOS PARA LA VISTA DEL CORREO
        $data = [
            'empleado' =>  $empleado,
            'identificacion' => $empleado->identificacion,
            'url_consulta' => $url
        ];
        
        $data              =  json_decode(json_encode($data), true);
    
        // ASUNTO DEL CORREO
        $asunto = "Certificación laboral - " . $empleado->identificacion;
        
        
        // ENVÍO DE CORREO EXACTAMENTE COMO LO PEDISTE
        Mail::send('emails/Certificaciones/CorreoCertificaciones', $data, function ($mail) use ($rutaDocumento, $request, $asunto, $fileName) {
    
            $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
            $mail->to($request->correo);
            $mail->subject($asunto);
            $mail->priority(1); // alta prioridad
    
        });
        
        $empleado->certificacion = $empleado->certificacion."; ".$request->correo;
        $empleado->correo = $request->correo;
        $empleado->estado = true;
        $empleado->save();
        
        
        
        
        DB::commit();
    
        return back()->with([
            'success' => 'Correo enviado correctamente a:',
            'correo_enviado' => $request->correo
        ]);
        
        
        }catch (\Exception $e) {
            DB::rollback();
           return back()
            ->with('mensaje_error', 'Ocurrió un error inesperado. Por favor, contacte al área de soporte.')
            ->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()
            ->with('mensaje_error', 'Ocurrió un error inesperado. Por favor, contacte al área de soporte.')
            ->withInput();
        }
    }


    public function descargar($cedula)
    {
         $fileName = $cedula . '.pdf';

        if (!Storage::disk('RecursosHumanos')->exists($fileName)) {
            abort(404, 'El archivo no existe.');
        }

        return Storage::disk('RecursosHumanos')->download($fileName, "certificacion_$cedula.pdf");
    
    }
    
    public function adminEnviarForm(){
       return view('administrador.RecursosHumanos.Certificado'); 
    }
    
    //adminEnviar
    public function adminEnviar(Request $request)
    {
        
        // VALIDACIÓN
        $request->validate([
            'identificacion' => 'required|numeric',
            'correo'         => 'required|email'
        ]);
        
       
        DB::beginTransaction();
        try{  
    
        // CONSULTAR EMPLEADO
        $empleado = Certificacion::where('identificacion', $request->identificacion)->first();
        
        if (!$empleado) {
            
            return back()->with([
                'swal_error' => 'La identificacion no se encuentra. Por favor comuníquese al correo para recibir asistencia',
                'correo_solicitud' => 'cldisajcali@cendoj.ramajudicial.gov.co',
            ]);
        }
    
        
    
        // ARCHIVO EN DISCO RecursosHumanos
        $fileName = $empleado->identificacion. '.pdf';
    
        
        
        if (!Storage::disk('RecursosHumanos')->exists($fileName)) {
            return back()->with([
                'swal_error' => 'El documento no se encuentra generado. Por favor comuníquese al correo para recibir asistencia',
                'correo_solicitud' => 'cldisajcali@cendoj.ramajudicial.gov.co',
            ]);
        }
        
        
    
        // RUTA DEL ARCHIVO
        $rutaDocumento = Storage::disk('RecursosHumanos')->path($fileName);
    
        // URL FIRMADA 24 HORAS
        $url = URL::temporarySignedRoute(
            'certificacion.descargar',
            now()->addHours(24),
            ['cedula' => $empleado->identificacion]
        );
    
        // DATOS PARA LA VISTA DEL CORREO
        $data = [
            'empleado' =>  $empleado,
            'identificacion' => $empleado->identificacion,
            'url_consulta' => $url
        ];
        
        $data              =  json_decode(json_encode($data), true);
    
        // ASUNTO DEL CORREO
        $asunto = "Certificación laboral - " . $empleado->identificacion;
        
        
        // ENVÍO DE CORREO EXACTAMENTE COMO LO PEDISTE
        Mail::send('emails/Certificaciones/CorreoCertificaciones', $data, function ($mail) use ($rutaDocumento, $request, $asunto, $fileName) {
    
            $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
            $mail->to($request->correo);
            $mail->subject($asunto);
            $mail->priority(1); // alta prioridad
    
        });
        
        $empleado->certificacion = $empleado->certificacion."; ".$request->correo;
        $empleado->correo = $request->correo;
        $empleado->estado = true;
        $empleado->save();
        
        
        
        
        DB::commit();
    
        return back()->with([
            'success' => 'Correo enviado correctamente a:',
            'correo_enviado' => $request->correo
        ]);
        
        
        }catch (\Exception $e) {
            DB::rollback();
           return back()
            ->with('mensaje_error', 'Ocurrió un error inesperado. Por favor, contacte al área de soporte.')
            ->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()
            ->with('mensaje_error', 'Ocurrió un error inesperado. Por favor, contacte al área de soporte.')
            ->withInput();
        }
    }
}
