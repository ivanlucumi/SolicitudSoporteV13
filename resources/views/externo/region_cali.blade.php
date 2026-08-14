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
  <meta name="robots" content="noindex">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <title>Registro Regional Cali</title>
  
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
        @if( \Carbon\Carbon::now()->toDateString() <= "2023-06-27" && \Carbon\Carbon::now()->toTimeString() <= "17:00:00")
              
        <div class="col-md-12">
                <div class="card-header justify-content-center" align="center" style="background-color: #004182;color:white"><h3>Taller Pr&aacute;ctico para funcionarios y empleados judiciales sobre valoraci&oacute;n probatoria y adopci&oacute;n de medidas de protecci&oacute;n con enfoque de G&eacute;nero y diferencial<br> CALI - VALLE DEL CAUCA  Viernes 14 de julio de 2023  8:00 a.m. - 4:00 p.m.</h3></div>
                    <form action="{{ route('publico.regionCali.save') }}" method="POST">
    @csrf
                        <br>
                        
                     
                      <hr>
                    <div class="form-group row">
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">CEDULA:</label>
                                  <input class="form-control @error('cedula') is-invalid @enderror" placeholder="IDENTIFICACION" autocomplete="off" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">NOMBRE COMPLETO:</label>
                                  <input class="form-control @error('nombre_completo') is-invalid @enderror" placeholder="NOMBRE Y APELLIDO" autocomplete="off" type="text" name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo') }}">
