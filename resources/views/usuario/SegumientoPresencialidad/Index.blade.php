@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Seguimiento Presencialidad')

@section('cabecera', 'Seguimiento Presencialidad')

@section('content') 

<div class="" style="text-align: left">	
	<a href="{!! route('usuario.seguimient.presencialidad.dowload')!!}" class="btn btn-warning btn-sm" >Descargar Mis Registros</a>
</div>
<br>
<div class="" style="text-align: left">	
	<a href="{!! route('usuario.seguimient.presencialidad.dowload.todo')!!}" class="btn btn-warning btn-sm" >Descargar Todo</a>
</div>

<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>DESPACHO</th>
				<th>CIUDAD</th>
				<th>TELEFONO</th>
				<th>EMAIL</th>
				<th>CIRCUITO</th>
				<th>REGISTRAR ASISTENCIA</th>
				
		    </tr>
	    </thead>
	    @if($despacho != null)
		    @foreach($despacho as $key =>$dirto)
		    
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row"> {{$dirto->nombreDespacho}}</th>									
					<th scope="row">{{$dirto->ciudad}}</th>
					<th scope="row">{{$dirto->telefono}}</th>									
					<th scope="row">{{$dirto->correoD}}</th>
					<th scope="row">{{$dirto->circuito}}</th>
					<th scope="row">
					    <?php
                             $key = DB::table('seguimiento_presencialidad')
                            ->where('codigoDespacho_id',$dirto->codigoDespacho)
                            ->where('fecha_registro_asistencia',$fecha_act)
                            ->get(); 
                         ?>
					    @switch($dia_semana)
                            
                                 @case (1)
                                  
                                    @if($key->isEmpty())
                                    <form action="{{ route('usuario.seguimient.presencialidad.registrar') }}" method="POST">
    @csrf
                                        <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                					    <input type="hidden"  name="dia" value="LUNES" required>
                					<button class="fa fa-save btn btn-danger btn-block elevation-3" type="submit">LUNES</button>                        
                                    </form>
                                    @else
                                     <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 @case (2)
                                     @if($key->isEmpty())
                                        <form action="{{ route('usuario.seguimient.presencialidad.registrar') }}" method="POST">
    @csrf
                                            <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                    					    <input type="hidden"  name="dia" value="MARTES" required>
                    					    <button class="fa fa-save btn btn-danger btn-block elevation-3" type="submit">MARTES</button>                        
                                        </form>
                                        @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                        @endif
                                 @break;
                                 @case (3)
                                     @if($key->isEmpty())
                                      <form action="{{ route('usuario.seguimient.presencialidad.registrar') }}" method="POST">
    @csrf
                                        <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                					    <input type="hidden"  name="dia" value="MIERCOLES" required>
                					<button class="fa fa-save btn btn-danger btn-block elevation-3" type="submit">MIERCOLES</button>                        
                                    </form>
                                    @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 @case (4)
                                    @if($key->isEmpty())
                                        <form action="{{ route('usuario.seguimient.presencialidad.registrar') }}" method="POST">
    @csrf
                                            <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                    				        <input type="hidden"  name="dia" value="JUEVES" required>
                    					    <button class="fa fa-save btn btn-danger btn-block elevation-3" type="submit">JUEVES</button>                        
                                        </form>
                                    @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 @case (5)
                                 @if($key->isEmpty())
                                    <form action="{{ route('usuario.seguimient.presencialidad.registrar') }}" method="POST">
    @csrf
                                        <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                    					<input type="hidden"  name="dia" value="VIERNES" required>
                					    <button class="fa fa-save btn btn-danger btn-block elevation-3" type="submit">VIERNES</button>                        
                                    </form>
                                    @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 
                            
                        @endswitch
					</th>
									     
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
<!--@if(isset($ip))
 @if($ip =="190.217.19.164")-->
<!--@else
    <tr class="table-light">
			<p class="lead"><center><h1> ESTE REGISTRO SOLO SE PUEDE HACER DESDE LA OFICINA.</h1></center></p3>
		</tr>
@endif
@endif-->

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Seguimiento.js"></script>  

@endsection