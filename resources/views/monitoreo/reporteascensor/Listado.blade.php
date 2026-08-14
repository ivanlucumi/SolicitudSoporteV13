@extends('layouts.monitoreo.monitoreo')
<!--ponerle titulo a la paginga-->
@section('title', 'Monitoreo ')
@section('cabecera', 'Monitoreo- Reporte Ascensor')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Reportes de Incidentes en Ascensores</h3>
                    <div class="panel-actions">
                        <a href="{{ route('monitoreo.index.ascensor') }}" class="btn btn-primary">
                            <i class="glyphicon glyphicon-plus"></i> Nuevo Reporte
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <!-- Filtros -->
                    <form method="GET" action="{{ route('monitoreo.reporte.ascensor') }}" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                           value="{{ request('fecha_inicio') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                                           value="{{ request('fecha_fin') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_incidente">Tipo Incidente</label>
                                    <select class="form-control" id="tipo_incidente" name="tipo_incidente">
                                        <option value="">Todos</option>
                                        @foreach($tiposIncidente as $tipo)
                                            <option value="{{ $tipo }}" {{ request('tipo_incidente') == $tipo ? 'selected' : '' }}>{{ ucfirst($tipo) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-filter"></i> Filtrar
                                </button>
                                <a href="{{ route('monitoreo.reporte.ascensor') }}" class="btn btn-default">
                                    <i class="glyphicon glyphicon-refresh"></i> Limpiar
                                </a>
                                <a href="{{ route('monitoreo.reporte.ascensor.descargar', request()->query()) }}" class="btn btn-success">
                                    <i class="glyphicon glyphicon-download"></i> Exportar Excel
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Resumen -->
                    <div class="alert alert-info">
                        <strong>Total de incidentes:</strong> {{ $incidentes->total() }} |
                        <strong>Mostrando:</strong> {{ $incidentes->firstItem() }} al {{ $incidentes->lastItem() }}
                    </div>

                    <!-- Tabla de incidentes -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Sede</th>
                                    <th>Ascensor</th>
                                    <th>Tipo Incidente</th>
                                    <th>Reportante</th>
                                    <th>Operador</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($incidentes as $incidente)
                                <tr>
                                    <td>{{ $incidente->codigoAsignado }}</td>
                                    <td>{{ $incidente->fecha_reporte }}</td>
                                    <td>{{ $incidente->hora_reporte }}</td>
                                    <td>{{ $incidente->sede }}</td>
                                    <td>{{ $incidente->ascensor }}</td>
                                    <td>{{ ucfirst($incidente->tipo_incidente) }}</td>
                                    <td>{{ $incidente->nombre_reportante }}</td>
                                    <td>{{ $incidente->operador ?? 'Sin asignar' }}</td>
                                    <td>{{ $incidente->descripcion }}</td>
                                    <td>
                                        <span class="label label-{{ $incidente->estado == 'pendiente' ? 'warning' : ($incidente->estado == 'en_proceso' ? 'info' : 'success') }}">
                                            {{ ucfirst(str_replace('_', ' ', $incidente->estado)) }}
                                        </span>
                                    </td>
                                    <td>
                                       
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No se encontraron incidentes</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="text-center">
                        {{ $incidentes->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection