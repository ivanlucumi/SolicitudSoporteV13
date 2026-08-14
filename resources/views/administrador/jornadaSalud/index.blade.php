@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Jornada Salud')
@section('cabecera', 'REGISTRO JORNADA SALUD')

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
				<th>CORREO</th>
				<th>CELULAR</th>
				<th>SEXO</th>
				<th>EPS</th>
				<th>CITOLOGIA</th>
				<th>HIGIENE ORAL</th>
				<th>DESPACHO</th>					     				
		    </tr>
	    </thead>
	    @if($jornadaSalud != null)
		    @foreach($jornadaSalud as $vacunacion)
			<tbody class="buscar">
				<tr class="table-light">					  
					<th scope="row"><div style="word-wrap: break-word;height: auto;width: 90px;">{{$vacunacion->cedula}}</div></th>
					<th scope="row"><div style="word-wrap: break-word;height: auto;width: 80px;">{{strtoupper($vacunacion->nombre)}}</div></th>
					<th scope="row">{{$vacunacion->apellido}}</th>
					<th scope="row">{{$vacunacion->correo}}</th>
					<th scope="row">{{$vacunacion->celular}}</th>
					<th scope="row">{{$vacunacion->sexo}}</th>
					<th scope="row">{{$vacunacion->eps}}</th>
					<th scope="row">{{$vacunacion->citologia}}</th>
					<th scope="row">{{$vacunacion->odontologia }}</th>
					<th scope="row">{{$vacunacion->despacho}}</th>
					
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
	fileName: "Revisiones Protocolo Dos",    //Nombre del archivo 
});

</script>

@endsection