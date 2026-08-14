<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Pisos extends Model
{
    //
    protected $table      = "pisos";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'p_nombre', 
    	'p_torre', 
    	'p_creador',
    	'p_modificador',
    ];

    public static function pisos(){
        $ver = DB::select('select pisos.id,pisos.p_nombre, torres.t_nombre as p_torre, p_creador, p_modificador  
            from pisos, torres
            where pisos.p_torre = torres.id
            order by pisos.p_torre, pisos.p_nombre');

        if($ver != null){
            return $ver;
        }else{
            return null;
        }
    }

    public static function Analisis($dato1, $dato2){
        $comprobar = DB::select('select count(*) as total from pisos where p_nombre = "'.$dato1.'" and p_torre = "'.$dato2.'"');

        if($comprobar != null){
        	return $comprobar;
        }else{
        	return 0;
        }

    }

    public static function Analisisor($dato1, $dato2, $dato3){
        $comprobar = DB::select('select count(*) as total from pisos where p_nombre = "'.$dato1.'" and p_torre = "'.$dato2.'" and id <> "'.$dato3.'"');

        if($comprobar != null){
            return $comprobar;
        }else{
            return 0;
        }

    }

    public static function Analisisid($dato1, $dato2, $dato3){
        $comprobar = DB::select('select count(*) as total from pisos where id = "'.$dato1.'" and p_nombre = "'.$dato2.'" and "'.$dato3.'" ');
        //dd($comprobar);
        if($comprobar != null){
            return $comprobar;
        }else{
            return 0;
        }

    }
}
