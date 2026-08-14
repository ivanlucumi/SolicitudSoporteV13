
    
 <a href="{{ route('usuario.agendamiento') }}" class="btn btn-primary">AGENDAR VISITA</a>

    <br>

    <hr>
    
    <div class="" style="text-align: right">
    <nav class="navbar navbar-light bg-light">
      <form action="{{ route('usuario.ingreso') }}" method="POST">
    @csrf
       <input class="form-group mr-sm-2 shadow" name="cedula" type="text"  placeholder="Buscar por Cedula" aria-label="Search">
        <input class="form-group mr-sm-2 shadow" name="fecha" type="date"  placeholder="Buscar por fecha" aria-label="Search">
        <input class="form-group mr-sm-2 shadow" name="radicado" type="number" min="1"  placeholder="Buscar por radicado" aria-label="Search">
        <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
      </form>
    </nav>
  </div>
    
   

    <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>IDENTIFICACI&Oacute;N</th>
		        <th>NOMBRE</th>
		        <th>APELLIDOS</th>
				<th>FECHA DE INGRESO</th>
				<th>HORA INGRESO</th>
				<th>DESPACHO</th>
				<th>TIPO</th>				     				
		    </tr>
	    </thead>
	    
		    @foreach($ingresos as $ingreso)
		    
			<tbody data-id="{!!$ingreso->id!!}" class="buscar">
				<tr class="table-light" >
					<th scope="row">{{$ingreso->identificacion}}</th>									
					<th scope="row">{{$ingreso->persona->nombre}}</th>									
					<th scope="row">{{$ingreso->persona->apellidos}}</th>									
					<th scope="row">{{$ingreso->fecha_ingreso}}</th>
					<th scope="row">@if($ingreso->hora_ingreso != null)
					    {{Carbon\Carbon::parse($ingreso->hora_ingreso)->toTimeString()}}
					    @else
					    Sin definir
					    @endif
					    </th>									
					<th scope="row">{{$ingreso->despacho}}</th>
					<th scope="row">{{$ingreso->tipo_solicitud}}</th>
				</tr>	                
			</tbody>
			@endforeach
	</table>
</div>

<!--formulario consulta de vehiculos-->
   <form id="form-consulta-ingreso" action="{{ route('monitoreo.verificacion.ingreso.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
   </form>

@push('scripts')
<script src="/js/1configuracion.js"></script>  
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/indexSolicitud.js"></script> 
@endpush