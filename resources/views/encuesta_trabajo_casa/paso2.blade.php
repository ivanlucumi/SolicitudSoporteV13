@extends('layouts.ensayo1')
@section('title', 'Inventario - Trabajo en Casa')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary" style="box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="panel-heading text-center" style="padding: 20px;">
                    <h3 class="panel-title" style="font-size: 24px; font-weight: bold;">Formulario Necesidades Tecnologicas</h3>
                    <p style="margin: 5px 0 0 0; opacity: 0.9;">Paso 2: Inventario de Elementos</p>
                </div>
                
                <div class="panel-body" style="padding: 20px 30px;">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <strong>Error:</strong> {{ session('error') }}
                        </div>
                    @endif
                    <!-- Aviso Legal -->
                    <div class="alert text-justify" style="background-color: #E9A23B; font-size: 15px; border-left: 5px solid red;">
                        <strong>En atención a lo dispuesto en el artículo 7 del Acuerdo PCSJA26-12564</strong>, solicitamos comedidamente diligenciar la encuesta de caracterización tecnológica, con el fin de recopilar información sobre los equipos, sistemas de información, software, conectividad y demás herramientas disponibles para el desarrollo de sus funciones en la modalidad de trabajo en casa, información que será cruzada con las autorizaciones de teletrabajo otorgadas.
                        <br><br>
                        La información será utilizada para identificar las condiciones y requerimientos tecnológicos de los servidores, de acuerdo con los criterios institucionales y los recursos disponibles para tal efecto. El diligenciamiento de la encuesta no implica la asignación o suministro automático de los elementos reportados, toda vez que esto se efectuara de acuerdo con los recursos disponibles para tal efecto.
                    </div>

                    <form method="POST" action="{{ route('trabajo_casa.guardar') }}" id="encuestaForm">
                        @csrf
                        <input type="hidden" name="cedula" value="{{ $empleado->cedulaE }}">
                        <input type="hidden" name="correo" value="{{ $correo }}">
                        <input type="hidden" name="cod_despacho" value="{{ $empleado->cod_despacho }}">
                        <input type="hidden" name="dependencia" value="{{ $nombreDespacho ?? ($despacho ? $despacho->nombreDespacho : $empleado->dependencia_titular) }}">
                        <input type="hidden" name="correo_dependencia" value="{{ $correoDespacho ?? ($despacho ? $despacho->correoD : 'No registrado') }}">
                        <input type="hidden" name="ciudad" value="{{ $ciudadReal ?? ($despacho ? strtoupper(trim($despacho->ciudad_real)) : strtoupper(trim($empleado->ciudad_ubicacion_laboral))) }}">

                    <!-- Pregunta principal -->
                    <div class="panel panel-warning" style="border-color: #faebcc;">
                        <div class="panel-body text-center" style="background-color: #fcf8e3;">
                            <p style="font-size: 18px; font-weight: bold; margin-bottom: 15px; color: #8a6d3b;">¿CUENTA CON LOS ELEMENTOS PARA TRABAJO EN CASA ESTABLECIDOS EN EL ACUERDO PCSJA26-12567 y ACUERDO PCSJA26-12568?</p>
                            <div class="form-group" style="font-size: 18px; margin-bottom: 0;">
                                <label class="radio-inline" style="margin-right: 30px;">
                                    <input type="radio" name="cuenta_todos_elementos" value="SI" required onclick="toggleElementosTeletrabajo(true)" style="transform: scale(1.5); margin-right: 8px;"> <strong>SÍ</strong>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="cuenta_todos_elementos" value="NO" required onclick="toggleElementosTeletrabajo(false)" style="transform: scale(1.5); margin-right: 8px;"> <strong>NO</strong>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Ficha del empleado -->
                    <div class="well well-sm" style="background-color: #f0f7fd; border-color: #d0e3f0;">
                        @php
                            $ciudadReal = $despacho ? strtoupper(trim($despacho->ciudad_real)) : strtoupper(trim($empleado->ciudad_ubicacion_laboral));
                            $correoDespacho = $despacho ? $despacho->correoD : 'No registrado';
                            $nombreDespacho = $despacho ? $despacho->nombreDespacho : $empleado->dependencia_titular;
                        @endphp
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 style="margin-top: 5px; color: #337ab7;"><strong>{{ $empleado->nameE }} {{ $empleado->lastnameE }}</strong></h4>
                                <ul class="list-inline" style="margin-bottom: 0;">
                                    <li><span class="glyphicon glyphicon-briefcase text-primary"></span> <strong>Despacho:</strong> {{ $nombreDespacho }}</li>
                                    <li><span class="glyphicon glyphicon-map-marker text-danger"></span> <strong>Ciudad:</strong> {{ $ciudadReal }}</li>
                                    <li><span class="glyphicon glyphicon-envelope text-info"></span> <strong>Correo Despacho:</strong> {{ $correoDespacho }}</li>
                                </ul>
                            </div>
                        </div>
                    @if(isset($empleado->teletrabajo) && strtoupper(trim($empleado->teletrabajo)) == 'SI')
                        <div class="alert alert-danger" style="font-size: 16px;">
                            <strong>Aviso:</strong> Según la base de datos suministrada por Bogotá, se realizó la validación correspondiente y se confirmó que el funcionario tiene activo el teletrabajo para el período 2026–2027.
                        </div>
                    @endif

                        @php
                            $esCiudadVpn = str_contains($ciudadReal, 'CALI') || str_contains($ciudadReal, 'BUGA') || str_contains($ciudadReal, 'PALMIRA');
                        @endphp

                        <!-- Bloque VPN (SOLO para ciudades específicas) -->
                        @if($esCiudadVpn)
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong><span class="glyphicon glyphicon-hdd"></span> Conectividad Institucional (VPN)</strong></h3>
                            </div>
                            <div class="panel-body">
                                <p style="font-size: 16px; font-weight: bold;">¿Cuenta con VPN?</p>
                                <div class="form-group text-center" style="font-size: 18px; margin-top: 15px;">
                                    <label class="radio-inline" style="margin-right: 30px;">
                                        <input type="radio" name="tiene_vpn" value="SI" required onclick="toggleRequiereVpn(false)" style="transform: scale(1.5); margin-right: 8px;"> <strong>SI</strong>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="tiene_vpn" value="NO" required onclick="toggleRequiereVpn(true)" style="transform: scale(1.5); margin-right: 8px;"> <strong>NO</strong>
                                    </label>
                                </div>

                                <!-- Pregunta condicional si dice NO -->
                                <div id="requiereVpnContainer" style="display: none; background-color: #fcf8e3; border-left: 5px solid #faebcc; padding: 15px; margin-top: 15px;">
                                    <p style="font-weight: bold; color: #8a6d3b;">¿Requiere VPN?</p>
                                    <div class="form-group text-center" style="font-size: 16px; margin-top: 10px;">
                                        <label class="radio-inline" style="margin-right: 30px;">
                                            <input type="radio" name="requiere_vpn" id="requiere_vpn_si" value="SI" onclick="toggleFormatoVpn(true)" style="transform: scale(1.5); margin-right: 8px;"> <strong>SI</strong>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="requiere_vpn" id="requiere_vpn_no" value="NO" onclick="toggleFormatoVpn(false)" style="transform: scale(1.5); margin-right: 8px;"> <strong>NO</strong>
                                        </label>
                                    </div>
                                    
                                    <!-- Mensaje de descarga condicional -->
                                    <div id="formatoVpnMsg" style="display: none; background-color: #d9edf7; border: 1px solid #bce8f1; padding: 10px; margin-top: 15px; border-radius: 4px; color: #31708f;">
                                        <span class="glyphicon glyphicon-info-sign"></span> Para tramitar su solicitud, es obligatorio descargar y diligenciar el siguiente formato: <br>
                                        <a href="https://www.disajcali.gov.co/img/1formatos/FormulariosolicitudVPN.docx" target="_blank" style="font-weight: bold; margin-top: 8px; display: inline-block;">
                                            <span class="glyphicon glyphicon-file"></span> Descargar Formulario Solicitud VPN
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Bloque Elementos -->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong><span class="glyphicon glyphicon-list-alt"></span> Inventario de Elementos Físicos</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-warning text-center" style="font-size: 18px; font-weight: bold; border-left: 8px solid #f0ad4e;">
                                    ¿CUENTA CON LOS ELEMENTOS PARA TRABAJO EN CASA ESTABLECIDOS EN EL ACUERDO PCSJA26-12567 y ACUERDO PCSJA26-12568?
                                </div>

                                @php
                                    $elementos = [
                                        'computador' => ['label' => 'Computador', 'icon' => 'glyphicon-blackboard'],
                                        'impresora' => ['label' => 'Impresora', 'icon' => 'glyphicon-print'],
                                        'escaner' => ['label' => 'Escáner', 'icon' => 'glyphicon-scan'],
                                        'conectividad' => ['label' => 'Conectividad (Internet)', 'icon' => 'glyphicon-signal'],
                                        'silla' => ['label' => 'Silla', 'icon' => 'glyphicon-user'],
                                        'escritorio' => ['label' => 'Escritorio', 'icon' => 'glyphicon-object-align-bottom']
                                    ];
                                @endphp

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="info">
                                                <th>Elemento</th>
                                                <th class="text-center" style="width: 150px;">REQUIERE</th>
                                                <th class="text-center" style="width: 150px;">NO REQUIERE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($elementos as $key => $data)
                                            <tr>
                                                <td style="vertical-align: middle; font-size: 16px;">
                                                    <span class="glyphicon {{ $data['icon'] }} text-muted" style="margin-right: 8px;"></span>
                                                    <strong>{{ $data['label'] }}</strong>
                                                </td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <input type="radio" name="{{ $key }}" value="REQUIERE" required style="transform: scale(1.5);">
                                                </td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <input type="radio" name="{{ $key }}" value="NO REQUIERE" required style="transform: scale(1.5);">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bloque Aplicaciones -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong><span class="glyphicon glyphicon-th-list"></span> Aplicaciones</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-info text-center" style="font-size: 18px; font-weight: bold; border-left: 8px solid #31708f;">
                                    INDIQUE QUÉ APLICACIONES USA PARA EL DESARROLLO DE SUS FUNCIONES
                                    <br><small style="font-weight: normal; font-size: 14px; color: #31708f;">(Puede marcar varias opciones)</small>
                                </div>
                                
                                <div class="row" style="font-size: 16px; padding: 10px 20px;">
                                    <div class="col-md-6">
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Justicia xxi cliente servidor" style="transform: scale(1.5); margin-right: 10px;"> Justicia xxi cliente servidor</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Tyba" style="transform: scale(1.5); margin-right: 10px;"> Tyba</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Sgde" style="transform: scale(1.5); margin-right: 10px;"> Sgde</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Siug" style="transform: scale(1.5); margin-right: 10px;"> Siug</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Efinomina" style="transform: scale(1.5); margin-right: 10px;"> Efinomina</label></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Sarj" style="transform: scale(1.5); margin-right: 10px;"> Sarj</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Samai" style="transform: scale(1.5); margin-right: 10px;"> Samai</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Portal de tierras" style="transform: scale(1.5); margin-right: 10px;"> Portal de tierras</label></div>
                                        <div class="checkbox" style="margin-bottom: 15px;"><label><input type="checkbox" name="aplicaciones[]" value="Tedial" style="transform: scale(1.5); margin-right: 10px;"> Tedial</label></div>
                                        
                                        <div class="checkbox" style="margin-bottom: 15px;">
                                            <label>
                                                <input type="checkbox" name="aplicaciones[]" value="Otra" id="chk_otra_app" onclick="toggleOtraApp()" style="transform: scale(1.5); margin-right: 10px;"> Otra
                                            </label>
                                            <div id="div_otra_app" style="display: none; margin-top: 10px; margin-left: 20px;">
                                                <input type="text" name="otra_aplicacion" id="txt_otra_app" class="form-control" placeholder="Especifique cuál...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-6">
                                <a href="{{ route('trabajo_casa.paso1') }}" class="btn btn-default btn-lg btn-block">
                                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success btn-lg btn-block">
                                    <span class="glyphicon glyphicon-send"></span> Enviar y Finalizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleRequiereVpn(show) {
        var container = document.getElementById('requiereVpnContainer');
        var rVpnSi = document.getElementById('requiere_vpn_si');
        var rVpnNo = document.getElementById('requiere_vpn_no');
        var formatoMsg = document.getElementById('formatoVpnMsg');
        
        if (show) {
            container.style.display = 'block';
            rVpnSi.required = true;
            rVpnNo.required = true;
        } else {
            container.style.display = 'none';
            rVpnSi.required = false;
            rVpnNo.required = false;
            rVpnSi.checked = false;
            rVpnNo.checked = false;
            if (formatoMsg) formatoMsg.style.display = 'none';
        }
    }

    function toggleFormatoVpn(show) {
        var formatoMsg = document.getElementById('formatoVpnMsg');
        if (show) {
            formatoMsg.style.display = 'block';
        } else {
            formatoMsg.style.display = 'none';
        }
    }

    function toggleOtraApp() {
        var chk = document.getElementById('chk_otra_app');
        var div = document.getElementById('div_otra_app');
        var txt = document.getElementById('txt_otra_app');
        
        if (chk.checked) {
            div.style.display = 'block';
            txt.required = true;
        } else {
            div.style.display = 'none';
            txt.required = false;
            txt.value = '';
        }
    }

    var isTeletrabajoLocked = false;
    function toggleElementosTeletrabajo(tieneTodos) {
        isTeletrabajoLocked = tieneTodos;
        var elementos = ['computador', 'impresora', 'escaner', 'conectividad', 'silla', 'escritorio'];
        
        elementos.forEach(function(item) {
            var radios = document.getElementsByName(item);
            for(var i = 0; i < radios.length; i++) {
                if (tieneTodos) {
                    if (radios[i].value === 'NO REQUIERE') {
                        radios[i].checked = true;
                    }
                    radios[i].style.pointerEvents = 'none';
                    radios[i].parentNode.style.opacity = '0.7';
                } else {
                    radios[i].style.pointerEvents = 'auto';
                    radios[i].parentNode.style.opacity = '1';
                }
            }
        });

         // Marcar VPN como SÍ y bloquear
        var vpnRadios = document.getElementsByName('tiene_vpn');
        if (vpnRadios.length > 0) {
            for(var i = 0; i < vpnRadios.length; i++) {
                if (tieneTodos) {
                    if (vpnRadios[i].value === 'SI') {
                        vpnRadios[i].checked = true;
                        // Ocultamos el bloque de requiere vpn porque ya lo tiene
                        toggleRequiereVpn(false);
                    }
                    vpnRadios[i].style.pointerEvents = 'none';
                    vpnRadios[i].parentNode.style.opacity = '0.7';
                } else {
                    vpnRadios[i].style.pointerEvents = 'auto';
                    vpnRadios[i].parentNode.style.opacity = '1';
                }
            }
        }

        var reqVpnRadios = document.getElementsByName('requiere_vpn');
        if (reqVpnRadios.length > 0) {
            for(var i = 0; i < reqVpnRadios.length; i++) {
                if (tieneTodos) {
                    if (reqVpnRadios[i].value === 'NO') {
                        reqVpnRadios[i].checked = true;
                        toggleFormatoVpn(false);
                    }
                    reqVpnRadios[i].style.pointerEvents = 'none';
                    reqVpnRadios[i].parentNode.style.opacity = '0.7';
                } else {
                    reqVpnRadios[i].style.pointerEvents = 'auto';
                    reqVpnRadios[i].parentNode.style.opacity = '1';
                }
            }
        }
    }

    // Prevenir cambios con teclado si está bloqueado
    document.addEventListener('keydown', function(e) {
        if (isTeletrabajoLocked) {
            if (e.target.tagName === 'INPUT' && e.target.type === 'radio') {
                if (['computador', 'impresora', 'escaner', 'conectividad', 'silla', 'escritorio', 'tiene_vpn'].includes(e.target.name)) {
                    e.preventDefault();
                }
            }
        }
    });
</script>
@endsection
