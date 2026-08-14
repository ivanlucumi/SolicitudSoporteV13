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
  <title>REGISTRO ASISTENCIA EVENTOS</title>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

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
        #canvas {
    border: 1px solid black;
}
/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */
canvas {
    width: 800px;
    height: 400px;
    background-color: #FFFFFF;
    border: 1px solid black;
}


	</style>

<!-- JavaScript -->

<!-- JavaScript -->


<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
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

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body style="background: #fff;" >
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
      <div class="row justify-content-center">
           <div>
                       <canvas id="firmaFuncionario"></canvas>

<input type="text" value="" id="firma" name="firma"> 
                    </div>
      <div class="col-md-12" style="display:block">
              <form action="{{ route('enviar.soporte.pdf.post') }}" method="POST">
    @csrf
              <div class="row"><h3><center>FORMATO REPORTE DE DIAGNOSTICO ON SITE</center></h3></div>

                  <div class="row">
                      <p class=""><h5><center>Informaci&oacute;n del Servicio</center></h5></p>
                      <hr>
                  </div>
                  <div class="row">
                      <div class='col-xs-12 col-sm-4'>
                         N&uacute;mero de Caso
                      </div>
                      <div class='col-xs-12 col-sm-8'>
                         <input id="num_caso" class="form-control @error('num_caso') is-invalid @enderror" placeholder="Ingrese N&uacute;mero de Caso" autocomplete="off" type="text" name="num_caso" value="{{ old('num_caso') }}">
