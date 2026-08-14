<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inspección Motocicleta</title>
    <style>
        @page { margin: 15mm 15mm; }
        body { font-family: Helvetica, Arial, sans-serif; font-size: 11px; margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; table-layout: fixed; word-wrap: break-word; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; vertical-align: middle; word-wrap: break-word; overflow-wrap: break-word; }
        .header-bg { background-color: #2e7d32; color: #fff; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .logos-container { width: 100%; margin-bottom: 5px; }
        .firma-img { max-width: 200px; max-height: 100px; }
    </style>
</head>
<body>
    <div class="logos-container">
        <table style="border:none;">
            <tr>
                <td style="border:none; text-align:left; width:33%; font-size: 10px;">
                    @php
                        $logoData = '';
                        $paths = [
                            public_path('img/logoLargo.png'),
                            base_path('public_html/img/logoLargo.png'),
                            base_path('public/img/logoLargo.png')
                        ];
                        foreach($paths as $path) {
                            if(file_exists($path)) {
                                $logoData = base64_encode(file_get_contents($path));
                                break;
                            }
                        }
                        if(empty($logoData)) {
                            $logoData = @base64_encode(@file_get_contents(asset('img/logoLargo.png')));
                        }
                    @endphp
                    @if($logoData)
                        <img src="data:image/png;base64,{{ $logoData }}" style="max-width: 180px; height: auto;">
                    @else
                        <strong>Rama Judicial</strong><br>Consejo Superior de la Judicatura<br>República de Colombia
                    @endif
                </td>
                <td style="border:none; text-align:center; width:33%; font-weight:bold; font-size:14px; color: #2e7d32;">
                    INSPECCIÓN PREOPERATIVA DE MOTOCICLETAS
                </td>
                <td style="border:none; text-align:right; width:33%; font-size: 10px;">
                    Consejo Superior de la Judicatura<br>Dirección Ejecutiva de Administración Judicial (DEAJ)
                </td>
            </tr>
        </table>
    </div>
    
    <table>
        <tr>
            <td class="text-bold" width="15%" style="text-align: center;">PROCESO</td>
            <td colspan="3" width="85%">Sistema de Gestión de Seguridad y Salud en el Trabajo</td>
        </tr>
        <tr>
            <td colspan="2" width="50%" class="header-bg">Información de la Motocicleta</td>
            <td colspan="2" width="50%" class="header-bg">Información de Conductor</td>
        </tr>
        <tr>
            <td class="text-bold" width="15%">Fecha:</td>
            <td width="35%">{{ $inspeccion->fecha->format('Y-m-d') }}</td>
            <td class="text-bold" width="25%">Servidor judicial / Conductor:</td>
            <td width="25%">{{ $inspeccion->conductor ? $inspeccion->conductor->name . ' ' . $inspeccion->conductor->lastname : $inspeccion->conductor_cedula }}</td>
        </tr>
        <tr>
            <td class="text-bold">Placa:</td>
            <td>{{ $inspeccion->placa }}</td>
            <td class="text-bold">Cédula:</td>
            <td>{{ $inspeccion->conductor_cedula }}</td>
        </tr>
        <tr>
            <td class="text-bold">Kilometraje:</td>
            <td>{{ number_format($inspeccion->kilometraje) }}</td>
            <td class="text-bold">Licencia de conducción:</td>
            <td>N/A</td>
        </tr>
    </table>

    <table>
        <tr>
            <th class="header-bg" width="5%">Nº</th>
            <th class="header-bg" width="45%">Condiciones de la motocicleta</th>
            <th class="header-bg text-center" width="8%">Cumple SI</th>
            <th class="header-bg text-center" width="8%">Cumple NO</th>
            <th class="header-bg" width="34%">Observaciones / Hallazgos</th>
        </tr>
        @php $num = 1; @endphp
        @foreach($detallesAgrupados as $grupo => $detalles)
            @if($grupo !== 'REPORTE DE LAS CONDICIONES DE SALUD DEL CONDUCTOR*' && $grupo !== 'ELEMENTOS DE PROTECCIÓN PERSONAL (EPP)')
                @foreach($detalles as $d)
                <tr>
                    <td class="text-center">{{ $num++ }}</td>
                    <td>{{ $d->nombre_item }}</td>
                    <td class="text-center">{{ $d->resultado == 'SI' ? 'X' : '' }}</td>
                    <td class="text-center">{{ $d->resultado == 'NO' ? 'X' : '' }}</td>
                    <td>{{ $d->observacion }}</td>
                </tr>
                @endforeach
            @endif
        @endforeach

        <tr>
            <td colspan="5" class="header-bg">Elementos de Protección Personal (EPP)</td>
        </tr>
        @foreach($detallesAgrupados as $grupo => $detalles)
            @if($grupo === 'ELEMENTOS DE PROTECCIÓN PERSONAL (EPP)')
                @foreach($detalles as $d)
                <tr>
                    <td class="text-center">{{ $num++ }}</td>
                    <td>{{ $d->nombre_item }}</td>
                    <td class="text-center">{{ $d->resultado == 'SI' ? 'X' : '' }}</td>
                    <td class="text-center">{{ $d->resultado == 'NO' ? 'X' : '' }}</td>
                    <td>{{ $d->observacion }}</td>
                </tr>
                @endforeach
            @endif
        @endforeach

        <tr>
            <td colspan="2" class="header-bg">Reporte de las Condiciones de Salud del Conductor</td>
            <td class="header-bg text-center">SI</td>
            <td class="header-bg text-center">NO</td>
            <td class="header-bg">Observaciones / Hallazgos</td>
        </tr>
        @foreach($detallesAgrupados as $grupo => $detalles)
            @if($grupo === 'REPORTE DE LAS CONDICIONES DE SALUD DEL CONDUCTOR*')
                @foreach($detalles as $d)
                <tr>
                    <td class="text-center">{{ $num++ }}</td>
                    <td>{{ $d->nombre_item }}</td>
                    <td class="text-center">{{ $d->resultado == 'SI' ? 'X' : '' }}</td>
                    <td class="text-center">{{ $d->resultado == 'NO' ? 'X' : '' }}</td>
                    <td>{{ $d->observacion }}</td>
                </tr>
                @endforeach
            @endif
        @endforeach
    </table>

    <table style="margin-top: 15px;">
        <tr>
            <td class="header-bg">Observaciones Generales</td>
        </tr>
        <tr>
            <td style="padding: 10px;">{{ $inspeccion->observaciones ? $inspeccion->observaciones : 'Sin observaciones generales.' }}</td>
        </tr>
    </table>

    <table style="border:none; margin-top: 15px;">
        <tr>
            <td style="border:none; width:60%;">
                <div style="margin-bottom: 5px;"><strong>Firma del Conductor:</strong></div>
                @if($inspeccion->firma_conductor)
                    <img src="{{ $inspeccion->firma_conductor }}" class="firma-img" style="border: 1px solid #ccc;">
                @else
                    <div style="height: 60px;"></div>
                    ____________________________________<br>
                    Firma
                @endif
            </td>
            <td style="border:none; width:40%; vertical-align: bottom; text-align: right; font-size: 10px;">
                <strong>Código:</strong> F-SGSST-109<br>
                <strong>Versión:</strong> 01<br>
                <strong>Fecha de aprobación:</strong> 
            </td>
        </tr>
    </table>
</body>
</html>
