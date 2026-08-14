<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Noticias;
use Carbon\Carbon;
use App\Http\Requests\NoticiasCreateRequest;
use App\Http\Requests\NoticiasUpdateRequest;

class NoticiasController extends Controller
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
        $noticias = Noticias::All();
        return view('administrador.noticias.index',compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiasCreateRequest $request)
    {
        //
        Noticias::create([
            'nNombre'         =>   $request['nNombre'],
            'nImagen'         =>   $request['nImagen'],
            'nDescripcion'    =>   $request['nDescripcion'],
            'nLink'           =>   $request['nLink'],
            'nTiempo'         =>   $request['nTiempo'],
            'nEstado'         =>   $request['nEstado'],
            'nCreador'        =>   $request['nCreador'],
            'nModificador'    =>   $request['nModificador'],
        ]);
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/noticias');
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
        $ntcia  = Noticias::find($id);
        return view('administrador/noticias.show',['ntcia'=>$ntcia]);

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
        $noticias  = Noticias::find($id);
        return view('administrador/noticias.edit', compact('noticias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticiasUpdateRequest $request, $id)
    {
        //
        $noticias = Noticias::find($id);
        $noticias->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $noticias->save();

        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('administrador/noticias');
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
        $noticias = Noticias::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/noticias');
    }
}
