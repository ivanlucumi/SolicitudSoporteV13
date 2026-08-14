@extends('layouts.correo')
@section('title', 'remoto')

@section('content')
@section('cabecera', 'Informacion de Registro Teletrabajo')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>

  
  
  
  
  <p>
      <h2>Confirmaci&oacute;n De Env&iacute;o Documentos Teletrabajo</h2> <br>
  </p>
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Informacion</b></div><br>
                   
  <hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la solicitud</b></div><br>
  
  <p>
      Se ha registrado solicitud de Teletrabajo, queda en espera de concepto ARL.
      Las novedades se ir&aacute;n reportando por este medio pero, debe tener en cuenta que el proceso se realiza a traves de SIRIS con las opciones habilitadas
  </p>
  
  <table>
    <tr>
      <th style="width: 35%;">IDENTIFICACION</th>
      <th>{{$funcionario_identificacion}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">NOMBRE</th>
      <th>{{$funcionario_nombre}} {{$funcionario_apellido}}</th>
    </tr>
    <tr>
      <td><b>ESTADO:</b></td>
      <td>{{$estado}} </td>
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