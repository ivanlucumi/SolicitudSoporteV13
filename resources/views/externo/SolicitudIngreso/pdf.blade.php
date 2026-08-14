@php
  // Intentar obtener la imagen localmente y codificarla en base64 para evitar problemas en producción
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
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Solicitud de Ingreso {{ $solicitud->numero_seguimiento }}</title>
<style>
  @page { margin: 40px 40px 90px 40px; }
  body { font-family: Arial, sans-serif; font-size: 12px; color: #111; line-height: 1.5; margin: 0; padding: 0; }
  
  /* Footer */
  footer {
    position: fixed;
    bottom: -70px;
    left: 0px;
    right: 0px;
    height: 75px;
  }
  .footer-table { width: 100%; font-size: 10.5px; color: #777; }
  .footer-table td { vertical-align: middle; }

  /* Encabezado */
  .header { text-align: center; margin-bottom: 20px; }
  .header .logo-line { border-top: 3px solid #0a2a4a; border-bottom: 1px solid #0a2a4a; padding: 10px 0; margin: 6px 0; }
  .header h1 { font-size: 15px; font-weight: bold; text-transform: uppercase; color: #0a2a4a; letter-spacing: 0.5px; margin: 5px 0;}
  .header h2 { font-size: 12px; color: #333; font-weight: normal; margin: 2px 0;}
  .header .radicado { font-size: 11px; color: #555; margin-top: 4px; }

  /* Títulos de sección */
  .seccion-titulo {
    background: #0a2a4a;
    color: #fff;
    font-weight: bold;
    font-size: 11.5px;
    padding: 5px 10px;
    margin-bottom: 10px;
    margin-top: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Tablas de información */
  .info-table { width: 100%; border-collapse: collapse; margin-bottom: 5px; font-size: 11.5px; }
  .info-table th, .info-table td {
    border: 1px solid #ccc;
    padding: 7px 10px;
    vertical-align: middle;
  }
  .info-table th { background-color: #f4f6f8; color: #333; text-align: left; width: 25%; }
  .info-table td { color: #000; }

  .estado-badge {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: bold;
      color: #fff;
  }
  .bg-success { background-color: #28a745; }
  .bg-danger { background-color: #dc3545; }
  .bg-warning { background-color: #ffc107; color: #000; }
  
  .motivo-box {
      border: 1px solid #ccc;
      padding: 12px;
      background: #fafafa;
      text-align: justify;
      min-height: 80px;
  }
</style>
</head>
<body>

  <footer>
    <table class="footer-table">
      <tr>
        <td style="width: 25%;">
          Fecha Impresión: {{ date('d/m/Y h:i a') }}
        </td>
        <td style="width: 50%; text-align: center;">
          Documento generado por el Sistema de Administración Judicial
        </td>
        <td style="width: 25%; text-align: right;">
          Nº Seguimiento: {{ $solicitud->numero_seguimiento }}
        </td>
      </tr>
    </table>
  </footer>

  @php
    $qrApiUrl = "https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=" . urlencode(route('solicitud_ingreso.qr', $solicitud->numero_seguimiento));
    
    // Convertir el QR a base64 usando cURL para evitar problemas de SSL o allow_url_fopen en el servidor
    $qrData = '';
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $qrApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $qrImage = curl_exec($ch);
        curl_close($ch);
        
        if ($qrImage) {
            $qrData = 'data:image/png;base64,' . base64_encode($qrImage);
        } else {
            $qrData = $qrApiUrl; // Fallback
        }
    } catch (\Exception $e) {
        $qrData = $qrApiUrl; // Fallback
    }
  @endphp
  <table width="100%" style="margin-bottom: 10px;">
    <tr>
      <td width="80%" style="text-align: center;">
        <div style="margin-bottom: 6px;">
          <img src="{{ $logoData }}" width="300" alt="Logo Rama Judicial">
        </div>
      </td>
      <td width="20%" style="text-align: right; vertical-align: top;">
        <img src="{{ $qrData }}" width="90" alt="Código QR">
      </td>
    </tr>
  </table>

  <div class="header" style="margin-top: 0;">
    <div class="logo-line">
      <h1>CONSEJO SUPERIOR DE LA JUDICATURA</h1>
      <h2>DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL</h2>
    </div>
    <div style="font-size: 16px; font-weight: bold; margin-top:15px; color:#0a2a4a;">COMPROBANTE DE SOLICITUD DE INGRESO</div>
    <div class="radicado"><strong>NÚMERO DE SEGUIMIENTO:</strong> <span style="color:#d32f2f; font-weight:bold; font-size:13px;">{{ $solicitud->numero_seguimiento }}</span></div>
    <div class="radicado"><strong>FECHA DE SOLICITUD:</strong> {{ $solicitud->created_at->format('d \d\e F \d\e Y, h:i A') }}</div>
  </div>

  <div class="seccion-titulo">1. INFORMACIÓN DEL DESPACHO / ÁREA (TITULAR)</div>
  <table class="info-table">
    <tr>
      <th>Nombre del Titular:</th>
      <td>{{ $solicitud->nombre_titular }}</td>
    </tr>
    <tr>
      <th>Cédula:</th>
      <td>{{ $solicitud->cedula_titular }}</td>
    </tr>
    <tr>
      <th>Cargo:</th>
      <td>{{ $solicitud->cargo_titular }}</td>
    </tr>
    <tr>
      <th>Correo Institucional:</th>
      <td>{{ $solicitud->correo_titular }}</td>
    </tr>
  </table>

  <div class="seccion-titulo">2. INFORMACIÓN DEL EMPLEADO A INGRESAR</div>
  <table class="info-table">
    <tr>
      <th>Nombre del Empleado:</th>
      <td>{{ $solicitud->nombre_empleado }}</td>
    </tr>
    <tr>
      <th>Cédula:</th>
      <td>{{ $solicitud->cedula_empleado }}</td>
    </tr>
    <tr>
      <th>Cargo:</th>
      <td>{{ $solicitud->cargo_empleado }}</td>
    </tr>
  </table>

  <div class="seccion-titulo">3. MOTIVO DE INGRESO DECLARADO</div>
  <div class="motivo-box">
      {{ $solicitud->motivo_ingreso }}
  </div>

  <div class="seccion-titulo">4. RESPUESTA DE ALMACÉN E INVENTARIOS</div>
  <table class="info-table">
    <tr>
      <th>Estado de Solicitud:</th>
      <td>
        @if($solicitud->estado == 'Autorizada')
            <span class="estado-badge bg-success">AUTORIZADA</span>
        @elseif($solicitud->estado == 'Denegada')
            <span class="estado-badge bg-danger">DENEGADA</span>
        @else
            <span class="estado-badge bg-warning">PENDIENTE DE REVISIÓN</span>
        @endif
      </td>
    </tr>
    @if($solicitud->estado == 'Autorizada')
    <tr>
      <th>Fecha de Ingreso:</th>
      <td><strong>{{ \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d \d\e m \d\e Y') }}</strong> a las <strong>{{ $solicitud->hora_ingreso }}</strong></td>
    </tr>
    @endif
    <tr>
      <th>Observaciones:</th>
      <td>{{ $solicitud->observaciones_almacen ?? 'Ninguna' }}</td>
    </tr>
  </table>

  <div style="margin-top: 60px; text-align: center; font-size: 11px; color:#555;">
      <p>Este documento es un comprobante electrónico y está sujeto a verificación por parte del personal de seguridad física.</p>
  </div>

</body>
</html>
