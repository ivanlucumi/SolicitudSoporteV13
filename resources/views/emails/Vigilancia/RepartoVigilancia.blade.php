@extends('layouts.correo')
@section('title', 'Reparto Asignado')

@section('content')
@section('cabecera', 'NOTIFICACIÓN DE REPARTO – SOLICITUD DE VIGILANCIA')

<div style="width:100%; background:#f4f6f8; padding:24px 0; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Arial,sans-serif; color:#0f172a;">

  <div style="max-width:680px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 6px 24px rgba(2,6,23,0.08);">

    <!-- Encabezado -->
    <div style="background:linear-gradient(135deg,#0ea5e9,#2563eb); padding:20px 24px; color:#ffffff;">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <div style="font-size:13px; opacity:.9;">
            Consejo Superior de la Judicatura – Rama Judicial
          </div>
          <h1 style="margin:6px 0 0; font-size:20px; font-weight:700;">
            Reparto de Solicitud de Vigilancia
          </h1>
        </div>
        <div style="font-size:12px; background:rgba(255,255,255,.2); padding:6px 10px; border-radius:999px;">
          {{ now()->format('d-m-Y') }}
        </div>
      </div>
    </div>

    <!-- Mensaje principal -->
    <div style="padding:24px;">
      <p style="font-size:14px; color:#334155; text-align:justify;">
        Cordial saludo,
        <br><br>
        Le informamos que su <strong>solicitud de vigilancia</strong> ha sido procesada exitosamente y ya cuenta con un
        <strong>despacho asignado</strong>. En este correo encontrará la constancia correspondiente al reparto realizado.
      </p>

      <div style="height:1px; background:#e5e7eb; margin:20px 0;"></div>

      <div style="font-size:14px; font-weight:700; text-transform:uppercase; color:#111827; margin-bottom:10px;">
        Información de la solicitud
      </div>

      <!-- Tabla de información -->
      <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate; border-spacing:0 10px;">
        <tr>
          <td style="width:35%; font-size:13px; color:#64748b;">Código de seguimiento</td>
          <td style="font-size:14px; font-weight:600;">{{ $seguimiento }}</td>
        </tr>

        <tr>
          <td style="font-size:13px; color:#64748b;">Nombre</td>
          <td style="font-size:14px;">{{ $nombre_apellido }}</td>
        </tr>

        <tr>
          <td style="font-size:13px; color:#64748b;">Cédula</td>
          <td style="font-size:14px;">{{ $cedula }}</td>
        </tr>

        <tr>
          <td style="font-size:13px; color:#64748b;">Despacho donde se encuentra</td>
          <td style="font-size:14px;">{{ $despacho_encuentra }}</td>
        </tr>

        <tr>
          <td style="font-size:13px; color:#64748b;">Número de radicado</td>
          <td style="font-size:14px;">{{ $num_radicado }}</td>
        </tr>

        <tr>
          <td style="font-size:13px; color:#64748b;">Despacho asignado</td>
          <td style="font-size:14px; font-weight:600; color:#1d4ed8;">
            {{ $reparto_asignado_a }}
          </td>
        </tr>
        
        @isset($acta_reparto)
          @if ($acta_reparto)
            <tr>
              <td style="width:35%; font-size:13px; color:#64748b; vertical-align:top;">Acta Reparto</td>
              <td style="vertical-align:top;">
                <a href="{{ route('Vigilancia.descargar.documento', ['filename' => urlencode($acta_reparto)]) }}"
                   style="display:inline-block; padding:10px 14px; background:#2563eb; color:#ffffff; text-decoration:none; border-radius:8px; font-size:13px; font-weight:600;">
                  Descargar Acta Reparto
                </a>
              </td>
            </tr>
          @endif
        @endisset
        
      </table>

      <!-- Aviso -->
      <div style="margin-top:24px; padding:14px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:10px; font-size:13px; color:#334155;">
        Este correo es únicamente informativo. Por favor, no responda a este mensaje, ya que las respuestas no serán atendidas.
      </div>
    </div>

    <!-- Pie de página -->
    <div style="padding:18px 24px; background:#0b1220; color:#e2e8f0;">
      <p style="margin:0 0 8px; font-size:12px;">
        Consejo Superior de la Judicatura – Rama Judicial.
      </p>
      <p style="margin:0; font-size:11px; color:#cbd5e1;">
        <strong>Aviso de confidencialidad:</strong> Este correo contiene información de la Rama Judicial de Colombia. Si no es
        el destinatario, notifíquelo y elimine este mensaje. El uso no autorizado puede generar responsabilidades legales
        conforme a la Ley 1273 de 2009 y demás normas aplicables.
      </p>
    </div>

  </div>
</div>
@endsection
