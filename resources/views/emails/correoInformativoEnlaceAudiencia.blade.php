@extends('layouts.correo')
@section('title', 'Agendamiento Solicitud Audiencia')

@section('content')
@section('cabecera', 'Agendamiento de Solicitud Audiencia Virtual')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  <p ><span class="izquierda"><h2>Se&ntilde;ores</h2></span></p>
  <p class="izquierda"><strong > <h3>{{$nombre_entidad}}</h3></strong></p>
  <p class="izquierda"><strong ><h4>{{$email}}</h4></strong></p><br>
  
  
  
  <p>
      <h3>La Audiencia virtual ya ha sido agendada.</h3>
  </p>
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Agendamiento de la solicitud</b></div><br>
                   
  <table>
    <tr>
      <th style="width: 35%;">Radicaci&oacute;n</th>
      <th>{{$numero_radicado_proceso}}</th>
    </tr>
    <tr>
      <td><b>Fecha Audiencia</b></td>
      <td>{{$fecha_prgramada}}</td>
    </tr>
    <tr>
      <td><b>Declarante o Indiciado:</b></td>
      <td>{{$declarante_indiciado}}</td>
    </tr>
    <tr>
        <td><b>Fecha y hora de la solicitud:</b></td>
        <td>{{$fecha_solicitud}} </td>
      </tr>  
    <tr>
        <td><b>Enlace Audiencia:</b></td>
        <td>{{$enlace}} </td>
      </tr> 
     <tr>
        <td><b>Id Audiencia:</b></td>
        <td>{{$id_conexion}} </td>
      </tr> 
  </table>
  <br>  

  <p>
    <h2>
        Inicias Sesi&oacute;n: <a href="https://disajcali.gov.co/login" target="_blank" style="display: block;
        width: 115px;height: 30px;background: rgb(0, 125, 110);padding: 5px;text-align: center;border-radius: 3px;
        color: white; font-weight: bold;">Login</a>
    </h2>
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