<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoEnUnoInstalacion extends Model
{
    //
    protected $table = "todo_en_uno_instalacion";
    protected $primaryKey = 'id';
    protected $fillable = [
				    	'fecha_instalacion',
             			'seccional',
             			'nombre_contacto',
             			'numero_cedula',
             			'usuario_dominio',
             			'correo_personal_inst',
             			'ciudad',
             			'direccion',
             			'telefono',
             			'email',
             			'id_despacho',
             			'despacho',
             			'placa_equipo',
             			'serial_equipo',
             			'marca',
             			'modelo',
             			'placa_teclado',
             			'serial_teclado',
             			'placa_mouse',
             			'serial_mouse',
             			//'tipo_instalacion',
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
