@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera', 'REGISTRE SU REQUERIMIENTO')

@section('content')

@push('scripts')
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

@endpush


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
      <form enctype="multipart/form-data" onsubmit="return validarImagen();" action="{{ route('usuario.solicitud.save.notificados') }}" method="POST">
    @csrf
        <div class="row">
          <div class="col-xs-12 col-sm-4" style="display: none">
          <input class="form-control" autocomplete="off" type="hidden" name="codigoDespacho" id="codigoDespacho" value="{{  auth()->user()->cedula }}">
          <input class="form-control" autocomplete="off" type="hidden" name="correo_despacho" id="correo_despacho" value="{{  auth()->user()->email }}">
          <label for="DESPACHO">Despacho:</label>
          <input class="form-control @error('despacho') is-invalid @enderror" id="despacho" type="text" name="despacho" value="{{ old('despacho',  auth()->user()->name.&quot;  &quot;. auth()->user()->lastname) }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

          </div>
          <div class="col-xs-12 col-sm-4">
          <label for="nRadicacion">Número de radicaci&oacute;n del proceso:</label>
          <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" /*'onkeyup'="&quot;validarcantidad(this)&quot;" */'min'="'1" placeholder="Ingrese número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso', $notificacion->numero_radicado_proceso) }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          <div id="cantidad"></div>
          </div>
          <div class="col-xs-12 col-sm-4">
          <label for="Delito">Delito:</label>
          <input class="form-control @error('delito') is-invalid @enderror" id="delito" placeholder="Diligencia Delito" type="text" name="delito" value="{{ old('delito', $notificacion->delito) }}">
