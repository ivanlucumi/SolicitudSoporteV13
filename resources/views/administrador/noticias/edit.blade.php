@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Ediatr Informacion Noticisr')
@section('cabecera', 'Editar  ')

@section('content') 
@include('../alerts.request')

		<form action="{{ route('noticias.update',$noticias->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="nNombre" class="fa fa-asterisk">Nombre de la Noticia :</label>
					<input class="form-control @error('nNombre') is-invalid @enderror" placeholder="Ingresar Nombre de la noticia" type="text" name="nNombre" id="nNombre" value="{{ old('nNombre', $noticias->nNombre ?? '') }}">
@error('nNombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="Foto">Imagen Representación Noticia 360x350::</label>
					<input class="form-control @error('nImagen') is-invalid @enderror" accept=".jpeg,.png,.jpg" placeholder="Fecha que estara pública informativa" type="file" name="nImagen" id="nImagen">
@error('nImagen')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="nDescripcion">Descripción:</label>
					<textarea class="form-control @error('nDescripcion') is-invalid @enderror" placeholder="Ingresar una breve Descripción" name="nDescripcion" id="nDescripcion">{{ old('nDescripcion', $noticias->nDescripcion ?? '') }}</textarea>
@error('nDescripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			
		</div>

		<div class="row">			
			<div class="col-xs-6">
				<div class="form-group">
					<label for="nLink">URL página:</label>
					<input class="form-control @error('nLink') is-invalid @enderror" placeholder="Ingresar url página a redireccionar ej: www.google.com" type="text" name="nLink" id="nLink" value="{{ old('nLink', $noticias->nLink ?? '') }}">
@error('nLink')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="nTiempo">Tiempo publicación:</label>
					<input class="form-control @error('nTiempo') is-invalid @enderror" placeholder="Fecha que estara púsblica la noticia" type="date" name="nTiempo" id="nTiempo" value="{{ old('nTiempo', $noticias->nTiempo ?? '') }}">
@error('nTiempo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>
		
		<div class="row">			
			<div class="col-xs-6">
				<div class="form-group">
					<label for="nEstado" class="fa fa-asterisk">Estado Publicación:</label>
					<select class="form-control @error('nEstado') is-invalid @enderror" name="nEstado" id="nEstado">
    @foreach([
					   '1'  => 'Activo',
					   '0'  => 'Inactivo'] as $key => $value)
        <option value="{{ $key }}" @selected(old('nEstado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('nEstado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="nModificador">Creador:</label>
					<input class="form-control @error('nModificador') is-invalid @enderror" placeholder="Nombre quien modifica la imagen del banner" readonly="true" type="text" name="nModificador" id="nModificador" value="{{ old('nModificador', $noticias->nModificador ??  auth()->user()->name) }}">
@error('nModificador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>			
		</div>
		
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Noticia</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection