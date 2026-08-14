@extends('layouts.monitoreo.coordinador')

@section('title', 'Asignaciones de Parqueadero')
@section('cabecera', 'Funcionarios Asignados')

@section('content')

@if(session('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary" style="border-radius: 12px;">
            <div class="box-header with-border">
                <div class="clearfix">
                    <h3 class="box-title" style="float:left;">
                        <i class="fa fa-users"></i> Listado de Asignaciones
                    </h3>
                    <a href="{{ route('cooringreso.parqueadero.index') }}" class="btn btn-default btn-sm" style="float:right; border-radius:20px;">
                        <i class="fa fa-arrow-left"></i> Volver a Puestos
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="asignacionesTable">
                        <thead style="background:#343a40; color:white;">
                            <tr>
                                <th>PUESTO ASIGNADO</th>
                                <th>EDIFICIO</th>
                                <th>FUNCIONARIO</th>
                                <th>CÃ‰DULA</th>
                                <th>CARGO</th>
                                <th>PLACA</th>
                                <th>TIPO VEH.</th>
                                <th>DESCRIPCIÃ“N</th>
                                <th>PERMISO</th>
                                <th class="text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($asignaciones as $asig)
                                <tr>
                                    {{-- Datos del puesto (via relaciÃ³n puesto) --}}
                                    <td><strong>{{ $asig->puesto->parqueadero ?? $asig->no_parqueadero }}</strong></td>
                                    <td>{{ $asig->puesto->edificio ?? '-' }}</td>

                                    {{-- Datos del funcionario (parqueadero) --}}
                                    <td><strong>{{ $asig->nombre }}</strong></td>
                                    <td>{{ $asig->cedula }}</td>
                                    <td>{{ $asig->cargo ?? '-' }}</td>
                                    <td><span class="label label-info">{{ $asig->placa }}</span></td>
                                    <td>{{ $asig->tipo_vehiculo }}</td>
                                    <td>{{ $asig->descripcion_vehiculo ?? '-' }}</td>
                                    <td>
                                        @if($asig->tipo_ingreso == 'GLOBAL')
                                            <span class="label label-warning">GLOBAL</span>
                                        @else
                                            <span class="label label-default">LOCAL</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('cooringreso.parqueadero.assign.edit', $asig->id) }}"
                                           class="btn btn-xs btn-primary" title="Editar AsignaciÃ³n">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('cooringreso.parqueadero.liberate.assignment', $asig->id) }}"
                                           class="btn btn-xs btn-danger" title="Eliminar"
                                           onclick="return confirm('Â¿EstÃ¡ seguro de eliminar esta asignaciÃ³n?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="10" class="text-center text-muted">No hay funcionarios asignados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#asignacionesTable').DataTable({
            "order": [[0,'asc']],
            "language": { "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" }
        });
    });
</script>
@endpush

@endsection


