@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Historial')
@section('cabecera', 'Información Sobre una Solicitud')

@section('content') 
    <form action="{{ route('historial.show',$seguimiento[0]->id) }}" method="POST">
    @csrf

		<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center; text-transform: uppercase;"><b >RADICADO: {{$seguimiento[0]->radicado}}</b></div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Seccional</b>
		    	 	<hr class="featurette-divider">
		    	 	@foreach($seccional as $sec)
		    	 		@if($seguimiento[0]->seccional == $sec->id)
		    	 			<p style="word-wrap: break-word;height: auto;width: 100%;">{{$sec->nombreSeccional}}</p>
		    	 		@endif
		    	 	@endforeach
		    		
		    	</div>
		    	<div class="col-xs-12 col-sm-4 ">
		    		
		    		<b style="text-transform: uppercase;">Tipo de Presentación</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->presentacion}}</p>
		    	</div>
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Cargo Tecnico</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->cargo_tecnico}}</p>
		    	</div>
		    	
		    </div>
		    <br>
		    <hr class="featurette-divider">
		    <div class="row">
		    	<div class="col-xs-12 col-sm-4">
		    		<b style="text-transform: uppercase;">Despacho</b>
		    		<hr class="featurette-divider">
		    		@foreach($user as $us)
						@if($seguimiento[0]->despacho == $us->id)								
						    <p style="word-wrap: break-word;height: auto;width: 100%;">{{$us->name}}</p>	
						@endif
					@endforeach
		    	</div>
		    	<div class="col-xs-12 col-sm-4">
		    		<b style="text-transform: uppercase;">Placa</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->id_placa}}</p>
		    	</div>
		    	<div class="col-xs-12 col-sm-4">
		    		<b style="text-transform: uppercase;">Fecha Visita</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->fecha_visita}}</p>
		    	</div>
		    </div>
		    <br>
		    <hr class="featurette-divider">
		    <div class="row">
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Empleado</b>
		    		<hr class="featurette-divider">
		    		@foreach($empleado as $emp)
						@if($seguimiento[0]->idEmpleado == $emp->id)								
						    <p style="word-wrap: break-word;height: auto;width: 100%;">{{$emp->nameE}} {{$emp->lastnameE}}</p>	
						@endif
					@endforeach
				</div>
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Edificio</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->edificio}}</p>
		    	</div>
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Categoria</b>
		    		<hr class="featurette-divider">
		    		@foreach($categoria as $cat)
						@if($seguimiento[0]->idcategorias == $cat->id)								
						    <p style="word-wrap: break-word;height: auto;width: 100%;">{{$cat->	descripcioncategoria}}</p>	
						@endif
					@endforeach		    		
		    	</div>
		    </div>
		     <br>
		    <hr class="featurette-divider">
		    <div class="row">
		    	
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Elementos</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">
		    							<?php
										if ($elementos != '') {
											$elementosInve     =  explode(" ", $seguimiento[0]->elementos);
										}else{
											$elementosInve = "No hay elementos reportados";
										}
										 

										 ?>
										 @foreach($elementosInve as $inventario)
										 	@foreach($elementos as $elemento)
										 		@if($inventario == $elemento->id)
						
										       {{$elemento->nombreElemento}}<br>
										       @endif
								            @endforeach
								          @endforeach

		    		</p>
		    	</div>
		    	<div class="col-xs-12 col-sm-4">
		    		<b style="text-transform: uppercase;">Descripcion</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->descripcion}}</p>
		    	</div>
		    	<div class="col-xs-12 col-sm-4 ">
		    		<b style="text-transform: uppercase;">Tecnico</b>
		    		<hr class="featurette-divider">
		    		@foreach($user as $us)
						@if($seguimiento[0]->tecnico == $us->id)								
						    <p style="word-wrap: break-word;height: auto;width: 100%;">{{$us->name}}</p>	
						@endif
					@endforeach		    		
		    	</div>
		    </div>
		    <br>
		    <hr class="featurette-divider">
		    <div class="row">
		    	<div class="col-xs-12 col-sm-6 ">
		    		<b style="text-transform: uppercase;">Observaciones</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->observaciones}}</p>
		    	</div>
		    	
		    	<div class="col-xs-12 col-sm-6">		    		
		    		<b style="text-transform: uppercase;">Solución</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->solucion}}</p>
		    	</div>
		    </div>
		    
		   
		     <br>
		    <hr class="featurette-divider">
		    <div class="row">
		    	<div class="col-xs-12 col-sm-6 ">
		    		<b style="text-transform: uppercase;">Estado</b>
		    		<hr class="featurette-divider">
		    		<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->estado}}</p>
		    	</div>		    	
		    	<div class="col-xs-12 col-sm-6">
		    		<b style="text-transform: uppercase;">Estado Solicitud</b>
		    		<hr class="featurette-divider">
		    		@if($seguimiento[0]->estado_solicitud != '')
						<p style="word-wrap: break-word;height: auto;width: 100%;">{{$seguimiento[0]->estado_solicitud}}</p>
					@else
						<p style="word-wrap: break-word;height: auto;width: 100%;">No Asignado</p>
					@endif
		    	</div> 
		    </div>

		  </div>
		   <hr class="featurette-divider">
		  <br>
		</div>
    	
	 	
		
									

	</form>
@endsection