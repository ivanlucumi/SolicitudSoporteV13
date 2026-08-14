@extends('layouts.monitoreo.monitoreo')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container">
    <h2>Registros de Ingreso de Polic&iacute;a</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div id="ajax-message" class="alert" style="display: none;"></div>

    <form method="GET" action="{{ route('police-entries.index') }}" class="form-inline" style="margin-bottom: 20px;">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o fecha (YYYY-MM-DD)" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <button type="button" id="btn-toggle-create" class="btn btn-success" style="margin-left: 10px;">
            <i class="glyphicon glyphicon-plus"></i> Nuevo Registro
        </button>
    </form>

    <div class="table-responsive panel panel-default modern-panel">
        <div class="panel-heading modern-heading">
            <i class="glyphicon glyphicon-th-list"></i> Tabla de Registros
        </div>
        <table class="table table-bordered table-hover modern-table">
            <thead>
                <tr>
                    <th class="text-center col-xs-2">Fecha Ingreso</th>
                    <th class="text-center col-xs-2">Cédula</th>
                    <th class="text-center col-xs-2">Nombre</th>
                    <th class="text-center col-xs-1">Hora Ingreso</th>
                    <th class="text-center col-xs-1">Hora Salida</th>
                    <th class="text-center col-xs-3">Observaciones</th>
                    <th class="text-center col-xs-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="entries-tbody">

                <!-- Fila para NUEVO REGISTRO (inline) - SIN hora de salida -->
                <tr id="create-row" class="edit-row d-none animated-row">
                    @csrf

                    <td>
                        <input type="date" class="form-control input-sm" id="create_fecha_ingreso" required>
                    </td>
                    <td>
                        <input type="number" class="form-control input-sm" id="create_cedula" placeholder="Cédula" required>
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" id="create_nombre" placeholder="Nombre" required>
                    </td>
                    <td>
                        <input type="time" class="form-control input-sm" id="create_hora_ingreso" required>
                    </td>
                    <td class="text-muted text-center">
                        <small>Se registra después</small>
                    </td>
                    <td>
                        <textarea class="form-control input-sm" id="create_observaciones" rows="1" placeholder="Opcional"></textarea>
                    </td>
                    <td class="text-center">
                        <button type="button" id="btn-save-create" class="btn btn-primary btn-sm">
                            <span class="spinner spinner-hidden" aria-hidden="true"></span>
                            Guardar
                        </button>
                        <button type="button" id="btn-cancel-create" class="btn btn-default btn-sm">Cancelar</button>
                    </td>
                </tr>

                @foreach ($entries as $entry)
                    <tr id="row-{{ $entry->id }}" data-id="{{ $entry->id }}" data-mode="view" class="animated-row">
                        <!--td class="cell-id text-center">{{ $entry->id }}</td>
                        <td class="cell-created text-center">{{ $entry->created_at->format('Y-m-d H:i') }}</td-->

                        <td class="cell-fecha_ingreso">
                            <span class="view-val">{{ $entry->fecha_ingreso }}</span>
                            <input type="date" class="form-control input-sm edit-input" value="{{ $entry->fecha_ingreso }}" style="display:none;">
                        </td>

                        <td class="cell-cedula">
                            <span class="view-val">{{ $entry->cedula }}</span>
                            <input type="text" class="form-control input-sm edit-input" value="{{ $entry->cedula }}" style="display:none;">
                        </td>

                        <td class="cell-nombre">
                            <span class="view-val">{{ $entry->nombre }}</span>
                            <input type="text" class="form-control input-sm edit-input" value="{{ $entry->nombre }}" style="display:none;">
                        </td>

                        <td class="cell-hora_ingreso">
                            <span class="view-val">{{ $entry->hora_ingreso }}</span>
                            <input type="time" class="form-control input-sm edit-input" value="{{ $entry->hora_ingreso }}" style="display:none;">
                        </td>

                        <td class="cell-hora_salida">
                            <span class="view-val">{{ $entry->hora_salida ?? '—' }}</span>
                            <input type="time" class="form-control input-sm edit-input" value="{{ $entry->hora_salida }}" style="display:none;">
                        </td>

                        <td class="cell-observaciones">
                            <span class="view-val">{{ $entry->observaciones ?? 'N/A' }}</span>
                            <textarea class="form-control input-sm edit-input" rows="1" style="display:none;">{{ $entry->observaciones }}</textarea>
                        </td>

                        <td class="cell-actions text-center">
                            <div class="actions-view">
                                @if(empty($entry->hora_salida))
                                    <button type="button" class="btn btn-info btn-xs btn-register-exit" title="Registrar Salida">
                                        <i class="glyphicon glyphicon-log-out"></i> Registrar Salida
                                    </button>
                                @endif
                                <button type="button" class="btn btn-warning btn-xs btn-edit">
                                    <i class="glyphicon glyphicon-pencil"></i> Editar
                                </button>
                            </div>
                            <div class="actions-edit" style="display:none;">
                                <button type="button" class="btn btn-success btn-xs btn-save">
                                    <span class="spinner spinner-hidden" aria-hidden="true"></span>
                                    Guardar
                                </button>
                                <button type="button" class="btn btn-default btn-xs btn-cancel">Cancelar</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $entries->links('pagination::bootstrap-4') }}
