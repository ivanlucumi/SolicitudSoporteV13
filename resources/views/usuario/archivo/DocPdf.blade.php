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
  <title>@yield('title')</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="shortcut icon" href="{{asset('img/icono.png')}}">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GQV5YWSC6Y"></script>


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
  <main role="main" class="container-fluid" style="width: 90%">
    <div class="row">
      <!--Logo principal index -->
      <table id="table9" class="table table-bordered table-striped  table-condensed table-hover" >
               <tbody class="shadow" >
                 <tr>  <th>
                        <img src="data:image/png;base64,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" alt="">
                       </th>
                     <th>
                        <p style="text-align: center; font-size: 17px; font-weight: bold;">
                            <br>Consejo Superior de la Judicatura<br>
                              Direcci&oacute;n Ejecutiva Seccional de Administraci&oacute;n Judicial<br>
                              Comit&eacute; Seccional de Archivo Judicial <br>
                              Distrito Judicial de Cali
                          </p>
                       </th>
                 </tr>
                </tbody>
        </table>
    </div>
    <div class="container-fluid">
        <div class="row">
            <p>
                <center>
                    <h5>
                        FORMATO DE PROTOCOLO PARA EL MANEJO Y LA SEGURIDAD DEL ARCHIVO JUDICIAL 
                    </h5>
                </center>
                
                <center>
                    <h3>
                        <strong>
                        FPS001(V03):  AUTORIZACION INGRESO DE PERSONAL EXTERNO
                        </strong>
                    </h3>
                </center>
            </p>
        </div>
        <br>
        <div class="row" >
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;">FECHA DE LA SOLICITUD:</div>
            <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;">DIA:</div>
            <div class="col-xs-12 col-sm-3" style="margin-top: 20px;border-bottom: 0.5px solid ;">MES:</div>
            <div class="col-xs-12 col-sm-3" style="margin-top: 20px;border-bottom: 0.5px solid ;">AÑO:</div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;">DESPACHO JUDICIAL QUE SOLICITA:</div>
            <div class="col-xs-12 col-sm-8" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;">FUNCIONARIO TITULAR:</div>
            <div class="col-xs-12 col-sm-8" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;">NOMBRE DE LA PERSONA AUTORIZADA:</div>
            <div class="col-xs-12 col-sm-8" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;">CEDULA DE CIUDADANIA:</div>
            <div class="col-xs-12 col-sm-8" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-3" style="margin-top: 20px;border-bottom: 0.5px solid ;">EPS:</div>
            <div class="col-xs-12 col-sm-3" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
            <div class="col-xs-12 col-sm-3" style="margin-top: 20px;border-bottom: 0.5px solid ;">ARL:</div>
            <div class="col-xs-12 col-sm-3" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-6" style="margin-top: 20px;border-bottom: 0.5px solid ;">FECHA DE INGRESO AL ARCHIVO CENTRAL: DESDE:</div>
            <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
             <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;">HASTA: </div>
              <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;">HORARIO DE PERMANENCIA:</div>
            <div class="col-xs-12 col-sm-8" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-7" style="margin-top: 20px;border-bottom: 0.5px solid ;">NOMBRE DEL EMPLEADO DE LA RAMA JUDICIAL RESPONSABLE:</div>
            <div class="col-xs-12 col-sm-5" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;">CARGO:</div>
            <div class="col-xs-12 col-sm-10" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 5px">
            <p>
                <center>
                    <strong>
                        <h3>CONTACTO EN CASO DE EMERGENCIA</h3>
                    </strong>
                </center>
            </p>
        </div>
         <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;">NOMBRE:</div>
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
            <div class="col-xs-12 col-sm-2" style="margin-top: 20px;border-bottom: 0.5px solid ;">TELEFONO:</div>
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-12 col-sm-4" style="margin-top: 20px;border-bottom: 0px solid ;">ACTIVIDAD QUE SE REALIZA:</div>
            <div class="col-xs-12 col-sm-12" style="margin-top: 20px;border-bottom: 0.5px solid ;"> </div>
        </div>
        <div class="row" style="margin-top: 80px">
            <div class="col-xs-12 col-sm-6">
               <div class="col-xs-12 col-sm-12" style="margin-top: 20px;border-bottom: 0.5px solid ;"></div>
            <div class="col-xs-12 col-sm-12" ><p><center>Firma del titular del despacho</center></p> </div> 
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="col-xs-12 col-sm-12" style="margin-top: 20px;border-bottom: 0.5px solid ;"></div>
            <div class="col-xs-12 col-sm-12" ><p><center>Vo. Bo.  Oficina Judicial de Cali</center></p> </div> 
            </div>
            
        </div>
        <div class="row" style="margin-top: 80px">
            <div class="col-xs-12 col-sm-12" style="margin-top: 20px;border-bottom: 0.5px solid ;"></div>
            <div class="col-xs-12 col-sm-12" ><p><center>Autorización Dirección Ejecutiva Seccional de Administración Judicial
                Clara Inés Ramirez Sierra</center></p> </div>
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


</body>

</html>