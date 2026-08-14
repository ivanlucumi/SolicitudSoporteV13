@extends('layouts.admin')
@section('title', 'Estadísticas Acortador URL')
@section('cabecera', 'Estadísticas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <!-- Panel principal -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-stats"></i> Estadísticas de URLs Acortadas
                            <div class="pull-right">
                                
                            </div>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!-- Listado general de URLs -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>URL Original</th>
                                        <th>URL Acortada</th>
                                        <th>Clicks</th>
                                        <th>Último Acceso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shortenedUrls as $urlItem)
                                    <tr>
                                        <td class="text-truncate" style="max-width: 200px;" title="{{ $urlItem->original_url }}">
                                            <a href="{{ $urlItem->original_url }}" target="_blank">{{ Str::limit($urlItem->original_url, 50) }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('a/'.$urlItem->short_code) }}" target="_blank">
                                                {{ url('a/'.$urlItem->short_code) }}
                                            </a>
                                        </td>
                                        <td>{{ $urlItem->click_count }}</td>
                                        <td>
                                            @if($urlItem->last_click)
                                                {{ $urlItem->last_click->created_at->format('d/m/Y H:i') }}
                                            @else
                                                Nunca
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('stats', $urlItem->short_code) }}" 
                                               class="btn btn-xs btn-info">
                                                <i class="glyphicon glyphicon-zoom-in"></i> Detalles
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $shortenedUrls->links() }}
                        </div>

                        <!-- Detalles específicos cuando se selecciona una URL -->
                        @if(isset($selectedUrl))
                        <div class="stats-detail" style="margin-top: 30px;">
                            <div class="row url-info-section">
                                <div class="col-md-6">
                                    <div class="well well-sm">
                                        <h4 class="text-primary"><i class="glyphicon glyphicon-link"></i> URL Original</h4>
                                        <div class="url-box">
                                            <a href="{{ $selectedUrl->original_url }}" target="_blank" class="text-truncate" title="{{ $selectedUrl->original_url }}">
                                                {{ Str::limit($selectedUrl->original_url, 60) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="well well-sm">
                                        <h4 class="text-primary"><i class="glyphicon glyphicon-scissors"></i> URL Acortada</h4>
                                        <div class="url-box">
                                            <a href="{{ url($url) }}" target="_blank" class="text-success">
                                                {{ url($url) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Resumen estadístico -->
                            <div class="row stats-summary">
                                <div class="col-md-4 text-center">
                                    <div class="well">
                                        <h4><i class="glyphicon glyphicon-stats"></i> Total Clicks</h4>
                                        <span class="badge" style="font-size: 20px; background: #5bc0de;">
                                            {{ $selectedUrl->click_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="well">
                                        <h4><i class="glyphicon glyphicon-calendar"></i> Creada</h4>
                                        <p>{{ $selectedUrl->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                               
                            </div>

                            <!-- Dispositivos y navegadores -->
                            <h4 class="section-title">
                                <i class="glyphicon glyphicon-phone"></i> Dispositivos y Navegadores
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">Tipos de Dispositivos</h5>
                                        </div>
                                        <div class="panel-body">
                                            <canvas id="deviceChart" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">Navegadores Más Usados</h5>
                                        </div>
                                        <div class="panel-body">
                                            <canvas id="browserChart" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla de accesos detallados -->
                            <h4 class="section-title">
                                <i class="glyphicon glyphicon-list-alt"></i> Historial de Accesos
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>IP</th>
                                            <th>Dispositivo/Navegador</th>
                                            <th>Referencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($clicks as $click)
                                        <tr>
                                            <td>{{ $click->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $click->ip_address }}</td>
                                            <td title="{{ $click->user_agent }}">
                                                {{ $this->parseUserAgent($click->user_agent) }}
                                            </td>
                                            <td>
                                                @if($click->referer)
                                                    <a href="{{ $click->referer }}" target="_blank" title="{{ $click->referer }}">
                                                        {{ Str::limit($click->referer, 30) }}
                                                    </a>
                                                @else
                                                    <span class="label label-default">Directo</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay registros de clicks</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $clicks->links() }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .panel-primary {
        border-color: #337ab7;
        margin-top: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .panel-primary .panel-heading {
        background-color: #337ab7;
        border-color: #337ab7;
    }
    
    .url-box {
        padding: 8px;
        background: #f9f9f9;
        border-radius: 4px;
        border-left: 3px solid #5bc0de;
        word-break: break-all;
    }
    
    .url-box a {
        color: #337ab7;
        text-decoration: none;
    }
    
    .url-box a:hover {
        text-decoration: underline;
    }
    
    .section-title {
        color: #337ab7;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-top: 25px;
        margin-bottom: 20px;
    }
    
    .stats-summary .well {
        min-height: 120px;
    }
    
    .stats-detail {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 4px;
        border: 1px solid #eee;
    }
    
    .table th {
        background-color: #f5f5f5;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
    }
    
    .text-truncate {
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        @if(isset($selectedUrl) && $selectedUrl->click_count > 0)
        // Gráfico de dispositivos
        var deviceCtx = document.getElementById('deviceChart').getContext('2d');
        var deviceChart = new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($deviceStats['labels'] ?? []) !!},
                datasets: [{
                    data: {!! json_encode($deviceStats['data'] ?? []) !!},
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#e74c3c',
                        '#f39c12'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Gráfico de navegadores
        var browserCtx = document.getElementById('browserChart').getContext('2d');
        var browserChart = new Chart(browserCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($browserStats['labels'] ?? []) !!},
                datasets: [{
                    data: {!! json_encode($browserStats['data'] ?? []) !!},
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#e74c3c',
                        '#f39c12',
                        '#9b59b6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        @endif
    });
</script>
@endsection