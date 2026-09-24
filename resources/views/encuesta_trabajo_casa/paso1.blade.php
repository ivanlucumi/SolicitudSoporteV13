@extends('layouts.ensayo1')
@section('title', 'Validación - Trabajo en Casa')

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary" style="box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="panel-heading text-center" style="padding: 20px;">
                    <h3 class="panel-title" style="font-size: 24px; font-weight: bold;">Trabajo en Casa</h3>
                    <p style="margin: 5px 0 0 0; opacity: 0.9;">Acuerdo XXXX-0001 - Validación</p>
                </div>
                
                <div class="panel-body" style="padding: 30px;">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <strong>Error:</strong> {{ session('error') }}
                        </div>
                    @endif

                    @if(session('error_fecha'))
                        <div class="alert alert-warning">
                            <strong>Atención:</strong> {{ session('error_fecha') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('trabajo_casa.validar') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="cedula">Cédula de Ciudadanía <span class="text-danger">*</span></label>
                            <input type="number" name="cedula" id="cedula" value="{{ old('cedula') }}" required class="form-control input-lg" placeholder="Ej: 123456789">
                            @error('cedula')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_expedicion">Fecha de Expedición <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_expedicion" id="fecha_expedicion" value="{{ old('fecha_expedicion') }}" required class="form-control input-lg">
                            @error('fecha_expedicion')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo Electrónico (para notificaciones) <span class="text-danger">*</span></label>
                            <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required class="form-control input-lg" placeholder="name@ejemplo.com">
                            @error('correo')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Continuar <span class="glyphicon glyphicon-arrow-right"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
