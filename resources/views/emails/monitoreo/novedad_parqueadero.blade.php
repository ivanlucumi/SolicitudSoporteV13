<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Novedad Parqueadero</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f8fafc; color: #1e293b; }
  .wrapper { max-width: 600px; margin: 40px auto; }
  .header { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 32px 40px; border-radius: 16px 16px 0 0; }
  .header h1 { color: #fff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
  .header p { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 6px; }
  .body { background: #fff; padding: 36px 40px; }
  .alert-box { background: #fef3c7; border: 1px solid #f59e0b; border-left: 5px solid #f59e0b; border-radius: 8px; padding: 16px 20px; margin-bottom: 28px; }
  .alert-box p { font-size: 14px; font-weight: 600; color: #92400e; }
  .novedad-box { background: #fef9f0; border: 2px solid #f59e0b; border-radius: 12px; padding: 20px 24px; margin-bottom: 28px; }
  .novedad-box .label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #b45309; margin-bottom: 8px; }
  .novedad-box .text { font-size: 16px; font-weight: 600; color: #78350f; line-height: 1.5; }
  .section-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px; }
  .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px; }
  .detail-item .d-label { font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
  .detail-item .d-value { font-size: 15px; font-weight: 600; color: #1e293b; }
  .badge { display: inline-block; padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
  .badge-ingreso { background: #dce8f5; color: #004182; }
  .badge-salida { background: #fee2e2; color: #991b1b; }
  .badge-reingreso { background: #dbeafe; color: #1e40af; }
  .guard-box { background: #f8fafc; border-radius: 8px; padding: 16px 20px; display: flex; align-items: center; gap: 12px; }
  .guard-icon { width: 40px; height: 40px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; flex-shrink: 0; }
  .guard-info .name { font-weight: 700; font-size: 14px; }
  .guard-info .role { font-size: 12px; color: #64748b; }
  .footer { background: #f8fafc; padding: 20px 40px; border-radius: 0 0 16px 16px; text-align: center; }
  .footer p { font-size: 12px; color: #94a3b8; }
  .footer a { color: #2563eb; text-decoration: none; font-weight: 600; }
  .timestamp { font-size: 12px; color: #94a3b8; margin-top: 4px; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <h1>⚠️ Novedad en Parqueadero</h1>
    <p>SIRIS CALI · Sistema de Control de Acceso · {{ now()->format('d/m/Y H:i') }}</p>
  </div>
  <div class="body">
    <div class="alert-box">
      <p>🔔 Se ha registrado una novedad durante un evento de parqueadero. Requiere su atención.</p>
    </div>

    <div class="novedad-box">
      <div class="label">📋 Novedad Reportada</div>
      <div class="text">{{ strtoupper($novedades) }}</div>
    </div>

    <div class="section-title">Información del Evento</div>
    <div class="detail-grid">
      <div class="detail-item">
        <div class="d-label">Tipo de Evento</div>
        <div class="d-value">
          @if(str_contains(strtoupper($registro->tipo_ingreso ?? 'INGRESO'), 'SALIDA'))
            <span class="badge badge-salida">Salida</span>
          @elseif(str_contains(strtoupper($registro->tipo_ingreso ?? ''), 'REINGRESO'))
            <span class="badge badge-reingreso">Reingreso</span>
          @else
            <span class="badge badge-ingreso">Ingreso</span>
          @endif
        </div>
      </div>
      <div class="detail-item">
        <div class="d-label">Portería</div>
        <div class="d-value">{{ $registro->porteria ?? 'N/A' }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Nombre</div>
        <div class="d-value">{{ $registro->nombre }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Identificación</div>
        <div class="d-value">{{ $registro->cedula }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Placa del Vehículo</div>
        <div class="d-value" style="font-size:18px; letter-spacing: 2px; color: #2563eb;">{{ strtoupper($registro->placa ?? 'N/A') }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Tipo de Vehículo</div>
        <div class="d-value">{{ $registro->vehiculo ?? 'N/A' }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">No. Puesto</div>
        <div class="d-value">{{ $registro->no_puesto ?? 'N/A' }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Hora del Evento</div>
        <div class="d-value">{{ $registro->hora_ingreso ?? now()->format('H:i:s') }}</div>
      </div>
    </div>

    <div class="section-title">Registrado por</div>
    <div class="guard-box">
      <div class="guard-icon">👮</div>
      <div class="guard-info">
        <div class="name">{{ $registro->quien_registro_ingreso ?? 'Portería' }}</div>
        <div class="role">Guarda / Portería · {{ $registro->porteria ?? 'General' }}</div>
        <div class="timestamp">{{ $registro->fecha ?? now()->format('Y-m-d') }} {{ $registro->hora_ingreso ?? '' }}</div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>Este es un mensaje automático del <a href="#">Sistema SIRIS CALI</a>.</p>
    <p style="margin-top: 6px;">Por favor no responda a este correo.</p>
  </div>
</div>
</body>
</html>
