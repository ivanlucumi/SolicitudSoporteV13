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
                                    <input type="date" name="fecha_desde" class="form-control" value="{{ $fecha_desde }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Hasta</label>
                                    <input type="date" name="fecha_hasta" class="form-control" value="{{ $fecha_hasta }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Placa</label>
                                    <input type="text" name="placa" class="form-control" placeholder="ABC123" value="{{ $placa }}" style="text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cédula</label>
                                    <input type="text" name="cedula" class="form-control" placeholder="C.C." value="{{ $cedula }}">
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('cooringreso.bitacora.index') }}" class="btn btn-default">
                                    <i class="fa fa-refresh"></i> Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead style="background-color: #3c8dbc; color: white;">
                            <tr>
                                <th class="text-center"># PUESTO</th>
                                <th>CÉDULA</th>
                                <th>FUNCIONARIO / VISITANTE</th>
                                <th>VEHÍCULO</th>
                                <th class="text-center">PLACA</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">INGRESO</th>
                                <th class="text-center">SALIDA</th>
                                <th>RESPONSABLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bitacora as $registro)
                                <tr>
                                    <td class="text-center">
                                        @if($registro->puesto)
                                            <span class="label label-info" style="font-size: 13px; padding: 5px 10px;">{{ $registro->puesto->no_parqueadero }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $registro->cedula }}</td>
                                    <td>{{ $registro->nombre }}</td>
                                    <td>{{ $registro->vehiculo }}</td>
                                    <td class="text-center"><strong>{{ $registro->placa }}</strong></td>
                                    <td class="text-center">{{ $registro->fecha }}</td>
                                    <td class="text-center text-green"><strong>{{ $registro->hora_ingreso }}</strong></td>
                                    <td class="text-center">
                                        @if($registro->hora_salida)
                                            <span class="text-red"><strong>{{ $registro->hora_salida }}</strong></span>
                                        @else
                                            <span class="label label-warning">ADENTRO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>
                                            In: {{ $registro->quien_registro_ingreso }}<br>
                                            Out: {{ $registro->quien_registro_salida ?? '---' }}
                                        </small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center" style="padding: 50px;">
                                        <i class="fa fa-search fa-3x text-muted"></i>
                                        <p class="text-muted" style="margin-top: 10px;">No se encontraron resultados.</p>
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
</style>
@endsection
