<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TiempoAtencionCreateRequest;
use App\Http\Requests\TiempoAtencionUpdateRequest;
use App\Models\TiempoAtencion;
use App\Models\Categoria;

class TiempoAtencionController extends Controller
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
        $tiempoAtencion = TiempoAtencion::All();
        return view('administrador.tiempoAtencion.index', compact('tiempoAtencion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.tiempoAtencion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TiempoAtencionCreateRequest $request)
    {
        //
         TiempoAtencion::create([
            'prioridad'        => $request['prioridad'],
            'maximoD'        => $request['maximoD'],            
        ]);
        
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/tiempoAtencion');
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
         $tiempos = TiempoAtencion::findOrFail($id);
                
          return view('administrador.tiempoAtencion.edit', compact('tiempos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TiempoAtencionUpdateRequest $request, $id)
    {
        //
        $tiempoAtencion = TiempoAtencion::findOrFail($id);
        $tiempoAtencion->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $tiempoAtencion->save();
       
         Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/tiempoAtencion');
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
        $dato = Categoria::where('prioridad',$id)->get();
        $comprobar = count($dato);
        //dd($comprobar);
        if($comprobar == 0){
            $tiempoAtension = TiempoAtencion::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/tiempoAtencion');
        }else{
            Session::flash('message','No se puede eliminar Tiempo de Atencion, está siendo utilizado');
            return Redirect::to('/administrador/tiempoAtencion');
        }
    }
}
