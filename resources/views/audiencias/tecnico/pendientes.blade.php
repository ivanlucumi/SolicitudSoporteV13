@extends('layouts.tecnicos')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud Audiencia')
@section('cabecera', 'Registra La Solicitud de Audiencia')

@section('content') 
<div class="table-responsive shadow">
	<table id="table9" class="table  table-hover table-condensed table-bordered " style="display: block;
  overflow: auto;
  width: 100%;
  height: 800px">
	
	</div>	
	    <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr class="shadow">
		        <th>EMAIL..</th>
				<th>NOMBRE ENTIDAD</th>
				<th>FECHA PROGRAMADA</th>
				<th>INICIO</th>
				<th>FIN</th>
				<th>CIUDAD</th>
				<th>ENTIDAD</th>					     
				<th>RADICADO</th>
				<th>F. SOLICITUD</th>
				<th>PRIVADA</th>
				<th>TELÉFONO</th>
				<th>DECLARANTE O INDICIADO</th>					     
				<th>ID</th>					     
                <th>URL</th>	
                <th>RESERVA</th>				     
				
		    </tr>
	    </thead>
	    
            @if($solicitudes != null)
            @foreach($solicitudes as $solicitud)
            <tbody data-id="{!!$solicitud->id!!}" class="buscar ">
                <tr class="table-light" id="color-fondo">
                    <th scope="row">{{$solicitud->email}}</th>									
                    <th scope="row">{{$solicitud->nombre_entidad}}</th>
                    <th scope="row">{{$solicitud->fecha_prgramada}}</th>
                    <th scope="row">{{$solicitud->hora_inicio}}</th>									
                    <th scope="row">{{$solicitud->hora_fin}}</th>									
                    <th scope="row">{{$solicitud->ciudad_destino}}</th>
                    <th scope="row">{{$solicitud->entidad_destino}}</th>					
                    <th scope="row">{{$solicitud->numero_radicado_proceso}}</th>
                    <th scope="row">{{$solicitud->fecha_solicitud}}</th>
                    <th scope="row">@if($solicitud->audiencia_privada == 1)
                                    SI
                                    @else
                                    NO
                                    @endif
                    </th>
                    <th scope="row">{{$solicitud->telefono}}</th>
                    <th scope="row">{{$solicitud->declarante_indiciado}}</th>	
                    <th scope="row"><input type="text" id="input-id" disabled="disabled"></th>              
                    <th scope="row"><input type="text" id="input-url" disabled="disabled"></th>      
                    <th><center><button class="btn btn-warning btn-block boton-asignar-audienciaV">ok</button></center></th>        
                </tr>	                
            </tbody>
            @endforeach
        @else
        <tr class="table-light">
            <p class="lead">Actualmente esta secion no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
        </tr>
        @endif
	
	</table>
</div>


<form id="form-verificar-disponibilidad" action="{{ route('tecnico.verificar.estado.solicitud',':VERIFICAR_ID') }}" method="POST">
    @csrf
</form>

<form id="form-visualizar-solicitud" action="{{ route('tecnico.solicitud.show',':SOLICITUD_ID') }}" method="POST">
    @csrf
</form>


<div class="container-fluid">
    @include('audiencias.tecnico.modal.modal_revisar_solicitud',['solicitudAudiencia'=> $solicitudAudiencia,
             'url'=> 'virtual.audiencia.confirmar', 'method'=>'POST'])   
 </div>
   
  @push('scripts')
    
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/audiencias/filtroaudiencias.js"></script>  
<script src="/js/audiencias/tecnico.js"></script>  

  @endpush

@endsection