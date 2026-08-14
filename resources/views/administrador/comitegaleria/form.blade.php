		@php
          $dato  = \Carbon\Carbon::now()->format('Y-m-d');
        @endphp
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cggTitulo" class="fa fa-asterisk">Titulo:</label>
					<input class="form-control @error('cggTitulo') is-invalid @enderror" placeholder="Ingrese titulo Galería" type="text" name="cggTitulo" id="cggTitulo" value="{{ old('cggTitulo') }}">
@error('cggTitulo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cggImagen" class="fa fa-asterisk">Agregar Imagenes:</label>
					<input type="file" name="cggImagen[]" id="cggImagen[]" class="@error('cggImagen[]') is-invalid @enderror">
@error('cggImagen[]')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cggdescripcion" class="fa fa-asterisk">Breve descripción:</label>
					<input class="form-control @error('cggdescripcion') is-invalid @enderror" placeholder="Ingrese Descripción Galería" type="text" name="cggdescripcion" id="cggdescripcion" value="{{ old('cggdescripcion') }}">
@error('cggdescripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="cggFecha">Tiempo publicación:</label>
					<input min="$dato" class="form-control @error('cggFecha') is-invalid @enderror" placeholder="Fecha que estara pública la imagen en la galería" type="date" name="cggFecha" id="cggFecha" value="{{ old('cggFecha') }}">
@error('cggFecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
				</div>
			</div>
		</div>
