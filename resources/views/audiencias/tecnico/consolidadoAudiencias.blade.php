@extends('layouts.tecnicos')
<!--ponerle titulo a la paginga-->
@section('title', 'Descarga de consolidado agendamiento')
@section('cabecera', ' Agendamiento de Audiencias LifeSize ')

@section('content') 



<div class="container-fluid">
  <div class="" style="text-align: right">
    <nav class="navbar navbar-light bg-light">
      <form action="{{ route('agendadas.por.tecnico') }}" method="POST">
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
        <input class="form-group mr-sm-2 shadow @error('ciudad') is-invalid @enderror" placeholder="Buscar por ciudad" autocomplete="off" aria-label="Search" type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') }}">
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <!--button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button-->
      </form>
    </nav>
  </div>
  
</div>




<div class="table-responsive shadow">
	<table id="table9" class="table  table-hover table-condensed table-bordered " style="display: block;
  overflow: auto;
  width: 100%;
  height: 800px">
	
	</div>	
	    <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr class="shadow">
		        <th>EMAIL</th>
				<th>NOMBRE ENTIDAD</th>
				<th>FECHA PROGRAMADA</th>
				<th>INICIO</th>
				<th>FIN</th>					     
				<th>RADICADO</th>
				<th>ID</th>					     
                <th>URL</th>						     
				
		    </tr>
	    </thead>
      
            @if($solicitudes != null)
            @foreach($solicitudes as $solicitud)
            <tbody data-id="{!!$solicitud->id!!}" class="buscar " >
                <tr class="table-light">
                    <th scope="row">{{$solicitud->email}}</th>									
                    <th >{{$solicitud->nombre_entidad}}</th>
                    <th scope="row">{{$solicitud->fecha_prgramada}}</th>
                    <th scope="row">{{$solicitud->hora_inicio}}</th>									
                    <th scope="row">{{$solicitud->hora_fin}}</th>						
                    <th scope="row">{{$solicitud->numero_radicado_proceso}}</th>
                    <th scope="row">{{$solicitud->id_conexion}}</th>
                    <th scope="row">{{$solicitud->enlace}}</th>

                    
                    </th>        
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



   
  @push('scripts')
    
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/audiencias/filtroaudienciatecnico.js"></script>  
<script src="/js/audiencias/tecnico.js"></script> 

  @endpush

@endsection