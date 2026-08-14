<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inspección de Vehículo Oficial</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f8fafc; color: #1e293b; }
  .wrapper { max-width: 600px; margin: 40px auto; }
  .header { background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); padding: 32px 40px; border-radius: 16px 16px 0 0; }
  .header h1 { color: #fff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
  .header p { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 6px; }
  .body { background: #fff; padding: 36px 40px; }
  .alert-box { background: #f0fdfa; border: 1px solid #14b8a6; border-left: 5px solid #14b8a6; border-radius: 8px; padding: 16px 20px; margin-bottom: 28px; }
  .alert-box p { font-size: 14px; font-weight: 600; color: #0f766e; }
  .section-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px; }
  .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px; }
  .detail-item .d-label { font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
  .detail-item .d-value { font-size: 15px; font-weight: 600; color: #1e293b; }
  .badge { display: inline-block; padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
  .badge-apto { background: #dcfce7; color: #166534; }
  .badge-observaciones { background: #fef3c7; color: #92400e; }
  .badge-no-apto { background: #fee2e2; color: #991b1b; }
  .guard-box { background: #f8fafc; border-radius: 8px; padding: 16px 20px; display: flex; align-items: center; gap: 12px; }
  .guard-icon { width: 40px; height: 40px; background: #0ea5e9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; flex-shrink: 0; }
  .guard-info .name { font-weight: 700; font-size: 14px; }
  .guard-info .role { font-size: 12px; color: #64748b; }
  .footer { background: #f8fafc; padding: 20px 40px; border-radius: 0 0 16px 16px; text-align: center; }
  .footer p { font-size: 12px; color: #94a3b8; }
  .footer a { color: #0ea5e9; text-decoration: none; font-weight: 600; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <h1>🚗 Inspección Preoperativa Registrada</h1>
    <p>SIRIS CALI · Módulo de Conductores · {{ $inspeccion->fecha }} {{ $inspeccion->hora }}</p>
  </div>
  <div class="body">
    <div class="alert-box">
      <p>🔔 Se ha registrado un nuevo formulario de inspección (check-out) para salida de vehículo oficial.</p>
    </div>

    <div class="section-title">Información del Vehículo y Estado</div>
    <div class="detail-grid">
      <div class="detail-item">
        <div class="d-label">Estado de Inspección</div>
        <div class="d-value">
          @if($inspeccion->estado == 'APTO')
            <span class="badge badge-apto">Apto</span>
          @elseif($inspeccion->estado == 'OBSERVACIONES')
            <span class="badge badge-observaciones">Observaciones</span>
          @else
            <span class="badge badge-no-apto">No Apto</span>
          @endif
        </div>
      </div>
      <div class="detail-item">
        <div class="d-label">Placa del Vehículo</div>
        <div class="d-value" style="font-size:18px; letter-spacing: 2px; color: #0ea5e9;">{{ strtoupper($inspeccion->placa) }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Tipo de Vehículo</div>
        <div class="d-value">{{ $inspeccion->tipo_vehiculo }}</div>
      </div>
      <div class="detail-item">
        <div class="d-label">Kilometraje Inicial</div>
        <div class="d-value">{{ number_format($inspeccion->kilometraje) }} km</div>
      </div>
    </div>

    <div style="text-align: center; margin-bottom: 28px;">
      <a href="{{ route('conductores.inspeccion.exportar', $inspeccion->id) }}" style="background: #0ea5e9; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-block;">📄 Descargar PDF de Inspección</a>
    </div>

    @if(!empty($inspeccion->observaciones) || count($failedItems) > 0)
    <div class="section-title" style="color:#b45309; border-color:#fef3c7;">Observaciones Registradas</div>
    <div style="background:#fef9f0; padding:15px; border-radius:8px; margin-bottom:28px; font-size:14px; color:#78350f;">
      @if(count($failedItems) > 0)
        <strong>Ítems marcados con NO:</strong><br>
        <ul style="margin-left: 20px; margin-top:5px; margin-bottom:10px;">
          @foreach($failedItems as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      @endif
      @if(!empty($inspeccion->observaciones))
        <strong>Observaciones Generales:</strong><br>
        {{ $inspeccion->observaciones }}
      @endif
    </div>
    @endif

    <div class="section-title">Conductor / Responsable</div>
    <div class="guard-box">
      <div class="guard-icon">👨‍✈️</div>
      <div class="guard-info">
        <div class="name">{{ $inspeccion->quien_registro }}</div>
        <div class="role">Identificación: {{ $inspeccion->conductor_cedula }}</div>
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
