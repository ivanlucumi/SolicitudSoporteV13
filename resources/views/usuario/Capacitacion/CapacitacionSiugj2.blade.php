@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Capacitacion Gestor Documental')
@section('cabecera', 'Registro Jornada Capacitacion SIUGJ')

@section('content') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="formulario">
    <div class="row ">
       <center>
           
          <h3>ESPACIO PARA LA CAPACITACI&Oacute;N:</h3> 
            <ul>
                <li>
                   <strong> UNICA INSTANCIA Y PRIMERA INSTANCIA EN : Palacio Justicia Carrera 10 # 12-15  | Sala1 - Piso 18</strong>
    
                </li>
                <li>
                    <strong>SEGUNDA INSTANCIA EN : Salas de capacitación Comfenalco</strong>
    
                </li>
            </ul>
         </center>
    </div>
    <hr>
    <br>
    <form action="{{ route('usuario.solicitud.save.capacitacion.siugj') }}" method="POST">
    @csrf  
        <div class="row ">
              <div class="col-xs-12 col-sm-4 form-group ">
              <label for="nRadicacion">Identificaci&oacute;n:</label>    
              <input id="identificacion" class="form-control @error('identificacion') is-invalid @enderror" min="1" placeholder="Ingrese numero de cedula" autocomplete="off" type="number" name="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              </div>
              <div class="col-xs-12 col-sm-4">
              <label for="hora">Ingrese Nomgre(s) y apellido(s):</label><br>
                  <input id="nombre-funcionario" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre Completo" autocomplete="off" type="text" name="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
              </div>
              <div class="col-xs-12 col-sm-4">
                  <label for="hora">Correo Elect&oacute;nico:</label><br>
                  <input class="form-control @error('correo') is-invalid @enderror" placeholder="Correo institucional Personal" autocomplete="off" type="email" name="correo" id="correo" value="{{ old('correo') }}">