@error('num_caso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    
                      </div>
                  </div>

                   <div class="form-group row mt-2 mb-3">

                              <div class=" col-xs-12 col-md-3">
                                <label for="fecha">* Fecha Solicitud:</label>
                                <input id="fecha_solicitud" class="form-control @error('fecha_solicitud') is-invalid @enderror" placeholder="Ingrese N. C&eacute;dula" min="1" autocomplete="off" type="date" name="fecha_solicitud" value="{{ old('fecha_solicitud') }}">
@error('fecha_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="especialidad">* Hora Solicitud:</label>
                                <input id="hora_solicitud" class="form-control @error('hora_solicitud') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="time" name="hora_solicitud" value="{{ old('hora_solicitud') }}">
@error('hora_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-6">
                                <label for="medio_solicitud">* Medio Solicitud:</label>
                                <div class="row">

                                          <div class="col-xs-6 col-sm-3">

                                              <label><input type="radio" id="cbox3" value="Llamada" name="medio_solicitud"  required> Llamada</label>

                                              </div>

                                              <div class="col-xs-6 col-sm-3">

                                                  <label><input type="radio" id="cbox3" value="Correo" name="medio_solicitud"   required> Correo</label>

                                              </div>
                                              <div class="col-xs-6 col-sm-3">

                                                  <label><input type="radio" id="cbox3" value="Siris" name="medio_solicitud"   required> Siris</label>

                                              </div>
                                              <div class="col-xs-6 col-sm-3">

                                                  <label><input type="radio" id="cbox3" value="Virtual" name="medio_solicitud" required> Virtual</label>

                                              </div>


                                      </div>

                               </div>
                      </div>
                      
                      <div class="row">
                        <p class=""><h5><center>Datos de Usuario</center></h5></p>
                        <hr>
                      </div>


                       <div class="form-group row mt-2 mb-3">

                              <div class=" col-xs-12 col-md-4">
                                <label for="especialidad">* IDENTIFICACION:</label>
                                <input id="cedula" class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingrese No. Identificaci&oacute;n" min="1" autocomplete="off" type="number" name="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="especialidad">* NOMBRES:</label>
                                <input id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="apellido">* APELLIDOS:</label>
                                <input id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                      </div>

                       <div class="form-group row mt-2 mb-3">

                              <div class=" col-xs-12 col-md-4">
                                 <label for="ciudad">* CIUDAD:</label>
                               <input id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                <label for="especialidad">* CARGO:</label>
                                <input id="cargo" class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Cargo" autocomplete="off" type="text" name="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>

                               <div class="col-xs-12 col-md-4 form-group ">
                               <label for="telefono">* TEL&Eacute;FONO:</label>
                                <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese No. Tel&eacute;fono" min="1" autocomplete="off" type="number" name="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror


                              </div>
                      </div>
                       <div class="row">
                            <p class=""><h5><center>Despacho:</center></h5></p>
                            <hr>
                             <div class=" col-xs-12 col-md-3">
                                <label for="seccional">* SECCIONAL:</label>
                                <input id="seccional" class="form-control @error('seccional') is-invalid @enderror" placeholder="Ingrese Seccional" autocomplete="off" type="text" name="seccional" value="{{ old('seccional') }}">
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                              <div class=" col-xs-12 col-md-5">
                                 <label for="despacho">* DESPACHO:</label>
                                <input id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                               

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="direccion">* DIRECCI&Oacute;N:</label>
                                <input id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingrese Direcci&oacute;n" autocomplete="off" type="text" name="direccion" value="{{ old('direccion') }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                      </div>
                      
                      <div class="row">
                        <p class=""><h5><center>Falla Reportada</center></h5></p>
                        <textarea id="falla_reportada" class="form-control @error('falla_reportada') is-invalid @enderror" style="height: 6em" placeholder="Registre Falla Reportada" min="1" autocomplete="off" name="falla_reportada">{{ old('falla_reportada') }}</textarea>
@error('falla_reportada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                      </div>

                      <div class="row">
                            <p class=""><h5><center>Ingeniero Asignado</center></h5></p>
                            <div class=" col-xs-12 col-md-3">
                                    <label for="fecha">* Fecha Atenci&oacute;n:</label>
                                <input id="fecha_atencion" class="form-control @error('fecha_atencion') is-invalid @enderror" placeholder="Ingrese Fecha" min="1" autocomplete="off" type="date" name="fecha_atencion" value="{{ old('fecha_atencion') }}">
@error('fecha_atencion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="especialidad">* Hora Atenci&oacute;n:</label>
                                <input id="hora_atencion" class="form-control @error('hora_atencion') is-invalid @enderror" placeholder="Ingrese Hora" autocomplete="off" type="time" name="hora_atencion" value="{{ old('hora_atencion') }}">
@error('hora_atencion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-6">
                                 <label for="nombre_tecnico">* Nombre:</label>
                                <input id="nombre_tecnico" class="form-control @error('nombre_tecnico') is-invalid @enderror" placeholder="Ingrese Nombre Ingeniero" autocomplete="off" type="text" name="nombre_tecnico" value="{{ old('nombre_tecnico') }}">
@error('nombre_tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 ">
                                 <label for="tipo_servicio">* Tipo de Servicio:</label>
                                <input id="tipo_servicio" class="form-control @error('tipo_servicio') is-invalid @enderror" placeholder="Registre Tipo de Servicio" autocomplete="off" type="text" name="tipo_servicio" value="{{ old('tipo_servicio') }}">
@error('tipo_servicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>

                      </div>

                      <div class="row">
                            <p class=""><h5><center>Datos Equipo Afectado</center></h5></p>
                            <div class=" col-xs-12 col-md-4">
                                    <label for="placa">* Placa:</label>
                                <input id="placa" class="form-control @error('placa') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="placa" value="{{ old('placa') }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="serial">* Serial Equipo:</label>
                                <input id="serial_equipo" class="form-control @error('serial_equipo') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial_equipo" value="{{ old('serial_equipo') }}">
@error('serial_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="marca_equipo">* Marca Equipo:</label>
                                <input id="marca_equipo" class="form-control @error('marca_equipo') is-invalid @enderror" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca_equipo" value="{{ old('marca_equipo') }}">
@error('marca_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="modelo_equipo">* Modelo Equipo:</label>
                                <input id="modelo_equipo" class="form-control @error('modelo_equipo') is-invalid @enderror" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo_equipo" value="{{ old('modelo_equipo') }}">
@error('modelo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="sistema_operativo">* Sistema Operativo:</label>
                                <input id="sistema_operativo" class="form-control @error('sistema_operativo') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo" value="{{ old('sistema_operativo') }}">
@error('sistema_operativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="antivirus">* Antivirus:</label>
                                <input id="antivirus" class="form-control @error('antivirus') is-invalid @enderror" placeholder="Ingrese Tipo Antivirus" autocomplete="off" type="text" name="antivirus" value="{{ old('antivirus') }}">
@error('antivirus')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-2">
                                 <label for="ver_antivirus">* Versi&oacute;n Antivirus:</label>
                                <input id="ver_antivirus" class="form-control @error('ver_antivirus') is-invalid @enderror" placeholder="Versi&oacute;n Antivirus" autocomplete="off" type="text" name="ver_antivirus" value="{{ old('ver_antivirus') }}">
@error('ver_antivirus')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>

                      </div>

                      <div class="row">
                            <p class=""><h5><center>Elementos de Soporte</center></h5></p>
                            <div class=" col-xs-12">
                                    <div class="row">
                                          <div class="col-xs-6 col-sm-4 mt-3">
                                              <label><input type="radio" id="cbox3" value="SI" name="elementos_de_soporte"   required> SI</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-4 mt-3">
                                              <label><input type="radio" id="cbox3" value="NO" name="elementos_de_soporte"   required> NO</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-4 mt-3">
                                              <label><input type="radio" id="cbox3" value="NO_APLICA" name="elementos_de_soporte"   required> NO APLICA</label>
                                          </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                          <div class="col-xs-6 col-sm-3 mt-2">
                                              <label><input type="radio" id="cbox3" value="CPU" name="tipo_elemento_de_soporte"   > CPU</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-3 mt-3">
                                              <label><input type="radio" id="cbox3" value="MONITOR" name="tipo_elemento_de_soporte"   > MONITOR</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-3 mt-3">
                                              <label><input type="radio" id="cbox3" value="TECLADO" name="tipo_elemento_de_soporte"   > TECLADO</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-3 mt-3">
                                              <label><input type="radio" id="cbox3" value="MOUSE" name="tipo_elemento_de_soporte"   > MOUSE</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-3 mt-3">
                                              <label><input type="radio" id="cbox3" value="SERVIDOR" name="tipo_elemento_de_soporte"  > SERVIDOR</label>
                                          </div>
                                          <div class="col-xs-6 col-sm-3 mt-3">
                                              <label><input type="radio" id="cbox3" value="OTRO" name="tipo_elemento_de_soporte"   > OTRO</label>
                                          </div>
                                          <div class=" col-xs-12 col-md-6">
                                            <input id="elemeto_soporte" class="form-control @error('elemeto_soporte') is-invalid @enderror" placeholder="Registre Elemento Soporte" autocomplete="off" type="text" name="elemeto_soporte" value="{{ old('elemeto_soporte') }}">
@error('elemeto_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                           </div>
                                           <hr>
                                    </div>
                          </div>
                              <div class=" col-xs-12 col-md-4">
                                <label for="placa_soporte">* Placa:</label>
                                <input id="placa_soporte" class="form-control @error('placa_soporte') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="placa_soporte" value="{{ old('placa_soporte') }}">
@error('placa_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="serial">* Serial Equipo:</label>
                                <input id="serial_equipo_soporte" class="form-control @error('serial_equipo_soporte') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial_equipo_soporte" value="{{ old('serial_equipo_soporte') }}">
@error('serial_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="marca_equipo">* Marca Equipo:</label>
                                <input id="marca_equipo_soporte" class="form-control @error('marca_equipo_soporte') is-invalid @enderror" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca_equipo_soporte" value="{{ old('marca_equipo_soporte') }}">
@error('marca_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="modelo_equipo">* Modelo Equipo:</label>
                                <input id="modelo_equipo_soporte" class="form-control @error('modelo_equipo_soporte') is-invalid @enderror" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo_equipo_soporte" value="{{ old('modelo_equipo_soporte') }}">
@error('modelo_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="sistema_operativo">* Sistema Operativo:</label>
                                <input id="sistema_operativo_soporte" class="form-control @error('sistema_operativo_soporte') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo_soporte" value="{{ old('sistema_operativo_soporte') }}">
@error('sistema_operativo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-4">
                                 <label for="memoria">* Memoria:</label>
                                <input id="memoria_soporte" class="form-control @error('memoria_soporte') is-invalid @enderror" placeholder="Cantidad Ram" autocomplete="off" type="text" name="memoria_soporte" value="{{ old('memoria_soporte') }}">
@error('memoria_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="disco_soporte">* Disco Duro:</label>
                                <input id="disco_soporte" class="form-control @error('disco_soporte') is-invalid @enderror" placeholder="Disco Duro" autocomplete="off" type="text" name="disco_soporte" value="{{ old('disco_soporte') }}">
@error('disco_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="procesador_soporte">* Procesador:</label>
                                <input id="procesador_soporte" class="form-control @error('procesador_soporte') is-invalid @enderror" placeholder="Procesador" autocomplete="off" type="text" name="procesador_soporte" value="{{ old('procesador_soporte') }}">
@error('procesador_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="tipo_equipo_soporte">* Tipo Equipo:</label>
                                <input id="tipo_equipo_soporte" class="form-control @error('tipo_equipo_soporte') is-invalid @enderror" placeholder="Registre Tipo Equipo" autocomplete="off" type="text" name="tipo_equipo_soporte" value="{{ old('tipo_equipo_soporte') }}">
@error('tipo_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>
                              <div class=" col-xs-12 col-md-3">
                                 <label for="nombre_equipo_soporte">* Nombre Equipo:</label>
                                <input id="nombre_equipo_soporte" class="form-control @error('nombre_equipo_soporte') is-invalid @enderror" placeholder="Registre Nombre Equipo" autocomplete="off" type="text" name="nombre_equipo_soporte" value="{{ old('nombre_equipo_soporte') }}">
@error('nombre_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                              </div>

                      </div>
                     <hr>
                     <div class="row">
                      <p class=""><h5><center>Descripci&oacute;n del Servicio</center></h5></p>
                      <label for="fecha">* Diagn&oacute;stico:</label>
                      <textarea id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n del Diagn&oacute;stico" min="1" autocomplete="off" name="diagnostico">{{ old('diagnostico') }}</textarea>
@error('diagnostico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                      <label for="fecha">* Soluci&oacute;n:</label>
                      <textarea id="solucion" class="form-control @error('solucion') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n Soluci&oacute;n" min="1" autocomplete="off" name="solucion">{{ old('solucion') }}</textarea>
@error('solucion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                    </div>
                    <hr>
                     <div class="row">
                      <p class=""><h5><center>Observaci&oacute;n Cliente</center></h5></p>
                      <p>
                          Por favor, seleccione algunas de las siguientes opciones considerando 1 como la mínima calificación y 5 como la máxima calificación de acuerdo al grado de satisfacción que se encuentra con el servicio prestado.
                      </p>
                      <div class=" col-xs-12 col-sm-6">
                          <textarea id="observacion_cliente" class="form-control @error('observacion_cliente') is-invalid @enderror" placeholder="Observaci&oacute;n" min="1" autocomplete="off" name="observacion_cliente">{{ old('observacion_cliente') }}</textarea>
@error('observacion_cliente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                      </div>
                      <div class=" col-xs-12 col-sm-6">
                          <div class="col-xs-12 col-sm-12">
                              <label for="fecha">*Calificaci&oacute;n del servicio :</label>


                          </div>
                          <div class="col-xs-12 col-sm-12">
                              <div class="table-responsive">
                                  <table id="table9" class="table table-bordered table-striped  table-condensed table-hover" style="width:auto; height:20px;" >
                                     <thead class="shadow" style="background-color: #004182; color: #fff;">
                                       <tr>
                                             <th>PREGUNTAS</th>
                                             <th>1</th>
                                             <th>2</th>
                                             <th>3</th>
                                             <th>4</th>
                                             <th>5</th>
                                       </tr>
                                     </thead>

                                             <tbody data-id="" class="buscar">
                                                 <tr class="table-light">
                                                     <th scope="row">Disposici&oacute;n para atenci&oacute;n de servicio del ingeniero </th>
                                                     <th scope="row">
                                                      <label><input type="radio" id="cbox3" value="1" name="disposicion"  > </label>
                                                     </th>
                                                     <th scope="row">
                                                      <label><input type="radio" id="cbox3" value="2" name="disposicion"  > </label>
                                                     </th>
                                                     <th scope="row">
                                                      <label><input type="radio" id="cbox3" value="3" name="disposicion"  > </label>
                                                     </th>
                                                     <th scope="row">
                                                      <label><input type="radio" id="cbox3" value="4" name="disposicion"  > </label>
                                                     </th>
                                                     <th scope="row">
                                                      <label><input type="radio" id="cbox3" value="5" name="disposicion"  > </label>
                                                     </th>
                                                 </tr>
                                                 <tr class="table-light">
                                                  <th scope="row">Conocimiento t&eacute;cnico del ingeniero  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="1" name="conocimiento_tec"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="2" name="conocimiento_tec"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="3" name="conocimiento_tec"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="4" name="conocimiento_tec"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="5" name="conocimiento_tec"  > </label>
                                                  </th>
                                              </tr>
                                              <tr class="table-light">
                                                  <th scope="row">Tiempo de atenci&oacute;n y soluci&oacute;n  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="1" name="tiempo_aten"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="2" name="tiempo_aten"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="3" name="tiempo_aten"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="4" name="tiempo_aten"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="5" name="tiempo_aten"  > </label>
                                                  </th>
                                              </tr>
                                              <tr class="table-light">
                                                  <th scope="row">Informaci&oacute;n del avance del caso  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="1" name="avance_caso"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="2" name="avance_caso"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="3" name="avance_caso"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="4" name="avance_caso"  > </label>
                                                  </th>
                                                  <th scope="row">
                                                   <label><input type="radio" id="cbox3" value="5" name="avance_caso"  > </label>
                                                  </th>
                                              </tr>
                                              </tbody>
                                  </table>
                               </div>
                             </div>
                          </div>
                      </div>
                    <hr>
                    <div>
                       <canvas id="firmaFuncionario"></canvas>

<input type="text" value="" id="firma" name="firma"> 
                    </div>
                     
                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button id="bt_envio" type="submit" class="btn btn-primary" >
                                  REGISTRAR INFORMACI&Oacute;N 1111
                              </button>
                          </div>
                      </div>
                  </form>

      </div>
  </div>
</div>


<img  src="data:image/png;base64,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">
<script>
    //======================================================================
    // VARIABLES
    //======================================================================
    const miCanvas = document.querySelector('#firmaFuncionario'),
        $btnDescargar = document.querySelector("#bt_envio");
    let lineas = [];
    let correccionX = 0;
    let correccionY = 0;
    let pintarLinea = false;
    // Marca el nuevo punto
    let nuevaPosicionX = 0;
    let nuevaPosicionY = 0;

    let posicion = miCanvas.getBoundingClientRect()
    correccionX = posicion.x;
    correccionY = posicion.y;

    miCanvas.width = 800;
    miCanvas.height = 400;

    //======================================================================
    // FUNCIONES
    //======================================================================

    /**
     * Funcion que empieza a dibujar la linea
     */
    function empezarDibujo () {
        pintarLinea = true;
        lineas.push([]);
    };
    
    /**
     * Funcion que guarda la posicion de la nueva línea
     */
    function guardarLinea() {
        lineas[lineas.length - 1].push({
            x: nuevaPosicionX,
            y: nuevaPosicionY
        });
    }

    /**
     * Funcion dibuja la linea
     */
    function dibujarLinea (event) {
        event.preventDefault();
        if (pintarLinea) {
            let ctx = miCanvas.getContext('2d')
            // Estilos de linea
            ctx.lineJoin = ctx.lineCap = 'round';
            ctx.lineWidth = 8;
            // Color de la linea
            ctx.strokeStyle = '#000000';
            // Marca el nuevo punto
            if (event.changedTouches == undefined) {
                // Versión ratón
                nuevaPosicionX = event.layerX;
                nuevaPosicionY = event.layerY;
            } else {
                // Versión touch, pantalla tactil
                nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
                nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
            }
            // Guarda la linea
            guardarLinea();
            // Redibuja todas las lineas guardadas
            ctx.beginPath();
            lineas.forEach(function (segmento) {
                ctx.moveTo(segmento[0].x, segmento[0].y);
                segmento.forEach(function (punto, index) {
                    ctx.lineTo(punto.x, punto.y);
                });
            });
            ctx.stroke();
        }
    }

    /**
     * Funcion que deja de dibujar la linea
     */
    function pararDibujar () {
        pintarLinea = false;
        guardarLinea();
    }

    //======================================================================
    // EVENTOS
    //======================================================================

    // Eventos raton
    miCanvas.addEventListener('mousedown', empezarDibujo, false);
    miCanvas.addEventListener('mousemove', dibujarLinea, false);
    miCanvas.addEventListener('mouseup', pararDibujar, false);

    // Eventos pantallas táctiles
    miCanvas.addEventListener('touchstart', empezarDibujo, false);
    miCanvas.addEventListener('touchmove', dibujarLinea, false);
    
     $btnDescargar.onclick = () => {
        const enlace = document.createElement('a');
        // El título
        //enlace.download = "Firma.png";
        // Convertir la imagen a Base64 y ponerlo en el enlace
        enlace.href = miCanvas.toDataURL();
        var firma = enlace.href = miCanvas.toDataURL();

        document.getElementById('firma').value=firma
        console.log(firma)
        // Hacer click en él
        //enlace.click();
    };

</script>
   </main>


</body>

</html>


