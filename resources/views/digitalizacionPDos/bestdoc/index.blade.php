<div class="container-fluid">
<hr>
<p>
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<br>
				<form target="_blank" action="{{ route('descarga.registro.traslado.bestdoc') }}" method="POST">
    @csrf
				<div class="row">
				    	<div class=" col-xs-12 col-sm-3 form-group">
					<select class="form-control @error('mes') is-invalid @enderror" name="mes" id="mes">
    <option value="">Seleccione Mes a Consultar</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mes') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
					<div class="col-xs-12 col-sm-3">
						<button class="btn btn-warning btn-md" type="submit">Descargar Mis Transferencias</button>
						</form>
					</div>
				</div>
			</div>
		</div>
</p>@if($TotalTransferencia != null)
@endif
<hr>
    
    
  <div class="" style="text-align: right">
    <nav class="navbar navbar-light bg-light">
        <div class="col-xs-12 col-sm-4">
            <form action="{{ route('supervisor.bestdco.inicio') }}" method="POST">
    @csrf
        <select class="form-control @error('despacho') is-invalid @enderror" name="despacho" id="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
        </div>
       <div class="col-xs-12 col-sm-4">
           <input class="form-control form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar por radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          </div>
        <div class="col-xs-12 col-sm-1">
            <button class="form-group btn btn-success my-2 my-sm-0 shadow btn-block" type="submit">Buscar</button>
        </div>
        
      </form>
    </nav>
  </div>
  
</div>

<div class="container-fluid">
    <div class="row">
 
              <div class="table-responsive">
            	<table id="table9" class="table table-bordered table-striped" >
                    <thead class="" style="background-color: #004182; color: #fff;">
            		    <tr>
            		        <th>RADICADO</th>
            		        <th>DESPACHO</th>
            		        <th>MUNICIPIO</th>
            		        <th>ESPECIALIDAD</th>
            				<th>ACCIONES</th>
            		    </tr>
            	    </thead>
            	     
            		    @foreach($listado as $digit)
            			<tbody data-id="{!!$digit->id!!}" class="buscar">
            			   
            				<tr class="table-light" 
            				@if($digit->asignado_a != null)
                				@if($digit->asignado_a ==  auth()->user()->id)
                                <?php echo 'style="background-color: #C3F8BC"'; ?>
                                @endif
                                @if($digit->asignado_a !=  auth()->user()->id)
                                <?php echo 'style="background-color: #FB866D"'; ?>
                                @endif
                            @endif
                             @if($digit->asignado_a == null)
                            <?php echo 'style="background-color: "'; ?>
                            @endif
                            
                            >
            					<th scope="row">{{$digit->radicacion}}</th>									
            					<th scope="row">{{$digit->despacho}}</th>									
            					<th scope="row">{{$digit->municipio}}</th>									
            					<th scope="row">{{$digit->especialidad}}</th>
            					<th scope="row">
            					   
					                <a href="{{ route('supervisor.bestdco.asignar.registro', $digit->id) }}" class="btn btn-success btn-xs mb-2" title="Para Marcar Como Trasladado">TOMAR</a>
            					    <a href="{{ route('supervisor.bestdco.registro', $digit->id) }}" class="btn btn-warning btn-xs mb-2" title="Asignarme Radicacion">TRASLADADO</a>
					            </th>
            				</tr>
            			</tbody>
            			@endforeach
            	</table>
            	{{ $listado->links() }}
            </div>
      
        
    </div>
    
</div>


