<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\EstadoExpediente;

class EstadoExpedientePrestamo extends Model
{
    use HasFactory;

    protected $table = "estado_expedientes_prestamo";

    protected $fillable = ['id',
    'id_expediente',
    'prestado_a_cedula',
    'prestado_a_nombre',
    'id_despacho',
    'prestado_a_despacho',
    'prestado_a_fecha',
    'observaciones',
    'user_id',
    'quien_presta',
    'fecha_devolucion',
    'quien_devuelve',
    'estado'
    ];

    public function Expediente(){
        return $this->belongsTo(EstadoExpediente::class,'id_expediente');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
        }
}
