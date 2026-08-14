@extends('layouts.inpec')
<!--ponerle titulo a la paginga-->
@section('title', 'Citaciones Inpec')
@section('cabecera', 'Solicitudes de citaci&oacute;n Inpec')

@section('content') 

	@include('alerts.success')
		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>RADICADO</th>
						  	  <th>JUZGADO</th>
						      <th>FECHA SOLICITUD</th>
						      <th>INICIA</th>
						      <th>FINALIZA</th>	
						      <th>LUGAR RECLUSION </th>
						      <th>INTERNO</th>	
						      <th>CUIDAD</th>
						     				      
					      </tr>
						</thead>

						@if(!empty($citaciones))
						@foreach($citaciones as $id => $citacion)
							 <tbody class="buscar">
									 					     
									 
    							 @foreach($citacion->Detenidos as $detenido)
    								<tr class="table-light">
        								     <th scope="row"> {{$citacion->numero_radicado_proceso}}  </th>
    										 <th scope="row"> {{$citacion->nombre_entidad}} </th>
    										 <th scope="row"> {{$citacion->fecha_prgramada}} </th>
    										 <th scope="row"> {{$citacion->hora_inicio}} </th>
    										 <th scope="row"> {{$citacion->hora_fin}} </th>	 
    										 <th scope="row"> {{$detenido->nombre_estalecimiento}} </th>
    										 <th scope="row"> {{$detenido->nombre_interno}} </th>
    										 <th scope="row"> {{$detenido->ciudad}} </th>
    								</tr>	
    							@endforeach	
                                    
								@endforeach	   	                
							 </tbody>
							 @else
							 
							 @endif
							            
				     </table>
				  </div>
				</div>
			 </div>
			<!-- /.box-body -->	
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/inpec/indexUsuarios.js"></script>        

@endsection