<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudTrabajoRemoto extends Model
{
    use HasFactory;
    protected $table = "solicitudes_trabajo_remoto";
    protected $fillable = [
        'id_despacho',
        'email_despacho',
        'despacho',
        'id_funcionario',
        'funcionario_identificacion',
        'funcionario_nombre',
        'funcionario_apellido',
        'email_funcionario',
        'tipo_usuario',
        'tipo_solicitud',
        'solicitud',
        'formalizacion',
        'observaciones_revocado',
        'documento_revocado',
        'anuencia',
        'fecha_solicitud',
        'estado',
        'fecha_concepto',
        'viabilidad',
        'concepto_arl',
        'concepto_talento_humano',
        'pasar_arl',
        'documento_concepto',
        'lista',
        'estado_solicitud',
        'fecha_estado_solicitud',
        'observaciones',
        'id_teletrabajo',
        'seguimiento',
        'logs_de_acciones'

        ];
}
