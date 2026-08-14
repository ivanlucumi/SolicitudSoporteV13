@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Notificacion')
@section('cabecera')
SOLICITUD DE NOTIFICACION
@endsection

@section('content')


 <div class="panel-group">
    <div class="panel panel-warning">
      <div class="panel-body">
         <a class="btn btn-danger" href="{{ url()->previous() }}">Ir Atras</a>
        <center>
          <h3>
            <strong> SOLICITUD DE NOTIFICACION REALIZADA  {{$notificacion[0]->fecha_recibido}} </strong>
          </h3>
        </center>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-xs-12 col-sm-3">
          <label for="nRadicacion">Número de radicaci&oacute;n del proceso:</label>
          <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" /*'onkeyup'="&quot;validarcantidad(this)&quot;" */'min'="'1" placeholder="Ingrese número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso', $notificacion[0]->numero_radicado_proceso) }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          <div id="cantidad"></div>
          </div>
          <div class="col-xs-12 col-sm-4">
          <label for="Delito">Delito:</label>
          <input class="form-control @error('delito') is-invalid @enderror" id="delito" placeholder="Diligencia Delito" type="text" name="delito" value="{{ old('delito', $notificacion[0]->delito) }}">
@error('delito')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
            <div class="col-xs-12 col-sm-3">
            <label for="audiencia">Clase Audiencia:</label>
            <input class="form-control select2 @error('clase_audiencia') is-invalid @enderror" placeholder="Seleccione Clase De Audiencia" autocomplete="off" id="clase_audiencia" type="text" name="clase_audiencia" value="{{ old('clase_audiencia', $notificacion[0]->clase_audiencia) }}">
@error('clase_audiencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

            </div>
          <div class="col-xs-12 col-sm-2">
          <label for="OFDICIO">Fecha Audiencia:</label>
          <input class="form-control @error('fecha_audiencia') is-invalid @enderror" id="fecha_audiencia" placeholder="Diligencia el Oficio" type="date" name="fecha_audiencia" value="{{ old('fecha_audiencia', $notificacion[0]->fecha_audiencia) }}">
@error('fecha_audiencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
          <div class="col-xs-12 col-sm-4  time">
          <label for="horaI">Hora inicio:</label>
          <input class="form-control timepicker @error('hora_inicio') is-invalid @enderror" id="timepicker" autocomplete="off" placeholder="Ingrese formato militar (24 horas)" type="time" name="hora_inicio" value="{{ old('hora_inicio', $notificacion[0]->hora_inicio) }}">
@error('hora_inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
          <div class="col-xs-12 col-sm-4">
          <label for="Lugar">Lugar:</label>
          <input class="form-control @error('lugar') is-invalid @enderror" id="lugar" placeholder="Diligencia Lugar" type="text" name="lugar" value="{{ old('lugar', $notificacion[0]->lugar) }}">
@error('lugar')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
          <div class="col-xs-12 col-sm-4">
          <label for="Telefono">Telefono Despacho:</label>
          <input class="form-control @error('telefono_despacho') is-invalid @enderror" id="telefono_despacho" placeholder="Regsitre Telefono Despacho" type="text" name="telefono_despacho" value="{{ old('telefono_despacho', $notificacion[0]->telefono_despacho) }}">
@error('telefono_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
        </div>
       <br>
       <div class="panel-body">
        <center>
          <h3>
            <strong> SOLICITUD DE NOTIFICACION  </strong>
          </h3>
        </center>
      </div>
           
          
		   <table border="0" class="table"  id="tablaDatos">
            <thead class="thead-dark">
              <tr></tr></thead>
                <tr ><td>
                @foreach($notificacion as $notificacion)
                <tr><td>
                
                <div class="row" 
                @if($notificacion->oficio === null)
                <?php echo 'style="background-color: #FBBAB4"'; ?>
                @else
                <?php echo 'style="background-color: #C3F8BC"'; ?>
                @endif>
                 <div class="col-xs-12" style=" text-align: right;">
                     CENTRO DE SERVICIO OFICIO :  <input  readonly placeholder="SIN OFICIO" value="{{$notificacion->oficio}}"></input>
                 </div>
                  <div class="col-xs-12 col-sm-2">
                    <label for="identidicacion">Tipo Identificacion:</label>
                    <input class="form-control select2 @error('tipo_identificacion') is-invalid @enderror" placeholder="Seleccione Tipo Identificacion" autocomplete="off" id="tipo_identificacion" type="text" name="tipo_identificacion" value="{{ old('tipo_identificacion', $notificacion->tipo_identificacion) }}">
@error('tipo_identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-2">
                    <label for="identificacion">Identificacion:</label>
                    <input class="form-control @error('identificacion') is-invalid @enderror" min="1" id="identificacion" placeholder="Regsitre Identificacion" type="number" name="identificacion" value="{{ old('identificacion', $notificacion->identificacion) }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-5">
                    <label for="Nombre">Nombre(s) Apellido(s):</label>
                    <input class="form-control @error('nombre_apellido') is-invalid @enderror" id="nombre_apellido" placeholder="Diligencia Nombres y Apellidos" type="text" name="nombre_apellido" value="{{ old('nombre_apellido', $notificacion->nombre_apellido) }}">
@error('nombre_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="identidicacion">Tipo Parte:</label>
                    <input class="form-control select2 @error('tipo_parte') is-invalid @enderror" placeholder="Seleccione Tipo Identificacion" autocomplete="off" id="tipo_parte" type="text" name="tipo_parte" value="{{ old('tipo_parte', $notificacion->tipo_parte) }}">
@error('tipo_parte')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-2">
                    <label for="tipo_notificacion">Tipo Notificacion:</label>
                    <input class="form-control select2 @error('tipo_notificacion') is-invalid @enderror" placeholder="Seleccione Tipo Identificacion" autocomplete="off" id="tipo_notificacion" type="text" name="tipo_notificacion" value="{{ old('tipo_notificacion', $notificacion->tipo_notificacion) }}">
@error('tipo_notificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="Direccion">Direccion:</label>
                    <input class="form-control @error('direccion') is-invalid @enderror" id="direccion" placeholder="Registre Direccion" type="text" name="direccion" value="{{ old('direccion', $notificacion->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-sm-2">
                    <label for="Ciudad">Ciudad:</label>
                    <input class="form-control @error('ciudad') is-invalid @enderror" id="ciudad" placeholder="Registre Ciudad" type="text" name="ciudad" value="{{ old('ciudad', $notificacion->ciudad) }}">
@error('ciudad')
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
    
        </table>

      </div>
    </div>
</div>





@endsection



