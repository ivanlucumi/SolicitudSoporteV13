@extends('layouts.correo')

@section('title', 'Respuesta a Solicitud de Soporte - SIRIS')

@section('content')

@php
    $consecutivo = $consecutivo ?? null;
    $categoria = $categoria ?? 'No disponible';
    $item = $item ?? 'No disponible';
    $descripcion = $descripcion ?? '';
    $estado = $estado ?? 'No disponible';
    $observaciones = $observaciones ?? '';
    $respuesta_tecnico = $respuesta_tecnico ?? '';
    $comentarios_notificacion = $comentarios_notificacion ?? '';
    $fecha_cerrado = $fecha_cerrado ?? null;
@endphp

<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background:#f4f6f8; padding:30px 0; font-family: Arial, Helvetica, sans-serif;">

<tr>
<td align="center">

<!-- CONTENEDOR PRINCIPAL -->
<table width="680" cellpadding="0" cellspacing="0" border="0"
       style="background:#ffffff; border-radius:10px;">

    <!-- HEADER -->
    <tr>
        <td style="background:#1e293b; padding:20px 25px; color:#ffffff;">
            <table width="100%">
                <tr>
                    <td style="font-size:14px; opacity:.85;">
                        Consejo Superior de la Judicatura - Rama Judicial
                    </td>
                    <td align="right" style="font-size:12px;">
                        {{ now()->format('d-m-Y') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:6px;">
                        <span style="font-size:20px; font-weight:bold;">
                            Respuesta a su Solicitud
                        </span><br>
                        <span style="font-size:13px; opacity:.8;">
                            Sistema SIRIS - SARA
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- CONTENIDO -->
    <tr>
        <td style="padding:25px;">

            <p style="font-size:14px; color:#111827;">
                <strong>Cordial saludo,</strong>
            </p>

            <p style="font-size:14px; color:#475569; line-height:1.6;">
                Su solicitud de soporte ha sido gestionada exitosamente.
                A continuación encontrará el resumen del caso registrado en el sistema.
            </p>

            <div style="height:1px; background:#e5e7eb; margin:20px 0;"></div>

            <!-- ENCUESTA -->
            @isset($consecutivo)
            <div style="margin-bottom:20px;">
                <a href="{{ route('mantenimiento.encuesta.mostrar', $consecutivo) }}"
                   style="display:inline-block;
                          padding:10px 16px;
                          background:#2563eb;
                          color:#ffffff;
                          text-decoration:none;
                          border-radius:6px;
                          font-size:13px;
                          font-weight:bold;">
                    Diligenciar Encuesta de Satisfacción
                </a>
            </div>
            @endisset

            <div style="height:1px; background:#e5e7eb; margin:20px 0;"></div>

            <!-- DETALLES -->
            <h3 style="margin:0 0 12px; font-size:16px; color:#111827;">
                Detalles de la Solicitud
            </h3>

            <table width="100%" cellpadding="8" cellspacing="0" border="0"
                   style="font-size:14px;">

                <tr style="background:#f8fafc;">
                    <td width="35%" style="color:#64748b;">Fecha de Cierre</td>
                    <td>
                        {{ $fecha_cerrado 
                            ? \Carbon\Carbon::parse($fecha_cerrado)->format('d-m-Y H:i') 
                            : 'No disponible' }}
                    </td>
                </tr>

                <tr>
                    <td style="color:#64748b;">Categoría</td>
                    <td>{{ $categoria }}</td>
                </tr>

                <tr style="background:#f8fafc;">
                    <td style="color:#64748b;">Ítem</td>
                    <td>{{ $item }}</td>
                </tr>

                <tr>
                    <td style="color:#64748b;">Estado</td>
                    <td>
                        <span style="background:#eef2ff;
                                     color:#3730a3;
                                     padding:4px 8px;
                                     border-radius:6px;
                                     font-size:12px;
                                     font-weight:bold;">
                            {{ $estado }}
                        </span>
                    </td>
                </tr>

                <tr style="background:#f8fafc;">
                    <td style="color:#64748b;">Descripción</td>
                    <td>{!! $descripcion ? nl2br(e($descripcion)) : 'No disponible' !!}</td>
                </tr>

                <tr>
                    <td style="color:#64748b;">Respuesta Técnico</td>
                    <td>{!! $respuesta_tecnico ? nl2br(e($respuesta_tecnico)) : 'No disponible' !!}</td>
                </tr>

                <tr style="background:#f8fafc;">
                    <td style="color:#64748b;">Observaciones</td>
                    <td>{!! $observaciones ? nl2br(e($observaciones)) : 'Sin observaciones' !!}</td>
                </tr>

                @if(!empty($comentarios_notificacion))
                <tr>
                    <td style="color:#64748b;">Comentarios de Notificación</td>
                    <td>{!! nl2br(e($comentarios_notificacion)) !!}</td>
                </tr>
                @endif

            </table>

            <div style="height:1px; background:#e5e7eb; margin:25px 0;"></div>

            <div style="padding:12px; background:#f1f5f9; border:1px solid #e2e8f0; font-size:13px; color:#334155;">
                Si la solución no resuelve completamente su requerimiento,
                puede registrar un nuevo caso detallando la situación.
            </div>

        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="background:#0b1220; padding:20px; color:#cbd5e1; font-size:12px;">
            <strong>Consejo Superior de la Judicatura - Rama Judicial</strong><br><br>
            Este mensaje fue generado automáticamente por el sistema SIRIS.
            No responda a esta dirección de correo electrónico.<br><br>
            <strong>Aviso de confidencialidad:</strong>
            Este mensaje contiene información institucional de carácter reservado.
        </td>
    </tr>

</table>

</td>
</tr>
</table>

@endsection