<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller\Administrador;
use Illuminate\Support\Facades\Session;
use App\Models\Categoria;
use App\Models\TiempoAtencion;
use App\Http\Requests\CategoriasCreateRequest;
use App\Http\Requests\CategoriasUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Elemento;
use App\Models\SolicitudUsuario;
class CategoriaController extends Controller
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
        $categorias = Categoria::verCategoria();
        return view('administrador.categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tiempos = tiempoAtencion::pluck('prioridad','id');
        //dd($tiempos);
        return view('administrador.categoria.create', compact('tiempos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasCreateRequest $request)
    {
        //
         //dd($request['tiempo']);
         Categoria::create([
            'descripcioncategoria'        => $request['descripcioncategoria'],
            'prioridad'                   => $request['prioridad'],
                    
        ]);
        
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/categorias');
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
         $categoria = Categoria::findOrFail($id);
           $tiempos = tiempoAtencion::pluck('prioridad','id');     
          return view('administrador.categoria.edit', compact('categoria','tiempos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriasUpdateRequest $request, $id)
    {
        //
        //dd($request);
        $categoria = Categoria::findOrFail($id);
        $categoria->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $categoria->save();
       
        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/categorias');
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
        $comprobar1 = 0;
        $texto="";
        $texto1="";
        $dato   =   Elemento::where('idCategoria',$id)->get();
        $dato1  =   SolicitudUsuario::where('idcategorias',$id)->get();

        
        if($dato != null){
            $comprobar =  count($dato);
            $texto=' Elementos, ';
        }
       
        if($dato1 != null){
            $comprobar1 =  count($dato1);
            $texto1=' Solicitud Usuario ';
        }

        //dd($comprobar);
        if($comprobar == 0 && $comprobar1 == 0){
            $ciudad = Categoria::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/categorias');
        }else{
            Session::flash('message','No se puede eliminar Categoria, está siendo utilizada en '.$texto.''.$texto1.'');
            return Redirect::to('/administrador/categorias');
        }

        
    
        
        
        
    }
}
