@extends('layouts.admin')

@section('title','Contratos')
@section('cabecera','Seguimiento de Contratos')

@push('styles')
<style>
/* ===============================
   ESTILO TABLA 2025 - BOOTSTRAP 3
================================ */
.table-2025 {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.table-2025 thead {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    color: #fff;
    position: sticky;
    top: 0;
    z-index: 2;
}

.table-2025 thead th {
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    border: none !important;
    vertical-align: middle !important;
}

.table-2025 tbody tr {
    transition: all .25s ease;
}

.table-2025 tbody tr:hover {
    background-color: #f5f7fa;
    transform: scale(1.002);
}

.table-2025 td {
    vertical-align: middle !important;
    font-size: 13px;
}

/* ===============================
   SEMÁFORO (PÍLDORAS)
================================ */
.label {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 20px;
    display: inline-block;
}

.label-success { background-color: #2ecc71; }
.label-warning { background-color: #f1c40f; color: #333; }
.label-danger  { background-color: #e74c3c; }
.label-default { background-color: #95a5a6; }

/* ===============================
   BOTONES ACCIONES
================================ */
.btn-xs {
    border-radius: 20px;
    padding: 4px 12px;
    transition: all .2s ease;
}

.btn-xs:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0,0,0,.15);
}

/* ===============================
   PANEL MODERNO
================================ */
.panel {
    border-radius: 10px;
    box-shadow: 0 6px 16px rgba(0,0,0,.08);
    border: none;
}

.panel-heading {
    background: #f8f9fa !important;
    font-weight: 600;
    font-size: 15px;
    border-bottom: 1px solid #ddd;
}
</style>
@endpush

@section('content')

@include('../alerts.success')
@include('../alerts.request')
@include('alerts.flash-message')

<div class="container-fluid">

    {{-- BOTÓN NUEVO CONTRATO --}}
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('contratos.novedades.create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i> Nuevo contrato
            </a>
        </div>
    </div>

    <br>
    
    {{-- BARRA DE BÚSQUEDA --}}
<div class="panel panel-default">
    <div class="panel-heading">
        <strong><i class="glyphicon glyphicon-search"></i> Búsqueda de contratos</strong>
    </div>

    <div class="panel-body">
        <form method="GET" action="{{ route('contratos.novedades.index') }}" class="form-horizontal">

            <div class="row">

                {{-- Número de contrato --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Número de contrato</label>
                        <input type="text"
                               name="numero"
                               value="{{ request('numero') }}"
                               class="form-control"
                               placeholder="Ej: 2024-015">
                    </div>
                </div>

                {{-- Contratista --}}
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Contratista</label>
                        <input type="text"
                               name="contratista"
                               value="{{ request('contratista') }}"
                               class="form-control"
                               placeholder="Nombre del contratista">
                    </div>
                </div>

                {{-- Botones --}}
                <div class="col-md-3">
                    <label class="control-label">&nbsp;</label>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-filter"></i> Buscar
                        </button>

                        <a href="{{ route('contratos.novedades.index') }}"
                           class="btn btn-default">
                            <i class="glyphicon glyphicon-refresh"></i> Limpiar
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>


    {{-- LISTADO ACTIVOS--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Listado de contratos Activos</strong>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-hover table-condensed table-2025">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Contratista</th>
                        <th>Objeto</th>
                        <th class="text-right">Valor</th>
                        <th>Inicio</th>
                        <th>Cierre</th>
                        <th>Terminación</th>
                        <th>Estado</th>
                        <th width="120" class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($contratos as $c)
                        <tr>
                            <td><strong>{{ $c->numero }}</strong></td>

                            <td>{{ $c->tipo }}</td>

                            <td>{{ $c->contratista }}</td>

                            <td>{{ Str::limit($c->objeto, 150) }}</td>

                            <td class="text-right">
                                <strong>${{ $c->valor}}</strong>
                            </td>

                            {{-- Fecha Inicio --}}
                            <td>
                                @if($c->fecha_inicio)
                                    <span class="label label-{{ $c->semaforoinicio }}">
                                        {{ $c->fecha_inicio->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="label label-default">Sin fecha</span>
                                @endif
                            </td>

                            {{-- Fecha Terminación --}}
                            <td>
                                @if($c->fecha_terminacion)
                                    <span class="label label-{{ $c->semaforo }}">
                                        {{ $c->fecha_terminacion->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="label label-default">Sin fecha</span>
                                @endif
                            </td>
                            
                            {{-- Fecha Cierre --}}
                            <td>
                                @if($c->fecha_cierre)
                                    <span class="label label-{{ $c->semaforocierre }}">
                                        {{ $c->fecha_cierre->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="label label-default">Sin fecha</span>
                                @endif
                            </td>

                            {{-- Estado --}}
                            <td>
                                <span class="label label-{{ $c->semaforo }}">
                                    {{ $c->estado }}
                                </span>
                            </td>

                            {{-- Acciones --}}
                            <td class="text-center">
                                <a href="{{ route('contratos.novedades.show',$c->id) }}"
                                   class="btn btn-success btn-xs" title="Ver">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>

                                <a href="{{ route('contratos.novedades.edit',$c->id) }}"
                                   class="btn btn-warning btn-xs" title="Editar">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                No hay contratos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    
    <hr>
    
    {{-- LISTADO INACTIVOS--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Listado de contratos Inactivos</strong>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-hover table-condensed table-2025">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Contratista</th>
                        <th>Objeto</th>
                        <th class="text-right">Valor</th>
                        <th>Inicio</th>
                        <th>Cierre</th>
                        <th>Terminación</th>
                        <th>Estado</th>
                        <th width="120" class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($contratosInactivos as $c)
                        <tr>
                            <td><strong>{{ $c->numero }}</strong></td>

                            <td>{{ $c->tipo }}</td>

                            <td>{{ $c->contratista }}</td>

                            <td>{{ Str::limit($c->objeto, 150) }}</td>

                            <td class="text-right">
                                <strong>${{ $c->valor}}</strong>
                            </td>

                            {{-- Fecha Inicio --}}
                            <td>
                                @if($c->fecha_inicio)
                                    <span class="label label-{{ $c->semaforo_inicio }}">
                                        {{ $c->fecha_inicio->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="label label-default">Sin fecha</span>
                                @endif
                            </td>

                            {{-- Fecha Cierre --}}
                            <td>
                                @if($c->fecha_cierre)
                                    <span class="label label-{{ $c->semaforo_cierre }}">
                                        {{ $c->fecha_cierre->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="label label-default">Sin fecha</span>
                                @endif
                            </td>

                            {{-- Fecha Terminación --}}
                            <td>
                                @if($c->fecha_terminacion)
                                    <span class="label label-{{ $c->semaforo }}">
                                        {{ $c->fecha_terminacion->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="label label-default">Sin fecha</span>
                                @endif
                            </td>

                            {{-- Estado --}}
                            <td>
                                <span class="label label-{{ $c->semaforo }}">
                                    {{ $c->estado }}
                                </span>
                            </td>

                            {{-- Acciones --}}
                            <td class="text-center">
                                <a href="{{ route('contratos.novedades.show',$c->id) }}"
                                   class="btn btn-success btn-xs" title="Ver">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>

                                <a href="{{ route('contratos.novedades.edit',$c->id) }}"
                                   class="btn btn-warning btn-xs" title="Editar">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                No hay contratos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
