@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Editar Usuario')

@section('cabecera', 'Editar Información Usuario')

@section('content') 
@include('../alerts.request')


			<form action="{{ route('user.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
				@include('administrador.user.form.form')
				 <div class="form-group">
					<label for="estado" class="fa fa-asterisk">Estado Certificacion</label><br>
					<select class="form-control @error('certifico_personal') is-invalid @enderror" name="certifico_personal" id="certifico_personal">
    <option value="">Estado Certificacion</option>
    @foreach($certificoP as $key => $value)
        <option value="{{ $key }}" @selected(old('certifico_personal', $user->certifico_personal ?? '') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('certifico_personal')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
						
				</div>
					<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Guardar Usuario</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
						</div>
						
					</div>
					
					
			
			</form>

@endsection