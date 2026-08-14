@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Seccionales')
@section('cabecera', 'Seccional  A Editar')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('seccionales.update',$seccional->id) }}" method="POST">
    @csrf
    @method('PUT')
			<div class="form-group">
					<label for="Nombre" class="fa fa-asterisk">Nombre Seccional:</label>
					<input class="form-control @error('nombreSeccional') is-invalid @enderror" placeholder="Ingresa eNivel Seccional" type="text" name="nombreSeccional" id="nombreSeccional" value="{{ old('nombreSeccional', $seccional->nombreSeccional ?? '') }}">
@error('nombreSeccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
			</div>

			<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Actualizar Seccional</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
			</div>
			
		



@endsection