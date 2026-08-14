<?php

namespace App\Services;

use App\Models\SolicitudServicio;
use Illuminate\Support\Facades\DB;
use App\Services\FileManagerService;

class SolicitudService
{
    protected $fileManager;

    public function __construct(FileManagerService $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * Create a new service request and attach files
     */
    public function createSolicitud(array $data, array $files = [], $userId = null)
    {
        return DB::transaction(function () use ($data, $files, $userId) {
            
            $solicitud = SolicitudServicio::create(array_merge($data, [
                'estado' => 'CREADA',
            ]));

            // Registrar en el historial
            $solicitud->historiales()->create([
                'usuario_id' => $userId,
                'usuario_nombre' => $data['solicitante_nombre'] ?? 'Usuario',
                'accion' => 'CREACION',
                'estado_nuevo' => 'CREADA',
                'comentario' => 'El usuario ha creado la solicitud de soporte.',
            ]);

            // Procesar archivos si existen
            if (!empty($files)) {
                $this->fileManager->storeMultiple($files, $solicitud, $userId);
            }

            return $solicitud;
        });
    }

    /**
     * Resolve a service request by the admin
     */
    public function resolveSolicitud(SolicitudServicio $solicitud, array $data, array $files = [], $adminId = null, $adminName = null)
    {
        return DB::transaction(function () use ($solicitud, $data, $files, $adminId, $adminName) {
            
            $estadoAnterior = $solicitud->estado;
            $nuevoEstado = 'RESUELTA';

            $solicitud->update([
                'respuesta' => $data['respuesta'],
                'estado' => $nuevoEstado,
                'responsable_id' => $adminId,
                'responsable_nombre' => $adminName,
                'fecha_solucion' => now(),
            ]);

            // Registrar en historial
            $solicitud->historiales()->create([
                'usuario_id' => $adminId,
                'usuario_nombre' => $adminName,
                'accion' => 'RESOLUCION',
                'estado_anterior' => $estadoAnterior,
                'estado_nuevo' => $nuevoEstado,
                'comentario' => 'El administrador ha respondido y resuelto la solicitud.',
            ]);

            // Procesar archivos de respuesta si existen
            if (!empty($files)) {
                $this->fileManager->storeMultiple($files, $solicitud, $adminId);
            }

            return $solicitud;
        });
    }
}
