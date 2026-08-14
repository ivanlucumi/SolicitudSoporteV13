<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Especial;
use App\Http\Requests\EspecialCreateRequest;
use App\Http\Requests\EspecialUpdateRequest;
use Carbon\Carbon;


class EspecialController extends Controller
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
        $especial = Especial::All();
        return view('administrador.especial.index',compact('especial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.especial.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecialCreateRequest $request)
    {
        //
        Especial::create([            
            'eFoto'          => $request['eFoto'],
            'eTiempo'        => $request['eTiempo'],           
            'eEstado'        => $request['eEstado'],
            'eCreador'       => $request['eCreador'],
        ]);
        Session::flash('message', 'Creado Correctamente');
        return Redirect::to('/administrador/especial');
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
        $especial  = Especial::find($id);
        return view('administrador/especial.edit', compact('especial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialUpdateRequest $request, $id)
    {
        //
        $especial = Especial::find($id);
        $especial->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $especial->save();

        Session::flash('message', ' Actualizado Correctamente');
        return Redirect::to('administrador/especial');
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
        $especial = Especial::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/especial');
    }
    
}
