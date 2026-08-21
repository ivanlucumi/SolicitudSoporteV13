<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Servicio para comprimir y almacenar imágenes de la Encuesta de Siniestros.
 * Reutiliza la lógica de compresión del ReporteFallasController.
 */
class ImagenSiniestroService
{
    /**
     * Ancho máximo de redimensionado (px)
     */
    protected int $maxAncho = 800;

    /**
     * Calidad JPEG (0-100)
     */
    protected int $calidadJpeg = 70;

    /**
     * Procesa y guarda una imagen comprimida.
     *
     * @param  UploadedFile  $file
     * @param  string        $codigoDespacho
     * @param  int           $elementoId
     * @return array{ruta: string, nombre: string, tamanio: int, mime: string}
     */
    public function guardar(UploadedFile $file, string $codigoDespacho, int $elementoId): array
    {
        @ini_set('memory_limit', '256M');
        @ini_set('max_execution_time', '120');

        $mime = $file->getMimeType();
        
        // Obtener el tipo de elemento para nombrar el archivo
        $elemento = \App\Models\EncuestaSiniestroElemento::find($elementoId);
        $tipoElemento = $elemento ? $elemento->tipo_elemento : 'Elemento';
        $tipoLimpio = preg_replace('/[^A-Za-z0-9\-]/', '_', $tipoElemento);
        
        $nombreOriginal = "{$codigoDespacho}_{$tipoLimpio}_" . time() . '.jpg';
        
        $carpeta = "EncuestaSiniestro/{$codigoDespacho}/{$elementoId}";
        $rutaRelativa = "{$carpeta}/{$nombreOriginal}";
        $rutaCompleta = storage_path("app/public/{$rutaRelativa}");

        // Crear directorio si no existe
        $dir = dirname($rutaCompleta);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        if (str_starts_with($mime, 'image/')) {
            $image = $this->cargarImagen($file->getRealPath(), $mime);

            if ($image) {
                // Corregir orientación EXIF
                $image = $this->corregirExif($image, $file->getRealPath(), $mime);
                // Redimensionar
                $image = $this->redimensionar($image);
                // Guardar como JPEG
                imagejpeg($image, $rutaCompleta, $this->calidadJpeg);
                imagedestroy($image);
                $tamanio = filesize($rutaCompleta) ?: 0;
                return [
                    'ruta'    => $rutaRelativa,
                    'nombre'  => $nombreOriginal,
                    'tamanio' => $tamanio,
                    'mime'    => 'image/jpeg',
                ];
            }
        }

        // Fallback: guardar sin comprimir (para PDF/documentos)
        Storage::disk('public')->put($rutaRelativa, file_get_contents($file->getRealPath()));
        return [
            'ruta'    => $rutaRelativa,
            'nombre'  => $file->getClientOriginalName(),
            'tamanio' => $file->getSize(),
            'mime'    => $mime,
        ];
    }

    /**
     * Elimina una foto del disco
     */
    public function eliminar(string $rutaRelativa): void
    {
        if (Storage::disk('public')->exists($rutaRelativa)) {
            Storage::disk('public')->delete($rutaRelativa);
        }
    }

    // ─── Métodos privados ──────────────────────────────────────────────────────

    private function cargarImagen(string $path, string $mime): mixed
    {
        return match(true) {
            in_array($mime, ['image/jpeg', 'image/jpg']) => @imagecreatefromjpeg($path),
            $mime === 'image/png'                         => @imagecreatefrompng($path),
            $mime === 'image/gif'                         => @imagecreatefromgif($path),
            $mime === 'image/webp'                        => @imagecreatefromwebp($path),
            default                                       => null,
        };
    }

    private function corregirExif(mixed $image, string $path, string $mime): mixed
    {
        if (!in_array($mime, ['image/jpeg', 'image/jpg'])) {
            return $image;
        }
        if (!function_exists('exif_read_data')) {
            return $image;
        }
        $exif = @exif_read_data($path);
        if ($exif && isset($exif['Orientation'])) {
            $image = match($exif['Orientation']) {
                3 => imagerotate($image, 180, 0),
                6 => imagerotate($image, -90, 0),
                8 => imagerotate($image, 90, 0),
                default => $image,
            };
        }
        return $image;
    }

    private function redimensionar(mixed $image): mixed
    {
        $ancho = imagesx($image);
        $alto  = imagesy($image);

        if ($ancho <= $this->maxAncho) {
            return $image;
        }

        $nuevoAncho = $this->maxAncho;
        $nuevoAlto  = (int) floor($alto * ($this->maxAncho / $ancho));

        $nueva = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

        // Preservar transparencia
        imagealphablending($nueva, false);
        imagesavealpha($nueva, true);
        $transparente = imagecolorallocatealpha($nueva, 255, 255, 255, 127);
        imagefilledrectangle($nueva, 0, 0, $nuevoAncho, $nuevoAlto, $transparente);

        imagecopyresampled($nueva, $image, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
        imagedestroy($image);

        return $nueva;
    }
}
