@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Galeria Comite Genero')
@section('cabecera', 'Editar Galeria Comite Genero')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('update-galeria',$comite->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		@include('administrador.comitegaleria.form')
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cggEstado" class="fa fa-asterisk">Estado Galería :</label>
					<select class="form-control @error('cggEstado') is-invalid @enderror" name="cggEstado" id="cggEstado">
    <option value="">Seleccione estado de la imagen en la galería</option>
    @foreach([
					   '1'       => 'Activo',
					   '0'       => 'Inactivo'] as $key => $value)
        <option value="{{ $key }}" @selected(old('cggEstado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('cggEstado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror		
				</div>
			</div>
		</div>		
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Imagen Galeria</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection