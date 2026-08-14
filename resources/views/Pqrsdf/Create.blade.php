@extends('layouts.ensayo')
@section('title', 'Formulario PQRSDF')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
body { background:#f7f9fc; }
.card { margin-top:30px; border-radius:8px; box-shadow:0 0 15px rgba(0,0,0,.08); background:#fff; }
.header-gradient { background:linear-gradient(90deg,#002147,#002147); color:#fff; padding:20px; font-size:22px; border-radius:8px 8px 0 0; }
.upload-box { border:2px dashed #4e73df; border-radius:8px; padding:25px; text-align:center; cursor:pointer; background:#f8f9fc; transition:.3s; }
.upload-box:hover { background:#eef2ff; }
.upload-box i { font-size:40px; color:#4e73df; }
.file-name { margin-top:10px; font-weight:bold; color:#16a34a; display:none; }
.email-error { color:#dc2626; font-size:13px; display:none; }
.email-ok { color:#16a34a; font-size:13px; display:none; }
</style>

<div class="container">
<div class="col-md-10 col-md-offset-1">

<div class="card animate__animated animate__fadeInUp">
<div class="header-gradient text-center">
 <h3> Formulario PQRSDF</h3>

    <p>
        Este formulario está destinado <strong>exclusivamente</strong> a la recepción de 
        <strong>Peticiones, Quejas, Reclamos, Sugerencias, Felicitaciones y Denuncias (PQRSDF)</strong>
        relacionadas con las funciones, trámites y servicios a cargo de la
        <strong>DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL DE CALI</strong>.
    </p>
</div>

<div class="panel-body">

<form method="POST" action="{{ route('pqrsdf.store') }}" enctype="multipart/form-data" id="pqrsdfForm">
@csrf

<div class="form-group">
<label>Tipo de solicitud *</label>
<select name="tipo" class="form-control" required>
<option value="">Seleccione</option>
<option>Petición</option>
<option>Queja</option>
<option>Reclamo</option>
<option>Sugerencia</option>
<option>Denuncia</option>
<option>Felicitación</option>
</select>
</div>

<div class="form-group">
<label>Nombre completo *</label>
<input type="text" name="nombres" class="form-control" required autocomplete="off">
</div>

<div class="row">
<div class="col-md-6 form-group">
<label>Tipo de documento *</label>
<select name="tipo_documento" class="form-control" required>
<option value="">Seleccione</option>
<option>Cédula de Ciudadanía</option>
<option>Tarjeta de Identidad</option>
<option>Cédula Extranjería</option>
<option>Pasaporte</option>
<option>NIT</option>
</select>
</div>

<div class="col-md-6 form-group">
<label>Número de documento *</label>
<input type="number" name="numero_documento" class="form-control" required min="1">
</div>
</div>

<div class="row">
<div class="col-md-6 form-group">
<label>Correo electrónico *</label>
<input type="email" name="correo" id="correo" class="form-control" required autocomplete="off">
</div>

<div class="col-md-6 form-group">
<label>Confirmar correo electrónico *</label>
<input type="email" id="correo_confirmacion" class="form-control" required autocomplete="off">
<span id="emailError" class="email-error">❌ Los correos no coinciden</span>
<span id="emailOk" class="email-ok">✔ Los correos coinciden</span>
</div>
</div>

<input type="hidden" name="correo_confirmacion" id="correo_confirmacion_hidden">

<div class="form-group">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control" autocomplete="off">
</div>

<div class="form-group">
<label>Dirección</label>
<input type="text" name="direccion" class="form-control" autocomplete="off">
</div>

<div class="form-group">
<label>Asunto *</label>
<input type="text" name="asunto" class="form-control" required autocomplete="off">
</div>

<div class="form-group">
<label>Mensaje *</label>
<textarea name="mensaje" class="form-control" rows="4" required></textarea>
</div>

<div class="form-group">
<label>Adjuntar documento (opcional)</label>
<div class="upload-box" onclick="document.getElementById('anexo').click()">
<i class="glyphicon glyphicon-cloud-upload"></i>
<p>Click para cargar archivo</p>
<small>PDF / JPG / PNG — Máx. 2MB</small>
<div id="fileName" class="file-name"></div>
</div>
<input type="file" name="anexo" id="anexo" class="hidden"
accept=".pdf,.jpg,.jpeg,.png" onchange="mostrarArchivo(this)">
</div>

<div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LcOzHoeAAAAAJIayuDbVH0y1w_-qGb_OiR1om1U"></div>
                    
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="error-message">
                            <strong>El campo "No soy un robot" es obligatorio</strong>
                        </span>
                    @endif
                </div>

<button type="submit" id="btnEnviar"
class="btn btn-primary btn-lg btn-block animate__animated animate__pulse">
Enviar PQRSDF 📨
</button>

</form>
<hr>
<br>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
function mostrarArchivo(input){
if(!input.files.length) return;
let f=input.files[0];
let size=f.size/1024/1024;
if(size>2){
alert('El archivo supera los 2 MB');
input.value='';
return;
}
$('#fileName').html('📎 '+f.name+' ('+size.toFixed(2)+' MB)').show();
}

$('#correo, #correo_confirmacion').on('keyup', function(){
let c1=$('#correo').val();
let c2=$('#correo_confirmacion').val();
$('#correo_confirmacion_hidden').val(c2);

if(!c2) return;

if(c1===c2){
$('#emailError').hide();
$('#emailOk').show();
$('#btnEnviar').prop('disabled',false);
}else{
$('#emailError').show();
$('#emailOk').hide();
$('#btnEnviar').prop('disabled',true);
}
});
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection
