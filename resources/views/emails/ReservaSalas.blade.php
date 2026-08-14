@extends('layouts.correo')
@section('title', 'Nueva Solicitud - Sala de Audiencia')

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
                Solicitud Sala de Audiencia
            </h2>
            <p style="margin:8px 0 0; font-size:13px; opacity:.9;">
                Rama Judicial – Consejo Seccional de la Judicatura
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
                        <strong>ℹ Aviso Informativo</strong><br>
                        Este correo es únicamente informativo.  
                        <strong>No se dará respuesta</strong> a este mensaje, ya que esta cuenta no se encuentra habilitada
                        para la atención de solicitudes.
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
                <span style="font-size:17px; font-weight:bold;">DESPACHO</span><br>
                <span style="font-size:15px; color:#334155;">{{ $despacho }}</span>
            </p>
        </td>
    </tr>

    <!-- MENSAJE PRINCIPAL -->
    <tr>
        <td style="padding:10px 28px 18px;">
            <h3 style="margin:0; font-size:17px; color:#1e293b;">
                ✔ La reserva de Sala de Audiencia se ha realizado con éxito.
            </h3>
        </td>
    </tr>

    <!-- DETALLES -->
    <tr>
        <td style="padding:0 28px 26px;">
            <h4 style="margin:0 0 12px; font-size:16px; text-transform:uppercase; color:#002147;">
                Detalles de la Reserva
            </h4>

            <table width="100%" cellpadding="10" cellspacing="0"
                   style="border-collapse:collapse; font-size:14px;">
                <tr style="background:#f1f5f9;">
                    <td width="35%"><strong>Radicación</strong></td>
                    <td>{{ $radicacion }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha y Hora</strong></td>
                    <td>{{ $fecha_inicio }} {{ $hora_inicio }} a {{ $fecha_fin }} {{ $hora_fin }}</td>
                </tr>
                <tr style="background:#f1f5f9;">
                    <td><strong>Demandante o Fiscalía</strong></td>
                    <td>{{ $nombre_fiscal }}</td>
                </tr>
                <tr>
                    <td><strong>Demandado o Indiciado</strong></td>
                    <td>{{ $nombre_indiciado }}</td>
                </tr>
                <tr style="background:#f1f5f9;">
                    <td><strong>Sala</strong></td>
                    <td>{{ $sala_nombre }}</td>
                </tr>
            </table>
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
                El uso no autorizado puede generar consecuencias legales conforme a la Ley 1273 de 2009 y demás normas aplicables.
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
