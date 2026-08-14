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
                            <i class="glyphicon glyphicon-stats"></i> Estadísticas de URL
                            <div class="pull-right">
                                <a href="{{ url()->previous() }}" class="btn btn-xs btn-default">
                                    <i class="glyphicon glyphicon-arrow-left"></i> Volver
                                </a>
                            </div>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!-- Sección de URLs -->
                        <div class="row url-info-section">
                            <div class="col-md-6">
                                <div class="well well-sm">
                                    <h4 class="text-primary"><i class="glyphicon glyphicon-link"></i> URL Original</h4>
                                    <div class="url-box">
                                        <a href="{{ $shortenedUrl->original_url }}" target="_blank" class="text-truncate" title="{{ $shortenedUrl->original_url }}">
                                            {{ Str::limit($shortenedUrl->original_url, 60) }}
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

                        <!-- Contador de clicks -->
                        <div class="click-counter text-center">
                            <div class="well" style="background-color: #f8f9fa; border-left: 4px solid #5bc0de;">
                                <h3 class="text-muted" style="margin-top: 0;">
                                    <i class="glyphicon glyphicon-hand-up"></i> Total de Clicks
                                </h3>
                                <span class="badge" style="font-size: 24px; background-color: #5bc0de;">
                                    {{ $shortenedUrl->click_count }}
                                </span>
                            </div>
                        </div>

                       

                        <!-- Tabla de accesos -->
                        <div class="access-log">
                            <h4 class="section-title">
                                <i class="glyphicon glyphicon-list-alt"></i> Últimos Accesos
                            </h4>
                            
                            @if($clicks->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-condensed">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center"><i class="glyphicon glyphicon-calendar"></i> Fecha</th>
                                                <th class="text-center"><i class="glyphicon glyphicon-globe"></i> IP</th>
                                                <th class="text-center"><i class="glyphicon glyphicon-phone"></i> Dispositivo/Navegador</th>
                                                <th class="text-center"><i class="glyphicon glyphicon-log-in"></i> Referencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clicks as $click)
                                                <tr>
                                                    <td class="text-center">{{ $click->created_at->format('d/m/Y H:i') }}</td>
                                                    <td class="text-center">{{ $click->ip_address }}</td>
                                                    <td class="text-center" title="{{ $click->user_agent }}">
                                                        {{ Str::limit($click->user_agent, 40) }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($click->referer)
                                                            <a href="{{ $click->referer }}" target="_blank" title="{{ $click->referer }}">
                                                                {{ Str::limit($click->referer, 30) }}
                                                            </a>
                                                        @else
                                                            <span class="label label-default">Directo</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Paginación -->
                                <div class="text-center">
                                    {{ $clicks->links() }}
                                </div>
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="glyphicon glyphicon-info-sign"></i> No hay registros de clicks para esta URL.
                                </div>
                            @endif
                        </div>
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
    
    .click-counter .badge {
        font-size: 1.5em;
        padding: 10px 20px;
        border-radius: 20px;
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
    
    .url-info-section {
        margin-bottom: 25px;
    }
    
    .chart-container {
        background: #fff;
        padding: 15px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
</style>
@endsection

