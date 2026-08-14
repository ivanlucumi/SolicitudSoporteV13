@extends('layouts.digitalizacion.digitalizacion')

@section('title', 'Registro de Actividad en Despacho')
@section('cabecera', 'Registro de Actividad en Despacho')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
<style>
    .panel-custom {
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    .panel-custom:hover {
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    .btn-custom {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .btn-custom:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .btn-custom:hover:before {
        width: 300px;
        height: 300px;
    }
    .checkbox-custom {
        transform: scale(1.3);
        margin-right: 15px;
    }
    .checkbox-label {
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        padding: 10px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .checkbox-label:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    .fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
    .pulse-btn {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px 10px 0 0;
        border-bottom: none;
    }
    .user-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background: linear-gradient(145deg, #f9f9f9, #ffffff);
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .user-card:hover {
        background: linear-gradient(145deg, #f0f8ff, #e6f3ff);
        border-color: #337ab7;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .badge-custom {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
    }
    .form-group-animated {
        transition: all 0.3s ease;
    }
    .form-group-animated:focus-within {
        transform: scale(1.02);
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .loading-spinner {
        display: none;
    }
    .btn-loading .loading-spinner {
        display: inline-block;
    }
    .btn-loading .btn-text {
        display: none;
    }
    .panel-heading-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 8px 8px 0 0;
    }
    .info-card {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: none;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .icon-bounce {
        animation: bounce 2s infinite;
    }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    .slide-in-left {
        animation: slideInLeft 0.5s ease-out;
    }
    .slide-in-right {
        animation: slideInRight 0.5s ease-out;
    }
    @keyframes slideInLeft {
        from { transform: translateX(-100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .table-modern {
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        background-color: #ffffff;
        animation: fadeIn 0.6s ease;
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border: none;
    }
    
    .table-modern th {
        font-weight: 600;
        padding: 14px 18px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 13px;
        border: none;
    }
    
    .table-modern td {
        padding: 12px 16px;
        border-bottom: 1px solid #e0e0e0;
        background-color: #fafafa;
    }
    
    .table-modern tr:hover td {
        background-color: #f0f8ff;
        transition: background-color 0.3s ease;
    }
    
    .table-modern input.form-control {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 6px 10px;
        font-size: 13px;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        transition: border-color 0.3s;
    }
    
    .table-modern input.form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    /* Estilos para las listas de observaciones */
    .observaciones-container {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        background: #f9f9f9;
    }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #e0e0e0;
        background: transparent;
        padding: 10px 15px;
        position: relative;
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background: #f0f8ff;
        transform: translateX(5px);
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .observacion-item {
        animation: fadeInLeft 0.5s ease;
        border-left: 4px solid #667eea;
        margin-bottom: 5px;
    }

    .observacion-capacitacion-item {
        animation: fadeInRight 0.5s ease;
        border-left: 4px solid #004182;
        margin-bottom: 5px;
    }

    .btn-delete-obs {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .list-group-item:hover .btn-delete-obs {
        opacity: 1;
    }

    .counter-badge {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        margin-right: 8px;
    }

    .empty-state {
        text-align: center;
        padding: 20px;
        color: #999;
        font-style: italic;
    }

    .empty-state i {
        font-size: 24px;
        margin-bottom: 10px;
        display: block;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="text-center animated fadeInDown" style="color: #333; margin-bottom: 30px; font-weight: 300;">
        <i class="fa fa-clipboard icon-bounce"></i> Registro de Actividad en Despacho Asignado
    </h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible animated bounceIn">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if (!$despachoSeleccionado)
        <div class="alert alert-warning animated shake">
            <i class="fa fa-exclamation-triangle"></i> No se ha seleccionado un despacho. 
            <a href="{{ route('actividades.index') }}" class="btn btn-xs btn-default btn-custom">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>
    @else
        {{-- Panel principal --}}
        <div class="panel panel-default panel-custom animated fadeInUp">
            <div class="panel-heading panel-heading-gradient">
                <h4 class="panel-title">
                    <i class="fa fa-plus-circle"></i> Registrar Nueva Actividad para el Despacho
                </h4>
            </div>
            <div class="panel-body">
                {{-- Información del despacho --}}
                <div class="info-card animated slideInLeft">
                    <h4><i class="fa fa-building text-primary"></i> Despacho Seleccionado</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><strong><i class="fa fa-tag text-info"></i> Nombre:</strong> {{ $despachoSeleccionado->nombreDespacho }}</li>
                                <li><strong><i class="fa fa-map-marker text-danger"></i> Circuito:</strong> {{ $despachoSeleccionado->circuito }}</li>
                                <li><strong><i class="fa fa-map text-success"></i> Ciudad:</strong> {{ $despachoSeleccionado->ciudad->nombreCiudad }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><strong><i class="fa fa-home text-warning"></i> Dirección:</strong> {{ $despachoSeleccionado->direccion }}</li>
                                <li><strong><i class="fa fa-phone text-primary"></i> Teléfono:</strong> {{ $despachoSeleccionado->telefono }}
                                    @if($despachoSeleccionado->extension)
                                        <span class="label label-info">Ext {{ $despachoSeleccionado->extension }}</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
<hr>
                <form action="{{ route('actividades.store') }}" method="POST" id="actividadForm">
                     @csrf
                    <input type="hidden" name="despacho_id" value="{{ $despachoSeleccionado->codigoDespacho }}">
                    <input type="hidden" name="usuarios_data" id="usuariosData">

                    <div class="row">
                        {{-- Columna izquierda: Checkboxes y Observaciones --}}
                        <div class="col-md-6">
                            <div class="panel panel-default panel-custom animated slideInLeft" style="animation-delay: 0.2s;">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-check-square-o"></i> ESTADO DE ACTIVIDADES</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="checkbox animated fadeInRight" style="animation-delay: 0.1s;">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="visitado" value="1" class="checkbox-custom"
                                                {{ (old('visitado') || ($actividad && $actividad->visitado)) ? 'checked' : '' }}>
                                                 <i class="fa fa-eye text-primary"></i>
                                            YA SE VISIT&Oacute;
                                        </label>
                                    </div>
                                    <div class="checkbox animated fadeInRight" style="animation-delay: 0.2s;">
                                        <label class="checkbox-label">
                                           <input type="checkbox" name="capacitado" value="1" class="checkbox-custom"
                                            {{ (old('capacitado') || ($actividad && $actividad->capacitado)) ? 'checked' : '' }}>
                                            <i class="fa fa-graduation-cap text-success"></i>
                                        YA SE CAPACIT&Oacute;
                                        </label>
                                    </div>
                                    <div class="checkbox animated fadeInRight" style="animation-delay: 0.3s;">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="datos_usuarios" value="1" class="checkbox-custom"
                                                    {{ (old('datos_usuarios') || ($actividad && $actividad->con_usuarios)) ? 'checked' : '' }}>
                                                    <i class="fa fa-users text-info"></i> 
                                                SE RECOGIERON DATOS DE USUARIOS

                                        </label>
                                    </div>
                                    <div class="checkbox animated fadeInRight" style="animation-delay: 0.4s;">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="usando_sgde" value="1" class="checkbox-custom"
                                                {{ (old('usando_sgde') || ($actividad && $actividad->en_produccion)) ? 'checked' : '' }}>
                                                <i class="fa fa-cogs text-warning"></i>
                                            EST&Aacute; USANDO SGDE

                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Panel de Observaciones Generales --}}
                            <div class="panel panel-default panel-custom animated slideInLeft" style="animation-delay: 0.3s;">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-comment text-primary"></i> OBSERVACIONES VISITAS
                                    </h5>
                                </div>
                                <div class="panel-body">
                                    <button type="button" class="btn btn-warning btn-custom" data-toggle="modal" data-target="#observacionesModal">
                                        <i class="fa fa-pencil"></i> Agregar Observaci&oacute;n Visita
                                    </button>
                                    <div class="observaciones-container" style="margin-top: 10px;">
                                        <ul  class="list-group">
                                            @forelse($observaciones as $index => $obs)
                                                <li class="list-group-item observacion-item">
                                                    <span class="badge badge-custom" id="obsCount">{{ $index + 1}}</span>
                                                    {{ $obs }}
                                                </li>
                                            @empty
                                                <li class="list-group-item empty-state">
                                                    <i class="fa fa-info-circle"></i>
                                                    No hay observaciones registradas
                                                </li>
                                            @endforelse
                                        </ul>
                                        <ul id="observacionesLista" class="list-group">
                                            </ul>
                                        <input type="hidden" name="observaciones" id="observaciones_input" value='@json($observaciones)'>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Columna derecha: Usuarios y Capacitación --}}
                        <div class="col-md-6">
                            <!--div class="panel panel-default panel-custom animated slideInRight" style="animation-delay: 0.2s;">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-users"></i> Usuarios Solicitados <span class="badge badge-custom" id="userCount">0</span></h5>
                                </div>
                                <div class="panel-body">
                                    <button type="button" class="btn btn-info btn-custom" data-toggle="modal" data-target="#userModal">
                                        <i class="fa fa-user-plus"></i> Registrar Usuario
                                    </button>
                                    <div id="usersList" class="mt-3"></div>
                                </div>
                            </div-->
                            
                            {{-- Panel de Observaciones de Capacitación --}}
                            <div class="panel panel-default panel-custom animated slideInRight" style="animation-delay: 0.3s;">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-graduation-cap text-success"></i> OBSERVACIONES DE CAPACITACI&Oacute;N
                                    </h5>
                                </div>
                                <div class="panel-body">
                                    <button type="button" class="btn btn-success btn-custom" data-toggle="modal" data-target="#modalObservacionesCapacitacion">
                                        <i class="fa fa-plus"></i> Agregar Observación de Capacitación
                                    </button>
                                    <div class="observaciones-container" style="margin-top: 10px;">
                                        <ul  class="list-group">
                                            @forelse($observacionesCapacitacion as $index => $obs)
                                                <li class="list-group-item observacion-capacitacion-item">
                                                    <span class="badge badge-custom" id="obsCount">{{ $index + 1 }}</span>
                                                    {{ $obs }}
                                                </li>
                                            @empty
                                                <li class="list-group-item empty-state">
                                                    <i class="fa fa-graduation-cap"></i>
                                                    No hay observaciones de capacitación registradas
                                                </li>
                                            @endforelse
                                        </ul>
                                        <input type="hidden" name="observaciones_capacitacion" id="inputObservacionesCapacitacion" value='@json($observacionesCapacitacion)'>

                                        <ul id="listaObservacionesCapacitacion" class="list-group">
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Botones de acción --}}
                    <div class="text-center animated fadeInUp" style="animation-delay: 0.6s;">
                        <button type="submit" class="btn btn-success btn-lg btn-custom pulse-btn" id="submitBtn">
                            <span class="loading-spinner">
                                <i class="fa fa-spinner fa-spin"></i> Procesando...
                            </span>
                            <span class="btn-text">
                                <i class="fa fa-save"></i> Registrar Actividad
                            </span>
                        </button>
                        <a href="{{ route('actividades.index') }}" class="btn btn-default btn-lg btn-custom">
                            <i class="fa fa-arrow-left"></i> Volver Atrás
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    
    {{-- Tabla de empleados SIRIS --}}
    <div class="animated fadeInUp">
        <h4 class="text-center" style="color: #555; margin-top: 30px; font-weight: 400;">
            <i class="fa fa-users"></i> SOLICITUD DE USUARIO POR SIRIS
        </h4>
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>CÉDULA</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>USUARIO DOMINIO</th>
                    <th>EMAIL PERSONAL INSTITUCIONAL</th>
                </tr>
            </thead>
            <tbody id="tabla-empleados">
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>
                            <input type="number" value="{{ $empleado->cedula }}" class="form-control">
                        </td>
                        <td>
                            <input type="text" value="{{ $empleado->nombre }}" class="form-control">
                        </td>
                        <td>
                            <input type="text" value="{{ $empleado->usuario }}" class="form-control">
                        </td>
                        <td>
                            <input type="email" value="{{ $empleado->email }}" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal para registro de usuarios --}}
<div class="modal fade" id="userModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated zoomIn">
            <div class="modal-header modal-header-custom">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-user-plus"></i> Registrar Usuario Solicitado
                </h4>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userName"><i class="fa fa-user text-primary"></i> Nombre Completo *</label>
                                <input type="text" class="form-control" id="userName" required 
                                       placeholder="Ingrese el nombre completo del usuario">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userEmail"><i class="fa fa-envelope text-info"></i> Correo Electrónico</label>
                                <input type="email" class="form-control" id="userEmail" 
                                       placeholder="usuario@ejemplo.com">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userPhone"><i class="fa fa-phone text-success"></i> Teléfono</label>
                                <input type="tel" class="form-control" id="userPhone" 
                                       placeholder="(601) 234-5678">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userRole"><i class="fa fa-briefcase text-warning"></i> Cargo/Rol</label>
                                <select class="form-control" id="userRole">
                                    <option value="">Seleccione un cargo</option>
                                    <option value="juez">Juez</option>
                                    <option value="secretario">Secretario</option>
                                    <option value="auxiliar">Auxiliar Judicial</option>
                                    <option value="escribiente">Escribiente</option>
                                    <option value="citador">Citador</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userObservations"><i class="fa fa-comment text-primary"></i> Observaciones del Usuario</label>
                        <textarea class="form-control" id="userObservations" rows="3" 
                                 placeholder="Observaciones específicas sobre este usuario (capacitación recibida, dificultades, etc.)..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-custom" onclick="addUser()">
                    <i class="fa fa-plus"></i> Agregar Usuario
                </button>
                <button type="button" class="btn btn-default btn-custom" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal para observaciones generales --}}
<div id="observacionesModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="observacionesModalLabel">
    <div class="modal-dialog">
        <div class="modal-content animated fadeInDown">
            <div class="modal-header modal-header-custom">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title" id="observacionesModalLabel">
                    <i class="fa fa-pencil"></i> Nueva Observación General
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nuevaObservacion">Escriba la observación:</label>
                    <textarea id="nuevaObservacion" class="form-control" rows="4" placeholder="Detalle la observación sobre la actividad realizada..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-custom" id="guardarObservacionBtn">
                    <i class="fa fa-save"></i> Guardar Observación
                </button>
                <button type="button" class="btn btn-default btn-custom" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal para observaciones de capacitación --}}
<div id="modalObservacionesCapacitacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalObservacionesCapacitacionLabel">
    <div class="modal-dialog">
        <div class="modal-content animated fadeInDown">
            <div class="modal-header modal-header-custom">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title" id="modalObservacionesCapacitacionLabel">
                    <i class="fa fa-graduation-cap"></i> Nueva Observación de Capacitación
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nuevaObservacionCapacitacion">Detalle la observación de la capacitación:</label>
                    <textarea id="nuevaObservacionCapacitacion" class="form-control" rows="4" placeholder="Por ejemplo: Tema cubierto, asistencia, dificultades encontradas, resultados obtenidos..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-custom" id="btnGuardarObservacionCapacitacion">
                    <i class="fa fa-save"></i> Guardar Observación
                </button>
                <button type="button" class="btn btn-default btn-custom" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let users = [];
    let userCounter = 0;
    let observaciones = [];
    let observacionesCapacitacion = [];

    // ===== FUNCIONES PARA USUARIOS =====
    window.addUser = function() {
        const name = $('#userName').val().trim();
        const email = $('#userEmail').val().trim();
        const phone = $('#userPhone').val().trim();
        const role = $('#userRole').val();
        const observations = $('#userObservations').val().trim();

        if (!name) {
            showAlert('El nombre es obligatorio', 'warning');
            return;
        }

        const user = {
            id: ++userCounter,
            name: name,
            email: email,
            phone: phone,
            role: role,
            observations: observations
        };

        users.push(user);
        updateUsersList();
        clearUserForm();
        $('#userModal').modal('hide');
        
        showAlert('Usuario agregado correctamente', 'success');
    };

    function updateUsersList() {
        const usersList = $('#usersList');
        const userCount = $('#userCount');
        
        userCount.text(users.length).addClass('animated pulse');
        
        if (users.length === 0) {
            usersList.html('<p class="text-muted"><i class="fa fa-info-circle"></i> No hay usuarios registrados</p>');
            return;
        }

        let html = '';
        users.forEach((user, index) => {
            const roleText = user.role ? getRoleText(user.role) : '';
            html += `
                <div class="user-card animated fadeInUp" style="animation-delay: ${index * 0.1}s;">
                    <div class="row">
                        <div class="col-md-9">
                            <h5><i class="fa fa-user text-primary"></i> ${user.name}</h5>
                            <div class="text-muted">
                                ${roleText ? `<span class="label label-primary">${roleText}</span> ` : ''}
                                ${user.email ? `<br><i class="fa fa-envelope"></i> ${user.email}` : ''}
                                ${user.phone ? `<br><i class="fa fa-phone"></i> ${user.phone}` : ''}
                            </div>
                            ${user.observations ? `<p class="mt-2"><strong><i class="fa fa-comment"></i> Obs:</strong> ${user.observations}</p>` : ''}
                        </div>
                        <div class="col-md-3 text-right">
                            <button type="button" class="btn btn-danger btn-sm btn-custom" onclick="removeUser(${user.id})" title="Eliminar usuario">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        
        usersList.html(html);
        $('#usuariosData').val(JSON.stringify(users));
    }

    function getRoleText(role) {
        const roles = {
            'juez': 'Juez',
            'secretario': 'Secretario',
            'auxiliar': 'Auxiliar Judicial',
            'escribiente': 'Escribiente',
            'citador': 'Citador',
            'otro': 'Otro'
        };
        return roles[role] || role;
    }

    window.removeUser = function(userId) {
        if (confirm('¿Está seguro de eliminar este usuario?')) {
            users = users.filter(user => user.id !== userId);
            updateUsersList();
            showAlert('Usuario eliminado correctamente', 'info');
        }
    };

    function clearUserForm() {
        $('#userForm')[0].reset();
    }

    // ===== FUNCIONES PARA OBSERVACIONES GENERALES =====
    $('#guardarObservacionBtn').click(function(){
        const obs = $('#nuevaObservacion').val().trim();
        if (!obs) {
            showAlert('Por favor escriba la observación', 'warning');
            return;
        }

        observaciones.push(obs);
        $('#observaciones_input').val(JSON.stringify(observaciones));
        renderizarObservaciones();

        $('#nuevaObservacion').val('');
        $('#observacionesModal').modal('hide');
        showAlert('Observación agregada correctamente', 'success');
    });

    function renderizarObservaciones() {
        const lista = $('#observacionesLista');
        const contador = $('#obsCount');
        
        lista.empty();
        contador.text(observaciones.length).addClass('animated pulse');

        if (observaciones.length === 0) {
            lista.append(`
                
            `);
            return;
        }

        observaciones.forEach(function(obs, index){
            lista.append(`
                <li class="list-group-item observacion-item" style="animation-delay: ${index * 0.1}s;">
                    <span class="counter-badge">#${index + 1}</span>
                    <span>${obs}</span>
                    <button type="button" class="btn btn-danger btn-xs btn-delete-obs" onclick="eliminarObservacion(${index})" title="Eliminar observación">
                        <i class="fa fa-trash"></i>
                    </button>
                </li>
            `);
        });
    }

    window.eliminarObservacion = function(index) {
        if (confirm('¿Está seguro de eliminar esta observación?')) {
            observaciones.splice(index, 1);
            $('#observaciones_input').val(JSON.stringify(observaciones));
            renderizarObservaciones();
            showAlert('Observación eliminada', 'info');
        }
    };

    // ===== FUNCIONES PARA OBSERVACIONES DE CAPACITACIÓN =====
    $('#btnGuardarObservacionCapacitacion').click(function(){
        const obs = $('#nuevaObservacionCapacitacion').val().trim();
        if (!obs) {
            showAlert('Por favor escriba la observación de capacitación', 'warning');
            return;
        }

        observacionesCapacitacion.push(obs);
        $('#inputObservacionesCapacitacion').val(JSON.stringify(observacionesCapacitacion));
        renderizarObservacionesCapacitacion();

        $('#nuevaObservacionCapacitacion').val('');
        $('#modalObservacionesCapacitacion').modal('hide');
        showAlert('Observación de capacitación agregada correctamente', 'success');
    });

    function renderizarObservacionesCapacitacion() {
        const lista = $('#listaObservacionesCapacitacion');
        const contador = $('#obsCapCount');
        
        lista.empty();
        contador.text(observacionesCapacitacion.length).addClass('animated pulse');

        if (observacionesCapacitacion.length === 0) {
            lista.append(`
                
            `);
            return;
        }

        observacionesCapacitacion.forEach(function(obs, index){
            lista.append(`
                <li class="list-group-item observacion-capacitacion-item" style="animation-delay: ${index * 0.1}s;">
                    <span class="counter-badge">#${index + 1}</span>
                    <span>${obs}</span>
                    <button type="button" class="btn btn-danger btn-xs btn-delete-obs" onclick="eliminarObservacionCapacitacion(${index})" title="Eliminar observación">
                        <i class="fa fa-trash"></i>
                    </button>
                </li>
            `);
        });
    }

    window.eliminarObservacionCapacitacion = function(index) {
        if (confirm('¿Está seguro de eliminar esta observación de capacitación?')) {
            observacionesCapacitacion.splice(index, 1);
            $('#inputObservacionesCapacitacion').val(JSON.stringify(observacionesCapacitacion));
            renderizarObservacionesCapacitacion();
            showAlert('Observación de capacitación eliminada', 'info');
        }
    };

    // ===== FUNCIONES GENERALES =====
    function showAlert(message, type = 'success') {
        const alertClass = `alert-${type}`;
        const iconClass = type === 'success' ? 'fa-check-circle' : 
                         type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';
        
        const alert = $(`
            <div class="alert ${alertClass} alert-dismissible animated bounceIn" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa ${iconClass}"></i> ${message}
            </div>
        `);
        
        $('body').append(alert);
        setTimeout(() => alert.fadeOut(() => alert.remove()), 3000);
    }

    // Manejo del formulario principal
    $('#actividadForm').on('submit', function(e) {
        const submitBtn = $('#submitBtn');
        submitBtn.addClass('btn-loading');
        
        // Actualizar todos los campos hidden antes del envío
        $('#usuariosData').val(JSON.stringify(users));
        $('#observaciones_input').val(JSON.stringify(observaciones));
        $('#inputObservacionesCapacitacion').val(JSON.stringify(observacionesCapacitacion));
        
        // Simular delay para mostrar loading
        setTimeout(() => {
            // El formulario se enviará normalmente
        }, 500);
    });

    // Inicializar todas las listas
    updateUsersList();
    renderizarObservaciones();
    renderizarObservacionesCapacitacion();
    
    // Efectos hover en checkboxes
    $('.checkbox-label').hover(
        function() { $(this).addClass('animated pulse'); },
        function() { $(this).removeClass('animated pulse'); }
    );

    // Efecto focus en form controls
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('animated pulse');
    }).on('blur', function() {
        $(this).parent().removeClass('animated pulse');
    });
});
</script>
@endpush