<div class="form-group">
	<label for="prioridad" class="fa fa-asterisk">Prioridad:</label>
	<input class="form-control @error('prioridad') is-invalid @enderror" placeholder="Ingresa Prioridad" type="text" name="prioridad" id="prioridad" value="{{ old('prioridad') }}">
@error('prioridad')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
</div>
					
<div class="form-group">
	<label for="maximoD" class="fa fa-asterisk">N&uacute;mero m&aacute;ximo de dias:</label>
	<input class="form-control @error('maximoD') is-invalid @enderror" placeholder="Ingresa Numero m&aacute;ximo de dias de atension" type="text" name="maximoD" id="maximoD" value="{{ old('maximoD') }}">
@error('maximoD')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
</div>