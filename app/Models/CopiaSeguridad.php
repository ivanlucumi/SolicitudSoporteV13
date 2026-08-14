<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CopiaSeguridad extends Model
{
    
     // Conexión a otra base de datos definida en config/database.php
    protected $connection = 'mysql_copias'; 
    
    
    protected $table      = "copia_servidores_db";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'fecha_copia',
        'nombre_servidor',
        'base_datos',
        'carpeta',
    	'estado',
    	'observaciones',
    	'copia_azure',
    	'observaciones_azure',
    	'firma_quien_verifica'
    ];
    
     // �9�5 Accesor para traer el nombre del usuario desde la otra BD
    public function getNombreUsuarioAttribute()
    {
        return DB::connection('mysql')
                 ->table('users')
                 ->where('id', $this->firma_quien_verifica)
                 ->value(DB::raw("CONCAT(name, ' ', lastname)"));
    }
   
    
}
