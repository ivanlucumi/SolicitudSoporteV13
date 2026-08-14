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

<div class="row ">
    <div class="col-xs-12 col-sm-12 form-group ">
    <label for="nRadicacion">FUNCIONARIO TITULAR:</label>
    
    <input class="form-control @error('funcionario_titular') is-invalid @enderror" min="1" placeholder="Funcionario Titular del Despacho" type="text" name="funcionario_titular" id="funcionario_titular" value="{{ old('funcionario_titular') }}">
@error('funcionario_titular')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-sm-4">
		<label for="persona_que_autoriza">PERSONA AUTORIZADA:</label><br>
		<input placeholder="Nombre Persona Autorizada" class="form-control @error('persona_que_autoriza') is-invalid @enderror" type="text" name="persona_que_autoriza" id="persona_que_autoriza" value="{{ old('persona_que_autoriza') }}">
@error('persona_que_autoriza')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>
	<div class="col-xs-12 col-md-3 form-group ">
       <label for="cedula"> CEDULA DE CIUDADANIA:</label><br>
		<input placeholder="Numero de Identificacion" class="form-control @error('cedula') is-invalid @enderror" min="1" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-3 form-group ">
       <label for="eps"> EPS:</label><br>
		<input placeholder="Registe Eps" class="form-control @error('eps') is-invalid @enderror" type="text" name="eps" id="eps" value="{{ old('eps') }}">
@error('eps')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-2 form-group ">
       <label for="arl"> ARL:</label><br>
		<input placeholder="Registre Arl" class="form-control @error('arl') is-invalid @enderror" type="text" name="arl" id="arl" value="{{ old('arl') }}">
@error('arl')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-2 form-group ">
       <label for="arl"> FECHA DE INGRESO DESDE:</label><br>
		<input placeholder="Desde" class="form-control @error('fecha_ingreso') is-invalid @enderror" type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{ old('fecha_ingreso') }}">
