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
			    <form action="{{ route('tecnico.firma.instalacion.todoenuno.store',$soporte->id) }}" method="POST">
    @csrf
    @method('PUT')
                @else

                <form action="{{ route('tecnico.firma.instalacion.todoenuno.store') }}" method="POST">
    @csrf
                @endif
                <div class="card-header"><h3><center>ACTA DE INSTALACION<br>
                                                    COMPUTADOR TODO EN UNO
                                            </center>
                                        </h3>
                </div>

                    <div class="row">
                        <p class=""><h5><center>Informaci&oacute;n del Servicio</center></h5></p>
                        <hr>
                    </div>
                        <div class="row">
                          <p class=""><h5><center>Datos del Despacho</center></h5></p>
                          <hr>
                        </div>


                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* IDENTIFICACION:</label>
                                  <input id="cedula_funcionario" class="form-control @error('cedula_funcionario') is-invalid @enderror" placeholder="Ingrese No. Identificaci&oacute;n" min="1" autocomplete="off" type="number" name="cedula_funcionario" value="{{ old('cedula_funcionario', $soporte->cedula_funcionario ?? $soporte-> cedula_funcionario) }}">
@error('cedula_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-8">
                                   <label for="nombre_funcionario">* NOMBRE CONTACTO:</label>
                                  <input id="nombre_funcionario" class="form-control input_nombre @error('nombre_funcionario') is-invalid @enderror" pattern="[a-zA-Z\u00F1\u00D1\u00E0-\u00FC ]{2,254}" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre_funcionario" value="{{ old('nombre_funcionario', $soporte->nombre_funcionario ?? $soporte->nombre_funcionario) }}">
@error('nombre_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                 <span id="message" style="background-color: Yellow; display:none ">
                                      
                                      Introduzca solo letras (A-Z) o (a-z).
                                  
                                 </span>
                                </div>
                        </div>


                        <div class="row">
                          <p class=""><h5><center>Datos Equipo Instalado</center></h5></p>
                          <div class=" col-xs-12 col-md-3">
                                  <label for="todo_en_uno">*PLACA TODO EN UNO:</label>
                                  <input id="todo_en_uno" class="form-control @error('todo_en_uno') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" type="text" name="todo_en_uno" value="{{ old('todo_en_uno', $soporte->todo_en_uno ?? $soporte->todo_en_uno) }}">
@error('todo_en_uno')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                            <div class=" col-xs-12 col-md-3">
                                  <label for="placa">* SERIAL TODO EN UNO:</label>
                                  <input class="form-control @error('serial_equipo') is-invalid @enderror" placeholder="Ingrese Placa del Equipo" min="1" autocomplete="off" id="serial_equipo" type="text" name="serial_equipo" value="{{ old('serial_equipo', $soporte->serial_equipo ?? $soporte->serial_equipo) }}">
@error('serial_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                          
                           <div class=" col-xs-12 col-md-3">
                                   <label for="serial">* PLACA TECLADO:</label>
                                  <input class="form-control @error('teclado_placa') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" id="teclado_placa" type="text" name="teclado_placa" value="{{ old('teclado_placa', $soporte->teclado_placa ?? $soporte->teclado_placa) }}">
@error('teclado_placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="marca_equipo">* SERIAL TECLADO:</label>
                                   <input class="form-control @error('teclado_serial') is-invalid @enderror" placeholder="" autocomplete="off" id="teclado_serial" type="text" name="teclado_serial" value="{{ old('teclado_serial', $soporte->teclado_serial ?? $soporte->teclado_serial) }}">
@error('teclado_serial')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="modelo_equipo">* PLACA MOUSE:</label>
                                  <input class="form-control @error('mouse_placa') is-invalid @enderror" placeholder="" autocomplete="off" id="mouse_placa" type="text" name="mouse_placa" value="{{ old('mouse_placa', $soporte->mouse_placa ?? $soporte->mouse_placa) }}">
@error('mouse_placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-3">
                                   <label for="mouse_serial">* SERIAL MOUSE:</label>
                                  <input class="form-control @error('mouse_serial') is-invalid @enderror" placeholder="" autocomplete="off" id="mouse_serial" type="text" name="mouse_serial" value="{{ old('mouse_serial', $soporte->mouse_serial ?? $soporte->mouse_serial) }}">
@error('mouse_serial')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                
                                <div class=" col-xs-12 col-md-6">
                                   <label for="codigo_despacho">* DESPACHO:</label>
                                  <select id="codigo_despacho" class="form-control  @error('codigo_despacho') is-invalid @enderror" autocomplete="off" name="codigo_despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('codigo_despacho', $soporte->codigo_despacho) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('codigo_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                

                        </div>
                       <hr>
                       <div class="row">
                        <p class=""><h5><center>Descripci&oacute;n del Servicio</center></h5></p>
                        <textarea id="descripcion_servicio" class="form-control @error('descripcion_servicio') is-invalid @enderror" style="height: 6em" placeholder="Descripci&oacute;n del Diagn&oacute;stico" min="1" autocomplete="off" name="descripcion_servicio">{{ old('descripcion_servicio', $soporte->descripcion_servicio ?? 'La instalación del equipo TODO EN UNO en el despacho se lleva a cabo de acuerdo con la distribución establecida por el Supervisor del Contrato.') }}</textarea>
@error('descripcion_servicio')
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
      var verifiPlaca = document.getElementById('todo_en_uno');
     
    verifiPlaca.addEventListener('input', function() 
    {
        console.log(verifiPlaca)

                document.getElementById('serial_equipo').value = "";
                document.getElementById('teclado_placa').value = "";
                document.getElementById('teclado_serial').value = "";
                document.getElementById('mouse_placa').value = "";
                document.getElementById('mouse_serial').value = ""
                document.getElementById('codigo_despacho').value = "";
                $("#codigo_despacho").val('');

        $.get("/tecnico/soporte/lista/instalacion/todoenuno/" + this.value + "", function(response) {
                
                
                
            if (Object.keys(response).length > 0) {
                console.log(response)
                
                if(response.cedula_funcionario  === null){
                    document.getElementById('serial_equipo').value = response.serial_equipo;
                    document.getElementById('teclado_placa').value = response.teclado_placa;
                    document.getElementById('teclado_serial').value = response.teclado_serial;
                    document.getElementById('mouse_placa').value = response.mouse_placa;
                    document.getElementById('mouse_serial').value = response.mouse_serial;
                    document.getElementById('codigo_despacho').value = response.codigo_despacho
                    $("#codigo_despacho").val(response.codigo_despacho);
                
                }else{
                    alert('ESTE EQUIPO YA ESTA ASIGNADO')
                }
                
            } else {
               document.getElementById('serial_equipo').value = "";
                document.getElementById('teclado_placa').value = "";
                document.getElementById('teclado_serial').value = "";
                document.getElementById('mouse_placa').value = "";
                document.getElementById('mouse_serial').value = ""
                document.getElementById('codigo_despacho').value = "";
                $("#codigo_despacho").val('');
            }
            
            
            
        });
    });
</script>

<script>
       //EMPLEADO
     
    var verifCedula = document.getElementById('cedula_funcionario');
    verifCedula.addEventListener('input', function() 
    {

        //console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            if (Object.keys(response).length > 0) {
                document.getElementById('nombre_funcionario').value = response[0].nameE +" "+response[0].lastnameE;
                //document.getElementById('cargo').value = response[0].cargo_titular;
                
                document.getElementById('seccional').value = "CALI";
                
                
            } else {
                document.getElementById('nombre_funcionario').value = "";
            }
            
            
            
        });
    });
    
    
   
    
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




   </main>


</body>

</html>


