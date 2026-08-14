@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Subir Restricciones de Salud ')
@section('cabecera', 'CARGAR FACTURAS CUMPLIDO Y COMPROBAR ESTADO')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">
<div class="row">
    
</div>    
 
<div class="row">
  <div class="col-xs-12 col-md-2">
    
  </div>
  <div class="col-xs-12 col-md-8">
    <form method="POST" action="/administrador/store/factura/cumplido" accept-charset="UTF-8" enctype="multipart/form-data">  
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class=" col-xs-12 col-md-8">
                  <label for="archivo">Seleccione Archivo:</label>                            
                  <input accept=".xls,.xlsx" class="form-control-file form-group @error('file') is-invalid @enderror" type="file" name="file" id="file">
@error('file')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                        <button type="submit" class="btn btn-danger bg-lg form-group btn-block">Verificar</button>
                      </div>
                      
                    </div>   

     </form>
        </div>

        <div class="col-xs-12 col-md-2">
           <a href="#" class="product-title"><i class="fa fa-file-excel-o fa-4x text-danger" aria-hidden="true"></i>

		  
		  </a> 
    
        </div>
    
  </div>
  <hr>
  <div class="row">
      <div class="col-xs-12 col-sm-8">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('factura.cumplido.descargar') }}" method="POST">
    @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-6" "form-group">
						<label for="Descarga de Facturas de cumplidos">Descarga de Facturas de cumplidos</label>
						
    					<input class="form-control @error('numero') is-invalid @enderror" autocomplete="off" placeholder="ingrese numero de cumplido" type="number" name="numero" id="numero" value="{{ old('numero') }}">
@error('numero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					</div>
					<div class="col-xs-12 col-sm-6" "form-group">
					    <br>
						<button class="btn btn-warning btn-md" type="submit">Descargar Cumplido</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
  </div>
     
  @endsection