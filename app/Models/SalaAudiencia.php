<?php

namespace App\Models;

use App\Models\Ubicacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaAudiencia extends Model
{
    use HasFactory;

    protected $table = "sala_audiencias";

    protected $fillable = [
        'ubicacion_id',
        'sala_nombre',
        'estado',
        'user_id',
    ];
    
    
       public function Ubicacion()
    {
       return $this->belongsTo(Ubicacion::class,'ubicacion_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
    
}


