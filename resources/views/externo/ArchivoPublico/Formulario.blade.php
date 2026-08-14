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
  <title>Solicitud de Audiencias Preliminares</title>

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
        
  {{-- CDN de SweetAlert2 (una sola vez en tu layout) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<div class="container-fluid">
    
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12">
             
                <div class="card-header" style="background-color: #004182;color:white"><h4><center>CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS PENALES MUNICIPALES Y DEL CIRCUITO DE CALI<br> VALLE DEL CAUCA</center></h4></div>
            
                    <div class="row">
                         <div class="col-xs-12 col-sm-9">
                            <p><center><h4>FORMULARIO &Uacute;NICO PARA SOLICITUD DE AUDIENCIAS DEL SISTEMA PENAL ACUSATORIO</h4></center> <br>
                            <center><h5><strong style="color:red">AVISO IMPORTANTE</strong>: Las solicitudes deben ser presentadas de manera individual, por cada n&uacute;mero de radicación SPOA, deber&aacute; diligenciarse una solicitud. </h5></center></p>
                       
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <br>
                            <span style="color:red">Para conocer estado de la solicitud da clic en el bot&oacute;n</span>
                            <br>
                            <center>
                               <a class="mt-3 mb-3 py-3" href="https://www.disajcali.gov.co/consulta/ficha/preliminar">
                                <button class="btn btn-warning">Consultar Estado</button>
                              </a>  
                            </center>
                             
                              
                        </div>
                        <p>
                            @include('../alerts.request')
                        </p>
                        
                        @if (session('error'))
                          <script>
                            document.addEventListener('DOMContentLoaded', function () {
                              const msg = @json(session('error')); // mantiene <br> como HTML
                              Swal.fire({
                                title: 'Ocurrió un error',
                                html: msg,                // usa html para respetar los <br>
                                icon: 'error',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#dc2626',
                              });
                            });
                          </script>
                        @endif
                        
                        @if (session('success'))
                          <script>
                            document.addEventListener('DOMContentLoaded', function () {
                              const msg = @json(session('success')); // mantiene el HTML intacto
                              Swal.fire({
                                title: '✅ Solicitud enviada',
                                html: msg, // permite los <br> y etiquetas HTML
                                icon: 'success',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#004182',
                                background: '#fefefe',
                                allowOutsideClick: false,
                              });
                            });
                          </script>
                        @endif
                        
                    </div>
                    
                   <hr>
                    <form id="MiFormulario" enctype="multipart/form-data" class="was-validated" action="{{ route('publico.ficha.preliminar.save') }}" method="POST">
    @csrf 
        <div class="row">
            
            <div class="col-xs-12 col-sm-1"></div>
            <div class="col-xs-12 col-sm-10">
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> RADICACI&Oacute;N (23 D&iacute;gitos):</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                       <input class="form-control  @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" min="1" placeholder="Ingrese número de radicado" autocomplete="off" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso') }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <span id="cantidad">. </span>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CEDULA PROCESADO:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('cedula_procesado') is-invalid @enderror" placeholder="Ingrese Cedula Procesado" autocomplete="off" type="text" name="cedula_procesado" id="cedula_procesado" value="{{ old('cedula_procesado') }}">
@error('cedula_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> PROCESADO:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('procesado') is-invalid @enderror" placeholder="Ingrese Nombre Procesado" autocomplete="off" type="text" name="procesado" id="procesado" value="{{ old('procesado') }}">
@error('procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> TIPO SOLICITUD:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<select class="form-control @error('tipo_solicitud') is-invalid @enderror" autocomplete="off" id="tipo_solicitud" name="tipo_solicitud">
    <option value="">Seleccione Tipo Solicitud</option>
    @foreach($tipoAudiencia as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <!--div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> URL PARA ANEXOS:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	        	<input class="form-control @error('url_expediente') is-invalid @enderror" placeholder="Registre URL en Caso de Pruebas" autocomplete="off" type="url" name="url_expediente" id="url_expediente" value="{{ old('url_expediente') }}">
@error('url_expediente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                   </div> 
                </div-->
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> DOCUMENTO SOLICITUD:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
        	        	<input class="form-control-file form-group @error('anexos') is-invalid @enderror" id="file_anexo" accept="application/pdf" type="file" name="anexos">
@error('anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                   </div> 
                </div><br>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> C&Eacute;DULA DE QUIEN SOLICITA:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('cedula_quien_solicita') is-invalid @enderror" placeholder="Ingrese C&eacute;dula de quien hace la Solicitud" autocomplete="off" min="1000" type="number" name="cedula_quien_solicita" id="cedula_quien_solicita" value="{{ old('cedula_quien_solicita') }}">
@error('cedula_quien_solicita')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> NOMBRE DE QUIEN SOLICITA:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('quien_solicita') is-invalid @enderror" placeholder="Ingrese Nombre de quien hace la Solicitud" autocomplete="off" type="text" name="quien_solicita" id="quien_solicita" value="{{ old('quien_solicita') }}">
@error('quien_solicita')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> CORREO ELECTR&Oacute;NICO:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('email_notificacion') is-invalid @enderror" id="email" placeholder="Ingrese Correo para ser Notificado" autocomplete="off" type="email" name="email_notificacion" value="{{ old('email_notificacion') }}">
@error('email_notificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                      	<span id="errorEmail" style="color:red;"></span>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>CELULAR:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control  @error('telefono') is-invalid @enderror" placeholder="Ingrese Celular Contacto" autocomplete="off" min="10" type="number" name="telefono" id="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                
                  @if(!empty($despachoActivo))
                    <hr>
                        <div class="row">
                        <p>
                            <center>
                                Señor Usuario: <br>
                                Si se presenta un error al enviar la solicitud, puede remitir un correo electrónico al juzgado de turno.<br>
                                Juzgado: <strong>{{$despachoActivo->nombreDespacho}}</strong><br>
                                Correo: <strong>{{$despachoActivo->correoD}}</strong>
                            </center>
                        </p>
                    </div>
                    @else
                    
                    @endif
                 
                 <hr>
                 <div class="row">
                      <div class="form-group">
                        <div align="center" class="col-xs-12">
                            <div  class="g-recaptcha" data-sitekey="6LcOzHoeAAAAAJIayuDbVH0y1w_-qGb_OiR1om1U"></div>
                            <br>
                            <!-- MEWS CAPTCHA -->
                            <div class="captcha" style="margin-bottom: 15px;">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-danger" id="reloadCaptcha" style="padding: 6px 12px; margin-left: 5px;" title="Cambiar Captcha">
                                    &#x21bb;
                                </button>
                            </div>
                            <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Ingrese el texto de la imagen" name="captcha" style="max-width: 300px; margin: 0 auto;" required autocomplete="off">
                            
                            @error('captcha')
                                <span class="help-block text-danger" role="alert">
                                    <strong style="color:red">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div align="center" class="col-xs-12">
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-danger" role="alert">
                                <strong style="color:red">El campo NO SOY UN ROBOT, es obligatorio <!--{{ $errors->first('g-recaptcha-response') }}--></strong>
                            </span>
                           @endif
                            
                        </div>
                        <br>
                        <div>
                            <p>
                                <center>
                                    Señor usuario, si pasadas 36 horas no le ha llegado correo electr&oacute;nico inform&aacute;ndole el número de Juzgado a quien le correspondio su solicitud, por favor comuníquese al siguiente número 6028986868 ext.2602.
                                </center>
                            </p>
                        </div>
                        <div id="mensaje-container">
                            <p id="mensaje"></p>
                        </div>
                        <div align="center" class="col-xs-12">
                            <button id="btsubmit" class="btn btn-success btn-block" style="text-align: center; background-color: #004182; color: #fff;" onclick="enviarFormulario()" type="submit">REALIZAR SOLICITUD</button>
                            </form>
                            <div id="console" style="display:none">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                                  <span class="sr-only">ESPERANDO RESPUESTA......</span>
                                  
                                </div>
                            </div>
                            
                            <br>
                        </div>
                        
                    </div>
                   
         </div>     
    
  
        
    </div>
    <div class="col-xs-12 col-sm-1"></div>
    
</div>

 <!-- Modal de espera -->
<div class="modal" id="modalEspera" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p><center> Enviando formulario, por favor Espera.....</center></p>
            </div>
        </div>
    </div>
</div>                   
                
        </div>
    </div>
      </div>
    </div>
    
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
  // Elemento que quieres resaltar
  var opcionResaltada = document.querySelector('#tipo_solicitud option[value="AUDIENCIA GARANTIAS ACTOS URGENTES"]');
  // Aplicar estilo al elemento
  opcionResaltada.style.color = "red";
});

var select = document.getElementById('tipo_solicitud');
select.addEventListener('change',
 function(){
    var selectedOption = this.options[select.selectedIndex].value;
    console.log(selectedOption)
    if(selectedOption =="AUDIENCIA GARANTIAS ACTOS URGENTES"){
        alert('¿Seguro su solicitud de audiencia vence en 36 horas?')
    }
 }
  );
  
</script>

<script>
// Obtenemos todos los campos de entrada
const inputs = document.querySelectorAll('input');

// Iteramos sobre cada campo y agregamos un evento 'input' para convertir el texto a mayúsculas
inputs.forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
});
</script>


<script>
     /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })


    //verificar los 23 digitos
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' d&iacute;gitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' d&iacute;gitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' d&iacute;gitos</span></strong>';
        }
    })
    

