<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\BlobSharedAccessSignatureHelper;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use Carbon\Carbon;
use App\Models\FichaPreliminar;

class AzureFichaRemisionController extends Controller
{
    protected $blobClient;
    protected $containerName;
    protected $accountName;
    protected $accountKey;
    protected $sasToken;
    protected $remoteBaseFolder = 'ficharemisiondocs';
    protected $maxRetries = 3;
    protected $retryDelay = 100;

    public function __construct()
    {
        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $this->containerName = env('AZURE_STORAGE_CONTAINER');
        $this->accountName = env('AZURE_STORAGE_ACCOUNT_NAME');
        $this->accountKey = env('AZURE_STORAGE_ACCOUNT_KEY');
        $this->sasToken = env('AZURE_STORAGE_SAS_TOKEN', '');

        $this->blobClient = BlobRestProxy::createBlobService($connectionString);
    }

    /**
     * Procesa todos los registros desde un rango de fechas
     */
    public function subirDocumentos(): JsonResponse
    {
        $inicio = Carbon::create(2025, 1, 1)->startOfDay();
        $fin = Carbon::create(2025, 6, 30)->endOfDay();

        $meses = [];
        while ($inicio->lessThanOrEqualTo($fin)) {
            $meses[] = $inicio->copy();
            $inicio->addMonth();
        }

        $resultadoFinal = [];

        foreach ($meses as $mes) {
            $periodo = $mes->format('Y-m');
            Log::info("🔄 Procesando mes: {$periodo}");

            $detalleMes = $this->procesarMes($mes->year, $mes->month);

            $resultadoFinal[] = [
                'periodo' => $periodo,
                'procesados' => count($detalleMes),
                'detalle' => $detalleMes
            ];
        }

        return $this->successResponse('Carga mensual completada', $resultadoFinal);
    }

    /**
     * Procesa registros para un año y mes específico
     */
    protected function procesarMes(int $year, int $month): array
    {
        $resultados = [];
    
        // Procesar ANEXOS
        FichaPreliminar::whereNotNull('anexos')
            ->where('anexos', '!=', '')
            ->where(function ($query) {
                $query->whereNull('anexo_sas')
                      ->orWhere('anexo_sas', '');
            })
            ->orderBy('id')
            ->chunk(100, function ($fichas) use (&$resultados) {
                foreach ($fichas as $ficha) {
                    $resultados[] = $this->procesarRegistroAnexos($ficha);
                }
            });
    
        // Mensaje intermedio opcional (log o info)
        \Log::info('Proceso de anexos completado', ['total' => count($resultados)]);
    
        // Procesar ACTAS DE REPARTO
        FichaPreliminar::whereNotNull('fecha_reparto')
            ->whereNotNull('acta_reparto')
            ->where(function ($query) {
                $query->whereNull('acta_reparto_sas')
                      ->orWhere('acta_reparto_sas', '');
            })
            ->orderBy('id')
            ->chunk(100, function ($fichas) use (&$resultados) {
                foreach ($fichas as $ficha) {
                    $resultados[] = $this->procesarRegistro($ficha);
                }
            });
    
        \Log::info('Proceso de actas de reparto completado', ['total' => count($resultados)]);
    
        return [
            'status' => 'success',
            'message' => 'Procesamiento de anexos y actas completado correctamente',
            'total_registros' => count($resultados),
            'detalles' => $resultados
        ];
    }


    /**
     * Procesa un solo registro de ficha_preliminar
     */
    protected function procesarRegistro($ficha): array
    {
        $logItem = ['id' => $ficha->id, 'resultados' => []];

        try {
            if (!$this->archivoLocalExiste($ficha->anexos) /*|| !$this->archivoLocalExiste($ficha->acta_reparto)*/) {
                $logItem['resultados'] = [
                    //'anexos' => $this->archivoLocalExiste($ficha->anexos) ? 'OK' : 'Archivo local no encontrado',
                    'acta_reparto' => $this->archivoLocalExiste($ficha->acta_reparto) ? 'OK' : 'Archivo local no encontrado',
                ];
                return $logItem;
            }

            $actualizacion = [];

            // Subir anexos
           /* $anexosBlobPath = $this->generateBlobPath('anexos', $ficha->anexos);
            $anexosResult = $this->subirYGenerarUrl('fichapreliminar', $ficha->anexos, $anexosBlobPath);
            $logItem['resultados']['anexos'] = $anexosResult['log'];
            
            
             if ($anexosBlobPath) {
                $ficha->anexo_sas="documento subido";
                $ficha->save();
            }

            if ($anexosResult['url']) {
                //dd($anexosResult['url']);
                $actualizacion['anexo_sas'] = $anexosResult['url'];
            }*/

            // Subir acta_reparto
            $actaBlobPath = $this->generateBlobPath('acta_reparto', $ficha->acta_reparto);
            $actaResult = $this->subirYGenerarUrl('fichapreliminar', $ficha->acta_reparto, $actaBlobPath);
            $logItem['resultados']['acta_reparto'] = $actaResult['log'];
            
            if ($actaResult) {
                $ficha-> acta_reparto_sas = "documento subido";
                $ficha->save();
            }

            if ($actaResult['url']) {
                $actualizacion['acta_reparto_sas'] = $actaResult['url'];
            }

            if (isset($actualizacion['anexo_sas']) && isset($actualizacion['acta_reparto_sas'])) {
                $ficha->update($actualizacion);
                Log::info("✅ Ficha ID {$ficha->id} actualizada con SAS URLs");
            }
            
            // Mensaje de progreso (opcional si ejecutas desde consola o navegador)
                echo "Archivos subidos: --- {$ficha->acta_reparto}<br>";
                ob_flush();
                flush();

        } catch (\Exception $e) {
            Log::error("❌ Error en ficha ID {$ficha->id}: " . $e->getMessage());
            $logItem['resultados']['error'] = $e->getMessage();
        }

        return $logItem;
    }
    
    
    protected function procesarRegistroAnexos($ficha): array
    {
        $logItem = ['id' => $ficha->id, 'resultados' => []];

        try {
            if (!$this->archivoLocalExiste($ficha->anexos)) {
                $logItem['resultados'] = [
                    'anexos' => $this->archivoLocalExiste($ficha->anexos) ? 'OK' : 'Archivo local no encontrado',
                ];
                return $logItem;
            }

            $actualizacion = [];

            // Subir anexos
            $anexosBlobPath = $this->generateBlobPath('anexos', $ficha->anexos);
            $anexosResult = $this->subirYGenerarUrl('fichapreliminar', $ficha->anexos, $anexosBlobPath);
            $logItem['resultados']['anexos'] = $anexosResult['log'];
            
            
             if ($anexosBlobPath) {
                $ficha->anexo_sas="documento subido";
                $ficha->save();
            }
            
            

            if ($anexosResult['url']) {
                //dd($anexosResult['url']);
                $actualizacion['anexo_sas'] = $anexosResult['url'];
            }

           
            if (isset($actualizacion['anexo_sas'])) {
                $ficha->update($actualizacion);
                Log::info("✅ Ficha ID {$ficha->id} actualizada con SAS URLs");
            }
            
            // Mensaje de progreso (opcional si ejecutas desde consola o navegador)
                echo "Archivos subidos: -----  {$ficha->anexos}<br>";
                ob_flush();
                flush();

        } catch (\Exception $e) {
            Log::error("❌ Error en ficha ID {$ficha->id}: " . $e->getMessage());
            $logItem['resultados']['error'] = $e->getMessage();
        }

        return $logItem;
    }

