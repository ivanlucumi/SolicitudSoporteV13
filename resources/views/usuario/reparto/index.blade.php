@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Repartos')
@section('cabecera', 'Solicitudes de Repartos')

@section('content') 
<form action="{{ route('reparto.asignar.funcionario') }}" method="POST">
    @csrf 
@if( auth()->user()->rol == 15)
<div class="row">
    <div class="col-xs-12 col-sm-4">
       <select class="form-control @error('asignado_a') is-invalid @enderror" id="asignad" autocomplete="off" name="asignado_a">
    <option value="">Asignar Reparto</option>
    @foreach($operariosR as $key => $value)
        <option value="{{ $key }}" @selected(old('asignado_a') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('asignado_a')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      
    </div>
    <div class="col-xs-12 col-sm-2">
        <button class="btn btn-primary btn-block" type="submit">Asignar</button>
    </div>
                   				
</div>
@endif

		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped  table-condensed table-hover" style="width:auto; height:20px;" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      @if( auth()->user()->rol == 15)
						        <th></th>
						       @endif
						        <th>FECHA</th>
						        <th>SEGUIMIENTO</th>
						        <th>ESPECIALIDAD</th>
                                <th>NOMBRE_GRUPO</th>
                                <th>COMUNA</th>
                                <th>ULR ANEXOS</th>
                                <th>TRASLADAR</th>
                                
					      </tr>
						</thead>
                            
							 @foreach($repartos as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light"@if($digit->estado == null)
                    				<?php echo 'style="background-color:"'; ?>
                                     @endif
                    				@if($digit->estado !=  auth()->user()->id)
                    				<?php echo 'style="background-color: #FFE4E1"'; ?>
                                     @endif
                                     @if($digit->estado ==  auth()->user()->id)
                    				<?php echo 'style="background-color: #DAF7A6"'; ?>
                                     @endif >
                    				    @if( auth()->user()->rol == 15)<th scope="row"><label><input name="lista[]" type="checkbox" id="cbox1" value="{!!$digit->id!!}"></label><br></th>@endif
                    				    <th scope="row">{{$digit->fecha_recibido}}</th>
                    				    <th scope="row">{{$digit->seguimiento}}</th>
                    				    <th scope="row">{{$digit->Espec->especialidad}}</th>	
                    					<th scope="row">{{$digit->nombre_grupo}}</th>	
                    					<th scope="row">{{$digit->comuna}}</th>		
                    					<th scope="row">{{$digit->url_anexos}}</th>
                    					<th scope="row"><a href="{{ route('reparto.traslado', $digit->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Asignar"></a></th>
                    					
    					
                    					
                    					
                    					
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						
                    	</form>	            
				     </table>
				  </div>
				</div>
			 </div>

			<!-- /.box-body -->	



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/indexReparto.js"></script> 

<script>

 //BotonAutorizar
  $('#BotonAutorizar').click(function(e) { 
  e.preventDefault();   
  var asignado = document.getElementById('asignad');
  alert(asignado)
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //var id = document.getElementById('id').value 
  //alert(id);
  var form  = $('#form-autorizar-ingreso');
  var url   = form.attr('action').replace(':PLACAING_ID', id);
  var data  = form.serialize();
  
  
  $.get(url,data, function(result){
    
  });
  
  });

var asignado = document.getElementById('asignad');
asignado.addEventListener('change',
  function(){
      var row   = $(this).parents('tbody')
      var id    = row.data('id');
      //alert(id);
    var selectedOption = this.options[asignado.selectedIndex];
    console.log(selectedOption.value );
    $.get("/asignar/a_funcionario/" + selectedOption.value + "", function(response) {
            
            if (Object.keys(response).length > 0) {
                
                   console.log('se asigno');
                
                
            } else {
                document.getElementById('edad').value = "";
            }
        });
  });
</script>  

@endsection