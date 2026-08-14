@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Estad&iacute;stica')
@section('cabecera', 'Estad&iacute;stica De Reparto')

@section('content') 

<div class="container-fluid">$faltantes
    <div class="row  mt-6 mb-6">
        <div class="col-xs-12 col-md-3">
           <h1><strong>TOTAL RECIBIDO: {{$total[0]->total}}</strong></h1> 
        </div>
        <div class="col-xs-12 col-md-3">
           <h1><strong>ASIGNADO: {{$asignado[0]->asignado}}</strong></h1> 
        </div>
        <div class="col-xs-12 col-md-3">
           <h1><strong>CON REPARTO: {{$conReparto[0]->reparto}}</strong></h1> 
        </div>
        <div class="col-xs-12 col-md-3">
           <h1><strong>FALTANTES: {{$faltantes[0]->faltante}}</strong></h1> 
        </div>
    </div>
    <hr>
        <div class="row mt-6 mb-6">
            <div class="col-xs-12 col-md-6">
                <div class="box box-warning">
                <div class="box-header">
                      <h2 class="box-title" style="color:red;align:center" ><strong>FUNCIONARIOS POR MES CON REPARTO ASIGNADO</strong></h2>
                </div>
                <div class="row">
                      <form action="{{ route('reparto.con.estadistica') }}" method="POST">
    @csrf
                      
                      <div class="col-xs-12 col-sm-4">
                          <label for="inicio">Fecha inicio:</label>
        					<input placeholder="Inicio" class="form-control @error('inicio') is-invalid @enderror" type="date" name="inicio" id="inicio" value="{{ old('inicio') }}">
@error('inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                      </div>
                      <div class="col-xs-12 col-sm-4">
                          <label for="fin">Fecha fin:</label>
        					<input placeholder="Fin" class="form-control @error('fin') is-invalid @enderror" type="date" name="fin" id="fin" value="{{ old('fin') }}">
@error('fin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                      </div>
                      <div class="col-xs-12 col-sm-4">
                           <br>
                          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Buscar</button>
                         </form>
                      </div>
                  </div>
                   <div class="table-responsive">
					 <table id="table9." class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						        <th>NOMBRE</th>
                                <th>CANTIDAD</th>
					      </tr>
						</thead>
							 @foreach($totalMes as $total)
		    
                    			<tbody  class="buscar">
                    				<tr class="table-light">
                    				   
                    				    <th scope="row">{{$total->name}}</th>	
                    					<th scope="row">{{$total->cantidad}}</th>	
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						          
				     </table>
				  </div>
               </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="box box-warning">
                <div class="box-header">
                      <h2 class="box-title" style="color:red;align:center"><strong>REPARTO POR FUNCIONARIO</strong></h2>
                </div>
                  <div class="table-responsive">
					 <table id="table10" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						        <th>NOMBRE</th>
                                <th>CANTIDAD</th>
					      </tr>
						</thead>
							 @foreach($Operarios as $Operario)
		    
                    			<tbody  class="buscar">
                    				<tr class="table-light">
                    				   
                    				    <th scope="row">{{$Operario->name}}</th>	
                    					<th scope="row">{{$Operario->cantidad}}</th>	
                				</tr>	                
                			</tbody>
                			
                			@endforeach
						          
				     </table>
				  </div>
               </div>
            </div>
        </div>
</div>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Estadistica1.js"></script> 
<script src="/js/Estadistica2.js"></script> 


@endsection