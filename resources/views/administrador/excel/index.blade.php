@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Download Excel')
@section('cabecera', 'Download Excel')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<div class="row">
	<div class="col-xs-12 col-sm-3">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('excelconsolidado') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Consolidado General">Consolidado General</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Excell All</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-3">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('excelfiltro') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Filtrado Solicitudes">Filtrado Solicitudes</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Excell All</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-3">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('excelrequerimientos') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Atencion Requerimientos">Atencion Requerimientos</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Excell All</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-3">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('excelsolicitados') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Mas Solicitados">Mas Solicitados</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Excell All</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-3">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('directorio.siris') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Directorio Siris">Directorio Siris</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Descargar Directorio</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>

<script src="/js/jquery.js"></script>
 

@endsection