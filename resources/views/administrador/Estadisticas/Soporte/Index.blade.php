@extends('layouts.admin')

@section('title', 'Estadísticas')
@section('cabecera', '📊 Dashboard de Estadísticas - Mesa de Ayuda')

@section('content')
    @include('../alerts.success')
    @include('../alerts.request')

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">

    {{-- Filtro por mes --}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-filter"></i> Filtro por mes</h3>
                </div>
                <div class="box-body">
                    <form method="GET" action="{{ url()->current() }}" class="form-inline">
                        <div class="form-group" style="margin-right:12px;">
                            <label for="mes" style="margin-right:8px;">Selecciona el mes:</label>
                            <input type="month" class="form-control" id="mes" name="mes"
                                   value="{{ $mesSeleccionado ?? now()->format('Y-m') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-refresh"></i> Aplicar
                        </button>
                        <a href="{{ url()->current() }}" class="btn btn-default" style="margin-left:6px;">
                            Limpiar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- KPIs --}}
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 class="kpi-number">{{ number_format($totalRequerimientosMes) }}</h3>
                    <p>Casos del mes</p>
                </div>
                <div class="icon"><i class="fa fa-ticket"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 class="kpi-number">{{ number_format($estadisticasGenerales['promedio_general_mes'], 2) }}</h3>
                    <p>Promedio general</p>
                </div>
                <div class="icon"><i class="fa fa-star"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 class="kpi-number">{{ number_format($estadisticasGenerales['casos_con_calificacion_alta']) }}</h3>
                    <p>Casos bien calificados (≥4)</p>
                </div>
                <div class="icon"><i class="fa fa-thumbs-up"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            @php
                $variacion = $estadisticasGenerales['total_casos_mes_actual'] - $estadisticasGenerales['total_casos_mes_anterior'];
                $porcentajeVariacion = $estadisticasGenerales['total_casos_mes_anterior'] > 0
                    ? round(($variacion / $estadisticasGenerales['total_casos_mes_anterior']) * 100, 1)
                    : 0;
            @endphp
            <div class="small-box {{ $porcentajeVariacion >= 0 ? 'bg-light-blue' : 'bg-red' }}">
                <div class="inner">
                    <h3 class="kpi-number">{{ $porcentajeVariacion > 0 ? '+' : '' }}{{ $porcentajeVariacion }}%</h3>
                    <p>Variación vs mes anterior</p>
                </div>
                <div class="icon">
                    <i class="fa fa-{{ $porcentajeVariacion >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráfico de líneas (ApexCharts) --}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-line-chart"></i> Evolución de calificaciones (últimos 12 meses)</h3>
                </div>
                <div class="box-body">
                    <div class="chart-wrap"><div id="lineChart"></div></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Donas por pregunta (ApexCharts) --}}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i> Disposición
                        <small>(Promedio: {{ $dist['disposicion']['promedio'] }})</small>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="chart-wrap"><div id="pieDisposicion"></div></div>
                    <p class="text-center text-muted" style="margin-top:8px;">
                        Total: {{ $dist['disposicion']['total'] }} respuestas
                        • {{ $dist['disposicion']['porcentaje'] }}% del mes
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i> Conocimiento Técnico
                        <small>(Promedio: {{ $dist['conocimiento_tec']['promedio'] }})</small>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="chart-wrap"><div id="pieConocimiento"></div></div>
                    <p class="text-center text-muted" style="margin-top:8px;">
                        Total: {{ $dist['conocimiento_tec']['total'] }} respuestas
                        • {{ $dist['conocimiento_tec']['porcentaje'] }}% del mes
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i> Tiempo de Atención
                        <small>(Promedio: {{ $dist['tiempo_aten']['promedio'] }})</small>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="chart-wrap"><div id="pieTiempo"></div></div>
                    <p class="text-center text-muted" style="margin-top:8px;">
                        Total: {{ $dist['tiempo_aten']['total'] }} respuestas
                        • {{ $dist['tiempo_aten']['porcentaje'] }}% del mes
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i> Avance del Caso
                        <small>(Promedio: {{ $dist['avance_caso']['promedio'] }})</small>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="chart-wrap"><div id="pieAvance"></div></div>
                    <p class="text-center text-muted" style="margin-top:8px;">
                        Total: {{ $dist['avance_caso']['total'] }} respuestas
                        • {{ $dist['avance_caso']['porcentaje'] }}% del mes
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA: Calificaciones del mes (1 a 5) con % vertical por ítem --}}
    @php
        $colorByValue = [1=>'#dc3545',2=>'#fd7e14',3=>'#ffc107',4=>'#004182',5=>'#007bff'];
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-table"></i> Calificaciones del mes por valor (1 a 5)</h3>
                    <p class="text-muted" style="margin:6px 0 0;">
                        El porcentaje de cada celda es respecto al total del ítem en el mes (vertical).
                    </p>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th style="width:90px;">Calificación</th>
                                <th>Disposición</th>
                                <th>Conocimiento Técnico</th>
                                <th>Tiempo de Atención</th>
                                <th>Avance del Caso</th>
                                <th style="width:150px;">Total calificaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tablaCalificaciones as $row)
                            <tr>
                                <td><strong>{{ $row['valor'] }} ⭐</strong></td>

                                {{-- Disposición --}}
                                <td>
                                    <div class="progress" style="height:10px; margin-bottom:6px;">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ $row['pct_disposicion'] }}%;
                                                    background-color: {{ $colorByValue[$row['valor']] }};">
                                        </div>
                                    </div>
                                    <small>{{ $row['disposicion'] }} ({{ $row['pct_disposicion'] }}%)</small>
                                </td>

                                {{-- Conocimiento Técnico --}}
                                <td>
                                    <div class="progress" style="height:10px; margin-bottom:6px;">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ $row['pct_conocimiento_tec'] }}%;
                                                    background-color: {{ $colorByValue[$row['valor']] }};">
                                        </div>
                                    </div>
                                    <small>{{ $row['conocimiento_tec'] }} ({{ $row['pct_conocimiento_tec'] }}%)</small>
                                </td>

                                {{-- Tiempo de Atención --}}
                                <td>
                                    <div class="progress" style="height:10px; margin-bottom:6px;">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ $row['pct_tiempo_aten'] }}%;
                                                    background-color: {{ $colorByValue[$row['valor']] }};">
                                        </div>
                                    </div>
                                    <small>{{ $row['tiempo_aten'] }} ({{ $row['pct_tiempo_aten'] }}%)</small>
                                </td>

                                {{-- Avance del Caso --}}
                                <td>
                                    <div class="progress" style="height:10px; margin-bottom:6px;">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ $row['pct_avance_caso'] }}%;
                                                    background-color: {{ $colorByValue[$row['valor']] }};">
                                        </div>
                                    </div>
                                    <small>{{ $row['avance_caso'] }} ({{ $row['pct_avance_caso'] }}%)</small>
                                </td>

                                {{-- Total calificaciones (suma de las 4 preguntas para ese valor) --}}
                                <td><strong>{{ $row['total'] }}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Totales</th>
                                <th>{{ array_sum(array_column($tablaCalificaciones, 'disposicion')) }}</th>
                                <th>{{ array_sum(array_column($tablaCalificaciones, 'conocimiento_tec')) }}</th>
                                <th>{{ array_sum(array_column($tablaCalificaciones, 'tiempo_aten')) }}</th>
                                <th>{{ array_sum(array_column($tablaCalificaciones, 'avance_caso')) }}</th>
                                <th>{{ array_sum(array_column($tablaCalificaciones, 'total')) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const promediosMensuales = @json($promediosMensuales ?? []);
        const dist = @json($dist ?? []);
        const labels15 = ['1 ⭐','2 ⭐','3 ⭐','4 ⭐','5 ⭐'];
        const palette = ['#dc3545','#fd7e14','#ffc107','#004182','#007bff'];

        function toMonthLabel(ym) {
            const [y, m] = String(ym).split('-').map(Number);
            const d = new Date(y, (m || 1) - 1, 1);
            return d.toLocaleDateString('es-ES', { month: 'short', year: 'numeric' });
        }
        function sum(arr){ return (arr || []).reduce((a,b)=>a + Number(b||0), 0); }

        // Línea - Evolución
        (function renderLine(){
            const el = document.querySelector('#lineChart');
            if (!el) return;

            const categories = (promediosMensuales || []).map(m => toMonthLabel(m.mes));
            const series = [
                { name: 'Disposición',           data: promediosMensuales.map(m => +(m.dispo ?? 0)) },
                { name: 'Conocimiento Técnico',  data: promediosMensuales.map(m => +(m.conocimiento ?? 0)) },
                { name: 'Tiempo de Atención',    data: promediosMensuales.map(m => +(m.tiempo ?? 0)) },
                { name: 'Avance del Caso',       data: promediosMensuales.map(m => +(m.avance ?? 0)) },
            ];

            const options = {
                chart: { type: 'line', height: 420, toolbar: { show: false } },
                series,
                xaxis: { categories, labels: { rotateAlways: true } },
                yaxis: { min: 1, max: 5, decimalsInFloat: 1, tickAmount: 8, title: { text: 'Calificación (1-5)' } },
                colors: ['#007bff','#004182','#ffc107','#dc3545'],
                stroke: { curve: 'smooth', width: 3 },
                markers: { size: 4 },
                fill: { type: 'gradient', gradient: { shadeIntensity: 0.2, opacityFrom: 0.2, opacityTo: 0.05, stops: [0, 90, 100] } },
                tooltip: { y: { formatter: (v) => (v ?? 0).toFixed(2) } },
                noData: { text: 'Sin datos', align: 'center', verticalAlign: 'middle' },
                legend: { position: 'bottom' }
            };

            new ApexCharts(el, options).render();
        })();

        // Donas - Helper
        function makeDonut(elId, dataArray, title) {
            const el = document.querySelector('#' + elId);
            if (!el) return;

            const total = sum(dataArray);
            const hasData = total > 0;

            const options = {
                chart: { type: 'donut', height: 340, toolbar: { show: false } },
                series: hasData ? dataArray.map(Number) : [],
                labels: hasData ? labels15 : [],
                colors: palette,
                legend: { position: 'bottom' },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                name: { show: true, fontSize: '13px', offsetY: 10, formatter: () => title },
                                value: { show: true, fontSize: '16px', formatter: (val) => hasData ? Math.round(val) : '0' },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: (w) => {
                                        const t = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return hasData ? t : 0;
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: { enabled: false },
                    formatter: function (val) {
                        return hasData ? `${val.toFixed(0)}%` : '';
                    },
                    style: { fontSize: '12px', fontWeight: '600' }
                },
                tooltip: {
                    y: {
                        formatter: function(val, { series }) {
                            const t = series.reduce((a,b)=>a+b, 0);
                            const pct = t ? ((val / t) * 100).toFixed(1) : 0;
                            return `${val} (${pct}%)`;
                        }
                    }
                },
                noData: {
                    text: 'Sin datos',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: { color: '#6c757d', fontSize: '14px' }
                }
            };

            new ApexCharts(el, options).render();
        }

        // Render de donas
        makeDonut('pieDisposicion',   (dist.disposicion?.conteos)      || [0,0,0,0,0], 'Disposición');
        makeDonut('pieConocimiento',  (dist.conocimiento_tec?.conteos) || [0,0,0,0,0], 'Conocimiento Técnico');
        makeDonut('pieTiempo',        (dist.tiempo_aten?.conteos)      || [0,0,0,0,0], 'Tiempo de Atención');
        makeDonut('pieAvance',        (dist.avance_caso?.conteos)      || [0,0,0,0,0], 'Avance del Caso');
    </script>

    <style>
        .chart-wrap { position: relative; height: 360px; }
        @media (max-width: 767px) { .chart-wrap { height: 320px; } }
        .small-box .inner h3.kpi-number { font-weight: 700; }
        .progress { height: 10px; }
    </style>
@endpush