@error('delito')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
            <div class="col-xs-12 col-sm-4">
            <label for="audiencia">Clase Audiencia:</label>
            <select class="form-control select2 @error('clase_audiencia') is-invalid @enderror" autocomplete="off" id="clase_audiencia" name="clase_audiencia">
    <option value="">Seleccione Clase De Audiencia</option>
    @foreach($TipoAudiencia as $key => $value)
        <option value="{{ $key }}" @selected(old('clase_audiencia', $notificacion->clase_audiencia) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('clase_audiencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

            </div>
          <div class="col-xs-12 col-sm-4">
          <label for="OFDICIO">Fecha Audiencia:</label>
          <input class="form-control @error('fecha_audiencia') is-invalid @enderror" id="fecha_audiencia" placeholder="Diligencia el Oficio" type="date" name="fecha_audiencia" value="{{ old('fecha_audiencia', $notificacion->fecha_audiencia) }}">
@error('fecha_audiencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
          <div class="col-xs-12 col-sm-4  time">
          <label for="horaI">Hora inicio:</label>
          <input class="form-control timepicker @error('hora_inicio') is-invalid @enderror" id="timepicker" autocomplete="off" placeholder="Ingrese formato militar (24 horas)" type="time" name="hora_inicio" value="{{ old('hora_inicio', $notificacion->hora_inicio) }}">
@error('hora_inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
          <div class="col-xs-12 col-sm-4">
          <label for="Lugar">Lugar:</label>
          <input class="form-control @error('lugar') is-invalid @enderror" id="lugar" placeholder="Diligencia Lugar" type="text" name="lugar" value="{{ old('lugar', $notificacion->lugar) }}">
@error('lugar')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
        </div>
       <br>
            <button class="btn btn-success" style="float:right" type="submit">GUARDAR SOLICITUD</button>
            <h2>
              <center>
                AGREGAR PERSONA A NOTIFICAR
                <br>
              </center>
            </h2>
            <div class="form-group" style="display:">
              <button type="button" class="btn btn-primary mr-2" onclick="agregarCampo()"> Agregar Persona</button>
              <button type="button" class="btn btn-danger" onclick="eliminarCampo()">Eliminar Fila Nueva</button>
            </div>


		   <table border="0" class="table"  id="tablaDatos">
            <thead class="thead-dark">
              <tr></tr></thead>
                <tr ><td>
                @if($notificaciones->isEmpty())
                <div class="row">
                      <div class="col-xs-12 col-sm-2">
                        <label for="identidicacion">Tipo Identificacion:</label>
                        <select class="form-control select2 @error('tipo_identificacion[]') is-invalid @enderror" autocomplete="off" id="tipo_identificacion" name="tipo_identificacion[]">
    <option value="">Seleccione Tipo Identificacion</option>
    @foreach($TipoIdentificacion as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_identificacion[]') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_identificacion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <label for="identificacion">Identificacion:</label>
                        <input class="form-control @error('identificacion[]') is-invalid @enderror" min="1" id="identificacion" placeholder="Regsitre Identificacion" type="number" name="identificacion[]" value="{{ old('identificacion[]') }}">
@error('identificacion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                      </div>
                      <div class="col-xs-12 col-sm-5">
                        <label for="Nombre">Nombre(s) Apellido(s):</label>
                        <input class="form-control @error('nombre_apellido[]') is-invalid @enderror" id="nombre_apellido" placeholder="Diligencia Nombres y Apellidos" type="text" name="nombre_apellido[]" value="{{ old('nombre_apellido[]') }}">
@error('nombre_apellido[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="identidicacion">Tipo Parte:</label>
                        <select class="form-control select2 @error('tipo_parte[]') is-invalid @enderror" autocomplete="off" id="tipo_parte" name="tipo_parte[]">
    <option value="">Seleccione Tipo Identificacion</option>
    @foreach($TipoParte as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_parte[]') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_parte[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <label for="tipo_notificacion">Tipo Notificacion:</label>
                        <select class="form-control select2 @error('tipo_notificacion[]') is-invalid @enderror" autocomplete="off" id="tipo_notificacion" name="tipo_notificacion[]">
    <option value="">Seleccione Tipo Identificacion</option>
    @foreach($TipoNotificacion as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_notificacion[]') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_notificacion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="Direccion">Direccion:</label>
                        <input class="form-control @error('direccion[]') is-invalid @enderror" id="direccion" placeholder="Registre Direccion" type="text" name="direccion[]" value="{{ old('direccion[]') }}">
@error('direccion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-2">
                        <label for="Ciudad">Ciudad:</label>
                        <input class="form-control @error('ciudad[]') is-invalid @enderror" id="ciudad" placeholder="Registre Ciudad" type="text" name="ciudad[]" value="{{ old('ciudad[]') }}">
@error('ciudad[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-2">
                        <label for="Telefono">Telefono:</label>
                        <input class="form-control @error('telefono_citado[]') is-invalid @enderror" id="telefono_citado" placeholder="Registre Telefono para Contacto" type="text" name="telefono_citado[]" value="{{ old('telefono_citado[]') }}">
@error('telefono_citado[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-3">
                        <label for="correo_citado">Correo:</label>
                        <input class="form-control @error('correo_citado[]') is-invalid @enderror" id="correo_citado" placeholder="Registre Correo para Contacto" type="email" name="correo_citado[]" value="{{ old('correo_citado[]') }}">
@error('correo_citado[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="col-xs-12 col-sm-12">
                        <label for="Observaciones">Observaciones:</label>
                        <textarea class="form-control @error('observaciones[]') is-invalid @enderror" id="observaciones" style="height: 73px;" placeholder="Registre Observaciones" name="observaciones[]">{{ old('observaciones[]') }}</textarea>
@error('observaciones[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                     </div>
                 </tr></td>
                 @endif
    
                @foreach($notificaciones as $key => $notificacion)
                <tr id="fila{{$key}}"><td>
                <div class="row">
                  <div class="col-xs-6">
                      <h3>PERSONA A NOTIFICAR </h3><input type="button" onclick="eliminarFila({{$key}});" class="btn btn-danger btn-xs fa fa-remove" value="Quitar" />
                  </div>
                  <div class="col-xs-6">
    
                  </div>
                 </div>
                 <br>
                <div class="row">
                  <div class="col-xs-12 col-sm-2">
                    <label for="identidicacion">Tipo Identificacion:</label>
                    <select class="form-control select2 @error('tipo_identificacion[]') is-invalid @enderror" autocomplete="off" id="tipo_identificacion" name="tipo_identificacion[]">
    <option value="">Seleccione Tipo Identificacion</option>
    @foreach($TipoIdentificacion as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_identificacion[]', $notificacion->tipo_identificacion) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_identificacion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-2">
                    <label for="identificacion">Identificacion:</label>
                    <input class="form-control @error('identificacion[]') is-invalid @enderror" min="1" id="identificacion" placeholder="Regsitre Identificacion" type="number" name="identificacion[]" value="{{ old('identificacion[]', $notificacion->identificacion) }}">
@error('identificacion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-5">
                    <label for="Nombre">Nombre(s) Apellido(s):</label>
                    <input class="form-control @error('nombre_apellido[]') is-invalid @enderror" id="nombre_apellido" placeholder="Diligencia Nombres y Apellidos" type="text" name="nombre_apellido[]" value="{{ old('nombre_apellido[]', $notificacion->nombre_apellido) }}">
@error('nombre_apellido[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="identidicacion">Tipo Parte:</label>
                    <select class="form-control select2 @error('tipo_parte[]') is-invalid @enderror" autocomplete="off" id="tipo_parte" name="tipo_parte[]">
    <option value="">Seleccione Tipo Identificacion</option>
    @foreach($TipoParte as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_parte[]', $notificacion->tipo_parte) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_parte[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-2">
                    <label for="tipo_notificacion">Tipo Notificacion:</label>
                    <select class="form-control select2 @error('tipo_notificacion[]') is-invalid @enderror" autocomplete="off" id="tipo_notificacion" name="tipo_notificacion[]">
    <option value="">Seleccione Tipo Identificacion</option>
    @foreach($TipoNotificacion as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_notificacion[]', $notificacion->tipo_notificacion) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_notificacion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="Direccion">Direccion:</label>
                    <input class="form-control @error('direccion[]') is-invalid @enderror" id="direccion" placeholder="Registre Direccion" type="text" name="direccion[]" value="{{ old('direccion[]', $notificacion->direccion) }}">
@error('direccion[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-sm-2">
                    <label for="Ciudad">Ciudad:</label>
                    <input class="form-control @error('ciudad[]') is-invalid @enderror" id="ciudad" placeholder="Registre Ciudad" type="text" name="ciudad[]" value="{{ old('ciudad[]', $notificacion->ciudad) }}">
@error('ciudad[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-sm-2">
                    <label for="Telefono">Telefono:</label>
                    <input class="form-control @error('telefono_citado[]') is-invalid @enderror" id="telefono_citado" placeholder="Registre Telefono para Contacto" type="text" name="telefono_citado[]" value="{{ old('telefono_citado[]', $notificacion->telefono_citado) }}">
@error('telefono_citado[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-sm-3">
                    <label for="correo_citado">Correo:</label>
                    <input class="form-control @error('correo_citado[]') is-invalid @enderror" id="correo_citado" placeholder="Registre Telefono para Contacto" type="email" name="correo_citado[]" value="{{ old('correo_citado[]', $notificacion->correo_citado) }}">
@error('correo_citado[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-sm-12">
                    <label for="Observaciones">Observaciones:</label>
                    <textarea class="form-control @error('observaciones[]') is-invalid @enderror" id="observaciones" style="height: 73px;" placeholder="Registre Observaciones" name="observaciones[]">{{ old('observaciones[]', $notificacion->observaciones) }}</textarea>
@error('observaciones[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
    
                    </div>
                    <hr style="height: 1px;  background-color: red;">
                  @endforeach
    
                </form>
        </table>

      </div>
    </div>
</div>






<script>
 $(function () {


                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });

                 //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })



            });

function eliminarFila(index) {
  $("#fila" + index).remove();
}
</script>

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Registro Ip",    //Nombre del archivo
});

</script>


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

function nombre(id){
        //console.log(id)
        div = document.getElementById(id);

        console.log('hola')

        }

  $(function () {
      $('#datetimepicker3').datetimepicker({
         format: 'LT'
       });
  });

  //Timepicker
  $('.timepicker').timepicker({
      showInputs: false
    })


/*var timepicker = new TimePicker('time', {
  lang: 'en',
  theme: 'dark'
});
timepicker.on('change', function(evt) {

  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});*/

function eliminarCampo(){
  var table = document.getElementById("tablaDatos");
  var rowCount = table.rows.length;
  //console.log(rowCount);

  if(rowCount <= 2)
    alert('No se puede eliminar Este Registro');
  else
    table.deleteRow(1);
}

function agregarCampo(){
  var table = document.getElementById("tablaDatos");
  var rowCount = table.rows.length;
  //alert(rowCount)
  document.getElementById("tablaDatos").insertRow(1).innerHTML = ` <tr><td>
          <div class="row">

          <div class="col-xs-12 col-sm-2">
            <label for="identidicacion">Tipo Identificacion:</label>
            <select class="form-control select2" shadow="" autocomplete="off" id="tipo_identificacion" name="tipo_identificacion[]" required=""><option selected="selected" value="">Seleccione Tipo Identificacion</option><option value="CC">CC</option><option value="CE">CE</option><option value="NIT">NIT</option><option value="NUIR">NIUR</option><option value="PASAPORTE">PASAPORTE</option><option value="SIN_IDENTIFICACION">SIN_IDENTIFICACION</option><option value="TI">TI</option></select>
          </div>
          <div class="col-xs-12 col-sm-2">
            <label for="identificacion">Identificacion:</label>
            <input class="form-control" shadow="" min="1" id="identificacion" placeholder="Regsitre Identificacion" name="identificacion[]" type="number">
          </div>
          <div class="col-xs-12 col-sm-5">
            <label for="Nombre">Nombre(s) Apellido(s):</label>
            <input class="form-control" shadow="" id="nombre_apellido" required="" placeholder="Diligencia Nombres y Apellidos" name="nombre_apellido[]" type="text">
            </div>
          <div class="col-xs-12 col-sm-3">
            <label for="identidicacion">Tipo Parte:</label>
            <select class="form-control select2" shadow="" autocomplete="off" id="tipo_parte" name="tipo_parte[]" required=""><option selected="selected" value="">Seleccione Tipo Parte</option><option value="DDO">DDO</option><option value="DTE">DTE</option><option value="FISCALIA">FISCALIA</option><option value="IMPUTADO">IMPUTADO</option><option value="INDICIADO">INDICIADO</option></select>
          </div>
          <div class="col-xs-12 col-sm-2">
            <label for="tipo_notificacion">Tipo Notificacion:</label>
            <select class="form-control select2" shadow="" autocomplete="off" id="tipo_notificacion" name="tipo_notificacion[]"><option selected="selected" value="">Seleccione Tipo Identificacion</option><option value="CENTRO CARCELARIO">CENTRO CARCELARIO</option><option value="CORREO">CORREO</option><option value="DIRECCION">DIRECCION</option><option value="DOMICILIARIA">DOMICILIARIA</option></select>
          </div>
          <div class="col-xs-12 col-sm-3">
            <label for="Direccion">Direccion:</label>
            <input class="form-control" shadow="" id="direccion" placeholder="Registre Direccion" name="direccion[]" type="text">
            </div>
            <div class="col-xs-12 col-sm-2">
            <label for="Ciudad">Ciudad:</label>
            <input class="form-control" shadow="" id="ciudad" placeholder="Registre Ciudad" name="ciudad[]" type="text">
            </div>
            <div class="col-xs-12 col-sm-2">
            <label for="Telefono">Telefono:</label>
            <input class="form-control" shadow="" id="telefono_citado" placeholder="Registre Telefono para Contacto" name="telefono_citado[]" type="text">
            </div>
            <div class="col-xs-12 col-sm-3">
            <label for="Correo">Correo:</label>
            <input class="form-control" shadow="" id="correo_citado[]" placeholder="Registre Correo para Contacto" name="correo_citado[]" type="text">
            </div>
            <div class="col-xs-12 col-sm-12">
            <label for="Observaciones">Observaciones:</label>
            <textarea class="form-control" shadow="" id="observaciones" style="height: 73px; width: 1540px;" placeholder="Registre Observaciones" name="observaciones[]" cols="50" rows="10"></textarea>
            </div>
          </div>
          </td></tr>`;
}
</script>

@endpush


@endsection



