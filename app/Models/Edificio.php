<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;

    protected $table = "edificios";

    protected $fillable = [
        'ciudad_id',
        'nombre_edificio',
        'estado',
        'user_id',
    ];
    
       public function ciudad()
    {
       return $this->belongsTo(Ciudad::class,'ciudad_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
