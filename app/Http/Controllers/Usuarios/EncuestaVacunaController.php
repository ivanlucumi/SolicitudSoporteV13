<?php

namespace App\Http\Controllers\Usuarios;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Digitalizacion;
use App\Models\RegistroDigitalizacion;
use App\Models\AgendamientoCapacitacion;
use App\Models\EncuestaVacuna;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

class EncuestaVacunaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }

    public function index(){
        
        $uVacunados = EncuestaVacuna::where('despacho_id', auth()->user()->cedula)->get();
        //dd($uVacunados);
        
        $vacunas = ['PFIZER' => 'PFIZER', 'SINOVAC' => 'SINOVAC', 'MODERNA' => 'MODERNA','ASTRAZENECA'=>'ASTRAZENECA','JANSSEN'=>'JANSSEN'];
        $encuesta = new EncuestaVacuna;
        $edita = false;
        
        return view('Formularios.encuestaVacunacion.index',compact('vacunas','encuesta','uVacunados','edita'));
        
        
    }
    
     public function store(Request $request)
    {
        //dd($request->all());
        
           $this->validate($request, [
                    'cedula'           => 'required|unique:encuesta_vacunacion|numeric',
                    'nombre' => 'required',
                    'apellido' => 'required'
                ]);  
        
        //dd($request->all());
        if($request->esquema=="NINGUNA"){
            $encuestaVacuna = new EncuestaVacuna();
            
           $encuestaVacuna->despacho =  auth()->user()->name;
           $encuestaVacuna->despacho_id =  auth()->user()->cedula;
           $encuestaVacuna->cedula = $request->cedula;
           $encuestaVacuna->nombre = $request->nombre;
           $encuestaVacuna->apellido = $request->apellido;
           $encuestaVacuna->esquema = $request->esquema;
           //$encuestaVacuna->vacuna = $request->vacuna;
           $encuestaVacuna->estado = $request->estado;
           $encuestaVacuna->save();
           
           
            
        }else{
            $encuestaVacuna = new EncuestaVacuna();
            
           $encuestaVacuna->despacho =  auth()->user()->name;
           $encuestaVacuna->despacho_id =  auth()->user()->cedula;
           $encuestaVacuna->cedula = $request->cedula;
           $encuestaVacuna->nombre = $request->nombre;
           $encuestaVacuna->apellido = $request->apellido;
           $encuestaVacuna->esquema = $request->esquema;
           $encuestaVacuna->vacuna = $request->vacuna;
           $encuestaVacuna->estado = "VACUNADO";
           $encuestaVacuna->save();
            
        }
        
        
        
        return redirect('usuarios/encuesta/vacunacion');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $uVacunados = EncuestaVacuna::where('despacho_id', auth()->user()->cedula)->get();
        //dd($uVacunados);
        
        $VACUNAS = ['PFIZER' => 'PFIZER', 'CORONOVAC' => 'CORONOVAC', 'MODERNA' => 'MODERNA','ASTRAZENECA'=>'ASTRAZENECA'];
        $encuesta = EncuestaVacuna::findOrFail($id);
        $edita = true;
        //dd($encuesta);
        
        return view('Formularios.encuestaVacunacion.edit',compact('VACUNAS','encuesta','uVacunados','edita'));
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
        $encuestaVacuna = EncuestaVacuna::findOrFail($id);
        if($request->esquema=="NINGUNA"){
           $encuestaVacuna->despacho =  auth()->user()->name;
           $encuestaVacuna->despacho_id =  auth()->user()->cedula;
           $encuestaVacuna->cedula = $request->cedula;
           $encuestaVacuna->nombre = $request->nombre;
           $encuestaVacuna->apellido = $request->apellido;
           $encuestaVacuna->esquema = $request->esquema;
           //$encuestaVacuna->vacuna = $request->vacuna;
           $encuestaVacuna->estado =' $request->estado';
           $encuestaVacuna->save();
           
           
            
        }else{
            
            
           $encuestaVacuna->despacho =  auth()->user()->name;
           $encuestaVacuna->despacho_id =  auth()->user()->cedula;
           $encuestaVacuna->cedula = $request->cedula;
           $encuestaVacuna->nombre = $request->nombre;
           $encuestaVacuna->apellido = $request->apellido;
           $encuestaVacuna->esquema = $request->esquema;
           $encuestaVacuna->vacuna = $request->vacuna;
           $encuestaVacuna->estado = 'VACUNADO';
           $encuestaVacuna->save();
            
        }
       
        Session::flash('message', 'Usuario actualizado correctamente');
        return redirect('usuarios/encuesta/vacunacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexRegistro(Request $request)
    {
        
         $agendado = AgendamientoCapacitacion::where('despacho_id', auth()->user()->cedula)->get();
       // dd($agendado);
        $tipoAsistencias = ['VIRTUAL' => 'VIRTUAL', 'PRESENCIAL' => 'PRESENCIAL'];
        
       
        
        $agendamiento = new AgendamientoCapacitacion;
        
        return view('Formularios.agendamientoCapacitacion.index',compact('agendado','agendamiento','tipoAsistencias'));
         
            
    }
}
