@extends('layouts.monitoreo.ingreso')

@section('title', 'Registro Ingreso')

@section('cabecera')
   <div class="header-welcome">
       <i class="material-icons">person</i>
       REGISTRO {{  auth()->user()->name }} {{  auth()->user()->lastname }}
   </div>
@endsection

@section('content')

<style>
    /* Material Design Colors & Variables */
    :root {
        --primary-color: #2196F3;
        --primary-dark: #1976D2;
        --primary-light: #BBDEFB;
        --accent-color: #FF5722;
        --success-color: #4CAF50;
        --warning-color: #FF9800;
        --error-color: #F44336;
        --text-primary: #212121;
        --text-secondary: #757575;
        --divider-color: #BDBDBD;
        --background-light: #FAFAFA;
        --card-shadow: 0 2px 8px rgba(0,0,0,0.1);
        --card-shadow-hover: 0 4px 16px rgba(0,0,0,0.15);
    }

    /* Header Welcome */
    .header-welcome {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        color: var(--primary-color);
        font-size: 1.2em;
    }

    .header-welcome .material-icons {
        font-size: 1.5em;
    }

    /* Main Container */
    .registro-container {
        background: var(--background-light);
        min-height: 100vh;
        padding: 20px 0;
    }

    /* Card Principal */
    .registro-card {
        background: white;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        padding: 30px;
        margin: 20px auto;
        max-width: 800px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .registro-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .registro-card:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translateY(-2px);
    }

    /* Form Groups Material Design */
    .form-group-material {
        position: relative;
        margin-bottom: 25px;
    }

    .form-group-material label {
        position: absolute;
        top: 12px;
        left: 12px;
        font-size: 14px;
        color: var(--text-secondary);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        background: white;
        padding: 0 4px;
        font-weight: 500;
    }

    .form-control-material {
        border: 2px solid #E0E0E0;
        border-radius: 8px;
        padding: 16px 12px 8px 12px;
        font-size: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        width: 100%;
        box-sizing: border-box;
    }

    .form-control-material:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }

    .form-control-material:focus + label,
    .form-control-material:not(:placeholder-shown) + label,
    .form-control-material.has-value + label {
        top: -8px;
        left: 8px;
        font-size: 12px;
        color: var(--primary-color);
        font-weight: 600;
    }

    /* Select Material */
    .select-material {
        position: relative;
    }

    .select-material::after {
        content: '▼';
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        pointer-events: none;
        font-size: 12px;
    }

    .select-material select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    /* Buttons Material Design */
    .btn-material {
        border: none;
        border-radius: 8px;
        padding: 14px 28px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 48px;
    }

    .btn-material::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transition: all 0.6s;
        transform: translate(-50%, -50%);
    }

    .btn-material:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary-material {
        background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
        color: white;
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
    }

    .btn-primary-material:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
    }

    .btn-warning-material {
        background: linear-gradient(45deg, var(--warning-color), #F57C00);
        color: white;
        box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
    }

    .btn-warning-material:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4);
    }

    /* Loading Animation */
    #loadingMessage {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        backdrop-filter: blur(4px);
    }

    .loading-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
    }

    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-text {
        font-size: 18px;
        font-weight: 500;
        margin-top: 15px;
    }

    /* Sending State */
    .btn-sending {
        background: linear-gradient(45deg, var(--warning-color), #F57C00) !important;
        pointer-events: none;
        opacity: 0.8;
    }

    /* Form Title */
    .form-title {
        text-align: center;
        margin-bottom: 30px;
        color: var(--text-primary);
        font-weight: 300;
        font-size: 2em;
        position: relative;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }

    /* Responsive */
    @media only screen and (max-width: 768px) {
        .registro-card {
            margin: 10px;
            padding: 20px;
        }

        .form-title {
            font-size: 1.5em;
        }

        video {
            max-width: 100%;
        }

        .btn-material {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    /* Input Icons */
    .input-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 20px;
        z-index: 1;
    }

    /* Loading state for inputs */
    .form-control-material.loading {
        border-color: var(--primary-color);
        background-image: linear-gradient(45deg, transparent 33%, rgba(33, 150, 243, 0.1) 33%, rgba(33, 150, 243, 0.1) 66%, transparent 66%);
        background-size: 20px 20px;
        animation: loading-stripes 1s linear infinite;
        position: relative;
    }

    .form-control-material.loading::after {
        content: '';
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        border: 2px solid var(--primary-color);
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 2;
    }

    @keyframes loading-stripes {
        0% { background-position: 0 0; }
        100% { background-position: 20px 0; }
    }

    /* Notification styles */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        transform: translateX(400px);
        transition: transform 0.3s ease-in-out;
    }

    .notification.show {
        transform: translateX(0);
    }

    .notification.success {
        background: var(--success-color);
    }

    .notification.error {
        background: var(--error-color);
    }

    .notification.info {
        background: var(--primary-color);
    }

    /* Success Animation */
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .form-success {
        animation: successPulse 0.6s ease-in-out;
    }

    /* Material Icons */
    @import url('https://fonts.googleapis.com/icon?family=Material+Icons');
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Roboto', sans-serif;
    }
