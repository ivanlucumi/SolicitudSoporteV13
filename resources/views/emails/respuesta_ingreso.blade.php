<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Respuesta a Solicitud de Ingreso</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h2 style="color: #0a2a4a; border-bottom: 2px solid #0a2a4a; padding-bottom: 10px;">
            Respuesta a Solicitud de Ingreso
        </h2>
        
        <p>Respetado(a) <strong>{{ $solicitud->nombre_titular }}</strong>,</p>
        
        <p>El área de Almacén ha revisado su solicitud de ingreso con número de seguimiento <strong>{{ $solicitud->numero_seguimiento }}</strong>.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid {{ $solicitud->estado == 'Autorizada' ? '#28a745' : '#dc3545' }}; margin: 20px 0;">
            <p style="margin: 0;"><strong>Estado de la Solicitud:</strong> 
                <span style="color: {{ $solicitud->estado == 'Autorizada' ? '#28a745' : '#dc3545' }}; font-weight: bold; font-size: 1.1em;">
                    {{ strtoupper($solicitud->estado) }}
                </span>
            </p>
            
            @if($solicitud->estado == 'Autorizada')
                <p style="margin: 10px 0 0 0;"><strong>Fecha autorizada de ingreso:</strong> {{ \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d/m/Y') }}</p>
                <p style="margin: 5px 0 0 0;"><strong>Hora autorizada:</strong> {{ $solicitud->hora_ingreso }}</p>
            @endif
            
            @if($solicitud->observaciones_almacen)
                <p style="margin: 15px 0 0 0;"><strong>Observaciones del Almacén:</strong><br>
                {{ $solicitud->observaciones_almacen }}</p>
            @endif
        </div>
        
        <p>Puede consultar y descargar el comprobante en formato PDF haciendo clic en el siguiente botón:</p>
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('solicitud_ingreso.pdf', $solicitud->numero_seguimiento) }}" style="background-color: #0a2a4a; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">
                Descargar Comprobante PDF
            </a>
        </div>
        <p style="font-size: 0.9em; color: #666;">
            Atentamente,<br>
            <strong>Área de Almacén e Inventarios</strong><br>
            Dirección Seccional de Administración Judicial
        </p>
    </div>
</body>
</html>
