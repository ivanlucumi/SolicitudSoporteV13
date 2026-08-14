@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Crear Usuario')
@section('cabecera', 'Creacion de Usuario')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('user.store') }}" method="POST">
    @csrf
				@include('administrador.user.form.form')

					<button class="btn btn-danger" type="submit">Guardar Usuario</button>
			</form>

@endsection