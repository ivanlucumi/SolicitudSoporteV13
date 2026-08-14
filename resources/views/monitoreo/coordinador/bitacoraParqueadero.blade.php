@extends('layouts.monitoreo.coordinador')

@section('title', 'Historial de Bitácora')
@section('cabecera', 'Historial de Bitácora de Parqueadero')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary premium-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-history"></i> Historial de Movimientos</h3>
                <div class="box-tools pull-right">
                    @if(!empty($userSeccional))
                        <span class="label label-primary" style="font-size: 13px; padding: 5px 10px; margin-right: 8px;">
                            <i class="fa fa-map-marker"></i> Seccional: {{ $userSeccional }}
                        </span>
                    @endif
                    <a href="{{ route('coordinador.control.ingreso') }}" class="btn btn-sm btn-default">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="box-body">
                <!-- Filtros -->
                <div class="well well-sm">
                    <form method="GET" action="{{ route('cooringreso.bitacora.index') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Desde</label>
                                    <input type="date" name="fecha_desde" class="form-control"
                                           value="{{ $fecha_desde ?? date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Hasta</label>
                                    <input type="date" name="fecha_hasta" class="form-control"
                                           value="{{ $fecha_hasta ?? date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Placa</label>
                                    <input type="text" name="placa" class="form-control" placeholder="ABC123"
                                           value="{{ $placa }}" style="text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cédula</label>
                                    <input type="text" name="cedula" class="form-control" placeholder="C.C."
                                           value="{{ $cedula }}">
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('cooringreso.bitacora.export', ['fecha_desde' => $fecha_desde, 'fecha_hasta' => $fecha_hasta, 'placa' => $placa, 'cedula' => $cedula, 'tipo' => 'excel']) }}" class="btn btn-success">
                                    <i class="fa fa-file-excel-o"></i> Excel
                                </a>
                                <a href="{{ route('cooringreso.bitacora.export', ['fecha_desde' => $fecha_desde, 'fecha_hasta' => $fecha_hasta, 'placa' => $placa, 'cedula' => $cedula, 'tipo' => 'pdf']) }}" class="btn btn-danger">
                                    <i class="fa fa-file-pdf-o"></i> PDF
                                </a>
                                <a href="{{ route('cooringreso.bitacora.index') }}" class="btn btn-default">
                                    <i class="fa fa-refresh"></i> Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- Contador -->
                <p class="text-muted" style="margin-bottom: 8px;">
                    <i class="fa fa-list"></i>
                    Mostrando <strong>{{ $bitacora->count() }}</strong> de <strong>{{ $bitacora->total() }}</strong> registros
                </p>

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" style="font-size: 12px;">
                        <thead style="background-color: #3c8dbc; color: white;">
                            <tr>
                                <th class="text-center"># PUESTO</th>
                                <th>CIUDAD / PORTERÍA</th>
                                <th>CÉDULA</th>
                                <th>FUNCIONARIO / VISITANTE</th>
                                <th>JUZGADO / DESPACHO</th>
                                <th>TIPO</th>
                                <th>VEHÍCULO</th>
                                <th class="text-center">PLACA</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">INGRESO</th>
                                <th class="text-center">SALIDA</th>
                                <th>NOVEDADES</th>
                                <th>RESPONSABLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bitacora as $registro)
                                <tr class="{{ is_null($registro->hora_salida) ? 'tr-adentro' : '' }}">
                                    {{-- # PUESTO --}}
                                    <td class="text-center">
                                        @php
                                            $noPuesto = $registro->no_puesto
                                                ?? optional($registro->puesto)->no_parqueadero
                                                ?? null;
                                        @endphp
                                        @if($noPuesto)
                                            <span class="label label-info" style="font-size: 12px; padding: 4px 8px;">
                                                {{ $noPuesto }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    {{-- CIUDAD / PORTERÍA --}}
                                    <td>
                                        @php
                                            // Prioridad: campo directo > relación
                                            $ciudad   = $registro->ciudad   ?: (optional(optional($registro->puesto)->puesto)->ciudad   ?? null);
                                            $edificio = $registro->edificio ?: (optional(optional($registro->puesto)->puesto)->edificio ?? null);
                                            $porteria = $registro->porteria ?? null;
                                        @endphp
                                        @if($ciudad)
                                            <span class="label label-default">{{ $ciudad }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                        @if($edificio)
                                            <br><small class="text-muted">{{ $edificio }}</small>
                                        @endif
                                        @if($porteria)
                                            <br><small class="text-info"><i class="fa fa-sign-in"></i> {{ $porteria }}</small>
                                        @endif
                                    </td>

                                    {{-- CÉDULA --}}
                                    <td>{{ $registro->cedula }}</td>

                                    {{-- NOMBRE --}}
                                    <td>{{ $registro->nombre }}</td>

                                    {{-- JUZGADO / DESPACHO --}}
                                    <td>
                                        @if($registro->empleado)
                                            <span style="font-size: 11px;">
                                                {{ $registro->empleado->cargo_titular ?? $registro->empleado->cargo }}<br>
                                                <strong>{{ $registro->empleado->dependencia_titular ?? 'SIN DEPENDENCIA' }}</strong>
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    {{-- TIPO --}}
                                    <td class="text-center">
                                        @php
                                            $tipo = $registro->tipo_ingreso ?? 'EMPLEADO';
                                        @endphp
                                        @if($tipo == 'VISITANTE')
                                            <span class="label label-warning">VISITANTE</span>
                                        @elseif($tipo == 'TEMPORAL')
                                            <span class="label label-info">TEMPORAL</span>
                                        @else
                                            <span class="label label-success">EMPLEADO</span>
                                        @endif
                                    </td>

                                    {{-- VEHÍCULO --}}
                                    <td>{{ $registro->vehiculo }}</td>

                                    {{-- PLACA --}}
                                    <td class="text-center"><strong>{{ $registro->placa }}</strong></td>

                                    {{-- FECHA --}}
                                    <td class="text-center">{{ $registro->fecha }}</td>

                                    {{-- HORA INGRESO --}}
                                    <td class="text-center text-green"><strong>{{ $registro->hora_ingreso }}</strong></td>

                                    {{-- HORA SALIDA --}}
                                    <td class="text-center">
                                        @if($registro->hora_salida)
                                            <span class="text-red"><strong>{{ $registro->hora_salida }}</strong></span>
                                        @else
                                            <span class="label label-warning">ADENTRO</span>
                                        @endif
                                    </td>

                                    {{-- NOVEDADES --}}
                                    <td>
                                        @if($registro->novedades)
                                            <span class="text-danger" style="font-weight: 600;">
                                                <i class="fa fa-warning"></i> {{ $registro->novedades }}
                                            </span>
                                        @else
                                            <span class="text-muted small">Sin novedades</span>
                                        @endif
                                    </td>

                                    {{-- RESPONSABLE --}}
                                    <td>
                                        <small>
                                            <i class="fa fa-sign-in text-green"></i> {{ $registro->quien_registro_ingreso }}<br>
                                            <i class="fa fa-sign-out text-red"></i> {{ $registro->quien_registro_salida ?? '---' }}
                                        </small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center" style="padding: 50px;">
                                        <i class="fa fa-search fa-3x text-muted"></i>
                                        <p class="text-muted" style="margin-top: 10px;">No se encontraron registros para los filtros seleccionados.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {{ $bitacora->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .premium-box {
        border-top: 3px solid #3c8dbc;
        box-shadow: 0 1px 11px rgba(0,0,0,0.1);
        border-radius: 5px;
    }
    .table-hover tbody tr:hover {
        background-color: #f4f4f4;
    }
    .table tbody tr.tr-adentro {
        background-color: #fffde7 !important;
    }
</style>
@endsection
