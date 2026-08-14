@extends('layouts.soporte')
@section('title', 'Listado de IPS ')
<!--ponerle titulo a la paginga-->

@section('cabecera', 'IP Usadas')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
    <div class="container-fluid">
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>MUNICIPIO</th>
						      <th>SEDE</th>
						  	  <th>DESPACHO</th>
						      <th>OFICINA</th>
						      <th>TIPO EQUIPO</th>
						      <th>NOMBRE EQUIPO</th>	
						      <th>IP</th>
						      <th>REGISTRO</th>
						      @if( auth()->user()->email =="jbolivarr@disajcali.gov.co")
						      <th>ACCIONES</th>
						      @endif
					      </tr>
						</thead>

						@if(!empty($listado))
						@foreach($listado as $listad)
							 <tbody class="buscar">
									 <tr class="table-light">
									     <th scope="row"> {{$listad->municipio}} </th>
									     <th scope="row"> {{$listad->sede}} </th>
										 <th scope="row"> {{$listad->despacho}} </th>
									     <th scope="row"> {{$listad->oficina}} </th>
									     <th scope="row"> {{$listad->tipo_equipo}} </th>
									     <th scope="row"> {{$listad->nombre_equipo}} </th>
									     <th scope="row"> {{$listad->ip}} </th>
									     <th scope="row"> {{$listad->usuario_creador}} </th>
									     @if( auth()->user()->email =="jbolivarr@disajcali.gov.co" ||  auth()->user()->email =="pbonillal@disajcali.gov.co" ||    auth()->user()->email =="conecttate.net@gmail.com") 
									      <th scope="row"> <a href="{{ route('tecnico.soporte.editar.registro.ip', $listad->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Editar Registro"></a> </th>
									      
									     @endif 
									 </tr>
								@endforeach	   	                
							 </tbody>
						@else
						<p>NO HAY REGISTRO DE IP´s HASTA EL MOMENTO</p>	 
						@endif
							            
				     </table>
				  </div>
				</div>
			 </div>
		</div>

<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
  


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroIp.js"></script> 

<script>
 $(function () {            
        
                
                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });
                
                 //Initialize Select2 Elements
                $('.select2').select2()
            
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })
                
              
                
            }); 
</script>

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