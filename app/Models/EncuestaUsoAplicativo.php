<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaUsoAplicativo extends Model
{
    use HasFactory;

    protected $table = "encuesta_uso_aplicativos";

    protected $fillable = [
        'despacho_id',
        'despacho',
        'email_despacho',
        'aplicativo',
        'cantidadExpedientesSgde',
        'capacitacionsgde',
        'problemas_sgde',
        'otros_sgde',
        'cantidadExpedientesSiugj',
        'problemasiugj',
        'novedades_siugj',
        'otros_problemasiugj',
        'cantidadExpedientesOneDrive',
        'cantidadExpedientesSharePoint'
        
    ];
}