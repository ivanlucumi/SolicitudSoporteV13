
				<div class="form-group">
					<label for="C&oacute;digo Elemento" class="fa fa-asterisk">C&oacute;digo Elemento:</label>
					<input class="form-control @error('id') is-invalid @enderror" placeholder="Ingresa C&oacute;digo Elemento " type="text" name="id" id="id" value="{{ old('id') }}">
@error('id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				<div class="form-group">
					<label for="Nombre Elemento" class="fa fa-asterisk">Nombre Elemento:</label>
					<input class="form-control @error('nombreElemento') is-invalid @enderror" placeholder="Ingresa NOmbre " type="text" name="nombreElemento" id="nombreElemento" value="{{ old('nombreElemento') }}">
@error('nombreElemento')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				
				<div class="form-group">
					<label for="Categoria" class="fa fa-asterisk">Seleccione Categoria:</label><br>
					<select class="form-control @error('idCategoria') is-invalid @enderror" name="idCategoria" id="idCategoria">
    <option value="">Selecione Categoria</option>
    @foreach($categorias as $key => $value)
        <option value="{{ $key }}" @selected(old('idCategoria') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('idCategoria')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

				</div>