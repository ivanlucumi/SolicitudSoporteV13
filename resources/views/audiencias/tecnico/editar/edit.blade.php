@extends('layouts.tecnicos')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud Audiencia')
@section('cabecera', ' Edici&oacute;n de Solicitud ')

@section('content') 

<form action="{{ route('tecnico.audiencias.actualizar.audiencia',$solicitudAudiencia->id) }}" method="POST">
    @csrf
    @method('PUT')
@include('audiencias.tecnico.editar.formularioAudiencia')

<hr>
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