@extends('layouts.monitoreo.coordinador')
@section('title', 'Consulta Registro de Ingreso')
@section('cabecera', 'Consulta Registro de Ingreso')

@section('content')
<style>
    body { background-color: #f5f5f5; }

    .panel-consulta {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        padding: 25px;
        max-width: 960px;
        margin: 20px auto;
    }

    h2, h4 { color: #004182; font-weight: bold; }

    .perfil-card {
        display: flex;
        align-items: center;
        gap: 28px;
        background: #f8fffe;
        border: 1px solid #d1fae5;
        border-radius: 14px;
        padding: 22px 28px;
        margin-bottom: 22px;
    }

    .foto-biometria {
        border-radius: 12px;
        width: 200px;
        height: 200px;
        object-fit: cover;
        object-position: top center;
        box-shadow: 0 6px 20px rgba(0,125,110,0.35);
        border: 4px solid #004182;
        flex-shrink: 0;
    }

    .perfil-info { flex: 1; }
    .perfil-info .id-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
    .perfil-info .id-value { font-size: 1.9rem; font-weight: 800; color: #1e293b; line-height: 1.1; }
    .perfil-info .nombre   { font-size: .95rem; color: #475569; margin-top: 4px; }

    .novedad-box {
        background-color: #fff1f2;
        border: 2px dashed #f43f5e;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 22px;
    }
    .novedad-box h4 { color: #be123c; margin-top: 0; font-size: 1rem; }
    .novedad-box p  { font-size: 12px; color: #881337; margin-bottom: 10px; }

    .table { font-size: 14px; text-align: center; }

    .btn-pdf {
        background-color: #004182;
        color: white; border: none; font-weight: bold;
        padding: 8px 18px; border-radius: 8px;
        transition: 0.3s; margin-top: 10px;
    }
    .btn-pdf:hover { background-color: #005f54; transform: scale(1.05); }

    @media print {
        .btn-pdf, #buscarForm { display: none !important; }
        body { background: white; }
        .panel-consulta { box-shadow: none; border: none; }
    }
</style>

<div class="panel-consulta">
    <h2 class="text-center">Consulta de Registro de Ingreso</h2>
    <h4 class="text-center" style="margin-bottom:18px;">{{ \Carbon\Carbon::now()->toDateString() }}</h4>
    <hr>

    {{-- Buscador Avanzado --}}
    <div id="buscarForm" style="margin-bottom: 22px; background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <form action="{{ route('coordinador.control.consulta.cedula') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label style="font-size:12px; color:#64748b;">Persona (Cédula o Nombre)</label>
                    <input type="text" name="identificacion" value="{{ request('identificacion') }}" class="form-control" placeholder="Ej: 12345678" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label style="font-size:12px; color:#64748b;">Portería / Usuario Registra</label>
                    <select name="id_porteria" class="form-control">
                        <option value="">Todas las Porterías</option>
                        @foreach($porteros ?? [] as $p)
                            <option value="{{ $p->id }}" {{ request('id_porteria') == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} {{ $p->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label style="font-size:12px; color:#64748b;">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label style="font-size:12px; color:#64748b;">Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="form-control">
                </div>
                <div class="col-md-2" style="margin-top: 22px;">
                    <button type="submit" class="btn btn-success btn-block" style="font-weight: bold;"><i class="fa fa-search"></i> Buscar</button>
                    @if(request()->hasAny(['identificacion', 'id_porteria', 'fecha_inicio', 'fecha_fin']))
                        <button type="submit" name="export_excel" value="1" class="btn btn-default btn-block" style="font-weight: bold; margin-top: 5px; color:#0f172a; border-color:#cbd5e1;">
                            <i class="fa fa-file-excel-o text-success"></i> Excel
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if(!empty($biometria) && isset($modoPerfil) && $modoPerfil)

    {{-- ©¤©¤ Perfil: Foto + ID ©¤©¤ --}}
    <div class="perfil-card">
        <img src="/Biometria/{{ $biometria->url_imagen }}" alt="Foto Biometr¨ªa" class="foto-biometria"
             onerror="this.src='/img/carnet/default.png">
        <div class="perfil-info">
            <div class="id-label">Identificaci&oacute;n</div>
            <div class="id-value">{{ $biometria->identificacion }}</div>
            <div class="nombre">{{ $biometria->nombres ?? '' }} {{ $biometria->apellidos ?? '' }}</div>
        </div>
    </div>

    {{-- ©¤©¤ Gesti¨®n de Novedades / Observaciones ©¤©¤ --}}
    <div class="novedad-box">
        <h4><i class="fa fa-exclamation-circle"></i> Gesti&oacute;n de Novedades</h4>
        <p>La novedad redactada aqu&iacute; interrumpir&aacute; el sistema en porter&iacute;a alertando al guarda.</p>
        <form action="{{ route('coordinador.guardar.novedad') }}" method="POST">
            <input type="hidden" name="id_biometria" value="{{ $biometria->id }}">
            <div class="form-group">
                <textarea name="novedades" class="form-control shadow" rows="3"
                    placeholder="Describa la novedad aqu¨ª..."
                    style="border-radius: 6px; border: 1px solid #fda4af;">{{ $biometria->novedades }}</textarea>
            </div>
            <button type="submit" class="btn btn-danger btn-block shadow" style="font-weight: bold; margin-top:8px;">
                <i class="fa fa-save"></i> Guardar / Remplazar Novedad
            </button>
        </form>

        @if(!empty($biometria->novedades))
        <form action="{{ route('coordinador.eliminar.novedad') }}" method="POST" style="margin-top: 8px;">
            <input type="hidden" name="id_biometria" value="{{ $biometria->id }}">
            <button type="submit" class="btn btn-default btn-block shadow"
                style="color:#475569; font-weight:bold; border:1px solid #cbd5e1; background-color:#f8fafc;"
                onclick="return confirm('07Est¨¢ seguro de limpiar esta novedad?');">
                <i class="fa fa-trash"></i> Quitar Novedad Activa
            </button>
        </form>
        @endif
    </div>

    {{-- ©¤©¤ Tabla de Registros ©¤©¤ --}}
    <h4 style="margin-bottom:10px;"><i class="fa fa-list"></i> Historial de Registros</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow">
            <thead style="background-color: #004182; color: #fff;">
                <tr>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>ACCI&Oacute;N</th>
                    <th>EVENTO / PORTER&Iacute;A</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Registros as $Registro)
                    <tr>
                        <td>{{ $Registro->fecha_ingreso ?? $Registro->fecha_salida }}</td>
                        <td>{{ $Registro->hora_ingreso  ?? $Registro->hora_salida }}</td>
                        <td>
                            @if(strtolower($Registro->accion) == 'ingreso')
                                <span class="label label-success">{{ $Registro->accion }}</span>
                            @else
                                <span class="label label-warning">{{ $Registro->accion }}</span>
                            @endif
                        </td>
                        <td>{{ $Registro->direccion_ingreso ?? $Registro->porteria_salida }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted">No hay registros disponibles</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <button class="btn btn-pdf" onclick="window.print()">
        <i class="fa fa-file-pdf-o"></i> Imprimir / Exportar PDF
    </button>

    @elseif(!empty($Registros) && isset($modoPerfil) && !$modoPerfil)
    
    {{-- ¤¤ Tabla de Registros General ¤¤ --}}
    <h4 style="margin-bottom:10px;"><i class="fa fa-list"></i> Resultados de Búsqueda ({{ $Registros->total() }} registros)</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow" style="font-size: 12px;">
            <thead style="background-color: #004182; color: #fff;">
                <tr>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>IDENTIFICACIÓN</th>
                    <th>NOMBRES Y APELLIDOS</th>
                    <th>ACCIÓN</th>
                    <th>PORTERÍA / EVENTO</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Registros as $Registro)
                    <tr>
                        <td class="text-center">{{ $Registro->fecha_ingreso ?? $Registro->fecha_salida }}</td>
                        <td class="text-center">{{ $Registro->hora_ingreso  ?? $Registro->hora_salida }}</td>
                        <td class="text-center"><strong>{{ $Registro->identificacion }}</strong></td>
                        <td>{{ $Registro->p_nombre }} {{ $Registro->s_nombre }} {{ $Registro->p_apellido }} {{ $Registro->s_apellido }}</td>
                        <td class="text-center">
                            @if(strtolower($Registro->accion) == 'ingreso')
                                <span class="label label-success">{{ $Registro->accion }}</span>
                            @else
                                <span class="label label-warning">{{ $Registro->accion }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $Registro->direccion_ingreso ?? $Registro->porteria_salida }} <br> 
                            <small class="text-muted"><i class="fa fa-user"></i> {{ $Registro->portero }} ({{ $Registro->portero_seccional }})</small>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted text-center" style="padding:30px;">No hay registros disponibles para los filtros seleccionados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="text-center">
        {{ $Registros->appends(request()->query())->links() }}
    </div>

    @endif
</div>

<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/tablefilter/tablefilter.js') }}"></script>
@endsection
