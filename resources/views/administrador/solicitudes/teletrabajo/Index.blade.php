@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'TELETRABAJO')

@section('cabecera', 'TELETRABAJO')

@section('content') 
@include('alerts.flash-message')
<div class="row">
   <div class="col-xs-12 col-sm-8">
            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('admin.teletrabajo.registro.excel') }}" method="POST">
    @csrf
               <div class="col-xs-12 col-sm-6 ">
                        <label for="despacho">Seleccione Mes:</label>
                        <select class="form-control select2 @error('mes') is-invalid @enderror" autocomplete="off" name="mes" id="mes">
    <option value="">Seleccione Mes para descargar</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mes') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                    </div><br>
                <button class="form-group btn btn-success btn-md my-2 my-sm-0 shadow" type="submit">DESCARGAR EXCEL POR MES</button>
                  
              </form>
            </nav>
          
       
    </div>
    <div class="col-xs-12 col-sm-4">
        <label for="despacho">Descargar Excel:</label><br>
        <a href="{!! route('admin.teletrabajo.registro.excel')!!}" class="btn btn-danger btn-md">DESCARGAR TODO</a>
    </div>
</div>

 

<center><h3><strong>INFORME TELETRABAJO REALIZADO POR DESPACHOS </strong></h3></center>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>ID DESPACHO</th>
		        <th>DESPACHO</th>
		        <th>IDENTIFICACION</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>EN TELETRABAJO</th>
				<th>FECHA REGISTRO</th>
				
		    </tr>
	    </thead>
	    
	    @if($resultado != null)
		    @foreach($resultado as $key =>$dirto)
		    
			<tbody class="buscar">
			    
				<tr class="table-light">
				    
					<th scope="row"> {{$dirto->codigoDespacho_id}}</th>
					<th scope="row"> {{$dirto->despacho_r}}</th>
					<th scope="row"> {{$dirto->identificacion}}</th>									
					<th scope="row">{{$dirto->nombre_servidor}}</th>
					<th scope="row">{{$dirto->cargo}}</th>
					<th scope="row">{{$dirto->teletrabajo}}<br>{{$dirto->novedad}}</th>
					<th scope="row">{{$dirto->fecha_registro_asistencia}}</th>
        			
    				
									     
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


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Seguimiento.js"></script>  


@endsection