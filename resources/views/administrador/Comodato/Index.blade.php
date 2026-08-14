@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Impresoras en Comodato')
@section('cabecera', ' Impresoras en Comodato ')

@section('content') 


<div class="table-responsive shadow">
	<table id="table9" class="table table-bordered table-striped" style="display: block;  overflow: auto;  width: 100%;  height: 800px" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		  <tr>
		    <th># CAJA</th>
				<th>SERIE</th>
				<th>MARCA</th>
				<th>MODELO</th>
				<th>ESTADO</th>
				<th>FECHA INST.</th>
				<th>DESPACHO</th>					     
				<th>TIPO INST</th>
				<th>IP</th>
				<th>OBSERVACIONES</th>			     
				
		    </tr>
	    </thead>
      
            @if($impresoras != null)
            @foreach($impresoras as $solicitud)
            
            <tbody class="buscar " >
                <tr class="table-light" >
                    <th scope="row">{{$solicitud->num_caja}}</th>									
                    <th scope="row">{{$solicitud->serie}}</th>
                    <th scope="row">{{$solicitud->marca}}</th>
                    <th scope="row">{{$solicitud->modelo}}</th>									
                    <th scope="row">{{$solicitud->estado}}</th>	
                    <th scope="row">{{$solicitud->Intalacion ? $solicitud->Intalacion->fecha_instalacion:" " }}</th>
                    <th scope="row">{{$solicitud->Intalacion ? $solicitud->Intalacion->despacho:" "}}</th>					
                    <th scope="row">{{$solicitud->Intalacion ? $solicitud->Intalacion->tipo_instalacion:" "}}</th>
                    <th scope="row">{{$solicitud->Intalacion ? $solicitud->Intalacion->ip:" "}}</th>
                    <th scope="row">{{$solicitud->Intalacion ? $solicitud->Intalacion->observaciones:" "}}</th>
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
<script src="/js/comodato/filter.js"></script> 

@push('scripts')
 


  @endpush

@endsection