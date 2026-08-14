@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Documentos Comite Genero')
@section('cabecera', 'Crear Documentos Comite Genero')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('store-documentos') }}" method="POST" enctype="multipart/form-data">
    @csrf
		@include('administrador.comite.form')
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Guardar Documento Comite</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection