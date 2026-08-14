<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstadisticaDigitalizacion extends Model
{
    protected $table = "estadistica_digitalizacion";

    protected $fillable = ['id_despacho',
    'despacho',
    'email',
    'especialidad',
    'distrito',
    'ciudad',
    'digitalizacion_fisico',
    'folios',
    'procesos_digitalizados',
    'validacion_onedrive',
    'fecha_validacion_onedrive',
    'migracion_onedrive',
    'fecha_migracion_onedrive',
    'capacitacion',
    'fecha_capacitacion',
    'estrega_usuarios',
    'fecha_estrega_usuarios',
    'puesta_en_marcha'];
    
    public function scopeId_despacho($query, $id_despacho){
        //dd( $radicado);
        if($id_despacho != ""){
            $query->where('id_despacho', 'LIKE', '%' .$id_despacho.'%'  );
            //dd( $query);
        }
    }
    
    public function scopeDespacho($query, $despacho){
        //dd( $radicado);
        if($despacho != ""){
            $query->where('despacho',$despacho);
            //dd( $query);
        }
    }
    
    public function scopeEspecialidad($query, $especialidad){
        //dd( $radicado);
        if($especialidad != ""){
            $query->where('especialidad', $especialidad );
            //dd( $query);
        }
    }
    
    public function scopeDistrito($query, $distrito){
        //dd( $radicado);
        if($distrito != ""){
            $query->where('distrito',$distrito);
            //dd( $query);
        }
    }
    
    public function scopeCiudad($query, $ciudad){
        //dd( $radicado);
        if($ciudad != ""){
            $query->where('ciudad',$ciudad);
            //dd( $query);
        }
    }
    
     public static function  SumaTotal()
     {
     	$total = DB::select('select SUM(digitalizacion_fisico) AS total FROM `estadistica_digitalizacion` WHERE digitalizacion_fisico IS NOT null');
     	return $total;
     }
     public static function  Digitalizados()
     {
     	$total = DB::select('select SUM(procesos_digitalizados) AS total FROM `estadistica_digitalizacion` WHERE procesos_digitalizados IS NOT null');
     	return $total;
     }
     
      public static function  foliosR()
     {
     	$total = DB::select('select SUM(folios) AS total FROM `estadistica_digitalizacion` WHERE folios IS NOT null');
     	return $total;
     }
     
     public static function EspecialidadDespacho (){
        return $especialidad = array('ADMINISTRATIVO'=>'ADMINISTRATIVO',
        'CIVIL DEL CIRCUITO EJECUCION'=>'CIVIL DEL CIRCUITO EJECUCION',
        'CIVIL DEL CIRCUITO'=>'CIVIL DEL CIRCUITO',
        'CIVIL MUNICIPAL EJEC SENTENCIAS'=>'CIVIL MUNICIPAL EJEC SENTENCIAS',
        'CIVIL MUNICIPAL'=>'CIVIL MUNICIPAL',
        'EJECUCION DE PENAS Y MEDIDAS'=>'EJECUCION DE PENAS Y MEDIDAS',
        'FAMILIA DEL CIRCUITO'=>'FAMILIA DEL CIRCUITO',
        'LABORAL DEL CIRCUITO'=>'LABORAL DEL CIRCUITO',
        'MENORES'=>'MENORES',
        'PENAL ADOLESCENTES CIRCUITO'=>'PENAL ADOLESCENTES CIRCUITO',
        'PENAL ADOLESCENTES'=>'PENAL ADOLESCENTES',
        'PENAL DEL CIRCUITO ESPECIALIZADO'=>'PENAL DEL CIRCUITO ESPECIALIZADO',
        'PENAL DEL CIRCUITO'=>'PENAL DEL CIRCUITO',
        'PENAL MUNICIPAL'=>'PENAL MUNICIPAL',
        'PEQUEÑAS CAUSAS LABORALES'=>'PEQUEÑAS CAUSAS LABORALES',
        'PEQUEÑAS CAUSAS Y COMPETENCIA MULTIPLE'=>'PEQUEÑAS CAUSAS Y COMPETENCIA MULTIPLE',
        'PROMISCUO DE FAMILIA'=>'PROMISCUO DE FAMILIA',
        'PROMISCUO MUNICIPAL'=>'PROMISCUO MUNICIPAL',
        'RES TIERRAS'=>'RES TIERRAS',
        'SALA CIVIL FAMILIA'=>'SALA CIVIL FAMILIA',
        'SALA CIVIL'=>'SALA CIVIL',
        'SALA DISCIPLINARIA'=>'SALA DISCIPLINARIA',
        'SALA FAMILIA'=>'SALA FAMILIA',
        'SALA LABORAL'=>'SALA LABORAL',
        'SALA PENAL'=>'SALA PENAL',
        'TCA'=>'TCA',
        'TS TIERRAS'=>'TS TIERRAS'
        
        );
     }
     
     public static function validacionOd(){
         return $VoD = array('CUMPLE PROTOCOLO'=>'CUMPLE PROTOCOLO',
                             'NO CUMPLE PROTOCOLO'=>'NO CUMPLE PROTOCOLO');
    
     }
     
     public static function migracionOd(){
         return $VoD = array('MIGRADO'=>'MIGRADO',
                             'NO MIGRADO'=>'NO MIGRADO',
                             'RECHAZADO'=>'RECHAZADO');
    
     }
     
     public static function capacitacionE(){
         return $VoD = array('DICTADA'=>'DICTADA',
                             'APLAZADA'=>'APLAZADA');
    
     }

}
