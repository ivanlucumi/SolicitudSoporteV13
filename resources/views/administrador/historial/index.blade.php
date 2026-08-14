@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Historial')
@section('cabecera', 'Listado de Seguimientos')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3>Ingrese las fechas en las que desea buscar los registros</h3>
				<form action="{{ route('historial.store') }}" method="POST">
    @csrf
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<input class="form-control @error('fechaInicio') is-invalid @enderror" placeholder="Fecha" type="date" name="fechaInicio" id="fechaInicio" value="{{ old('fechaInicio') }}">
@error('fechaInicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<input class="form-control @error('fechaFin') is-invalid @enderror" placeholder="Fecha" type="date" name="fechaFin" id="fechaFin" value="{{ old('fechaFin') }}">
@error('fechaFin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
						<button class="btn btn-warning btn-block" type="submit">Download PDF</button>
						</form>
						</div>
					</div>
			</div>
		</div>
		<hr>
		
           

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
				<th>RADICADO</th>
				<th>DESPACHO</th>
				<th>ELEMENTO</th>
				<th>TECNICO</th>
				<th>FECHA VISITA</th>
				<th>ESTADO</th>
				<th>ACCIÓN</th>					     				
		    </tr>
	    </thead>
	    @if($seguimiento != null)
		    @foreach($seguimiento as $seg)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$seg->radicado}}</th>	
					    @foreach($user as $us)
					       	@if($seg->despacho == $us->id)								
					       		<th scope="row" style="word-wrap: break-word;height: auto;width: 200px;">{{$us->name}}</th>	
					       	@endif
					    @endforeach
					<th scope="row">
						<?php
							if ($elementos != '') {
								$elementosInve     =  explode(" ", $seg->elementos);
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
					</th>
						@foreach($user as $us)
					       	@if($seg->tecnico == $us->id)								
					       		<th scope="row" >{{$us->name}}</th>	
					       	@endif
					    @endforeach
					<th scope="row">{{$seg->fecha_visita}}</th>
					@if($seg->estado_solicitud != '')
						<th scope="row">{{$seg->estado_solicitud}}</th>
					@else
						<th scope="row">No Asignado</th>
					@endif
					<th scope="row">
					    <div >									      	
					    	<a href="{{ route('historial.show', $seg->id) }}" class="btn btn-primary fa fa-eye"></a>
					    </div>
					</th>					     
				</tr>	                
			</tbody>
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSieteSSS.js"></script> 


@endsection