@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Directorio')
@section('cabecera', 'Información Item Directorio Juzgado ')

@section('content') 
    <form action="{{ route('directorio.show',$directorio->id) }}" method="POST">
    @csrf

		
    	<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center; text-transform: uppercase;"><b >DESPACHO: {{$directorio->dDespacho}}</b></div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-xs-4 ">
		    		<b style="text-transform: uppercase;">Ciudad</b>
		    	 	<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$directorio->dCiudad}}</p>
		    	</div>
		    	<div class="col-xs-4 ">
		    		
		    		<b style="text-transform: uppercase;">Direccion</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$directorio->dDireccion}}</p>
		    	</div>
		    	<div class="col-xs-4">
		    		
		    		<b style="text-transform: uppercase;">Telef&oacute;no</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$directorio->dTelefono}}</p>
		    	</div>
		    </div>
		    <br>
		    <hr class="featurette-divider">
		    <div class="row">
		    	<div class="col-xs-4 ">
		    		<b style="text-transform: uppercase;">Extensi&oacute;n</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$directorio->dExtension}}</p>
		    	</div>
		    	<div class="col-xs-4 ">
		    		<b style="text-transform: uppercase;">Circuito</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$directorio->dCircuito}}</p>
		    	</div>
		    	<div class="col-xs-4">
		    		<b style="text-transform: uppercase;">Distrito</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$directorio->dDistricto}}</p>
		    	</div>
		    </div>

		  </div>
		   <hr class="featurette-divider">
		  <div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-3" >
				<a href="{{ route('directorio.edit', $directorio->id) }}" class="btn btn-danger btn-block fa fa-pencil"> Editar</a>
			</div>
			<div class="col-xs-3">
				<form action="{{ route('directorio.destroy', $directorio->id) }}" method="POST">
    @csrf
    @method('DELETE')
				<button class="btn btn-danger btn-block fa fa-close" type="submit">Eliminar</button>
				</form>	
			</div>			
			<div class="col-xs-3"></div>
			
		</div><br>
		</div>

	 	
		
									

	</form>
@endsection