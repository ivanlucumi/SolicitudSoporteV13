@extends('layouts.admin')
@section('title', 'Solicitudes Despacho')
@section('cabecera', 'LISTADO SOLICITUDES')


@section('content')
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<a class="btn btn-danger" href="{!! route('requerimientodespachos.descarga.admin')!!}"><i class="fa fa-globe"></i> <span>Descargar Reporte</span></a>

<hr>
<div class="col-xs-12 col-md-12  form-group table-responsive">
	<table id="table9" class="table table-bordered table-striped">
		<thead class="shadow" style="background-color: #004182; color: #fff;">
			<tr>
				<th>DESPACHO</th>
				<th>EMAIL</th>
				<th>TIPO SOLICITUD</th>
				<th>CANTIDAD</th>
				<th>OBSERVACIONES</th>
				<th>FECHA REGISTRO</th>
				<th>FOTO</th>
			</tr>
		</thead>
		<tbody>
			@foreach($requerimientodespachos as $requerimientodespacho)

				<tr>
					<td>{{ $requerimientodespacho->nombre_despacho }}</td>
					<td>{{ $requerimientodespacho->email_despacho }}</td>
					<td>{{ $requerimientodespacho->tipo_solicitud }}</td>
					<td>{{ $requerimientodespacho->cantidad_elementos }}</td>
					<td>{{ $requerimientodespacho->observaciones }}</td>
					<td>{{ $requerimientodespacho->fecha_solicitud }}</td>
					<td><img src="/Solicitudes//{{ $requerimientodespacho->evidencia_fotografica }}" alt="{{ $requerimientodespacho->evidencia_fotografica }}" style="width:100px;heigth:auto" ></td>

				</tr>

			@endforeach
		</tbody>
	</table>
</div>

 <script src="/js/jquery.js"></script>
 <script src="/tablefilter/tablefilter.js"></script>
 <script src="/js/filterIndexRequerimiento.js"></script>   
 

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
	fileName: "Requerminetos Despachos",    //Nombre del archivo 
});

</script>


@stop
