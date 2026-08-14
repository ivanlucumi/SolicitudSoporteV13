<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Models\BiometriaIngreso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use Carbon\Carbon;

class AzureBiometriaController extends Controller
{
    protected $blobClient;
    protected $containerName;
    protected $lote = 100; // Tamaño del lote: puedes ajustar según capacidad del servidor

    public function __construct()
    {
        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $this->containerName = env('AZURE_STORAGE_CONTAINER');
        $this->blobClient = BlobRestProxy::createBlobService($connectionString);
    }

    /**
     * Procesa la subida de imágenes de Biometría a Azure por lotes.
     */
    public function subirFotosAzure(Request $request)
    {
        // Parámetro opcional para reanudar desde un ID específico
        $desdeId = $request->get('desde', 0);

        // Obtener lote de registros pendientes
        $pendientes = BiometriaIngreso::where('id', '>', $desdeId)
            ->whereNotNull('url_imagen')
            ->where(function ($q) {
                $q->whereNull('foto')->orWhere('foto', '');
            })
            ->orderBy('id', 'asc')
            ->limit($this->lote)
            ->get();

        if ($pendientes->isEmpty()) {
            Log::info('✅ No hay registros pendientes de subir a Azure.');
            return response()->json(['message' => 'No hay registros pendientes.'], 200);
        }

        $subidos = 0;
        $errores = 0;
        $ultimoId = null;

        foreach ($pendientes as $registro) {
            $ultimoId = $registro->id;

            try {
                $rutaLocal = $registro->url_imagen;
                $nombreArchivo = basename($rutaLocal);
                $rutaAzure = 'biometriabackup/' . $nombreArchivo;

                // Verificar si el archivo local existe
                if (!Storage::disk('biometria')->exists($rutaLocal)) {
                    Log::warning("⚠️ Archivo local no encontrado para ID {$registro->id}: {$rutaLocal}");
                    $errores++;
                    continue;
                }

                // Verificar si ya existe en Azure
                if ($this->existeEnAzure($rutaAzure)) {
                    $registro->update(['foto' => 'Subido']);
                    Log::info("📂 Archivo ya existía en Azure: {$rutaAzure}");
                    $subidos++;
                    continue;
                }

                // Leer contenido local
                $contenido = Storage::disk('biometria')->get($rutaLocal);

                // Subir a Azure
                $this->subirArchivoAzure($rutaAzure, $contenido);

                // Validar subida
                if ($this->existeEnAzure($rutaAzure)) {
                    $registro->update(['foto' => 'Subido']);
                    Log::info("✅ Archivo subido correctamente: {$rutaAzure}");
                    $subidos++;
                } else {
                    Log::error("❌ Fallo al verificar subida de {$rutaAzure}");
                    $errores++;
                }

                // Liberar memoria
                unset($contenido);
            } catch (ServiceException $ex) {
                Log::error("Azure ServiceException en ID {$registro->id}: " . $ex->getMessage());
                $errores++;
            } catch (\Exception $e) {
                Log::error("Error general subiendo ID {$registro->id}: " . $e->getMessage());
                $errores++;
            }
        }

        // Retornar resultado con punto de reanudación
        return response()->json([
            'message' => 'Lote procesado correctamente.',
            'total_en_lote' => $pendientes->count(),
            'subidos' => $subidos,
            'errores' => $errores,
            'ultimo_id_procesado' => $ultimoId,
            'continuar_con' => $ultimoId ? ($ultimoId + 1) : null
        ], 200);
    }

    /**
     * Verifica si el archivo ya existe en Azure Blob Storage.
     */
    private function existeEnAzure($rutaAzure): bool
    {
        try {
            $this->blobClient->getBlobProperties($this->containerName, $rutaAzure);
            return true;
        } catch (ServiceException $e) {
            if ($e->getCode() == 404) return false;
            throw $e;
        }
    }

    /**
     * Sube un archivo a Azure Blob Storage con metadatos.
     */
    private function subirArchivoAzure($rutaAzure, $contenido)
    {
        $options = new CreateBlockBlobOptions();
        $options->setContentType('image/jpeg');
        $options->setMetadata([
            'uploaded_at' => Carbon::now()->toDateTimeString(),
            'source' => 'Laravel Biometria Lote',
        ]);

        $this->blobClient->createBlockBlob($this->containerName, $rutaAzure, $contenido, $options);
    }
}
