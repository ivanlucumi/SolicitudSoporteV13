@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Crear Categor&iacute;a')
@section('cabecera', 'Creaci&oacute;n de Categor&iacute;a')

@section('content') 
@include('../alerts.request')

			<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
				@include('administrador.categoria.form.form')
									
			<div class="row">
						<div class="col-xs-12 col-md-6">
							<button class="btn btn-primary btn-block" type="submit">Guardar Categor&iacute;a </button>
							</form>
						</div>
						<div class="col-xs-12 col-md-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
			</div>



@endsection