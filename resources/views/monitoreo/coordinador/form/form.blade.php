				<div class="row">
				    
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="parqueadero">No. Parqueadero :</label>
    					<input class="form-control @error('no_parqueadero') is-invalid @enderror" placeholder="Ingrese No Parqueadero" autocomplete="off" type="text" name="no_parqueadero" id="no_parqueadero" value="{{ old('no_parqueadero') }}">
@error('no_parqueadero')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="Calidad">Calidad :</label>
    					<input class="form-control @error('calidad') is-invalid @enderror" placeholder="Ingrese Calidad" autocomplete="off" type="text" name="calidad" id="calidad" value="{{ old('calidad') }}">
@error('calidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="Cedula">C&eacute;dula :</label><br>
    					<input class="form-control @error('cedula') is-invalid @enderror" min="1" placeholder="Ingrese C&eacute;dula" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-3">
    					<label for="Tipo Vehiculo">Tipo Vehiculo :</label>
    					<input class="form-control @error('tipo_vehiculo') is-invalid @enderror" placeholder="Ingrese Tipo Veh&iacute;culo" autocomplete="off" type="text" name="tipo_vehiculo" id="tipo_vehiculo" value="{{ old('tipo_vehiculo') }}">
@error('tipo_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-3">
    					<label for="Placa">Placa :</label><br>
    					<input class="form-control @error('placa') is-invalid @enderror" placeholder="Ingrese No Placa" type="text" name="placa" id="placa" value="{{ old('placa') }}">
@error('placa')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-12">
    					<label for="Descripcion Vehiculo">Descripci&oacute;n Veh&iacute;culo :</label>
    					<input class="form-control @error('descripcion_vehiculo') is-invalid @enderror" placeholder="Ingrese Descripci&oacute;n Veh&iacute;culo" autocomplete="off" type="text" name="descripcion_vehiculo" id="descripcion_vehiculo" value="{{ old('descripcion_vehiculo') }}">
@error('descripcion_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				
                    <div class="form-group col-xs-12 col-sm-6">
    					<label for="Nombre">Nombre :</label>
    					<input class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese Nombre" autocomplete="off" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for=" Cargo">Cargo :</label>
    					<input class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Cargo" autocomplete="off" type="text" name="cargo" id="cargo" value="{{ old('cargo') }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="Juzgado">Juzgado :</label>
    					<input class="form-control @error('juzgado') is-invalid @enderror" placeholder="Ingrese Juzgado" autocomplete="off" type="text" name="juzgado" id="juzgado" value="{{ old('juzgado') }}">
@error('juzgado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="Especialidad"> Especialidad :</label>
    					<input class="form-control @error('especialidad') is-invalid @enderror" placeholder="Ingrese Especialidad" autocomplete="off" type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}">
@error('especialidad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
    				</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="ocupado"> Estado :</label>
    					<select class="form-control @error('ocupado') is-invalid @enderror" name="ocupado" id="ocupado">
    <option value="">Selecccione Estado</option>
    @foreach(["LIBRE" =>"LIBRE","OCUPADO" =>"OCUPADO"] as $key => $value)
        <option value="{{ $key }}" @selected(old('ocupado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('ocupado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    						</div>
    				<div class="form-group col-xs-12 col-sm-6">
    					<label for="Tipo Ingreso"> Tipo Ingreso :</label>
    					<select class="form-control @error('tipo_ingreso') is-invalid @enderror" name="tipo_ingreso" id="tipo_ingreso">
    <option value="">Selecccione Tipo Ingreso</option>
    @foreach(["RESTRINGIDO" =>"RESTRINGIDO","SIN RESTRICCION" =>"SIN RESTRICCION"] as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_ingreso') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_ingreso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    						</div>
				</div>
				