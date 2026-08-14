@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Inventario')
@section('cabecera', ' Inventario')


@section('content') 
@include('../alerts.success')
@include('../alerts.request')
		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">	
            	<a href="{!! url('/administrador/inventarios/create')!!}" class="btn btn-warning">Registrar Inventario</a>      
            	</div>
			</div>
			
		</div>
        <hr>
        <div class="row">
        	<div class="col-xs-12 col-sm-6"> 
        	<label for="quienSolicita">Juzgados:</label><br>
			<select class="form-control select2  @error('idEmpleado') is-invalid @enderror" id="juzgadoInv" name="idEmpleado">
    <option value="">Seleccione Juzgado</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('idEmpleado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('idEmpleado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
        	</div>
        </div>
            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table  table-hover table-condensed table-bordered ">
						<thead style="background-color: #AFAFAF; color: #fff;">
						  <tr style="background-color: #AFAFAF; color: #fff;">
						  	  <th>ELEMENTO</th>
						      <th>JUZGADO</th>
						      <th>No. INVENTARIO</th>
						      <th>ACCIONES</th>	
						     				      
					      </tr>
						</thead>
							 <tbody id="contenidoinv">
																	 	                
							</tbody>							              
				     </table>
				  </div>
				</div>
			 </div>
			<!-- /.box-body -->	        
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>



 
	
@endsection