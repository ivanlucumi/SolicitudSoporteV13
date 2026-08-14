@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Imagen Informativa')
@section('cabecera', 'Crear Imagen Informativa ')

@section('content') 
@include('../alerts.request')

		<form action="{{ route('especial.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="eFoto" class="fa fa-asterisk">Imagen Representacion Tema 360x350:</label>
					<input class="form-control @error('eFoto') is-invalid @enderror" accept=".jpeg,.png,.jpg" placeholder="Fecha que estara pública informativa" type="file" name="eFoto" id="eFoto">
@error('eFoto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>	
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="eTiempo">Tiempo publicación:</label>
					<input class="form-control @error('eTiempo') is-invalid @enderror" placeholder="Fecha que estara pública informativa" type="date" name="eTiempo" id="eTiempo" value="{{ old('eTiempo') }}">
@error('eTiempo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>			
		</div>

		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="eEstado" class="fa fa-asterisk">Estado Publicación:</label>
					<select class="form-control @error('eEstado') is-invalid @enderror" name="eEstado" id="eEstado">
    @foreach([
					   '1'         => 'Activo',
					   '0'         => 'Inactivo'] as $key => $value)
        <option value="{{ $key }}" @selected(old('eEstado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('eEstado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="eCreador" class="fa fa-asterisk">Persona que Modifica el Recurso:</label>
					<input class="form-control @error('eCreador') is-invalid @enderror" placeholder="Nombre quien crea la imagen del banner" readonly="true" type="text" name="eCreador" id="eCreador" value="{{ old('eCreador',  auth()->user()->name) }}">
@error('eCreador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>			
		</div>
		
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Guardar Imagen</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection