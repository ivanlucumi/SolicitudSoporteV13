<?php

namespace App\Http\Controllers\Comodato;


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


use App\Models\ComodatoImpresora;

use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\InventarioImpresoraComodato;

class ComodatoImpresoraController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('Uticom');
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
        
        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $soporte = New ComodatoImpresora();
        $tipoInstalacion = ComodatoImpresora::TipoInstalacion();
        return view('Comodato.Index',compact('soporte','ciudades','despachos','tipoInstalacion'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'fecha_instalacion' => 'required|date',
            'numero_cedula' => 'required|max:11',
            'nombre_contacto' => 'required|max:200',
            'seccional' => 'required|max:50',
            'ciudad' => 'required|max:80',
            'direccion' => 'required|max:120',
            'telefono' => 'required|max:30',
            'email' => 'required|max:180',
            'despacho' => 'required|max:200',
            //'placa_equipo' => 'required|max:80',
            'serial' => 'required|max:100|unique:instalacion_impresoras_comodato',
            'marca' => 'required|max:100',
            'modelo' => 'required|max:80',
            'tipo_instalacion' => 'required|max:100',
            //'ip'=>'required|max:15|unique:instalacion_impresoras_comodato',
            'descripcion_servicio' => 'required',
            'observaciones' => 'required',
            'firma' => 'required',
            ]);
            
            if($request->tipo_instalacion == "Red"){
                 $request->validate([
                        'ip'=>'required|max:15|unique:instalacion_impresoras_comodato'
            ]);
            }
        
        try{
        $despacho= Despacho::where('codigoDespacho',$request->despacho)->first();
        //dd($request->all(),$request->despacho,$despacho);
        
        $impresora =  InventarioImpresoraComodato::where('serie',$request->serial)
        ->where('estado','SIN ASIGNAR')
        ->first();
        
        if(empty($impresora)){
               Session::flash('error', 'No se puede asignar impresora!');
                return Redirect::back();
           }
        
        //dd($request->despacho,$despacho->nombreDespacho,$despacho->codigoDespacho);
        
        $reporte = new ComodatoImpresora();
                        $reporte->id_despacho =  $request->despacho;
             			$reporte->fecha_instalacion =  $request->fecha_instalacion;
				    	$reporte->numero_cedula =  $request->numero_cedula;
				    	$reporte->nombre_contacto =  ucwords($request->nombre_contacto);
             			$reporte->seccional =  ucwords($request->seccional);
				    	$reporte->ciudad =  ucwords($request->ciudad);
             			$reporte->direccion =  ucwords($request->direccion);
				    	$reporte->telefono =  $request->telefono;
             			$reporte->email =  $request->email;
				    	$reporte->despacho =  ucwords($despacho->nombreDespacho);
             			$reporte->placa_equipo =  strtoupper($request->placa_equipo);
				    	$reporte->serial =  strtoupper($request->serial);
				    	$reporte->marca =  strtoupper($request->marca);
				    	$reporte->modelo =  strtoupper($request->modelo);
             			$reporte->tipo_instalacion =  $request->tipo_instalacion;
             			$reporte->ip =  $request->ip;
				    	$reporte->descripcion_servicio =  ucwords($request->descripcion_servicio);
             			$reporte->observaciones =  ucwords($request->observaciones);
				    	$reporte->firma_funcionario =  $request->firma;
				    	$reporte->id_user =  auth()->user()->id;
                        $reporte ->save();
        
        
        
           if(!empty($impresora)){
            $impresora->estado="ASIGNADA";
        	$impresora->tecnico_id = auth()->user()->id;
            $impresora->instalacion_comodato_id=$reporte->id;
            $impresora ->save();
           }
         
         
         $data              =  json_decode(json_encode($reporte), true);               
        
        $pdf = Pdf::loadView('emails/soporte/CorreoComodato',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
          
        $nombrePdf =$reporte->serial."-".$despacho->nombreDespacho."-".".pdf";
        //return $pdf->download($nombrePdf);
        $correoDes=str_replace(" ", "", $despacho->correoD);
        $supervisor ='gmstdesajvalle@cendoj.ramajudicial.gov.co';
        $correoTec='ut.pabonilla.27@outlook.com';
        $almacen ='almacali@cendoj.ramajudicial.gov.co';
        $asunto="ACTA DE INSTALACION CONTRATO DE COMODATO DE IMPRESORAS 001 DE 2023";//." ".$reporte->serial."-".$reporte->marca."-".$reporte->modelo;
         Mail::send('emails/soporte/ComprobanteComodato', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$correoTec,$asunto,$supervisor,$almacen) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                //$mail->to($correoDes);
                $mail->cc($correoTec);
                //$mail->cc($supervisor);
                //$mail->cc($almacen);
                $mail->subject($asunto);
                $mail->attachData($pdf->output(), $nombrePdf);
            });
         
         
        
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
    public function show(Request $request,$caja)
    {
        /*$impresora=InventarioImpresoraComodato::where('serie',$serie)
        ->where('estado','SIN ASIGNAR')
        ->first();*/
        $impresora=InventarioImpresoraComodato::where('num_caja',$caja)
        ->where('estado','SIN ASIGNAR')
        ->first();
        
        //dd($impresora);
        if(empty($impresora)){
            $impresora=InventarioImpresoraComodato::where('num_caja',$caja)
            ->where('estado','ASIGNADA')
            ->first();
            
            if(!empty($impresora)){
                 $impresora = [
                    "marca" => "IMPRESORA ASIGNADA",
                    "modelo" => "IMPRESORA ASIGNADA",
                    "serie" => "IMPRESORA ASIGNADA",
                ];
                
            }else{
                $impresora = [
                    "marca" => "NO EXISTE, VALIDA NUM CAJA",
                    "modelo" => "NO EXISTE, VALIDA NUM CAJA",
                    "serie" => "NO EXISTE, VALIDA NUM CAJA",
                ]; 
            }
        }
        
        
        
        if($request->ajax())
        {
         
          return response()->json($impresora);
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
       //$reportes = ComodatoImpresora::WHERE('fecha_instalacion','>', '2024-02-17')->get();
        //$reportes = ComodatoImpresora::WHERE('id','>', '540')->get();
         $reportes = ComodatoImpresora::find(651);
        //$reportes = ComodatoImpresora::ALL();
       
      // dd($reportes);
       
       foreach($reportes as $reporte){
         $impresora =InventarioImpresoraComodato::where('instalacion_comodato_id',$reporte->id)->first();
         //dd($impresora,$reporte->id);
         $data              =  json_decode(json_encode($reporte), true);  
        $pdf = Pdf::loadView('emails/soporte/CorreoComodato',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'620']);
          
        $nombrePdf =$impresora->num_caja." - ".$reporte->serial."-".$reporte->despacho."-".".pdf";
        
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
