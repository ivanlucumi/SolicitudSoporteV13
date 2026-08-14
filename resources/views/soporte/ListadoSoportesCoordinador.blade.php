@extends('layouts.soporte')

 @section('title', 'Listado de Soportes')

<!--ponerle titulo a la paginga-->

@section('cabecera', 'Listado de Soportes')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>NUMERO CASO</th>
						      <th>FECHA HORA</th>
						  	  <th>MEDIO</th>
						      <th>SECCIONAL</th>
						      <th>DESPACHO</th>
						      <th>USUARIO</th>
						      <th>FALLA</th>
						      <th>ESTADO</th>
						      <th>TECNICO</th>
					      </tr>
						</thead>

						@foreach($soportes as $listad)
							 <tbody class="buscar">
									 <tr class="table-light">
									      <th scope="row"> {{$listad->num_caso}} </th>
									     <th scope="row"> {{$listad->fecha_solicitud}} {{$listad->hora_solicitud}}</th>
										 <th scope="row"> {{$listad->medio_solicitud}} </th>
									     <th scope="row"> {{$listad->seccional}} </th>
									     <th scope="row"> {{$listad->despacho}} </th>
									     <th scope="row"> {{$listad->nombre}} {{$listad->apellido}}</th>
									     <th scope="row"> {{$listad->falla_reportada}} </th>
									     <th scope="row"> {{$listad->estado_soporte}} </th>
									     <th scope="row"> {{$listad->nombre_tecnico}} </th>
									    
									 </tr>
								@endforeach	   	                
							 </tbody>
						
				     </table>
				  </div>
				</div>
			 </div>

<!-- Select2 -->


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroSoportes.js"></script> 


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
	fileName: "Inventario Digitalizacion",    //Nombre del archivo 
});

</script>
  
@endsection

