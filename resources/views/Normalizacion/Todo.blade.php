@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Normalizacion de Expedientes')
@section('cabecera', 'Normalizacion Expedientes')

  
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
 
<style>
        /* Estilo para los botones de radio */
        input[type="radio"] {
            -webkit-appearance: none; /* Desactiva la apariencia predeterminada de WebKit */
            -moz-appearance: none; /* Desactiva la apariencia predeterminada de Firefox */
            appearance: none; /* Desactiva la apariencia predeterminada de otros navegadores */
            width: 15px; /* Ajusta el tamaño del botón */
            height: 15px; /* Ajusta el tamaño del botón */
            border-radius: 50%; /* Hace que el botón sea circular */
            /*border: 1px solid #ff0000;*/ /* Establece el color del borde a rojo */
        }

        /* Estilo para los botones de radio cuando están seleccionados */
        input[type="radio"]:checked {
            background-color: #AAF97D; /* Establece el color de fondo a rojo cuando el botón está seleccionado */
        }
            
            input[type="text"],
            input[type="email"],
            input[type="number"],
            input[type="radio"],
            input[type="select"],
            textarea,
            fieldset {
              width: ;
              border: 1px solid #333;
              box-sizing: border-box;
            }
            
            input:invalid {
              box-shadow: 0 0 5px 1px red;
            }
            
            input:focus:invalid {
              box-shadow: none;
            }
            
        
    </style>
     <style>
        .sombracard {
            width: 100%;
            padding: 20px;
            border-radius: 20px;
            background-color: #EEF6F5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Aplica sombra */
        }
        .element {
          width: 100%;
          height: 30px;
          border-color: black;
          border-width: 2px;
          border-style: solid;
        }
    </style>
    

@section('content') 


@if( auth()->user()->email == "aolivarc@cendoj.ramajudicial.gov.co" ||  auth()->user()->email == "root10@gmail.com")

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <center>
            <h3><strong>MOVER NORMALIZADOS</strong></h3>
        </center>
        <br>
				<form action="{{ route('normalizacion.registro.traslado') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-6 form-group">
				    	    <label>MES ACTUAL</label>
    					<select class="form-control @error('mesNormalizado') is-invalid @enderror" name="mesNormalizado" id="mesNormalizado">
    <option value="">Seleccione Mes Normalizado</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mesNormalizado', $mesActual) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mesNormalizado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				        </div>
    				
				        <div class=" col-xs-12 col-sm-6 form-group">
        				    	    <label>CONTRATISTA </label>
        					<select class="form-control @error('persona') is-invalid @enderror" name="persona" id="persona">
    <option value="">Seleccione Ps </option>
    @foreach($personas as $key => $value)
        <option value="{{ $key }}" @selected(old('persona') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('persona')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				</div>
				
				    	<div class=" col-xs-12 col-sm-6 form-group">
				    	<label>MOVER A </label>
        					<select class="form-control @error('mesCambio') is-invalid @enderror" name="mesCambio" id="mesCambio">
    <option value="">Seleccione Mes a dejar</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mesCambio') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mesCambio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				</div>
					<div class="col-xs-12 col-sm-6">
					    <center>
					        <br>
					        <button class="btn btn-danger btn-md btn-block" type="submit">TRASLADAR</button>
						</form>
					    </center>
						
					</div>
				</div>
        
        </div>
        <div class="col-xs-12 col-sm-5" style=" border-left: 3px solid #000;margin-left: 3em;">
            <center>
                <h3><strong>ASIGNAR RADICADOS</strong></h3>
            </center>
            <br>
            <form enctype="multipart/form-data" action="{{ route('normalizacion.registro.asignacion') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-6 form-group">
        				<label>CONTRATISTA </label>
        					<select class="form-control @error('persona') is-invalid @enderror" name="persona" id="persona">
    <option value="">Seleccione Ps </option>
    @foreach($personas as $key => $value)
        <option value="{{ $key }}" @selected(old('persona') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('persona')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				</div>
				
				    	<div class=" col-xs-12 col-sm-6 form-group">
				    	<label>Seleccione Archivo:</label>                         
                        <input accept=".xls,.xlsx" class="form-control-file form-group @error('file') is-invalid @enderror" type="file" name="file" id="file">
@error('file')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				</div>
					<div class="col-xs-12 col-sm-12">
					    <div class="row">
					        <div class="col-xs-12 col-sm-3"></div>
					        <div class="col-xs-12 col-sm-6">
					             <br>
        					        <button class="btn btn-warning btn-md btn-block" type="submit">ASIGNAR RADICADOS</button>
        						</form>
        					    
					        </div>
					        <div class="col-xs-12 col-sm-3"> </div>
					    </div>
					   
						
					</div>
				</div>
        </div>
               
 </div>
          

@endif

<hr>
@if($Normalizacion != null)



<div class="row">
			<div class="col-xs-12 col-sm-6">
				<br>
				<form action="{{ route('normalizacion.registro.todo') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-6 form-group">
					<select class="form-control @error('mes') is-invalid @enderror" name="mes" id="mes">
    <option value="">Seleccione Mes a Consultar</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mes') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
					<div class="col-xs-12 col-sm-3">
						<button class="btn btn-warning btn-md" type="submit">VER REVISIONES</button>
						</form>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-5" style=" border-left: 3px solid #000;margin-left: 3em;">
			    <h3>BUSCAR RADICADO:</h3>
				<form action="{{ route('normalizacion.registro.todo') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-6 form-group">
					<input placeholder="Ingrese radicado 23 Digitos" class="form-control @error('radicacion') is-invalid @enderror" type="number" name="radicacion" id="radicacion" value="{{ old('radicacion') }}">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
					<div class="col-xs-12 col-sm-3">
						<button class="btn btn-primary btn-md" type="submit">BUSCAR RADICADO</button>
						</form>
					</div>
				</div>
				<hr>
				@if(!empty($radicadoAsignado))
				    <strong>ASIGNADO A:</strong>
				    @foreach($radicadoAsignado as $radicadoAsig)
				    <p>
				     {{$radicadoAsig}}	
				    </p>
				    @endforeach
			
				@endif
				@if(!empty($radicadoNormalizado))
				    <strong>NORMALIZADO :</strong>
				    @foreach($radicadoNormalizado as $radicadoNorma)
				    <p>
				     {{$radicadoNorma}}	
				    </p>
				    @endforeach
			
				@endif
			</div>
		</div>

@endif
<hr>

<div class="row">
 @foreach($CANTIDAD as $Listado)
    <div class="col-xs-12 col-sm-4 ">
        <div class="element col-xs-12 col-sm-9"><strong> {{$Listado->revisado_por}}</strong></div>
        <div class="element col-xs-12 col-sm-3"><center><strong>{{$Listado->Total}}</strong></center></div>
    </div>
 @endforeach
</div>



    <div class="table-responsive sombracard">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RADICADO</th>
				<th>DESPACHO</th>
		        <th>FOLIOS</th>
		        <th>OBSERVACIONES</th>
		        <th>FECHA REVISION</th>
		        <th>REVISADO POR</th>
				
		    </tr>
	    </thead>
	    @if($Normalizacion != null)
	        <tbody class="buscar">
			 @foreach($Normalizacion as $solicitud)
							
									
											<tr class="table-light">
												<th scope="row"> {{$solicitud->radicacion}} </th>
												<th scope="row"> {{$solicitud->despacho}}  </th>
												<th scope="row"> {{$solicitud->folios}} </th>
												<th scope="row"> {{$solicitud->observaciones}} </th>
												<th scope="row"> {{$solicitud->fecha_revision}} </th>
												<th scope="row"> {{$solicitud->revisado_por}} </th>
											</tr>								 	                
									
			 @endforeach	  
			</tbody>
		@endif					
		   
	</table>
	
</div>


   <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterNormalizacion.js"></script>

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Historico Registros",    //Nombre del archivo 
});
</script>

@endsection