@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Requerimientos')
@section('cabecera', 'Requerimientos')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<div class="container">
            		<a href="{!! url('/administrador/requerimientos/create')!!}" class="btn btn-warning">Crear Requerimiento</a>    
            	</div>
			</div>
		</div>
        <hr>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>TIPO REQUERIMIENTO</th>	
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($tiporequerimientos != null)
		    @foreach($tiporequerimientos as $tiporequerimiento)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$tiporequerimiento->nombreRequerimiento}}</th>
					<th>
						<div class="row">
							<div class="col-xs-3">
							   <a href="{{ route('requerimientos.edit', $tiporequerimiento->id) }}" class="btn btn-primary fa fa-pencil"></a>
							</div>
							<div class="col-xs-4">
								<!--<form action="{{ route('requerimientos.destroy', $tiporequerimiento->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$tiporequerimiento->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
							</div>
						</div>
					</th>
				</tr>	                
			</tbody>
			@include('administrador.tipoRequerimiento.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterUnoS.js"></script> 


@endsection