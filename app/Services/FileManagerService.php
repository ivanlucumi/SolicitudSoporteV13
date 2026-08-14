<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\ArchivoAdjunto;
use Illuminate\Database\Eloquent\Model;

class FileManagerService
{
    /**
     * @param UploadedFile $file
     * @param Model $attachable
     * @param int|null $userId
     * @param string $disk
     * @return ArchivoAdjunto
     */
    public function storeAndAttach(UploadedFile $file, Model $attachable, $userId = null, $disk = 'local')
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mime = $file->getClientMimeType();
        $size = $file->getSize();

        // Generar un UUID para el nombre del archivo para ofuscarlo en disco
        $uuidName = Str::uuid() . '.' . $extension;

        // Subir archivo (por ejemplo, a storage/app/soportes/YYYY/MM/)
        $folder = 'soportes/' . date('Y/m');
        
        $path = $file->storeAs($folder, $uuidName, $disk);

        // Registrar en base de datos
        return $attachable->archivos()->create([
            'nombre_original'   => $originalName,
            'nombre_almacenado' => $uuidName,
            'ruta'              => $path,
            'mime_type'         => $mime,
            'peso_bytes'        => $size,
            'usuario_id'        => $userId,
        ]);
    }

    /**
     * Helper para procesar múltiples archivos
     */
    public function storeMultiple(array $files, Model $attachable, $userId = null, $disk = 'local')
    {
        $attachments = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $attachments[] = $this->storeAndAttach($file, $attachable, $userId, $disk);
            }
        }
        return $attachments;
    }
}
