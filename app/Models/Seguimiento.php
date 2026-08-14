<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Seguimiento extends Model
{
    //
      protected $table = "seguimientos";
   
    protected $fillable = [
    	'idReporte',
        'seccional',
    	'presentacion', 
    	'solucion', 
    	'cargo_tecnico',
    	'estado',
    	'id_placa',
    	'observaciones'
    ];


    public static function verHistorial(){

        $seguimiento = DB::select('
            select  
                t.id,
                t.seccional,
                t.presentacion,
                t.solucion,
                t.cargo_tecnico,
                t.estado,
                t.id_placa,
                t.observaciones,
                su.radicado,
                su.idUser as despacho,
                su.idEmpleado,
                su.edificio,
                su.idrequerimiento,
                su.idcategorias,
                su.elementos,
                su.descripcion,
                su.tecnico,
                su.fecha_visita,
                su.estado_solicitud
            from 
                seguimientos as t
            inner join solicitud_usuarios as su
                    on t.idReporte = su.id ');

        return $seguimiento;

    }

    public static function verHistorialId($id){

        $seguimiento = DB::select('
            select  
                t.id,
                t.seccional,
                t.presentacion,
                t.solucion,
                t.cargo_tecnico,
                t.estado,
                t.id_placa,
                t.observaciones,
                su.radicado,
                su.idUser as despacho,
                su.idEmpleado,
                su.edificio,
                su.idrequerimiento,
                su.idcategorias,
                su.elementos,
                su.descripcion,
                su.tecnico,
                su.fecha_visita,
                su.estado_solicitud
            from 
                seguimientos as t
            inner join solicitud_usuarios as su
                    on t.idReporte = su.id 
            where
                t.id ='.$id);

        return $seguimiento;

    }
    
     public static function buscarHistorialBD($fechai, $fechaf){

        $seguimiento = DB::select('
            select  
                t.id,
                t.seccional,
                t.presentacion,
                t.solucion,
                t.cargo_tecnico,
                t.estado,
                t.id_placa,
                t.observaciones,
                su.radicado,
                su.idUser as despacho,
                su.idEmpleado,
                su.edificio,
                su.idrequerimiento,
                su.idcategorias,
                su.elementos,
                su.descripcion,
                su.tecnico,
                su.fecha_visita,
                su.estado_solicitud
            from 
                seguimientos as t
            inner join solicitud_usuarios as su
                    on t.idReporte = su.id 
            where 
                su.fecha_visita
            between "'.$fechai.'" and  "'.$fechaf.'"');

        if($seguimiento != null){
            return $seguimiento;
        }else{
            return null;
        }

    }


  
}
