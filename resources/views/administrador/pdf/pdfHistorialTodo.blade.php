@extends('layouts.pdf')

<!--ponerle titulo a la paginga-->
@section('title', 'Historial de Seguimientos')
 
<!--aqui se pone todo el contenido de la pagina <body> -->
@section('content')   

    <table>
    	<caption>Datos Historiales Seguimiento</caption>
		<thead>
			<tr>
				<th>Radicado</th>
				
				<th>Seccional</th>
				
				<th>Tipo de Presentaci¨®n</th>
				
				<th>Cargo Tecnico</th>
				
				<th>Despacho</th>

				<th>Placa</th>

				<th>Fecha Visita</th>
				
				<th>Empleado</th>
				
				<th>Edificio</th>
				
				<th>Categoria</th>
				
				<th>Elementos</th>

				<th>Descripcion</th>

				<th>Tecnico</th>
				
				<th>Observaciones</th>

				<th>Soluci¨®n</th>
				
				<th>Estado</th>

				<th>Estado Solicitud</th>
				
			</tr>
		</thead>
		@foreach($seguimiento as $dp)
		<tbody>
			<tr>	
				
				<td>{{$dp->radicado}}</td>
				
				<td style="word-wrap: break-word;height: auto;width: 100%;">
					@foreach($seccional as $sec)
		    	 		@if($dp->seccional == $sec->id)		    	 			
		    	 			{{$sec->nombreSeccional}}
		    	 		@endif
		    	 	@endforeach
		    	</td>
				
				<td>{{$dp->presentacion}}</td>

				<td>{{$dp->cargo_tecnico}}</td>
					
				<td style="word-wrap: break-word;height: auto;width: 100%;">
					@foreach($user as $us)
						@if($dp->despacho == $us->id)								
						    {{$us->name}}
						@endif
					@endforeach
				</td>

				<td>{{$dp->id_placa}}</td>

				<td>{{$dp->fecha_visita}}</td>
				
				<td style="word-wrap: break-word;height: auto;width: 100%;">
					@foreach($empleado as $emp)
						@if($dp->idEmpleado == $emp->id)								
						    {{$emp->nameE}} {{$emp->lastnameE}}
						@endif
					@endforeach
				</td>
				
				<td>{{$dp->edificio}}</td>

				<td>
					@foreach($categoria as $cat)
						@if($dp->idcategorias == $cat->id)								
						    {{$cat->descripcioncategoria}}
						@endif
					@endforeach
				</td>
					
				<td>
					<?php
						if ($elementos != '') {
							$elementosInve     =  explode(" ", $dp->elementos);
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
				</td>

				<td style="word-wrap: break-word;height: auto;width: 100%;">{{$dp->descripcion}}</td>

				<td style="word-wrap: break-word;height: auto;width: 100%;">
					@foreach($user as $us)
						@if($dp->tecnico == $us->id)								
						   {{$us->name}}	
						@endif
					@endforeach
				</td>
				
				<td style="word-wrap: break-word;height: auto;width: 100%;">{{$dp->observaciones}}</td>
				
				<td style="word-wrap: break-word;height: auto;width: 100%;">{{$dp->solucion}}</td>

				<td>{{$dp->estado}}</td>
					
				<td>
					@if($dp->estado_solicitud != '')
						{{$dp->estado_solicitud}}
					@else
						No Asignado
					@endif
				</td>
				
			</tr>			
		</tbody>
		@endforeach
	</table>   
@endsection