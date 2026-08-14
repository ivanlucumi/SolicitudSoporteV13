@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Roles')
@section('cabecera', 'Crear de Rol')

@section('content') 
@include('../alerts.request')
	
		<form action="{{ route('rol.store') }}" method="POST">
    @csrf
			<div class="form-group">
				<label for="Rol" class="fa fa-asterisk">Nombre Rol:</label>
				<input class="form-control @error('rol') is-invalid @enderror" placeholder="Ingresa Nombre de Rol" type="text" name="rol" id="rol" value="{{ old('rol') }}">
@error('rol')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
			</div>
			<button class="btn btn-danger" type="submit">Guardar Rol</button>
			</form>

@endsection