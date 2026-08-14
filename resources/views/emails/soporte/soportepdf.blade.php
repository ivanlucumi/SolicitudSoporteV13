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
 
  <title>REGISTRO ASISTENCIA EVENTOS</title>

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



	</style>

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
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12" style="display:block">
             @include('alerts.flash-message')
             @include('../alerts.success')
                @include('../alerts.request')
                @if ($soporte->id)
			    <form action="{{ route('cerrar.soporte.servicio',$soporte->id) }}" method="POST">
    @csrf
    @method('PUT')
                @else

                <form action="{{ route('enviar.soporte.pdf.post') }}" method="POST">
    @csrf
                @endif
                <div class="card-header"><h3><center>FORMATO REPORTE DE DIAGNOSTICO ON SITE</center></h3></div>

                    <div class="row">
                        <p class=""><h5><center>Informaci&oacute;n del Servicio</center></h5></p>
                        <hr>
                    </div>
                    <div class="row">
                    <div class='col-xs-12 col-sm-4'>
                    N&uacute;mero de Caso
                    </div>
                    <div class='col-xs-12 col-sm-8'>
                     <input id="num_caso" class="form-control @error('num_caso') is-invalid @enderror" placeholder="Ingrese N&uacute;mero de Caso" autocomplete="off" type="text" name="num_caso" value="{{ old('num_caso', $soporte->num_caso ?? $soporte->num_caso) }}">
