@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'ESCALAFON DESPACHOS')
@section('cabecera', 'ESCALAFON DESPACHOS')

@section('content')

	   <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						  	  <th>DISTRITO</th>
						      <th>CIRCUITO</th>
						      <th>MUNICIPIO</th>	
						      <th>DESPACHO</th>
						      <th>ESTADO NOMINA</th>	
						      <th>LISTA</th>
						      <th>CARGO</th>
						      <th>ACOGIGO</th>
						      <th>CEDULA</th>
						      <th>PROPIEDAD</th>
						      <th>FECHA VINCULACION</th>
						      <th>PROVISIONALIDAD</th>
						      <th>ACCION</th>
						      
						     				      
					      </tr>
						</thead>


						@if($escalafonDespacho != null)
							@foreach($escalafonDespacho as $solicitud)
							
									<tbody class="buscar">
											<tr class="table-light">
												<th scope="row"> {{$solicitud->distrito}} </th>
												<th scope="row"> {{$solicitud->circuito}}  </th>
												<th scope="row"> {{$solicitud->municipio}} </th>
												<th scope="row"> {{$solicitud->despacho_judicial}} </th>
												<th scope="row"> {{$solicitud->estado_nomina}} </th>
												<th scope="row"> {{$solicitud->lista}} </th>
												<th scope="row"> {{$solicitud->cargo}} </th>
												<th scope="row"> {{$solicitud->acogido}} </th>
												<th scope="row"> {{$solicitud->Carrera->cedula_propiedad}}</th>
												<th scope="row"> {{$solicitud->Carrera->nombres_propiedad}} {{$solicitud->Carrera->apellido_propiedad}}</th>
												<th scope="row"> {{$solicitud->fecha_vinculacion}} </th>
												<th scope="row">@if(!empty($solicitud->Provisionalidad->cedula_provisionalidad)){{ $solicitud->Provisionalidad->cedula_provisionalidad}}@endif
												@if(!empty($solicitud->Provisionalidad->nombre_provisionalidad)){{ $solicitud->Provisionalidad->nombre_provisionalidad}}@endif 
												@if(!empty($solicitud->Provisionalidad->apellido_provisionalidad)){{ $solicitud->Provisionalidad->apellido_provisionalidad}}@endif</th>
											    <th scope="row"><a href="{{ route('escalafon.listado.show', $solicitud->id) }}" class="btn btn-warning btn-sm btn-block fa fa-eye" title="VER"></a> </th>
    					                        
    					                       
											</tr>								 	                
									</tbody>
							@endforeach	  
					    @else
							 
					    @endif					
							
							            
				     </table>
				  </div>
				</div>
			 </div>
		<!-- /.box-body -->	

@endsection



