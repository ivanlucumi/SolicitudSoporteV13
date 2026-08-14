@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Comité de Genero')

@section('content') 
<div class="row">
	<div class="col-xs-12 col-md-12">
		<p> <h2 style="text-align: center; text-transform: uppercase; font: 200% Footlight-MT-Light;">Comité de Genero</h2></p>
		<p style="text-align: justify; font-size: 18px; color: black;">	
			Colombia ha experimentado significativas transformaciones a nivel normativo en materia de protección especial a la mujer, especialmente luego de la expedición de la Constitución de 1991. Sin embargo para garantizar la igualdad y la no discriminación en la práctica, se precisa la adopción de medidas de orden pedagógico y administrativo que hagan realidad la equidad de género. <br>
			La administración de justicia no puede ser ajena a este propósito y por ello la Sala Administrativa del Consejo Superior de la Judicatura de Colombia creó la Comisión Nacional de Género en la Rama Judicial,mediante Acuerdo 4552 de 2008, la cual fue instalada el 9 de junio de 2008, con el propósito de promover la incorporación e institucionalización de la perspectiva de género en el quehacer de la labor judicial.
		</p>
	</div>
</div>
<hr>
@if($comitegaleria != null)
<div class="row">
	<div class="col-xs-12 col-md-12">
		<p> <h2 style="text-align: center; text-transform: uppercase; font: 200% Footlight-MT-Light;">Nuestra Galería</h2></p>
		<div class="row">
			@if($total == 1)
				<div class="col-xs-12 col-md-4"></div>
				<div class="col-xs-12 col-md-4">
					@foreach($comitegaleria as $cmtg)
						<img src="/img/{{$cmtg->cggImagen}}" class="img-responsive img-thumbnail" style="height: 300px; width: 300px;">
					@endforeach
				</div>
				<div class="col-xs-12 col-md-4"></div>
			@else
				@foreach($comitegaleria as $cmtg)
					<div class="col-xs-12 col-md-4">
						<img src="/img/{{$cmtg->cggImagen}}" class="img-responsive img-thumbnail" style="height: 300px; width: 300px;">
					</div>
				@endforeach				
			@endif
		</div><br>
		<div >
			<center><a href="{!! url('/comite_genero_galeria')!!}" class="btn btn-block fa fa-eye" style="background-color: #004182; color: #fff;"> Ver más</a></center>
		</div>		
	</div>
</div>
<hr>
@endif
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="table-responsive">
			<table id="table9" class="table  table-hover table-condensed table-bordered ">
			
				<caption>
					<p > <h2 style="text-align: center; text-transform: uppercase; font: 200% Footlight-MT-Light;">Documentos</h2> </p>
				</caption>
			    <thead style="background-color: #004182; color: #fff;">
				    <tr>
				        <th>T&Iacute;TULO</th>
						<th>PUBLICACIÓN</th>
						<th>ARCHIVO</th>						
				    </tr>
			    </thead>
			    @if($informe != null)
				    @foreach($informe as $ifn)
					<tbody class="buscar">
						<tr class="table-light">
							<th scope="row">{{$ifn->cgtitulo}}</th>									
							<th scope="row">{{$ifn->created_at}}</th>
							<th scope="row">
								<a href="" onClick="window.open('/img/{{$ifn->cgdocumento}}','popup', 'width=800px,height=600px')" class="product-title"><img src="/img/pdf.svg" alt="Product Image" class="img-fluid" style="height: 50px; max-height: 80px;">
		                    	<div class="mask flex-center waves-effect waves-light">Ver</div></a>
		                	</th>												     
						</tr>	                
					</tbody>
					@endforeach
				@else
				<tr class="table-light">
					<p class="lead">Actualmente esta secci&oacute;n no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
				</tr>
				@endif
			</table>
		</div>
	</div>

	<div class="col-xs-12 col-md-12">
		<div class="table-responsive">
			<table id="table10" class="table  table-hover table-condensed table-bordered ">
			
				<caption>
					<p > <h2 style="text-align: center; text-transform: uppercase; font: 200% Footlight-MT-Light;">Enlaces de interés</h2> </p>
				</caption>
			    <thead style="background-color: #004182; color: #fff;">
				    <tr>
				        <th>T&Iacute;TULO</th>
						<th>DESCRIPCION</th>
						<th>PUBLICACIÓN</th>						
						<th>ENLACE</th>						
				    </tr>
			    </thead>
			    @if($comieenlaces != null)
				    @foreach($comieenlaces as $ifn)
					<tbody class="buscar">
						<tr class="table-light">
							<th scope="row">{{$ifn->cgetitulo}}</th>									
							<th scope="row">{{$ifn->cgedescripcion}}</th>
							<th scope="row">{{$ifn->created_at}}</th>
							<th scope="row">
								<a href="{{$ifn->cgelink}}" target="_blank">Visitar Enlace</a>
		                	</th>												     
						</tr>	                
					</tbody>
					@endforeach
				@else
				<tr class="table-light">
					<p class="lead">Actualmente esta secci&oacute;n no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
				</tr>
				@endif
			</table>
		</div>
	</div>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCGdocumentos.js"></script>  
<script src="/js/filterCGgaleria.js"></script>  

@endsection