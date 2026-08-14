@extends('layouts.requerimientoDespacho')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	<form action="{{ route('requerimientodespachos.update', $requerimientodespacho->id) }}" method="POST">
    @csrf
    @method('PUT')

		<div class="mb-3">
			<label for="despacho_id" class="form-label">Despacho_id</label>
			<input class="form-control @error('despacho_id') is-invalid @enderror" type="text" name="despacho_id" id="despacho_id" value="{{ old('despacho_id') }}">
@error('despacho_id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="nombre_despacho" class="form-label">Nombre_despacho</label>
			<input class="form-control @error('nombre_despacho') is-invalid @enderror" type="text" name="nombre_despacho" id="nombre_despacho" value="{{ old('nombre_despacho') }}">
@error('nombre_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="email_despacho" class="form-label">Email_despacho</label>
			<input class="form-control @error('email_despacho') is-invalid @enderror" type="text" name="email_despacho" id="email_despacho" value="{{ old('email_despacho') }}">
@error('email_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="tipo_solicitud" class="form-label">Tipo_solicitud</label>
			<input class="form-control @error('tipo_solicitud') is-invalid @enderror" type="text" name="tipo_solicitud" id="tipo_solicitud" value="{{ old('tipo_solicitud') }}">
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="observaciones" class="form-label">Observaciones</label>
			<textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="fecha_solicitud" class="form-label">Fecha_solicitud</label>
			<input type="text" name="fecha_solicitud" id="fecha_solicitud" value="{{ old('fecha_solicitud') }}" class="form-control @error('fecha_solicitud') is-invalid @enderror">
@error('fecha_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="usuario_id" class="form-label">Usuario_id</label>
			<input type="text" name="usuario_id" id="usuario_id" value="{{ old('usuario_id') }}" class="form-control @error('usuario_id') is-invalid @enderror">
@error('usuario_id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="mb-3">
			<label for="evidencia_fotografica" class="form-label">Evidencia_fotografica</label>
			<input class="form-control @error('evidencia_fotografica') is-invalid @enderror" type="text" name="evidencia_fotografica" id="evidencia_fotografica" value="{{ old('evidencia_fotografica') }}">
@error('evidencia_fotografica')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>

		<button class="btn btn-primary" type="submit">Edit</button>

	</form>
@stop
