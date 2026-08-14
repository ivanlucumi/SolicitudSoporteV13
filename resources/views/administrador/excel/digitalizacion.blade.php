@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Subir excel con registro de digitalizacion')
@section('cabecera', 'Carga de Registro de digitalizacion')

@section('content') 




<div class="container-fluid">
 
<div class="row">
  <div class="col-xs-12 col-md-2">
    
  </div>
  <div class="col-xs-12 col-md-8">
    <form method="POST" action="/administrador/store/save/almacenar/registro/digitalizacion" accept-charset="UTF-8" enctype="multipart/form-data">  
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class=" col-xs-12 col-md-8">
                  <label for="archivo">Seleccione Archivo:</label>                            
                  <input accept=".xls,.xlsx" class="form-control-file form-group @error('file') is-invalid @enderror" type="file" name="file" id="file">
@error('file')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                        <button type="submit" class="btn btn-danger bg-lg form-group btn-block">Subir Excel</button>
                      </div>
                      
                    </div>   

     </form>
        </div>

        <div class="col-xs-12 col-md-2" style="display:none">
           <a href="" onClick="window.open('/formatoExcel/FORMATO PARA SUBIR USUARIO.xls','popup', 'width=800px,height=600px')" class="product-title"><i class="fa fa-file-excel-o fa-4x text-danger" aria-hidden="true"></i>

		  <div class="mask flex-center waves-effect waves-light">Descargar <br> formato no valido</div>
		  </a> 
    
        </div>
    
  </div>

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
  
  <hr>
      <P><strong><h2>PROCESOS POR REVISAR PROTOCOLO 2</h2></strong></P>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-2">
            SIN REGISTRO:<h1 style="color:red"> {{$SinRPDos}}</h1>
        </div>
        <div class="col-xs-12 col-sm-3">
            CON OBSERVACIONES
             <a href="{!! route('administrador.observaciones.protodos')!!}"></i>   <h1 style="color:red">  {{$observaPDos}}</h1> </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            PARA UN TOTAL DE <h1 style="color:red">  {{$cantidadPDos}}</h1>
        </div>
        <div class="col-xs-12 col-sm-2">
        ESTAN O.K <h1 style="color:red">  {{$cantidadOk}}</h1>
        </div>
        <div class="col-xs-12 col-sm-2">
        CORREGIDAS
        <a href="{!! route('administrador.ok.revisados.protodos')!!}"></i>   <h1 style="color:red">  {{$cantidadRevidadaPDos}}</h1> </a>
        </div>
        
    </div>
    
</div>
<hr>

