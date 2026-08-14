@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Noticias')
@section('cabecera', 'Noticias Importantes')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
					<a href="{!! url('/administrador/noticias/create')!!}" class="btn btn-warning">Crear Noticia</a>
				</div>
			</div>
		</div>
        <hr>


<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>NOMBRE</th>
				<th>IMAGEN</th>
				<th>ESTADO</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($noticias != null)
		    @foreach($noticias as $ntcia)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$ntcia->nNombre}}</th>
					<th scope="row">
						<img src="/img/{{$ntcia->nImagen}}" alt="" style="width:100px;" >
					</th>									
					@if($ntcia->nEstado == 1)
					  	<th scope="row">Activo</th>
					@else
						<th scope="row">Inactivo</th>									  
					@endif							
					<th scope="row">{{$ntcia->nCreador}}</th>
					<th scope="row">{{$ntcia->nModificador}}</th>
					<th scope="row">
					    <div class="row">
					      	<div class="col-xs-4">
					      		<a href="{{ route('noticias.edit', $ntcia->id) }}" class="btn btn-primary fa fa-pencil"> </a><br>
					      	</div>
					      	<div class="col-xs-4">
					      		<a href="{{ route('noticias.show', $ntcia->id) }}" class="btn btn-primary fa fa-eye"></a>
					      	</div>
					      	<div class="col-xs-4">
					      		<!--<form action="{{ route('noticias.destroy', $ntcia->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-pencil" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$ntcia->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
					      	</div>
					    </div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.noticias.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCincoS.js"></script> 

@endsection