@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Editar Categorias')
@section('cabecera', 'Categorias A Editar')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('categorias.update',$categoria->id) }}" method="POST">
    @csrf
    @method('PUT')
			<div class="row">
					<div class="form-group col-xs-12 col-md-6">
						<label for="Nombre Categoria" class="fa fa-asterisk">Nombre Categoria:</label>
						<input class="form-control @error('descripcioncategoria') is-invalid @enderror" placeholder="Ingresa Nombre " type="text" name="descripcioncategoria" id="descripcioncategoria" value="{{ old('descripcioncategoria', $categoria->descripcioncategoria ?? '') }}">
@error('descripcioncategoria')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
					</div>
				
					<div class="form-group col-xs-12 col-md-6">
					<label for="prioridad" class="fa fa-asterisk">Seleccione Tiempo atenci&oacute;n:</label><br>
					<select name="prioridad" id="prioridad" class="@error('prioridad') is-invalid @enderror">
    @foreach($tiempos as $key => $value)
        <option value="{{ $key }}" @selected(old('prioridad', ['class'=>'form-control','required']) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('prioridad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					</div>
			</div>
					
						
			<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Actualizar Categoria</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
							</form>
						</div>
						
			</div>


@endsection