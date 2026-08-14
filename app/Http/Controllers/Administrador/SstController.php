<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Sst;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class SstController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

    /* comite documentos */
    public function index(){
    	$sst = Sst::all();
    	return view('administrador.sst.index', compact('sst'));
    }

    public function create()
    {
        //
        return view('administrador.sst.create');
    }

    public function store(Request $request)
    {
        //
        Sst::create([
            'sst_titulo'        => $request['sst_titulo'],
            'sst_documento'     => $request['sst_documento'],
            'ubicacion'         => $request['ubicacion'],
            'sst_creador'       =>  auth()->user()->cedula,
        ]);
        Session::flash('message', 'Creado Correctamente');
        return Redirect::to('/administrador/sst-documentos');
    }

    public function edit($id)
    {
        //
        $sst = Sst::find($id);
        return view('administrador.sst.edit', compact('sst'));
    }

    public function update(Request $request, $id)
    {
        //
        $sst                = Sst::find($id);
        $sst->sst_titulo      = $request->get('sst_titulo');
        $sst->sst_documento   = $request->get('sst_documento');
        $sst->sst_modificador =  auth()->user()->cedula;
        $sst->ubicacion ="SST";
        //$comite->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $sst->save();

        Session::flash('message', ' Actualizado Correctamente');
        return Redirect::to('administrador/sst-documentos');
    }

    public function destroy($id)
    {
        //
        $sst = Sst::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/sst-documentos');
    }

   
    

}
