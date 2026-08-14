<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EncuestaLlamada;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class EncuestaLlamadaController extends Controller
{
    /**
     * Muestra la lista de usuarios pendientes por llamar y los ya llamados.
     */
    public function index()
    {
        $user = Auth::user();

        // Verificar si es el super admin de encuestas
        $isAdminEncuesta = (strtolower($user->email) === 'encuesta@disajcali.gov.co');

        // Construir la consulta
        $query = EncuestaLlamada::query();

        // Para la vista principal (index), TODOS ven solo los Pendientes y los que ellos mismos tomaron
        $query->where(function($q) use ($user) {
            $q->where('estado', 'Pendiente')
              ->orWhere('usuario_id', $user->id);
        });

        $llamadas = $query->orderByRaw("
                            CASE 
                                WHEN usuario_id = " . $user->id . " AND estado = 'En proceso' THEN 0
                                WHEN estado = 'Pendiente' THEN 1
                                ELSE 2 
                            END
                          ")
                          ->inRandomOrder()
                          ->get();
                        
        return view('encuesta_llamadas.index', compact('llamadas', 'isAdminEncuesta'));
    }

    /**
     * Muestra el histórico completo (Sólo Admin)
     */
    public function historico()
    {
        $user = Auth::user();
        if (strtolower($user->email) !== 'encuesta@disajcali.gov.co') {
            abort(403, 'No autorizado para ver el histórico.');
        }

        // El histórico muestra absolutamente todos los registros ordenados por estado y ID
        $llamadas = EncuestaLlamada::with('usuario')
                        ->orderByRaw("
                            CASE 
                                WHEN estado = 'Llamado' THEN 0
                                WHEN estado = 'En proceso' THEN 1
                                ELSE 2 
                            END
                        ")
                        ->orderBy('id', 'asc')
                        ->get();

        $isAdminEncuesta = true;
        return view('encuesta_llamadas.historico', compact('llamadas', 'isAdminEncuesta'));
    }

    /**
     * Importar registros desde un archivo CSV
     */
    public function importarCSV(Request $request)
    {
        $request->validate([
            'archivo_csv' => 'required|mimes:csv,txt|max:5120',
        ]);

        $user = Auth::user();
        if (strtolower($user->email) !== 'encuesta@disajcali.gov.co') {
            return redirect()->back()->with('error', 'No tienes permiso para importar datos.');
        }

        if ($request->hasFile('archivo_csv')) {
            $path = $request->file('archivo_csv')->getRealPath();
            // Leer el archivo y separar por punto y coma (;)
            $data = array_map(function($line) {
                return str_getcsv($line, ';');
            }, file($path));

            // Quitar los encabezados si existen (asumiendo que la primera fila es encabezado)
            if (count($data) > 0) {
                array_shift($data);
            }

            $insertData = [];
            $repetidos = [];
            
            // Traer todas las cédulas existentes de una vez para optimizar (y prevenir duplicados contra la BD)
            $cedulasExistentes = EncuestaLlamada::pluck('cedula')->toArray();

            foreach ($data as $row) {
                // Prevenir filas vacías
                if (!isset($row[0]) || trim($row[0]) == '') continue;

                $cedula = trim($row[0] ?? '');
                $nombre = trim($row[1] ?? '');

                if (in_array($cedula, $cedulasExistentes)) {
                    $repetidos[] = ['cedula' => $cedula, 'nombre' => $nombre];
                    continue; // Saltar los que ya existen
                }

                // Añadir al arreglo de existentes para evitar duplicados dentro del mismo CSV
                $cedulasExistentes[] = $cedula;

                // Formato: cedula, nombre, celular, correo, municipio
                $insertData[] = [
                    'cedula'     => $cedula,
                    'nombre'     => $nombre,
                    'celular'    => trim($row[2] ?? ''),
                    'correo'     => trim($row[3] ?? ''),
                    'municipio'  => trim($row[4] ?? ''),
                    'estado'     => 'Pendiente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($insertData)) {
                EncuestaLlamada::insert($insertData);
            }

            if (count($repetidos) > 0) {
                $mensajeExito = 'Se importaron ' . count($insertData) . ' usuarios exitosamente. Hubo ' . count($repetidos) . ' repetidos omitidos.';
                return redirect()->back()->with('success', $mensajeExito)->with('repetidos', $repetidos);
            } elseif (!empty($insertData)) {
                return redirect()->back()->with('success', 'Se han importado ' . count($insertData) . ' usuarios exitosamente sin duplicados.');
            } else {
                return redirect()->back()->with('error', 'El archivo estaba vacío, no tiene el formato correcto o todas las cédulas ya estaban registradas.');
            }
        }

        return redirect()->back()->with('error', 'Error al cargar el archivo.');
    }

    /**
     * Inicia la llamada, bloquea el registro y muestra el formulario en una nueva página.
     */
    public function llamar($id)
    {
        $llamada = EncuestaLlamada::findOrFail($id);

        // Si ya está asignado a otro usuario
        if ($llamada->usuario_id && $llamada->usuario_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Este registro ya está siendo procesado por otro usuario.');
        }

        // Si no está asignado o es el mismo usuario, tomarlo
        $llamada->usuario_id = Auth::id();
        $llamada->locked_at = now();
        if ($llamada->estado == 'Pendiente') {
            $llamada->estado = 'En proceso';
        }
        $llamada->save();

        return view('encuesta_llamadas.edit', compact('llamada'));
    }

    /**
     * Busca un empleado por cédula para autocompletar la información
     */
    public function buscarEmpleado(Request $request): JsonResponse
    {
        $cedula = $request->get('cedula');

        if (!$cedula) {
            return response()->json(['ok' => false, 'mensaje' => 'Cédula no proporcionada']);
        }

        // Consultar empleado (sólo actualizar cargo y despacho desde empleados, lo demás se mantiene de la encuesta)
        $empleado = DB::table('empleados')
            ->select(
                'dependencia_titular as despacho',
                'cargo_titular as cargo'
            )
            ->where('cedulaE', $cedula)
            ->first();

        if ($empleado) {
            return response()->json([
                'ok' => true,
                'data' => $empleado
            ]);
        }

        return response()->json([
            'ok' => false,
            'mensaje' => 'Empleado no encontrado'
        ]);
    }

    /**
     * Guarda la encuesta y finaliza la llamada.
     */
    public function guardarEncuesta(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:encuesta_llamadas,id',
            'cedula' => 'required|string',
            'nombre' => 'required|string',
            'observaciones' => 'required|string'
        ]);

        $llamada = EncuestaLlamada::find($request->id);
        
        // Validar que sea el usuario correcto
        if ($llamada->usuario_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este registro.');
        }

        $llamada->cedula = $request->cedula;
        $llamada->nombre = $request->nombre;
        $llamada->celular = $request->celular;
        $llamada->municipio = $request->municipio;
        $llamada->correo = $request->correo;
        $llamada->despacho = $request->despacho;
        $llamada->cargo = $request->cargo;
        $llamada->observaciones = $request->observaciones;
        $llamada->estado = 'Llamado';
        
        $llamada->save();

        return redirect()->route('encuestas_llamadas.index')->with('success', 'Encuesta guardada y finalizada correctamente.');
    }

    /**
     * Exporta los datos a Excel (CSV).
     */
    public function exportarExcel()
    {
        $user = Auth::user();
        if (strtolower($user->email) !== 'encuesta@disajcali.gov.co') {
            abort(403, 'No autorizado para descargar el archivo.');
        }

        $llamadas = EncuestaLlamada::with('usuario')->orderBy('id', 'asc')->get();
        $filename = "Encuestas_Llamadas_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($llamadas) {
            $file = fopen('php://output', 'w');
            // Añadir BOM para que Excel lea el UTF-8 correctamente
            fputs($file, $bom =(chr(0xEF) . chr(0xBB) . chr(0xBF)));
            
            // Encabezados
            fputcsv($file, ['ID', 'Cédula', 'Nombre', 'Celular', 'Correo', 'Municipio', 'Despacho', 'Cargo', 'Estado', 'Asesor que llamó', 'Observaciones', 'Fecha de Carga', 'Última Actualización'], ';');

            foreach ($llamadas as $ll) {
                $asesor = $ll->usuario ? $ll->usuario->name . ' ' . $ll->usuario->lastname : 'N/A';
                fputcsv($file, [
                    $ll->id,
                    $ll->cedula,
                    $ll->nombre,
                    $ll->celular,
                    $ll->correo,
                    $ll->municipio,
                    $ll->despacho,
                    $ll->cargo,
                    $ll->estado,
                    $asesor,
                    $ll->observaciones,
                    $ll->created_at,
                    $ll->updated_at
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
