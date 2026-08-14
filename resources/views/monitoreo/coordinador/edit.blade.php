@extends('layouts.monitoreo.coordinador')
<!--ponerle titulo a la paginga-->
@section('title', 'Editar Zona Parqueadero')

@section('cabecera', 'Editar Zona Parqueadero')

@section('content') 
@include('../alerts.request')


			<form action="{{ route('coordinador.parqueadero.updateForm',$parqueadero->id) }}" method="POST">
    @csrf
    @method('PUT')
					@include('monitoreo.coordinador.form.form')
				
					<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">EDITAR ZONA</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
						</div>
						
					</div>
					
					
			
			</form>

@endsection