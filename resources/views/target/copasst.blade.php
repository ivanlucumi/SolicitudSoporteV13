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
  <title>El Copasst Seccional Valle del Cauca</title>


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

  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">
  <link rel="stylesheet" href="/css/sticky-footer.css">
  <link href="/gallery/galeria/animate.css" rel="stylesheet" />

    <!-- Light Gallery Plugin Css -->
    <link href="/gallery/galeria/light-gallery/css/lightgallery.css" rel="stylesheet">
    
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
      <div class="col-xs-12  col-md-4">
        <img src="/img/logoLargo.png" class="img-responsive">
      </div>
      <!-- Texto descriptivo del index y juzgadi-->
      <div class="col-xs-12  col-md-5">
        <p style="text-align: center; font-size: 17px; font-weight: bold;">
          <br>Consejo Superior de la Judicatura<br>
          Direcci&oacute;n Ejecutiva Seccional de Administraci&oacute;n Judicial<br>
          Cali - Valle del Cauca
        </p>
      </div>
      <div class="col-xs-12  col-md-3" >
          <div style="text-align: center; position: absolute; bottom: -80px;">
            <div id="google_translate_element" ></div>    
          </div>
          
      </div>
    </div>


 <!-- Static navbar -->
      <nav class="navbar navbar-default cBlanco" style="background-color: #004182;">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="color: #fff;"  href="{!! url('/')!!}">SIRIS CALI</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" >
              <li class=" " ><a  href="{!! url('/')!!}" style="color: #fff; ">Home</a></li>
              <li><a href="{!! url('/mision')!!}" style="color: #fff;">Misi&oacute;n</a></li>
              <li><a href="{!! url('/vision')!!}" style="color: #fff;">Visi&oacute;n</a></li>
              <li><a href="{!! url('/directorio')!!}" style="color: #fff;">Directorio Telef&oacute;nico</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #fff;">Contrataciones
                <span class="caret"></span></a>
                <ul class="dropdown-menu" style="background-color: #004182; ">
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/actos-administrativos" target="_blank" style="color: #fff;">Circulares y Actos Administrativos</a></li>
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/contratacion-de-minima-cuantia" target="_blank" style="color: #fff;">Contratación de Mínima Cuantía </a></li>
                 
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/seleccion-abreviada-de-menor-cuantia" target="_blank" style="color: #fff;">Selección Abreviada de Menor Cuantía</a></li>
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/contratacion-directa " target="_blank" style="color: #fff;">Contratación Directa</a></li>
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/concurso-de-meritos" target="_blank" style="color: #fff;">Concurso de Méritos </a></li>
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/licitacion-publica" target="_blank" style="color: #fff;">Licitación Pública</a></li>
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/plan-anual-de-adquisiciones" target="_blank" style="color: #fff;">Plan Anual de Adquisiciones</a></li>
                  <li><a href="https://www.ramajudicial.gov.co/web/direccion-seccional-de-administracion-judicial-de-cali/seleccion-abreviada-subasta-inversa" target="_blank" style="color: #fff;">Selección Abreviada Subasta Inversa</a></li>
                </ul>
              </li> 
               <li><a href="{!! url('/comite_genero')!!}" style="color: #fff;">Comíte de Genero</a></li>
              <li><a href="{!! url('/programacion_audiencias')!!}" style="color: #fff;">Audiencias</a></li>     
    
              <li><a href="{!! url('/contactenos')!!}" style="color: #fff;">Cont&aacute;ctenos</a></li>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class=""><a href="{!! url('/login')!!}" style="color: #fff;"><span class="glyphicon glyphicon-log-in">   </span>SIRIS CALI </a></li><!--active-->
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
          <div >
            <center> 
                 <video class="video-responsive" width="100%"; max-width="600px"; height="600" autoplay controls>
                    <source src="/img/1formatos/comovotar.mp4" type="video/mp4">
                    
                </video>
            </center>
          </div>

 </main>

 <footer class="footer" style="height: 80px">
      <div class="container">
        
        <div class="row">
			<div class="col-md-8 ">
				<div class="card">
					<div class="card-body d-flex justify-content-between align-items-center">
						<span class="text-muted cBlanco">&copy; Copyright 2018, Todos los Derechos Reservados - <a href="{!! url('/legal')!!}">Legal</a></span>
						
					</div>
				</div>
			</div>
			
		</div>
		
      </div>
  </footer>
  
  

  
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




<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
  $(function () {
    $('#searchtable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        
</body>

</html>