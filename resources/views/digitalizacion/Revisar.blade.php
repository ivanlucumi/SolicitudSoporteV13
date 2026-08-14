@if( auth()->user()->email != "servisoft@disajcali.gov.co")
@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Revisar Proceso de Digitalizacion')
@section('cabecera', 'Revisar Proceso de Digitalizacion')

@section('content') 
<div class="container-fluid">
@include('../alerts.request')



			<form action="{{ route('digitalizacion.update',$digitalizado->id) }}" method="POST">
    @csrf
    @method('PUT')
			<input type="hidden" name="fecha_revision"  value="<?php echo date("Y-m-d");?>">
    			<div class="row">
    				<div class="col-xs-12 col-sm-6 col-md-4 form-group">
    					<label for="Radicado" class="fa fa-asterisk">Radicado :</label>
    					<input class="form-control @error('radicacion') is-invalid @enderror" autocomplete="off" type="text" name="radicacion" id="radicacion" value="{{ old('radicacion', $digitalizado->radicacion ?? $digitalizado->radicacion) }}">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 form-group">
    					<label for="Despacho" class="fa fa-asterisk">Despacho :</label>
    					<input class="form-control @error('despacho') is-invalid @enderror" autocomplete="off" type="text" name="despacho" id="despacho" value="{{ old('despacho', $digitalizado->despacho ?? $digitalizado->despacho) }}">
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 form-group">
    					<label for="Municipio">Municipio :</label>
    					<input class="form-control @error('municipio') is-invalid @enderror" autocomplete="off" type="text" name="municipio" id="municipio" value="{{ old('municipio', $digitalizado->municipio ?? $digitalizado->municipio) }}">
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				
    				<div class="col-xs-12 col-sm-6 col-md-4 form-group">
    					<label for="Especialidad" class="fa fa-asterisk">Especialidad :</label>
    					<input class="form-control @error('especialidad') is-invalid @enderror" required="required" autocomplete="off" type="email" name="especialidad" id="especialidad" value="{{ old('especialidad', $digitalizado->especialidad ?? $digitalizado->especialidad) }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 form-group">
    					<label for="Cantidad" class="fa fa-asterisk">Cantidad :</label>
    					<input class="form-control @error('cantidad') is-invalid @enderror" required="required" autocomplete="off" type="email" name="cantidad" id="cantidad" value="{{ old('cantidad', $digitalizado->cantidad ?? $digitalizado->cantidad) }}">
