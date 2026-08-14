@extends('layouts.usuarios')
@section('title', 'Inventario Sala Audiencia')
@section('cabecera') LISTADO DE SALAS DE AUDIENCIA
@endsection

@section('content')
<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido por Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container-fluid">
    
    {{-- Formulario nueva sala --}}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-plus-circle"></i> Crear Nueva Sala
            </h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('salas.creacion') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre" class="control-label">
                                <i class="fa fa-tag"></i> Nombre de la Sala <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control input-modern" max="50" required placeholder="Registra Nombre Sala">
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sede" class="control-label">
                                <i class="fa fa-university"></i> Sede <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="sede" id="sede" class="form-control input-modern" required placeholder="Sede " max="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion" class="control-label">
                                <i class="fa fa-road"></i> Direcci&oacute;n <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="direccion" id="direccion" class="form-control input-modern" required placeholder="Direccion">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="piso" class="control-label">
                                <i class="fa fa-building-o"></i> Piso (Opcional)
                            </label>
                            <input type="number" name="piso" id="piso" class="form-control input-modern" min="1" max="99" placeholder="Numero Piso">
                        </div>
                    </div>
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="municipio" class="control-label">
                                <i class="fa fa-map-marker text-primary"></i> Municipio <span class="text-danger">*</span>
                            </label>
                            <select name="municipio" id="municipio" class="form-control select2" required>
                                <option value="">-- Seleccione Municipio --</option>
                                @foreach($ciudades as $codigo => $nombre)
                                    <option value="{{ $nombre }}" {{ old('municipio', $municipio ?? '') == $nombre ? 'selected' : '' }}>
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="foto" class="control-label">
                                <i class="fa fa-camera"></i> Foto de la Sala <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control input-modern" accept="image/*">
                            <small class="text-muted">Formatos permitidos: JPG, PNG, máx 2MB</small>
                        </div>
                    
                        {{-- Previsualización --}}
                        <div id="preview-container" class="mt-2" style="display:none;">
                            <p class="text-sm text-gray-600"><i class="fa fa-eye"></i> Vista previa:</p>
                            <img id="preview-image" src="" class="img-thumbnail" style="max-width: 100%; border-radius: 8px;">
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-modern">
                        <i class="fa fa-save"></i> Guardar Sala
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de salas --}}
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-list"></i> Listado de Salas
                <span class="badge pull-right">{{ count($salas) }}</span>
            </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-modern">
                    <thead>
                        <tr>
                            <th><i class="fa fa-tag"></i> Nombre</th>
                            <th><i class="fa fa-location-arrow"></i> Municipio</th>
                            <th><i class="fa fa-university"></i> Sede</th>
                            <th><i class="fa fa-road"></i> Dirección</th>
                            <th><i class="fa fa-building-o"></i> Piso</th>
                            <th><i class="fa fa-building-o"></i> Observaciones</th>
                            <th><i class="fa fa-camera"></i> Foto</th>
                            <th><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salas as $sala)
                            <tr>
                                <td class="font-weight-bold text-primary">{{ $sala->nombre }}</td>
                                <td>{{ $sala->municipio }}</td>
                                <td>{{ $sala->sede }}</td>
                                <td>{{ $sala->direccion }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $sala->piso ?: 'N/A' }}
                                    </span>
                                </td>
                                
                                <td>{{ $sala->observaciones_generales }}</td>
                                <td>
                                    @if($sala->foto)
                                        <img src="/img/{{$sala->foto}}" alt="Foto Sala" style="width:80px; height:60px; object-fit:cover; border-radius:6px;" loading="lazy">
                                        
                                    @else
                                        <span class="text-muted">Sin foto</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('inventario.index', ['sala_id' => $sala->id]) }}" class="btn btn-primary btn-xs" title="Asignar elementos">
                                        <i class="fa fa-plus"></i> Asignar Elementos
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    <div class="empty-state">
                                        <i class="fa fa-inbox fa-3x"></i>
                                        <p>No hay salas registradas</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables de colores azules */
:root {
    --primary-blue: #2563eb;
    --secondary-blue: #3b82f6;
    --light-blue: #dbeafe;
    --dark-blue: #1e40af;
    --blue-hover: #1d4ed8;
    --success: #10b981;
    --gray-light: #f8fafc;
    --gray-medium: #64748b;
    --gray-dark: #334155;
}

/* Animaciones básicas */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

