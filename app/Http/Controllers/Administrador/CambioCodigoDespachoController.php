<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CambioCodigoDespachoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

    public function index()
    {
        return view('administrador.excel.ActualizarCodigoDespacho');
    }

    public function actualizarCodigosDesdeExcel(Request $request)
    {
        $file = $request->file('file');

        if (!$file || !$file->isValid() || $file->getClientOriginalExtension() !== 'xlsx') {
            return response()->json([
                'success' => false,
                'error'   => 'Archivo inválido. Debe ser un archivo .xlsx'
            ], 400);
        }

        try {

            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            DB::beginTransaction();

            $reporte = [
                'exitosos' => [],
                'fallidos' => []
            ];

            foreach ($rows as $index => $row) {

                if ($index === 0) continue;

                $antiguo = trim($row[0] ?? '');
                $nuevo   = trim($row[1] ?? '');

                if (!$antiguo || !$nuevo || $antiguo === $nuevo) {
                    continue;
                }

                $resultado = $this->realizarCambioGlobalDespacho($antiguo, $nuevo);

                if ($resultado['success']) {
                    $reporte['exitosos'][] = "$antiguo → $nuevo";
                } else {
                    $reporte['fallidos'][] = [
                        'codigo_antiguo' => $antiguo,
                        'codigo_nuevo'   => $nuevo,
                        'motivo'         => $resultado['error']
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'mensaje' => 'Proceso finalizado',
                'reporte' => $reporte
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error general actualización códigos: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error'   => 'Error general: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Realiza el cambio global del código de despacho
     */
    public function realizarCambioGlobalDespacho(string $antiguo, string $nuevo): array
    {
        try {

            // Validar existencia código antiguo
            $existeAntiguo = DB::table('despachos')
                ->where('codigoDespacho', $antiguo)
                ->exists();

            if (!$existeAntiguo) {
                return [
                    'success' => false,
                    'error'   => 'El código antiguo no existe en la tabla despachos'
                ];
            }

            // Validar duplicado
            $existeNuevo = DB::table('despachos')
                ->where('codigoDespacho', $nuevo)
                ->exists();

            if ($existeNuevo) {
                return [
                    'success' => false,
                    'error'   => 'El código nuevo ya existe (conflicto de llave primaria)'
                ];
            }

            $mapeoTablas = [
                
                'a_programacion_capacitacion_siugj' => 'codigo_despacho',
                'contratos_activos'                 => 'despacho_id',
                'despacho_escalafon'                => 'codigo_despacho',
                'digitalizacion'                    => 'despacho_id',
                'distribucion_equipo_2024'          => 'codigo_despacho',
                'encuesta_uso_aplicativos'          => 'despacho_id',
                'escalafon_despacho'                => 'codigo_despacho',
                'esquema_vacunacion'                => 'codigo_despacho',
                'estadistica_digitalizacion'        => 'id_despacho',
                'ficha_preliminar'                  => 'id_despacho_reparto',
                'instalacion_impresoras_comodato'   => 'id_despacho',
                'Inventario_computadores_todoenuno' => 'codigo_despacho',
                'levantamiento_sgde'                => 'despacho_id',
                'normalizacion'                     => 'despacho_id',
                'normallizacion_asignado'           => 'codigo_despacho',
                'notificaciones'                    => 'codigoDespacho',
                'personal_activo'                   => 'despacho',
                'personas'                          => 'despacho_id',
                'portatiles_instalacion'            => 'id_despacho',
                'programacion_capacitacion'         => 'codigo_despacho',
                'programacion_visita_siugj'         => 'codigo_despacho',
                'registro_digitalizacion'           => 'id_despacho',
                'reporte_incidente'                 => 'id_usuario',
                'requerimiento_despachos'           => 'despacho_id',
                'reserva_sala_audiencias'           => 'despacho_id',
                'seguimiento_presencialidad'        => 'codigoDespacho_id',
                'siniestros'                        => 'despacho_id',
                'solicitudes_almacen'               => 'id_despacho',
                'solicitudes_trabajo_remoto'        => 'id_despacho',
                'solicitud_audiencias'              => 'codigo_despacho',
                'solicitud_creacion_usuario'        => 'codigo_despacho',
                'solicitud_usuario_soportes'        => 'id_despacho',
                'soporte_usuarios_pdf'              => 'despacho_id',
                'teletrabajo_2024'                  => 'codigo_despacho',
                'todo_en_uno_instalacion'           => 'id_despacho',
                'usuario_sgde'                      => 'codigo_despacho',
                'vigilancia_judiciales'             => 'codigo_despacho',
                'empleados'                         => 'cod_despacho',
                //'despachos'                         => 'codigoDespacho',
            ];

            $tablasConError = [];

            foreach ($mapeoTablas as $tabla => $columna) {

                try {

                    DB::table($tabla)
                        ->where($columna, $antiguo)
                        ->update([$columna => $nuevo]);

                    // Registrar log
                    DB::table('codigo_logs')->insert([
                        'tabla'          => $tabla,
                        'codigo_antiguo' => $antiguo,
                        'codigo_nuevo'   => $nuevo,
                        'fecha_cambio'   => now()
                    ]);

                } catch (\Exception $e) {

                    $tablasConError[] = $tabla;

                    Log::warning("Error actualizando {$tabla}: " . $e->getMessage());
                }
            }

            if (!empty($tablasConError)) {
                return [
                    'success' => false,
                    'error'   => 'Error en tablas: ' . implode(', ', $tablasConError)
                ];
            }

            return ['success' => true];

        } catch (\Exception $e) {

            Log::error('Error cambio global despacho: ' . $e->getMessage());

            return [
                'success' => false,
                'error'   => $e->getMessage()
            ];
        }
    }
}