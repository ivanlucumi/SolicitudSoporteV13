<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Directorio;
use App\Http\Requests\DirectorioRequest;
use Illuminate\Support\Facades\DB;
use Auth;

class DirectorioController extends Controller
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
        $directorio = Directorio::All();
        return view('administrador.directorio.index',compact('directorio'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.directorio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectorioRequest $request)
    {
        //
        Directorio::create([
            'dDespacho'   => $request['dDespacho'],
            'dCiudad'     => $request['dCiudad'],
            'dDireccion'  => $request['dDireccion'],
            'dTelefono'   => $request['dTelefono'],
            'dExtension'  => $request['dExtension'],
            'dCircuito'   => $request['dCircuito'],
            'dDistricto'  => $request['dDistricto'],
            'dCreador'    => $request['dCreador'],
        ]);
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/directorio');
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
        $directorio  = Directorio::find($id);
        return view('administrador/directorio.show',['directorio'=>$directorio]);
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
        $directorio  = Directorio::find($id);
        return view('administrador/directorio.edit', compact('directorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DirectorioRequest $request, $id)
    {
        //
        $directorio = Directorio::find($id);
        $directorio->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $directorio->save();

        Session::flash('message', 'Directorio actualizado correctamente');
        return Redirect::to('administrador/directorio');
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
        $directorio = Directorio::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/directorio');
    }
}
