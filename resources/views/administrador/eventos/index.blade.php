@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Vacunacion')
@section('cabecera', 'REGISTRO VACUNACIÓN')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
	

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>		        
		        <th>CEDULA</th>
		        <th>NOMBRE</th>
				<th>DESPACHO</th>
				<th>CARGO</th>					     				
		    </tr>
	    </thead>
	    @if($eventos != null)
		    @foreach($eventos as $evento)
			<tbody class="buscar">
				<tr class="table-light">					  
					<th scope="row">{{$evento->cedula}}</th>
					<th scope="row">{{strtoupper($evento->nombre)}} {{strtoupper($evento->apellido)}}</th>
					<th scope="row">{{$evento->despacho}}</th>
					<th scope="row">{{$evento->cargo}}</th>
				</tr>
				@if(sizeof($evento->Familiar)>0))
				<tr>
				 <td colspan="4">FAMILIAR DE {{strtoupper($evento->nombre)}} {{strtoupper($evento->apellido)}}</td>
				</tr>
				<tr>		        
    		        <th>TIPO IDENT.</th>
    		        <th>IDENTIFICACION</th>
    				<th>PARENTESCO</th>
    				<th>NOMBRE</th>					     				
		        </tr>
				@foreach($evento->Familiar as $familiar)
				<tr>
				 <td scope="row">{{$familiar->tipo_identificacion}}</td>
				 <td  scope="row">{{$familiar->identificacion}}</td>
				 <td  scope="row">{{$familiar->parentesco}}</td>
				 <td  scope="row">{{$familiar->nombre_acompanhante}} {{$familiar->apellido_acompanhante}}</td>
				</tr>
				@endforeach
				@endif
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
	fileName: "rEGISTRO EVENTO INTEGRACION FAMILIAR",    //Nombre del archivo 
});

</script>

@endsection