@error('fecha_ingreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
     <div class="col-xs-12 col-md-2 form-group ">
       <label for="arl"> FECHA DE INGRESO HASTA:</label><br>
		<input placeholder="Hasta" class="form-control @error('fecha_salida') is-invalid @enderror" type="date" name="fecha_salida" id="fecha_salida" value="{{ old('fecha_salida') }}">
@error('fecha_salida')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-2 form-group ">
       <label for="arl">HORARIO DE PERMANENCIA:</label><br>
		<input placeholder="Hortarios de Permanencia" class="form-control @error('horario_permanencia') is-invalid @enderror" type="text" name="horario_permanencia" id="horario_permanencia" value="{{ old('horario_permanencia') }}">
@error('horario_permanencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
     <div class="col-xs-12 col-md-4 form-group ">
       <label for="arl">NOMBRE DEL EMPLEADO DE LA RAMA JUDICIAL RESPONSABLE :</label><br>
		<input placeholder="Empleado Responsable" class="form-control @error('empleado_responsable') is-invalid @enderror" type="text" name="empleado_responsable" id="empleado_responsable" value="{{ old('empleado_responsable') }}">
@error('empleado_responsable')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-2 form-group ">
       <label for="arl">CARGO:</label><br>
		<input placeholder="Cargo" class="form-control @error('cargo') is-invalid @enderror" type="text" name="cargo" id="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-6 form-group ">
       <label for="contacto_emergencia">CONTACTO DE EMERGENCIA:</label><br>
		<input placeholder="Nombre de Contacto de Emergencia" class="form-control @error('contacto_emergencia') is-invalid @enderror" type="text" name="contacto_emergencia" id="contacto_emergencia" value="{{ old('contacto_emergencia') }}">
@error('contacto_emergencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 col-md-6 form-group ">
       <label for="telefono_emergencia">TELEFONO CONTACTO DE EMERGENCIA:</label><br>
		<input placeholder="Telefono Contacto de Emergencia" class="form-control @error('telefono_emergencia') is-invalid @enderror" type="text" name="telefono_emergencia" id="telefono_emergencia" value="{{ old('telefono_emergencia') }}">
@error('telefono_emergencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    
     <div class="col-xs-12 form-group ">
       <label for="actividad_realiza">ACTIVIDAD QUE SE REALIZA:</label><br>
		<textarea placeholder="Describa las actividades a realizar" class="form-control @error('actividad_realiza') is-invalid @enderror" name="actividad_realiza" id="actividad_realiza">{{ old('actividad_realiza') }}</textarea>
@error('actividad_realiza')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    <div class="col-xs-12 form-group ">
        <p>
          <strong><h3> ADJUNTE DOCUMENTOS </h3></strong> 
        </p>
    </div>
    <!--div class="col-xs-6 form-group ">
       <label for="doc_autorizacion">AUTORIZACION DE INGRESO:</label><br>
		<input type="file" name="doc_autorizacion" id="doc_autorizacion" class="@error('doc_autorizacion') is-invalid @enderror">
@error('doc_autorizacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div-->
    <div class="col-xs-6 form-group ">
       <label for="doc_responsabilidad">EXONERACION DE RESPONSABILIDAD:</label><br>
		<input type="file" name="doc_responsabilidad" id="doc_responsabilidad" class="@error('doc_responsabilidad') is-invalid @enderror">
@error('doc_responsabilidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
    </div>
    					
    </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-4"></div>
    
   
    
    <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">SOLICITAR AUTORIZACION</button>
        </form> 
    </div>
   
    
    <div class="col-xs-12 col-sm-4"></div>                
</div>
 <br>
 <hr>


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
                <td>ACCION</td>
                </tr>
            </thead> 
            @if($solicitudes != null)
             @foreach($solicitudes as $solicitud)
             
             
                <tbody data-id="{!!$solicitud->id!!}">
                <tr >
                 <td>{{$solicitud->funcionario_titular}}</td>
                 <td>{{$solicitud->persona_que_autoriza}} {{$solicitud->cedula}}</td>
                 <td>{{$solicitud->fecha_ingreso}} a {{$solicitud->fecha_salida}}</td>
                 <td>{{$solicitud->horario_permanencia}}</td>
                 <td>
                    <a onClick="window.open('/IngresoArchivoJudicial/{{$solicitud->doc_autorizacion}}','popup', 'width=800px,height=600px')">DOC AUTORIZACION DE INGRESO</a><br>
                 </td>
                 <td>
                    <a onClick="window.open('/IngresoArchivoJudicial/{{$solicitud->doc_responsabilidad}}','popup', 'width=800px,height=600px')">DOC EXONERACION DE RESPONSABILIDAD</a><br>
                 </td>
                 <td>
                     @if(empty($solicitud->firma_titular_despacho))
                     <a  class="btn btn-warning  active firma-despacho btn-sm " id="{{ $solicitud->id }}"
                                     data-id="{{$solicitud->id}}"
                                    data-nombre="{{$solicitud->persona_que_autoriza}}"
                                    data-target="#FirmaDespacho" title="FIRMA AUTORIZACION" > <i class="fa fa-pencil-square-o  trasladar"> FIRMA TITULAR DESPACHO</i>
                     </a>
                     @else
                     <button>EN ESPERA DE AUTORIZACION</button>
                     @endif
                     
                 </td>
                </tr>
                </tbody>
            @endforeach
          @endif 
           
        </table>
     </div>
</div>
@include('usuario.archivo.ModalFirmaDespacho')

<script src="/js/jquery.js"></script>

<script>
$(document).ready(function () {
    $('.firma-despacho').click(function () {
        // Obtener los valores de los atributos data del bot贸n data-nombre
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');

        // Asignar los valores a los elementos del modal innerHTML = name
      
        document.getElementById("nombre").innerHTML=nombre;
        $('#id').val(id);
        // Abrir el modal
        $('#FirmaDespacho').modal('show');
    });
});
</script>

@endsection



