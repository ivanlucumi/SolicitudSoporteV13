@extends('layouts.monitoreo.coordinador')

@section('title', 'Administraci¨®n de Parqueaderos')
@section('cabecera', 'Gesti¨®n de Puestos de Parqueo')

@section('content')
<style>
    .admin-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        padding: 20px;
        margin-bottom: 20px;
    }
    .badge-libre  { background: #004182; color: #fff; }
    .badge-ocupado{ background: #dc3545; color: #fff; }
    .table-admin thead { background: #343a40; color: white; }
    .badge-count  { background: #007bff; color: #fff; border-radius: 50%; padding: 2px 7px; font-size: 11px; }
</style>

@if(session('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="admin-card">

            {{-- Encabezado --}}
            <div class="clearfix" style="margin-bottom:15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h4 style="float:left; margin:0; color:#343a40;">
                    <i class="fa fa-building-o"></i> Inventario de Puestos
                </h4>
                <div style="float:right;">
                    <a href="{{ route('cooringreso.parqueadero.assignments') }}" class="btn btn-info btn-sm" style="border-radius:20px; margin-right:8px;">
                        <i class="fa fa-users"></i> Ver Asignaciones
                    </a>
                    <a href="{{ route('cooringreso.parqueadero.create') }}" class="btn btn-primary btn-sm" style="border-radius:20px;">
                        <i class="fa fa-plus"></i> Nuevo Puesto
                    </a>
                </div>
            </div>            <div class="well well-sm" style="background:#f9f9f9; border-radius:8px; margin-bottom:15px;">
                <form method="GET" action="{{ route('cooringreso.parqueadero.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="small">No. Puesto / Edificio</label>
                                <input type="text" name="parqueadero" class="form-control input-sm" placeholder="Buscar puesto..." value="{{ request('parqueadero') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="small">Funcionario / Placa</label>
                                <input type="text" name="funcionario" class="form-control input-sm" placeholder="Nombre, CC o Placa..." value="{{ request('funcionario') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="small">Ciudad</label>
                                <select name="ciudad" class="form-control input-sm">
                                    <option value="">-- Todas --</option>
                                    @foreach($ciudades as $c)
                                        <option value="{{ $c }}" {{ request('ciudad') == $c ? 'selected' : '' }}>{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="small">Estado</label>
                                <select name="estado" class="form-control input-sm">
                                    <option value="">-- Todos --</option>
                                    <option value="LIBRE" {{ request('estado') == 'LIBRE' ? 'selected' : '' }}>LIBRE</option>
                                    <option value="OCUPADO" {{ request('estado') == 'OCUPADO' ? 'selected' : '' }}>OCUPADO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                                <a href="{{ route('cooringreso.parqueadero.index') }}" class="btn btn-default btn-sm" title="Limpiar">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-admin" id="puestosTable">
                    <thead>
                        <tr>
                            <th style="width:10%">No. PUESTO</th>
                            <th style="width:10%">CIUDAD</th>
                            <th style="width:13%">EDIFICIO / TORRE</th>
                            <th style="width:15%">UBICACIÓN</th>
                            <th style="width:10%">ZONA</th>
                            <th style="width:5%">CAP.</th>
                            <th style="width:10%">ESTADO</th>
                            <th>FUNCIONARIOS ASIGNADOS</th>
                            <th style="width:12%" class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($puestos as $puesto)
                            <tr>
                                <td><strong>{{ $puesto->parqueadero }}</strong></td>
                                <td>{{ $puesto->ciudad }}</td>
                                <td>{{ $puesto->edificio }}</td>
                                <td>{{ $puesto->ubicacion }}</td>
                                <td>{{ $puesto->zona ?? '-' }}</td>
                                <td>{{ $puesto->capacidad ?? 1 }}</td>
                                <td class="text-center">
                                    @if($puesto->estado == 'LIBRE')
                                        <span class="label label-success">LIBRE</span>
                                    @elseif($puesto->estado == 'OCUPADO')
                                        <span class="label label-danger">OCUPADO</span>
                                    @else
                                        <span class="label label-default" style="background:#6c757d;">INACTIVO</span>
                                    @endif
                                </td>
                                <td>
                                    @if($puesto->asignaciones->count() > 0)
                                        @foreach($puesto->asignaciones as $asig)
                                            <div style="border-bottom: 1px solid #f0f0f0; padding: 4px 0;">
                                                <strong>{{ $asig->nombre }}</strong>
                                                <small class="text-muted">C.C. {{ $asig->cedula }}</small>
                                                &nbsp;|&nbsp;
                                                <span class="label label-info">{{ $asig->placa }}</span>
                                                @if(isset($asig->ocupado) && $asig->ocupado == 'OCUPADO')
                                                    <span class="label label-success"><i class="fa fa-sign-in"></i> ADENTRO</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-muted"><i>Sin funcionario asignado</i></span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cooringreso.parqueadero.assign', $puesto->id) }}"
                                       class="btn btn-xs btn-primary" title="Asignar Funcionario">
                                        <i class="fa fa-user-plus"></i>
                                    </a>
                                    <a href="{{ route('cooringreso.parqueadero.edit', $puesto->id) }}"
                                       class="btn btn-xs btn-warning" title="Editar Puesto">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted">No hay puestos registrados aún.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                </form>
            </div>{{-- /.table-responsive --}}

            <div class="text-center premium-pagination">
                {{ $puestos->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto-submit form when a select changes
        $('.table-header-filter select').on('change', function() {
            $(this).closest('form').submit();
        });

        $('#puestosTable').DataTable({
            "paging": false,
            "info": false,
            "searching": false,
            "order": [],
            "language": { "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" }
        });
    });
</script>
@endpush

@endsection




