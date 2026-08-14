@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Roles')
@section('cabecera', 'Roles Disponibles')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
            		<a href="{!! url('/administrador/rol/create')!!}" class="btn btn-warning">Crear Rol</a>            
            	</div>
			</div>
		</div>
        <hr>
            


<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>NOMBRE</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($roles != null)
		    @foreach($roles as $rol)
			<tbody class="buscar">
				<tr class="table-light">
					<th>{{$rol->rol}}</th>
					<th>
						<div class="row">
							<div class="col-md-2">
							  	<a href="{{ route('rol.edit', $rol->id) }}" class="btn btn-primary fa fa-pencil"></a>
							</div>
							<div class="col-md-2">
								<!--<form action="{{ route('rol.destroy', $rol->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-remove" type="submit">X</button>
								</form>	-->
								<a href="" data-target="#modal-delete-{{$rol->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.rol.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterUno.js"></script> 

@endsection