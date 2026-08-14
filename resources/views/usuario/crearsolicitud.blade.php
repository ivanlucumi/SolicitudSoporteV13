@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Soporte')
@section('cabecera', 'REGISTRE SU REQUERIMIENTO')

@section('content') 
@include('alerts.success')
@include('alerts.request')
<form action="{{ route('store') }}" method="POST">
    @csrf
  <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> <strong>{!!"  ". auth()->user()->name."   ". auth()->user()->lastname!!}</strong></h3>
            </div>

	            <div class="box-body">
	            	<div class="container-fluid"> 
						<form action="{{ route('store') }}" method="POST">
    @csrf
	            	 
					            	<div class="row">
					            		<div class="form-group" style="display:none;">
											<label for="id">Id User:</label>
											<input class="form-control @error('idUser') is-invalid @enderror" display="true" type="text" name="idUser" id="idUser" value="{{ old('idUser',  auth()->user()->id) }}">
@error('idUser')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
										</div>
					            	</div>
					            	      		
					            	
						              <div class="row">
						                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
						                  	
						                         <label for="quienSolicita">Cedula de quien solicita:</label><br>
						                         <select class="form-control select2  @error('idEmpleado') is-invalid @enderror" id="quiensolicita" name="idEmpleado">
    <option value="">ingrese Cedula</option>
    @foreach($empleados as $key => $value)
        <option value="{{ $key }}" @selected(old('idEmpleado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('idEmpleado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
						                   
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
						                  	
						                         <label for="quienSolicita">Nombre de quien solicita:</label><br>
						                         <label id="presenta">
						                                            	
						                         </label>                   
						                    
						                </div>
						               
						                <div class="col-xs-12 col-sm-12 col-md-4">
						                   <label for="EDIFICIO">EDIFICIO SEDE :</label>
						                  <input class="form-control @error('edificio') is-invalid @enderror" type="text" name="edificio" id="edificio" value="{{ old('edificio') }}">
@error('edificio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
						                </div>
						              </div>
						            
						              <div class="row">
						                <div class="col-xs-12 col-md-6 form-group">
						                  	
						                         <label for="Requerimiento">Requerimiento:</label><br>
						                         <select class="form-control @error('idrequerimiento') is-invalid @enderror" id="requerimiento" name="idrequerimiento">
    <option value="">Seleccione Requerimiento</option>
    @foreach($requerimientos as $key => $value)
        <option value="{{ $key }}" @selected(old('idrequerimiento') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('idrequerimiento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
						                    
						                </div>
						                <div class="col-xs-12 col-md-6 form-group" id="categ" style="">
						                 
						                         <label for="Selecciona">Selecciona Categoria:</label><br>
						                         <select class="form-control @error('idcategorias') is-invalid @enderror" name="idcategorias" id="idcategorias">
    <option value="">Seleccione Categoría</option>
    @foreach($categorias as $key => $value)
        <option value="{{ $key }}" @selected(old('idcategorias') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('idcategorias')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
						                   
						                </div>
						               
						              </div>
						              
						              
										
						              <div class="row">
						                <div class="col-xs-12 col-sm-12 form-group">
						                   <label for="elementos">ELEMENTOS:</label>
						                  <input class="form-control @error('elementos') is-invalid @enderror" type="text" name="elementos" id="elementos" value="{{ old('elementos') }}">
@error('elementos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
						                </div>
						                <div class="col-xs-12" id="elementos1" style="display: none;">
											<strong>Elementos</strong><hr>
						                	<div class="col-xs-12 col-md-12">
												 <div class="table-responsive">
													 <table id="miTabla" class="table table-bordered table-striped">
														<thead>
														  <tr>
														  	  <th>SELECCIONE</th>
														  	  <th>ELEMENTO</th>
														      <th>MARCA</th>
														      <th>MODELO</th>
														      <th>SERIAL</th>	
														     
														     				      
													      </tr>
														</thead>
														
															 <tbody id="contenido">
																	 	                
															 </tbody>
														            
												     </table>
												  </div>

						                		</div>
						                	</div>		               
						              </div>
						             
										<hr>
						              <div class="row">
						                <div class="col-xs-12" style="height: ">
						                  <label for="Descripcion">Descripcion :</label>
						                  <textarea class="form-control @error('descripcion') is-invalid @enderror" style="height:6em;" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
@error('descripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
						                </div>
						                
						               
						              </div>
								</div>
	            </div>

 </div>

				 <div class="row">
						<div class="col-xs-6 form-group">
							<button class="btn btn-primary btn-block" type="submit">Generar</button>
						</div>
						<div class="col-xs-6 form-group">
							<a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancelar</a>
							</form>
						</div>
						
			 </div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>



@endsection



