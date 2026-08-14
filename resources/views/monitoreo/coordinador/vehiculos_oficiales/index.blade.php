@extends('layouts.monitoreo.coordinador')

@section('title', 'Vehículos Oficiales')
@section('cabecera', 'Vehículos Oficiales - Listado y Asignación')

@section('content')

@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible" style="border-radius: 8px; margin-bottom: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Éxito!</h4>
        {{ session()->get('message') }}
    </div>
@endif

<div class="box" style="border-radius: 12px; border-top: 4px solid #1e40af; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-bottom: 20px;">
    <div class="box-header with-border" style="padding: 16px; background: linear-gradient(135deg, #1e293b 0%, #1e40af 100%); border-radius: 11px 11px 0 0;">
        <h3 class="box-title" style="font-weight: 700; color: white; font-size: 16px;">
            <i class="fa fa-car" style="margin-right: 8px;"></i>
            Vehículos Oficiales — Asignación de Conductores
        </h3>
        <div class="box-tools pull-right">
            <span class="badge" style="background:#10b981; font-size: 13px; padding: 6px 12px;">
                {{ $vehiculos->count() }} vehículos registrados
            </span>
        </div>
    </div>
    
    <div class="box-body" style="padding: 20px;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="tablaVehiculos" style="width: 100%;">
                <thead style="background-color: #f1f5f9; color: #475569; font-size: 13px;">
                    <tr>
                        <th>Puesto</th>
                        <th>Placa</th>
                        <th>Descripción / Tipo</th>
                        <th>Conductor Asignado</th>
                        <th>Último Ingreso</th>
                        <th>Última Salida</th>
                        <th style="text-align: center; width: 200px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehiculos as $v)
                    <tr>
                        <td style="vertical-align: middle;">
                            <span class="label label-primary" style="font-size: 12px; padding: 4px 8px;">{{ $v->no_parqueadero ?? 'N/A' }}</span>
                        </td>
                        <td style="vertical-align: middle;">
                            <span style="font-size: 18px; font-weight: 900; color: #1e293b; font-family: monospace; letter-spacing: 2px; display: block;">{{ $v->placa }}</span>
                        </td>
                        <td style="vertical-align: middle;">
                            <span style="font-weight: 600;">{{ $v->descripcion_vehiculo ?? 'Sin descripción' }}</span>
                            <br>
                            <small style="color: #6b7280; font-style: italic;">{{ $v->tipo_vehiculo ?? '' }}</small>
                        </td>
                        <td style="vertical-align: middle;">
                            @if($v->cedula && $v->nombre)
                                <div style="display: flex; flex-direction: column; margin-bottom: 5px;">
                                    <span style="font-weight: 700; color: #2563eb; font-size: 14px;">{{ $v->nombre }}</span>
                                    <small style="color: #64748b; font-size: 12px;"><i class="fa fa-id-card-o"></i> CC: {{ $v->cedula }}</small>
                                </div>
                                @if($v->asignacion_tipo == 'fechas')
                                    <span class="label label-info" style="font-size: 11px; padding: 3px 6px;">
                                        <i class="fa fa-calendar"></i> Por Fechas: {{ $v->asignacion_inicio }} a {{ $v->asignacion_fin }}
                                    </span>
                                @elseif($v->asignacion_tipo == 'definitiva')
                                    <span class="label label-primary" style="font-size: 11px; padding: 3px 6px;">
                                        <i class="fa fa-lock"></i> Definitiva
                                    </span>
                                @endif
                                
                                @if(!$v->visible_para_otros)
                                    <span class="label label-danger" style="font-size: 11px; padding: 3px 6px; margin-top: 3px; display: inline-block;">
                                        <i class="fa fa-eye-slash"></i> Privado
                                    </span>
                                @endif
                            @else
                                <span class="label label-warning" style="font-size: 12px; padding: 4px 8px;">
                                    <i class="fa fa-exclamation-triangle"></i> Sin Asignar
                                </span>
                            @endif
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            @if($v->ingreso_hoy)
                                <span class="label label-success" style="font-size: 12px; padding: 4px 8px; display: inline-block;">
                                    <i class="fa fa-arrow-circle-down"></i> {{ $v->ingreso_hoy }}
                                </span>
                            @else
                                <span style="color: #cbd5e1; font-style: italic;">Sin registros</span>
                            @endif
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            @if($v->salida_hoy)
                                <span class="label label-danger" style="font-size: 12px; padding: 4px 8px; display: inline-block;">
                                    <i class="fa fa-arrow-circle-up"></i> {{ $v->salida_hoy }}
                                </span>
                            @else
                                @if($v->ingreso_hoy)
                                    <span class="label label-info" style="font-size: 12px; padding: 4px 8px;">
                                        <i class="fa fa-map-marker"></i> Dentro
                                    </span>
                                @else
                                    <span style="color: #cbd5e1; font-style: italic;">-</span>
                                @endif
                            @endif
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            <button 
                                class="btn btn-sm btn-primary btn-asignar" 
                                data-id="{{ $v->id }}" 
                                data-placa="{{ $v->placa }}" 
                                data-cedula="{{ $v->cedula ?? '' }}" 
                                data-nombre="{{ $v->nombre ?? '' }}" 
                                data-asignacion_tipo="{{ $v->asignacion_tipo ?? 'definitiva' }}"
                                data-asignacion_inicio="{{ $v->asignacion_inicio ?? '' }}"
                                data-asignacion_fin="{{ $v->asignacion_fin ?? '' }}"
                                data-visible_para_otros="{{ $v->visible_para_otros ? '1' : '0' }}"
                                title="Asignar Conductor"
                                style="margin-right: 4px; margin-bottom: 4px;">
                                <i class="fa fa-user-plus"></i> Asignar
                            </button>
                            @if($v->cedula && $v->nombre)
                                <form action="{{ route('cooringreso.vehiculos_oficiales.unassign') }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de quitar el conductor a este vehículo?');">
                                    @csrf
                                    <input type="hidden" name="vehiculo_id" value="{{ $v->id }}">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Quitar Conductor" style="margin-right: 4px; margin-bottom: 4px;">
                                        <i class="fa fa-user-times"></i> Quitar
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('cooringreso.vehiculos_oficiales.toggle_visibilidad') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="vehiculo_id" value="{{ $v->id }}">
                                <button type="submit" class="btn btn-sm {{ $v->oculto_para_conductores ? 'btn-success' : 'btn-warning' }}" 
                                        title="{{ $v->oculto_para_conductores ? 'Mostrar a conductores' : 'Ocultar a conductores' }}" 
                                        style="margin-right: 4px; margin-bottom: 4px;">
                                    <i class="fa {{ $v->oculto_para_conductores ? 'fa-eye' : 'fa-eye-slash' }}"></i> {{ $v->oculto_para_conductores ? 'Mostrar' : 'Ocultar' }}
                                </button>
                            </form>
                            <a href="{{ route('coordinador.historial', $v->placa) }}" 
                               class="btn btn-sm btn-info" 
                               title="Ver Historial de Inspecciones"
                               style="margin-bottom: 4px;">
                                <i class="fa fa-history"></i> Historial
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center" style="padding: 40px; color: #94a3b8;">
                            <i class="fa fa-car" style="font-size: 48px; display: block; margin-bottom: 10px; opacity: 0.4;"></i>
                            No se encontraron vehículos oficiales registrados en el sistema.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal para Asignar Conductor --}}
