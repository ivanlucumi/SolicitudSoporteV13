<!--@extends('layouts.digitalizacion.digitalizacion')-->
@extends('layouts.digitalizacion.servisoft')
<!--ponerle titulo a la paginga-->
@section('title', 'Inventario Digitalizacion')
@section('cabecera', 'Despachos Con Inventario Digitalizacion')



@section('content') 

<div class="container-fluid" style="margin-top:30px">
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<br>
				<form action="{{ route('servisoft.registroInventario.descarga') }}" method="POST">
    @csrf
				
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<label for="Registro Inventario">Registro Inventario</label>
					</div>
					<div class="col-xs-12 col-sm-12">
						<button class="btn btn-warning btn-md" type="submit">Descargar Excel Total</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-9">
				<br>
				
				<div class="row">
				    <form action="{{ route('servisoft.registroInventario') }}" method="POST">
    @csrf
				    
					<div class="col-xs-12 col-sm-9">
				    <label for="id_despacho">Listado Despacho Que han Diligenciado Inventario:</label><br>
					<select class="form-control @error('id_despacho') is-invalid @enderror" name="id_despacho" id="id_despacho">
    <option value="">Seleccione Despacho para busqueda</option>
    @foreach($despachosRegistrados as $key => $value)
        <option value="{{ $key }}" @selected(old('id_despacho', old('demandado')) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('id_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
					</div>
					<div class="col-xs-12 col-sm-3">
					    <label for=""></label><br>
						<button class="btn btn-primary btn-md" type="submit">Buscar Por Despacho</button>
						</form>
					</div>
					
				</div>
				<div class="row">
				    <form action="{{ route('servisoft.registroInventario.descarga') }}" method="POST">
    @csrf
				    
					<div class="col-xs-12 col-sm-9">
				    <label for="id_despacho">Listado Despacho Que han Diligenciado Inventario:</label><br>
					<select class="form-control @error('id_despacho') is-invalid @enderror" name="id_despacho" id="id_despacho">
    <option value="">Seleccione Despacho para busqueda</option>
    @foreach($despachosRegistrados as $key => $value)
        <option value="{{ $key }}" @selected(old('id_despacho', old('demandado')) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('id_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
					</div>
					<div class="col-xs-12 col-sm-3">
					    <label for=""></label><br>
						<button class="btn btn-danger btn-md" type="submit">Descarga  Por Despacho</button>
						</form>
					</div>
					
				</div>
			</div>
		</div>
</div>	

<div class="container-fluid" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
     <center> <h3>INVENTARIO DE DIGITALIZACION</h3>
		<H4>RESPUESTAS</H4></center><br>
      <div class="table-responsive">
                            <table class="table table-striped table-bordered" >
							
							
                                <thead style="background-color: #004182; color: #fff;">
                                <tr>
                                      <th>ID DESPACHO</th>
                                      <th>DESPACHO</th>
									  <th>CIUDAD</th>
									  <th>RADICADO</th>	
									  <th>DEMANDANTE</th>
									  <th>DEMANDADO</th> 
									  <th>FOLIOS</th>
									  <th>CUADERNOS</th>
									  <th>TIPO EXP.</th>
									  <th>FECHA REGISTRO</th>
									  
                                </tr>
                                </thead>
									@if($inventarios != null)
									  @foreach($inventarios as $inventario)
										
										 <tbody class="buscar">
												 <tr class="table-light">
													 <th scope="row">{{$inventario->id_despacho}}</th>
													 <th scope="row">{{$inventario->despacho}} </th>
													 <th scope="row">{{$inventario->ciudad}}</th>
													 <th scope="row">{{$inventario->radicado}}</th>
													 <th scope="row">{{$inventario->demandante}}</th>
													 <th scope="row">{{$inventario->demandado}}</th>
													 <th scope="row">{{$inventario->folios}}</th>
													 <th scope="row">{{$inventario->cuadernos}}</th>
													 <th scope="row">{{$inventario->tipo_expediente}}</th>
													 <th scope="row">{{$inventario->created_at}}</th>
										 </tbody>
											 
										@endforeach	 
									@else
									<p><center>POR EL MOMENTO NO HAN DADO RESPUESTA A ESTE INVENTARIO</center></p>
										 
									@endif
                                </table>
                                {{ $inventarios->links() }}
                        </div>
      
      <hr class="d-sm-none">
    </div>
    
  </div>
</div>




<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>    

@endsection