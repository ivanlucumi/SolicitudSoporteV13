@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Seccionales')
@section('cabecera', 'Seccionales')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
            		<a href="{!! url('/administrador/seccionales/create')!!}" class="btn btn-warning">Crear Seccionales</a>      
            	</div>
			</div>
		</div>
        <hr>

 			
           

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th style="width: 70%;">NOMBRE</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($seccionales != null)
		    @foreach($seccionales as $seccional)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$seccional->nombreSeccional}}</th>
					<th>
					   	<div class="row">
					   		<div class="col-md-6">
					   			<a href="{{ route('seccionales.edit', $seccional->id) }}" class="btn btn-primary fa fa-pencil"> </a>
					   		</div>
					   		<div class="col-md-6">
					   			<!--<form action="{{ route('seccionales.destroy', $seccional->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit"> X </button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$seccional->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.seccionales.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterUno.js"></script> 


@endsection