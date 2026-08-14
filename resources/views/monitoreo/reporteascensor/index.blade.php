@extends('layouts.monitoreo.monitoreo')
<!--ponerle titulo a la paginga-->
@section('title', 'Monitoreo ')
@section('cabecera', 'Monitoreo- Reporte Ascensor')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <div class="panel-heading" style="border-radius: 8px 8px 0 0; background: linear-gradient(45deg, #007bff, #0056b3); color: white;">
                    <h3 class="panel-title text-center" style="font-weight: bold;">Reporte de Incidente en Ascensor</h3>
                </div>
                
                <div class="panel-body" style="background-color: #f9f9f9; padding: 20px;">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('monitoreo.reporte.ascensor.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Fecha del reporte -->
                        <div class="form-group">
                            <label for="fecha_reporte" class="control-label">Fecha Reporte *</label>
                            <input type="date" class="form-control" id="fecha_reporte" name="fecha_reporte" 
                                value="{{ old('fecha_reporte', now()->format('Y-m-d')) }}" 
                                max="{{ now()->format('Y-m-d') }}" 
                                required readonly>
                            @error('fecha_reporte')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hora del reporte -->
                        <div class="form-group">
                            <label for="hora_reporte" class="control-label">Hora del Reporte *</label>
                            <input type="time" 
                                   class="form-control" 
                                   id="hora_reporte" 
                                   name="hora_reporte" 
                                   value="{{ old('hora_reporte', now()->format('H:i')) }}" 
                                   readonly
                                   required>
                            @error('hora_reporte')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Información del ascensor -->
                        <div class="form-group">
                            <label for="ascensor" class="control-label">Ascensor *</label>
                            <select class="form-control" id="ascensor" name="ascensor" required>
                                <option value="">Seleccione un ascensor</option>
                                @foreach($ascensores as $ascensor)
                                    <option value="{{ $ascensor }}" {{ old('ascensor') == $ascensor ? 'selected' : '' }}>
                                        {{ $ascensor }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('ascensor')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tipo de incidente -->
                        <div class="form-group">
                            <label for="tipo_incidente" class="control-label">Tipo de Incidente *</label>
                            <select class="form-control" id="tipo_incidente" name="tipo_incidente" required onchange="toggleOtroInput(this)">
                                <option value="">Seleccione un tipo</option>
                                <option value="Persona(s) atrapada(s)" {{ old('tipo_incidente') == 'Persona(s) atrapada(s)' ? 'selected' : '' }}>Persona(s) atrapada(s)</option>
                                <option value="Mal_funcionamiento" {{ old('tipo_incidente') == 'Mal_funcionamiento' ? 'selected' : '' }}>Mal funcionamiento</option>
                                <option value="Ruidos" {{ old('tipo_incidente') == 'Ruidos' ? 'selected' : '' }}>Ruidos anormales</option>
                                <option value="Electrico" {{ old('tipo_incidente') == 'Electrico' ? 'selected' : '' }}>Problema eléctrico</option>
                                <option value="Mecanico" {{ old('tipo_incidente') == 'Mecanico' ? 'selected' : '' }}>Problema mecánico</option>
                                <option value="Otro" {{ old('tipo_incidente') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('tipo_incidente')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Otro tipo de incidente -->
                        <div class="form-group" id="otro_tipo_incidente" style="display: none;">
                            <label for="otro_tipo_incidente" class="control-label">Especifique el tipo de incidente *</label>
                            <input type="text" class="form-control" id="otro_tipo_incidente" name="otro_tipo_incidente" value="{{ old('otro_tipo_incidente') }}" maxlength="30">
                            @error('otro_tipo_incidente')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion" class="control-label">Descripción detallada del reporte *</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                         <!-- Hora del incidente -->
                        <div class="form-group">
                            <label for="hora_incidente" class="control-label">Hora del Incidente *</label>
                            <input type="time" 
                                   class="form-control" 
                                   id="hora_incidente" 
                                   name="hora_incidente" 
                                   value="{{ old('hora_incidente') }}" 
                                   required>
                            @error('hora_incidente')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        

                        <!-- Nombre del reportante -->
                        <div class="form-group">
                            <label for="nombre_reportante" class="control-label">Nombre quien Realiza el Reporte *</label>
                            <input type="text" class="form-control" id="nombre_reportante" name="nombre_reportante" value="{{ old('nombre_reportante') }}" required>
                            @error('nombre_reportante')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Código asignado -->
                        <div class="form-group">
                            <label for="codigoAsignado" class="control-label">Digite el Código Asignado al Reporte *</label>
                            <input type="text" class="form-control" id="codigoAsignado" name="codigoAsignado" value="{{ old('codigoAsignado') }}" required>
                            @error('codigoAsignado')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Operador -->
                        <div class="form-group">
                            <label for="operador" class="control-label">Nombre de Operador de Otis que Recibe la Solicitud *</label>
                            <input type="text" class="form-control" id="operador" name="operador" value="{{ old('operador') }}" required>
                            @error('operador')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <i class="glyphicon glyphicon-send"></i> Reportar Incidente
                            </button>
                            <a href="{{ url('/') }}" class="btn btn-default" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleOtroInput(select) {
        const otroInput = document.getElementById('otro_tipo_incidente');
        if (select.value === 'Otro') {
            otroInput.style.display = 'block';
        } else {
            otroInput.style.display = 'none';
        }
    }
</script>
@endsection

