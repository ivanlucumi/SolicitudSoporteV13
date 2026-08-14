<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsistenciaTecnico;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Carbon;

class AsistenciaTecnicoController extends Controller
{
    
      public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
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
        //dd(Carbon::today());
        
        $fechaMenos30Dias = Carbon::now()->subDays(8);
        $fechaMenos30Dias->toDateString();
        $ip = $request->ip();
        //dd($fechaMenos30Dias);
        $mi_asistencia=AsistenciaTecnico::where('user_id', auth()->id())
        ->where('fecha_registro','>=',$fechaMenos30Dias)
        ->get();
        //dd($mi_asistencia);//echo Carbon::now()->toDateString(); // Devuelve 'YYYY-MM-DD'

        $sedesTecnicos = AsistenciaTecnico::sedes();
        //dd($mi_asistencia);
        return view('soporte.Asistencia',compact('sedesTecnicos','mi_asistencia','ip'));
    }
    
    public function indexListado(Request $request){
        
        if( auth()->user()->email == "coordinador_av3@cendoj.ramajudicial.gov.co"){
            $listado = AsistenciaTecnico::whereIn('user_id',[134,1959217])
            ->orderBy('fecha_registro','DESC')
            ->get();
           // dd($listado);
        }else{
            $listado = AsistenciaTecnico::all();
        }
       
       return view('soporte.ListadoAsistencia',compact('listado'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        //dd($request->longitude,$request->latitude);
        $today = Carbon::today();
        
         $sede = $request->input('sede');
        if ($sede == 'otro') {
            $otherSede = $request->input('other_sede');
            $sede = $otherSede;
        }
        
        $asistencia = AsistenciaTecnico::firstOrCreate(
            ['user_id' =>  auth()->id(), 'fecha_registro' => $today],
            ['fecha_registro' => Carbon::today(),
             'sede' => strtoupper($sede),
             'hora_ingreso' => Carbon::now()->toTimeString(),
             'ip_ingreso' => $request->ip(),
             'observaciones' =>strtoupper($request->observaciones),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            ]
        );
        
        if (!$asistencia->wasRecentlyCreated) {
            return back()->withErrors(['msg' => 'Ya has registrado la entrada hoy.']);
        }
         DB::commit();
         
         return back()->with('success', 'Entrada registrada exitosamente.');
         
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }

        

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSalida(Request $request)
    {
        $today = Carbon::today();
        $asistencia = AsistenciaTecnico::where('user_id',  auth()->id())->where('fecha_registro', $today)->first();

        if (!$asistencia) {
            return back()->withErrors(['msg' => 'No has registrado la entrada hoy.']);
        }

        if ($asistencia->hora_salida) {
            return back()->withErrors(['msg' => 'Ya has registrado la salida hoy.']);
        }

        $asistencia->update(['hora_salida' => Carbon::now(),'ip_salida' => $request->ip()]);

        return back()->with('success', 'Salida registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AsistenciaTecnico  $asistenciaTecnico
     * @return \Illuminate\Http\Response
     */
    public function show(AsistenciaTecnico $asistenciaTecnico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AsistenciaTecnico  $asistenciaTecnico
     * @return \Illuminate\Http\Response
     */
    public function edit(AsistenciaTecnico $asistenciaTecnico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AsistenciaTecnico  $asistenciaTecnico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsistenciaTecnico $asistenciaTecnico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AsistenciaTecnico  $asistenciaTecnico
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsistenciaTecnico $asistenciaTecnico)
    {
        //
    }
}
