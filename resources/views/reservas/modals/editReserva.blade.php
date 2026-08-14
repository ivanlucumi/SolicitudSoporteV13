@extends('layouts.reserva')
<!--ponerle titulo a la paginga-->
@section('title', 'Modificar Reserva Sala')
@section('cabecera', 'Modificar Reserva Sala')

@section('content') 
@include('../alerts.request')
@include('../alerts.errors')
		<form action="{{ route('reservas-update',$reserva->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		@include('reservas.modals.form')

		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Reserva Sala</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection