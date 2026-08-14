@extends('layouts.usuarios')
@section('title', 'Solicitud Elementos Almacén')
@section('cabecera', 'ACTIVACION USUARIO SGDE')

@section('content') 
<style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f4f4f4; }
    input, select { width: 100%; padding: 5px; border: none; outline: none; }
    .guardar { padding: 8px; background-color: green; color: white; cursor: pointer; border: none; }
    .guardar:hover { background-color: darkgreen; }
    .eliminar { padding: 8px; background-color: red; color: white; cursor: pointer; border: none; }
    .eliminar:hover { background-color: darkred; }
</style>

<h2>USUARIOS PARA SGDE</h2>
<div class="container-fluid">
    
    <div class="row" >
        <div class="col-xs-12 col-sm-4" >
            <a href="https://etbcsj.sharepoint.com/sites/portaldecompetenciasdigitales/SitePages/-Sistema-de-Gesti%C3%B3n-Documental-Electr%C3%B3nica.aspx" rel="noopener" target="_blank" ><img src="/img/alerta.gif" class="card-img" width="200em" height="190em"></a>
        </div>
        <div class="col-xs-12 col-sm-8">
            
                      <p class="card-text" ><h2><strong><center style="color:#C0392B">PARA TENER EN CUENTA.</center></strong></h2> </p>
                    <h3>
                     <strong>URL DE AYUDAS PARA EL MANEJO DEL SGDE
                        <center> <a style="color:red" href="https://etbcsj.sharepoint.com/sites/portaldecompetenciasdigitales/SitePages/-Sistema-de-Gesti%C3%B3n-Documental-Electr%C3%B3nica.aspx" rel="noopener" target="_blank" >DAR CLIC PARA DIRIGIRSE A VIDEO TUTORIALES Y MANUALES SGDE</a></center>
                     </strong>
                    </h3>
                </p>
        </div>
        
        
    </div>
    
    <hr>
    <h2>URL DE SGDE </h2>
    <h2 class="card-title"><strong><center><a href="https://siugj-sgde.ramajudicial.gov.co/expedientes/login" rel="noopener" target="_blank">https://siugj-sgde.ramajudicial.gov.co/expedientes/login </a> </center></strong></h2>
    <hr>
    <!--h2>SOLICITUD DE CREACION USUARIO SGDE </h2>
    <div class="row"  >
    <div class="col-xs-12 col-sm-2"></div>
        
        <div class="col-xs-12 col-sm-8 ">
            <div class="card" style="">
              <div class="card-body">
                <a href="" onclick="window.open('/img/1formatos/Solicitud Usuario SGDE.docx','popup', 'width=800px,height=600px')" class="product-title">
            		 <center> <h2><strong>DESCARGAR FORMATO</strong></h2> </center>
            		 </a>
                <p class="card-text"></p>
              </div> 
            </div>
        </div>
    <div class="col-xs-12 col-sm-2"></div> 
       
    </div-->
     <br>
    
    <!--hr>
    <h2>SOLICITUD DE CAPACITACI&Oacute;N VIRTUAL DESDE NIVEL CENTRAL </h2>
    <h2 class="card-title"><strong><center><a href="https://forms.office.com/pages/responsepage.aspx?id=mLosYviA80GN9Y65mQFZi-pavHaOHEVDsb0gZHMq0bFUQjFCQ0tZUVoyVFlPVVFQMTFHMFI2U0FWUy4u&route=shorturl
" rel="noopener" target="_blank">FORMULARIO DE INSCRIPCI&Oacute;N</a> </center></strong></h2-->
    
    <hr>
    
    <!--h3> <center> <strong> SOLICITUD USUARIO SGDE</strong></center></h3-->
    <!--h2>SOLICITUD DE USUARIO SGDE DEBE REALIZARSE POR MEDIO DE JUDIT  </h2>
    <h2 class="card-title"><strong><center><a href="https://judit.ramajudicial.gov.co/HEAT/" rel="noopener" target="_blank">https://judit.ramajudicial.gov.co/HEAT/ </a> </center></strong></h2-->
    
     <!--form id="formRegistro" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="usuario">Usuario Dominio</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico Personal Institucional</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Registrar</button>
    </form-->
    <!--div class="row">
        <div class="col-xs-12 col-sm-7">
            <label for="cargo-select"> CARGOS PARA UTILIZACION DE USUARIO SGDE:</label> <hr>
            <select id="cargo-select" class="form-control ">
                <option value="">SELECCIONA  CARGO</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo }}">{{ $cargo }}</option>
                @endforeach
            </select>
            <hr>
            
            <button class="btn btn-danger" id="agregar-empleado">AGREGAR CARGO Y REGISTRAR</button>
            @if(1==0)
            @endif
        </div>
        
    </div-->
    
</div>


