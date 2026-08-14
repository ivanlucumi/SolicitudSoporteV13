@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Asignacion de Computadores')
@section('cabecera', 'Distribucion Equipos')
@section('content') 

<style>
        .card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .banner-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .banner-img {
            width: 100%;
            display: none;
            height:300px;
        }

        .banner-img.active {
            display: block;
        }

        .banner-text {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #B62516;
            color: #fff;
            padding: 8px;
            font-weight: bold;
        }

        .content {
            padding: 16px;
        }
    </style>
    

<center><h1><strong> DISTRIBUCI&Oacute;N EQUIPOS 2024</strong></h1></center>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
            <strong><h3 style='text-align:left; color:rgba(199, 0, 57);'> TIENE ASIGNADO {{$cantidad}} COMPUTADOR(ES)</h3></strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
            <strong><h3 style='text-align:right; color:rgba(199, 0, 57);'>TIENE REGISTRADO {{$registros}} COMPUTADOR(ES)</h3></strong>
        </div>
    </div>
</div>
    
    

<hr>
 <div class="box-body">
     @if($registros < $cantidad)
	            	<div class="container-fluid"> 
						<form id="form-clasificados" action="{{ route('usuario.save.asignacion.computador') }}" method="POST" enctype="multipart/form-data">
    @csrf
					            	      		
					            	
    						              <div class="row">
    						                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
    						                  	
    						                         <label for="categoria">IDENTIFICACION:</label><br>
    						                         <input placeholder="Ingrese Numero identificacion" class="form-control  @error('identificacion') is-invalid @enderror" type="number" name="identificacion" id="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
    						                   
    						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
						                  	
						                         <label for="producto">NOMBRE:</label><br>
						                         <input placeholder="Registre Nombre Completo" class="form-control  @error('funcionario') is-invalid @enderror" type="text" name="funcionario" id="funcionario" value="{{ old('funcionario') }}">
@error('funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-6 form-group ">
						                  	
						                         <label for="producto">Correo: (CORREO PERSONAL INSTITUCIONAL DEL FUNCIONARIO)</label><br>
						                         <input placeholder="Registre Correo Personal Institucional" class="form-control  @error('email_funcionario') is-invalid @enderror" id="modelo" type="email" name="email_funcionario" value="{{ old('email_funcionario') }}">
@error('email_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                        <span>Se validar&aacute; correo del funcionario registrado</span>
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-6 form-group " >
						                  	
						                         <label for="producto">IP DEL EQUIPO QUE SE VA A CAMBIAR:</label><br>
						                         <input placeholder="Registre IP del Equipo" class="form-control  @error('ip') is-invalid @enderror" pattern="\b(?:\d{1,3}\.){3}\d{1,3}\b" type="text" name="ip" id="ip" value="{{ old('ip') }}">
@error('ip')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror                   
						                    <p id="resultado"></p>
						                </div>
						                </div>
						              <hr>
						              <div class="row">
                        						<div class="col-xs-6 form-group">
                        							<button class="btn btn-success btn-block" type="submit">GUARDAR DATOS</button>
                        						</div>
                        						<div class="col-xs-6 form-group">
                        							<a href="{{ url()->previous() }}" class="btn btn-warning btn-block">CANCELAR</a>
                        							</form>
                        						</div>
                        						
                        			 </div>
@endif  
									<hr>
									
<div class="table-responsive">
	<table id="table9" class="table  table-hover table-condensed table-bordered ">
	    <thead style="background-color: #AFAFAF; color: #fff;">
		    <tr>
		        <th>IDENTIFICACION</th>
				<th>NOMBRE</th>
				<th>CORREO</th>
				<th>IP EQUIPO</th>				     				
		    </tr>
	    </thead>
	    @if($respuestas != null)
		    @foreach($respuestas as $respuesta)
			<tbody class="buscar">
				<tr class="table-light">
					<th scope="row">{{$respuesta->identificacion}}</th>
					<th scope="row">{{$respuesta->funcionario}}</th>
					<th scope="row">{{$respuesta->email_funcionario}}</th>
					<th scope="row">{{$respuesta->ip}}</th>									
										     
				</tr>	                
			</tbody>
			@endforeach
		@endif
	</table>
</div>
									
									
								</div>
	            </div>



@endsection