<?php

namespace App\Http\Controllers\VigilanciaJudicial;

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
use App\Models\VigilanciaJudicial;

class RepartoVigilanciaController extends Controller
{
      public function __construct(){
        $this->middleware('auth');
        $this->middleware('vigilancia');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $repartos=VigilanciaJudicial::where('fecha_reparto',NULL)
        ->get();
        //
        return view('VigilanciaJudicial.Index',compact('repartos'));
    }
    
     public function Historico(Request $request)
    {
        
        $repartos=VigilanciaJudicial::where('fecha_reparto','!=',null)
        ->get();
        //
        return view('VigilanciaJudicial.Historico',compact('repartos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reparto(Request $request,$id)
    {
         $despachos = Despacho::where('nombreDespacho','LIKE','%SALA ADMINISTRATIVA%')->pluck('nombreDespacho','codigoDespacho');  
         DB::beginTransaction();
        try{ 
        $reparto= VigilanciaJudicial::FindOrFail($id);
        
        
        if($reparto->user_id == null || $reparto->user_id ==  auth()->user()->id){
         $reparto->user_id =  auth()->user()->id;
         $reparto->save();
         
         DB::commit();
         return view('VigilanciaJudicial.Reparto',compact('reparto','despachos'));
        }else{
            
            Session::flash('success', 'Esta Solicitud ya esta siendo Tramitada!');
            return redirect()->route('reparto.vigilancia.judicial.index');
        }
        
          //dd($reporte);
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        return redirect()->route('reparto.vigilancia.judicial.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AsignarReparto(Request $request,$id)
    {
        //dd($request->all());
        DB::beginTransaction();
        try{ 
        $this->validate($request, [
                 'reparto_asignado_a'=>'required' ,
                 'acta_reparto'=>'required',
                 'observaciones'=>'required'
                ]);
        
        
      $despacho= Despacho::where('codigoDespacho',$request->reparto_asignado_a)->first();
      //dd($despacho);
        
        $reparto= VigilanciaJudicial::FindOrFail($id);
        
        $tamDemanda = intval($_FILES["acta_reparto"]["size"]);
        
        $total= ($tamDemanda)/1000000;
        if ($total > 15) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tamaño Permitido, debe ser máximo 15 MB");
           return Redirect::back();
        }
        $extension= pathinfo($_FILES["acta_reparto"]['name'], PATHINFO_EXTENSION);
        $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extension, $formatos_permitidos) ) {
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
        }
        if($tamDemanda > 0){
            $file = $request->file('acta_reparto');
             // Nombre original sin extensión
            $nombreSinExtension = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            // Obtener extensión real del archivo (pdf, docx, etc.)
            $extension = $file->getClientOriginalExtension();
            // Armar nombre del archivo
            $nombre ='AR'. $reparto->seguimiento . $nombreSinExtension.".". $extension;
            
            \Storage::disk('VigilanciaJudicial')->put($nombre, \File::get($file));  
        }
        
        //dd($request->reparto_asignado_a,$despacho->nombreDespacho);
        
         $codigoDespacho=$request->reparto_asignado_a;
         //dd($codigoDespacho,$despacho->nombreDespacho);
        
        $reporte= VigilanciaJudicial::FindOrFail($id);
           $reporte->reparto_asignado_a = $despacho->nombreDespacho;
           $reporte->reparto_asignado_codigodespa = $codigoDespacho;
           $reporte->acta_reparto = $nombre;
           $reporte->fecha_reparto = Carbon::now();
           $reporte->funcionario_reparte=  auth()->user()->name." ". auth()->user()->lastname;
           $reporte->observaciones = $request->observaciones;
           $reporte ->save();
           
           
            $data              =  json_decode(json_encode($reporte), true); 
           
           $emailD=str_replace(" ", "", $despacho->correoD);
           $notificacion=str_replace(" ", "", $reporte->correo);
           $nombreDespacho=$despacho->nombreDespacho;
           $formato= $reporte->formato;
           $anexos=$reporte->anexos;
            Mail::send('emails.Vigilancia.RepartoVigilancia',$data, function ($message) use ($reporte,$nombre,$emailD,$notificacion,$nombreDespacho,$formato,$anexos) {
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
                                        $message->to($notificacion);
                                        //$message->cc($notificacion);
                                        $message->subject('El reparto le correspondió al Despacho: ' .$nombreDespacho);
                                        // $message->attach("/home/disajcal/public_html/VigilanciaJudicial/" . $nombre,[  'mime' => "application/octet-stream", ]);
                                        //$message->attach("/home/disajcal/public_html/VigilanciaJudicial/" . $formato,[  'mime' => "application/octet-stream", ]);
                                        //$message->attach("/home/disajcal/public_html/VigilanciaJudicial/" . $anexos,[  'mime' => "application/octet-stream", ]);
                         });
            Mail::send('emails.Vigilancia.RepartoVigilanciaDespacho',$data, function ($message) use ($reporte,$nombre,$emailD,$notificacion,$nombreDespacho,$formato,$anexos) {
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
                                        $message->to($emailD);
                                        //$message->cc($notificacion);
                                        $message->subject('El reparto le correspondió al Despacho: ' .$nombreDespacho);
                                        //$message->attach("/home/disajcal/public_html/VigilanciaJudicial/" . $nombre,[  'mime' => "application/octet-stream", ]);
                                        //$message->attach("/home/disajcal/public_html/VigilanciaJudicial/" . $formato,[  'mime' => "application/octet-stream", ]);
                                        //$message->attach("/home/disajcal/public_html/VigilanciaJudicial/" . $anexos,[  'mime' => "application/octet-stream", ]);
                         });
            
        DB::commit();
        
        
        Session::flash('success', 'Reparto Asignado y Notificado!');
        return redirect()->route('reparto.vigilancia.judicial.index');
          //dd($reporte);
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        
        
    }
    

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
