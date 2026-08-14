<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ControlDigitalizacion extends Model
{
    protected $table = "control_digitalizacion";
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
                         'reviso_servisoft',
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
    
     public function scopeCantidad($query, $cantidad){
        //dd( $radicado);
        if($cantidad != ""){
            $query->where('cantidad','<=',$cantidad );
           //dd( $query);
        }
    }
    
     public static function estadisticaDigitalizacionMes($nombre)
 {
 	$agendadores = DB::select('select count(reviso) as cantidad, reviso as name from control_digitalizacion WHERE  reviso LIKE  "%'.$nombre.'%" GROUP BY reviso');
 	return $agendadores;
     
 }
 
 //CONTEO TRABAJO SERVISOFT
    public static function ConteoUser($user){
     $inventario =  DB::select('select count(reviso_servisoft) as cantidad from control_digitalizacion WHERE reviso_servisoft LIKE "%'.$user.'%" GROUP BY reviso_servisoft ');
           return $inventario;

 }
 
 //resultado inventario digitalizacion
 public static function InventarioDigitalizacion(){
     $inventario =  DB::select('SELECT radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente ,(select nombreCiudad from ciudades where ciudades.codigoCiudad = registro_digitalizacion.ciudad) as ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho');
     return $inventario;
 }
 
    
}
