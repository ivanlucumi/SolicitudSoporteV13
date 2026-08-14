<div class="form-group">
	<label for="Rol" class="fa fa-asterisk">Codigo Ciudad:</label>
	<input class="form-control @error('codigoCiudad') is-invalid @enderror" placeholder="Ingresa Codigo de Ciudad" type="text" name="codigoCiudad" id="codigoCiudad" value="{{ old('codigoCiudad') }}">
@error('codigoCiudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
</div>
					
<div class="form-group">
	<label for="Rol" class="fa fa-asterisk">Nombre Ciudad:</label>
	<input class="form-control @error('nombreCiudad') is-invalid @enderror" placeholder="Ingresa Nombre de la Ciudad" type="text" name="nombreCiudad" id="nombreCiudad" value="{{ old('nombreCiudad') }}">
@error('nombreCiudad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
</div>