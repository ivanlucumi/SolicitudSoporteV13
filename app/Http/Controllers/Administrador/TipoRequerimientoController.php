<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Http\Requests\RequerimientoCreateRequest;
use App\Http\Requests\RequerimientoUpdateRequest;
use App\Models\TipoRequerimiento;
use App\Models\SolicitudUsuario;


class TipoRequerimientoController extends Controller
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
        $tiporequerimientos = TipoRequerimiento::All();
        return view('administrador.tipoRequerimiento.index', compact('tiporequerimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.tipoRequerimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequerimientoCreateRequest $request)
    {
        //
         TipoRequerimiento::create([
            'nombreRequerimiento'        => $request['nombreRequerimiento'],
                    
        ]);
        
        //dd($perfiles);
          Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/requerimientos');
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
         $requerimiento = TipoRequerimiento::findOrFail($id);
                
          return view('administrador.tipoRequerimiento.edit', compact('requerimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequerimientoUpdateRequest $request, $id)
    {
        //
        $empleado = TipoRequerimiento::findOrFail($id);
        $empleado->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $empleado->save();
       
        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/requerimientos');
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
        $comprobar = 0;
        $dato = SolicitudUsuario::where('idrequerimiento',$id)->get();
        //dd($dato);
        $comprobar = count($dato);
        //dd($comprobar);
        if($comprobar == 0){
            $tipo = TipoRequerimiento::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/requerimientos');
        }else{
            Session::flash('message','No se puede eliminar Requerimiento, está siendo utilizada en Solicitud Usuarios');
            return Redirect::to('/administrador/requerimientos');
        }

    }
}
