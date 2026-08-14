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
  <title>Ventanilla Presentaci&oacute;n Demandas Virtuales Valle Del Cauca</title>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

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

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12">
             @include('alerts.flash-message')
                <div class="card-header" style="background-color: #004182;color:white"><h4><center>PRESENTACI&Oacute;N DEMANDAS ELECTR&Oacute;NICAS<br> JURISDICCI&Oacute;N ORDINARIA Y ADMINISTRATIVA <br> VALLE DEL CAUCA</center></h4></div>
            
                    <div class="row">
                        <p><center><h4>CARÁTULA DEL PROCESO</h4></center></p>
                    </div>
                    <div class="row">
                        <p><center><h4><strong style="color:red">AVISO IMPORTANTE</strong>:  El horario para la RECEPCIÓN de demandas electrónicas, es de LUNES a VIERNES de 8:00 a.m a 5:00 p.m, por lo que las demandas presentadas fuera del horario, serán tramitadas al siguiente dia hábil.</h4></center></p>
                    </div>
                   <hr>
                    <form enctype="multipart/form-data" onsubmit="return validarImagen();" action="{{ route('externo.reparto') }}" method="POST">
    @csrf
                         <div class="form-group row mt-2 mb-3">
                            
                                <div class=" col-xs-12 col-md-5">
                                  <label for="especialidad">* ESPECIALIDAD:</label>
                                
                                  <select class="form-control @error('especialidad') is-invalid @enderror" autocomplete="off" id="espe" name="especialidad">
    <option value="">Seleccione Especialidad</option>
    @foreach($gruposRe as $key => $value)
        <option value="{{ $key }}" @selected(old('especialidad') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                
                                <div class=" col-xs-12 col-md-4">
                                  <label for="nombre_grupo">* NOMBRE GRUPO:</label>
                                    <select required id='nombre_gr' name="nombre_grupo" class="form-control"  >
					
			                    	</select>
                                        
                                </div>
                                <div class=" col-xs-12 col-md-3" id="comuna">
                                    
                                </div>
                        </div> 
                        <div class="row mb-3 mt-3">
                            <h5><center>DATOS DEL DEMANDANTE</center></h5>
                         </div>
                         <div class="row">
                            <table border="1" class="table" id="tablaDemandante">
                              <thead class="thead-dark">
                                <tr>
                                  <th> IDENTIFICACI&Oacute;N</th>
                                  <th>* NOMBRE (S)</th>
                                  <th> APELLIDO (S)</th>
                                </tr>
                              </thead>
                               <tr><td><input type="number"  id="demandanteT"   name="ceduladte[]" class="col-xs-12" placeholder="No. Identificación" autocomplete="off"></td><td><input type="text"  name="nombredte[]"  placeholder="Nombre Completo" autocomplete="off" ></td><td><input type="text"  name="apellidodte[]"  placeholder="Apellido Completo" autocomplete="off"></td></tr>
                              
                              <tbody>
                              </tbody>
                            </table>
                        
                            <div class="form-group">
                              <button type="button" class="btn btn-primary mr-2" onclick="agregarFilaD()">Agregar Fila Demandante</button>
                              <button type="button" class="btn btn-danger" onclick="eliminarFilaD()">Eliminar Fila Demandante</button>
                            </div>
                          </div>
                          
                          <div class="row mb-3 mt-3">
                            <h5><center>DATOS DEL DEMANDADO</center></h5>
                         </div>
                         <div class="row">
                            <table border="1" class="table"  id="tablaDemandados">
                              <thead class="thead-dark">
                                <tr>
                                  <th>IDENTIFICACI&Oacute;N</th>
                                  <th>NOMBRE (S)</th>
                                  <th>APELLIDO (S)</th>
                                  <!--th>CORREO</th-->
                                </tr>
                              </thead>
                              <tr><td><input type="number" id="demandadoD"  name="ceduladado[]"  class="col-xs-12"placeholder="No. Identificación" ></td><td><input type="text"  name="nombredado[]" placeholder="Nombre Completo"  autocomplete="off" required></td><td><input type="text"  name="apellidodado[]"  placeholder="Apellido Completo" autocomplete="off" ></td><!--td><input type="email"  name="correo_notif_ddo[]" placeholder="Correo Demandado" autocomplete="off" ></td--></tr><tbody>
                              </tbody>
                            </table>
                        
                            <div class="form-group">
                              <button type="button" class="btn btn-primary mr-2" onclick="agregarFila()"> Agregar Fila Demandado</button>
                              <button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila Demandado</button>
                            </div>
                          </div>
                          
                          <div class="row mb-3 mt-3">
                            <h5><center>DATOS DEL APODERADO</center></h5>
                         </div>
                         <div class="row">
                             <div class=" col-xs-12 col-md-4">
                                  <label for="cedulaA">IDENTIFICACI&Oacute;N APODERADO:</label>
                                  <input class="form-control @error('cedulaA') is-invalid @enderror" placeholder="No. Identificaci&oacute;n" autocomplete="off" type="number" name="cedulaA" id="cedulaA" value="{{ old('cedulaA') }}">
@error('cedulaA')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                <div class=" col-xs-12 col-md-5">
                                  <label for="nombreA">NOMBRE (S) Y APELLIDO (S):</label>
                                  <input class="form-control @error('nombreA') is-invalid @enderror" placeholder="Nombre Completo" autocomplete="off" type="text" name="nombreA" id="nombreA" value="{{ old('nombreA') }}">
@error('nombreA')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                <div class=" col-xs-12 col-md-3">
                                  <label for="tarjetaP">TARJETA PROFESIONAL:</label>
                                  <input class="form-control @error('tarjetaP') is-invalid @enderror" placeholder="Tarjeta Profesional" autocomplete="off" type="text" name="tarjetaP" id="tarjetaP" value="{{ old('tarjetaP') }}">
@error('tarjetaP')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                          </div>
                           <div class="row mb-3 mt-3">
                            <h5><center>INFORMACION DEL DOCUMENTO</center></h5>
                         </div>
                         <div class="row">
                             <div class=" col-xs-12 col-md-2">
                                  <label for="cuaderno">* CUADERNO (S):</label>
                                  <input class="form-control @error('cuaderno') is-invalid @enderror" placeholder="Cantidad cuadernos" autocomplete="off" type="number" name="cuaderno" id="cuaderno" value="{{ old('cuaderno') }}">
@error('cuaderno')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                                <div class=" col-xs-12 col-md-3">
                                  <label for="folios">* FOLIOS:</label>
                                  <input class="form-control @error('folios') is-invalid @enderror" placeholder="Cantidad de folios" autocomplete="off" type="text" name="folios" id="folios" value="{{ old('folios') }}">
@error('folios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                          </div>
                           <div class="row mb-3 mt-3">
                            <h5><center>ANOTACIONES ESPECIALES (DOCUMENTOS ORIGINALES / FOLIO) / OBSERVACIONES</center></h5>
                         </div>
                         <div class="row">
                             <div class=" col-xs-12 col-md-12">
                                  <textarea class="form-control @error('observaciones') is-invalid @enderror" placeholder="OBSERVACIONES" autocomplete="off" style="height: 90px;" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                        
                                </div>
                          </div>
                          <div class="row mb-3 mt-3">
                              <h5><center>TEL&Eacute;FONO DE CONTACTO </center></h5>
                              <div class="col-xs-12 col-sm-4"></div>
                              <div class="col-xs-12 col-sm-4">  <center>
                                  <input class="form-control @error('contacto') is-invalid @enderror" placeholder="Ingrese N&uacute;mero de t&eacute;lefono" autocomplete="off" type="number" name="contacto" id="contacto" value="{{ old('contacto') }}">
@error('contacto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </center></div>
                             
                              <div class="col-xs-12 col-sm-4"></div>
                            
                          
                         </div>
                          
                          <div class="row mb-3 mt-3">
                            <h5><center>CARGA DE DOCUMENTOS</center></h5>
                         </div>

                        <div class="form-group row mt-3 mb-3">
                            
                                <div class=" col-xs-12 col-md-4">
                                  <label for="archivo">* Demanda y Poder solo Pdf:</label> <br>                            
                                  <input accept=".pdf" class="form-control-file form-group @error('demanda') is-invalid @enderror" id="demanda" onchange="return fileValidation()" type="file" name="demanda">
@error('demanda')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                    <label for="archivo"> Anexos (Menos 20Mb):</label>  <br>                          
                                    <input accept=".rar,.zip" class="form-control-file form-group @error('anexos') is-invalid @enderror" id="anexos" onchange="return sizeValidation()" type="file" name="anexos">
@error('anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                          
                                  </div>
                                <div class=" col-xs-12 col-md-4">
                                    <label for="archivo">Enlace para anexos de mas de 20MB:</label>                            
                                    <input class="form-control form-group @error('url_anexos') is-invalid @enderror" placeholder="Pegar el enlace del repositorio " type="text" name="url_anexos" id="url_anexos" value="{{ old('url_anexos') }}">
@error('url_anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                          
                                  </div>
                                  
                                    
                        </div>  
                        
                        <input class="form-control" autocomplete="off" type="hidden" name="email" id="email" value="{{ $email }}">
                        <input class="form-control" autocomplete="off" type="hidden" name="oficinaReparto" id="oficinaReparto" value="{{ $oficinaReparto }}">
                        <p>
                            <span>
                                Los campos con * son obligatorios
                            </span>
                        </p>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button id="bt_envio" type="submit" class="btn btn-primary" onclick="envio()">
                                    ENVIAR PROCESO
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
<script language="JavaScript">
  function redireccionar() {
    setTimeout("location.href='https://www.disajcali.gov.co/formulario/validacion", 1000000);
  }
  </script>
<script>
/*$(window).on('load', function() {
    console.log('All assets are loaded')
    setTimeout(console.log("Funcion cargada al inicio 3"),100000);
})
function CerrarPorTiempo(){
    console.log("Funcion cargada al inicio");
    setTimeout(console.log("Funcion cargada al inicio 2"),20000);

    //setTimeout(location.href ="https://www.disajcali.gov.co/formulario/validacion",60000);
    
}*/

//FUNCION PARA VERIFICAR TIPO DE ARCHIVOS

function fileValidation(){
    var fileInput = document.getElementById('demanda');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor, seleccione solo documentos en formato PDF');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="+e.target.result+"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    
  }
  
  function sizeValidation() {
    var fileSize = $('#anexos')[0].files[0].size;
    var anexos = document.getElementById('anexos');
    var siezekiloByte = parseInt(fileSize / 1024);
    //alert(siezekiloByte);
    if (siezekiloByte >  15000) {
        anexos.value = '';
        alert("Anexo no cumple con el tamaño, Archivo muy grande");
        alert("Cuando el tamaño supere el Máximo exigido, remitir el link donde comparte los archivos");
        anexos.value = '';
        return false;
    }
}



function envio(){
  var canDismiss = false;
 var notification = alertify.error('Espera un momento.....Enviando informacion!');
 notification.ondismiss = function(){ return canDismiss; };
 setTimeout(function(){ canDismiss = true;}, 80000);
 
 setTimeout(function(){
    document.getElementById("bt_envio").style.backgroundColor = "red";
  }, 1000)
    
}

function agregarFila(){
  document.getElementById("tablaDemandados").insertRow(2).innerHTML = '<tr><td><input type="number" id="demandanteT"  name="ceduladado[]" class="col-xs-12"placeholder="Identificación Demandado" ></td><td><input type="text"  name="nombredado[]" placeholder="Nombre Completo" autocomplete="off" required></td><td><input type="text"  name="apellidodado[]" placeholder="Apellido Completo" autocomplete="off" ></td><!--td><input type="email"  name="correo_notif_ddo[]" placeholder="Correo Demandado" autocomplete="off" ></td--></tr>';
}

function eliminarFila(){
  var table = document.getElementById("tablaDemandados");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 2)
    alert('No se puede eliminar la última fila');
  else
    table.deleteRow(rowCount -1);
}

function agregarFilaD(){
  document.getElementById("tablaDemandante").insertRow(2).innerHTML = ' <tr><td><input type="number"  id="demandadoD"  name="ceduladte[]" class="col-xs-12" placeholder="Identificación Demandante" autocomplete="off"></td><td><input type="text"  name="nombredte[]" placeholder="Nombre Completo" autocomplete="off" ></td><td><input type="text"  name="apellidodte[]" placeholder="Apellido Completo" autocomplete="off"></td></tr>';
}

function eliminarFilaD(){
  var table = document.getElementById("tablaDemandante");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 2)
    alert('No se puede eliminar la última fila');
  else
    table.deleteRow(rowCount -1);
}
</script>
<script>

var select = document.getElementById('espe');
var s_comuna = document.getElementById('comuna');
select.addEventListener('change',
  function(){
    var selectedOption = this.options[select.selectedIndex];
    //console.log(selectedOption.value + ': ' + selectedOption.text);
    $.get("/formulario/reparto/grupo/" + selectedOption.value + "", function(response) {
            
            if (Object.keys(response).length > 0) {
                s_comuna.innerHTML = "";
                    $("#nombre_gr").empty();
                     $("#nombre_gr").append("<option value='' >Seleccione Grupo</option>");

                    for(i=0; i<response.length; i++){

                    $("#nombre_gr").append("<option value="+"("+response[i].codigo+") "+" "+response[i].nombre_grupo+"'>"+"("+response[i].codigo+") "+response[i].nombre_grupo+"</option>");

                     }
                if(selectedOption.value == 10){
                    $("#comuna").append(`<label for="COMUNA">COMUNA:</label><br><select required name="comuna" class="form-control"  >
                    <option value='' >Comuna de residencia</option>"
					  <option value="COMUNA_1">COMUNA 1</option>
					    <option value="COMUNA_2">COMUNA 2</option>
					     <option value="COMUNA_3">COMUNA 3</option>
					      <option value="COMUNA_4">COMUNA 4</option>
					       <option value="COMUNA_5">COMUNA 5</option>
					        <option value="COMUNA_6">COMUNA 6</option>
					         <option value="COMUNA_7">COMUNA 7</option> 
					          <option value="COMUNA_8">COMUNA 8</option>
					          <option value="COMUNA_9">COMUNA 9</option>
					           <option value="COMUNA_10">COMUNA 10</option>
					            <option value="COMUNA_11">COMUNA 11</option>
					             <option value="COMUNA_12">COMUNA 12</option>
					              <option value="COMUNA_13">COMUNA 13</option>
					               <option value="COMUNA_14">COMUNA 14</option>
					                <option value="COMUNA_15">COMUNA 15</option>
					                 <option value="COMUNA_16">COMUNA 16</option>
					                  <option value="COMUNA_17">COMUNA 17</option>
					                   <option value="COMUNA_18">COMUNA 18</option>
					                    <option value="COMUNA_19">COMUNA 19</option>
					                    <option value="COMUNA_20">COMUNA 20</option>
					                     <option value="COMUNA_21">COMUNA 21</option>
					                      <option value="COMUNA_22">COMUNA 22</option>
			         </select>`);
                }else{
                    s_comuna.innerHTML = "";
                }
                
            } 
        });
              

  });
  
 
 /* ceddte.oninput = function() {
    //result.innerHTML = ceddte.value;
    alert(ceddte.value);

  };*/

  //const input = document.querySelector('ceddte');
  const input = document.getElementById('demandadoD');
  const cdante = document.getElementById('demandanteT');
  var select = document.getElementById('espe');
  var selectgr = document.getElementById('nombre_gr');
//const log = document.getElementById('log');

input.addEventListener('change', updateValue);

function updateValue(e) {
 
  var especialidad = select.value;
  var nombre_grupo = selectgr.value;
  var ceddado = input.value;
  var ceddante = cdante.value;
 

  var dataString = 'especialidad=' + especialidad + '&nombre_grupo=' + nombre_grupo + '&ceddado=' + ceddado + '&ceddante=' + ceddante;

//alert(dataString)

   $.ajax({

    type: "GET",
    url: "/consultar/proceso/",
    data: dataString,
    dataType:"html",
    asycn:false,
    success: function(response){
      console.log(response)
     if(response == "True"){
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Ya Presentó Documentos con los mismo Datos',
          text: "Desea continua?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, estoy seguro',
          cancelButtonText: 'No, Cancelar!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            /*swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )*/
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            location.href ="https://www.disajcali.gov.co/formulario/validacion";
           /* swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )*/
          }
        })

     }
      
      

    }
    });

    

}

    
</script>
@stack('scripts')



</body>

</html>


