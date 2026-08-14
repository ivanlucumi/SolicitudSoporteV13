@extends('layouts.correo')
@section('title', 'Soporte PDF')

@section('content')
@section('cabecera', 'Ficha de Remision ')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  <p>
      <h2>Ficha de Remisi&oacute;n</h2> <br>
  </p>
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Informaci&oacute;n</b></div><br>
                   
  <hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la Remisi&oacute;n</b></div><br>
  
  <p>
      Se adjunta Ficha de Remisi&oacute;n
  </p>
  
  <table>
    <tr>
      <th style="width: 35%;">DESPACHO QUE REMITE</th>
      <th>{{$despacho_remite}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">MOTIVO DE REMISI&OacuteN</th>
      <th>{{$m_remision}}</th>
    </tr>
    <tr>
      <th style="width: 35%;">ESPECIALIDAD</th>
      <th>{{$especialidad}}</th>
    </tr>
    <tr>
      <td><b>RADICACION:</b></td>
      <td>{{$numero_radicado_proceso}} </td>
    </tr>
    <tr>
      <td><b>GRUPO DE REPARTO:</b></td>
      <td>{{$gr_reparto}} </td>
    </tr>
    <tr>
      <td><b>DEMANDANTE:</b></td>
      <td>{{$demandante}} </td>
    </tr>
    <tr>
      <td><b>DEMANDADO:</b></td>
      <td>{{$demandado}} </td>
    </tr>
     <tr>
      <td><b>CONOCIMINETO PREVIO:</b></td>
      <td>{{$concocimiento_pre}} </td>
    </tr>
     <tr>
      <td><b>URL:</b></td>
      <td>{{$url_expediente}} </td>
    </tr>
  </table>
  <br>  
  <hr>
      <strong>
        Remisi&oacute;n desde OFICINA JUDICIAL CALI por: {{$usuario_quien_realiza}}
      </strong>
  <hr>
   
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