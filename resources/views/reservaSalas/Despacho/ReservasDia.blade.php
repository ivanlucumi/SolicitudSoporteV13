@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera', 'RESERVA SALAS ')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
	

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>		        
		        <th>RADICACION</th>
		        <th>DESPACHO</th>
		        <th>SALA</th>
		        <th>TORRE PISO</th>
				<th>DEMANDANTE O FISCALLIA</th>
				<th>DEMANDADO O INDICIADO</th>	
				<th>HORA DE INCIO</th>	
				<th>HORA FIN</th>	
		    </tr>
	    </thead>
	    @if($eventos != null)
		    @foreach($eventos as $evento)
			<tbody class="buscar">
				<tr class="table-light">					  
					<th scope="row">{{$evento->radicacion}}</th>
					<th scope="row">{{$evento->despacho}}</th>
					<th scope="row">{{strtoupper($evento->sala_nombre)}}</th>
					<th scope="row">{{$evento->ubicacion_nombre}}</th>
					<th scope="row">{{$evento->nombre_fiscal}}</th>
					<th scope="row">{{strtoupper($evento->nombre_indiciado)}}</th>
					<th scope="row">{{$evento->start}}</th>
					<th scope="row">{{$evento->end}}</th>
				</tr>
				<tr>
				 <td colspan="4"></td>
				</tr>
			</tbody>
			@endforeach
		@endif
	</table>
	
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSesisSS.js"></script> 
<!-- Llamar a los complementos javascript-->

<!-- Llamar a los complementos javascript-->

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "RESERVAS DE SALAS DEL DIA",    //Nombre del archivo 
});

</script>


@endsection