<table>
    <thead>
        <tr>
            <!--th>CARGO</th-->
            <th>CÉDULA</th>
            <th>NOMBRE COMPLETO</th>
            <th>USUARIO DOMINIO</th>
            <th>EMAIL PERSONAL INSTITUCIONAL</th>
            <!--th>ACCIÓN</th-->
        </tr>
    </thead>
    <tbody id="tabla-empleados">
        @foreach ($empleados as $empleado)
            <tr data-cargo="{{ $empleado->cargo }}">
                <!--td><input type="text" class="cargo" value="{{ $empleado->cargo }}" readonly></td-->
                <td><input type="number" value="{{ $empleado->cedula }}" class="cedula"></td>
                <td><input type="text" value="{{ $empleado->nombre }}" class="nombre"></td>
                <td><input type="text" value="{{ $empleado->usuario }}" class="usuario"></td>
                <td><input type="email" value="{{ $empleado->email }}" class="email"></td>
                <!--td>
                    
                </td-->
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--script>
    $(document).ready(function () {
        // Agregar nueva fila al seleccionar un cargo
        $("#agregar-empleado").click(function () {
            var cargoSeleccionado = $("#cargo-select").val();
            if (cargoSeleccionado === "") {
                alert("Por favor, seleccione un cargo.");
                return;
            }

            // Verificar si el cargo ya fue agregado
            if ($(`#tabla-empleados tr[data-cargo='${cargoSeleccionado}']`).length > 0) {
                alert("Este cargo ya ha sido agregado.");
                return;
            }

            var nuevaFila = `
                <tr data-cargo="${cargoSeleccionado}">
                    <td><input type="text" class="cargo" value="${cargoSeleccionado}" readonly></td>
                    <td><input type="text" class="cedula"></td>
                    <td><input type="text" class="nombre"></td>
                    <td><input type="text" class="usuario"></td>
                    <td><input type="text" class="email"></td>
                    <td>
                        <button class="guardar">Guardar</button>
                        <button class="eliminar">Eliminar</button>
                    </td>
                </tr>`;
            $("#tabla-empleados").append(nuevaFila);

            // Remover el cargo del select para evitar duplicados
            $("#cargo-select option[value=" + cargoSeleccionado + "']").remove();
            $("#cargo-select").val(""); // Resetear el select
        });

        // Guardar datos vía AJAX
        $(document).on("click", ".guardar", function () {
            var fila = $(this).closest("tr");
            var cargo = fila.find(".cargo").val();
            var nombre = fila.find(".nombre").val();
            var cedula = fila.find(".cedula").val();
            var usuario = fila.find(".usuario").val();
            var email = fila.find(".email").val();

            if (nombre.trim() === "" || cedula.trim() === "" || usuario.trim() === "" || email.trim() === "") {
                alert("Por favor, complete todos los campos.");
                return;
            }

            $.ajax({
                url: "{{ route('usuario.solicitud.sgde.save') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cargo: cargo,
                    nombre: nombre,
                    cedula: cedula,
                    usuario: usuario,
                    email: email
                },
                success: function (response) {
                    alert("Empleado registrado correctamente");
                    location.reload(); // Recargar los datos actualizados
                },
                error: function (xhr) {
                    alert("Error al guardar. Verifica que la cédula no esté duplicada.");
                }
            });
        });

        // Eliminar fila y devolver el cargo al select
        $(document).on("click", ".eliminar", function () {
            var fila = $(this).closest("tr");
            var cargo = fila.data("cargo");

            // Devolver el cargo al select
            $("#cargo-select").append(`<option value="${cargo}">${cargo}</option>`);

            // Eliminar la fila
            fila.remove();
        });
    });
</script-->

<script>
$(document).ready(function () {
    $('#formRegistro').submit(function (e) {
        e.preventDefault();
        
       

        const datos = {
            _token: '{{ csrf_token() }}',
            cedula: $('#cedula').val(),
            nombre: $('#nombre').val(),
            usuario: $('#usuario').val(),
            email: $('#email').val(),
        };
        
         

        $.ajax({
            url: "{{ route('usuario.solicitud.sgde.save') }}",
            method: "POST",
            data: datos,
            success: function (response) {
                alert("Usuario registrado correctamente");
                // Crear la nueva fila con los datos del formulario
                const nuevaFila = `
                    <tr >
                        <td><input type="number" class="cedula" value="${datos.cedula}"></td>
                        <td><input type="text" class="nombre" value="${datos.nombre}"></td>
                        <td><input type="text" class="usuario" value="${datos.usuario}"></td>
                        <td><input type="email" class="email" value="${datos.email}"></td>
                        <td></td>
                    </tr>
                `;
            
                $('#tabla-empleados').append(nuevaFila); // Agrega la nueva fila a la tabla
                $('#formRegistro')[0].reset(); // Limpia el formulario
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errores = xhr.responseJSON.errors;
                    let mensaje = "Errores encontrados:\n";
                    for (const campo in errores) {
                        mensaje += `- ${errores[campo][0]}\n`;
                    }
                    alert(mensaje);
                } else {
                    alert("Error inesperado al guardar.");
                }
            }
        });
    });
});
</script>
@endsection