<div class="modal fade" id="modalAsignarConductor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, #1e293b 0%, #1e40af 100%); color: white; border-top-left-radius: 12px; border-top-right-radius: 12px; padding: 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1; font-size: 20px;"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Asignar Conductor a Vehículo</h4>
            </div>
            <form action="{{ route('cooringreso.vehiculos_oficiales.assign') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding: 24px;">
                    <input type="hidden" name="vehiculo_id" id="modal_vehiculo_id">
                    <input type="hidden" name="conductor_cedula" id="modal_conductor_cedula">
                    <input type="hidden" name="conductor_nombre" id="modal_conductor_nombre">

                    {{-- Placa del vehículo --}}
                    <div style="margin-bottom: 20px; text-align: center; background: #f1f5f9; border-radius: 10px; padding: 16px;">
                        <h2 style="margin: 0; font-family: monospace; font-weight: 900; color: #1e293b; letter-spacing: 4px;" id="modal_placa_display"></h2>
                        <p style="color: #64748b; margin-top: 4px; margin-bottom: 0; font-size: 12px;">Vehículo Oficial — Asignación de Conductor</p>
                    </div>

                    {{-- Conductor actual --}}
                    <div id="conductor_actual_wrap" style="margin-bottom: 16px; display: none;">
                        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 10px 14px;">
                            <small style="color:#64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Conductor actualmente asignado</small>
                            <div style="font-weight: 700; color: #1e40af; font-size: 14px;" id="conductor_actual_nombre"></div>
                            <div style="color: #64748b; font-size: 12px;" id="conductor_actual_cedula"></div>
                        </div>
                    </div>

                    {{-- Select con Select2 (Conductores habituales) --}}
                    <div class="form-group">
                        <label style="font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">
                            <i class="fa fa-users" style="color: #3b82f6;"></i>
                            Conductores Habituales
                        </label>
                        <select id="select_conductor" class="form-control" style="width: 100%; border-radius: 8px; height: 40px;">
                            <option value="">-- Seleccionar de la lista... --</option>
                            @foreach($conductores as $c)
                                <option 
                                    value="{{ $c->cedula }}" 
                                    data-nombre="{{ strtoupper($c->name . ' ' . $c->lastname) }}">
                                    {{ $c->cedula }} — {{ strtoupper($c->name . ' ' . $c->lastname) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="text-align: center; margin: 16px 0;">
                        <span style="background: #e2e8f0; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; color: #64748b;">O BUSCAR OTRO</span>
                    </div>

                    {{-- Búsqueda manual por cédula --}}
                    <div class="form-group">
                        <label style="font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">
                            <i class="fa fa-search" style="color: #3b82f6;"></i> Buscar otra persona por Cédula
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscar_cedula" placeholder="Ej: 1113456789..." style="border-radius: 8px 0 0 8px; height: 40px;">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" id="btn_buscar_conductor" style="border-radius: 0 8px 8px 0; height: 40px; font-weight: 600;">
                                    Buscar
                                </button>
                            </span>
                        </div>
                        <small id="error_busqueda" style="color: #ef4444; display: none; margin-top: 5px;"></small>
                    </div>

                    {{-- Preview del seleccionado --}}
                    <div id="preview_conductor" style="display: none; margin-top: 12px; background: #f0fdf4; border: 1px solid #86efac; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px;">
                        <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Conductor seleccionado</div>
                        <div style="font-weight: 800; font-size: 15px; color: #166534;" id="preview_nombre"></div>
                        <div style="color: #64748b; font-size: 12px;" id="preview_cedula_txt"></div>
                    </div>

                    {{-- Opciones de Asignación --}}
                    <div class="form-group" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
                        <label style="font-weight: 600; color: #374151; margin-bottom: 12px; display: block;">
                            <i class="fa fa-cogs" style="color: #3b82f6;"></i> Opciones de Asignación
                        </label>
                        
                        <div style="margin-bottom: 15px;">
                            <label style="margin-right: 15px; font-weight: normal; cursor: pointer;">
                                <input type="radio" name="asignacion_tipo" value="definitiva" checked onchange="toggleFechasAsignacion(this.value)"> 
                                Asignación Definitiva
                            </label>
                            <label style="font-weight: normal; cursor: pointer;">
                                <input type="radio" name="asignacion_tipo" value="fechas" onchange="toggleFechasAsignacion(this.value)"> 
                                Por Fechas
                            </label>
                        </div>

                        <div id="rango_fechas_container" style="display: none; background: #fff; padding: 12px; border-radius: 6px; border: 1px dashed #cbd5e1; margin-bottom: 15px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label style="font-size: 12px; color: #64748b;">Fecha Inicio</label>
                                    <input type="date" name="asignacion_inicio" id="asignacion_inicio" class="form-control" style="height: 34px;">
                                </div>
                                <div class="col-md-6">
                                    <label style="font-size: 12px; color: #64748b;">Fecha Fin</label>
                                    <input type="date" name="asignacion_fin" id="asignacion_fin" class="form-control" style="height: 34px;">
                                </div>
                            </div>
                        </div>

                        <div style="border-top: 1px solid #e2e8f0; padding-top: 12px; margin-top: 15px;">
                            <label style="font-weight: normal; cursor: pointer; display: flex; align-items: flex-start; gap: 8px; margin-bottom: 12px;">
                                <input type="checkbox" name="visible_para_otros" id="visible_para_otros" value="1" checked style="margin-top: 2px;">
                                <div>
                                    <strong style="color: #334155;">Permitir que otros conductores vean este vehículo</strong>
                                    <p style="margin: 0; font-size: 11px; color: #64748b;">Si se desmarca, solo el conductor asignado podrá inspeccionarlo.</p>
                                </div>
                            </label>
                            
                            <label style="font-weight: normal; cursor: pointer; display: flex; align-items: flex-start; gap: 8px;">
                                <input type="checkbox" name="exclusivo_para_conductor" id="exclusivo_para_conductor" value="1" style="margin-top: 2px;">
                                <div>
                                    <strong style="color: #ea580c;">Restringir al conductor a ver SÓLO sus vehículos asignados</strong>
                                    <p style="margin: 0; font-size: 11px; color: #64748b;">Si se marca, el conductor no podrá ver los vehículos "Libres" ni los de otros. Solo verá los vehículos que tenga explícitamente asignados a su nombre.</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btn_guardar_asignacion" disabled>
                        <i class="fa fa-save"></i> Guardar Asignación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    /* Select2 dentro de modal */
    .select2-container { width: 100% !important; }
    .select2-container .select2-selection--single {
        height: 40px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        display: flex;
        align-items: center;
        padding: 0 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
        color: #374151;
        font-size: 14px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }
    .select2-dropdown {
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        border-color: #d1d5db;
    }
    .select2-results__option--highlighted {
        background-color: #1e40af !important;
    }
    .select2-search__field {
        border-radius: 6px !important;
        border: 1px solid #d1d5db !important;
        padding: 6px 10px !important;
    }
</style>
<script>
function toggleFechasAsignacion(tipo) {
    if (tipo === 'fechas') {
        $('#rango_fechas_container').slideDown(200);
        $('#asignacion_inicio').prop('required', true);
        $('#asignacion_fin').prop('required', true);
    } else {
        $('#rango_fechas_container').slideUp(200);
        $('#asignacion_inicio').prop('required', false);
        $('#asignacion_fin').prop('required', false);
    }
}

$(document).ready(function() {
    // Inicializar DataTable
    $('#tablaVehiculos').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json" },
        pageLength: 25,
        order: [[1, 'asc']]
    });

    // Abrir modal de asignación
    $(document).on('click', '.btn-asignar', function() {
        var id     = $(this).data('id');
        var placa  = $(this).data('placa');
        var cedula = String($(this).data('cedula') || '').trim();
        var nombre = String($(this).data('nombre') || '').trim();
        var asign_tipo = $(this).data('asignacion_tipo') || 'definitiva';
        var asign_inicio = $(this).data('asignacion_inicio') || '';
        var asign_fin = $(this).data('asignacion_fin') || '';
        var vis_otros = $(this).data('visible_para_otros') !== 0;

        // Resetear modal
        $('#modal_vehiculo_id').val(id);
        $('#modal_placa_display').text(placa);
        $('#modal_conductor_cedula').val('');
        $('#modal_conductor_nombre').val('');
        $('#btn_guardar_asignacion').prop('disabled', true);
        $('#preview_conductor').hide();
        
        // Asignación de opciones
        $('input[name="asignacion_tipo"][value="' + asign_tipo + '"]').prop('checked', true);
        toggleFechasAsignacion(asign_tipo);
        $('#asignacion_inicio').val(asign_inicio);
        $('#asignacion_fin').val(asign_fin);
        $('#visible_para_otros').prop('checked', vis_otros);

        // Mostrar conductor actual si existe
        if (cedula !== '') {
            $('#conductor_actual_nombre').text(nombre || 'Sin nombre registrado');
            $('#conductor_actual_cedula').text('CC: ' + cedula);
            $('#conductor_actual_wrap').show();
        } else {
            $('#conductor_actual_wrap').hide();
        }
        // Resetear select
        $('#select_conductor').val('');
        
        $('#modalAsignarConductor').modal('show');
    });
    
    // Cuando se selecciona del dropdown
    $('#select_conductor').on('change', function() {
        var cedula = $(this).val();
        if (cedula) {
            var nombre = $(this).find(':selected').data('nombre');
            $('#modal_conductor_cedula').val(cedula);
            $('#modal_conductor_nombre').val(nombre);
            $('#preview_nombre').text(nombre);
            $('#preview_cedula_txt').text('Cédula: ' + cedula);
            $('#preview_conductor').show();
            $('#btn_guardar_asignacion').prop('disabled', false);
            
            // Limpiar búsqueda manual
            $('#buscar_cedula').val('');
            $('#error_busqueda').hide();
        } else {
            // Solo limpiar si no hemos llenado los datos por búsqueda
            if($('#buscar_cedula').val().trim() === '') {
                $('#modal_conductor_cedula').val('');
                $('#modal_conductor_nombre').val('');
                $('#preview_conductor').hide();
                $('#btn_guardar_asignacion').prop('disabled', true);
            }
        }
    });
    
    // Búsqueda manual por cédula
    $('#btn_buscar_conductor').click(function() {
        var cedula = $('#buscar_cedula').val().trim();
        if(cedula === '') {
            alert('Ingrese una cédula para buscar');
            return;
        }
        
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $('#error_busqueda').hide();
        
        $.get("{{ route('cooringreso.vehiculos_oficiales.buscar', ':cedula') }}".replace(':cedula', cedula), function(res) {
            if(res.success) {
                $('#modal_conductor_cedula').val(res.conductor.cedula);
                $('#modal_conductor_nombre').val(res.nombre_completo);
                
                $('#preview_nombre').text(res.nombre_completo);
                $('#preview_cedula_txt').text('Cédula: ' + res.conductor.cedula);
                $('#preview_conductor').show();
                
                $('#btn_guardar_asignacion').prop('disabled', false);
                $('#error_busqueda').hide();
                
                // Limpiar el select2
                $('#select_conductor').val('').trigger('change.select2');
            } else {
                $('#error_busqueda').text(res.message || 'Persona no encontrada en el sistema.').show();
                $('#modal_conductor_cedula').val('');
                $('#modal_conductor_nombre').val('');
                $('#preview_conductor').hide();
                $('#btn_guardar_asignacion').prop('disabled', true);
            }
        }).fail(function(xhr) {
            var msg = 'Error de conexión';
            if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
            $('#error_busqueda').text(msg).show();
        }).always(function() {
            btn.prop('disabled', false).html('Buscar');
        });
    });
    
    // Buscar con Enter en el input de cédula
    $('#buscar_cedula').keypress(function(e) {
        if(e.which === 13) {
            e.preventDefault();
            $('#btn_buscar_conductor').click();
        }
    });
});
</script>
@endpush
