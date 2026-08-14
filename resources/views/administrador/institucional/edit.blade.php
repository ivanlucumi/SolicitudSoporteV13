@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Tema Institucional')
@section('cabecera', 'Editar Tema Institucional ')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('institucional.update',$institucional->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="iTipo" class="fa fa-asterisk">Tema Institucional:</label>
					<input class="form-control @error('iTipo') is-invalid @enderror" readonly="true" type="text" name="iTipo" id="iTipo" value="{{ old('iTipo', $institucional->iTipo ?? '') }}">
@error('iTipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror		
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="Foto" class="fa fa-asterisk">Imagen Representación Tema 500x500:</label>
					<input class="form-control @error('iFoto') is-invalid @enderror" accept=".jpeg,.png,.jpg" placeholder="Fecha que estara pública informativa" type="file" name="iFoto" id="iFoto">
@error('iFoto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="iDescripcion">Descripcion Max 255.:</label>
			<textarea class="form-control @error('iDescripcion') is-invalid @enderror" placeholder="Ingrese la descripcion del valor" name="iDescripcion" id="iDescripcion">{{ old('iDescripcion', $institucional->iDescripcion ?? '') }}</textarea>
@error('iDescripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		
		<div class="form-group">
			<label for="iModificador">Persona que Modifica el Recurso:</label>
			<input class="form-control @error('iModificador') is-invalid @enderror" placeholder="Nombre quien crear el valo
			r" readonly="true" type="text" name="iModificador" id="iModificador" value="{{ old('iModificador', $institucional->iModificador ??  auth()->user()->name) }}">
@error('iModificador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Tema Institucional</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection