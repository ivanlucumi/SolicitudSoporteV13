
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
             
                <div class="card-header" style="background-color: #004182;color:white"><h4><center>INFORMACION ENCABEZADO</center></h4></div>
            
                    <div class="row">
                        <p><center><h4>INFROMACION</h4></center> <br>
                        <center><h5><strong style="color:red">AVISO IMPORTANTE</strong>: De que se trata el modulo. </h5></center></p>
                        <p>
                            @include('alerts.flash-message')
                            @include('../alerts.success')
                            @include('../alerts.request')
                        </p>
                    </div>
                    
                   <hr>
                    <form id="MiFormulario" enctype="multipart/form-data" class="was-validated" action="{{ route('send.code') }}" method="POST">
    @csrf 
        <div class="row">
            
            <div class="col-xs-12 col-sm-12">
               
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <label for="email">Correo electrónico</label>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" required>
                       </div><br>
                   </div> 
                </div>
                
                 <hr>
                 <div class="row">
                      <div class="form-group">
                        <div align="center" class="col-xs-12">
                            <div  class="g-recaptcha" data-sitekey="6LcOzHoeAAAAAJIayuDbVH0y1w_-qGb_OiR1om1U"></div>
                            <br>
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
    
</div>

 <!-- Modal de espera -->
<div class="modal" id="modalEspera" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p><center> Enviando Codigo.....</center></p>
            </div>
        </div>
    </div>
</div>                   
                
        </div>
    </div>
      </div>
    </div>
    
</div>



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
    //setTimeout("location.href='https://www.disajcali.gov.co/solicitud/ficha/preliminar", 900000000);
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

@stack('scripts')
</body>

</html>



