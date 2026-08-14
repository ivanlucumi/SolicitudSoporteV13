@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Subir Empleados por Excel ')
@section('cabecera', 'Carga de Excel Empleados para Ingreso al Palacio')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">
 
<div class="row">
  <div class="col-xs-12 col-md-2">
    
  </div>
  <div class="col-xs-12 col-md-8">
    <form method="POST" action="/administrador/store/save/empleados/activos" accept-charset="UTF-8" enctype="multipart/form-data">  
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

		  <div class="mask flex-center waves-effect waves-light">Descargar <br> formato</div>
		  </a> 
    
        </div>
    
  </div>
  </div>
     
  @endsection