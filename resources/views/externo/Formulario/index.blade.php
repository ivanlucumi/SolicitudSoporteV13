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
  <title>REGISTRO ASISTENCIA EVENTOS</title>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

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
          Cali - Valle del Cauca
        </p>
      </div>
      
    </div>

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
             <div class="card-header"><h3><center>REGISTRO YA NO DISPONIBLE</center></h3></div>
        <div class="col-md-12" style="display:none">
             @include('alerts.flash-message')
             @include('../alerts.success')
                @include('../alerts.request')
                <div class="card-header"><h3><center>REGISTRASE EN EVENTO DIA DE LA FAMILIA TRIBUNAL SUPERIOR DISTRITO DE CALI</center></h3></div>

                    <div class="row">
                        
                    </div>
                   
                    <form action="{{ route('externo.evento.store') }}" method="POST">
    @csrf
                         <div class="form-group row mt-2 mb-3">
                            
                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* CEDULA:</label>
                                  <input class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingrese N. C&eacute;dula" min="1" autocomplete="off" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="especialidad">* NOMBRES:</label>
                                  <input class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                        
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="especialidad">* APELLIDOS:</label>
                                  <input class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" id="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
                                </div>
                        </div> 
                        
                         <div class="form-group row mt-2 mb-3">
                             
                                <div class=" col-xs-12 col-md-4">
                                   <label for="especialidad">* DESPACHO:</label>
                                  <input class="form-control @error('despacho') is-invalid @enderror" placeholder="Ingrese Despacho" autocomplete="off" type="text" name="despacho" id="despacho" value="{{ old('despacho') }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                        
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* CARGO:</label>
                                  <input class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Cargo" autocomplete="off" type="text" name="cargo" id="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                
                                 <div class="col-xs-12 col-md-4 form-group ">

                                        <label for="acompañante">ACOMPAÑANTE:</label>
                                
                                        <div class="row">
                                
                                            <div class="col-xs-6 col-sm-6">
                                
                                                <label><input type="radio" id="cbox3" value="con_acompanhante" name="acompanhante" onclick="mostrar()" required> SI</label>
                                
                                                </div>
                                
                                                <div class="col-xs-6 col-sm-6">
                                
                                                    <label><input type="radio" id="cbox3" value="sin_acompanhante" name="acompanhante" onclick="ocultar()" required> NO</label>
                                
                                                </div>
                                        
                                
                                        </div>
                                
                                </div>
                        </div> 
                       <hr>
                       <div id="idFamiliar" style="display:none">
                       <div class="row mb-3 mt-3">
                            <h5><center>REGISTRAR ACOMPAÑANTES</center></h5>
                         </div>
                         <div class="row">
                            <div class="table-responsive">
                            <table border="1" class="table"  id="tablaDemandados">
                              <thead class="thead-dark">
                                <tr>
                                  <th>PARENTESCO</th>
                                  <th>TIPO IDENTIFICACI&Oacute;N</th>
                                  <th>IDENTIFICACI&Oacute;N</th>
                                  <th>NOMBRE (S)</th>
                                  <th>APELLIDO (S)</th>
                                </tr>
                              </thead>
                              <tr>
                             </tr>
                             <tbody>
                              </tbody>
                            </table>
                            </div>
                            <hr>
                            <div class="form-group">
                              <button type="button" class="btn btn-success mr-2" onclick="agregarFamiliar()">Agregar Fila</button>
                              <button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila</button>
                            </div>
                          </div>
                         </div>
                         <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="bt_envio" type="submit" class="btn btn-primary" >
                                    REGISTRAR INFORMACI&Oacute;N
                                </button>
                            </div>
                        </div>
                    </form>
                
        </div>
    </div>
      </div>
    </div>
    
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
<!--<script src="/js/ingreso/contadorVisitas.js"></script>-->
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script>

function agregarFamiliar(){
  document.getElementById("tablaDemandados").insertRow(2).innerHTML = `<td><input type="text" name="parentesco[]" class="col-xs-12"placeholder="Parentesco" required></td>
                                  <td><input type="text"  name="tipo_identificacion[]" placeholder="Tipo Identificacion" autocomplete="off" required></td>
                                  <td><input type="number"  name="identificacion[]" placeholder="Identificacion" autocomplete="off" min=1 required></td>
                                  <td><input type="text"  name="nombre_acompanhante[]" placeholder="Nombre(s)" autocomplete="off" required></td>
                                  <td><input type="text"  name="apellido_acompanhante[]" placeholder="Apellido(s)" autocomplete="off" required></td>`;
}

function eliminarFila(){
  var table = document.getElementById("tablaDemandados");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 2)
    consle.log('No se puede eliminar la última fila');
  else
    table.deleteRow(rowCount -1);
}

//mostrar familia
function mostrar() {
    var x = document.getElementById("idFamiliar");
    document.getElementById("tablaDemandados").insertRow(2).innerHTML = `<td><input type="text" name="parentesco[]" class="col-xs-12"placeholder="Parentesco" required></td>
                                  <td><input type="text"  name="tipo_identificacion[]" placeholder="Tipo Identificacion" autocomplete="off" required></td>
                                  <td><input type="number"  name="identificacion[]" placeholder="Identificacion" autocomplete="off" min=1 required></td>
                                  <td><input type="text"  name="nombre_acompanhante[]" placeholder="Nombre(s)" autocomplete="off" required></td>
                                  <td><input type="text"  name="apellido_acompanhante[]" placeholder="Apellido(s)" autocomplete="off" required></td>`;
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }
}

//ocultar failiar
function ocultar() {
    var x = document.getElementById("idFamiliar");
    var table = document.getElementById("tablaDemandados");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 2)
    console.log('No se puede eliminar la última fila');
  else
    table.deleteRow(rowCount -1);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
}


</script>
@stack('scripts')



</body>

</html>


