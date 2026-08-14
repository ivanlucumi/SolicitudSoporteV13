@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Normalizacion de Expedientes')
@section('cabecera', 'Normalizacion Expedientes')

  <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
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
    </style>
    

@section('content') 
<!--div class="container-fluid">
    <div class="" style="text-align: right">
      <nav class="navbar navbar-light bg-light">
        <form action="{{ route('prodos.inicio') }}" method="POST">
    @csrf
        <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar por radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('despacho') is-invalid @enderror" placeholder="Buscar por despacho" autocomplete="off" aria-label="Search" type="text" name="despacho" id="despacho" value="{{ old('despacho') }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('municipio') is-invalid @enderror" placeholder="Buscar por Municipio" autocomplete="off" aria-label="Search" type="text" name="municipio" id="municipio" value="{{ old('municipio') }}">
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <input class="form-group mr-sm-2 shadow @error('especialidad') is-invalid @enderror" placeholder="Buscar por especialidad" autocomplete="off" aria-label="Search" type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        @if( auth()->user()->email == "gmstdesajvalle3@cendoj.ramajudicial.gov.co")
        <<input class="form-group mr-sm-2 shadow @error('cantidad') is-invalid @enderror" placeholder="cantidad" autocomplete="off" aria-label="Search" type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}">
@error('cantidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror>
        @endif
       
          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
        </form>
      </nav>
    </div>
    
  </div-->
<hr>


<p>
   <justify><h3><strong>TOTAL NORMALIZADOS POR MI: {{$total}} </strong></h3></justify>
</p>

<div class="row">
 @foreach($mesesNomralizados as $MES)
    <div class="col-xs-12 col-sm-3 ">
        <div class="element col-xs-12 col-sm-4"><strong>
            @if($MES->mes =="5")
                MAYO
            @endif
            @if($MES->mes =="6")
                JUNIO
            @endif
            @if($MES->mes =="7")
                JULIO
            @endif
            @if($MES->mes =="8")
                AGOSTO
            @endif
            @if($MES->mes =="9")
                SEPTIEMBRE
            @endif
            @if($MES->mes =="10")
                OCTUBRE
            @endif
            @if($MES->mes =="11")
                NOVIEMBRE
            @endif
            @if($MES->mes =="12")
                DICIEMBRE
            @endif
            </strong></div>
        <div class="element col-xs-12 col-sm-4"><strong>{{$MES->Total}}</strong></div>
    </div>
 @endforeach
</div>


<hr>

<div class="container-fluid">
    
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-12">
             
                <div class="card-header" style="background-color: #004182;color:white"><h2><center>REGISTRAR NORMALIZACION</center></h2></div>
            
                    
                   <hr>
                    <form id="MiFormulario" class="was-validated" action="{{ route('normalizacion.registro.save') }}" method="POST">
    @csrf 
        <div class="row ">
            
            <div class="col-xs-12 col-sm-3"></div>
            <div class="col-xs-12 col-sm-6 sombracard">
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> RADICACI&Oacute;N (23 D&iacute;gitos):</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                       <input class="form-control  @error('radicacion') is-invalid @enderror" id="nProceso" min="1" placeholder="Debe Tomar Radicado de Asignados" autocomplete="off" type="number" name="radicacion" value="{{ old('radicacion', $RadicadoTomado) }}">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    <span id="cantidad">. </span>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong>DESPACHO:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<select class="form-control  select2 @error('despacho_id') is-invalid @enderror" autocomplete="off" name="despacho_id" id="despacho_id">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho_id') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho_id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> ALMACENADO EN:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<select class="form-control @error('repositorio') is-invalid @enderror" autocomplete="off" id="repositorio" name="repositorio">
    <option value="">Aplicativo donde se Carga</option>
    @foreach($repositorio as $key => $value)
        <option value="{{ $key }}" @selected(old('repositorio') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('repositorio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> FOLIOS:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('folios') is-invalid @enderror" placeholder="Registre Folios" autocomplete="off" min="1" type="number" name="folios" id="folios" value="{{ old('folios') }}">
@error('folios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> INDICE:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<input class="form-control @error('indice') is-invalid @enderror" placeholder="Se crea indice o se actualiza" autocomplete="off" type="text" name="indice" id="indice" value="{{ old('indice') }}">
@error('indice')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                <div class="row">
                   <div class="col-xs-12 col-sm-6">
                       <h5><strong> OBSERVACIONES:</strong></h5>
                   </div> 
                   <div class="col-xs-12 col-sm-6">
                      	<textarea class="form-control @error('observaciones') is-invalid @enderror" placeholder="Observaciones de la Normalizacion" autocomplete="off" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
                   </div> 
                </div>
                
                
                 <hr>
                 <div class="row">
                      <div class="form-group">
                        
                        <div align="center" class="col-xs-12">
                            <button id="btsubmit" class="btn btn-success btn-block" style="text-align: center; background-color: #004182; color: #fff;" onclick="enviarFormulario()" type="submit">GUARDAR REGISTRO</button>
                            </form>
                            
                            <br>
                        </div>
                        
                    </div>
                   
         </div>     
    
  
        
    </div>
    <div class="col-xs-12 col-sm-3"></div>
    
</div>

 <!-- Modal de espera -->
<div class="modal" id="modalEspera" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p><center> Enviando formulario.....</center></p>
            </div>
        </div>
    </div>
</div>                   
                
        </div>
    </div>
      </div>
    </div>
    
</div>


@if($Normalizacion != null)
<p>
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form action="{{ route('normalizacion.registro.descarga') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-3 form-group">
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
						<button class="btn btn-warning btn-md" type="submit">Descargar Mis Revisiones</button>
						</form>
					</div>
				</div>
			</div>
		</div>
</p>
@endif
<hr>

    <div class="table-responsive sombracard">
	<table id="table9" class="table table-bordered table-striped" >
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <th>RADICADO</th>
				<th>DESPACHO</th>
		        <th>FOLIOS</th>
		        <th>OBSERVACIONES</th>
		        <th>FECHA REVISION</th>
				
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
											</tr>								 	                
									
			 @endforeach	  
			</tbody>
		@endif					
		   
	</table>
	
</div>

<script src="/js/jquery.js"></script>

<script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
     /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })


    //verificar los 23 digitos
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' d&iacute;gitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' d&iacute;gitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' d&iacute;gitos</span></strong>';
        }
    })
    

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
  
</script>

@endsection