@extends('layouts.usuarios')

@section('content')
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h3 class="panel-title" style="font-weight: bold;">FORMULARIO DE SERVICIOS JUDICIALES</h3>
        </div>
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
                                    <input type="radio" name="servicio" value="{{ $servicio }}" class="servicio-radio" id="servicio_{{ $index }}">
                                </td>
                                <td>
                                    <label for="servicio_{{ $index }}" style="font-weight: bold; cursor: pointer;">
                                        {!! $servicio !!}
                                    </label>
                                </td>
                                <td>
                                    <select name="tipo_servicio[{{ $index }}]" class="form-control input-sm tipo-servicio" disabled>
                                        <option value="">Seleccione...</option>
                                        <option value="presencial">Presencial</option>
                                        <option value="virtual">Virtual</option>
                                        <option value="ambos">Ambos</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observacion[{{ $index }}]" rows="2" class="form-control input-sm observacion" disabled></textarea>
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
                            <i class="glyphicon glyphicon-plus"></i> Agregar Servicio Personalizado
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
                    <input type="radio" name="servicio" value="custom_${customServiceCounter}" class="servicio-radio" id="servicio_${newId}" checked>
                </td>
                <td>
                    <input type="text" name="custom_servicio_nombre[${newId}]" class="form-control input-sm" placeholder="Nombre del servicio" required>
                </td>
                <td>
                    <select name="tipo_servicio[${newId}]" class="form-control input-sm tipo-servicio">
                        <option value="">Seleccione...</option>
                        <option value="presencial">Presencial</option>
                        <option value="virtual">Virtual</option>
                        <option value="ambos">Ambos</option>
                    </select>
                </td>
                <td>
                    <textarea name="observacion[${newId}]" rows="2" class="form-control input-sm observacion"></textarea>
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
                
                // Seleccionar el primer servicio disponible después de eliminar
                $('.servicio-radio').first().prop('checked', true).trigger('change');
            }
        });
    });

    // Al seleccionar un servicio
    $('.servicio-radio').on('change', function () {
        // Desactivar todos los selects y campos (excepto los personalizados)
        $('.tipo-servicio').not('[name^="tipo_servicio[custom_]"]').prop('disabled', true).val('');
        $('.observacion').not('[name^="observacion[custom_]"]').prop('disabled', true).val('');

        const $row = $(this).closest('tr');
        const servicioId = $row.data('servicio-id');

        // Activar los campos de la fila seleccionada
        $row.find('.tipo-servicio').prop('disabled', false);
        $row.find('.observacion').prop('disabled', false);
    });

    // Validación al enviar el formulario
    $('#servicioForm').on('submit', function (e) {
        let isValid = true;
        const servicioSeleccionado = $('input[name="servicio"]:checked');

        if (!servicioSeleccionado.length) {
            Swal.fire({
                icon: 'warning',
                title: 'Servicio no seleccionado',
                text: 'Debe seleccionar un servicio judicial antes de continuar.',
                confirmButtonText: 'Entendido'
            });
            return false;
        }

        const $row = servicioSeleccionado.closest('tr');
        const servicioId = $row.data('servicio-id');
        const tipo = $row.find('.tipo-servicio').val();

        // Validar servicio personalizado
        if (servicioId.startsWith('custom_')) {
            const nombreServicio = $row.find('input[name^="custom_servicio_nombre["]').val();
            
            if (!nombreServicio) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nombre requerido',
                    text: 'Debe especificar el nombre del servicio personalizado.',
                    confirmButtonText: 'Entendido'
                });
                return false;
            }
        }

        if (!tipo) {
            Swal.fire({
                icon: 'warning',
                title: 'Tipo de servicio requerido',
                text: 'Seleccione el tipo de servicio: Presencial, Virtual o Ambos.',
                confirmButtonText: 'Seleccionar'
            });
            return false;
        }

        return true;
    });

    // Permitir que al dar clic en una fila se active el radio
    $('tbody').on('click', 'tr', function (e) {
        if (!$(e.target).is('input, select, textarea, label, button, i')) {
            const radio = $(this).find('.servicio-radio');
            radio.prop('checked', true);
            radio.trigger('change');
        }
    });
});
</script>

<style>
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
</style>
@endsection