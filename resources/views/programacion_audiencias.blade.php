@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Prograci&oacute;n Audiencias')

@section('content') 
@include('/alerts.success')
@include('/alerts.request')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<p class="lead" ><h2 style="text-align: center; text-transform: uppercase;">consulta AUDIENCIAS JUZGADOS PALACIO DE JUSTICIA   CALI</h2></p>
		</div>
	</div>
	<hr>

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<p style="font-size: 22px; text-align: center;">Señor(@) usuario, seleccione la torre de la cual desea conocer las salas con sus respectivas audiencias.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<a href="{!! url('/programacion_torre_a')!!}"><h3><center>Torre A <br>Civil - Familiar - laboral <br><img src="/img/building.png"></center></h3></a>

		</div>
		<div class="col-xs-12 col-sm-6">
			<a href="{!! url('/programacion_torre_b')!!}"><h3><center>Torre B <br>Penal <br><img src="/img/building.png"></center></h3></a>			
		</div>
	</div>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/reservasi.js"></script> 



@endsection