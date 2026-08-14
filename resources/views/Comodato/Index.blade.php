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
  <title>ACTA DE INSTALACION</title>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style type="text/css">
/*@media screen and (min-width: 600px) {
    .ocultar-div{
        visibility:hidden;
    }
}*/
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

#canvas{
            border:1px solid #000000;
            width: 100%;
            height: 100%; 
            background-color: #f8f7f7;
        }
        
.div-tabla{
    border-color: #aaaaaa;
   border-width: 1px;
   border-style: solid;
}
</style>

<style>
/*Mostraremos los campos requeridos de color amarillo*/
    form input:required {
       border:2px solid  salmon;
    /* otras propiedades */
    }
    /*Si el valor que el usuario escribe es valido, obtendra un color verde*/
    form input:valid{
        border:2px solid #AAF97D;
        /* otras propiedades */
    }
    /*caso contrario, el color sera rojo*/
    form input:focus:invalid{
        border:2px solid red;
        /* otras propiedades */
    }
    
    form select:required {
       border:2px solid  salmon;
    /* otras propiedades */
    }
    /*Si el valor que el usuario escribe es valido, obtendra un color verde*/
    form select:valid{
        border:2px solid #AAF97D;
        /* otras propiedades */
    }
    /*caso contrario, el color sera rojo*/
    form select:focus:invalid{
        border:2px solid  red;
        /* otras propiedades */
    }
    form textarea:required {
       border:2px solid  salmon;
    /* otras propiedades */
    }
    /*Si el valor que el usuario escribe es valido, obtendra un color verde*/
    form textarea:valid{
        border:2px solid #AAF97D;
        /* otras propiedades */
    }
    /*caso contrario, el color sera rojo*/
    form textarea:focus:invalid{
        border:2px solid  salmon;
        /* otras propiedades */
    }
</style>
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
         <!-- Cali - Valle del Cauca1-->
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
			    <form action="{{ route('tecnico.firma.comodato.impresora.store',$soporte->id) }}" method="POST">
    @csrf
    @method('PUT')
                @else

                <form action="{{ route('tecnico.firma.comodato.impresora.store') }}" method="POST">
    @csrf
                @endif
                <div class="card-header"><h3><center>ACTA DE INSTALACION<br>
                                                    CONTRATO DE COMODATO DE IMPRESORAS 001 DE 2023
                                            </center>
                                        </h3>
                </div>

                    <div class="row">
                        <p class=""><h5><center>Informaci&oacute;n del Servicio</center></h5></p>
                        <hr>
                    </div>
                    <div class="row">
                    <div class='col-xs-12 col-sm-2'>
                        Fecha Instalaci&oacute;n:
                    </div>
                    <div class='col-xs-12 col-sm-4'>
                     <input id="fecha_instalacion" class="form-control has-success has-warning @error('fecha_instalacion') is-invalid @enderror" placeholder="Ingrese N&uacute;mero de Caso" autocomplete="off" type="date" name="fecha_instalacion" value="{{ old('fecha_instalacion', $soporte->fecha_instalacion ?? $soporte->fecha_instalacion) }}">
