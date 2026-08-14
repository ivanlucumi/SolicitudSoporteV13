<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller\Administrador;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\InventarioCreateRequest;
use App\Http\Requests\InventarioUpdateRequest;
use App\Models\Inventario;
use App\Models\Elemento;
use App\Models\Despacho;

class InventarioController extends Controller
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
        //$inventarios = Inventario::todoInventario();
        //$inventarios = Inventario::where('estadoPlaca','ACTIVOS')->with('elementoI','despachoI')->get();
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        //dd($despachos);

       // dd($inventarios);
        return view('administrador.inventario.index',compact('despachos'));
    }

    public function selectInventario(Request $request, $id)
    {
        $inventarios = Inventario::where('codigoJuzgado',$id)->where('estadoPlaca','ACTIVOS')->with('elementoI','despachoI')->get();

          if($request->ajax())
            {
             
              return response()->json($inventarios);
            }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $elementos = Elemento::pluck('nombreElemento','id');
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        return view('administrador.inventario.create',compact('elementos','despachos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventarioCreateRequest $request)
    {
       //dd($request);

      Inventario::create([
            'codigoElemento'         => $request['codigoElemento'],
            'codigoJuzgado'          => $request['codigoJuzgado'],     
            'placaInventario'        => $request['placaInventario'], 
            'marca'                  => $request['marca'], 
            'modelo'                 => $request['modelo'],
            'serial'                 => $request['serial'],
            'valorArticulo'          => $request['valorArticulo'], 
            'fechaAsignacion'        => $request['fechaAsignacion'], 
            'estadoPlaca'            => $request['estadoPlaca'],
            'observacionPlaca'       => $request['observacionPlaca']

                   
        ]);
        
        Session::flash('message','Creado Correctamente');
        return Redirect::to('/administrador/inventarios');
    
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
        $inventario = Inventario::getInventario($id);
        //dd($inventario);
        return view('administrador.inventario.show',compact('inventario'));
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
        $elementos = Elemento::pluck('nombreElemento','id');
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $inventario = Inventario::findOrFail($id);
        return view('administrador.inventario.edit',compact('inventario','despachos','elementos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventarioUpdateRequest $request, $id)
    {
        //
        $inventario = Inventario::findOrFail($id);
        $inventario->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $inventario->save();
        Session::flash('message','Actualizado Correctamente');
        return Redirect::to('/administrador/inventarios');
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
        $inventario = Inventario::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('/administrador/inventarios');
    }
}