</div>

<!-- Modal para registrar hora de salida -->
<!-- Modal para registrar hora de salida -->
<div class="modal fade" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exitModalLabel">
                    <i class="glyphicon glyphicon-log-out"></i> Registrar Hora de Salida
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="modal_nombre">Nombre:</label>
                    <input type="text" class="form-control" id="modal_nombre" readonly>
                </div>
                <div class="form-group">
                    <label for="modal_cedula">Cédula:</label>
                    <input type="text" class="form-control" id="modal_cedula" readonly>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="modal_fecha_ingreso">Fecha de Ingreso:</label>
                            <input type="text" class="form-control" id="modal_fecha_ingreso" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="modal_hora_ingreso">Hora de Ingreso:</label>
                            <input type="text" class="form-control" id="modal_hora_ingreso" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="modal_fecha_salida">Fecha de Salida: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="modal_fecha_salida" required>
                            <small class="text-muted">Puede ser igual o posterior a la fecha de ingreso</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="modal_hora_salida">Hora de Salida: <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="modal_hora_salida" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modal_observaciones">Observaciones:</label>
                    <textarea class="form-control" id="modal_observaciones" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-exit">
                    <span class="spinner spinner-hidden" aria-hidden="true"></span>
                    Guardar Salida
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CSS Bootstrap 3 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery y Bootstrap 3 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/vendor/jquery-3.6.0.min.js"><\/script>')</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

<style>
/* Estilos modernos compatibles con Bootstrap 3 */
.modern-panel {
    border: 1px solid #e3e6eb;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(20,20,20,0.06);
}
.modern-heading {
    padding: 10px 15px;
    background: linear-gradient(90deg, #f7f8fa, #ffffff);
    border-bottom: 1px solid #eceff3;
    font-weight: 600;
    color: #2a2f45;
}
.modern-table > thead > tr > th {
    background: #f5f7fb;
    color: #2a2f45;
    border-color: #e6e9ef !important;
    font-weight: 600;
}
.modern-table > tbody > tr {
    transition: background-color 180ms ease, box-shadow 180ms ease;
}
.modern-table > tbody > tr:hover {
    background-color: #f9fbff;
    box-shadow: inset 0 0 0 1px #eef2ff;
}
.edit-row, tr[data-mode="edit"] {
    background: #fffef6 !important;
    box-shadow: inset 3px 0 0 #ffbf47;
}
.view-val {
    display: inline-block;
    padding: 4px 6px;
    border-radius: 4px;
    transition: background-color 160ms ease, color 160ms ease;
}
.edit-input {
    animation: fadeIn 200ms ease;
}
.animated-row {
    animation: fadeSlideIn 260ms ease;
}
.spinner {
    display: inline-block;
    width: 12px; height: 12px;
    border: 2px solid #fff;
    border-top-color: rgba(255,255,255,0.3);
    border-radius: 50%;
    margin-right: 6px;
    vertical-align: -2px;
    animation: spin 0.8s linear infinite;
}
.spinner.spinner-hidden {
    visibility: hidden;
}
.btn-success .spinner, .btn-primary .spinner { 
    border-color: #fff; 
    border-top-color: rgba(255,255,255,0.3); 
}

#ajax-message {
    position: sticky;
    top: 10px;
    z-index: 100;
}

