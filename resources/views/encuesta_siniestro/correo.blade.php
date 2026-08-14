<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reporte de Siniestro – {{ $siniestro->consecutivo }}</title>
<style>
  body { margin:0; padding:0; font-family: 'Segoe UI', Arial, sans-serif; background:#f4f6fb; color:#222; }
  .container { max-width:680px; margin:0 auto; background:#fff; border-radius:10px; overflow:hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }

  .header { background: linear-gradient(135deg, #0a2a4a 0%, #1a3f6f 100%); color:#fff; padding:28px 32px; }
  .header h1 { margin:0 0 4px; font-size:1.3rem; font-weight:800; }
  .header p  { margin:0; font-size:0.85rem; opacity:0.8; }
  .consec-box {
    display:inline-block; margin-top:12px; background:rgba(255,255,255,0.15);
    border:1px solid rgba(255,255,255,0.3); padding:6px 16px; border-radius:20px;
    font-family:monospace; font-size:1.1rem; font-weight:800; letter-spacing:0.05em;
  }

  .status-bar { padding:12px 32px; font-weight:700; font-size:0.9rem; text-align:center; }
  .status-enviado    { background:#eafaf1; color:#1e8449; border-bottom:3px solid #27ae60; }
  .status-registrado { background:#eaf3fb; color:#1a5276; border-bottom:3px solid #2980b9; }

  .body { padding:24px 32px; }
  .section { margin-bottom:22px; }
  .section-title {
    font-size:0.78rem; font-weight:800; color:#0a2a4a; text-transform:uppercase;
    letter-spacing:0.08em; border-bottom:2px solid #0a2a4a; padding-bottom:5px; margin-bottom:12px;
  }
  .info-table { width:100%; border-collapse:collapse; }
  .info-table td { padding:6px 10px; font-size:0.85rem; }
  .info-table .lbl { font-weight:700; color:#666; width:35%; font-size:0.78rem; text-transform:uppercase; }
  .info-table .val { color:#111; border-bottom:1px solid #f0f0f0; }

  .elem-block { border:1.5px solid #e0e6ef; border-radius:8px; margin-bottom:14px; overflow:hidden; }
  .elem-header { background:#0a2a4a; color:#fff; padding:10px 16px; font-weight:700; font-size:0.9rem; }
  .elem-body { padding:14px 16px; }

  .dano-alert { background:#fef9ec; border-left:4px solid #f39c12; padding:10px 14px; border-radius:0 6px 6px 0; margin-top:8px; font-size:0.85rem; }
  .dano-alert strong { display:block; font-size:0.76rem; color:#888; text-transform:uppercase; margin-bottom:3px; }

  .footer { background:#f8fafd; padding:20px 32px; border-top:1px solid #e0e6ef; text-align:center; font-size:0.78rem; color:#888; }
  .footer strong { color:#0a2a4a; }

  .btn { display:inline-block; padding:12px 28px; background:#c0392b; color:#fff; text-decoration:none; border-radius:24px; font-weight:700; font-size:0.9rem; margin-top:16px; }
</style>
</head>
<body>
<div class="container">

  <div class="header">
    <h1>⚖ Reporte de Siniestro Registrado</h1>
    <p>Dirección Seccional de Administración Judicial – SIRIS CALI</p>
    <div class="consec-box">{{ $siniestro->consecutivo }}</div>
  </div>

  <div class="status-bar status-{{ $siniestro->estado }}">
    Estado: {{ strtoupper($siniestro->estado_label) }}
    @if($siniestro->correo_enviado) &nbsp;|&nbsp; ✉ Correo Enviado @endif
  </div>

  <div class="body">

    <div class="section">
      <div class="section-title">🏛 Despacho</div>
      <table class="info-table">
        <tr><td class="lbl">Nombre</td><td class="val">{{ $siniestro->despacho_nombre }}</td></tr>
        <tr><td class="lbl">Código</td><td class="val">{{ $siniestro->despacho_codigo }}</td></tr>
        <tr><td class="lbl">Ciudad</td><td class="val">{{ $siniestro->despacho_ciudad }}</td></tr>
        <tr><td class="lbl">Correo</td><td class="val">{{ $siniestro->despacho_correo }}</td></tr>
        <tr><td class="lbl">Fecha Siniestro</td><td class="val">{{ $siniestro->fecha_siniestro?->format('d/m/Y') }}</td></tr>
      </table>
    </div>

    @if($siniestro->titular_nombre)
    <div class="section">
      <div class="section-title">👤 Titular del Despacho</div>
      <table class="info-table">
        <tr><td class="lbl">Nombre</td><td class="val">{{ $siniestro->titular_nombre }}</td></tr>
        <tr><td class="lbl">Cargo</td><td class="val">{{ $siniestro->titular_cargo }}</td></tr>
        <tr><td class="lbl">Cédula</td><td class="val">{{ $siniestro->titular_cedula }}</td></tr>
      </table>
    </div>
    @endif

    <div class="section">
      <div class="section-title">📦 Elementos Afectados ({{ $siniestro->elementos->count() }})</div>
      @foreach($siniestro->elementos as $i => $elem)
      <div class="elem-block">
        <div class="elem-header">Elemento {{ $i+1 }}: {{ $elem->tipo_elemento }} – {{ $elem->nombre_elemento }}</div>
        <div class="elem-body">
          <table class="info-table">
            <tr><td class="lbl">Placa</td><td class="val">{{ $elem->placa ?: '–' }}</td></tr>
            <tr><td class="lbl">Marca / Modelo</td><td class="val">{{ $elem->marca }} {{ $elem->modelo }}</td></tr>
            <tr><td class="lbl">Estado Anterior</td><td class="val">{{ $elem->estado_anterior ?: '–' }}</td></tr>
            <tr><td class="lbl">Estado Posterior</td><td class="val">{{ $elem->estado_posterior ?: '–' }}</td></tr>
            <tr><td class="lbl">Fotos adjuntas</td><td class="val">{{ $elem->fotos->count() }} fotografía(s)</td></tr>
          </table>
          @if($elem->descripcion_dano)
          <div class="dano-alert">
            <strong>Descripción del Daño</strong>
            {{ $elem->descripcion_dano }}
          </div>
          @endif
        </div>
      </div>
      @endforeach
    </div>

    @if($siniestro->observaciones_generales)
    <div class="section">
      <div class="section-title">📝 Observaciones Generales</div>
      <p style="font-size:0.88rem; line-height:1.6; background:#f8fafd; padding:12px; border-radius:6px; border-left:3px solid #2980b9;">
        {{ $siniestro->observaciones_generales }}
      </p>
    </div>
    @endif

    <div style="text-align:center; margin-top:10px;">
      <p style="font-size:0.85rem; color:#666;">El PDF completo con fotografías se adjunta a este correo.</p>
    </div>

  </div>

  <div class="footer">
    <p>Este correo fue generado automáticamente por <strong>SIRIS CALI</strong>.</p>
    <p>Dirección Seccional de Administración Judicial – Cali</p>
    <p>No responder a este correo. Para contacto: <strong>siriscali@disajcali.gov.co</strong></p>
  </div>

</div>
</body>
</html>
