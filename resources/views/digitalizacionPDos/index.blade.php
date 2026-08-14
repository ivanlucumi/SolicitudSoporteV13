@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios Protocolo Dos')
@section('cabecera', 'Solicitudes enviadas y sin resolver Protocolo Dos')

@section('content') 
<div class="container-fluid">
    <div class="" style="text-align: right">
      <nav class="navbar navbar-light bg-light">
        <form action="{{ route('prodos.inicio') }}" method="POST">
    @csrf
        <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar por radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('despacho') is-invalid @enderror" placeholder="Buscar por despacho" autocomplete="off" aria-label="Search" type="text" name="despacho" id="despacho" value="{{ old('despacho') }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('municipio') is-invalid @enderror" placeholder="Buscar por Municipio" autocomplete="off" aria-label="Search" type="text" name="municipio" id="municipio" value="{{ old('municipio') }}">
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('especialidad') is-invalid @enderror" placeholder="Buscar por especialidad" autocomplete="off" aria-label="Search" type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        @if( auth()->user()->email == "gmstdesajvalle3@cendoj.ramajudicial.gov.co")
        <!--<input class="form-group mr-sm-2 shadow @error('cantidad') is-invalid @enderror" placeholder="cantidad" autocomplete="off" aria-label="Search" type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}">
@error('cantidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror-->
        @endif
       
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
@if($digitalizado != null)
<p>
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form target="_blank" action="{{ route('descarga.prodos.inicio') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-3 form-group">
					<select class="form-control @error('mes') is-invalid @enderror" name="mes" id="mes">
    <option value="">Seleccione Mes a Consultar</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mes') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
					<div class="col-xs-12 col-sm-3">
						<button class="btn btn-warning btn-md" type="submit">Descargar Mis Revisiones</button>
						</form>
					</div>
				</div>
			</div>
		</div>
</p>
@endif
<hr>

    <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RADICADO</th>
				<th>ACCIONES</th>
		        <th>DESPACHO</th>
				
		    </tr>
	    </thead>
	    
		    @foreach($digitalizado as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
				<tr class="table-light" @if($digit->quien_tomo ==  auth()->user()->id)
                <?php echo 'style="background-color: #C3F8BC"'; ?>
                @endif
                @if($digit->quien_tomo == null)                 
                <?php echo 'style="background-color: #"'; ?>
                @endif
                @if($digit->quien_tomo !=  auth()->user()->id)
                <?php echo 'style="background-color: #FBBAB4"'; ?>
                @endif >	
				    <th scope="row">{{$digit->radicacion}}</th>	
					<th scope="row">
					    @if($digit->quien_tomo ==  auth()->user()->id || $digit->quien_tomo == null)
					    <a href="{{ route('prodos.revisar', [$digit->id]) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Revisar" target="_blank"></a>
					    <a href="{{ route('supervisor.protocolo.dos.sinregistro', $digit->id) }}" class="btn btn-warning btn-xs mb-2" title="Sin Registro">S-R</a>
					    
					    <a href="{{ route('supervisor.protocolo.dos.corregido', $digit->id) }}" class="btn btn-success btn-xs mb-2" title="Corregido">CORREGIDO</a>
					    @endif
					</th>
					<th scope="row">{{$digit->despacho}}</th>	
					
				</tr>	                
			</tbody>
			@endforeach
	</table>
	{!! $digitalizado->appends(Request::all())->links() !!}
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>     
<script src="/js/FilterSietePdos.js"></script>

@endsection