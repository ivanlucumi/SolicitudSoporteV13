<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Seccional;
use App\Http\Requests\SeccionalesCreateRequest;
use App\Http\Requests\SeccionalesUpdateRequest;
use App\Seguimiento;

class SeccionalesController extends Controller
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
        $seccionales = Seccional::All();
        return view('administrador.seccionales.index', compact('seccionales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.seccionales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionalesCreateRequest $request)
    {
        //
         Seccional::create([
            'nombreSeccional'        => $request['nombreSeccional'],
                      
        ]);
        
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/seccionales');
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
         $seccional = Seccional::findOrFail($id);
                
          return view('administrador.seccionales.edit', compact('seccional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionalesUpdateRequest $request, $id)
    {
        //
        $seccionale = Seccional::findOrFail($id);
        $seccionale->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $seccionale->save();
       
        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/seccionales');
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
        $dato = Seguimiento::where('seccional',$id)->get();
        $comprobar = count($dato);
        //dd($comprobar);
        if($comprobar == 0){
            $seccionale = Seccional::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/seccionales');
        }else{
            Session::flash('message','No se puede eliminar Seccional, está siendo utilizada en Seguimiento');
            return Redirect::to('/administrador/seccionales');
        }
        
       
    }
}
