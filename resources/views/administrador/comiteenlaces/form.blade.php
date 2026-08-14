		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cgetitulo" class="fa fa-asterisk">Titulo:</label>
					<input class="form-control @error('cgetitulo') is-invalid @enderror" placeholder="Ingrese titulo enlace" type="text" name="cgetitulo" id="cgetitulo" value="{{ old('cgetitulo') }}">
@error('cgetitulo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cgedescripcion">Descripción Enlace: </label>
                    <textarea placeholder="Descripción Enlace" class="form-control @error('cgedescripcion') is-invalid @enderror" style="height:2.4em" name="cgedescripcion" id="cgedescripcion">{{ old('cgedescripcion') }}</textarea>
@error('cgedescripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cgelink" class="fa fa-asterisk">URL página:</label>
					<input class="form-control @error('cgelink') is-invalid @enderror" placeholder="enlace ej: www.ejemplo.com" pattern="https://.*" type="text" name="cgelink" id="cgelink" value="{{ old('cgelink') }}">
@error('cgelink')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>