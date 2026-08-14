<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio teléfonico disajcali"/>
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <title>REGISTRO ASISTENCIA EVENTOS1</title>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="shortcut icon" href="{{asset('img/icono.png')}}">

  <!-- ESTILOS MODERNOS CORPORATIVOS 2026 -->
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

    * {
      box-sizing: border-box;
    }

    html {
      position: relative;
      min-height: 100%;
    }

    body {
      margin: 0;
      padding: 0 0 80px 0;
      font-family: 'Inter', 'Roboto', system-ui, -apple-system, sans-serif;
      background: linear-gradient(135deg, #f1f5f9 0%, #e9f0f8 100%);
      color: var(--text);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    /* Fondo con patrón sutil */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(ellipse at 20% 50%, rgba(0,136,204,0.03) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(10,42,74,0.02) 0%, transparent 50%);
      pointer-events: none;
      z-index: 0;
    }

    main {
      position: relative;
      z-index: 1;
      padding: 24px 16px;
    }

    /* Header con efecto glass */
    .corp-header {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.6);
      box-shadow: var(--shadow-sm);
      padding: 20px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
      border-radius: var(--radius-lg);
      margin-bottom: 28px;
      border: 1px solid var(--border-light);
    }

    .corp-header img {
      max-height: 60px;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.06));
    }

    .corp-header .header-text {
      text-align: right;
    }

    .corp-header .header-text p {
      margin: 0;
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--primary);
      letter-spacing: 0.01em;
    }

    .corp-header .header-text small {
      font-size: 0.78rem;
      color: var(--text-muted);
      font-weight: 400;
    }

    /* Card principal */
    .corp-card {
      background: var(--surface);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-md);
      border: 1px solid var(--border-light);
      overflow: hidden;
      transition: all var(--transition);
    }

    .corp-card:hover {
      box-shadow: var(--shadow-lg);
    }

    .corp-card .card-header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      color: #fff;
      padding: 22px 28px;
      position: relative;
      overflow: hidden;
    }

    .corp-card .card-header::after {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 200px;
      height: 200px;
      background: rgba(255,255,255,0.03);
      border-radius: 50%;
    }

    .corp-card .card-header h3 {
      margin: 0;
      font-size: 1.3rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      position: relative;
      z-index: 1;
    }

    .card-body {
      padding: 28px;
    }

    /* Secciones (Fieldsets elegantes) */
    .corp-fieldset {
      border: 1.5px solid var(--border);
      border-radius: var(--radius);
      padding: 24px 28px;
      margin-bottom: 32px;
      background: var(--surface-alt);
      box-shadow: inset 0 2px 6px rgba(0,0,0,0.02);
      transition: border-color var(--transition);
    }

    .corp-fieldset:hover {
      border-color: #cbd5e1;
    }

    legend.corp-section-title {
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--primary);
      margin: 0;
      padding: 6px 16px;
      border: 1.5px solid var(--border);
      background: var(--surface);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      letter-spacing: 0.02em;
      box-shadow: var(--shadow-sm);
      width: auto;
    }

    legend.corp-section-title::before {
      content: '';
      width: 6px;
      height: 6px;
      background: var(--accent);
      border-radius: 50%;
    }

    /* Form controls */
    .form-label {
      font-weight: 600;
      font-size: 0.85rem;
      color: var(--text-soft);
      margin-bottom: 6px;
      display: inline-block;
    }

    .form-control {
      border: 1.5px solid var(--border);
      border-radius: var(--radius-sm);
      padding: 10px 14px;
      font-size: 0.92rem;
      transition: all var(--transition);
      background: var(--surface);
      color: var(--text);
      width: 100%;
      box-shadow: var(--shadow-sm);
    }

    .form-control:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(0,136,204,0.1);
      background: #fff;
    }

    .form-control:valid:not(:placeholder-shown) {
      border-color: #86efac;
    }

    .form-control:invalid:not(:placeholder-shown):not(:focus) {
      border-color: #fca5a5;
    }

    select.form-control {
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234a5568' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      padding-right: 40px;
    }

    textarea.form-control {
      resize: vertical;
      min-height: 100px;
    }

    /* Radio y checkbox estilizados */
    .corp-radio-group {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .corp-radio-option {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border: 1.5px solid var(--border);
      border-radius: 24px;
      cursor: pointer;
      transition: all var(--transition);
      font-size: 0.9rem;
      font-weight: 500;
      background: var(--surface);
    }

    .corp-radio-option:hover {
      border-color: var(--accent);
      background: #f0f7ff;
    }

    .corp-radio-option input[type="radio"] {
      accent-color: var(--accent);
      margin: 0;
    }

    /* Tabla de rating */
    .rating-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-light);
    }

    .rating-table thead th {
      background: var(--primary);
      color: #fff;
      padding: 12px 10px;
      text-align: center;
      font-weight: 600;
      font-size: 0.8rem;
      letter-spacing: 0.03em;
    }

    .rating-table tbody tr {
      transition: background var(--transition);
    }

    .rating-table tbody tr:nth-child(odd) {
      background: #f8fafd;
    }

    .rating-table tbody tr:hover {
      background: #e8f0fb;
    }

    .rating-table td, .rating-table th[scope="row"] {
      padding: 12px 10px;
      border-bottom: 1px solid var(--border-light);
      text-align: center;
      vertical-align: middle;
    }

    .rating-table th[scope="row"] {
      text-align: left;
      font-weight: 500;
      color: var(--text);
    }

    /* Star radio */
    .star-radio {
      display: inline-flex;
    }

    .star-radio input[type="radio"] {
      opacity: 0;
      position: absolute;
      width: 0;
      height: 0;
    }

    .star-radio label {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 1.2rem;
      color: #cbd5e0;
      transition: all var(--transition);
      border-radius: 50%;
    }

    .star-radio input[type="radio"]:checked + label {
      color: #f59e0b;
      transform: scale(1.2);
      text-shadow: 0 0 8px rgba(245,158,11,0.4);
    }

    .star-radio label:hover {
      color: #f59e0b;
      background: rgba(245,158,11,0.1);
    }

    /* Signature */
    .signature-wrapper {
      border: 2px dashed var(--border);
      border-radius: var(--radius);
      padding: 24px;
      background: var(--surface-alt);
      transition: all var(--transition);
      text-align: center;
    }

    .signature-wrapper.has-sig {
      border-color: var(--success);
      background: #f0fdf4;
      border-style: solid;
    }

    .signature-tip {
      font-size: 0.82rem;
      color: var(--text-muted);
      margin-bottom: 12px;
    }

    #draw-canvas {
      display: block;
      width: 100%;
      max-width: 420px;
      height: 200px;
      border-radius: var(--radius-sm);
      border: 1.5px solid var(--border);
      background: #fff;
      touch-action: none;
      cursor: crosshair;
      margin: 0 auto;
      box-shadow: var(--shadow-sm);
    }

    .sig-actions {
      display: flex;
      gap: 12px;
      margin-top: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-save-sig {
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 24px;
      padding: 10px 24px;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all var(--transition);
      box-shadow: var(--shadow-sm);
    }

    .btn-save-sig:hover:not(:disabled) {
      background: var(--primary-light);
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    .btn-save-sig:disabled {
      background: var(--success);
      cursor: default;
    }

    .btn-clear-sig {
      background: transparent;
      color: var(--text-soft);
      border: 1.5px solid var(--border);
      border-radius: 24px;
      padding: 10px 20px;
      font-size: 0.88rem;
      font-weight: 500;
      cursor: pointer;
      transition: all var(--transition);
    }

    .btn-clear-sig:hover {
      border-color: var(--danger);
      color: var(--danger);
    }

    .sig-status {
      display: none;
      align-items: center;
      gap: 8px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--success);
      margin-top: 12px;
      justify-content: center;
    }

    .sig-status.visible {
      display: flex;
    }

    /* Botones */
    .btn-primary {
      background: var(--primary);
      color: #fff;
      border: none;
      padding: 12px 28px;
      border-radius: 24px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all var(--transition);
      box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
      background: var(--primary-light);
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .corp-header {
        flex-direction: column;
        align-items: flex-start;
      }
      .corp-header .header-text {
        text-align: left;
      }
      .card-body {
        padding: 20px 16px;
      }
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
  @stack('style')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
  <main role="main" class="container">
    
    <!-- Header corporativo moderno -->
    <div class="corp-header">
      <img src="{{ asset('img/logoLargo.png') }}" alt="Logo" class="img-responsive">
      <div class="header-text">
        <p>Consejo Superior de la Judicatura
        Dirección Seccional de Administración Judicial
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
              <form id="formulario_principal" action="{{ route('cerrar.soporte.servicio',$soporte->id) }}" method="POST">
                @csrf
                @method('PUT')
              @else
              <form id="formulario_principal" action="{{ route('enviar.soporte.pdf.post') }}" method="POST">
                @csrf
              @endif

                <div class="card-header">
                  <h3><center>FORMATO REPORTE DE DIAGNÓSTICO ON SITE</center></h3>
                </div>

                <!-- Información del Servicio -->
                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Información del Servicio</legend>
                <div class="row g-3">
                  <div class="col-md-2">
                    <label class="form-label">Número de Caso</label>
                    <input id="num_caso" class="form-control @error('num_caso') is-invalid @enderror" placeholder="Ingrese Número de Caso" type="text" name="num_caso" value="{{ old('num_caso', $soporte->num_caso ?? '') }}">
                    @error('num_caso')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Estado Servicio</label>
                    <select id="gestion" class="form-control" name="despacho">
                      <option value="">Seleccione Gestión</option>
                      @foreach($tipo_gestion as $key => $value)
                        <option value="{{ $key }}" {{ old('despacho', $soporte->gestion) == $key ? 'selected' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row g-3 mt-3">
                  <div class="col-md-3">
                    <label class="form-label">* Fecha Solicitud</label>
                    <input id="fecha_solicitud" class="form-control" type="date" name="fecha_solicitud" value="{{ old('fecha_solicitud', $soporte->fecha_solicitud ?? '') }}">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">* Hora Solicitud</label>
                    <input id="hora_solicitud" class="form-control" type="time" name="hora_solicitud" value="{{ old('hora_solicitud', $soporte->hora_solicitud ?? '') }}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">* Medio Solicitud</label>
                    <div class="corp-radio-group">
                      @foreach(['Llamada', 'Correo', 'Siris', 'Virtual'] as $medio)
                        <label class="corp-radio-option">
                          <input type="radio" name="medio_solicitud" value="{{ $medio }}" {{ ($soporte->medio_solicitud ?? '') == $medio ? 'checked' : '' }} required> {{ $medio }}
                        </label>
                      @endforeach
                    </div>
                  </div>
                </div>

                </fieldset>

                <!-- Datos de Usuario -->
                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Datos de Usuario</legend>
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">* IDENTIFICACIÓN</label>
                    <input id="cedula" class="form-control" type="number" name="cedula" value="{{ old('cedula', $soporte->cedula ?? '') }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">* NOMBRES</label>
                    <input id="nombre" class="form-control input_nombre" pattern="[a-zA-Z\u00F1\u00D1\u00E0-\u00FC ]{2,254}" type="text" name="nombre" value="{{ old('nombre', $soporte->nombre ?? '') }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">* APELLIDOS</label>
                    <input id="apellido" class="form-control input_apellido" pattern="[a-zA-Z\u00F1\u00D1\u00E0-\u00FC ]{2,254}" type="text" name="apellido" value="{{ old('apellido', $soporte->apellido ?? '') }}">
                  </div>
                </div>
                <div class="row g-3 mt-3">
                  <div class="col-md-4">
                    <label class="form-label">* CIUDAD</label>
                    <select id="ciudad" class="form-control select-2" name="ciudad">
                      <option value="">Seleccione Ciudad</option>
                      @foreach($ciudades as $key => $value)
                        <option value="{{ $key }}" {{ old('ciudad', $soporte->ciudad) == $key ? 'selected' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">* CARGO</label>
                    <input id="cargo" class="form-control" type="text" name="cargo" value="{{ old('cargo', $soporte->cargo ?? '') }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">* TELÉFONO</label>
                    <input id="telefono" class="form-control" type="number" name="telefono" value="{{ old('telefono', $soporte->telefono ?? '') }}">
                  </div>
                </div>

                </fieldset>

                <!-- Despacho -->
                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Despacho</legend>
                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label">* SECCIONAL</label>
                    <input id="seccional" class="form-control" type="text" name="seccional" value="{{ old('seccional', $soporte->seccional ?? '') }}">
                  </div>
                  <div class="col-md-5">
                    <label class="form-label">* DESPACHO</label>
                    <select id="despacho" class="form-control" name="despacho">
                      <option value="">Seleccione Despacho</option>
                      @foreach($despachos as $key => $value)
                        <option value="{{ $key }}" {{ old('despacho', $soporte->despacho_id) == $key ? 'selected' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">* DIRECCIÓN</label>
                    <input id="direccion" class="form-control" type="text" name="direccion" value="{{ old('direccion', $soporte->direccion ?? '') }}">
                  </div>
                </div>

                </fieldset>

                <!-- Falla Reportada -->
                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Falla Reportada</legend>
                <textarea id="falla_reportada" class="form-control" style="height:6em" name="falla_reportada">{{ old('falla_reportada', $soporte->falla_reportada ?? '') }}</textarea>

                </fieldset>

                <!-- Ingeniero Asignado -->
                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Ingeniero Asignado</legend>
                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label">* Fecha Atención</label>
                    <input id="fecha_atencion" class="form-control" type="date" name="fecha_atencion" value="{{ old('fecha_atencion', $soporte->fecha_atencion ?? '') }}">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">* Hora Atención</label>
                    <input id="hora_atencion" class="form-control" type="time" name="hora_atencion" value="{{ old('hora_atencion', $soporte->hora_atencion ?? '') }}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">* Nombre</label>
                    <input id="nombre_tecnico" class="form-control" type="text" name="nombre_tecnico" value="{{ old('nombre_tecnico', $soporte->nombre_tecnico ?? auth()->user()->name.' '.auth()->user()->lastname) }}">
                  </div>
                </div>
                <div class="mt-3">
                  <label class="form-label">* Tipo de Servicio</label>
                  <select id="tipo_servicio" class="form-control" name="tipo_servicio">
                    <option value="">Seleccione Tipo Servicio</option>
                    @foreach($tipo_servicio as $key => $value)
                      <option value="{{ $key }}" {{ old('tipo_servicio', $soporte->tipo_servicio) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
                </fieldset>

                <!-- ... (El resto del formulario se mantiene idéntico en estructura, solo se beneficia de los estilos globales) ... -->
                
                <!-- Descripción del Servicio -->
                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Descripción del Servicio</legend>
                <label class="form-label">* Diagnóstico</label>
                <textarea id="diagnostico" class="form-control" name="diagnostico" required>{{ old('diagnostico', $soporte->diagnostico ?? '') }}</textarea>
                <label class="form-label mt-3">* Solución</label>
                <textarea id="solucion" class="form-control" name="solucion" required>{{ old('solucion', $soporte->solucion ?? '') }}</textarea>

                <!-- Observaciones y Calificación -->
                </fieldset>

                <fieldset class="corp-fieldset">
                  <legend class="corp-section-title">Observación Cliente</legend>
                <p style="font-size:0.9rem; color:var(--text-soft);">Por favor, seleccione de 1 a 5 estrellas según su satisfacción.</p>
                <div class="row">
                  <div class="col-md-6">
                    <textarea id="observacion_cliente" class="form-control" name="observacion_cliente" style="height: 100%; min-height: 150px;">{{ old('observacion_cliente', $soporte->observacion_cliente ?? '') }}</textarea>
                  </div>
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="rating-table">
                        <thead>
                          <tr>
                            <th style="min-width:160px;">Aspecto evaluado</th>
                            <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach(['disposicion' => 'Disposición del ingeniero', 'conocimiento_tec' => 'Conocimiento técnico', 'tiempo_aten' => 'Tiempo de atención', 'avance_caso' => 'Avance del caso'] as $name => $label)
                          <tr>
                            <th scope="row">{{ $label }}</th>
                            @for($i=1;$i<=5;$i++)
                            <td>
                              <div class="star-radio">
                                <input type="radio" name="{{ $name }}" id="{{ $name }}_{{ $i }}" value="{{ $i }}">
                                <label for="{{ $name }}_{{ $i }}" title="{{ $i }}">★</label>
                              </div>
                            </td>
                            @endfor
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- Firma -->
                </fieldset>

                <fieldset class="corp-fieldset" style="margin-bottom: 0;">
                  <legend class="corp-section-title">Firma de Aceptación</legend>
                <div class="signature-wrapper" id="sig-wrapper">
                  <p class="signature-tip">✏️ Firme en el recuadro — funciona con dedo o mouse</p>
                  <canvas id="draw-canvas" width="420" height="200"></canvas>
                  <div class="sig-actions">
                    <button type="button" id="draw-submitBtn" class="btn-save-sig">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                      Guardar firma
                    </button>
                    <button type="button" id="draw-clearBtn" class="btn-clear-sig">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.6"/></svg>
                      Volver a firmar
                    </button>
                  </div>
                  <div class="sig-status" id="sig-status">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Firma guardada correctamente
                  </div>
                </div>
                <input type='hidden' name='firma' id='imagen' value="" required />

                <div class="form-group row mb-0" style="display:none;">
                  <div class="col-md-6 offset-md-4">
                    <button id="bt_envio" type="submit" class="btn-primary">REGISTRAR INFORMACIÓN</button>
                  </div>
                </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Scripts originales (se mantienen intactos) -->
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
    $(function () {
      $('.select2').select2();
    });
  </script>

  <!-- Script de firma (idéntico al original) -->
  <script>
  (function () {
    var canvas    = document.getElementById('draw-canvas');
    var ctx       = canvas.getContext('2d');
    var wrapper   = document.getElementById('sig-wrapper');
    var clearBtn  = document.getElementById('draw-clearBtn');
    var submitBtn = document.getElementById('draw-submitBtn');
    var sigStatus = document.getElementById('sig-status');
    var imagenInput = document.getElementById('imagen');
    var btnEnvio  = document.getElementById('bt_envio');
    var mainForm  = document.getElementById('formulario_principal');

    // Mantener la sesión activa para evitar el error 419 (Page Expired)
    setInterval(function() {
      fetch(window.location.href, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-store' });
    }, 15 * 60 * 1000); // 15 minutos

    var drawing  = false;
    var lastPos  = { x: 0, y: 0 };
    var mousePos = { x: 0, y: 0 };

    window.requestAnimFrame = (function () {
      return window.requestAnimationFrame ||
             window.webkitRequestAnimationFrame ||
             window.mozRequestAnimationFrame ||
             function (cb) { window.setTimeout(cb, 1000 / 60); };
    })();

    function getPos(canvasDom, clientX, clientY) {
      var rect = canvasDom.getBoundingClientRect();
      var scaleX = canvasDom.width  / rect.width;
      var scaleY = canvasDom.height / rect.height;
      return {
        x: (clientX - rect.left) * scaleX,
        y: (clientY - rect.top)  * scaleY
      };
    }

    canvas.addEventListener('mousedown', function (e) {
      drawing = true;
      lastPos = getPos(canvas, e.clientX, e.clientY);
    });
    canvas.addEventListener('mouseup',   function () { drawing = false; });
    canvas.addEventListener('mouseleave',function () { drawing = false; });
    canvas.addEventListener('mousemove', function (e) {
      mousePos = getPos(canvas, e.clientX, e.clientY);
    });

    canvas.addEventListener('touchstart', function (e) {
      e.preventDefault();
      var t = e.touches[0];
      drawing = true;
      lastPos = getPos(canvas, t.clientX, t.clientY);
      mousePos = lastPos;
    }, { passive: false });
    canvas.addEventListener('touchend', function (e) { e.preventDefault(); drawing = false; }, { passive: false });
    canvas.addEventListener('touchcancel', function (e) { e.preventDefault(); drawing = false; }, { passive: false });
    canvas.addEventListener('touchmove', function (e) {
      e.preventDefault();
      var t = e.touches[0];
      mousePos = getPos(canvas, t.clientX, t.clientY);
    }, { passive: false });

    function renderCanvas() {
      if (drawing) {
        ctx.strokeStyle = '#111';
        ctx.lineWidth   = 2.5;
        ctx.lineCap     = 'round';
        ctx.lineJoin    = 'round';
        ctx.beginPath();
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
        ctx.closePath();
        lastPos = mousePos;
      }
    }

    function clearCanvas() { ctx.clearRect(0, 0, canvas.width, canvas.height); }
    function isCanvasBlank() {
      var blank = document.createElement('canvas');
      blank.width  = canvas.width;
      blank.height = canvas.height;
      return canvas.toDataURL() === blank.toDataURL();
    }

    (function loop() {
      requestAnimFrame(loop);
      renderCanvas();
    })();

    clearBtn.addEventListener('click', function () {
      clearCanvas();
      imagenInput.value = '';
      wrapper.classList.remove('has-sig');
      sigStatus.classList.remove('visible');
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Guardar firma';
    });

    submitBtn.addEventListener('click', function () {
      $(mainForm).find('input, select, textarea').each(function() {
        if ($(this).prop('required') && !$(this).is(':visible')) {
          $(this).removeAttr('required').attr('data-hidden-req', 'true');
        } else if ($(this).attr('data-hidden-req') === 'true' && $(this).is(':visible')) {
          $(this).prop('required', true).removeAttr('data-hidden-req');
        }
      });

      var disposicion    = document.querySelector('input[name="disposicion"]:checked');
      var conocimiento   = document.querySelector('input[name="conocimiento_tec"]:checked');
      var tiempo         = document.querySelector('input[name="tiempo_aten"]:checked');
      var avance         = document.querySelector('input[name="avance_caso"]:checked');

      if (!disposicion || !conocimiento || !tiempo || !avance) {
        Swal.fire({ title: 'Calificación incompleta', text: 'Debe calificar todos los aspectos del servicio.', icon: 'warning', confirmButtonColor: '#0a2a4a' });
        return;
      }

      if (!mainForm.reportValidity()) {
        $(mainForm).find('[data-hidden-req="true"]').prop('required', true).removeAttr('data-hidden-req');
        return;
      }
      
      if (isCanvasBlank()) {
        Swal.fire({ title: 'Firma vacía', text: 'Por favor realice su firma.', icon: 'warning', confirmButtonColor: '#0a2a4a' });
        return;
      }
      
      Swal.fire({
        title: '¿Está seguro?',
        html: 'Una vez guardada la firma, <strong>no podrá modificarla</strong>.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0a2a4a',
        cancelButtonColor: '#e53e3e',
        confirmButtonText: 'Sí, registrar',
        cancelButtonText: 'Cancelar'
      }).then(function (result) {
        if (result.isConfirmed) {
          imagenInput.value = canvas.toDataURL();
          wrapper.classList.add('has-sig');
          sigStatus.classList.add('visible');
          submitBtn.disabled = true;
          submitBtn.innerHTML = 'Procesando...';
          
          fetch(window.location.href, { method: 'GET', cache: 'no-store', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => {
              if (res.status === 401 || res.status === 419) throw new Error('Sesión expirada');
              return res.text();
            })
            .then(html => {
              var doc = new DOMParser().parseFromString(html, 'text/html');
              if (doc.querySelector('form[action*="login"]')) throw new Error('Sesión expirada');
              var newToken = doc.querySelector('meta[name="csrf-token"]');
              if (newToken) {
                var csrfInput = mainForm.querySelector('input[name="_token"]');
                if (csrfInput) csrfInput.value = newToken.content;
              }
              mainForm.submit();
            })
            .catch(err => {
              if(err.message === 'Sesión expirada') {
                 Swal.fire({ title: 'Sesión expirada', text: 'Su sesión ha expirado por inactividad. Por favor, recargue la página o inicie sesión nuevamente.', icon: 'error', confirmButtonColor: '#0a2a4a' });
                 submitBtn.disabled = false;
                 submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Guardar firma';
                 wrapper.classList.remove('has-sig');
                 sigStatus.classList.remove('visible');
              } else {
                 mainForm.submit(); 
              }
            });
        }
      });
    });

    mainForm.addEventListener('submit', function (e) {
      if (isCanvasBlank() || !imagenInput.value) {
        e.preventDefault(); 
        Swal.fire({ title: 'Firma requerida', text: 'Firme y pulse "Guardar firma".', icon: 'error', confirmButtonColor: '#0a2a4a' });
        return false;
      }
      let disp = document.querySelector('input[name="disposicion"]:checked');
      let cono = document.querySelector('input[name="conocimiento_tec"]:checked');
      let tiem = document.querySelector('input[name="tiempo_aten"]:checked');
      let avan = document.querySelector('input[name="avance_caso"]:checked');
      if (!disp || !cono || !tiem || !avan) {
        e.preventDefault();
        Swal.fire({ title: 'Calificación incompleta', text: 'Califique todos los aspectos.', icon: 'warning', confirmButtonColor: '#0a2a4a' });
        return false;
      }
      if (btnEnvio.disabled) { e.preventDefault(); return false; }
      btnEnvio.disabled = true;
      btnEnvio.innerHTML = 'Procesando...';
    });
  })();
  </script>

  <!-- Scripts de consulta (idénticos) -->
  <script>
    var verifCedula = document.getElementById('cedula');
    verifCedula.addEventListener('input', function() {
      $.get("{{ url('/tecnico/soporte/consulta/cedula/corte') }}/" + this.value, function(response) {
        if (response && response.length > 0) {
          document.getElementById('nombre').value = response[0].nameE || "";
          document.getElementById('apellido').value = response[0].lastnameE || "";
          document.getElementById('cargo').value = response[0].cargo_titular || "";
          document.getElementById('telefono').value = response[0].telefono || "";
          document.getElementById('direccion').value = response[0].direccion || "";
          document.getElementById('seccional').value = "CALI";
          $("#despacho").val(response[0].cod_despacho || "");
          $("#ciudad").val(response[0].nombreCiudad || "");
        } else {
          document.getElementById('nombre').value = "";
          document.getElementById('apellido').value = "";
          document.getElementById('cargo').value = "";
          document.getElementById('telefono').value = "";
          document.getElementById('direccion').value = "";
          document.getElementById('seccional').value = "";
          $("#despacho").val("");
          $("#ciudad").val("");
        }
      }).fail(function() {
        document.getElementById('nombre').value = "";
        document.getElementById('apellido').value = "";
      });
    });

    var verifPlaca = document.getElementById('placa');
    verifPlaca.addEventListener('input', function() {
      $.get("{{ url('/tecnico/soporte/consulta/inventario') }}/" + this.value, function(response) {
        if (response && Object.keys(response).length > 0 && response.serial) {
          document.getElementById('serial_equipo').value = response.serial || "";
          document.getElementById('marca_equipo').value = response.marca || "";
          document.getElementById('modelo_equipo').value = response.modelo || "";
        } else {
          document.getElementById('serial_equipo').value = "";
          document.getElementById('marca_equipo').value = "";
          document.getElementById('modelo_equipo').value = "";
        }
      });
    });

    $(".input_apellido, .input_nombre").on("keypress", function(event){
      if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
        return false;
      }
    });

    function requerid() {
      $('#id_elementos_de_soporte').show();
      CPU_SERVIDOR();
    }
    function no_requerid() {
      $('#id_elementos_de_soporte').hide();
      document.getElementById("elemeto_soporte").removeAttribute("required"); 
      quitarprovpropi();
    }
    function otro_tipo(e) {
      if(e == "OTRO"){
        $('#elemeto_soporte').closest('.col-xs-12').show();
        document.getElementById("elemeto_soporte").setAttribute("required",'True');
        CPU_SERVIDOR();
        $('#oc_sistema_operativo_soporte').show();
        $('#oc_memoria_soporte').show();
        $('#oc_disco_soporte').show();
        $('#oc_procesador_soporte').show();
      } else {
        document.getElementById("elemeto_soporte").removeAttribute("required"); 
        $('#elemeto_soporte').closest('.col-xs-12').hide();
      }
      if(e == "CPU" || e == "SERVIDOR"){
        CPU_SERVIDOR();
        $('#oc_sistema_operativo_soporte').show();
        $('#oc_memoria_soporte').show();
        $('#oc_disco_soporte').show();
        $('#oc_procesador_soporte').show();
      }
      if(e == "MONITOR" || e == "TECLADO" || e == "MOUSE"){
        quitarprovpropi();
        $('#oc_sistema_operativo_soporte').hide();
        $('#oc_memoria_soporte').hide();
        $('#oc_disco_soporte').hide();
        $('#oc_procesador_soporte').hide();
        EQUIPOS_SIN_SO();
      }
    }
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
</body>
</html>