    /**
     * Subida + generación de SAS URL usable en navegador (10 años, inline)
     */
    protected function subirYGenerarUrl(string $disk, string $localPath, string $blobPath): array
    {
        $log = [];
        $url = null;

        if ($this->subirArchivoDesdeDisco($disk, $localPath, $blobPath)) {
            
            
            $url = $this->generarUrlConSas($blobPath, basename($blobPath));
            
            $log = ['estado' => 'Subido', 'url' => $url];
        } else {
            $log = 'Error al subir';
        }

        return ['url' => $url, 'log' => $log];
    }

    /**
     * Verifica si un archivo existe en el disco Laravel
     */
    protected function archivoLocalExiste(string $path): bool
    {
        return Storage::disk('fichapreliminar')->exists($path);
    }

    /**
     * Genera la ruta en Azure con carpeta virtual
     */
    protected function generateBlobPath(string $tipo, string $filename): string
    {
        return "{$this->remoteBaseFolder}/{$tipo}/{$filename}";
    }

    /**
     * Sube un archivo desde un disco Laravel a Azure Blob Storage
     */
    protected function subirArchivoDesdeDisco(string $disk, string $localPath, string $blobPath): bool
    {
        try {
            $contenido = Storage::disk($disk)->get($localPath);
            $mimeType = Storage::disk($disk)->mimeType($localPath) ?? 'application/octet-stream';

            for ($intentos = 0; $intentos < $this->maxRetries; $intentos++) {
                try {
                    $options = new CreateBlockBlobOptions();
                    $options->setContentType($mimeType);

                    $this->blobClient->createBlockBlob(
                        $this->containerName,
                        $blobPath,
                        $contenido,
                        $options
                    );
                    
                    $url = $this->generarUrlConSas($blobPath, basename($blobPath));
                    //dd($url);

                    Log::info("✅ Subido a Azure: {$blobPath}");
                    return true;

                } catch (ServiceException $e) {
                    Log::warning("⚠️ Intento {$intentos} fallido: " . $e->getMessage());
                    usleep($this->retryDelay * 1000);
                }
            }

            Log::error("❌ Fallo definitivo al subir {$blobPath}");
            return false;

        } catch (\Exception $e) {
            Log::error("❌ Error leyendo archivo local {$localPath}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Genera una URL con SAS dinámica de 10 años para usar en navegador
     */
  protected function generarUrlConSas(string $blobPath): string
    {
        $helper = new BlobSharedAccessSignatureHelper(
            $this->accountName,
            $this->accountKey
        );
    
        $start = gmdate('Y-m-d\TH:i:s\Z', strtotime('-1 day'));
        $expiry = gmdate('Y-m-d\TH:i:s\Z', strtotime('+10 years'));
    
        // ✔️ SOLO permisos válidos
        $permissions = 'r';
    
        $sasToken = $helper->generateBlobServiceSharedAccessSignatureToken(
            'b',                    // Blob-level
            $this->containerName,   // Container
            $blobPath,              // Blob path
            $start,
            $expiry,
            $permissions            // ✔️ Valid permission
        );
    
        return sprintf(
            'https://%s.blob.core.windows.net/%s/%s?%s',
            $this->accountName,
            $this->containerName,
            $blobPath,
            $sasToken
        );
    }




    /**
     * Respuesta JSON exitosa
     */
    protected function successResponse(string $message, array $data = [], int $status = 200): JsonResponse
    {
        return Response::json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Respuesta JSON de error
     */
    protected function errorResponse(string $message, int $status = 500): JsonResponse
    {
        return Response::json([
            'success' => false,
            'error' => $message
        ], $status);
    }
}
