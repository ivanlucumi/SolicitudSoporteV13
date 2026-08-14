@extends('layouts.reserva')
<!--ponerle titulo a la paginga-->
@section('title', 'Reservas Salas Juzgados')
@section('cabecera', 'Reservas Salas Juzgados')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')


       
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>JUZGADO</th>
		        <th>RADICADO</th>
		        <th>SALA</th>
				<th>DEMANDANTE</th>
				<th>DEMANDADO</th>
				<th>FECHA</th>
				<th>ESTADO</th>
				<th>HORA INICIO</th>
				<th>HORA FIN</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($reservas != null)
		    @foreach($reservas as $rsa)
		    
			<tbody data-id="{!!$rsa->id!!}" class="buscar">
				<tr class="table-light">
														
					<th scope="row">{{$rsa->ndespacho}}</th>
					
					<th scope="row">{{$rsa->rs_numero_radicado}}</th>
					
					<th scope="row">{{$rsa->sala_nombre}}</th>									
					<th scope="row">{{$rsa->rs_nombre_fiscal}}</th>
					<th scope="row">{{$rsa->rs_nombre_indiciado}}</th>									
					<th scope="row">{{$rsa->rs_fecha}}</th>
					<th scope="row">{{$rsa->rs_estado}}</th>
					<th scope="row">{{$rsa->rs_hora_inicio}}</th>
					<th scope="row">{{$rsa->rs_hora_fin}}</th>
					<th scope="row">
						<div class="row-group">
							<div class="col-xs-12 col-sm-5 btn-group">								
								<a href="{{ route('reservas-edit', $rsa->id) }}" class="btn btn-primary fa fa-pencil" title="Editar Reserva Juzgado"> </a>
							</div>
							<div class="col-xs-12 col-sm-6 btn-group">
								<!--<form action="{{ route('reservas-delete', $rsa->id) }}" method="POST">
    @csrf
    @method('DELETE')
								<button class="btn btn-danger fa fa-close" type="submit">X</button>
								</form>-->
								<a href="" data-target="#modal-delete-{{$rsa->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('reservas.modaleliminareserva')
			
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterReserva.js"></script>  
@endsection