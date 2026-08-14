@php
    $layout = 'layouts.monitoreo.conductor'; // Base por defecto para este módulo
    if (auth()->check()) {
        if (auth()->user()->rol == 2) {
            $layout = 'layouts.monitoreo.coordinador';
        }
    }
@endphp
@extends($layout)

@section('title', 'Nueva Inspección Preoperativa')

@section('content')

<div class="row" style="margin: 20px 0;">
    <div class="col-md-10 col-md-offset-1">
        
        {{-- ===== HEADER CARD ===== --}}
        <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; overflow: hidden; margin-bottom: 24px;">
            <div style="height: 6px; background: linear-gradient(90deg, #2563eb, #3b82f6);"></div>
            <div class="box-body" style="padding: 32px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa fa-clipboard" style="color: #2563eb; font-size: 28px;"></i>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 22px; margin: 0; color: #0f172a; text-transform: uppercase;">
                            {{ $tipoVehiculo === 'MOTOCICLETA' ? 'Formato F-SGSST-109' : 'Formato F-SGSST-105' }}
                        </h2>
                        <p style="color: #64748b; margin: 4px 0 0; font-size: 13px; font-weight: 500;">
                            Inspección preoperativa diaria obligatoria para vehículos oficiales.
                        </p>
                    </div>
                </div>
                <a href="{{ route('conductores.index') }}" class="btn btn-default" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 20px;">
                    <i class="fa fa-arrow-left"></i> Volver al Panel
                </a>
            </div>
        </div>

        {{-- ===== ALERTAS DE SISTEMA ===== --}}
        @if(session('error'))
            <div class="alert alert-danger" style="border-radius: 14px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        {{-- ===== FORMULARIO PRINCIPAL ===== --}}
        <form action="{{ route('conductores.inspeccion.guardar') }}" method="POST" id="form-inspeccion">
            @csrf
            
            <input type="hidden" name="tipo_vehiculo" value="{{ $tipoVehiculo }}">
            
            {{-- Tarjeta 1: Información General --}}
            <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 20px;">
                    1. Información General del Vehículo y Conductor
                </h4>
                
                <div class="row">
                    {{-- Placa --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label style="color: #475569; font-weight: 600; font-size: 13px;">Placa del Vehículo</label>
                            <input type="text" name="placa" value="{{ $vehiculoParqueadero->placa }}" readonly 
                                   style="background: #f8fafc; border: 2px solid #cbd5e1; border-radius: 12px; font-weight: 800; font-size: 18px; color: #dc2626; text-align: center; letter-spacing: 1.5px; height: 50px; text-transform: uppercase;" class="form-control">
                        </div>
                    </div>
                    
                    {{-- Tipo Vehículo --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label style="color: #475569; font-weight: 600; font-size: 13px;">Tipo de Vehículo</label>
                            <input type="text" value="{{ $vehiculoParqueadero->tipo_vehiculo }}" readonly 
                                   style="background: #f8fafc; border: 2px solid #cbd5e1; border-radius: 12px; font-weight: 700; font-size: 14px; color: #475569; height: 50px;" class="form-control">
                        </div>
                    </div>

                    {{-- Kilometraje --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label style="color: #475569; font-weight: 600; font-size: 13px;">Kilometraje Actual <span style="color:#ef4444;">*</span></label>
                            <input type="number" name="kilometraje" required value="{{ old('kilometraje') }}" placeholder="Ej: 125430"
                                   style="border: 2px solid #cbd5e1; border-radius: 12px; font-weight: 700; font-size: 15px; color: #1e293b; height: 50px;" class="form-control">
                        </div>
                    </div>

                    {{-- Cédula Conductor --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label style="color: #475569; font-weight: 600; font-size: 13px;">Cédula Conductor</label>
                            <input type="text" name="conductor_cedula" id="conductor_cedula" required value="{{ auth()->user()->cedula }}" readonly
                                   style="background: #f8fafc; border: 2px solid #cbd5e1; border-radius: 12px; font-weight: 700; font-size: 14px; color: #1e293b; height: 50px;" class="form-control">
                        </div>
                    </div>
                </div>

                {{-- Datos del conductor logueado --}}
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <div id="conductor-info-card" style="display: flex; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 14px; padding: 14px; align-items: center; gap: 12px;">
                            <i class="fa fa-user-circle" style="color: #2563eb; font-size: 24px;"></i>
                            <div>
                                <small style="color: #1e40af; font-weight: 700; text-transform: uppercase; font-size: 10px; display: block;">Conductor Identificado</small>
                                <span id="conductor-name-display" style="font-size: 14px; font-weight: 800; color: #1e293b; text-transform: uppercase;">
                                    {{ auth()->user()->name }} {{ auth()->user()->lastname ?? '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
                    <div class="col-md-4">
                        <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Parqueadero Asignado</small>
                        <p style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 4px;">{{ $vehiculoParqueadero->puesto ? $vehiculoParqueadero->puesto->parqueadero : $vehiculoParqueadero->no_parqueadero }}</p>
                    </div>
                    <div class="col-md-4">
                        <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Sede / Edificio</small>
                        <p style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 4px;">{{ $vehiculoParqueadero->edificio ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">Dependencia</small>
                        <p style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 4px; text-transform: uppercase;">{{ $vehiculoParqueadero->despacho }}</p>
                    </div>
                </div>
            </div>

            {{-- Tarjeta 2: Preguntas Checklist --}}
            <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 20px;">
                    2. Lista de Verificación (Checklist)
                </h4>

                @foreach($preguntas as $grupoKey => $grupo)
                <div style="margin-bottom: 32px;">
                    <h5 style="background: #f1f5f9; color: #475569; font-weight: 800; padding: 12px 18px; border-radius: 10px; font-size: 13px; letter-spacing: 0.5px; margin-bottom: 18px;">
                        {{ $grupo['titulo'] }}
                    </h5>
                    
                    @foreach($grupo['items'] as $itemKey => $itemName)
                    <div style="border-bottom: 1px dashed #e2e8f0; padding: 14px 10px; display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <span style="font-weight: 600; color: #1e293b; font-size: 14px; flex: 1;">{{ $itemName }}</span>
                            
                            @php
                                $labelSi = 'SI';
                                $labelNo = 'NO';
                                $showNa = true;
                                $colorSi = '#22c55e'; // verde
                                $colorNo = '#ef4444'; // rojo

                                $esFalloEnSi = in_array($itemKey, [
                                    'simit_comparendos', 
                                    'salud_alcohol', 
                                    'salud_estado_general', 
                                    'salud_estado_emocional', 
                                    'salud_estado_visual'
                                ]);

                                if ($esFalloEnSi) {
                                    $colorSi = '#ef4444'; // SÍ es malo (rojo)
                                    $colorNo = '#22c55e'; // NO es bueno (verde)
                                }

                                if (in_array($itemKey, ['luces_externas', 'espejos', 'llantas', 'aceite', 'cinturon_seguridad', 'equipo_carretera'])) {
                                    $labelSi = 'Bueno';
                                    $labelNo = 'Malo';
                                    $showNa = false;
                                } elseif (in_array($itemKey, ['liquido_frenos', 'refrigerante', 'limpiabrisas', 'liquido_direccion'])) {
                                    $labelSi = 'Óptimo';
                                    $labelNo = 'Por debajo del óptimo';
                                    $showNa = false;
                                } elseif ($itemKey === 'documentacion_completa') {
                                    $labelSi = 'Completa';
                                    $labelNo = 'Incompleta';
                                    $showNa = false;
                                } elseif (str_starts_with($itemKey, 'salud_') || str_starts_with($itemKey, 'simit_')) {
                                    $showNa = false; 
                                } elseif (strtoupper($vehiculoParqueadero->calidad_vehiculo) === 'MOTOCICLETA') {
                                    $showNa = false; 
                                }
                            @endphp

                            {{-- Controles Radio --}}
                            <div style="display: flex; gap: 16px; align-items: center;">
                                <label style="margin: 0; font-weight: 700; color: {{ $colorSi }}; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                                    <input type="radio" name="respuestas[{{ $itemKey }}]" value="SI" class="radio-checklist" data-item="{{ $itemKey }}"> {{ $labelSi }}
                                </label>
                                <label style="margin: 0; font-weight: 700; color: {{ $colorNo }}; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                                    <input type="radio" name="respuestas[{{ $itemKey }}]" value="NO" class="radio-checklist" data-item="{{ $itemKey }}"> {{ $labelNo }}
                                </label>
                                @if($showNa)
                                <label style="margin: 0; font-weight: 700; color: #64748b; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                                    <input type="radio" name="respuestas[{{ $itemKey }}]" value="N/A" class="radio-checklist" data-item="{{ $itemKey }}"> N/A
                                </label>
                                @endif
                            </div>
                        </div>

                        {{-- Campo de observación condicional --}}
                        <div id="obs-container-{{ $itemKey }}" style="display: none; padding: 8px 0;">
                            <input type="text" name="observaciones_items[{{ $itemKey }}]" id="obs-input-{{ $itemKey }}" 
                                   placeholder="Describa el fallo mecánico o de documentación observado..." 
                                   style="border: 2px solid #ef4444; border-radius: 10px; font-size: 13px; padding: 10px;" class="form-control">
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

            {{-- Tarjeta 3: Firma y Envío --}}
            <div class="box" style="border-radius: 24px; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); background: #fff; padding: 32px; margin-bottom: 24px;">
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 20px;">
                    3. Firma y Observaciones Generales
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: #475569; font-weight: 600; font-size: 13px;">Observaciones Generales</label>
                            <textarea name="observaciones" rows="5" placeholder="Escriba comentarios generales del estado del vehículo..."
                                      style="border: 2px solid #cbd5e1; border-radius: 12px; font-size: 14px; resize: none; padding: 14px;" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6 text-center">
                        <label style="color: #475569; font-weight: 600; font-size: 13px; display: block; margin-bottom: 10px;">Firma del Conductor</label>
                        <div style="border: 2px dashed #cbd5e1; border-radius: 16px; background: #f8fafc; padding: 10px; display: inline-block;">
                            <canvas id="signature-pad" width="400" height="150" style="background: #fff; border-radius: 8px; cursor: crosshair; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);"></canvas>
                        </div>
                        <div style="margin-top: 10px; display: flex; justify-content: center; gap: 10px;">
                            <button type="button" class="btn btn-sm btn-default" id="btn-clear-sig" style="border-radius: 8px;">
                                <i class="fa fa-eraser"></i> Borrar Firma
                            </button>
                        </div>
                        <input type="hidden" name="firma" id="firma-input">
                    </div>
                </div>

                <div style="margin-top: 32px; border-top: 1px solid #f1f5f9; padding-top: 24px; display: flex; gap: 16px; justify-content: flex-end;">
                    <a href="{{ route('conductores.index') }}" class="btn btn-default" style="border-radius: 12px; font-weight: 700; padding: 14px 28px;">
                        CANCELAR
                    </a>
                    <button type="submit" id="btn-submit-inspeccion" style="background: #2563eb; color: #fff; border: none; border-radius: 12px; font-weight: 700; padding: 14px 32px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                        <i class="fa fa-check-circle"></i> GUARDAR INSPECCIÓN
                    </button>
                </div>
            </div>
            
        </form>

    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    
    // Al cargar los datos del usuario de sesión, el conductor ya se considera válido
    var conductorValido = true;

    // ---- Toggles dinámicos para los ítems del checklist ----
    $('.radio-checklist').change(function() {
        var itemKey = $(this).data('item');
        var val = $(this).val();
        
        var isFalloEnSi = ['simit_comparendos', 'salud_alcohol', 'salud_estado_general', 'salud_estado_emocional', 'salud_estado_visual'].includes(itemKey);
        var isFallo = isFalloEnSi ? (val === 'SI') : (val === 'NO');

        if (isFallo) {
            $('#obs-container-' + itemKey).slideDown(200);
            $('#obs-input-' + itemKey).prop('required', true);
        } else {
            $('#obs-container-' + itemKey).slideUp(150);
            $('#obs-input-' + itemKey).prop('required', false).val('');
        }
    });

    // ---- Panel de Firma digitalizada (HTML5 Canvas) ----
    var canvas = document.getElementById('signature-pad');
    var ctx = canvas.getContext('2d');
    var drawing = false;
    var signatureEmpty = true;

    // Obtener coordenadas adaptadas al Canvas
    function getCoords(e) {
        var rect = canvas.getBoundingClientRect();
        var clientX = e.clientX || (e.touches && e.touches[0].clientX);
        var clientY = e.clientY || (e.touches && e.touches[0].clientY);
        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    function startDrawing(e) {
        drawing = true;
        var coords = getCoords(e);
        ctx.beginPath();
        ctx.moveTo(coords.x, coords.y);
        signatureEmpty = false;
        validarEnvioForm();
    }

    function draw(e) {
        if (!drawing) return;
        e.preventDefault();
        var coords = getCoords(e);
        ctx.lineTo(coords.x, coords.y);
        ctx.strokeStyle = '#0f172a';
        ctx.lineWidth = 3;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.stroke();
    }

    function stopDrawing() {
        drawing = false;
    }

    // Eventos Mouse
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseleave', stopDrawing);

    // Eventos Touch (Móviles/Tablets)
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);

    // Limpiar panel de firma
    $('#btn-clear-sig').click(function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        signatureEmpty = true;
        validarEnvioForm();
    });

    // ---- Habilitación del Botón Guardar (Ahora siempre habilitado para mostrar errores) ----
    function validarEnvioForm() {
        // Ya no deshabilitamos el botón para que el usuario pueda ver qué le falta
    }

    // Interceptar envío del formulario para validar y empaquetar la firma
    $('#form-inspeccion').submit(function(e) {
        var camposFaltantes = [];

        // Validar cédula conductor validada
        if (!conductorValido) {
            camposFaltantes.push('Validación de la Cédula del Conductor (Búsqueda)');
        }

        // Validar kilometraje
        if (!$('input[name="kilometraje"]').val() || $('input[name="kilometraje"]').val().trim() === '') {
            camposFaltantes.push('Kilometraje Actual');
        }

        // Validar que todos los ítems del checklist tengan una respuesta seleccionada
        var itemsValidados = {};
        $('.radio-checklist').each(function() {
            var itemKey = $(this).data('item');
            if (!itemsValidados[itemKey]) {
                if ($('input[name="respuestas[' + itemKey + ']"]:checked').length === 0) {
                    var itemName = $(this).closest('div').parent().find('span').first().text();
                    if (!itemName) itemName = "Ítem de verificación";
                    camposFaltantes.push('Falta calificar el estado de: ' + itemName);
                }
                itemsValidados[itemKey] = true;
            }
        });

        // Validar observaciones requeridas (cuando se marca un fallo)
        $('.radio-checklist:checked').each(function() {
            var val = $(this).val();
            var itemKey = $(this).data('item');
            var isFalloEnSi = ['simit_comparendos', 'salud_alcohol', 'salud_estado_general', 'salud_estado_emocional', 'salud_estado_visual'].includes(itemKey);
            var isFallo = isFalloEnSi ? (val === 'SI') : (val === 'NO');
            
            if (isFallo) {
                var inputObs = $('#obs-input-' + itemKey);
                if (!inputObs.val().trim()) {
                    var itemName = $(this).closest('.radio-checklist').parent().parent().parent().find('span').first().text();
                    if (!itemName) {
                        itemName = "Elemento marcado como NO"; // Fallback por si la estructura cambia
                    }
                    camposFaltantes.push('Falta observación en: ' + itemName);
                }
            }
        });

        // Validar firma
        if (signatureEmpty) {
            camposFaltantes.push('Firma del Conductor (Requerida)');
        }

        // Si hay campos faltantes, mostrar alerta y detener el envío
        if (camposFaltantes.length > 0) {
            e.preventDefault();
            var msj = '<strong>Por favor, complete o corrija los siguientes campos obligatorios para guardar la inspección:</strong><br><ul style="text-align: left; margin-top: 15px; font-size: 14px; color: #dc2626;">';
            camposFaltantes.forEach(function(campo) {
                msj += '<li>' + campo + '</li>';
            });
            msj += '</ul>';
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Formulario incompleto',
                    html: msj,
                    confirmButtonText: 'Entendido, voy a completarlo',
                    confirmButtonColor: '#2563eb'
                });
            } else {
                alert("Faltan los siguientes campos:\n- " + camposFaltantes.join("\n- "));
            }
            return false;
        }

        // Si todo está bien, convertir firma a Base64 e inyectar al input hidden
        var dataURL = canvas.toDataURL('image/png');
        $('#firma-input').val(dataURL);
        
        $('#btn-submit-inspeccion').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');
    });

});
</script>
@endpush
