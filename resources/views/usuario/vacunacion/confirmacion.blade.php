@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Jornada de Vacunacion Empleados Judiciales y Familiares')
@section('cabecera', 'Formulario para Registro de Vacunaci&oacute;n')

@section('content') 

	<div class="row justify-content-md-center">
	    
      <div class="row">
          <div class="col-xs-1">

          </div>
          <div class="col-xs-10">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-12">
                   <center> <img src="/img/covid.jpg" class="card-img" width="610em" height="230em"></center>
                  </div>
                  <div class="col-md-12">
                    <div class="card-body">
                       <p class="card-text"><h2><strong><center>FORMULARIO PARA REGISTRO JORNADA VACUNACI&Oacute;N.</center></strong></h2> </p>
                      <p  align="justify"><h4>Por favor diligenciar los datos solicitados para registrar asistencia a Jornada de Vacunaci&oacute;n.</h4>
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
  

<form action="{{ route('confirmar.usuario.vacunacion') }}" method="POST">
    @csrf  
<div class="row ">
    <div class="col-xs-12 col-sm-8 form-group ">
    <label for="nRadicacion">Número de cedula:</label>
    
    <input class="form-control @error('cedula') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" type="number" name="cedula" id="cedula" value="{{ old('cedula', $cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-sm-4">
		<label for="hora">Seleccione Hora Asistencia:</label><br>
		<input class="form-control @error('hora_asistencia') is-invalid @enderror" type="text" name="hora_asistencia" id="hora_asistencia" value="{{ old('hora_asistencia', $hora) }}">
@error('hora_asistencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>
</div>

 <div class="col-xs-12 col-md-8 form-group ">

        <label for="empleado">Empleado o Familiar:</label>

        <div class="row">

            <div class="col-xs-6 col-sm-6">

                <label><input type="radio" id="cbox3" value="EMPLEADO" name="empleado" onclick="empleadoN()" > EMPLEADO</label>

                </div>

                <div class="col-xs-6 col-sm-6">

                    <label><input type="radio" id="cbox3" value="FAMILIAR" name="empleado" onclick="familiarM()"> FAMILIAR</label>

                </div>
        

        </div>

</div>
<div class="col-xs-12 col-md-4 form-group " id="idFamiliar" style="display:none;">

        <label for="cedFamilia">Nombre cedula del Empleado de la Rama:</label>

        <input class="form-control @error('familiar') is-invalid @enderror" placeholder="Ingrese No. Identificacion de Empleado" autocomplete="off" id="identFamiliar" type="number" name="familiar" value="{{ old('familiar') }}">
@error('familiar')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>


<div class="row ">

    <div class="col-xs-12 col-sm-6 form-group ">

        <label for="nombres">Nombre:</label>

        <input class="form-control @error('nombres') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre Completo" type="text" name="nombres" id="nombres" value="{{ old('nombres') }}">
@error('nombres')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-6 form-group ">

        <label for="apellidos">Apellido:</label>

        <input class="form-control @error('apellidos') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Apellidos Completos" type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}">
@error('apellidos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
     <div class="col-xs-12 col-md-6 form-group ">

        <label for="sexo">Seleccione Sexo:</label>

        <div class="row">

            <div class="col-xs-6 col-sm-6">

                <label><input type="radio" id="cbox2" value="FEMENINO" name="sexo"  > FEMENINO</label>

                </div>

                <div class="col-xs-6 col-sm-6">

                    <label><input type="radio" id="cbox2" value="MASCULINO" name="sexo" > MASCULINO</label>

                </div>
        

        </div>

</div>

   <div class="col-xs-12 col-sm-3 form-group ">

        <label for="fecha_nacimiento">Fecha Nacimiento:</label>

        <input class="form-control @error('fecha_nacimiento') is-invalid @enderror" autocomplete="off" id="fechaN" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
@error('fecha_nacimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    <div class="col-xs-12 col-sm-3 form-group ">
        
       

        <label for="edad">Edad:</label>

        <input class="form-control @error('edad') is-invalid @enderror" min="1" autocomplete="off" id="edad" type="number" name="edad" value="{{ old('edad') }}">
@error('edad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    
    <div class="col-xs-12 col-md-8 form-group ">

        <label for="dosis">Indique la dosis a aplicar:</label>

        <div class="row">

            <div class="col-xs-6 col-sm-4">

                <label><input type="radio" id="cbox2" value="PRIMERA" name="dosis" onclick="nomVacunaO()" > PRIMERA</label>

                </div>

                <div class="col-xs-6 col-sm-4">

                    <label><input type="radio" id="cbox2" value="SEGUNDA" name="dosis" onclick="nomVacunaM()"> SEGUNDA</label>

                </div>
                <div class="col-xs-6 col-sm-4">

                    <label><input type="radio" id="cbox2" value="REFUERZO" name="dosis" onclick="nomVacunaM()"> REFUERZO</label>

                </div>
        

        </div>

</div>

<div class="col-xs-12 col-md-4 form-group " id="dosisDos" style="display:none;">

       <label for="hora">Seleccione Vacuna Aplicada:</label><br>
		<select class="form-control @error('vacuna') is-invalid @enderror" name="vacuna" id="vacuna">
    <option value="">Seleccione Vacuna</option>
    @foreach($vacunas as $key => $value)
        <option value="{{ $key }}" @selected(old('vacuna') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('vacuna')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>

        
    </div>
 <br> 
 </div>
<script>
//mostrar nombre  vacuna
function nomVacunaM() {
    var x = document.getElementById("dosisDos");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }
}

//ocultar nombre  vacuna

function nomVacunaO() {
    var x = document.getElementById("dosisDos");
    document.getElementById('textVacuna').value = " ";
    if (x.style.display === "block") {
        x.style.display = "none";
        document.getElementById('textVacuna').value = " ";
    } else {
        x.style.display = "none";
    }
}


//mostrar familia
function familiarM() {
    var x = document.getElementById("idFamiliar");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }
}

//ocultar failiar
function empleadoN() {
    var x = document.getElementById("idFamiliar");
    document.getElementById('identFamiliar').value = " ";
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
}


     //anho
     
    var verifAnho = document.getElementById('fechaN');
    verifAnho.addEventListener('input', function() {

        //console.log(this.value);

        $.get("/usuarios/consulta/anho/" + this.value + "", function(response) {

            //console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('edad').value = response;
            } else {
                document.getElementById('edad').value = "";
            }
        });

    });
    

</script>    


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