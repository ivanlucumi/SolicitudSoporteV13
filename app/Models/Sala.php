<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sala extends Model
{
    //
    protected $table      = "salas";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	's_nombre', 
    	's_pisos', 
    	's_creador',
    	's_modificador',
    ];

    public static function salas(){
        $ver = DB::select('select salas.id, pisos.p_nombre as s_pisos, torres.t_nombre as torre, salas.s_nombre, salas.s_creador, salas.s_modificador  
            FROM salas, pisos, torres
            where salas.s_pisos = pisos.id
            and pisos.p_torre = torres.id
            order by pisos.p_torre, salas.s_pisos, salas.s_nombre');
        //dd($ver);
        if($ver != null){
            return $ver;
        }else{
            return null;
        }
    }

    public static function pluckSala(){
    	//$ver = DB::select('select  concat(torres.t_nombre,"   ",pisos.p_nombre) as organizado from pisos, torres where pisos.p_torre = torres.id')->lists('organizado','pisos.id');

        $ver = DB::table('pisos')

        ->select(DB::raw('CONCAT(torres.t_nombre, ", ", pisos.p_nombre) AS organizado'),'pisos.id')
        ->join('torres', 'torres.id', '=', 'pisos.p_torre')
        ->orderBy('pisos.p_torre')
        ->pluck('organizado','pisos.id');
        //dd($ver);
    	if($ver != null){
    		return $ver;
    	}else{
    		return null;
    	}
    }

    public static function salasPisospluck(){
        //$ver = DB::select('select  concat(torres.t_nombre,"   ",pisos.p_nombre) as organizado from pisos, torres where pisos.p_torre = torres.id')->lists('organizado','pisos.id');

        $ver = DB::table('salas')

        ->select(DB::raw('CONCAT(pisos.p_nombre, ", ", salas.s_nombre) AS organizado'),'salas.id')
        ->join('pisos', 'pisos.id', '=', 'salas.s_pisos')
        //->orderBy('salas.s_pisos','salas.s_nombre','ASC')
        ->pluck('organizado','salas.id');
        //dd($ver);
        if($ver != null){
            return $ver;
        }else{
            return null;
        }
    }

    

    public static function Analisis($dato1, $dato2){
        $comprobar = DB::select('select count(*) as total from salas where s_nombre = "'.$dato1.'" and s_pisos = "'.$dato2.'"');

        if($comprobar != null){
            return $comprobar;
        }else{
            return 0;
        }

    }

     public static function Analisisor($dato1, $dato2, $dato3){
        $comprobar = DB::select('select count(*) as total from salas where s_nombre = "'.$dato1.'" and s_pisos = "'.$dato2.'" and id <> "'.$dato3.'"');

        if($comprobar != null){
            return $comprobar;
        }else{
            return 0;
        }

    }

    public static function Analisisid($dato1, $dato2, $dato3){
        $comprobar = DB::select('select count(*) as total from salas where id = "'.$dato1.'" and s_nombre = "'.$dato2.'"  ');
        //dd($comprobar);
        if($comprobar != null){
            return $comprobar;
        }else{
            return 0;
        }

    }
}
