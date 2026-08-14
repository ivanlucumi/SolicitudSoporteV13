@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Responder Ficha de Remision')
@section('cabecera', 'Responder Ficha de Remision')


  <script src="/js/jquery.js"></script>

@section('content') 


<div class="row">
    
    <div class="col-xs-12 col-sm-3"></div>
    <div class="col-xs-12 col-sm-6">
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> MOTIVO DE LA REMISI&Oacute;N:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              <input class="form-control @error('m_remision') is-invalid @enderror" type="text" name="m_remision" id="m_remision" value="{{ old('m_remision', $remision->m_remision) }}">
@error('m_remision')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
           </div> 
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> ESPECIALIDAD A QUIEN VA DIRIGIDO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              <select id="especialidad" name="especialidad" class="form-control" required disabled>
                  <option value="{{$remision->especialidad}}" >{{$remision->especialidad}}</option>
             </select>
           </div> 
        </div>
          <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DESPACHO QUE REMITE:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input class="form-control @error('despacho_remite') is-invalid @enderror" type="text" name="despacho_remite" id="despacho_remite" value="{{ old('despacho_remite', $remision->despacho_remite) }}">
@error('despacho_remite')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
         <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> RADICACION (23 D&iacute;gitos):</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
               <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" min="1" placeholder="Ingrese número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso', $remision->numero_radicado_proceso) }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            <span id="cantidad"></span>
           </div> 
        </div>
          <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> GRUPO DE REPARTO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              <select id="gr_repart" name="gr_reparto" class="form-control" disabled required>
                  <option value="{{$remision->gr_reparto}}" >{{$remision->gr_reparto}}</option>
              </select>
           </div> 
        </div>
          <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DEMANDANTE:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              	<input class="form-control @error('demandante') is-invalid @enderror" type="text" name="demandante" id="demandante" value="{{ old('demandante', $remision->demandante) }}">
@error('demandante')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
           </div> 
        </div>
         
          <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DEMANDADO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              	<input class="form-control @error('demandado') is-invalid @enderror" type="text" name="demandado" id="demandado" value="{{ old('demandado', $remision->demandado) }}">
@error('demandado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
           </div> 
        </div>
         <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> CONOCIMIENTO PREVIO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
               <select id="concocimiento_pre" name="concocimiento_pre" class="form-control" disabled required>
                   <option value="{{$remision->concocimiento_pre}}" >{{$remision->concocimiento_pre}}</option>
                </select>
           </div> 
        </div>
         <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> URL:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<a class="btn btn-default  btn-block btn-sm" href="{{$remision->url_expediente}}" target="_blank">VER URL DEL EXPEDIENTE</a>	
           </div> 
        </div>
        <form enctype="multipart/form-data" action="{{ route('reparto.update.respuesta.ficha',$remision->id) }}" method="POST">
    @csrf
    @method('PUT')
         <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DESPACHO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<select class="form-control select2 @error('despacho_corresponde') is-invalid @enderror" autocomplete="off" name="despacho_corresponde" id="despacho_corresponde">
    <option value="">Seleccionar Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho_corresponde') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho_corresponde')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> ACTA DE REPARTO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input accept=".pdf,.PDF" class="form-control-file form-group @error('acta_reparto') is-invalid @enderror" id="demanda" onchange="return fileValidation()" type="file" name="acta_reparto">
@error('acta_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> CONSULTA:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input accept=".pdf,.PDF" class="form-control-file form-group @error('consulta') is-invalid @enderror" id="consulta" type="file" name="consulta">
@error('consulta')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
         <hr>
        <div class="row">
           <div class="col-xs-12 col-sm-4">
               
           </div> 
           <div class="col-xs-12 col-sm-4">
	        <button class="btn btn-success btn-block" type="submit">REALIZAR REMISI&Oacute;N</button>
           </div> 
           <div class="col-xs-12 col-sm-4">
	        </form>	
           </div> 
        </div>      
    
    <div class="col-xs-12 col-sm-2">
        
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