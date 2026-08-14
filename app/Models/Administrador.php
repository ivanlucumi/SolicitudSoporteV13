<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Administrador extends Model
{
    //
     public static function getSolicitud()
    {
       		 $Solicitud = DB::select('select
       		 	solicitud_usuarios.radicado AS radicado,
       		 	solicitud_usuarios.id AS id,
    		    solicitud_usuarios.edificio AS edificio,
    		    solicitud_usuarios.descripcion AS descripcion,
    		    users.name AS usuario,
    		    empleados.nameE AS nombre,
    		    empleados.lastnameE AS apellido,
    		    tipo_requerimientos.nombreRequerimiento AS nombrerequerimiento,
    		    categorias.descripcioncategoria AS categoria,
                solicitud_usuarios.elementos AS nombreelemento,
                tiempo_atencions.prioridad AS prioridad,
                tiempo_atencions.maximoD AS dias
    		FROM
    		    solicitud_usuarios,
    		    users,
    		    empleados,
    		    tipo_requerimientos,
    		    tiempo_atencions,
    		    categorias
    		WHERE
    		    users.id = solicitud_usuarios.idUser AND empleados.id = solicitud_usuarios.idEmpleado AND tipo_requerimientos.id = solicitud_usuarios.idrequerimiento AND categorias.id = solicitud_usuarios.idcategorias AND categorias.prioridad = tiempo_atencions.id AND ISNULL(solicitud_usuarios.tecnico) AND ISNULL(solicitud_usuarios.fecha_visita) ');
    
       
         if ($Solicitud!=null) {
                return $Solicitud;
            }else{
                return null;
            }
    }

  

    public static function getSolicitudAsignada($id)
    {
   		 $Solicitud = DB::select('select
   		 	solicitud_usuarios.radicado AS radicado,
   		 	solicitud_usuarios.id AS id,
		    solicitud_usuarios.edificio AS edificio,
		    solicitud_usuarios.descripcion AS descripcion,
		    users.name AS usuario,
		    empleados.nameE AS nombre,
		    empleados.lastnameE AS apellido,
		    tipo_requerimientos.nombreRequerimiento AS nombrerequerimiento,
		    categorias.descripcioncategoria AS categoria,
            solicitud_usuarios.elementos AS nombreelemento,
            tiempo_atencions.prioridad AS prioridad,
            tiempo_atencions.maximoD AS dias
		FROM
		    solicitud_usuarios,
		    users,
		    empleados,
		    tipo_requerimientos,
		    tiempo_atencions,
		    categorias
		WHERE
		    users.id = solicitud_usuarios.idUser
		     AND empleados.id = solicitud_usuarios.idEmpleado AND tipo_requerimientos.id = solicitud_usuarios.idrequerimiento AND categorias.id = solicitud_usuarios.idcategorias AND categorias.prioridad = tiempo_atencions.id AND ISNULL(solicitud_usuarios.estado_solicitud) AND  solicitud_usuarios.tecnico ='.$id);

    if ($Solicitud!=null) {
            return $Solicitud;
        }else{
            return null;
        }
}

 public static function getSolicitudId($id)
 {
 		$Solicitud = DB::select('select solicitud_usuarios.radicado AS radicado,
 			solicitud_usuarios.id AS id,
 			solicitud_usuarios.created_at AS fechaCreacion,
		    solicitud_usuarios.edificio AS edificio,
		    solicitud_usuarios.descripcion AS descripcion,
		    solicitud_usuarios.elementos AS elementos,
		    users.cedula as IdUser,
            despachos.telefono AS telefono,
            despachos.correoD AS correo,
		    users.name AS usuario,
		    empleados.cedulaE AS cedula,
		    empleados.nameE AS nombre,
		    empleados.lastnameE AS apellido,
		    tipo_requerimientos.nombreRequerimiento AS nombrerequerimiento,
		    categorias.descripcioncategoria AS categoria,
            tiempo_atencions.prioridad AS prioridad,
            tiempo_atencions.maximoD AS dias,
		    solicitud_usuarios.elementos AS nombreelemento
		FROM
		    solicitud_usuarios,
		    users,
            despachos,
		    empleados,
		    tipo_requerimientos,
            tiempo_atencions,
		    categorias
		WHERE
          users.id = solicitud_usuarios.idUser AND 
          empleados.id = solicitud_usuarios.idEmpleado AND
          tipo_requerimientos.id = solicitud_usuarios.idrequerimiento AND
          categorias.id = solicitud_usuarios.idcategorias AND
          despachos.codigoDespacho = users.cedula AND
          categorias.prioridad = tiempo_atencions.id  AND
          solicitud_usuarios.id ='.$id);
          
    if ($Solicitud!=null) {
            return $Solicitud;
        }else{
            return null;
        }
    //return $Solicitud;
 }

 public static function  getinventario($id)
 {
 	$inventario = DB::select('select solicitud_usuarios.elementos as elementos FROM solicitud_usuarios WHERE solicitud_usuarios.id ='.$id);
 	return $inventario;
 }

  public static function  Inventario()
 {
 	$inventario = DB::select('select elementos.id as id, elementos.nombreElemento as nombre FROM `elementos` WHERE 1');
 	return $inventario;
 }

 public static function selectEmpleados()
 {
 	$select =User::select(DB::raw('CONCAT(name,"   ",lastname) as name'),'id')->where('rol',1)->orwhere('rol',2)->get()->pluck('name','id');
 	return $select;

 }


public static function estadisticaDespacho()
 {
 	$despachoEstadistica = DB::select('select codigo_despacho, email, count(email) as cantidad, (select name from users where users.cedula = solicitud_audiencias.codigo_despacho) as name  from solicitud_audiencias GROUP BY email,codigo_despacho');
 	return $despachoEstadistica;

 }
 
 public static function estadisticaAgendadores()
 {
     //'select reservasalas.*, (select nombreDespacho from despachos where despachos.codigoDespacho = reservasalas.rs_codigo_juzgado)
 	$agendadores = DB::select('select solicitud_audiencias.quien_asigno,   count(solicitud_audiencias.email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias GROUP BY quien_asigno');
 	return $agendadores;
     
 }
 
 public static function estadisticaDespachoMes($mes)
 {
 	$despachoEstadistica = DB::select('select codigo_despacho, email, count(email) as cantidad, (select name from users where users.cedula = solicitud_audiencias.codigo_despacho) as name from solicitud_audiencias WHERE fecha_prgramada LIKE "'.$mes.'%" GROUP BY email,codigo_despacho');
 	return $despachoEstadistica;

 }
 
 public static function estadisticaAgendadoresMes($mes)
 {
 	$agendadores = DB::select('select quien_asigno, count(email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias WHERE updated_at LIKE "'.$mes.'%" AND quien_asigno IS NOT NULL GROUP BY quien_asigno');
 	return $agendadores;
     
 }
 
 public static function estadisticaDespachoMesF($fechai,$fechaf)
 {
 	 $despachoEstadistica = DB::select('select codigo_despacho, email, count(email) as cantidad,
    (select name from users where users.cedula = solicitud_audiencias.codigo_despacho) as name
    from solicitud_audiencias
    WHERE fecha_prgramada = "'.$fechai.'"  and fecha_prgramada "'.$fechaf.'" GROUP BY email,codigo_despacho');
    //dd($despachoEstadistica);
    return $despachoEstadistica;

 }
 
 public static function estadisticaAgendadoresMesF($fechai,$fechaf)
 {
 	$agendadores = DB::select('select quien_asigno, count(email) as cantidad, (select name from users where users.id = solicitud_audiencias.quien_asigno) as name from solicitud_audiencias WHERE fecha_solicitud  BETWEEN "'.$fechai.'"  and "'.$fechaf.'"  AND quien_asigno IS NOT NULL  GROUP BY quien_asigno');
 	return $agendadores;
     
 }
 
  public static function despachosCertificados()
 {
 	$personalCertificado  = DB::select("select cedula,email, name FROM `users` WHERE  certifico_personal = 1");
 	return $personalCertificado;
     
 }
 
 public static function estadisticaDigitalizacionMes()
 {
 	$agendadores = DB::select('select count(reviso) as cantidad, reviso as name from control_digitalizacion WHERE  reviso IS NOT NULL GROUP BY reviso');
 	return $agendadores;
     
 }
 //PROTOCOLO 2 2022
  public static function estadisticaDigitalizacionMesPDos2022()
 {
 	//$agendadores = DB::select('select count(reviso) as cantidad, reviso as name from control_digitalizacion_proto_dos WHERE  reviso IS NOT NULL AND fecha_revision like "%2022%" GROUP BY reviso');
 	//return $agendadores;
 	
 	$agendadores = DB::select('SELECT COUNT(reviso) as cantidad, reviso as name, SUM(cantidad) as folios FROM `control_digitalizacion_proto_dos` WHERE reviso IS NOT NULL AND fecha_revision like "%2022%" GROUP BY reviso');
 	return $agendadores;
     
 }
  //PROTOCOLO 2 2022 totalidad de folios
  public static function totalidadFolios()
 {
 	$agendadores = DB::select('SELECT  SUM(cantidad) as folios FROM `control_digitalizacion_proto_dos`');
 	//dd($agendadores[0]->folios);
 	return  intval($agendadores[0]->folios);
 }
 
  //PROTOCOLO 2 2022 totalidad de folios revisados
  public static function totalidadFoliosRevisados()
 {
 	$agendadores = DB::select('SELECT  SUM(cantidad) as folios FROM `control_digitalizacion_proto_dos` where reviso is not null and fecha_revision like "%2022%"');
 	//dd($agendadores[0]->folios);
 	return  intval($agendadores[0]->folios);
 }
 //PROTOCOLO 2 2021
  public static function estadisticaDigitalizacionMesPDos2021()
 {
 	$agendadores = DB::select('select count(reviso) as cantidad, reviso as name from control_digitalizacion_proto_dos WHERE  reviso IS NOT NULL AND fecha_revision like "%2021%" GROUP BY reviso');
 	return $agendadores;
     
 }

  //PROTOCOLO 2 por fecha
  public static function estadisticaDigitalizacionPDosDia($fechaR)
 {
 	$ValoresDia = DB::select('select count(reviso) as cantidad, reviso as name from control_digitalizacion_proto_dos WHERE fecha_revision ="'.$fechaR.'" AND  reviso IS NOT NULL GROUP BY reviso');
 	return $ValoresDia;
     
 }
 
 //conteo de revision de servisoft
  public static function estadisticaRevisionServisof()
 {
 	$revision = DB::select('select count(reviso_servisoft) as cantidad, reviso_servisoft as name from control_digitalizacion WHERE  reviso_servisoft IS NOT NULL GROUP BY reviso_servisoft');
 	return $revision;
     
 }
 
  //conteo de revision de servisoft PROTOCOLO 2
  public static function estadisticaRevisionServisofPDos()
 {
 	$revision = DB::select('select count(reviso_servisoft) as cantidad, reviso_servisoft as name from control_digitalizacion_proto_dos WHERE  reviso_servisoft IS NOT NULL GROUP BY reviso_servisoft');
 	return $revision;
     
 }
 
 //conteo total de procesos almacenados en la db
 
 public static function TotalDigitalizacion()
 {
 	$total = DB::select('select count(*) as total FROM `control_digitalizacion` WHERE 1 ');
 	return $total;
     
 }
 
 //conteo total de procesos almacenados en la db PROTOCOLO 2
 
 public static function TotalDigitalizacionPDos()
 {
 	$total = DB::select('select count(*) as total FROM `control_digitalizacion_proto_dos` ');
 	return $total;
     
 }
 
 //resultado inventario digitalizacion
 public static function InventarioDigitalizacion(){
     $inventario =  DB::select('SELECT radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho');
     return $inventario;
 }
 
 

}
