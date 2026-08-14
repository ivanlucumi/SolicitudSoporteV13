@extends('layouts.monitoreo.coordinador')

@section('title', 'Nuevo Puesto de Parqueo')
@section('cabecera', 'Registrar Puesto de Parqueo')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-building-o"></i> Datos del Puesto Físico</h3>
                <small class="text-muted pull-right">Tabla: uso_parqueadero</small>
            </div>

            <form action="{{ route('cooringreso.parqueadero.store') }}" method="POST">
    @csrf
            <div class="box-body" style="padding: 25px;">

                <div class="form-group {{ $errors->has('parqueadero') ? 'has-error' : '' }}">
                    <label>Número / Identificador del Puesto: <span class="text-danger">*</span></label>
                    <input class="form-control @error('parqueadero') is-invalid @enderror" placeholder="Ej: P-101 / SOTANO-1 / EXTERNO-1" autocomplete="off" style="text-transform:uppercase;" type="text" name="parqueadero" id="parqueadero" value="{{ old('parqueadero') }}">
@error('parqueadero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <span class="help-block">Código único que identifica este puesto.</span>
                    @if($errors->has('parqueadero'))
                        <span class="help-block text-danger">{{ $errors->first('parqueadero') }}</span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('ciudad') ? 'has-error' : '' }}">
                            <label>Ciudad: <span class="text-danger">*</span></label>
                            <input class="form-control @error('ciudad') is-invalid @enderror" style="text-transform:uppercase;" type="text" name="ciudad" id="ciudad" value="{{ old('ciudad', 'CALI') }}">
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('edificio') ? 'has-error' : '' }}">
                            <label>Edificio / Torre: <span class="text-danger">*</span></label>
                            <input class="form-control @error('edificio') is-invalid @enderror" placeholder="Ej: TORRE A / PALACIO" style="text-transform:uppercase;" type="text" name="edificio" id="edificio" value="{{ old('edificio') }}">
@error('edificio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('ubicacion') ? 'has-error' : '' }}">
                            <label>Ubicación: <span class="text-danger">*</span></label>
                            <input class="form-control @error('ubicacion') is-invalid @enderror" placeholder="Ej: SÓTANO 1" style="text-transform:uppercase;" type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}">
@error('ubicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Zona de Asignación:</label>
                            <input class="form-control @error('zona') is-invalid @enderror" placeholder="Ej: ZONA VIP" style="text-transform:uppercase;" type="text" name="zona" id="zona" value="{{ old('zona') }}">
@error('zona')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Capacidad: <span class="text-danger">*</span></label>
                            <input class="form-control @error('capacidad') is-invalid @enderror" min="1" type="number" name="capacidad" id="capacidad" value="{{ old('capacidad', 1) }}">
@error('capacidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                    </div>
                </div>

            </div>{{-- /.box-body --}}

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar Puesto
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
