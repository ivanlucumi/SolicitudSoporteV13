@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'ESCALAFON DESPACHOS')
@section('cabecera', 'ESCALAFON DESPACHOS')

@section('content')

<div class="" style="text-align: left">	
	<a href="{!! route('usuario.escalafon.cargos.Incorporacion')!!}" class="btn btn-warning btn-sm" >Incorporaci&oacute;n</a>
</div>

	   <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
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
												<th scope="row"> {{$solicitud->cargo}} </th>
												<th scope="row"> Nombre Funcionario</th>
												<th scope="row"> Cedula </th>
												<th scope="row"> En Propiedad </th>
												<th scope="row"> fecha </th>
												<th scope="row"> estado </th>
											    <th scope="row">
											         <form action="{{ route('usuario.escalafon.cargos.Incorporacion') }}" method="POST">
    @csrf
                                                                <input class="form-control" type="hidden" name="id" id="id" value="{{ $solicitud->id }}"> 
                                                        <button class="form-group my-2 my-sm-0 shadow btn btn-warning btn-sm fa fa-eye" type="submit"> Incorporar</button>
                                                        
                                                      </form>
											    </th>
    					                        
    					                       
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



