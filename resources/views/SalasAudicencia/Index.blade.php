@extends('layouts.usuarios')
@section('title', 'Inventario Sala Audiencia')
@section('cabecera')
  INVENTARIO DE SALA AUDIENCIA - {!! $salaAudiencia->nombre !!}
@endsection

@section('content')
<style>
/* Estilos minimalistas mejorados */
.info-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.info-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.info-content label {
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
    display: block;
}

.info-content div {
    font-weight: 600;
    color: #1e293b;
    font-size: 0.9rem;
}

.elementos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    padding: 0.5rem 0;
}

.elemento-card-small {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.elemento-card-small::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.elemento-card-small:hover::before {
    left: 100%;
}

.elemento-card-small:hover {
    border-color: #3b82f6;
    background: #eff6ff;
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
}

.elemento-card-small.selected {
    border-color: #10b981;
    background: #ecfdf5;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
}

.elemento-card-small.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.elemento-card-small.inactive {
    opacity: 0.6;
    background: #f1f5f9;
    border-color: #cbd5e1;
    cursor: not-allowed;
}

.elemento-card-small.auto-selected {
    border-color: #8b5cf6;
    background: #f3e8ff;
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.2);
}

.elemento-icon-small {
    font-size: 2rem;
    color: #3b82f6;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.elemento-card-small.selected .elemento-icon-small {
    color: #10b981;
    transform: scale(1.1);
}

.elemento-card-small.auto-selected .elemento-icon-small {
    color: #8b5cf6;
    transform: scale(1.1);
}

.elemento-card-small.inactive .elemento-icon-small {
    color: #94a3b8;
}

.elemento-name-small {
    font-size: 0.8rem;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.2;
}

.elemento-card-small.inactive .elemento-name-small {
    color: #94a3b8;
}

.elemento-seleccionado {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: all 0.2s ease;
}

.elemento-seleccionado:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.elemento-seleccionado.sin-estado {
    border-color: #f59e0b;
    background: #fffbeb;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
}

.elemento-seleccionado.auto-added {
    border-color: #8b5cf6;
    background: #faf5ff;
    box-shadow: 0 2px 8px rgba(139, 92, 246, 0.2);
}

.elemento-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.elemento-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #1e293b;
}

.elemento-title i {
    color: #3b82f6;
    font-size: 1.1rem;
}

.elemento-title .auto-badge {
    background: #8b5cf6;
    color: white;
    font-size: 0.6rem;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: 0.5rem;
}

.elemento-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.cantidad-control {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    overflow: hidden;
}

.cantidad-btn {
    background: none;
    border: none;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #64748b;
    font-weight: 600;
    transition: all 0.2s ease;
}

.cantidad-btn:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.cantidad-display {
    min-width: 32px;
    text-align: center;
    font-weight: 600;
    color: #1e293b;
    padding: 0 0.25rem;
}

.estado-selector {
    width: 100%;
    margin-top: 0.5rem;
    position: relative;
}

.estado-selector select {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    background: white;
    font-size: 0.85rem;
    transition: all 0.2s ease;
}

.estado-selector select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.estado-selector select.required {
    border-color: #f59e0b;
    background: #fffbeb;
}

.estado-selector select.required:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.estado-selector .required-label {
    position: absolute;
    top: -8px;
    right: 8px;
    background: #f59e0b;
    color: white;
    font-size: 0.7rem;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 600;
    z-index: 10;
}

.observaciones-input {
    width: 100%;
    margin-top: 0.5rem;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 0.85rem;
    resize: vertical;
    min-height: 60px;
    transition: all 0.2s ease;
}