</style>

<div class="registro-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="registro-card">
                    <h2 class="form-title">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 10px;">assignment_ind</i>
                        Registro de Ingreso
                    </h2>
                    
                    <!-- Mensaje Discreto de Novedad -->
                    <div id="alertaNovedadDiscreta" style="display: none; background-color: #fff1f2; border-left: 5px solid #e11d48; color: #881337; padding: 15px; border-radius: 4px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(225, 29, 72, 0.1);">
                        <div style="font-weight: 600; margin-bottom: 5px; display: flex; align-items: center; gap: 6px;">
                            <i class="material-icons" style="font-size: 22px; color: #e11d48;">error_outline</i> 
                            NOVEDAD REGISTRADA EN EL SISTEMA
                        </div>
                        <div id="textoNovedadDiscreta" style="font-size: 15px; margin-left: 28px; line-height: 1.4;"></div>
                    </div>

                    <form enctype="multipart/form-data" id="biometriaRegistro" action="{{ route('biometria.registro.save') }}" method="POST">
    @csrf
                    <div class="row">
                        {{-- Tipo de documento --}}
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group-material">
                                <div class="select-material">
                                    <select id="tipo_doc" class="form-control-material @error('tipo_doc') is-invalid @enderror" name="tipo_doc">
    @foreach([
                                        'CC' => 'Cédula de Ciudadanía',
                                        'CE' => 'Cédula de Extranjería',
                                        'PAS' => 'Pasaporte',
                                        'TI' => 'Tarjeta de Identidad'
                                    ] as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_doc') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_doc')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                    <label for="tipo_doc">Tipo de Documento</label>
                                </div>
                                <i class="material-icons input-icon">description</i>
                            </div>
                        </div>

                        {{-- Identificación --}}
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group-material">
                                <input id="identificacion" class="form-control-material autofocus @error('identificacion') is-invalid @enderror" placeholder=" " autocomplete="off" type="number" name="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                <label for="identificacion">Número de Identificación</label>
                                <i class="material-icons input-icon">badge</i>
                            </div>
                        </div>

                        {{-- Primer Apellido --}}
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group-material">
                                <input id="p_apellido" class="form-control-material @error('p_apellido') is-invalid @enderror" placeholder=" " autocomplete="off" type="text" name="p_apellido" value="{{ old('p_apellido') }}">
