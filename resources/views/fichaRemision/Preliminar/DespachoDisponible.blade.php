@extends('layouts.Ficha.Ficha')
@section('title', 'Configuracion de Despacho para Notificaciones')
@section('content')
<div class="container-fluid">
    <div class="panel panel-primary panel-modern">
        <div class="panel-heading">
            <center>
             <h2 class="panel-title">Configurar Despacho para Notificaciones</h2>
            </center>
        </div>
        
        <div class="panel-body">
           
            {{-- Tarjeta de configuraci¨®n --}}
            <div class="card card-modern card-elevate">
                <div class="card-header">
                    <h3 class="card-title text-white"><strong>Selecci&oacute;n de Despacho</strong></h3>
                </div>
                <div class="card-body " style="margin-left: 20px; margin-right: 20px;">
                    <form method="POST" action="{{ route('despachos.activar') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                                <label for="despacho_id" class="control-label">Despacho activo:</label>
                                <select name="despacho_id" id="despacho_id" class="form-control select2" required>
                                    <option value="">-- Seleccione un despacho --</option>
                                    @foreach($despachos as $despacho)
                                        <option value="{{ $despacho->codigoDespacho }}" >
                                            {{ $despacho->nombreDespacho }} ({{ $despacho->correoD }})
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        
                        <div class="form-group text-left">
                            <button type="submit" class="btn btn-warning btn-elevate">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Activar Juzgado
                            </button>
                            
                            
                        </div>
                        <br>
                    </form>
                </div>
            </div>

            {{-- Despacho actual activo --}}
            @if($despachoActivo)
            <div class="card card-modern card-elevate mt-4">
                <div class="card-header bg-info">
                    <h3 class="card-title text-white">Despacho Activo Actual</h3>
                </div>
                <div class="card-body">
                    <div class="media d-flex align-items-center">
                        <div class="media-left mr-3">
                            <span class="glyphicon glyphicon-ok-circle" style="font-size: 40px; color: #5cb85c;"></span>
                        </div>
                        <div class="media-body d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="media-heading mb-1">{{ $despachoActivo->nombreDespacho }}</h4>
                                <p class="mb-1">{{ $despachoActivo->correoD }}</p>
                                <small class="text-muted">Activado el: {{ $despachoActivo->updated_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <hr>
                            @if($despachoActivo)
                            <div class="ml-3 mt-4 mb-4">
                                <a href="{{ route('despachos.inactivar') }}" class="btn btn-danger btn-elevate" 
                                   onclick="return confirm('07Esta seguro de desactivar todos los despachos?')">
                                    <span class="glyphicon glyphicon-remove"></span> Desactivar Notificacion
                                </a>
                            </div>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Historial --}}
            <div class="card card-modern card-elevate mt-4">
                <div class="card-header bg-primary">
                    <center>
                        <h3 class="card-title text-white">Historial de Cambios</h3>
                    </center>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table9"  class="table table-hover table-modern">
                            <thead>
                                <tr>
                                    <th>Despacho</th>
                                    <th>Email</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historial as $h)
                                    <tr class="tr-elevate">
                                        <td>{{ $h->despacho }}</td>
                                        <td>{{ $h->email }}</td>
                                        <td>
                                            <span class="label label-{{ $h->accion == 'activar' ? 'success' : 'danger' }}">
                                                {{ ucfirst($h->accion) }}
                                            </span>
                                        </td>
                                        <td>{{ $h->user->name }}</td>
                                        <td>{{ $h->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay registros en el historial</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCincoFichaD.js"></script> 

<style>
    /* Estilos modernos */
    .panel-modern {
        border: none;
        border-radius: 4px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    
    .card-modern {
        border: none;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .card-modern:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    
    .card-elevate {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }
    
    .btn-elevate {
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .btn-elevate:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transform: translateY(-1px);
    }
    
    .alert-elevate {
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        border: none;
    }
    
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    
    .tr-elevate {
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .tr-elevate:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-1px);
    }
    
    .label {
        padding: 5px 10px;
        border-radius: 12px;
        font-weight: 500;
    }
</style>

<script>
$(document).ready(function() {
    // Inicializar Select2 con estilo moderno
    $('.select2').select2({
        placeholder: 'Buscar despacho...',
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "No se encontraron resultados";
            }
        },
        dropdownCssClass: 'select2-dropdown-modern'
    });

    // Pre-seleccionar el despacho activo si existe
    @if($despachoActivo)
        $('.select2').val('{{ $despachoActivo->codigoDespacho }}').trigger('change');
    @endif
});
</script>
@endsection