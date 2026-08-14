@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Resultado Encuesta Digitalizaci&oacute;n')
@section('cabecera', 'Usuarios que Respondieron Encuesta Digitalizaci&oacute;n')

@section('content') 


<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		       	<th>DESPACHO</th>
				<th>EMAIL</th>
				<th>PROCESOS ACTIVOS</th>
				<th>AUTORIZA DIGITALIZACION EXTERNA</th>
										     				
		    </tr>
	    </thead>
	    @if($resultadoEncuesta != null)
		    @foreach($resultadoEncuesta as $resultado)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{strtoupper ($resultado->despacho)}}</th>
					<th scope="row">{{$resultado->email}}</th>
					<th scope="row">{{$resultado->procesos_activos}}</th>
					<th scope="row">{{$resultado->autoriza_digitalizacion}}</th>
										     
				</tr>	                
			</tbody>
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterEncuesta.js"></script> 


@endsection

