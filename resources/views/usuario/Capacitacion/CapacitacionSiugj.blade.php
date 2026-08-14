@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Capacitacion Gestor Documental')
@section('cabecera', 'Registro Jornada Capacitacion SIUGJ')

@section('content') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

  <form action="{{ route('usuario.solicitud.save.capacitacion.siugj') }}" method="POST">
    @csrf  
  <input class="form-control" type="hidden" name="codigo_despacho" id="codigo_despacho" value="{{  auth()->user()->cedula }}">
  <input class="form-control" type="hidden" name="despacho" id="despacho" value="{{  auth()->user()->name.' '.  auth()->user()->lastname }}">
  <div class="row ">
      <div class="col-xs-12 col-sm-4 form-group ">
      <label for="nRadicacion">Identificaci&oacute;n:</label>    
      <input id="identificacion" class="form-control @error('identificacion') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" autocomplete="off" type="number" name="identificacion" value="{{ old('identificacion') }}">
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
  
 
  
  <div class="row ">
      <div class="col-xs-12 col-sm-6">
          <center>
              <h3>
                  UNICA INSTANCIA
              </h3>
          </center>
         @foreach($capacitacionesUnica as $evento)
            <div class="evento">
                <h3>
                    <input type="radio" name="evento_seleccionado" value="{{ $evento->id }}" onclick="activarRoles({{ $evento->id }})">
                    {{ $evento->categoria }} - {{ $evento->fecha }} ({{ $evento->horario }})
                </h3>
                <p>
                     <label><strong>Selecciona Modalidad:</strong></label>
                    <div>
                        @if($evento->cantidad <25)
                        <label><input type="radio" name="tipoCapacitacion" value="Presencial"> Presencial</label><br>
                        @endif
                        <label><input type="radio" name="tipoCapacitacion" value="Virtual"> Virtual</label><br>
                    </div>
                <p><strong>Ubicación:</strong> {{ $evento->ubicacion }}</p>
                <p><strong>Cantidad:</strong> {{ $evento->cantidad }}</p>
                
                @php
                    $roles = explode("\n", trim($evento->role));
                @endphp
    
                <label><strong>Selecciona un rol:</strong></label>
                @foreach($roles as $role)
                    <div>
                        <input type="radio" name="roles" value="{{ trim($role) }}" class="roles-{{ $evento->id }}" disabled>
                        {{ trim($role) }}
                    </div>
                @endforeach
                
               
        </div>
    @endforeach
      </div>
      <div class="col-xs-12 col-sm-6">
          <center>
              <h3>
                  PRIMERA INSTANCIA
              </h3>
          </center>
          @foreach($capacitacionesPrimera as $eventoP)
               <div class="evento">
                        <h3>
                            <input type="radio" name="evento_seleccionado" value="{{ $eventoP->id }}" onclick="activarRoles({{ $eventoP->id }})">
                            {{ $eventoP->categoria }} - {{ $eventoP->fecha }} ({{ $eventoP->horario }})
                        </h3>
                        <p><strong>Modalidad:</strong> {{ $eventoP->modalidad }}</p>
                        <p><strong>Ubicación:</strong> {{ $eventoP->ubicacion }}</p>
                        <p><strong>Cantidad:</strong> {{ $eventoP->cantidad }}</p>
                        
                        @php
                            $roles = explode("\n", trim($eventoP->role));
                        @endphp
            
                        <label><strong>Selecciona un rol:</strong></label>
                        @foreach($roles as $role)
                            <div>
                                <input type="radio" name="roles" value="{{ trim($role) }}" class="roles-{{ $eventoP->id }}" disabled>
                                {{ trim($role) }}
                            </div>
                        @endforeach
                        <label><strong>Selecciona un tipo Capacitacion:</strong></label>
                        <div>
                            <label><input type="checkbox" name="tipoCapacitacion[]" value="Presencial"> Presencial</label><br>
                            <label><input type="checkbox" name="tipoCapacitacion[]" value="Virtual"> Virtual</label><br>
                        </div>
                </div>
            @endforeach
      </div>

  </div>




  </div>
  
   
  
   <br> 
   </div>
 
  
  
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
   
 <script>
    function activarRoles(eventoId) {
        // Deshabilitar todos los roles
        document.querySelectorAll('input[name="roles"]').forEach(el => el.disabled = true);

        // Habilitar solo los roles del evento seleccionado
        document.querySelectorAll('.roles-' + eventoId).forEach(el => el.disabled = false);
    }

    function validarFormulario() {
        let eventoSeleccionado = document.querySelector('input[name="evento_seleccionado"]:checked');
        let rolSeleccionado = document.querySelector('input[name="roles"]:checked');

        if (!eventoSeleccionado) {
            alert('Debes seleccionar un evento.');
            return false;
        }

        if (!rolSeleccionado) {
            alert('Debes seleccionar un rol para el evento.');
            return false;
        }

        return true;
    }
</script> 
  
  
  
@push('scripts')
@endpush


@endsection