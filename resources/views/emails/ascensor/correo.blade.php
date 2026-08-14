@extends('layouts.correo')
@section('title', 'Reporte de Incidente en Ascensor')

@section('content')
@section('cabecera', 'Reporte de Incidente en Ascensor')

<div class="email-container">
    <!-- Encabezado -->
    <div class="email-header">
        <p class="text-right">Generado: @php echo now()->format('d-m-Y H:i'); @endphp</p>
        <h2 class="email-title">Reporte de Incidente en Ascensor</h2>
        <p class="reference-code">Código de seguimiento: <strong>{{ $codigoAsignado ?? 'N/A' }}</strong></p>
    </div>

    <hr class="divider">

    <!-- Detalles del Incidente -->
    <div class="section-header">
        <h3>Información del Incidente</h3>
    </div>

    <table class="data-table">
        <tr>
            <th class="col-30">Fecha del Reporte:</th>
            <td>{{ \Carbon\Carbon::parse($fecha_reporte)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th class="col-30">Hora del Reporte:</th>
            <td>{{ $hora_reporte }}</td>
        </tr>
        <tr>
            <th class="col-30">Ascensor:</th>
            <td>{{ $ascensor }}</td>
        </tr>
        <tr>
            <th class="col-30">Tipo de Incidente:</th>
            <td>{{ ucfirst($tipo_incidente) }}</td>
        </tr>
         <tr>
            <th class="col-30">Hora del Incidente:</th>
            <td>{{$hora_incidente }}</td>
        </tr>
        
    </table>

    <!-- Descripción -->
    <div class="description-box">
        <h4>Descripción Detallada:</h4>
        <p>{{ $descripcion }}</p>
    </div>

    <hr class="divider">

    <!-- Información de Reporte -->
    <div class="section-header">
        <h3>Información del Reportante</h3>
    </div>

    <table class="data-table">
        <tr>
            <th class="col-30">Nombre:</th>
            <td>{{ $nombre_reportante }}</td>
        </tr>
        <tr>
            <th class="col-30">Operador Asignado:</th>
            <td>{{ $operador ?? 'Por asignar' }}</td>
        </tr>
    </table>

    <hr class="divider">


    <!-- Aviso de confidencialidad -->
    <div class="confidential-notice">
        <p style="text-align: justify;">
            &Eacute;ste correo  es solo informativo, agradecemos no responder debido a que su solicitud no será atendida <br>
           
           </p>
           <p style="text-align: justify;">
            Consejo Superior de la Judicatura - Rama Judicial Nota Importante:<br>  
           </p>
           <p style="text-align: justify;">
            Enviado desde una dirección de correo electrónico utilizado exclusivamente para notificación el cual no acepta respuestas.<br> 
           </p>
           <p style="text-align: justify;">
               <strong>AVISO DE CONFIDENCIALIDAD:</strong> Este correo electrónico contiene información de la Rama Judicial de Colombia. Si no es el destinatario de este correo y lo recibió por error comuníquelo de inmediato,
           respondiendo al remitente y eliminando cualquier copia que pueda tener del mismo. Si no es el destinatario, 
           no podrá usar su contenido, de hacerlo podría tener consecuencias legales como las contenidas en la Ley 1273 del 5 de enero de 2009 y todas las que le apliquen. Si es el destinatario,
           le corresponde mantener reserva en general sobre la información de este mensaje, sus documentos y/o archivos adjuntos, 
           a no ser que exista una autorización explícita. Antes de imprimir este correo, considere si es realmente necesario hacerlo, recuerde que puede guardarlo como un archivo digital.
        </p>
    </div>
</div>

<style>
    .email-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        max-width: 700px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }
    
    .email-header {
        margin-bottom: 25px;
        text-align: center;
    }
    
    .email-title {
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .reference-code {
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .divider {
        border: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #3498db, transparent);
        margin: 25px 0;
    }
    
    .section-header h3 {
        color: #3498db;
        margin: 15px 0;
        font-size: 18px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
        background-color: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .data-table th, .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ecf0f1;
        text-align: left;
    }
    
    .data-table th {
        background-color: #3498db;
        color: white;
        font-weight: normal;
    }
    
    .col-30 {
        width: 30%;
    }
    
    .description-box {
        background-color: white;
        padding: 15px;
        margin: 20px 0;
        border-left: 4px solid #3498db;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .description-box h4 {
        margin-top: 0;
        color: #3498db;
    }
    
    .status-pending {
        color: #e67e22;
        font-weight: bold;
    }
    
    .instructions {
        background-color: #e8f4fc;
        padding: 15px;
        border-radius: 5px;
        margin: 20px 0;
    }
    
    .instructions h4 {
        margin-top: 0;
        color: #2980b9;
    }
    
    .instructions ol {
        padding-left: 20px;
    }
    
    .confidential-notice {
        margin-top: 30px;
        padding: 15px;
        background-color: #f2f2f2;
        border-left: 4px solid #c0392b;
        font-size: 14px;
    }
    
    .confidential-notice h4 {
        margin-top: 0;
        color: #c0392b;
    }
    
    .text-right {
        text-align: right;
        color: #7f8c8d;
        font-size: 14px;
    }
</style>
@endsection