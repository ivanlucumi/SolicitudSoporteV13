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


use App\Models\Portatil;

use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\PortatilInstalacion;

class PortatilesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Uticom');
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
        $soporte = New PortatilInstalacion();
        return view('Comodato.Portatil.Index',compact('soporte','ciudades','despachos'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
        
         
        
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
            'despacho' => 'required|max:12',
            'placa_equipo' => 'required|max:25',
            'serial_equipo' => 'required|max:25|unique:portatiles_instalacion',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:30',
            'placa_teclado'=> 'required|max:25',
            'serial_teclado'=> 'required|max:25',
            'placa_mouse'=> 'required|max:25',
            'serial_mouse'=> 'required|max:25',
            
            'ip'=>'required|max:15|unique:portatiles_instalacion',
            'descripcion_servicio' => 'required|max:200',
            'observaciones' => 'required|max:200',
            'firma' => 'required',
            ]);
            
        
        
        try{
        $despacho= Despacho::where('codigoDespacho',$request->despacho)->first();
        //dd($request->all(),$request->despacho,$despacho);
        
        $portatil =  Portatil::where('serial_equipo',$request->serial_equipo)
        ->where('estado','SIN ASIGNAR')
        ->first();
        
       
        
        if(empty($portatil)){
               Session::flash('error', 'No se puede asignar impresora!');
                return Redirect::back();
           }
        
         //dd($portatil);
        
        $reporte = new PortatilInstalacion();
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
				    	$reporte->serial_equipo =  strtoupper($request->serial_equipo);
				    	$reporte->marca =  strtoupper($request->marca);
				    	$reporte->modelo =  strtoupper($request->modelo);
				    	
				    	$reporte->placa_teclado =  strtoupper($request->placa_teclado);
				    	$reporte->serial_teclado =  strtoupper($request->serial_teclado);
				    	$reporte->placa_mouse =  strtoupper($request->placa_mouse);
				    	$reporte->serial_mouse =  strtoupper($request->serial_mouse);
				    	
				    	
             			$reporte->ip =  $request->ip;
				    	$reporte->descripcion_servicio =  ucwords($request->descripcion_servicio);
             			$reporte->observaciones =  ucwords($request->observaciones);
				    	$reporte->firma_funcionario =  $request->firma;
				    	$reporte->id_user =  auth()->user()->id;
                        $reporte ->save();
                        
                        $reporte ->firma_tecnico =  auth()->user()->firma;
                        $reporte ->cedula_tecnico =  auth()->user()->cedula;
                        
                        //dd($reporte ->firma_tecnico);
        
        
        
           if(!empty($portatil)){
            $portatil->estado="ASIGNADO";
        	$portatil->tecnico_id = auth()->user()->id;
            $portatil->instalacion_portatil_id=$reporte->id;
            $portatil ->save();
           }
         
         
         $data              =  json_decode(json_encode($reporte), true);               
        
        $pdf = Pdf::loadView('emails/soporte/PdfPortatil',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
          
        $nombrePdf =$reporte->serial_equipo."-".$despacho->nombreDespacho."-".".pdf";
        //return $pdf->download($nombrePdf);
        $correoDes=str_replace(" ", "", $despacho->correoD);
        $supervisor ='gmstdesajvalle3@cendoj.ramajudicial.gov.co';
        $correoTec='ut.pabonilla.27@outlook.com';
        $almacen ='almacali@cendoj.ramajudicial.gov.co';
        $asunto="ACTA DE INSTALACION PORTATIL";//." ".$reporte->serial."-".$reporte->marca."-".$reporte->modelo;
         Mail::send('emails/soporte/PortatilCorreo', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$correoTec,$asunto,$supervisor,$almacen) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                //$mail->to($correoDes);
                //$mail->cc($correoTec);
                $mail->cc($supervisor);
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
            return redirect()->route('tecnico.firma.portatiles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$caja)
    {
        /*$portatil=InventarioImpresoraComodato::where('serie',$serie)
        ->where('estado','SIN ASIGNAR')
        ->first();*/
        $portatil=Portatil::where('num_caja',$caja)
        ->where('estado','SIN ASIGNAR')
        ->first();
        
        //dd($portatil);
        if(empty($portatil)){
            $portatil=Portatil::where('num_caja',$caja)
            ->where('estado','ASIGNADO')
            ->first();
            
            if(!empty($portatil)){
                 $portatil = [
                    "placa_equipo" => "PORTATIL ASIGNADO",
                    "marca" => "PORTATIL ASIGNADO",
                    "modelo" => "PORTATIL ASIGNADO",
                    "serial_equipo" => "PORTATIL ASIGNADO",
                    'serial_teclado'=> "PORTATIL ASIGNADO",
                    'placa_teclado'=> "PORTATIL ASIGNADO",
                    'serial_mouse'=> "PORTATIL ASIGNADO",
                    'placa_mouse'=> "PORTATIL ASIGNADO",
                ];
                
            }else{
                $portatil = [
                    "placa_equipo" => "NO EXISTE, VALIDA NUM CAJA",
                    "marca" => "NO EXISTE, VALIDA NUM CAJA",
                    "modelo" => "NO EXISTE, VALIDA NUM CAJA",
                    "serial_equipo" => "NO EXISTE, VALIDA NUM CAJA",
                    'serial_teclado'=> "NO EXISTE, VALIDA NUM CAJA",
                    'placa_teclado'=> "NO EXISTE, VALIDA NUM CAJA",
                    'serial_mouse'=> "NO EXISTE, VALIDA NUM CAJA",
                    'placa_mouse'=> "NO EXISTE, VALIDA NUM CAJA",
                ]; 
            }
        }
        
        //dd($portatil);
        
        if($request->ajax())
        {
         
          return response()->json($portatil);
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
        $impresoras = PortatilInstalacion::orderBy('updated_at','DESC')->get();
       // dd($impresoras,$impresoras->Intalacion);
       //dd($impresoras);
       
       return view('administrador.Comodato.Index',compact('impresoras'));
    }
    
    public function listadoTec(Request $request)
    {
        $portatiles = Portatil::orderBy('updated_at','DESC')->get();
        //dd($portatiles->InstalacionP);
       //dd($impresoras);
       
       return view('soporte.ListadoPortatil',compact('portatiles'));
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
          $user = User::findOrFail($reporte->id_user);
          
          $reporte ->firma_tecnico = $user->firma;
          $reporte ->cedula_tecnico = $user->cedula;
          
         $data              =  json_decode(json_encode($reporte), true);  
        $pdf = Pdf::loadView('emails/soporte/CorreoComodato',compact('reporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'640']);
          
        $nombrePdf =$reporte->serial_equipo."-".$reporte->despacho."-".".pdf";
        
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
