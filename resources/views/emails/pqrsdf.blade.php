@extends('layouts.correo')
@section('title', 'Notificación PQRSDF - Sistema de Información SIRIS')

@section('content')

<div style="width:100%; background:#f4f6f8; padding:40px 0; font-family:Arial, Helvetica, sans-serif; color:#0f172a;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<!-- CONTENEDOR PRINCIPAL -->
<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff; border-radius:16px; box-shadow:0 8px 30px rgba(15,23,42,0.12); overflow:hidden;">

    <!-- ENCABEZADO -->
    <tr>
        <td style="background:#002147; color:#ffffff; padding:26px 28px;">
            <h2 style="margin:0; font-size:22px; font-weight:bold; letter-spacing:.3px;">
                Notificación PQRSDF – Sistema SIRIS CALI
            </h2>
            <p style="margin:8px 0 0; font-size:13px; opacity:.9;">
                Rama Judicial – Consejo Seccional de la Judicatura del Valle del Cauca
            </p>
        </td>
    </tr>

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

    <!-- TITULO -->
    <tr>
        <td style="padding:18px 28px 10px;">
            <h3 style="margin:0; font-size:18px; color:#1e293b;">
                📬 Nueva Solicitud PQRSDF Recibida
            </h3>
        </td>
    </tr>

    <!-- DATOS DEL SOLICITANTE -->
    <tr>
        <td style="padding:0 28px 22px;">
            <table width="100%" cellpadding="10" cellspacing="0"
                   style="border-collapse:collapse; font-size:14px;">
                <tr style="background:#f1f5f9;">
                    <td width="35%"><strong>Tipo de Solicitud</strong></td>
                    <td>{{ $data['tipo'] }}</td>
                </tr>
                <tr>
                    <td><strong>Nombre Completo</strong></td>
                    <td>{{ $data['nombres'] }}</td>
                </tr>
                <tr style="background:#f1f5f9;">
                    <td><strong>Documento</strong></td>
                    <td>{{ $data['tipo_documento'] }} - {{ $data['numero_documento'] }}</td>
                </tr>
                <tr>
                    <td><strong>Correo Electrónico</strong></td>
                    <td>{{ $data['correo'] }}</td>
                </tr>
                <tr style="background:#f1f5f9;">
                    <td><strong>Teléfono</strong></td>
                    <td>{{ $data['telefono'] ?? 'No registra' }}</td>
                </tr>
                <tr>
                    <td><strong>Dirección</strong></td>
                    <td>{{ $data['direccion'] ?? 'No registra' }}</td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- ASUNTO -->
    <tr>
        <td style="padding:0 28px 14px;">
            <table width="100%" cellpadding="12" cellspacing="0"
                   style="border:1px solid #e2e8f0; border-radius:10px;">
                <tr style="background:#f8fafc;">
                    <td style="font-size:14px;">
                        <strong>Asunto</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px;">
                        {{ $data['asunto'] }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- MENSAJE -->
    <tr>
        <td style="padding:0 28px 26px;">
            <table width="100%" cellpadding="12" cellspacing="0"
                   style="border:1px solid #e2e8f0; border-radius:10px;">
                <tr style="background:#f8fafc;">
                    <td style="font-size:14px;">
                        <strong>Descripción de la Solicitud</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px; line-height:1.6;">
                        {{ $data['mensaje'] }}
                    </td>
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
