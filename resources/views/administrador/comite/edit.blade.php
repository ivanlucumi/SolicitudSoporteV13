@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Documento Comite Genero')
@section('cabecera', 'Editar Documento Comite Genero')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('update-documentos',$comite->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		@include('administrador.comite.form')		
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Documento Comite</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection