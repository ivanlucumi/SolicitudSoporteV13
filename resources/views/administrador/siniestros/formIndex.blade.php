

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		       	<th># CASO</th>
				<th>FECHA RECIBIDO</th>
				<th>DESPACHO</th>
				<th>USUARIO</th>
				<th>TIPO ELEMENTO</th>
				<th>TIPO DE DA&Ntilde;O</th>
				<th>DIAGNOSTICO</th>
				<th>DOCUMENTOS</th>
				<th>FECHA ENV ADMON</th>
				<th>TECNICO</th>
				<th># ASEGURADORA</th>  
				<th>FECHA DE PAGO</th>
				<th>ACCIONES</th>						     				
		    </tr>
	    </thead>
	    @if($siniestros != null)
		    @foreach($siniestros as $siniestro)
			<tbody class="buscar">
				<tr class="table-light">
				    <th scope="row">{{$siniestro->num_caso}}</th>
					<th scope="row">{{$siniestro->fecha_reporte}}</th>
					<th scope="row">{{$siniestro->despacho}}</th>
					<th scope="row">{{$siniestro->nombre_usuario}}</th>
					<th scope="row">{{$siniestro->placa}} <br> {{$siniestro->serial_equipo}}<br> {{$siniestro->marca_equipo}}<br> {{$siniestro->modelo_equipo}}</th>
					<th scope="row">{{$siniestro->falla_reportada}}</th>
					<th scope="row">{{$siniestro->diagnostico}}</th>
					<th scope="row"> 
    					@if(!empty($siniestro->informe_onsite ))<a onClick="window.open('/Siniestros/{{$siniestro->informe_onsite}}','popup', 'width=800px,height=600px')">VER_INFORME_ONSITE</a><br>@endif 
    					@if(!empty($siniestro->reporte_tecnico ))<a onClick="window.open('/Siniestros/{{$siniestro->reporte_tecnico}}','popup', 'width=800px,height=600px')">VER_REPORTE_TECNICO</a><br>@endif 
    					@if(!empty($siniestro->reporte_aseguradora ))<a onClick="window.open('/Siniestros/{{$siniestro->reporte_aseguradora}}','popup', 'width=800px,height=600px')">VER_REPORTE_ASEGURADORA</a> <br>@endif
    					@if(!empty($siniestro->liquidacion_siniestro ))<a onClick="window.open('/Siniestros/{{$siniestro->liquidacion_siniestro}}','popup', 'width=800px,height=600px')">VER_LIQUIDACION_SINIESTRO</a> <br>@endif
    					@if(!empty($siniestro->ingreso_almacen ))<a onClick="window.open('/Siniestros/{{$siniestro->ingreso_almacen}}','popup', 'width=800px,height=600px')">VER_INGRESO_ALMACEN</a>@endif
					</th>
					<th scope="row">{{$siniestro->fecha_envio_admon}}</th>
					<th scope="row">{{$siniestro->nombre_tecnico}}</th>
					<th scope="row">{{$siniestro->num_siniestro_aseguradora}}</th>
					<th scope="row">{{$siniestro->fecha_de_pago_aseguradora}}</th>
					<th > 
					    <div class="row">
					        <div class="col-xs-6">
					            <a href="{{ route('administrador.siniestro.edit', $siniestro->id) }}" class="btn btn-primary btn-sm fa fa-pencil" title="editar usuario"></a>
					        </div>
					        @if(empty($siniestro->aprobado))
					        <div class="col-xs-6">
					            <a href="" data-target="#modal-delete-{{$siniestro->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>
					            <!--	@if( auth()->user()->tipo_rol == "COORDINADOR" ||  auth()->user()->rol == 1)	  		
                				    <form action="{{ route('administrador.siniestro.delete', $siniestro->id) }}" method="POST">
    @csrf
    @method('DELETE')
                					<button class="btn btn-danger btn-sm fa fa-remove" title="eliminar usuario" type="submit">X</button>
                					</form>	
                					@endif-->
					        </div>
					        @endif
					    </div>
    				
    						   		
    				
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.siniestros.ModalEliminar')
			@endforeach
		@endif
	</table>
</div>
