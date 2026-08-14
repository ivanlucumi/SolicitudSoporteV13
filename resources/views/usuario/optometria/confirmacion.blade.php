@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Jornada de Bienestar Empleados Judiciales')
@section('cabecera', 'Formulario para Registro de Jornada de Bienestar')

@section('content') 

	<div class="row justify-content-md-center">
	    
      <div class="row">
          <div class="col-xs-1">

          </div>
          <div class="col-xs-10">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-12">
                   <center> <img src="/img/1formatos/jornadaBienestar.jpeg" class="card-img" width="410em" height="330em"></center>
                  </div>
                  <div class="col-md-12">
                    <div class="card-body">
                       <p class="card-text"><h2><strong><center>FORMULARIO PARA REGISTRO JORNADA DE BIENESTAR.</center></strong></h2> </p>
                      <p  align="justify"><h4>Por favor diligenciar los datos solicitados para registrar asistencia a la Jornada de Salud.</h4>
                      <br>
                      
                     </div>
                  </div>
                </div>
              </div>
          </div> 
          <div class="col-xs-1">

          </div>       
      </div>
	</div>
    <hr>
  

<form action="{{ route('usuario.save.optometria') }}" method="POST">
    @csrf  
<input class="form-control" type="hidden" name="despacho" id="despacho" value="{{  auth()->user()->name.' '.  auth()->user()->lastname }}">
<input class="form-control" type="hidden" name="email_despacho" id="email_despacho" value="{{  auth()->user()->email }}">

<div class="row ">
    <div class="col-xs-12 col-sm-4 form-group ">
    <label for="nRadicacion">Número de cedula:</label>    
    <input class="form-control @error('cedula') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" type="number" name="cedula" id="cedula" value="{{ old('cedula', $cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-sm-4">
		<label for="hora">Fecha Seleccionada:</label><br>
		<input class="form-control @error('fecha') is-invalid @enderror" type="text" name="fecha" id="fecha" value="{{ old('fecha', $fecha) }}">
@error('fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>
	<div class="col-xs-12 col-sm-4">
		<label for="hora">Hora Seleccionada:</label><br>
		<input class="form-control @error('hora') is-invalid @enderror" type="text" name="hora" id="hora" value="{{ old('hora', $hora) }}">
@error('hora')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>
</div>



<div class="row ">

    <div class="col-xs-12 col-sm-4 form-group ">

        <label for="nombres">Nombre:</label>

        <input class="form-control @error('nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-4 form-group ">

        <label for="apellidos">Apellido:</label>

        <input class="form-control @error('apellido') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Apellidos Completos" type="text" name="apellido" id="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    <div class="col-xs-12 col-sm-4 form-group ">

        <label for="eps">EPS:</label>

        <input class="form-control @error('eps') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Su Eps" type="text" name="eps" id="eps" value="{{ old('eps') }}">
@error('eps')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    
     <div class="col-xs-12 col-sm-4 form-group ">

        <label for="correo">Correo:</label>

        <input class="form-control @error('correo') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Correo" type="email" name="correo" id="correo" value="{{ old('correo') }}">
@error('correo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
     <div class="col-xs-12 col-sm-4 form-group ">

        <label for="telefono">Telefono:</label>

        <input class="form-control @error('telefono') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Telefono" type="text" name="telefono" id="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>


 <br> 
 </div>


<div class="row">
    <div class="col-xs-12 col-sm-4"></div>
    
    <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">RESERVAR</button>
        
    </div>
    
    <div class="col-xs-12 col-sm-4"></div>                
</div>   
</form> 

    
 

   
  @push('scripts')
  <script src="/js/jquery.js"></script>
    
   <script src="/js/horaMilitar/combodate.js"></script> 
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>        

<!--        https://cdnjs.com/libraries/bootstrap-datetimepicker-->
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


 <script>
            
            $(function () {            
        
                
                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });
                
              
                
            });    

        
</script>
  
   @endpush
   



@endsection