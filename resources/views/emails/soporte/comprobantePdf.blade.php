@extends('layouts.correo')
@section('title', 'Soporte PDF')

@section('content')
@section('cabecera', 'Soporte de Atencion a Usuario ')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  <p>
      <h2>Confirmaci&oacute;n De Env&iacute;o Documento PDF</h2> <br>
  </p>
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Informaci&oacute;n</b></div><br>
                   
  <hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la solicitud</b></div><br>
  
  <p>
      Se Remite Soporte de atenci&oacute;n a Usuario
  </p>
  
  <table>
    <tr>
      <th style="width: 35%;">NUMERO DE CASO</th>
      <th>{{$num_caso}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">FECHA SOLICITUD</th>
      <th>{{$fecha_solicitud}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">FUNCIONARIO</th>
      <th>{{$nombre}} {{$apellido}}</th>
    </tr>
    <tr>
      <td><b>SECCIONAL:</b></td>
      <td>{{$seccional}} </td>
    </tr>
    <tr>
      <td><b>DESPACHO:</b></td>
      <td>{{$despacho}} </td>
    </tr>
    <tr>
      <td><b>FALLA:</b></td>
      <td>{{$falla_reportada}} </td>
    </tr>
    <tr>
      <td><b>TECNICO:</b></td>
      <td>{{$nombre_tecnico}} </td>
    </tr>
  </table>
  <br>  
   
  <br>  

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