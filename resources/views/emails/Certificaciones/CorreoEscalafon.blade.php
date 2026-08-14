@extends('layouts.correo')
@section('title', 'Notificación - Sistema de Información SIRIS')

@section('content')

<div style="width:100%; background:#f4f6f8; padding:40px 0; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, 'Helvetica Neue', sans-serif; color:#0f172a;">

  <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:16px; box-shadow:0 8px 30px rgba(15,23,42,0.12); overflow:hidden;">

    <!-- Encabezado -->
    <div style="background:#0f172a; color:#ffffff; padding:24px;">
      <h2 style="margin:0; font-size:22px; font-weight:700;">Notificación del Sistema SIRIS CALI</h2>
      <p style="margin:4px 0 0; font-size:14px; opacity:.85;">Rama Judicial – Consejo Seccional de la Judicatura del Valle</p>
    </div>

    <!-- Contenido -->
    <div style="padding:30px 28px;">

      <p style="font-size:16px; margin:0 0 16px;">
        Cordial saludo,
      </p>

      <p style="font-size:15px; margin:0 0 18px; color:#334155;">
        Se ha realizado el envío de su consulta de Escalafon y, conforme a su solicitud, se remite el enlace correspondiente para su descarga:
      </p>

      <div style="padding:14px 16px; background:#f1f5f9; border-radius:10px; margin-bottom:24px; color:#0f172a; font-weight:600; font-size:15px;">
          Señor(a):<br>
        {{ $empleado['nameE'] }} {{ $empleado['lastnameE'] }}
      </div>

      <p style="font-size:15px; margin:0 0 18px; color:#334155;">
        Puede visualizar la información completa en el siguiente enlace el cual tiene una vigencia de 72 horas:
      </p>

      <a href="{{ $url_consulta }}"
         style="display:inline-block; padding:12px 22px; background:#2563eb; color:white; text-decoration:none; font-weight:600; border-radius:8px; font-size:15px; transition:all .25s;">
         Descargar Certificado
      </a>

      <p style="margin-top:26px; font-size:13px; color:#64748b;">
        Si llega a presentarse alguna novedad o inconsistencia en la certificación, le solicitamos remitir la información al correo: ssadmvalle@cendoj.ramajudicial.gov.co, donde será atendida por el equipo responsable.
      </p>

    </div>

     <!-- Llamado a la acción informativo -->
      <div style="margin-top:24px; padding:12px 14px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:10px; font-size:13px; color:#334155;">
        Este correo es informativo. Por favor, no responda a este mensaje, ya que no se procesarán respuestas por este medio.
      </div>

    </div>
    
    <hr>

    <!-- Pie de página / Notas -->
    <div style="padding:18px 24px; background:#0b1220; color:#e2e8f0;">
      <p style="margin:0 0 8px; font-size:12px;">
        Consejo Superior de la Judicatura - Rama Judicial. Enviado desde una dirección utilizada exclusivamente para notificaciones; no acepta respuestas.
      </p>
      <p style="margin:0; font-size:11px; color:#cbd5e1;">
        <strong>Aviso de confidencialidad:</strong> Este correo electrónico contiene información de la Rama Judicial de Colombia. Si no es el destinatario, notifíquelo al remitente y elimine cualquier copia. No está autorizado a usar su contenido y podría incurrir en responsabilidades legales (Ley 1273 de 2009 y demás aplicables). Si es el destinatario, mantenga la reserva sobre la información, documentos y/o archivos adjuntos salvo autorización expresa. Antes de imprimir este correo, considere si es necesario; puede conservarlo en formato digital.
      </p>
    </div>

  </div>
</div>

@endsection
