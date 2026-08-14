@extends('layouts.monitoreo.coordinador')

@section('title', 'Editar Funcionario')
@section('cabecera', 'Editar Datos: {{ $funcionario->nombre }}')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="box box-warning" style="border-radius:12px;">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-pencil"></i> Editar Funcionario: <strong>{{ $funcionario->nombre }}</strong></h3>
        @if($funcionario->puesto)
          <span class="label label-success pull-right" style="margin-top:5px;">
            Puesto: {{ $funcionario->puesto->parqueadero }} — {{ $funcionario->puesto->edificio }}
          </span>
        @else
          <span class="label label-danger pull-right" style="margin-top:5px;">Sin puesto asignado</span>
        @endif
      </div>

      <form action="{{ route('cooringreso.funcionarios.update', $funcionario->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="box-body" style="padding:25px;">

        <h4 class="text-primary"><i class="fa fa-user"></i> Información Personal</h4><hr>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group {{ $errors->has('cedula') ? 'has-error' : '' }}">
              <label>Cédula:</label>
              <input class="form-control @error('cedula') is-invalid @enderror" type="text" name="cedula" id="cedula" value="{{ old('cedula', $funcionario->cedula ?? '') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              @if($errors->has('cedula'))<span class="help-block text-danger">{{ $errors->first('cedula') }}</span>@endif
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group">
              <label>Nombre Completo:</label>
              <input class="form-control @error('nombre') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="nombre" id="nombre" value="{{ old('nombre', $funcionario->nombre ?? '') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>Cargo:</label>
              <input class="form-control @error('cargo') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="cargo" id="cargo" value="{{ old('cargo', $funcionario->cargo ?? '') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Estado Funcionario:</label>
              <select class="form-control @error('estado_funcionario') is-invalid @enderror" name="estado_funcionario" id="estado_funcionario">
    @foreach(['ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO'] as $key => $value)
        <option value="{{ $key }}" @selected(old('estado_funcionario') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('estado_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Calidad:</label>
              <select class="form-control @error('calidad') is-invalid @enderror" name="calidad" id="calidad">
    @foreach(['FUNCIONARIO'=>'FUNCIONARIO','MAGISTRADO'=>'MAGISTRADO','EMPLEADO'=>'EMPLEADO','CONTRATISTA'=>'CONTRATISTA','OTRO'=>'OTRO'] as $key => $value)
        <option value="{{ $key }}" @selected(old('calidad') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('calidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Tipo de Ingreso:</label>
              <select class="form-control @error('tipo_ingreso') is-invalid @enderror" name="tipo_ingreso" id="tipo_ingreso">
    @foreach(App\Models\Parqueadero::tiposIngreso() as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_ingreso') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_ingreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Juzgado / Despacho: <span class="text-danger">*</span></label>
              <select name="despacho_select" id="despacho_select" class="form-control select2" required style="width: 100%;">
                  <option value="">-- SELECCIONE DESPACHO --</option>
                  @foreach($despachos as $d)
                      <option value="{{ $d->nombreDespacho }}" 
                              data-codigo="{{ $d->codigoDespacho }}" 
                              data-email="{{ $d->correoD }}"
                              {{ ($funcionario->codigo_despacho == $d->codigoDespacho || $funcionario->juzgado == $d->nombreDespacho) ? 'selected' : '' }}>
                          {{ $d->nombreDespacho }}
                      </option>
                  @endforeach
              </select>
              <input type="hidden" name="despacho" id="despacho_val" value="{{ $funcionario->despacho ?? $funcionario->juzgado }}">
              <input type="hidden" name="codigo_despacho" id="codigo_despacho" value="{{ $funcionario->codigo_despacho }}">
              <input type="hidden" name="email_despacho" id="email_despacho" value="{{ $funcionario->email_despacho }}">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Especialidad / Detalles:</label>
              <input class="form-control @error('especialidad') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="especialidad" id="especialidad" value="{{ old('especialidad', $funcionario->especialidad ?? '') }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>

        <h4 class="text-primary" style="margin-top:20px;">
            <i class="fa fa-car"></i> Información del Vehículo Principal
        </h4><hr>
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label>Placa:</label>
              <input class="form-control @error('placa') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="placa" id="placa" value="{{ old('placa', $funcionario->placa ?? '') }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Calidad Vehículo:</label>
              <select class="form-control @error('calidad_vehiculo') is-invalid @enderror" name="calidad_vehiculo" id="calidad_vehiculo">
    @foreach(['PARTICULAR'=>'PARTICULAR','OFICIAL'=>'OFICIAL'] as $key => $value)
        <option value="{{ $key }}" @selected(old('calidad_vehiculo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('calidad_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Tipo de Vehículo:</label>
              <select class="form-control @error('tipo_vehiculo') is-invalid @enderror" name="tipo_vehiculo" id="tipo_vehiculo">
    @foreach([
                  'CARRO'          => 'CARRO',
                  'MOTO'           => 'MOTO',
                  'CAMIONETA'      => 'CAMIONETA',
                  'BICICLETA'      => 'BICICLETA / CICLA',
                  'MOTO ELECTRICA' => 'MOTO ELÉCTRICA',
                  'MONOPATIN'      => 'MONOPATÍN'
              ] as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_vehiculo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Color / Descripción:</label>
              <input class="form-control @error('descripcion_vehiculo') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="descripcion_vehiculo" id="descripcion_vehiculo" value="{{ old('descripcion_vehiculo', $funcionario->descripcion_vehiculo ?? '') }}">
@error('descripcion_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>

        <h4 class="text-primary" style="margin-top:30px;">
            <i class="fa fa-plus-circle"></i> Vehículos Adicionales
            <button type="button" id="btn-add-vehicle" class="btn btn-success btn-xs pull-right" style="border-radius:10px;">
                <i class="fa fa-plus"></i> Agregar Otro Vehículo
            </button>
        </h4><hr>
        
        <div id="additional-vehicles-container">
            @foreach($vehiculosHermanos as $index => $vExtra)
                <div class="row vehicle-row" style="margin-bottom: 15px; background: #fcfcfc; padding: 10px; border-radius: 8px; border: 1px dashed #ddd;">
                    <input type="hidden" name="vehiculos_extra[{{ $index }}][id]" value="{{ $vExtra->id }}">
                    <div class="col-sm-3">
                        <div class="form-group" style="margin-bottom:0;">
                            <label><small>Placa:</small></label>
                            <input type="text" name="vehiculos_extra[{{ $index }}][placa]" class="form-control input-sm" value="{{ $vExtra->placa }}" style="text-transform:uppercase;" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group" style="margin-bottom:0;">
                            <label><small>Tipo:</small></label>
                            <select name="vehiculos_extra[{{ $index }}][tipo_vehiculo]" class="form-control input-sm">
                                <option value="CARRO" {{ $vExtra->tipo_vehiculo == 'CARRO' ? 'selected' : '' }}>CARRO</option>
                                <option value="MOTO" {{ $vExtra->tipo_vehiculo == 'MOTO' ? 'selected' : '' }}>MOTO</option>
                                <option value="CAMIONETA" {{ $vExtra->tipo_vehiculo == 'CAMIONETA' ? 'selected' : '' }}>CAMIONETA</option>
                                <option value="BICICLETA" {{ $vExtra->tipo_vehiculo == 'BICICLETA' ? 'selected' : '' }}>BICICLETA / CICLA</option>
                                <option value="MOTO ELECTRICA" {{ $vExtra->tipo_vehiculo == 'MOTO ELECTRICA' ? 'selected' : '' }}>MOTO ELÉCTRICA</option>
                                <option value="MONOPATIN" {{ $vExtra->tipo_vehiculo == 'MONOPATIN' ? 'selected' : '' }}>MONOPATÍN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group" style="margin-bottom:0;">
                            <label><small>Calidad Vehículo:</small></label>
                            <select name="vehiculos_extra[{{ $index }}][calidad_vehiculo]" class="form-control input-sm">
                                <option value="PARTICULAR" {{ $vExtra->calidad_vehiculo == 'PARTICULAR' ? 'selected' : '' }}>PARTICULAR</option>
                                <option value="OFICIAL" {{ $vExtra->calidad_vehiculo == 'OFICIAL' ? 'selected' : '' }}>OFICIAL</option>
                                <option value="OTRO" {{ $vExtra->calidad_vehiculo == 'OTRO' ? 'selected' : '' }}>OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group" style="margin-bottom:0;">
                            <label><small>Descripción:</small></label>
                            <input type="text" name="vehiculos_extra[{{ $index }}][descripcion]" class="form-control input-sm" value="{{ $vExtra->descripcion_vehiculo }}" style="text-transform:uppercase;">
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-vehicle" style="margin-top:20px; border-radius:50%;">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row" style="margin-top:20px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Observaciones Vehículo:</label>
                    <textarea class="form-control @error('observaciones') is-invalid @enderror" rows="2" name="observaciones" id="observaciones">{{ old('observaciones', $funcionario->observaciones ?? '') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
            </div>
        </div>

      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-warning btn-lg">
          <i class="fa fa-refresh"></i> Actualizar
        </button>
        <a href="{{ route('cooringreso.funcionarios.index') }}" class="btn btn-default btn-lg pull-right">
          Cancelar
        </a>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inicializar Select2 si está disponible
    if ($.fn.select2) {
        $('.select2').select2({
            placeholder: "-- SELECCIONE DESPACHO --",
            allowClear: true
        });
    }

    // Sincronizar campos ocultos al cambiar selección
    $('#despacho_select').on('change', function() {
        var selected = $(this).find('option:selected');
        var nombre = selected.val();
        var codigo = selected.data('codigo');
        var email  = selected.data('email');

        $('#despacho_val').val(nombre);
        $('#codigo_despacho').val(codigo);
        $('#email_despacho').val(email);
    });

    // Gestión dinámica de vehículos adicionales
    var vehicleIndex = {{ $vehiculosHermanos->count() }};
    
    $('#btn-add-vehicle').on('click', function() {
        var html = `
            <div class="row vehicle-row" style="margin-bottom: 15px; background: #fcfcfc; padding: 10px; border-radius: 8px; border: 1px dashed #004182; display:none;">
                <div class="col-sm-3">
                    <div class="form-group" style="margin-bottom:0;">
                        <label><small>Placa:</small></label>
                        <input type="text" name="vehiculos_extra[${vehicleIndex}][placa]" class="form-control input-sm" placeholder="ABC123" style="text-transform:uppercase;" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" style="margin-bottom:0;">
                        <label><small>Tipo:</small></label>
                        <select name="vehiculos_extra[${vehicleIndex}][tipo_vehiculo]" class="form-control input-sm">
                            <option value="CARRO">CARRO</option>
                            <option value="MOTO">MOTO</option>
                            <option value="CAMIONETA">CAMIONETA</option>
                            <option value="BICICLETA">BICICLETA / CICLA</option>
                            <option value="MOTO ELECTRICA">MOTO ELÉCTRICA</option>
                            <option value="MONOPATIN">MONOPATÍN</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" style="margin-bottom:0;">
                        <label><small>Calidad Vehículo:</small></label>
                        <select name="vehiculos_extra[${vehicleIndex}][calidad_vehiculo]" class="form-control input-sm">
                            <option value="PARTICULAR">PARTICULAR</option>
                            <option value="OFICIAL">OFICIAL</option>
                            <option value="OTRO">OTRO</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group" style="margin-bottom:0;">
                        <label><small>Descripción:</small></label>
                        <input type="text" name="vehiculos_extra[${vehicleIndex}][descripcion]" class="form-control input-sm" placeholder="COLOR, MARCA..." style="text-transform:uppercase;">
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <button type="button" class="btn btn-danger btn-sm btn-remove-vehicle" style="margin-top:20px; border-radius:50%;">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        var $newRow = $(html);
        $('#additional-vehicles-container').append($newRow);
        $newRow.fadeIn();
        vehicleIndex++;
    });

    $(document).on('click', '.btn-remove-vehicle', function() {
        var $row = $(this).closest('.vehicle-row');
        $row.fadeOut(function() {
            $row.remove();
        });
    });

    // Autocompletado por cédula (en caso de actualización de datos maestros)
    $('input[name="cedula"]').on('blur', function() {
        var $cedulaInput = $(this);
        var cedula = $cedulaInput.val();
        
        if (cedula.length >= 5) {
            // Limpiar campos antes de la consulta (según solicitud del usuario)
            $('input[name="nombre"]').val('');
            $('input[name="cargo"]').val('');
            $('#despacho_select').val('').trigger('change');

            $.ajax({
                url: "{{ route('cooringreso.buscar_empleado.ajax') }}",
                type: 'GET',
                data: { cedula: cedula },
                success: function(response) {
                    if (response.success) {
                        var data = response.data;
                        $('input[name="nombre"]').val(data.nombre);
                        $('input[name="cargo"]').val(data.cargo);
                        
                        if (data.calidad) {
                            $('select[name="calidad"]').val(data.calidad);
                        }

                        if (data.codigo_despacho) {
                            var $despachoSelect = $('#despacho_select');
                            var optionToSelect = $despachoSelect.find('option').filter(function() {
                                return $(this).data('codigo') == data.codigo_despacho;
                            });

                            if (optionToSelect.length) {
                                $despachoSelect.val(optionToSelect.val()).trigger('change');
                            }
                        }
                        
                        toastr.info('Datos de empleado actualizados desde el sistema central.');
                    } else {
                        // En edición, si no se encuentra en el sistema central, informamos
                        // pero no borramos los datos actuales del registro de parqueadero por seguridad.
                        toastr.warning('No se encontraron datos actualizados para esta cédula en el sistema central.');
                    }
                },
                error: function() {
                    toastr.error('Error al consultar el sistema central de empleados.');
                }
            });
        }
    });
});
</script>
@endpush
