@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Enlaces Comite Genero')
@section('cabecera', 'Crear Enlaces Comite Genero')

@section('content') 
@include('../alerts.request')
		<form enctype="multipart/form-data" action="{{ route('store-enlaces') }}" method="POST">
    @csrf
		@include('administrador.comiteenlaces.form')
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Guardar Enlace Comite</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection