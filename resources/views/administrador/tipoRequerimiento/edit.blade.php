@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Editar Requeriientos')
@section('cabecera', 'Requeriientos A Editar')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('requerimientos.update',$requerimiento->id) }}" method="POST">
    @csrf
    @method('PUT')
				<div class="form-group">
					<label for="Requeriientos" class="fa fa-asterisk">Nombre Requerimientos: </label>
					<input class="form-control @error('nombreRequerimiento') is-invalid @enderror" placeholder="Ingresa Nombre Requerimiento" type="text" name="nombreRequerimiento" id="nombreRequerimiento" value="{{ old('nombreRequerimiento', $requerimiento->nombreRequerimiento ?? '') }}">
@error('nombreRequerimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
										
				<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Actualizar Requerimiento</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
			</div>
	


@endsection