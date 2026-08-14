<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;   // ✅ v3.x — antes era: use Barryvdh\DomPDF\Facade;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SoporteUsuario;
use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\Inventario;
use App\Models\Siniestro;

use App\Models\User;

use App\Models\Empleado;

class FirmaExternaController extends Controller
{
    //
    public function __construct(){
         //$this->middleware('auth');
        // $this->middleware('Reparto');

     }

   
    
    public function PendienteFirma(Request $request,$id,$numcaso,$tecnico,$fecha){
        
       // dd($id,$numcaso,$tecnico,$fecha);
        
         $soporte = SoporteUsuario::where('id',$id)
         ->where('num_caso',$numcaso)
         ->where('tecnico_id',$tecnico)
         ->where('fecha_atencion',$fecha)
        ->where('estado_soporte','PENDIENTE_FIRMA')
         ->first(); 
        /// dd($soporte,$request->All(),$id,$numcaso,$tecnico,$fecha);
         if(empty($soporte)){
           Session::flash('success', 'Este caso ya esta Cerrado, no se puede firmar!');
            return Redirect::to('/');  
         }
        
        return view('externo.Formulario.FirmaExternaPublico',compact('soporte'));
        
    }
    
   
    public function FirmaPublico(Request $request, $id)
    {
        // 1) Validación de campos requeridos
        $request->validate([
            'disposicion'          => 'required',
            'conocimiento_tec'     => 'required',
            'tiempo_aten'          => 'required',
            'avance_caso'          => 'required',
            'observacion_cliente'  => 'required',
            'firma'                => 'required',
        ]);
     
        // 2) Verificar que el soporte existe y NO esté ya cerrado
        //    BUG ORIGINAL: buscaba con estado CERRADO y si lo encontraba redirigía,
        //    pero si NO existía el registro, findOrFail abajo podía traer cualquier id.
        $soporte = SoporteUsuario::findOrFail($id);
     
        if ($soporte->estado_soporte === 'CERRADO') {
            Session::flash('success', 'El documento ya está firmado.');
            return Redirect::to('/');
        }
     
        DB::beginTransaction();
        try {
            $despacho   = Despacho::where('codigoDespacho', $soporte->despacho_id)->firstOrFail();
            $firma_tec  = User::findOrFail($soporte->tecnico_id);
     
            // 3) Actualizar el soporte
            $soporte->fill($request->all());
            $soporte->estado_soporte  = 'CERRADO';
            $soporte->despacho        = $despacho->nombreDespacho;
            $soporte->firma           = $request->firma;           // firma cliente (base64)
            $soporte->firma_tecnico   = $firma_tec->firma;
            $soporte->ip_firma        = $request->ip();
            $soporte->save();
     
            // 4) Datos adicionales para el PDF
            $correoTecnico    = User::findOrFail($soporte->tecnico_id);
            $soporte->cedula_tec = $correoTecnico->cedula;
     
            // 5) Generar PDF
            //    ✅ CORRECCIÓN PRINCIPAL: Pdf:: en lugar de PDF::
            //    ✅ Se usa el facade nuevo: Barryvdh\DomPDF\Facade\Pdf
            $pdf = Pdf::loadView('emails/soporte/PdfOnsiteV3', compact('soporte'))
                      ->setPaper('legal', 'portrait')
                      ->setOptions([
                          
                          'isRemoteEnabled'      => true,
                          'dpi'                  => 150,   // ⚠️ 650 dpi es excesivo, ralentiza mucho
                      ]);
     
            // 6) Preparar datos del correo
            $nombrePdf = $soporte->num_caso
                       . '-' . $soporte->fecha_solicitud
                       . '-' . $soporte->ciudad
                       . '-' . $soporte->seccional
                       . '.pdf';
     
            $asunto    = $soporte->num_caso . '-' . $soporte->ciudad . '-' . $soporte->gestion;
            $correoTec = $firma_tec->email;
            $pdfOutput = $pdf->output(); // ✅ Capturar ANTES del closure para evitar problemas de scope
     
            // 7) Enviar correo con PDF adjunto
            Mail::send(
                'emails/soporte/comprobantePdf',
                json_decode(json_encode($soporte), true),
                function ($mail) use ($pdfOutput, $nombrePdf, $correoTec, $asunto) {
                    $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                    $mail->to($correoTec);
                    $mail->cc('teccoorseccali@cendoj.ramajudicial.gov.co');
                    $mail->subject($asunto);
                    $mail->attachData($pdfOutput, $nombrePdf, ['mime' => 'application/pdf']);
                }
            );
     
            DB::commit();
     
            Session::flash('success', 'Se remite PDF firmado correctamente.');
            return Redirect::to('/');
     
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Se presentó un error, informe a soporte: ' . $e->getMessage())
                ->withInput();
        }
    }
    

}
