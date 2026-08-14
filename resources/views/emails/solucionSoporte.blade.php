@extends('layouts.correo')
@section('title', 'Solución de Soporte')

@section('content')

<div style="width:100%; background-color:#f4f6f8; padding:24px 0; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color:#0f172a; line-height:1.5;">
  <div style="max-width:680px; margin:0 auto; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 6px 24px rgba(2,6,23,0.08);">

    <!-- ================== ENCABEZADO ================== -->
    <div style="background-color:#002147; padding:20px 24px;">
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <div style="font-size:14px; color:#e5e7eb;">
              Consejo Superior de la Judicatura - Rama Judicial
            </div>
            <div style="margin-top:4px; font-size:20px; font-weight:700; color:#ffffff;">
              Respuesta de Soporte SIRIS
            </div>
          </td>
          <td align="right">
            <div style="background-color:#ffffff; color:#002147; padding:6px 12px; border-radius:999px; font-size:12px; font-weight:700;">
              {{ now()->format('d-m-Y') }}
            </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- ================== ALERTA INFORMATIVA ================== -->
    <div style="padding:16px 24px; border-bottom:1px solid #fed7aa;">
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
         <!-- ALERTA SUPERIOR -->
        <tr>
            <td style="padding:18px 28px 10px;">
                <table width="100%" cellpadding="14" cellspacing="0"
                       style="background:#fff7ed; border-left:6px solid #f97316; border-radius:10px;">
                    <tr>
                        <td style="font-size:13px; color:#9a3412; line-height:1.6;">
                            <strong>⚠ Aviso Importante</strong><br>
                            Este correo electrónico es únicamente informativo.  
                            <strong>No se dará respuesta</strong> a este mensaje, ya que esta cuenta no se encuentra habilitada
                            para la atención de solicitudes.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
      </table>
    </div>

    <!-- ================== CONTENIDO ================== -->
    <div style="padding:24px;">

      <p style="margin:0 0 8px; font-size:15px;">Señores,</p>

      <p style="margin:0; font-size:16px; font-weight:700;">
        {{ $despacho }}
      </p>
      <p style="margin:2px 0 20px; font-size:14px; color:#475569;">
        {{ $email_despacho }}
      </p>

      <h2 style="margin:0 0 8px; font-size:18px; color:#111827;">
        Detalles de la solicitud de soporte
      </h2>

      <div style="height:1px; background-color:#e5e7eb; margin:16px 0;"></div>

      <!-- Tabla de detalles -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate; border-spacing:0 10px;">
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Despacho</td>
          <td style="font-size:14px; font-weight:600;">{{ $despacho }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Funcionario</td>
          <td style="font-size:14px;">{{ $funcionario }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Tipo de solicitud</td>
          <td style="font-size:14px;">{{ $tipo_solicitud }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Respuesta</td>
          <td style="font-size:14px;">
            {!! $respuesta !!}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Estado</td>
          <td style="font-size:14px; font-weight:700; color:#16a34a;">
            {{ $estado }}
          </td>
        </tr>
      </table>

      <!-- Nota -->
      <div style="margin-top:24px; padding:14px; background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; font-size:13px; color:#334155;">
        En caso de que la respuesta no solucione el soporte solicitado, deberá registrar un nuevo requerimiento indicando las correcciones necesarias.
      </div>

      <!-- CTA -->
      <div style="margin-top:24px;">
        <a href="https://disajcali.gov.co/login" target="_blank"
           style="display:inline-block; padding:12px 18px; background-color:#002147; color:#ffffff; text-decoration:none; border-radius:8px; font-size:14px; font-weight:600;">
          Iniciar sesión en SIRIS
        </a>
      </div>

    </div>

    <!-- ================== PIE LEGAL ================== -->
    <div style="padding:18px 24px; background-color:#0b1220; color:#e2e8f0;">
      <p style="margin:0 0 8px; font-size:12px;">
        Consejo Superior de la Judicatura - Rama Judicial. Enviado desde una dirección utilizada exclusivamente para notificaciones.
      </p>
      <p style="margin:0; font-size:11px; color:#cbd5e1;">
        <strong>Aviso de confidencialidad:</strong> Este correo electrónico contiene información de la Rama Judicial de Colombia.
        Si no es el destinatario, notifíquelo al remitente y elimine cualquier copia. El uso no autorizado puede acarrear
        consecuencias legales conforme a la Ley 1273 de 2009 y demás normas aplicables.
      </p>
    </div>

  </div>
</div>

@endsection
