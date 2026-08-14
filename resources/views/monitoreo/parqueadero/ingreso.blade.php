<div class="row animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
    <!-- Personas -->
    <div class="col-md-4 col-sm-4">
        <div class="premium-card stats-card" style="border-top: 4px solid var(--primary);">
            <div class="stats-icon text-primary"><i class="fa fa-users"></i></div>
            <span class="text-muted">Total Personas</span>
            <span class="stats-count" id="count-personas">{{ $contarUsuario }}</span>
        </div>
    </div>
    <!-- Carros -->
    <div class="col-md-4 col-sm-4">
        <div class="premium-card stats-card" style="border-top: 4px solid #3b82f6;">
            <div class="stats-icon" style="color: #3b82f6;"><i class="fa fa-car"></i></div>
            <span class="text-muted">Vehículos Livianos</span>
            <span class="stats-count" id="count-carros">{{ $contarCarros }}</span>
        </div>
    </div>
    <!-- Motos -->
    <div class="col-md-4 col-sm-4">
        <div class="premium-card stats-card" style="border-top: 4px solid #f59e0b;">
            <div class="stats-icon" style="color: #f59e0b;"><i class="fa fa-motorcycle"></i></div>
            <span class="text-muted">Motocicletas</span>
            <span class="stats-count" id="count-motos">{{ $contarMotos }}</span>
        </div>
    </div>
</div>

<div class="row animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
    <!-- Unified Search Bar -->
    <div class="col-md-12">
        <div class="search-container">
            <h4 class="text-center" style="margin-top: 0; margin-bottom: 25px; font-weight: 600; letter-spacing: 1px;">
                CONSULTA DE ACCESO VEHICULAR
            </h4>
            <div class="search-input-group">
                <input type="text" id="unifiedSearch" placeholder="Ingrese Cédula o Placa para registrar..." autocomplete="off" onkeypress="if(event.keyCode == 13) $('#btnUnifiedSearch').click();">
                <button type="button" class="btn-search" id="btnUnifiedSearch">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <p class="text-center" style="margin-top: 15px; opacity: 0.7; font-size: 13px;">
                <i class="fa fa-info-circle"></i> Use la placa para una búsqueda directa o la cédula para funcionarios.
            </p>
        </div>
    </div>
</div>

<div class="row animate__animated animate__fadeInUp" style="margin-bottom: 25px; animation-delay: 0.5s;">
    <div class="col-md-12 text-right">
        @if( auth()->user()->rol == 10)
        <a href="{{ route('cooringreso.bitacora.index') }}" class="btn btn-primary" style="border-radius: 50px; padding: 10px 25px; box-shadow: var(--shadow-sm); border: none; background: var(--primary);">
            <i class="fa fa-history"></i> Historial Bitácora
        </a>
        <form style="display:inline;" action="{{ route('parqueadero.descarga.ingreso') }}" method="POST">
    @csrf
        <button type="submit" class="btn btn-default" style="border-radius: 50px; padding: 10px 25px; box-shadow: var(--shadow-sm); margin-left: 10px;">
            <i class="fa fa-download text-warning"></i> Reporte Diario
        </button>
        </form>
        @endif
    </div>
</div>

<!-- Filters Section -->
<div class="row animate__animated animate__fadeInUp" style="margin-bottom: 20px; animation-delay: 0.55s;">
    <div class="col-md-8">
        <div class="input-group" style="box-shadow: var(--shadow-sm); border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; background: white;">
            <span class="input-group-addon" style="background: white; border: none; padding-left: 20px; color: var(--primary);">
                <i class="fa fa-filter"></i>
            </span>
            <input type="text" id="tableSearch" class="form-control" placeholder="Buscar por placa, nombre o identificación en el listado..." style="border: none; height: 48px; box-shadow: none; font-size: 14px;">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select id="statusFilter" class="form-control" style="height: 48px; border-radius: 12px; box-shadow: var(--shadow-sm); border: 1px solid #e2e8f0; font-weight: 600; color: #475569; appearance: none; background: white url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22 width=%2216%22 height=%2216%22 fill=%22none%22 stroke=%22%2364748b%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22%3E%3Cpath d=%22M4 6l4 4 4-4%22%2F%3E%3C%2Fsvg%3E') no-repeat right 15px center;">
                <option value="all">🔍 Todos los registros</option>
                <option value="inside" style="color: #10b981;">🟢 Solo los que están ADENTRO</option>
                <option value="finished" style="color: #64748b;">⚪ Solo FINALIZADOS</option>
            </select>
        </div>
    </div>
