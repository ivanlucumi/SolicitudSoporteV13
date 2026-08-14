@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Roles')
@section('cabecera', 'Rol A Editar')

@section('content') 
@include('../alerts.request')
<form action="{{ route('rol.update',$rol->id) }}" method="POST">
    @csrf
    @method('PUT')
		<div class="form-group">
			<label for="Nombre Rol" class="fa fa-asterisk">Nombre Rol: </label>
			<input class="form-control @error('rol') is-invalid @enderror" placeholder="Ingresa el Nombre del Rol" type="text" name="rol" id="rol" value="{{ old('rol', $rol->rol ?? '') }}">
@error('rol')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
		</div>

				
		<button class="btn btn-danger" type="submit">Actualizar Rol</button>
	</form>


@endsection