@extends('layouts.monitoreo.coordinador')

@section('title', 'Editar Puesto de Parqueo')
@section('cabecera', 'Editar Puesto: {{ $puesto->parqueadero }}')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-warning" style="border-radius: 12px;">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-building-o"></i> Editar Puesto: <strong>{{ $puesto->parqueadero }}</strong></h3>
                <small class="text-muted pull-right">Tabla: uso_parqueadero · ID: {{ $puesto->id }}</small>
            </div>

            <form action="{{ route('cooringreso.parqueadero.update', $puesto->id) }}" method="POST">
    @csrf
    @method('PUT')
            <div class="box-body" style="padding: 25px;">

                <div class="form-group {{ $errors->has('parqueadero') ? 'has-error' : '' }}">
                    <label>Número / Identificador del Puesto: <span class="text-danger">*</span></label>
                    <input class="form-control @error('parqueadero') is-invalid @enderror" autocomplete="off" style="text-transform:uppercase;" type="text" name="parqueadero" id="parqueadero" value="{{ old('parqueadero', $puesto->parqueadero ?? '') }}">
@error('parqueadero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    @if($errors->has('parqueadero'))
                        <span class="help-block text-danger">{{ $errors->first('parqueadero') }}</span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Ciudad:</label>
                            <input class="form-control @error('ciudad') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="ciudad" id="ciudad" value="{{ old('ciudad', $puesto->ciudad ?? '') }}">
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Edificio / Torre:</label>
                            <input class="form-control @error('edificio') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="edificio" id="edificio" value="{{ old('edificio', $puesto->edificio ?? '') }}">
@error('edificio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Ubicación:</label>
                            <input class="form-control @error('ubicacion') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion', $puesto->ubicacion ?? '') }}">
@error('ubicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Zona de Asignación:</label>
                            <input class="form-control @error('zona') is-invalid @enderror" placeholder="Ej: ZONA VIP" style="text-transform:uppercase;" type="text" name="zona" id="zona" value="{{ old('zona', $puesto->zona ?? '') }}">
@error('zona')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Capacidad:</label>
                            <input class="form-control @error('capacidad') is-invalid @enderror" min="1" type="number" name="capacidad" id="capacidad" value="{{ old('capacidad', $puesto->capacidad ?? '') }}">
@error('capacidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Estado:</label>
                    <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
    @foreach(['LIBRE' => 'LIBRE', 'OCUPADO' => 'OCUPADO', 'INACTIVO' => 'INACTIVO'] as $key => $value)
        <option value="{{ $key }}" @selected(old('estado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('estado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>

                @if($puesto->asignaciones && $puesto->asignaciones->count() > 0)
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    <strong>Funcionarios asignados a este puesto:</strong>
                    <ul style="margin-top:5px; margin-bottom:0;">
                        @foreach($puesto->asignaciones as $asig)
                            <li style="margin-bottom: 5px;">
                                <a href="{{ route('cooringreso.parqueadero.liberate.assignment', $asig->id) }}" 
                                   class="btn btn-danger btn-xs" 
                                   title="Quitar Funcionario"
                                   onclick="return confirm('¿Está seguro de quitar a este funcionario del puesto?')">
                                    <i class="fa fa-times"></i>
                                </a>
                                &nbsp; <strong>{{ $asig->nombre }}</strong> — <span class="label label-info">{{ $asig->placa }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>{{-- /.box-body --}}

            <div class="box-footer">
                <button type="submit" class="btn btn-warning">
                    <i class="fa fa-refresh"></i> Actualizar Puesto
                </button>
                <a href="{{ route('cooringreso.parqueadero.index') }}" class="btn btn-default pull-right">
                    Cancelar
                </a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
