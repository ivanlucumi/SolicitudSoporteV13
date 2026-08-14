<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ControlDigitalizacionSinRevisar extends Model
{
    protected $table = "control_digitalizacion_sin_revisar";
    protected $fillable = [
				    	'radicacion',
                         'despacho',
                         'estado',
                         'municipio',
                         'especialidad',
                         'cantidad',
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
                         'correccion',
                         'segunda_revision',
                         'fecha_revision',
    						];
    						
    						
   /* public function ControIngresos()
    {
       return $this->belongsToMany(ControlIngreso::class,'identificacion');// se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos 
    }*/
    
     public function scopeRadicado($query, $radicado){
        //dd( $radicado);
        if($radicado != ""){
            $query->where('radicacion', $radicado);
            //dd( $query);
        }
    }
    
    public function scopeMunicipio($query, $municipio){
        //dd( $radicado);
        if($municipio != ""){
            $query->where('municipio', 'LIKE', '%' .$municipio.'%' );
            //dd( $query);
        }
    }
    
    public function scopeEspecialidad($query, $especialidad){
        //dd( $radicado);
        if($especialidad != ""){
            $query->where('especialidad', 'LIKE', '%' .$especialidad.'%');
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
    
     public static function estadisticaDigitalizacionMes($nombre)
 {
 	$agendadores = DB::select('select count(reviso) as cantidad, reviso as name from control_digitalizacion WHERE  reviso LIKE  "%'.$nombre.'%" GROUP BY reviso');
 	return $agendadores;
     
 }
 
 //resultado inventario digitalizacion
 public static function InventarioDigitalizacion(){
     $inventario =  DB::select('SELECT radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente ,(select nombreCiudad from ciudades where ciudades.codigoCiudad = registro_digitalizacion.ciudad) as ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho');
     return $inventario;
 }
 
    
}
