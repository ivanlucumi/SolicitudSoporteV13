		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<label for="sst_titulo" class="fa fa-asterisk">Titulo:</label>
					<input class="form-control @error('sst_titulo') is-invalid @enderror" placeholder="Ingrese titulo documento" type="text" name="sst_titulo" id="sst_titulo" value="{{ old('sst_titulo') }}">
@error('sst_titulo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-5">
				<div class="form-group">
				    <label>Agregar documento:</label>
					<input class="form-control @error('sst_documento') is-invalid @enderror" accept=".pdf" placeholder="Cargar documento" type="file" name="sst_documento" id="sst_documento">
@error('sst_documento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-2">
			    <label>Seleccione Ubicacion</label>
				<div class="form-control">
				    
					<select name="ubicacion" id="id_del_select">
                      <option value="">SELECCIONE DONDE MOSTRAR</option>
                      <option value="SST">SST</option>
                      <option value="COE">COE</option>
                    </select>
				</div>
			</div>
		</div>