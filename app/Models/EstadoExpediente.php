<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoExpediente extends Model
{
    use HasFactory;
    protected $table = "estado_expedientes";

    protected $fillable = [
    'id',
    'radicado',
    'ni',
    'cedula_procesado',
    'nombre_procesado',
    'delito',
    'sede',
    'almacenado_en',
    'no_caja',
    'cuadernos',
    'folios',
    'tipo_expediente',
    'fecha_digitalizado',
    'asunto_archivo',
    'fecha_archivo',
    'observaciones',
    'estado',
    'creado_por'
    ];


    public static function  Sedes()
    {
         $sede=['ARCHIVO CENTRAL'=>'ARCHIVO CENTRAL','BRITILANA'=>'BRITILANA','SOTANO TORRE B'=>'SOTANO TORRE B','PISO 3- TORRE B'=>'PISO 3- TORRE B',
         'PISO 5- TORRE B'=>'PISO 5- TORRE B','PISO 2 - TORRE A CSJ'=>'PISO 2 - TORRE A CSJ','OTRO'=>'OTRO','ARCHIVO ESCANEADO'=>'ARCHIVO ESCANEADO'];
         ksort($sede);
         return $sedes = collect($sede);

    }


    public static function  TipoEmpaque()
    {
         $empaque=['CAJA'=>'CAJA','CINTA'=>'CINTA','OTRO'=>'OTRO'];
         ksort($empaque);
         return $empaques = collect($empaque);

    }

    public static function  TipoProceso()
    {
         $empaque=['FISICO'=>'FISICO','DIGITAL'=>'DIGITAL','OTRO'=>'OTRO'];
         ksort($empaque);
         return $empaques = collect($empaque);

    }

    public static function  AsuntoArchivo()
    {
         $asunto=['PRECLUSIONES'=>'PRECLUSIONES',
         'ABSOLUTORIO'=>'ABSOLUTORIO',
         'ARCHIVO DEFINITIVO'=>'ARCHIVO DEFINITIVO',
         'PAGANDO PENA'=>'PAGANDO PENA',
         'CENTRAL ESCANEADO'=>'CENTRAL ESCANEADO',
         'ACTIVAS'=>'ACTIVAS',
         'EXTINCION DE LA CONDENA' =>'EXTINCION DE LA CONDENA',
         'PENA CUMPLIDA' =>'PENA CUMPLIDA',
         'EXTINCION PENA' =>'EXTINCION PENA',
         'PENA CUMPILDA' =>'PENA CUMPILDA',
         'PRESCRIPCION DE LA PENA'=>'PRESCRIPCION DE LA PENA',
        'ACUMULACION DE PENAS'=>'ACUMULACION DE PENAS',
        'PENDIENTE EXTINCION DE PENA'=>'PENDIENTE EXTINCION DE PENA',
        'EXTINCION POR PRESCRIPCION'=>'EXTINCION POR PRESCRIPCION', 
        'PRESCRIPCION DE LA PENA'=>'PRESCRIPCION DE LA PENA',
        'EXTINCION POR MUERTE'=>'EXTINCION POR MUERTE',
        'EXTINCION DE LA PENA POR MUERTE'=>'EXTINCION DE LA PENA POR MUERTE',
        'PRECLUSION POR MUERTE'=>'PRECLUSION POR MUERTE',
        'SENTENCIA ABSOLUTORIA'=>'SENTENCIA ABSOLUTORIA',
        'PRECLUSION POR PRESCRIPCION'=>'PRECLUSION POR PRESCRIPCION', 
        'ABSOLUCION'=>'ABSOLUCION',
        'PRECLUSION POR ATIPICIDAD'=>'PRECLUSION POR ATIPICIDAD',
        'PRECLUSION'=>'PRECLUSION', 
        'EXTINCION DE LA CONDENA POR MUERTE'=>'EXTINCION DE LA CONDENA POR MUERTE',
        'TERMINADO POR ORDEN JUDICIAL'=>'TERMINADO POR ORDEN JUDICIAL',
        'LIBERTAD INMEDIATA'=>'LIBERTAD INMEDIATA',
        'EXTINCION POR MUERTE'=>'EXTINCION POR MUERTE',
        'JUZGADO PIERDE COMPETENCIA'=>'JUZGADO PIERDE COMPETENCIA',
        'VENCIMIENTO TERMINOS'=>'VENCIMIENTO TERMINOS'];
         ksort($asunto);
         return $asuntos = collect($asunto);

    }
    
    public function scopeRadicado($query, $radicado){
        //dd( $cuidad);
        if($radicado){
            $query->where('radicado',$radicado);
            //dd( $query);
        }
    }

    public function scopeProcesado($query, $procesado){
        //dd( $cuidad);
        if($procesado){
            $query->where('cedula_procesado','LIKE', '%' .$procesado.'%');
            //dd( $query);
        }
    }

    public function scopeNombre($query, $nombre){
        //dd( $entidad);
        if($nombre){
            $query->where('nombre_procesado','LIKE', '%' .$nombre.'%' );
            //dd( $query);
        }
    }
    
    public function scopeNi($query, $ni){
        //dd( $entidad);
        if($ni){
            $query->where('ni',$ni);
            //dd( $query);
        }
    }
    public function scopeCaja($query, $caja){
        //dd( $entidad);
        if($caja){
            $query->where('no_caja',$caja);
            //dd( $query);
        }
    }

}
