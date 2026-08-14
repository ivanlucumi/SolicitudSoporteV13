<input class="form-control" type="hidden" name="usuario" id="usuario" value="{{  auth()->user()->cedula }}">

        <div class="col-xs-12 col-sm-6">
            <label for="identificacion">Identificación:</label>
            <input id="identificacion" class="form-control @error('identificacion') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" type="number" name="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>

        <div class="col-xs-12 col-sm-6">
            <label for="nombre_funcionario">Nombre completo:</label>
            <input id="nombre-funcionario" class="form-control @error('nombre_funcionario') is-invalid @enderror" placeholder="Nombre y Apellidos" type="text" name="nombre_funcionario" value="{{ old('nombre_funcionario') }}">
@error('nombre_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>

        <div class="col-xs-12 form-group mt-3 mb-3">
            <hr>
            <center><label><strong>SELECCIONE CATEGOR&Iacute;A Y REQUERIMIENTOS</strong></label></center><hr>
            <div id="categorias-container">
                <div class="row categoria-item" data-index="0">
                    <div class="col-xs-12 col-sm-6">
                        <label>Categor&iacute;a:</label>
                        <select name="categoria[]" class="form-control categoria-select" required>
                            <option value="">Seleccione Categor&iacute;a</option>
                            @foreach($categorias as $a)
                                <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <label>Requerimiento:</label>
                        <select name="item[]" class="form-control item-select" required>
                            <option value="">Seleccione una categor&iacute;a primero</option>
                            
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-success btn-block add-line"><strong><i class="fa fa-plus-square" aria-hidden="true"></i></strong></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 form-group">
            <label for="descripcion">Descripción del Reporte:</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" placeholder="Describa el incidente" style="height: 60px;" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
@error('descripcion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>