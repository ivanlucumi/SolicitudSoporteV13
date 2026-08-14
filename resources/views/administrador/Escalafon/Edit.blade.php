@extends('layouts.ensayo1')

@push('styles')
<style>
    .page-box { margin-top: 20px; margin-bottom: 30px; }
    .page-title { margin:0; font-size:24px; font-weight:600; color:#2c3e50; }
    .page-subtitle { margin-top:6px; color:#7f8c8d; }
    .panel-minimal { border-color:#e7eaec; box-shadow:0 1px 2px rgba(0,0,0,.04); }
    .panel-minimal > .panel-heading { background:#fff; border-color:#eef1f4; font-weight:600; }
    .filter-box { background:#fcfcfc; border:1px solid #eef1f4; border-radius:4px; padding:15px; }
    .summary-box { background:#fafafa; border:1px solid #eee; border-radius:4px; padding:12px; margin-bottom:15px; min-height:72px; }
    .summary-label { font-size:11px; text-transform:uppercase; color:#888; margin-bottom:4px; letter-spacing:.4px; }
    .summary-value { font-size:14px; font-weight:600; color:#2c3e50; }
    .required { color:#d9534f; }
    .result-empty { padding:25px; text-align:center; color:#777; }
    .table-results thead th { background:#fafafa; font-size:12px; text-transform:uppercase; color:#666; }
    .current-row { background:#f5faff !important; }
    .badge-soft { display:inline-block; padding:4px 8px; border-radius:20px; font-size:11px; font-weight:600; }
    .badge-propiedad { background:#d9edf7; color:#31708f; }
    .badge-provisionalidad { background:#fcf8e3; color:#8a6d3b; }
    .badge-ambos { background:#dff0d8; color:#3c763d; }
    .badge-sin { background:#f5f5f5; color:#777; }
    .form-section-title { margin-top:0; margin-bottom:18px; font-size:16px; font-weight:600; color:#34495e; }
    .help-muted { color:#999; font-size:12px; }
    .panel-footer-actions { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; }
    @media (max-width:767px) {
        .panel-footer-actions { display:block; }
        .panel-footer-actions .btn { width:100%; margin-bottom:8px; }
    }
    /* Estilos adicionales para la tabla de resultados */
    .table-detalles { font-size:13px; }
    .table-detalles td, .table-detalles th { vertical-align: middle; }
    .details-summary { cursor:pointer; color:#337ab7; }
    .details-summary:hover { text-decoration:underline; }
</style>
@endpush

@section('content')
<div class="container-fluid page-box">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title">Editar registro de escalafón</h1>
            <p class="page-subtitle">
                Filtra por juzgado, cargo y tipo de relación para ver resultados y editar el registro seleccionado.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <strong>Correcto:</strong> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Se encontraron errores:</strong>
            <ul style="margin-top:8px; margin-bottom:0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FILTROS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-minimal">
                <div class="panel-heading">
                    Buscar relaciones
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('despachos.escalafon.despachosAjax', $id) }}">
                        @csrf
                        <div class="filter-box">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filtro_despacho">Juzgado / Despacho</label>
                                        <select id="filtro_despacho" class="form-control" name="despacho">
                                            <option value="">Seleccione un juzgado</option>
                                            @foreach($despachos as $d)
                                                <option value="{{ $d->codigoDespacho }}"
                                                    {{ (old('despacho', $despachoSeleccionado ?? '') == $d->codigoDespacho) ? 'selected' : '' }}>
                                                    {{ $d->codigoDespacho }} - {{ $d->nombreDespacho }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filtro_cargo">Cargo</label>
                                        <select id="filtro_cargo" class="form-control" name="cargo">
                                            <option value="">Seleccione un cargo</option>
                                            @foreach($cargos as $c)
                                                <option value="{{ $c->id }}"
                                                    data-despacho="{{ optional($c->despachoJudicial)->codigoDespacho ?? '' }}"
                                                    {{ (old('cargo', $cargoSeleccionado ?? '') == $c->id) ? 'selected' : '' }}>
                                                    {{ $c->nombre_cargo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="filtro_tipo">Tipo</label>
                                        <select id="filtro_tipo" class="form-control" name="tipo">
                                            <option value="todos" {{ (old('tipo', $tipoSeleccionado ?? '') == 'todos') ? 'selected' : '' }}>Todos</option>
                                            <option value="propiedad" {{ (old('tipo', $tipoSeleccionado ?? '') == 'propiedad') ? 'selected' : '' }}>Propiedad</option>
                                            <option value="provisionalidad" {{ (old('tipo', $tipoSeleccionado ?? '') == 'provisionalidad') ? 'selected' : '' }}>Provisionalidad</option>
                                            <option value="ambos" {{ (old('tipo', $tipoSeleccionado ?? '') == 'ambos') ? 'selected' : '' }}>Ambos</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" id="btn_buscar" class="btn btn-primary btn-block">
                                            Buscar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <p class="help-muted" style="margin-bottom:0;">
                                Flujo del módulo: <strong>Juzgado → Cargo → Propiedad/Provisionalidad → Resultados</strong>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- RESULTADOS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-minimal">
                <div class="panel-heading">
                    Resultados de la búsqueda
                    @if(isset($registro) && $registro->count() > 0)
                        <span class="badge badge-primary pull-right">{{ $registro->count() }} registro(s)</span>
                    @endif
                </div>
                <div class="panel-body">
                    @if(!isset($registro) || $registro->isEmpty())
                        <div class="result-empty">
                            <i class="fa fa-info-circle fa-2x text-muted"></i>
                            <p>No se encontraron registros con los filtros aplicados.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-detalles">
                                <thead>
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Propiedad</th>
                                        <th>Provisional</th>
                                        <th>Escalafón</th>
                                        <th>Posesión</th>
                                        <th>Licencia</th>
                                        <th>Observaciones / Notas</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registro as $item)
                                        <tr>
                                            <td>
                                                <strong>{{ $item->cargo->nombre_cargo ?? 'N/A' }}</strong><br>
                                                <small>Grado: {{ $item->cargo->grado ?? '' }}</small><br>
                                                <small>Estado: {{ $item->cargo->estado_actual ?? '' }}</small>
                                            </td>
                                            <td>
                                                @if($item->propietario)
                                                    {{$item->propietario->nameE}} {{$item->propietario->lastnameE}} <br> 
                                                    <small>Cédula: {{ $item->propietario->cedulaE }}</small>
                                                @else
                                                    <span class="text-muted">No asignado</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->provisional)
                                                
                                                    {{ $item->provisional->nameE }} {{ $item->provisional->lastnameE }}<br>
                                                    <small>Cédula: {{ $item->provisional->cedulaE }}</small>
                                                @else
                                                    <span class="text-muted">No asignado</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->escalafon)
                                                    <strong>Novedad:</strong> {{ $item->escalafon->novedad }}<br>
                                                    <strong>Acto:</strong> {{ $item->escalafon->numero_acto }} / {{ $item->escalafon->fecha_acto }}
                                                @else
                                                    <span class="text-muted">Sin datos</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->posesion)
                                                    <strong>Tipo:</strong> {{ $item->posesion->tipo_nombramiento }}<br>
                                                    <strong>Fecha posesión:</strong> {{ $item->posesion->fecha_posesion }}
                                                @else
                                                    <span class="text-muted">Sin datos</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->licencia)
                                                    <strong>Res:</strong> {{ $item->licencia->no_resolucion }}<br>
                                                    <strong>Fecha:</strong> {{ $item->licencia->fecha }}
                                                @else
                                                    <span class="text-muted">Sin datos</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->observaciones)
                                                    <strong>Res:</strong> {{ $item->observaciones }}
                                                @else
                                                    <span class="text-muted">Sin datos</span>
                                                @endif
                                            </td>
                                            
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="panel-footer panel-footer-actions">
                    <span>Mostrando {{ $registro->count() ?? 0 }} registros</span>
                    {{-- Si usas paginación, aquí colocarías $registro->links() --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush