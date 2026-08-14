<style>
    .encuesta-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .encuesta-content {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        width: 90%;
        max-width: 1300px;
        max-height: 90vh;
        overflow-y: auto;
    }
    .blocked-page {
        pointer-events: none;
        opacity: 0.5;
        overflow: hidden;
    }
    tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
    .form-group {
        margin-bottom: 5px;
    }
    .input-sm {
        padding: 5px 10px;
        font-size: 12px;
        height: auto;
    }
    .panel-primary {
        border-color: #337ab7;
    }
    .panel-primary > .panel-heading {
        background-color: #337ab7;
        border-color: #337ab7;
    }
    .table thead tr.info th {
        background-color: #d9edf7;
    }
    small.text-muted {
        font-size: 0.85em;
        color: #6c757d;
    }
    .remove-service {
        padding: 1px 5px;
    }
    #addCustomService {
        margin-bottom: 15px;
    }
    .selected-row {
        background-color: #e6f7ff !important;
    }
</style>

@php
$servicios = [
    'Alimentos en el exterior',
    'Desarchivo de procesos',
    'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
    'Vigilancia Judicial Administrativa',
    'Informaci&oacute;n sobre el pago de sentencias y conciliaciones - DEAJ',
    'Informaci&oacute;n Reparto Oficina de Apoyo Penal',
    'Consulta &oacute;rdenes de captura vigente con fecha de los hechos anterior al a&ntilde;o 2005',
    'Dep&oacute;sitos Judiciales',
    'Diligencia Acta de Compromiso Penal',
    'Presentaciones personales para las medidas de aseguramiento no privativas de la libertad',
    'Autorizaci&oacute;n especiales de personas privadas de la libertad (PPL)',
    'Registro de solicitudes de audiencias de control de garant&iacute;as',
    'Registro de escritos de acusaci&oacute;n para juzgados penales de conocimiento',
    'Radicaci&oacute;n de memoriales',
    'Consulta de programaci&oacute;n y grabaciones de audiencias judiciales',
    'Reclamaci&oacute;n sobre la prescripci&oacute;n de dep&oacute;sitos judiciales',
    'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
    'Tr&aacute;mites cobro coactivo Direcciones Seccionales',
    'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
    'Consulta de procesos nacional unificada',
    'Validaci&oacute;n de sentencias judiciales',
    'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
    'Consulta de personas emplazadas',
    'Consulta de Programaci&oacute;n y grabaciones de audiencias judiciales',
    'Reclamaci&oacute;n sobre la prescripci&oacute;n de dep&oacute;sitos judiciales',
    'Consulta de Programaci&oacute;n y grabaciones de audiencias judiciales',
    'Biblioteca Virtual - SIDN',
    'Tr&aacute;mites cobro coactivo Direcciones Seccionales'
];
@endphp

