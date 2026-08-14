<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EstadisticasController extends Controller
{
    public function index(Request $request)
    {
        // Mes seleccionado en formato YYYY-MM
        $mesSeleccionado = $request->query('mes');
        if (!$mesSeleccionado || !preg_match('/^\d{4}-\d{2}$/', $mesSeleccionado)) {
            $mesSeleccionado = now()->format('Y-m');
        }

        try {
            $dt = Carbon::createFromFormat('Y-m', $mesSeleccionado)->startOfMonth();
        } catch (\Exception $e) {
            $dt = now()->startOfMonth();
            $mesSeleccionado = $dt->format('Y-m');
        }

        $anio = (int) $dt->year;
        $mes  = (int) $dt->month;

        // Rango de últimos 12 meses hasta el mes seleccionado
        $desde = $dt->copy()->subMonths(11)->startOfMonth();
        $hasta = $dt->copy()->endOfMonth();

        // Promedios mensuales (1..5) por pregunta y conteo de casos
        $promediosMensuales = DB::table('soporte_usuarios_pdf')
            ->selectRaw('
                DATE_FORMAT(fecha_atencion, "%Y-%m") as mes,
                AVG(NULLIF(disposicion,0))       as dispo,
                AVG(NULLIF(conocimiento_tec,0)) as conocimiento,
                AVG(NULLIF(tiempo_aten,0))      as tiempo,
                AVG(NULLIF(avance_caso,0))      as avance,
                COUNT(*)                        as total_casos
            ')
            ->whereNotNull('fecha_atencion')
            ->whereBetween('fecha_atencion', [$desde, $hasta])
            ->groupByRaw('DATE_FORMAT(fecha_atencion, "%Y-%m")')
            ->orderBy('mes')
            ->get();

        // Requerimientos del mes seleccionado
        $totalRequerimientosMes = DB::table('soporte_usuarios_pdf')
            ->whereYear('fecha_atencion', $anio)
            ->whereMonth('fecha_atencion', $mes)
            ->count();

        // Distribuciones (conteos 1..5) + totales y % por cada campo del mes seleccionado
        $dist = [
            'disposicion'       => $this->distribucion('disposicion', $anio, $mes, $totalRequerimientosMes),
            'conocimiento_tec'  => $this->distribucion('conocimiento_tec', $anio, $mes, $totalRequerimientosMes),
            'tiempo_aten'       => $this->distribucion('tiempo_aten', $anio, $mes, $totalRequerimientosMes),
            'avance_caso'       => $this->distribucion('avance_caso', $anio, $mes, $totalRequerimientosMes),
        ];

        $estadisticasGenerales = $this->obtenerEstadisticasGenerales($anio, $mes);

        // Tabla de calificaciones del mes (1..5) con % vertical por ítem
        $tablaCalificaciones = $this->tablaCalificaciones($dist, $totalRequerimientosMes);

        return view('administrador.Estadisticas.Soporte.Index', compact(
            'promediosMensuales',
            'dist',
            'estadisticasGenerales',
            'totalRequerimientosMes',
            'mesSeleccionado',
            'tablaCalificaciones'
        ));
    }

    private function distribucion(string $campo, int $anio, int $mes, int $reqMes): array
    {
        $rows = DB::table('soporte_usuarios_pdf')
            ->selectRaw("$campo as valor, COUNT(*) as cantidad")
            ->whereYear('fecha_atencion', $anio)
            ->whereMonth('fecha_atencion', $mes)
            ->whereBetween($campo, [1, 5])
            ->groupBy('valor')
            ->pluck('cantidad', 'valor')
            ->toArray();

        $conteos = [];
        $totalRespuestas = 0;
        $sumaCalificaciones = 0;

        for ($i = 1; $i <= 5; $i++) {
            $conteos[$i] = isset($rows[$i]) ? (int) $rows[$i] : 0;
            $totalRespuestas += $conteos[$i];
            $sumaCalificaciones += ($i * $conteos[$i]);
        }

        $porcentaje = $reqMes > 0 ? round(($totalRespuestas / $reqMes) * 100, 2) : 0.0;
        $promedio   = $totalRespuestas > 0 ? round($sumaCalificaciones / $totalRespuestas, 2) : 0.0;

        $porcentajesPorCalificacion = [];
        for ($i = 1; $i <= 5; $i++) {
            $porcentajesPorCalificacion[$i] = $totalRespuestas > 0
                ? round(($conteos[$i] / $totalRespuestas) * 100, 1)
                : 0.0;
        }

        return [
            'conteos' => array_values($conteos), // [c1..c5]
            'total' => $totalRespuestas,        // total del ítem
            'reqMes' => $reqMes,
            'porcentaje' => $porcentaje,        // % del ítem vs solicitudes
            'promedio' => $promedio,
            'porcentajesPorCalificacion' => array_values($porcentajesPorCalificacion),
        ];
    }

    // Construye filas para la tabla "Calificaciones del mes" con % vertical por ítem
    private function tablaCalificaciones(array $dist, int $totalRequerimientosMes): array
    {
        $totalesItem = [
            'disposicion'      => $dist['disposicion']['total']       ?? 0,
            'conocimiento_tec' => $dist['conocimiento_tec']['total']  ?? 0,
            'tiempo_aten'      => $dist['tiempo_aten']['total']       ?? 0,
            'avance_caso'      => $dist['avance_caso']['total']       ?? 0,
        ];

        $rows = [];
        for ($valor = 1; $valor <= 5; $valor++) {
            $dispo = $dist['disposicion']['conteos'][$valor - 1]      ?? 0;
            $cono  = $dist['conocimiento_tec']['conteos'][$valor - 1] ?? 0;
            $tiem  = $dist['tiempo_aten']['conteos'][$valor - 1]      ?? 0;
            $avan  = $dist['avance_caso']['conteos'][$valor - 1]      ?? 0;

            $rows[] = [
                'valor' => $valor,
                'disposicion' => $dispo,
                'conocimiento_tec' => $cono,
                'tiempo_aten' => $tiem,
                'avance_caso' => $avan,
                'total' => $dispo + $cono + $tiem + $avan,

                // % vertical por ítem (cada celda vs total de su ítem)
                'pct_disposicion'      => $totalesItem['disposicion']      > 0 ? round(($dispo / $totalesItem['disposicion']) * 100, 2) : 0.0,
                'pct_conocimiento_tec' => $totalesItem['conocimiento_tec'] > 0 ? round(($cono  / $totalesItem['conocimiento_tec']) * 100, 2) : 0.0,
                'pct_tiempo_aten'      => $totalesItem['tiempo_aten']      > 0 ? round(($tiem  / $totalesItem['tiempo_aten']) * 100, 2) : 0.0,
                'pct_avance_caso'      => $totalesItem['avance_caso']      > 0 ? round(($avan  / $totalesItem['avance_caso']) * 100, 2) : 0.0,
            ];
        }
        return $rows;
    }

    private function obtenerEstadisticasGenerales(int $anio, int $mes): array
    {
        $actual = Carbon::create($anio, $mes, 1);
        $anterior = $actual->copy()->subMonth();

        $promedioGeneralMes = DB::table('soporte_usuarios_pdf')
            ->whereYear('fecha_atencion', $anio)
            ->whereMonth('fecha_atencion', $mes)
            ->selectRaw('
                AVG((NULLIF(disposicion,0) + NULLIF(conocimiento_tec,0) +
                     NULLIF(tiempo_aten,0) + NULLIF(avance_caso,0)) / 4) as promedio_general
            ')
            ->value('promedio_general');

        return [
            'total_casos_mes_actual' => DB::table('soporte_usuarios_pdf')
                ->whereYear('fecha_atencion', $anio)
                ->whereMonth('fecha_atencion', $mes)
                ->count(),
            'total_casos_mes_anterior' => DB::table('soporte_usuarios_pdf')
                ->whereYear('fecha_atencion', $anterior->year)
                ->whereMonth('fecha_atencion', $anterior->month)
                ->count(),
            'promedio_general_mes' => $promedioGeneralMes ? round($promedioGeneralMes, 2) : 0.0,
            'casos_con_calificacion_alta' => DB::table('soporte_usuarios_pdf')
                ->whereYear('fecha_atencion', $anio)
                ->whereMonth('fecha_atencion', $mes)
                ->where(function ($q) {
                    $q->where('disposicion', '>=', 4)
                      ->orWhere('conocimiento_tec', '>=', 4)
                      ->orWhere('tiempo_aten', '>=', 4)
                      ->orWhere('avance_caso', '>=', 4);
                })
                ->count(),
        ];
    }
}