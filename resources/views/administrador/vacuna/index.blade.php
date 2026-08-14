@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Vacunacion')
@section('cabecera', 'REGISTRO VACUNACIÓN')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Exportar datos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
 
</nav>		

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>		        
		        <th>CEDULA</th>
		        <th>NOMBRE</th>
				<th>APELIDO</th>
				<th>SEXO</th>
				<th>EDAD</th>
				<th>DOSIS</th>
				<th>VACUNA</th>
				<th>HORA</th>
				<th>PERSONA</th>
				<th>DESPACHO</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($vacunaciones != null)
		    @foreach($vacunaciones as $vacunacion)
			<tbody class="buscar">
				<tr class="table-light">					  
					<th scope="row"><div style="word-wrap: break-word;height: auto;width: 90px;">{{$vacunacion->cedula}}</div></th>
					<th scope="row"><div style="word-wrap: break-word;height: auto;width: 80px;">{{strtoupper($vacunacion->nombres)}}</div></th>
					<th scope="row">{{$vacunacion->apellidos}}</th>
					<th scope="row">{{$vacunacion->sexo}}</th>
					<th scope="row">{{$vacunacion->edad}}</th>
					<th scope="row">{{$vacunacion->dosis}}</th>
					<th scope="row">{{$vacunacion->vacuna}}</th>
					<th scope="row">{{$vacunacion->hora_asistencia}}</th>
					<th scope="row">{{$vacunacion->empleado }}  {{ $vacunacion->familiar}}</th>
					<th scope="row">{{$vacunacion->despacho}}</th>
					<th>
						<div class="row">
							<div class="col-xs-12">
								
						   		<div class="col-xs-12">
									<a href="" data-target="#modal-delete-{{$vacunacion->id}}" data-toggle="modal"><button class="btn btn-danger btn-block fa fa-close"></button></a>
						   		</div>
							</div>
						</div>
					</th>
				</tr>	                
			</tbody>
			@include('administrador.vacuna.modalEliinarReserva')
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
	fileName: "Revisiones Protocolo Dos",    //Nombre del archivo 
});

</script>

@endsection