@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Cuidades')
@section('cabecera', 'Cuidades Inscritas ')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')


<div class="row">
			<div class="col-xs-12 col-sm-2">
				 <div class="container">
            		<a href="{!! url('/administrador/ciudad/create')!!}" class="btn btn-warning">Crear Ciudades</a>      
            	</div>
			</div>
			
		</div>
            <hr>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>CODIGO</th>
				<th>NOMBRE</th>
				<th>ACCIONES</th>						     				
		    </tr>
	    </thead>
	    @if($ciudades != null)
		    @foreach($ciudades as $ciudad)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$ciudad->codigoCiudad}}</th>
					<th scope="row">{{$ciudad->nombreCiudad}}</th>
					<th>
					   	<div class="row">
					   		<div class="col-md-6">
					   			<a href="{{ route('ciudad.edit', $ciudad->codigoCiudad) }}" class="btn btn-primary fa fa-pencil"></a>
					   		</div>
					   		<div class="col-md-6">
					   			<!--
									<form action="{{ route('ciudad.destroy', $ciudad->codigoCiudad) }}" method="POST">
    @csrf
    @method('DELETE')
									<button class="btn btn-danger fa fa-close" type="submit">X</button>
									</form>
					   			 -->
								<a href="" data-target="#modal-delete-{{$ciudad->codigoCiudad}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
					   		</div>
					   	</div>
					</th>
				</tr>	                
			</tbody>
			@include('administrador.ciudad.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterDosS.js"></script> 

@endsection