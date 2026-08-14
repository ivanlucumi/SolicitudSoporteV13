<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class MigracionBestdoc extends Model
{
    protected $table = "control_migracion_bestdoc";
    protected $fillable = [
				    	'radicacion',
                        'despacho',
                        'municipio',
                        'especialidad',
                        'cantidad',
                        'estado',
                        'calidad',
                        'asignado_a',
                        'reviso',
                        'fecha_traslado',
                        'repetido_en_excel'
    						];
    						

      public function scopeRadicado($query, $radicado){
        //dd( $radicado);
        if($radicado != ""){
            $query->where('radicacion', $radicado);
            //dd( $query);
        }
    }
    
    public function scopeDespacho($query, $despacho){
        //dd( $radicado);
        if($despacho != ""){
            $query->where('despacho',$despacho );
            //dd( $query);
        }
    }
 
    
}
