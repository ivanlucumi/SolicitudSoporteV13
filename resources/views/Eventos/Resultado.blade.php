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
  <title>CONSULTA EVENTO DIA DE LA FAMILIA</title>

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
     <div class="row">
                                <p><center><h4>CONSULTAR ESTADO DE LAS SOLICITUDES </h4></center> <br>
                                 <p>
                                    @include('alerts.flash-message')
                                    @include('../alerts.success')
                                    @include('../alerts.request')
                                </p>
                            </div>

<div class="container-fluid">

@if(\Carbon\Carbon::now()->toDateString() <= "2025-06-14")  

   @if(!empty($Listado)) 
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="card" style="width: 100%;">
                <form id="MiFormulario" class="was-validated" action="{{ route('save.confirmacion.familia') }}" method="POST">
    @csrf 
                            <input class="form-control" type="hidden" name="identificacion" id="identificacion" value="{{ $Listado->identificacion }}">
              <div class="card-body">
                <h5 class="card-title"><strong>FUNCIONARIO:</strong> {{$Listado->nombre_servidor}}</h5>
                <p class="card-text"> <strong>IDENTIFICACION :</strong> {{$Listado->identificacion}} </p>
                <div class="form-group">
                            <select class="form-control @error('confirma') is-invalid @enderror" autocomplete="off" id="sede" name="confirma">
    <option value="">Seleccione Estado</option>
    @foreach(['ASISTE' => 'ASISTE','NO ASISTE'=>'NO ASISTE'] as $key => $value)
        <option value="{{ $key }}" @selected(old('confirma', $Listado->confirma) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('confirma')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
              </div>
              
              <div class="card-body">
                 @if(!empty($Listado->acompanante_1 ) && !empty($Listado->identificacion_a1 ) && !empty($Listado->parentezco_1 ))
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ACOMPAÑANTE 1:</strong> {{$Listado->acompanante_1 }}</li>
                <li class="list-group-item"><strong>IDENTIFICACION:</strong> {{$Listado->identificacion_a1}}</li>
                <li class="list-group-item"><strong>PARENTEZCO :</strong>{{$Listado->parentezco_1}}</li>
                <li class="list-group-item"><strong>CONFIRMAR ASISTENCIA:</strong> 
                <div class="form-group">
                            <select class="form-control @error('confirma_1') is-invalid @enderror" autocomplete="off" id="sede" name="confirma_1">
    <option value="">Seleccione Estado</option>
    @foreach(['ASISTE' => 'ASISTE','NO ASISTE'=>'NO ASISTE'] as $key => $value)
        <option value="{{ $key }}" @selected(old('confirma_1', $Listado->confirma_1) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('confirma_1')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                </li>
                @endif
                </ul>
                 <hr> 
                 
                 <hr>
                 @if(!empty($Listado->acompanante_2 ) && !empty($Listado->identificacion_a2 ) && !empty($Listado->parentezco_2 ))
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ACOMPAÑANTE 2:</strong> {{$Listado->acompanante_2 }}</li>
                        <li class="list-group-item"><strong>IDENTIFICACION:</strong> {{$Listado->identificacion_a2}}</li>
                        <li class="list-group-item"><strong>PARENTEZCO :</strong>{{$Listado->parentezco_2}}</li>
                        <li class="list-group-item"><strong>CONFIRMAR ASISTENCIA:</strong> 
                            <div class="form-group">
                                    <select class="form-control @error('confirma_2') is-invalid @enderror" autocomplete="off" id="sede" name="confirma_2">
    <option value="">Seleccione Estado</option>
    @foreach(['ASISTE' => 'ASISTE','NO ASISTE'=>'NO ASISTE'] as $key => $value)
        <option value="{{ $key }}" @selected(old('confirma_2', $Listado->confirma_2) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('confirma_2')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </li>
                     </ul>
                @endif
              </div>
              <div class="row">
                           <div class="col-xs-12 col-sm-12">
                               <center><h5><strong>OBSERVACIONES:</strong></h5></center>
                           </div> 
                           <div class="col-xs-12 col-sm-12">
                              	<input class="form-control @error('observaciones') is-invalid @enderror" placeholder="Observaciones" autocomplete="off" type="text" name="observaciones" id="observaciones" value="{{ old('observaciones') }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                           </div> 
                        </div>
              
              <div>
                <button id="btsubmit" class="btn btn-success btn-block" style="text-align: center; background-color: ; color: #fff;" type="submit">GUARDAR RESPUESTAS</button>
                </form>  
              </div>
              
            </div>
        </div>
        <div class="col-xs-12 col-sm-3">
            
        </div>
        
    </div>
    @else
        <center> <strong>LA C&Eacute;DULA INGRESADA NO SE ENCUENTRA EN EL SISTEMA. SI YA REALIZÓ EL REGISTRO Y NO PUEDE CONFIRMAR LA ASISTENCIA, POR FAVOR COMUNÍQUESE DIRECTAMENTE CON RECURSOS HUMANOS <br>
        bsdisajcali@cendoj.ramajudicial.gov.co</strong> </center>
    @endif
@else
<center> 
        <strong>
             La confirmaci&oacute;n de asistencia ha sido cerrada. Aquellos que no confirmaron se entiende que no asistir&aacute;n al evento.
        </strong> 
</center>

@endif
    
</div>



 </main>


  

  
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

@stack('scripts')
</body>

</html>


