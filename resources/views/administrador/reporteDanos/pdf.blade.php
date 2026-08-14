<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Daños - {{ $reporte->despacho }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #1a202c;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2d3748;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            border: 1px solid #cbd5e1;
            padding: 10px;
            text-align: left;
        }
        .info-table th {
            background-color: #f8fafc;
            width: 30%;
        }
        .section-title {
            background-color: #e2e8f0;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        .item-box {
            border: 1px solid #cbd5e1;
            padding: 10px;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .item-box p {
            margin: 5px 0;
        }
        .image-container {
            margin-top: 10px;
            text-align: center;
        }
        .image-container img {
            height: 450px; /* Altura fija para uniformidad y evitar desbordes */
            width: auto;
            max-width: 100%; /* Si es horizontal, se ajustará al ancho de la hoja */
            border: 1px solid #ddd;
            margin: 15px auto; /* Centrado automático */
            page-break-inside: avoid;
            display: block;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>REPORTE ESPECIAL DE FALLAS Y DAÑOS</h2>
        <p>Generado el: {{ date('d/m/Y H:i A') }}</p>
    </div>

    <table class="info-table">
        <tr>
            <th>Radicado #</th>
            <td>{{ str_pad($reporte->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <th>Despacho / Dependencia</th>
            <td><strong>{{ $reporte->juzgado }}</strong></td>
        </tr>
        <tr>
            <th>Código Juzgado</th>
            <td>{{ $reporte->codigo_juzgado ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Funcionario que Reporta</th>
            <td>{{ $reporte->nombre_empleado }} (C.C. {{ $reporte->identificacion_empleado ?? 'N/A' }})</td>
        </tr>
        <tr>
            <th>Fecha del Reporte</th>
            <td>{{ $reporte->created_at->format('d/m/Y h:i A') }}</td>
        </tr>
    </table>

    <!-- CONECTIVIDAD -->
    @if($reporte->obs_conectividad || !empty($reporte->evidencia_conectividad))
    <div class="section-title">1. CONECTIVIDAD E INTERNET</div>
    <div class="item-box">
        <p><strong>Observaciones:</strong><br> {{ $reporte->obs_conectividad ?? 'Sin observaciones' }}</p>
        
        @if(!empty($reporte->evidencia_conectividad))
            <div class="image-container">
                @foreach($reporte->evidencia_conectividad as $imgBase64)
                    @if($imgBase64)
                        <img src="{{ $imgBase64 }}" alt="Evidencia Conectividad">
                    @endif
                @endforeach
            </div>
        @else
            <p style="color:#777; font-size:12px;">Sin evidencia adjunta</p>
        @endif
    </div>
    @endif

    <!-- FUNCIÓN REUTILIZABLE PARA HARDWARE (COMPUTO, IMPRESORAS, ETC) -->
    @php
        $mostrarHardware = function($titulo, $datos, $evidencias) {
            if (empty($datos)) return;
            
            echo '<div class="section-title">' . $titulo . '</div>';
            
            // Si $datos es array (dinámico)
            if (is_array($datos)) {
                foreach ($datos as $index => $item) {
                    echo '<div class="item-box">';
                    echo '<p><strong>Marca:</strong> ' . ($item['marca'] ?? 'N/A') . ' | <strong>Placa:</strong> ' . ($item['placa'] ?? 'N/A') . '</p>';
                    echo '<p><strong>Observaciones:</strong><br> ' . ($item['observacion'] ?? 'N/A') . '</p>';
                    
                    if (isset($evidencias[$index]) && is_array($evidencias[$index])) {
                        echo '<div class="image-container">';
                        foreach ($evidencias[$index] as $imgBase64) {
                            if ($imgBase64) {
                                echo '<img src="' . $imgBase64 . '" alt="Evidencia">';
                            }
                        }
                        echo '</div>';
                    } else {
                        echo '<p style="color:#777; font-size:12px;">Sin evidencia adjunta</p>';
                    }
                    echo '</div>';
                }
            } else {
                // Fallback formato antiguo (string)
                echo '<div class="item-box">';
                echo '<p><strong>Observaciones:</strong><br> ' . $datos . '</p>';
                if (!empty($evidencias)) {
                     echo '<div class="image-container">';
                     foreach ($evidencias as $imgBase64) {
                         if (is_string($imgBase64) && $imgBase64) {
                             echo '<img src="' . $imgBase64 . '" alt="Evidencia">';
                         }
                     }
                     echo '</div>';
                } else {
                    echo '<p style="color:#777; font-size:12px;">Sin evidencia adjunta</p>';
                }
                echo '</div>';
            }
        };
    @endphp

    {{ $mostrarHardware('2. EQUIPOS DE CÓMPUTO', $reporte->obs_computo, $reporte->evidencia_computo) }}
    {{ $mostrarHardware('3. IMPRESORAS', $reporte->obs_impresoras, $reporte->evidencia_impresoras) }}
    {{ $mostrarHardware('4. ESCÁNER', $reporte->obs_escaner, $reporte->evidencia_escaner) }}
    {{ $mostrarHardware('5. TELEFONÍA IP', $reporte->obs_telefonia, $reporte->evidencia_telefonia) }}
    <!-- TELEVISORES Y SALAS -->
    {{ $mostrarHardware('7. TELEVISORES', $reporte->obs_televisor, $reporte->evidencia_televisor) }}
    {{ $mostrarHardware('8. EQUIPOS DE SALA DE AUDIENCIA', $reporte->obs_sala_audiencia, $reporte->evidencia_sala_audiencia) }}

</body>
</html>
