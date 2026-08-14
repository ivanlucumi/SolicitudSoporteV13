@extends('layouts.correo')
@section('title', 'Reparto Asignado')
@section('content')
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    .custom-table th, .custom-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .custom-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
</style>
@section('cabecera', 'Respuesta a su Solicitud!')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  
  <p style="text-align: justify;">
      Cordial saludo, <br>
      Señores:  {{ $nombreDespacho }}, se relaciona a continuación los elementos de papeler&iacute;a y suministros entregados.
       </p>
  
 <hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la Solicitud de Elementos Disponibles para Entrega</b></div><br>
  
  <table class="custom-table">
    <thead>
        <tr>
            <th>ELEMENTO</th>
            <th>CANTIDAD SOLICITADA</th>
            <th>OBSERVACIONES</th>
            <th>CANTIDAD ENTREGADA</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($elementos as $elemento)
        <tr>
            <td>{{ $elemento['elemento'] ?? 'N/A' }}</td>
            <td>{{ $elemento['cantidad'] ?? 'N/A' }}</td>
            <td>{{ $elemento['observaciones'] ?? 'N/A' }}</td>
            <td>{{ $elemento['cantidad_entregada'] ?? 'N/A' }}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
<div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Observaciones</b></div><br>
<hr>
<p>
    <justify>
        {{ $observaciones }}
    </justify>
</p>
 
  <br> 
  
  <p>
      
    </p><br>  
    
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
 
        
@endsection
