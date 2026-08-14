<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteFalla;
use App\Models\Despacho;
use Illuminate\Support\Facades\Storage;

class ReporteFallasController extends Controller
{
    /**
     * Muestra la vista del formulario.
     */
    public function index()
    {
        return view('externo.Formulario.FormularioDanos');
    }

    /**
     * Guarda los datos en la base de datos y las imágenes en el filesystem.
     */
    public function store(Request $request)
    {
        // Evitar que la página se quede cargando o se cuelgue al procesar imágenes pesadas
        @ini_set('max_execution_time', '300');
        @ini_set('memory_limit', '-1');

        // Validación básica
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipos_falla' => 'nullable|array',
            
            // Archivos - puedes ajustar el tamaño máximo aquí (ej. max:5120 para 5MB)
            'evidencia_conectividad.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'evidencia_computo.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'evidencia_impresoras.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'evidencia_escaner.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'evidencia_telefonia.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
        ]);

        // Guardar reporte
        $reporte = new \App\Models\ReporteFalla();
        $reporte->identificacion_empleado = $request->cedula_funcionario;
        $reporte->nombre_empleado = $request->nombre;
        $reporte->codigo_juzgado = $request->codigo_juzgado;
        $reporte->juzgado = $request->despacho;
        $reporte->tipos_falla = $request->tipos_falla;

        // Función auxiliar para procesar datos dinámicos (arrays)
        $procesarDinamico = function ($categoria) use ($request) {
            $marca_field = "marca_{$categoria}";
            $placa_field = "placa_{$categoria}";
            $obs_field = "obs_{$categoria}_dinamico";
            $old_obs_field = "obs_{$categoria}";
            
            $datos = [];
            if ($request->has($marca_field)) {
                foreach ($request->$marca_field as $index => $marca) {
                    $datos[] = [
                        'marca' => $marca,
                        'placa' => $request->$placa_field[$index] ?? null,
                        'observacion' => $request->$obs_field[$index] ?? $request->$old_obs_field[$index] ?? null,
                    ];
                }
                return $datos;
            }
            return null; // Si no hay datos dinámicos, retorna null
        };

        // Procesar Observaciones Dinámicas
        $reporte->obs_conectividad = $request->obs_conectividad; // Este no es dinámico (es solo 1 textarea)
        $reporte->obs_computo = $procesarDinamico('computo');
        $reporte->obs_impresoras = $procesarDinamico('impresoras');
        $reporte->obs_escaner = $procesarDinamico('escaner');
        $reporte->obs_telefonia = $procesarDinamico('telefonia');
        $reporte->obs_ups = $procesarDinamico('ups');
        $reporte->obs_televisor = $procesarDinamico('televisor');
        $reporte->obs_sala_audiencia = $procesarDinamico('sala_audiencia');

        // Procesar Evidencias Dinámicas (ej. múltiples inputs name="evidencia_computo_X")
        // La función anterior sube todo de un array de archivos (name="evidencia_computo[]")
        $subirArchivos = function ($campoInput) use ($request) {
            $paths = [];
            if ($request->hasFile($campoInput)) {
                $files = is_array($request->file($campoInput)) ? $request->file($campoInput) : [$request->file($campoInput)];
                foreach ($files as $file) {
                    if (is_array($file)) {
                        foreach ($file as $f) {
                            $paths[] = $this->comprimirYGuardarImagen($f);
                        }
                    } else {
                        $paths[] = $this->comprimirYGuardarImagen($file);
                    }
                }
            }
            return empty($paths) ? null : $paths;
        };

        $subirArchivosDinamicos = function ($categoria) use ($request, $subirArchivos) {
            $marca_field = "marca_{$categoria}";
            $id_field = "id_{$categoria}";
            if ($request->has($marca_field)) {
                $evidencias = [];
                foreach ($request->$marca_field as $index => $marca) {
                    $id = $request->input($id_field)[$index] ?? ($index + 1); // Usar ID del form si existe
                    $campo = "evidencia_{$categoria}_dinamica_" . $id;
                    if ($request->hasFile($campo)) {
                        $evidencias[] = $subirArchivos($campo);
                    } else {
                        $evidencias[] = null;
                    }
                }
                return $evidencias;
            }
            return $subirArchivos("evidencia_{$categoria}");
        };

        $reporte->evidencia_computo = $subirArchivosDinamicos('computo');
        $reporte->evidencia_impresoras = $subirArchivosDinamicos('impresoras');
        $reporte->evidencia_escaner = $subirArchivosDinamicos('escaner');
        $reporte->evidencia_telefonia = $subirArchivosDinamicos('telefonia');
        $reporte->evidencia_ups = $subirArchivosDinamicos('ups');
        $reporte->evidencia_televisor = $subirArchivosDinamicos('televisor');
        $reporte->evidencia_sala_audiencia = $subirArchivosDinamicos('sala_audiencia');
        $reporte->evidencia_conectividad = $subirArchivos('evidencia_conectividad');

        $reporte->save();

        // Podrías devolver con sweetalert o un mensaje de sesión
        return redirect()->back()->with('success', 'Su reporte ha sido enviado con éxito y las evidencias se han guardado correctamente.');
    }

    /**
     * Busca un empleado por cédula y devuelve su nombre completo
     */
    public function buscarEmpleado(Request $request)
    {
        $cedula = $request->get('cedula');
        if (!$cedula) {
            return response()->json(['encontrado' => false]);
        }

        $empleado = \App\Models\Empleado::where('cedulaE', $cedula)->first();

        if ($empleado) {
            return response()->json([
                'encontrado' => true,
                'nombre_completo' => trim($empleado->nameE . ' ' . $empleado->lastnameE),
                'cargo' => $empleado->cargo_titular ?? '',
                'codigo_juzgado' => $empleado->cod_dependencia ?? $empleado->cod_despacho ?? '',
                'juzgado' => $empleado->dependencia_titular ?? ''
            ]);
        }

        return response()->json(['encontrado' => false]);
    }

    /**
     * Comprime y guarda la imagen si es válida, de lo contrario la guarda normal.
     */
    private function comprimirYGuardarImagen($file)
    {
        $mime = $file->getMimeType();
        if (str_starts_with($mime, 'image/')) {
            $path = $file->hashName('evidencias_fallas');
            $fullPath = storage_path('app/public/' . $path);
            
            // Asegurar que el directorio exista
            $dir = dirname($fullPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            // Aumentar memoria temporalmente por si suben fotos de >5MB
            @ini_set('memory_limit', '256M');

            if ($mime == 'image/jpeg' || $mime == 'image/jpg') {
                $image = @imagecreatefromjpeg($file->getRealPath());
                if ($image) {
                    $image = $this->corregirOrientacionExif($image, $file->getRealPath());
                    $image = $this->resizeImageMaxAncho($image, 1600); // Mayor tamaño para apreciar mejor el daño
                    imagejpeg($image, $fullPath, 85); // Mayor calidad para evitar que se vea borrosa al estirarse en el PDF
                    imagedestroy($image);
                    return $path;
                }
            } elseif ($mime == 'image/png') {
                $image = @imagecreatefrompng($file->getRealPath());
                if ($image) {
                    $image = $this->resizeImageMaxAncho($image, 1600);
                    // Nivel de compresión de 0 a 9 (7 es óptimo para balancear velocidad y peso)
                    imagepng($image, $fullPath, 7); 
                    imagedestroy($image);
                    return $path;
                }
            }
        }
        
        // Fallback para documentos PDF u otras imágenes no procesadas
        return $file->store('evidencias_fallas', 'public');
    }

    /**
     * Corrige la rotación de imágenes provenientes de celulares usando EXIF
     */
    private function corregirOrientacionExif($image, $filename)
    {
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($filename);
            if ($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if ($orientation == 3) {
                    $image = imagerotate($image, 180, 0);
                } elseif ($orientation == 6) {
                    $image = imagerotate($image, -90, 0);
                } elseif ($orientation == 8) {
                    $image = imagerotate($image, 90, 0);
                }
            }
        }
        return $image;
    }

    /**
     * Redimensiona una imagen si supera el ancho máximo de forma rápida
     */
    private function resizeImageMaxAncho($image, $maxAncho)
    {
        $ancho = imagesx($image);
        $alto = imagesy($image);

        if ($ancho > $maxAncho) {
            $nuevoAncho = $maxAncho;
            $nuevoAlto = floor($alto * ($maxAncho / $ancho));
            
            $nuevaImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            
            // Preservar transparencia para PNG de forma rápida
            imagealphablending($nuevaImagen, false);
            imagesavealpha($nuevaImagen, true);
            $transparent = imagecolorallocatealpha($nuevaImagen, 255, 255, 255, 127);
            imagefilledrectangle($nuevaImagen, 0, 0, $nuevoAncho, $nuevoAlto, $transparent);

            // imagecopyresampled asegura buena calidad sin aliasing (bordes dentados)
            imagecopyresampled($nuevaImagen, $image, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            
            imagedestroy($image); // Liberar memoria de la imagen original
            return $nuevaImagen;
        }

        return $image;
    }
}
