@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera', 'REGISTRE SU REQUERIMIENTO')

@push('scripts')
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

@endpush

@section('content')
 <div class="panel-group">
    <div class="panel panel-warning">
      <div class="panel-body">
        <center>
          <h3>
            <strong> SOLICITUD DE NOTIFICACION  </strong>
          </h3>
        </center>
      </div>
      <div class="panel-footer">
      <form enctype="multipart/form-data" onsubmit="return validarImagen();" action="{{ route('usuario.solicitud.save.notificacion') }}" method="POST">
    @csrf
        <div class="row">
          <input class="form-control" autocomplete="off" type="hidden" name="codigoDespacho" id="codigoDespacho" value="{{  auth()->user()->cedula }}">
          <input class="form-control" autocomplete="off" type="hidden" name="correo_despacho" id="correo_despacho" value="{{  auth()->user()->email }}">
          <input type="hidden" name="DESPACHO" id="DESPACHO" value="{{ 'Despacho:' }}">
          <input class="form-control" id="despacho" type="hidden" name="despacho" value="{{  auth()->user()->name.&quot;  &quot;. auth()->user()->lastname }}">

          <div class="col-xs-12 col-sm-3">
            <label for="nRadicacion">Número de radicaci&oacute;n del proceso:</label>
            <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" /*'onkeyup'="&quot;validarcantidad(this)&quot;" */'min'="'1" placeholder="Ingrese número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso', $notificacion->numero_radicado_proceso) }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            <span id="cantidad"></span>
            </div>
            <div class="col-xs-12 col-sm-4">
            <label for="Delito">Delito:</label>
            <input class="form-control @error('delito') is-invalid @enderror" id="delito" placeholder="Diligencia Delito" type="text" name="delito" value="{{ old('delito', $notificacion->delito) }}">
@error('delito')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-sm-5">
            <label for="audiencia">Clase Audiencia:</label>
            <select class="form-control select2 @error('clase_audiencia') is-invalid @enderror" autocomplete="off" id="clase_audiencia" name="clase_audiencia">
    <option value="">Seleccione Clase De Audiencia</option>
    @foreach($TipoAudiencia as $key => $value)
        <option value="{{ $key }}" @selected(old('clase_audiencia') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('clase_audiencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

            </div>
           
          </div>
          <div class="row">
               <div class="col-xs-12 col-sm-4">
            <label for="OFDICIO">Fecha Audiencia:</label>
            <input class="form-control @error('fecha_audiencia') is-invalid @enderror" id="fecha_audiencia" placeholder="Diligencia el Oficio" type="date" name="fecha_audiencia" value="{{ old('fecha_audiencia', $notificacion->fecha_audiencia) }}">
@error('fecha_audiencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          <div class="col-xs-12 col-sm-4 mt-4">
          <label for="horaI">Hora inicio:</label>
          <input class="form-control @error('hora_inicio') is-invalid @enderror" id="time1" autocomplete="off" placeholder="Ingrese formato militar (24 horas)" type="time" name="hora_inicio" value="{{ old('hora_inicio', $notificacion->hora_inicio) }}">
@error('hora_inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
          <div class="col-xs-12 col-sm-4 mt-4">
          <label for="Lugar">Lugar:</label>
          <input class="form-control @error('lugar') is-invalid @enderror" id="lugar" placeholder="Diligencia Lugar" type="text" name="lugar" value="{{ old('lugar', $notificacion->lugar) }}">
@error('lugar')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
        </div>
        <hr>
        <div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Registrar Notificacion</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>

      </div>
    </div>
<hr>


@push('scripts')

<script src="/js/horaMilitar/combodate.js"></script>
<script src="adminlte/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })


</script>

@endpush


@endsection



