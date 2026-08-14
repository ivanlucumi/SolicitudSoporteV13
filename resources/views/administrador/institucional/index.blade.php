@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Institucional')
@section('cabecera', 'Temas institucionales del juzgado ')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
					<a href="{!! url('/administrador/institucional/create')!!}" class="btn btn-success">Crear Tema</a>
				</div>
			</div>
		</div>
            <hr>
            
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>TITUTLO</th>
				<th>FOTO</th>
				<th>DESCRIPCION</th>
				<th>TIPO</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($institucional != null)
		    @foreach($institucional as $intitu)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$intitu->iTitulo}}</th>
					<th scope="row">
						<img src="/img/{{$intitu->iFoto}}" alt="" style="width:100px;" >
					</th>
					<th scope="row" style="width: 200px;"><p>{{$intitu->iDescripcion}}</p></th>
					<th scope="row">{{$intitu->iTipo}}</th>
					<th scope="row">{{$intitu->iCreador}}</th>
					<th scope="row">{{$intitu->iModificador}}</th>
					<th>
					    <div class="row">
					      	<div class="col-xs-6">
					      		<a href="{{ route('institucional.edit', $intitu->id) }}" class="btn btn-danger fa fa-pencil"> </a>
					      	</div>
					      	<div class="col-xs-6">
					      		<!--<form action="{{ route('institucional.destroy', $intitu->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$intitu->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
					      	</div>
					    </div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.institucional.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSiete.js"></script> 

@endsection