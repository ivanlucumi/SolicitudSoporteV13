<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Administrador;
use App\Http\Requests\RolsUpdateRequest;
use App\Http\Requests\RolsCreateRequest;
use App\Models\User;

use App\Models\RoL;

class RolController extends Controller
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
        $roles = RoL::All();
        return view('administrador.rol.index',compact('roles'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.rol.createRol');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolsCreateRequest $request)
    {
        //
         Rol::create([
            'rol'        => $request['rol'],            
        ]);
        
        Session::flash('message', 'creado correctamente');
        return Redirect::to('/administrador/rol');
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
         $rol = Rol::findOrFail($id);
                
          return view('administrador.rol.editRol', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolsUpdateRequest $request, $id)
    {
        //
        $rol = Rol::findOrFail($id);
        $rol->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $rol->save();
        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('/administrador/rol');
       
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
        $usuario = User::where('rol',$id)->get();

        $comprobar = count($usuario);
        //dd($comprobar);
        if($comprobar == 0){
            $rol = Rol::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/rol');
        }else{
            Session::flash('message','No se puede eliminar rol, está siendo utilizado');
            return Redirect::to('/administrador/rol');
        }

        
    }
}
