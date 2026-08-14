@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Elementos')
@section('cabecera', 'Elementos')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
        <div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
            		<a href="{!! url('/administrador/elementos/create')!!}" class="btn btn-warning">Crear Elemento</a>     
            	</div>
			</div>
		</div>
        <hr>				      		
            
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>CODIGO</th>
				<th>ELEMENTO</th>
				<th>CATEGORIA</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($elementos != null)
		    @foreach($elementos as $elemento)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$elemento->id}}</th>
					<th scope="row">{{$elemento->nombreElemento}}</th>
				    <th scope="row">{{$elemento->descripcioncategoria}}</th>
					<th>
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ route('elementos.edit', $elemento->id) }}" class="btn btn-primary fa fa-pencil"></a>
							</div>
							<div class="col-xs-6">
								<!--<form action="{{ route('elementos.destroy', $elemento->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$elemento->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
							</div>
						</div>
					</th>
				</tr>	                
			</tbody>
			@include('administrador.elementos.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCuatroS.js"></script> 

@endsection