</script>

<script>
const emailInput = document.getElementById("email");
const errorSpan = document.getElementById("errorEmail");

// 🔥 La "i" al final permite mayúsculas y minúsculas
//const regex = /^[a-z0-9][a-z0-9._-]*@(fiscalia\.gov\.co|gmail\.com|hotmail\.com)$/i;
const regex = /^[a-zA-Z0-9](?:[a-zA-Z0-9._%+-]{0,62}[a-zA-Z0-9])?@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

emailInput.addEventListener("input", function () {

    const email = this.value.trim();

    if (email === "") {
        errorSpan.textContent = "";
        this.style.border = "";
        return;
    }

    if (!regex.test(email)) {
        errorSpan.textContent = "Correo inválido. Los Correos no debe iniciar con caracteres especiales.";
        this.style.border = "2px solid red";
    } else {
        errorSpan.textContent = "";
        this.style.border = "2px solid green";
    }
});
</script>



 <!--script type="text/javascript">
    // usando javascript
    window.addEventListener("load", function() {
    input = document.getElementById("btsubmit");
    input.addEventListener("click", clicked, false);
    
});
function clicked() {
    
document.getElementById("btsubmit").disabled = true;
setTimeout(function() {
    $('#btsubmit').prop('disabled', false);
  }, 12000);
  document.getElementById("console").style.display = "block";
 setTimeout(function() {
    document.getElementById("console").style.display = "none";
  }, 12000); 
  
  
}

