@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Cerrando Solicitudes')
@section('cabecera', ' Solicitudes de Usuarios')

@section('content') 
<style>

.alto{
	height: 4em;

}
.fondo{
	background-color: #859488;
	font-size: 16px;

}
.titulo{
	font-size: 18px;
	height: 3.5em;
	text-align: center;
}
.firma{
	font-size: 10px;
	text-align: center;
	height: 6.4em;
	color: #CBCACA;
}


.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc !important;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}
	
</style>
<form action="{{ route('administrador..store') }}" method="POST">
    @csrf
<div class="row">
       <div class="form-group" style="display:none;">
                  <input class="form-control @error('idSolicitud') is-invalid @enderror" display="true" type="text" name="idSolicitud" id="idSolicitud" value="{{ old('idSolicitud', $solicitud[0]->id) }}">
@error('idSolicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
</div>

<div class="row">
	<div class="col-xs-12 ">
		<div class="col-xs-12 col-md-7 table-bordered titulo" >
			<strong>FORMATO DE ATENCIÓN A REQUERIMIENTOS INFORMÁTICOS</strong>

		  </div>
		   		<div class="col-xs-12 col-md-2 table-bordered fondo alto">
		       	 <strong>CLASIFICACIÓN:</strong>

		       	</div>
		   	<div class="col-xs-12 col-md-3 table-bordered alto">
		       		<div>
		       		<label>PRIORIDAD: </label>	<strong>{{$solicitud[0]->AtSoli ? $solicitud[0]->AtSoli->prioridad : ''}}</strong>
		       		</div>
		       		<div>
		       		<label>DIA LIMITE DE ATENSION: </label>	{{$solicitud[0]->AtSoli ? $solicitud[0]->AtSoli->maximoD : ''}}
		       		</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>INFORMACIÓN GENERAL</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="col-xs-12 col-md-3 table-bordered">
		No. CONSECUTIVO: 
		</div>
		<div class="col-xs-12 col-md-2 table-bordered">
			{{$solicitud[0]->radicado}}
		</div>
	
		<div class="col-xs-12 col-md-4 table-bordered">
		FECHA DEL REQUERIMIENTO:
		</div>
		<div class="col-xs-12 col-md-3 table-bordered">
			{{$solicitud[0]->created_at ? $solicitud[0]->created_at->format('d/m/Y') : ''}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-md-12">
		@foreach($seccionales as $seccional)
		<div class="col-xs-12 col-md-4 table-bordered">
			<label for="nombre">$seccional->nombreSeccional</label>
			<input type="radio" name="seccional" id="seccional_$seccional->id" value="$seccional->id">,'required' }}
		</div>
		 @endforeach
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>TIPO DE PRESENTACIÓN DEL REQUERIMIENTO</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@foreach($tipoSolicitudes as $tipoSolicitud)
			<div class="col-xs-12 col-md-4 table-bordered">
				<div class="col-xs-6">
					<label for="nombre">$tipoSolicitud</label>
				</div>
				<div class="col-xs-4">
			     <input checked type="radio" name="presentacion" id="presentacion_WEB" value="WEB">
				</div>				
			</div>
		 @endforeach
	</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>DATOS DEL SOLICITANTE</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-3 table-bordered">
			<strong>NOMBRE COMPLETO:</strong>
		</div>
		  <div class="col-xs-12 col-md-5 table-bordered">
			{{$solicitud[0]->empleadoSoli ? $solicitud[0]->empleadoSoli->nameE : ''}} 
			{{$solicitud[0]->empleadoSoli ? $solicitud[0]->empleadoSoli->lastnameE : ''}} 
           
		   </div>
		   <div class="col-xs-12 col-md-2 table-bordered">
			<strong>No. CÉDULA:</strong>
		 </div>
	    <div class="col-xs-12 col-md-2 table-bordered">
			{{$solicitud[0]->empleadoSoli ? $solicitud[0]->empleadoSoli->cedulaE : ''}} 
      </div>
	</div>
</div class="row">
	<div class="col-xs-12 col-md-3 table-bordered ">
		<strong>DESPACHO JUDICIAL:</strong>
	</div>
	<div class="col-xs-12 col-md-9 table-bordered ">
		{{$solicitud[0]->despachoSoli ? $solicitud[0]->despachoSoli->nombreDespacho : ''}} 
	</div>
