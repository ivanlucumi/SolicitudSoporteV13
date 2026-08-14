<?php

namespace App\Http\Controllers\Inpec;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\SolicitudUsuario;
use App\Models\SolicitudAudiencia;
use App\Models\Detenido;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Carbon;


class InpeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('inpec');
    }
    
    public function index(Request $request){
        $fecha = Carbon::now()->toDateString();
        $citaciones = SolicitudAudiencia::where('fecha_prgramada','>=',$fecha)
        ->where('detenido',1)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        //$citaciones = Detenido::with('Audiencia')->get();
        //dd($citaciones);
        return view('inpec.index',compact('citaciones'));
    }
    
    public function citaciones(Request $request){
        $fecha = Carbon::now()->toDateString();
        $citaciones = SolicitudAudiencia::where('fecha_prgramada','>=',$fecha)->where('detenido',1)->get();
        //$citaciones = Detenido::with('Audiencia')->get();
        //dd($citaciones);
        return view('inpec.index',compact('citaciones'));
    }

}
