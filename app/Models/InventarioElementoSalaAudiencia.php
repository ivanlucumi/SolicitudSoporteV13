<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioElementoSalaAudiencia extends Model
{
    use HasFactory;

    protected $table = 'inventario_elementos_sala_audiencia';

    protected $fillable = [
        'sala_id',
        'elemento_id',
        'cantidad',
        'estado',
        'observaciones',
        'id_user',
    ];

    // Relaciones
    public function sala()
    {
        return $this->belongsTo(InventarioSalaAudiencia::class, 'sala_id');
    }

    public function elemento()
    {
        return $this->belongsTo(Elemento::class, 'elemento_id');
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
