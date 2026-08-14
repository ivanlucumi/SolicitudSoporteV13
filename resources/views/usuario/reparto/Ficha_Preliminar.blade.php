@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Ficha de Remision')
@section('cabecera', 'Ficha de Solicitud')


  <script src="/js/jquery.js"></script>

@section('content') 
<form enctype="multipart/form-data" action="{{ route('usuario.ficha.preliminar.store') }}" method="POST">
    @csrf 
<div class="row">
    
    <div class="col-xs-12 col-sm-3"></div>
    <div class="col-xs-12 col-sm-6">
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> RADICACION (23 D&iacute;gitos):</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
               <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" min="1" placeholder="Ingrese número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso') }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            <span id="cantidad"></span>
           </div> 
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> PROCESADO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              	<input class="form-control @error('procesado') is-invalid @enderror" placeholder="Ingrese Nombre Procesado" type="text" name="procesado" id="procesado" value="{{ old('procesado') }}">
@error('procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
           </div> 
        </div>
         <div class="row">
            <div class="col-xs-12 col-sm-6">
                 <h4><strong> TIPO SOLICITUD:</strong></h4>
            </div> 
            <div class="col-xs-12 col-sm-6">
            	<select class="form-control @error('tipo_solicitud') is-invalid @enderror" autocomplete="off" name="tipo_solicitud" id="tipo_solicitud">
    <option value="">Seleccione Tipo Solicitud</option>
    @foreach($tipoAudiencia as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
            </div> 
         </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> URL:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input class="form-control @error('url_expediente') is-invalid @enderror" placeholder="Registre URL en Caso de Pruebas" type="url" name="url_expediente" id="url_expediente" value="{{ old('url_expediente') }}">
@error('url_expediente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DOCUMENTO SOLICITUD:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input class="form-control-file form-group @error('anexos') is-invalid @enderror" id="file_anexo" accept="application/pdf" type="file" name="anexos">
@error('anexos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DESPACHO QUE REMITE:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input class="form-control @error('despacho_remite') is-invalid @enderror" type="text" name="despacho_remite" id="despacho_remite" value="{{ old('despacho_remite',  auth()->user()->name) }}">
@error('despacho_remite')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
         
         <hr>
         <div class="row">
            <div col-xs-12 col-sm-4 ></div> 
            <div col-xs-12 col-sm-4 >
                <button class="btn btn-success btn-block" type="submit">REALIZAR SOLICITUD</button>
            </div> 
            <div col-xs-12 col-sm-4 ></div> 
         </div>     
    
  
        
    </div>
    <div class="col-xs-12 col-sm-3"></div>
    
</div>



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




@endsection