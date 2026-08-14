<!DOCTYPE html>
<html>
<head>
    <title>Solicitud de Soporte Creada</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #0056b3;">Nueva Solicitud de Servicio</h2>
        <p>Se ha registrado una nueva solicitud en el sistema.</p>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Número:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $solicitud->numero_solicitud }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Solicitante:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $solicitud->solicitante_nombre }} ({{ $solicitud->solicitante_identificacion }})</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Dependencia:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $solicitud->dependencia_nombre }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Tipo:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $solicitud->tipo_solicitud }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Fecha:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $solicitud->created_at->format('d/m/Y H:i A') }}</td>
            </tr>
        </table>
        
        <div style="margin-top: 20px; background-color: #f9f9f9; padding: 15px; border-left: 4px solid #0056b3;">
            <p style="margin: 0;"><strong>Descripción:</strong></p>
            <p style="margin-top: 5px;">{{ $solicitud->descripcion }}</p>
        </div>

        @if($solicitud->archivos()->count() > 0)
            <div style="margin-top: 20px;">
                <p><strong>Archivos Adjuntos ({{ $solicitud->archivos()->count() }}):</strong></p>
                <p style="font-size: 13px; color: #555;">Por motivos de seguridad y tamaño, los archivos no se adjuntan directamente en este correo. Puedes acceder a ellos usando el siguiente enlace seguro (si tienes sesión iniciada):</p>
                <a href="{{ url('/administrador/solicitudes/servicio/archivos/' . $solicitud->uuid) }}" style="display: inline-block; padding: 10px 15px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 4px;">Ver Archivos Adjuntos</a>
            </div>
        @endif
        
        <hr style="margin-top: 30px; border: 0; border-top: 1px solid #ddd;">
        <p style="font-size: 12px; color: #888; text-align: center;">Este es un mensaje automático del Sistema de Registro de Requerimientos Informáticos. Por favor no responda a este correo.</p>
    </div>
</body>
</html>
