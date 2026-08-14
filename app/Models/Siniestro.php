<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    use HasFactory;
    protected $table = "siniestros";
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id',
		'num_caso',
        "despacho" ,
        "despacho_id" ,
        'correo_despacho',
        "direccion",
        "cedula",
        "nombre_usuario" ,
        "ciudad" ,
        "cargo",
        "telefono" ,
        "placa",
        "serial_equipo",
        "marca_equipo",
        "modelo_equipo",
        "falla_reportada",
        "diagnostico",
        "fecha_reporte",
        "informe_onsite",
        "reporte_tecnico",
        "reporte_aseguradora",
        "liquidacion_siniestro",
        "ingreso_almacen",
        "fecha_envio_admon",
        "tecnico_id",
        "nombre_tecnico",
        "aprobado",
        "num_siniestro_aseguradora",
        "fecha_de_pago_aseguradora",
        "observaciones",
        "estado_remision",
        "estado_siniestro"];
}
