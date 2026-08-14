		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cgtitulo" class="fa fa-asterisk">Titulo:</label>
					<input class="form-control @error('cgtitulo') is-invalid @enderror" placeholder="Ingrese titulo documento" type="text" name="cgtitulo" id="cgtitulo" value="{{ old('cgtitulo') }}">
@error('cgtitulo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cgdocumento" class="fa fa-asterisk">Agregar documento:</label>
					<input class="form-control @error('cgdocumento') is-invalid @enderror" accept=".pdf" placeholder="Cargar documento" type="file" name="cgdocumento" id="cgdocumento">
@error('cgdocumento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>