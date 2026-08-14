@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Reservas Salas Audiencias')
@section('cabecera', 'VERIFICAR RESERVA SALAS ')

@section('content')
@include('../alerts.success')
@include('../alerts.request')


<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>		        
		        <th>RADICACION</th>
		        <th>SALA</th>
		        <th>TORRE PISO</th>
				<th>DEMANDANTE O FISCALLIA</th>
				<th>DEMANDADO O INDICIADO</th>	
				<th>FECHA</th>	
				<th>HORA FIN</th>	
		    </tr>
	    </thead>
	    @if($eventos != null)
		    @foreach($eventos as $evento)
			<tbody class="buscar">
				<tr class="table-light">					  
					<th scope="row">{{$evento->radicacion}}</th>
					<th scope="row">{{strtoupper($evento->sala->sala_nombre)}}</th>
					<th scope="row">{{$evento->sala->ubicacion->ubicacion_nombre}}</th>
					<th scope="row">{{$evento->nombre_fiscal}}</th>
					<th scope="row">{{strtoupper($evento->nombre_indiciado)}}</th>
					<th scope="row">{{$evento->fecha_inicio}}</th>
					<th scope="row">{{$evento->hora_inicio}} a {{$evento->hora_fin}}</th>
				</tr>
				
			</tbody>
			@endforeach
		@endif
	</table>
	
</div>
@push('scripts')

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>

<script src="/js/FilterSieteRS.js"></script>       


  
   @endpush


<!-- Llamar a los complementos javascript-->


@endsection



