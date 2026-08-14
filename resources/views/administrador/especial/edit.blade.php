@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Imagen Informativa')
@section('cabecera', 'Editar Imagen Informativa')

@section('content') 
@include('../alerts.request')

		<form action="{{ route('especial.update',$especial->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="eFoto">Imagen Representacion Tema 360x350:</label>
					<input class="form-control @error('eFoto') is-invalid @enderror" accept=".jpeg,.png,.jpg" placeholder="Fecha que estara pública informativa" type="file" name="eFoto" id="eFoto">
@error('eFoto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>	
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="eTiempo">Tiempo publicación:</label>
					<input class="form-control @error('eTiempo') is-invalid @enderror" placeholder="Fecha que estara pública informativa" type="date" name="eTiempo" id="eTiempo" value="{{ old('eTiempo', $especial->eTiempo ?? '') }}">
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
					<label for="eModificador">Persona que Crea el Recurso:</label>
					<input class="form-control @error('eModificador') is-invalid @enderror" placeholder="Nombre quien crea la imagen del banner" readonly="true" type="text" name="eModificador" id="eModificador" value="{{ old('eModificador', $especial->eModificador ??  auth()->user()->name) }}">
@error('eModificador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>			
		</div>
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Informacion</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection