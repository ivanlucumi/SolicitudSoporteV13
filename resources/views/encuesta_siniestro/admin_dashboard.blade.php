@extends('layouts.admin')

@section('title', 'Dashboard Estadístico – Siniestros')
@section('cabecera', 'Dashboard Siniestros Admin')

@section('content')
{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<style>
/* ───────────────────────────── VARIABLES ───────────────────────────── */
:root {
  --ds-navy:    #0a2a4a;
  --ds-blue:    #1565c0;
  --ds-teal:    #00897b;
  --ds-amber:   #f57c00;
  --ds-red:     #c62828;
  --ds-green:   #2e7d32;
  --ds-purple:  #6a1b9a;
  --ds-surface: #f5f7fa;
  --ds-border:  #e3e8ef;
  --ds-radius:  12px;
  --ds-shadow:  0 4px 20px rgba(10,42,74,.10);
  --ds-shadow-hover: 0 8px 32px rgba(10,42,74,.18);
}

/* ───────────────────────────── HEADER BANNER ───────────────────────── */
.ds-banner {
  background: linear-gradient(135deg, var(--ds-navy) 0%, #1565c0 60%, #0097a7 100%);
  color: #fff;
  padding: 24px 32px;
  border-radius: var(--ds-radius);
  margin-bottom: 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  box-shadow: var(--ds-shadow);
}
.ds-banner h1 {
  margin: 0;
  font-size: 1.55rem;
  font-weight: 800;
  letter-spacing: -.3px;
}
.ds-banner p { margin: 4px 0 0; opacity: .82; font-size: .9rem; }
.ds-export-group { display: flex; gap: 10px; flex-wrap: wrap; }
.btn-export {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 9px 18px;
  border-radius: 50px;
  font-size: .83rem;
  font-weight: 700;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: all .2s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,.18);
}
.btn-export:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,.22); text-decoration: none; }
.btn-export-green  { background: #43a047; color: #fff; }
.btn-export-teal   { background: #00838f; color: #fff; }
.btn-export-back   { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.3); }
.btn-export-back:hover { background: rgba(255,255,255,.25); color: #fff; }

/* ───────────────────────────── KPI CARDS ───────────────────────────── */
.kpi-row { margin-bottom: 28px; }
.kpi-card {
  border-radius: var(--ds-radius);
  padding: 22px 24px;
  display: flex;
  align-items: center;
  gap: 16px;
  color: #fff;
  box-shadow: var(--ds-shadow);
  transition: transform .2s, box-shadow .2s;
  position: relative;
  overflow: hidden;
}
.kpi-card::after {
  content: '';
  position: absolute;
  right: -15px;
  top: -15px;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: rgba(255,255,255,.10);
}
.kpi-card:hover { transform: translateY(-4px); box-shadow: var(--ds-shadow-hover); }
.kpi-card.kpi-blue   { background: linear-gradient(135deg, #1565c0, #42a5f5); }
.kpi-card.kpi-teal   { background: linear-gradient(135deg, #00695c, #26c6da); }
.kpi-card.kpi-amber  { background: linear-gradient(135deg, #e65100, #ffa726); }
.kpi-card.kpi-green  { background: linear-gradient(135deg, #1b5e20, #66bb6a); }
.kpi-card.kpi-red    { background: linear-gradient(135deg, #b71c1c, #ef5350); }
.kpi-icon {
  font-size: 2.2rem;
  opacity: .9;
  flex-shrink: 0;
}
.kpi-data { line-height: 1.2; }
.kpi-value {
  font-size: 2.4rem;
  font-weight: 900;
  display: block;
  letter-spacing: -1px;
}
.kpi-label {
  font-size: .78rem;
  opacity: .88;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .5px;
}

/* ───────────────────────────── CHARTS ──────────────────────────────── */
.charts-row { margin-bottom: 28px; }
.chart-card {
  background: #fff;
  border: 1px solid var(--ds-border);
  border-radius: var(--ds-radius);
  padding: 22px;
  box-shadow: var(--ds-shadow);
}
.chart-card h5 {
  font-weight: 700;
  color: var(--ds-navy);
  margin: 0 0 16px;
  font-size: .95rem;
  display: flex;
  align-items: center;
  gap: 8px;
}
.chart-card canvas { max-height: 260px; }

/* ───────────────────────────── FILTROS ─────────────────────────────── */
.filter-card {
  background: #fff;
  border: 1px solid var(--ds-border);
  border-radius: var(--ds-radius);
  padding: 20px 24px;
  margin-bottom: 28px;
  box-shadow: var(--ds-shadow);
}
.filter-card h6 { margin: 0 0 16px; font-weight: 700; color: var(--ds-navy); font-size: .95rem; }
.filter-grid .form-control { font-size: .85rem; }

/* ───────────────────────────── SECTION HEADERS ─────────────────────── */
.section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin: 28px 0 14px;
}
.section-title {
  font-size: 1.05rem;
  font-weight: 800;
  color: var(--ds-navy);
  display: flex;
  align-items: center;
  gap: 9px;
  margin: 0;
}
.section-badge {
  background: var(--ds-blue);
  color: #fff;
  font-size: .72rem;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 50px;
}
.section-badge.red { background: var(--ds-red); }
.section-badge.green { background: var(--ds-green); }

/* ───────────────────────────── TABLE ───────────────────────────────── */
.ds-table-wrap {
  background: #fff;
  border: 1px solid var(--ds-border);
  border-radius: var(--ds-radius);
  overflow: hidden;
  box-shadow: var(--ds-shadow);
  margin-bottom: 32px;
}
table.ds-table { width: 100%; border-collapse: collapse; }
table.ds-table thead tr { background: var(--ds-navy); color: #fff; }
table.ds-table th {
  padding: 11px 13px;
  font-size: .78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .4px;
  white-space: nowrap;
}
table.ds-table td {
  padding: 9px 13px;
  font-size: .83rem;
  border-bottom: 1px solid #f0f3f7;
  vertical-align: middle;
}
table.ds-table tbody tr:hover td { background: #f0f6ff; }
table.ds-table tbody tr:last-child td { border-bottom: none; }

/* Estado badges */
.badge-estado {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 50px;
  font-size: .72rem;
  font-weight: 700;
  white-space: nowrap;
}
.be-registrado  { background: #e3f2fd; color: #1565c0; }
.be-enviado     { background: #e8f5e9; color: #2e7d32; }
.be-en_revision { background: #fff8e1; color: #e65100; }
.be-cerrado     { background: #fce4ec; color: #b71c1c; }
.be-borrador    { background: #f3f4f6; color: #6b7280; }

/* Acción botones */
.btn-sm-action {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: .75rem;
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  border: none;
  cursor: pointer;
  transition: all .2s;
  white-space: nowrap;
}
.btn-sm-action:hover { transform: translateY(-1px); text-decoration: none; }
.bsa-blue  { background: #1565c0; color: #fff; }
.bsa-red   { background: #c62828; color: #fff; }

/* ───────────────────────────── TABLA SIN SINIESTRO ─────────────────── */
table.ds-table.green-head thead tr { background: #2e7d32; }

/* ───────────────────────────── RESPONSIVE ──────────────────────────── */
@media(max-width: 768px) {
  .ds-banner { flex-direction: column; align-items: flex-start; }
  .kpi-value { font-size: 1.9rem; }
  .section-header { flex-direction: column; align-items: flex-start; }
}

/* ───────────────────────────── ANIMACIONES ──────────────────────────── */
@keyframes countUp {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}
.kpi-card { animation: countUp .4s ease both; }
.kpi-card:nth-child(1) { animation-delay: .05s; }
.kpi-card:nth-child(2) { animation-delay: .10s; }
.kpi-card:nth-child(3) { animation-delay: .15s; }
.kpi-card:nth-child(4) { animation-delay: .20s; }
.kpi-card:nth-child(5) { animation-delay: .25s; }
</style>


{{-- ══════════════════════ BANNER ══════════════════════ --}}
<div class="ds-dashboard-wrapper" style="margin: -15px;">

<div class="ds-banner">
  <div>
    <h1><i class="fa fa-bar-chart"></i> Dashboard Estadístico &mdash; Siniestros</h1>
    <p>Resumen ejecutivo de equipos siniestrados y despachos sin reporte &bull; Rol Administrador</p>
  </div>
  <div class="ds-export-group">
    {{-- Exportar con los filtros activos --}}
    <a href="{{ route('admin.exportar.elementos', $filtros) }}"
       class="btn-export btn-export-green" id="btn-excel-elementos" title="Descargar Excel de equipos siniestrados">
      <i class="fa fa-file-excel-o"></i> Excel Equipos
    </a>
    <a href="{{ route('admin.exportar.sin', array_intersect_key($filtros, array_flip(['despacho','ciudad']))) }}"
       class="btn-export btn-export-teal" id="btn-excel-sin" title="Descargar Excel de despachos sin siniestro">
      <i class="fa fa-file-excel-o"></i> Excel Sin Siniestro
    </a>
    <a href="{{ route('index') }}" class="btn-export btn-export-back">
      <i class="fa fa-arrow-left"></i> Volver
    </a>
  </div>
</div>

{{-- ══════════════════════ KPI CARDS ══════════════════════ --}}
<div class="row kpi-row">
  <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
    <div class="kpi-card kpi-blue">
      <div class="kpi-icon"><i class="fa fa-exclamation-circle"></i></div>
      <div class="kpi-data">
        <span class="kpi-value" id="kpi-siniestros">{{ $totalSiniestros }}</span>
        <span class="kpi-label">Siniestros Registrados</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
    <div class="kpi-card kpi-teal">
      <div class="kpi-icon"><i class="fa fa-laptop"></i></div>
      <div class="kpi-data">
        <span class="kpi-value" id="kpi-elementos">{{ $totalElementos }}</span>
        <span class="kpi-label">Equipos Siniestrados</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
    <div class="kpi-card kpi-amber">
      <div class="kpi-icon"><i class="fa fa-gavel"></i></div>
      <div class="kpi-data">
        <span class="kpi-value" id="kpi-con">{{ $despachosConSiniestro }}</span>
        <span class="kpi-label">Despachos CON Siniestro</span>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
    <div class="kpi-card kpi-green">
      <div class="kpi-icon"><i class="fa fa-check-circle"></i></div>
      <div class="kpi-data">
        <span class="kpi-value" id="kpi-sin">{{ $despachosSinSiniestro }}</span>
        <span class="kpi-label">Despachos SIN Siniestro</span>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
    <div class="kpi-card kpi-red">
      <div class="kpi-icon"><i class="fa fa-envelope"></i></div>
      <div class="kpi-data">
        <span class="kpi-value">{{ $porEstado['enviado'] ?? 0 }}</span>
        <span class="kpi-label">Enviados Aseguradora</span>
      </div>
    </div>
  </div>
</div>

{{-- ══════════════════════ GRÁFICOS ══════════════════════ --}}
<div class="row charts-row">

  {{-- Donut – Por estado --}}
  <div class="col-md-4" style="margin-bottom: 15px;">
    <div class="chart-card">
      <h5><i class="fa fa-pie-chart" style="color:#1565c0;"></i> Estado de Siniestros</h5>
      <canvas id="chartEstados"></canvas>
    </div>
  </div>

  {{-- Barras – Tipo de equipo --}}
  <div class="col-md-8" style="margin-bottom: 15px;">
    <div class="chart-card">
      <h5><i class="fa fa-bar-chart" style="color:#00838f;"></i> Equipos por Tipo</h5>
      <canvas id="chartTipos"></canvas>
    </div>
  </div>

</div>

{{-- ══════════════════════ FILTROS ══════════════════════ --}}
<div class="filter-card">
  <h6><i class="fa fa-filter"></i> Filtrar registros</h6>
  <form method="GET" action="{{ route('admin.dashboard') }}" id="form-filtros">
    <div class="row" style="display:flex; flex-wrap:wrap; align-items:flex-end;">
      <div class="col-md-2 col-sm-4" style="margin-bottom: 10px;">
        <label style="font-size:.8rem;font-weight:600;">Despacho / Juzgado</label>
        <input type="text" name="despacho" class="form-control"
               value="{{ $filtros['despacho'] ?? '' }}" placeholder="Nombre o código...">
      </div>
      <div class="col-md-2 col-sm-4" style="margin-bottom: 10px;">
        <label style="font-size:.8rem;font-weight:600;">Ciudad</label>
        <input type="text" name="ciudad" class="form-control"
               value="{{ $filtros['ciudad'] ?? '' }}" placeholder="Ciudad...">
      </div>
      <div class="col-md-2 col-sm-4" style="margin-bottom: 10px;">
        <label style="font-size:.8rem;font-weight:600;">Tipo de Equipo</label>
        <select name="tipo_elemento" class="form-control">
          <option value="">Todos</option>
          @foreach($tiposElemento as $tipo)
            <option value="{{ $tipo }}" {{ ($filtros['tipo_elemento'] ?? '') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2 col-sm-4" style="margin-bottom: 10px;">
        <label style="font-size:.8rem;font-weight:600;">Estado Siniestro</label>
        <select name="estado" class="form-control">
          <option value="">Todos</option>
          @foreach(['registrado'=>'Registrado','enviado'=>'Enviado','en_revision'=>'En Revisión','cerrado'=>'Cerrado'] as $val=>$lbl)
            <option value="{{ $val }}" {{ ($filtros['estado'] ?? '') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-1 col-sm-3" style="margin-bottom: 10px;">
        <label style="font-size:.8rem;font-weight:600;">Desde</label>
        <input type="date" name="fecha_inicio" class="form-control" value="{{ $filtros['fecha_inicio'] ?? '' }}">
      </div>
      <div class="col-md-1 col-sm-3" style="margin-bottom: 10px;">
        <label style="font-size:.8rem;font-weight:600;">Hasta</label>
        <input type="date" name="fecha_fin" class="form-control" value="{{ $filtros['fecha_fin'] ?? '' }}">
      </div>
      <div class="col-md-2 col-sm-12" style="margin-bottom: 10px; display:flex; gap:8px;">
        <button type="submit" class="btn btn-primary btn-sm" style="height:34px;padding:0 12px;">
          <i class="fa fa-search"></i> Filtrar
        </button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-sm" style="height:34px;padding:0 12px;display:flex;align-items:center;">
          <i class="fa fa-times"></i> Limpiar
        </a>
      </div>
    </div>
  </form>
</div>

{{-- ══════════════════════ TABLA 1: EQUIPOS SINIESTRADOS ══════════════════════ --}}
<div class="section-header">
  <h5 class="section-title">
    <i class="fa fa-exclamation-triangle" style="color:#c62828;"></i>
    Equipos Siniestrados por Despacho / Juzgado
    <span class="section-badge red">{{ $elementosSiniestrados->count() }} registros</span>
  </h5>
  <a href="{{ route('admin.exportar.elementos', $filtros) }}"
     class="btn-export btn-export-green" style="font-size:.8rem;padding:7px 14px;">
    <i class="fa fa-file-excel-o"></i> Descargar Excel
  </a>
</div>

<div class="ds-table-wrap">
  @if($elementosSiniestrados->count())
    <table class="ds-table" id="tabla-elementos">
      <thead>
        <tr>
          <th>#</th>
          <th>Consecutivo</th>
          <th>Código Despacho</th>
          <th>Despacho / Juzgado</th>
          <th>Ciudad</th>
          <th>Fecha Siniestro</th>
          <th>Tipo Equipo</th>
          <th>Placa</th>
          <th>Serial</th>
          <th>Marca / Modelo</th>
          <th>Descripción Daño</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($elementosSiniestrados as $i => $el)
        <tr>
          <td style="color:#999;font-size:.75rem;">{{ $i + 1 }}</td>
          <td>
            <strong style="color:#0a2a4a;font-size:.8rem;">{{ $el->consecutivo }}</strong>
          </td>
          <td style="font-family:monospace;font-size:.8rem;font-weight:600;color:#0a2a4a;white-space:nowrap;">
            {{ $el->despacho_codigo ?? '–' }}
          </td>
          <td>
            <span title="{{ $el->despacho_nombre }}" style="font-size:.82rem;">
              {{ \Illuminate\Support\Str::limit($el->despacho_nombre, 32) }}
            </span>
          </td>
          <td style="font-size:.8rem;">{{ $el->despacho_ciudad ?? '–' }}</td>
          <td style="white-space:nowrap;font-size:.8rem;">
            {{ $el->fecha_siniestro ? \Carbon\Carbon::parse($el->fecha_siniestro)->format('d/m/Y') : '–' }}
          </td>
          <td>
            <span style="background:#e3f2fd;color:#1565c0;padding:2px 8px;border-radius:50px;font-size:.75rem;font-weight:700;">
              {{ $el->tipo_elemento ?? '–' }}
            </span>
          </td>
          <td style="font-size:.8rem;font-family:monospace;">{{ $el->placa ?? '–' }}</td>
          <td style="font-size:.78rem;font-family:monospace;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $el->serial }}">
            {{ $el->serial ?? '–' }}
          </td>
          <td style="font-size:.8rem;">{{ trim(($el->marca ?? '') . ' ' . ($el->modelo ?? '')) ?: '–' }}</td>
          <td style="font-size:.78rem;max-width:160px;" title="{{ $el->descripcion_dano }}">
            {{ \Illuminate\Support\Str::limit($el->descripcion_dano ?? '–', 50) }}
          </td>
          <td style="font-size:.78rem;max-width:140px;" title="{{ $el->observaciones }}">
            {{ \Illuminate\Support\Str::limit($el->observaciones ?? '–', 45) }}
          </td>
          <td style="white-space:nowrap;">
            <a href="{{ route('encuesta.siniestro.show', $el->siniestro_id) }}"
               class="btn-sm-action bsa-blue" title="Ver siniestro completo">
              <i class="fa fa-eye"></i> Ver
            </a>
            <a href="{{ route('encuesta.siniestro.pdf', $el->siniestro_id) }}"
               class="btn-sm-action bsa-red" title="Descargar PDF" target="_blank">
              <i class="fa fa-file-pdf-o"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div style="text-align:center;padding:50px 20px;color:#999;">
      <i class="fa fa-inbox" style="font-size:3rem;display:block;margin-bottom:12px;"></i>
      <p>No hay equipos siniestrados con los filtros aplicados.</p>
    </div>
  @endif
</div>

{{-- ══════════════════════ TABLA 2: DESPACHOS SIN SINIESTRO ══════════════════════ --}}
<div class="section-header">
  <h5 class="section-title">
    <i class="fa fa-building-o" style="color:#2e7d32;"></i>
    Despachos / Juzgados Sin Siniestro Registrado
    <span class="section-badge green">{{ $despachosSinRegistro->count() }} despachos</span>
  </h5>
  <a href="{{ route('admin.exportar.sin', array_intersect_key($filtros, array_flip(['despacho','ciudad']))) }}"
     class="btn-export btn-export-teal" style="font-size:.8rem;padding:7px 14px;">
    <i class="fa fa-file-excel-o"></i> Descargar Excel
  </a>
</div>

<div class="ds-table-wrap">
  @if($despachosSinRegistro->count())
    <table class="ds-table green-head" id="tabla-sin-siniestro">
      <thead>
        <tr>
          <th>#</th>
          <th>Código</th>
          <th>Despacho / Juzgado</th>
          <th>Ciudad</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Circuito</th>
          <th>Especialidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach($despachosSinRegistro as $j => $d)
        <tr>
          <td style="color:#999;font-size:.75rem;">{{ $j + 1 }}</td>
          <td style="font-family:monospace;font-size:.8rem;font-weight:600;color:#0a2a4a;">{{ $d->codigoDespacho }}</td>
          <td style="font-size:.83rem;">{{ $d->nombreDespacho }}</td>
          <td style="font-size:.8rem;">{{ $d->nombreCiudad ?? '–' }}</td>
          <td style="font-size:.78rem;max-width:180px;" title="{{ $d->direccion }}">
            {{ \Illuminate\Support\Str::limit($d->direccion ?? '–', 40) }}
          </td>
          <td style="font-size:.78rem;">
            @if($d->correoD)
              <a href="mailto:{{ $d->correoD }}" style="color:#1565c0;">{{ $d->correoD }}</a>
            @else
              <span style="color:#ccc;">–</span>
            @endif
          </td>
          <td style="font-size:.8rem;">{{ $d->telefono ?? '–' }}</td>
          <td style="font-size:.78rem;">{{ $d->circuito ?? '–' }}</td>
          <td style="font-size:.78rem;">{{ $d->especialidad ?? '–' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div style="text-align:center;padding:50px 20px;color:#2e7d32;">
      <i class="fa fa-check-circle" style="font-size:3rem;display:block;margin-bottom:12px;"></i>
      <p><strong>¡Todos los despachos tienen siniestro registrado!</strong></p>
    </div>
  @endif
</div>

</div> <!-- Cierra ds-dashboard-wrapper -->
@endsection

@push('scripts')
<script>
$(function() {

  /* ── DataTable Equipos Siniestrados ── */
  if ($('#tabla-elementos').length) {
    $('#tabla-elementos').DataTable({
      paging:       true,
      pageLength:   25,
      lengthMenu:   [10, 25, 50, 100],
      searching:    true,
      ordering:     true,
      info:         true,
      autoWidth:    false,
      scrollX:      true,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      columnDefs: [
        { orderable: false, targets: [15] }
      ]
    });
  }

  /* ── DataTable Despachos Sin Siniestro ── */
  if ($('#tabla-sin-siniestro').length) {
    $('#tabla-sin-siniestro').DataTable({
      paging:       true,
      pageLength:   25,
      lengthMenu:   [10, 25, 50, 100],
      searching:    true,
      ordering:     true,
      info:         true,
      autoWidth:    false,
      scrollX:      true,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      }
    });
  }

  /* ═══════════ CHART: Estado de Siniestros (Donut) ═══════════ */
  const porEstado = @json($porEstado);
  const estadoLabels = {
    registrado:  'Registrado',
    enviado:     'Enviado',
    en_revision: 'En Revisión',
    cerrado:     'Cerrado',
    borrador:    'Borrador'
  };
  const estadoColores = {
    registrado:  '#1565c0',
    enviado:     '#2e7d32',
    en_revision: '#f57c00',
    cerrado:     '#c62828',
    borrador:    '#78909c'
  };

  const estadoKeys   = Object.keys(porEstado);
  const estadoValues = Object.values(porEstado);
  const estadoColors = estadoKeys.map(k => estadoColores[k] || '#999');
  const estadoNames  = estadoKeys.map(k => estadoLabels[k] || k);

  if (estadoKeys.length > 0) {
    new Chart(document.getElementById('chartEstados'), {
      type: 'doughnut',
      data: {
        labels: estadoNames,
        datasets: [{
          data: estadoValues,
          backgroundColor: estadoColors,
          borderWidth: 3,
          borderColor: '#fff',
          hoverOffset: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            position: 'bottom',
            labels: { font: { size: 12 }, padding: 14 }
          },
          tooltip: {
            callbacks: {
              label: ctx => ` ${ctx.label}: ${ctx.raw} siniestro(s)`
            }
          }
        },
        cutout: '60%'
      }
    });
  } else {
    document.getElementById('chartEstados').closest('.chart-card').innerHTML =
      '<h5><i class="fa fa-pie-chart" style="color:#1565c0;"></i> Estado de Siniestros</h5>' +
      '<p style="text-align:center;color:#bbb;padding:40px 0;">Sin datos aún</p>';
  }

  /* ═══════════ CHART: Tipos de Equipo (Barras) ═══════════ */
  const tiposData = @json($porTipoElemento);

  if (tiposData.length > 0) {
    const tipoLabels = tiposData.map(t => t.tipo_elemento || 'Sin tipo');
    const tipoValues = tiposData.map(t => t.total);

    const paleta = [
      '#1565c0','#00838f','#2e7d32','#6a1b9a',
      '#c62828','#e65100','#37474f','#1b5e20',
      '#880e4f','#0277bd'
    ];
    const barColors = tipoLabels.map((_, i) => paleta[i % paleta.length]);

    new Chart(document.getElementById('chartTipos'), {
      type: 'bar',
      data: {
        labels: tipoLabels,
        datasets: [{
          label: 'Equipos siniestrados',
          data: tipoValues,
          backgroundColor: barColors,
          borderRadius: 6,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        indexAxis: tipoLabels.length > 6 ? 'y' : 'x',
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: ctx => ` ${ctx.raw} equipo(s)`
            }
          }
        },
        scales: {
          x: {
            grid: { color: '#f0f0f0' },
            ticks: { font: { size: 11 } }
          },
          y: {
            grid: { color: '#f0f0f0' },
            ticks: { font: { size: 11 }, precision: 0 }
          }
        }
      }
    });
  } else {
    document.getElementById('chartTipos').closest('.chart-card').innerHTML =
      '<h5><i class="fa fa-bar-chart" style="color:#00838f;"></i> Equipos por Tipo</h5>' +
      '<p style="text-align:center;color:#bbb;padding:40px 0;">Sin datos aún</p>';
  }

  /* ── Animación de contadores KPI ── */
  function animateCounter(el, target, duration) {
    let start = 0;
    const step = target / (duration / 16);
    const timer = setInterval(() => {
      start += step;
      if (start >= target) { start = target; clearInterval(timer); }
      el.textContent = Math.floor(start).toLocaleString('es-CO');
    }, 16);
  }

  const kpis = [
    { id: 'kpi-siniestros', val: parseInt('{{ $totalSiniestros }}') },
    { id: 'kpi-elementos',  val: parseInt('{{ $totalElementos }}') },
    { id: 'kpi-con',        val: parseInt('{{ $despachosConSiniestro }}') },
    { id: 'kpi-sin',        val: parseInt('{{ $despachosSinSiniestro }}') },
  ];
  kpis.forEach((k, i) => {
    const el = document.getElementById(k.id);
    if (el) setTimeout(() => animateCounter(el, k.val, 800), i * 120);
  });

});
</script>
@endpush
