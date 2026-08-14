@extends('layouts.correo')
@section('title', 'Reparto Asignado')

@section('content')

<div style="width:100%; background:#f4f6f8; padding:24px 0; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Arial,sans-serif; color:#0f172a; line-height:1.5;">
  <div style="max-width:680px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 6px 24px rgba(2,6,23,0.08);">

    <!-- Encabezado -->
    <div style="background:linear-gradient(135deg,#0ea5e9,#2563eb); padding:20px 24px; color:#ffffff;">
      <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
        <div>
          <div style="font-size:14px; opacity:.9;">
            Consejo Superior de la Judicatura - Rama Judicial
          </div>
          <h1 style="margin:4px 0 0; font-size:20px; font-weight:700;">
            Notificación de Solicitud de Vigilancia
          </h1>
        </div>
        <div style="background:rgba(255,255,255,0.18); padding:6px 10px; border-radius:999px; font-size:12px; font-weight:600; white-space:nowrap;">
          {{ now()->format('d-m-Y') }}
        </div>
      </div>
    </div>

    <!-- Aviso informativo -->
    <div style="padding:16px 24px; background:#ecfeff; border-bottom:1px solid #e2e8f0;">
      <div style="display:flex; align-items:flex-start; gap:10px;">
        <div style="width:10px; height:10px; background:#06b6d4; border-radius:50%; margin-top:6px;"></div>
        <p style="margin:0; font-size:14px; color:#0f172a;">
          Se ha recibido una <strong>solicitud de vigilancia</strong>. Una vez se complete el proceso de reparto,
          se notificará el despacho asignado por este mismo medio.<br>
          Agradecemos tu atención y quedamos a disposición para cualquier consulta adicional

        </p>
      </div>
    </div>

    <!-- Contenido -->
    <div style="padding:24px;">

      <h2 style="margin:0 0 12px; font-size:18px; color:#111827;">
        Detalles de la solicitud
      </h2>
      <p style="margin:0 0 20px; font-size:14px; color:#334155;">
        A continuación se relaciona la información suministrada en la solicitud de vigilancia.
      </p>

      <div style="height:1px; background:#e5e7eb; margin:16px 0;"></div>
      <div style="text-transform:uppercase; font-weight:700; color:#111827; font-size:14px; letter-spacing:.4px; margin-bottom:12px;">
        Información
      </div>

      <!-- Tabla -->
      <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate; border-spacing:0 10px;">
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Código Seguimiento</td>
          <td style="font-size:14px; color:#0f172a; font-weight:600;">
            {{ $seguimiento }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Nombre</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $nombre_apellido }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Cédula</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $cedula }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Dirección</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $direccion }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Correo Electrónico</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $correo }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Despacho Actual</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $despacho_encuentra }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Radicado</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $num_radicado }}
          </td>
        </tr>
      </table>

      <!-- Aviso -->
      <div style="margin-top:24px; padding:12px 14px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:10px; font-size:13px; color:#334155;">
        Este correo es informativo. Por favor, no responda a este mensaje, ya que no se procesarán respuestas por este medio.
      </div>

    </div>

    <!-- Pie -->
    <div style="padding:18px 24px; background:#0b1220; color:#e2e8f0;">
      <p style="margin:0 0 8px; font-size:12px;">
        Consejo Superior de la Judicatura - Rama Judicial. Enviado desde una dirección utilizada exclusivamente para notificaciones; no acepta respuestas.
      </p>
      <p style="margin:0; font-size:11px; color:#cbd5e1;">
        <strong>Aviso de confidencialidad:</strong> Este correo electrónico contiene información de la Rama Judicial de Colombia. 
        Si no es el destinatario, notifíquelo al remitente y elimine cualquier copia. 
        No está autorizado a usar su contenido y podría incurrir en responsabilidades legales (Ley 1273 de 2009 y demás aplicables).
        Antes de imprimir este correo, considere si es necesario; puede conservarlo en formato digital.
      </p>
    </div>

  </div>
</div>

@endsection
