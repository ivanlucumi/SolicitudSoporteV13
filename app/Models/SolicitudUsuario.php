<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SolicitudUsuario extends Model
{
    //

    protected $table = "solicitud_usuarios";
    protected $fillable = ['radicado','idUser','idEmpleado','codigoDespacho','edificio','idrequerimiento','idcategorias','elementos','descripcion','tecnico','fecha_visita','estado_solicitud','tiempo'];

    public static function solicitudesEnviadas($id)
            {
                           /* $Solicitud = DB::select('
                            select 
                                solicitud_usuarios.radicado,
                                empleados.nameE, 
                                empleados.lastnameE,
                                solicitud_usuarios.edificio,
                                tipo_requerimientos.nombreRequerimiento,
                                categorias.descripcioncategoria, 
                                solicitud_usuarios.elementos, 
                                solicitud_usuarios.descripcion,
                                users.name, users.lastname, 
                                solicitud_usuarios.fecha_visita
                            FROM 
                                solicitud_usuarios, 
                                users,
                                empleados,
                                tipo_requerimientos,
                                categorias,
                                elementos
                            WHERE 
                                users.id = solicitud_usuarios.tecnico AND
                                empleados.id = solicitud_usuarios.idEmpleado AND
                                tipo_requerimientos.id = solicitud_usuarios.idrequerimiento AND
                                categorias.id = solicitud_usuarios.idcategorias AND
                                ISNULL(solicitud_usuarios.estado_solicitud) AND
                                solicitud_usuarios.idUser = '.$id.'
                            ORDER BY 
                                solicitud_usuarios.created_at DESC');*/

               /* $solicitud = DB::table('solicitud_usuarios')
                            ->select('solicitud_usuarios.radicado','solicitud_usuarios.edificio','solicitud_usuarios.elementos','solicitud_usuarios.descripcion','solicitud_usuarios.fecha_visita','empleados.nameE','empleados.lastnameE','tipo_requerimientos.nombreRequerimiento','categorias.descripcioncategoria','users.name','users.lastname')
                            ->join()*/

                $Solicitud = DB::select('
                    select 
                        su.id,
                        su.radicado,
                        emp.nameE, 
                        emp.lastnameE,
                        su.edificio,
                        tr.nombreRequerimiento,
                        cat.descripcioncategoria, 
                        su.elementos, 
                        su.descripcion,
                        tec.name, tec.lastname, 
                        su.fecha_visita
                    FROM 
                        solicitud_usuarios as su,
                        users as tec,
                        empleados as emp,
                        tipo_requerimientos as tr,
                        categorias as cat
                    WHERE   
                        su.tecnico = tec.id AND
                        su.idEmpleado = emp.id AND
                        su.idrequerimiento = tr.id AND
                        su.idcategorias = cat.id  AND
                        su.idUser = '.$id.'

                    ORDER BY
                        su.created_at DESC
                    ');

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

//se crea la relacion de Solicitud con los elementos para llamar este metodo en el index del controller y mejorar la consulta al igual que enla vista donde aparece lo que necesitamos mostrar
public function elementosSoli()
    {
       return $this->belongsToMany(Elemento::class,'elementos_solicitud');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }

//se crea la relacion de Solicitud con el usuario para llamar este metodo en el index del controller y mejorar la consulta al igual que enla vista donde aparece lo que necesitamos mostrar
public function usuarioSoli()
    {
       return $this->belongsTo(User::class,'idUser');/* se utilisa idUser porque asi llega el dato de la solicitud y ese es el id que cosultamos en la tabla Users*/
    }

public function empleadoSoli()
    {
       return $this->belongsTo(Empleado::class,'idEmpleado');/* se utilisa idUser porque asi llega el dato de la solicitud y ese es el id que cosultamos en la tabla Users*/
    }

//se crea la relacion de Solicitud con la categoria para llamar este metodo en el index del controller y mejorar la consulta al igual que enla vista donde aparece lo que necesitamos mostrar
public function categoriaSoli()
    {
       return $this->belongsTo(Categoria::class,'idcategorias');
    }
//se crea la relacion de Solicitud con el tiporequerimiento para llamar este metodo en el index del controller y mejorar la consulta al igual que enla vista donde aparece lo que necesitamos mostrar
public function requerimientoSoli()
    {
       return $this->belongsTo(TipoRequerimiento::class,'idrequerimiento');
    }
public function despachoSoli()
    {
       return $this->belongsTo(Despacho::class,'codigoDespacho');
    }

public function AtSoli()
    {
       return $this->belongsTo(TiempoAtencion::class,'tiempo');
    }

}
