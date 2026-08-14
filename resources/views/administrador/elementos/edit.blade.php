@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Elementos')
@section('cabecera', 'Ediar Elemento')

@section('content') 
@include('../alerts.request')

			<form action="{{ route('elementos.update',$elemento->id) }}" method="POST">
    @csrf
    @method('PUT')
				@include('administrador.elementos.form.form')
				
			<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Actualizar Elemento</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
			</div>

@endsection