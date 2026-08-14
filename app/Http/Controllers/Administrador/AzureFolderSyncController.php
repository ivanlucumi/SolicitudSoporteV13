<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AzureFolder;
use App\Models\AzureUploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;

class AzureFolderSyncController extends Controller
{
    public function index()
    {
        $folders = AzureFolder::withCount('uploadedFiles')->get();
        return view('administrador.azure_folders.index', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'path' => 'required|string|unique:azure_folders,path'
        ]);

        $path = $request->input('path');

        if (!File::isDirectory($path)) {
            return redirect()->back()->with('error', 'La ruta especificada no es una carpeta válida o no existe en el servidor.');
        }

        AzureFolder::create([
            'path' => $path,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Carpeta registrada exitosamente.');
    }

    public function destroy($id)
    {
        $folder = AzureFolder::findOrFail($id);
        $folder->delete();
        return redirect()->back()->with('success', 'Carpeta eliminada del registro.');
    }

    public function sync()
    {
        // Esto puede tomar tiempo, aumentar el tiempo límite si es posible
        set_time_limit(300);

        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $containerName = env('AZURE_STORAGE_CONTAINER');

        if (!$connectionString || !$containerName) {
            return redirect()->back()->with('error', 'Credenciales de Azure no configuradas.');
        }

        try {
            $blobClient = BlobRestProxy::createBlobService($connectionString);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error conectando a Azure: ' . $e->getMessage());
        }

        $folders = AzureFolder::where('is_active', true)->get();
        $archivosSubidos = 0;
        $archivosOmitidos = 0;
        $errores = 0;

        foreach ($folders as $folder) {
            if (!File::isDirectory($folder->path)) {
                Log::warning("Azure Sync: La carpeta no existe -> {$folder->path}");
                continue;
            }

            $files = File::allFiles($folder->path);

            foreach ($files as $file) {
                $path = $file->getPathname();
                $hash = md5_file($path);

                // Verificar si ya fue subido (misma ruta y mismo hash)
                if (AzureUploadedFile::where('file_path', $path)->where('file_hash', $hash)->exists()) {
                    $archivosOmitidos++;
                    continue;
                }

                try {
                    $contenido = file_get_contents($path);
                    $nombreArchivo = $file->getFilename();
                    
                    // Definir ruta en azure (ej. carpetas_sync/1_nombrecarpeta/archivo.ext)
                    $folderName = basename($folder->path);
                    $rutaAzure = "carpetas_sync/{$folder->id}_{$folderName}/" . $nombreArchivo;

                    $options = new CreateBlockBlobOptions();
                    $mime = mime_content_type($path);
                    $options->setContentType($mime ?: 'application/octet-stream');

                    // Subir a Azure
                    $blobClient->createBlockBlob($containerName, $rutaAzure, $contenido, $options);

                    // Registrar en base de datos local
                    AzureUploadedFile::updateOrCreate(
                        ['file_path' => $path],
                        [
                            'azure_folder_id' => $folder->id,
                            'file_hash' => $hash,
                            'uploaded_at' => now()
                        ]
                    );

                    $archivosSubidos++;
                    
                    // Liberar memoria
                    unset($contenido);
                    
                } catch (\Exception $e) {
                    Log::error("Error subiendo archivo a Azure {$path}: " . $e->getMessage());
                    $errores++;
                }
            }
        }

        return redirect()->back()->with('success', "Sincronización completada: $archivosSubidos subidos, $archivosOmitidos omitidos (ya existentes), $errores errores.");
    }
}
