@extends('layouts.monitoreo.coordinador')

@section('cabecera')
    Permisos Especiales — Fin de Semana / Festivos
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
</div>
@endif

{{-- ===== FORMULARIO NUEVO PERMISO ===== --}}
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" style="background:#003f75;">
                <h3 class="box-title" style="color:#fff;">
                    <i class="fa fa-plus-circle"></i> &nbsp;Otorgar Permiso Especial
                </h3>
            </div>
            <div class="box-body">
                <p class="text-muted" style="font-size:12px; margin-bottom:15px;">
                    <i class="fa fa-info-circle"></i>
                    Los vehículos <strong>PARTICULARES</strong> solo pueden ingresar de <strong>Lunes a Viernes</strong>.
                    Use este formulario para habilitar el acceso en sábado, domingo o festivo.
                </p>

                <form action="{{ route('cooringreso.permisos.store') }}" method="POST">
    @csrf
                @csrf

                <div class="form-group">
                    <label>Cédula del Funcionario <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="cedula" id="cedula_permiso" required style="width:100%;">
                        <option value="">-- Seleccione un funcionario --</option>
                        @foreach($funcionarios as $f)
                            <option value="{{ $f->cedula }}">
                                {{ $f->cedula }} — {{ $f->nombre }} ({{ $f->placa }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Solo muestra funcionarios activos con vehículo PARTICULAR.</small>
                </div>

                <div class="form-group">
                    <label>Fecha del Permiso <span class="text-danger">*</span></label>
                    <input type="date" name="fecha_permiso" class="form-control" required
                           min="{{ now()->toDateString() }}"
                           value="{{ old('fecha_permiso') }}">
                    <small class="text-muted">Puede ser sábado, domingo o festivo.</small>
                </div>

                <div class="form-group">
                    <label>Motivo</label>
                    <input type="text" name="motivo" class="form-control"
                           placeholder="Ej: Trabajo urgente, guardia especial..."
                           maxlength="255" value="{{ old('motivo') }}">
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-save"></i> &nbsp;Otorgar Permiso
                </button>

                </form>
            </div>
        </div>
    </div>

    {{-- ===== TABLA DE PERMISOS VIGENTES ===== --}}
    <div class="col-md-7">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-list"></i> &nbsp;Permisos Registrados
                </h3>
                <div class="box-tools pull-right">
                    {{-- Filtro por cédula --}}
                    <form method="GET" action="{{ route('cooringreso.permisos.index') }}" class="form-inline" style="display:inline-flex; gap:6px;">
                        <input type="text" name="cedula" class="form-control input-sm"
                               placeholder="Filtrar por cédula..." value="{{ $cedula }}" style="width:160px;">
                        <button type="submit" class="btn btn-sm btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                        @if($cedula)
                        <a href="{{ route('cooringreso.permisos.index') }}" class="btn btn-sm btn-warning">
                            <i class="fa fa-times"></i>
                        </a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="box-body table-responsive" style="padding:0;">
                <table class="table table-bordered table-condensed table-hover" style="font-size:13px; margin:0;">
                    <thead style="background:#f5f5f5;">
                        <tr>
                            <th style="width:120px;">Cédula</th>
                            <th>Funcionario</th>
                            <th style="width:110px; text-align:center;">Fecha</th>
                            <th>Motivo</th>
                            <th style="width:120px;">Otorgado por</th>
                            <th style="width:70px; text-align:center;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($permisos as $permiso)
                        @php
                            $fecha = \Carbon\Carbon::parse($permiso->fecha_permiso);
                            $esPasado = $fecha->isPast() && !$fecha->isToday();
                            $esFdS = in_array($fecha->dayOfWeek, [0, 6]);
                        @endphp
                        <tr class="{{ $esPasado ? 'text-muted' : '' }}" style="{{ $esPasado ? 'opacity:.6;' : '' }}">
                            <td style="font-family:monospace; font-size:14px;">{{ $permiso->cedula }}</td>
                            <td>
                                @php
                                    $func = $funcionarios->firstWhere('cedula', $permiso->cedula);
                                @endphp
                                {{ $func->nombre ?? '—' }}
                                @if($func)
                                    <br><small class="text-muted">{{ $func->placa }}</small>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                <span class="label label-{{ $esPasado ? 'default' : ($esFdS ? 'warning' : 'info') }}">
                                    {{ $fecha->format('d/m/Y') }}
                                </span>
                                <br>
                                <small class="text-muted">{{ $fecha->locale('es')->isoFormat('dddd') }}</small>
                            </td>
                            <td>{{ $permiso->motivo ?? '—' }}</td>
                            <td>
                                <small>{{ $permiso->coordinador->name ?? '—' }}</small>
                            </td>
                            <td style="text-align:center;">
                                @if(!$esPasado)
                                <form style="display:inline;" onsubmit="return confirm(&quot;¿Eliminar este permiso?&quot;)" action="{{ route('cooringreso.permisos.destroy', $permiso->id) }}" method="POST">
    @csrf
    @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-xs btn-danger" title="Eliminar permiso">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </form>
                                @else
                                <span class="label label-default">Vencido</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted" style="padding:30px;">
                                <i class="fa fa-calendar-times-o fa-2x" style="display:block; margin-bottom:8px;"></i>
                                No hay permisos especiales registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($permisos->hasPages())
            <div class="box-footer text-center premium-pagination">
                {{ $permisos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#cedula_permiso').select2({
        placeholder: '-- Seleccione un funcionario --',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
