@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'TELETRABAJO')

@section('cabecera', 'TELETRABAJO 2024')

@section('content') 
@include('alerts.flash-message')
                @include('../alerts.success')
                @include('../alerts.request')
<center><h3><strong>SOLICITUDES AUTORIZADAS DE TELETRABAJO 2024 </strong></h3></center>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>ID DESPACHO</th>
		        <th>DESPACHO</th>
		        <th>IDENTIFICACION</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>DIAS TELETRABAJO</th>
				<th>FECHA FORMALIZACION</th>
				<th>ACCIONES</th>
				
		    </tr>
	    </thead>
	    
	    @if($resultado != null)
		    @foreach($resultado as $key =>$dirto)
		    
			<tbody class="buscar">
			    
				<tr class="table-light">
				    
					<th scope="row"> {{$dirto->codigo_despacho}}</th>
					<th scope="row"> {{$dirto->despacho}}</th>
					<th scope="row"> {{$dirto->identificacion}}</th>									
					<th scope="row">{{$dirto->nombre_servidor}}</th>
					<th scope="row">{{$dirto->cargo}}</th>
					<th scope="row">{{$dirto->dias_teletrabajo}}</th>
					<th scope="row">{{$dirto->fecha_formalizacion}}</th>
					<th scope="row">
					    <center>
								<a href="{{ route('admin.teletrabajo.EditarTeletrabajo', $dirto->id) }}" class="btn btn-warning btn-block fa fa-pencil"></a>
						</center>
					</th>
					
        			
    				
									     
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
<script src="/js/Seguimiento.js"></script>  


@endsection