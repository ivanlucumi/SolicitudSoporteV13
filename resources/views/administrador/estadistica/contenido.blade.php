
<div class="container-fluid">
  <div class="" style="text-align: right">
    <nav class="navbar navbar-light bg-light">
      <form action="{{ route('administrador.estadistica.digitalizacion') }}" method="POST">
    @csrf
       
        <input class="form-group mr-sm-2 shadow @error('id_despacho') is-invalid @enderror" placeholder="Buscar por Id Despacho" autocomplete="off" aria-label="Search" type="number" name="id_despacho" id="id_despacho" value="{{ old('id_despacho') }}">
@error('id_despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <select class="form-group select2  @error('distrito') is-invalid @enderror" style="width:200px" aria-label="Search" name="distrito" id="distrito">
    <option value="">Distrito</option>
    @foreach($distrito as $key => $value)
        <option value="{{ $key }}" @selected(old('distrito') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('distrito')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
        <select class="form-group select2  @error('ciudad') is-invalid @enderror" style="width:250px" aria-label="Search" name="ciudad" id="ciudad">
    <option value="">P.Digitalizacion</option>
    @foreach($puntoDig as $key => $value)
        <option value="{{ $key }}" @selected(old('ciudad') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('ciudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
        <select class="form-group select2  @error('especialidad') is-invalid @enderror" aria-label="Search" name="especialidad" id="especialidad">
    <option value="">Seleccione Especialidad</option>
    @foreach($especialidad as $key => $value)
        <option value="{{ $key }}" @selected(old('especialidad') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
        <select class="form-group select2  @error('despacho') is-invalid @enderror" aria-label="Search" name="despacho" id="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachosRegistrados as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
        <br> 
        <br>
        <button class="form-group btn btn-success my-2 my-sm-0 shadow mt-1 mb-2" type="submit">Filtrar Por Criterio</button>
      </form>
    </nav>
  </div>
  
</div>

<div class="container-fluid" style="margin-top:30px">
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<br>
				<form action="{{ route('administrador.registroInventario.descarga') }}" method="POST">
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
				    <form action="{{ route('administrador.inventario.digitalizacion') }}" method="POST">
    @csrf
				    
					<div class="col-xs-12 col-sm-9">
				    <label for="id_despacho">Listado Despacho Que han Diligenciado Inventario:</label><br>
					<select class="form-control select2 @error('id_despacho') is-invalid @enderror" name="id_despacho" id="id_despacho">
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
				    <form action="{{ route('administrador.registroInventario.descarga') }}" method="POST">
    @csrf
				    
					<div class="col-xs-12 col-sm-9">
				    <label for="id_despacho">Listado Despacho Que han Diligenciado Inventario:</label><br>
					<select class="form-control select2 @error('id_despacho') is-invalid @enderror" name="id_despacho" id="id_despacho">
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
      <div class="col-xs-12 col-sm-3" style="background-color:#F8F9BF ; border: #F7F984 2px double;">
          <h4><strong>PROC. REPORTADOS</strong></h4> <h1><strong><center>{{$pReportados}}</center></strong></h1>
      </div>
      <div class="col-xs-12 col-sm-3" style="background-color:#F8F9BF ;border: #F7F984 2px double;">
          <h4><strong>PROC. DIGITALIZADOS</strong></h4> <h1><strong><center>{{$rDigitalizado}}</center></strong></h1>
      </div>
      <div class="col-xs-12 col-sm-3" style="background-color:#F8F9BF ;border: #F7F984 2px double;">
          <h4><strong># FOLIOS</strong></h4> <h1><strong><center>{{$FoliosR}}</center></strong></h1>
      </div>
      <div class="col-xs-12 col-sm-3" style="background-color:#F8F9BF ;border: #F7F984 2px double;">
          <h4><strong>% AVANCE</strong></h4> <h1><strong><center>{{$porcentaje}}%</center></strong></h1>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
     <center> <h3>ESTAD&Iacute;STICA DIGITALIZAI&Oacute;N</h3>
		<H4>RESPUESTAS</H4></center><br>
      <div class="table-responsive">
                            <table class="table table-striped table-bordered" >
                                @if($mostrar == 1)
                                <thead >
                                <tr>
                                      <th></th>
                                      <th></th>
									  <th></th>
									  <th></th>
									  <th style="background-color:#F8F9BF; color: black;">
									      <?php $Reportado =0; ?>
									    @foreach($Estadisticas as $estadistica)
									      <h1><?php  $Reportado = $Reportado + $estadistica->digitalizacion_fisico; ?></h1>
									    @endforeach
									     <?php echo number_format($Reportado, 0);  ?>
									  </th>
									  <th style="background-color:#F8F9BF; color: black;">
									      <?php $Digital =0; ?>
									    @foreach($Estadisticas as $estadistica)
									      <h1><?php  $Digital = $Digital + $estadistica->procesos_digitalizados; ?></h1>
									    @endforeach
									     <?php echo number_format($Digital, 0);  ?>
									  </th> 
									  <th></th>
									  <th></th>
									  <th></th>
									  <th></th>
									  <th></th>
									  <th style="background-color:#F8F9BF; color: black;">
									   <?php $porcent =0; ?>
									    @foreach($Estadisticas as $estadistica)
									      <h1><?php  $porcent = $Digital/ $Reportado*100 ?></h1>
									    @endforeach
									   <?php echo round($porcent, 2)."%" ?></th>
									  <th></th>
                                </tr>
							    </thead>
							    @endif
                                <thead style="background-color: #004182; color: #fff;">
                                <tr>
                                      <th>ID DESPACHO</th>
                                      <th>DESPACHO</th>
                                      <th>DISTRITO</th>
									  <th>CIUDAD</th>
									  <th>ESPECIALIDAD</th>
									  <th style="width:100px !importatnt">DIGI/CION FISICA</th>
									  <th style="width:100px !importatnt">PROC. DIGITA/DOS</th>
									  <th>VALI/CION ONEDRIVE</th>
									  <th>MIGRA/CION ONEDRIVE</th>
									  <th>CAPACITACION</th>
									  <th>ENTREGA USUARIOS</th>
									  <th>PUESTA EN MARCHA</th>
									  <th>% AVANCE</th>
									  <th>ACCI&Oacute;N</th>
                                </tr>
                                </thead>
									@if($Estadisticas != null)
									  @foreach($Estadisticas as $estadistica)
										
										 <tbody class="buscar">
												 <tr class="table-light">
													 <th scope="row">{{$estadistica->id_despacho}}</th>
													 <th scope="row">{{$estadistica->despacho}} </th>
													 <th scope="row">{{$estadistica->distrito}}</th>
													 <th scope="row">{{$estadistica->ciudad}}</th>
													 <form action="{{ route('administrador.estadistica.update',$estadistica->id) }}" method="POST">
    @csrf
    @method('PUT')
			                                         <th scope="row"><select class="form-group select2  @error('especialidad') is-invalid @enderror" style="width:200px" aria-label="Search" name="especialidad" id="especialidad">
    <option value="">Seleccione Especialidad</option>
    @foreach($especialidad as $key => $value)
        <option value="{{ $key }}" @selected(old('especialidad', $estadistica->especialidad) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror</th>
													 <th scope="row"><input type="number" name="digitalizacion_fisico" id="digitalizacion_fisico" value="{{ old('digitalizacion_fisico', $estadistica->digitalizacion_fisico ?? $estadistica->digitalizacion_fisico) }}" class="@error('digitalizacion_fisico') is-invalid @enderror">
@error('digitalizacion_fisico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror</th>
													 <th scope="row"><input type="number" name="procesos_digitalizados" id="procesos_digitalizados" value="{{ old('procesos_digitalizados', $estadistica->procesos_digitalizados ?? $estadistica->procesos_digitalizados) }}" class="@error('procesos_digitalizados') is-invalid @enderror">
@error('procesos_digitalizados')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror</th>
													 <th scope="row">
													     <select class="form-group select2  @error('validacion_onedrive') is-invalid @enderror" style="width:150px" aria-label="Search" name="validacion_onedrive" id="validacion_onedrive">
    <option value="">Selec Validacion</option>
    @foreach($validacionOnD as $key => $value)
        <option value="{{ $key }}" @selected(old('validacion_onedrive', $estadistica->validacion_onedrive) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('validacion_onedrive')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													     <input type="date" name="fecha_validacion_onedrive" id="fecha_validacion_onedrive" value="{{ old('fecha_validacion_onedrive', $estadistica->fecha_validacion_onedrive ?? $estadistica->fecha_validacion_onedrive) }}" class="@error('fecha_validacion_onedrive') is-invalid @enderror">
@error('fecha_validacion_onedrive')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													 </th>
													 <th scope="row">
													     <select class="form-group select2  @error('migracion_onedrive') is-invalid @enderror" style="width:150px" aria-label="Search" name="migracion_onedrive" id="migracion_onedrive">
    <option value="">Esta. Migracion</option>
    @foreach($migracionOneD as $key => $value)
        <option value="{{ $key }}" @selected(old('migracion_onedrive', $estadistica->migracion_onedrive) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('migracion_onedrive')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													     <input type="date" name="fecha_migracion_onedrive" id="fecha_migracion_onedrive" value="{{ old('fecha_migracion_onedrive', $estadistica->fecha_migracion_onedrive ?? $estadistica->fecha_migracion_onedrive) }}" class="@error('fecha_migracion_onedrive') is-invalid @enderror">
@error('fecha_migracion_onedrive')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													 </th>
													 <th scope="row">
													     <select class="form-group select2  @error('capacitacion') is-invalid @enderror" style="width:150px" aria-label="Search" name="capacitacion" id="capacitacion">
    <option value="">Esta. Capacitacion</option>
    @foreach($capacitacionE as $key => $value)
        <option value="{{ $key }}" @selected(old('capacitacion', $estadistica->capacitacion) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('capacitacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													     <input type="date" name="fecha_capacitacion" id="fecha_capacitacion" value="{{ old('fecha_capacitacion', $estadistica->fecha_capacitacion ?? $estadistica->fecha_capacitacion) }}" class="@error('fecha_capacitacion') is-invalid @enderror">
@error('fecha_capacitacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													 </th>
													 <th scope="row">
													     <input type="text" name="estrega_usuarios" id="estrega_usuarios" value="{{ old('estrega_usuarios', $estadistica->estrega_usuarios ?? $estadistica->estrega_usuarios) }}" class="@error('estrega_usuarios') is-invalid @enderror">
@error('estrega_usuarios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													     <input type="date" name="fecha_estrega_usuarios" id="fecha_estrega_usuarios" value="{{ old('fecha_estrega_usuarios', $estadistica->fecha_estrega_usuarios ?? $estadistica->fecha_estrega_usuarios) }}" class="@error('fecha_estrega_usuarios') is-invalid @enderror">
@error('fecha_estrega_usuarios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
													 </th>
													 <th scope="row"><input type="text" name="puesta_en_marcha" id="puesta_en_marcha" value="{{ old('puesta_en_marcha', $estadistica->puesta_en_marcha ?? $estadistica->puesta_en_marcha) }}" class="@error('puesta_en_marcha') is-invalid @enderror">
@error('puesta_en_marcha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror</th>
													 <th scope="row">
													     @if($estadistica->digitalizacion_fisico != 0 & $estadistica->procesos_digitalizados != 0)
													     <?php echo round((($estadistica->procesos_digitalizados/$estadistica->digitalizacion_fisico)*100), 2) ?> %
													     @else
													      0%
													     @endif
													     </th>
													 <th><button class="btn btn-primary btn-block" type="submit">ACTUALIZAR</button>
													 </form></th>
										 </tbody>
											 
										@endforeach	 
									@else
									<p><center>NO HAY INFORMACION RELACIONADA</center></p>
										 
									@endif
                                </table>
                        </div>
     
      <hr class="d-sm-none">
    </div>
    
  </div>
</div>



 




<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>  