<div >
	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-2 table-bordered">
		<strong>TELÉFONO:</strong>
		 </div>
		  <div class="col-xs-12 col-md-1 table-bordered">
			{{$solicitud[0]->despachoSoli ? $solicitud[0]->despachoSoli->telefono : ''}}
		  </div>
		  <div class="col-xs-12 col-md-3 table-bordered">
		   <strong>CORREO ELECTRÓNICO:</strong>
		 </div>
		 <div class="col-xs-12 col-md-6 table-bordered">
			{{$solicitud[0]->despachoSoli ? $solicitud[0]->despachoSoli->correoD : ''}}
	  </div>
	</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>DESCRIPCIÓN DEL REQUERIMIENTO</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 ">
		<div class="col-xs-12 table-bordered alto">
			{{ $solicitud[0]->descripcion}}
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>SOLUCI&Oacute;N</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-12 table-bordered">
			<textarea class="form-control @error('solucion') is-invalid @enderror" style="height: 80px;" placeholder="Describa la solución" name="solucion" id="solucion">{{ old('solucion') }}</textarea>
@error('solucion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 		
		</div>
		<div class="col-xs-12 col-md-6 ">
			<div class="col-xs-12 col-md-6 table-bordered">
				FECHA RESPUESTA:
			</div>
			<div class="col-xs-12 col-md-6 table-bordered">
				{{$fecha}}
			</div>
			
		</div>			
	</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>INGENIERO RESPONSABLE</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-2 alto table-bordered">
			NOMBRE:	
			</div>	
			 <div class="col-xs-12 col-md-6 table-bordered alto">
			 	{!!"  ". auth()->user()->name."   ". auth()->user()->lastname!!}
			 </div>
			 <div class="col-xs-12 col-md-4 table-bordered  firma" >
			 	Firma:
			 </div>
		</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-2 table-bordered">
				CARGO:		
			</div>	
				<div class="col-xs-12 col-md-4 table-bordered">
					<input class="form-control @error('cargo_tecnico') is-invalid @enderror" display="true" placeholder="Ingresa tu cargo" type="text" name="cargo_tecnico" id="cargo_tecnico" value="{{ old('cargo_tecnico') }}">
@error('cargo_tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>	
				<div class="col-xs-12 col-md-3 table-bordered">
						FECHA ASIGNACIÓN:
				</div>
			  <div class=" col-xs-12 col-md-3 table-bordered">
				{{$solicitud[0]->created_at->format('d/m/Y')}}
			</div>	
		</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>ESTADO DE LA SOLICITUD</strong> 
		</div>
	</div>
</div>
<div class="row">
	
		<div class="col-xs-12 col-md-12 table-bordered">
			@foreach($estados as $estado)
			<div class="col-xs-12 col-md-4 table-bordered">
				<div class="col-xs-6">
					<label for="nombre">$estado</label>
				</div>
				<div class="col-xs-4">
					<input type="radio" name="estado" id="estado_$estado" value="$estado">
				</div>
			</div>
		 @endforeach
	</div>	
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong>ELEMENTOS</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6">
	<label style="text-align: center;">Dispositivo:</label><br>
			{!!$solicitud[0]->elementosSoli ? $solicitud[0]->elementosSoli->pluck('nombreElemento')->implode(' <br>') : ''!!}

    </div>	
    <div class="col-xs-12 col-sm-6">
    	<label text-align="center">ID :</label><br>
		{!!$solicitud[0]->elementosSoli ? $solicitud[0]->elementosSoli->pluck('id')->implode(' <br>') : ''!!}

    </div>	               
 </div>
 <div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 table-bordered fondo">
			<strong> SELECCIONAR PLACA INVENTARIO</strong> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		
			<div class="col-xs-12 col-md-12">
				<div class="form-group">
					<br>
					 @if($placas->all() != null)
					 <select data-placeholder="Seleccione Placa" class="form-control select2 @error('idPlaca[]') is-invalid @enderror" multiple="multiple" name="idPlaca[]" id="idPlaca[]">
    @foreach($placas as $key => $value)
        <option value="{{ $key }}" @selected(old('idPlaca[]') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('idPlaca[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					 @endif
					 <strong>OBSERVACIONES</strong> 
					 <textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
				</div>  
			</div>	                	
			 <br>
    </div>		               
 </div>

<div class="row">
	<div class="col-xs-12 col-md-4">			
	</div>	
	<div class="col-xs-12 col-md-4">
	 <button class="btn btn-danger btn-block" type="submit">Cerrar caso</button>
	 </form>			
	</div>	
	<div class="col-xs-12 col-md-4">			
	</div>	
</div>


@endsection