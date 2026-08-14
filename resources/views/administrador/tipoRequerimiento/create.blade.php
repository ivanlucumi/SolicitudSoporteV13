@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Crear Requerimiento')
@section('cabecera', 'Creacion de Requerimiento')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('requerimientos.store') }}" method="POST">
    @csrf
				<div class="form-group">
					<label for="Nomre Requerimiento" class="fa fa-asterisk">Nombre Requerimiento:</label>
					<input class="form-control @error('nombreRequerimiento') is-invalid @enderror" placeholder="Ingresa Nombre de Requerimiento" type="text" name="nombreRequerimiento" id="nombreRequerimiento" value="{{ old('nombreRequerimiento') }}">
@error('nombreRequerimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
					
				<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Guardar Requerimiento</button>
							</form>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
					</div>



@endsection