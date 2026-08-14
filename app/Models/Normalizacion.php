<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Normalizacion extends Model
{
    protected $table = "normalizacion";
    protected $fillable = [
                        'despacho_id',
				    	'despacho',
                        'radicacion',
                        'folios',
                        'inidice',
                        'repositorio',
                        'revisado_por',
                        'id_user',
                        'fecha_revision',
                        'mes',
                        'observaciones'
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