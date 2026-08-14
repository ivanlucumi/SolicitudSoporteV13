@if( auth()->user()->email != "servisoft@disajcali.gov.co")
@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Revisar Proceso de Digitalizacion Protocolo Dos')
@section('cabecera', 'Revisar Proceso de Digitalizacion Protocolo Dos')

@section('content') 
<div class="container-fluid">
@include('../alerts.request')

<p ><h1><center style="strong">EXPEDIENTE CON RADICADO {{$digitalizado->radicacion}}  </center></h1></p><hr>

			<form action="{{ route('prodos.update',$digitalizado->id) }}" method="POST">
    @csrf
    @method('PUT')
			<input type="hidden" name="fecha_revision"  value="<?php echo date("Y-m-d");?>">
    			<div class="row">
    				<div class="col-xs-12 col-sm-6 col-md-2 form-group">
    					<label for="Radicado" class="fa fa-asterisk">Radicado :</label>
    					<input class="form-control @error('radicacion') is-invalid @enderror" autocomplete="off" type="text" name="radicacion" id="radicacion" value="{{ old('radicacion', $digitalizado->radicacion ?? $digitalizado->radicacion) }}">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-6 form-group">
    					<label for="Despacho" class="fa fa-asterisk">Despacho :</label>
    					<input class="form-control @error('despacho') is-invalid @enderror" autocomplete="off" type="text" name="despacho" id="despacho" value="{{ old('despacho', $digitalizado->despacho ?? $digitalizado->despacho) }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-2 form-group">
    					<label for="Especialidad" class="fa fa-asterisk">Especialidad :</label>
    					<input class="form-control @error('especialidad') is-invalid @enderror" required="required" autocomplete="off" type="email" name="especialidad" id="especialidad" value="{{ old('especialidad', $digitalizado->especialidad ?? $digitalizado->especialidad) }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-2 form-group">
    					<label for="Cantidad" class="fa fa-asterisk">Cantidad :</label>
    					<input class="form-control @error('cantidad') is-invalid @enderror" required="required" autocomplete="off" type="email" name="cantidad" id="cantidad" value="{{ old('cantidad', $digitalizado->cantidad ?? $digitalizado->cantidad) }}">
