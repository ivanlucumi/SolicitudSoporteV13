@extends('layouts.tecnicos')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud Audiencia')
@section('cabecera', ' Edici&oacute;n de Solicitud ')

@section('content') 

<form action="{{ route('tecnico.actualizar.audiencia.agendada',$solicitudAudiencia->id) }}" method="POST">
    @csrf
    @method('PUT')
@include('audiencias.tecnico.formularioAudiencia')

<hr>
<div class="row">
		<div class="col-xs-6">
			<button class="btn btn-primary btn-block" type="submit">Corregir Agendamiento</button>
		</div>
		<div class="col-xs-6">
		  <a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
		</div>
						
</div>

</form>


@endsection