<div class="row">
        <?php $totalAPDOS =0; $TOTALf=0;?>
          <center><strong><h2>REVISADO PROTOCOLO 2 POR ENCARGADO 2022</h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>	
            				<th>FOLIOS</th>	
            		    </tr>
            	    </thead>
            	     @if($estadisticaDigitalizacionPDos2022 != null)
                		    @foreach($estadisticaDigitalizacionPDos2022 as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{number_format(intval($agendador->cantidad), 0 )}}</th>
                					<th scope="row">{{$agendador->folios}}</th>
                										     
                				</tr>	                
                				<?php 
                			$totalAPDOS = $totalAPDOS + $agendador->cantidad;
                			$TOTALf = $TOTALf +$agendador->folios;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th style="color:red"><?php echo number_format($totalAPDOS, 0, ',', '.'); ?></th>
                			        <th style="color:red"><?php echo number_format($TOTALf, 0, ',', '.');  ?></th>
                			    </tr>
                			</tbody>
                			<tbody>
                			    <tr>
                			        <th>Total En la Base de Datos</th>
                			        <th>{{$conteoExpedientesPDos[0]->total}}</th>
                			        <th>{{number_format($proto2Folios, 0, ',', '.')}}</th>
                			    </tr>
                			</tbody>
                			
                	@endif
            	</table>
            </div>
        </div>
  <hr>
  

 
   <div class="row">
       @if($dia0 != null)
       <?php $totald0 =0 ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <center><strong><h2>{{$fecha0}}</h2></strong> </center>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     
                		    @foreach($dia0 as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{$agendador->cantidad}}</th>
                										     
                				</tr>
                				<?php 
                			$totald0 = $totald0 + $agendador->cantidad;
                			?>
                			@endforeach
                				<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totald0 ?></th>
                			    </tr>
                			</tbody>
            	</table>
            </div>
        </div>
        @endif
        @if($dia1 != null)
        <?php $totald1 =0 ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <center><strong><h2>{{$fecha1}}</h2></strong> </center>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     
                		    @foreach($dia1 as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{$agendador->cantidad}}</th>
                										     
                				</tr>
                				<?php 
                			$totald1 = $totald1 + $agendador->cantidad;
                			?>
                			@endforeach
                	<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totald1 ?></th>
                			    </tr>
                			</tbody>
            	</table>
            </div>
        </div>
        @endif
         @if($dia2 != null)
         <?php $totald2 =0 ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <center><strong><h2>{{$fecha2}}</h2></strong> </center>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     
                		    @foreach($dia2 as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{$agendador->cantidad}}</th>
                										     
                				</tr>	
                			<?php 
                			$totald2 = $totald2 + $agendador->cantidad;
                			?>
                			@endforeach
                		<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totald2 ?></th>
                			    </tr>
                			</tbody>
            	</table>
            </div>
        </div>
        @endif
         @if($dia3 != null)
         <?php $totald3 =0 ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <center><strong><h2>{{$fecha3}}</h2></strong> </center>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     
                		    @foreach($dia3 as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{$agendador->cantidad}}</th>
                										     
                				</tr>
                				<?php 
                			$totald3 = $totald3 + $agendador->cantidad;
                			?>
                			@endforeach
                				<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totald3 ?></th>
                			    </tr>
                			</tbody>
            	</table>
            </div>
        </div>
        @endif
         @if($dia4 != null)
         <?php $totald4 =0 ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <center><strong><h2>{{$fecha4}}</h2></strong> </center>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     
                		    @foreach($dia4 as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{$agendador->cantidad}}</th>
                										     
                				</tr>	
                					<?php 
                			$totald4 = $totald4 + $agendador->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totald4 ?></th>
                			    </tr>
                			</tbody>
            	</table>
            </div>
        </div>
        @endif
            
    </div>
  <hr>
      <div class="row">
        <?php $totalA =0 ?>
          <center><strong><h2>TOTAL REVISADO SERVISOFT PROTOCOLO 2 </h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     @if($revisionServisoft != null)
                		    @foreach($revisionServisoftPDos as $servisoft)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$servisoft->name}}</th>
                					<th scope="row">{{$servisoft->cantidad}}</th>
                										     
                				</tr>	                
                				<?php 
                			$totalA = $totalA + $servisoft->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totalA ?></th>
                			    </tr>
                			</tbody>
                			<tbody>
                			    <tr>
                			        <th>Total En la Base de Datos</th>
                			        <th>{{$conteoExpedientesPDos[0]->total}}</th>
                			    </tr>
                			</tbody>
                			
                	@endif
            	</table>
            </div>
        </div>
  
  <hr>
  
   <div class="row">
      <center><strong><h2>PETICIONES DE SOLUCION A DIGITALIZACION</h2></strong> </center>
  </div>
    
  <hr>
  
  <div class="row">
        <?php $totalAPDOS =0 ?>
          <center><strong><h2>REVISADO PROTOCOLO 2 POR ENCARGADO 2021</h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     @if($estadisticaDigitalizacionPDos != null)
                		    @foreach($estadisticaDigitalizacionPDos as $agendador)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendador->name}}</th>
                					<th scope="row">{{$agendador->cantidad}}</th>
                										     
                				</tr>	                
                				<?php 
                			$totalAPDOS = $totalAPDOS + $agendador->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totalAPDOS ?></th>
                			    </tr>
                			</tbody>
                			<tbody>
                			    <tr>
                			        <th>Total En la Base de Datos</th>
                			        <th>{{$conteoExpedientesPDos[0]->total}}</th>
                			    </tr>
                			</tbody>
                			
                	@endif
            	</table>
            </div>
        </div>
  <hr>
  
   
  <div class="row" style="display:none">
        <?php $totalA =0 ?>
          <center><strong><h2>TOTAL REVISADO PROTOCOLO 1 </h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     @if($estadisticaDigitalizacion != null)
                		    @foreach($estadisticaDigitalizacion as $agendadores)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendadores->name}}</th>
                					<th scope="row">{{$agendadores->cantidad}}</th>
                										     
                				</tr>	                
                				<?php 
                			$totalA = $totalA + $agendadores->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totalA ?></th>
                			    </tr>
                			</tbody>
                			<tbody>
                			    <tr>
                			        <th>Total En la Base de Datos</th>
                			        <th>{{$conteoExpedientes[0]->total}}</th>
                			    </tr>
                			</tbody>
                			
                	@endif
            	</table>
            </div>
        </div>
        
        <div class="row" style="display:none">
        <?php $totalA =0 ?>
          <center><strong><h2>TOTAL REVISADO SERVISOFT </h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	
            				<th>NOMBRE</th>
            				<th>CANTIDAD SUPERVISADAS</th>				     				
            		    </tr>
            	    </thead>
            	     @if($revisionServisoft != null)
                		    @foreach($revisionServisoft as $servisoft)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$servisoft->name}}</th>
                					<th scope="row">{{$servisoft->cantidad}}</th>
                										     
                				</tr>	                
                				<?php 
                			$totalA = $totalA + $servisoft->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th>Total Revisadas</th>
                			        <th><?php echo $totalA ?></th>
                			    </tr>
                			</tbody>
                			<tbody>
                			    <tr>
                			        <th>Total En la Base de Datos</th>
                			        <th>{{$conteoExpedientes[0]->total}}</th>
                			    </tr>
                			</tbody>
                			
                	@endif
            	</table>
            </div>
        </div>
  
  <hr>
  <P>PROCESOS POR REVISAR PROTOCOLO 1</P>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            SIN REGISTRO:<h1 style="color:red"> {{$SinR}}</h1>
        </div>
        <div class="col-xs-12 col-sm-4">
            CON OBSERVACIONES <h1 style="color:red">  {{$observa}}</h1>
        </div>
        <div class="col-xs-12 col-sm-4">
            PARA UN TOTAL DE <h1 style="color:red">  {{$cantidad}}</h1>
        </div>
        
    </div>
    
