@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Tiempo de Atención')
@section('cabecera', 'Actualizar Tiempo de Atención')

@section('content') 
@include('../alerts.request')

			<form action="{{ route('tiempoAtencion.update',$tiempos->id) }}" method="POST">
    @csrf
    @method('PUT')
				@include('administrador.tiempoAtencion.form.form')

			<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Actualizar Tiempo</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
			</div>

@endsection