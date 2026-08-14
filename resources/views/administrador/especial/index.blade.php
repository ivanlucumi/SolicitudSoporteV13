@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Imagen Informativa ')
@section('cabecera', 'Imagenes Informativas ')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
<div class="row">
			<div class="col-xs-12 col-sm-3">
				<div class="container">
					<a href="{!! url('/administrador/especial/create')!!}" class="btn btn-warning">Crear Imangen Informativa</a>
				</div>
			</div>
			
		</div>
        <hr>
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>IMAGEN</th>						      
				<th>TIEMPO</th>
				<th>ESTADO</th>						      
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($especial != null)
		    @foreach($especial as $espl)
			<tbody class="buscar">
				<tr class="table-light">						           
					<th scope="row">
						<img src="/img/{{$espl->eFoto}}" alt="" style="width:100px;" >
					</th>									
					<th scope="row">{{$espl->eTiempo}}</th>
					@if($espl->eEstado == 1)
						<th scope="row">Activo</th>
					@else
						<th scope="row">Inactivo</th>									  
					@endif																
					<th scope="row">{{$espl->eCreador}}</th>
					<th scope="row">{{$espl->eModificador}}</th>
					<td>
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ route('especial.edit', $espl->id) }}" class="btn btn-primary fa fa-pencil"> </a>
							</div>
							<div class="col-xs-6">
							  	<!--<form action="{{ route('especial.destroy', $espl->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$espl->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</td>					     
				</tr>	                
			</tbody>
			@include('administrador.especial.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSeis.js"></script> 

@endsection