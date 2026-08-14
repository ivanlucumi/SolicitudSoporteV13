@extends('layouts.VigilanciaJudicial')
<!--ponerle titulo a la paginga-->
@section('title', 'Repartos')
@section('cabecera', 'Historico Solicitudes de Vigilancia')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">


		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped  table-condensed table-hover" style="width:auto; height:20px;" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						        <th>FECHA</th>
						        <th>SEGUIMIENTO</th>
						        <th>SOLICITANTE</th>
                                <th>NOMBRE</th>
                                <th>RADICADO</th>
                                <th>DESPACHO</th>
                                <th>DEMANDANTE</th>
                                <th>DEMANDADO</th>
                                <th>DOCUMENTOS</th>
                                <th>FECHA REPARTO</th>
                                <th>DESP CORRESPONDE</th>
                                <th>OBSERVACIONES</th>
                                
                                
                                
					      </tr>
						</thead>
                            
							 @foreach($repartos as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light" >
                    				    <th scope="row">{{$digit->fecha_recibido}}</th>
                    				    <th scope="row">{{$digit->seguimiento}}</th>
                    				    <th scope="row">{{$digit->tipo_solicitante}}</th>	
                    					<th scope="row">{{$digit->cedula}}<br>{{$digit->nombre_apellido}}</th>	
                    					<th scope="row">{{$digit->num_radicado}}</th>		
                    					<th scope="row">{{$digit->despacho_encuentra}}</th>
                    					<th scope="row">{{$digit->demandante}}</th>
                    					<th scope="row">{{$digit->demandado}}</th>
                    					<th scope="row"> @if(!empty($digit->formato))<a onClick="window.open('/VigilanciaJudicial/{{$digit->formato}}','popup', 'width=800px,height=600px')">1. FORMATO</a><br>@endif
                        					@if(!empty($digit->anexos))<a onClick="window.open('/VigilanciaJudicial/{{$digit->anexos}}','popup', 'width=800px,height=600px')">2. ANEXOS</a><br>@endif
                        					@if(!empty($digit->acta_reparto))<a onClick="window.open('/VigilanciaJudicial/{{$digit->acta_reparto}}','popup', 'width=800px,height=600px')">3. ACTA REPARTO</a><br>@endif
                        				</th>
                    					<th scope="row">{{$digit->fecha_reparto}}</th>
                    					<th scope="row">{{$digit->reparto_asignado_a}}</th>
                    					<th scope="row">{{$digit->observaciones}}</th>
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						
                    	</form>	            
				     </table>
				  </div>
				</div>
			 </div>

			<!-- /.box-body -->	



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Vigilancia.js"></script> 

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
	fileName: "Historico Solicitudes de Vigilancia",    //Nombre del archivo 
});

</script>


@endsection