</div>

  <!--div class="row">
      

    <div class="table-responsive">
    	<table id="table9" class="table table-bordered table-striped" >
            <thead class="shadow" style="background-color: #004182; color: #fff;">
    		    <tr>
    		        <th>RadDig</th>
    		        <th>RADICADO</th>
    		        <th>DESPACHO</th>
    		        <th>MUNICIPIO</th>
    		        <th>ESPECIALIDAD</th>
    				<th>CANTIDAD</th>
    				<th>ESTADO</th>
    				<th>OBSERVACIONES</th>
    		    </tr>
    	    </thead>
    	    
    		    @foreach($digitalizado as $digit)
    		    
    			<tbody data-id="{!!$digit->id!!}" class="buscar">
    				<tr class="table-light" >
    				    <th scope="row">{{strlen($digit->radicacion)}}</th>
    					<th scope="row">{{$digit->radicacion}}</th>									
    					<th scope="row">{{$digit->despacho}}</th>									
    					<th scope="row">{{$digit->municipio}}</th>									
    					<th scope="row">{{$digit->especialidad}}</th>
    					<th scope="row">{{$digit->cantidad}}</th>
    					<th scope="row">{{$digit->estado}}</th>
    					<th scope="row">{{$digit->observaciones}}</th>
    					
    				</tr>	                
    			</tbody>
    			@endforeach
    	</table>
    	{{ $digitalizado->links() }}
    </div>
      
  </div-->
  
</div>   
  @endsection