<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoReparto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OficinaJudicialReparto extends Model
{
    //
    protected $table      = "oficina_judicial_repartos";
    protected $primaryKey = 'id';
    protected $fillable   = [
    'seguimiento',
    'especialidad',	
    'nombre_especialidad',
    'grupo',
    'nombre_grupo',
    'demandante',
    'demandado',
    'contacto',
    'correo_notif_ddo',
    'cedulaA',
    'nombreA',
    'tarjetaP',
    'cuaderno',
    'folios',
    'observaciones',
    'demanda',
    'poder',
    'anexos',
    'url_anexos',
    'email',
    'oficinaReparto',
    'acta_reparto',
    'asignado_a',
    'reparto_asignado_a',
    'estado',
    'rechazo',
    'traslado',
    'fecha_recibido',
    'fecha_traslado',
    'fecha_rechazo',
    'fecha_reparto',
    'codigo_despacho',
    'despacho',
    'radicacion',
    'conocimiento_previo'
    
    
];

 
  public function Espec()
    {
       return $this->belongsTo(GrupoReparto::class,'especialidad');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
    public function nombreOfi()
    {
       return $this->belongsTo(Reparto::class,'nombre_grupo');
    }
    
     public function Operario()
    {
       return $this->belongsTo(User::class,'asignado_a');
    }
    
    public static function TotalEnvioReparto()
 {
     $total = DB::select('select count(*) as total FROM `oficina_judicial_repartos` ');
     return $total;
 //	$agendadores = DB::select('select quien_asigno, count(email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias WHERE updated_at BETWEEN "'.$fechai.'"  and "'.$fechaf.'"  AND quien_asigno IS NOT NULL  GROUP BY quien_asigno');
 //	return $agendadores;
     
 }
 
    public static function TotalAsignado()
 {
     $total = DB::select('select count(*) as asignado FROM `oficina_judicial_repartos` where asignado_a is not null and acta_reparto is  null AND reparto_asignado_a is null ');
     return $total;
 //	$agendadores = DB::select('select quien_asigno, count(email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias WHERE updated_at BETWEEN "'.$fechai.'"  and "'.$fechaf.'"  AND quien_asigno IS NOT NULL  GROUP BY quien_asigno');
 //	return $agendadores;
     
 }
 
    public static function TotalConReparto()
 {
     $total = DB::select('select count(*) as reparto FROM `oficina_judicial_repartos` where asignado_a is not null and acta_reparto is not null AND reparto_asignado_a is not null ');
     return $total;
 //	$agendadores = DB::select('select quien_asigno, count(email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias WHERE updated_at BETWEEN "'.$fechai.'"  and "'.$fechaf.'"  AND quien_asigno IS NOT NULL  GROUP BY quien_asigno');
 //	return $agendadores;
     
 }
 
     public static function TotalFaltantes()
 {
     $total = DB::select('select count(*) as faltante FROM `oficina_judicial_repartos` where asignado_a is null and acta_reparto is  null AND reparto_asignado_a is  null ');
     return $total;
 //	$agendadores = DB::select('select quien_asigno, count(email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias WHERE updated_at BETWEEN "'.$fechai.'"  and "'.$fechaf.'"  AND quien_asigno IS NOT NULL  GROUP BY quien_asigno');
 //	return $agendadores;
     
 }
 
 public static function TotalOperarios(){
    $agendadores = DB::select('select oficina_judicial_repartos.asignado_a,   count(oficina_judicial_repartos.email) as cantidad, (select name from users where users.id = oficina_judicial_repartos.asignado_a) as name from oficina_judicial_repartos GROUP BY asignado_a');
 	return $agendadores;
 }
 
  public static function TotalDespachos(){
    $agendadores = DB::select('select  count(oficina_judicial_repartos.oficinaReparto) as cantidad, (select name from users where users.email = oficina_judicial_repartos.oficinaReparto) as name from oficina_judicial_repartos GROUP BY oficinaReparto');
 	return $agendadores;
 }

 public static function TotalOperarioMes(){
   	 $despachoEstadistica = DB::select('select oficina_judicial_repartos.asignado_a, count(oficina_judicial_repartos.email) as cantidad, (select name from users where users.id = oficina_judicial_repartos.asignado_a) as name from oficina_judicial_repartos where fecha_reparto like "%'.Carbon::now()->format('Y-m').'%" GROUP BY asignado_a');
    return $despachoEstadistica;
 }
 
 public static function TotalOperarioMesFechas($fechai,$fechaf){
   	 $despachoEstadistica = DB::select('select oficina_judicial_repartos.asignado_a, count(oficina_judicial_repartos.email) as cantidad, (select name from users where users.id = oficina_judicial_repartos.asignado_a) as name from oficina_judicial_repartos where fecha_reparto BETWEEN "'.$fechai.'"  and "'.$fechaf.'" GROUP BY asignado_a');
    return $despachoEstadistica;
 }
 
 
    public static function  Gr_Reparto()
 {
      $reparto=['01 SENTENCIAS APELADAS EN PROCESOS ORDINARIOS'=>'01 SENTENCIAS APELADAS EN PROCESOS ORDINARIOS',
      '02 SENTENCIAS CONSULTADAS EN PROCESOS ORDINARIOS'=>'02 SENTENCIAS CONSULTADAS EN PROCESOS ORDINARIOS',
      '03 AUTOS APEL. EN PROCES. ORDINARIOS-FUEROS SINDICALES'=>'03 AUTOS APEL. EN PROCES. ORDINARIOS-FUEROS SINDICALES',
      '04 APELACION DE SENTENCIAS EN FUERO SINDICAL'=>'04 APELACION DE SENTENCIAS EN FUERO SINDICAL',
      '05 AUTOS APELADOS EN PROCESOS EJECUTIVOS'=>'05 AUTOS APELADOS EN PROCESOS EJECUTIVOS',
      '06 HOMOLOGACIONES'=>'06 HOMOLOGACIONES',
      '07 VARIOS(Conflictos de Competencia, Recursos de Queja-Otros)'=>'07 VARIOS(Conflictos de Competencia, Recursos de Queja-Otros)',
      '08 TUTELAS PRIMERA INSTANCIA'=>'08 TUTELAS PRIMERA INSTANCIA',
      '09 IMPUGNACION DE TUTELAS'=>'09 IMPUGNACION DE TUTELAS',
      '10 IMPUGNACION HABEAS CORPUS'=>'10 IMPUGNACION HABEAS CORPUS',
      '11 ACOSO LABORAL'=>'11 ACOSO LABORAL',
      '12 CALIF. DE SUSPENSION O PARO COLECTIVO DE TRABAJO'=>'12 CALIF. DE SUSPENSION O PARO COLECTIVO DE TRABAJO',
      '13 RECURSO DE REVISION'=>'13 RECURSO DE REVISION',
      '14 CONSULTA DESACATO EN TUTELAS'=>'14 CONSULTA DESACATO EN TUTELAS',];
      //ksort($reparto);
      return $reparto = collect($reparto);
      
 }


}