/* Header de página */
.page-header {
    background: linear-gradient(135deg, var(--light-blue) 0%, #bfdbfe 100%);
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 1px solid #93c5fd;
    animation: fadeIn 0.6s ease;
}

.page-header h1 {
    margin: 0;
    color: var(--primary-blue);
    font-weight: 600;
}

.page-header small {
    color: var(--gray-medium);
    font-size: 16px;
}

/* Paneles modernos */
.panel {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.1);
    margin-bottom: 25px;
    overflow: hidden;
    animation: fadeIn 0.8s ease;
}

.panel-primary > .panel-heading {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
    border: none;
    color: white;
    padding: 20px 25px;
}

.panel-info > .panel-heading {
    background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    border: none;
    color: white;
    padding: 20px 25px;
}

.panel-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.panel-body {
    padding: 30px;
    background: white;
}

/* Inputs modernos y funcionales */
.form-group {
    margin-bottom: 25px;
    position: relative;
}

.control-label {
    font-weight: 600;
    color: var(--gray-dark);
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
}

.control-label i {
    color: var(--primary-blue);
    margin-right: 5px;
}

.input-modern {
    height: 45px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: white;
    color: var(--gray-dark);
}

.input-modern:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
    background: #fefefe;
}

.input-modern:hover {
    border-color: var(--secondary-blue);
}

/* Botones modernos */
.btn-modern {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--blue-hover) 100%);
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    background: linear-gradient(135deg, var(--blue-hover) 0%, var(--dark-blue) 100%);
}

.btn-modern:active {
    transform: translateY(0);
}

/* Tabla moderna */
.table-modern {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.table-modern thead th {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--blue-hover) 100%);
    color: white;
    border: none;
    padding: 15px 12px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.table-modern tbody tr {
    transition: all 0.3s ease;
    animation: slideIn 0.5s ease;
}

.table-modern tbody tr:hover {
    background: var(--light-blue);
    transform: scale(1.01);
}

.table-modern td {
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: var(--gray-dark);
}

/* Badges */
.badge {
    background: var(--secondary-blue);
    color: white;
    border-radius: 12px;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 500;
}

.badge-info {
    background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
}

/* Alertas */
.alert {
    border: none;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 20px;
    animation: fadeIn 0.5s ease;
}

.alert-success {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    color: #065f46;
    border-left: 4px solid var(--success);
}

/* Estado vacío */
.empty-state {
    padding: 40px 20px;
    color: var(--gray-medium);
}

.empty-state i {
    color: #cbd5e1;
    margin-bottom: 15px;
}

.empty-state p {
    font-size: 16px;
    margin: 0;
}

/* Colores de texto */
.text-primary {
    color: var(--primary-blue) !important;
}

.text-muted {
    color: var(--gray-medium) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header {
        padding: 20px;
        text-align: center;
    }
    
    .panel-body {
        padding: 20px 15px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .btn-modern {
        width: 100%;
        margin-top: 15px;
    }
    
    .table-responsive {
        border-radius: 8px;
    }
}

@media (max-width: 576px) {
    .input-modern {
        height: 42px;
        font-size: 14px;
    }
    
    .control-label {
        font-size: 13px;
    }
    
    .panel-title {
        font-size: 16px;
        flex-direction: column;
        gap: 5px;
    }
    
    .table-modern thead th {
        padding: 12px 8px;
        font-size: 11px;
    }
    
    .table-modern td {
        padding: 12px 8px;
        font-size: 13px;
    }
}

/* Efectos adicionales */
.btn:hover i {
    transform: scale(1.1);
}

.form-control:focus {
    animation: none; /* Evitar conflictos */
}

/* Mejoras de accesibilidad */
.btn:focus,
.form-control:focus {
    outline: 2px solid var(--primary-blue);
    outline-offset: 2px;
}

/* Transiciones suaves */
* {
    box-sizing: border-box;
}

.panel:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(37, 99, 235, 0.15);
}
</style>

<style>
/* Form Group Styles */
.form-group { margin-bottom: 1.5rem; position: relative; }
.control-label { 
    font-weight: 600; color: #374151; display: flex; align-items: center; gap: 0.5rem; 
    margin-bottom: 0.5rem; font-size: 0.9rem; 
}
.text-danger { color: #ef4444 !important; }

/* Base Form Control */
.form-control { 
    border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; 
    transition: all 0.3s ease; font-size: 0.9rem; background: #fff;
}
.form-control:focus { 
    border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); outline: none; 
}

