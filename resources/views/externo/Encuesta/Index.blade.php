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
  <title>Encuesta Satisfaccion</title>
  <!-- NO INDEXAR PAGINA POR ROBOTS -->
    <meta name="robots" content="noindex, nofollow">
  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
  background-color: #002147;
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

</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
        .question {
            margin-bottom: 20px;
        }
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
          <br>Consejo Superior de la Judicatura <br>
          Direcci&oacute;n Seccional de Administraci&oacute;n Judicial
          Cali - Valle del Cauca
          <br>
          "Fortaleciendo la justicia, promoviendo el bienestar de todos"
        </p>
      </div>
      
    </div>

        <div class="container-fluid">
            
            <div class="card">
              <div class="card-body">
                <div class="row justify-content-center">
                <div class="col-md-12">
                     
                        <div class="card-header" style="background-color: #002147;color:white"><h4><center>Como parte de nuestro prop&oacute;sito hacia asegurar niveles m&aacute;s altos de satisfacci&oacute;n de los servicios que brinda el Grupo de Mantenimiento y Soporte Tecnológico, le agradecemos responder la siguiente encuesta:</h4></div>
                    
                            <div class="row">
                                <p><center><h4>Evaluando el periodo de Julio a Septiembre del 2025, por favor d&iacute;ganos cual es su nivel de satisfacci&oacute;n con los siguientes Servicios y/o Aplicaciones: </h4></center> <br>
                                 <p>
                                    @include('../alerts.success')
                                    @include('../alerts.request')
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                    @if (session()->has('success'))
                                        <script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: '¡Éxito!',
                                                    text: '¡¡Gracias por su tiempo y sus respuestas!!',
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                            }
                                        </script>
                                    @endif
                                    
                                    @if (session()->has('error'))
                                        <script>
                                            window.onload = function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: '{{ session()->get('error') }}',
                                                    confirmButtonColor: '#d33',
                                                    confirmButtonText: 'Cerrar'
                                                });
                                            }
                                        </script>
                                    @endif

                                </p>
                            </div>
                            
                           <hr>
                            <form id="MiFormulario" class="was-validated" action="{{ route('encuesta.satisfaccion.store') }}" method="POST">
    @csrf 
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-1"></div>
                        <div class="col-xs-12 col-sm-10">
                            <div class="container mt-5">
                                 <!-- Pregunta 1 -->
                                <div class="question" id="question1">
                                    <label for="q1"><h3>Pregunta 1/10: ¿Cómo califica el servicio de Soporte Correo Electr&oacute;nico?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q1" id="q1-1" value="Muy Satisfactoria" onclick="handleOptionChange(1)">
                                        <label class="form-check-label" for="q1-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q1" id="q1-2" value="Satisfactoria" onclick="handleOptionChange(1)">
                                        <label class="form-check-label" for="q1-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q1" id="q1-3" value="Normal" onclick="handleOptionChange(1)">
                                        <label class="form-check-label" for="q1-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q1" id="q1-4" value="Poco Satisfactoria" onclick="handleOptionChange(1)">
                                        <label class="form-check-label" for="q1-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q1" id="q1-5" value="No Satisfactoria" onclick="handleOptionChange(1)">
                                        <label class="form-check-label" for="q1-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q1" id="q1-6" value="No Aplica" onclick="handleOptionChange(1)">
                                        <label class="form-check-label" for="q1-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs1">
                                        <label for="observation1">Observaciones</label>
                                        <textarea class="form-control" id="observation1" name="observaciones_soportecorreoelectronico" rows="3" oninput="checkObservation(1)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" disabled id="prev1">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next1" onclick="nextQuestion(1)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 2 -->
                                <div class="question hidden" id="question2">
                                    <label for="q2"><h3>Pregunta 2/10: ¿Cómo califica el servicio de P&aacute;gina Web Rama Judicial?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q2" id="q2-1" value="Muy Satisfactoria" onclick="handleOptionChange(2)">
                                        <label class="form-check-label" for="q2-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q2" id="q2-2" value="Satisfactoria" onclick="handleOptionChange(2)">
                                        <label class="form-check-label" for="q2-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q2" id="q2-3" value="Normal" onclick="handleOptionChange(2)">
                                        <label class="form-check-label" for="q2-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q2" id="q2-4" value="Poco Satisfactoria" onclick="handleOptionChange(2)">
                                        <label class="form-check-label" for="q2-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q2" id="q2-5" value="No Satisfactoria" onclick="handleOptionChange(2)">
                                        <label class="form-check-label" for="q2-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q2" id="q2-6" value="No Aplica" onclick="handleOptionChange(2)">
                                        <label class="form-check-label" for="q2-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs2">
                                        <label for="observation2">Observaciones</label>
                                        <textarea class="form-control" id="observation2" name="observaciones_paginaramajudicial" rows="3" oninput="checkObservation(2)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev2" onclick="prevQuestion(2)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next2" onclick="nextQuestion(2)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 3 -->
                                <div class="question hidden" id="question3">
                                    <label for="q3"><h3>Pregunta 3/10: ¿Cómo califica el servicio de Justicia XXI?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q3" id="q3-1" value="Muy Satisfactoria" onclick="handleOptionChange(3)">
                                        <label class="form-check-label" for="q3-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q3" id="q3-2" value="Satisfactoria" onclick="handleOptionChange(3)">
                                        <label class="form-check-label" for="q3-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q3" id="q3-3" value="Normal" onclick="handleOptionChange(3)">
                                        <label class="form-check-label" for="q3-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q3" id="q3-4" value="Poco Satisfactoria" onclick="handleOptionChange(3)">
                                        <label class="form-check-label" for="q3-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q3" id="q3-5" value="No Satisfactoria" onclick="handleOptionChange(3)">
                                        <label class="form-check-label" for="q3-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q3" id="q3-6" value="No Aplica" onclick="handleOptionChange(3)">
                                        <label class="form-check-label" for="q3-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs3">
                                        <label for="observation3">Observaciones</label>
                                        <textarea class="form-control" id="observation3" name="observaciones_justiciaxxi" rows="3" oninput="checkObservation(3)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev3" onclick="prevQuestion(3)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next3" onclick="nextQuestion(3)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 4 -->
                                <div class="question hidden" id="question4">
                                    <label for="q4"><h3>Pregunta 4/10: ¿Cómo califica el servicio de Tyba - Justicia XXI Web?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q4" id="q4-1" value="Muy Satisfactoria" onclick="handleOptionChange(4)">
                                        <label class="form-check-label" for="q4-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q4" id="q4-2" value="Satisfactoria" onclick="handleOptionChange(4)">
                                        <label class="form-check-label" for="q4-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q4" id="q4-3" value="Normal" onclick="handleOptionChange(4)">
                                        <label class="form-check-label" for="q4-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q4" id="q4-4" value="Poco Satisfactoria" onclick="handleOptionChange(4)">
                                        <label class="form-check-label" for="q4-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q4" id="q4-5" value="No Satisfactoria" onclick="handleOptionChange(4)">
                                        <label class="form-check-label" for="q4-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q4" id="q4-6" value="No Aplica" onclick="handleOptionChange(4)">
                                        <label class="form-check-label" for="q4-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs4">
                                        <label for="observation4">Observaciones</label>
                                        <textarea class="form-control" id="observation4" rows="3" name="observaciones_tybajusticiaxxi" oninput="checkObservation(4)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev4" onclick="prevQuestion(4)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next4" onclick="nextQuestion(4)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 2 -->
                                <div class="question hidden" id="question5">
                                    <label for="q5"><h3>Pregunta 5/10: ¿Cómo califica el servicio de Conectividad e Internet?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q5" id="q5-1" value="Muy Satisfactoria" onclick="handleOptionChange(5)">
                                        <label class="form-check-label" for="q5-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q5" id="q5-2" value="Satisfactoria" onclick="handleOptionChange(5)">
                                        <label class="form-check-label" for="q5-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q5" id="q5-3" value="Normal" onclick="handleOptionChange(5)">
                                        <label class="form-check-label" for="q5-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q5" id="q5-4" value="Poco Satisfactoria" onclick="handleOptionChange(5)">
                                        <label class="form-check-label" for="q5-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q5" id="q5-5" value="No Satisfactoria" onclick="handleOptionChange(5)">
                                        <label class="form-check-label" for="q5-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q5" id="q5-6" value="No Aplica" onclick="handleOptionChange(5)">
                                        <label class="form-check-label" for="q5-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs5">
                                        <label for="observation5">Observaciones</label>
                                        <textarea class="form-control" id="observation5" rows="3" name="observaciones_conectividadeinternet" oninput="checkObservation(5)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev5" onclick="prevQuestion(5)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next5" onclick="nextQuestion(5)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 2 -->
                                <div class="question hidden" id="question6">
                                    <label for="q6"><h3>Pregunta 6/10: ¿Cómo califica el servicio de Firma Electr&oacute;nica?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q6" id="q6-1" value="Muy Satisfactoria" onclick="handleOptionChange(6)">
                                        <label class="form-check-label" for="q6-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q6" id="q6-2" value="Satisfactoria" onclick="handleOptionChange(6)">
                                        <label class="form-check-label" for="q6-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q6" id="q6-3" value="Normal" onclick="handleOptionChange(6)">
                                        <label class="form-check-label" for="q6-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q6" id="q6-4" value="Poco Satisfactoria" onclick="handleOptionChange(6)">
                                        <label class="form-check-label" for="q6-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q6" id="q6-5" value="No Satisfactoria" onclick="handleOptionChange(6)">
                                        <label class="form-check-label" for="q6-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q6" id="q6-6" value="No Aplica" onclick="handleOptionChange(6)">
                                        <label class="form-check-label" for="q6-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs6">
                                        <label for="observation6">Observaciones</label>
                                        <textarea class="form-control" id="observation6" rows="3" name="observaciones_firmaelectronica" oninput="checkObservation(6)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev6" onclick="prevQuestion(6)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next6" onclick="nextQuestion(6)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 7 -->
                                <div class="question hidden" id="question7">
                                    <label for="q7"><h3>Pregunta 7/10: ¿Cómo califica la funcionalidad de las plataformas del Sistema de Gestión Documental Electrónico (SGDE) – Aplica para las especialidades Civil, Familia y Penal y del Sistema Integrado de Gestión Judicial (SIUGJ) – Aplica para la especialidad Laboral:
                                    </h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q7" id="q7-1" value="Muy Satisfactoria" onclick="handleOptionChange(7)">
                                        <label class="form-check-label" for="q7-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q7" id="q7-2" value="Satisfactoria" onclick="handleOptionChange(7)">
                                        <label class="form-check-label" for="q7-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q7" id="q7-3" value="Normal" onclick="handleOptionChange(7)">
                                        <label class="form-check-label" for="q7-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q7" id="q7-4" value="Poco Satisfactoria" onclick="handleOptionChange(7)">
                                        <label class="form-check-label" for="q7-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q7" id="q7-5" value="No Satisfactoria" onclick="handleOptionChange(7)">
                                        <label class="form-check-label" for="q7-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q7" id="q7-6" value="No Aplica" onclick="handleOptionChange(7)">
                                        <label class="form-check-label" for="q7-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs7">
                                        <label for="observation7">Observaciones</label>
                                        <textarea class="form-control" id="observation7" name="observaciones_sgde" rows="3" oninput="checkObservation(7)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev7" onclick="prevQuestion(7)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next7" onclick="nextQuestion(7)" disabled>Siguiente</button>
                                </div>
                    
                               
                    
                                <!-- Pregunta 2 -->
                                <div class="question hidden" id="question8">
                                    <label for="q8"><h3>Pregunta 8/10: ¿Cómo califica el servicio de Soporte mesa de ayuda (línea 018000 124 595)?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q8" id="q8-1" value="Muy Satisfactoria" onclick="handleOptionChange(8)">
                                        <label class="form-check-label" for="q8-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q8" id="q8-2" value="Satisfactoria" onclick="handleOptionChange(8)">
                                        <label class="form-check-label" for="q8-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q8" id="q8-3" value="Normal" onclick="handleOptionChange(8)">
                                        <label class="form-check-label" for="q8-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q8" id="q8-4" value="Poco Satisfactoria" onclick="handleOptionChange(8)">
                                        <label class="form-check-label" for="q8-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q8" id="q8-5" value="No Satisfactoria" onclick="handleOptionChange(8)">
                                        <label class="form-check-label" for="q8-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q8" id="q8-6" value="No Aplica" onclick="handleOptionChange(8)">
                                        <label class="form-check-label" for="q8-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs8">
                                        <label for="observation8">Observaciones</label>
                                        <textarea class="form-control" id="observation8" rows="3" name="observaciones_mesadeayuda" oninput="checkObservation(8)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev8" onclick="prevQuestion(8)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next8" onclick="nextQuestion(8)" disabled>Siguiente</button>
                                </div>
                    
                                <!-- Pregunta 9 -->
                                <div class="question hidden" id="question9">
                                    <label for="q9"><h3>Pregunta 9/10: ¿Cómo califica el servicio de soporte en las Salas de Audiencias?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q9" id="q9-1" value="Muy Satisfactoria" onclick="handleOptionChange(9)">
                                        <label class="form-check-label" for="q9-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q9" id="q9-2" value="Satisfactoria" onclick="handleOptionChange(9)">
                                        <label class="form-check-label" for="q9-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q9" id="q9-3" value="Normal" onclick="handleOptionChange(9)">
                                        <label class="form-check-label" for="q9-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q9" id="q9-4" value="Poco Satisfactoria" onclick="handleOptionChange(9)">
                                        <label class="form-check-label" for="q9-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q9" id="q9-5" value="No Satisfactoria" onclick="handleOptionChange(9)">
                                        <label class="form-check-label" for="q9-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q9" id="q9-6" value="No Aplica" onclick="handleOptionChange(9)">
                                        <label class="form-check-label" for="q9-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs9">
                                        <label for="observation9">Observaciones</label>
                                        <textarea class="form-control" id="observation9" rows="3" name="observaciones_salaaudiencia" oninput="checkObservation(9)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev9" onclick="prevQuestion(9)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next9" onclick="nextQuestion(9)" disabled>Siguiente</button>
                                </div>
                    
                                 <!-- Pregunta 9 
                                 <div class="question hidden" id="question10">
                                    <label for="q10"><h3>Pregunta 10/12: ¿Cómo califica el servicio de Soporte Audiencias Virtuales?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-1" value="Muy Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-2" value="Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-3" value="Normal" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-4" value="Poco Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-5" value="No Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-6" value="No Aplica" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs10">
                                        <label for="observation10">Observaciones</label>
                                        <textarea class="form-control" id="observation10" rows="3" name="observaciones_soporteaudienciasvirtuales" oninput="checkObservation(10)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev10" onclick="prevQuestion(10)">Anterior</button>
                                    <button type="button" class="btn btn-primary mt-3" id="next10" onclick="nextQuestion(10)" disabled>Siguiente</button>
                                </div>-->
                    
                    
                                <!-- Pregunta 11 -->
                                <div class="question hidden" id="question10">
                                    <label for="q11"><h3>Pregunta 10/10: ¿Cómo califica el servicio de Creaci&oacute;n Usuario de Dominio?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-1" value="Muy Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-2" value="Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-3" value="Normal" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-4" value="Poco Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-5" value="No Satisfactoria" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q10-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q10" id="q10-6" value="No Aplica" onclick="handleOptionChange(10)">
                                        <label class="form-check-label" for="q11-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs10">
                                        <label for="observation11">Observaciones</label>
                                        <textarea class="form-control" id="observation10"  name="observaciones_usuariodominio" rows="3" oninput="checkObservation(10)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev10" onclick="prevQuestion(10)">Anterior</button>
                                    <button type="submit" class="btn btn-success mt-3" id="submitBtn" disabled>Enviar</button>
                                </div>
                                
                                 <!-- Pregunta 12 
                                <div class="question hidden" id="question12">
                                    <label for="q12"><h3>Pregunta 12/12: ¿Cómo califica el servicio de SIUGJ?</h3></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q12" id="q12-1" value="Muy Satisfactoria" onclick="handleOptionChange(12)">
                                        <label class="form-check-label" for="q12-1">Muy Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q12" id="q12-2" value="Satisfactoria" onclick="handleOptionChange(12)">
                                        <label class="form-check-label" for="q12-2">Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q12" id="q12-3" value="Normal" onclick="handleOptionChange(12)">
                                        <label class="form-check-label" for="q12-3">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q12" id="q12-4" value="Poco Satisfactoria" onclick="handleOptionChange(12)">
                                        <label class="form-check-label" for="q12-4">Poco Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q12" id="q12-5" value="No Satisfactoria" onclick="handleOptionChange(12)">
                                        <label class="form-check-label" for="q12-5">No Satisfactoria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q12" id="q12-6" value="No Aplica" onclick="handleOptionChange(12)">
                                        <label class="form-check-label" for="q12-6">No Aplica</label>
                                    </div>
                                    <div class="form-group hidden" id="obs12">
                                        <label for="observation12">Observaciones</label>
                                        <textarea class="form-control" id="observation12"  name="observaciones_siugj" rows="3" oninput="checkObservation(12)"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="prev12" onclick="prevQuestion(12)">Anterior</button>
                                    <button type="submit" class="btn btn-success mt-3" id="submitBtn" disabled>Enviar</button>
                                </div>-->
            
            
            
                            </div>
                        </div>
                    <div class="col-xs-12 col-sm-1"></div>
                    
                </div>
        
                   
                        
                </div>
            </div>
              </div>
            </div>
            
        </div>
        <script>
            // Mostrar y ocultar observaciones, manejar botones de siguiente y anterior
            function showObservation(observationId) {
                document.getElementById(observationId).classList.remove('hidden');
            }
    
            function hideObservation(observationId, obsFieldId) {
                document.getElementById(observationId).classList.add('hidden');
                document.getElementById(obsFieldId).value = '';  // Limpiar el campo de observaciones
            }
    
            function handleOptionChange(questionNumber) {
                const selectedOption = document.querySelector(`input[name="q${questionNumber}"]:checked`);
                const obs = document.getElementById(`obs${questionNumber}`);
                const nextButton = document.getElementById(`next${questionNumber}`);
                const submitBtn = document.getElementById('submitBtn');
    
                if (selectedOption && (selectedOption.value === 'Poco Satisfactoria' || selectedOption.value === 'No Satisfactoria')) {
                    showObservation(`obs${questionNumber}`);
                } else {
                    hideObservation(`obs${questionNumber}`, `observation${questionNumber}`);
                }
    
                if (selectedOption && questionNumber < 10) {
                    nextButton.disabled = false;
                } else if (questionNumber === 10 && selectedOption) {
                    submitBtn.disabled = false;
                }
            }
    
            function checkObservation(questionNumber) {
                const observation = document.getElementById(`observation${questionNumber}`).value;
                const nextButton = document.getElementById(`next${questionNumber}`);
                const submitBtn = document.getElementById('submitBtn');
    
                if (observation.trim() === '' && (document.querySelector(`input[name="q${questionNumber}"]:checked`).value === 'Poco Satisfactoria' || document.querySelector(`input[name="q${questionNumber}"]:checked`).value === 'No Satisfactoria')) {
                    nextButton.disabled = true;
                    submitBtn.disabled = true;
                } else {
                    nextButton.disabled = false;
                    submitBtn.disabled = false;
                }
            }
    
            function nextQuestion(currentQuestion) {
                const nextQuestion = currentQuestion + 1;
                document.getElementById(`question${currentQuestion}`).classList.add('hidden');
                document.getElementById(`question${nextQuestion}`).classList.remove('hidden');
            }
    
            function prevQuestion(currentQuestion) {
                const prevQuestion = currentQuestion - 1;
                document.getElementById(`question${currentQuestion}`).classList.add('hidden');
                document.getElementById(`question${prevQuestion}`).classList.remove('hidden');
            }
        </script>

@stack('scripts')
</body>

</html>


