<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ComodatoImpresora;

class InventarioImpresoraComodato extends Model
{
    protected $table      = "inventario_impresoras_comodato";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'num_caja',
        'serie',
        'marca',
        'modelo',
        'estado',
        'observaciones',
    	'tecnico_id',
        'instalacion_comodato_id',
    ];
    
   public function Intalacion()
    {
       return $this->belongsTo(ComodatoImpresora::class,'instalacion_comodato_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
