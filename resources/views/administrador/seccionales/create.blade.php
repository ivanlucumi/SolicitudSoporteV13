@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Seccionales')
@section('cabecera', 'Crear Seccional')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('seccionales.store') }}" method="POST">
    @csrf
				<div class="form-group">
					<label for="Nombre" class="fa fa-asterisk">Nombre Seccional:</label>
					<input class="form-control @error('nombreSeccional') is-invalid @enderror" placeholder="Ingresa eNivel Seccional" type="text" name="nombreSeccional" id="nombreSeccional" value="{{ old('nombreSeccional') }}">
@error('nombreSeccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>

					<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Guardar Seccional</button>
							</form>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
					</div>
			

			
	
		



@endsection