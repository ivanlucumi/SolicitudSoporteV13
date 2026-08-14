@extends('layouts.correo')
@section('title', 'Nueva Solicitud - Audiencia Virtual')

@section('content')

<div style="width:100%; background:#f4f6f8; padding:40px 0; font-family:Arial, Helvetica, sans-serif; color:#0f172a;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<!-- CONTENEDOR -->
<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff; border-radius:16px; box-shadow:0 8px 30px rgba(15,23,42,0.12); overflow:hidden;">

    <!-- ENCABEZADO -->
    <tr>
        <td style="background:#002147; color:#ffffff; padding:26px 28px;">
            <h2 style="margin:0; font-size:22px; font-weight:bold;">
                Solicitud de Audiencia Virtual
            </h2>
            <p style="margin:8px 0 0; font-size:13px; opacity:.9;">
                Rama Judicial – Consejo Superior de la Judicatura
            </p>
        </td>
    </tr>

    <!-- FECHA -->
    <tr>
        <td style="padding:14px 28px 0; font-size:13px; color:#475569; text-align:right;">
            Fecha: {{ date('d-m-Y') }}
        </td>
    </tr>

    <!-- ALERTA INFORMATIVA -->
    <tr>
        <td style="padding:16px 28px 10px;">
            <table width="100%" cellpadding="14" cellspacing="0"
                   style="background:#eff6ff; border-left:6px solid #2563eb; border-radius:10px;">
                <tr>
                    <td style="font-size:13px; color:#1e3a8a; line-height:1.6;">
                        <strong>ℹ Aviso Importante</strong><br>
                        Este correo es únicamente informativo.  
                        <strong>No se dará respuesta</strong> a este mensaje, ya que no es un canal habilitado para atención.
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- DESTINATARIO -->
    <tr>
        <td style="padding:18px 28px 10px;">
            <p style="margin:0; font-size:15px;">
                <strong>Señores</strong><br>
                <span style="font-size:17px; font-weight:bold;">{{ $nombre_entidad }}</span><br>
                <span style="font-size:14px; color:#334155;">{{ $email }}</span>
            </p>
        </td>
    </tr>

    <!-- MENSAJE PRINCIPAL -->
    <tr>
        <td style="padding:10px 28px 18px;">
            <h3 style="margin:0; font-size:17px; color:#1e293b;">
                ✔ La solicitud de audiencia virtual se ha realizado con éxito.
            </h3>
        </td>
    </tr>

    <!-- DETALLES -->
    <tr>
        <td style="padding:0 28px 26px;">
            <h4 style="margin:0 0 12px; font-size:16px; text-transform:uppercase; color:#002147;">
                Detalles de la Solicitud
            </h4>

            <table width="100%" cellpadding="10" cellspacing="0"
                   style="border-collapse:collapse; font-size:14px;">
                <tr style="background:#f1f5f9;">
                    <td width="35%"><strong>Radicación</strong></td>
                    <td>{{ $numero_radicado_proceso }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha de Audiencia</strong></td>
                    <td>{{ $fecha_prgramada }}</td>
                </tr>
                <tr style="background:#f1f5f9;">
                    <td><strong>Declarante o Indiciado</strong></td>
                    <td>{{ $declarante_indiciado }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha y hora de la solicitud</strong></td>
                    <td>{{ $fecha_solicitud }}</td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- BOTÓN -->
    <tr>
        <td style="padding:0 28px 30px; text-align:center;">
            <a href="https://disajcali.gov.co/login" target="_blank"
               style="display:inline-block; background:#2563eb; color:#ffffff;
                      padding:12px 22px; border-radius:8px; font-size:14px;
                      font-weight:bold; text-decoration:none;">
                Iniciar Sesión
            </a>
        </td>
    </tr>

    <!-- PIE -->
    <tr>
        <td style="background:#0b1220; padding:20px 26px; color:#e2e8f0;">
            <p style="margin:0 0 10px; font-size:12px;">
                Consejo Superior de la Judicatura – Rama Judicial de Colombia
            </p>
            <p style="margin:0; font-size:11px; color:#cbd5e1; line-height:1.6;">
                <strong>Aviso de confidencialidad:</strong> Este correo electrónico contiene información de la Rama Judicial
                de Colombia. Si usted no es el destinatario, notifíquelo y elimine cualquier copia.
                El uso no autorizado puede generar responsabilidades legales conforme a la Ley 1273 de 2009 y demás normas aplicables.
            </p>
        </td>
    </tr>

</table>
<!-- FIN CONTENEDOR -->

</td>
</tr>
</table>

</div>
@endsection
