@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Prograci&oacute;n Audiencias Torre B')

@section('content') 
@include('/alerts.success')
@include('/alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<form action="{{ route('programacion_torre_b') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<input class="form-control @error('fecha') is-invalid @enderror" placeholder="Fecha Buscar" type="date" name="fecha" id="fecha" value="{{ old('fecha') }}">
@error('fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
					<button class="btn btn-warning btn-block" style="background-color: #004182" type="submit">Buscar Audiencia B</button>
					</form>
					</div>
					<div class="col-xs-12 col-sm-4">
					<form action="{{ route('programacion_torre_a') }}" method="POST">
    @csrf	
					<button class="btn btn-warning btn-block" style="background-color: #807E7E" type="submit">Ir a Torre A</button>
					</form>
					</div>
				</div>
			</div>
		</div>
		<hr>
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>FECHA</th>
		        <th>JUZGADO</th>
		        <th># RADICADO</th>
				<th>TORRE</th>
				<th>PISO</th>
				<th>SALA</th>
				<th>DEMANDANTE</th>
				<th>DEMANDADO</th>
				<th>HORA INICIO</th>					     
				<th>HORA FINALIZACI&Oacute;N</th>		     
		    </tr>
	    </thead>
	    @if($reservas != null)
		    @foreach($reservas as $rsv)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row"> {{$rsv->rs_fecha}}</th>									
					<th scope="row">{{$rsv->ndespacho}}</th>
					<th scope="row">{{$rsv->rs_numero_radicado}}</th>
					<th scope="row">{{$rsv->torre}}</th>
					<th scope="row">{{$rsv->piso}}</th>									
					<th scope="row">{{$rsv->sala}}</th>									
					<th scope="row">{{$rsv->rs_nombre_fiscal}}</th>
					<th scope="row">{{$rsv->rs_nombre_indiciado}}</th>					
					<th scope="row">{{$rsv->rs_hora_inicio}}</th>					
					<th scope="row">{{$rsv->rs_hora_fin}}</th>				     
				</tr>	                
			</tbody>
			@endforeach
		@else
		<tr class="table-light">
			<p class="lead">Actualmente esta secion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
		</tr>
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/reservasi.js"></script>  

@endsection