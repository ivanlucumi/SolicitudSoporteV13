@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Banner ')
@section('cabecera', 'Imagenes Banner Principal')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<div class="container">
				<a href="{!! url('/administrador/banner/create')!!}" class="btn btn-warning">Crear Imangen Banner</a>
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
				<th>URL</th>
				<th>CREADO</th>
				<th>TIEMPO</th>
				<th>ESTADO</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($banner != null)
		    @foreach($banner as $bnnr)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$bnnr->bNombre}}</th>
					<th scope="row">
						<img src="/img/{{$bnnr->bFoto}}" alt="" style="width:100px;" loading="lazy">
					</th>									
					<th scope="row" ><div style="word-wrap: break-word;height: auto;width: 90px;">{{$bnnr->bLink}}</div></th>
					<th scope="row" ><div style="word-wrap: break-word;height: auto;width: 90px;">{{$bnnr->created_at}}</div></th>
					<th scope="row">{{$bnnr->bTiempo}}</th>
					@if($bnnr->bEstado == 1)
						<th scope="row">Activo</th>
					@else
						<th scope="row">Inactivo</th>									  
					@endif								
					<th scope="row">{{$bnnr->bCreador}}</th>
					<th scope="row">{{$bnnr->bModificador}}</th>
					<td scope="row">
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ route('banner.edit', $bnnr->id) }}" class="btn btn-primary fa fa-pencil"> </a>
							</div>
							<div class="col-xs-6">
								<!--<form action="{{ route('banner.destroy', $bnnr->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$bnnr->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</td>					     
				</tr>	                
			</tbody>
			@include('administrador.banner.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterOcho.js"></script> 
@endsection