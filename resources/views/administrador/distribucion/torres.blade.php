@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Torres Juzgados')
@section('cabecera', 'Torres Juzgados')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<div class="container">
 			<a href="#" class="btn btn-warning elevation-5   crear_torre form-group">Crear Torre</a>
			</div>
		</div>
	</div>
	<hr>
       
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>TITULO</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($torres != null)
		    @foreach($torres as $tre)
			<tbody data-id="{!!$tre->id!!}" class="buscar">
				<tr class="table-light">
					<th scope="row">{{$tre->t_nombre}}</th>									
					<th scope="row">{{$tre->t_creador}}</th>
					<th scope="row">{{$tre->t_modificador}}</th>
					<th scope="row">
						<div class="row-group">
							<div class="col-xs-12 col-sm-6 btn-group">								
								<a href="#" class="btn btn-primary  fa fa-pencil editar_torre" title="Editar Torre Juzgado"></a>
							</div>
							<div class="col-xs-12 col-sm-6 btn-group">
								<!--<form action="{{ route('torres-delete', $tre->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$tre->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.distribucion.modaleliminartorre')
			@endforeach
		@endif
	</table>
</div>

@include('administrador.distribucion.modals.createTorre')
@include('administrador.distribucion.modals.editTorre')

<form id="form-edit-torre" action="{{ route('torres-edit',':TORRE_ID') }}" method="POST">
    @csrf
    @method('PUT')
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterTorre.js"></script> 
<script src="/js/distribucion.js"></script> 
@endsection