@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Seguimiento Presencialidad Despacho')


@section('cabecera', 'REGISTRO ASISTENCIA A DESPACHO')

@section('content') 

<div class="" style="text-align: left">	
	<a href="{!! route('usuario.seguimient.presencialidad.dowload')!!}" class="btn btn-warning btn-sm" >Descargar Mis Registros</a>
</div>
<br>

<p>
    <h4>
        SIRIS no permite realizar solicitudes de teletrabajo nuevas, es para que los funcionarios que ya cuentan con autorizaci&oacute;n de teletrabajo hagan el registro de novedades e indiquen si asisten o no a la oficina durante el d&iacute;a de teletrabajo
    </h4>
</p>

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
				<th>REGISTRAR No. ASISTENTES</th>
				
		    </tr>
	    </thead>
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
                            ->where('codigoDespacho_id', auth()->user()->cedula)
                            ->where('fecha_registro_asistencia',$fecha_act)
                            ->get(); 
                         ?>
					    @switch($dia_semana)
                            
                                 @case (1)
                                  
                                    @if($key->isEmpty())
                                    <form action="{{ route('usuario.seguimient.presencialidad.despacho.registra') }}" method="POST">
    @csrf
                                        <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                					    <input type="hidden"  name="dia" value="LUNES" required>
                					    <input type="number"  name="num_funcionarios" min=1  style="width: 100px;" placeholder="# Asistentes" required>
                					<button class="fa fa-save btn btn-danger  elevation-3" type="submit">LUNES</button>                        
                                    </form>
                                    @else
                                     <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 @case (2)
                                     @if($key->isEmpty())
                                        <form action="{{ route('usuario.seguimient.presencialidad.despacho.registra') }}" method="POST">
    @csrf
                                            <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                    					    <input type="hidden"  name="dia" value="MARTES" required>
                					    <input type="number"  name="num_funcionarios" min=1  style="width: 100px;" placeholder="# Asistentes" required>
                    					    <button class="fa fa-save btn btn-danger  elevation-3" type="submit">MARTES</button>                        
                                        </form>
                                        @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                        @endif
                                 @break;
                                 @case (3)
                                     @if($key->isEmpty())
                                      <form action="{{ route('usuario.seguimient.presencialidad.despacho.registra') }}" method="POST">
    @csrf
                                        <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                					    <input type="hidden"  name="dia" value="MIERCOLES" required>
                					    <input type="number"  name="num_funcionarios" min=1  style="width: 100px;" placeholder="# Asistentes" required>
                					<button class="fa fa-save btn btn-danger elevation-3" type="submit">MIERCOLES</button>                        
                                    </form>
                                    @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 @case (4)
                                    @if($key->isEmpty())
                                        <form action="{{ route('usuario.seguimient.presencialidad.despacho.registra') }}" method="POST">
    @csrf
                                            <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                    				        <input type="hidden"  name="dia" value="JUEVES" required>
                					    <input type="number"  name="num_funcionarios" min=1  style="width: 100px;" placeholder="# Asistentes" required>
                    					    <button class="fa fa-save btn btn-danger elevation-3" type="submit">JUEVES</button>                        
                                        </form>
                                    @else
                                         <button class="fa fa-save btn btn-success btn-block elevation-3" disabled> YA SE REGISTRO</button>
                                    @endif
                                 @break;
                                 @case (5)
                                 @if($key->isEmpty())
                                    <form action="{{ route('usuario.seguimient.presencialidad.despacho.registra') }}" method="POST">
    @csrf
                                        <input type="hidden"  name="codigoDespacho_id" value="{{$dirto->codigoDespacho}}" required>
                    					<input type="hidden"  name="dia" value="VIERNES" required>
                					    <input type="number"  name="num_funcionarios" min=1  style="width: 100px;" placeholder="# Asistentes" required>
                					    <button class="fa fa-save btn btn-danger  elevation-3" type="submit">VIERNES</button>                        
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
<hr>
<h1><center> REGISTRO DE ASISTENCIA </center></h1>
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	
	</div>	
	    <thead style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>DESPACHO</th>
				<th>CIRCUITO</th>
				<th>DIA</th>
				<th># SERVIDORES JUDICIALES</th>
				<th>FECHA REGISTRO</th>
				
				
		    </tr>
	    </thead>
		    @foreach($asistencias as $key =>$dirto)
		    
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row"> {{$dirto->nombreDespacho}}</th>
					<th scope="row">{{$dirto->circuito}}</th>
					<th scope="row">{{$dirto->asistencia}}</th>
					<th scope="row">{{$dirto->num_funcionarios}}</th>
					<th scope="row">{{$dirto->fecha_registro_asistencia}}</th>
					
									     
				</tr>	                
			</tbody>
			@endforeach
	</table>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Seguimiento.js"></script>  

@endsection