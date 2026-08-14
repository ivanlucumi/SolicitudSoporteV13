@extends('layouts.correo')
@section('title', 'Soporte PDF')

@section('content')
@section('cabecera', 'ACTA DE INSTALACION TODO EN UNO')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  <p>
      <h2>Confirmaci&oacute;n De Env&iacute;o Documento PDF</h2> <br>
  </p>
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Informaci&oacute;n</b></div><br>
                   
  <hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la Instalacion</b></div><br>
  
  <p>
      ACTA DE INSTALACION TODO EN UNO ORDEN DE COMPRA No. 122359 DE 2023
  </p>
  
  <table>
    <tr>
      <th style="width: 35%;">FECHA INSTALACION</th>
      <th>{{$fecha_instalacion}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">MAGISTRADO O JUEZ</th>
      <th>{{$nombre_contacto}}</th>
    </tr>
    <tr>
      <td><b>MARCA:</b></td>
      <td>{{$marca}} </td>
    </tr>
    <tr>
      <td><b>MODELO:</b></td>
      <td>{{$modelo}} </td>
    </tr>
    <tr>
      <th style="width: 35%;">PLACA EQUIPO</th>
      <th>{{$placa_equipo}}</th>
    </tr>
    <tr>
      <td><b>SERIAL EQUIPO:</b></td>
      <td>{{$serial_equipo}} </td>
    </tr>
    
    <tr>
      <th style="width: 35%;">PLACA TECLADO</th>
      <th>{{$placa_teclado}}</th>
    </tr>
    <tr>
      <td><b>SERIAL TECLADO:</b></td>
      <td>{{$serial_teclado}} </td>
    </tr>
    
    <tr>
      <th style="width: 35%;">PLACA MOUSE</th>
      <th>{{$placa_mouse}}</th>
    </tr>
    <tr>
      <td><b>SERIAL MOUSE:</b></td>
      <td>{{$serial_mouse}} </td>
    </tr>
    
    <tr>
      <td><b>OBSERVACIONES:</b></td>
      <td>{{$observaciones}} </td>
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