@error('fecha_instalacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                    </div>
                    </div>
                        
                        <div class="row">
                          <p class=""><h5><center>Datos del Despacho</center></h5></p>
                          <hr>
                        </div>


                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* IDENTIFICACION:</label>
                                  <input id="numero_cedula" class="form-control @error('numero_cedula') is-invalid @enderror" placeholder="Ingrese No. Identificaci&oacute;n" min="1" autocomplete="off" type="number" name="numero_cedula" value="{{ old('numero_cedula', $soporte->numero_cedula ?? $soporte-> numero_cedula) }}">
@error('numero_cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="especialidad">* NOMBRE CONTACTO:</label>
                                  <input id="nombre_contacto" class="form-control input_nombre @error('nombre_contacto') is-invalid @enderror" pattern="[a-zA-Z\u00F1\u00D1\u00E0-\u00FC ]{2,254}" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre_contacto" value="{{ old('nombre_contacto', $soporte->nombre_contacto ?? $soporte->nombre_contacto) }}">
@error('nombre_contacto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                 <span id="message" style="background-color: Yellow; display:none ">
                                      
                                      Introduzca solo letras (A-Z) o (a-z).
                                  
                                 </span>
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="seccional">* SECCIONAL:</label>
                                  <input id="seccional" class="form-control input_apellido @error('seccional') is-invalid @enderror" placeholder="Ingrese Seccional" autocomplete="off" type="text" name="seccional" value="{{ old('seccional', $soporte->seccional ?? $soporte->seccional) }}">
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </div>

                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                   <label for="ciudad">* CIUDAD:</label>
                                  <select id="ciudad" class="form-control select-2 @error('ciudad') is-invalid @enderror" autocomplete="off" name="ciudad">
    <option value="">Seleccione Ciudad</option>
    @foreach($ciudades as $key => $value)
        <option value="{{ $key }}" @selected(old('ciudad', $soporte->ciudad) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('ciudad')
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

                                 <div class="col-xs-12 col-md-4 form-group ">
                                 <label for="telefono">* TEL&Eacute;FONO:</label>
                                  <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese No. Tel&eacute;fono" min="1" autocomplete="off" type="text" name="telefono" value="{{ old('telefono', $soporte->telefono ?? $soporte->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-6">
                                  <label for="email">* CORREO:</label>
                                  <input id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ingrese Correo" autocomplete="off" type="text" name="email" value="{{ old('email', $soporte->email ?? $soporte->email) }}">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-6">
                                   <label for="despacho">* DESPACHO:</label>
                                  <select id="despacho" class="form-control  @error('despacho') is-invalid @enderror" autocomplete="off" name="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho', $soporte->despacho_id) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </div>

                        <div class="row">
                          <p class=""><h5><center>Datos Equipo Instalado</center></h5></p>
                          <div class=" col-xs-12 col-md-1">
                                  <label for="num_caja">*Num Caja:</label>
                                  <input id="num_caja" class="form-control @error('num_caja') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="num_caja" value="{{ old('num_caja', $soporte->num_caja ?? $soporte->num_caja) }}">
@error('num_caja')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                            <div class=" col-xs-12 col-md-3">
                                  <label for="placa">* Placa:</label>
                                  <input id="placa_equipo" class="form-control @error('placa_equipo') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="placa_equipo" value="{{ old('placa_equipo', $soporte->placa_equipo ?? $soporte->placa_equipo) }}">
@error('placa_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                          
                           <div class=" col-xs-12 col-md-4">
                                   <label for="serial">* Serial Equipo:</label>
                                  <input id="serial" class="form-control @error('serial') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial" value="{{ old('serial', $soporte->serial ?? $soporte->serial) }}">
@error('serial')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                               
                                <div class=" col-xs-12 col-md-4">
                                   <label for="marca_equipo">* Marca Equipo:</label>
                                  <input id="marca" class="form-control @error('marca') is-invalid @enderror" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca" value="{{ old('marca', $soporte->marca ?? $soporte->marca) }}">
@error('marca')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="modelo_equipo">* Modelo Equipo:</label>
                                  <input id="modelo" class="form-control @error('modelo') is-invalid @enderror" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo" value="{{ old('modelo', $soporte->modelo ?? $soporte->modelo) }}">
@error('modelo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="tipo_instalacion">* Tipo Instalaci&oacute;n:</label>
                                  <select id="tipo_instalacion" class="form-control @error('tipo_instalacion') is-invalid @enderror" autocomplete="off" name="tipo_instalacion">
    <option value="">Seleccione Tipo Instalacion</option>
    @foreach($tipoInstalacion as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_instalacion', $soporte->tipo_instalacion) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_instalacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                 <div class=" col-xs-12 col-md-4" style="display:none" id="form_ip">
                                   <label for="ip">* Ip Impresora:</label>
                                   <input class="form-control @error('ip') is-invalid @enderror" placeholder="Registrar Ip Impresora" autocomplete="off" id="ip" type="text" name="ip" value="{{ old('ip', $soporte->ip ?? '') }}">
@error('ip')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                

                        </div>
                       <hr>
                       <div class="row">
                        <p class=""><h5><center>Descripci&oacute;n del Servicio</center></h5></p>
                        <textarea id="descripcion_servicio" class="form-control @error('descripcion_servicio') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n del Diagn&oacute;stico" min="1" autocomplete="off" name="descripcion_servicio">{{ old('descripcion_servicio', $soporte->descripcion_servicio ?? 'La instalación de la impresora en el despacho se lleva a cabo de acuerdo con la distribución establecida por el Supervisor del Contrato.') }}</textarea>
@error('descripcion_servicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                      </div>
                      <div class="row">
                        <p class=""><h5><center>Observaciones</center></h5></p>
                         <textarea id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" style="height: 6em" placeholder="Observaci&oacute;n Ingeniero" min="1" autocomplete="off" name="observaciones">{{ old('observaciones', $soporte->observaciones ?? $soporte->observaciones) }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                        </div>
                      
                      </div>
                      <hr>
                      
                      </div>
                      <hr>
                         <div class="row">   
                            <div class="form-group col-xs-12  col-sm-6 " >
                                <label for="firma">Firma Aceptacion Ingreso:</label>
                                <div id="div" autofocus>
                                <canvas id="draw-canvas" width="359" height="359" style='border: 1px solid #CCC;' >Su navegador no soporta canvas :( </canvas>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12  col-sm-6 " id="oculto-guardar" style="display: block;" >
                                        <button class="btn btn-danger btn-guardar btn-sm pull-left " type='button' id="draw-submitBtn" style="display: block;" title="Guarde la firma para poder almacenar el comprobante">Firmar Documento</button>
                                    </div>
                                    <div class="form-group col-xs-12  col-sm-6 " id="muestro-guardar" style="display: block;">
                                        <button class="btn btn-dark  btn-sm " id="draw-clearBtn" type='button' >Volver a Firmar</button>
                                    </div>
                                </div>
                                <input type='hidden' name='firma' id='imagen' value="" required />
                            </div>   
                            <div class="form-group col-xs-12  col-sm-6">
                                 
                            </div>
                        
                            
                        </div>
                       
                            <br>
                        </div>
                        <!--input type="hidden" value="" id="firma" name="firma"-->
                         <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="bt_envio" type="submit" class="btn btn-primary btn-block" >
                                    REGISTRAR INFORMACI&Oacute;N
                                </button>
                            </div>
                        </div>
                        <br><br><br>
                    </form>

        </div>
    </div>
      </div>
    </div>

</div>





<script src="js/jquery-3.2.1.min.js"></script>
<script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
</script>
<script>
     /*
          El siguiente codigo en JS Contiene mucho codigo
          de las siguietes 3 fuentes:
          https://stipaltamar.github.io/dibujoCanvas/
          https://developer.mozilla.org/samples/domref/touchevents.html - https://developer.mozilla.org/es/docs/DOM/Touch_events
          http://bencentra.com/canvas/signature/signature.html - https://bencentra.com/code/2014/12/05/html5-canvas-touch-events.html
  */
  
  (function() { // Comenzamos una funcion auto-ejecutable
  
  // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
  window.requestAnimFrame = (function (callback) {
    return window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.oRequestAnimationFrame ||
          window.msRequestAnimaitonFrame ||
          function (callback) {
             window.setTimeout(callback, 1000/60);
            // Retrasa la ejecucion de la funcion para mejorar la experiencia
          };
  })();
  
  // Traemos el canvas mediante el id del elemento html
  var canvas = document.getElementById("draw-canvas");
  var ctx = canvas.getContext("2d");
  
  
  // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
  var drawText = document.getElementById("draw-dataUrl");
  var drawImage = document.getElementById("draw-image");
  var clearBtn = document.getElementById("draw-clearBtn");
  var submitBtn = document.getElementById("draw-submitBtn");
  clearBtn.addEventListener("click", function (e) {
    // Definimos que pasa cuando el boton draw-clearBtn es pulsado
    clearCanvas();
    //drawImage.setAttribute("src", "");
    imagen.value = '';
    document.getElementById('imagen').value = '';
    document.getElementById('oculto-guardar').style.display = '';
    //alert(document.getElementById('oculto-guardar').style.display = 'none' );

  }, false);
    // Definimos que pasa cuando el boton draw-submitBtn es pulsado
  submitBtn.addEventListener("click", function (e) {
    var canvas = document.getElementById('draw-canvas');    
    var dataUrl = canvas.toDataURL();
    console.log(dataUrl);
    //alert(dataUrl);
    
    //drawImage.setAttribute("src", dataUrl);
    imagen.value = dataUrl;
    document.getElementById('oculto-guardar').style.display = 'none'; 
   // alert(document.getElementById('oculto-guardar').style.display = 'block' );
   }, false);
  
  // Activamos MouseEvent para nuestra pagina
  var drawing = false;
  var mousePos = { x:0, y:0 };
  var lastPos = mousePos;
  canvas.addEventListener("mousedown", function (e)
  {
    /*
      Mas alla de solo llamar a una funcion, usamos function (e){...}
      para mas versatilidad cuando ocurre un evento
    */
    var tint = "#000000";
    var punta = 3;
    //console.log(e);
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);
  canvas.addEventListener("mouseup", function (e)
  {
    drawing = false;
  }, false);
  canvas.addEventListener("mousemove", function (e)
  {
    mousePos = getMousePos(canvas, e);
  }, false);
  
  // Activamos touchEvent para nuestra pagina
  canvas.addEventListener("touchstart", function (e) {
    mousePos = getTouchPos(canvas, e);
    //console.log(mousePos);
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchend", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchleave", function (e) {
    // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchmove", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });

    canvas.dispatchEvent(mouseEvent);
  }, false);
  
  // Get the position of the mouse relative to the canvas
  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    };
  }
  
  // Get the position of a touch relative to the canvas
  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    //console.log(touchEvent);
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
      x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
      y: touchEvent.touches[0].clientY - rect.top
    };
  }
  
  // Draw to the canvas
  function renderCanvas() {
    if (drawing) {
      var tint = "#000000";
      var punta = 3;
      ctx.strokeStyle = tint.value;
      ctx.beginPath();
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      //console.log(punta.value);
      ctx.lineWidth = punta.value;
      ctx.stroke();
      ctx.closePath();
      lastPos = mousePos;
    }
  }
  
  function clearCanvas() {
    canvas.width = canvas.width;
  }
  
  // Allow for animation
  (function drawLoop () {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  
})(); 



</script>


<script>
       //EMPLEADO
     
    var verifCedula = document.getElementById('numero_cedula');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            //console.log(response[0].nameE)
            console.log(response[0].correoD)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre_contacto').value = response[0].nameE +" "+response[0].lastnameE;
                //document.getElementById('cargo').value = response[0].cargo_titular;
                
                document.getElementById('telefono').value = response[0].telefono+" EXT "+response[0].extension;
                document.getElementById('direccion').value = response[0].direccion;
                
                document.getElementById('seccional').value = "CALI";
                document.getElementById('email').value = response[0].correoD;
                
                
            } else {
                document.getElementById('nombre_contacto').value = "";
                document.getElementById('telefono').value = "";
                document.getElementById('direccion').value = "";
                document.getElementById('seccional').value = "";
                document.getElementById('email').value = "";
            }
            $("#despacho").val(response[0].cod_despacho);
            $("#ciudad").val(response[0].nombreCiudad);
            
            
        });
    });
    
    
    //IMPRESORA
    
     //var verifSerie = document.getElementById('serial');
     var verifSerie = document.getElementById('num_caja');
    verifSerie.addEventListener('input', function() 
    {

        console.log(this.value.serial);
        document.getElementById('serial').value = "";
                document.getElementById('modelo').value = "";
                document.getElementById('modelo').value = "";

        $.get("/tecnico/soporte/consulta/serie/impresora/" + this.value + "", function(response) {
                console.log(response.marca)
                
                
            if (Object.keys(response).length > 0) {
                document.getElementById('serial').value = response.serie;
                document.getElementById('marca').value = response.marca;
                document.getElementById('modelo').value = response.modelo;
                
                
            } else {
                document.getElementById('serial').value = "";
                document.getElementById('modelo').value = "";
                document.getElementById('modelo').value = "";
            }
            
            
            
        });
    });
    
    
    //EQUIPO DE SOPORTE
    
    /* var verifPlaca = document.getElementById('placa');
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
    });*/
    
  
    
    /*jQuery(document).ready(function() {
        jQuery('.input_apellido').keypress(function(tecla) {
        if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 'Alt'+165)) return false;
        });
    });*/
    
    $(".nombre_contacto").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
     $(".input_nombre").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
    
    
  
    
    </script>
 <script>
       const input = document.getElementById('ip');
          
         input.addEventListener('change', updateValue);

        function updateValue(e) {
            
                 
                  // Using Regex expression for validating IPv4
                  var ipaddress =
                    /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
                  var content = $("#ip").val();
          
                  if (ipaddress.test(content)) {
                    $("#demo").html("Ipaddress is Valid");
                  } else {
                    alert('Verifique Ip, ésta no es válida!!')
                  }
                };
</script>

<script>

var select = document.getElementById('tipo_instalacion');
select.addEventListener('change',
  function(){
    var selectedOption = this.options[select.selectedIndex];
    
    if(selectedOption.value == "Red"){
      document.getElementById("ip").setAttribute("required",'True'); 
      $('#form_ip').css('display', 'block');
         
    }else{
     document.getElementById("ip").removeAttribute("required");  
     $('#form_ip').css('display', 'none');  
    }
    
   // console.log(selectedOption.value + ': ' + selectedOption.text);
  });

    
</script>

   </main>


</body>

</html>