.btn-register-exit {
    margin-right: 5px;
}

/* Animaciones */
@keyframes spin {
    to { transform: rotate(360deg); }
}
@keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
    from { opacity: 0; } to { opacity: 1; }
}
</style>

<script>
(function initPage($){
    if (!$) { console.error('jQuery no cargó'); return; }
    window.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content') || '';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': window.CSRF_TOKEN,
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
})(window.jQuery);
</script>

<script>
    // Base URLs
    const STORE_URL = @json(route('police-entries.store'));
    const UPDATE_BASE = @json(url('monitoreo/police-entries'));

    // Variable global para el ID del registro actual en el modal
    let currentExitEntryId = null;

    // CSRF para AJAX
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    // ==================== Helpers UI ====================
    function showAjaxMessage(type, message) {
        var alertDiv = $('#ajax-message');
        alertDiv.removeClass().addClass('alert alert-' + type).text(message).stop(true, true).fadeIn(150);
        setTimeout(function() { alertDiv.fadeOut(300); }, 4200);
    }

    function setRowMode($tr, mode) {
        $tr.attr('data-mode', mode);
        if (mode === 'edit') {
            $tr.find('.view-val').hide();
            $tr.find('.edit-input').show();
            $tr.find('.actions-view').hide();
            $tr.find('.actions-edit').show();
        } else {
            $tr.find('.edit-input').hide();
            $tr.find('.view-val').show();
            $tr.find('.actions-edit').hide();
            $tr.find('.actions-view').show();
        }
    }

    function esc(s) {
        if (s === null || s === undefined) return '';
        return String(s).replace(/[&<>"'`=\/]/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;',"':'&quot;',"":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'}[c];
        });
    }

    function setButtonLoading($btn, loading) {
        var $spinner = $btn.find('.spinner');
        if (!$spinner.length) return;
        if (loading) {
            $spinner.removeClass('spinner-hidden');
            $btn.prop('disabled', true);
        } else {
            $spinner.addClass('spinner-hidden');
            $btn.prop('disabled', false);
        }
    }

    function handleAjaxError(xhr, action) {
        let msg = 'Error al ' + action + '. ';
        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
            msg += Object.values(xhr.responseJSON.errors).flat().join(', ');
        } else if (xhr.responseJSON && xhr.responseJSON.message) {
            msg += xhr.responseJSON.message;
        } else {
            msg += 'Código ' + xhr.status;
        }
        showAjaxMessage('danger', msg);
    }

    // Validación de horas
    function validateTimes(hIn, hOut) {
        if (hOut && hIn && hOut < hIn) {
            return 'La hora de salida no puede ser menor que la hora de ingreso.';
        }
        return null;
    }

    // ==================== Toggle fila de creación ====================
    $('#btn-toggle-create').on('click', function() {
        var $row = $('#create-row');
        if ($row.hasClass('d-none')) {
            $row.removeClass('d-none').hide().slideDown(180);
            $('#create_fecha_ingreso').focus();
        } else {
            $('#btn-cancel-create').click();
        }
    });

    $('#btn-cancel-create').on('click', function() {
        clearCreateRow();
        $('#create-row').slideUp(150, function() { $(this).addClass('d-none'); });
    });

    function clearCreateRow() {
        $('#create_fecha_ingreso, #create_cedula, #create_nombre, #create_hora_ingreso').val('');
        $('#create_observaciones').val('');
    }

    // ==================== Guardar nuevo registro (SIN hora de salida) ====================
    $('#btn-save-create').on('click', function() {
        var $btn = $(this);
        var payload = {
            fecha_ingreso:  $('#create_fecha_ingreso').val(),
            cedula:         $('#create_cedula').val(),
            nombre:         $('#create_nombre').val(),
            hora_ingreso:   $('#create_hora_ingreso').val(),
            observaciones:  $('#create_observaciones').val(),
            _token:         window.CSRF_TOKEN
        };

        if (!payload.fecha_ingreso || !payload.cedula || !payload.nombre || !payload.hora_ingreso) {
            showAjaxMessage('danger', 'Complete los campos obligatorios (Fecha, Cédula, Nombre, Hora Ingreso).');
            return;
        }

        setButtonLoading($btn, true);
        $.ajax({
            type: 'POST',
            url: STORE_URL,
            data: payload,
            success: function(response) {
                if (response && response.success && response.entry) {
                    const html = buildRowHtml(response.entry);
                    $('#create-row').after(html);
                    $('#btn-cancel-create').click();
                    showAjaxMessage('success', response.message || 'Registro creado correctamente.');
                } else {
                    location.reload();
                }
            },
            error: function(xhr) { handleAjaxError(xhr, 'crear'); },
            complete: function() { setButtonLoading($btn, false); }
        });
    });

    // Permitir Enter para guardar en inputs de creación
    $('#create-row').on('keydown', 'input, textarea', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            $('#btn-save-create').click();
        } else if (e.key === 'Escape') {
            e.preventDefault();
            $('#btn-cancel-create').click();
        }
    });

   // ==================== Registrar Salida (Modal) ====================
    $(document).on('click', '.btn-register-exit', function() {
        var $tr = $(this).closest('tr');
        currentExitEntryId = $tr.data('id');
        
        var nombre = $tr.find('.cell-nombre .view-val').text().trim();
        var cedula = $tr.find('.cell-cedula .view-val').text().trim();
        var fechaIngreso = $tr.find('.cell-fecha_ingreso .view-val').text().trim();
        var horaIngreso = $tr.find('.cell-hora_ingreso .view-val').text().trim();
        var observaciones = $tr.find('.cell-observaciones .view-val').text().trim();
        
        $('#modal_nombre').val(nombre);
        $('#modal_cedula').val(cedula);
        $('#modal_fecha_ingreso').val(fechaIngreso);
        $('#modal_hora_ingreso').val(horaIngreso);
        
        // Establecer fecha de salida por defecto como la fecha de ingreso
        $('#modal_fecha_salida').val(fechaIngreso);
        $('#modal_fecha_salida').attr('min', fechaIngreso); // No permitir fechas anteriores
        
        $('#modal_hora_salida').val('');
        $('#modal_observaciones').val(observaciones === 'N/A' ? '' : observaciones);
        
        $('#exitModal').modal('show');
        
        // Focus en fecha de salida después de que se muestre el modal
        $('#exitModal').on('shown.bs.modal', function () {
            $('#modal_fecha_salida').focus();
        });
    });
    
    // Guardar hora de salida desde el modal
    $('#btn-save-exit').on('click', function() {
        var $btn = $(this);
        var fechaSalida = $('#modal_fecha_salida').val();
        var horaSalida = $('#modal_hora_salida').val();
        var fechaIngreso = $('#modal_fecha_ingreso').val();
        var horaIngreso = $('#modal_hora_ingreso').val();
        var observaciones = $('#modal_observaciones').val();
    
        if (!fechaSalida || !horaSalida) {
            showAjaxMessage('danger', 'Debe ingresar la fecha y hora de salida.');
            return;
        }
    
        // Validación en el cliente
        var fechaHoraIngreso = new Date(fechaIngreso + ' ' + horaIngreso);
        var fechaHoraSalida = new Date(fechaSalida + ' ' + horaSalida);
        
        if (fechaHoraSalida < fechaHoraIngreso) {
            showAjaxMessage('danger', 'La fecha y hora de salida no puede ser anterior a la de ingreso.');
            return;
        }
    
        var payload = {
            _method: 'PUT',
            _token: window.CSRF_TOKEN,
            fecha_salida: fechaSalida,
            hora_salida: horaSalida,
            observaciones: observaciones
        };
    
        setButtonLoading($btn, true);
        $.ajax({
            type: 'POST',
            url: UPDATE_BASE + '/' + currentExitEntryId + '/update-salida',
            data: payload,
            success: function(resp) {
                if (resp && resp.success && resp.entry) {
                    updateRowFromEntry($('#row-' + currentExitEntryId), resp.entry);
                    $('#exitModal').modal('hide');
                    showAjaxMessage('success', resp.message || 'Hora de salida registrada correctamente.');
                } else {
                    location.reload();
                }
            },
            error: function(xhr) { handleAjaxError(xhr, 'registrar salida'); },
            complete: function() { setButtonLoading($btn, false); }
        });
    });
    
    // Elimina o actualiza la función validateTimes ya que ahora validamos fecha completa
    function validateTimes(fechaIngreso, horaIngreso, fechaSalida, horaSalida) {
        if (!fechaSalida || !horaSalida) return null;
        
        var fechaHoraIngreso = new Date(fechaIngreso + ' ' + horaIngreso);
        var fechaHoraSalida = new Date(fechaSalida + ' ' + horaSalida);
        
        if (fechaHoraSalida < fechaHoraIngreso) {
            return 'La fecha y hora de salida no puede ser anterior a la de ingreso.';
        }
        return null;
    }


    // ==================== Editar fila ====================
    $(document).on('click', '.btn-edit', function() {
        var $tr = $(this).closest('tr');
        
        // Guardar valores originales
        $tr.data('original', {
            fecha_ingreso: $tr.find('.cell-fecha_ingreso .view-val').text().trim(),
            cedula:        $tr.find('.cell-cedula .view-val').text().trim(),
            nombre:        $tr.find('.cell-nombre .view-val').text().trim(),
            hora_ingreso:  $tr.find('.cell-hora_ingreso .view-val').text().trim(),
            hora_salida:   $tr.find('.cell-hora_salida .view-val').text().trim() === '—' ? '' :
                           $tr.find('.cell-hora_salida .view-val').text().trim(),
            observaciones: ($tr.find('.cell-observaciones .view-val').text().trim() === 'N/A' ? '' :
                           $tr.find('.cell-observaciones .view-val').text().trim())
        });
        
        setRowMode($tr, 'edit');
        
        // Poner los inputs con el valor actual
        var o = $tr.data('original');
        $tr.find('.cell-fecha_ingreso .edit-input').val(o.fecha_ingreso);
        $tr.find('.cell-cedula .edit-input').val(o.cedula);
        $tr.find('.cell-nombre .edit-input').val(o.nombre);
        $tr.find('.cell-hora_ingreso .edit-input').val(o.hora_ingreso);
        $tr.find('.cell-hora_salida .edit-input').val(o.hora_salida);
        $tr.find('.cell-observaciones .edit-input').val(o.observaciones);
        
        $tr.find('.edit-input:visible:first').focus();
    });

    // ==================== Cancelar edición ====================
    $(document).on('click', '.btn-cancel', function() {
        var $tr = $(this).closest('tr');
        var o = $tr.data('original') || {};
        
        if (o && Object.keys(o).length) {
            $tr.find('.cell-fecha_ingreso .view-val').text(o.fecha_ingreso || '');
            $tr.find('.cell-cedula .view-val').text(o.cedula || '');
            $tr.find('.cell-nombre .view-val').text(o.nombre || '');
            $tr.find('.cell-hora_ingreso .view-val').text(o.hora_ingreso || '');
            $tr.find('.cell-hora_salida .view-val').text(o.hora_salida || '—');
            $tr.find('.cell-observaciones .view-val').text(o.observaciones || 'N/A');
        }
        setRowMode($tr, 'view');
    });

    // ==================== Guardar edición ====================
    $(document).on('click', '.btn-save', function() {
        var $btn = $(this);
        var $tr = $btn.closest('tr');
        var id = $tr.data('id');
        
        var payload = {
            _method:       'PUT',
            _token:        window.CSRF_TOKEN,
            fecha_ingreso: $tr.find('.cell-fecha_ingreso .edit-input').val(),
            cedula:        $tr.find('.cell-cedula .edit-input').val(),
            nombre:        $tr.find('.cell-nombre .edit-input').val(),
            hora_ingreso:  $tr.find('.cell-hora_ingreso .edit-input').val(),
            hora_salida:   $tr.find('.cell-hora_salida .edit-input').val(),
            observaciones: $tr.find('.cell-observaciones .edit-input').val()
        };

        if (!payload.fecha_ingreso || !payload.cedula || !payload.nombre || !payload.hora_ingreso) {
            showAjaxMessage('danger', 'Complete los campos obligatorios.');
            return;
        }
        
        var err = validateTimes(payload.hora_ingreso, payload.hora_salida);
        if (err) { showAjaxMessage('danger', err); return; }

        setButtonLoading($btn, true);
        $.ajax({
            type: 'POST',
            url:  UPDATE_BASE + '/' + id + '/update',
            data: payload,
            success: function(resp) {
                if (resp && resp.success && resp.entry) {
                    updateRowFromEntry($('#row-' + id), resp.entry);
                    setRowMode($tr, 'view');
                    showAjaxMessage('success', resp.message || 'Registro actualizado correctamente.');
                } else {
                    location.reload();
                }
            },
            error: function(xhr) { handleAjaxError(xhr, 'actualizar'); },
            complete: function() { setButtonLoading($btn, false); }
        });
    });

    // ==================== Teclas rápidas en edición ====================
    $(document).on('keydown', 'tr[data-mode="edit"] .edit-input', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            $(this).closest('tr').find('.btn-save').click();
        } else if (e.key === 'Escape') {
            e.preventDefault();
            $(this).closest('tr').find('.btn-cancel').click();
        }
    });

    // ==================== Construir HTML de nueva fila ====================
    function buildRowHtml(entry) {
        var id = esc(entry.id);
        var created = esc(entry.created_at || '');
        var fecha_ingreso = esc(entry.fecha_ingreso || '');
        var cedula = esc(entry.cedula || '');
        var nombre = esc(entry.nombre || '');
        var hora_ingreso = esc(entry.hora_ingreso || '');
        var hora_salida = esc(entry.hora_salida || '');
        var observaciones = esc(entry.observaciones || 'N/A');
        
        var exitButton = '';
        if (!entry.hora_salida) {
            exitButton = '<button type="button" class="btn btn-info btn-xs btn-register-exit" title="Registrar Salida">' +
                        '<i class="glyphicon glyphicon-log-out"></i> Registrar Salida' +
                        '</button> ';
        }

        return '' +
        '<tr id="row-' + id + " data-id=" + id + " data-mode="view" class="animated-row">' +
            '<td class="cell-id text-center">' + id + '</td>' +
            '<td class="cell-created text-center">' + created + '</td>' +
            '<td class="cell-fecha_ingreso">' +
                '<span class="view-val">' + fecha_ingreso + '</span>' +
                '<input type="date" class="form-control input-sm edit-input" value=" + fecha_ingreso + " style="display:none;">' +
            '</td>' +
            '<td class="cell-cedula">' +
                '<span class="view-val">' + cedula + '</span>' +
                '<input type="number" class="form-control input-sm edit-input" value=" + cedula + " style="display:none;">' +
            '</td>' +
            '<td class="cell-nombre">' +
                '<span class="view-val">' + nombre + '</span>' +
                '<input type="text" class="form-control input-sm edit-input" value=" + nombre + " style="display:none;">' +
            '</td>' +
            '<td class="cell-hora_ingreso">' +
                '<span class="view-val">' + hora_ingreso + '</span>' +
                '<input type="time" class="form-control input-sm edit-input" value=" + hora_ingreso + " style="display:none;">' +
            '</td>' +
            '<td class="cell-hora_salida">' +
                '<span class="view-val">' + (hora_salida || '—') + '</span>' +
                '<input type="time" class="form-control input-sm edit-input" value=" + hora_salida + " style="display:none;">' +
            '</td>' +
            '<td class="cell-observaciones">' +
                '<span class="view-val">' + (observaciones || 'N/A') + '</span>' +
                '<textarea class="form-control input-sm edit-input" rows="1" style="display:none;">' + (observaciones === 'N/A' ? '' : observaciones) + '</textarea>' +
            '</td>' +
            '<td class="cell-actions text-center">' +
                '<div class="actions-view">' +
                    exitButton +
                    '<button type="button" class="btn btn-warning btn-xs btn-edit">' +
                        '<i class="glyphicon glyphicon-pencil"></i> Editar' +
                    '</button>' +
                '</div>' +
                '<div class="actions-edit" style="display:none;">' +
                    '<button type="button" class="btn btn-success btn-xs btn-save">' +
                        '<span class="spinner spinner-hidden" aria-hidden="true"></span> Guardar' +
                    '</button> ' +
                    '<button type="button" class="btn btn-default btn-xs btn-cancel">Cancelar</button>' +
                '</div>' +
            '</td>' +
        '</tr>';
    }

    // ==================== Actualizar fila desde respuesta ====================
    function updateRowFromEntry($tr, entry) {
        $tr.find('.cell-created').text(entry.created_at || '');
        $tr.find('.cell-fecha_ingreso .view-val').text(entry.fecha_ingreso || '');
        $tr.find('.cell-cedula .view-val').text(entry.cedula || '');
        $tr.find('.cell-nombre .view-val').text(entry.nombre || '');
        $tr.find('.cell-hora_ingreso .view-val').text(entry.hora_ingreso || '');
        $tr.find('.cell-hora_salida .view-val').text(entry.hora_salida || '—');
        $tr.find('.cell-observaciones .view-val').text(entry.observaciones || 'N/A');

        // Sincronizar inputs
        $tr.find('.cell-fecha_ingreso .edit-input').val(entry.fecha_ingreso || '');
        $tr.find('.cell-cedula .edit-input').val(entry.cedula || '');
        $tr.find('.cell-nombre .edit-input').val(entry.nombre || '');
        $tr.find('.cell-hora_ingreso .edit-input').val(entry.hora_ingreso || '');
        $tr.find('.cell-hora_salida .edit-input').val(entry.hora_salida || '');
        $tr.find('.cell-observaciones .edit-input').val(entry.observaciones || '');
        
        // Actualizar botones de acción
        var $actionsView = $tr.find('.actions-view');
        $actionsView.empty();
        
        if (!entry.hora_salida) {
            $actionsView.append(
                '<button type="button" class="btn btn-info btn-xs btn-register-exit" title="Registrar Salida">' +
                '<i class="glyphicon glyphicon-log-out"></i> Registrar Salida' +
                '</button> '
            );
        }
        
        $actionsView.append(
            '<button type="button" class="btn btn-warning btn-xs btn-edit">' +
            '<i class="glyphicon glyphicon-pencil"></i> Editar' +
            '</button>'
        );
    }
</script>
@endsection