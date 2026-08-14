
@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Usuarios')
@section('cabecera', 'Solicitudes enviadas y sin resolver')



@section('content') 

<hr>
<P>PROCESOS POR REVISAR </P>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            SIN REGISTRO:<h1 style="color:red"> {{$SinR}}</h1>
        </div>
        <div class="col-xs-12 col-sm-4">
            CON OBSERVACIONES <h1 style="color:red">  {{$observa}}</h1>
        </div>
        <div class="col-xs-12 col-sm-4">
            PARA UN TOTAL DE <h1 style="color:red">  {{$cantidad}}</h1>
        </div>
        
    </div>
    
</div>

<hr>
  <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RadDig</th>
		        <th>RADICADO</th>
		        <th>DESPACHO</th>
		        <th>MUNICIPIO</th>
		        <th>ESPECIALIDAD</th>
				<th>CANTIDAD</th>
				<th>ESTADO</th>
				<th>OBSERVACIONES</th>
				@if( auth()->user()->email == "servisoft@disajcali.gov.co")
				<th>CORRECIONES</th>
				<th>ACCIONES</th>
				@endif
		    </tr>
	    </thead>
	    
		    @foreach($digitalizado as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
			   @if($digit->correcion == null)
				<tr class="table-light" >
				    <th scope="row">{{strlen($digit->radicacion)}}</th>
					<th scope="row">{{$digit->radicacion}}</th>									
					<th scope="row">{{$digit->despacho}}</th>									
					<th scope="row">{{$digit->municipio}}</th>									
					<th scope="row">{{$digit->especialidad}}</th>
					<th scope="row">{{$digit->cantidad}}</th>
					<th scope="row">{{$digit->estado}}</th>
					<th scope="row">{{$digit->observaciones}}</th>
					@if( auth()->user()->email == "servisoft@disajcali.gov.co")
					<form action="{{ route('supervisor.servisoft',$digit->id) }}" method="POST">
    @csrf
    @method('PUT')          
					<th scope="row"><input type="text"  name="correccion" required></th>
					
					<th scope="row"><button class="fa fa-save btn btn-success btn-block elevation-3" type="submit">OK</button>                        
                    </form></th>
                    @endif
			
				</tr>
			  @endif
			</tbody>
			@endforeach
	</table>
	{{ $digitalizado->links() }}
</div>
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>    

@endsection

