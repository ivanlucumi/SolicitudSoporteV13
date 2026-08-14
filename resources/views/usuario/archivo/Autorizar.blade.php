@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes Ingreso Archivo Judicial')
@section('cabecera', 'SOLICITUD DE INGRESO ARCHIVO JUDICIAL')

@section('content')

@push('scripts')
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

@endpush


<form enctype="multipart/form-data" action="{{ route('usuario.solicitud.ingreso.store') }}" method="POST">
    @csrf 
<div class="row">
    <div class="card-body">
    <p class="card-text"><h3 style="color:red"><strong><center>AUTORIZACION INGRESO DE PERSONAL EXTERNO ARCHIVO JUDICIAL.</center></strong></h3> </p>
     </div>
</div>


<div class="row">

<div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>FUNCIONARIO TITULAR</td>
                <td>PERSONA AUTORIZADA</td>
                <td>FECHA DE INGRESO</td>
                <td>HORARIO DE PERMANENCIA</td>
                <td>AUTORIZACION DE INGRESO</td>
                <td>EXONERACION DE RESPONSABILIDAD</td>
                <td>AUTORIZAR</td>
                </tr>
            </thead> 
            @if($solicitudes != null)
             @foreach($solicitudes as $solicitud)
             
             
                <tbody data-id="{!!$solicitud->id!!}">
                <tr >
                 <td>{{$solicitud->persona_que_autoriza}}</td>
                 <td>{{$solicitud->persona_que_autoriza}} {{$solicitud->cedula}}</td>
                 <td>{{$solicitud->fecha_ingreso}} a {{$solicitud->fecha_salida}}</td>
                 <td>{{$solicitud->horario_permanencia}}</td>
                 <td>
                    <a onClick="window.open('/IngresoArchivoJudicial/{{$solicitud->doc_autorizacion}}','popup', 'width=800px,height=600px')">DOC AUTORIZACION DE INGRESO</a><br>
                 </td>
                 <td>
                    <a onClick="window.open('/IngresoArchivoJudicial/{{$solicitud->doc_responsabilidad}}','popup', 'width=800px,height=600px')">DOC EXONERACION DE RESPONSABILIDAD</a><br>
                 </td>
                </tr>
                </tbody>
            @endforeach
          @endif 
           
        </table>
     </div>
</div>

@endsection



