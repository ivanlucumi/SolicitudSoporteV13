<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Validator;

use App\Models\Eleccion;

class EleccionController extends Controller
{
    public function index(Request $request){

        if(empty($request->all()) ){
         $funcionario=null;   
        }else{
         $funcionario=Eleccion::where('cedula',$request->cedula)->first(); 
        // dd($funcionario); 
        }
        
        return view('externo.elecciones.index',compact('funcionario')); 
    }
}
