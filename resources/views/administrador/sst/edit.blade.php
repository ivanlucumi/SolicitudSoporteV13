@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Seguridad y salud en el Trabajo')
@section('cabecera', 'Editar Seguridad y salud en el Trabajo')

@section('content') 
@include('../alerts.request')
		<form action="{{ route('sst-update-documentos',$sst->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		@include('administrador.sst.form')		
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Documento SST</button>
				</form>
			</div>
			<div class="col-xs-6">
				<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
				</form>
			</div>
		</div>
@endsection