@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Crear Elemento')
@section('cabecera', 'Creacion de Elemento')

@section('content') 
@include('../alerts.request')

			<form action="{{ route('elementos.store') }}" method="POST">
    @csrf
					@include('administrador.elementos.form.form')
				
				<div class="row">
						<div class="col-xs-12 col-sm-6">
							<button class="btn btn-primary btn-block" type="submit">Guardar Elemento</button>
							</form>
						</div>
						<div class="col-xs-12 col-sm-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
				</div>


@endsection