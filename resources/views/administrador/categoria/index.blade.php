@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Categorias')
@section('cabecera', 'Categorias Inscritas ')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
            		<a href="{!! url('/administrador/categorias/create')!!}" class="btn btn-warning">Crear Categoria</a>     
            	</div>
			</div>
		</div>
        <hr>


<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>NOMBRE CATEGORIA</th>
				<th>PRIORIDAD</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($categorias != null)
		    @foreach($categorias as $categoria)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$categoria->descripcioncategoria}}</th>
					<th scope="row">{{$categoria->prioridad}}</th>
					<td>
					   	<div class="row">
					  		<div class="col-xs-3">
					   			<a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary fa fa-pencil"></a>
					   		</div>
					   		<div class="col-xs-6">
					   			<!--<form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$categoria->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
					   		</div>
					   	</div>
					</td>
				</tr>	                
			</tbody>
			@include('administrador.categoria.modaleliminar')			
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterDosS.js"></script> 

@endsection