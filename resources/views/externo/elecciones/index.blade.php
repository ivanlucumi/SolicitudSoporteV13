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
  <title>Censo para Elecciones</title>
  
  <script src='https://www.google.com/recaptcha/api.js'></script>
   <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>


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
/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */



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
<body style="background: #fff;">
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
        @include('alerts.flash-message')
        @include('../alerts.success')
        @include('../alerts.request')
      <div class="card-body">
        <div class="row justify-content-center">
            
        <div class="col-md-12">
                <div class="card-header justify-content-center" align="center" style="background-color: #004182;color:white"><h3>CONSULTA DE CORREO PARA VOTACIÓN ELECTRÓNICA DE LA COMISIÓN INTERINSTITUCIONAL DE LA RAMA JUDICIAL</h3></div>
                    <form action="{{ route('externo.censo.electoral.post') }}" method="POST">
    @csrf
                        <br>
                        
                     
                      <hr>
                    <div class="form-group row">
                        <div class=" col-xs-12 col-md-3">
                        </div>
                         <div class=" col-xs-12 col-md-6">
                                  <label for="email">C&Eacute;DULA FUNCIONARIO(A):</label>
                                  <input class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingresa No C&eacute;dula del Funcionario" autocomplete="off" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-3">
                        </div>
                        <br>
                        <br>
                        <div align="center" class="col-xs-12  mb-3 mt-3" style="">
                                <button type="submit" class="btn btn-block" style="background-color: #004182; color: #fff;">
                                   CONSULTA
                                </button>
                                <br>
                            </div>
                            </form>
                            <br>
                        
                    </div>
                
        </div>
    </div>
    @if ($funcionario != null)
    <div class="row ">
        <div class=" col-xs-12 col-md-4">
            <label for="email">C&Eacute;DULA FUNCIONARIO:</label>
            <input class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingresa No C&eacute;dula del Funcionario" autocomplete="off" type="number" name="cedula" id="cedula" value="{{ old('cedula', $funcionario->cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
  </div>
  <div class=" col-xs-12 col-md-4">
    <label for="email">NOMBRE(S):</label>
    <input class="form-control @error('cedula') is-invalid @enderror" autocomplete="off" type="text" name="cedula" id="cedula" value="{{ old('cedula', $funcionario->nombre) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
<div class=" col-xs-12 col-md-4">
    <label for="email">CORREO:</label>
    <input class="form-control @error('cedula') is-invalid @enderror" autocomplete="off" type="text" name="cedula" id="cedula" value="{{ old('cedula', $funcionario->correo) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
<div class="row mt-3 mb-3">
    <a href="https://sivoto.ramajudicial.gov.co/SiVotoWeb"  class="VER DOCUMENTO" target="_blank"><h4>Enlace Votaci&oacute;n</h4></a>
 </div> 
    @endif
    
    </div>
      </div>
    </div>
    
  
    
</div>


 </main>


  

  
<!-- REQUIRED JS SCRIPTS -->

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


@stack('scripts')


</body>

</html>


