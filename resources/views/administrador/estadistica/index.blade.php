@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista Usuarios')
@section('cabecera', 'Usuarios Disponibles')

@section('content') 


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6">
        <?php $totalA =0 ?>
          <center><strong><h2>AGENDADORES</h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	<th>ID</th>
            				<th>NOMBRE</th>
            				<th>CANTIDAD AGENDADA</th>				     				
            		    </tr>
            	    </thead>
            	     @if($estadisticaAgendadores != null)
                		    @foreach($estadisticaAgendadores as $agendadores)
                			<tbody class="buscar">
                				<tr class="table-light">
                					<th scope="row"> {{$agendadores->quien_asigno}}</th>
                					<th scope="row">@if ($agendadores->quien_asigno == null) Falta por agendar 
                					@else
                					{{$agendadores->name}}
                					
                					@endif</th>
                					<th scope="row">{{$agendadores->cantidad}}</th>
                										     
                				</tr>	                
                				<?php 
                			$totalA = $totalA + $agendadores->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th></th>
                			        <th>Total agendadas</th>
                			        <th><?php echo $totalA ?></th>
                			    </tr>
                			</tbody>
                	@endif
            	</table>
            </div>
        </div>
        
        <!--POR MESES -->
        <?php $total =0 ?>
        <div class="col-xs-12 col-md-6">
          <center><strong><h2>AGENDADORES POR MES DE {{$mesAg}}</h2></strong> </center>
          <div class="row">
              <form action="{{ route('administrador.estadistica.agendadores') }}" method="POST">
    @csrf
              
              <div class="col-xs-12 col-sm-4">
                  <label for="Rol">Fecha inicio:</label>
					<input placeholder="Inicio" class="form-control @error('agendadorMesi') is-invalid @enderror" type="date" name="agendadorMesi" id="agendadorMesi" value="{{ old('agendadorMesi') }}">
@error('agendadorMesi')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
              </div>
              <div class="col-xs-12 col-sm-4">
                  <label for="Rol">Fecha fin:</label>
					<input placeholder="Fin" class="form-control @error('agendadorMesf') is-invalid @enderror" type="date" name="agendadorMesf" id="agendadorMesf" value="{{ old('agendadorMesf') }}">
@error('agendadorMesf')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
              </div>
              <div class="col-xs-12 col-sm-4">
                   <br>
                  <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
                 </form>
              </div>
          </div>
          	
          <hr>
            <div  class="table-responsive">
            	<table class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	<th>ID</th>
            				<th>NOMBRE</th>
            				<th>CANTIDAD AGENDADA</th>				     				
            		    </tr>
            	    </thead>
            	     @if($estadisticaAgendadoresMes != null)
                		    @foreach($estadisticaAgendadoresMes as $agendadoresm)
                			<tbody class="buscar">
                			    @if ($agendadoresm->quien_asigno != null) 
                				<tr class="table-light">
                					<th scope="row"> {{$agendadoresm->quien_asigno}}</th>
                					<th scope="row">{{$agendadoresm->name}}</th>
                					<th scope="row">{{$agendadoresm->cantidad}}</th>
                										     
                				</tr>
                				@endif
                			</tbody>
                		<?php 
                			$total = $total + $agendadoresm->cantidad;
                			?>
                			@endforeach
                			<tbody>
                			    <tr>
                			        <th></th>
                			        <th>Total agendadas</th>
                			        <th><?php echo $total ?></th>
                			    </tr>
                			</tbody>
                		@endif
            	    
            	
            	</table>
            </div>
        </div>
        
        <hr>
        
        <!-- solicitudes por despacho -->
        <div class="col-xs-12 col-md-6">
            
          <center><strong><h2>TOTAL SOLICITUDES DE DESPACHOS</h2></strong> </center>
          <hr>
            <div class="table-responsive">
            	<table id="table91"  class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	<th>CODIGO DESPACHO</th>
            				<th>NOMBRE DESPACHO</th>
            				<th>TOTAL SOLICITUDES</th>
            				<th>EMAIL</th>
            										     				
            		    </tr>
            	    </thead>
            	     @if($estadistica != null)
                            		    @foreach($estadistica as $estadist)
                            			<tbody class="buscar">
                            				<tr class="table-light">
                            					<th scope="row"> {{$estadist->codigo_despacho}}</th>
                            					<th scope="row">{{$estadist->name}}</th>
                            					<th scope="row">{{$estadist->cantidad}}</th>
                            					<th scope="row">{{$estadist->email}}</th>
                            				</tr>	                
                            			</tbody>
                            			@endforeach
                            			
                    @endif
            
            	</table>
            </div>
        </div>
        
         <!-- solicitudes por despacho POR MES -->
        <div class="col-xs-12 col-md-6">
          <center><strong><h2>SOLICITUDES DE DESPACHOS POR MES</h2></strong> </center>
          <div class="row">
              <form action="{{ route('administrador.estadistica.despachos') }}" method="POST">
    @csrf
             
              <div class="col-xs-12 col-sm-4">
                  <label for="Rol">Fecha inicio:</label>
					<input placeholder="Inicio" class="form-control @error('despachosMesi') is-invalid @enderror" type="date" name="despachosMesi" id="despachosMesi" value="{{ old('despachosMesi') }}">
@error('despachosMesi')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
              </div>
              <div class="col-xs-12 col-sm-4">
                  <label for="Rol">Fecha fin:</label>
					<input placeholder="Fin" class="form-control @error('despachosMesf') is-invalid @enderror" type="date" name="despachosMesf" id="despachosMesf" value="{{ old('despachosMesf') }}">
@error('despachosMesf')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
              </div>
              <div class="col-xs-12 col-sm-4">
                   <br>
                  <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
                 </form>
              </div>
          </div>
          <hr>
			 
		  <br>
            <div class="table-responsive">
            	<table id="table9"  class="table  table-hover table-condensed table-bordered ">
            	    <thead style="background-color: #AFAFAF; color: #fff;">
            		    <tr>
            		       	<th>CODIGO DESPACHO</th>
            				<th>NOMBRE DESPACHO</th>
            				<th>TOTAL SOLICITUDES</th>
            				<th>EMAIL</th>
            										     				
            		    </tr>
            	    </thead>
            	     @if($estadistica != null)
                            		    @foreach($estadisticadespachoMes as $estadisticames)
                            			<tbody class="buscar">
                            				<tr class="table-light">
                            					<th scope="row"> {{$estadisticames->codigo_despacho}}</th>
                            					<th scope="row">{{$estadisticames->name}}</th>
                            					<th scope="row">{{$estadisticames->cantidad}}</th>
                            					<th scope="row">{{$estadisticames->email}}</th>
                            					
                            										     
                            				</tr>	                
                            			</tbody>
                            			@endforeach
                            		@endif
            
            	</table>
            </div>
        </div>
        
        
    </div>
</div>

<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
  


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterCuatroSSSS.js"></script> 
<script src="/js/filterCuatroSSSS2.js"></script>

<script>
 $(function () {            
        
                
                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });
                
                 //Initialize Select2 Elements
                $('.select2').select2()
            
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })
                
              
                
            }); 
</script>


@endsection

