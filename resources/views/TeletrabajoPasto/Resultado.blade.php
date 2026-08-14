
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio teléfonico disajcali"/>
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Solicitud de Audiencias Preliminares</title>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>



<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  	<style type="text/css">
		/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  margin-bottom: 60px; /* Margin bottom by footer height */
}
.footer {
  position: absolute;
  bottom: -60px;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 30px; /* Vertically center the text there */
  background-color: #004182;
  color: #ffffff;
}

ul li:hover {background: #ffffff52;}

.cBlanco{
	color: #ffffff;
}

.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
  background-color: #a2a2a2b3;
}

.dropdown-menu > li > a:hover{
  background-color: #a2a2a2b3;
}
/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

<style>
    /* Estilos para el botón */
    button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Estilo para el botón cuando está inhabilitado */
    button[disabled] {
        background-color: gray;
        color: white;
        cursor: not-allowed;
    }
</style>

	</style>

<link rel="stylesheet" href="/toastr/toastr.min.css">
<script src="/toastr/toastr.min.js"></script>

<!-- JavaScript -->

<!-- JavaScript -->


<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    @stack('style')


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- NAVIDAD
<marquee style="position: absolute; z-index: 100"><img src="img/Navidad.gif"></marquee>
-->
   

<body style="background: #fff;"onLoad="redireccionar()" >
  <main role="main" class="container">
    <div class="row">
      <!--Logo principal index -->
      <div class="col-xs-12  col-md-5">
        <img src="/img/logoLargo.png" class="img-responsive">
      </div>
      <!-- Texto descriptivo del index y juzgadi-->
      <div class="col-xs-12  col-md-7">
        <p style="text-align: center; font-size: 17px; font-weight: bold;">
          <br>Consejo Superior de la Judicatura<br>
          Direcci&oacute;n Ejecutiva Seccional de Administraci&oacute;n Judicial<br>
          Cali - Valle del Cauca
        </p>
      </div>
      
    </div>

<div class="container-fluid">

<center><h3><strong>INFORME TELETRABAJO DEL DIA {{$dia_semana}},     <?php $time = time(); echo date("d-m-Y", $time);?></strong></h3></center>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>IDENTIFICACION</th>
				<th>NOMBRE</th>
				<th>DEPENDENCIA</th>
				<th>FECHA SOLICITUD</th>
				<th>EN TELETRABAJO</th>
				<th>ACCIONES</th>
				
		    </tr>
	    </thead>
	    
	    @if($despacho != null)
		    @foreach($despacho as $key =>$dirto)
		    
			<tbody class="buscar">
			    
				<tr class="table-light">
					<th scope="row"> {{$dirto->identificacion}}</th>									
					<th scope="row">{{$dirto->nombre}}</th>
					<th scope="row">{{$dirto->dependencia}}</th>
					<th scope="row">{{$dirto->fecha_solicitud}}</th>
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
			<p class="lead">Actualmente esta secion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
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


  
<!-- REQUIRED JS SCRIPTS   onClick="this.disabled=true"-->

<!-- jQuery 3 -->
<script src="js/jquery-3.2.1.min.js"></script> 
<script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script> 
<script src="adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
<script src="adminlte/dist/js/adminlte.min.js"></script>
<script src="/gallery/galeria/light-gallery/js/lightgallery-all.js"></script>
<!-- Custom Js -->
<script src="/gallery/galeria/image-gallery.js"></script>
<!--<script src="/js/ingreso/contadorVisitas.js"></script>-->
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script language="JavaScript">
  function redireccionar() {
    //setTimeout("location.href='https://www.disajcali.gov.co/solicitud/ficha/preliminar", 900000000);
  }
</script>

<script>
document.getElementById('file_anexo').onchange = function() {
    var archivo = this.files[0];
    var maxSize = 20 * 1024 * 1024;

    if (archivo.size > maxSize) {
        alert('El tamaño del archivo es demasiado grande. Por favor, seleccione un archivo más pequeño.');
        this.value = ''; // Limpiar el campo de archivo
    }
};
</script>

<script>


    function enviarFormulario() {
        // Mostrar el modal de espera
        $('#modalEspera').modal('show');
        
        setTimeout(function() {
                $('#modalEspera').modal('hide');
            }, 5000);

        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById('MiFormulario'));
        
        var url = formData.attr('action');
        var data = formData.serialize();
        
        
        // Enviar la solicitud al controlador
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function(response) {
                // Manejar la respuesta del controlador

                // Cerrar el modal de espera
                $('#modalEspera').modal('hide');
            },
            error: function(error) {
                // Manejar errores

                // Cerrar el modal de espera
                $('#modalEspera').modal('hide');
            }
        });
    }
</script>

@stack('scripts')
</body>

</html>

