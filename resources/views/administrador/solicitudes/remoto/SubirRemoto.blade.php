@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Servicios')
@section('cabecera', 'Subir Solicitud Teletrabajo')
@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">


     
     <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>IDENTIFICACI&Oacute;N</td>
                <td>NOMBRE</td>
                <td>TIPO SOLICITUD</td>
                <td>DOCUEMENTOS</td>
                <td>ESTADO</td>
                <td>OBSERVACIONES R.H</td>
                <td>CONCEPTO ARL</td>
                <td style="width:12em">ACCI&Oacute;N</td>
                </tr>
            </thead> 
            @if($solicitudes != null)
             @foreach($solicitudes as $radicado)
             
             
                <tbody data-id="{!!$radicado->id!!}">
                <tr >
                 <td>{{$radicado->funcionario_identificacion}}</td>
                 <td>{{$radicado->funcionario_nombre}} {{$radicado->funcionario_apellido}}</td>
                 <td>{{$radicado->tipo_solicitud}}</td>
                 <td>
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->solicitud}}','popup', 'width=800px,height=600px')">SOLICITUD</a><br>
                    
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->anuencia}}','popup', 'width=800px,height=600px')">ANUENCIA</a><br>
                    
                    
                    @if($radicado->lista != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->lista}}','popup', 'width=800px,height=600px')">LISTA ARL</a>  <br> 
                    @endif
                    
                    @if($radicado->documento_concepto != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->documento_concepto}}','popup', 'width=800px,height=600px')">CONCEPTO ARL</a>  <br>
                    @endif
                    @if($radicado->formalizacion != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->formalizacion}}','popup', 'width=800px,height=600px')">FORMALIZACION</a> <br> 
                    @endif
                     @if($radicado->documento_revocado != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->documento_revocado}}','popup', 'width=800px,height=600px')">REVOCADO</a> <br>  
                    @endif
                    @if($radicado->desistimiento != null)
                    <a onClick="window.open('/SoportesRemoto/{{$radicado->desistimiento}}','popup', 'width=800px,height=600px')">DESISTIMIENTO</a> <br>  
                    @endif
                 </td>
                 <td>{{$radicado->estado}}</td>
                 <td>{{$radicado->concepto_talento_humano}}</td>
                 <td>{{$radicado->fecha_concepto}}<br>
                 {{$radicado->viabilidad}}<br>
                 {{$radicado->concepto_arl}}</td>
                  <td style="width:12em">
                     <!--a href="" data-target="#modal-solicitud-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-primary btn-sm" title="Subir Solicitud">Solicitud</button></a>
                     <a href="" data-target="#modal-anuencia-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-warning btn-sm" title="Subir Anuencia">Anuencia</button></a>
                     <a href="" data-target="#modal-formalizacion-{{$radicado->id}}" data-toggle="modal"><button class="btn btn-success btn-sm" title="Subir Formalizacion">Formalizacion</button></a-->
                     @if($radicado->desistimiento == null && $radicado->estado != "APROBADO" )
                     <a  class="btn btn-warning  active desistimiento-banner btn-sm " id="{{ $radicado->id }}"
                                    data-toggle="modal" href="#modal-desistimiento" data-id="{{$radicado->id}}"
                                    data-expediente="{{$radicado->funcionario_identificacion}}"
                                    data-nombre="{{$radicado->funcionario_nombre}} {{$radicado->funcionario_apellido}}"
                                    data-target="#myModal" title="SUBIR DESISTIMIENTO" > <i class="fa fa-exchange  trasladar"> DESISTIMIENTO</i>
                     </a>
                     @endif
                      
                 </td>
                 
                </tr>
                </tbody>
            @endforeach
          @endif 
        </table>
     </div>

       <!-- @include('administrador.solicitudes.remoto.bannerSolicitud')
        @include('administrador.solicitudes.remoto.bannerAnuencia')
        @include('administrador.solicitudes.remoto.bannerFormalizacion')-->
        
       @include('administrador.solicitudes.remoto.bannerDesistimiento')
        
        
   
  <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterSubirRemoto.js"></script> 
  
  <!-- Llamar a los complementos javascript-->

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Solicitud al Grupo Soporte",    //Nombre del archivo 
});

</script>
<script>
$(document).ready(function () {
    $('.desistimiento-banner').click(function () {
        // Obtener los valores de los atributos data del bot贸n data-nombre
        var id = $(this).data('id');
        var expediente = $(this).data('expediente');
        var nombre = $(this).data('nombre');

        // Asignar los valores a los elementos del modal innerHTML = name
      
        
        document.getElementById("expediente").innerHTML=expediente;
        document.getElementById("nombre").innerHTML=nombre;
        $('#id').val(id);
        // Abrir el modal
        $('#desistimiento-banner').modal('show');
    });
});
</script>
  
   

@endsection