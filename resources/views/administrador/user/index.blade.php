@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Usuarios')
@section('cabecera', 'Usuarios Disponibles')

@section('content') 

@include('../alerts.success')
@include('../alerts.request')

		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
            		<a href="{!! url('/administrador/user/create')!!}" class="btn btn-warning">Crear Usuario</a>      
            	</div>
			</div>
		</div>
        <hr>
          

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		       	<th>CEDULA</th>
				<th>NOMBRE</th>
				<th>EMAIL</th>
				<th>ROL</th>
				<th>ACCIONES</th>						     				
		    </tr>
	    </thead>
	    @if($users != null)
		    @foreach($users as $user)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$user->cedula}}</th>
					<th scope="row">{{$user->name}} {{$user->lastname}}</th>
					<th scope="row">{{$user->email}}</th>
					<th >{{$user->rol}}</th>
					<th scope="row"> 
    					<a href="{{ route('admin.reset.password', $user->id) }}" class="btn btn-warning btn-xs fa fa-key mb-2" title="reset password"></a>
    								
    				    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="editar usuario"></a>
    						  		
    				    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
    					<button class="btn btn-danger btn-xs fa fa-remove" title="eliminar usuario" type="submit">X</button>
    					</form>	
    						   		
    				
					</th>					     
				</tr>	                
			</tbody>
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCuatroSSSS.js"></script> 


@endsection

