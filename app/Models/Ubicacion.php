<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Edifico;
use Illuminate\Support\Facades\DB;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = "ubicaciones";

    protected $fillable = [
        'edificio_id',
        'ubicacion_nombre',
        'estado',
        'user_id',
    ];
    
      public function ciudad()
    {
       return $this->belongsTo(Edificio::class,'edificio_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
