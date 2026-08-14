<?php

namespace App\Http\Controllers\TodoEnUno;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


use App\Models\TodoUno;

use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\InventarioImpresoraComodato;

class TodoUnoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        $soporte = New TodoUno();
        return view('TodoUno.Index',compact('soporte','ciudades','despachos'));
    }
    public function store(Request $request)
    {
        dd($request->all());
        
        DB::beginTransaction();
        $request->validate([
            'cedula_funcionario' => 'required|max:15',
            'nombre_funcionario' => 'required|max:120',
            'descripcion_servicio' => 'required|max:200',
            'firma' => 'required',
            ]);
            
            
        try{
        $despacho= Despacho::where('codigoDespacho',$request->codigo_despacho)->first();
        //dd($request->all(),$request->despacho,$despacho);
        
        $reporte =  TodoUno::where('todo_en_uno',$request->todo_en_uno)
        ->where('cedula_funcionario',NULL)
        ->first();
        
        if(empty($reporte)){
               Session::flash('error', 'TODO EN UNO YA ESTA ASIGNADO!');
                return Redirect::back();
           }
        
       // dd($reporte);
        
        //$reporte = new TodoUno();
                        $reporte->cedula_funcionario =  $request->cedula_funcionario;
             			$reporte->nombre_funcionario =  $request->nombre_funcionario;
				    	$reporte->descripcion_servicio =  $request->descripcion_servicio;
				    	$reporte->firma_funcionario =  $request->firma;
				    	$reporte->descripcion_servicio =  $request->descripcion_servicio;
                        $reporte ->save();
        
        
        
        /*   
         
         
        $data              =  json_decode(json_encode($reporte), true);               
        
        $pdf = Pdf::loadView('emails/soporte/CorreoComodato',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
          
        $nombrePdf =$reporte->todo_en_uno."-".$despacho->nombreDespacho."-".".pdf";
        //return $pdf->download($nombrePdf);
        //$correoDes=str_replace(" ", "", $despacho->correoD);
        $supervisor ='gmstdesajvalle3@cendoj.ramajudicial.gov.co';
        
        $asunto="ACTA DE INSTALACION TODO EN UNO";//." ".$reporte->serial."-".$reporte->marca."-".$reporte->modelo;
         Mail::send('emails/soporte/ComprobanteComodato', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$asunto,$supervisor) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($supervisor);
                //$mail->cc($correoTec);
                //$mail->cc($supervisor);
                //$mail->cc($almacen);
                $mail->subject($asunto);
                $mail->attachData($pdf->output(), $nombrePdf);
            });
         
         */
        
          DB::commit();
          //dd($reporte);
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        
            Session::flash('success', 'Entrega de Impresora Registrada con Exito!');
            return redirect()->route('tecnico.firma.comodato.impresora');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function consulta(Request $request,$placa)
    {
        $todoenuno =  TodoUno::where('todo_en_uno',$placa)->first();
        
        
        if($request->ajax())
        {
         
          return response()->json($todoenuno);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function listado(Request $request)
    {
        $impresoras = InventarioImpresoraComodato::orderBy('updated_at','DESC')->get();
       // dd($impresoras,$impresoras->Intalacion);
       //dd($impresoras);
       
       return view('administrador.Comodato.Index',compact('impresoras'));
    }
    
    public function listadoTec(Request $request)
    {
        $impresoras = InventarioImpresoraComodato::orderBy('updated_at','DESC')->get();
       // dd($impresoras,$impresoras->Intalacion);
       //dd($impresoras);
       
       return view('soporte.impresoras',compact('impresoras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function descargarPdf(Request $request)
    {
       $reportes = ComodatoImpresora::all();
       
       //dd($reportes);
       
       foreach($reportes as $reporte){
         $data              =  json_decode(json_encode($reporte), true);  
        $pdf = Pdf::loadView('emails/soporte/CorreoComodato',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
          
        $nombrePdf =$reporte->serial."-".$reporte->despacho."-".".pdf";
        
        \Storage::disk('backups')->put($nombrePdf,$pdf->output() );
        
        /*return $pdf->download($nombrePdf);
        $correoTec='ut.pabonilla.27@outlook.com';
        $asunto="ACTA DE INSTALACION CONTRATO DE COMODATO DE IMPRESORAS 001 DE 2023";//." ".$reporte->serial."-".$reporte->marca."-".$reporte->modelo;
         Mail::send('emails/soporte/ComprobanteComodato', $data, function ($mail) use ($pdf,$nombrePdf,$correoTec,$asunto) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($correoTec);
                $mail->subject($asunto);
                $mail->attachData($pdf->output(), $nombrePdf);
            });*/
         
        
        
       }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
