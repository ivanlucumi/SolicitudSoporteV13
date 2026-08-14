<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller\Administrador;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ElementoCreateRequest;
use App\Http\Requests\ElementoUpdateRequest;
use App\Models\Elemento;
use App\Models\Categoria;
use App\Models\Inventario;

class ElementoController extends Controller
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
        $elementos = Elemento::getElementos();
        return view('administrador.elementos.index', compact('elementos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::pluck('descripcioncategoria','id');
        $elementos  = Elemento::getElementos();
        return view('administrador.elementos.create',compact('categorias','elementos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElementoCreateRequest $request)
    {
        //
         Elemento::create([
            'id'                   => $request['id'],
            'nombreElemento'       => $request['nombreElemento'],
             'idCategoria'         => $request['idCategoria'],
                    
        ]);
        
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/elementos');
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
         $elemento = Elemento::findOrFail($id);
         $categorias = Categoria::pluck('descripcioncategoria','id');            
          return view('administrador.elementos.edit', compact('elemento','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ElementoUpdateRequest $request, $id)
    {
        //
        $elemento = Elemento::findOrFail($id);
        $elemento->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $elemento->save();
       
        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/elementos');
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
        $dato = Inventario::where('codigoElemento',$id)->get();

        $comprobar = count($dato);
        //dd($comprobar);
        if($comprobar == 0){
            $elemento = Elemento::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/elementos');
        }else{
            Session::flash('message','No se puede eliminar Elemento, está siendo utilizado en Inventario');
            return Redirect::to('/administrador/elementos');
        }
        
    }
}
