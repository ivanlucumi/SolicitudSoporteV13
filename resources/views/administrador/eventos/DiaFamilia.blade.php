@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'EVENTO DIA DE LA FAMILIA')
@section('cabecera', 'EVENTO DIA DE LA FAMILIA')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
	

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>		        
		        <th>NOMBRE SERVIDOR</th>
		        <th>IDENTIFICACION</th>
				<th>DESPACHO</th>
				<th>CARGO</th>	
				<th>CONFIRMA</th>
		        <th>ACOM 1 IDENTIFICACIO</th>
		        <th>ACOM 1 NOMBRE</th>
		        <th>ACOM 1 PARENTEZCO</th>
				<th>CONFIRMA</th>
				<th>ACOM 2 IDENTIFICACION</th>
		        <th>ACOM 2 NOMBRE</th>
		        <th>ACOM 2 PARENTEZCO</th>	
				<th>CONFIRMA</th>
		        <th>OBSERVACIONES</th>
		        <th>ACCION</th>
		    </tr>
	    </thead>
	    @if($listado != null)
		    @foreach($listado as $evento)
			<tbody class="buscar" id="table-body">
				<tr class="table-light">					  
				     <td scope="row">{{$evento->nombre_servidor}}</td>
					 <td scope="row">{{strtoupper($evento->identificacion)}}</td>
					 <td scope="row">{{$evento->despacho}}</td>
					 <td scope="row">{{$evento->cargo}}</td>
					 <form action="{{ route('admin.consulta.dia.familia.actualizar',$evento->id) }}" method="POST">
    @csrf
    @method('PUT')          
                     <td scope="row">{{$evento->confirma}}</td>
					 <td scope="row">{{$evento->identificacion_a1}}</td>
					 <td scope="row">{{$evento->acompanante_1}}</td>
					 <td scope="row">{{$evento->parentezco_1}}</td>
					 <td scope="row">{{$evento->confirma_1}}</td>
					 <td scope="row">{{$evento->identificacion_a2}}</td>
					 <td scope="row">{{$evento->acompanante_2}}</td>
					 <td scope="row">{{$evento->parentezco_2}}</td>
					 <td scope="row">{{$evento->confirma_2}}</td>
					 <td scope="row">{{$evento->observaciones}}</td>
    				 
    				 <td  scope="row">
    				      <button class="fa fa-save btn btn-success btn-block elevation-3" type="submit">Actualizar</button>                        
                          </form>
    				 </td>
    				 
				</tr>
			</tbody>
			@endforeach
		@endif
	</table>
	
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/FilterDiaFamilia.js"></script> 
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
	fileName: "DIA DE LA FAMILIA",    //Nombre del archivo 
});

</script>

@endsection