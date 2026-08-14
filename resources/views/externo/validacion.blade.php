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
  <title>Validacion de Informacion para Reparto</title>
  
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
<body style="background: #fff;" onLoad="redireccionar()">
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
                <div class="card-header justify-content-center" align="center" style="background-color: #004182;color:white"><h3>PRESENTACI&Oacute;N DEMANDAS ELECTR&Oacute;NICAS<br> JURISDICCIÓN ORDINARIA Y ADMINISTRATIVA <br> VALLE DEL CAUCA</h3></div>
                    <form action="{{ route('robot.informacion.reparto') }}" method="POST">
    @csrf
                        <br>
                        
                     
                      <hr>
                    <div class="form-group row">
                        
                         <div class=" col-xs-12 col-md-6">
                                  <label for="email">CORREO PERSONAL (ES PARA NOTIFICAR):</label>
                                  <input class="form-control @error('email') is-invalid @enderror" placeholder="Correo para notificacion de Reparto" autocomplete="off" type="email" name="email" id="email" value="{{ old('email') }}">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-6">
                                  <label for="oficinaReparto">SELECCIONE OFICINA PARA REPARTO:</label>
                                  <select class="form-control @error('oficinaReparto') is-invalid @enderror" autocomplete="off" name="oficinaReparto" id="oficinaReparto">
    <option value="">Seleccion de Especialidad</option>
    @foreach($oficinas as $key => $value)
        <option value="{{ $key }}" @selected(old('oficinaReparto') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('oficinaReparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-1">
                            </div>
                        <div class=" col-xs-12 col-md-10 mb-3 mt-3">
                             <small>Para dar cumplimiento a la Ley 1266 de 2008, a la Ley 1581 de 2012 y demás normas reglamentarias que regulan el Hábeas Data y la Protección de Datos Personales,
                            autorizo, únicamente para efectos de la presentación de esta Demanda, llevar a cabo el tratamiento de mis datos personales.</small> <br>
                            <label SIZE=1  style="text-align:center"><input type="checkbox"  value="aceptoTrataminetoDatos" name="tratamientoDeDatos" required ><strong> Acepto pol&iacute;tica de tratamiento de Datos</strong>
                            <a href="" onClick="window.open('/imgg/autorizacion_proteccion_datos.pdf','popup', 'width=800px,height=600px')">
                                <!--img src="/img/pdf.svg" alt="Product Image" class="img-fluid" style="height: 30px; max-height:50px;"-->
		                    	<div class="mask flex-center waves-effect waves-light"></div></a></label>
                                 
                        </div>
                        <div class=" col-xs-12 col-md-1">
                            </div>
                   </div>
                    <div class="form-group row mt-4 mb-4"style="background-color:">
                        <div class="col-xs-12 col-sm-4" style="background-color:yelow"></div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-5" style="background-color:">
                                <div  class="g-recaptcha" data-sitekey="6LcOzHoeAAAAAJIayuDbVH0y1w_-qGb_OiR1om1U" required></div>
                                <br>
                        </div>
                        <br>
                        <div align="center" class="col-xs-12 col-sm-4 col-md-4" style="">
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block text-danger" role="alert">
                                    <strong style="color:red">El campo NO SOY UN ROBOT, es obligatorio <!--{{ $errors->first('g-recaptcha-response') }}--></strong>
                                </span>
                               @endif
                                <br>
                            </div>
                        <div align="center" class="col-xs-12 col-sm-5 col-md-4" style="">
                                <button type="submit" class="btn btn-block" style="background-color: #004182; color: #fff;">
                                   REALIZAR PROCESO
                                </button>
                                <br>
                            </div>
                            </form>
                            <br>
                        
                    </div>
               <div class="row">
                         <a href="https://procesojudicial.ramajudicial.gov.co/TutelaEnLinea"  class="VER DOCUMENTO" target="_blank"><h3>Para Presentar Tutela Y Habeas Corpus, Haga Clic Aquí</h3></a>
                      </div>    
        </div>
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
<script language="JavaScript">
  function redireccionar() {
    setTimeout("location.href='https://www.disajcali.gov.co/formulario/validacion", 100000);
  }
  </script>

@stack('scripts')


</body>

</html>


