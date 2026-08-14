@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Tiempos de Atención')
@section('cabecera', 'Tiempos de Atenciones')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				 <div class="container">
            		<a href="{!! url('/administrador/tiempoAtencion/create')!!}" class="btn btn-warning">Crear Tiempo de atensi&oacute;n</a>      
            	</div>
			</div>
		</div>
        <hr>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		       <th>PRIORIDAD</th>
				<th>DIA MAXIMO DE ATENSI&Oacute;N</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($tiempoAtencion != null)
		    @foreach($tiempoAtencion as $tiempo)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$tiempo->prioridad}}</th>
					<th scope="row">{{$tiempo->maximoD}}</th>
					<td>
					   	<div class="row">
					   		<div class="col-md-6">
					   			<a href="{{ route('tiempoAtencion.edit', $tiempo->id) }}" class="btn btn-primary fa fa-pencil"></a>
					   		</div>
					   		<div class="col-md-6">
					   			<!--<form action="{{ route('tiempoAtencion.destroy', $tiempo->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$tiempo->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
					   		</div>
					   	</div>
					</td>
				</tr>	                
			</tbody>
			@include('administrador.tiempoAtencion.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterDos.js"></script>  


@endsection