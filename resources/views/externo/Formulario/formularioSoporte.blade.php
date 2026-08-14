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

  	<style>
    :root {
      --primary: #0a2a4a;
      --primary-light: #0d3b66;
      --accent: #0088cc;
      --accent-hover: #006699;
      --surface: #ffffff;
      --surface-alt: #f8fafd;
      --border: #e2e8f0;
      --border-light: #edf2f7;
      --text: #1a202c;
      --text-soft: #4a5568;
      --text-muted: #718096;
      --success: #38a169;
      --warning: #d69e2e;
      --danger: #e53e3e;
      --shadow-sm: 0 1px 2px rgba(0,0,0,0.04);
      --shadow: 0 4px 12px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
      --shadow-md: 0 8px 24px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
      --shadow-lg: 0 16px 40px rgba(0,0,0,0.1), 0 4px 12px rgba(0,0,0,0.06);
      --radius-sm: 8px;
      --radius: 12px;
      --radius-lg: 16px;
      --transition: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * { box-sizing: border-box; }
    html { position: relative; min-height: 100%; }
    body {
      margin: 0; padding: 0 0 80px 0;
      font-family: 'Inter', 'Roboto', system-ui, -apple-system, sans-serif;
      background: linear-gradient(135deg, #f1f5f9 0%, #e9f0f8 100%);
      color: var(--text); line-height: 1.6; -webkit-font-smoothing: antialiased;
    }
    body::before {
      content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: radial-gradient(ellipse at 20% 50%, rgba(0,136,204,0.03) 0%, transparent 60%), radial-gradient(ellipse at 80% 20%, rgba(10,42,74,0.02) 0%, transparent 50%);
      pointer-events: none; z-index: 0;
    }
    main { position: relative; z-index: 1; padding: 24px 16px; }

    .corp-header {
      background: rgba(255,255,255,0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.6); box-shadow: var(--shadow-sm);
      padding: 20px 24px; display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 20px; border-radius: var(--radius-lg); margin-bottom: 28px; border: 1px solid var(--border-light);
    }
    .corp-header img { max-height: 60px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.06)); }
    .corp-header .header-text { text-align: right; }
    .corp-header .header-text p { margin: 0; font-size: 0.95rem; font-weight: 600; color: var(--primary); letter-spacing: 0.01em; }
    .corp-header .header-text small { font-size: 0.78rem; color: var(--text-muted); font-weight: 400; }

    .corp-card {
      background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);
      border: 1px solid var(--border-light); overflow: hidden; transition: all var(--transition);
    }
    .corp-card:hover { box-shadow: var(--shadow-lg); }
    .corp-card .card-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: #fff; padding: 22px 28px; position: relative; overflow: hidden; }
    .corp-card .card-header::after { content: ''; position: absolute; top: -50%; right: -20%; width: 200px; height: 200px; background: rgba(255,255,255,0.03); border-radius: 50%; }
    .corp-card .card-header h3 { margin: 0; font-size: 1.3rem; font-weight: 700; letter-spacing: 0.02em; position: relative; z-index: 1; }
    .card-body { padding: 28px; }

    .corp-fieldset {
      border: 1.5px solid var(--border); border-radius: var(--radius); padding: 24px 28px; margin-bottom: 32px;
      background: var(--surface-alt); box-shadow: inset 0 2px 6px rgba(0,0,0,0.02); transition: border-color var(--transition);
    }
    .corp-fieldset:hover { border-color: #cbd5e1; }
    legend.corp-section-title {
      font-size: 0.95rem; font-weight: 700; color: var(--primary); margin: 0; padding: 6px 16px;
      border: 1.5px solid var(--border); background: var(--surface); border-radius: 20px; display: inline-flex;
      align-items: center; gap: 8px; letter-spacing: 0.02em; box-shadow: var(--shadow-sm); width: auto;
    }
    legend.corp-section-title::before { content: ''; width: 6px; height: 6px; background: var(--accent); border-radius: 50%; }

    .form-label { font-weight: 600; font-size: 0.85rem; color: var(--text-soft); margin-bottom: 6px; display: inline-block; }
    .form-control {
      border: 1.5px solid var(--border); border-radius: var(--radius-sm); padding: 10px 14px; font-size: 0.92rem;
      transition: all var(--transition); background: var(--surface); color: var(--text); width: 100%; box-shadow: var(--shadow-sm);
    }
    .form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(0,136,204,0.1); background: #fff; }
    select.form-control { cursor: pointer; }
    textarea.form-control { resize: vertical; min-height: 100px; }
  </style>

<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<script src="{{ asset('toastr/toastr.min.js') }}"></script>

<!-- JavaScript -->

<!-- JavaScript -->


<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
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
<body>
  <main role="main" class="container">
    
    <!-- Header corporativo moderno -->
    <div class="corp-header">
      <img src="{{ asset('img/logoLargo.png') }}" alt="Logo" class="img-responsive">
      <div class="header-text">
        <p>Consejo Superior de la Judicatura<br>
        Dirección Seccional de Administración Judicial<br>
        Cali - Valle del Cauca
        </p>
        <small>"Fortaleciendo la justicia, promoviendo el bienestar de todos"</small>
      </div>
    </div>

<div class="container-fluid">
    <div class="corp-card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12" style="display:block">
             @include('alerts.flash-message')
             @include('../alerts.success')
                @include('../alerts.request')
                @if ($soporte->id)
			    <form id="validationForm" name="validationForm" action="{{ route('cerrar.soporte.servicio',$soporte->id) }}" method="POST">
    @csrf
    @method('PUT')
                @else

                <form action="{{ route('enviar.soporte.pdf.post') }}" method="POST">
    @csrf
                @endif
                <div class="card-header"><h3><center>FORMATO REPORTE DE DIAGNOSTICO ON SITE</center></h3></div>

                    <fieldset class="corp-fieldset">
                      <legend class="corp-section-title">Informaci&oacute;n del Servicio</legend>
                    <div class="row">
                    <div class='col-xs-12 col-sm-2'>
                    N&uacute;mero de Caso
                    </div>
                    <div class='col-xs-12 col-sm-4'>
                     <input id="num_caso" class="form-control has-success has-warning @error('num_caso') is-invalid @enderror" placeholder="Ingrese N&uacute;mero de Caso" autocomplete="off" type="text" name="num_caso" value="{{ old('num_caso', $soporte->num_caso ?? $soporte->num_caso) }}">
@error('num_caso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                    </div>
                    <div class='col-xs-12 col-sm-2'>
                        Estado Servicio
                    </div>
                    <div class=" col-xs-12 col-md-4">
                                  <select id="gestion" class="form-control @error('gestion') is-invalid @enderror" autocomplete="off" name="gestion">
    <option value="">Seleccione Gesti&oacute;n</option>
    @foreach($tipo_gestion as $key => $value)
        <option value="{{ $key }}" {{ old('gestion', $soporte->gestion) == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@error('gestion')
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

                                                <label><input class="form-check-input" type="radio" name="medio_solicitud" id="medio_solicitud_Llamada" value="Llamada"> Llamada</label>

                                                </div>

                                                <div class="col-xs-6 col-sm-3">

                                                    <label><input class="form-check-input" type="radio" name="medio_solicitud" id="medio_solicitud_Correo" value="Correo"> Correo</label>

                                                </div>
                                                <div class="col-xs-6 col-sm-3">

                                                    <label><input class="form-check-input" type="radio" name="medio_solicitud" id="medio_solicitud_Siris" value="Siris"> Siris</label>

                                                </div>
                                                <div class="col-xs-6 col-sm-3">

                                                    <label><input class="form-check-input" type="radio" name="medio_solicitud" id="medio_solicitud_Virtual" value="Virtual"> Virtual</label>

                                                </div>


                                        </div>

                                 </div>
                        </div>
                        
                        </fieldset>
                        
                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Datos de Usuario</legend>


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
                                  <input id="nombre" class="form-control input_nombre @error('nombre') is-invalid @enderror" pattern="[a-zA-Z\u00F1\u00D1\u00E0-\u00FC ]{2,254}" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" value="{{ old('nombre', $soporte->nombre ?? $soporte->nombre) }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                 <span id="message" style="background-color: Yellow; display:none ">
                                      
                                      Introduzca solo letras (A-Z) o (a-z).
                                  
                                 </span>
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="apellido">* APELLIDOS:</label>
                                  <input id="apellido" class="form-control input_apellido @error('apellido') is-invalid @enderror" pattern="[a-zA-Z\u00F1\u00D1\u00E0-\u00FC ]{2,254}" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido', $soporte->apellido ?? $soporte->apellido) }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </div>

                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-6">
                                   <label for="ciudad">* CIUDAD:</label>
                                  <select id="ciudad" class="form-control select-2 @error('ciudad') is-invalid @enderror" autocomplete="off" name="ciudad">
    <option value="">Seleccione Ciudad</option>
    @foreach($ciudades as $key => $value)
        <option value="{{ $key }}" {{ old('ciudad', $soporte->ciudad) == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-6">
                                  <label for="especialidad">* CARGO:</label>
                                  <input id="cargo" class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Cargo" autocomplete="off" type="text" name="cargo" value="{{ old('cargo', $soporte->cargo ?? $soporte->cargo) }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>

                                 <div class="col-xs-12 col-md-6 form-group ">
                                 <label for="telefono">* TEL&Eacute;FONO:</label>
                                  <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese No. Tel&eacute;fono" min="1" autocomplete="off" type="number" name="telefono" value="{{ old('telefono', $soporte->telefono ?? $soporte->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-6">
                                  <label for="correo_empleado">* CORREO EMPLEADO JUDICIAL:</label>
                                  <input id="correo_empleado" class="form-control @error('correo_empleado') is-invalid @enderror" placeholder="Ingrese Email Funcionario" autocomplete="off" type="email" name="correo_empleado" value="{{ old('correo_empleado', $soporte->correo_empleado ?? $soporte->correo_empleado) }}">
@error('correo_empleado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </div>
                        </fieldset>

                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Despacho:</legend>
                          <div class="row">
                          <div class=" col-xs-12 col-md-3">
                                  <label for="seccional">* SECCIONAL:</label>
                                  <input id="seccional" class="form-control @error('seccional') is-invalid @enderror" placeholder="Ingrese Seccional" autocomplete="off" type="text" name="seccional" value="{{ old('seccional', $soporte->seccional ?? $soporte->seccional) }}">
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-5">
                                   <label for="despacho">* DESPACHO:</label>
                                  <select id="despacho" class="form-control select2 @error('despacho') is-invalid @enderror" autocomplete="off" name="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" {{ old('despacho', $soporte->despacho) == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                 

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="direccion">* DIRECCI&Oacute;N:</label>
                                  <input id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingrese Direcci&oacute;n" autocomplete="off" type="text" name="direccion" value="{{ old('direccion', $soporte->direccion ?? $soporte->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                        </div>
                        
                        </fieldset>
                        
                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Falla Reportada</legend>
                          <div class="row">
                              <div class="col-xs-12">
                                  <textarea id="falla_reportada" class="form-control @error('falla_reportada') is-invalid @enderror" style="height: 6em" placeholder="Registre Falla Reportada" min="1" autocomplete="off" name="falla_reportada">{{ old('falla_reportada', $soporte->falla_reportada ?? $soporte->falla_reportada) }}</textarea>
@error('falla_reportada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                              </div>
                          </div>
                        </fieldset>

                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Ingeniero Asignado</legend>
                          <div class="row">
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
                                  <select id="tipo_servicio" class="form-control @error('tipo_servicio') is-invalid @enderror" autocomplete="off" name="tipo_servicio">
    <option value="">Seleccione Tipo Servicio</option>
    @foreach($tipo_servicio as $key => $value)
        <option value="{{ $key }}" {{ old('tipo_servicio', $soporte->tipo_servicio) == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_servicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>

                        </div>

                        </fieldset>

                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Datos Equipo Afectado</legend>
                          <div class="row">
                          <div class=" col-xs-12 col-md-4">
                                  <label for="placa">* Placa:</label>
                                  <input id="placa" class="form-control @error('placa') is-invalid @enderror" maxlength="27" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="placa" value="{{ old('placa', $soporte->placa ?? $soporte->placa) }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="serial">* Serial Equipo:</label>
                                  <input id="serial_equipo" class="form-control @error('serial_equipo') is-invalid @enderror" maxlength="47" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial_equipo" value="{{ old('serial_equipo', $soporte->serial_equipo ?? $soporte->serial_equipo) }}">
@error('serial_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="marca_equipo">* Marca Equipo:</label>
                                  <input id="marca_equipo" class="form-control @error('marca_equipo') is-invalid @enderror" maxlength="68" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca_equipo" value="{{ old('marca_equipo', $soporte->marca_equipo ?? $soporte->marca_equipo) }}">
@error('marca_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="modelo_equipo">* Modelo Equipo:</label>
                                  <input id="modelo_equipo" class="form-control @error('modelo_equipo') is-invalid @enderror" maxlength="48" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo_equipo" value="{{ old('modelo_equipo', $soporte->modelo_equipo ?? $soporte->modelo_equipo) }}">
@error('modelo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="sistema_operativo">* Sistema Operativo:</label>
                                  <input id="sistema_operativo" maxlength="28" class="form-control @error('sistema_operativo') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo" value="{{ old('sistema_operativo', $soporte->sistema_operativo ?? $soporte->sistema_operativo) }}">
@error('sistema_operativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="antivirus">* Antivirus:</label>
                                  <input id="antivirus" class="form-control @error('antivirus') is-invalid @enderror" maxlength="20" placeholder="Ingrese Tipo Antivirus" autocomplete="off" type="text" name="antivirus" value="{{ old('antivirus', $soporte->antivirus ?? $soporte->antivirus) }}">
@error('antivirus')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-2">
                                   <label for="ver_antivirus">* Versi&oacute;n Antivirus:</label>
                                  <input id="ver_antivirus" class="form-control @error('ver_antivirus') is-invalid @enderror" maxlength="6" placeholder="Versi&oacute;n Antivirus" autocomplete="off" type="text" name="ver_antivirus" value="{{ old('ver_antivirus', $soporte->ver_antivirus ?? $soporte->ver_antivirus) }}">
@error('ver_antivirus')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>

                        </div>
                        <div class="row">
                        
                            <div class=" col-xs-12 col-md-4">
                                       <label for="agente_ivanti">* Agente Ivanti:</label>
                                      <input id="agente_ivanti" class="form-control @error('agente_ivanti') is-invalid @enderror" placeholder="Agente Ivanti" autocomplete="off" type="text" name="agente_ivanti" value="{{ old('agente_ivanti', $soporte->agente_ivanti ?? $soporte->agente_ivanti) }}">
@error('agente_ivanti')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    
                                    </div>
                                    <div class=" col-xs-12 col-md-4">
                                       <label for="office">* Office 365:</label>
                                      <input id="office" class="form-control @error('office') is-invalid @enderror" placeholder="Office 365" autocomplete="off" type="text" name="office" value="{{ old('office', $soporte->office ?? $soporte->office) }}">
@error('office')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    
                                    </div>
                                    <div class=" col-xs-12 col-md-4">
                                       <label for="equipo_dominio">* Equipo en el Dominio:</label>
                                      <input id="equipo_dominio" class="form-control @error('equipo_dominio') is-invalid @enderror" placeholder="Equipo en el Dominio" autocomplete="off" type="text" name="equipo_dominio" value="{{ old('equipo_dominio', $soporte->equipo_dominio ?? $soporte->equipo_dominio) }}">
@error('equipo_dominio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                        </div>

                        </fieldset>

                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Elementos de Soporte</legend>
                          
                                  <div class="row" >
                                            <div class="col-xs-6 col-sm-4 mt-3">
                                                <label>
                                                    <input class="form-check-input" type="radio" id="cbox3" value="SI" name="elementos_de_soporte" onclick="requerid()" @if ($soporte->elementos_de_soporte =="SI")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> SI</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-4 mt-3">
                                                <label><input class="form-check-input" type="radio" id="cbox3" value="NO" name="elementos_de_soporte" onclick="no_requerid()"  @if ($soporte->elementos_de_soporte =="NO")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> NO</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-4 mt-3">
                                                <label><input class="form-check-input" type="radio" id="cbox3" value="NO_APLICA" name="elementos_de_soporte" onclick="no_requerid()" @if ($soporte->elementos_de_soporte =="NO_APLICA")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> NO APLICA</label>
                                            </div>
                                      </div>
                                    
                        <HR>
                        <div class="row"  id="id_elementos_de_soporte" >
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input class="form-check-input" type="radio" id="tipo_elemento_de_soporte" value="CPU" name="tipo_elemento_de_soporte" onclick="otro_tipo('CPU')" @if ($soporte->tipo_elemento_de_soporte =="CPU")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > CPU</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input class="form-check-input" type="radio" id="tipo_elemento_de_soporte" value="MONITOR" name="tipo_elemento_de_soporte" onclick="otro_tipo('MONITOR')" @if ($soporte->tipo_elemento_de_soporte =="MONITOR")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > MONITOR</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input class="form-check-input" type="radio" id="tipo_elemento_de_soporte" value="TECLADO" name="tipo_elemento_de_soporte" onclick="otro_tipo('TECLADO')" @if ($soporte->tipo_elemento_de_soporte =="TECLADO")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > TECLADO</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input class="form-check-input" type="radio" id="tipo_elemento_de_soporte" value="MOUSE" name="tipo_elemento_de_soporte" onclick="otro_tipo('MOUSE')" @if ($soporte->tipo_elemento_de_soporte =="MOUSE")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > MOUSE</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input class="form-check-input" type="radio" id="tipo_elemento_de_soporte" value="SERVIDOR" name="tipo_elemento_de_soporte" onclick="otro_tipo('SERVIDOR')" @if ($soporte->tipo_elemento_de_soporte =="SERVIDOR")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  > SERVIDOR</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 mt-3">
                                                <label><input class="form-check-input" type="radio" id="tipo_elemento_de_soporte" value="OTRO" name="tipo_elemento_de_soporte" onclick="otro_tipo('OTRO')" @if ($soporte->elementos_de_soporte =="OTRO")
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
                                <div class=" col-xs-12 col-md-4" id="oc_sistema_operativo_soporte">
                                   <label for="sistema_operativo">* Sistema Operativo:</label>
                                  <input id="sistema_operativo_soporte" class="form-control @error('sistema_operativo_soporte') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo_soporte" value="{{ old('sistema_operativo_soporte', $soporte->sistema_operativo_soporte ?? $soporte->sistema_operativo_soporte) }}">
@error('sistema_operativo_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4" id="oc_memoria_soporte">
                                   <label for="memoria">* Memoria:</label>
                                  <input id="memoria_soporte" class="form-control @error('memoria_soporte') is-invalid @enderror" placeholder="Cantidad Ram" autocomplete="off" type="text" name="memoria_soporte" value="{{ old('memoria_soporte', $soporte->memoria_soporte ?? $soporte->memoria_soporte) }}">
@error('memoria_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3" id="oc_disco_soporte">
                                   <label for="disco_soporte">* Disco Duro:</label>
                                  <input id="disco_soporte" class="form-control @error('disco_soporte') is-invalid @enderror" placeholder="Disco Duro" autocomplete="off" type="text" name="disco_soporte" value="{{ old('disco_soporte', $soporte->disco_soporte ?? $soporte->disco_soporte) }}">
@error('disco_soporte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3" id="oc_procesador_soporte">
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
                       
                        </fieldset>
                       
                        <fieldset class="corp-fieldset">
                          <legend class="corp-section-title">Requiere Repuesto</legend>
                          
                                  <div class="row" >
                                            <div class="col-xs-6 col-sm-6">
                                                <label>
                                                    <input class="form-check-input" type="radio" id="requiere_repuesto" value="SI" name="requiere_repuesto"  @if ($soporte->requiere_repuesto =="SI")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> SI</label>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 ">
                                                <label><input class="form-check-input" type="radio" id="requiere_repuesto" value="NO" name="requiere_repuesto"  @if ($soporte->requiere_repuesto =="NO")
                                                        @php
                                                            echo 'checked'
                                                        @endphp
                                                       @endif  required> NO</label>
                                            </div>
                                      </div>
                                    
                        </fieldset>
                        
                       <fieldset class="corp-fieldset">
                        <legend class="corp-section-title">Descripci&oacute;n del Servicio</legend>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="fecha">* Diagn&oacute;stico:</label>
                                <textarea id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n del Diagn&oacute;stico" min="1" autocomplete="off" name="diagnostico">{{ old('diagnostico', $soporte->diagnostico ?? $soporte->diagnostico) }}</textarea>
@error('diagnostico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="fecha">* Soluci&oacute;n:</label>
                                <textarea id="solucion" class="form-control @error('solucion') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n Soluci&oacute;n" min="1" autocomplete="off" name="solucion">{{ old('solucion', $soporte->solucion ?? $soporte->solucion) }}</textarea>
@error('solucion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                        </div>
                      </fieldset>
                      
                      <fieldset class="corp-fieldset">
                        <legend class="corp-section-title">Observaci&oacute;n Ingeniero</legend>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea id="observacion_tecnico" class="form-control @error('observacion_tecnico') is-invalid @enderror" style="height: 6em" placeholder="Observaci&oacute;n Ingeniero" min="1" autocomplete="off" name="observacion_tecnico">{{ old('observacion_tecnico', $soporte->observacion_tecnico ?? $soporte->observacion_tecnico) }}</textarea>
@error('observacion_tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </div>
                        </div>
                      </fieldset>
                      <hr>
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
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('gallery/galeria/light-gallery/js/lightgallery-all.js') }}"></script>

<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('gallery/galeria/image-gallery.js') }}"></script>
<!--<script src="/js/ingreso/contadorVisitas.js"></script>-->
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
</script>
<script>
       //EMPLEADO
     
    var verifCedula = document.getElementById('cedula');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            console.log(response[0].nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre').value = response[0].nameE;
                document.getElementById('apellido').value = response[0].lastnameE;
                document.getElementById('cargo').value = response[0].cargo_titular;
                
                document.getElementById('telefono').value = response[0].telefono;
                document.getElementById('direccion').value = response[0].direccion;
                
                document.getElementById('seccional').value = "CALI";
            } else {
                document.getElementById('nombre').value = "";
                document.getElementById('apellido').value = "";
                document.getElementById('cargo').value = "";
                document.getElementById('telefono').value = "";
                document.getElementById('direccion').value = "";
                document.getElementById('seccional').value = "";
            }
            
            let despachoId = response[0].cod_despacho;
            let despachoText = response[0].nombreDespacho ?? response[0].codigoDespacho?.nombreDespacho;
            
            if (despachoId && despachoText) {
                // Verificar si la opción ya existe para no duplicarla
                if ($('#despacho').find("option[value='" + despachoId + "']").length) {
                    $('#despacho').val(despachoId).trigger('change');
                } else {
                    let option = new Option(despachoText, despachoId, true, true);
                    $('#despacho').append(option).trigger('change');
                }
            } else {
                $('#despacho').val(despachoId).trigger('change');
            }
            
            $("#ciudad").val(response[0].nombreCiudad).trigger('change');
            
        });
    });
    
    
    
    //EQUIPO DE SOPORTE
    
     var verifPlaca = document.getElementById('placa');
    verifPlaca.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/inventario/" + this.value + "", function(response, juzgado) {

            console.log(response.serial)
           if (Object.keys(response).length > 0) {
                document.getElementById('serial_equipo').value = response.serial;
                document.getElementById('marca_equipo').value = response.marca;
                document.getElementById('modelo_equipo').value = response.modelo;
            } else {
                document.getElementById('serial_equipo').value = "";
                document.getElementById('marca_equipo').value = "";
                document.getElementById('modelo_equipo').value = "";
            }
          //  $("#despacho").val(response.cod_despacho);
            
            
        });
    });
    
  
    
    /*jQuery(document).ready(function() {
        jQuery('.input_apellido').keypress(function(tecla) {
        if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 'Alt'+165)) return false;
        });
    });*/
    
    $(".input_apellido").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
     $(".input_nombre").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
    //mostrar div
    function requerid() {
        document.getElementById("id_elementos_de_soporte").removeAttribute("display:none");
         $('#id_elementos_de_soporte').css('display', '');
         $('#id_elementos_de_soporte').css('visibility', 'visible');
         CPU_SERVIDOR();
  
        // Resetear, por si acaso has estado jugando con la otra propiedad
     // $('#id_elementos_de_soporte').css('visibility', 'visible');
       /*if( $('#id_elementos_de_soporte').css('visibility') != 'hidden' ) {
            $('id_elementos_de_soporte').css('visibility', 'visible');
          } else {
            $('#id_elementos_de_soporte').css('visibility', 'visible');
          }*/
        //PonerProp();
        
    };
    
    //mostrar div
    function no_requerid() {
          if( $('#id_elementos_de_soporte').is(":visible") ) {
            $('#id_elementos_de_soporte').css('display', 'none'); 
          } else {
            $('#id_elementos_de_soporte').css('display', 'none');
          }
          document.getElementById("elemeto_soporte").removeAttribute("required"); 
        quitarprovpropi();
        
    };
    
     //mostrar div
    function otro_tipo(e) {
        console.log(e)
        
        if(e == "OTRO"){
            if( $('#elemeto_soporte').is(":visible") ) {
            $('#elemeto_soporte').css('display', 'block'); 
          } else {
            $('#elemeto_soporte').css('display', 'block');
          }
            document.getElementById("elemeto_soporte").setAttribute("required",'True');
             CPU_SERVIDOR();
            $('#oc_sistema_operativo_soporte').css('display', '');
            $('#oc_memoria_soporte').css('display', '');
            $('#oc_disco_soporte').css('display', '');
            $('#oc_procesador_soporte').css('display', '');
        }else{
            
          document.getElementById("elemeto_soporte").removeAttribute("required"); 
          if( $('#elemeto_soporte').is(":visible") ) {
            $('#elemeto_soporte').css('display', 'none'); 
          } else {
            $('#elemeto_soporte').css('display', 'none');
          }
        }
        
        if(e == "CPU" || e == "SERVIDOR"){
            CPU_SERVIDOR();
            $('#oc_sistema_operativo_soporte').css('display', '');
            $('#oc_memoria_soporte').css('display', '');
            $('#oc_disco_soporte').css('display', '');
            $('#oc_procesador_soporte').css('display', '');
        }
        
        if(e == "MONITOR" || e == "TECLADO" || e == "MOUSE"){
            quitarprovpropi();
            $('#oc_sistema_operativo_soporte').css('display', 'none');
            $('#oc_memoria_soporte').css('display', 'none');
            $('#oc_disco_soporte').css('display', 'none');
            $('#oc_procesador_soporte').css('display', 'none');
            
            EQUIPOS_SIN_SO();
        }
        
        
        
        
    };
    
    
        //poner atributos
    function CPU_SERVIDOR(){
      document.getElementById("placa_soporte").setAttribute("required",'True');
        document.getElementById("serial_equipo_soporte").setAttribute("required",'True');
        document.getElementById("marca_equipo_soporte").setAttribute("required",'True');
        document.getElementById("modelo_equipo_soporte").setAttribute("required",'True');
        document.getElementById("sistema_operativo_soporte").setAttribute("required",'True');
        document.getElementById("memoria_soporte").setAttribute("required",'True');
        document.getElementById("disco_soporte").setAttribute("required",'True');
        document.getElementById("procesador_soporte").setAttribute("required",'True');
        document.getElementById("tipo_equipo_soporte").setAttribute("required",'True');
        document.getElementById("nombre_equipo_soporte").setAttribute("required",'True');
      
}
function EQUIPOS_SIN_SO(){
      document.getElementById("placa_soporte").setAttribute("required",'True');
        document.getElementById("serial_equipo_soporte").setAttribute("required",'True');
        document.getElementById("marca_equipo_soporte").setAttribute("required",'True');
        document.getElementById("modelo_equipo_soporte").setAttribute("required",'True');
        //document.getElementById("sistema_operativo_soporte").setAttribute("required",'True');
        //document.getElementById("memoria_soporte").setAttribute("required",'True');
        //document.getElementById("disco_soporte").setAttribute("required",'True');
        //document.getElementById("procesador_soporte").setAttribute("required",'True');
        document.getElementById("tipo_equipo_soporte").setAttribute("required",'True');
        document.getElementById("nombre_equipo_soporte").setAttribute("required",'True');
      
}

function quitarprovpropi(){
        document.getElementById("placa_soporte").removeAttribute("required");
        document.getElementById("serial_equipo_soporte").removeAttribute("required");
        document.getElementById("marca_equipo_soporte").removeAttribute("required");
        document.getElementById("modelo_equipo_soporte").removeAttribute("required");
        document.getElementById("sistema_operativo_soporte").removeAttribute("required");
        document.getElementById("memoria_soporte").removeAttribute("required");
        document.getElementById("disco_soporte").removeAttribute("required");
        document.getElementById("procesador_soporte").removeAttribute("required");
        document.getElementById("tipo_equipo_soporte").removeAttribute("required");
        document.getElementById("nombre_equipo_soporte").removeAttribute("required");
    }
    
    
    </script>

@stack('scripts')



</body>

</html>


