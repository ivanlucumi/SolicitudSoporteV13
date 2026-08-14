<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoporteUsuario extends Model
{
    use HasFactory;
    protected $table = "soporte_usuarios_pdf";
    protected $fillable = [
        "num_caso",
        "gestion",
        "tecnico_id",
        "estado_soporte",
        "fecha_solicitud",
        "hora_solicitud",
        "medio_solicitud" ,
        "seccional",
        "despacho" ,
        "despacho_id" ,
        'correo_despacho',
        "direccion",
        "cedula",
        "nombre" ,
        "apellido",
        "correo_empleado",
        "ciudad" ,
        "cargo",
        "telefono" ,
        "falla_reportada" ,
        "fecha_atencion" ,
        "hora_atencion",
        "nombre_tecnico",
        "tipo_servicio",
        "placa",
        "serial_equipo",
        "marca_equipo",
        "modelo_equipo",
        "sistema_operativo" ,
        "antivirus",
        "ver_antivirus",
        "agente_ivanti",
        "office",
        "equipo_dominio",
        "elementos_de_soporte",
        "requiere_repuesto",
        "tipo_elemento_de_soporte" ,
        "elemeto_soporte",
        "placa_soporte",
        "serial_equipo_soporte",
        "marca_equipo_soporte" ,
        "modelo_equipo_soporte",
        "sistema_operativo_soporte",
        "memoria_soporte",
        "disco_soporte",
        "procesador_soporte",
        "tipo_equipo_soporte" ,
        "nombre_equipo_soporte",
        "diagnostico" ,
        "solucion",
        "observacion_cliente",
        "observacion_tecnico",
        "disposicion",
        "conocimiento_tec",
        "tiempo_aten",
        "avance_caso",
        'firma',
        'firma_tecnico',

        ];
        
       public static function  tipoServicio()
 {
      $equipo=['OnSite'=>'OnSite','Remoto'=>'Remoto'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
 
      public static function  estadoServicio()
 {
      $equipo=['SOLUCIONADO'=>'SOLUCIONADO','GARANTIA'=>'GARANTIA','REPUESTO'=>'REPUESTO','PROVEEDOR'=>'PROVEEDOR','SINIESTRO'=>'SINIESTRO'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
}
