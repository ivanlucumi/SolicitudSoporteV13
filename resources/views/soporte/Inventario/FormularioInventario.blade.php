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
/*@media screen and (min-width: 600px) {
    .ocultar-div{
        visibility:hidden;
    }
}*/
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
        #canvas {
    border: 1px solid black;
}
/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

#canvas{
            border:1px solid #000000;
            width: 100%;
            height: 100%; 
            background-color: #f8f7f7;
        }
</style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
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
         <!-- Cali - Valle del Cauca1-->
        </p>
      </div>

    </div>

<div class="container-fluid">

    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12" style="display:block">
             @include('alerts.flash-message')
             @include('../alerts.success')
                @include('../alerts.request')
                @if ($soporte->id)
			    <form action="{{ route('cerrar.soporte.servicio',$soporte->id) }}" method="POST">
    @csrf
    @method('PUT')
                @else

                <form action="{{ route('enviar.soporte.pdf.post') }}" method="POST">
    @csrf
                @endif
                <div class="card-header"><h3><center>INVENTARIO DE EQUIPOS</center></h3></div>

                    <div class="row">
                        <p class=""><h5><center>Informaci&oacute;n Inventario</center></h5></p>
                        <hr>
                    </div>
                    
                    <div class="row">
                          <p class=""><h5><center>Datos de Usuario</center></h5></p>
                          <hr>
                        </div>


                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* IDENTIFICACION:</label>
                                  <input id="cedula" class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingrese No. Identificaci&oacute;n" min="1" autocomplete="off" type="number" name="cedula" value="{{ old('cedula', $soporte->cedula ?? $soporte-> cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="especialidad">* NOMBRES:</label>
                                  <input id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" value="{{ old('nombre', $soporte->nombre ?? $soporte->nombre) }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="apellido">* APELLIDOS:</label>
                                  <input id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido', $soporte->apellido ?? $soporte->apellido) }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                        </div>

                         <div class="form-group row mt-2 mb-3">

                                <div class=" col-xs-12 col-md-4">
                                   <label for="ciudad">* CIUDAD:</label>
                                  <select id="ciudad" class="form-control select2 @error('ciudad') is-invalid @enderror" autocomplete="off" name="ciudad">
    <option value="">Seleccione Ciudad</option>
    @foreach($ciudades as $key => $value)
        <option value="{{ $key }}" @selected(old('ciudad', $soporte->ciudad) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="especialidad">* CARGO:</label>
                                  <input id="cargo" class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Cargo" autocomplete="off" type="text" name="cargo" value="{{ old('cargo', $soporte->cargo ?? $soporte->cargo) }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>

                                 <div class="col-xs-12 col-md-4 form-group ">
                                 <label for="telefono">* TEL&Eacute;FONO:</label>
                                  <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese No. Tel&eacute;fono" min="1" autocomplete="off" type="number" name="telefono" value="{{ old('telefono', $soporte->telefono ?? $soporte->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror


                                </div>
                        </div>
                        <div class="row">
                          <p class=""><h5><center>Despacho:</center></h5></p>
                          <hr>
                          <div class=" col-xs-12 col-md-3">
                                  <label for="seccional">* SECCIONAL:</label>
                                  <input id="seccional" class="form-control @error('seccional') is-invalid @enderror" placeholder="Ingrese Seccional" autocomplete="off" type="text" name="seccional" value="{{ old('seccional', $soporte->seccional ?? $soporte->seccional) }}">
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-5">
                                   <label for="despacho">* DESPACHO:</label>
                                  <select id="despacho" class="form-control select2 @error('despacho') is-invalid @enderror" autocomplete="off" name="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho', $soporte->despacho_id) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                 

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="direccion">* DIRECCI&Oacute;N:</label>
                                  <input id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingrese Direcci&oacute;n" autocomplete="off" type="text" name="direccion" value="{{ old('direccion', $soporte->direccion ?? $soporte->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                        </div>
                        
                    <div class="form-group row mt-2 mb-3">
                          <p class=""><h5><center>Datos Equipo Afectado</center></h5></p>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="placa">* Sticker Inventario:</label>
                                  <input id="sticker_inventario" class="form-control @error('sticker_inventario') is-invalid @enderror" placeholder="Sticker" min="1" autocomplete="off" type="text" name="sticker_inventario" value="{{ old('sticker_inventario', $soporte->sticker_inventario ?? $soporte->sticker_inventario) }}">
@error('sticker_inventario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="placa">* Tipo Equipo:</label>
                                  <input id="tipo_equipo" class="form-control @error('tipo_equipo') is-invalid @enderror" placeholder="Seleccione tipo Equipo" min="1" autocomplete="off" type="text" name="tipo_equipo" value="{{ old('tipo_equipo', $soporte->tipo_equipo ?? $soporte->tipo_equipo) }}">
@error('tipo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="placa">* Hostname:</label>
                                  <input id="hostname" class="form-control @error('hostname') is-invalid @enderror" placeholder="Hostname" min="1" autocomplete="off" type="text" name="hostname" value="{{ old('hostname', $soporte->hostname ?? $soporte->hostname) }}">
@error('hostname')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                  <label for="placa">* Ip Equipo:</label>
                                  <input class="form-control @error('ip') is-invalid @enderror" placeholder="Registrar Ip Equipo" autocomplete="off" id="ip" type="text" name="ip" value="{{ old('ip', $soporte->ip ?? '') }}">
@error('ip')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="serial">* Serial Equipo:</label>
                                  <input id="serial_equipo" class="form-control @error('serial_equipo') is-invalid @enderror" placeholder="Ingrese Serial" autocomplete="off" type="text" name="serial_equipo" value="{{ old('serial_equipo', $soporte->serial_equipo ?? $soporte->serial_equipo) }}">
@error('serial_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="sistema_operativo">* Sistema Operativo:</label>
                                  <input id="sistema_operativo" class="form-control @error('sistema_operativo') is-invalid @enderror" placeholder="Ingrese Sistema Operativo" autocomplete="off" type="text" name="sistema_operativo" value="{{ old('sistema_operativo', $soporte->sistema_operativo ?? $soporte->sistema_operativo) }}">
@error('sistema_operativo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="sistema_operativo">* Procesador:</label>
                                  <input id="procesador" class="form-control @error('procesador') is-invalid @enderror" placeholder="Ingrese Procesador" autocomplete="off" type="text" name="procesador" value="{{ old('procesador', $soporte->procesador ?? $soporte->procesador) }}">
@error('procesador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="sistema_operativo">* Memoria Ram:</label>
                                  <input id="memoria_ram" class="form-control @error('memoria_ram') is-invalid @enderror" placeholder="Ingrese Memoria Ram" autocomplete="off" type="text" name="memoria_ram" value="{{ old('memoria_ram', $soporte->memoria_ram ?? $soporte->memoria_ram) }}">
@error('memoria_ram')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="marca_equipo">* Placa:</label>
                                  <input id="placa" class="form-control @error('placa') is-invalid @enderror" placeholder="Ingrese Placa Equipo" autocomplete="off" type="text" name="placa" value="{{ old('placa', $soporte->placa ?? $soporte->placa) }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="marca_equipo">* Marca Equipo:</label>
                                  <input id="marca_equipo" class="form-control @error('marca_equipo') is-invalid @enderror" placeholder="Ingrese Marca Equipo" autocomplete="off" type="text" name="marca_equipo" value="{{ old('marca_equipo', $soporte->marca_equipo ?? $soporte->marca_equipo) }}">
@error('marca_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="modelo_equipo">* Modelo Equipo:</label>
                                  <input id="modelo_equipo" class="form-control @error('modelo_equipo') is-invalid @enderror" placeholder="Ingrese Modelo Equipo" autocomplete="off" type="text" name="modelo_equipo" value="{{ old('modelo_equipo', $soporte->modelo_equipo ?? $soporte->modelo_equipo) }}">
@error('modelo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                
                                <div class=" col-xs-12 col-md-4">
                                   <label for="antivirus">* Serial Ultimo Inventario:</label>
                                  <input id="s_ultimo_inven" class="form-control @error('s_ultimo_inven') is-invalid @enderror" placeholder="Ingrese Serial &Uacute;ltimo Inventario" autocomplete="off" type="text" name="s_ultimo_inven" value="{{ old('s_ultimo_inven', $soporte->s_ultimo_inven ?? $soporte->s_ultimo_inven) }}">
@error('s_ultimo_inven')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                                </div>
                                <div class=" col-xs-12 col-md-4">
                                   <label for="ver_antivirus">* Placa Mantenimiento:</label>
                                  <input id="placa_mantenimiento" class="form-control @error('placa_mantenimiento') is-invalid @enderror" placeholder="&Uacute;ltima Placa Mantenimiento" autocomplete="off" type="text" name="placa_mantenimiento" value="{{ old('placa_mantenimiento', $soporte->placa_mantenimiento ?? $soporte->placa_mantenimiento) }}">
@error('placa_mantenimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

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





<script src="js/jquery-3.2.1.min.js"></script>
<script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
</script>

<script>
       //EMPLEADO
     
    var verifCedula = document.getElementById('cedula');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            console.log(response[0].nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre').value = response[0].nameE;
                document.getElementById('apellido').value = response[0].lastnameE;
                document.getElementById('cargo').value = response[0].cargo_titular;
                
                document.getElementById('telefono').value = response[0].telefono;
                document.getElementById('direccion').value = response[0].direccion;
                
                document.getElementById('seccional').value = "CALI";
            } else {
                document.getElementById('nombre').value = "";
                document.getElementById('apellido').value = "";
                document.getElementById('cargo').value = "";
                document.getElementById('telefono').value = "";
                document.getElementById('direccion').value = "";
                document.getElementById('seccional').value = "";
            }
            $("#despacho").val(response[0].cod_despacho);
            $("#ciudad").val(response[0].nombreCiudad);
            
            
        });
    });
    
    
    
    //EQUIPO DE SOPORTE
    
     var verifPlaca = document.getElementById('placa');
    verifPlaca.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/inventario/" + this.value + "", function(response, juzgado) {

            console.log(response.serial)
           if (Object.keys(response).length > 0) {
                document.getElementById('serial_equipo').value = response.serial;
                document.getElementById('marca_equipo').value = response.marca;
                document.getElementById('modelo_equipo').value = response.modelo;
            } else {
                document.getElementById('serial_equipo').value = "";
                document.getElementById('marca_equipo').value = "";
                document.getElementById('modelo_equipo').value = "";
            }
          //  $("#despacho").val(response.cod_despacho);
            
            
        });
    });
    
  
    
    /*jQuery(document).ready(function() {
        jQuery('.input_apellido').keypress(function(tecla) {
        if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 'Alt'+165)) return false;
        });
    });*/
    
    $(".input_apellido").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
     $(".input_nombre").on("keypress", function(event){
        if((event.which > 33 && event.which < 65) || (event.which > 91 && event.which < 95) || (event.which > 120 && event.which < 126) || (event.which == 168) || $(this).val().length == 80){
            return false;
        }
    });
    
   
    
    </script>

</main>


</body>

</html>