@error('correo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
              </div>
          </div>
          <p>
                     <label><strong>Selecciona Modalidad:</strong></label>
                    <div>
                        
                        <label><input type="radio" name="tipoCapacitacion" value="Presencial"> Presencial</label><br>
                        
                        <label><input type="radio" name="tipoCapacitacion" value="Virtual"> Virtual</label><br>
                    </div>
        </p>
  
        <div>
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" onchange="cargarRoles()" class="form-control">
                <option value="">Selecciona una categoría</option>
            </select>
        </div>

        <div id="roles-div" style="display:none;">
            <label for="role">Rol:</label>
            <select id="role" name="role" onchange="cargarFechas()" class="form-control">
                <option value="">Selecciona un rol</option>
            </select>
        </div>

        <div id="fechas-div" style="display:none;">
            <label for="fecha">Fecha:</label>
            <select id="fecha" name="fecha" onchange="cargarHorarios()" class="form-control">
                <option value="">Selecciona una fecha</option>
            </select>
        </div>

        <div id="horarios-div" style="display:none;">
            <label for="horario">Horario:</label>
            <select id="horario" name="horario" class="form-control">
                <option value="">Selecciona un horario</option>
            </select>
        </div>
<br><hr>
       <div class="row">
      <div class="col-xs-12 col-sm-4"></div>
      
      <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
          <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">REGISTRAR</button>
          
      </div>
      
      <div class="col-xs-12 col-sm-4"></div>                
  </div>   
  </form> 
  
      <br>
      <hr>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let eventos = [];

    // Cargar eventos desde Laravel
    function cargarEventos() {
        $.get('/usuarios/eventos', function(data) {
            eventos = data;
            cargarCategorias();
        }).fail(function(error) {
            console.error('Error cargando eventos:', error);
        });
    }

    // Cargar categorías
    function cargarCategorias() {
        const categoriaSelect = $('#categoria');
        if (!categoriaSelect.length) return; // Validar que el elemento exista

        categoriaSelect.empty();
        categoriaSelect.append('<option value="">Selecciona una categoría</option>');

        const categorias = [...new Set(eventos.map(evento => evento.categoria))];
        categorias.forEach(categoria => {
            categoriaSelect.append(`<option value="${categoria}">${categoria}</option>`);
        });
    }

    // Cargar roles según categoría
    function cargarRoles() {
        const categoriaSeleccionada = $('#categoria').val();
        const rolesDiv = $('#roles-div');
        const roleSelect = $('#role');

        if (!rolesDiv.length || !roleSelect.length) return; // Validar que los elementos existan

        if (categoriaSeleccionada) {
            const roles = [...new Set(eventos
                .filter(evento => evento.categoria === categoriaSeleccionada)
                .map(evento => evento.role)
            )];

            roleSelect.empty();
            roleSelect.append('<option value="">Selecciona un rol</option>');

            roles.forEach(role => {
                roleSelect.append(`<option value="${role}">${role}</option>`);
            });

            rolesDiv.show();
        } else {
            rolesDiv.hide();
            $('#fechas-div').hide();
            $('#horarios-div').hide();
            $('#btn-reservar').prop('disabled', true);
        }
    }

    // Cargar fechas según categoría y rol
    function cargarFechas() {
        const categoriaSeleccionada = $('#categoria').val();
        const roleSeleccionado = $('#role').val();
        const fechasDiv = $('#fechas-div');
        const fechaSelect = $('#fecha');

        if (!fechasDiv.length || !fechaSelect.length) return; // Validar que los elementos existan

        if (categoriaSeleccionada && roleSeleccionado) {
            const fechas = [...new Set(eventos
                .filter(evento => 
                    evento.categoria === categoriaSeleccionada && 
                    evento.role === roleSeleccionado
                )
                .map(evento => evento.fecha)
            )];

            console.log('Fechas filtradas:', fechas); // Depuración

            fechaSelect.empty();
            fechaSelect.append('<option value="">Selecciona una fecha</option>');

            fechas.forEach(fecha => {
                fechaSelect.append(`<option value="${fecha}">${fecha}</option>`);
            });

            fechasDiv.show();
        } else {
            fechasDiv.hide();
            $('#horarios-div').hide();
            $('#btn-reservar').prop('disabled', true);
        }
    }

    // Cargar horarios según categoría, rol y fecha
    function cargarHorarios() {
        const categoriaSeleccionada = $('#categoria').val();
        const roleSeleccionado = $('#role').val();
        const fechaSeleccionada = $('#fecha').val();
        const horariosDiv = $('#horarios-div');
        const horarioSelect = $('#horario');

        if (!horariosDiv.length || !horarioSelect.length) return; // Validar que los elementos existan

        if (categoriaSeleccionada && roleSeleccionado && fechaSeleccionada) {
            // Filtrar eventos por categoría, rol y fecha
            const eventosFiltrados = eventos.filter(evento => 
                evento.categoria === categoriaSeleccionada &&
                evento.role === roleSeleccionado &&
                evento.fecha === fechaSeleccionada
            );

            console.log('Eventos filtrados para horarios:', eventosFiltrados); // Depuración

            // Obtener horarios únicos
            const horarios = [...new Set(eventosFiltrados.flatMap(evento => evento.horario.split("\n")))];

            horarioSelect.empty();
            horarioSelect.append('<option value="">Selecciona un horario</option>');

            horarios.forEach(horario => {
                horarioSelect.append(`<option value="${horario}">${horario}</option>`);
            });

            horariosDiv.show();
        } else {
            horariosDiv.hide();
            $('#btn-reservar').prop('disabled', true);
        }

        // Habilitar el botón de reservar si todos los campos están completos
        $('#btn-reservar').prop('disabled', !$('#categoria').val() || !$('#role').val() || !$('#fecha').val() || !$('#horario').val());
    }

    // Reservar evento
    function reservarEvento(event) {
        event.preventDefault();

        const eventoSeleccionado = eventos.find(evento => 
            evento.categoria === $('#categoria').val() && 
            evento.role === $('#role').val() && 
            evento.fecha === $('#fecha').val() && 
            evento.horario === $('#horario').val()
        );

        if (eventoSeleccionado) {
            $.post('/reservar', { evento_id: eventoSeleccionado.id }, function(data) {
                alert(data.message);
                cargarEventos(); // Recargar los eventos
            }).fail(function(error) {
                alert(error.responseJSON.message);
            });
        } else {
            alert('No se encontró el evento seleccionado.');
        }
    }

    // Cargar eventos al cargar la página
    $(document).ready(function() {
        cargarEventos();
    });
</script>
@push('scripts')
@endpush


@endsection