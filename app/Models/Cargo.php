<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Despacho;

class Cargo extends Model
{
    protected $fillable = [
        'despacho_judicial_id',
        'codigo_cargo',
        'codigo_cargo_nomina',
        'codigo_registro_elegibles',
        'nombre_cargo',
        'grado',
        'acogimiento',
        'id_ocurrencia_titular',
        'fecha_inicial_vinculacion',
        'estado_actual_propiedad',
        'estado_actual_provisionalidad'
        
    ];

    protected $casts = ['fecha_inicial_vinculacion' => 'date'];

    public function despachoJudicial()
    {
         return $this->belongsTo(Despacho::class, 'despacho_judicial_id');
    }

    public function escalafoneRegistros()
    {
        return $this->hasMany(EscalafonRegistro::class);
    }
}
