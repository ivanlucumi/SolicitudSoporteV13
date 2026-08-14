@extends('layouts.correo')

@section('title', 'Registro de Incidente - SIRIS')
@section('cabecera', 'Registro de Incidente')

@section('content')

@php
    $nombre_usuario = $nombre_usuario ?? 'Usuario';
    $consecutivo = $consecutivo ?? 'N/A';
    $categoria = $categoria ?? 'No disponible';
    $item = $item ?? 'No disponible';
    $descripcion = $descripcion ?? '';
    $estado = $estado ?? 'En proceso';
@endphp

<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background-color:#f4f6f9; padding:40px 0; font-family: Arial, Helvetica, sans-serif;">

<tr>
<td align="center">

<!-- CARD PRINCIPAL -->
<table width="600" cellpadding="0" cellspacing="0" border="0"
       style="background:#ffffff;
              border-radius:12px;
              box-shadow:0 4px 15px rgba(0,0,0,0.06);
              overflow:hidden;">

    <!-- HEADER -->
    <tr>
        <td style="background:linear-gradient(90deg,#0f766e,#0d9488);
                   padding:22px;
                   text-align:center;
                   color:white;">
            <h2 style="margin:0; font-weight:600;">
                Registro de Incidente Exitoso
            </h2>
            <p style="margin:6px 0 0 0; font-size:13px; opacity:0.9;">
                Sistema SIRIS
            </p>
        </td>
    </tr>

    <!-- BODY -->
    <tr>
        <td style="padding:30px;">

            <p style="text-align:right; font-size:13px; color:#777;">
                Fecha: {{ now()->format('d-m-Y') }}
            </p>

            <p style="font-size:15px; color:#333;">
                <strong>Señor(a):</strong>
            </p>

            <p style="font-size:16px; margin-top:-5px;">
                <strong>{{ $nombre_usuario }}</strong>
            </p>

            <p style="font-size:14px; color:#555; line-height:1.6;">
                El registro de su incidente se realizó correctamente en nuestro sistema.
                A continuación podrá visualizar el resumen del caso:
            </p>

            <!-- BADGE CONSEcutivo -->
            <div style="background:#eef6f5;
                        border-left:4px solid #0d9488;
                        padding:12px 15px;
                        margin:20px 0;
                        font-size:14px;">
                <strong>Ticket No:</strong> {{ $consecutivo }}
            </div>

            <div style="height:1px; background:#eeeeee; margin:25px 0;"></div>

            <h3 style="margin-top:0; color:#333;">Detalles de la Solicitud</h3>

            <table width="100%" cellpadding="8" cellspacing="0" border="0"
                   style="font-size:14px; color:#444;">

                <tr style="background:#fafafa;">
                    <td width="35%" style="font-weight:bold;">Categoría</td>
                    <td>{{ $categoria }}</td>
                </tr>

                <tr>
                    <td style="font-weight:bold;">Ítem</td>
                    <td>{{ $item }}</td>
                </tr>

                <tr style="background:#fafafa;">
                    <td style="font-weight:bold;">Estado</td>
                    <td>
                        <span style="background:#e6f4ea;
                                     color:#137333;
                                     padding:4px 8px;
                                     border-radius:6px;
                                     font-size:12px;">
                            {{ $estado }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td style="font-weight:bold;">Descripción</td>
                    <td>{!! $descripcion ? nl2br(e($descripcion)) : 'No disponible' !!}</td>
                </tr>

            </table>

            <div style="height:1px; background:#eeeeee; margin:30px 0;"></div>

            <p style="font-size:14px; color:#555;">
                Puede consultar el estado actualizado de su solicitud ingresando al sistema:
            </p>

            <div style="text-align:center; margin:25px 0;">
                <a href="https://disajcali.gov.co/login" target="_blank"
                   style="background:#0d9488;
                          color:#ffffff;
                          padding:12px 30px;
                          text-decoration:none;
                          border-radius:8px;
                          font-size:14px;
                          font-weight:bold;
                          display:inline-block;">
                    Iniciar Sesión
                </a>
            </div>

        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="background:#f8f9fa; padding:20px; font-size:12px; color:#777; line-height:1.6;">
            <strong>Consejo Superior de la Judicatura - Rama Judicial</strong><br><br>
            Este mensaje fue generado automáticamente por el sistema SIRIS.
            No responder a esta dirección de correo.<br><br>
            <strong>AVISO DE CONFIDENCIALIDAD:</strong>
            Este mensaje contiene información confidencial y/o privilegiada.
            Si usted no es el destinatario, elimínelo e informe al remitente.
        </td>
    </tr>

</table>

</td>
</tr>
</table>

@endsection