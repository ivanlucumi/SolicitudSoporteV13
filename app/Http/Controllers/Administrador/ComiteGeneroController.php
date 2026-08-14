<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Http\Requests\ComiteGeneroCreateRequest;
use App\Http\Requests\ComiteGeneroUpdateRequest;
use App\Http\Requests\ComiteGeneroGaleriaCreateRequest;
use App\Http\Requests\ComiteGeneroGaleriaUpdateRequest;
use App\Http\Requests\ComiteGeneroEnlacesCreateRequest;
use App\Http\Requests\ComiteGeneroEnlacesUpdateRequest;
use App\Models\ComiteGenero;
use App\Models\ComiteGeneroEnlaces;
use App\Models\ComiteGeneroGaleria;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class ComiteGeneroController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

    /* comite documentos */
    public function indexDocumentoGenero(){
    	$comite = ComiteGenero::comiteGenero();
    	return view('administrador.comite.index', compact('comite'));
    }

    public function createDocumentoGenero()
    {
        //
        return view('administrador.comite.create');
    }

    public function storeDocumentoGenero(ComiteGeneroCreateRequest $request)
    {
        //
        ComiteGenero::create([
            'cgtitulo'        => $request['cgtitulo'],
            'cgdocumento'     => $request['cgdocumento'],
            'cgcreador'       =>  auth()->user()->cedula,
        ]);
        Session::flash('message', 'Creado Correctamente');
        return Redirect::to('/administrador/genero-documentos');
    }

    public function editDocumentoGenero($id)
    {
        //
        $comite = ComiteGenero::find($id);
        return view('administrador/comite.edit', compact('comite'));
    }

    public function updateDocumentoGenero(ComiteGeneroUpdateRequest $request, $id)
    {
        //
        $comite                = ComiteGenero::find($id);
        $comite->cgtitulo      = $request->get('cgtitulo');
        $comite->cgdocumento   = $request->get('cgdocumento');
        $comite->cgmodificador =  auth()->user()->cedula;
        //$comite->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $comite->save();

        Session::flash('message', ' Actualizado Correctamente');
        return Redirect::to('administrador/genero-documentos');
    }

    public function destroyDocumentoGenero($id)
    {
        //
        $comite = ComiteGenero::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/genero-documentos');
    }

    /**********************/

    /* comite enlaces */
    public function indexComiteGeneroEnlaces(){
    	$comite = ComiteGeneroEnlaces::comiteGeneroEnlaces();
    	return view('administrador.comiteenlaces.index', compact('comite'));
    }

    public function createComiteGeneroEnlaces()
    {
        //
        return view('administrador.comiteenlaces.create');
    }

    public function storeComiteGeneroEnlaces(ComiteGeneroEnlacesCreateRequest $request)
    {
        //
        $files     = $request->file('cgelink');
        if(!empty($files)){
            $cgetitulo = Carbon::now()->second.$files->getClientOriginalName();
            $this->attributes['cgelink'] = $cgetitulo;
            \Storage::disk('local')->put($cgetitulo, \File::get($files));
        }
        
        ComiteGeneroEnlaces::create([
            'cgetitulo'       =>  $request['cgetitulo'],
            'cgedescripcion'  =>  $request['cgedescripcion'],
            'cgelink'         =>  $request['cgelink'],
            'cgecreador'       =>   auth()->user()->cedula,
        ]);
        Session::flash('message', 'Creado Correctamente');
        return Redirect::to('/administrador/genero-enlaces');
    }

    public function editComiteGeneroEnlaces($id)
    {
        //
        $comite = ComiteGeneroEnlaces::find($id);
        return view('administrador/comiteenlaces.edit', compact('comite'));
    }

    public function updateComiteGeneroEnlaces(ComiteGeneroEnlacesUpdateRequest $request, $id)
    {
        //
        $comite = ComiteGeneroEnlaces::find($id);
        $comite->cgetitulo      = $request->get('cgetitulo');
        $comite->cgedescripcion = $request->get('cgedescripcion');
        $comite->cgelink        = $request->get('cgelink');
        $comite->cgemodificador =  auth()->user()->cedula;
        //$comite->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $comite->save();

        Session::flash('message', ' actualizado correctamente');
        return Redirect::to('administrador/genero-enlaces');
    }

    public function destroyComiteGeneroEnlaces($id)
    {
        //
        $comite = ComiteGeneroEnlaces::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/genero-enlaces');
    }

    /**********************/

    /* comite galería*/
    public function indexComiteGaleria(){
    	$comite = ComiteGeneroGaleria::comiteGeneroGaleria();
    	return view('administrador.comitegaleria.index', compact('comite'));
    }

    public function createComiteGaleria()
    {
        //
        return view('administrador.comitegaleria.create');
    }

    public function storeComiteGaleria(ComiteGeneroGaleriaCreateRequest $request)
    {
        //
        $total     = count($request->cggImagen);
        //dd($request->cggImagen);
        $files     = $request->file('cggImagen');
        $arreglo   = array();

        foreach($files as $file) {
            if(!empty($files)){
                $cggTitulo = Carbon::now()->second.$file->getClientOriginalName();
                $this->attributes['file'] = $cggTitulo;
                \Storage::disk('local')->put($cggTitulo, \File::get($file));  
                 $arreglo[] = $cggTitulo;  
            }
        }

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');
        //dd($arreglo);
        $total1     = count($arreglo);
        //dd($total1);
        if($total == 1){
            ComiteGeneroGaleria::create([
                'cggTitulo'        => $request['cggTitulo'], 
                'cggImagen'        => $arreglo[0],     
                'cggdescripcion'   => $request['cggdescripcion'], 
                'cggFecha'         => $request['cggFecha'], 
                'cggEstado'        => 1,//1 ->muestra 0 ->deshabilitado 
                'cggCreador'       =>  auth()->user()->cedula                   
            ]);
        }else{
            for ($i=0; $i < $total1; $i++) { 
                ComiteGeneroGaleria::create([
                	'cggTitulo'        => $request['cggTitulo'],                     
                    'cggImagen'        => $arreglo[$i],     
                    'cggdescripcion'   => $request['cggdescripcion'], 
                    'cggFecha'         => $request['cggFecha'], 
                    'cggEstado'        => 1,//1 ->muestra 0 ->deshabilitado 
                    'cggCreador'       =>  auth()->user()->cedula                   
                                       
                ]); 
            }
        }
        Session::flash('message', 'Creado Correctamente');
        return Redirect::to('/administrador/genero-galeria');
    }

    public function editComiteGaleria($id)
    {
        //
        $comite = ComiteGeneroGaleria::find($id);
        return view('administrador/comitegaleria.edit', compact('comite'));
    }

    public function updateComiteGaleria(ComiteGeneroGaleriaUpdateRequest $request, $id)
    {
        //
        $imagen  = $request['cggImagen'];
        $gImagen = Carbon::now();
        $gImagen = $gImagen->format('Y-m-d');
        
        if(!empty($request['cggImagen'])){
            $cggTitulo = Carbon::now()->second.$cggImagen->getClientOriginalName();
            $this->attributes['gImagen'] = $cggTitulo;
            \Storage::disk('local')->put($cggTitulo, \File::get($cggImagen));        
        }
       
        //dd($gImagen);
        $glrs = ComiteGeneroGaleria::findOrFail($id);
        $glrs->cggTitulo      = $request->get('cggTitulo');
        if(!empty($request['cggImagen'])){
            $glrs->cggImagen      = $request->get('cggImagen');
        }
        
        $glrs->cggdescripcion = $request->get('cggdescripcion');
        $glrs->cggFecha       = $request->get('cggFecha');
        $glrs->cggEstado      = $request->get('cggEstado');
        $glrs->cggModificador = $request->get('cggModificador');

        //$glrs->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */

        $glrs->save();

        Session::flash('message', ' Actualizado Correctamente');
        return Redirect::to('administrador/genero-galeria');
    }

    public function destroyComiteGaleria($id)
    {
        //
        $comite = ComiteGeneroGaleria::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/genero-galeria');
    }

    /**********************/
    

}
