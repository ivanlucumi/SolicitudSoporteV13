<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BiometriaIngreso;
use App\Models\User;

class BiometriaIngresoRegistro extends Model
{
    use HasFactory;

    protected $table = 'biometria_ingresos_registro';
    protected $fillable = [
        'biometria_ingresos_id',
        'acccion',
        'fecha',
        'fecha_ingreso',
        'hora_ingreso',
        'id_porteria',
        'direccion_ingreso',
        'fecha_salida',
        'hora_salida',
        'porteria_salida'];
        
        
        public function Ingreso(){
    return $this->belongsTo(BiometriaIngreso::class,'biometria_ingresos_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
        public function Porteria(){
    return $this->belongsTo(User::class,'id_porteria');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
