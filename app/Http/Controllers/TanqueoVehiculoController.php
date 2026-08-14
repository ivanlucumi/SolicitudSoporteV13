<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TanqueoVehiculo;


use App\Exports\TanqueoExport;


use App\Models\Vehiculo;
use App\Models\Conductor;
use App\Models\Empleado;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;



class TanqueoVehiculoController extends Controller
{
    
    public function __construct()
    {
        
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        //$this->middleware('fichas');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         
        
        
        $niveles =TanqueoVehiculo::nivel();
        $vehiculos = Vehiculo::where('propietario','RAMA JUDICIAL')->pluck('marca','id');
        $horaA = Carbon::now()->subDay(30); 
        $diaMenos30 = $horaA->toDateString();
        
        //dd($registros[0]->vehiculo);
        if( auth()->user()->rol == 6){
         $registros = TanqueoVehiculo::where('id_user', auth()->user()->id)->where('fecha_registro',Carbon::now()->toDateString())->get();
         return view('tanqueo.parqueadero.index',compact('registros','vehiculos','niveles'));   
        }else{
          $registros = TanqueoVehiculo::where('fecha_registro','>=',$diaMenos30)
          ->orderBy('created_at','DESC')
          ->get();  
          return view('tanqueo.administracion.index',compact('registros','vehiculos','niveles'));   
        }
        //return view('tanqueo.index',compact('registros','vehiculos','niveles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
         $this->validate($request, [
            'id_vehiculo'=> 'required',
            'conductor' => 'required|max:13',
            'nombre_conductor' => 'required|max:150',
            'nivel_tanque' => 'required',
            'kilometraje' => 'required|numeric',
            'imagen_base64' => 'required'
        ]);
        
        DB::beginTransaction();
        try{
        $vehiculo = Vehiculo::where('placa',$request->id_vehiculo)->first();
       // dd($request->all());
         if(strlen($request->imagen_base64) > 50){
        $image_service_str = substr($request->imagen_base64, strpos($request->imagen_base64, ",")+1);
         // Decodificar ese string y devolver los datos de la imagen  
         //dd($image_service_str);
         $image = base64_decode($image_service_str); 
        
        $nombre_imagen = $vehiculo->marca."-".$vehiculo->placa."-".Carbon::now().".png";
        
        $nombre_imagen =trim($nombre_imagen, " ");
        
        \Storage::disk('tanqueo')->put($nombre_imagen, $image, ['Content-Type' => 'image/png']); 
         }else{
         $nombre_imagen = $vehiculo->marca."-".$vehiculo->placa."-".Carbon::now().".jpg";
         \Storage::disk('tanqueo')->put($nombre_imagen, \File::get($request->file('imagen_base64')));
         }
        
       
       $tanqueo  = new TanqueoVehiculo(); 
       $tanqueo->id_user =  auth()->user()->id;
       $tanqueo->user = auth()->user()->name." ". auth()->user()->lastname;
       $tanqueo->id_vehiculo = $vehiculo->id;
       $tanqueo->conductor = $request->conductor;
       $tanqueo->nombre_conductor = $request->nombre_conductor;
       $tanqueo->nivel_tanque = $request->nivel_tanque;
       $tanqueo->fecha_registro = Carbon::now();
       $tanqueo->kilometraje = $request->kilometraje;
       $tanqueo->observaciones = $request->observaciones;
       $tanqueo->foto = $nombre_imagen;
       $tanqueo->url_foto = "www.disajcali.gov.co/Tanqueo/".$nombre_imagen;
       //dd($tanqueo);
       $tanqueo->save();
       
        DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
       
       Session::flash('warning', 'REGISTRO REALIZADO CON EXITO');  
            return redirect()->back();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TanqueoVehiculo  $tanqueoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
       // $vehiculo = Vehiculo::FindOrFail($id);
       
       $vehiculo = Vehiculo::where('placa',$id)->first();
       //dd($vehiculo);
       
       if(empty($vehiculo)){
           $vehiculo= null;
       }
        
        if($request->ajax()){
        
        return $vehiculo;

        }
    }
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TanqueoVehiculo  $tanqueoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(TanqueoVehiculo $tanqueoVehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TanqueoVehiculo  $tanqueoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TanqueoVehiculo $tanqueoVehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TanqueoVehiculo  $tanqueoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TanqueoVehiculo $tanqueoVehiculo)
    {
        //
    }
    
     public function consultaCedulaE(Request $request,$id){
         
        
        $consulta = Conductor::where('cedula',$id)->first();
        //dd($conductor);
        
        if(empty($consulta)){
          $conductor = Empleado::where('cedulaE',$id)->first(); 
          
        }else{
          $conductor = Conductor::where('cedula',$id)->first(); 
        }
        
        
        if($request->ajax())
        {
         
          return response()->json($conductor);
        }
        
        
    }
    
    public function Export(){
         $notificaciones = TanqueoVehiculo::join('vehiculos', 'vehiculos.id', '=', 'tanqueo_vehiculos.id_vehiculo')
             ->select(
            "fecha_registro",
            "vehiculos.marca as marca" ,
            "vehiculos.placa as placa" ,
            "conductor" ,
            "nombre_conductor",
            "kilometraje",
            "nivel_tanque",
            "observaciones",
            'url_foto'
            
        )
        ->get();
        //dd($notificaciones);

        return (new TanqueoExport($notificaciones))->download('REGISTRO_TANQUEO.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    
}
