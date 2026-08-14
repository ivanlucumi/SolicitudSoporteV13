
@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Verificacion Servisoft')
@section('cabecera', 'Expedientes Con Novedades Protocolo Dos 1')



@section('content') 


<hr>
<P><strong><h2><center>PROCESOS POR REVISAR PROTOCOLO 2</center></h2></strong> </P><hr>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-2">
            SIN REGISTRO:<h1 style="color:red"> {{$SinRPDos}}</h1>
        </div>
        <div class="col-xs-12 col-sm-3">
            CON OBSERVACIONES <h1 style="color:red">  {{$observaPDos}}</h1>
        </div>
        <div class="col-xs-12 col-sm-3">
            PARA UN TOTAL DE <h1 style="color:red">  {{$cantidadPDos}}</h1>
        </div>
        <div class="col-xs-12 col-sm-2">
        ESTAN O.K <h1 style="color:red">  {{$cantidadOk}}</h1>
        </div>
        <!--div class="col-xs-12 col-sm-2">
        FOLIOS<h1 style="color:red">  {{number_format($proto2FoliosRevi, 0, ',', '.')}}</h1>
        </div-->
        
    </div>
    
</div>


<hr>
  <div class="table-responsive">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RADICADO</th>
		        <th>DESPACHO</th>
		        <th>ESPECIALIDAD</th>
				<th>ESTADO</th>
				<th>FECHA REVISI&Oacute;N</th>
				<th>FECHA CORRECI&Oacute;N</th>
				<th>OBSERVACIONES</th>
		    </tr>
	    </thead>
	    
		    @foreach($digitalizado as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
			   @if($digit->correcion == null)
				<tr class="table-light" >
					<th scope="row">{{$digit->radicacion}}</th>									
					<th scope="row">{{$digit->despacho}}</th>									
					<th scope="row">{{$digit->especialidad}}</th>
					<th scope="row">{{$digit->estado}}</th>
					<th scope="row">{{$digit->fecha_revision}}</th>
					<th scope="row">{{$digit->updated_at}}</th>
					<th scope="row">{{$digit->observaciones}}</th>
                   
				</tr>
			  @endif
			</tbody>
			@endforeach
	</table>
	{{ $digitalizado->links() }}
</div>
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>    
<script src="/js/conObservaciones.js"></script>

@endsection

