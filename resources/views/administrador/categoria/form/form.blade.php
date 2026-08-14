				
					<div class="form-group col-xs-12 col-md-6">
						<label for="Nombre Categoria" class="fa fa-asterisk">Nombre Categoria:</label>
						<input class="form-control @error('descripcioncategoria') is-invalid @enderror" placeholder="Ingresa Nombre " type="text" name="descripcioncategoria" id="descripcioncategoria" value="{{ old('descripcioncategoria') }}">
@error('descripcioncategoria')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
					</div>
				
					<div class="form-group col-xs-12 col-md-6">
					<label for="prioridad" class="fa fa-asterisk">Seleccione Tiempo atenci&oacute;n:</label><br>
					<select class="form-control @error('prioridad') is-invalid @enderror" name="prioridad" id="prioridad">
    <option value="">Selecione Tiempo atenci&oacute;n</option>
    @foreach($tiempos as $key => $value)
        <option value="{{ $key }}" @selected(old('prioridad') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('prioridad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
					</div>
				
				