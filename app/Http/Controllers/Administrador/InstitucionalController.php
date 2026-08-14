<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Institucional;
use App\Models\TipoTemas;  
use App\Http\Requests\InstitucionalCreateRequest;
use App\Http\Requests\InstitucionalUpdateRequest;

class InstitucionalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $institucional = Institucional::All();
        return view('administrador.institucional.index', compact('institucional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('administrador.institucional.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitucionalCreateRequest $request)
    {
        $dato="";
        if($request['iTipo'] == 'Mision'){
            $dato = "Misión";
        }else{
            $dato = "Visión";
        }

        Institucional::create([
            'iTitulo'         => $dato,
            'iFoto'           => $request['iFoto'],    
            'iDescripcion'    => $request['iDescripcion'],  
            'iTipo'           => $request['iTipo'],    
            'iCreador'        => $request['iCreador'],          
        ]);
        
        //dd($perfiles);
        Session::flash('message', 'actualizado correctamente');        
        return Redirect::to('/administrador/institucional');
        
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
        $institucional  = Institucional::find($id);
        return view('administrador/institucional.edit', compact('institucional'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstitucionalUpdateRequest $request, $id)
    {
        //
        $institucional = Institucional::find($id);
        $institucional->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $institucional->save();

        Session::flash('message', 'actualizado correctamente');
        return Redirect::to('administrador/institucional');
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
        $institucional = Institucional::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/institucional');
    }
}
