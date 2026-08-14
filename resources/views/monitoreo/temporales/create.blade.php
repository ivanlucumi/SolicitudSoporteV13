@extends('layouts.monitoreo.coordinador')

@section('cabecera', 'Nuevo Ingreso Temporal')

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Registrar Personal Temporal / Contratista</h3>
    </div>
    <div class="box-body">
        <form action="{{ route('cooringreso.temporales.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group @error('cedula') has-error @enderror">
                        <label>Cédula:</label>
                        <input type="number" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
                        @error('cedula') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group @error('nombre') has-error @enderror">
                        <label>Nombre Completo:</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        @error('nombre') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group @error('empresa') has-error @enderror">
                        <label>Empresa / Entidad:</label>
                        <input type="text" name="empresa" class="form-control" placeholder="Ej: PROVEEDOR, CONTRATISTA, ETC." value="{{ old('empresa') }}" required>
                        @error('empresa') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group @error('placa') has-error @enderror">
                        <label>Placa del Vehículo:</label>
                        <input type="text" name="placa" class="form-control" placeholder="ABC-123" value="{{ old('placa') }}" required>
                        @error('placa') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group @error('tipo_vehiculo') has-error @enderror">
                        <label>Tipo de Vehículo:</label>
                        <select class="form-control @error('tipo_vehiculo') is-invalid @enderror" name="tipo_vehiculo" id="tipo_vehiculo">
    @foreach(['CARRO' => 'CARRO', 'MOTO' => 'MOTO'] as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_vehiculo', old('tipo_vehiculo')) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        @error('tipo_vehiculo') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group @error('ciudad') has-error @enderror">
                        <label>Ciudad / Seccional de Acceso:</label>
                        <select class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" id="ciudad">
    <option value="">Seleccione ciudad...</option>
    @foreach($ciudades as $key => $value)
        <option value="{{ $key }}" @selected(old('ciudad', old('ciudad')) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        @error('ciudad') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group @error('fecha_inicio') has-error @enderror">
                        <label>Fecha Inicio Vigencia:</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', date('Y-m-d')) }}" required>
                        @error('fecha_inicio') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group @error('fecha_fin') has-error @enderror">
                        <label>Fecha Fin Vigencia:</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
                        @error('fecha_fin') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('cooringreso.temporales.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-success pull-right">
                    <i class="fa fa-save"></i> Guardar Registro Temporal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
