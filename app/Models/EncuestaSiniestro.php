<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaSiniestro extends Model
{
    use HasFactory;

    protected $table = 'encuesta_siniestros';

    protected $fillable = [
        'consecutivo',
        'despacho_codigo',
        'despacho_nombre',
        'despacho_correo',
        'despacho_ciudad',
        'despacho_direccion',
        'titular_nombre',
        'titular_cedula',
        'titular_cargo',
        'titular_correo',
        'titular_telefono',
        'empleados_json',
        'fecha_siniestro',
        'observaciones_generales',
        'estado',
        'pdf_path',
        'pdf_generado_at',
        'correo_enviado',
        'correo_enviado_at',
        'correo_destinatarios',
        'correo_error',
        'user_id',
        'url_fotos',
        'firma_empleado',
    ];

    protected $casts = [
        'empleados_json'   => 'array',
        'correo_enviado'   => 'boolean',
        'fecha_siniestro'  => 'date',
        'pdf_generado_at'  => 'datetime',
        'correo_enviado_at'=> 'datetime',
    ];

    // ─── Relaciones ────────────────────────────────────────────────────────────

    public function elementos()
    {
        return $this->hasMany(EncuestaSiniestroElemento::class, 'encuesta_siniestro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Genera el próximo consecutivo con formato SIN-YYYYMMDD-NNNN
     */
    public static function generarConsecutivo(): string
    {
        $fecha = now()->format('Ymd');
        $prefijo = "SIN-{$fecha}-";

        $ultimo = static::where('consecutivo', 'LIKE', "{$prefijo}%")
            ->orderByDesc('id')
            ->lockForUpdate()
            ->first();

        if ($ultimo) {
            $partes = explode('-', $ultimo->consecutivo);
            $numero = (int) end($partes) + 1;
        } else {
            $numero = 1;
        }

        return $prefijo . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Label legible del estado
     */
    public function getEstadoLabelAttribute(): string
    {
        return match($this->estado) {
            'borrador'    => 'Borrador',
            'registrado'  => 'Registrado',
            'enviado'     => 'Enviado',
            'en_revision' => 'En revisión',
            'cerrado'     => 'Cerrado',
            default       => ucfirst($this->estado),
        };
    }

    /**
     * Badge color según estado
     */
    public function getEstadoBadgeAttribute(): string
    {
        return match($this->estado) {
            'borrador'    => 'default',
            'registrado'  => 'primary',
            'enviado'     => 'success',
            'en_revision' => 'warning',
            'cerrado'     => 'danger',
            default       => 'default',
        };
    }

    /**
     * ¿Se puede editar?
     */
    public function puedeEditar(): bool
    {
        return in_array($this->estado, ['borrador', 'registrado']);
    }
}
