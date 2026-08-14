@extends('layouts.Almacen.Almacen')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4"><i class="fa fa-warehouse"></i> Dashboard de Solicitudes - CALI</h1>
    
    <!-- Filtros -->
    <div class="panel panel-primary mb-4">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-filter"></i> Filtros de Búsqueda</h3>
        </div>
        <div class="panel-body">
            <form method="GET" action="{{ route('solicitudes.dashboard') }}">
                <div class="row">
                    <!-- Filtros por fecha -->
                    <div class="col-md-2 form-group">
                        <label for="fecha_inicio">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="fecha_fin">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                    </div>
                    
                    <!-- Filtro por mes -->
                    <div class="col-md-2 form-group">
                        <label for="mes">Mes</label>
                        <select name="mes" class="form-control">
                            <option value="">Todos</option>
                            @foreach(range(1, 12) as $mes)
                                <option value="{{ $mes }}" {{ request('mes') == $mes ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $mes)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Filtro por despacho -->
                    <div class="col-md-3 form-group">
                        <label for="despacho">Despacho</label>
                        <select name="despacho" class="form-control">
                            <option value="">Todos</option>
                            @foreach($despachos as $despacho)
                                <option value="{{ $despacho }}" {{ request('despacho') == $despacho ? 'selected' : '' }}>
                                    {{ $despacho }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Filtro por estado de entrega -->
                    <div class="col-md-2 form-group">
                        <label for="entrega">Estado Entrega</label>
                        <select name="entrega" class="form-control">
                            <option value="">Todos</option>
                            <option value="ENTREGADO" {{ request('entrega') == 'ENTREGADO' ? 'selected' : '' }}>Entregadas</option>
                            <option value="NO_ENTREGADO" {{ request('entrega') == 'NO_ENTREGADO' ? 'selected' : '' }}>No Entregadas</option>
                        </select>
                    </div>
                    
                    <!-- Filtro por elemento -->
                    <div class="col-md-3 form-group">
                        <label for="elemento">Elemento</label>
                        <input type="text" name="elemento" class="form-control" value="{{ request('elemento') }}" placeholder="Buscar elemento...">
                    </div>
                </div>
                <div class="row">
                    <!-- Botones de acción -->
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-filter"></i> Aplicar Filtros
                        </button>
                        <a href="{{ route('solicitudes.dashboard') }}" class="btn btn-default">
                            <i class="fa fa-broom"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Resumen Estadístico -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="panel-title"><i class="fa fa-paper-plane"></i> Solicitudes Enviadas</h4>
                            <h2 class="mb-0">{{ $estadisticas['total'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="panel-title"><i class="fa fa-check-circle"></i> Entregadas</h4>
                            <h2 class="mb-0">{{ $estadisticas['entregadas'] }}</h2>
                            <small class="text-muted">{{ $estadisticas['total'] > 0 ? round(($estadisticas['entregadas']/$estadisticas['total'])*100, 1) : 0 }}% del total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="panel-title"><i class="fa fa-clock-o"></i> Pendientes</h4>
                            <h2 class="mb-0">{{ $estadisticas['no_entregadas'] }}</h2>
                            <small class="text-muted">{{ $estadisticas['total'] > 0 ? round(($estadisticas['no_entregadas']/$estadisticas['total'])*100, 1) : 0 }}% del total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Gráficos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart"></i> Solicitudes por Mes</h3>
                </div>
                <div class="panel-body">
                    <canvas id="chartPorMes" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pie-chart"></i> Proporción Entregadas/Pendientes</h3>
                </div>
                <div class="panel-body">
                    <canvas id="chartProporcion" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabla de Solicitudes -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="panel-title"><i class="fa fa-table"></i> Listado de Solicitudes Enviadas - CALI</h3>
                </div>
                <div class="col-md-6 text-right">
                    <span class="badge bg-success"><i class="fa fa-check-circle"></i> Entregadas: {{ $estadisticas['entregadas'] }}</span>
                    <span class="badge bg-warning"><i class="fa fa-clock-o"></i> Pendientes: {{ $estadisticas['no_entregadas'] }}</span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><i class="fa fa-calendar"></i> Fecha</th>
                            <th><i class="fa fa-building"></i> Despacho</th>
                            <th><i class="fa fa-cube"></i> Elemento</th>
                            <th><i class="fa fa-hashtag"></i> Cantidad</th>
                            <th><i class="fa fa-truck"></i> Estado Entrega</th>
                            <th><i class="fa fa-calendar-check-o"></i> Fecha Entrega</th>
                            <th><i class="fa fa-user"></i> Atendió</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->fecha_solicitud }}</td>
                            <td>{{ $solicitud->despacho }}</td>
                            <td>{{ $solicitud->elemento }}</td>
                            <td>{{ $solicitud->cantidad }}</td>
                            <td>
                                @if($solicitud->quien_atendio)
                                    <span class="label label-success"><i class="fa fa-check-circle"></i> ENTREGADO</span>
                                @else
                                    <span class="label label-warning"><i class="fa fa-clock-o"></i> PENDIENTE</span>
                                @endif
                            </td>
                            <td>{{ $solicitud->fecha_entrega ? $solicitud->fecha_entrega : '--' }}</td>
                            <td>{{ $solicitud->quien_atendio ?? '--' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 text-muted">
                    Mostrando {{ $solicitudes->firstItem() }} a {{ $solicitudes->lastItem() }} de {{ $solicitudes->total() }} registros
                </div>
                <div class="col-md-6 text-right">
                    {{ $solicitudes->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .panel {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .panel-heading {
        border-radius: 0;
    }
    .table th {
        white-space: nowrap;
        vertical-align: middle;
    }
    .badge, .label {
        font-size: 90%;
        padding: 0.4em 0.6em;
        font-weight: 500;
    }
    .panel-primary .panel-heading {
        background-color: #337ab7;
        border-color: #337ab7;
    }
    .panel-success .panel-heading {
        background-color: #5cb85c;
        border-color: #5cb85c;
    }
    .panel-warning .panel-heading {
        background-color: #f0ad4e;
        border-color: #f0ad4e;
    }
</style>
@endpush

@push('scripts')
<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Incluir Font Awesome 4 (compatible con Bootstrap 3) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    // Gráfico por Mes
    const ctxMes = document.getElementById('chartPorMes').getContext('2d');
    new Chart(ctxMes, {
        type: 'bar',
        data: {
            labels: {!! json_encode($estadisticas['por_mes']->pluck('mes')) !!},
            datasets: [
                {
                    label: 'Entregadas',
                    data: {!! json_encode($estadisticas['por_mes']->pluck('entregadas')) !!},
                    backgroundColor: 'rgba(92, 184, 92, 0.7)',
                    borderColor: 'rgba(92, 184, 92, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Pendientes',
                    data: {!! json_encode($estadisticas['por_mes']->pluck('no_entregadas')) !!},
                    backgroundColor: 'rgba(240, 173, 78, 0.7)',
                    borderColor: 'rgba(240, 173, 78, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
    
    // Gráfico de Proporción
    const ctxProporcion = document.getElementById('chartProporcion').getContext('2d');
    new Chart(ctxProporcion, {
        type: 'doughnut',
        data: {
            labels: ['Entregadas', 'Pendientes'],
            datasets: [{
                data: [{{ $estadisticas['entregadas'] }}, {{ $estadisticas['no_entregadas'] }}],
                backgroundColor: [
                    'rgba(92, 184, 92, 0.7)',
                    'rgba(240, 173, 78, 0.7)'
                ],
                borderColor: [
                    'rgba(92, 184, 92, 1)',
                    'rgba(240, 173, 78, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw;
                            const percentage = Math.round((value / total) * 100);
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush