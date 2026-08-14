@extends('layouts.monitoreo.monitoreo')

@section('content')
<style>
    /* Animaciones personalizadas */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes slideInRight {
        from {
            transform: translate3d(100%, 0, 0);
            opacity: 0;
        }
        to {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
    }

    .animated {
        animation-duration: 0.5s;
        animation-fill-mode: both;
    }

    .fadeInDown {
        animation-name: fadeInDown;
    }

    .fadeInUp {
        animation-name: fadeInUp;
    }

    .pulse {
        animation-name: pulse;
    }

    .slideInRight {
        animation-name: slideInRight;
    }

    /* Estilos del panel */
    .panel-primary {
        border-color: #337ab7;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .panel-primary:hover {
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        transform: translateY(-2px);
    }

    .panel-heading {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
        border-color: #2c3e50 !important;
        padding: 15px 20px;
    }

    .panel-title {
        font-size: 20px;
        font-weight: 600;
        color: #fff !important;
    }

    /* Botón crear mejorado */
    .btn-create {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        color: white;
    }

    .btn-create:active {
        transform: translateY(0);
    }

    .btn-create::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-create:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-create i {
        margin-right: 8px;
    }

    /* Tabla mejorada */
    .table-hover tbody tr {
        transition: all 0.3s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #f0f8ff !important;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Encabezados de tabla con color más oscuro */
    .table thead tr.info {
        background: linear-gradient(135deg, #1a252f 0%, #2c3e50 100%) !important;
        color: white !important;
    }

    .table thead tr.info th {
        border-color: #1a252f !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.8px;
        padding: 15px 12px !important;
        color: #121212 !important;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        border-bottom: 3px solid #667eea !important;
    }

    .table thead tr.info th i {
        margin-right: 6px;
        font-size: 14px;
        opacity: 0.9;
    }

    /* Alertas mejoradas */
    .alert {
        border-radius: 8px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        animation: slideInRight 0.5s ease;
    }

    .alert-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .alert-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    /* Modal mejorado */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 20px 25px;
        border: none;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
        font-size: 32px;
        font-weight: 300;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .modal-title {
        font-size: 22px;
        font-weight: 600;
    }

    .modal-body {
        padding: 30px;
    }

    /* Formulario mejorado */
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control {
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        padding: 12px 15px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: translateY(-2px);
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #6c757d;
        border: none;
        color: white;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        color: white;
    }

    /* Badge para contador */
    .badge-counter {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-left: 10px;
    }

    /* Loading spinner */
    .spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-left: 10px;
        display: inline-block;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* ========================================
       ESTILOS MEJORADOS PARA PAGINACIÓN
       ======================================== */
    
    /* Contenedor de paginación */
    .pagination-wrapper {
        margin-top: 30px;
        padding: 20px 0;
        border-top: 2px solid #e0e0e0;
    }

    /* Estilos para la paginación de Bootstrap 3 */
    .pagination {
        margin: 0;
        display: inline-block;
        padding-left: 0;
        border-radius: 4px;
    }

    .pagination > li {
        display: inline;
    }

    .pagination > li > a,
    .pagination > li > span {
        position: relative;
        float: left;
        padding: 10px 16px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #2c3e50;
        text-decoration: none;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #dee2e6;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .pagination > li:first-child > a,
    .pagination > li:first-child > span {
        margin-left: 0;
        border-top-left-radius: 25px;
        border-bottom-left-radius: 25px;
    }

    .pagination > li:last-child > a,
    .pagination > li:last-child > span {
        border-top-right-radius: 25px;
        border-bottom-right-radius: 25px;
    }

    .pagination > li > a:hover,
    .pagination > li > span:hover,
    .pagination > li > a:focus,
    .pagination > li > span:focus {
        z-index: 2;
        color: #ffffff;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    /* Página activa */
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:hover,
    .pagination > .active > span:hover,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus {
        z-index: 3;
        color: #ffffff;
        cursor: default;
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        border-color: #2c3e50;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(44, 62, 80, 0.4);
    }

    /* Página deshabilitada */
    .pagination > .disabled > span,
    .pagination > .disabled > span:hover,
    .pagination > .disabled > span:focus,
    .pagination > .disabled > a,
    .pagination > .disabled > a:hover,
    .pagination > .disabled > a:focus {
        color: #999999;
        cursor: not-allowed;
        background-color: #f5f5f5;
        border-color: #dddddd;
        opacity: 0.6;
    }

    /* Tamaño grande para paginación */
    .pagination-lg > li > a,
    .pagination-lg > li > span {
        padding: 12px 20px;
        font-size: 16px;
        line-height: 1.3333333;
    }

    .pagination-lg > li:first-child > a,
    .pagination-lg > li:first-child > span {
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
    }

    .pagination-lg > li:last-child > a,
    .pagination-lg > li:last-child > span {
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
    }

    /* Iconos en botones de paginación */
    .pagination > li > a .glyphicon,
    .pagination > li > span .glyphicon {
        font-size: 12px;
        margin: 0 2px;
    }

    /* Información de paginación */
    .pagination-info {
        display: inline-block;
        padding: 10px 20px;
        margin-left: 20px;
        color: #666;
        font-size: 14px;
        font-weight: 500;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 25px;
        border: 2px solid #dee2e6;
    }

    .pagination-info strong {
        color: #2c3e50;
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .btn-create {
            width: 100%;
            margin-bottom: 15px;
        }

        .pagination > li > a,
        .pagination > li > span {
            padding: 8px 12px;
            font-size: 12px;
        }

        .pagination-info {
            display: block;
            margin: 15px 0 0 0;
            text-align: center;
        }

        .pagination-wrapper {
            text-align: center;
        }
    }

    /* Animación para los botones de paginación */
    .pagination > li {
        animation: fadeInUp 0.5s ease;
    }

    .pagination > li:nth-child(1) { animation-delay: 0.1s; }
    .pagination > li:nth-child(2) { animation-delay: 0.2s; }
    .pagination > li:nth-child(3) { animation-delay: 0.3s; }
    .pagination > li:nth-child(4) { animation-delay: 0.4s; }
    .pagination > li:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="container animated fadeInUp">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible animated slideInRight">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="glyphicon glyphicon-ok"></i> <strong>¡Éxito!</strong> {{ session('success') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible animated slideInRight">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="glyphicon glyphicon-warning-sign"></i> <strong>¡Atención!</strong> {{ session('warning') }}
                </div>
            @endif

            <div class="panel panel-primary animated fadeInDown">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-list"></i> Listado de Novedades
                        <span class="badge-counter">{{ $notificaciones->total() }}</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-create" data-toggle="modal" data-target="#modalNovedad">
                        <i class="glyphicon glyphicon-plus"></i> Nueva Novedad
                    </button>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="info">
                                    <th><i class="glyphicon glyphicon-tag"></i> #</th>
                                    <th><i class="glyphicon glyphicon-user"></i> Usuario</th>
                                    <th><i class="glyphicon glyphicon-map-marker"></i> Ciudad</th>
                                    <th><i class="glyphicon glyphicon-home"></i> Edificio</th>
                                    <th><i class="glyphicon glyphicon-road"></i> Dirección</th>
                                    <th><i class="glyphicon glyphicon-pencil"></i> Descripción</th>
                                    <th><i class="glyphicon glyphicon-calendar"></i> Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notificaciones as $notificacion)
                                    <tr>
                                        <td><strong>{{ $notificacion->id }}</strong></td>
                                        <td>{{ $notificacion->usuario }}</td>
                                        <td>{{ $notificacion->ciudad }}</td>
                                        <td>{{ $notificacion->edificio }}</td>
                                        <td>{{ $notificacion->direccion }}</td>
                                        <td>
                                            <span data-toggle="tooltip" title="{{ $notificacion->descripcion }}">
                                                {{ Str::limit($notificacion->descripcion, 50) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small>{{ $notificacion->created_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div style="padding: 40px;">
                                                <i class="glyphicon glyphicon-inbox" style="font-size: 48px; color: #ccc;"></i>
                                                <p style="margin-top: 15px; color: #999; font-size: 16px;">
                                                    <em>No hay novedades registradas</em>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación mejorada -->
                    <div class="pagination-wrapper text-center">
                        {{ $notificaciones->links() }}
                        
                        @if($notificaciones->total() > 0)
                            <div class="pagination-info">
                                Mostrando 
                                <strong>{{ $notificaciones->firstItem() }}</strong> a 
                                <strong>{{ $notificaciones->lastItem() }}</strong> de 
                                <strong>{{ $notificaciones->total() }}</strong> registros
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear novedad -->
<div class="modal fade" id="modalNovedad" tabindex="-1" role="dialog" aria-labelledby="modalNovedadLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalNovedadLabel">
                    <i class="glyphicon glyphicon-plus-sign"></i> Registrar Nueva Novedad
                </h4>
            </div>
            <div class="modal-body">
                <form id="formNovedad" action="{{ route('notificaciones.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">
                                    <i class="glyphicon glyphicon-user"></i> Usuario *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="usuario" 
                                       name="usuario" 
                                       value="{{ old('usuario') }}" 
                                       placeholder="Nombre del usuario"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciudad">
                                    <i class="glyphicon glyphicon-map-marker"></i> Ciudad *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="ciudad" 
                                       name="ciudad" 
                                       value="{{ old('ciudad') }}" 
                                       placeholder="Ciudad"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edificio">
                                    <i class="glyphicon glyphicon-home"></i> Edificio *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="edificio" 
                                       name="edificio" 
                                       value="{{ old('edificio') }}" 
                                       placeholder="Nombre del edificio"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">
                                    <i class="glyphicon glyphicon-road"></i> Dirección *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="{{ old('direccion') }}" 
                                       placeholder="Dirección completa"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">
                            <i class="glyphicon glyphicon-pencil"></i> Descripción *
                        </label>
                        <textarea class="form-control" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  rows="5" 
                                  placeholder="Describe la novedad en detalle..."
                                  required>{{ old('descripcion') }}</textarea>
                        <small class="text-muted">
                            <span id="charCount">0</span> / 500 caracteres
                        </small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-submit">
                                <i class="glyphicon glyphicon-send"></i> Registrar Novedad
                                <span class="spinner" id="spinner"></span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-cancel" data-dismiss="modal">
                                <i class="glyphicon glyphicon-remove"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inicializar tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Contador de caracteres
    $('#descripcion').on('input', function() {
        var length = $(this).val().length;
        $('#charCount').text(length);
        
        if (length > 500) {
            $('#charCount').css('color', 'red');
        } else {
            $('#charCount').css('color', '#666');
        }
    });

    // Animación al enviar formulario
    $('#formNovedad').on('submit', function(e) {
        var btn = $(this).find('.btn-submit');
        btn.prop('disabled', true);
        btn.html('<i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Enviando...');
    });

    // Limpiar formulario al cerrar modal
    $('#modalNovedad').on('hidden.bs.modal', function () {
        $('#formNovedad')[0].reset();
        $('#charCount').text('0');
    });

    // Validación en tiempo real
    $('.form-control').on('blur', function() {
        if ($(this).val() === '' && $(this).prop('required')) {
            $(this).css('border-color', '#f5576c');
        } else {
            $(this).css('border-color', '#e0e0e0');
        }
    });

    // Animación de entrada para las filas de la tabla
    $('.table tbody tr').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(-20px)'
        });
        
        $(this).delay(index * 50).animate({
            'opacity': '1'
        }, 300, function() {
            $(this).css('transform', 'translateX(0)');
        });
    });

    // Auto-cerrar alertas después de 5 segundos
    setTimeout(function() {
        $('.alert').fadeOut('slow', function() {
            $(this).remove();
        });
    }, 5000);

    // Efecto de pulso en el botón crear
    setInterval(function() {
        $('.btn-create').addClass('pulse');
        setTimeout(function() {
            $('.btn-create').removeClass('pulse');
        }, 500);
    }, 5000);

    // Abrir modal si hay errores de validación
    @if($errors->any())
        $('#modalNovedad').modal('show');
        
        // Mostrar errores en el modal
        var errorsHtml = '<div class="alert alert-danger alert-dismissible animated fadeInDown">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>¡Error!</strong> Por favor corrige los siguientes errores:<ul>';
        
        @foreach($errors->all() as $error)
            errorsHtml += '<li>{{ $error }}</li>';
        @endforeach
        
        errorsHtml += '</ul></div>';
        
        $('.modal-body').prepend(errorsHtml);
    @endif

    // Mejorar la apariencia de los botones de paginación
    $('.pagination > li > a, .pagination > li > span').each(function() {
        var text = $(this).text().trim();
        
        // Reemplazar texto "Previous" con icono
        if (text === 'Previous' || text === '«' || text === 'Anterior') {
            $(this).html('<i class="glyphicon glyphicon-chevron-left"></i> Anterior');
        }
        
        // Reemplazar texto "Next" con icono
        if (text === 'Next' || text === '»' || text === 'Siguiente') {
            $(this).html('Siguiente <i class="glyphicon glyphicon-chevron-right"></i>');
        }
    });

    // Efecto hover en botones de paginación
    $('.pagination > li > a').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});
</script>
@endsection