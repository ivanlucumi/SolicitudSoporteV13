<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraVenta extends Model
{
    use HasFactory;
    
    protected $table = "clasificados";
    protected $fillable = [
				    	'id_despacho',
             			'despacho',
				    	'correo_despacho',
             			'categoria',
				    	'producto',
             			'modelo',
				    	'kilometraje',
             			'especificaciones',
				    	'caracteristicas',
             			'foto_1',
				    	'foto_2',
             			'foto_3',
				    	'contacto_telefono',
             			'contacto_correo',
				    	'ip_publicacion',
				    	'fecha_eliminacion',
    						];
    
    
    
    
     public static function  Categoria()
 {
      $equipo=['VEHICULO'=>'VEHICULO','TECNOLOGIA'=>'TECNOLOGIA','INMUEBLE'=>'INMUEBLE','TECNOLOGIA'=>'TECNOLOGIA','OTRO'=>'OTRO'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
}
