<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ControlDigitalizacionPdf extends Model
{
    protected $table = "control_digitalizacion_pdf";
    protected $fillable = [
				    	'radicacion',
                         'despacho',
                         'municipio',
                         'especialidad',
                         'cantidad',
                         'estado',
                         'llave_digitos_23',
                         'no_pdf',
                         'visor',
                         'cd',
                         'ver_video',
                         'indice',
                         'ver_exp_completo',
                         'observaciones',
                         'demandante',
                         'demandado',
                         'tipificacion',
                         'reviso',
                         'fecha_revision',
    						];
    						
    						
   /* public function ControIngresos()
    {
       return $this->belongsToMany(ControlIngreso::class,'identificacion');// se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos 
    }*/
    
    public static function ConteoUser($user){
     $inventario =  DB::select('select count(reviso_servisoft) as cantidad, reviso as name from control_digitalizacion WHERE reviso_servisoft LIKE "%'.$user.'%"  ');
     return $inventario;
 }
    
}
