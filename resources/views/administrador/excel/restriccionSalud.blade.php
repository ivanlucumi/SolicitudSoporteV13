@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Subir Restricciones de Salud ')
@section('cabecera', 'Carga de Excel Empleados con Restricciones de Salud')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">
 
<div class="row">
  <div class="col-xs-12 col-md-2">
    
  </div>
  <div class="col-xs-12 col-md-8">
    <form method="POST" action="/administrador/store/asignacion/parqueadero/restriccion/salud" accept-charset="UTF-8" enctype="multipart/form-data">  
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class=" col-xs-12 col-md-8">
                  <label for="archivo">Seleccione Archivo:</label>                            
                  <input accept=".xls,.xlsx" class="form-control-file form-group @error('file') is-invalid @enderror" type="file" name="file" id="file">
@error('file')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                        <button type="submit" class="btn btn-danger bg-lg form-group btn-block">Enviar</button>
                      </div>
                      
                    </div>   

     </form>
        </div>

        <div class="col-xs-12 col-md-2">
           <a href="#" class="product-title"><i class="fa fa-file-excel-o fa-4x text-danger" aria-hidden="true"></i>

		  
		  </a> 
    
        </div>
    
  </div>
  </div>
     
  @endsection