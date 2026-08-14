@extends('layouts.mantenimiento')
@section('title', 'Solicitudes Despacho')
@section('cabecera', 'VERIFICAR SOLICITUD')

@section('content') 
@include('../alerts.request')
		
		<div class="row">
		    <p><center><strong><h2>{{$requerimientodespachos->nombre_despacho}} CREADO EL {{$requerimientodespachos->fecha_solicitud}} </h2></strong></center></p>
		    <hr>
		    
		    <div class="col-xs-12 col-md-6">
						<img src="/Solicitudes/{{$requerimientodespachos->evidencia_fotografica}}" alt="" style="width:100%;height:400px" >
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="form-group">
					<label for="observaciones">Descripci&oacute;n :</label>
					<textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			
		</div>
		<hr>
		<form action="{{ route('reporte.incidentes.solicitudes.put',$requerimientodespachos->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
		<div class="row">
		    <div class="col-xs-12">
				<div class="form-group">
        		     <label for="estado">Estado:</label>
                        <select name="estado" id="estado" class="form-control" required>	
                        
                            <option value="RESUELTO" @if(old('estado', $requerimientodespacho->estado ?? '') == 'EN GESTION') selected @endif>EN GESTION</option>
                            <option value="RESUELTO" @if(old('estado', $requerimientodespacho->estado ?? '') == 'ARREGLO PARCIAL') selected @endif>ARREGLO PARCIAL</option>
                            <option value="TERMINADO" @if(old('estado', $requerimientodespacho->estado ?? '') == 'PENDIENTE') selected @endif>PENDIENTE</option>
                            <option value="PENDIENTE" @if(old('estado', $requerimientodespacho->estado ?? '') == 'REALIZADO') selected @endif>REALIZADO</option>
                        </select>
                    </div>
			</div>
		    
		    
			<div class="col-xs-12">
				<div class="form-group">
					<label for="respuesta">RESPUESTA A LA SOLICITUD :</label>
					<textarea class="form-control @error('respuesta') is-invalid @enderror" placeholder="Dar respuesta" name="respuesta" id="respuesta">{{ old('respuesta', $requerimientodespachos->respuesta ?? '') }}</textarea>
@error('respuesta')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			
		</div>	
		<div class="row">
			<div class="col-xs-6">
				<button class="btn btn-primary btn-block" type="submit">Actualizar Informacion</button>
				</form>
			</div>
			<div class="col-xs-6">
			    <a class="btn btn-danger btn-block" href="{{ route('reporte.incidentes.solicitudes') }}">Cancelar</a>
				</form>
			</div>
		</div>
@endsection