<form action="{{ isset($despacho) ? route('despachos.update', $despacho->codigoDespacho) : route('despachos.store') }}" method="POST" id="despachoForm" novalidate>
  @csrf
  @if(isset($despacho))
    @method('PUT')
  @endif

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ isset($despacho) ? 'Editar Despacho' : 'Crear Despacho' }}</h3>
    </div>
    <div class="panel-body">
      <p class="text-muted"><small>Complete los campos obligatorios marcados con <span class="text-danger">*</span></small></p>

      {{-- Informaci&oacute;n Principal --}}
      <fieldset>
        <legend>Informaci&oacute;n Principal</legend>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group @error('codigoDespacho') has-error @enderror">
              <label for="codigoDespacho" class="control-label">C&oacute;digo Despacho <span class="text-danger">*</span></label>
              <input type="text" name="codigoDespacho" id="codigoDespacho" maxlength="20"
                     value="{{ old('codigoDespacho', $despacho->codigoDespacho ?? '') }}"
                     class="form-control"
                     placeholder="Ej: 110013105011"
                     {{ isset($despacho) ? 'readonly' : '' }} required>
              @error('codigoDespacho')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group @error('nombreDespacho') has-error @enderror">
              <label for="nombreDespacho" class="control-label">Nombre Despacho <span class="text-danger">*</span></label>
              <input type="text" name="nombreDespacho" id="nombreDespacho" maxlength="95"
                     value="{{ old('nombreDespacho', $despacho->nombreDespacho ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Juzgado 001 Civil del Circuito" required>
              @error('nombreDespacho')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group @error('sede') has-error @enderror">
              <label for="sede" class="control-label">Sede <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="sede" id="sede" maxlength="100"
                     value="{{ old('sede', $despacho->sede ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Palacio de Justicia">
              @error('sede')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group @error('codCiudad') has-error @enderror">
              <label for="codCiudad" class="control-label">Ciudad <span class="text-danger">*</span></label>
              <select name="codCiudad" id="codCiudad" class="form-control" required>
                <option value="">Seleccione Ciudad</option>
                @foreach($ciudades as $key => $value)
                  <option value="{{ $key }}" {{ old('codCiudad', $despacho->codCiudad ?? '') == $key ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                @endforeach
              </select>
              @error('codCiudad')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group @error('direccion') has-error @enderror">
              <label for="direccion" class="control-label">Direcci&oacute;n <span class="text-danger">*</span></label>
              <input type="text" name="direccion" id="direccion" maxlength="50"
                     value="{{ old('direccion', $despacho->direccion ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Calle 12 # 7-58" required>
              @error('direccion')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group @error('telefono') has-error @enderror">
              <label for="telefono" class="control-label">Tel&eacute;fono <span class="text-danger">*</span></label>
              <input type="tel" name="telefono" id="telefono" maxlength="12"
                     value="{{ old('telefono', $despacho->telefono ?? '') }}"
                     class="form-control"
                     placeholder="Ej: 6028851234" required>
              @error('telefono')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>
      </fieldset>

      <hr>

      {{-- Correos --}}
      <fieldset>
        <legend>Correos Electr&oacute;nicos</legend>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group @error('correoD') has-error @enderror">
              <label for="correoD" class="control-label">Correo Principal <span class="text-danger">*</span></label>
              <input type="email" name="correoD" id="correoD" maxlength="70"
                     value="{{ old('correoD', $despacho->correoD ?? '') }}"
                     class="form-control"
                     placeholder="Ej: despacho@ejemplo.gov.co" required>
              @error('correoD')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group @error('correo_demanda') has-error @enderror">
              <label for="correo_demanda" class="control-label">Correo Demanda <span class="text-muted">(Opcional)</span></label>
              <input type="email" name="correo_demanda" id="correo_demanda" maxlength="70"
                     value="{{ old('correo_demanda', $despacho->correo_demanda ?? '') }}"
                     class="form-control"
                     placeholder="demanda@ejemplo.gov.co">
              @error('correo_demanda')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group @error('correo_memoriales') has-error @enderror">
              <label for="correo_memoriales" class="control-label">Correo Memoriales <span class="text-muted">(Opcional)</span></label>
              <input type="email" name="correo_memoriales" id="correo_memoriales" maxlength="70"
                     value="{{ old('correo_memoriales', $despacho->correo_memoriales ?? '') }}"
                     class="form-control"
                     placeholder="memoriales@ejemplo.gov.co">
              @error('correo_memoriales')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <div class="form-group @error('atencion_virtual') has-error @enderror">
              <label for="atencion_virtual" class="control-label">Atenci&oacute;n Virtual <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="atencion_virtual" id="atencion_virtual" maxlength="255"
                     value="{{ old('atencion_virtual', $despacho->atencion_virtual ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Enlace de Teams, Zoom, o informaci&oacute;n de atenci&oacute;n virtual">
              @error('atencion_virtual')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>
      </fieldset>

      <hr>

      {{-- Ubicaci&oacute;n y Jerarqu&iacute;a --}}
      <fieldset>
        <legend>Ubicaci&oacute;n y Jerarqu&iacute;a</legend>
        <div class="row">
          <div class="col-xs-12 col-sm-3">
            <div class="form-group @error('edificio') has-error @enderror">
              <label for="edificio" class="control-label">Edificio <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="edificio" id="edificio" maxlength="50"
                     value="{{ old('edificio', $despacho->edificio ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Torre A">
              @error('edificio')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group @error('piso') has-error @enderror">
              <label for="piso" class="control-label">Piso <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="piso" id="piso" maxlength="20"
                     value="{{ old('piso', $despacho->piso ?? '') }}"
                     class="form-control"
                     placeholder="Ej: 3">
              @error('piso')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group @error('extension') has-error @enderror">
              <label for="extension" class="control-label">Extensi&oacute;n <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="extension" id="extension" maxlength="20"
                     value="{{ old('extension', $despacho->extension ?? '') }}"
                     class="form-control"
                     placeholder="Ej: 3012">
              @error('extension')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group @error('estado') has-error @enderror">
              <label for="estado" class="control-label">Estado <span class="text-muted">(Opcional)</span></label>
              <select name="estado" id="estado" class="form-control">
                <option value="Activo" {{ old('estado', $despacho->estado ?? 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ old('estado', $despacho->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
              </select>
              @error('estado')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group @error('circuito') has-error @enderror">
              <label for="circuito" class="control-label">Circuito <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="circuito" id="circuito" maxlength="50"
                     value="{{ old('circuito', $despacho->circuito ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Circuito 01">
              @error('circuito')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group @error('districto') has-error @enderror">
              <label for="districto" class="control-label">Distrito <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="districto" id="districto" maxlength="50"
                     value="{{ old('districto', $despacho->districto ?? '') }}"
                     class="form-control"
                     placeholder="Ej: Distrito Judicial de Cali">
              @error('districto')<span class="help-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            @if(isset($despacho))
            <div class="form-group">
              <label for="modificador" class="control-label">Modificado por <span class="text-muted">(Sistema)</span></label>
              <input type="text" name="modificador" id="modificador" maxlength="50"
                     value="{{ old('modificador', $despacho->modificador ??  auth()->user()->name ?? '') }}"
                     class="form-control" readonly>
            </div>
            @else
            <div class="form-group">
              <label for="creador" class="control-label">Creado por <span class="text-muted">(Sistema)</span></label>
              <input type="text" name="creador" id="creador" maxlength="50"
                     value="{{ old('creador',  auth()->user()->name ?? '') }}"
                     class="form-control" readonly>
            </div>
            @endif
          </div>
        </div>
      </fieldset>

    </div>
    <div class="panel-footer">
      <div class="row">
        <div class="col-xs-12 col-sm-6" style="margin-bottom: 5px;">
          <button type="submit" class="btn btn-primary btn-block">
            <i class="fa fa-save"></i> {{ isset($despacho) ? 'Actualizar Despacho' : 'Guardar Despacho' }}
          </button>
        </div>
        <div class="col-xs-12 col-sm-6">
          <a href="{{ url()->previous() }}" class="btn btn-default btn-block">
            <i class="fa fa-times"></i> Cancelar
          </a>
        </div>
      </div>
    </div>
  </div>
</form>

{{-- Validaciones y efectos JS --}}
<script>
(function() {
  const form = document.getElementById('despachoForm');
  const inputs = form.querySelectorAll('input, select, textarea');

  const validators = {
    codigoDespacho: v => v.length >= 3 && v.length <= 20,
    nombreDespacho: v => v.trim().length >= 3 && v.length <= 95,
    sede: v => v === '' || (v.length <= 100),
    codCiudad: v => v !== '',
    direccion: v => v.trim().length >= 3 && v.length <= 100,
    telefono: v => /^\d{7,12}$/.test(v),
    correoD: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) && v.length <= 70,
    correo_demanda: v => v === '' || (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) && v.length <= 70),
    correo_memoriales: v => v === '' || (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) && v.length <= 70),
    atencion_virtual: v => v === '' || v.length <= 255,
    extension: v => v === '' || v.length <= 20,
    circuito: v => v === '' || v.length <= 50,
    districto: v => v === '' || v.length <= 50,
    edificio: v => v === '' || v.length <= 50,
    piso: v => v === '' || v.length <= 20,
  };

  function mark(el, valid) {
    if (!el) return;
    const group = el.closest('.form-group');
    if (!group) return;
    group.classList.remove('has-success', 'has-error');
    if (el.value.trim() !== '') {
      group.classList.add(valid ? 'has-success' : 'has-error');
    }
  }

  inputs.forEach(input => {
    input.addEventListener('blur', function() {
      const name = this.name;
      if (validators[name]) {
        mark(this, validators[name](this.value));
      }
    });
    input.addEventListener('input', function() {
      const group = this.closest('.form-group');
      if (group) group.classList.remove('has-error');
    });
  });

  form.addEventListener('submit', function(e) {
    let ok = true;
    inputs.forEach(input => {
      const name = input.name;
      if (validators[name] && !validators[name](input.value)) {
        if (input.hasAttribute('required') || input.value.trim() !== '') {
          mark(input, false);
          ok = false;
        }
      }
    });
    if (!ok) {
      e.preventDefault();
      const firstInvalid = form.querySelector('.has-error input, .has-error select, .has-error textarea');
      if (firstInvalid) firstInvalid.focus();
    }
  });
})();
</script>
