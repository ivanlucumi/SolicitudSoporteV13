@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios')
@section('cabecera', 'Audiencias virtuales Agendadas')

@section('content') 
<div class="" style="text-align: left">	
	<a href="{!! url('/usuarios/audiencias')!!}" class="btn btn-warning btn-sm" >Audiencia Hoy</a>
</div>
	
<div class="" style="text-align: right">
	      
    <nav class="navbar navbar-light bg-light">
      <form action="{{ route('solicitud.filtro') }}" method="POST">
    @csrf
        <input class="form-group mr-sm-2 shadow @error('fecha') is-invalid @enderror" placeholder="Buscar por fecha" autocomplete="off" aria-label="Search" type="date" name="fecha" id="fecha" value="{{ old('fecha') }}">
@error('fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar por radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
      </form>
    </nav>
  </div>
  
  
		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						  	  <th>FECHA</th>
						      <th>HORA INICIO</th>
						      <th>NÚMERO RADICADO</th>	
						      <th>DECLARANTE O INDICIADO</th>
						      <th>ID</th>	
						      <th>URL</th>
						      <th>INICIAR</th>
						      <th>ACCION</th>
						      
						     				      
					      </tr>
						</thead>


						@if($solicitudesAudiencia != null)
							@foreach($solicitudesAudiencia as $solicitud)
									<tbody class="buscar">
											<tr class="table-light">
												<th scope="row"> {{$solicitud->fecha_prgramada}} </th>
												<th scope="row"> {{$solicitud->hora_inicio}}  </th>
												<th scope="row"> {{$solicitud->numero_radicado_proceso}} </th>
												<th scope="row"> {{$solicitud->declarante_indiciado}} </th>
												<th scope="row"> {{$solicitud->id_conexion}} </th>
												<th scope="row"> {{$solicitud->enlace}} </th>
												<th scope="row">@if($solicitud->enlace != null) <a class="btn btn-success btn-xs" href="{!!$solicitud->enlace!!}" target="_blank"><span>Iniciar</span></a> @endif</th>
											    <th scope="row">@if($solicitud->enlace == null) <form action="{{ route('solicitud.audiencia.eliminar', $solicitud->id) }}" method="POST">
    @csrf
    @method('DELETE')
    					                        <button class="btn btn-danger btn-xs fa fa-remove" title="Eliminar Solicitud" type="submit">Eliminar</button>
    					                        </form> @endif	</th>
    					                        
    					                       
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
    
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>

<script src="/js/indexUsuarios.js"></script>         

@push('scripts')
  
   @endpush

@endsection