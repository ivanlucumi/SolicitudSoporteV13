<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ControlDigitalizacionProtoDos extends Model
{
    protected $table = "control_digitalizacion_proto_dos";
    protected $fillable = [
                        'codigo_despacho',
				    	'radicacion',
                         'despacho',
                         'municipio',
                         'especialidad',
                         'cantidad',
                         'estado',
                         'calidad',
                         'cantidad_archivos_m',
                        'observaciones_archivos_m',
                        'cantidad_archivos_multimedia_m',
                        'observaciones_archivos_multimedia_m',
                        'carpetas_comprimidas_m',
                        'carpetas_protocolodos_m',
                        'observaciones_generales_m',
                        'cantidad_archivos_b',
                        'observaciones_archivos_b',
                        'numero_archivos_multimedia_b',
                        'observaciones_archivos_multimedia_b',
                        'carpetas_comprimidas_b',
                        'carpetas_protocolodos_b',
                        'observaciones_generales_b',
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
                         'reviso_id',
                         'reviso',
                         'fecha_revision',
                         'reprocesar',
                         'transferido'
    						];
    						

    
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
            $query->where('despacho','LIKE', '%' .$despacho.'%' );
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
    
     public function scopeCalidad($query, $calidad){
        //dd( $radicado);
        if($calidad != ""){
            $query->where('calidad','<=',$calidad );
           //dd( $query);
        }
    }
    
     public static function estadisticaDigitalizacionMes($nombre)
 {
 	$agendadores = DB::select('select count(reviso_id) as cantidad, reviso as name from control_digitalizacion_proto_dos WHERE  reviso_id =  '.$nombre.' AND fecha_revision LIKE  "%2023%" GROUP BY reviso');
 	//dd($agendadores);
 	return $agendadores;
     
 }
 
 //CONTEO TRABAJO SERVISOFT
    public static function ConteoUser($user){
     $inventario =  DB::select('select count(reviso_servisoft) as cantidad from control_digitalizacion_proto_dos WHERE reviso_servisoft LIKE "%'.$user.'%" GROUP BY reviso_servisoft ');
           return $inventario;

 }
 
 //resultado inventario digitalizacion
 public static function InventarioDigitalizacion(){
     $inventario =  DB::select('SELECT radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente ,(select nombreCiudad from ciudades where ciudades.codigoCiudad = registro_digitalizacion.ciudad) as ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho');
     return $inventario;
 }
 
    
}
