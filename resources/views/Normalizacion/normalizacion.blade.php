
@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios')
@section('cabecera', 'RADICACIONES DISPONIBLES')



@section('content') 
<center><p>RADICACIONES TOMADAS</p></center>
 <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RADICACION EN CARPETA</th>
		        <th>RADICADO NORMALIZADO</th>
		        <th>ACCION</th>
		    </tr>
	    </thead>
	    
		    @foreach($expedientesTomados as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
			   @if($digit->correcion == null)
				<tr class="table-light" >
				    <th scope="row">{{$digit->despacho}}</th>
				    <th scope="row">{{$digit->radicacion}}</th>
				    <th>
                       <center>
                        
                          <form action="{{ route('normalizacion.registro') }}" method="POST">
    @csrf         
                            <input class="form-control" type="hidden" name="RadicadoTomado" id="RadicadoTomado" value="{{ $digit->radicacion }}">
                            <button class="fa fa-save btn btn-warning btn-block elevation-3" type="submit">REGISTRAR</button>                        
                          </form>
                        
                        
                       </center>
                    </th> 
				</tr>
			  @endif
			</tbody>
			@endforeach
	</table>
	
</div>
<hr>

  <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RADICADO</th>
		        <th>ACCION</th>
		    </tr>
	    </thead>
	    
		    @foreach($expedientes as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
			   @if($digit->correcion == null)
				<tr class="table-light" >
				    <th scope="row">{{$digit->radicacion}}</th>
				    <th>
                       <center>
                        @if($digit->user ===  auth()->user()->id)
                          <form action="{{ route('normalizacion.registro.tomar') }}" method="POST">
    @csrf         
                            <input class="form-control @error('RTomar') is-invalid @enderror" type="text" name="RTomar" id="RTomar" value="{{ old('RTomar', $digit->radicacion) }}">
@error('RTomar')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            <button class="fa fa-save btn btn-warning btn-block elevation-3" type="submit">Soltar</button>                        
                          </form>
                        @endif
                        @if($digit->user === null)
                        <form action="{{ route('normalizacion.registro.tomar') }}" method="POST">
    @csrf         
                            <input class="form-control" type="hidden" name="RTomar" id="RTomar" value="{{ $digit->radicacion }}">
                            <button class="fa fa-save btn btn-warning btn-block elevation-3" type="submit">TOMAR</button>                        
                          </form>
                        @endif
                        @if($digit->user !=  auth()->user()->id && $digit->user != null)
                        <button class="btn btn-warning btn-block " disabled> </button>
                        @endif
                        
                       </center>
                    </th> 
				</tr>
			  @endif
			</tbody>
			@endforeach
	</table>
	
</div>
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>    

<script src="/js/filterDosNormalizacion.js"></script>

@endsection

