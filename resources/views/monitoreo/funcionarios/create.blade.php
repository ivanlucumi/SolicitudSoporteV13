@extends('layouts.monitoreo.coordinador')

@section('title', 'Registrar Funcionario')
@section('cabecera', 'Registrar Nuevo Funcionario')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="box box-success" style="border-radius:12px;">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user-plus"></i> Datos del Funcionario</h3>
        <small class="text-muted pull-right">Podrá asignarle un puesto desde el listado</small>
      </div>

      <form action="{{ route('cooringreso.funcionarios.store') }}" method="POST">
    @csrf
      <div class="box-body" style="padding:25px;">

        {{-- Datos personales --}}
        <h4 class="text-primary"><i class="fa fa-user"></i> Información Personal</h4><hr>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group {{ $errors->has('cedula') ? 'has-error' : '' }}">
              <label>Cédula: <span class="text-danger">*</span></label>
              <input class="form-control @error('cedula') is-invalid @enderror" placeholder="Número de identificación" autocomplete="off" type="text" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              @if($errors->has('cedula'))<span class="help-block text-danger">{{ $errors->first('cedula') }}</span>@endif
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
              <label>Nombre Completo: <span class="text-danger">*</span></label>
              <input class="form-control @error('nombre') is-invalid @enderror" placeholder="APELLIDO NOMBRE" style="text-transform:uppercase;" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
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
              <input class="form-control @error('cargo') is-invalid @enderror" placeholder="Ej: MAGISTRADO" style="text-transform:uppercase;" type="text" name="cargo" id="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Calidad:</label>
              <select class="form-control @error('calidad') is-invalid @enderror" name="calidad" id="calidad">
    @foreach(['FUNCIONARIO'=>'FUNCIONARIO','MAGISTRADO'=>'MAGISTRADO','EMPLEADO'=>'EMPLEADO','CONTRATISTA'=>'CONTRATISTA','OTRO'=>'OTRO'] as $key => $value)
        <option value="{{ $key }}" @selected(old('calidad', 'FUNCIONARIO') == $key)>{{ $value }}</option>
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
        <option value="{{ $key }}" @selected(old('tipo_ingreso', 'RESTRINGIDO') == $key)>{{ $value }}</option>
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
                              data-email="{{ $d->correoD }}">
                          {{ $d->nombreDespacho }}
                      </option>
                  @endforeach
              </select>
              <input type="hidden" name="despacho" id="despacho_val">
              <input type="hidden" name="codigo_despacho" id="codigo_despacho">
              <input type="hidden" name="email_despacho" id="email_despacho">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Especialidad / Detalles:</label>
              <input class="form-control @error('especialidad') is-invalid @enderror" placeholder="Ej: CIVIL DEL CIRCUITO" style="text-transform:uppercase;" type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>

        {{-- Datos del vehículo --}}
        <h4 class="text-primary" style="margin-top:20px;"><i class="fa fa-car"></i> Información del Vehículo</h4><hr>
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group {{ $errors->has('placa') ? 'has-error' : '' }}">
              <label>Placa: <span class="text-danger">*</span></label>
              <input class="form-control @error('placa') is-invalid @enderror" placeholder="ABC123" style="text-transform:uppercase;" type="text" name="placa" id="placa" value="{{ old('placa') }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Calidad Vehículo: <span class="text-danger">*</span></label>
              <select class="form-control @error('calidad_vehiculo') is-invalid @enderror" name="calidad_vehiculo" id="calidad_vehiculo">
    @foreach(['PARTICULAR'=>'PARTICULAR','OFICIAL'=>'OFICIAL'] as $key => $value)
        <option value="{{ $key }}" @selected(old('calidad_vehiculo', 'PARTICULAR') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('calidad_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group {{ $errors->has('tipo_vehiculo') ? 'has-error' : '' }}">
              <label>Tipo Vehículo: <span class="text-danger">*</span></label>
              <select class="form-control @error('tipo_vehiculo') is-invalid @enderror" name="tipo_vehiculo" id="tipo_vehiculo">
    @foreach([
                  'CARRO'          => 'CARRO',
                  'MOTO'           => 'MOTO',
                  'CAMIONETA'      => 'CAMIONETA',
                  'BICICLETA'      => 'BICICLETA / CICLA',
                  'MOTO ELECTRICA' => 'MOTO ELÉCTRICA',
                  'MONOPATIN'      => 'MONOPATÍN'
              ] as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_vehiculo', 'CARRO') == $key)>{{ $value }}</option>
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
              <input class="form-control @error('descripcion_vehiculo') is-invalid @enderror" placeholder="Ej: Mazda 3 Gris" style="text-transform:uppercase;" type="text" name="descripcion_vehiculo" id="descripcion_vehiculo" value="{{ old('descripcion_vehiculo') }}">
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
            {{-- Aquí se cargarán los vehículos dinámicamente --}}
        </div>

        <div class="row" style="margin-top:20px;">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Observaciones Vehículo:</label>
              <textarea class="form-control @error('observaciones') is-invalid @enderror" rows="2" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
        </div>

        <div class="alert alert-info" style="margin-top:10px;">
          <i class="fa fa-info-circle"></i>
          El puesto de parqueadero se asignará después desde el listado de funcionarios.
        </div>

      </div>{{-- /.box-body --}}
      <div class="box-footer">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fa fa-save"></i> Guardar Funcionario
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
    var vehicleIndex = 0;
    
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

    // Autocompletado por cédula
    $('input[name="cedula"]').on('blur', function() {
        var $cedulaInput = $(this);
        var cedula = $cedulaInput.val();
        
        if (cedula.length >= 5) {
            // Limpiar campos antes de la consulta
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

                        // Buscar y seleccionar despacho en Select2
                        if (data.codigo_despacho) {
                            var $despachoSelect = $('#despacho_select');
                            var optionToSelect = $despachoSelect.find('option').filter(function() {
                                return $(this).data('codigo') == data.codigo_despacho;
                            });

                            if (optionToSelect.length) {
                                $despachoSelect.val(optionToSelect.val()).trigger('change');
                            }
                        }
                        
                        toastr.success('Datos de empleado encontrados y cargados.');
                    } else {
                        // Limpiar campos si no hay resultados
                        $('input[name="nombre"]').val('');
                        $('input[name="cargo"]').val('');
                        $('#despacho_select').val('').trigger('change');
                        toastr.warning('No se encontraron datos para la cédula ingresada.');
                    }
                },
                error: function() {
                    console.error('Error en la búsqueda de empleado');
                    toastr.error('Error al consultar los datos del empleado.');
                }
            });
        }
    });
});
</script>
@endpush
