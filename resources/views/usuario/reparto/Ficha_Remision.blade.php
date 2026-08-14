@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Ficha de Remision')
@section('cabecera', 'Ficha de Remision')


  <script src="/js/jquery.js"></script>

@section('content') 
<form action="{{ route('usuario.ficha.remision.store') }}" method="POST">
    @csrf 
<div class="row">
    
    <div class="col-xs-12 col-sm-3"></div>
    <div class="col-xs-12 col-sm-6">
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h3><strong> MOTIVO DE LA REMISI&Oacute;N:</strong></h3>
           </div> 
           <div class="col-xs-12 col-sm-6">
              <div class="col-xs-12 ">
                <label><input type="radio" id="cbox2" value="Por_Competencia" name="m_remision" required> POR COMPETENCIA</label>
              </div>
              <div class="col-xs-12 ">
                    <label><input type="radio" id="cbox2" value="En_Segunda_Instancia" name="m_remision" required > EN SEGUNDA INSTANCIA</label>

                </div> 
           </div> 
        </div>
        <hr>
        <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> ESPECIALIDAD A QUIEN VA DIRIGIDO:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              <select id="especialidad" name="especialidad" class="form-control" required>
                <option>--- Seleccione un Especialidad ---</option>
                 @foreach($especialidad as $especia)
                  <option value="{{$especia}}" >{{$especia}}</option>
                 @endforeach
             </select>
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
         <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> RADICACION (23 D&iacute;gitos):</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
               <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" min="1" placeholder="Ingrese n¨²mero de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso') }}">
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
              </select>
           </div> 
        </div>
          <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> DEMANDANTE:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
              	<input class="form-control @error('demandante') is-invalid @enderror" type="text" name="demandante" id="demandante" value="{{ old('demandante') }}">
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
              	<input class="form-control @error('demandado') is-invalid @enderror" type="text" name="demandado" id="demandado" value="{{ old('demandado') }}">
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
                        </select>
           </div> 
        </div>
         <div class="row">
           <div class="col-xs-12 col-sm-6">
               <h4><strong> URL:</strong></h4>
           </div> 
           <div class="col-xs-12 col-sm-6">
	        	<input class="form-control @error('url_expediente') is-invalid @enderror" type="url" name="url_expediente" id="url_expediente" value="{{ old('url_expediente') }}">
@error('url_expediente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
           </div> 
        </div>
         <hr>
              
    
    <div class="col-xs-12 col-sm-2">
        <button class="btn btn-primary btn-block" type="submit">Generar Ficha</button>
    </div>
  
        
    </div>
    <div class="col-xs-12 col-sm-3"></div>
    
      

        

                    				
</div>



<script>
    $(document).ready(function() {
        $('#especialidad').change(function() {
            $('#concocimiento_pre').empty();
            $('#concocimiento_pre').prop('disabled', false);
            const city_dropdown = $('#concocimiento_pre');
            $.ajax({
                url: "{{ route('usuario.ficha.conocimiento') }}",
                data: {
                    subcategoria_id: $(this).val()
                },
                success: function(data) {
                    city_dropdown.html('<option value="" selected>--- Seleccione Despacho ---</option>');
                    city_dropdown.append('<option value="VA POR PRIMERA VEZ" >--- VA POR PRIMERA VEZ ---</option>');
                    $.each(data, function(id, value) {
                        city_dropdown.append('<option value=" + value.nombreDespacho + ">' + value.nombreDespacho + '</option>');
                    });
                }, error: function (response) {
                    //alert(error con la peticiÃ³n);
                    city_dropdown.html('<option value="N/A" selected>--- N/A ---</option>');
                    city_dropdown.append('<option value="VA POR PRIMERA VEZ" >--- VA POR PRIMERA VEZ ---</option>');
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#especialidad').change(function() {
            $('#gr_repart').empty();
            $('#gr_repart').prop('disabled', false);
            const gr_repart = $('#gr_repart');
            $.ajax({
                url: "{{ route('usuario.ficha.gr_reparto') }}",
                data: {
                    gr_reparto: $(this).val()
                },
                success: function(data) {
                    console.log(data)
                    gr_repart.html('<option value="" selected>--- SELECCIONE GRUPO REPARTO ---</option>');
                    $.each(data, function(id, value) {
                        gr_repart.append('<option value=" + value.grupo_reparto + ">' + value.grupo_reparto + '</option>');
                    });
                }, error: function (response) {
                    //alert(error con la peticiÃ³n);
                    gr_repart.html('<option value="N/A" selected>--- SELECCIONE GRUPO REPARTO  ---</option>');
                }
            })
        })
    })
</script>


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