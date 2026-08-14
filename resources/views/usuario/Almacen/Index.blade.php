@extends('layouts.usuarios')
@section('title', 'Solicitud Elementos Almacen')
@section('cabecera', 'PORTAL DE INSUMOS DE PAPELERIA Y ELEMENTOS DE OFICINA - PIPE')

@section('content') 
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">

<style>
    .center-logo {
        display: flex;
        justify-content: right;
        align-items: center;
        margin-bottom: 30px;
    }

    .center-logo img {
        max-width: 120px;
        animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-animate {
        transition: all 0.3s ease-in-out;
        transform: scale(1);
    }

    .btn-animate:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }

    .sombra {
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        border-radius: 10px;
        padding: 20px;
        background-color: #ffffff;
        animation: fadeIn 0.8s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to   { opacity: 1; transform: scale(1); }
    }

    .form-group label {
        font-weight: bold;
        color: #2c3e50;
    }

    .table > thead {
        background: linear-gradient(to right, #274a8a, #1a2e5b);
        color: white;
    }

    .alert {
        animation: fadeIn 0.5s ease-out;
    }
</style>


<style>
    .sombra {
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.5));
        position: relative;
    }

    .sombra::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
        z-index: -1;
    }

    table {
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
        border-radius: 10px;
    }

    tbody tr:nth-child(even) {
        background-color: #D5F5E3;
    }

    tbody tr:nth-child(odd) {
        background-color: #fff;
    }
    
    
     /* Estilo mejorado para la imagen redonda */
    /* Estilo mejorado para la imagen redonda con nube de diálogo */
    .logo-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 30px;
        position: relative;
    }

    .logo-container {
        position: relative;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #d39d60; /* Borde rojo */
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        background: white;
        padding: 5px;
        z-index: 1;
    }

    .logo-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    /* Nube de diálogo */
    .speech-bubble {
        position: absolute;
        right: 200px;
        top: 20px;
        background: #f3f3f3;
        padding: 15px;
        border-radius: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        width: 200px;
        text-align: center;
        z-index: 2;
        animation: float 3s ease-in-out infinite;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .speech-bubble:after {
        content: '';
        position: absolute;
        right: -15px;
        top: 50%;
        width: 0;
        height: 0;
        border: 15px solid transparent;
        border-left-color: #f3f3f3;
        border-right: 0;
        margin-top: -15px;
        margin-right: -15px;
    }

    .speech-bubble.show {
        opacity: 1;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    /* Efecto hover */
    .logo-container:hover img {
        transform: scale(2.05);
    }

    .logo-container:hover + .speech-bubble {
        opacity: 1;
    }
</style>
<style>
    /* Estilos exclusivos para el botón "REPORTAR A ALMACÉN" */
    .btn-reportar-almacen {
        background-color: #ff6b00 !important;
        border: none !important;
        color: #fff !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 10px rgba(255, 107, 0, 0.4);
        transition: all 0.3s ease-in-out;
        animation: heartbeat-reportar 1.8s infinite;
    }

    .btn-reportar-almacen:hover {
        background-color: #e55b00 !important;
        transform: scale(1.05);
        box-shadow: 0 6px 14px rgba(255, 107, 0, 0.6);
    }

    /* Animación solo aplicada a este botón */
    @keyframes heartbeat-reportar {
        0% { transform: scale(1); }
        25% { transform: scale(1.08); }
        40% { transform: scale(0.95); }
        60% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>



<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Contenedor de logo redondo mejorado -->
<!-- Contenedor de logo con nube de diálogo -->
<div class="logo-wrapper">
    <div class="speech-bubble" id="greeting-bubble">
        ¡Hola! Bienvenido al sistema PIPE<br>
        <small>¿En qué puedo ayudarte hoy?</small>
    </div>
    
    <div class="logo-container">
        <img src="{{ asset('img/1formatos/pipe.png') }}" alt="Pipe" id="logo-image">
    </div>
</div>



<div class="form-group row mb-3 mt-3">
    <div class="col-xs-12 col-sm-6 col-md-2 mb-3 mt-3">
        <label>ELEMENTOS PARA PEDIR A ALMACEN</label>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 mb-3 mt-3">
        <select id="item-select" class="form-control select2">
            <option value="">SELECCIONE ELEMENTO</option>
            <option value="OTRO">OTRO</option>
            @foreach($inventario as $item)
                <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 mt-3" id="otro-input-container" style="display: none;">
        <input type="text" id="otro-input" class="form-control" placeholder="Ingrese Nombre Elemento">
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 mb-3 mt-3">
        <button id="add-item" class="btn btn-primary btn-block btn-animate mt-2">AGREGAR ELEMENTO</button>
    </div>
    <div class="col-xs-12 col-md-12 mb-3 mt-3">
        <div id="message-elemento" class="mt-3"></div>
    </div>
</div>
<div style="
    text-align:center; 
    background:#fff7f0; 
    border:2px solid #ff7b00; 
    border-radius:10px; 
    padding:15px 20px; 
    margin:20px 0; 
    color:#d45a00; 
    font-family:'Segoe UI', sans-serif; 
    font-weight:700;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);">

    <h4 style="margin-bottom:10px; font-weight:800; color:#ff6b00;">
        📝 IMPORTANTE, TENER EN CUENTA
    </h4>

    <p style="margin:0; font-size:15px;">
        UNA VEZ FINALICE LA SOLICITUD DE ELEMENTOS, 
        INGRESE LOS DATOS DEL MAGISTRADO O JUEZ Y 
        HAGA CLIC EN EL BOTÓN 
        <strong>"REPORTAR A ALMACÉN"</strong> 
        PARA REMITIR LA INFORMACIÓN.
    </p>
</div>

<div class="row">
    <div id="item-form" class="col-md-6 col-md-offset-3 mt-3 mb-3 sombra" style="display:none;">
        <div class="col-xs-12">
            <label for="elemento">ELEMENTO SELECCIONADO:</label>
            <input type="text" id="item-elemento" class="form-control" readonly>
        </div>
        <div class="col-xs-12">
            <label for="cantidad">CANTIDAD:</label>
            <input type="number" id="item-cantidad" class="form-control mt-2" placeholder="Cantidad">
        </div>
        <div class="col-xs-12 mt-3">
            <label for="observaciones">OBSERVACIONES:</label>
            <input type="textarea" id="item-observaciones" class="form-control mt-2" placeholder="Observaciones" style="height: 5em;">
        </div>
        
        <div class="col-xs-12 mt-3">
            <hr>
            <div class="col-md-6 mt-3">
                <button id="save-item" class="btn btn-success btn-block btn-animate mt-3 mb-3">REGISTRAR ELEMENTO</button>

            </div>
            <div class="col-md-6">
                <button id="close-form" class="btn btn-secondary btn-block btn-animate mt-3 mb-3" onclick="$('#item-form').hide();">CANCELAR</button>
                
            </div>
        </div>
    </div>
</div>


<div id="message" class="mt-3"></div>
@if($Estado > 1)
    <p>
        <center>
            <strong>
                <h3> YA SE REALIZ&Oacute; SOLICITUD AL ALMACEN</h3>
            </strong>
        </center>
    </p>
@endif

<hr>

<div class="table-responsive sombra">
    <table id="table9" class="table table-hover table-condensed table-bordered">
        <thead style="background-color: #274a8a; color: white;">
            <tr>
                <th>ELEMENTO</th>
                <th>CANTIDAD</th>
                <th>OBSERVACIONES</th>
                <th>ESTADO</th>
                <th>ACCION</th>
            </tr>
        </thead>
        <tbody id="items-table">
            @if($solicitudes != null)
                @foreach($solicitudes as $solicitud)
                
                    <tr id="item-{{ $solicitud->id }}"  >
                        <td>{{ $solicitud->elemento }}</td>
                        <td>{{ $solicitud->cantidad }}</td>
                        <td>{{ $solicitud->observaciones }}</td>
                        <td>
                            @if($solicitud->estado_solicitud)
                                <span><center>ENVIADO</center></span>
                            @else
                                <span><center>SIN SOLICITAR</center></span>
                            @endif </td>
                        <td>
                            
                            @if($solicitud->estado_solicitud)
                                <button class="btn btn-success btn-sm" disabled>ENVIADO</button>
                            @else
                                <button class="btn btn-danger btn-sm delete-item" data-id="{{ $solicitud->id }}">ELIMINAR</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<hr>
<br>
<div>
    <div class="row">
        <center><h4><strong>TITULAR DEL DESPACHO</strong></h4></center>
        <hr>
        <form action="{{ route('usuario.elementos.almacen.cerrar') }}" method="POST">
    @csrf
        <div class="col-xs-12 col-sm-3">
            <label for="cedula">Cedula:</label>
            <input id="cedula" class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingrese Cedula" autocomplete="off" type="number" name="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="nombre">Nombre:</label>
            <input id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="apellido">Apellido:</label>
            <input id="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" value="{{ old('apellido') }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-sm-3">
            <br>
        <button class="btn btn-reportar-almacen btn-block mt-3 mb-3" type="submit">REPORTAR A ALMACÉN</button>
        </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function () {
    $('#item-select').change(function () {
        const value = $(this).val();
        if (value === 'OTRO') {
            $('#otro-input-container').show();
            $('#otro-input').val('');
        } else {
            $('#otro-input-container').hide();
        }
    });

    $('#add-item').click(function () {
        let selectedItem = $('#item-select').val();

        if (selectedItem === 'OTRO') {
            const otroValue = $('#otro-input').val().trim();
            if (!otroValue) {
                showMessage('error', 'Debe ingresar un elemento válido en el campo "OTRO".');
                return;
            }
            selectedItem = otroValue.toUpperCase();
        }

        if (!selectedItem) {
            showMessage('error', 'Debe seleccionar un elemento.');
            return;
        }

        // Verificar si el elemento contiene la palabra "toga"
       /* if (selectedItem.toLowerCase().includes('toga')) {
            $('#item-observaciones').val('Debe registrar talla');
        } else {
            $('#item-observaciones').val('');
        }*/
        // Verificar si el elemento contiene la palabra "toga"
        if (selectedItem.toLowerCase().includes('toga')) {
            $('#item-observaciones').attr('placeholder', 'DEBE REGISTRAR TALLA DE LA TOGA EN OBSERVACIONES');
           showMessage('error', 'REGISTRAR TALLA PARA LA TOGA EN EL CAMPO OBSERVACIONES.');
        } else {
            $('#item-observaciones').attr('placeholder', 'Observaciones'); //  Restaurar el placeholder por defecto
        }

        $('#item-elemento').val(selectedItem);
        $('#item-form').show();
    });

    function showMessage(type, message) {
        const alertBox = `<div class="alert alert-${type}">${message}</div>`;
        $('#message-elemento').html(alertBox);
        setTimeout(function () {
            $('.alert').fadeOut('slow', function () {
                $(this).remove();
            });
        }, 3500);
    }

    $('#save-item').click(function() {
        const itemName = $('#item-elemento').val();
        const itemQuantity = $('#item-cantidad').val();
        const itemObservaciones = $('#item-observaciones').val();

        if (!itemQuantity) {
            showMessage('error', 'Debe registrar la cantidad de elementos.');
            return;
        }
        
         // Validar observaciones si el elemento contiene "toga"
        if (itemName.toLowerCase().includes('toga') && !itemObservaciones.trim()) {
            showMessage('error', 'REGISTRAR TALLA PARA LA TOGA.');
            return;
        }

        $.ajax({
            url: '/usuarios/solicitud/elementos/almacen/save',
            method: 'post',
            data: {
                elemento: itemName,
                cantidad: itemQuantity,
                observaciones: itemObservaciones,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.error) {
                    $('#item-elemento').val('');
                    $('#item-cantidad').val('');
                    $('#item-observaciones').val('');
                    $('#item-form').hide();
                    showMessage('danger', response.error);
                } else {
                    const observaciones = response.observaciones || "N/A";
                    $('#items-table').append(`
                        <tr id="item-${response.id}">
                            <td>${response.elemento}</td>
                            <td>${response.cantidad}</td>
                            <td>${observaciones}</td>
                            <td>SIN SOLICITAR</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-item" data-id="${response.id}">ELIMINAR</button>
                            </td>
                        </tr>
                    `);
                    $('#item-form').hide();
                    $('#item-elemento').val('');
                    $('#item-cantidad').val('');
                    $('#item-observaciones').val('');
                    showMessage('success', 'Elemento agregado con éxito');
                }
            }
        });
    });

    $(document).on('click', '.delete-item', function() {
        const itemId = $(this).data('id');
        $.ajax({
            url: `/usuarios/solicitud/elementos/almacen/delete/${itemId}`,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $(`#item-${itemId}`).remove();
            }
        });
    });

    var verifCedula = document.getElementById('cedula');
    verifCedula.addEventListener('input', function() {
        $.get("/usuarios/consulta/cedula/" + this.value, function(response) {
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre').value = response.nombre;
                document.getElementById('apellido').value = response.apellidos;
            } else {
                document.getElementById('nombre').value = "";
                document.getElementById('apellido').value = "";
            }
        });
    });
});
</script>