<!-- Modal de Encuesta -->
<div class="modal fade in" id="encuestaModal" tabindex="-1" role="dialog" aria-labelledby="encuestaModalLabel" style="display: block; padding-right: 17px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #004182; color: white;">
          <strong>
            <h4 class="modal-title text-center" id="encuestaModalLabel">INVENTARIO DE SERVICIOS JUDICIALES</h4>
          </strong>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #004182; color: white;">
            <h2 class="panel-title text-center">Con el prop&oacute;sito de dar cumplimiento a la implementaci&oacute;n de la Ventanilla Judicial Electr&oacute;nica, establecida mediante el Acuerdo PCSJA23-12094 de 2023, solicitamos de manera atenta su colaboraci&oacute;n para diligenciar la siguiente encuesta.</h2>
          </div>
          <div class="panel-body">
            <div class=" text-center">
              <h4>Seleccione los servicios que utiliza habitualmente y, en caso de ser necesario, complemente la información o adicione aquellos servicios que no se encuentren en la lista:</h4>
            </div>
            
            @include('alerts.flash-message')
            @include('../alerts.success')
            @include('../alerts.request')
            
            <div class="panel-body">
                <form id="servicioForm" method="POST" action="{{ route('servicios-judiciales.store') }}" class="form-horizontal">
                    @csrf
                    <hr>

                    <!-- Tabla de servicios -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="serviciosTable">
                            <thead>
                                <tr class="info">
                                    <th class="text-center" style="width: 5%;">✔</th>
                                    <th style="width: 50%;">Servicio Judicial</th>
                                    <th style="width: 25%;">Tipo Servicio</th>
                                    <th style="width: 20%;">Observaciones</th>
                                    <th style="width: 5%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($servicios as $index => $servicio)
                                <tr data-servicio-id="{{ $index }}">
                                    <td class="text-center">
                                        <input type="checkbox" name="servicios[{{ $index }}][seleccionado]" class="servicio-checkbox" id="servicio_{{ $index }}">
                                        <input type="hidden" name="servicios[{{ $index }}][nombre]" value="{{ $servicio }}">
                                    </td>
                                    <td>
                                        <label for="servicio_{{ $index }}" style="font-weight: bold; cursor: pointer;">
                                            {!! $servicio !!}
                                        </label>
                                    </td>
                                    <td>
                                        <select name="servicios[{{ $index }}][tipo_servicio]" class="form-control input-sm tipo-servicio" disabled>
                                            <option value="">Seleccione...</option>
                                            <option value="presencial">Presencial</option>
                                            <option value="virtual">Virtual</option>
                                            <option value="ambos">Ambos</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="servicios[{{ $index }}][observacion]" rows="2" class="form-control input-sm observacion" disabled></textarea>
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Botón para agregar servicio personalizado -->
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="button" id="addCustomService" class="btn btn-success">
                                <i class="glyphicon glyphicon-plus"></i> Agregar Servicio Que no Está En Lista
                            </button>
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="glyphicon glyphicon-floppy-disk"></i> Guardar Registro
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Fondo oscuro para el modal -->
<div class="modal-backdrop fade in" style="z-index: 1040;"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    // Contador para IDs únicos de servicios personalizados
    let customServiceCounter = 0;

    // Función para agregar un nuevo servicio personalizado
    function addCustomService() {
        customServiceCounter++;
        const newId = 'custom_' + customServiceCounter;
        
        const newRow = `
            <tr data-servicio-id="${newId}">
                <td class="text-center">
                    <input type="checkbox" name="servicios[${newId}][seleccionado]" class="servicio-checkbox" id="servicio_${newId}" checked>
                    <input type="hidden" name="servicios[${newId}][custom]" value="1">
                </td>
                <td>
                    <input type="text" name="servicios[${newId}][nombre]" class="form-control input-sm" placeholder="Nombre del servicio" required>
                </td>
                <td>
                    <select name="servicios[${newId}][tipo_servicio]" class="form-control input-sm tipo-servicio">
                        <option value="">Seleccione...</option>
                        <option value="presencial">Presencial</option>
                        <option value="virtual">Virtual</option>
                        <option value="ambos">Ambos</option>
                    </select>
                </td>
                <td>
                    <textarea name="servicios[${newId}][observacion]" rows="2" class="form-control input-sm observacion"></textarea>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-xs remove-service" title="Eliminar servicio">
                        <i class="glyphicon glyphicon-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        
        $('#serviciosTable tbody').append(newRow);
        
        // Desplazarse a la nueva fila
        $('html, body').animate({
            scrollTop: $(`[data-servicio-id="${newId}"]`).offset().top - 100
        }, 500);
        
        // Resaltar la fila
        $(`[data-servicio-id="${newId}"]`).addClass('selected-row');
    }

    // Evento para agregar servicio personalizado
    $('#addCustomService').on('click', addCustomService);

    // Evento para eliminar servicio personalizado
    $(document).on('click', '.remove-service', function() {
        const $row = $(this).closest('tr');
        const servicioId = $row.data('servicio-id');
        
        // Verificar si es un servicio predefinido
        if (!servicioId.startsWith('custom_')) {
            Swal.fire({
                icon: 'error',
                title: 'No se puede eliminar',
                text: 'Solo se pueden eliminar servicios personalizados.',
                confirmButtonText: 'Entendido'
            });
            return;
        }
        
        Swal.fire({
            icon: 'question',
            title: '¿Eliminar servicio?',
            text: '¿Está seguro que desea eliminar este servicio personalizado?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $row.remove();
            }
        });
    });

    // Al marcar/desmarcar un checkbox
    $(document).on('change', '.servicio-checkbox', function() {
        const $row = $(this).closest('tr');
        const isChecked = $(this).is(':checked');
        
        // Habilitar/deshabilitar campos según el estado del checkbox
        $row.find('.tipo-servicio').prop('disabled', !isChecked);
        $row.find('.observacion').prop('disabled', !isChecked);
        
        // Resaltar fila seleccionada
        if (isChecked) {
            $row.addClass('selected-row');
        } else {
            $row.removeClass('selected-row');
            $row.find('.tipo-servicio').val('');
            $row.find('.observacion').val('');
        }
    });

    // Validación al enviar el formulario
    $('#servicioForm').on('submit', function (e) {
        let hasSelection = false;
        let hasErrors = false;
        
        // Verificar que al menos un servicio esté seleccionado
        $('.servicio-checkbox:checked').each(function() {
            hasSelection = true;
            const $row = $(this).closest('tr');
            const tipoServicio = $row.find('.tipo-servicio').val();
            
            // Validar que se haya seleccionado tipo de servicio
            if (!tipoServicio) {
                hasErrors = true;
                $row.find('.tipo-servicio').addClass('is-invalid');
            } else {
                $row.find('.tipo-servicio').removeClass('is-invalid');
            }
            
            // Validar nombre para servicios personalizados
            if ($row.data('servicio-id').startsWith('custom_')) {
                const nombreServicio = $row.find('input[name*="[nombre]"]').val();
                if (!nombreServicio) {
                    hasErrors = true;
                    $row.find('input[name*="[nombre]"]').addClass('is-invalid');
                } else {
                    $row.find('input[name*="[nombre]"]').removeClass('is-invalid');
                }
            }
        });
        
        if (!hasSelection) {
            Swal.fire({
                icon: 'warning',
                title: 'Ningún servicio seleccionado',
                text: 'Debe seleccionar al menos un servicio judicial antes de continuar.',
                confirmButtonText: 'Entendido'
            });
            return false;
        }
        
        if (hasErrors) {
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor complete todos los campos requeridos para los servicios seleccionados.',
                confirmButtonText: 'Entendido'
            });
            return false;
        }
        
        return true;
    });

    // Permitir que al dar clic en una fila se active el checkbox
    $('tbody').on('click', 'tr', function (e) {
        if (!$(e.target).is('input, select, textarea, label, button, i')) {
            const checkbox = $(this).find('.servicio-checkbox');
            checkbox.prop('checked', !checkbox.prop('checked'));
            checkbox.trigger('change');
        }
    });
});
</script>