@error('cantidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				
    				
				
				</div>
				
				<hr>
				<p ><h1><center style="strong">SUPERVISI&Oacute;N</center></h1></p>
				<hr>
				<div class="row">
				    
				    <div class="col-xs-12 col-sm-6 col-md-2 form-group" style="display:none">
					<label for="Llave 23" class="fa fa-asterisk">Cumple 23 Digitos:</label><br>
					<input placeholder="Seleccione Si cumple 23 Dig" class="form-control @error('llave_digitos_23') is-invalid @enderror" type="text" name="llave_digitos_23" id="llave_digitos_23" value="{{ old('llave_digitos_23', $digitalizado->llave_digitos_23 ?? 'CUMPLE') }}">
@error('llave_digitos_23')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				    </div>
				    <div  class="col-xs-12  col-md-12 form-group">
        				    <div class="col-xs-12 col-sm-6 col-md-2 form-group">
        					<label for="pdf" class="fa fa-asterisk">Pdf:</label><br>
        					<input class="form-control @error('nombre_pdf') is-invalid @enderror" autocomplete="off" id="nombre_pdf" type="text" name="nombre_pdf" value="{{ old('nombre_pdf', $digitalizado->nombre_pdf ?? old('nombre_pdf')) }}">
@error('nombre_pdf')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        				    </div>
        				    <div class="col-xs-12 col-sm-5 col-md-2 form-group">
        					<label for="no_paginas" class="fa fa-asterisk">No. p&aacute;ginas:</label><br>
        					<input class="form-control @error('cantidad_paginas') is-invalid @enderror" autocomplete="off" min="0" id="cantidad_paginas" type="number" name="cantidad_paginas" value="{{ old('cantidad_paginas', $digitalizado->cantidad_paginas ?? old('cantidad_paginas')) }}">
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
			    	</div>
			    </div>
			    <div class="row">
				     <div class="col-xs-12  col-md-4 form-group" style="background-color:#eefaf0">
				        <label for="Visor">VISOR:</label><br>
				        @foreach($visor as $visor)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$visor}} name="visor"  required @if($digitalizado->visor==$visor) checked @endif > {{$visor}} </label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-12  col-md-4 form-group"   >
				        <label for="Contiene CD">CONTIENE CD:</label><br>
				        @foreach($cd as $cd)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$cd}} name="cd"  required @if($digitalizado->cd==$cd) checked @endif> {{$cd}} </label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-12  col-md-4 form-group" style="background-color:#eefaf0">
				        <label for="visualizar videos">VISUALIZAR VIDEOS:</label><br>
				        @foreach($digitales as $digital)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$digital}} name="ver_video"  required @if($digitalizado->ver_video==$digital) checked @endif> {{$digital}}</label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-12  col-md-4 form-group">
				        <label for="visualizar indice">VISUALIZAR INDICE:</label><br>
				        @foreach($indices as $indice)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$indice}} name="indice"  required @if($digitalizado->indice==$indice) checked @endif> {{$indice}}</label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-12  col-md-4 form-group"  style="background-color:#eefaf0">
				        <label for="visualizar expediente completo">VISUALIZAR EXPEDIENTE COMPLETO:</label><br>
				        @foreach($expedientes as $expediente)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$expediente}} name="ver_exp_completo"  required @if($digitalizado->ver_exp_completo==$expediente) checked @endif> {{$expediente}}</label>
                        </div>
                        @endforeach   
                     </div>
                     <div class="col-xs-12  col-md-4 form-group" >
				        <label for="DEMANDANTE">DEMANDANTE:</label><br>
				        @foreach($demte as $demt)
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$demt}} name="demandante"  required @if($digitalizado->demandante==$demt) checked @endif> {{$demt}}</label>
                        </div>
                        @endforeach   
                     </div>
				    <div class="col-xs-12  col-md-4 form-group" style="background-color:#eefaf0">
				        <label for="demandado">DEMANDADO:</label><br>
				        @foreach($demdo as $demando )
                        <div class="col-xs-12 col-lg-6">
                            <label><input type="radio" id="cbox2" value={{$demando}} name="demandado"  required @if($digitalizado->demandado==$demando) checked @endif> {{$demando}}</label>
                        </div>
                        @endforeach   
                     </div>
                      <div class="col-xs-12  col-md-4 form-group" >
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
				    
				    
                </div>
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


<form id="form-delete-PDF" action="{{ route('delete.pdf',':PDF_ID') }}" method="POST">
    @csrf
    @method('DELETE')
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>  

<script>

$(document).ready(function() {

    
  $('#informacion_pdf').click(function(e) {
        e.preventDefault();
        var radicado_id = $("input#radicado_id").val();
        var cantidad_paginas = $("input#cantidad_paginas").val();
        var nombre_pdf = $("input#nombre_pdf").val();
        var dataString = 'cantidad_paginas='+ cantidad_paginas + '&nombre_pdf=' + nombre_pdf + '&radicado_id=' + radicado_id;
 // alert (dataString);
        
  
   $.ajax({
       
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            url: "/revision/proceso/digitalizacion/supervision/save/" + radicado_id,
            data: dataString,
            success: function(data) {
                
            $("#cantidad_paginas").val("");
            $("#nombre_pdf").val("");
            
            //console.log(data[0])
            
            //$('#id_pdfs').setAttribute('data-id',  data[0].id);
            var d = document.getElementById("id_pdfs");  //   Javascript
                d.setAttribute('data-id' , data[0].id);
                
            
            $('#id_pdfs').append('<tr><td>' + data[0].nombre_pdf + 
                                           '</td><td>' + data[0].cantidad_paginas + 
                                           '</td><td>'+

                              '<a id="eliminarPfd" class="btn btn-danger  bnt-xs fa fa-trash fa-lg eliminarPfd"></a>' 
                            
                     
                        + '</td></tr>');
            
                
             document.querySelector('#total_paginas').innerText = data[1];
             
             window.location.reload(); 
             
             //d.removeAttribute('id');
            }
        });
  
  return false;
  });
  
  

  
   //BORRRAR DATOS DE PDF
$('.eliminarPfd').click(function(e) {       
       e.preventDefault();

       var row = $(this).parents('tbody')
       
       //alert(row)
       var id = row.data('id');
       var form = $('#form-delete-PDF');
       var url = form.attr('action').replace(':PDF_ID', id);
       var data = form.serialize();
     
     //alert();
       row.fadeOut();
      $.post(url, data, function(result){
        
        document.querySelector('#total_paginas').innerText = result;
        
       });

     });

    });

</script>




@endsection

@else
    @include('digitalizacion.digitalizacion')
@endif

