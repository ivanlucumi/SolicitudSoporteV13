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
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio telﾃｩfonico disajcali"/>
  <meta name="author" content="">
  <meta name="robots" content="noindex">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- librerﾃｭas opcionales que activan el soporte de HTML5 para IE8 -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <title>Mesa de Trabajo</title>
  
  <script src='https://www.google.com/recaptcha/api.js'></script>
   <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


<link rel="shortcut icon" href="{{asset('img/icono.png')}}">
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

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
<body style="background: #fff;" >
  <main role="main" class="container">
    <div class="row">
           <!--Logo principal index -->
      <div class="col-xs-12  col-md-6">
        <img src="/img/derecho penal.jpeg" class="img-responsive" width="380" height="220">
      </div>
        <!-- Texto descriptivo del index y juzgadi-->
      <div class="col-xs-12  col-md-6">
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
        <div class="row justify-content-left">
            
        <div class="col-md-12">
                <div class="card-header justify-content-center" align="center" style="background-color: #004182;color:white"><h3>CONSULTA ASISTENTES EVENTO</h3></div>
                <div>
                     <a class="btn btn-danger btn-block " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SALIR
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                    </form> 
                </div>
                  
                        <br>
                        
                     
                      <hr>
                      
                <div class='row'>
                    <div class="col-xs-12 col-sm-3">
                        <strong>INSCRITOS: {{$asistentes}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                       <strong> AISTENCIA 26 DE JULIO: {{$j26}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <strong> AISTENCIA 27 DE JULIO: {{$j27}}</strong> 
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <strong> AISTENCIA 28 DE JULIO: {{$j28}}</strong> 
                    </div>
                </div>
                <hr>
                    
                    <div class="form-group row">
                        
                         <div class=" col-xs-12 col-md-6">
                                  <label for="email">INGRESE NUMERO DE IDENTIFICACI&Oacute;N:</label>
                                  <input class="form-control @error('identificacion') is-invalid @enderror" placeholder="No. de identificaci&oacute;n para consulta y registro de asistencia" min="1" autocomplete="off" id="nid" type="number" name="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <hr>
                      <form action="{{ route('registro.asistencia.evento') }}" method="POST">
    @csrf
                    <div class="form-group row">
                        <div class=" col-xs-12 col-md-3">
                                  <label for="oficinaReparto">IDENTIFICACI&Oacute;N:</label>
                                  <input class="form-control @error('cedula') is-invalid @enderror" placeholder="No. de identificaci&oacute;n" min="1" autocomplete="off" id="cedula" type="number" name="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class=" col-xs-12 col-md-9">
                                  <label for="oficinaReparto">NOMBRE (S) Y APELLIDO (S):</label>
                                  <input class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre(s) y apellido(s) completo" min="1" autocomplete="off" id="nombre" type="text" name="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-5">
                                  <label for="oficinaReparto">CORREO</label>
                                  <input class="form-control @error('correo') is-invalid @enderror" placeholder="CORREO" min="1" autocomplete="off" id="correo" type="text" name="correo" value="{{ old('correo') }}">
@error('correo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-4">
                                  <label for="oficinaReparto">CARGO U OCUPACION</label>
                                  <input class="form-control @error('cargo') is-invalid @enderror" placeholder="CARGO U OCUPACION" min="1" autocomplete="off" id="cargo" type="text" name="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class=" col-xs-12 col-md-3">
                                  <label for="oficinaReparto">ASISTENCIA</label>
                                  <input class="form-control @error('asistencia') is-invalid @enderror" placeholder="ASISTENCIA" min="1" autocomplete="off" id="asistencia" type="text" name="asistencia" value="{{ old('asistencia') }}">
@error('asistencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                       
                   </div>
                    <div class="form-group row mt-4 mb-4"style="background-color:">
                        <div class="col-xs-12 col-sm-4" style="background-color:yelow"></div>
                        
                        
                        <br>
                       
                        <div align="center" class="col-xs-12 col-sm-5 col-md-4" style="display:none">
                                <button type="submit" class="btn btn-block" style="background-color: #004182; color: #fff;">
                                   REGISTRAR ASISTENCIA
                                </button>
                                <br>
                            </div>
                            </form>
                            <br>
                        
                    </div>
                 
        </div>
       
    </div>
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card-body">
                 <div class="card-header justify-content-center" align="center" style="background-color: #004182;color:white"><h4>LISTA DE PARTICIPANTES INSCRITOS {{$asistentes}}</h4></div>
                        <div class="table-responsive">
                              <table id="table9"  class="table table-hover table-condensed table-bordered ">
                                  <thead style="background-color: #AFAFAF; color: #fff;">
                                      <tr>
                                          <th>IDENTIFICACION</th>
                                          <th>NOMBRE</th>
                                          <th>CARGO U OCUPACI&Oacute;N</th>
                                          <th>CORREO</th>
                                          <th>TIPO ASISTENCIA</th>
                                          <th>26 DE JULIO</th>
                                          <th>27 DE JULIO</th>
                                          <th>28 DE JULIO</th>
                                      </tr>
                                  </thead>                  
                                      
                                      <tbody class="buscar">
                                          @foreach($registros as $key => $participante)
                                          
                                          <tr class="table-light">   
                                              <th scope="row">{{ $participante->identificacion }}</th>
                                              <th scope="row">{{ $participante->nombre }}</th>
                                              <th scope="row">{{ $participante->cargo_ocupacion }}</th>
                                              <th scope="row">{{ $participante->correo }}</th>
                                              <th scope="row">{{ $participante->asistencia }}</th>
                                              <th scope="row">{{ $participante->asistencia_ingreso_26 }}</th>
                                              <th scope="row">{{ $participante->asistencia_ingreso_27 }}</th>
                                              <th scope="row">{{ $participante->asistencia_ingreso_28 }}</th>
                                          </tr>
                                          @endforeach	 
                                         
                                      </tbody>
                              </table>
                          </div>
                        
                       </div>
        </div>
    </div>
      </div>
    </div>
    
  
    
</div>


 </main>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  
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
  //VISITANTE

    var verifCedula = document.getElementById('nid');
    verifCedula.addEventListener('input', function() {

        console.log(this.value.nid);
        

        $.get("/consulta/cedula/asistencia/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                
                document.getElementById('cedula').value = "";
                document.getElementById('nombre').value = "";
                document.getElementById('correo').value = "";
                document.getElementById('cargo').value = "";
                document.getElementById('asistencia').value = "";
                
                document.getElementById('cedula').value = response.identificacion;
                document.getElementById('nombre').value = response.nombre;
                document.getElementById('correo').value = response.correo;
                document.getElementById('cargo').value = response.cargo_ocupacion;
                document.getElementById('asistencia').value = response.asistencia;
                
                Toastify({
                      text: "SE REGISTRO ASISTENCIA PARA EL USUARIO "+response.nombre+" CON NUMERO DE IDENTIFICACION "+response.identificacion,
                      duration: 4000,
                      //destination: "https://github.com/apvarun/toastify-js",
                      newWindow: true,
                      close: true,
                      gravity: "top", // `top` or `bottom`
                      position: "center", // `left`, `center` or `right`
                      stopOnFocus: true, // Prevents dismissing of toast on hover
                      style: {
                        background: "linear-gradient(to right, #ce1332, #96c93d)",
                      },
                      onClick: function(){} // Callback after click
                    }).showToast();
                
                document.getElementById('nid').value = "";
                
            } else {
                
                document.getElementById('cedula').value = "";
                document.getElementById('nombre').value = "";
                document.getElementById('correo').value = "";
                document.getElementById('cargo').value = "";
                document.getElementById('asistencia').value = "";
                
               
            }
        });

    }); 
</script>

<!-- Llamar a los complementos javascript-->

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
   formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
   position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
   bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
   fileName: "Mesas de trabajo",    //Nombre del archivo 
});
$(document).click(function(){
   //autofocus
  document.getElementById("nid").focus();
})

function ContarIngresos() {
       
    //focus
    document.getElementById("nid").focus();
    
    }
    setInterval(ContarIngresos, 40000); 

</script>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCuatroUno.js"></script> 

@stack('scripts')


</body>

</html>