@error('nombre_completo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">CIUDAD DONDE TRABAJA:</label>
                                  <input class="form-control @error('ciudad_trabajo') is-invalid @enderror" placeholder="CIUDAD DONDE TRABAJA" autocomplete="off" type="text" name="ciudad_trabajo" id="ciudad_trabajo" value="{{ old('ciudad_trabajo') }}">
@error('ciudad_trabajo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">CARGO:</label>
                                  <input class="form-control @error('cargo') is-invalid @enderror" placeholder="CARGO" autocomplete="off" type="text" name="cargo" id="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">TELEFONO:</label>
                                  <input class="form-control @error('telefono') is-invalid @enderror" placeholder="TELEFONO" autocomplete="off" type="text" name="telefono" id="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">CORREO:</label>
                                  <input class="form-control @error('correo') is-invalid @enderror" placeholder="CORREO" autocomplete="off" type="email" name="correo" id="correo" value="{{ old('correo') }}">
@error('correo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class="col-xs-12 col-md-4 form-group ">

                                        <label for="acompañante">YA ADJUNTO CEDULA:</label>
                                
                                        <div class="row">
                                
                                            <div class="col-xs-6 col-sm-6">
                                
                                                <label><input type="radio" id="cbox3" value="adjunto cedula" name="ya_adjunto_cedula"  required> SI</label>
                                
                                                </div>
                                
                                                <div class="col-xs-6 col-sm-6">
                                
                                                    <label><input type="radio" id="cbox3" value="no adjunto cedula" name="ya_adjunto_cedula"  required> NO</label>
                                
                                                </div>
                                        
                                
                                        </div>
                                
                                </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">TIPO TRANSPORTE:</label>
                                
                                  <select class="form-control @error('tipo_viajes') is-invalid @enderror" autocomplete="off" id="espe" name="tipo_viajes">
    <option value="">SELECCIONE TIPO TRANSPORTE</option>
    @foreach($transporte as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_viajes') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_viajes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                        
                        <br>
                        <center><h2> SALIDA </h2></center>
                        <hr>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">CIUDAD ORIGEN:</label>
                                  <input class="form-control @error('de_ciudad') is-invalid @enderror" placeholder="ORIGEN" autocomplete="off" type="text" name="de_ciudad" id="de_ciudad" value="{{ old('de_ciudad') }}">
@error('de_ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-4">
                                  <label for="email">CIUDAD DESTINO:</label>
                                  <input class="form-control @error('a_ciudad') is-invalid @enderror" placeholder="DESTINO" autocomplete="off" type="text" name="a_ciudad" id="a_ciudad" value="{{ old('a_ciudad') }}">
@error('a_ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">FECHA SALIDA:</label>
                                  <input class="form-control @error('fecha_de_viaje') is-invalid @enderror" placeholder="FECHA SALIDA" autocomplete="off" type="date" name="fecha_de_viaje" id="fecha_de_viaje" value="{{ old('fecha_de_viaje') }}">
@error('fecha_de_viaje')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-4">
                                  <label for="email">HORA SALIDA:</label>
                                  <input class="form-control @error('hora_salida') is-invalid @enderror" placeholder="HORA SALIDA" autocomplete="off" type="time" name="hora_salida" id="hora_salida" value="{{ old('hora_salida') }}">
@error('hora_salida')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-4">
                                  <label for="email">VALOR ESTIMADO SALIDA:</label>
                                  <input class="form-control @error('valor_estimado') is-invalid @enderror" placeholder="REGISTRE VALOR" autocomplete="off" type="number" name="valor_estimado" id="valor_estimado" value="{{ old('valor_estimado') }}">
@error('valor_estimado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <br>
                        <center><h2>REGRESO </h2></center>
                        <hr>
                         <div class=" col-xs-12 col-md-4">
                                  <label for="email">CIUDAD ORIGEN:</label>
                                  <input class="form-control @error('de_ciudad_regreso') is-invalid @enderror" placeholder="ORIGEN" autocomplete="off" type="text" name="de_ciudad_regreso" id="de_ciudad_regreso" value="{{ old('de_ciudad_regreso') }}">
@error('de_ciudad_regreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-4">
                                  <label for="email">CIUDAD DESTINO:</label>
                                  <input class="form-control @error('a_ciudad_regreso') is-invalid @enderror" placeholder="DESTINO" autocomplete="off" type="text" name="a_ciudad_regreso" id="a_ciudad_regreso" value="{{ old('a_ciudad_regreso') }}">
@error('a_ciudad_regreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">FECHA SALIDA:</label>
                                  <input class="form-control @error('fecha_regreso') is-invalid @enderror" placeholder="FECHA SALIDA" autocomplete="off" type="date" name="fecha_regreso" id="fecha_regreso" value="{{ old('fecha_regreso') }}">
@error('fecha_regreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-4">
                                  <label for="email">HORA SALIDA:</label>
                                  <input class="form-control @error('hora_regreso') is-invalid @enderror" placeholder="HORA SALIDA" autocomplete="off" type="time" name="hora_regreso" id="hora_regreso" value="{{ old('hora_regreso') }}">
@error('hora_regreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">VALOR ESTIMADO REGRESO:</label>
                                  <input class="form-control @error('valor_estimado_regreso') is-invalid @enderror" placeholder="VALOR ESTIMADO DE REGRESO" autocomplete="off" type="number" name="valor_estimado_regreso" id="valor_estimado_regreso" value="{{ old('valor_estimado_regreso') }}">
@error('valor_estimado_regreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <br>
                        <center><h2>HOTEL </h2></center>
                        <hr>
                         <div class="col-xs-12 col-md-4 form-group ">

                                        <label for="acompañante">REQUIERE HOTEL:</label>
                                
                                        <div class="row">
                                
                                            <div class="col-xs-6 col-sm-6">
                                
                                                <label><input type="radio" id="cbox3" value="REQUIERE HOTEL" name="requiere_hotel" onclick="mostrar()" required> SI</label>
                                
                                                </div>
                                
                                                <div class="col-xs-6 col-sm-6">
                                
                                                    <label><input type="radio" id="cbox3" value="NO REQUIERE HOTEL" name="requiere_hotel" onclick="ocultar()"  required> NO</label>
                                
                                                </div>
                                        
                                
                                        </div>
                                
                                </div>
                             <div class=" col-xs-12 col-md-4" id="fecha_llegada_hotel" style="display:block">
                                  <label for="email">FECHA DE LLEGADA:</label>
                                  <input class="form-control @error('fecha_llegada_hotel') is-invalid @enderror" placeholder="FECHA DE LLEGADA" autocomplete="off" id="fecha_llegada_hotel1" type="date" name="fecha_llegada_hotel" value="{{ old('fecha_llegada_hotel') }}">
@error('fecha_llegada_hotel')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-4" id="fecha_salida_hotel" style="display:block">
                                  <label for="email">FECHA DE SALIDA:</label>
                                  <input class="form-control @error('fecha_salida_hotel') is-invalid @enderror" placeholder="FECHA DE SALIDA" autocomplete="off" id="fecha_salida_hotel1" type="date" name="fecha_salida_hotel" value="{{ old('fecha_salida_hotel') }}">
@error('fecha_salida_hotel')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        
                        <div class=" col-xs-12 col-md-4">
                                  <label for="email">VALOR TOTAL VIAJE:</label>
                                  <input class="form-control @error('valor_total_viajes') is-invalid @enderror" placeholder="REGISTRE VALOR TOTAL" autocomplete="off" type="number" name="valor_total_viajes" id="valor_total_viajes" value="{{ old('valor_total_viajes') }}">
@error('valor_total_viajes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
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
        </div>
        @else
        <center>
            <h1>
                EL FORMULARIO YA NO SE ENCUENTRA DISPONIBLE, AGRADECEMOS SU COMPRESI&Oacute;N<br>
                FELIZ TARDE
            </h1>
        </center>
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
<script>
     function mostrar() {
        
          if( $('#fecha_llegada_hotel').is(":visible") ) {
            $('#fecha_llegada_hotel').css('display', 'block'); 
            $('#fecha_salida_hotel').css('display', 'block'); 
             document.getElementById("fecha_llegada_hotel1").setAttribute("required",'True');
             document.getElementById("fecha_salida_hotel1").setAttribute("required",'True');
          } else {
            $('#fecha_llegada_hotel').css('display', 'block');
            $('#fecha_salida_hotel').css('display', 'block'); 
            document.getElementById("fecha_llegada_hotel1").setAttribute("required",'True');
             document.getElementById("fecha_salida_hotel1").setAttribute("required",'True');
          }
          
          
        }
        function ocultar() {
        
          if( $('#fecha_salida_hotel').is(":visible") ) {
            $('#fecha_llegada_hotel').css('display', 'none');
            $('#fecha_salida_hotel').css('display', 'none');
            document.getElementById("fecha_llegada_hotel1").removeAttribute("required");
            document.getElementById("fecha_salida_hotel1").removeAttribute("required");
          } else {
            $('#fecha_salida_hotel').css('display', 'none');
            $('#fecha_llegada_hotel').css('display', 'none');
            document.getElementById("fecha_llegada_hotel1").removeAttribute("required");
            document.getElementById("fecha_salida_hotel1").removeAttribute("required");
          }
          
          fecha_salida_hotel
        }
</script>
@stack('scripts')


</body>

</html>


