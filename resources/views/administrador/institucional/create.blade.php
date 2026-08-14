@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Crear Informacion Institucional')
@section('cabecera', 'Creacion de ')

@section('content') 

@include('../alerts.request')
		<form action="{{ route('institucional.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="iTipo" class="fa fa-asterisk">Tema Institucional :</label>
					<select class="form-control @error('iTipo') is-invalid @enderror" name="iTipo" id="iTipo">
    <option value="">Seleccione el tema institucional</option>
    @foreach([
					   'Vision'       => 'Vision',
					   'Mision'       => 'Mision'] as $key => $value)
        <option value="{{ $key }}" @selected(old('iTipo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('iTipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror		
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="Foto *" class="fa fa-asterisk">Imagen Representacion Tema 500x500:</label>
					<input class="form-control @error('iFoto') is-invalid @enderror" accept=".jpeg,.png,.jpg" placeholder="Fecha que estara pública informativa" type="file" name="iFoto" id="iFoto">
@error('iFoto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>
				
		<div class="form-group">
			<label for="iDescripcion" class="fa fa-asterisk">Descripcion Max 255.:</label>
			<textarea class="form-control @error('iDescripcion') is-invalid @enderror" placeholder="Ingrese la descripcion del valor" name="iDescripcion" id="iDescripcion">{{ old('iDescripcion') }}</textarea>
@error('iDescripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		
		<div class="form-group">
			<label for="iCreador" class="fa fa-asterisk">Persona que Crea el Recurso:</label>
			<input class="form-control @error('iCreador') is-invalid @enderror" placeholder="Nombre quien crear el valor" readonly="true" type="text" name="iCreador" id="iCreador" value="{{ old('iCreador',  auth()->user()->name) }}">
@error('iCreador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Guardar Tema Institucional</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection