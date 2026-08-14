@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Regsitro Incidentes Mercurio')
@section('cabecera', 'Regsitro Incidentes Mercurio')

@section('content') 
<form action="{{ route('administrador.save.incidentes') }}" method="POST">
    @csrf 
<div class="container-fluid">
      <hr>
      <P><strong><h2>REGISTRO DE INCIDENTES</h2></strong></P>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            PENDIENTES POR RESOLVER:  <a href="{!! route('administrador.registro.incidentes')!!}"></i> <h1 style="color:red"> {{$incidentesTotal}}</h1>
        </div>
        <div class="col-xs-12 col-sm-4">
            RESUELTOS
             <a href="{!! route('administrador.registro.incidentes')!!}"></i>   <h1 style="color:red">  {{$resueltosTotal}}</h1> </a>
        </div>
        
    </div>
    
</div>

<div class="row">
    
    
      <input class="form-control @error('usuario') is-invalid @enderror" type="text" name="usuario" id="usuario" value="{{ old('usuario',  auth()->user()->name.' '.  auth()->user()->lastname) }}">
@error('usuario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      
	 
    <div class="col-xs-12 col-sm-4 form-group ">
     <label for="Despacho">Despacho:</label>  
     <input class="form-control @error('despacho_que_solicita') is-invalid @enderror" placeholder="Despacho" type="text" name="despacho_que_solicita" id="despacho_que_solicita" value="{{ old('despacho_que_solicita') }}">
@error('despacho_que_solicita')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-sm-4 form-group ">
     <label for="nRadicacion">Radicacion:</label>  
     <input class="form-control @error('radicacion') is-invalid @enderror" placeholder="Radicado Expediente" id="nProceso" type="number" name="radicacion" value="{{ old('radicacion') }}">
@error('radicacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
     <div id="cantidad"></div>
    </div>
    <div class="col-xs-12 col-sm-4 form-group">
		<label for="estado" class="fa fa-asterisk">Seleccione Estado:</label><br>
		<select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
    <option value="">Seleccione Rol</option>
    @foreach($estados as $key => $value)
        <option value="{{ $key }}" @selected(old('estado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('estado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
	</div>
	
    <div class="col-xs-12 col-sm-12 form-group ">
    <label for="nRadicacion">Solicitud:</label>  
    <textarea class="form-control @error('solicitud') is-invalid @enderror" placeholder="Descripcion Solicitud" autocomplete="off" style="height:5em;" name="solicitud" id="solicitud">{{ old('solicitud') }}</textarea>
@error('solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>

    <div class="col-xs-12 col-sm-12">
        <button class="btn btn-primary btn-block" type="submit">Registrar</button>
    </div>
                   				
</div>

</form>	 
<hr>

           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped  table-condensed table-hover"  >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      @if( auth()->user()->rol == 15)
						        <th></th>
						       @endif
						        <th>USUARIO</th>
						        <th>SOLICITUD</th>
						        <th>FECHA</th>
                                <th>DESPACHO</th>
                                <th>RADICACION</th>
                                <th>ESTADO</th>
                                <th>SOLUCION</th>
                                <th>QUIEN</th>
                                <th>FECHA</th>
                                
					      </tr>
						</thead>
                            
							 @foreach($incidentes as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light" >
                    				    <th scope="row">{{$digit->usuario}}</th>
                    				    <th scope="row">{{$digit->solicitud}}</th>
                    				    <th scope="row">{{$digit->fecha_solicitud}}</th>	
                    					<th scope="row">{{$digit->despacho_que_solicita}}</th>	
                    					<th scope="row">{{$digit->radicacion}}</th>	
                    					<th scope="row">{{$digit->estado}}</th>
                    					<th scope="row">{{$digit->solucion}}</th>	
                    					<th scope="row">{{$digit->quien_soluciono}}
                    					</th><th scope="row">{{$digit->fecha_solucion}}</th>
    					
                    					
                    					
                    					
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						          
				     </table>
				  </div>
				</div>
			 
</div>
			<!-- /.box-body -->	



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/indexReparto.js"></script> 

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
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })
 
function nombre(id){
        //console.log(id)
        div = document.getElementById(id);
            
        console.log('hola')

        } 
    
</script>

@endsection