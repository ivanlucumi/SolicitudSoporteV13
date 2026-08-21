<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EncuestaSiniestroFoto extends Model
{
    use HasFactory;

    protected $table = 'encuesta_siniestro_fotos';

    protected $fillable = [
        'elemento_id',
        'ruta_archivo',
        'nombre_archivo',
        'tamanio',
        'mime_type',
    ];

    // ─── Relaciones ────────────────────────────────────────────────────────────

    public function elemento()
    {
        return $this->belongsTo(EncuestaSiniestroElemento::class, 'elemento_id');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    /**
     * URL pública de la foto
     */
    public function getUrlAttribute(): string
    {
        $container = 'siniestro';
        return "https://" . env('AZURE_STORAGE_ACCOUNT') . ".blob.core.windows.net/{$container}/{$this->ruta_archivo}";
    }

    /**
     * Ruta absoluta del archivo (ahora apunta a Azure)
     */
    public function getRutaAbsolutaAttribute(): string
    {
        return $this->url;
    }

    /**
     * Contenido base64 para incrustar en PDF
     */
    public function getBase64Attribute(): ?string
    {
        try {
            // Se asume que el contenedor Azure tiene acceso público (Blob public access)
            $contenido = @file_get_contents($this->url);
            if ($contenido) {
                $mime = $this->mime_type ?: 'image/jpeg';
                return 'data:' . $mime . ';base64,' . base64_encode($contenido);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Error leyendo foto de Azure para PDF: {$this->url}");
        }
        return null;
    }
}
