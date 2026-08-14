<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComodatoImpresora extends Model
{
    //
    protected $table = "instalacion_impresoras_comodato";
    protected $primaryKey = 'id';
    protected $fillable = [
				    	'fecha_instalacion',
             			'seccional',
             			'nombre_contacto',
             			'numero_cedula',
             			'ciudad',
             			'direccion',
             			'telefono',
             			'email',
             			'id_despacho',
             			'despacho',
             			'placa_equipo',
             			'serial',
             			'marca',
             			'modelo',
             			'tipo_instalacion',
             			'ip',
             			'descripcion_servicio',
             			'observaciones',
             			'entrega',
             			'recibe',
             			'id_user',
             			'firma_funcionario'
    						];
    						
    public static function  TipoInstalacion()
 {
      
      $tipo=['Red'=>'Red','Usb'=>'Usb'];
      ksort($tipo);
      return $tipos = collect($tipo);
      
 }
 
 protected $hidden = [
        'firma_funcionario'
    ];
 
}
