@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Noticia')
@section('cabecera', 'Noticia del juzgado ')

@section('content') 
    <form action="{{ route('noticias.show',$ntcia->id) }}" method="POST">
    @csrf
	 	<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center; text-transform: uppercase;"><b >TEMA NOTICIA: {{$ntcia->nNombre}}</b></div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-xs-6 ">
		    		<b style="text-transform: uppercase;">Imagen</b>
		    		<hr class="featurette-divider">
		    		<img src="/img/{{$ntcia->nImagen}}" alt="" style="width:100%;" >
		    	</div>
		    	<div class="col-xs-6 ">
		    		<b style="text-transform: uppercase;">Descripcion</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$ntcia->nDescripcion}}</p>
		    	</div>
		    </div>
		    <br>
		    <div class="row">
		    	<div class="col-xs-4 ">
		    		<b style="text-transform: uppercase;">url a Redireccionar</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$ntcia->nLink}}</p>
		    	</div>
		    	<div class="col-xs-4 ">
		    		<b style="text-transform: uppercase;">Tiempo Publicacion</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$ntcia->nTiempo}}</p>
		    	</div>
		    	<div class="col-xs-4 ">
		    		@if($ntcia->bEstado == 1)
		    		<b style="text-transform: uppercase;">Estado</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">Activo</p>
		    		@else
		    		<b style="text-transform: uppercase;">Estado</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">Inactivo</p>
		    		@endif
		    	</div>
		    </div>
		    <hr class="featurette-divider">

		    <div class="row">
				<div class="col-xs-3"></div>
				<div class="col-xs-3">
					<a href="{{ route('noticias.edit', $ntcia->id) }}" class="btn btn-danger btn-block fa fa-pencil"> Editar</a>
				</div>
				<div class="col-xs-3">
					<!--<form action="{{ route('noticias.destroy', $ntcia->id) }}" method="POST">
    @csrf
    @method('DELETE')
					<button class="btn btn-danger btn-block fa fa-close" type="submit">Eliminar</button>
					</form>	-->
					<a href="" data-target="#modal-delete-{{$ntcia->id}}" data-toggle="modal"><button class="btn btn-danger btn-block fa fa-close"></button></a>
				</div>
				<div class="col-xs-3"></div>			
			</div>

		  </div>

		  
		</div>
	 	
		
									

	</form>
	@include('administrador.noticias.modaleliminar')
@endsection