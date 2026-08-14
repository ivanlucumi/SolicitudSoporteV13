@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios')
@section('cabecera', 'Solicitudes enviadas y sin resolver')

@section('content') 
<div class="container-fluid">
    <div class="" style="text-align: right">
      <nav class="navbar navbar-light bg-light">
        <form action="{{ route('digitalizacion.inicio') }}" method="POST">
    @csrf
        <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar por radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('despacho') is-invalid @enderror" placeholder="Buscar por despacho" autocomplete="off" aria-label="Search" type="text" name="despacho" id="despacho" value="{{ old('despacho') }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('municipio') is-invalid @enderror" placeholder="Buscar por municipio" autocomplete="off" aria-label="Search" type="text" name="municipio" id="municipio" value="{{ old('municipio') }}">
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('especialidad') is-invalid @enderror" placeholder="Buscar por especialidad" autocomplete="off" aria-label="Search" type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
        </form>
      </nav>
    </div>
    
  </div>
<hr>
@if($estadisticaDigitalizacion != null)

<p>
   <justify><h3><strong>REVISADO POR MI: {{$estadisticaDigitalizacion[0]->cantidad}} EXPEDIENTES</strong></h3></justify>
</p>

@endif

<hr>

    <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RadDig</th>
		        <th>RADICADO</th>
				<th>ACCIONES</th>
		        <th>DESPACHO</th>
		        <th>MUNICIPIO</th>
		        <th>ESPECIALIDAD</th>
				<th>CANTIDAD</th>
				<th>OBSERVACIONES</th>
				
		    </tr>
	    </thead>
	    
		    @foreach($digitalizado as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
				<tr class="table-light" >
				    <th scope="row">{{strlen($digit->radicacion)}}</th>	
				    <th scope="row">{{$digit->radicacion}}</th>	
					<th scope="row">
					    <a href="{{ route('digitalizacion.revisar', [$digit->id]) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Revisar"></a>
					    <a href="{{ route('supervisor.sinregistro', $digit->id) }}" class="btn btn-warning btn-xs mb-2" title="Sin Registro">S-R</a>
					</th>
					<th scope="row">{{$digit->despacho}}</th>									
					<th scope="row">{{$digit->municipio}}</th>									
					<th scope="row">{{$digit->especialidad}}</th>
					<th scope="row">{{$digit->cantidad}}</th>
					<th scope="row">{{$digit->observaciones}}</th>
					
				</tr>	                
			</tbody>
			@endforeach
	</table>
	
	
	$digitalizado->appends(['radicado' => $radicado','despacho' => $despacho','municipio' => $municipio','especialidad' => $especialidad'])->links();
	{{ $digitalizado->links() }}
	
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>     

@endsection