@error('num_caso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                    </div>
                    </div>

                     <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-3">
                                  <label for="fecha">* Fecha Solicitud:</label>
                                  <input id="fecha_solicitud" class="form-control @error('fecha_solicitud') is-invalid @enderror" placeholder="Ingrese N. C&eacute;dula" min="1" autocomplete="off" type="date" name="fecha_solicitud" value="{{ old('fecha_solicitud', $soporte->fecha_solicitud ?? $soporte->fecha_solicitud) }}">
@error('fecha_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="especialidad">* Hora Solicitud:</label>
                                  <input id="hora_solicitud" class="form-control @error('hora_solicitud') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="time" name="hora_solicitud" value="{{ old('hora_solicitud', $soporte->hora_solicitud ?? $soporte->hora_solicitud) }}">
@error('hora_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-6">
                                  <label for="medio_solicitud">* Medio Solicitud:</label>
                                  <div class="row">

                                            <div class="col-xs-6 col-sm-3">

                                                <label><input type="radio" id="cbox3" value="Llamada" name="medio_solicitud" @if ($soporte->medio_solicitud =="Llamada")
                                                 @php
                                                     echo 'checked'
                                                 @endphp
                                                @endif required> Llamada</label>

                                                </div>

                                                <div class="col-xs-6 col-sm-3">

                                                    <label><input type="radio" id="cbox3" value="Correo" name="medio_solicitud"  @if ($soporte->medio_solicitud =="Correo")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif required> Correo</label>

                                                </div>
                                                <div class="col-xs-6 col-sm-3">

                                                    <label><input type="radio" id="cbox3" value="Siris" name="medio_solicitud" @if ($soporte->medio_solicitud =="Siris")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> Siris</label>

                                                </div>
                                                <div class="col-xs-6 col-sm-3">

                                                    <label><input type="radio" id="cbox3" value="Virtual" name="medio_solicitud"  @if ($soporte->medio_solicitud =="Virtual")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif required> Virtual</label>

                                                </div>


                                        </div>

                                 </div>
                        </div>
                        <div class="row">
                          <p class=""><h5><center>Despacho:</center></h5></p>
                          <hr>
                          <div class=" col-xs-12 col-md-3">
                                  <label for="seccional">* SECCIONAL:</label>
                                  <input id="seccional" class="form-control @error('seccional') is-invalid @enderror" placeholder="Ingrese Seccional" autocomplete="off" type="text" name="seccional" value="{{ old('seccional', $soporte->seccional ?? $soporte->seccional) }}">
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-5">
                                   <label for="despacho">* DESPACHO:</label>
                                  <input id="despacho" class="form-control select2 @error('despacho') is-invalid @enderror" placeholder="Seleccione Despacho" autocomplete="off" type="text" name="despacho" value="{{ old('despacho', $soporte->despacho ?? $soporte->despacho) }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="direccion">* DIRECCI&Oacute;nN:</label>
                                  <input id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingrese Direcci&oacute;n" autocomplete="off" type="text" name="direccion" value="{{ old('direccion', $soporte->direccion ?? $soporte->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                        </div>
                        <div class="row">
                          <p class=""><h5><center>Datos de Usuario</center></h5></p>
                          <hr>
                        </div>


                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* IDENTIFICACION:</label>
                                  <input id="cedula" class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingrese No. Identificaci&oacute;n" min="1" autocomplete="off" type="number" name="cedula" value="{{ old('cedula', $soporte->cedula ?? $soporte-> cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="especialidad">* NOMBRES:</label>
                                  <input id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" value="{{ old('nombre', $soporte->nombre ?? $soporte->nombre) }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="apellido">* APELLIDOS:</label>
                                  <input id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido', $soporte->apellido ?? $soporte->apellido) }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </div>

                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                   <label for="ciudad">* CIUDAD:</label>
                                  <input id="ciudad" class="form-control select2 @error('ciudad') is-invalid @enderror" placeholder="Seleccione Ciudad" autocomplete="off" type="text" name="ciudad" value="{{ old('ciudad', $soporte->ciudad ?? $soporte->ciudad) }}">
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* CARGO:</label>
                                  <input id="cargo" class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Cargo" autocomplete="off" type="text" name="cargo" value="{{ old('cargo', $soporte->cargo ?? $soporte->cargo) }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>

                                 <div class="col-xs-12 col-md-4 form-group ">
                                 <label for="telefono">* TEL&Eacute;FONO:</label>
                                  <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese N. Tel&eacute;fono" min="1" autocomplete="off" type="number" name="telefono" value="{{ old('telefono', $soporte->telefono ?? $soporte->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror


                                </div>
                        </div>
                        <div class="row">
                          <p class=""><h5><center>Falla Reportada</center></h5></p>
                          <textarea id="falla_reportada" class="form-control @error('falla_reportada') is-invalid @enderror" style="height: 6em" placeholder="Registre Falla Reportada" min="1" autocomplete="off" name="falla_reportada">{{ old('falla_reportada', $soporte->falla_reportada ?? $soporte->falla_reportada) }}</textarea>
@error('falla_reportada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                        </div>

                        <div class="row">
                          <p class=""><h5><center>Ingeniero Asignado</center></h5></p>
                          <div class=" col-xs-12 col-md-3">
                                  <label for="fecha">* Fecha Atenci&oacute;n:</label>
                                  <input id="fecha_atencion" class="form-control @error('fecha_atencion') is-invalid @enderror" placeholder="Ingrese Fecha" min="1" autocomplete="off" type="date" name="fecha_atencion" value="{{ old('fecha_atencion', $soporte->fecha_atencion ?? $soporte->fecha_atencion) }}">
@error('fecha_atencion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="especialidad">* Hora Atenci&oacute;n:</label>
                                  <input id="hora_atencion" class="form-control @error('hora_atencion') is-invalid @enderror" placeholder="Ingrese Hora" autocomplete="off" type="time" name="hora_atencion" value="{{ old('hora_atencion', $soporte->hora_atencion ?? $soporte->hora_atencion) }}">
@error('hora_atencion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-6">
                                   <label for="nombre_tecnico">* Nombre:</label>
                                  <input id="nombre_tecnico" class="form-control @error('nombre_tecnico') is-invalid @enderror" placeholder="Ingrese Nombre Ingeniero" autocomplete="off" type="text" name="nombre_tecnico" value="{{ old('nombre_tecnico', $soporte->nombre_tecnico ??  auth()->user()->name.' '.  auth()->user()->lastname) }}">
@error('nombre_tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 ">
                                   <label for="tipo_servicio">* Tipo de Servicio:</label>
                                  <input id="tipo_servicio" class="form-control @error('tipo_servicio') is-invalid @enderror" placeholder="Registre Tipo de Servicio" autocomplete="off" type="text" name="tipo_servicio" value="{{ old('tipo_servicio', $soporte->tipo_servicio ?? $soporte->tipo_servicio) }}">
@error('tipo_servicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>

                        </div>

                        <div class="row">
                          <p class=""><h5><center>Datos Equipo Afectado</center></h5></p>
                          <div class=" col-xs-12 col-md-4">
                                  <label for="placa">* Placa:</label>
                                  <input id="placa" class="form-control @error('placa') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="placa" value="{{ old('placa', $soporte->placa ?? $soporte->placa) }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="serial">* Serial Equipo:</label>
                                  <input id="serial_equipo" class="form-control @error('serial_equipo') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial_equipo" value="{{ old('serial_equipo', $soporte->serial_equipo ?? $soporte->serial_equipo) }}">
@error('serial_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="marca_equipo">* Marca Equipo:</label>
                                  <input id="marca_equipo" class="form-control @error('marca_equipo') is-invalid @enderror" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca_equipo" value="{{ old('marca_equipo', $soporte->marca_equipo ?? $soporte->marca_equipo) }}">
@error('marca_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="modelo_equipo">* Modelo Equipo:</label>
                                  <input id="modelo_equipo" class="form-control @error('modelo_equipo') is-invalid @enderror" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo_equipo" value="{{ old('modelo_equipo', $soporte->modelo_equipo ?? $soporte->modelo_equipo) }}">
@error('modelo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="sistema_operativo">* Sistema Operativo:</label>
                                  <input id="sistema_operativo" class="form-control @error('sistema_operativo') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo" value="{{ old('sistema_operativo', $soporte->sistema_operativo ?? $soporte->sistema_operativo) }}">
@error('sistema_operativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="antivirus">* Antivirus:</label>
                                  <input id="antivirus" class="form-control @error('antivirus') is-invalid @enderror" placeholder="Ingrese Tipo Antivirus" autocomplete="off" type="text" name="antivirus" value="{{ old('antivirus', $soporte->antivirus ?? $soporte->antivirus) }}">
@error('antivirus')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-2">
                                   <label for="ver_antivirus">* Versi&oacute;n Antivirus:</label>
                                  <input id="ver_antivirus" class="form-control @error('ver_antivirus') is-invalid @enderror" placeholder="Versi&oacute;n Antivirus" autocomplete="off" type="text" name="ver_antivirus" value="{{ old('ver_antivirus', $soporte->ver_antivirus ?? $soporte->ver_antivirus) }}">
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
                                                <label><input type="radio" id="cbox3" value="SI" name="elementos_de_soporte" @if ($soporte->elementos_de_soporte =="SI")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> SI</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-4 mt-3">
                                                <label><input type="radio" id="cbox3" value="NO" name="elementos_de_soporte" @if ($soporte->elementos_de_soporte =="NO")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> NO</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-4 mt-3">
                                                <label><input type="radio" id="cbox3" value="NO APLICA" name="elementos_de_soporte" @if ($soporte->elementos_de_soporte =="NO APLICA")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> NO APLICA</label>
                                            </div>
                                      </div>
                                    <HR>
                                    <div class="row">
                                            <div class="col-xs-6 col-sm-3 mt-2">
                                                <label><input type="radio" id="cbox3" value="CPU" name="tipo_elemento_de_soporte" @if ($soporte->tipo_elemento_de_soporte =="CPU")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > CPU</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input type="radio" id="cbox3" value="MONITOR" name="tipo_elemento_de_soporte" @if ($soporte->tipo_elemento_de_soporte =="MONITOR")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > MONITOR</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input type="radio" id="cbox3" value="TECLADO" name="tipo_elemento_de_soporte" @if ($soporte->tipo_elemento_de_soporte =="TECLADO")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > TECLADO</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input type="radio" id="cbox3" value="MOUSE" name="tipo_elemento_de_soporte" @if ($soporte->tipo_elemento_de_soporte =="MOUSE")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > MOUSE</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input type="radio" id="cbox3" value="SERVIDOR" name="tipo_elemento_de_soporte" @if ($soporte->tipo_elemento_de_soporte =="SERVIDOR")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > SERVIDOR</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input type="radio" id="cbox3" value="OTRO" name="tipo_elemento_de_soporte" @if ($soporte->elementos_de_soporte =="OTRO")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > OTRO</label>
                                            </div>
                                            <div class=" col-xs-12 col-md-6">
                                              <input id="elemeto_soporte" class="form-control @error('elemeto_soporte') is-invalid @enderror" placeholder="Registre Elemento Soporte" autocomplete="off" type="text" name="elemeto_soporte" value="{{ old('elemeto_soporte', $soporte->elemeto_soporte ?? $soporte->elemeto_soporte) }}">
@error('elemeto_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                             </div>
                                             <hr>
                                      </div>
                            </div>
                          <div class=" col-xs-12 col-md-4">
                                  <label for="placa_soporte">* Placa:</label>
                                  <input id="placa_soporte" class="form-control @error('placa_soporte') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="placa_soporte" value="{{ old('placa_soporte', $soporte->placa_soporte ?? $soporte->placa_soporte) }}">
@error('placa_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="serial">* Serial Equipo:</label>
                                  <input id="serial_equipo_soporte" class="form-control @error('serial_equipo_soporte') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial_equipo_soporte" value="{{ old('serial_equipo_soporte', $soporte->serial_equipo_soporte ?? $soporte->serial_equipo_soporte) }}">
@error('serial_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="marca_equipo">* Marca Equipo:</label>
                                  <input id="marca_equipo_soporte" class="form-control @error('marca_equipo_soporte') is-invalid @enderror" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca_equipo_soporte" value="{{ old('marca_equipo_soporte', $soporte->marca_equipo_soporte ?? $soporte->marca_equipo_soporte) }}">
@error('marca_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="modelo_equipo">* Modelo Equipo:</label>
                                  <input id="modelo_equipo_soporte" class="form-control @error('modelo_equipo_soporte') is-invalid @enderror" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo_equipo_soporte" value="{{ old('modelo_equipo_soporte', $soporte->modelo_equipo_soporte ?? $soporte->modelo_equipo_soporte) }}">
@error('modelo_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="sistema_operativo">* Sistema Operativo:</label>
                                  <input id="sistema_operativo_soporte" class="form-control @error('sistema_operativo_soporte') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo_soporte" value="{{ old('sistema_operativo_soporte', $soporte->sistema_operativo_soporte ?? $soporte->sistema_operativo_soporte) }}">
@error('sistema_operativo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="memoria">* Memoria:</label>
                                  <input id="memoria_soporte" class="form-control @error('memoria_soporte') is-invalid @enderror" placeholder="Cantidad Ram" autocomplete="off" type="text" name="memoria_soporte" value="{{ old('memoria_soporte', $soporte->memoria_soporte ?? $soporte->memoria_soporte) }}">
@error('memoria_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="disco_soporte">* Disco Duro:</label>
                                  <input id="disco_soporte" class="form-control @error('disco_soporte') is-invalid @enderror" placeholder="Disco Duro" autocomplete="off" type="text" name="disco_soporte" value="{{ old('disco_soporte', $soporte->disco_soporte ?? $soporte->disco_soporte) }}">
@error('disco_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="procesador_soporte">* Procesador:</label>
                                  <input id="procesador_soporte" class="form-control @error('procesador_soporte') is-invalid @enderror" placeholder="Procesador" autocomplete="off" type="text" name="procesador_soporte" value="{{ old('procesador_soporte', $soporte->procesador_soporte ?? $soporte->procesador_soporte) }}">
@error('procesador_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="tipo_equipo_soporte">* Tipo Equipo:</label>
                                  <input id="tipo_equipo_soporte" class="form-control @error('tipo_equipo_soporte') is-invalid @enderror" placeholder="Registre Tipo Equipo" autocomplete="off" type="text" name="tipo_equipo_soporte" value="{{ old('tipo_equipo_soporte', $soporte->tipo_equipo_soporte ?? $soporte->tipo_equipo_soporte) }}">
@error('tipo_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="nombre_equipo_soporte">* Nombre Equipo:</label>
                                  <input id="nombre_equipo_soporte" class="form-control @error('nombre_equipo_soporte') is-invalid @enderror" placeholder="Registre Nombre Equipo" autocomplete="off" type="text" name="nombre_equipo_soporte" value="{{ old('nombre_equipo_soporte', $soporte->nombre_equipo_soporte ?? $soporte->nombre_equipo_soporte) }}">
@error('nombre_equipo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>

                        </div>
                       <hr>
                       <div class="row">
                        <p class=""><h5><center>Descripci&oacute;n del Servicio</center></h5></p>
                        <label for="fecha">* Diagn&oacute;stico:</label>
                        <textarea id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n del Diagn&oacute;stico" min="1" autocomplete="off" name="diagnostico">{{ old('diagnostico', $soporte->diagnostico ?? $soporte->diagnostico) }}</textarea>
@error('diagnostico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        <label for="fecha">* Soluci&oacute;n:</label>
                        <textarea id="solucion" class="form-control @error('solucion') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n Soluci&oacute;n" min="1" autocomplete="off" name="solucion">{{ old('solucion', $soporte->solucion ?? $soporte->solucion) }}</textarea>
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
                            <textarea id="observacion_cliente" class="form-control @error('observacion_cliente') is-invalid @enderror" placeholder="Observaci&oacute;n" min="1" autocomplete="off" name="observacion_cliente">{{ old('observacion_cliente', $soporte->observacion_cliente ?? $soporte->observacion_cliente) }}</textarea>
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
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xs-12-col-sm-6">

                        </div>
                        <div class="col-xs-12-col-sm-6">
                            <p>Firmar a continuación:</p>
                            <canvas id="canvas" width="480em"></canvas>
                            <br>
                            <button id="btnLimpiar">Limpiar</button>
                            <button id="btnDescargar">Acepta Firma</button>
                            <button style="display: none" id="btnGenerarDocumento">Pasar a documento</button>
                            <br>
                        </div>
                        <input type="hidden" value="" id="firma" name="firma">
                      </div>

                         <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="bt_envio" type="submit" class="btn btn-primary" >
                                    REGISTRAR INFORMACI&Oacute;N
                                </button>
                            </div>
                        </div>
                    </form>

        </div>
    </div>
      </div>
    </div>

</div>


 </main>





<!-- REQUIRED JS SCRIPTS   onClick="this.disabled=true"-->

<!-- jQuery 3 -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
</script>
<script>

    const $canvas = document.querySelector("#canvas"),
        $btnDescargar = document.querySelector("#btnDescargar"),
        $btnLimpiar = document.querySelector("#btnLimpiar");
       // $btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");
    const contexto = $canvas.getContext("2d");
    const COLOR_PINCEL = "black";
    const COLOR_FONDO = "white";
    const GROSOR = 2;
    let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;
    const obtenerXReal = (clientX) => clientX - $canvas.getBoundingClientRect().left;
    const obtenerYReal = (clientY) => clientY - $canvas.getBoundingClientRect().top;
    let haComenzadoDibujo = false; // Bandera que indica si el usuario está presionando el botón del mouse sin soltarlo


    const limpiarCanvas = () => {
        // Colocar color blanco en fondo de canvas
        contexto.fillStyle = COLOR_FONDO;
        contexto.fillRect(0, 0, $canvas.width, $canvas.height);
    };
    limpiarCanvas();
    $btnLimpiar.onclick = limpiarCanvas;
    // Escuchar clic del botón para descargar el canvas
    $btnDescargar.onclick = () => {
        const enlace = document.createElement('a');
        // El título
        //enlace.download = "Firma.png";
        // Convertir la imagen a Base64 y ponerlo en el enlace
        enlace.href = $canvas.toDataURL();
        var firma = enlace.href = $canvas.toDataURL();

        document.getElementById('firma').value=firma
        console.log(firma)
        // Hacer click en él
        enlace.click();
    };

    window.obtenerImagen = () => {
        return $canvas.toDataURL();
    };

   /* $btnGenerarDocumento.onclick = () => {
        window.open("documento.html");
    };*/
    // Lo demás tiene que ver con pintar sobre el canvas en los eventos del mouse
    $canvas.addEventListener("mousedown", evento => {
        // En este evento solo se ha iniciado el clic, así que dibujamos un punto
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.fillStyle = COLOR_PINCEL;
        contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
        contexto.closePath();
        // Y establecemos la bandera
        haComenzadoDibujo = true;
    });

    $canvas.addEventListener("mousemove", (evento) => {
        if (!haComenzadoDibujo) {
            return;
        }
        // El mouse se está moviendo y el usuario está presionando el botón, así que dibujamos todo

        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.moveTo(xAnterior, yAnterior);
        contexto.lineTo(xActual, yActual);
        contexto.strokeStyle = COLOR_PINCEL;
        contexto.lineWidth = GROSOR;
        contexto.stroke();
        contexto.closePath();
    });
    ["mouseup", "mouseout"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, () => {
            haComenzadoDibujo = false;
        });
    });
    </script>

@stack('scripts')



</body>

</html>


