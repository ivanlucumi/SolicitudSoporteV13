@extends('layouts.tecnicos')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud Audiencia')
@section('cabecera', ' Todas las Solicitud de Audiencia ')

@section('content') 

<div class="" style="text-align: left">	
	<a href="{!! url('/administrador/solicitudes/audiencias')!!}" class="btn btn-warning btn-sm" >Audiencia Hoy</a>
</div>

<div class="container-fluid">
  <div class="" style="text-align: right">
    <nav class="navbar navbar-light bg-light">
      <form action="{{ route('tecnico.audiencias.buscar.resultado') }}" method="POST">
    @csrf
        <input class="form-group mr-sm-2 shadow @error('fecha') is-invalid @enderror" placeholder="Buscar por fecha" autocomplete="off" aria-label="Search" type="date" name="fecha" id="fecha" value="{{ old('fecha') }}">
@error('fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        <input class="form-group mr-sm-2 shadow @error('email') is-invalid @enderror" placeholder="Buscar por Email" autocomplete="off" aria-label="Search" type="email" name="email" id="email" value="{{ old('email') }}">
@error('email')
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
  
</div>



<div class="table-responsive shadow">
	<table id="table9" class="table table-bordered table-striped" style="display: block;  overflow: auto;  width: 100%;  height: 800px" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		  <tr>
		    <th>EMAIL</th>
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
                <th>ACCIONES</th>					     
				
		    </tr>
	    </thead>
      
            @if($solicitudes != null)
            @foreach($solicitudes as $solicitud)
            <tbody data-id="{!!$solicitud->id!!}" class="buscar " >
                <tr class="table-light"  
                @if($solicitud->quien_asigno ===  auth()->user()->id)
                <?php echo 'style="background-color: #C3F8BC"'; ?>
                @endif
                @if($solicitud->quien_asigno === null)                 
                <?php echo 'style="background-color: #"'; ?>
                @endif
                @if($solicitud->quien_asigno !=  auth()->user()->id)
                <?php echo 'style="background-color: #FBBAB4"'; ?>
                @endif>
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
                    <th scope="row">{{$solicitud->id_conexion}}</th>
                    <th scope="row">{{$solicitud->enlace}}</th>
                    <th scope="row"><a href="{{ route('tecnico.audiencias.buscar.editar', $solicitud->id) }}" class="btn btn-primary fa fa-pencil"> </a>	</th>
     
                          
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


<form id="form-verificar-disponibilidad" action="{{ route('tecnico.verificar.estado.solicitud',':ESTADO_ID') }}" method="POST">
    @csrf
</form>



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/audiencias/adminAudiencias.js"></script> 



<div class="container-fluid">
    @include('audiencias.tecnico.modal.modal_revisar_solicitud',['solicitudAudiencia'=> $solicitudAudiencia,
             'url'=> 'virtual.audiencia.confirmar', 'method'=>'POST'])   
 </div>
   
@push('scripts')
 
<script src="/js/audiencias/tecnico.js"></script> 

  @endpush

@endsection