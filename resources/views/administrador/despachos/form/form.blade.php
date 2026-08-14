<form action="{{ isset($despacho) ? route('despachos.update', $despacho->codigoDespacho) : route('despachos.store') }}" method="POST" id="despachoForm" novalidate>
  @csrf
  @if(isset($despacho))
    @method('PUT')
  @endif

  <div class="despacho-card">
    <div class="despacho-header">
      <h3>{{ isset($despacho) ? 'Editar Despacho' : 'Crear Despacho' }}</h3>
      <small>Complete los campos obligatorios marcados con <span class="req">*</span></small>
    </div>

    {{-- Información Principal --}}
    <div class="section-title">Información Principal</div>
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="codigoDespacho">Código Despacho <span class="req">*</span></label>
          <input type="text" name="codigoDespacho" id="codigoDespacho" maxlength="20"
                 value="{{ old('codigoDespacho', $despacho->codigoDespacho ?? '') }}"
                 class="form-control @error('codigoDespacho') is-invalid @enderror"
                 placeholder="Ej: 110013105011"
                 {{ isset($despacho) ? 'readonly' : '' }} required>
          @error('codigoDespacho')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="nombreDespacho">Nombre Despacho <span class="req">*</span></label>
          <input type="text" name="nombreDespacho" id="nombreDespacho" maxlength="95"
                 value="{{ old('nombreDespacho', $despacho->nombreDespacho ?? '') }}"
                 class="form-control @error('nombreDespacho') is-invalid @enderror"
                 placeholder="Ej: Juzgado 001 Civil del Circuito" required>
          @error('nombreDespacho')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="sede">Sede <span class="badge-optional">Opcional</span></label>
          <input type="text" name="sede" id="sede" maxlength="100"
                 value="{{ old('sede', $despacho->sede ?? '') }}"
                 class="form-control @error('sede') is-invalid @enderror"
                 placeholder="Ej: Palacio de Justicia">
          @error('sede')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="codCiudad">Ciudad <span class="req">*</span></label>
          <select name="codCiudad" id="codCiudad" class="form-control @error('codCiudad') is-invalid @enderror" required>
            <option value="">Seleccione Ciudad</option>
            @foreach($ciudades as $key => $value)
              <option value="{{ $key }}" {{ old('codCiudad', $despacho->codCiudad ?? '') == $key ? 'selected' : '' }}>
                {{ $value }}
              </option>
            @endforeach
          </select>
          @error('codCiudad')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="direccion">Dirección <span class="req">*</span></label>
          <input type="text" name="direccion" id="direccion" maxlength="50"
                 value="{{ old('direccion', $despacho->direccion ?? '') }}"
                 class="form-control @error('direccion') is-invalid @enderror"
                 placeholder="Ej: Calle 12 # 7-58" required>
          @error('direccion')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="telefono">Teléfono <span class="req">*</span></label>
          <input type="tel" name="telefono" id="telefono" maxlength="12"
                 value="{{ old('telefono', $despacho->telefono ?? '') }}"
                 class="form-control @error('telefono') is-invalid @enderror"
                 placeholder="Ej: 6028851234" required>
          @error('telefono')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <hr class="divider-modern">

    {{-- Correos --}}
    <div class="section-title">Correos Electrónicos</div>
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="form-group-min">
          <label for="correoD">Correo Principal <span class="req">*</span></label>
          <input type="email" name="correoD" id="correoD" maxlength="70"
                 value="{{ old('correoD', $despacho->correoD ?? '') }}"
                 class="form-control @error('correoD') is-invalid @enderror"
                 placeholder="Ej: despacho@ejemplo.gov.co" required>
          @error('correoD')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="form-group-min">
          <label for="correo_demanda">Correo Demanda <span class="badge-optional">Opcional</span></label>
          <input type="email" name="correo_demanda" id="correo_demanda" maxlength="70"
                 value="{{ old('correo_demanda', $despacho->correo_demanda ?? '') }}"
                 class="form-control @error('correo_demanda') is-invalid @enderror"
                 placeholder="demanda@ejemplo.gov.co">
          @error('correo_demanda')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="form-group-min">
          <label for="correo_memoriales">Correo Memoriales <span class="badge-optional">Opcional</span></label>
          <input type="email" name="correo_memoriales" id="correo_memoriales" maxlength="70"
                 value="{{ old('correo_memoriales', $despacho->correo_memoriales ?? '') }}"
                 class="form-control @error('correo_memoriales') is-invalid @enderror"
                 placeholder="memoriales@ejemplo.gov.co">
          @error('correo_memoriales')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <hr class="divider-modern">

    {{-- Ubicación y Jerarquía --}}
    <div class="section-title">Ubicación y Jerarquía</div>
    <div class="row">
      <div class="col-xs-12 col-sm-3">
        <div class="form-group-min">
          <label for="edificio">Edificio <span class="badge-optional">Opcional</span></label>
          <input type="text" name="edificio" id="edificio" maxlength="50"
                 value="{{ old('edificio', $despacho->edificio ?? '') }}"
                 class="form-control @error('edificio') is-invalid @enderror"
                 placeholder="Ej: Torre A">
          @error('edificio')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-3">
        <div class="form-group-min">
          <label for="piso">Piso <span class="badge-optional">Opcional</span></label>
          <input type="text" name="piso" id="piso" maxlength="20"
                 value="{{ old('piso', $despacho->piso ?? '') }}"
                 class="form-control @error('piso') is-invalid @enderror"
                 placeholder="Ej: 3">
          @error('piso')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-3">
        <div class="form-group-min">
          <label for="extension">Extensión <span class="badge-optional">Opcional</span></label>
          <input type="text" name="extension" id="extension" maxlength="20"
                 value="{{ old('extension', $despacho->extension ?? '') }}"
                 class="form-control @error('extension') is-invalid @enderror"
                 placeholder="Ej: 3012">
          @error('extension')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-3">
        <div class="form-group-min">
          <label for="estado">Estado <span class="badge-optional">Opcional</span></label>
          <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
            <option value="Activo" {{ old('estado', $despacho->estado ?? 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ old('estado', $despacho->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
          </select>
          @error('estado')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="form-group-min">
          <label for="circuito">Circuito <span class="badge-optional">Opcional</span></label>
          <input type="text" name="circuito" id="circuito" maxlength="50"
                 value="{{ old('circuito', $despacho->circuito ?? '') }}"
                 class="form-control @error('circuito') is-invalid @enderror"
                 placeholder="Ej: Circuito 01">
          @error('circuito')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="form-group-min">
          <label for="districto">Distrito <span class="badge-optional">Opcional</span></label>
          <input type="text" name="districto" id="districto" maxlength="50"
                 value="{{ old('districto', $despacho->districto ?? '') }}"
                 class="form-control @error('districto') is-invalid @enderror"
                 placeholder="Ej: Distrito Judicial de Cali">
          @error('districto')<div class="error-text show">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        @if(isset($despacho))
        <div class="form-group-min">
          <label for="modificador">Modificado por <span class="badge-optional">Sistema</span></label>
          <input type="text" name="modificador" id="modificador" maxlength="50"
                 value="{{ old('modificador', $despacho->modificador ??  auth()->user()->name ?? '') }}"
                 class="form-control" readonly>
        </div>
        @else
        <div class="form-group-min">
          <label for="creador">Creado por <span class="badge-optional">Sistema</span></label>
          <input type="text" name="creador" id="creador" maxlength="50"
                 value="{{ old('creador',  auth()->user()->name ?? '') }}"
                 class="form-control" readonly>
        </div>
        @endif
      </div>
    </div>

    <hr class="divider-modern">

    {{-- Botones --}}
    <div class="row">
      <div class="col-xs-12 col-sm-6" style="margin-bottom: 0.8rem;">
        <button type="submit" class="btn-modern btn-guardar btn-block">
          <i class="fa fa-save"></i> {{ isset($despacho) ? 'Actualizar Despacho' : 'Guardar Despacho' }}
        </button>
      </div>
      <div class="col-xs-12 col-sm-6">
        <a href="{{ url()->previous() }}" class="btn-modern btn-cancelar btn-block" style="text-decoration:none;">
          <i class="fa fa-times"></i> Cancelar
        </a>
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
    extension: v => v === '' || v.length <= 20,
    circuito: v => v === '' || v.length <= 50,
    districto: v => v === '' || v.length <= 50,
    edificio: v => v === '' || v.length <= 50,
    piso: v => v === '' || v.length <= 20,
  };

  function mark(el, valid) {
    if (!el) return;
    el.classList.remove('is-valid', 'is-invalid');
    if (el.value.trim() !== '') {
      el.classList.add(valid ? 'is-valid' : 'is-invalid');
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
      this.classList.remove('is-invalid');
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
      const firstInvalid = form.querySelector('.is-invalid');
      if (firstInvalid) firstInvalid.focus();
    }
  });
})();
</script>
