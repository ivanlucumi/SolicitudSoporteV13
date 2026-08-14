@extends('layouts.tecnicos')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes')
@section('cabecera', ' Solicitudes de Usuarios')

@section('content') 
@include('alerts.success')
@include('alerts.request')
<link rel="stylesheet" href="/css/style.css">

@foreach($solicitudes as $solicitud)

<div class="panel panel-warning">
	  <div class="panel-heading">
	    <h3 class="panel-title"><strong style="font-size:30px">DESPACHO:  {{strtoupper($solicitud->usuario)}}</strong></h3>
	  </div>
  <div class="panel-body">
	    <div class="row">

		      <div class="col-xs-4">
		        <div class="col-xs-6 col-md-6">
		          SOLICITÓ:
		        </div>
		        <div class="col-xs-12 col-md-6 estiloShow">
		          {{strtoupper($solicitud->nombre)}}  {{strtoupper($solicitud->apellido)}}
		        </div>
		      </div>

		      <div class="col-xs-4 ">
		        <div class="col-xs-12 col-md-6">
		          EDIFICIO:
		        </div>
		        <div class="col-xs-12 col-md-6 estiloShow">
		          {{strtoupper($solicitud->edificio)}}
		        </div>
		      </div>

		      <div class="col-xs-4">
		        <div class="col-xs-12 col-md-6">
		          REQUERIMIENTO:
		        </div>
		        <div class="col-xs-12 col-md-6 estiloShow">
		          {{strtoupper($solicitud->nombrerequerimiento)}}
		        </div>
		      </div>
	      
	    </div>
	 <hr>
	    <div class="row">

	      <div class="col-xs-12 col-md-6">
	        <div class="col-xs-12 col-md-4">
	          CATEGORIA:
	        </div>
	        <div class="col-xs-12 col-md-8 estiloShow">
	          {{strtoupper($solicitud->categoria)}}
	        </div>
	      </div>
	      
	       <div class="col-xs-12 col-md-6">
	        <div class="col-xs-12 col-md-6">
	          ELEMENTO:
	        </div>
	        <div class="col-xs-12 col-md-6 estiloShow">
	          {{strtoupper($solicitud->nombreelemento)}}
	        </div>
	      </div>
	           
	    </div>

	<hr>
	     <div class="row">
		      <div class="col-xs-12">
		         <div class="col-xs-12 col-md-3">
			        DESCRIPCION:	        
			     	 </div>
			      	 <div class="col-xs-12 col-md-3 estiloShow">
			        {{strtoupper($solicitud->descripcion)}}		        
			      </div>
		      </div>           
	   	 </div>
	    <hr>
	    	<div class="row">

	          	<div class="col-xs-4">	             
		        </div>

			        <div class="col-xs-4">
			            <a href="{!! url('/administrador/categorias/create')!!}" class="btn btn-warning btn-block">Asignar Visita</a>   
			        </div>

		        <div class="col-xs-4">	               
		        </div>

		     </div>

    </div>
</div>
 
 @endforeach 
@endsection