</div>

<!-- Results Table -->
<div class="animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
    <div class="table-responsive" style="padding: 10px;">
        <table id="tableIngresos" class="table table-premium">
            <thead>
                <tr>
                    <th>IDENTIFICACIÓN</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>VEHÍCULO</th>
                    <th class="text-center">PARQUEADERO</th>
                    <th class="text-center">HORA INGRESO</th>
                    <th class="text-center">HORA SALIDA</th>
                    <th>DESPACHO / ROL</th>
                    <th class="text-center">ESTADO</th>
                </tr>
            </thead>
            <tbody>
                @if($ingresos && $ingresos->count() > 0)
                @foreach($ingresos as $ingreso)
                <tr class="{{ $ingreso->salida == null ? 'success-row' : '' }}">
                    <td style="font-weight: 600; color: #1e293b;">{{ $ingreso->identificacion }}</td>
                    <td style="color: #475569;">{{ $ingreso->fullname }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="background: #f1f5f9; padding: 8px; border-radius: 8px;">
                                <i class="fa fa-{{ ($ingreso->vehicu->tipo ?? $ingreso->tipo ?? '') == 'MOTO' ? 'motorcycle' : 'car' }}" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <strong style="color: var(--primary); font-size: 14px;">{{ $ingreso->vehicu->placa ?? $ingreso->placa ?? 'N/A' }}</strong><br>
                                <small class="text-muted">{{ $ingreso->vehicu->tipo ?? $ingreso->tipo ?? 'PERSONAL' }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge-status badge-puesto">
                            <i class="fa fa-map-pin"></i>
                            {{ $ingreso->parqueado->puesto->parqueadero ?? $ingreso->parqueado->no_parqueadero ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span style="color: var(--primary); font-weight: 600;">{{ $ingreso->hora_ingreso }}</span><br>
                        <small class="text-muted" style="font-size: 10px;">{{ $ingreso->fecha_ingreso }}</small>
                    </td>
                    <td class="text-center">
                        @if($ingreso->salida)
                        <span style="color: var(--danger); font-weight: 600;">{{ $ingreso->hora_salida }}</span>
                        @else
                        <span class="badge-status badge-inside">
                            <span class="pulse-dot" style="width: 6px; height: 6px; margin-right: 4px;"></span> ADENTRO
                        </span>
                        @endif
                    </td>
                    <td>
                        <div style="max-width: 200px; font-size: 11px; color: #64748b; line-height: 1.2;">
                            {{ $ingreso->despacho }}
                        </div>
                        <span class="label label-info" style="font-size: 9px; border-radius: 4px; padding: 2px 6px;">{{ $ingreso->tipo_solicitud }}</span>
                    </td>
                    <td class="text-center">
                        @if($ingreso->salida)
                        <span class="badge-status badge-outside">FINALIZADO</span>
                        @else
                        <span class="text-success" style="font-weight: 600; font-size: 11px;"><i class="fa fa-check-circle"></i> ACTIVO</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8" class="text-center" style="padding: 80px; background: white; border-radius: 20px;">
                        <div class="animate__animated animate__pulse animate__infinite">
                            <i class="fa fa-search fa-4x" style="color: #e2e8f0;"></i>
                        </div>
                        <h4 style="color: #94a3b8; margin-top: 20px;">No hay registros para hoy</h4>
                        <p class="text-muted">Los ingresos aparecerán aquí en tiempo real.</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Transiciones suaves para la tabla */
    #tableIngresos tbody tr {
        animation: fadeInRight 0.5s ease backwards;
    }
    
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Estilo de fila activa */
    .success-row {
        border-left: 4px solid var(--success) !important;
    }
</style>
