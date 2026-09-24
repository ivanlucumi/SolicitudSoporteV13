<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones_circulares';

    protected $fillable = [
        'tipo_publicacion',
        'numero_acta',
        'fecha',
        'asunto',
        'archivo_pdf'
    ];

}
