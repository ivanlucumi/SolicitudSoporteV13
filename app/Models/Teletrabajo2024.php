<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teletrabajo2024 extends Model
{
    use HasFactory;
    protected $table = "teletrabajo_2024";
    protected $fillable = [
        'corporacion',
        'seccional',
        'especialidad',
        'codigo_despacho',
        'despacho',
        'correo_despacho',
        'direccion_teletrabajo',
        'estado',
        'estado_solicitud',
        'fecha_solicitud',
        'municipio',
        'municipio_teletrabajo',
        'identificacion',
        'nombre_servidor',
        'cargo',
        'celular',
        'correo_personal',
        'correo_institucional',
        'departamento_teletrabajo',
        'nombre_nominador',
        'identidad_nominador',
        'cargo_nominador',
        'tipo_servidor_judicial',
        'anuencia_nominador',
        'correo_nominador',
        'departamento_judicial',
        'favorable',
        'fecha_anuencia',
        'fecha_firma_servidor',
        'fecha_formalizacion',
        'fecha_posecion',
        'genero',
        'lactante',
        'dias_teletrabajo',
        'observaciones_visita',
        'vigencia_solicitud'

        ];
        
        
      
        
        
}