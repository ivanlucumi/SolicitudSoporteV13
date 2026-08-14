@extends('layouts.correo')
@section('title', 'Reparto Asignado')

@section('content')
@section('cabecera', 'Reparto Asignado!')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  
  <p style="text-align: justify;">
      <h3>Reparto Asignado.</h3><br>
      Cordial saludo, 
      Me permito remitir acción de tutela recibida mediante aplicativo. <br>
      Nota: La oficina de reparto reenvía los archivos tal cual llegan por aplicativo, si el despacho requiere documentos adicionales o legibles para iniciar el trámite, deben ser solicitados directamente al interesado. 
  </p>
  
 
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Informaci&oacute;n</b></div><br>
                   
  <hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles del Reparto</b></div><br>
  
   
                   
  <table>
    <tr>
      <th style="width: 35%;">C&Oacute;DIGO SEGUIMIENTO</th>
      <th>{{$seguimiento}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">ESPECIALIDAD</th>
      <th>{{$nombre_especialidad}}</th>
    </tr>
    <tr>
      <td><b>NOMBRE GRUPO:</b></td>
      <td>{{$nombre_grupo}}</td>
    </tr>
    <tr>
      <td><b>ACCIONATE (S):</b></td>
      <td>{{$demandante}}</td>
    </tr>
    <tr>
      <td><b>ACCIONADO (S):</b></td>
      <td>{{$demandado}}</td>
    </tr>
    <tr>
      <td><b>APODERADO:</b></td>
      <td>{{$cedulaA}} {{$nombreA}} {{$tarjetaP}}</td>
    </tr>
    <tr>
      <td><b>CUADERNO (S):</b></td>
      <td>{{$cuaderno}}</td>
    </tr>
    <tr>
      <td><b>FOLIOS:</b></td>
      <td>{{$folios}}</td>
    </tr>
    <tr>
      <td><b>URL ANEXOS:</b></td>
      <td>{{$url_anexos}}</td>
    </tr> 
    <tr>
      <td><b>OBSERVACIONES:</b></td>
      <td>{{$observaciones}}</td>
    </tr>  
  </table>
  <br>  

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