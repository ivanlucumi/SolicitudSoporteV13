<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
use App\Models\Empleado;
use App\Models\EncuestaSiniestro;
use App\Models\EncuestaSiniestroElemento;
use App\Models\EncuestaSiniestroFoto;
use App\Models\Inventario;
use App\Services\CorreoSiniestroService;
use App\Services\ImagenSiniestroService;
use App\Services\PdfSiniestroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EncuestaSiniestroController extends Controller
{
    public function __construct(
        protected ImagenSiniestroService  $imagenService,
        protected PdfSiniestroService     $pdfService,
        protected CorreoSiniestroService  $correoService,
    ) {
        $this->middleware('auth');
    }

    // ══════════════════════════════════════════════════════════════════════════
    // LISTADO
    // ══════════════════════════════════════════════════════════════════════════

    public function index(Request $request)
    {
        $query = EncuestaSiniestro::with('user')
            ->orderByDesc('id');

        // Filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }
        if ($request->filled('despacho')) {
            $query->where('despacho_nombre', 'LIKE', '%' . $request->despacho . '%');
        }
        // Si no es admin, solo ver los propios
        if (auth()->user()->rol != 1 && auth()->user()->tipo_rol != 'ADMINISTRACION') {
            $query->where('user_id', auth()->id());
        }

        $siniestros = $query->paginate(20)->withQueryString();

        return view('encuesta_siniestro.index', compact('siniestros'));
    }

    // ══════════════════════════════════════════════════════════════════════════
    // FORMULARIO CREACIÓN
    // ══════════════════════════════════════════════════════════════════════════

    public function create()
    {
        $despachos = DB::table('despachos')
            ->leftJoin('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->whereNull('despachos.estado')
            ->select(
                'despachos.codigoDespacho',
                'despachos.nombreDespacho',
                'despachos.correoD',
                'despachos.direccion',
                'despachos.telefono',
                'ciudades.nombreCiudad as ciudad'
            )
            ->orderBy('despachos.nombreDespacho')
            ->get();

        // Códigos de despachos que ya tienen un siniestro registrado (no borrador)
        $despachosRegistrados = EncuestaSiniestro::whereIn('estado', ['registrado', 'enviado', 'en_revision', 'cerrado'])
            ->pluck('despacho_codigo')
            ->unique()
            ->values()
            ->toArray();

        return view('encuesta_siniestro.create', compact('despachos', 'despachosRegistrados'));
    }

    // ══════════════════════════════════════════════════════════════════════════
    // GUARDAR CABECERA (AJAX – Paso 1)
    // ══════════════════════════════════════════════════════════════════════════

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'despacho_codigo'  => 'required|string|max:20',
            'despacho_nombre'  => 'required|string|max:255',
            'fecha_siniestro'  => 'required|date',
        ]);

        // ── Verificar unicidad por despacho ───────────────────────────────────
        // Si viene un siniestro_id existente (actualización de borrador), lo permitimos.
        // Si no, bloqueamos si ya existe un siniestro activo (no borrador) para ese despacho.
        $existente = EncuestaSiniestro::where('despacho_codigo', $request->despacho_codigo)
            ->where('estado', 'borrador')
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($existente && (!$request->filled('siniestro_id') || $existente->id != $request->siniestro_id)) {
            return response()->json([
                'ok'            => false,
                'duplicado'     => true,
                'mensaje'       => "El despacho '{$request->despacho_nombre}' ya tiene un siniestro registrado ({$existente->consecutivo}).",
                'siniestro_url' => route('encuesta.siniestro.show', $existente->id),
                'consecutivo'   => $existente->consecutivo,
                'estado'        => $existente->estado_label,
                'fecha'         => optional($existente->fecha_siniestro)->format('d/m/Y'),
            ], 409);
        }

        DB::beginTransaction();
        try {
            if ($request->filled('siniestro_id')) {
                $siniestro = EncuestaSiniestro::findOrFail($request->siniestro_id);
                $siniestro->update([
                    'despacho_codigo'   => $request->despacho_codigo,
                    'despacho_nombre'   => $request->despacho_nombre,
                    'despacho_correo'   => $request->despacho_correo,
                    'despacho_ciudad'   => $request->despacho_ciudad,
                    'despacho_direccion'=> $request->despacho_direccion,
                    'titular_nombre'    => $request->titular_nombre,
                    'titular_cedula'    => $request->titular_cedula,
                    'titular_cargo'     => $request->titular_cargo,
                    'titular_correo'    => $request->titular_correo,
                    'titular_telefono'  => $request->titular_telefono,
                    'empleados_json'    => $request->empleados ? json_decode($request->empleados, true) : null,
                    'fecha_siniestro'   => $request->fecha_siniestro,
                    'observaciones_generales' => $request->observaciones_generales,
                    'url_fotos'         => $request->url_fotos,
                    'firma_empleado'    => $request->firma_empleado,
                ]);
            } else {
                $siniestro = EncuestaSiniestro::create([
                    'consecutivo'       => EncuestaSiniestro::generarConsecutivo(),
                    'despacho_codigo'   => $request->despacho_codigo,
                    'despacho_nombre'   => $request->despacho_nombre,
                    'despacho_correo'   => $request->despacho_correo,
                    'despacho_ciudad'   => $request->despacho_ciudad,
                    'despacho_direccion'=> $request->despacho_direccion,
                    'titular_nombre'    => $request->titular_nombre,
                    'titular_cedula'    => $request->titular_cedula,
                    'titular_cargo'     => $request->titular_cargo,
                    'titular_correo'    => $request->titular_correo,
                    'titular_telefono'  => $request->titular_telefono,
                    'empleados_json'    => $request->empleados ? json_decode($request->empleados, true) : null,
                    'fecha_siniestro'   => $request->fecha_siniestro,
                    'observaciones_generales' => $request->observaciones_generales,
                    'url_fotos'         => $request->url_fotos,
                    'firma_empleado'    => $request->firma_empleado,
                    'estado'            => 'borrador',
                    'user_id'           => auth()->id(),
                ]);
            }

            DB::commit();

            return response()->json([
                'ok'           => true,
                'siniestro_id' => $siniestro->id,
                'consecutivo'  => $siniestro->consecutivo,
                'mensaje'      => 'Siniestro creado correctamente.',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar EncuestaSiniestro: ' . $e->getMessage());
            return response()->json(['ok' => false, 'mensaje' => 'Error al guardar: ' . $e->getMessage()], 500);
        }
    }

    // ══════════════════════════════════════════════════════════════════════════
    // GUARDAR/ACTUALIZAR ELEMENTO (AJAX – Guardado progresivo)
    // ══════════════════════════════════════════════════════════════════════════

    public function storeElemento(Request $request): JsonResponse
    {
        $request->validate([
            'siniestro_id'  => 'required|exists:encuesta_siniestros,id',
            'tipo_elemento' => 'required|string|max:150',
        ]);

        DB::beginTransaction();
        try {
            $siniestro = EncuestaSiniestro::findOrFail($request->siniestro_id);

            // Si ya existe el elemento (edición), actualizarlo
            if ($request->filled('elemento_id')) {
                $elemento = EncuestaSiniestroElemento::where('id', $request->elemento_id)
                    ->where('encuesta_siniestro_id', $siniestro->id)
                    ->firstOrFail();
                $elemento->update($this->datosElemento($request));
            } else {
                $elemento = EncuestaSiniestroElemento::create(
                    array_merge(['encuesta_siniestro_id' => $siniestro->id], $this->datosElemento($request))
                );
            }

            DB::commit();
            Log::info("Elemento guardado exitosamente. Siniestro ID: {$siniestro->id}, Elemento ID: {$elemento->id}");

            return response()->json([
                'ok'          => true,
                'elemento_id' => $elemento->id,
                'mensaje'     => '✅ Elemento guardado correctamente.',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar elemento siniestro: ' . $e->getMessage());
            return response()->json(['ok' => false, 'mensaje' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // ══════════════════════════════════════════════════════════════════════════
    // SUBIR FOTO DE ELEMENTO (AJAX)
    // ══════════════════════════════════════════════════════════════════════════

    public function storeFoto(Request $request): JsonResponse
    {
        $request->validate([
            'elemento_id' => 'required|exists:encuesta_siniestro_elementos,id',
            'foto'        => 'required|file|mimes:jpeg,png,jpg,webp|max:15360', // 15MB máx pre-compresión
        ]);

        try {
            $elemento  = EncuestaSiniestroElemento::with('siniestro')->findOrFail($request->elemento_id);
            $codigo    = $elemento->siniestro->despacho_codigo ?? 'SIN_CODIGO';

            $resultado = $this->imagenService->guardar($request->file('foto'), $codigo, $elemento->id);
            
            // --- SUBIR A AZURE ---
            $blobClient = \MicrosoftAzure\Storage\Blob\BlobRestProxy::createBlobService(env('AZURE_STORAGE_CONNECTION_STRING'));
            $containerName = 'siniestro';
            $blobPath = "{$codigo}/{$resultado['nombre']}";
            
            $localFilePath = storage_path('app/public/' . $resultado['ruta']);
            $stream = fopen($localFilePath, 'r');
            $blobClient->createBlockBlob($containerName, $blobPath, $stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
            
            // --- BORRAR LOCAL ---
            @unlink($localFilePath);

            $foto = EncuestaSiniestroFoto::create([
                'elemento_id'  => $elemento->id,
                'ruta_archivo' => $blobPath, // Guardamos la ruta de Azure
                'nombre_archivo'=> $resultado['nombre'],
                'tamanio'      => $resultado['tamanio'],
                'mime_type'    => $resultado['mime'],
            ]);
            
            // La URL ahora debe apuntar a Azure para que el frontend la muestre
            $azureUrl = "https://" . env('AZURE_STORAGE_ACCOUNT') . ".blob.core.windows.net/{$containerName}/{$blobPath}";

            return response()->json([
                'ok'       => true,
                'foto_id'  => $foto->id,
                'url'      => $azureUrl,
                'tamanio'  => round($resultado['tamanio'] / 1024, 1) . ' KB',
                'mensaje'  => '📷 Foto guardada en Azure correctamente.',
            ]);

        } catch (\Exception $e) {
            Log::error('Error subiendo foto siniestro: ' . $e->getMessage());
            return response()->json(['ok' => false, 'mensaje' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // ══════════════════════════════════════════════════════════════════════════
    // ELIMINAR FOTO (AJAX)
    // ══════════════════════════════════════════════════════════════════════════

    public function deleteFoto(int $id): JsonResponse
    {
        try {
            $foto = EncuestaSiniestroFoto::findOrFail($id);
            $this->imagenService->eliminar($foto->ruta_archivo);
            $foto->delete();

            return response()->json(['ok' => true, 'mensaje' => 'Foto eliminada.']);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'mensaje' => 'Error al eliminar.'], 500);
        }
    }

    // ══════════════════════════════════════════════════════════════════════════
    // FINALIZAR: generar PDF + enviar correo
    // ══════════════════════════════════════════════════════════════════════════

    public function finalizar(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $siniestro = EncuestaSiniestro::with('elementos.fotos', 'user')->findOrFail($id);

            // Actualizar observaciones generales y nuevos campos si vienen
            $updateData = [];
            if ($request->has('observaciones_generales')) {
                $updateData['observaciones_generales'] = $request->observaciones_generales;
            }
            if ($request->has('url_fotos')) {
                $updateData['url_fotos'] = $request->url_fotos;
            }
            if ($request->has('firma_empleado')) {
                $updateData['firma_empleado'] = $request->firma_empleado;
            }
            if (!empty($updateData)) {
                $siniestro->update($updateData);
            }

            \Log::info("Finalizando siniestro ID {$id}. Elementos detectados: " . $siniestro->elementos->count());
            \Log::info("Contenido del siniestro: ", $siniestro->toArray());

            // Validar que tenga al menos un elemento
            if ($siniestro->elementos->isEmpty()) {
                return response()->json([
                    'ok' => false, 
                    'mensaje' => 'Debe agregar al menos un elemento afectado.'
                ], 422);
            }

            // Cambiar estado a registrado
            $siniestro->update(['estado' => 'registrado']);

            DB::commit();

            // Generar PDF
            $mensajePdf = '';
            try {
                $rutaPdf = $this->pdfService->generar($siniestro->fresh());
                $mensajePdf = '✅ PDF generado correctamente.';
            } catch (\Exception $e) {
                Log::error('Error generando PDF siniestro: ' . $e->getMessage());
                $mensajePdf = '⚠️ PDF no pudo generarse: ' . $e->getMessage();
            }

            // Enviar correo
            $siniestro->refresh();
            $resultadoCorreo = $this->correoService->enviar($siniestro);

            // Actualizar estado de correo en BD
            $siniestro->update([
                'correo_enviado'      => $resultadoCorreo['enviado'],
                'correo_enviado_at'   => $resultadoCorreo['enviado'] ? now() : null,
                'correo_destinatarios'=> $resultadoCorreo['destinatarios'],
                'correo_error'        => $resultadoCorreo['error'],
                'estado'              => $resultadoCorreo['enviado'] ? 'enviado' : 'registrado',
            ]);

            return response()->json([
                'ok'          => true,
                'consecutivo' => $siniestro->consecutivo,
                'pdf_ok'      => str_contains($mensajePdf, '✅'),
                'pdf_msg'     => $mensajePdf,
                'correo_ok'   => $resultadoCorreo['enviado'],
                'correo_msg'  => $resultadoCorreo['enviado']
                    ? '📧 Correo enviado a: ' . $resultadoCorreo['destinatarios']
                    : '⚠️ Correo no enviado: ' . $resultadoCorreo['error'],
                'redirect'    => route('encuesta.siniestro.show', $siniestro->id),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al finalizar siniestro: ' . $e->getMessage());
            return response()->json(['ok' => false, 'mensaje' => 'Error al finalizar: ' . $e->getMessage()], 500);
        }
    }

    // ══════════════════════════════════════════════════════════════════════════
    // DETALLE
    // ══════════════════════════════════════════════════════════════════════════

    public function show(int $id)
    {
        $siniestro = EncuestaSiniestro::with('elementos.fotos', 'user')->findOrFail($id);
        return view('encuesta_siniestro.show', compact('siniestro'));
    }

    // ══════════════════════════════════════════════════════════════════════════
    // GENERAR / DESCARGAR PDF
    // ══════════════════════════════════════════════════════════════════════════

    public function generarPdf(int $id)
    {
        $siniestro = EncuestaSiniestro::with('elementos.fotos', 'user')->findOrFail($id);
        return $this->pdfService->descargar($siniestro);
    }

    // ══════════════════════════════════════════════════════════════════════════
    // REENVIAR CORREO
    // ══════════════════════════════════════════════════════════════════════════

    public function reenviarCorreo(int $id): JsonResponse
    {
        try {
            $siniestro = EncuestaSiniestro::findOrFail($id);

            // Regenerar PDF si no existe
            if (!$siniestro->pdf_path || !file_exists(storage_path('app/public/' . $siniestro->pdf_path))) {
                $this->pdfService->generar($siniestro);
                $siniestro->refresh();
            }

            $resultado = $this->correoService->enviar($siniestro);

            $siniestro->update([
                'correo_enviado'      => $resultado['enviado'],
                'correo_enviado_at'   => $resultado['enviado'] ? now() : null,
                'correo_destinatarios'=> $resultado['destinatarios'],
                'correo_error'        => $resultado['error'],
                'estado'              => $resultado['enviado'] ? 'enviado' : $siniestro->estado,
            ]);

            return response()->json([
                'ok'     => $resultado['enviado'],
                'mensaje'=> $resultado['enviado']
                    ? '📧 Correo reenviado correctamente.'
                    : '❌ Error: ' . $resultado['error'],
            ]);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'mensaje' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // ══════════════════════════════════════════════════════════════════════════
    // AJAX HELPERS
    // ══════════════════════════════════════════════════════════════════════════

    /**
     * Verifica si un despacho ya tiene un siniestro registrado.
     * Devuelve { registrado: bool, siniestro: {...} | null }
     */
    public function ajaxVerificarDespacho(string $codigo): JsonResponse
    {
        $siniestro = EncuestaSiniestro::where('despacho_codigo', $codigo)
            ->whereIn('estado', ['registrado', 'enviado', 'en_revision', 'cerrado'])
            ->orderByDesc('id')
            ->first();

        if (!$siniestro) {
            return response()->json(['registrado' => false]);
        }

        return response()->json([
            'registrado'    => true,
            'consecutivo'   => $siniestro->consecutivo,
            'estado'        => $siniestro->estado_label,
            'fecha'         => optional($siniestro->fecha_siniestro)->format('d/m/Y'),
            'elementos'     => $siniestro->elementos()->count(),
            'siniestro_url' => route('encuesta.siniestro.show', $siniestro->id),
        ]);
    }

    public function ajaxDespacho(string $codigo): JsonResponse
    {
        $despacho = DB::table('despachos')
            ->leftJoin('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->where('despachos.codigoDespacho', $codigo)
            ->select(
                'despachos.codigoDespacho',
                'despachos.nombreDespacho',
                'despachos.correoD',
                'despachos.direccion',
                'despachos.telefono',
                'ciudades.nombreCiudad as ciudad'
            )
            ->first();

        if (!$despacho) {
            return response()->json(['ok' => false, 'mensaje' => 'Despacho no encontrado'], 404);
        }

        return response()->json(['ok' => true, 'despacho' => $despacho]);
    }

    public function ajaxEmpleados(string $codigo): JsonResponse
    {
        $empleados = DB::table('empleados')
            ->where('cod_despacho', $codigo)
            ->whereIn('estado', ['A', 'ACTIVO', 'ACTIVE'])
            ->select('id', 'cedulaE', 'nameE', 'lastnameE', 'cargo_titular', 'cod_despacho')
            ->orderBy('nameE')
            ->get()
            ->map(fn($e) => [
                'id'      => $e->id,
                'cedula'  => $e->cedulaE,
                'nombre'  => trim("{$e->nameE} {$e->lastnameE}"),
                'cargo'   => $e->cargo_titular,
                'despacho'=> $e->cod_despacho,
            ]);

        return response()->json(['ok' => true, 'empleados' => $empleados]);
    }

    public function ajaxEmpleadoCedula(string $cedula): JsonResponse
    {
        $empleado = DB::table('empleados')
            ->where('cedulaE', $cedula)
            ->whereIn('estado', ['A', 'ACTIVO', 'ACTIVE'])
            ->select('id', 'cedulaE', 'nameE', 'lastnameE', 'cargo_titular', 'cod_despacho')
            ->first();

        if (!$empleado) {
            return response()->json(['ok' => false, 'mensaje' => 'Empleado no encontrado o inactivo']);
        }

        return response()->json([
            'ok' => true, 
            'empleado' => [
                'id'      => $empleado->id,
                'cedula'  => $empleado->cedulaE,
                'nombre'  => trim("{$empleado->nameE} {$empleado->lastnameE}"),
                'cargo'   => $empleado->cargo_titular,
                'despacho'=> $empleado->cod_despacho,
            ]
        ]);
    }

    public function ajaxBuscarDespachos(Request $request): JsonResponse
    {
        $term = $request->query('q', '');
        
        $query = Despacho::whereNull('estado')
            ->select('codigoDespacho', 'nombreDespacho', 'correoD', 'direccion');
            
        if (!empty($term)) {
            $query->where(function($q) use ($term) {
                $q->where('nombreDespacho', 'LIKE', '%' . $term . '%')
                  ->orWhere('codigoDespacho', 'LIKE', '%' . $term . '%');
            });
        }
        
        // Paginación para Select2
        $despachos = $query->orderBy('nombreDespacho')->paginate(30);
        
        $resultados = $despachos->map(function($d) {
            return [
                'id' => $d->codigoDespacho,
                'text' => $d->nombreDespacho . ' (' . $d->codigoDespacho . ')',
                'element' => [
                    'nombre' => $d->nombreDespacho,
                    'correo' => $d->correoD,
                    'dir' => $d->direccion,
                    'codigo' => $d->codigoDespacho
                ]
            ];
        });

        return response()->json([
            'results' => $resultados,
            'pagination' => ['more' => $despachos->hasMorePages()]
        ]);
    }

    public function ajaxInventario(string $codigo): JsonResponse
    {
        $items = DB::table('inventarios')
            ->join('elementos', 'inventarios.codigoElemento', '=', 'elementos.id')
            ->where('inventarios.codigoJuzgado', $codigo)
            ->whereIn('inventarios.estadoPlaca', ['1', 'ACTIVOS', 'ACTIVO'])
            ->select(
                'inventarios.id',
                'inventarios.placaInventario',
                'inventarios.marca',
                'inventarios.modelo',
                'inventarios.serial',
                'elementos.nombreElemento'
            )
            ->orderBy('elementos.nombreElemento')
            ->get();

        return response()->json(['ok' => true, 'inventario' => $items]);
    }

    // ══════════════════════════════════════════════════════════════════════════
    // HELPERS PRIVADOS
    // ══════════════════════════════════════════════════════════════════════════

    private function datosElemento(Request $request): array
    {
        return [
            'inventario_id'    => $request->inventario_id ?: null,
            'tipo_elemento'    => $request->tipo_elemento,
            'nombre_elemento'  => $request->nombre_elemento,
            'placa'            => $request->placa,
            'serial'           => $request->serial,
            'marca'            => $request->marca,
            'modelo'           => $request->modelo,
            'estado_anterior'  => $request->estado_anterior,
            'estado_posterior' => $request->estado_posterior,
            'descripcion_dano' => $request->descripcion_dano,
            'observaciones'    => $request->observaciones,
        ];
    }
}
