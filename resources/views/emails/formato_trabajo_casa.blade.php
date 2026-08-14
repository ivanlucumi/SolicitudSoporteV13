<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formato Elementos Trabajo en Casa</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        .header { background-color: #0d6efd; color: white; padding: 15px; text-align: center; }
        .content { padding: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Formulario Trabajo en Casa</h2>
            <p>Acuerdo XXX-00022</p>
        </div>
        <div class="content">
            <p>Cordial saludo,</p>
            
            <div style="background-color: #d9edf7; color: #31708f; border-left: 4px solid #31708f; padding: 15px; margin-bottom: 20px; font-size: 14px; text-align: justify;">
                <strong>En atención a lo dispuesto en el artículo 7 del Acuerdo PCSJA26-12564</strong>, solicitamos comedidamente diligenciar la encuesta de caracterización tecnológica, con el fin de recopilar información sobre los equipos, sistemas de información, software, conectividad y demás herramientas disponibles para el desarrollo de sus funciones en la modalidad de trabajo en casa, información que será cruzada con las autorizaciones de teletrabajo otorgadas.
                <br><br>
                La información será utilizada para identificar las condiciones y requerimientos tecnológicos de los servidores, de acuerdo con los criterios institucionales y los recursos disponibles para tal efecto. El diligenciamiento de la encuesta no implica la asignación o suministro automático de los elementos reportados, toda vez que esto se efectuara de acuerdo con los recursos disponibles para tal efecto.
            </div>

            <p>A continuación se presenta el resumen de la información registrada para Trabajo en Casa:</p>
            
            <h3>Datos del Empleado</h3>
            <ul>
                <li><strong>Cédula:</strong> {{ $encuesta->cedula }}</li>
                <li><strong>Correo:</strong> {{ $encuesta->correo }}</li>
                <li><strong>Despacho:</strong> {{ $encuesta->dependencia ?? 'N/A' }}</li>
                <li><strong>Ciudad:</strong> {{ $encuesta->ciudad ?? 'N/A' }}</li>
            </ul>

            <h3>Conectividad</h3>
            <ul>
                @if($encuesta->tiene_vpn)
                    <li><strong>¿Cuenta con VPN?:</strong> {{ $encuesta->tiene_vpn }}</li>
                @endif
                @if($encuesta->requiere_vpn)
                    <li><strong>¿Requiere VPN?:</strong> {{ $encuesta->requiere_vpn }}</li>
                @endif
            </ul>

            @if($encuesta->requiere_vpn == 'SI')
            <div style="background-color: #e7f3fe; border-left: 4px solid #0d6efd; padding: 15px; margin: 20px 0;">
                <h4 style="margin-top: 0; color: #0d6efd;">Formatos Adicionales Requeridos</h4>
                <p style="margin-bottom: 0;">Dado que usted indicó que requiere una VPN, es indispensable descargar y diligenciar el siguiente documento para iniciar su solicitud:</p>
                <p style="margin-bottom: 0; margin-top: 10px;">
                    <a href="https://www.disajcali.gov.co/img/1formatos/FormulariosolicitudVPN.docx" style="font-weight: bold; color: #0d6efd; text-decoration: none;">⬇️ Descargar Formulario Solicitud VPN</a>
                </p>
            </div>
            @endif

            <h3>Inventario de Elementos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Elemento</th>
                        <th>Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Computador</td>
                        <td>{{ $encuesta->computador }}</td>
                    </tr>
                    <tr>
                        <td>Impresora</td>
                        <td>{{ $encuesta->impresora }}</td>
                    </tr>
                    <tr>
                        <td>Escáner</td>
                        <td>{{ $encuesta->escaner }}</td>
                    </tr>
                    <tr>
                        <td>Conectividad (Internet)</td>
                        <td>{{ $encuesta->conectividad }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Silla Ergonómica</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $encuesta->silla }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Escritorio</td>
                        <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; text-align: center;">{{ $encuesta->escritorio }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><strong>Aplicaciones Usadas</strong></td>
                        <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; text-align: center; color: #0d6efd;">
                            {{ $encuesta->aplicaciones ? $encuesta->aplicaciones : 'Ninguna seleccionada' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p style="margin-top: 30px; font-size: 0.9em; color: #777; border-top: 1px solid #eee; padding-top: 10px;">
                <strong>NOTA INFORMATIVA:</strong><br>
                Este es un mensaje generado automáticamente por el sistema SIRIS y tiene un carácter estrictamente informativo. 
                Las respuestas y solicitudes relacionadas con este tema se reciben y tramitan únicamente por los medios oficiales establecidos. 
                <strong>En caso de dar respuesta a este correo, no será atendida.</strong>
            </p>
        </div>
    </div>
</body>
</html>
