@extends('layouts.correo')
@section('title', 'Solicitud de Restablecimiento de Contraseña')

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
              Restablecimiento de Contraseña
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
    <div style="padding:16px 24px; background-color:#fff7ed; border-bottom:1px solid #fed7aa;">
      <p style="margin:0; font-size:14px; font-weight:700; color:#7c2d12;">
        Correo únicamente informativo
      </p>
      <p style="margin:4px 0 0; font-size:13px; color:#9a3412;">
        Este mensaje no recibe respuestas. Cualquier correo enviado a esta dirección
        <strong>no será atendido ni procesado</strong>.
      </p>
    </div>

    <!-- ================== CONTENIDO ================== -->
    <div style="padding:24px;">

      <p style="margin:0 0 14px; font-size:15px;">
        Reciban ustedes un cordial y respetuoso saludo.
      </p>

      <p style="margin:0 0 18px; font-size:14px; color:#334155;">
        En atención a su requerimiento, me permito remitir el usuario y la contraseña temporal
        para acceder a la plataforma. Esta contraseña deberá ser modificada una vez se inicie sesión,
        con el fin de garantizar la seguridad de la información.
      </p>

      <h2 style="margin:0 0 12px; font-size:18px; color:#111827;">
        Datos de acceso al sistema
      </h2>

      <!-- Caja de credenciales -->
      <div style="padding:16px; background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; margin-bottom:18px;">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td style="width:35%; font-size:13px; color:#64748b;">Usuario</td>
            <td style="font-size:14px; font-weight:700; color:#0f172a;">
              {{ $email }}
            </td>
          </tr>
          <tr>
            <td style="width:35%; font-size:13px; color:#64748b; padding-top:10px;">
              Contraseña temporal
            </td>
            <td style="font-size:14px; font-weight:700; color:#b91c1c; padding-top:10px;">
              123456
            </td>
          </tr>
        </table>
      </div>

      <!-- Advertencia de seguridad -->
      <div style="padding:12px 14px; background-color:#ecfeff; border:1px solid #bae6fd; border-radius:10px; font-size:13px; color:#0f172a;">
        Por razones de seguridad, esta contraseña es temporal y debe ser cambiada inmediatamente después de iniciar sesión.
      </div>

      <!-- CTA -->
      <div style="margin-top:24px;">
        <a href="https://disajcali.gov.co/login" target="_blank"
           style="display:inline-block; padding:12px 20px; background-color:#002147; color:#ffffff; text-decoration:none; border-radius:8px; font-size:14px; font-weight:600;">
          Iniciar sesión en la plataforma
        </a>
      </div>

      <p style="margin-top:24px; font-size:14px; color:#334155;">
        Quedamos atentos ante cualquier duda o aclaración.<br>
        <strong>Feliz día.</strong>
      </p>

    </div>

    <!-- ================== PIE LEGAL ================== -->
    <div style="padding:18px 24px; background-color:#0b1220; color:#e2e8f0;">
      <p style="margin:0 0 8px; font-size:12px;">
        Consejo Superior de la Judicatura - Rama Judicial. Enviado desde una dirección utilizada exclusivamente para notificaciones.
      </p>
      <p style="margin:0; font-size:11px; color:#cbd5e1;">
        <strong>Aviso de confidencialidad:</strong> Este correo electrónico contiene información de la Rama Judicial de Colombia.
        Si no es el destinatario, notifíquelo al remitente y elimine cualquier copia. El uso no autorizado puede acarrear
        consecuencias legales conforme a la Ley 1273 de 2009 y demás normas aplicables. Antes de imprimir este correo,
        considere si es necesario; puede conservarlo en formato digital.
      </p>
    </div>

  </div>
</div>

@endsection
