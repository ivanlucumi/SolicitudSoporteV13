@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Enlaces Comite Genero')
@section('cabecera', 'Editar Enlaces Comite Genero')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('update-enlaces',$comite->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		@include('administrador.comiteenlaces.form')		
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Enlaces Comite</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection