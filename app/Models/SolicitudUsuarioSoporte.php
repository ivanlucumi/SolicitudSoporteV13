<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SolicitudUsuarioSoporte extends Model
{
    use HasFactory;

    protected $table = "solicitud_usuario_soportes";
    protected $fillable = [
        'id_despacho',
        'email_despacho',
        'despacho',
        'id_funcionario',
        'medio_solicitud',
        'funcionario',
        'tipo_solicitud',
        'solicitud',
        'anexo',
        'acta',
        'fecha_solicitud',
        'respuesta',
        'estado',
        'fecha_solucion',
        'id_user',
        'quien_da_solucion'

];

public static function  tipo_solicitud()
{
     $equipo=['CREACION CORREO ELECTRONICO'=>'CREACION CORREO ELECTRONICO','CREACION USUARIO DOMINIO'=>'CREACION USUARIO DOMINIO',/*'SOPORTE CORREO ELECTRONICO'=>'SOPORTE CORREO ELECTRONICO','SOPORTE PAGINA WEB'=>'SOPORTE PAGINA WEB',
     'CREACION USUARIO BESTDOC'=>'CREACION USUARIO BESTDOC','SOPORTE BESTDOC'=>'SOPORTE BESTDOC',*/'MERCURIO'=>'MERCURIO','SOPORTE USUARIO DOMINIO'=>'SOPORTE USUARIO DOMINIO',
    'BANCO AGRARIO'=>'BANCO AGRARIO','JUSTICIA XXI'=>'JUSTICIA XXI','TYBA (JUSTICIA XXI WEB)'=>'TYBA (JUSTICIA XXI WEB)','SOPORTE SGDE'=>'SOPORTE SGDE','CREACION USUARIO SGDE'=>'CREACION USUARIO SGDE','INTERNET'=>'INTERNET','SALAS DE AUDIENCIA'=>'SALAS DE AUDIENCIA',
    'VPN (USUARIO REMOTO)'=>'VPN (USUARIO REMOTO)','SOLICITUD FIRMA ELECTRONICA'=>'SOLICITUD FIRMA ELECTRONICA','OTRO'=>'OTRO'];
    
    //orden ascendente
    ksort($equipo);
    //var_export($equipo);
    
     return $equipos = collect($equipo);
     
}

public static function  tipo_solicitud_remoto()
{
     $equipo=['SOLICITUD DE TELETRABAJO'=>'SOLICITUD DE TELETRABAJO'];
    
    //orden ascendente
    ksort($equipo);
    //var_export($equipo);
    
     return $equipos = collect($equipo);
     
}

public static function  medio_solicitud()
{
     $equipo=['TELEFONO'=>'TELEFONO','CELULAR'=>'CELULAR','WHATSAPP'=>'WHATSAPP','PRESENCIAL'=>'PRESENCIAL'];
    
    //orden ascendente
    ksort($equipo);
    //var_export($equipo);
    
     return $equipos = collect($equipo);
     
}

public static function  tipo_usuario()
{
     $equipo=['FUNCIONARIO'=>'FUNCIONARIO','EMPLEADO'=>'EMPLEADO'];
    
    //orden ascendente
    ksort($equipo);
    //var_export($equipo);
    
     return $equipos = collect($equipo);
     
}

//tipo_viabilidad_remoto
public static function  tipo_viabilidad_remoto()
{
     $equipo=['SI'=>'SI','NO'=>'NO','CONDICIONADA'=>'CONDICIONADA'];
    
    //orden ascendente
    ksort($equipo);
    //var_export($equipo);
    
     return $equipos = collect($equipo);
     
}
public static function  estado()
{
     $equipo=['APROBADO'=>'APROBADO','DENEGADO'=>'DENEGADO'];
    
    //orden ascendente
    ksort($equipo);
    //var_export($equipo);
    
     return $equipos = collect($equipo);
     
}


 public static function estadisticaFuncionario($tipo = null)
 {
 	$agendadores = DB::select('select id_user,count(id) as cantidad, (select name from users where users.id = solicitud_usuario_soportes.id_user) as nombre FROM `solicitud_usuario_soportes` GROUP BY id_user');
 	return $agendadores;
 }
 
  public static function estadisticaFuncionarioFechas($fechai,$fechaf, $tipo = null)
 {
 	$agendadores = DB::select('select id_user,count(id) as cantidad, (select name from users where users.id = solicitud_usuario_soportes.id_user) as nombre FROM `solicitud_usuario_soportes`
 	WHERE DATE(fecha_solicitud) >= ? and DATE(fecha_solicitud) <= ?
 	GROUP BY id_user', [$fechai, $fechaf]);
 	return $agendadores;
 }
 
 public static function estadisticaFuncionarioMes($fechai,$fechaf)
 {
 	$despachoEstadistica = DB::select('select id_user,count(id) as cantidad, (select name from users where users.id = solicitud_usuario_soportes.id_user) as nombre 
 	FROM `solicitud_usuario_soportes` 
    WHERE DATE(fecha_solicitud) >= ? and DATE(fecha_solicitud) <= ?
 	GROUP BY id_user', [$fechai, $fechaf]);
 	return $despachoEstadistica;
 }
 
  public static function estadisticaTipoSolicitud($tipo = null)
 {
 	$agendadores = DB::select('select tipo_solicitud, COUNT(id) as cantidad FROM `solicitud_usuario_soportes` GROUP by tipo_solicitud');
 	return $agendadores;
 }
 public static function estadisticaTipoSolicitudFechas($fechai,$fechaf)
 {
 	$agendadores = DB::select('select tipo_solicitud, COUNT(id) as cantidad FROM `solicitud_usuario_soportes` 
 	WHERE DATE(fecha_solicitud) >= ? and DATE(fecha_solicitud) <= ?
 	GROUP by tipo_solicitud', [$fechai, $fechaf]);
 	return $agendadores;
 }
 
 
 // app/Models/SolicitudUsuarioSoporte.php
public function getRespuestaFormateadaAttribute()
{
    if (!$this->respuesta) {
        return '';
    }

    // Ajusta imágenes para que carguen rápido y no desborden
    return preg_replace(
        [
            '/<img(.*?)>/i',
            '/<img(.*?)style="(.*?)"(.*?)>/i'
        ],
        [
            '<img loading="lazy"$1 style="max-width:100%;height:auto;">',
            '<img$1style="$2;max-width:100%;height:auto;"$3>'
        ],
        $this->respuesta
    );
}

 

   
}
