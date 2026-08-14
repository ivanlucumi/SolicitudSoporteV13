@extends('layouts.VigilanciaJudicial')
<!--ponerle titulo a la paginga-->
@section('title', 'Repartos')
@section('cabecera', 'Solicitudes de Vigilancia')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">


		            <!-- /.box-header -->
           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped  table-condensed table-hover" style="width:auto; height:20px;" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						        <th>FECHA</th>
						        <th>SEGUIMIENTO</th>
						        <th>SOLICITANTE</th>
                                <th>NOMBRE</th>
                                <th>RADICADO</th>
                                <th>DESPACHO</th>
                                <th>DEMANDANTE</th>
                                <th>DEMANDADO</th>
                                
					      </tr>
						</thead>
                            
							 @foreach($repartos as $digit)
		    
                    			<tbody data-id="{!!$digit->id!!}" class="buscar">
                    				<tr class="table-light"@if($digit->user_id == null)
                    				<?php echo 'style="background-color:"'; ?>
                                     @endif
                    				@if($digit->user_id !=  auth()->user()->id)
                    				<?php echo 'style="background-color: #FFE4E1"'; ?>
                                     @endif
                                     @if($digit->user_id ==  auth()->user()->id)
                    				<?php echo 'style="background-color: #DAF7A6"'; ?>
                                     @endif >
                    				    <th scope="row">{{$digit->fecha_recibido}}</th>
                    				    <th scope="row">{{$digit->seguimiento}}</th>
                    				    <th scope="row">{{$digit->tipo_solicitante}}</th>	
                    					<th scope="row">{{$digit->cedula}}<br>{{$digit->nombre_apellido}}</th>	
                    					<th scope="row">{{$digit->num_radicado}}</th>		
                    					<th scope="row">{{$digit->despacho_encuentra}}</th>
                    					<th scope="row">{{$digit->demandante}}</th>
                    					<th scope="row">{{$digit->demandado}}</th>
                    					<th scope="row"><a href="{{ route('reparto.vigilancia.judicial.reparto', $digit->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Asignar"></a></th>
                    					
    					
                    					
                    					
                    					
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
<script src="/js/Vigilancia.js"></script> 

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
	fileName: "Solicitudes de Vigilancia",    //Nombre del archivo 
});

</script>

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