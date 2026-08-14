@extends('layouts.mantenimiento')
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
				<th>TIPO SOLICITUD</th>
				<th>CANTIDAD</th>
				<th>OBSERVACIONES</th>
				<th>FECHA REGISTRO</th>
				<th>ESTADO</th>
				<th>ATIENDE</th>
				<th>FECHA</th>
				<th>ACCI&Oacute;N </th>
			</tr>
		</thead>
		<tbody >
			@foreach($requerimientodespachos as $requerimientodespacho)

				<tr class="table-light"  
                @if($requerimientodespacho->id_user != null && $requerimientodespacho->id_user !=  auth()->user()->id) 
                   style="background-color: #FBBAB4;"
                @elseif($requerimientodespacho->id_user ==  auth()->user()->id) 
                    style="background-color: #daf8ea;"
                @endif">
					<td>{{ $requerimientodespacho->nombre_despacho }}</td>
					<td>{{ $requerimientodespacho->tipo_solicitud }}</td>
					<td>{{ $requerimientodespacho->cantidad_elementos }}</td>
					<td>{{ $requerimientodespacho->observaciones }}</td>
					<td>{{ $requerimientodespacho->fecha_solicitud }}</td>
					<td>{{ $requerimientodespacho->estado }}</td>
					<td>{{ $requerimientodespacho->quien_atiende }}</td>
					<td>{{ $requerimientodespacho->fecha_cerrado }}</td>
					<td>  
                    @if($requerimientodespacho->id_user != null && $requerimientodespacho->id_user !=  auth()->user()->id)                 
					<a href="{{ route('reporte.incidentes.solicitudes.editt', $requerimientodespacho->id) }}" class="btn btn-warning bnt-xs fa fa-eye disabled"> </a>
                    
                    @endif
                    @if($requerimientodespacho->id_user == null || $requerimientodespacho->id_user ==  auth()->user()->id )
                    <a href="{{ route('reporte.incidentes.solicitudes.edit', $requerimientodespacho->id) }}" class="btn btn-success bnt-xs fa fa-eye"> </a>
                    @endif
                    @if( $requerimientodespacho->id_user ==  auth()->user()->id && $requerimientodespacho->respuesta == null)
                    <a href="{{ route('reporte.incidentes.solicitudes.soltar', $requerimientodespacho->id) }}" class="btn btn-danger bnt-xs fa fa-reply-all">Soltar </a>
                   
                    @endif
                </td>

				</tr>

			@endforeach
		</tbody>
	</table>
</div>

 <script src="/js/jquery.js"></script>
 <script src="/tablefilter/tablefilter.js"></script>
 <script src="/js/filterIndexRequerimientoD.js"></script>   
 

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
