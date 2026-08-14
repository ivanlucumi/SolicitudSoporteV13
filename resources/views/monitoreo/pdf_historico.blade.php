<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Histórico de Ingresos</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #333;
        }
        .header {
            width: 100%;
            border-bottom: 2px solid #003f75;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            width: 180px;
        }
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #003f75;
            margin-top: -50px;
        }
        .info-box {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th {
            background-color: #003f75;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .data-table td {
            padding: 6px;
            border: 1px solid #ddd;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $logo }}" class="logo">
        <div class="title">REPORTE HISTÓRICO DE INGRESOS</div>
    </div>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td width="15%"><strong>Funcionario:</strong></td>
                <td>{{ $funcionario ? strtoupper($funcionario->nameE . ' ' . $funcionario->lastnameE) : 'N/A' }}</td>
                <td width="15%"><strong>Cédula:</strong></td>
                <td>{{ $funcionario ? $funcionario->cedulaE : 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Cargo:</strong></td>
                <td>{{ $funcionario ? strtoupper($funcionario->cargo_titular) : 'N/A' }}</td>
                <td><strong>Rango Fechas:</strong></td>
                <td>{{ $fecha_inicio ?? 'Inicio' }} - {{ $fecha_fin ?? 'Hoy' }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Nombre</th>
                <th>Juzgado / Despacho</th>
                <th>Fecha Ingreso</th>
                <th>Hora Ingreso</th>
                <th>Hora Salida</th>
                <th>Lugar/Portería</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $reg)
            <tr>
                <td>{{ $reg->placa ?? 'PEATÓN' }}</td>
                <td><small>{{ $reg->nombre }}</small></td>
                <td>
                    @if($reg->empleado)
                        <small>{{ $reg->empleado->cargo_titular ?? $reg->empleado->cargo }} - {{ $reg->empleado->dependencia_titular }}</small>
                    @else
                        <small>N/A</small>
                    @endif
                </td>
                <td>{{ $reg->fecha }}</td>
                <td>{{ $reg->hora_ingreso }}</td>
                <td>{{ $reg->hora_salida ?? 'SIN SALIDA' }}</td>
                <td>{{ $reg->porteria }} {{ $reg->edificio }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado por SIRIS CALI el {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