</script-->

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
    setTimeout("location.href='https://www.disajcali.gov.co/solicitud/ficha/preliminar", 900000000);
  }
</script>

<script>
document.getElementById('file_anexo').onchange = function() {
    var archivo = this.files[0];
    var maxSize = 20 * 1024 * 1024;

    if (archivo.size > maxSize) {
        alert('El tamaño del archivo es demasiado grande. Por favor, seleccione un archivo más pequeño.');
        this.value = ''; // Limpiar el campo de archivo
    }
};
</script>

<script>


    function enviarFormulario() {
        // Mostrar el modal de espera
        
        if (!validarFormulario()) {
            return false;
        }
        
        $('#modalEspera').modal('show');
        
        setTimeout(function() {
                $('#modalEspera').modal('hide');
            }, 5000);

        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById('MiFormulario'));
        
        var url = formData.attr('action');
        var data = formData.serialize();
        
        
        // Enviar la solicitud al controlador
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function(response) {
                // Manejar la respuesta del controlador

                // Cerrar el modal de espera
                $('#modalEspera').modal('hide');
            },
            error: function(error) {
                // Manejar errores

                // Cerrar el modal de espera
                $('#modalEspera').modal('hide');
            }
        });
    }
</script>

<script>
    function validarFormulario() {
        // Validar el captcha
        if (typeof grecaptcha !== 'undefined') {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validación requerida',
                    text: 'Por favor complete el campo "No soy un robot"',
                    confirmButtonColor: '#004182'
                });
                return false;
            }
        }

        // Validar el número de radicado (23 dígitos)
        var radicado = document.getElementById('nProceso').value;
        if (radicado.length !== 23) {
            Swal.fire({
                icon: 'error',
                title: 'Dato incorrecto',
                text: 'El número de radicado debe tener exactamente 23 dígitos',
                confirmButtonColor: '#004182'
            });
            return false;
        }

        // Validar el Captcha de la Imagen
        var captchaImgVal = document.getElementById('captcha').value;
        if (captchaImgVal.trim() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Validación requerida',
                text: 'Por favor ingrese el texto de la imagen (Captcha)',
                confirmButtonColor: '#004182'
            });
            return false;
        }

        // Validar archivo PDF
        var archivoInput = document.getElementById('file_anexo');
        if (archivoInput.files.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Documento requerido',
                text: 'Debe adjuntar un documento de solicitud',
                confirmButtonColor: '#004182'
            });
            return false;
        }

        var archivo = archivoInput.files[0];
        if (archivo.type !== 'application/pdf') {
            Swal.fire({
                icon: 'error',
                title: 'Formato incorrecto',
                text: 'El archivo adjunto debe ser un PDF',
                confirmButtonColor: '#004182'
            });
            return false;
        }

        return true;
    }
</script>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var reloadBtn = document.getElementById('reloadCaptcha');
        if (reloadBtn) {
            reloadBtn.addEventListener('click', function(e) {
                e.preventDefault(); // Evitar cualquier comportamiento por defecto (ej. submit de formulario)
                var img = document.querySelector('.captcha img');
                if (img) {
                    var baseUrl = img.src.split('?')[0];
                    img.src = baseUrl + '?' + Math.random();
                }
            });
        }
    });
</script>

@stack('scripts')
</body>

</html>


