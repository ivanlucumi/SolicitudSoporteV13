@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Contactenos')

@section('content') 


<link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">

<script src="adminlte/plugins/iCheck/icheck.min.js"></script>


@include('alerts.success')

	
		
			<form action="{{ route('contactame') }}" method="POST">
    @csrf
		<div class="row">
			<div class="col-xs-12 col-sm-3"></div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-success"  style="border-style: ridge; border-width: 4px; " >
				<div class="panel-heading" style="background-color: #004182; color: #fff;">Dejenos saber su inquietud u opinión</div>
				<div class="panel-body">
					<div class="form-group has-feedback">
				    <label for="nombre">Nombre</label>
				    <input class="form-control imput-sm @error('nombre') is-invalid @enderror" style="border: 1px dotted #999;
  							border-radius: 0; -webkit-appearance: searchfield" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				    <span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>

					<div class="form-group has-feedback">
					    <label for="email">Correo Electronico</label>
					    <input class="form-control @error('email') is-invalid @enderror" style="border: 1px dotted #999;
  							border-radius: 0; -webkit-appearance: searchfield" type="text" name="email" id="email" value="{{ old('email') }}">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>

					<div class="form-group has-feedback">
					    <label for="asunto">Asunto</label>
					    <input class="form-control @error('asunto') is-invalid @enderror" style="border: 1px dotted #999;
  							border-radius: 0; -webkit-appearance: searchfield" type="text" name="asunto" id="asunto" value="{{ old('asunto') }}">
@error('asunto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					    <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
					</div>

					<div class="form-group has-feedback">
						<label for="msg">Mensaje</label>
					    <textarea class="form-control @error('msg') is-invalid @enderror" style="border: 1px dotted #999;
  							border-radius: 0; -webkit-appearance: searchfield" name="msg" id="msg">{{ old('msg') }}</textarea>
@error('msg')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					</div>
					<input type="hidden" name="contacto" id="contacto" value="{{ old('contacto') }}" class="@error('contacto') is-invalid @enderror">
@error('contacto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					<button class="btn btn-block" style="background-color: #004182; color: #fff;" type="submit">Enviar Mensaje</button>
					</form>
				</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3"></div>
		</div>
  	<br>

@endsection