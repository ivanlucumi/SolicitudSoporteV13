@extends('layouts.digitalizacion.servisoft')
<!--ponerle titulo a la paginga-->
@section('title', 'Regsitro Incidentes Mercurio')
@section('cabecera', 'Regsitro Incidentes Mercurio')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<div class="container-fluid">

<div class="row">
    <div><center><h2>POR RESOLVER .</h2></center></div>
</div>
<hr>

           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped  table-condensed table-hover"  >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      @if( auth()->user()->rol == 15)
						        <th></th>
						       @endif
						        <th>USUARIO</th>
						        <th>SOLICITUD</th>
						        <th>FECHA</th>
                                <th>DESPACHO</th>
                                <th>RADICACION</th>
                                <th>ESTADO</th>
                                <th>SOLUCION</th>
					      </tr>
						</thead>
                            
							 @foreach($incidentes as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light" >
                    				    <th scope="row">{{$digit->usuario}}</th>
                    				    <th scope="row">{{$digit->solicitud}}</th>
                    				    <th scope="row">{{$digit->fecha_solicitud}}</th>	
                    					<th scope="row">{{$digit->despacho_que_solicita}}</th>
                    					<th scope="row">{{$digit->radicacion}}</th>	
                    					<th scope="row">{{$digit->estado}}</th>
                    				
                    					@if(!empty($digit->solucion))
                    					<th scope="row">{{$digit->solucion}}</th>
                    					<th scope="row">{{$digit->quien_soluciono}}</th>
                    					<th scope="row">{{$digit->fecha_solucion}}</th>
                    					<form action="{{ route('servisoft.update.incidentes',$digit->id) }}" method="POST">
    @csrf
    @method('PUT')        
                    					@else
                    					<form action="{{ route('servisoft.update.incidentes',$digit->id) }}" method="POST">
    @csrf
    @method('PUT')
                    					<th scope="row"><input type="text"  name="solucion" required></th>
                    					<th scope="row"><button class="fa fa-save btn btn-success btn-block elevation-3" type="submit">RESOLVER</button>  
                    					<th scope="row">{{$digit->fecha_solucion}}</th>
                    					                      
                                        </form></th>
                                        @endif
                    					
    					
                    					
                    					
                    					
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						          
				     </table>
				  </div>
				</div>
<hr>
<div class="row">
    <div><center><h2>RESUELTAS</h2></center></div>
</div>
<hr>
			 <div class="row">
				 <div class="table-responsive">
					 <table id="table10" class="table table-bordered table-striped  table-condensed table-hover"  >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      @if( auth()->user()->rol == 15)
						        <th></th>
						       @endif
						        <th>USUARIO</th>
						        <th>SOLICITUD</th>
						        <th>FECHA</th>
                                <th>DESPACHO</th>
                                <th>RADICACION</th>
                                <th>ESTADO</th>
                                <th>SOLUCION</th>
                                <th>QUIEN</th>
                                <th>FECHA</th>
                                
					      </tr>
						</thead>
                            
							 @foreach($resueltos as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light" >
                    				   <th scope="row">{{$digit->usuario}}</th>
                    				    <th scope="row">{{$digit->solicitud}}</th>
                    				    <th scope="row">{{$digit->fecha_solicitud}}</th>	
                    					<th scope="row">{{$digit->despacho_que_solicita}}</th>	
                    					<th scope="row">{{$digit->radicacion}}</th>	
                    					<th scope="row">{{$digit->estado}}</th>
                    					<th scope="row">{{$digit->solucion}}</th>	
                    					<th scope="row">{{$digit->quien_soluciono}}
                    					</th><th scope="row">{{$digit->fecha_solucion}}</th>
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						          
				     </table>
				  </div>
				</div>
</div>
			<!-- /.box-body -->	



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script> 
<script src="/js/Filter8Pdos.js"></script>



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
	fileName: "Reporte Novedades Digitalizacion",    //Nombre del archivo 
});

</script>

@endsection