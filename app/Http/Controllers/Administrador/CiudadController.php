<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Http\Requests\CiudadesCreateRequest;
use App\Http\Requests\CiudadesUpdateRequest;
use App\Models\Ciudad;
use App\Models\Despacho;
class CiudadController extends Controller
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
        $ciudades = Ciudad::All();
        return view('administrador.ciudad.index', compact('ciudades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.ciudad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CiudadesCreateRequest $request)
    {
        //
        Ciudad::create([
            'codigoCiudad'        => $request['codigoCiudad'],
            'nombreCiudad'        => $request['nombreCiudad'],            
        ]);
        
        //dd($request);
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/ciudad');
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
         $ciudad = Ciudad::findOrFail($id);
                
          return view('administrador.ciudad.edit', compact('ciudad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CiudadesUpdateRequest $request, $id)
    {
        //
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $ciudad->save();
       
        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/ciudad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $comprobar = 0;
        $dato = Despacho::All();

        foreach ($dato as $dt) {
            if($id == $dt->codCiudad){
                $comprobar =  $comprobar + 1;
            }
        }
        //dd($comprobar);
        if($comprobar == 0){
            $ciudad = Ciudad::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/ciudad');
        }else{
            Session::flash('message','No se puede eliminar Ciudad, está siendo utilizada en Despacho');
            return Redirect::to('/administrador/ciudad');
        }
        
        
    }
}
