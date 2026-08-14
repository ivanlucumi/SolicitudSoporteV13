@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Repartos')
@section('cabecera', 'Documentos con Reparto')

@section('content') 
<form action="{{ route('reparto.asignar.funcionario') }}" method="POST">
    @csrf 
		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>FECHA</th>
						      <th>SEGUIMIENTO</th>
						        <th>ESPECIALIDAD</th>
                                <th>NOMBRE_GRUPO</th>
                                <th>COMUNA</th>
                                <th>DEMANDANTE</th>
                                <th>DEMANDADO</th>
                                <!--th>CUADERNO</th>
                                <th>FOLIOS</th>
                                <th>OBSERVACIONES</th>
                                <th>DEMANDA Y PODER</th>
                                <th>ANEXOS</th>
                                <th>URL ANEXOS</th-->
                                <th>ASIGNADO A</th>
                                <th>ACTA REPARTO</th>
                                <th>DESPACHO ASIG.</th>
                                
					      </tr>
						</thead>
                            
							 @foreach($repartos as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light"  @if($digit->estado != NULL)
                <?php echo 'style="background-color: #FFE4E1"'; ?>
                @endif>
                                        <th scope="row">{{$digit->fecha_recibido}}</th>
                    				    <th scope="row">{{$digit->seguimiento}}</th>
                    				    <th scope="row">{{$digit->Espec->especialidad}}</th>	
                    					<th scope="row">{{$digit->nombre_grupo}}</th>
                    					<th scope="row">{{$digit->comuna}}</th>
                    					<th scope="row">{{$digit->demandante}}</th>									
                    					<th scope="row">{{$digit->demandado}}</th>
                    					<!--th scope="row">{{$digit->cuaderno}}</th>
                    					<th scope="row">{{$digit->folios}}</th>
                    					<th scope="row">{{$digit->observaciones}}</th>
                    					<th scope="row"><a onClick="window.open('/Reparto/{{$digit->demanda}}','popup', 'width=800px,height=600px')">{{$digit->demanda}} </a> </th>
                    					<th scope="row"><a href="/Reparto/{{$digit->anexos}}" download="{{$digit->anexos}}">{{$digit->anexos}}</a> </th>
                    					<th scope="row">{{$digit->url_anexos}} </th-->
                    					<th scope="row">@if(empty($digit->asignado_a))
                    					  SIN ASIGNAR
                    					  @else
                    					    {{isset($digit->Operario->name) ? $digit->Operario->name : 'No Asignado'}}
                    					    @endif
                    					</th>
                    					<th scope="row"><a onClick="window.open('/Reparto/{{$digit->acta_reparto}}','popup', 'width=800px,height=600px')">{{$digit->acta_reparto}}  </a> </th>
                    					<th scope="row">{{$digit->reparto_asignado_a}}</th>
    					
                    					
                    					
                    					
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
      alert(id);
    var selectedOption = this.options[asignado.selectedIndex];
    console.log(selectedOption.value );
    $.get("/asignar/a_funcionario/" + selectedOption.value + "", function(response) {
            
            if (Object.keys(response).length > 0) {
                
                   alert('se asigno');
                
                
            } else {
                document.getElementById('edad').value = "";
            }
        });
  });
</script>  

@endsection