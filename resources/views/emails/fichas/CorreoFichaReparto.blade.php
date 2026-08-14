@extends('layouts.correo')
@section('title', 'Soporte de Solicitud')

@section('content')

<div style="width:100%; background:#f4f6f8; padding:24px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, 'Helvetica Neue', 'Noto Sans', sans-serif; color:#0f172a; line-height:1.5;">
  <div style="max-width:680px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 6px 24px rgba(2,6,23,0.08);">

    <!-- Encabezado -->
    <div style="background:linear-gradient(135deg, #0ea5e9, #2563eb); padding:20px 24px; color:#ffffff;">
      <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
        <div>
          <div style="font-size:14px; opacity:.9;">Consejo Superior de la Judicatura - Rama Judicial</div>
          <h1 style="margin:4px 0 0; font-size:20px; font-weight:700;">{{ $tipo_solicitud }}</h1>
        </div>
        <div style="background:rgba(255,255,255,0.18); padding:6px 10px; border-radius:999px; font-size:12px; font-weight:600; white-space:nowrap;">
          {{ now()->format('d-m-Y') }}
        </div>
      </div>
    </div>

    <!-- Aviso de motivo (Juzgado de Turno) -->
    <div style="padding:16px 24px; background:#ecfeff; border-bottom:1px solid #e2e8f0;">
      <div style="display:flex; align-items:flex-start; gap:10px;">
        <div style="width:10px; height:10px; background:#06b6d4; border-radius:50%; margin-top:6px;"></div>
        <p style="margin:0; font-size:14px; color:#0f172a;">
          Remisión de Acta Reparto
        </p>
      </div>
    </div>

    <!-- Contenido principal -->
    <div style="padding:24px;">

      <h2 style="margin:0 0 12px; font-size:18px; color:#111827;">Datos Solicitud</h2>
      <p style="margin:0 0 20px; font-size:14px; color:#334155;">
        A continuación encontrará los detalles de su solicitud.
      </p>

      <div style="height:1px; background:#e5e7eb; margin:16px 0;"></div>
      <div style="text-transform:uppercase; font-weight:700; color:#111827; font-size:14px; letter-spacing:.4px; margin-bottom:8px;">
        Información
      </div>

      <div style="height:1px; background:#e5e7eb; margin:16px 0;"></div>
      <div style="text-transform:uppercase; font-weight:700; color:#111827; font-size:14px; letter-spacing:.4px; margin-bottom:12px;">
        Detalles de la Solicitud de Audiencias del Sistema Penal Acusatorio
      </div>

      <!-- Tabla de detalles -->
      <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate; border-spacing:0 10px;">
        @if ($anexos)
          <tr>
            <td style="width:35%; font-size:13px; color:#64748b; vertical-align:top;">Anexo</td>
            <td style="vertical-align:top;">
              <a href="{{ route('fichaPreliminar.descargar.anexo', ['filename' => urlencode($anexos)]) }}"
                 style="display:inline-block; padding:10px 14px; background:#2563eb; color:#ffffff; text-decoration:none; border-radius:8px; font-size:13px; font-weight:600;">
                Descargar Anexo
              </a>
            </td>
          </tr>
        @endif

        @isset($acta_reparto)
          @if ($acta_reparto)
            <tr>
              <td style="width:35%; font-size:13px; color:#64748b; vertical-align:top;">Acta Reparto</td>
              <td style="vertical-align:top;">
                <a href="{{ route('fichaPreliminar.descargar.acta', ['filename' => urlencode($acta_reparto)]) }}"
                   style="display:inline-block; padding:10px 14px; background:#2563eb; color:#ffffff; text-decoration:none; border-radius:8px; font-size:13px; font-weight:600;">
                  Descargar Acta Reparto
                </a>
              </td>
            </tr>
          @endif
        @endisset

        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Código Seguimiento</td>
          <td style="font-size:14px; color:#0f172a; font-weight:600;">{{ $seguimiento }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Radicación</td>
          <td style="font-size:14px; color:#0f172a;">{{ $numero_radicado_proceso }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Procesado</td>
          <td style="font-size:14px; color:#0f172a;">{{ $procesado }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Tipo Solicitud</td>
          <td style="font-size:14px; color:#0f172a;">{{ $tipo_solicitud }}</td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Quién Solicita</td>
          <td style="font-size:14px; color:#0f172a;">
            {{ $quien_solicita }} 〞 CC: {{ $cedula_quien_solicita }}
          </td>
        </tr>
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Fecha Remisión</td>
          <td style="font-size:14px; color:#0f172a;">{{ $fecha_solicitud }}</td>
        </tr>
      </table>

      <!-- Llamado a la acci車n informativo -->
      <div style="margin-top:24px; padding:12px 14px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:10px; font-size:13px; color:#334155;">
        Este correo es informativo. Por favor, no responda a este mensaje, ya que no se dará respuestas por este medio.
      </div>

    </div>

    <!-- Pie de p芍gina / Notas -->
    <div style="padding:18px 24px; background:#0b1220; color:#e2e8f0;">
      <p style="margin:0 0 8px; font-size:12px;">
        Consejo Superior de la Judicatura - Rama Judicial. Enviado desde una dirección utilizada exclusivamente para notificaciones; no acepta respuestas.
      </p>
      <p style="margin:0; font-size:11px; color:#cbd5e1;">
        <strong>Aviso de confidencialidad:</strong> Este correo electrónico contiene informaci車n de la Rama Judicial de Colombia. Si no es el destinatario, notifíquelo al remitente y elimine cualquier copia. No está autorizado a usar su contenido y podr赤a incurrir en responsabilidades legales (Ley 1273 de 2009 y dem芍s aplicables). Si es el destinatario, mantenga la reserva sobre la informaci車n, documentos y/o archivos adjuntos salvo autorizaci車n expresa. Antes de imprimir este correo, considere si es necesario; puede conservarlo en formato digital.
      </p>
    </div>

  </div>
</div>
@endsection