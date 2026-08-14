@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'TELETRABAJO')

@section('cabecera', 'TELETRABAJO')

@section('content') 

<div class="row ">
            <p>
                <center>
                    <label style="color:red"><H2>IMPORTANTE</H2></label><br>
                    <strong>
                        SIRIS no permite realizar solicitudes de teletrabajo nuevas, es para que los funcionarios que ya cuentan con autorizaci&oacute;n de teletrabajo hagan el registro de novedades e indiquen si asisten o no a la oficina durante el d&iacute;a de teletrabajo
                        </strong>
                </center>
            </p>
        </div>

<center><h3><strong>INFORME TELETRABAJO DEL DIA {{$dia_semana}},     <?php $time = time(); echo date("d-m-Y", $time);?>.</strong></h3></center>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>IDENTIFICACION</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>FECHA FORMALIZACION</th>
				<th>EN TELETRABAJO</th>
				<th>ACCIONES</th>
				
		    </tr>
	    </thead>
	    
	    @if($despacho != null)
		    @foreach($despacho as $key =>$dirto)
		    
			<tbody class="buscar">
			    
				<tr class="table-light">
					<th scope="row"> {{$dirto->identificacion}}</th>									
					<th scope="row">{{$dirto->nombre_servidor}}</th>
					<th scope="row">{{$dirto->cargo}}</th>
					<th scope="row">{{$dirto->fecha_formalizacion}}</th>
					<th scope="row"> 
					<?php
                             $key = DB::table('seguimiento_presencialidad')
                            ->where('identificacion',$dirto->identificacion)
                            ->where('fecha_registro_asistencia',$fecha_act)
                            ->get(); 
                         ?>
					 @if($key->isEmpty())
    					<div class="form-group row">
    					    <form action="{{ route('usuario.informe.teletrabajo.registrar') }}" method="POST">
    @csrf
    					            <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigo_despacho}}" required>
                    				<input type="hidden"  name="dia" value="{{$dia_semana}}" required>
                    				<input type="hidden"  name="identificacion" value="{{$dirto->identificacion}}" required>
                    				<input type="hidden"  name="nombre_servidor" value="{{$dirto->nombre_servidor}}" required>
                    				<input type="hidden"  name="cargo" value="{{$dirto->cargo}}" required>
                                    <div class=" col-xs-12 col-md-3 mb-2 mt-2">
                                         <center>
                                        <label SIZE=1  style="text-align:center"><strong> SI  <input class="ocultarYBorrarCheckbox" type="radio"  value="EN_TELETRABAJO " name="teletrabajo" required ></strong>
                                        </label>
            		                    </center>
                                             
                                    </div>
                                    <div class=" col-xs-12 col-md-4 mb-2 mt-2">
                                        <center>
                                        <label SIZE=1  style="text-align:center"><strong> NO <input class="mostrarCheckbox" type="radio"  value="ASISTE_AL_DESPACHO" name="teletrabajo" required ></strong>
                                        </label>
                                        </center>     
                                    </div>
                                    <div class=" col-xs-12 col-md-5 descrip1_otro"  style="display:none">
                                      <input class="form-control inputOcultar @error('observaciones') is-invalid @enderror" placeholder="Motivo de Asistencia" autocomplete="off" id="descrip_otro.$dirto->id" type="text" name="observaciones" value="{{ old('observaciones') }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                    </div>
                                    
                                </div>
                       </th>
                		<th scope="row">       
                            <button class="fa fa-save btn btn-danger btn-block elevation-3" type="submit">REGISTRAR</button>                        
                            </form>
        				</th>
        			@else
        			    <th scope="row">       
                            <BUTTON CLASS="fa fa-save btn btn-success btn-block elevation-3" disabled>
                                REGISTRADO
                            </BUTTON>
        				</th>
        			@endif
    				
									     
				</tr>	                
			</tbody>
			@endforeach
		@else
		<tr class="table-light">
			<p class="lead">Actualmente esta seccion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
		</tr>
		@endif
	</table>
</div>

<hr>

<center>
    <strong>
        <h3>
            LISTADO DE EMPLEADOS QUE ESTAN REGISTRADOS CON TELETRABAJO 
        </h3>
    </strong>
</center>

<div class="table-responsive">
	<table class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>IDENTIFICACION</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>FECHA FORMALIZACION</th>
				<th>D&Iacute;AS TELETRABAJO</th>
				
		    </tr>
	    </thead>
	    
	    @if($despachousuario != null)
		    @foreach($despachousuario as $key =>$despacho)
		    
			<tbody class="buscar">
			    
				<tr class="table-light">
					<th scope="row"> {{$despacho->identificacion}}</th>									
					<th scope="row">{{$despacho->nombre_servidor}}</th>
					<th scope="row">{{$despacho->cargo}}</th>
					<th scope="row">{{$despacho->fecha_formalizacion}}</th>
					<th scope="row">{{$despacho->dias_teletrabajo}}</th>
				</tr>	                
			</tbody>
			@endforeach
		@else
		<tr class="table-light">
			<p class="lead">Actualmente esta seccion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
		</tr>
		@endif
	</table>
