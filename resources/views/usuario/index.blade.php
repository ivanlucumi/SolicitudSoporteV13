@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios')
@section('cabecera', 'Solicitudes enviadas y sin resolver')

@section('content') 

		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						  	  <th>RADICADO</th>
						      <th>PRESENT&Oacute;</th>
						      <th>EDIFICIO</th>
						      <th>REQUERIMIENTO</th>	
						      <th>CATEGORIA</th>
						      <th>ELEMENTO</th>	
						      <th>DESCRIPCI&Oacute;N</th>
						      <th>T&Eacute;CNICO</th>
						      <th>FECHA VISITA</th>
						     				      
					      </tr>
						</thead>

						@if($solicitudes != 0)
						@foreach($solicitudes as $solicitud)
							 <tbody class="buscar">
									 <tr class="table-light">
										 <th scope="row"> {{$solicitud->radicado}} </th>
									     <th scope="row"> {{$solicitud->nameE}}  {{$solicitud->lastnameE}} </th>
									     <th scope="row"> {{$solicitud->edificio}} </th>
									     <th scope="row"> {{$solicitud->nombreRequerimiento}} </th>
									     <th scope="row"> {{$solicitud->descripcioncategoria}} </th>
									     <th scope="row"> {{$solicitud->elementos}} </th>
									     <th scope="row"> {{$solicitud->descripcion}} </th>
									     <th scope="row"> {{$solicitud->name}}  {{$solicitud->lastname}}</th>
									     <th scope="row"> {{$solicitud->fecha_visita}} </th>
									     
															     
									 </tr>
								

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
<script src="/js/indexUsuarios.js"></script>        

@endsection