.observaciones-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.panel {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.panel-heading {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 1rem 1.5rem;
}

.panel-info .panel-heading {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.panel-default .panel-heading {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    color: #1e293b;
}

.panel-title {
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.panel-default .panel-title {
    color: #1e293b;
}

.panel-title i {
    font-size: 1.2rem;
}

.badge {
    background: rgba(255,255,255,0.2);
    color: white;
    border-radius: 12px;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.panel-default .badge {
    background: rgba(30, 41, 59, 0.1);
    color: #1e293b;
}

.btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.form-control {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.table-modern {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.table-modern thead th {
    background: #f8fafc;
    border: none;
    font-weight: 600;
    color: #374151;
    padding: 1rem;
}

.table-modern tbody td {
    border: none;
    border-bottom: 1px solid #f1f5f9;
    padding: 1rem;
    vertical-align: middle;
}

.table-modern tbody tr:hover {
    background: #f8fafc;
}

.label {
    border-radius: 12px;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.text-muted {
    color: #64748b !important;
    font-style: italic;
}

#noElementsMessage {
    padding: 2rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 2px dashed #e2e8f0;
}

.validation-message {
    background: #fef3c7;
    border: 1px solid #f59e0b;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
    color: #92400e;
    font-weight: 600;
    display: none;
}

.validation-message i {
    color: #f59e0b;
    margin-right: 0.5rem;
}

.info-message {
    background: #dbeafe;
    border: 1px solid #3b82f6;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
    color: #1e40af;
    font-weight: 600;
}

.info-message i {
    color: #3b82f6;
    margin-right: 0.5rem;
}

.animated {
    animation-duration: 0.6s;
    animation-fill-mode: both;
}

.fadeInUp {
    animation-name: fadeInUp;
}

.shake {
    animation: shake 0.5s ease-in-out;
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 30px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(139, 92, 246, 0); }
    100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
}

@media (max-width: 768px) {
    .elementos-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 0.75rem;
    }
    
    .elemento-card-small {
        padding: 0.75rem;
    }
    
    .elemento-icon-small {
        font-size: 1.5rem;
    }
    
    .elemento-name-small {
        font-size: 0.75rem;
    }
    
    .info-card {
        padding: 0.75rem;
    }
    
    .info-icon {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
}
</style>

<div class="container-fluid">
    {{-- Datos de ubicación --}}<div class="panel panel-primary animated fadeInUp" style="animation-delay: 0.2s;">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-map-marker"></i> Datos de Ubicación</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            
            {{-- Imagen Sala --}}
            <div class="col-xs-12 col-md-6 text-center">
                @if($salaAudiencia->foto)
                    <a href="#" data-toggle="modal" data-target="#modalFoto">
                        <img src="/img/{{$salaAudiencia->foto}}" 
                             alt="Foto Sala" 
                             class="img-responsive img-thumbnail"
                             style="max-width:100%; height:280px; object-fit:cover; border-radius:8px; cursor:pointer;">
                    </a>
                @else
                    <span class="text-muted">Sin foto</span>
                @endif
            </div>

            {{-- Información --}}
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    
                    <div class="col-xs-6 col-md-6">
                        <div class="info-card">
                            <div class="info-icon"><i class="fa fa-location-arrow"></i></div>
                            <div class="info-content">
                                <label>Municipio</label>
                                <div>{{ $salaAudiencia->municipio }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-6">
                        <div class="info-card">
                            <div class="info-icon"><i class="fa fa-road"></i></div>
                            <div class="info-content">
                                <label>Dirección</label>
                                <div>{{ $salaAudiencia->direccion }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-6">
                        <div class="info-card">
                            <div class="info-icon"><i class="fa fa-university"></i></div>
                            <div class="info-content">
                                <label>Sede</label>
                                <div>{{ $salaAudiencia->sede }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-6">
                        <div class="info-card">
                            <div class="info-icon"><i class="fa fa-building-o"></i></div>
                            <div class="info-content">
                                <label>Piso</label>
                                <div>{{ $salaAudiencia->piso ?: 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- Modal para foto en grande --}}
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFotoLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="/img/{{$salaAudiencia->foto}}" 
             alt="Foto Sala" 
             class="img-responsive" 
             style="margin:0 auto; max-height:80vh; object-fit:contain;">
      </div>
    </div>
  </div>
</div>


    {{-- Mensaje informativo para primera vez --}}
    @if($inventarioExistente->count() == 0)
        <div class="info-message animated fadeInUp" style="animation-delay: 0.25s;">
            <i class="fa fa-info-circle"></i>
            <strong>Inventario Inicial:</strong> Los elementos b&aacute;sicos de la sala se han cargado autom&aacute;ticamente.
Por favor, registre la cantidad existente de cada elemento y seleccione su estado actual para completar el inventario inicial.
Si un elemento requiere detalles adicionales, puede agregar observaciones o incluir nuevos elementos manualmente.
        </div>
    @endif

    {{-- Elementos disponibles --}}
    @if($inventarioExistente->count() > 0)
        <div class="panel panel-info animated fadeInUp" style="animation-delay: 0.3s;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-cubes"></i> Elementos Disponibles</h3>
            </div>
            <div class="panel-body">
                <div class="elementos-grid" id="elementosDisponibles">
                    @foreach($elementosDisponibles as $elemento)
                        <div class="elemento-card-small"
                             data-id="{{ $elemento->id }}"
                             data-nombre="{{ strtolower($elemento->nombreElemento) }}">
                            <div class="elemento-icon-small"><i class="fa fa-{{ $elemento->icono }}"></i></div>
                            <div class="elemento-name-small">{{ $elemento->nombreElemento }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Mensaje de validación --}}
    <div class="validation-message" id="validationMessage">
        <i class="fa fa-exclamation-triangle"></i>
        <span id="validationText">Debe seleccionar el estado para todos los elementos antes de guardar.</span>
    </div>

    {{-- Formulario --}}
    <form method="POST" action="{{ route('inventario.store') }}" id="inventarioForm">
        @csrf
        <input type="hidden" name="sala_id" value="{{ $salaAudiencia->id }}">

        <div class="panel panel-primary animated fadeInUp" style="animation-delay: 0.4s;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list-alt"></i> 
                    @if($inventarioExistente->count() == 0)
                        Inventario Inicial - Elementos Básicos
                    @else
                        Elementos Seleccionados
                    @endif
                    <span class="badge pull-right" id="elementCount">0</span>
                </h3>
            </div>
            <div class="panel-body">
                <div id="elementosSeleccionados">
                    <div class="text-center text-muted" id="noElementsMessage">
                        <i class="fa fa-info-circle"></i> 
                        @if($inventarioExistente->count() == 0)
                            Cargando elementos básicos para el inventario inicial...
                        @else
                            Seleccione elementos adicionales de la lista superior
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default animated fadeInUp" style="animation-delay: 0.6s;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-sticky-note"></i> Observaciones Generales</h3>
            </div>
            <div class="panel-body">
                <textarea name="observaciones" rows="4" class="form-control" placeholder="Ingrese observaciones generales sobre el inventario..."></textarea>
            </div>
        </div>

        <div class="text-center animated fadeInUp" style="animation-delay: 0.8s;">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a href="{{ route('salas.listado') }}" class="btn btn-warning btn-lg btn-block">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <button type="submit" class="btn btn-success btn-lg btn-block" id="submitBtn" disabled>
                        <i class="fa fa-save"></i> 
                        @if($inventarioExistente->count() == 0)
                            Crear Inventario Inicial
                        @else
                            Guardar Elementos
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- Inventario existente --}}
    @if($inventarioExistente->count() > 0)
        <hr>
        <div class="panel panel-default animated fadeInUp" style="animation-delay: 1s;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list"></i> Inventario Registrado 
                    <span class="badge pull-right">{{ $inventarioExistente->count() }}</span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-modern">
                        <thead>
                            <tr>
                                <th><i class="fa fa-cube"></i> Elemento</th>
                                <th><i class="fa fa-check-circle"></i> Estado</th>
                                <th><i class="fa fa-check-circle"></i> Cantidad</th>
                                <th><i class="fa fa-comment"></i> Observaciones</th>
                                <th><i class="fa fa-calendar"></i> Fecha</th>
                                <th><i class="fa fa-cogs"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventarioExistente as $item)
                                <tr>
                                    <td><i class="fa fa-{{ $item->elemento->icono }}"></i> {{ $item->elemento->nombreElemento }}</td>
                                    <td>
                                        <span class="label label-{{ $item->estado == 'Bueno' ? 'success' : ($item->estado == 'Malo' ? 'danger' : 'warning') }}">
                                            {{ $item->estado }}
                                        </span>
                                    </td>
                                    <td><i class="fa fa-{{ $item->elemento->icono }}"></i> {{ $item->cantidad }}</td>
                                    <td>{{ $item->observaciones ?: '-' }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('inventario.sala.elemento.destroy', $item->id) }}" method="POST" class="d-inline formulario-eliminar">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const reglas = {
        unico: ['televisor','computador','impresora','amplificador','camara','microfono presidente'],
        limite: { 'altavoces': 2 },
        multiple: ['extensor microfono','microfono','estrados','sillas','tandem','separador']
    };

    const seleccionados = {};
    const grid = document.getElementById('elementosDisponibles');
    const contenedor = document.getElementById('elementosSeleccionados');
    const submitBtn = document.getElementById('submitBtn');
    const badge = document.getElementById('elementCount');
    const form = document.getElementById('inventarioForm');
    const validationMessage = document.getElementById('validationMessage');

    // Verificar si es la primera vez (no hay inventario existente)
    const esPrimeraVez = {{ $inventarioExistente->count() == 0 ? 'true' : 'false' }};

    // Elementos ya registrados en el inventario
    const elementosRegistrados = [
        @foreach($inventarioExistente as $item)
            '{{ strtolower($item->elemento->nombreElemento) }}',
        @endforeach
    ];

    // Todos los elementos disponibles para primera vez
    const todosElementos = [
        @foreach($elementosDisponibles as $elemento)
            {
                id: {{ $elemento->id }},
                nombre: '{{ strtolower($elemento->nombreElemento) }}',
                nombreOriginal: '{{ $elemento->nombreElemento }}'
            },
        @endforeach
    ];

    const icono = {
        televisor:'tv',computador:'desktop',impresora:'print',amplificador:'volume-up',
        altavoces:'volume-up',camara:'camera','microfono presidente':'microphone',
        microfono:'microphone','extensor microfono':'microphone',estrados:'building',sillas:'chair',tandem:'users',separador:'minus'
    };

    const normalizar = t => t.toLowerCase().trim();

    // Marcar elementos ya registrados como inactivos
    function marcarElementosRegistrados() {
        if (!esPrimeraVez && grid) {
            elementosRegistrados.forEach(nombreElemento => {
                const card = grid.querySelector(`[data-nombre="${nombreElemento}"]`);
                if (card) {
                    const key = normalizar(nombreElemento);
        
                    // Si es único o ya alcanzó el límite, lo marcamos como inactivo
                    if (
                        reglas.unico.includes(key) ||
                        (reglas.limite[key] && (seleccionados[key] || 0) >= reglas.limite[key])
                    ) {
                        card.classList.add('inactive');
                    }
                }
            });
        }

    }

    function puedeAgregar(nombre) {
        const key = normalizar(nombre);
        
        // Si no es primera vez, verificar si ya está registrado y es único
        if (!esPrimeraVez && reglas.unico.includes(key) && elementosRegistrados.includes(key)) {
            return false;
        }
        
        if (reglas.unico.includes(key) && seleccionados[key]) return false;
        if (reglas.limite[key] && (seleccionados[key]||0) >= reglas.limite[key]) return false;
        return true;
    }

    function validarEstados() {
        const elementosCards = contenedor.querySelectorAll('.elemento-seleccionado');
        let todosConEstado = true;
        let elementosSinEstado = [];

        elementosCards.forEach(card => {
            const select = card.querySelector('select[name*="[estado]"]');
            const elementoNombre = card.querySelector('.elemento-title').textContent.trim().replace(/AUTO/g, '').trim();
            
            if (!select.value) {
                todosConEstado = false;
                elementosSinEstado.push(elementoNombre);
                card.classList.add('sin-estado');
                select.classList.add('required');
                
                // Agregar etiqueta de requerido si no existe
                if (!card.querySelector('.required-label')) {
                    const label = document.createElement('span');
                    label.className = 'required-label';
                    label.textContent = 'REQUERIDO';
                    card.querySelector('.estado-selector').appendChild(label);
                }
            } else {
                card.classList.remove('sin-estado');
                select.classList.remove('required');
                
                // Remover etiqueta de requerido
                const label = card.querySelector('.required-label');
                if (label) label.remove();
            }
        });

        return { todosConEstado, elementosSinEstado };
    }

    function actualizarContador() {
        const total = Object.values(seleccionados).reduce((a,b)=>a+b,0);
        badge.textContent = total;
        
        const { todosConEstado } = validarEstados();
        submitBtn.disabled = total === 0 || !todosConEstado;
        
        document.getElementById('noElementsMessage').style.display = total === 0 ? 'block' : 'none';
        
        // Ocultar mensaje de validación si todo está correcto
        if (todosConEstado) {
            validationMessage.style.display = 'none';
        }
    }

    function renderElemento(id, nombre, esAutomatico = false) {
        const key = normalizar(nombre);
        seleccionados[key] = (seleccionados[key]||0) + 1;

        const cantidad = seleccionados[key];
        const esMultiple = reglas.multiple.includes(key) || reglas.limite[key];

        const card = document.createElement('div');
        card.className = `elemento-seleccionado sin-estado ${esAutomatico ? 'auto-added' : ''}`;
        card.dataset.key = key;
        card.innerHTML = `
            <div class="elemento-header">
                <div class="elemento-title">
                    <i class="fa fa-${icono[key]||'cube'}"></i> 
                    ${nombre}
                    ${esAutomatico ? '<span class="auto-badge">AUTO</span>' : ''}
                </div>
                <div class="elemento-controls">
                    ${esMultiple ? `
                        <div class="cantidad-control">
                            <button type="button" class="cantidad-btn menos">-</button>
                            <span class="cantidad-display">${cantidad}</span>
                            <button type="button" class="cantidad-btn mas">+</button>
                        </div>
                        <p class="text-danger small" style="margin-top:5px;">
                            ⚠️ Recuerde ingresar la cantidad de este elemento.
                        </p>
                        `:''}
                    <button type="button" class="btn btn-danger btn-xs eliminar"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="estado-selector">
                <span class="required-label">REQUERIDO</span>
                <select name="elementos[${id}][estado]" class="form-control required">
                    <option value="">Seleccionar estado *</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                    <option value="No Tiene">No Tiene</option>
                </select>
            </div>
            <textarea name="elementos[${id}][observaciones]" class="observaciones-input" placeholder="Observaciones del elemento..."></textarea>
            <input type="hidden" name="elementos[${id}][cantidad]" value="1" class="cantidad-input">
        `;
        contenedor.appendChild(card);
        
        // Agregar event listener para el cambio de estado
        const select = card.querySelector('select');
        select.addEventListener('change', () => {
            actualizarContador();
        });
        
        // Animación de entrada
        setTimeout(() => {
            card.classList.add('animated', 'fadeInUp');
        }, 100);
        
        actualizarContador();
    }

    function actualizarCantidad(card,delta) {
        const key = card.dataset.key;
        const input = card.querySelector('.cantidad-input');
        let valor = parseInt(input.value)+delta;
        if (valor < 1) valor = 1;
        if (reglas.limite[key] && valor > reglas.limite[key]) valor = reglas.limite[key];
        input.value = valor;
        card.querySelector('.cantidad-display').textContent = valor;
        seleccionados[key] = valor;
        actualizarContador();
    }

    // Validación antes del envío del formulario
    form.addEventListener('submit', (e) => {
        const { todosConEstado, elementosSinEstado } = validarEstados();
        
        if (!todosConEstado) {
            e.preventDefault();
            
            // Mostrar mensaje de validación
            validationMessage.style.display = 'block';
            document.getElementById('validationText').textContent = 
                `Debe seleccionar el estado para: ${elementosSinEstado.join(', ')}`;
            
            // Hacer scroll al mensaje
            validationMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Agregar animación de shake a elementos sin estado
            contenedor.querySelectorAll('.sin-estado').forEach(card => {
                card.classList.add('shake');
                setTimeout(() => card.classList.remove('shake'), 500);
            });
            
            return false;
        }
    });

    // Event listeners para grid (solo si existe)
    if (grid) {
        grid.addEventListener('click', e=>{
            const card = e.target.closest('.elemento-card-small');
            if (!card || card.classList.contains('disabled') || card.classList.contains('inactive')) return;
            
            const id = card.dataset.id;
            const nombre = card.dataset.nombre;
            if (!puedeAgregar(nombre)) return;
            
            renderElemento(id, nombre);
            card.classList.add('selected');
            
            // Deshabilitar si es único o alcanzó el límite
            const key = normalizar(nombre);
            if (reglas.unico.includes(key) || (reglas.limite[key] && seleccionados[key] >= reglas.limite[key])) {
                card.classList.add('disabled');
            }
        });
    }

    contenedor.addEventListener('click', e=>{
        const card = e.target.closest('.elemento-seleccionado');
        if (!card) return;
        const key = card.dataset.key;
        
        if (e.target.classList.contains('menos')) {
            actualizarCantidad(card,-1);
        }
        if (e.target.classList.contains('mas')) {
            actualizarCantidad(card,1);
        }
        if (e.target.closest('.eliminar')) {
            delete seleccionados[key];
            card.remove();
            actualizarContador();
            if (grid) {
                const gridCard = grid.querySelector(`[data-nombre="${key}"]`);
                if (gridCard) {
                    gridCard.classList.remove('selected', 'disabled');
                }
            }
        }
    });

    // Inicializar
    marcarElementosRegistrados();

    // Lógica de precarga según si es primera vez o no
    if (esPrimeraVez) {
        // Primera vez: Cargar TODOS los elementos automáticamente
        console.log('Primera vez - Cargando todos los elementos automáticamente');
        
        // Ocultar el mensaje después de un momento
        setTimeout(() => {
            document.getElementById('noElementsMessage').style.display = 'none';
        }, 1000);
        
        // Cargar todos los elementos con un pequeño delay para animación
        todosElementos.forEach((elemento, index) => {
            setTimeout(() => {
                renderElemento(elemento.id, elemento.nombreOriginal, true);
                
                // Marcar como auto-seleccionado en el grid si existe
                if (grid) {
                    const gridCard = grid.querySelector(`[data-nombre="${elemento.nombre}"]`);
                    if (gridCard) {
                        gridCard.classList.add('auto-selected', 'pulse');
                        setTimeout(() => gridCard.classList.remove('pulse'), 2000);
                    }
                }
            }, index * 200); // Delay escalonado para efecto visual
        });
        
    } 
});
</script>
@endsection