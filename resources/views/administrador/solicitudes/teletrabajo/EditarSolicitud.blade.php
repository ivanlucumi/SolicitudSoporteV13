@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Edicion de datos Teletrabajo')
@section('cabecera', 'Edicion de datos Teletrabajo')

@section('content') 
@include('alerts.flash-message')
                @include('../alerts.success')
                @include('../alerts.request')
                
		<form action="{{ route('admin.teletrabajo.UpdateTeletrabajo',$Teletrabajo2024->id) }}" method="POST">
    @csrf
    @method('PUT')
		<div class="container-fluid">
		    <div class="row">
		        <div class="col-xs-12 col-md-2"></div>
		        <div class="col-xs-12 col-md-6">
		            	<div class="row">
                			<div class="col-xs-12">
                				<div class="form-group">
                					<label for="despacho" class="fa fa-asterisk">DESPACHO:</label>
                					<select class="form-control select2 @error('codigo_despacho') is-invalid @enderror" name="codigo_despacho" id="codigo_despacho">
    <option value="">Selecione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('codigo_despacho', $Teletrabajo2024->codigo_despacho) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('codigo_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                				</div>
                			</div>
                			<div class="col-xs-6">
                				<div class="form-group">
                					<label for="id">Identificacion:</label>
                					<input class="form-control @error('identificacion') is-invalid @enderror" placeholder="Ingrese Identificacion" type="text" name="identificacion" id="identificacion" value="{{ old('identificacion', $Teletrabajo2024->identificacion ?? $Teletrabajo2024->identificacion) }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                				</div>
                			</div>
                		
                			<div class="col-xs-6">
                				<div class="form-group">
                					<label for="nombre">Nombre:</label>
                					<input class="form-control @error('nombre_servidor') is-invalid @enderror" placeholder="Registre Nombre Completo" type="text" name="nombre_servidor" id="nombre_servidor" value="{{ old('nombre_servidor', $Teletrabajo2024->nombre_servidor ?? $Teletrabajo2024->nombre_servidor) }}">
@error('nombre_servidor')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                				</div>
                			</div>
                			<div class="col-xs-6">
                				<div class="form-group">
                					<label for="cargo">cargo:</label>
                					<input class="form-control @error('cargo') is-invalid @enderror" placeholder="Cargo" type="text" name="cargo" id="cargo" value="{{ old('cargo', $Teletrabajo2024->cargo ?? $Teletrabajo2024->cargo) }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                				</div>
                			</div>
                			<div class="col-xs-6">
                		        <label>DIAS TELETRABAJO REGISTRADOS </label>
                		        <p>
                		            {{$Teletrabajo2024->dias_teletrabajo}}
                		        </p>
                		        <hr>
                		    </div>
                		</div>
                		<div class="row">
                		    
                		    <hr>
                			<div class="col-xs-12">
                				<div class="form-group">
                					<label>D&Iacute;AS TELETRABAJO REGISTRADOS </label><br>
                					
                					<div class="row">
                					    <div class="col-xs-3">
                					       <label><input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="LUNES" /> LUNES</label> 
                					    </div>
                					    <div class="col-xs-3">
                					       <label><input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="MARTES"/> MARTES</label> 
                					    </div>
                					    <div class="col-xs-3">
                					       <label><input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="MIERCOLES"/> MIERCOLES</label> 
                					    </div>
                					    <div class="col-xs-3">
                					       <label><input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="JUEVES"/> JUEVES</label> 
                					    </div>
                					    <div class="col-xs-3">
                					       <label><input type="checkbox" id="cbox1" name="dias_teletrabajo[]" value="VIERNES"/> VIERNES</label> 
                					    </div>
                					</div>
                					
                				</div>
                			</div>
                			
                		</div>	
                		<div class="row">
                			<div class="col-xs-12 mt-3 mb-3 p-3">
                				<button class="btn btn-primary btn-block" type="submit">Actualizar Informacion</button>
                				</form>
                				<br>
                			</div>
                			<div class="col-xs-12 mt-3 mb-3 p-3">
                				<a href="{!! route('admin.solicitudes.teletrabajo.registro')!!}" class="btn btn-danger  btn-block">Cancelar</a>
                				</form>
                			</div>
		</div>
		        </div>
		        <div class="col-xs-12 col-md-2"></div>
		    </div>
		</div>
		
	
@endsection