<script>
// Mostrar la nube de diálogo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.getElementById('greeting-bubble').classList.add('show');
        
        // Cambiar mensajes cada 5 segundos
        const messages = [
            "Recuerda revisar tus solicitudes",
            "¿Necesitas ayuda con algún elemento?",
            "Si no haces clic en el botón REPORTAR A ALMACÉN, tu pedido no será registrado.",
            "¡Ten un excelente día!",
        ];
        
        let counter = 0;
        setInterval(function() {
            document.getElementById('greeting-bubble').innerHTML = 
                messages[counter % messages.length] + 
                '<br><small>PIPE - Sistema de Insumos</small>';
            counter++;
        }, 5000);
    }, 1000);
});
</script>

<script>
$(document).ready(function() {
    // Mostrar u ocultar la sección de pedir elementos
    $('#btn-pedir-elementos').on('click', function() {
        $('#seccion-pedir-elementos').slideToggle();
    });

    // Mostrar campo OTRO cuando se selecciona
    $('#item-select').on('change', function() {
        if ($(this).val() === 'OTRO') {
            $('#otro-input-container').show();
        } else {
            $('#otro-input-container').hide();
        }
    });

    // Agregar elementos a la tabla
    $('#add-item').on('click', function() {
        let elemento = $('#item-select').val();
        let cantidad = $('#cantidad-input').val();
        let observacion = $('#obs-input').val();

        if (elemento === '') {
            alert('Seleccione o escriba un elemento');
            return;
        }

        if (elemento === 'OTRO') {
            elemento = $('#otro-input').val().trim();
            if (elemento === '') {
                alert('Ingrese el nombre del elemento');
                return;
            }
        }

        if (cantidad === '' || cantidad <= 0) {
            alert('Ingrese una cantidad válida');
            return;
        }

        // Agregar fila
        $('#tabla-elementos tbody').append(`
            <tr>
                <td>${elemento}</td>
                <td>${cantidad}</td>
                <td>${observacion}</td>
                <td>SIN SOLICITAR</td>
                <td><button class="btn btn-danger btn-sm btn-delete">Eliminar</button></td>
            </tr>
        `);

        // Limpiar campos
        $('#item-select').val('');
        $('#otro-input').val('');
        $('#cantidad-input').val('');
        $('#obs-input').val('');
        $('#otro-input-container').hide();
    });

    // Eliminar elemento de la tabla
    $('#tabla-elementos').on('click', '.btn-delete', function() {
        $(this).closest('tr').remove();
    });
});
</script>


@endsection