@error('cantidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<p><center><h1>MARCAR PARA REPORCESAR</h1></center></p>
    				<div class="col-xs-12 form-group"   >
                                <div class="col-xs-12 col-lg-3">
                                    <label><input type="radio" id="cbox2" value="REPROCESAR MERCURIO" name="reprocesar"  required='true' @if($digitalizado->reprocesar=="REPROCESAR MERCURIO") checked @endif> REPORCESAR MERCURIO</label>
                                </div>
                                <div class="col-xs-12 col-lg-3">
                                    <label><input type="radio" id="cbox2" value="REPROCESAR BESTDOC" name="reprocesar"  required='true' @if($digitalizado->reprocesar=="REPROCESAR BESTDOC") checked @endif > RERPOCESAR BESTDOC</label>
                                </div>
                                <div class="col-xs-12 col-lg-3">
                                    <label><input type="radio" id="cbox2" value="REPROCESAR MERCURIO Y BESTDOC"  name="reprocesar"  required='true' @if($digitalizado->reprocesar=="REPROCESAR MERCURIO Y BESTDOC") checked @endif> RERPOCESAR MERCURIO Y BESTDOC</label>
                                </div>
                                <div class="col-xs-12 col-lg-3">
                                    <label><input type="radio" id="cbox2" value="SIN NOVEDAD"  name="reprocesar"  required='true' @if($digitalizado->reprocesar=="SIN NOVEDAD") checked @endif> SIN NOVEDAD</label>
                                </div>
                                 
                             </div>
                             <hr>
				
				</div>
				
				<!--div class="row">
				    <div  class="col-xs-12  col-md-12 form-group">
        				    <div class="col-xs-12 col-sm-6 col-md-2 form-group">
        					<label for="pdf" class="fa fa-asterisk">Radicado:</label><br>
        					<input class="form-control @error('nombre_pdf') is-invalid @enderror" autocomplete="off" id="nombre_pdf" placeholder="Ingrese Radicado Exp" type="text" name="nombre_pdf" value="{{ old('nombre_pdf', $digitalizado->nombre_pdf ?? old('nombre_pdf')) }}">
@error('nombre_pdf')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        				    </div>
        				    <div class="col-xs-12 col-sm-5 col-md-2 form-group">
        					<label for="no_paginas" class="fa fa-asterisk">Total p&aacute;ginas:</label><br>
        					<input class="form-control @error('cantidad_paginas') is-invalid @enderror" autocomplete="off" min="0" id="cantidad_paginas" placeholder="Ingresa El Total de Paginas" type="number" name="cantidad_paginas" value="{{ old('cantidad_paginas', $digitalizado->cantidad_paginas ?? old('cantidad_paginas')) }}">
@error('cantidad_paginas')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        				    </div>
        				    <div class="col-xs-12 col-sm-1 col-md-1  form-group">
        				        <input class="form-control" autocomplete="off" min="0" id="radicado_id" type="hidden" name="radicado_id" value="{{ $digitalizado->id }}">
        				        <input type="hidden" name="nombreRuta" id="nombreRuta" value="{{ $nombreRuta }}">
        				        <input type="hidden" name="reviso" id="reviso" value="{{  auth()->user()->name.&quot; &quot;. auth()->user()->lastname }}">
        				        <input type="hidden" name="estado" id="estado" value="{{ 'REGISTRO' }}">
        					 <br>
        					 <a href="#" class="btn btn-success btn-sm 
                                        fa fa-plus-square" id="informacion_pdf" title="almacenar informacion"></a>
                  
        				    </div>
        				    <div class="col-xs-12 col-md-7  form-group">
        				        <table class="table table-bordered table-striped">
        				        <thead class="shadow" style="background-color: #004182; color: #fff;">
        				          <tr>    
                                    <td>Nombre</td>
                                    <td>Cantidad</td>
                                    <td>Eliminar</td>
                                  </tr>
                                </thead>  
                                  @foreach($PRODUCTOS as $pdfs)
                                  <tbody data-id="{!!$pdfs->id!!}">
                                      <tr >
                                        <td>{{$pdfs->nombre_pdf}}</td>
                                        <td>{{$pdfs->cantidad_paginas}}</td>
                                        <td>
                                             <a id="eliminarPfd" class="btn btn-danger bnt-xs fa fa-trash fa-lg eliminarPfd"></a>
                                        </td>
                                      </tr>
                                  </tbody>
                                  @endforeach
                                  <tbody data-id=""  id="id_pdfs" >
                                    
					              </tbody>
                                  <tr><td>Total Pag</td>
                                    <td><label id='total_paginas' style="color:red">{{$total}}</label></td>
                                     </tr>
                                  <tr>
                                </table>
        				    </div>
			    	</div-->
			    	<div class=row>
			    	    <div class="col-xs-12 col-sm-6">
			    	        <p><center> <strong><h3>NOVEDADES MERCURIO</h3> </strong></center></p><hr><br><br>
			    	        <div class="col-xs-3  form-group">
        					<label for="OBSERVACIONES">CANTIDAD ARCHIVOS:</label><br>
        					<input placeholder="# Doc Protocolo 2" class="form-control @error('cantidad_archivos_m') is-invalid @enderror" type="number" name="cantidad_archivos_m" id="cantidad_archivos_m" value="{{ old('cantidad_archivos_m', $digitalizado->cantidad_archivos_m ?? old('cantidad_archivos_m')) }}">
@error('cantidad_archivos_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
        				    <div class="col-xs-9  form-group">
        					<label for="OBSERVACIONES">OBSERVACIONES ARCHIVOS:</label><br>
        					<textarea placeholder="Observaciones de Archivos" class="form-control  @error('observaciones_archivos_m') is-invalid @enderror" style="height:66px" name="observaciones_archivos_m" id="observaciones_archivos_m">{{ old('observaciones_archivos_m', $digitalizado->observaciones_archivos_m ?? old('observaciones_archivos_m')) }}</textarea>
@error('observaciones_archivos_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
        				    <div class="col-xs-3  form-group">
        					<label for="OBSERVACIONES">CANTIDAD MULTIMEDIA:</label><br>
        					<input placeholder="# Archivos Multimedia" class="form-control @error('cantidad_archivos_multimedia_m') is-invalid @enderror" type="number" name="cantidad_archivos_multimedia_m" id="cantidad_archivos_multimedia_m" value="{{ old('cantidad_archivos_multimedia_m', $digitalizado->cantidad_archivos_multimedia_m ?? old('cantidad_archivos_multimedia_m')) }}">
@error('cantidad_archivos_multimedia_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
        				    <div class="col-xs-9 form-group">
        					<label for="OBSERVACIONES">OBSERVACIONES MULTIMEDIA:</label><br>
        					<textarea placeholder="Observaciones Archivos Multimedia" class="form-control  @error('observaciones_archivos_multimedia_m') is-invalid @enderror" style="height:66px" name="observaciones_archivos_multimedia_m" id="observaciones_archivos_multimedia_m">{{ old('observaciones_archivos_multimedia_m', $digitalizado->observaciones_archivos_multimedia_m ?? old('observaciones_archivos_multimedia_m')) }}</textarea>
@error('observaciones_archivos_multimedia_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
        				    <div class="col-xs-12 col-xs-6 form-group">
        					<label for="OBSERVACIONES">CONTIENE CARPETAS COMPRIMIDAS:</label><br>
        					<textarea placeholder="Relacionar si continie carpetas comprimidas, si descargar o si contiene errores" class="form-control  @error('carpetas_comprimidas_m') is-invalid @enderror" style="height:100px" name="carpetas_comprimidas_m" id="carpetas_comprimidas_m">{{ old('carpetas_comprimidas_m', $digitalizado->carpetas_comprimidas_m ?? old('carpetas_comprimidas_m')) }}</textarea>
@error('carpetas_comprimidas_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
        				    <div class="col-xs-12 col-xs-6 form-group">
        					<label for="OBSERVACIONES">ORGANIZACION SEGUN PROTOCOLO2:</label><br>
        					<textarea placeholder="Relacionar si contiene carpetas Si contiene fechas, los documentos estan en orden" class="form-control  @error('carpetas_protocolodos_m') is-invalid @enderror" style="height:100px" name="carpetas_protocolodos_m" id="carpetas_protocolodos_m">{{ old('carpetas_protocolodos_m', $digitalizado->carpetas_protocolodos_m ?? old('carpetas_protocolodos_m')) }}</textarea>
@error('carpetas_protocolodos_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
        				    <div class="col-xs-12 form-group">
        					<label for="OBSERVACIONES">OBSERVACIONES GENERAL MERCURIO:</label><br>
        					<textarea placeholder="Observaciones Archivos Multimedia" class="form-control  @error('observaciones_generales_m') is-invalid @enderror" style="height:100px" name="observaciones_generales_m" id="observaciones_generales_m">{{ old('observaciones_generales_m', $digitalizado->observaciones_generales_m ?? old('observaciones_generales_m')) }}</textarea>
@error('observaciones_generales_m')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        				    </div>
			    	    </div>
			    	    <div class="col-xs-12 col-sm-6">
			    	        <p><center> <strong><h3>NOVEDADES BESTDOC</h3> </strong></center> </p><hr>
        			         <div class="col-xs-12 form-group"   >
        			             <div class="col-xs-12 col-lg-4">
        				        <label for="se">SE REALIZO TRANFERENCIA:</label>
        				        </div>
                                <div class="col-xs-12 col-lg-4">
                                    <label><input type="radio" id="cbox2" value="TRANSFERIDO" onclick="requerido()" name="transferido"  required='true' @if($digitalizado->transferido=="TRANSFERIDO") checked @endif> SE TRANSFIRIO A BESTDOC </label>
                                </div>
                                <div class="col-xs-12 col-lg-4">
                                    <label><input type="radio" id="cbox2" value="SIN_TRANSFERIR" onclick="no_requerido()" name="transferido"  required='true' @if($digitalizado->transferido=="SIN_TRANSFERIR") checked @endif> SIN TRANSFERIR </label>
                                </div>
                                 
                             </div>
			    	         <div id="bestdoc" style="display:none">
			    	               <div class="col-xs-3  form-group">
                					<label for="OBSERVACIONES">CANTIDAD ARCHIVOS:</label><br>
                					<input placeholder="# Doc Protocolo 2" class="form-control @error('cantidad_archivos_b') is-invalid @enderror" id="cantidad_archivos_b" type="number" name="cantidad_archivos_b" value="{{ old('cantidad_archivos_b', $digitalizado->cantidad_archivos_b ?? old('cantidad_archivos_b')) }}">
@error('cantidad_archivos_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
                				    <div class="col-xs-9  form-group">
                					<label for="OBSERVACIONES">OBSERVACIONES ARCHIVOS:</label><br>
                					<textarea placeholder="# Archivos Multimedia" class="form-control  @error('cantidad_archivos_multimedia_b') is-invalid @enderror" style="height:66px" id="cantidad_archivos_multimedia_b" name="cantidad_archivos_multimedia_b">{{ old('cantidad_archivos_multimedia_b', $digitalizado->cantidad_archivos_multimedia_b ?? old('cantidad_archivos_multimedia_b')) }}</textarea>
@error('cantidad_archivos_multimedia_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
                				    <div class="col-xs-3  form-group">
                					<label for="OBSERVACIONES">CANTIDAD MULTIMEDIA:</label><br>
                					<input placeholder="# Archivos Multimedia" class="form-control @error('numero_archivos_multimedia_b') is-invalid @enderror" id="numero_archivos_multimedia_b" type="number" name="numero_archivos_multimedia_b" value="{{ old('numero_archivos_multimedia_b', $digitalizado->numero_archivos_multimedia_b ?? old('numero_archivos_multimedia_b')) }}">
@error('numero_archivos_multimedia_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
                				    <div class="col-xs-9 form-group">
                					<label for="OBSERVACIONES">OBSERVACIONES MULTIMEDIA:</label><br>
                					<textarea placeholder="# Observaciones Multimedia" class="form-control  @error('observaciones_archivos_multimedia_b') is-invalid @enderror" style="height:66px" id="observaciones_archivos_multimedia_b" name="observaciones_archivos_multimedia_b">{{ old('observaciones_archivos_multimedia_b', $digitalizado->observaciones_archivos_multimedia_b ?? old('observaciones_archivos_multimedia_b')) }}</textarea>
@error('observaciones_archivos_multimedia_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
                				    <div class="col-xs-12 col-xs-6 form-group">
                					<label for="OBSERVACIONES">CONTIENE CARPETAS COMPRIMIDAS:</label><br>
                					<textarea placeholder="Relacionar si continie carpetas comprimidas, si descargar o si contiene errores" class="form-control  @error('carpetas_comprimidas_b') is-invalid @enderror" style="height:100px" id="carpetas_comprimidas_b" name="carpetas_comprimidas_b">{{ old('carpetas_comprimidas_b', $digitalizado->carpetas_comprimidas_b ?? old('carpetas_comprimidas_b')) }}</textarea>
@error('carpetas_comprimidas_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
                				    <div class="col-xs-12 col-xs-6 form-group">
                					<label for="OBSERVACIONES">ORGANIZACION SEGUN PROTOCOLO2:</label><br>
                					<textarea placeholder="Relacionar si contiene carpetas comprimidas, si descargar o si contiene errores" class="form-control  @error('carpetas_protocolodos_b') is-invalid @enderror" style="height:100px" id="carpetas_protocolodos_b" name="carpetas_protocolodos_b">{{ old('carpetas_protocolodos_b', $digitalizado->carpetas_protocolodos_b ?? old('carpetas_protocolodos_b')) }}</textarea>
@error('carpetas_protocolodos_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
                				    <div class="col-xs-12 form-group">
                					<label for="OBSERVACIONES">OBSERVACIONES GENERAL BESTDOC:</label><br>
                					<textarea placeholder="Observaciones Archivos Multimedia" class="form-control  @error('observaciones_generales_b') is-invalid @enderror" style="height:100px" id="observaciones_generales_b" name="observaciones_generales_b">{{ old('observaciones_generales_b', $digitalizado->observaciones_generales_b ?? old('observaciones_generales_b')) }}</textarea>
@error('observaciones_generales_b')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
                				    </div>
			    	         </div>
			    	    </div>
			    	</div>
			    </div>
			    <!--div class="row">
				     <div class="col-xs-6 col-sm-4 col-md-4 form-group" style="background-color:#eefaf0">
				        <label for="Visor">VISOR:</label><br>
				        @foreach($visor as $visor)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$visor}} name="visor"  required @if($digitalizado->visor==$visor) checked @endif > {{$visor}} </label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-6 col-sm-4 col-md-4 form-group"   >
				        <label for="Contiene CD">CONTIENE CD:</label><br>
				        @foreach($cd as $cd)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$cd}} name="cd"  required @if($digitalizado->cd==$cd) checked @endif> {{$cd}} </label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-6 col-sm-4 col-md-4 form-group">
				        <label for="visualizar indice">VISUALIZAR INDICE:</label><br>
				        @foreach($indices as $indice)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$indice}} name="indice"  required @if($digitalizado->indice==$indice) checked @endif> {{$indice}}</label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-6 col-sm-4 col-md-4 form-group" >
				        <label for="DEMANDANTE">DEMANDANTE:</label><br>
				        @foreach($demte as $key => $demt)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="demandante"  value={{$demt}} name="demandante"  required @if($digitalizado->demandante==$demt) checked @endif> {{$demt}}</label>
                        </div>
                        @endforeach   
                     </div>
				    <div class="col-xs-6 col-sm-4 col-md-4 form-group" style="background-color:#eefaf0">
				        <label for="demandado">DEMANDADO:</label><br>
				        @foreach($demdo as $demando )
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$demando}} name="demandado"  required @if($digitalizado->demandado==$demando) checked @endif> {{$demando}}</label>
                        </div>
                        @endforeach   
                     </div>
                      <div class="col-xs-6 col-sm-4 col-md-4 form-group" >
					   <label for="tipificacion">TIPIFICACI&Oacute;N:</label><br>
				        @foreach($tipific as $tipifi)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$tipifi}} name="tipificacion"  required @if($digitalizado->tipificacion==$tipifi) checked @endif> {{$tipifi}}</label>
                        </div>
                        @endforeach   
                     </div>
                      
				    
				    <div class="col-xs-12  form-group">
					<label for="OBSERVACIONES">OBSERVACIONES:</label><br>
					<textarea placeholder="Ingresa las observaciones Encontradas" class="form-control height=&quot;3em&quot; @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones">{{ old('observaciones', $digitalizado->observaciones ?? old('observaciones')) }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				    </div>
				    
				    
                </div -->
                <div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" type="submit">Guardar Reporte</button>
						</div>
						<div class="col-xs-6">
							<a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">Cancelar</a>
						</div>
						
			   </div>
					
					
			
			</form>
<hr>



<script src="/js/jquery.js"></script>
<script>

//mostrar div
    function no_requerido() {
        sin_atributo();
          if( $('#bestdoc').is(":visible") ) {
            $('#bestdoc').css('display', 'none'); 
            sin_atributo()
          } else {
            $('#bestdoc').css('display', 'none');
            sin_atributo()
          } 
        sin_atributo()
        
    };
    function requerido() {
        document.getElementById("bestdoc").removeAttribute("display:none");
         $('#bestdoc').css('display', '');
         $('#bestdoc').css('visibility', 'visible');
         atributo();
    };
    

function atributo(){
      document.getElementById("cantidad_archivos_b").setAttribute("required",'True');
        document.getElementById("cantidad_archivos_multimedia_b").setAttribute("required",'True');
        document.getElementById("observaciones_archivos_multimedia_b").setAttribute("required",'True');
        document.getElementById("numero_archivos_multimedia_b").setAttribute("required",'True');
        document.getElementById("carpetas_comprimidas_b").setAttribute("required",'True');
        document.getElementById("carpetas_protocolodos_b").setAttribute("required",'True');
        document.getElementById("observaciones_generales_b").setAttribute("required",'True');
      
}
    function sin_atributo(){
        document.getElementById("cantidad_archivos_b").removeAttribute("required");
        document.getElementById("cantidad_archivos_multimedia_b").removeAttribute("required");
        document.getElementById("observaciones_archivos_multimedia_b").removeAttribute("required");
        document.getElementById("numero_archivos_multimedia_b").removeAttribute("required");
        document.getElementById("carpetas_protocolodos_b").removeAttribute("required");
        document.getElementById("carpetas_comprimidas_b").removeAttribute("required");
        document.getElementById("observaciones_generales_b").removeAttribute("required");
    }
</script>




@endsection

@else
    @include('digitalizacionPDos.digitalizacion')
@endif

