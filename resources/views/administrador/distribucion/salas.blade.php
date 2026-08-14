@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Salas Juzgados')
@section('cabecera', 'Salas Juzgados')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<div class="container">
 			<a href="#" class="btn btn-warning elevation-5   crear_salas form-group">Crear Sala</a>
			</div>
		</div>
	</div>
	<hr>
       
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>TORRE</th>
		        <th>PISO</th>
		        <th>SALA</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($salas != null)
		    @foreach($salas as $sla)
			<tbody data-id="{!!$sla->id!!}" class="buscar">
				<tr class="table-light">
					<th scope="row">{{$sla->torre}}</th>									
					<th scope="row">{{$sla->s_pisos}}</th>									
					<th scope="row">{{$sla->s_nombre}}</th>									
					<th scope="row">{{$sla->s_creador}}</th>
					<th scope="row">{{$sla->s_modificador}}</th>
					<th scope="row">
						<div class="row-group">
							<div class="col-xs-12 col-sm-6 btn-group">								
								<a href="#" class="btn btn-primary  fa fa-pencil editar_salas" title="Editar Sala Juzgado"></a>
							</div>
							<div class="col-xs-12 col-sm-6 btn-group">
								<!--<form action="{{ route('salas-delete', $sla->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$sla->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.distribucion.modaleliminarsala')
			@endforeach
		@endif
	</table>
</div>

@include('administrador.distribucion.modals.createSala')
@include('administrador.distribucion.modals.editSala')

<form id="form-edit-salas" action="{{ route('salas-edit',':SALAS_ID') }}" method="POST">
    @csrf
    @method('PUT')
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSala.js"></script> 
<script src="/js/distribucion.js"></script> 
@endsection