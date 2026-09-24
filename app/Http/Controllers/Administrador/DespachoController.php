<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller\Administrador;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\DespachosCreateRequest;
use App\Http\Requests\DespachosUpdateRequest;

use App\Exports\DespachoExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Inventario;




class DespachoController extends Controller
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
        $despachos = Despacho::todoDespachos();

        return view('administrador.despachos.index',compact('despachos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ciudades = Ciudad::pluck('nombreCiudad','codigoCiudad');
        return view('administrador.despachos.create', compact('ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DespachosCreateRequest $request)
    {
        //
        Despacho::create([
            'codigoDespacho'     => $request['codigoDespacho'],
            'nombreDespacho'     => $request['nombreDespacho'],
            'sede'               => $request['sede'],
            'codCiudad'          => $request['codCiudad'],
            'direccion'          => $request['direccion'],
            'telefono'           => $request['telefono'],
            'correoD'            => $request['correoD'],
            'atencion_virtual'   => $request['atencion_virtual'],
            'correo_demanda'     => $request['correo_demanda'],
            'correo_memoriales'  => $request['correo_memoriales'],
            'extension'          => $request['extension'],
            'circuito'           => $request['circuito'],
            'districto'          => $request['districto'],
            'edificio'           => $request['edificio'],
            'piso'               => $request['piso'],
            'estado'             => $request['estado'] ?? 'Activo',
            'creador'            => $request['creador'] ??  auth()->user()->name ?? 'Sistema',
        ]);

        User::create([
            'cedula'         => $request['codigoDespacho'],
            'name'           => $request['nombreDespacho'],
            'lastname'       => $request['lastname'] ?? 'Despacho',
            'email'          => $request['correoD'],
            'password'       => $request['codigoDespacho'],
            'rol'            => 3,
        ]);

        Session::flash('message', 'Despacho creado correctamente');
        return Redirect::to('/administrador/despachos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $despachos = Despacho::with('ciudad')->find($id);
        return view('administrador.despachos.show', ['despachos' => $despachos]);
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
        $ciudades = Ciudad::pluck('nombreCiudad','codigoCiudad');
        $despacho = Despacho::findOrFail($id);
        return view('administrador.despachos.edit',compact('despacho','ciudades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DespachosUpdateRequest $request, $id)
    {
        $despacho = Despacho::findOrFail($id);
        $despacho->fill($request->all());
        $despacho->estado = $request->estado ?? $despacho->estado ?? 'Activo';
        $despacho->modificador = $request->modificador ??  auth()->user()->name ?? null;
        $despacho->save();

        Session::flash('message', 'Despacho actualizado correctamente');
        return Redirect::to('/administrador/despachos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $despacho = Despacho::findOrFail($id);
        $despacho->estado = 'Inactivo';
        $despacho->modificador =  auth()->user()->name ?? 'Sistema';
        $despacho->save();

        Session::flash('message', 'Despacho inactivado correctamente');
        return Redirect::to('/administrador/despachos');
    }

    public function export()
    {
        $fecha = now()->format('Ymd_His');
        return Excel::download(new DespachoExport, "despachos_{$fecha}.xlsx");
    }
}
