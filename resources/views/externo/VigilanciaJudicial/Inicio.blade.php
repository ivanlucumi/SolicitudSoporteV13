<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Vigilancia Judicial Administrativa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/icono.png') }}">

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ESTILOS -->
    <style>
        :root{
            --primary:#002147;
            --danger:#dc3545;
        }

        body{
            background:#f4f6f9;
            font-family:'Roboto',sans-serif;
            font-size:16px;
        }

        .card{
            border-radius:12px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        .card-header{
            background:var(--primary);
            color:#fff;
            text-align:center;
            font-weight:600;
            border-radius:12px 12px 0 0;
        }

        .section-title{
            margin:30px 0 15px;
            padding-left:10px;
            border-left:4px solid var(--primary);
            font-weight:600;
        }

        .form-control{
            border-radius:8px;
        }

        .form-control:focus{
            border-color:var(--primary);
            box-shadow:0 0 0 .2rem rgba(0,125,110,.2);
        }

        /* REQUIRED */
        input:required,
        select:required,
        textarea:required{
            border:2px solid #ffb3b3;
        }

        input:required:valid,
        select:required:valid,
        textarea:required:valid{
            border-color:#004182;
        }

        /* Radios */
        .radio-box label{
            border:1px solid #ddd;
            padding:10px;
            border-radius:8px;
            cursor:pointer;
            transition:.2s;
        }

        .radio-box input:checked + span{
            font-weight:bold;
            color:var(--primary);
        }

        /* Botón */
        .btn-enviar{
            background:var(--primary);
            color:#fff;
            padding:12px;
            font-weight:600;
            border-radius:10px;
        }

        .btn-enviar:hover{
            background:#006357;
        }

        /* CAPTCHA */
        .recaptcha-wrapper{
            display:flex;
            justify-content:center;
            margin:25px 0;
        }
        
        input[type="checkbox"]:invalid {
                outline: 2px solid #dc3545;
            }

    </style>
    
      <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<div class="container my-4">

    <!-- HEADER -->
    <div class="row align-items-center mb-4">
        <div class="col-md-5">
            <img src="/img/logoLargo.png" class="img-fluid">
        </div>
        <div class="col-md-7 text-center fw-bold">
            Consejo Superior de la Judicatura<br>
            Dirección Seccional de Administración Judicial<br>
            Cali – Valle del Cauca
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>
                FORMATO PARA SOLICITUD DE VIGILANCIA JUDICIAL ADMINISTRATIVA<br>
                <small>Acuerdo PSAA11-8716 de 2011 – Valle del Cauca</small>
            </h4>
        </div>


        <div class="card-body">
            
            @include('alerts.flash-message')
            @include('../alerts.request')
            

            <form id="miFormulario" action="{{ route('publico.vigilancia.judicial.save') }}" method="POST" enctype="multipart/form-data">
    @csrf

            <!-- DATOS -->
            <div class="section-title">Datos del solicitante</div>
            <p class="text-center">Seleccione el cuadro que corresponda a la calidad que tiene el solicitante en el proceso cuya vigilancia se pretende.</p>
            <div class="row text-center radio-box mb-3">
                @foreach(['DEMANDANTE','DEMANDADO','ACCIONANTE','ACCIONADO','APODERADO','OTRO'] as $tipo)
                    <div class="col-md-4 mb-2">
                        <label class="w-100">
                            <input type="radio" name="tipo_solicitante" value="{{ $tipo }}" required>
                            <span>{{ $tipo }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="nombre_apellido">Nombres y Apellidos</label>
                    <input class="form-control @error('nombre_apellido') is-invalid @enderror" type="text" name="nombre_apellido" id="nombre_apellido" value="{{ old('nombre_apellido') }}">
@error('nombre_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-6">
                    <label for="cedula">Cédula</label>
                    <input class="form-control @error('cedula') is-invalid @enderror" min="1" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="correo">Correo electrónico</label>
                    <input class="form-control @error('correo') is-invalid @enderror" type="email" name="correo" id="correo" value="{{ old('correo') }}">
@error('correo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-6">
                    <label for="direccion">Dirección</label>
                    <input class="form-control @error('direccion') is-invalid @enderror" type="text" name="direccion" id="direccion" value="{{ old('direccion') }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>
             <div class="row mt-3">
                <div class="col-md-4">
                    <label for="telefono">Teléfono</label>
                    <input class="form-control @error('telefono') is-invalid @enderror" type="text" name="telefono" id="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-4">
                    <label for="barrio">Barrio</label>
                    <input class="form-control @error('barrio') is-invalid @enderror" type="text" name="barrio" id="barrio" value="{{ old('barrio') }}">
@error('barrio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-4">
                    <label for="municipio">Municipio</label>
                    <input class="form-control @error('municipio') is-invalid @enderror" type="text" name="municipio" id="municipio" value="{{ old('municipio') }}">
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>

            <!-- DESPACHO -->
            <div class="section-title">Despacho judicial</div>
            <select class="form-control select2 @error('codigo_despacho') is-invalid @enderror" name="codigo_despacho" id="codigo_despacho">
    <option value="">Seleccione despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('codigo_despacho') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('codigo_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

            <!-- PROCESO -->
            <div class="section-title">Datos del proceso</div>

            <div class="row">
                <div class="col-md-6">
                    <label for="tipo_proceso">Tipo de proceso</label>
                    <input class="form-control @error('tipo_proceso') is-invalid @enderror" type="text" name="tipo_proceso" id="tipo_proceso" value="{{ old('tipo_proceso') }}">
@error('tipo_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-6">
                    <label for="num_radicado">Número de radicado (23 dígitos)</label>
                    <input class="form-control @error('num_radicado') is-invalid @enderror" id="nProceso" type="number" name="num_radicado" value="{{ old('num_radicado') }}">
@error('num_radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <small id="cantidad" class="text-danger"></small>
                </div>
            </div>

             <div class="row mt-3">
                <div class="col-md-6">
                    <label for="demandante">Demandante</label>
                    <input class="form-control @error('demandante') is-invalid @enderror" type="text" name="demandante" id="demandante" value="{{ old('demandante') }}">
@error('demandante')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-6">
                    <label for="demandado">Demandado</label>
                    <input class="form-control @error('demandado') is-invalid @enderror" type="text" name="demandado" id="demandado" value="{{ old('demandado') }}">
@error('demandado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>

            <!-- ARCHIVOS -->
            <div class="section-title">Archivos</div>

            <div class="row">
                <div class="col-md-6">
                    <input class="form-control @error('formato') is-invalid @enderror" accept=".pdf" type="file" name="formato" id="formato">
@error('formato')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-md-6">
                    <input class="form-control @error('anexos') is-invalid @enderror" accept=".pdf" type="file" name="anexos" id="anexos">
@error('anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>

            <!-- POLÍTICA -->
            <hr>
            <div class="mt-4 text-center">
            
                <small class="d-block mb-3">
                    Para dar cumplimiento a la Ley 1266 de 2008, a la Ley 1581 de 2012 y demás normas reglamentarias
                    que regulan el Hábeas Data y la Protección de Datos Personales, autorizo, únicamente para efectos
                    de la presentación de esta Demanda, llevar a cabo el tratamiento de mis datos personales.
                </small>
            
                <hr class="w-75 mx-auto">
            
                <div class="form-check d-flex justify-content-center mt-2">
                    <input
                        class="form-check-input me-2"
                        type="checkbox"
                        name="tratamientoDeDatos"
                        value="aceptoTrataminetoDatos"
                        id="tratamientoDeDatos"
                        required
                    >
                    <label class="form-check-label fw-bold" for="tratamientoDeDatos">
                        Acepto política de tratamiento de datos
                    </label>
                </div>
            
            </div>

            <!-- CAPTCHA -->
            <div class="recaptcha-wrapper">
                <div id="recaptcha"></div>
            </div>

            @if ($errors->has('g-recaptcha-response'))
                <div class="text-danger text-center">
                    El campo “No soy un robot” es obligatorio
                </div>
            @endif

            <!-- BOTÓN -->
            <div class="text-center mt-4">
                <button type="submit" id="btnSubmit" class="btn btn-enviar w-50">
                    Registrar solicitud
                </button>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CAPTCHA JS -->
<script>
    var onloadCallback = function () {
        grecaptcha.render('recaptcha', {
            'sitekey': '6LcOzHoeAAAAAJIayuDbVH0y1w_-qGb_OiR1om1U'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
$(function () {

    $('.select2').select2();

    const radicado = document.getElementById('nProceso');
    const contador = document.getElementById('cantidad');

    radicado.addEventListener('input', () => {
        radicado.value = radicado.value.slice(0,23);
        contador.innerHTML = radicado.value.length === 23
            ? '<span class="text-success">✔ Radicado completo</span>'
            : radicado.value.length + ' / 23 dígitos';
    });

    $('#miFormulario').on('submit', function () {
        $('#btnSubmit').prop('disabled', true).text('Enviando...');
    });
});
</script>

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

</body>
</html>