@error('p_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                <label for="p_apellido">Primer Apellido</label>
                                <i class="material-icons input-icon">person</i>
                            </div>
                        </div>

                        {{-- Segundo Apellido --}}
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group-material">
                                <input id="s_apellido" class="form-control-material @error('s_apellido') is-invalid @enderror" placeholder=" " autocomplete="off" type="text" name="s_apellido" value="{{ old('s_apellido') }}">
@error('s_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                <label for="s_apellido">Segundo Apellido</label>
                                <i class="material-icons input-icon">person_outline</i>
                            </div>
                        </div>

                        {{-- Primer Nombre --}}
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group-material">
                                <input id="p_nombre" class="form-control-material @error('p_nombre') is-invalid @enderror" placeholder=" " autocomplete="off" type="text" name="p_nombre" value="{{ old('p_nombre') }}">
@error('p_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                <label for="p_nombre">Primer Nombre</label>
                                <i class="material-icons input-icon">account_circle</i>
                            </div>
                        </div>

                        {{-- Segundo Nombre --}}
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group-material">
                                <input id="s_nombre" class="form-control-material @error('s_nombre') is-invalid @enderror" placeholder=" " autocomplete="off" type="text" name="s_nombre" value="{{ old('s_nombre') }}">
@error('s_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                <label for="s_nombre">Segundo Nombre</label>
                                <i class="material-icons input-icon">account_box</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        
                        <input id="sexo" class="form-control  @error('sexo') is-invalid @enderror" autocomplete="off" style="width : 0px; heigth : 0px" type="text" name="sexo" value="{{ old('sexo') }}">
@error('sexo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        <input id="f_nacimiento" class="form-control  @error('f_nacimiento') is-invalid @enderror" autocomplete="off" style="width : 0px; heigth : 0px" type="text" name="f_nacimiento" value="{{ old('f_nacimiento') }}">
@error('f_nacimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-1 col-sm-1 form-group ">
                        <input id="nombre_conductor" class="form-control  @error('ti') is-invalid @enderror" autocomplete="off" style="width : 0px; heigth : 0px" type="text" name="ti" value="{{ old('ti') }}">
@error('ti')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    
                     </div>
                     <div class="col-xs-12 col-lg-3"></div>

                    {{-- Botones --}}
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-xs-12 col-md-6">
                            <button class="btn btn-material btn-primary-material btn-block shadow" id="btnSubmit" type="submit">VALIDAR DATOS</button>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a href="{!! url('/usuarios') !!}" class="btn btn-material btn-warning-material btn-block shadow">
                                <i class="material-icons">cancel</i>
                                Cancelar
                            </a>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loadingMessage">
    <div class="loading-content">
        <div class="loading-spinner"></div>
        <div class="loading-text">Validando datos...</div>
        <p style="margin-top: 10px; opacity: 0.8;">Por favor espere un momento</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Focus inicial
        document.getElementById("identificacion").focus();

        // Manejar labels flotantes
        $('.form-control-material').on('input blur', function() {
            if ($(this).val().trim() !== '') {
                $(this).addClass('has-value');
            } else {
                $(this).removeClass('has-value');
            }
        });

        // Inicializar labels para campos con valor
        $('.form-control-material').each(function() {
            if ($(this).val().trim() !== '') {
                $(this).addClass('has-value');
            }
        });

        // === VALIDAR TIPO DE DOCUMENTO Y FORMATO ===
        let consultaTimeout;
        
        $('#identificacion').on('input', function() {
            const tipo = $('#tipo_doc').val();
            const valor = $(this).val().trim();
            const inputElement = $(this);


            // Limpiar timeout anterior
            clearTimeout(consultaTimeout);

            if (tipo && valor.length >= 3) {
                // Mostrar indicador de carga
                inputElement.addClass('loading');
                
                // Debounce para evitar múltiples consultas
                consultaTimeout = setTimeout(function() {
                    // Construir ruta con los dos parámetros
                    const url = `/porteria/ingreso/consulta/${tipo}/${valor}`;

                    document.getElementById('p_apellido').value = "";
                    document.getElementById('p_nombre').value = "";
                    document.getElementById('s_apellido').value = "";
                    document.getElementById('s_nombre').value = "";
                    
                    // Borramos mensajes 
                            document.getElementById('alertaNovedadDiscreta').style.display = 'none';
                            document.getElementById('textoNovedadDiscreta').innerText = '';
                            
                            inputElement.removeClass('loading');
                            
                    let camposLlenados = 0;
                    // Realizar consulta AJAX con jQuery
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        timeout: 10000, // 10 segundos timeout
                        beforeSend: function() {
                            console.log('Consultando documento:', tipo, valor);
                        }
                    })
                    .done(function(response) {
                        console.log('Respuesta recibida:', response);
                        if (response && typeof response === 'object') {

                            console.log('Datos encontrados para el documento:', response);

                            document.getElementById('p_apellido').value = response.p_apellido;
                            document.getElementById('p_nombre').value = response.p_nombre;
                            document.getElementById('s_apellido').value = response.s_apellido;
                            document.getElementById('s_nombre').value = response.s_nombre;
                            
                            // Borramos mensajes
                            document.getElementById('alertaNovedadDiscreta').style.display = 'none';
                            document.getElementById('textoNovedadDiscreta').innerText = '';
                            
                            camposLlenados = 1;
                            
                            // Mostrar mensaje de éxito si se llenaron campos
                            if (camposLlenados > 0) {
                                inputElement.css('border-color', 'var(--success-color)');
                                setTimeout(() => {
                                    inputElement.css('border-color', '');
                                }, 2000);
                            }
                        } else {
                            console.log('No se encontraron datos para el documento');
                            // Limpiar campos si no hay datos
                            document.getElementById('p_apellido').value = "";
                            document.getElementById('p_nombre').value = "";
                            document.getElementById('s_apellido').value = "";
                            document.getElementById('s_nombre').value = "";
                            inputElement.removeClass('loading');
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.log('No se encontraron datos para el documento');
                        
                        
                        // Mostrar error visual
                        inputElement.css('border-color', 'var(--error-color)');
                        setTimeout(() => {
                            inputElement.css('border-color', '');
                        }, 3000);
                        
                        // Mostrar mensaje de error específico
                        if (xhr.status === 404) {
                            console.log('Documento no encontrado en la base de datos');
                        } else if (xhr.status === 500) {
                            console.log('Error interno del servidor');
                        } else if (status === 'timeout') {
                            console.log('Tiempo de espera agotado');
                        }
                    })
                    .always(function() {
                        inputElement.removeClass('loading');
                    });
                }, 500); // Esperar 500ms antes de hacer la consulta
            } else {
                // Limpiar campos si no hay suficientes caracteres
                if (valor.length === 0) {
                    const campos = ['p_apellido', 's_apellido', 'p_nombre', 's_nombre'];
                    document.getElementById('p_apellido').value = "";
                            document.getElementById('p_nombre').value = "";
                            document.getElementById('s_apellido').value = "";
                            document.getElementById('s_nombre').value = "";
                    campos.forEach(c => {
                        const campo = $(`#${c}`);
                        if (campo.length) {
                            campo.val('').removeClass('has-value');
                        }
                    });
                }
                inputElement.removeClass('loading');
            }
        });

        // === ANIMACIÓN AL ENVIAR ===
        $('#biometriaRegistro').on('submit', function(event) {
            const loadingMessage = $('#loadingMessage');
            const btnSubmit = $('#btnSubmit');

            // Mostrar loading
            loadingMessage.fadeIn(300);

            // Cambiar estado del botón
            btnSubmit.addClass('btn-sending')
                    .html('<i class="material-icons">hourglass_empty</i> Enviando...')
                    .prop('disabled', true);

            // Agregar clase de éxito al formulario
            $('.registro-card').addClass('form-success');
        });

        // Validación en tiempo real
        $('input[required]').on('blur', function() {
            if ($(this).val().trim() === '') {
                $(this).css('border-color', 'var(--error-color)');
            } else {
                $(this).css('border-color', 'var(--success-color)');
                setTimeout(() => {
                    $(this).css('border-color', '');
                }, 2000);
            }
        });

        // Efecto ripple en botones
        $('.btn-material').on('click', function(e) {
            const button = $(this);
            const ripple = $('<span class="ripple"></span>');

            button.append(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Limpiar campos cuando cambie el tipo de documento
        $('#tipo_doc').on('change', function() {
            const campos = ['identificacion', 'p_apellido', 's_apellido', 'p_nombre', 's_nombre'];
            campos.forEach(c => {
                const campo = $(`#${c}`);
                if (campo.length && c !== 'identificacion') {
                    campo.val('').removeClass('has-value');
                }
            });
        });
    });
</script>
 <script>
document.getElementById('identificacion').addEventListener('input', function () {
    // Si comienza con ceros → se los quita automáticamente
    this.value = this.value.replace(/^0+/, '');
});
</script>

@endsection