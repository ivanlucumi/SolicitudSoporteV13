<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ContratoNovedad extends Model
{
    // Conexión a otra base de datos definida en config/database.php 
        protected $connection = 'mysql_contratos'; 
    
    protected $table = 'contrato_novedades';

    protected $fillable = [
        'contrato_id',
        'descripcion',
        'fecha',
        'usuario_id'
    ];

    protected $casts = [
        'fecha' => 'date'
    ];

    /**
     * Relación con contrato
     */
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }
}
