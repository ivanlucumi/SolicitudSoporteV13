<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte Mensual</title>

<style>
    @page {
        size: A4;
        margin: 140px 40px 100px 40px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 18px;
        color: #2c3e50;
    }

    /* ============================= */
    /* HEADER */
    /* ============================= */
    header {
        position: fixed;
        top: -120px;
        left: 0;
        right: 0;
        height: 100px;
        text-align: center;
        border-bottom: 4px solid #1f3c88;
        padding-bottom: 8px;
    }

    .title {
        font-size: 30px;
        font-weight: bold;
        color: #1f3c88;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .subtitle {
        font-size: 20px;
        color: #555;
        margin-top: 4px;
    }

    /* ============================= */
    /* FOOTER */
    /* ============================= */
    footer {
        position: fixed;
        bottom: -80px;
        left: 0;
        right: 0;
        height: 60px;
        font-size: 9px;
        text-align: center;
        border-top: 2px solid #1f3c88;
        padding-top: 6px;
        color: #555;
    }

    

    .doc-id {
        position: absolute;
        top: -115px;
        right: 0;
        font-size: 14px;
        color: #777;
    }

    /* ============================= */
    /* TARJETAS INFORMACIÓN */
    /* ============================= */
    .info-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .info-table td {
        width: 33%;
        padding: 8px;
    }

    .info-card {
        border: 1px solid #d6dbe8;
        padding: 10px;
        border-radius: 6px;
        background-color: #f4f6fb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .label {
        font-size: 18px;
        font-weight: bold;
        color: #1f3c88;
        margin-bottom: 4px;
    }

    .value {
        font-size: 18px;
        color: #2c3e50;
    }

    /* ============================= */
    /* TABLA PRINCIPAL */
    /* ============================= */
    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }

    thead {
        display: table-header-group;
    }

    th {
        background-color: #1f3c88;
        color: #ffffff;
        font-size: 18px;
        border: 1px solid #163172;
        padding: 8px;
        text-align: left;
    }

    td {
        border: 1px solid #e2e6f0;
        padding: 8px 10px;
        vertical-align: top;
        word-wrap: break-word;
        overflow-wrap: break-word;
        line-height: 1.4;
    }
    
   
    tbody tr:nth-child(even) {
        background-color: #f8f9fd;
    }

    .col-numero {
        width: 2%;
        text-align: center;
        font-weight: bold;
        color: #1f3c88;
    }

    .col-fecha {
        width: 10%;
        font-weight: 500;
    }

    .col-plataforma {
        width: 10%;
        font-weight: 500;
    }

    .col-actividades {
        width: 78%;
        white-space: normal;
        text-align: justify;
    }

    tr {
        page-break-inside: avoid;
    }

    .total-row td {
        font-weight: bold;
        background-color: #e8edf7;
        border-top: 2px solid #1f3c88;
        font-size: 18px;
        color: #1f3c88;
    }

    /* ============================= */
    /* FIRMA */
    /* ============================= */
    .signature-area {
        margin-top: 60px;
        text-align: center;
    }

    .signature-line {
        margin: 40px auto 8px;
        width: 480px;
        border-top: 1px solid #1f3c88;
    }

    .signature-label {
        font-size: 18px;
        font-weight: bold;
        color: #1f3c88;
    }

</style>
</head>

<body>

<header>
    <div class="title">Reporte Mensual de Actividades</div>
    <div class="subtitle">Resumen detallado de actividades realizadas</div>
</header>

<footer>
    Documento generado automáticamente por Sistema de Registro de Requerimientos Informáticos - DISAJ CALI "SIRISCALI".<br>
    Cualquier modificación invalida este reporte. Versión {{ date('Ymd') }}
    
</footer>

<div class="doc-id">
    DOC-{{ strtoupper(Str::random(8)) }}-{{ date('Ymd') }}
</div>

<table class="info-table">
    <tr>
        <td>
            <div class="info-card">
                <div class="label">Nombre</div>
                <div class="value">{{ $userName }}</div>
            </div>
        </td>
        <td>
            <div class="info-card">
                <div class="label">Per&iacute;odo</div>
                <div class="value">{{ $monthName }}</div>
            </div>
        </td>
        <td>
            <div class="info-card">
                <div class="label">Fecha de generaci&oacute;n</div>
                <div class="value">{{ now()->format('d/m/Y H:i') }}</div>
            </div>
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th class="col-numero">#</th>
            <th class="col-fecha">Fecha</th>
            <th class="col-plataforma">Plataforma</th>
            <th class="col-actividades">Actividades Realizadas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
        <tr>
            <td class="col-numero">{{ $loop->iteration }}</td>
            <td class="col-fecha">{{ $activity->activity_date->format('d/m/Y') }}</td>
            <td class="col-plataforma">{{ $activity->plataforma }}</td>
            <td class="col-actividades">
                {!! nl2br(e($activity->description)) !!}
            </td>
        </tr>
        @endforeach

        <tr class="total-row">
            <td colspan="3">Total de requerimientos</td>
            <td>{{ $activities->count() }}</td>
        </tr>
    </tbody>
</table>

<div class="signature-area">
    <div class="signature-line"></div>
    <div class="signature-label">
        Firma {{ $userName }}
    </div>
</div>

</body>
</html>
