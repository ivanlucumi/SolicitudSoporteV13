<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Torre;
use App\Models\Pisos;
use App\Models\Sala;
use App\Http\Requests\TorreCreateRequest;
use App\Http\Requests\TorreUpdateRequest;
use App\Http\Requests\PisoCreateRequest;
use App\Http\Requests\PisoUpdateRequest;
use App\Http\Requests\SalaCreateRequest;
use App\Http\Requests\SalaUpdateRequest;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class DistribucionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }
    //

    /**Torres**/
    public function torresJuzgados(){
    	$torres = Torre::all();
    	return view('administrador.distribucion.torres', compact('torres'));
    }

    public function torresStore(TorreCreateRequest $request){

    	$message = 'Torre creada corectamente!!';

        if ($request->ajax()) {


            $evento = Torre::create([
                't_nombre'           => $request['t_nombre'],
                't_creador'          =>  auth()->user()->name,            
            ]);
            Session::flash('message','Torre Creada Correctamente');

            return $message;
            
        }

    }

    public function torresEdit($id, Request $request){
    	$torres = Torre::findOrFail($id);

    	if($request->ajax()){
            return Response::json($torres); 
        };
    } 

    public function torresUpdate($id, TorreUpdateRequest $request){
    	$message = 'Torre Actualizada Correctamente!!';

    	if($request->ajax())
        {
    		$torres                 =  Torre::findOrFail($id);
    		$torres->t_nombre       =  $request['t_nombre'];
    		$torres->t_modificador  =   auth()->user()->name;
    		$torres->save();
            Session::flash('message','Torre Actualizada Correctamente');
            return $message;

    	}
    }

    public function torresDelete($id){
    	$total = 0;
    	$validar = Pisos::where('p_torre',$id)->get();

    	if($validar != null){
            $total =  count($validar);
            $texto=' Elementos, ';
        }


        //dd($comprobar);
        if($total == 0){
            $torre = Torre::destroy($id);
            Session::flash('message','Torre Eliminada Correctamente');
            return Redirect::to('/administrador/torres-juzgados');
        }else{
            Session::flash('message','No se puede eliminar Torre, tiene pisos asignados');
            return Redirect::to('/administrador/torres-juzgados');
        }
    }
    /**Torres**/

    /**Pisos**/
    public function pisosJuzgados(){
    	$pisos  = Pisos::pisos();
    	$torres = Torre::pluck('t_nombre','id'); 
    	return view('administrador.distribucion.pisos', compact('pisos','torres'));
    }

    public function pisosStore(PisoCreateRequest $request){

    	$message = 'Pisos creada corectamente!!';

        if ($request->ajax()) {
            $comprobar = Pisos::Analisis($request['p_nombre'], $request['p_torre']);
            //dd($comprobar);

            if($comprobar[0]->total == 0){
                $evento = Pisos::create([
                    'p_nombre'           => strtoupper($request['p_nombre']),
                    'p_torre'            => $request['p_torre'],
                    'p_creador'          =>  auth()->user()->name,            
                ]);
                Session::flash('message','Piso Creado Correctamente');
            }else{
                Session::flash('message','Ya se ha creado para esta torre el siguiente piso: '.strtoupper($request['p_nombre']));
            }
            return $message;
            
        }

    }

    public function pisosEdit($id, Request $request){
    	$pisos = Pisos::findOrFail($id);

    	if($request->ajax()){
            return Response::json($pisos); 
        };
    } 

    public function pisosUpdate($id, PisoUpdateRequest $request){
    	$message = 'Piso Actualizada Correctamente!!';

    	if($request->ajax())
        {
    		$elmismo = Pisos::Analisisid($id, $request['p_nombre'], $request['p_torre']);

            $otro    = Pisos::Analisisor($request['p_nombre'], $request['p_torre'],$id); 
            //dd($otro[0]->total,' ',$elmismo[0]->total);
            $pisos                 =  Pisos::findOrFail($id);
            
            
            if($elmismo[0]->total == 1 && $otro[0]->total == 0){                
                $pisos->p_nombre       =  $request['p_nombre'];
                $pisos->p_torre        =  $request['p_torre'];
                $pisos->p_modificador  =   auth()->user()->name;
                $pisos->save();
                Session::flash('message','Piso Actualizado Correctamente n');

            }
            //dd($otro[0]->total);
            if($otro[0]->total == 0){    
                //dd('no debia entrar');            
                $pisos->p_nombre       =  $request['p_nombre'];
                $pisos->p_torre        =  $request['p_torre'];
                $pisos->p_modificador  =   auth()->user()->name;
                $pisos->save();
                Session::flash('message','Piso Actualizado Correctamente m');

            }

            if($otro[0]->total == 1){
                Session::flash('message','Ya se encuentra un registro con los mismos datos');   
                         
            }

            
            return $message;

    	}
    }

    public function pisosDelete($id){
    	$total = 0;
    	$validar = Sala::where('s_pisos',$id)->get();

    	if($validar != null){
            $total =  count($validar);
        }


        //dd($comprobar);
        if($total == 0){
            $torre = Pisos::destroy($id);
            Session::flash('message','Piso Eliminado Correctamente');
            return Redirect::to('/administrador/pisos-juzgados');
        }else{
            Session::flash('message','No se puede eliminar Piso, tiene salas asignados');
            return Redirect::to('/administrador/pisos-juzgados');
        }
    }
    /**Pisos**/


    /**Salas**/
    public function salasJuzgados(){
        $salas  = Sala::salas();
        $salasp  = Sala::pluckSala(); 
        return view('administrador.distribucion.salas', compact('salas','salasp'));
    }

    public function salasStore(SalaCreateRequest $request){

        $message = 'Sala creada corectamente!!';

        if ($request->ajax()) {
            $comprobar = Sala::Analisis($request['s_nombre'], $request['s_pisos']);
            //dd($comprobar);

            if($comprobar[0]->total == 0){
                $evento = Sala::create([
                    's_nombre'           => strtoupper($request['s_nombre']),
                    's_pisos'            => $request['s_pisos'],
                    's_creador'          =>  auth()->user()->name,            
                ]);
                Session::flash('message','Sala Creada Correctamente');
            }else{
                Session::flash('message','Ya se ha creado para este piso la siguiente sala: '.strtoupper($request['s_nombre']));
            }
            return $message;
            
        }

    }

    public function salasEdit($id, Request $request){
        $salas = Sala::findOrFail($id);

        if($request->ajax()){
            return Response::json($salas); 
        };
    } 

    public function salasUpdate($id, SalaUpdateRequest $request){
        $message = 'Piso Actualizada Correctamente!!';

        if($request->ajax())
        {
            $elmismo = Sala::Analisisid($id, $request['s_nombre'], $request['s_pisos']);

            $otro    = Sala::Analisisor($request['s_nombre'], $request['s_pisos'],$id); 
            //dd($otro[0]->total,' ',$elmismo[0]->total);
            $sala                 =  Sala::findOrFail($id);
            
            
            if($elmismo[0]->total == 1 && $otro[0]->total == 0){                
                $sala->s_nombre       =  $request['s_nombre'];
                $sala->s_pisos        =  $request['s_pisos'];
                $sala->s_modificador  =   auth()->user()->name;
                $sala->save();
                Session::flash('message','Sala Actualizada Correctamente n');

            }
            //dd($otro[0]->total);
            if($otro[0]->total == 0){    
                //dd('no debia entrar');            
                $sala->s_nombre       =  $request['s_nombre'];
                $sala->s_pisos        =  $request['s_pisos'];
                $sala->s_modificador  =   auth()->user()->name;
                $sala->save();
                Session::flash('message','Sala Actualizada Correctamente m');

            }

            if($otro[0]->total == 1){
                Session::flash('message','Ya se encuentra un registro con los mismos datos');   
                         
            }

            
            return $message;

        }
    }
    //falta organizar con la tabla reserva para la validacion
    public function salasDelete($id){
        $total = 0;
        $validar = Sala::where('s_pisos',$id)->get();

        if($validar != null){
            $total =  count($validar);
        }


        //dd($comprobar);
        if($total == 0){
            $torre = Pisos::destroy($id);
            Session::flash('message','Piso Eliminado Correctamente');
            return Redirect::to('/administrador/pisos-juzgados');
        }else{
            Session::flash('message','No se puede eliminar Piso, tiene salas asignados');
            return Redirect::to('/administrador/pisos-juzgados');
        }
    }
    /**Salas**/

}