/* Select2 Enhanced Styles */
.select2-container { width: 100% !important; }
.select2-container--default .select2-selection--single {
    height: 48px !important; border: 2px solid #e2e8f0 !important; border-radius: 8px !important;
    background: #fff !important; transition: all 0.3s ease !important;
}
.select2-container--default .select2-selection--single:hover { border-color: #cbd5e1 !important; }
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important; outline: none !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #374151 !important; line-height: 44px !important; padding-left: 1rem !important; 
    padding-right: 2rem !important; font-size: 0.9rem !important;
}
.select2-container--default .select2-selection--single .select2-selection__placeholder { 
    color: #9ca3af !important; font-style: italic !important; 
}
.select2-container--default .select2-selection--single .select2-selection__arrow { 
    height: 44px !important; right: 1rem !important; width: 20px !important; 
}
.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #64748b transparent transparent transparent !important; 
    border-style: solid !important; border-width: 6px 6px 0 6px !important;
    height: 0 !important; left: 50% !important; margin-left: -6px !important; 
    margin-top: -3px !important; position: absolute !important; top: 50% !important; 
    width: 0 !important; transition: all 0.3s ease !important;
}
.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent #3b82f6 transparent !important; border-width: 0 6px 6px 6px !important;
}

/* Dropdown Styles */
.select2-dropdown { 
    border: 2px solid #e2e8f0 !important; border-radius: 8px !important; 
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; margin-top: 4px !important; 
}
.select2-container--default .select2-results__option { 
    padding: 0.75rem 1rem !important; font-size: 0.9rem !important; 
    color: #374151 !important; transition: all 0.2s ease !important; 
}
.select2-container--default .select2-results__option--highlighted[aria-selected] { 
    background-color: #3b82f6 !important; color: white !important; 
}
.select2-container--default .select2-results__option[aria-selected=true] { 
    background-color: #eff6ff !important; color: #1e40af !important; font-weight: 600 !important; 
}
.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 2px solid #e2e8f0 !important; border-radius: 6px !important; 
    padding: 0.5rem !important; font-size: 0.9rem !important; margin: 0.5rem !important; 
    width: calc(100% - 1rem) !important;
}
.select2-container--default .select2-search--dropdown .select2-search__field:focus {
    border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important; outline: none !important;
}

/* Validation States */
.has-error .select2-container--default .select2-selection--single { 
    border-color: #ef4444 !important; box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important; 
}
.has-success .select2-container--default .select2-selection--single { 
    border-color: #10b981 !important; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important; 
}

/* Responsive */
@media (max-width: 768px) {
    .select2-container--default .select2-selection--single { height: 44px !important; }
    .select2-container--default .select2-selection--single .select2-selection__rendered { 
        line-height: 40px !important; font-size: 0.85rem !important; 
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 40px !important; }
}
</style>

<script>
$(document).ready(function() {
    // Verificar que Select2 esté disponible
    if (typeof $.fn.select2 !== 'undefined') {
        $('#municipio').select2({
            placeholder: '-- Seleccione un municipio --',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() { return "No se encontraron resultados"; },
                searching: function() { return "Buscando..."; }
            }
        }).on('change', function() {
            const $group = $(this).closest('.form-group');
            $group.removeClass('has-error has-success');
            if ($(this).val()) {
                $group.addClass('has-success');
            } else {
                $group.addClass('has-error');
            }
        });
    } else {
        console.warn('Select2 no está disponible. Asegúrese de incluir la librería Select2.');
    }
});
</script>



<script>
$(document).ready(function() {
    $('#ciudad').select2({
        placeholder: "-- Seleccione una ciudad --",
        allowClear: true,
        width: '100%' // Para que se ajuste al tamaño del form-control
    });
});
</script>

<script>
// JavaScript vanilla (sin jQuery) para evitar errores
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss para alertas
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(function() {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 300);
        }, 5000);
    });
    
    // Efecto loading en formulario
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            const btn = form.querySelector('.btn-modern');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
            }
        });
    });
    
    // Mejorar experiencia de inputs
    const inputs = document.querySelectorAll('.input-modern');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            this.parentNode.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentNode.classList.remove('focused');
        });
    });
    
    // Cerrar alertas manualmente
    const closeButtons = document.querySelectorAll('.alert .close');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert');
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(function() {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 300);
        });
    });
});
</script>

<script>
document.getElementById('foto').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        previewImage.src = '';
    }
});
</script>

@endsection