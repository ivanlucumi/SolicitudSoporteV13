@extends('layouts.monitoreo.coordinador')
<!--ponerle titulo a la paginga-->
@section('title', 'Crear Zona Parqueo')
@section('cabecera', 'Creacion Zona Parqueo')

@section('content') 
@include('../alerts.request')
			<form action="{{ route('coordinador.parqueadero.saveForm') }}" method="POST">
    @csrf
			<input class="form-control" placeholder="Ingrese Especialidad" required="required" autocomplete="off" type="hidden" name="ocupado" id="ocupado" value="{{ 'LIBRE' }}">	
    			
					
				@include('monitoreo.coordinador.form.form')

					<button class="btn btn-danger" type="submit">CREAR ZONA</button>
			</form>

@endsection