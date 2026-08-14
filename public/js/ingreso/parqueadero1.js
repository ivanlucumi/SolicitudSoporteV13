$(document).ready(function() {
    
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // ===================================================================
    //  LIMPIEZA DE MODALES: Asegurar que no queden datos previos
    // ===================================================================
    function resetModals() {
        console.log("Cleaning all modals...");
        // Inputs generales
        $('.modal input[type="text"], .modal input[type="hidden"], .modal textarea').val('');
        
        // Divs de advertencia y displays
        $('#advertencia_porteria_div, #advertencia_porteria_div1, #advertencia_porteria_div2, #alerta_inspeccion_ya, #alerta_inspeccion_ingreso').hide();
        $('#novedades_anteriores, #novedades_anteriores_ya, #novedades_anteriores_multi_div').text('—');
        
        // Reset botones
        $('#BotonRegistrarIngreso, #BotonRegistrarSalida').hide();
        
        // Limpiar tabla multi
        $('#tabla_vehiculos_multi tbody').empty();
        
        // Reset estilos de estado
        $('#estado_vehiculo').css('color', '#1e293b');
    }

    // Al cerrar cualquier modal, resetear datos
    $('.modal').on('hidden.bs.modal', function () {
        resetModals();
    });

    function searchUnified() {
        var searchValue = $('#unifiedSearch').val().trim();
        console.log("Starting search for:", searchValue);
        
        if (searchValue === "") {
            toastr.info('Por favor ingrese una cédula o placa');
            return;
        }

        // Limpiar antes de consultar para evitar parpadeos con datos viejos
        resetModals();

        var form = $('#form-consulta-placa-ingreso');
        var action = form.attr('action');
        var url = action.replace(':CEDULA_ID', searchValue);
        
        $.get(url, function(result) {
            if (!result || result.length === 0 || (typeof result === 'object' && Object.keys(result).length === 0) || !result[0]) {
                Swal.fire({
                    title: "NO AUTORIZADO",
                    text: "La placa o cédula " + searchValue + " no está registrada o autorizada en el sistema.",
                    icon: "error",
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            if (result[0].impedimento === "rest") {
                Swal.fire({
                    title: "INGRESO RESTRINGIDO", 
                    text: "El funcionario " + result[0].nombre + " tiene restricción: " + result[0].Restriccion, 
                    icon: "warning"
                });
                return;
            }

            if (result[0].impedimento === "sin_autorizacion") {
                Swal.fire({
                    title: "SIN AUTORIZACIÓN",
                    text: result[0].mensaje,
                    icon: "warning",
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            if (result[0].impedimento === "no_encontrado") {
                Swal.fire({
                    title: "NO ENCONTRADO",
                    text: result[0].mensaje,
                    icon: "error",
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            if (result.length > 1) {
                fillModalMulti(result);
            } else {
                fillModalSingle(result[0]);
            }
        });
    }

    function fillModalSingle(data) {
        $('#id').val(data.id_parq);
        $('#identificacion').val(data.cedula);
        $('#nombre').val(data.nombre);
        $('#despacho').val(data.juzgado);
        $('#placa').val(data.placa);
        $('#tipo').val(data.tipo_vehiculo);

        if (data.empresa) {
            $('#empresa_modal').val(data.empresa);
            $('#div_empresa').show();
        } else {
            $('#div_empresa').hide();
        }
        $('#caract').val(data.descripcion_vehiculo);
        $('#estado_vehiculo').val(data.ocupado);
        $('#ubicacion_detalle').val(data.ubicacion_detalle);
        $('#capacidad_info').val(data.adentro_hoy + ' / ' + data.capacidad_puesto);
        
        var previasIng = data.novedades_hoy ? data.novedades_hoy : (data.observaciones_previas ? data.observaciones_previas : 'SIN NOVEDADES PREVIAS');
        $('#novedades_anteriores').text(previasIng);
        $('#novedades').val(''); 
        
        const defaultAvatar = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23cbd5e1'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/%3E%3C/svg%3E";

        if (data.foto_empleado) {
            $('#img_foto_empleado').attr('src', data.foto_empleado);
            $('#div_foto_empleado').show();
        } else {
            $('#img_foto_empleado').attr('src', defaultAvatar);
            $('#div_foto_empleado').show();
        }
        
        // Si no está permitido y no es por puesto lleno (ej: sin puesto asignado), mostrar alerta directa
        if (!data.permitido_porteria && !data.puesto_lleno && !data.ya_ingreso) {
            Swal.fire({
                title: '⚠️ ACCESO NO PERMITIDO',
                html: '<p style="font-size:15px; margin:0;">' + data.mensaje_porteria + '</p>' +
                      '<p style="font-size:13px; color:#64748b; margin-top:8px;"><strong>Nombre:</strong> ' + data.nombre + '<br><strong>Placa:</strong> ' + data.placa + '</p>',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        if (data.permitido_porteria) {
            $('#advertencia_porteria_div').hide();
            $('#BotonRegistrarIngreso').prop('disabled', false).removeClass('disabled').show();
        } else {
            $('#advertencia_porteria_msg').text(data.mensaje_porteria);
            $('#advertencia_porteria_div').show();
            $('#BotonRegistrarIngreso').prop('disabled', true).addClass('disabled').show();
        }

        // Verificación Inspección para Vehículos Oficiales al INGRESO - Restricción eliminada (solo se exige a la salida)
        $('#alerta_inspeccion_ingreso').hide();

        if (data.ya_ingreso) {
            $('#id__').val(data.id_parq);
            $('#identificacion__').val(data.cedula);
            $('#nombre__').val(data.nombre);
            $('#despacho__').val(data.juzgado);
            $('#placa__').val(data.placa);
            $('#color__').val(data.descripcion_vehiculo);
            $('#capacidad_info_ya').val(data.adentro_hoy + ' / ' + data.capacidad_puesto);
            
            var previas = data.novedades_hoy ? data.novedades_hoy : (data.observaciones_previas ? data.observaciones_previas : 'SIN NOVEDADES PREVIAS');
            $('#novedades_anteriores_ya').text(previas);
            $('#novedades_ya').val(''); 
            
            const defaultAvatar = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23cbd5e1'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/%3E%3C/svg%3E";

            if (data.foto_empleado) {
                $('#img_foto_empleado_ya').attr('src', data.foto_empleado);
                $('#div_foto_empleado_ya').show();
            } else {
                $('#img_foto_empleado_ya').attr('src', defaultAvatar);
                $('#div_foto_empleado_ya').show();
            }
            
            // Verificación Inspección para Vehículos Oficiales
            if (data.es_oficial) {
                if (data.inspeccion_estado !== 'APTO') {
                    $('#alerta_inspeccion_ya').show();
                    var msj = data.inspeccion_hoy ? "El vehículo oficial NO ESTÁ APTO según la inspección." : "El vehículo oficial requiere inspección preoperativa del día para poder salir.";
                    $('#msj_inspeccion_ya').text(msj);
                    $('#BotonRegistrarSalidaYa').prop('disabled', true).addClass('disabled').hide();
                } else {
                    $('#alerta_inspeccion_ya').hide();
                    $('#BotonRegistrarSalidaYa').prop('disabled', false).removeClass('disabled').show();
                }
            } else {
                $('#alerta_inspeccion_ya').hide();
                $('#BotonRegistrarSalidaYa').prop('disabled', false).removeClass('disabled').show();
            }
            
            $('#ResultadoConsultaI').modal('show');
            return;
        } else if (data.puesto_lleno) {
            $('#BotonRegistrarIngreso').show().prop('disabled', true).addClass('disabled');
            $('#BotonRegistrarSalida').hide();
            $('#estado_vehiculo').css('color', '#dc3545').val(data.ocupado);
        } else {
            $('#BotonRegistrarSalida').hide();
            $('#estado_vehiculo').css('color', '#004182').val(data.ocupado);
        }

        $('#VerificarIngreso').modal('show');
    }

    function fillModalMulti(results) {
        $('#nombre_multi_display').text(results[0].nombre);
        $('#cedula_multi_display').text(results[0].cedula);
        $('#identificacion1').val(results[0].cedula);
        
        const defaultAvatar = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23cbd5e1'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/%3E%3C/svg%3E";

        if (results[0].foto_empleado) {
            $('#img_foto_empleado_multi').attr('src', results[0].foto_empleado);
            $('#div_foto_empleado_multi').show();
        } else {
            $('#img_foto_empleado_multi').attr('src', defaultAvatar);
            $('#div_foto_empleado_multi').show();
        }
        
        var tbody = $('#tabla_vehiculos_multi tbody');
        tbody.empty();

        results.forEach(function(veh) {
            var badgeClass = veh.ya_ingreso ? 'label-danger' : (veh.puesto_lleno ? 'label-warning' : 'label-success');
            var statusText = veh.ya_ingreso ? 'ADENTRO' : (veh.puesto_lleno ? 'LLENO' : 'DISPONIBLE');
            
            if (veh.ya_ingreso) {
                if (veh.es_oficial && veh.inspeccion_estado !== 'APTO') {
                    var msjText = veh.inspeccion_hoy ? "NO APTO" : "SIN INSP.";
                    btnAction = `<button class="btn btn-danger btn-sm" disabled title="Vehículo oficial bloqueado por inspección"><i class="fa fa-ban"></i> ${msjText}</button>`;
                } else {
                    btnAction = `<button class="btn btn-danger btn-sm btn-registrar-multi" data-type="salida" data-plate="${veh.placa}" data-parq="${veh.id_parq}"><i class="fa fa-sign-out"></i> SALIDA</button>`;
                }
            } else {
                // Ingreso: no se exige la restricción de inspección para oficiales al ingresar
                var disabledAttr = veh.permitido_porteria ? '' : 'disabled';
                btnAction = `<button class="btn btn-success btn-sm btn-registrar-multi" data-type="ingreso" data-plate="${veh.placa}" data-parq="${veh.id_parq}" ${disabledAttr}><i class="fa fa-sign-in"></i> INGRESO</button>`;
            }

            var row = `
                <tr style="background: #fff; border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px; vertical-align: middle;">
                        <span style="font-weight: 700; color: #1e293b; font-size: 13px;">${veh.tipo_vehiculo}</span><br>
                        <small style="color: #64748b; font-size: 11px;">${veh.descripcion_vehiculo}</small>
                    </td>
                    <td style="padding: 12px; vertical-align: middle;">
                        <span class="label label-primary" style="font-size: 13px; padding: 4px 8px; letter-spacing: 1px;">${veh.placa}</span>
                    </td>
                    <td style="padding: 12px; vertical-align: middle; text-align: center;">
                        <span style="font-size: 12px; font-weight: 600; color: #475569;">${veh.ubicacion_detalle}</span>
                    </td>
                    <td style="padding: 12px; vertical-align: middle; text-align: center;">
                        <span style="font-size: 12px; font-weight: 700; color: #ca8a04;">${veh.adentro_hoy} / ${veh.capacidad_puesto}</span>
                    </td>
                    <td style="padding: 12px; vertical-align: middle; text-align: center;">
                        <span class="label ${badgeClass}">${statusText}</span>
                    </td>
                    <td style="padding: 12px; vertical-align: middle; text-align: center;">
                        ${btnAction}
                    </td>
                </tr>
            `;
            tbody.append(row);
        });

        var historico = results[0].novedades_hoy || results[0].observaciones_previas || 'SIN NOVEDADES PREVIAS';
        $('#novedades_anteriores_multi_div').text(historico);
        $('#novedades_multi').val('');

        $('#VerificarIngreso2').modal('show');
    }

    // Eventos
    $('#btnUnifiedSearch').click(function() { searchUnified(); });

    $('#unifiedSearch').on('keydown', function(e) {
        if (e.which == 13) { // Enter key
            e.preventDefault();
            searchUnified();
        }
    });

    // Botones de Registro (Single)
    $('#BotonRegistrarIngreso').click(function(e) {
        e.preventDefault();
        var id = $('#placa').val(); // Usar PLACA en lugar de Cédula
        var parqId = $('#id').val(); // ID único del vehículo
        var novedades = $('#novedades').val();
        var url = $('#form-registrar-ingreso').attr('action').replace(':CEDULA_ID', id) + "?parq=" + parqId + "&novedades=" + encodeURIComponent(novedades);

        // Deshabilitar para evitar doble clic
        $(this).prop('disabled', true).text('Registrando...');

        $.get(url, function(res) {
            if (res.status === 0) {
                toastr.success(res.message || 'Ingreso registrado');
                $('#VerificarIngreso').modal('hide');
                refreshBitacora(); // ⌛ Refrescar solo la tabla
            } else {
                toastr.error(res.message);
                if (res.message.toLowerCase().includes('ya se encuentra') || res.message.toLowerCase().includes('adentro') || res.message.toLowerCase().includes('ocupado')) {
                    $('#BotonRegistrarIngreso').hide();
                    $('#BotonRegistrarSalida').show();
                    $('#estado_vehiculo').css('color', '#dc3545').val('OCUPADO');
                }
            }
        }).fail(function(jqXHR) {
            toastr.error('Error del servidor o comunicación fallida.');
        }).always(function() {
            $('#BotonRegistrarIngreso').prop('disabled', false).text('REGISTRAR INGRESO');
        });
    });

    // Registrar Salida (Unificado)
    $(document).on('click', '#BotonRegistrarSalida, #BotonRegistrarSalidaYa', function(e) {
        e.preventDefault();
        
        var isYaIngreso = $(this).attr('id') === 'BotonRegistrarSalidaYa';
        var plate = isYaIngreso ? $('#placa__').val() : $('#placa').val();
        var parqId = isYaIngreso ? $('#id__').val() : $('#id').val();
        var novedades = isYaIngreso ? $('#novedades_ya').val() : $('#novedades').val();

        var btn = $(this);
        btn.prop('disabled', true);

        var url = "/parqueadero/registrar/salida/" + plate + "?parq=" + parqId + "&novedades=" + encodeURIComponent(novedades);

        $.get(url, function(res) {
            if (res.status === 0) {
                toastr.success(res.message || 'Salida registrada');
                $('.modal').modal('hide');
                refreshBitacora();
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        }).fail(function() {
            toastr.error('Error al procesar la salida');
        }).always(function() {
            btn.prop('disabled', false);
        });
    });

    // Registro Unificado para Multi-Vehículo
    $(document).on('click', '.btn-registrar-multi', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        var plate = $(this).data('plate');
        var parq = $(this).data('parq');
        var novedades = $('#novedades_multi').val();
        
        var btn = $(this);
        btn.prop('disabled', true);

        var url = (type === 'ingreso') 
            ? "/parqueadero/registrar/ingreso/dos/" + plate + "?parq=" + parq + "&novedades=" + encodeURIComponent(novedades)
            : "/parqueadero/registrar/salida/" + plate + "?parq=" + parq + "&novedades=" + encodeURIComponent(novedades);

        $.get(url, function(res) {
            if (res.status === 0) {
                toastr.success(res.message || 'Registro exitoso');
                $('#VerificarIngreso2').modal('hide');
                refreshBitacora();
            } else {
                Swal.fire('Atención', res.message, 'warning');
                if (res.message.toLowerCase().includes('adentro') || res.message.toLowerCase().includes('ocupado')) {
                    searchUnified(); // Refrescar modal si cambió el estado
                }
            }
        }).fail(function() {
            toastr.error('Error al procesar el registro');
        }).always(function() {
            btn.prop('disabled', false);
        });
    });


});

// ===================================================================
// refreshBitacora: Actualiza la tabla de bitácora via AJAX
// sin recargar toda la página
// ===================================================================
function refreshBitacora() {
    $.ajax({
        url: window.location.href,
        type: 'GET',
        success: function(html) {
            try {
                // Extraer el tbody actualizado de la respuesta
                var newTbody = $(html).find('#tableIngresos tbody').html();
                if (newTbody) {
                    $('#tableIngresos tbody').html(newTbody);
                    // Reaplica los filtros tras la actualización AJAX
                    if (typeof filterTable === 'function') {
                        filterTable();
                    }
                }

                // Actualizar contadores detallados
                ['personas', 'carros', 'motos'].forEach(function(type) {
                    var newCount = $(html).find('#count-' + type).text();
                    if (newCount !== undefined) {
                        $('#count-' + type).text(newCount);
                    }
                });

                // Efecto visual: flash en la tabla
                $('#tableIngresos').fadeOut(150).fadeIn(300);

                // Refrescar enfoque en el campo de búsqueda
                setTimeout(function() {
                    var search = document.getElementById('unifiedSearch');
                    if (search) { search.focus(); search.value = ''; }
                }, 350);
            } catch (e) {
                console.error('Error in refreshBitacora:', e);
                window.location.reload();
            }
        },
        error: function() {
            // Fallback silencioso: no recargar
            console.warn('[refreshBitacora] No se pudo actualizar la tabla.');
        }
    });
} 