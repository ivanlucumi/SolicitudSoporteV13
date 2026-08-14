<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use Carbon\Carbon;

use App\Models\BiometriaIngreso;

class AzureController extends Controller
{
    protected $blobClient;
    protected $containerName;
    protected $accountName;
    protected $accountKey;
    protected string $backupPath;
    protected $maxRetries = 3;
    protected $retryDelay = 100; // milisegundos

    public function __construct()
    {
       $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $this->containerName = env('AZURE_STORAGE_CONTAINER') ?? throw new \RuntimeException('Azure storage container name not configured');
        $this->backupPath = config('backup.path', storage_path('../../backups'));
        
        $this->blobClient = BlobRestProxy::createBlobService($connectionString);
    }

    /**
     * Sube un archivo de backup a Azure Blob Storage
     * 
     * @param string|null $filename Nombre específico del archivo (opcional)
     * @return JsonResponse
     */
    public function subirBackup(string $filename = null): JsonResponse
    {
        try {
            $filename = $filename ?? $this->getLatestBackupFile();
            $localFilePath = $this->backupPath . '/' . $filename;
            
            $this->validateBackupFile($localFilePath);
            
            // Generar nombre único para el blob
            $blobPath = $this->generateUniqueBlobPath($filename);
            
            $this->uploadToAzure($localFilePath, $blobPath);
            $this->cleanUpLocalFile($localFilePath);

            return response()->json([
                'ok' => true,
                'mensaje' => 'Backup subido exitosamente',
                'data' => [
                    'path' => $blobPath,
                    'filename' => basename($blobPath),
                    'size' => filesize($localFilePath),
                    'deleted_local' => !file_exists($localFilePath)
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error("Error en subirBackup: " . $e->getMessage());
            return response()->json([
                'ok' => false,
                'mensaje' => $e->getMessage()
            ], $e->getCode() > 0 ? $e->getCode() : 500);
        }
    }

    /**
     * Genera un backup completo de la base de datos usando mysqldump y lo sube a Azure.
     * 
     * @return JsonResponse
     */
    public function generarYSubirBackup(): JsonResponse
    {
        // Evitar que el servidor corte el proceso por timeout o falta de memoria
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        try {
            // Asegurar que el directorio de backups existe
            if (!file_exists($this->backupPath)) {
                mkdir($this->backupPath, 0755, true);
            }

            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbPort = env('DB_PORT', '3306');
            $dbUser = env('DB_USERNAME', 'root');
            $dbPass = env('DB_PASSWORD', '');
            $dbName = env('DB_DATABASE', 'siris');

            $dateString = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "backup_completo_{$dbName}_{$dateString}.sql";
            $localFilePath = $this->backupPath . '/' . $filename;

            // En lugar de usar exec() con mysqldump (que está deshabilitado por seguridad en producción),
            // usamos un método nativo de PHP para generar el SQL
            $this->dumpDatabasePhp($localFilePath);

            if (!file_exists($localFilePath) || filesize($localFilePath) === 0) {
                @unlink($localFilePath);
                throw new \Exception("El archivo de backup generado está vacío o falló la creación.");
            }

            // Forzar que el backup se almacene en el contenedor 'siriscali'
            $this->containerName = 'siriscali';

            // Una vez generado exitosamente, usamos el método existente para subirlo a Azure y limpiar
            $response = $this->subirBackup($filename);

            // Si la subida fue exitosa, enviamos el correo
            if ($response->getStatusCode() === 200) {
                try {
                    \Illuminate\Support\Facades\Mail::raw(
                        "El backup automático de la base de datos SIRIS se ha generado y subido a Azure correctamente.\n\n" .
                        "Archivo: {$filename}\n" .
                        "Fecha de generación: " . \Carbon\Carbon::now()->format('d/m/Y H:i:s') . "\n\n" .
                        "Este es un mensaje automático, por favor no responda.",
                        function ($message) {
                            $message->to('gmstdesajvalle3@cendoj.ramajudicial.gov.co')
                                    ->subject('Notificación de Backup Exitoso - SIRIS');
                        }
                    );
                } catch (\Exception $mailEx) {
                    \Illuminate\Support\Facades\Log::error("Backup subido pero falló el envío de correo: " . $mailEx->getMessage());
                }
            }

            return $response;

        } catch (\Exception $e) {
            Log::error("Error generando backup de BD: " . $e->getMessage());
            return response()->json([
                'ok' => false,
                'mensaje' => "Error al generar el backup: " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Genera un archivo SQL de respaldo puro en PHP usando DB::cursor para evitar 
     * consumo excesivo de memoria, útil en servidores donde exec() está deshabilitado.
     */
    protected function dumpDatabasePhp(string $filePath)
    {
        $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
        
        $handle = fopen($filePath, 'w+');
        if (!$handle) {
            throw new \Exception("No se pudo crear el archivo de backup en $filePath");
        }

        fwrite($handle, "-- Backup generado por SIRIS PHP Dumper\n");
        fwrite($handle, "-- Fecha: " . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . "\n\n");
        fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n");
        fwrite($handle, "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n");
        fwrite($handle, "SET AUTOCOMMIT=0;\n");
        fwrite($handle, "START TRANSACTION;\n\n");

        $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();

        foreach ($tables as $tableRow) {
            $tableArray = (array)$tableRow;
            $table = array_values($tableArray)[0];
            
            // Estructura
            $createTable = \Illuminate\Support\Facades\DB::select("SHOW CREATE TABLE `{$table}`");
            
            if (isset($createTable[0]->{'Create Table'})) {
                $createSql = $createTable[0]->{'Create Table'};
                $isView = false;
            } elseif (isset($createTable[0]->{'Create View'})) {
                $createSql = $createTable[0]->{'Create View'};
                $isView = true;
            } else {
                continue;
            }
            
            fwrite($handle, "\n\nDROP " . ($isView ? "VIEW" : "TABLE") . " IF EXISTS `{$table}`;\n");
            fwrite($handle, $createSql . ";\n\n");

            // Solo insertar datos si es tabla
            if (!$isView) {
                foreach (\Illuminate\Support\Facades\DB::table($table)->cursor() as $row) {
                    $rowArray = (array)$row;
                    $values = [];
                    foreach ($rowArray as $value) {
                        if ($value === null) {
                            $values[] = 'NULL';
                        } else {
                            $values[] = $pdo->quote($value);
                        }
                    }
                    $sql = "INSERT INTO `{$table}` VALUES(" . implode(', ', $values) . ");\n";
                    fwrite($handle, $sql);
                }
            }
        }

        fwrite($handle, "\nCOMMIT;\n");
        fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
        fclose($handle);
    }
    
    protected function generateUniqueBlobPath(string $filename): string
    {
        $dateFolder = Carbon::now()->format('Y-m-d');
        $baseName = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $extension = $extension ? ".$extension" : '';
        
        $blobDir = "SIRISBACKUP/{$dateFolder}";
        $blobName = "{$baseName}{$extension}";
        
        $counter = 1;
        while ($this->blobExists("{$blobDir}/{$blobName}")) {
            $blobName = "{$baseName}_{$counter}{$extension}";
            $counter++;
        }
        
        return "{$blobDir}/{$blobName}";
    }

    /**
     * Obtiene el archivo de backup más reciente
     * 
     * @return string
     * @throws \RuntimeException Si no se encuentran archivos de backup
     */
    protected function getLatestBackupFile(): string
    {
        $files = glob($this->backupPath . '/*.{sql,sql.gz}', GLOB_BRACE);
        
        if (empty($files)) {
            throw new \RuntimeException('No se encontraron archivos de backup', 404);
        }
        
        // Ordenar por tiempo de modificación (más reciente primero)
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        
        return basename($files[0]);
    }

    /**
     * Valida que el archivo de backup exista y sea válido
     * 
     * @param string $filePath
     * @throws \RuntimeException Si el archivo no es válido
     */
    protected function validateBackupFile(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("Archivo de respaldo no encontrado: {$filePath}", 404);
        }
        
        if (filesize($filePath) === 0) {
            throw new \RuntimeException("El archivo de respaldo está vacío: {$filePath}", 422);
        }
    }

    /**
     * Genera la ruta del blob en Azure
     * 
     * @param string $filename
     * @return string
     */
    protected function generateBlobPath(string $filename): string
    {
        $dateFolder = Carbon::now()->format('Y-m-d');
        return "SIRISBACKUP/{$dateFolder}/{$filename}";
    }

    /**
     * Sube un archivo a Azure Blob Storage
     * 
     * @param string $localFilePath
     * @param string $blobPath
     * @throws ServiceException
     */
    protected function uploadToAzure(string $localFilePath, string $blobPath): void
    {
        $stream = fopen($localFilePath, 'r');
        
        try {
            $this->blobClient->createBlockBlob(
                $this->containerName, 
                $blobPath, 
                $stream
            );
            
            Log::info("Backup subido correctamente a Azure: {$blobPath}");
        } finally {
            if (is_resource($stream)) {
                fclose($stream);
            }
        }
    }

    /**
     * Elimina el archivo local después de la subida
     * 
     * @param string $filePath
     */
    protected function cleanUpLocalFile(string $filePath): void
    {
        if (unlink($filePath)) {
            Log::info("Archivo local eliminado: {$filePath}");
        } else {
            Log::warning("No se pudo eliminar el archivo local: {$filePath}");
        }
    }

    /**
     * Verifica si un blob ya existe en Azure
     * 
     * @param string $blobPath
     * @return bool
     */
    protected function blobExists(string $blobPath): bool
    {
        try {
            $this->blobClient->getBlobProperties($this->containerName, $blobPath);
            return true;
        } catch (ServiceException $e) {
            return false;
        }
    }

    /**
     * Respuesta JSON exitosa
     * 
     * @param string $message
     * @param array $data
     * @param int $status
     * @return JsonResponse
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
     * 
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $status = 500): JsonResponse
    {
        return Response::json([
            'success' => false,
            'error' => $message
        ], $status);
    }
    
   public function uploadBase64Images(): array
    {
        
       // dd('hola');
        $result = ['subidas' => 0, 'errores' => 0, 'omitidos' => 0];
        
        

        BiometriaIngreso::whereNotNull('foto')
        //->where('url_imagen',null)
        //->where('identificacion','1114825893')
        ->chunk(100, function ($registros) use (&$result) {
            
            foreach ($registros as $registro) {
                try {
                    //dd($registro);
                    // Verificar si necesita procesamiento
                   /* if (!$registro->needsImageProcessing()) {
                        $result['omitidos']++;
                        //dd( $result['omitidos']);
                        continue;
                    }*/
                    
                        // Obtener la imagen en base64
                         $base64 = $registro->foto;

                    
                    // Limpiar encabezado base64 si existe
                        if (str_contains($base64, ',')) {
                            [, $base64] = explode(',', $base64);
                        }
        
                        // Convertir base64 a binario
                        $binaryData = base64_decode($base64);
        
                        // Construir nombre del archivo: YYYYMMDD_HHmmss_cedula.png
                        $fecha = Carbon::parse($registro->created_at)->format('Ymd_His');
                        $cedula = $registro->identificacion ?? 'sin_cedula';
                        $apellido = $registro->p_apellido;
                        $nombre = $registro->p_nombre;
                        $filename = "BIOMETRIA_INGRESO/{$cedula}_{$apellido}_{$nombre}_{$fecha}.png";
                        
                        $this->blobClient->createBlockBlob(
                            $this->containerName, 
                            $filename, 
                            $binaryData
                        );
        
                      $result['subidas']++;
                      Log::info("Imagen procesada: {$filename} (ID: {$registro->id})");  


                    // Procesar imagen
                   /* $imageData = $this->processImage($registro->foto);
                    $filename = $this->generateFilename($registro);
                    
                    //dd($filename);

                    // Subir a Azure
                    $this->blobClient->createBlockBlob($this->container, $filename, $imageData);

                    // Actualizar registro
                    $registro->url_imagen = $this->getFileUrl($filename);
                    $registro->save();

                    $result['subidas']++;
                    Log::info("Imagen procesada: {$filename} (ID: {$registro->id})");*/

                } catch (\Exception $e) {
                    $result['errores']++;
                    Log::error("Error en ID {$registro->id}: " . $e->getMessage());
                }
            }
        });

        return $result;
    }

    protected function processImage(string $base64): string
    {
        $data = explode(',', $base64);
        $imageData = base64_decode(end($data));
        
        if ($imageData === false) {
            throw new \RuntimeException('Datos de imagen no válidos');
        }

        return $imageData;
    }

    protected function generateFilename(BiometriaIngreso $registro): string
    {
        return sprintf(
            "biometria/%s_%s.png",
            $registro->created_at->format('Ymd_His'),
            $registro->cedula ?: 'sin_cedula'
        );
    }

    protected function getFileUrl(string $filename): string
    {
        return "https://" . env('AZURE_STORAGE_ACCOUNT') . ".blob.core.windows.net/{$this->container}/{$filename}";
    }
    
    /**
     * Sube una foto de Siniestro directamente a Azure Blob Storage
     * 
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function subirFotoSiniestro(\Illuminate\Http\Request $request): JsonResponse
    {
        $request->validate([
            'foto'        => 'required|file|mimes:jpeg,png,jpg,webp|max:15360',
            'codigo_juzgado'=> 'required|string',
            'elemento_id' => 'required|numeric'
        ]);

        try {
            $codigo = $request->codigo_juzgado;
            $file = $request->file('foto');
            $elementoId = $request->elemento_id;
            
            // Buscar la foto recién guardada en la BD para usar el MISMO nombre exacto
            $fotoDb = \App\Models\EncuestaSiniestroFoto::where('elemento_id', $elementoId)->latest('id')->first();
            
            if ($fotoDb && $fotoDb->nombre_archivo) {
                $filename = $fotoDb->nombre_archivo;
            } else {
                // Fallback por si acaso
                $elemento = \App\Models\EncuestaSiniestroElemento::find($elementoId);
                $tipoElemento = $elemento ? $elemento->tipo_elemento : 'Elemento';
                $tipoLimpio = preg_replace('/[^A-Za-z0-9\-]/', '_', $tipoElemento);
                $extension = $file->getClientOriginalExtension();
                $filename = "{$codigo}_{$tipoLimpio}_" . time() . ".{$extension}";
            }
            
            // Definir el nombre del contenedor específico para siniestros
            // (Asegúrate de que este contenedor exista en Azure y tenga permisos de escritura)
            $containerSiniestros = 'siniestro'; 
            
            // La carpeta será directamente el código del juzgado
            $blobPath = "{$codigo}/{$filename}";
            
            // Subir a Azure
            $stream = fopen($file->getRealPath(), 'r');
            $this->blobClient->createBlockBlob(
                $containerSiniestros, 
                $blobPath, 
                $stream
            );
            if (is_resource($stream)) {
                fclose($stream);
            }

            return $this->successResponse('Foto subida a Azure correctamente', [
                'ruta_azure' => $blobPath
            ]);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error subiendo foto siniestro a Azure: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}