</div>
<!--@if(isset($ip))
 @if($ip =="190.217.19.164")-->
<!--@else
    <tr class="table-light">
			<p class="lead"><center><h1> ESTE REGISTRO SOLO SE PUEDE HACER DESDE LA OFICINA.</h1></center></p3>
		</tr>
@endif
@endif-->

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Seguimiento.js"></script>  


<script>
  // Esperamos a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
  // Obtenemos todos los checkboxes de 'ocultar y borrar' con la clase 'ocultarYBorrarCheckbox'
  const ocultarYBorrarCheckboxes = document.querySelectorAll('.ocultarYBorrarCheckbox');

  // Iteramos sobre cada checkbox 'ocultar y borrar'
  ocultarYBorrarCheckboxes.forEach(function(checkbox) {
    // Añadimos un evento 'change' a cada checkbox 'ocultar y borrar'
    checkbox.addEventListener('change', function() {
      // Obtenemos la fila (TR) a la que pertenece el checkbox
      const fila = checkbox.closest('tr');

      // Obtenemos el input de texto (TD) dentro de la misma fila
      const inputTexto = fila.querySelector('.inputOcultar');
      const divTexto = fila.querySelector('.descrip1_otro');
      

      // Verificamos el estado del checkbox 'ocultar y borrar'
      if (checkbox.checked) {
        // Si está marcado, ocultamos el input de texto y borramos su contenido
        inputTexto.style.display = 'none';
        inputTexto.value = ''; // Borramos el contenido
        divTexto.style.display = 'none';

        // Quitamos el atributo 'required' del input
        inputTexto.removeAttribute('required');
      } else {
        // Si no está marcado, mostramos el input de texto
        inputTexto.style.display = ''; // Restauramos el estilo original
        divTexto.style.display = '';

        // Añadimos el atributo 'required' al input
        inputTexto.setAttribute('required', true);
      }
    });
  });

  // Obtenemos todos los checkboxes de 'mostrar' con la clase 'mostrarCheckbox'
  const mostrarCheckboxes = document.querySelectorAll('.mostrarCheckbox');

  // Iteramos sobre cada checkbox 'mostrar'
  mostrarCheckboxes.forEach(function(checkbox) {
    // Añadimos un evento 'change' a cada checkbox 'mostrar'
    checkbox.addEventListener('change', function() {
      // Obtenemos la fila (TR) a la que pertenece el checkbox
      const fila = checkbox.closest('tr');

      // Obtenemos el input de texto (TD) dentro de la misma fila
      const inputTexto = fila.querySelector('.inputOcultar');
      const divTexto = fila.querySelector('.descrip1_otro');

      // Verificamos el estado del checkbox 'mostrar'
      if (checkbox.checked) {
        // Si está marcado, mostramos el input de texto
        inputTexto.style.display = '';
        divTexto.style.display = '';

        // Añadimos el atributo 'required' al input
        inputTexto.setAttribute('required', true);
      } else {
        // Si no está marcado, ocultamos el input de texto
        inputTexto.style.display = 'none';
        divTexto.style.display = 'none';
        // Quitamos el atributo 'required' del input
        inputTexto.removeAttribute('required');
      }
    });
  });
});

</script>

<!--script>

function obtenerValorRadio(valor) {
    var consulta = 'descrip_otro' + valor;
    var novedadclic = 'novedad' + valor;
    var otrovalor = 'descrip1_otro' + valor;
    
    const checkbox = document.getElementById(novedadclic);
    alert(checkbox.checked)
    
      // Verificamos si el checkbox está seleccionado cuando ocurre un cambio
      checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
          console.log('El checkbox está seleccionado');
        } else {
          console.log('El checkbox no está seleccionado');
        }
      });


    // Verificar si el elemento consulta existe antes de modificarlo
    var elementoConsulta = document.getElementById(otrovalor);
   // alert(elementoConsulta.value)
    if (elementoConsulta) {
        elementoConsulta.value = ""; // Limpiar el valor si existe
    }

    var grupoRadio = document.getElementsByName(novedadclic);
    
    
    
    
    

    for (var i = 0; i < grupoRadio.length; i++) {
        if (grupoRadio[i].checked) {
            var valorSeleccionado = grupoRadio[i].value;

            if (valorSeleccionado === "ASISTE_AL_DESPACHO") {
                if (elementoConsulta) {
                    alert('asistio')
                    elementoConsulta.setAttribute("required", true);
                }
                $('#' + otrovalor).css('display', 'block');
            } else {
                if (elementoConsulta) {
                    elementoConsulta.removeAttribute("required");
                }
                $('#' + otrovalor).css('display', 'none');
            }

            // Detener el bucle una vez que se encuentra el radio button seleccionado
            break;
        }
    }
}

</script-->

@endsection