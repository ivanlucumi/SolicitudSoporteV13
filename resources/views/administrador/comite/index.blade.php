@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Comite Genero Documentos')
@section('cabecera', 'Comite Genero Documentos')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<div class="container">
				<a href="{!! url('/administrador/create-documentos')!!}" class="btn btn-warning">Crear Documento</a>
			</div>
		</div>
	</div>
	<hr>
       
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>TITULO</th>
				<th>DOCUMENTO</th>
				<th>CREADOR</th>
				<th>MODIFICADOR</th>
				<th>ACCIONES</th>					     				
		    </tr>
	    </thead>
	    @if($comite != null)
		    @foreach($comite as $cmte)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$cmte->cgtitulo}}</th>
					<th scope="row">
						<a  href="#"
                            onClick="window.open('/img/{{$cmte->cgdocumento}}','popup', 'width=800px,height=600px')">
                            Ver Archivo
                        </a>
					</th>																	
					<th scope="row">{{$cmte->creador}}</th>
					<th scope="row">{{$cmte->modificador}}</th>
					<th scope="row">
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ route('edit-documentos', $cmte->id) }}" class="btn btn-primary fa fa-pencil"> </a>
							</div>
							<div class="col-xs-6">
								<a href="" data-target="#modal-delete-{{$cmte->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-close"></button></a>	
							</div>
						</div>
					</th>					     
				</tr>	                
			</tbody>
			@include('administrador.comite.modaleliminar')
			@endforeach
		@endif
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterDocumentosGenero.js"></script> 
@endsection