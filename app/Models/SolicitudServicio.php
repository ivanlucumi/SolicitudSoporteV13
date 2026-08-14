<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudServicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'solicitudes_servicio';

    protected $fillable = [
        'uuid',
        'numero_solicitud',
        'dependencia_id',
        'dependencia_nombre',
        'dependencia_email',
        'solicitante_identificacion',
        'solicitante_nombre',
        'tipo_solicitud',
        'medio_solicitud',
        'descripcion',
        'respuesta',
        'estado',
        'responsable_id',
        'responsable_nombre',
        'fecha_solucion',
    ];

    protected $casts = [
        'fecha_solucion' => 'datetime',
    ];

    /**
     * Boot function to generate UUID and numero_solicitud
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) \Illuminate\Support\Str::uuid();
            }
            if (empty($model->numero_solicitud)) {
                $lastId = static::max('id') ?? 0;
                $model->numero_solicitud = 'REQ-' . date('Y') . '-' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Get all attachments for this request.
     */
    public function archivos()
    {
        return $this->morphMany(ArchivoAdjunto::class, 'attachable');
    }

    /**
     * Get the history of the request.
     */
    public function historiales()
    {
        return $this->hasMany(SolicitudHistorial::class, 'solicitud_id')->orderBy('created_at', 'desc');
    }
}
