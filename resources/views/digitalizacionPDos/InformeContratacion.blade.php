@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Informe de Actividades')
@section('cabecera', 'Informe de Actividades Diarias')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Registro de Actividades Diarias</h3>
                </div>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div id="time-message" class="alert alert-info" style="{{ $isAfterNoon ? 'display: none;' : '' }}">
                        El formulario estará disponible después del mediodía (12:00 PM).
                    </div>
                    
                    <div id="already-registered" class="alert alert-warning" style="{{ $hasRegisteredToday ? '' : 'display: none;' }}">
                        Ya has registrado tus actividades para hoy. Podrás registrar nuevas actividades mañana después del mediodía.
                    </div>
                    
                    <form id="activity-form" method="POST" action="{{ route('activities.store') }}" style="{{ ($isAfterNoon && !$hasRegisteredToday) ? '' : 'display: none;' }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="date">Fecha:</label>
                            <input type="text" class="form-control" value="{{ $today->format('d/m/Y') }}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Descripción de actividades:</label>
                            <textarea class="form-control" id="description" name="description" rows="8" required></textarea>
                            <small class="text-muted">Describe detalladamente las actividades realizadas hoy.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-floppy-disk"></i> Guardar Actividad
                        </button>
                    </form>
                </div>
                <div class="panel-footer">
                    <form action="{{ route('activities.generate-report') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="form-group">
                            <label for="month" class="control-label">Generar reporte mensual:</label>
                            <input type="month" name="month" id="month" class="form-control" 
                                   value="{{ now()->format('Y-m') }}" 
                                   max="{{ now()->format('Y-m') }}">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-file"></i> Generar PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    #activity-form textarea {
        resize: vertical;
        min-height: 150px;
        max-height: 300px;
    }
    
    .panel-heading h3 {
        margin: 0;
        font-weight: bold;
    }
    
    .alert {
        margin-bottom: 20px;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Verificar periódicamente si es después del mediodía
        function checkTime() {
            var now = new Date();
            var hours = now.getHours();
            
            if (hours >= 12) {
                $('#time-message').hide();
                
                @if(!$hasRegisteredToday)
                    $('#activity-form').show();
                @endif
            } else {
                $('#time-message').show();
                $('#activity-form').hide();
            }
        }
        
        // Verificar cada minuto
        setInterval(checkTime, 60000);
        
        // Validación del textarea
        $('#activity-form').on('submit', function() {
            var description = $('#description').val().trim();
            
            if (description.length < 10) {
                alert('La descripción debe tener al menos 10 caracteres.');
                return false;
            }
            
            return true;
        });
    });
</script>
@endsection