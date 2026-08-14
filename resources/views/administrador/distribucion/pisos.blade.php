@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Pisos Juzgados')
@section('cabecera', 'Pisos Juzgados')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<div class="container">
 			<a href="#" class="btn btn-warning elevation-5   crear_pisos form-group">Crear Piso</a>
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
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($pisos != null)
		    @foreach($pisos as $pso)
			<tbody data-id="{!!$pso->id!!}" class="buscar">
				<tr class="table-light">
					<th scope="row">{{$pso->p_torre}}</th>									
					<th scope="row">{{$pso->p_nombre}}</th>									
					<th scope="row">{{$pso->p_creador}}</th>
					<th scope="row">{{$pso->p_modificador}}</th>
					<th scope="row">
						<div class="row-group">
							<div class="col-xs-12 col-sm-6 btn-group">								
								<a href="#" class="btn btn-primary  fa fa-pencil editar_pisos" title="Editar Piso Juzgado"></a>
							</div>
							<div class="col-xs-12 col-sm-6 btn-group">
								<!--<form action="{{ route('pisos-delete', $pso->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$pso->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.distribucion.modaleliminarpiso')
			@endforeach
		@endif
	</table>
</div>

@include('administrador.distribucion.modals.createPiso')
@include('administrador.distribucion.modals.editPiso')

<form id="form-edit-pisos" action="{{ route('pisos-edit',':PISOS_ID') }}" method="POST">
    @csrf
    @method('PUT')
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterPiso.js"></script> 
<script src="/js/distribucion.js"></script> 
@endsection