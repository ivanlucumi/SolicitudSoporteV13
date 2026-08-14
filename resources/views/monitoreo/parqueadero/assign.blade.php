@extends('layouts.monitoreo.coordinador')

@section('title', 'Asignación de Puesto')
@section('cabecera', 'Asignar Funcionario(s) a Puesto')

@section('content')
<div class="row" style="margin-top: 24px;">
    <div class="col-md-10 col-md-offset-1">
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; background: #fff;">
            
            {{-- Header con gradiente azul --}}
            <div class="box-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); padding: 40px 32px; border: none; text-align: center;">
                <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; backdrop-filter: blur(4px);">
                    <i class="fa fa-car" style="color: #fff; font-size: 32px;"></i>
                </div>
                <h3 class="box-title" style="color: #fff; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 24px; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                    Asignación de Puesto: {{ $puesto->parqueadero }}
                </h3>
                <p style="color: rgba(255,255,255,0.8); margin: 8px 0 0; font-size: 14px; font-weight: 500;">
                    <i class="fa fa-map-marker" style="margin-right: 6px;"></i> {{ $puesto->edificio }} — {{ $puesto->ubicacion }}
                </p>
            </div>
            
            <div class="box-body" style="padding: 40px;">
                
                {{-- Asignaciones actuales --}}
                @if($puesto->asignaciones && $puesto->asignaciones->count() > 0)
                <div style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 24px; margin-bottom: 40px;">
                    <h5 style="margin: 0 0 16px; font-weight: 800; color: #1e40af; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa fa-users" style="margin-right: 8px;"></i> Ocupación Actual:
                    </h5>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        @foreach($puesto->asignaciones as $asig)
                        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                            <a href="{{ route('cooringreso.parqueadero.liberate.assignment', $asig->id) }}" 
                               style="color: #ef4444; font-size: 14px; transition: all 0.2s;"
                               title="Quitar Funcionario"
                               onclick="return confirm('¿Está seguro de desvincular a {{ $asig->nombre }}?')">
                                <i class="fa fa-times-circle"></i>
                            </a>
                            <span style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $asig->nombre }}</span>
                            <span style="background: #1e40af; color: #fff; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800; letter-spacing: 1px;">{{ $asig->placa }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="color: #475569; font-weight: 700; font-size: 13px; margin-bottom: 12px; display: block;">Buscar Funcionario:</label>
                            <div style="display: flex; gap: 12px;">
                                <div style="flex: 1; position: relative;">
                                    <i class="fa fa-search" style="position: absolute; left: 20px; top: 18px; color: #94a3b8;"></i>
                                    <input type="text" id="termino_busqueda" class="form-control" 
                                           placeholder="Ingrese Cédula o Placa..." 
                                           style="height: 54px; border-radius: 14px; border: 2px solid #f1f5f9; background: #f8fafc; padding-left: 50px; font-size: 15px; font-weight: 600; transition: all 0.2s;"
                                           onfocus="this.style.borderColor='#3b82f6'; this.style.background='#fff';"
                                           onblur="this.style.borderColor='#f1f5f9'; this.style.background='#f8fafc';">
                                </div>
                                <button type="button" id="btn_buscar" 
                                        style="background: #2563eb; color: #fff; border: none; border-radius: 14px; font-weight: 700; padding: 0 32px; transition: all 0.2s;">
                                    BUSCAR
                                </button>
                            </div>
                        </div>
                        
                        {{-- Resultados AJAX --}}
                        <div id="resultado_busqueda" style="display:none; margin-top: 20px; background: #fff; border: 2px solid #f1f5f9; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);">
                            <div style="padding: 16px 20px; background: #f8fafc; border-bottom: 1px solid #f1f5f9; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">
                                <i class="fa fa-list-ul"></i> Coincidencias Encontradas
                            </div>
                            <div id="lista_resultados" class="list-group" style="margin: 0; border: none;">
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin: 48px 0 24px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                        <div style="width: 32px; height: 32px; background: #eff6ff; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-user-plus" style="color: #2563eb; font-size: 14px;"></i>
                        </div>
                        <h4 style="margin: 0; font-family: 'Outfit', sans-serif; font-weight: 700; color: #1e293b;">Operación de Asignación</h4>
                    </div>

                    <form id="form_asignacion" action="{{ route('cooringreso.parqueadero.assign.store') }}" method="POST">
    @csrf
                    <input type="hidden" name="puesto_id" id="puesto_id" value="{{ $puesto->id }}">

                    <div class="table-responsive">
                        <table class="table" id="tabla_asignar" style="border-collapse: separate; border-spacing: 0 8px;">
                            <thead>
                                <tr style="color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px;">
                                    <th style="padding: 12px; border: none; font-weight: 700;">Identificación</th>
                                    <th style="padding: 12px; border: none; font-weight: 700;">Nombre Completo</th>
                                    <th style="padding: 12px; border: none; font-weight: 700;">Placa</th>
                                    <th style="padding: 12px; border: none; font-weight: 700;">Vehículo</th>
                                    <th style="padding: 12px; border: none; font-weight: 700; text-align: center;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="fila_vacia">
                                    <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8; border: 2px dashed #f1f5f9; border-radius: 16px;">
                                        <i class="fa fa-info-circle" style="display: block; font-size: 24px; margin-bottom: 12px;"></i>
                                        Aún no ha seleccionado funcionarios para este puesto
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box-footer" style="padding: 32px 40px; background: #f8fafc; border-top: 1px solid #f1f5f9;">
                <div style="display: flex; gap: 20px;">
                    <button type="submit" class="btn" style="flex: 1; background: #2563eb; color: #fff; border: none; border-radius: 14px; font-weight: 700; font-size: 15px; padding: 18px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);" id="btn_confirmar" disabled>
                        <i class="fa fa-check-circle" style="margin-right: 8px;"></i> CONFIRMAR ASIGNACIÓN
                    </button>
                    <a href="{{ route('cooringreso.parqueadero.index') }}" class="btn" style="flex: 1; background: #fff; color: #64748b; border: 2px solid #e2e8f0; border-radius: 14px; font-weight: 700; font-size: 15px; padding: 18px; transition: all 0.2s;">
                        CANCELAR
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var funcActual = null;
    var arrayIds = [];

    // Búsqueda AJAX al hacer click o presionar Enter
    $('#btn_buscar').on('click', function() {
        realizarBusqueda();
    });

    $('#termino_busqueda').on('keypress', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            realizarBusqueda();
        }
    });

    function realizarBusqueda() {
        var term = $('#termino_busqueda').val().trim();
        
        if (term.length >= 3) {
            var $btn = $('#btn_buscar');
            var originalText = $btn.html();
            $btn.html('<i class="fa fa-spinner fa-spin"></i> Buscando...');
            $btn.prop('disabled', true);
            $('#resultado_busqueda').hide();

            $.ajax({
                url: "{{ route('cooringreso.parqueadero.buscar_funcionario.ajax') }}",
                data: { term: term },
                success: function(response) {
                    $btn.html(originalText);
                    $btn.prop('disabled', false);

                    if (response.success && response.data.length > 0) {
                        $('#lista_resultados').empty();
                        window.resultadosActuales = {};
                        
                        response.data.forEach(function(func) {
                            window.resultadosActuales[func.id] = func;

                            var isAssignedToThis = (func.parqueadero_id == {{ $puesto->id }});
                            var noTieneVehiculo  = (func.id === null);
                            var alertClass = noTieneVehiculo ? 'list-group-item-danger' : (isAssignedToThis ? 'list-group-item-warning' : 'list-group-item-info');
                            var btnDisabled = (isAssignedToThis || noTieneVehiculo) ? 'disabled' : '';
                            var btnText = noTieneVehiculo
                                ? '<i class="fa fa-ban"></i> Sin vehículo registrado'
                                : (isAssignedToThis ? 'Ya en este puesto' : '<i class="fa fa-plus"></i> Agregar');
                            
                            var warningText = '';
                            if (func.aviso) {
                                warningText = `<span class="text-danger" style="font-size: 0.85em; display:block; margin-top: 5px;"><i class="fa fa-exclamation-triangle"></i> ${func.aviso}</span>`;
                            } else if (func.parqueadero_id && !isAssignedToThis) {
                                warningText = `<span class="text-danger" style="font-size: 0.85em; display:block; margin-top: 5px;"><i class="fa fa-exclamation-triangle"></i> Actualmente asignado al puesto: <strong>${func.no_parqueadero}</strong> (Al agregar se reasignará)</span>`;
                            }
                            
                            var item = `
                                <div class="list-group-item ${alertClass}" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; border-radius: 8px;">
                                    <div>
                                        <strong><i class="fa fa-user"></i> Funcionario:</strong> ${func.nombre} <br>
                                        <strong><i class="fa fa-id-card"></i> Cédula:</strong> ${func.cedula} | 
                                        <strong><i class="fa fa-car"></i> Placa:</strong> <span class="label label-primary">${func.placa}</span> |
                                        <strong>Tipo:</strong> ${func.tipo_vehiculo}
                                        ${warningText}
                                    </div>
                                    <button type="button" class="btn btn-success btn-agregar-especifico" data-id="${func.id}" ${btnDisabled}>${btnText}</button>
                                </div>
                            `;
                            $('#lista_resultados').append(item);
                        });
                        
                        $('#resultado_busqueda').slideDown();
                        toastr.success('Se encontraron ' + response.data.length + ' registro(s)');
                    } else {
                        $('#lista_resultados').empty();
                        $('#resultado_busqueda').slideUp();
                        toastr.warning('No se encontró ningún funcionario con esa cédula o placa.');
                    }
                },
                error: function() {
                    $btn.html(originalText);
                    $btn.prop('disabled', false);
                    toastr.error('Error de conexión al buscar.');
                }
            });
        } else {
            toastr.warning('Ingrese al menos 3 caracteres para buscar.');
        }
    }

    // Agregar a la lista desde un botón específico
    $(document).on('click', '.btn-agregar-especifico', function() {
        var id = $(this).data('id');
        var funcActual = window.resultadosActuales[id];
        
        if (!funcActual) return;

        // Validar si ya está asignado a este mismo parqueadero en la BD
        if (funcActual.parqueadero_id == {{ $puesto->id }}) {
            toastr.warning('Este funcionario o placa ya se encuentra asignado a este parqueadero.');
            return;
        }

        // Validar si ya está agregado en la tabla temporal
        if (arrayIds.includes(funcActual.id)) {
            toastr.info('El vehículo ya está en la lista de asignación.');
            return;
        }

        arrayIds.push(funcActual.id);
        
        // Quitar fila vacía si existe
        $('#fila_vacia').hide();

        var fila = `<tr id="fila_${funcActual.id}">
            <td>${funcActual.cedula}</td>
            <td>${funcActual.nombre}</td>
            <td><span class="label label-primary">${funcActual.placa}</span></td>
            <td>${funcActual.tipo_vehiculo}</td>
            <td class="text-center">
                <input type="hidden" name="funcionarios[]" value="${funcActual.id}">
                <button type="button" class="btn btn-danger btn-xs btn-quitar" data-id="${funcActual.id}" title="Quitar">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>`;

        $('#tabla_asignar tbody').append(fila);
        
        // Cambiar el botón para indicar que ya fue agregado
        $(this).prop('disabled', true).removeClass('btn-success').addClass('btn-default').html('<i class="fa fa-check"></i> Agregado');
        funcActual = null;

        actualizarBotonConfirmar();
        toastr.success('Agregado a la lista de asignación.');
    });

    // Quitar de la lista
    $(document).on('click', '.btn-quitar', function() {
        var id = $(this).data('id');
        $('#fila_' + id).remove();
        
        // Eliminar del array
        arrayIds = arrayIds.filter(function(item) {
            return item !== id;
        });

        if (arrayIds.length === 0) {
            $('#fila_vacia').show();
        }
        
        actualizarBotonConfirmar();
    });

    function actualizarBotonConfirmar() {
        if (arrayIds.length > 0) {
            $('#btn_confirmar').prop('disabled', false);
        } else {
            $('#btn_confirmar').prop('disabled', true);
        }
    }

    // Evitar que el formulario se envíe con Enter si están en el campo de búsqueda
    $('#form_asignacion').on('submit', function(e) {
        if (arrayIds.length === 0) {
            e.preventDefault();
            toastr.error('Debe agregar al menos un funcionario a la lista para asignar.');
        }
    });
});
</script>
@endpush
