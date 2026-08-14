<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequerimientoDespacho extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    protected $table      = "requerimiento_despachos";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'despacho_id',
        'nombre_despacho',
        'email_despacho',
        'identificacion',
        'nombre_funcionario',
        'categoria',
        'tipo_solicitud',
        'observaciones',
    	'fecha_solicitud',
        'usuario_id',
        'evidencia_fotografica',
        'estado',
        'respuesta',
        'quien_atiende',
        'id_user',
        'fecha_cerrado',
        'segunda_visita',
        'fecha_visita'
    ];
    
    protected $dates = ['deleted_at'];
    
    
      public static function  Solicitud()
 {
      $equipo=['MOBILIARIO SALA DE AUDIENCIAS'=>'MOBILIARIO SALA DE AUDIENCIAS',
'ESCRITORIO EN L'=>'ESCRITORIO EN L',
'SILLA TIPO MAGISTRADO – JUEZ'=>'SILLA TIPO MAGISTRADO – JUEZ',
'SILLA ERGON&Oacute;MICA SENCILLA'=>'SILLA ERGON&Oacute;MICA SENCILLA',
'SILLA P&Uacute;BLICO'=>'SILLA P&Uacute;BLICO',
'PAPELERA'=>'PAPELERA',
'DESCANSA PIES'=>'DESCANSA PIES',
'VENTILADORES'=>'VENTILADORES',
'AIRE CONDICIONADO'=>'AIRE CONDICIONADO',
'COMPUTADORES'=>'COMPUTADORES',
'IMPRESORAS'=>'IMPRESORAS',
'ESC&Aacute;NER'=>'ESC&Aacute;NER',
'REGULADORES'=>'REGULADORES',
'EQUIPO TECNOL&Oacute;GICO SALA DE AUDIENCIAS'=>'EQUIPO TECNOL&Oacute;GICO SALA DE AUDIENCIAS',
'ESTANTER&Iacute;AS'=>'ESTANTER&Iacute;AS',
'OTRO'=>'OTRO'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
}
