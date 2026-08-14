@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Galería Comite Genero')
@section('cabecera', 'Crear Galería Comite Genero')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('store-galeria') }}" method="POST" enctype="multipart/form-data">
    @csrf
		@include('administrador.comitegaleria.form')
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Guardar Galería Comite</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection