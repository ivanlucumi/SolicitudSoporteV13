<!DOCTYPE html>
<html lang="es">
<head>
@php
  $logoPath = public_path('img/logoLargo.png');
  if (!file_exists($logoPath)) {
      $logoPath = base_path('public_html/img/logoLargo.png');
  }
  if (!file_exists($logoPath)) {
      $logoPath = base_path('public/img/logoLargo.png');
  }
  $logoData = '';
  if (file_exists($logoPath)) {
      $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
  } else {
      $logoData = asset('img/logoLargo.png');
  }
@endphp
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Reporte de Siniestro – {{ $siniestro->consecutivo }}</title>
<style>
  @page { margin: 30px 40px; }
  * { box-sizing:border-box; }
  body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size:9pt; color:#1a1a1a; background:#fff; margin:0; padding:0; line-height:1.4; }

  /* ── ENCABEZADO ── */
  .header { background: #f8fafc; color:#0a2a4a; border-bottom: 2px solid #0a2a4a; padding:14px 18px; margin-bottom:0; }
  .header-inner { display:table; width:100%; }
  .header-logo  { display:table-cell; width:220px; vertical-align:middle; padding-right:15px; }
  .header-logo img { max-width:100%; height:auto; }
  .header-title { display:table-cell; vertical-align:middle; border-left: 2px solid #cbd5e1; padding-left:15px; }
  .header-title h1 { font-size:12pt; font-weight:700; margin-bottom:2px; }
  .header-title p  { font-size:7pt; opacity:0.85; margin:0; }
  .header-consec { display:table-cell; text-align:right; vertical-align:middle; width: 140px; }
  .consec-box {
    background:#fff; border:1px solid #0a2a4a; color:#0a2a4a;
    padding:6px 12px; border-radius:6px; text-align:center;
  }
  .consec-box .lbl { font-size:7pt; opacity:0.8; display:block; }
  .consec-box .val { font-size:12pt; font-weight:800; font-family:monospace; }

  /* ── SUBENCABEZADO ── */
  .subheader {
    background: #f1f5f9; color:#333; border-bottom: 1px solid #cbd5e1; padding:8px 18px;
    font-size:7.5pt; display:table; width:100%; margin-top:10px;
  }
  .subheader td { display:table-cell; }
  .subheader td:last-child { text-align:right; }

  /* ── ESTADO ── */
  .estado-bar {
    text-align:center; padding:5px;
    background: #fdf2f8; border: 1px solid #c0392b; color:#c0392b; font-weight:700; font-size:8pt;
  }
  .estado-bar.enviado   { background:#f0fdf4; border: 1px solid #27ae60; color:#27ae60; }
  .estado-bar.registrado { background:#eff6ff; border: 1px solid #2980b9; color:#2980b9; }
  .estado-bar.borrador  { background:#f8fafc; border: 1px solid #95a5a6; color:#555; }

  /* ── SECCIONES ── */
  .section { margin: 10px 16px; }
  .section-title {
    font-size:9pt; font-weight:700; color:#0a2a4a;
    border-bottom:2px solid #0a2a4a; padding-bottom:3px; margin-bottom:8px;
    text-transform:uppercase; letter-spacing:0.05em;
  }
  .info-grid { width:100%; border-collapse:collapse; margin-bottom:10px; }
  .info-grid td { padding:6px 8px; font-size:8.5pt; vertical-align:top; border-bottom:1px solid #eee; }
  .info-grid .lbl { font-weight:700; color:#555; width:20%; font-size:7.5pt; text-transform:uppercase; }
  .info-grid .val { color:#111; width:30%; }

  /* ── ELEMENTOS ── */
  .elemento-block {
    border:1.5px solid #ddd; border-radius:5px; margin-bottom:12px; overflow:hidden;
    page-break-inside: avoid;
  }
  .elemento-header {
    background: #e2e8f0;
    color:#0a2a4a; padding:7px 12px; font-size:9pt; font-weight:700; border-bottom: 1px solid #cbd5e1;
  }
  .elemento-body { padding:8px 12px; }
  .elem-grid { width:100%; border-collapse:collapse; margin-bottom:6px; }
  .elem-grid td { padding:3px 6px; font-size:8pt; }
  .elem-grid .el  { font-weight:700; color:#555; width:30%; text-transform:uppercase; font-size:7.5pt; }
  .elem-grid .ev  { color:#111; border-bottom:1px dotted #ddd; }

  .dano-box {
    background:#fff; border:1px solid #f39c12; border-left:4px solid #f39c12;
    padding:6px 10px; border-radius:4px; margin-bottom:6px; font-size:8pt;
  }
  .dano-box strong { font-size:7.5pt; text-transform:uppercase; color:#888; display:block; margin-bottom:2px; }

  /* ── FOTOS ── */
  .fotos-section { margin-top:6px; }
  .fotos-section .f-title { font-size:7.5pt; font-weight:700; color:#555; text-transform:uppercase; margin-bottom:6px; }
  .fotos-grid-pdf { width:100%; border-collapse:collapse; }
  .fotos-grid-pdf td { padding:5px; width:50%; }
  .fotos-grid-pdf img { width:100%; height:180px; object-fit:cover; border-radius:4px; border:1px solid #ddd; }

  /* ── FIRMA / PIE ── */
  .firmas { display:table; width:100%; margin:16px 16px 0; }
  .firma-cell { display:table-cell; width:45%; text-align:center; border-top:1.5px solid #333; padding-top:6px; font-size:8pt; }

  .footer {
    background:#f8fafc; color:#555; border-top: 1px solid #cbd5e1; font-size:7pt;
    padding:8px 18px; margin-top:16px; display:table; width:100%;
  }
  .footer td { display:table-cell; }
  .footer td:last-child { text-align:right; }
</style>
</head>
<body>

{{-- ── ENCABEZADO ── --}}
<div class="header">
  <div class="header-inner">
    <div class="header-logo">
      <img src="{{ $logoData }}" alt="Logo Rama Judicial">
    </div>
    <div class="header-title">
      <h1><center>REPORTE DE SINIESTRO</center></h1>
      <p style="color:#555;"> <center> Consejo Superior de la Judicatura<br>Dirección Seccional de Administración Judicial<br>Cali - Valle del Cauca</center> </p>
      <p style="color:#555;"><center>"Fortaleciendo la justicia, promoviendo el bienestar de todos"</center></p>
    </div>
    <div class="header-consec">
      <div class="consec-box">
        <span class="lbl">No. SINIESTRO</span>
        <span class="val">{{ $siniestro->consecutivo }}</span>
      </div>
    </div>
  </div>
</div>

<div class="subheader">
  <table width="100%" style="border-collapse:collapse;"><tr>
    <td style="width:40%;">Fecha Siniestro: <strong>10 de Agosto 2026</strong></td>
    <td style="width:30%; text-align:center;">Elementos: <strong>{{ $siniestro->elementos->count() }}</strong></td>
    <td style="width:30%; text-align:right;">Generado: {{ now()->format('d/m/Y H:i') }}</td>
  </tr></table>
</div>

{{-- ── INFO DESPACHO ── --}}
<div class="section" style="margin-top:12px;">
  <div class="section-title">Información del Despacho</div>
  <table class="info-grid" width="100%">
    <tr>
      <td class="lbl">Código</td><td class="val">{{ $siniestro->despacho_codigo }}</td>
      <td class="lbl">Ciudad</td><td class="val">{{ $siniestro->despacho_ciudad }}</td>
    </tr>
    <tr>
      <td class="lbl">Nombre</td><td class="val" colspan="3">{{ $siniestro->despacho_nombre }}</td>
    </tr>
    <tr>
      <td class="lbl">Dirección</td><td class="val">{{ $siniestro->despacho_direccion }}</td>
      <td class="lbl">Correo</td><td class="val">{{ $siniestro->despacho_correo }}</td>
    </tr>
  </table>
</div>

{{-- ── TITULAR DESPACHO ── --}}
@if($siniestro->titular_nombre)
<div class="section">
  <div class="section-title">Titular del Despacho</div>
  <table class="info-grid" width="100%">
    <tr>
      <td class="lbl">Nombre</td><td class="val" colspan="3">{{ $siniestro->titular_nombre }}</td>
    </tr>
    <tr>      
      <td class="lbl">Cédula</td><td class="val">{{ $siniestro->titular_cedula }}</td>
      <td class="lbl">Cargo</td><td class="val">{{ $siniestro->titular_cargo }}</td>      
    </tr>

  </table>
</div>
@endif

{{-- ── EMPLEADOS ── --}}
@if(is_array($siniestro->empleados_json) && count($siniestro->empleados_json) > 0)
<div class="section">
  <div class="section-title">Empleado Presente</div>
  <table class="info-grid" width="100%">
    @foreach($siniestro->empleados_json as $emp)
    <tr>
      <td class="lbl">Nombre</td>
      <td class="val">{{ $emp['nombre'] ?? '' }}</td>
      <td class="lbl">Cédula</td>
      <td class="val">{{ $emp['cedula'] ?? '' }}</td>
    </tr>
    @if(!empty($emp['cargo']))
    <tr>
      <td class="lbl">Cargo</td>
      <td class="val" colspan="3">{{ $emp['cargo'] }}</td>
    </tr>
    @endif
    @endforeach
  </table>
</div>
@endif

{{-- ── OBSERVACIONES GENERALES ── --}}
@if($siniestro->observaciones_generales)
<div class="section">
  <div class="section-title">Observaciones Generales</div>
  <div style="background:#f5f7fa; padding:8px 12px; border-radius:5px; border-left:3px solid #2980b9; font-size:8.5pt;">
    {!! $siniestro->observaciones_generales !!}
  </div>
</div>
@endif

{{-- ── ELEMENTOS ── --}}
<div class="section">
  <div class="section-title">📦 Elementos Afectados ({{ $siniestro->elementos->count() }})</div>

  @foreach($siniestro->elementos as $i => $elem)
  <div class="elemento-block">
    <div class="elemento-header">
      Elemento {{ $i + 1 }}: {{ $elem->tipo_elemento }}
      @if($elem->placa) &nbsp;|&nbsp; Placa: {{ $elem->placa }} @endif
    </div>
    <div class="elemento-body">
      <table class="elem-grid" width="100%">
        <tr>
          <td class="el">Tipo</td><td class="ev">{{ $elem->tipo_elemento ?: '–' }}</td>
          <td class="el">Nombre</td><td class="ev">{{ $elem->nombre_elemento ?: '–' }}</td>
        </tr>
        <tr>
          <td class="el">Placa</td><td class="ev">{{ $elem->placa ?: '–' }}</td>
          <td class="el">Serial</td><td class="ev">{{ $elem->serial ?: '–' }}</td>
        </tr>
        <tr>
          <td class="el">Marca</td><td class="ev">{{ $elem->marca ?: '–' }}</td>
          <td class="el">Modelo</td><td class="ev">{{ $elem->modelo ?: '–' }}</td>
        </tr>
        <tr>
          <td class="el">Estado Anterior</td><td class="ev">{{ $elem->estado_anterior ?: '–' }}</td>
          <td class="el">Estado Posterior</td><td class="ev">{{ $elem->estado_posterior ?: '–' }}</td>
        </tr>
      </table>

      @if($elem->descripcion_dano)
      <div class="dano-box">
        <strong>Descripción del Daño:</strong>
        {{ $elem->descripcion_dano }}
      </div>
      @endif

      @if($elem->observaciones)
      <div style="font-size:8pt; color:#555; padding:4px 0;">
        <strong style="text-transform:uppercase; font-size:7.5pt;">Observaciones:</strong> {{ $elem->observaciones }}
      </div>
      @endif

      {{-- Fotos del elemento (max 6 por elemento en PDF) (desactivado temporalmente) --}}
      @if(false && $elem->fotos->count())
      <div class="fotos-section">
        <div class="f-title">Fotografías ({{ $elem->fotos->count() }})</div>
        <table class="fotos-grid-pdf">
          @foreach($elem->fotos->chunk(2) as $row)
          <tr>
            @foreach($row as $foto)
            <td>
              @php $b64 = $foto->base64; @endphp
              @if($b64)
                <img src="{{ $b64 }}" alt="Foto siniestro">
              @else
                <div style="height:180px;background:#eee;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:7pt;color:#aaa;">Sin imagen</div>
              @endif
            </td>
            @endforeach
            {{-- Rellenar celdas vacías --}}
            @for($j = $row->count(); $j < 2; $j++)
              <td></td>
            @endfor
          </tr>
          @endforeach
        </table>
      </div>
      @endif

    </div>
  </div>
  @endforeach
</div>

{{-- ── FIRMAS ── --}}
<table width="100%" style="margin-top:20px; border-collapse:collapse;">
  <tr>
    <td style="text-align:center; padding:0 20px; width: 50%; vertical-align: bottom;">
      <div style="height:80px;"></div> {{-- Espacio para firma manual --}}
      <div style="border-top:1.5px solid #333; padding-top:6px; font-size:8pt;">
        <strong>{{ $siniestro->user?->name }} {{ $siniestro->user?->lastname }}</strong><br>
        Funcionario Que Realiza el Reporte<br>
        Dirección Seccional de Administración Judicial<br>
        Fecha: {{ $siniestro->created_at->format('d/m/Y') }}
      </div>
    </td>
    
    @if($siniestro->firma_empleado)
    <td style="text-align:center; padding:0 20px; width: 50%; vertical-align: bottom;">
      <div style="height:80px; margin-bottom:5px;">
         <img src="{{ $siniestro->firma_empleado }}" alt="Firma Empleado" style="max-height:80px; display:block; margin:0 auto;">
      </div>
      <div style="border-top:1.5px solid #333; padding-top:6px; font-size:8pt;">
        @php
            $empFirmaNombre = 'Empleado Involucrado / Afectado';
            $empFirmaCedula = '';
            $empFirmaCargo = 'Funcionario que asiste';
            if(is_array($siniestro->empleados_json) && count($siniestro->empleados_json) > 0) {
                $primerEmp = $siniestro->empleados_json[0];
                if(!empty($primerEmp['nombre'])) $empFirmaNombre = $primerEmp['nombre'];
                if(!empty($primerEmp['cedula'])) $empFirmaCedula = 'C.C. ' . $primerEmp['cedula'];
                if(!empty($primerEmp['cargo'])) $empFirmaCargo = $primerEmp['cargo'];
            }
        @endphp
        <strong>{{ $empFirmaNombre }}</strong><br>
        @if($empFirmaCedula){{ $empFirmaCedula }}<br>@endif
        {{ $empFirmaCargo }}<br>
        Fecha: {{ $siniestro->created_at->format('d/m/Y') }}
      </div>
    </td>
    @else
    <td style="text-align:center; padding:0 20px; width: 50%; vertical-align: bottom;">
      <div style="height:80px;"></div> {{-- Espacio vacío para balancear --}}
    </td>
    @endif
  </tr>
</table>

{{-- ── PIE ── --}}
<div class="footer">
  <table width="100%"><tr>
    <td>SIRIS CALI – Sistema de Información de Recursos de la Rama Judicial</td>
    <td style="text-align:right;">{{ $siniestro->consecutivo }}</td>
  </tr></table>
</div>

</body>
</html>
