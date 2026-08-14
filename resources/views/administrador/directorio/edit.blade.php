@extends('layouts.admin')

@section('title', 'Editar Item Directorio')
@section('cabecera', 'Editar Item Directorio')

@section('content')

<style>
  .despacho-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(0, 63, 117, 0.08);
    border-radius: 1rem;
    box-shadow: 0 10px 40px rgba(0, 63, 117, 0.10);
    padding: 2rem;
    margin-bottom: 2rem;
    animation: fadeInUp 0.6s ease-out both;
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .despacho-header {
    text-align: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0, 63, 117, 0.10);
  }
  .despacho-header h3 {
    margin: 0;
    color: #003f75;
    font-weight: 500;
    font-size: 1.5rem;
  }
  .despacho-header small {
    color: #6c757d;
    font-size: 0.9rem;
  }
  .form-group-min {
    margin-bottom: 1.25rem;
    position: relative;
  }
  .form-group-min label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #495057;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 0.4rem;
  }
  .form-group-min .req { color: #dc3545; }
  .form-group-min input,
  .form-group-min select,
  .form-group-min textarea {
    width: 100%;
    border: 1px solid #ced4da;
    border-radius: 0.6rem;
    padding: 0.6rem 0.9rem;
    font-size: 0.95rem;
    color: #212529;
    background: #fff;
    transition: all 0.25s ease;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.03);
    outline: none;
    height: auto;
  }
  .form-group-min input:focus,
  .form-group-min select:focus,
  .form-group-min textarea:focus {
    border-color: #003f75;
    box-shadow: 0 0 0 3px rgba(0, 63, 117, 0.12);
    transform: translateY(-1px);
  }
  .form-group-min input.is-valid {
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.12);
  }
  .form-group-min input.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.12);
  }
  .form-group-min .error-text {
    font-size: 0.8rem;
    color: #dc3545;
    margin-top: 0.3rem;
  }
  .btn-modern {
    border: none;
    border-radius: 0.6rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
  }
  .btn-guardar {
    background: linear-gradient(135deg, #003f75 0%, #0056a3 100%);
    color: #fff;
  }
  .btn-guardar:hover {
    background: linear-gradient(135deg, #0056a3 0%, #0074d9 100%);
  }
  .btn-cancelar {
    background: #fff;
    color: #dc3545;
    border: 1px solid #dc3545;
  }
  .btn-cancelar:hover {
    background: #dc3545;
    color: #fff;
  }
  .divider-modern {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(0,63,117,0.15), transparent);
    margin: 1.5rem 0;
  }
  .section-title {
    font-size: 0.75rem;
    font-weight: 700;
    color: #003f75;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  .section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, rgba(0,63,117,0.2), transparent);
  }
  .badge-optional {
    font-size: 0.65rem;
    font-weight: 600;
    color: #6c757d;
    background: rgba(108,117,125,0.10);
    padding: 0.15rem 0.4rem;
    border-radius: 0.3rem;
    text-transform: uppercase;
    margin-left: 0.3rem;
  }
  @media (max-width: 768px) {
    .despacho-card { padding: 1.2rem; }
  }
</style>

@include('../alerts.request')

<form action="{{ route('directorio.update', $directorio->id) }}" method="POST" id="directorioForm" novalidate>
  @csrf
  @method('PUT')

  <div class="despacho-card">
    <div class="despacho-header">
      <h3>Editar Item Directorio</h3>
      <small>Complete los campos obligatorios marcados con <span class="req">*</span></small>
    </div>

    <div class="section-title">Información del Directorio</div>
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dDespacho">Despacho <span class="req">*</span></label>
          <input type="text" name="dDespacho" id="dDespacho" maxlength="100"
                 value="{{ old('dDespacho', $directorio->dDespacho ?? '') }}"
                 class="form-control @error('dDespacho') is-invalid @enderror"
                 placeholder="Nombre del Despacho" required>
          @error('dDespacho')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dCiudad">Ciudad <span class="req">*</span></label>
          <input type="text" name="dCiudad" id="dCiudad" maxlength="100"
                 value="{{ old('dCiudad', $directorio->dCiudad ?? '') }}"
                 class="form-control @error('dCiudad') is-invalid @enderror"
                 placeholder="Nombre de la Ciudad" required>
          @error('dCiudad')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dDireccion">Dirección <span class="req">*</span></label>
          <input type="text" name="dDireccion" id="dDireccion" maxlength="100"
                 value="{{ old('dDireccion', $directorio->dDireccion ?? '') }}"
                 class="form-control @error('dDireccion') is-invalid @enderror"
                 placeholder="Dirección del juzgado" required>
          @error('dDireccion')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dTelefono">Teléfono <span class="req">*</span></label>
          <input type="text" name="dTelefono" id="dTelefono" maxlength="15"
                 value="{{ old('dTelefono', $directorio->dTelefono ?? '') }}"
                 class="form-control @error('dTelefono') is-invalid @enderror"
                 placeholder="Teléfono del Juzgado" required>
          @error('dTelefono')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dExtension">Extensión <span class="badge-optional">Opcional</span></label>
          <input type="text" name="dExtension" id="dExtension" maxlength="20"
                 value="{{ old('dExtension', $directorio->dExtension ?? '') }}"
                 class="form-control @error('dExtension') is-invalid @enderror"
                 placeholder="Extensión del juzgado">
          @error('dExtension')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dCircuito">Circuito <span class="badge-optional">Opcional</span></label>
          <input type="text" name="dCircuito" id="dCircuito" maxlength="50"
                 value="{{ old('dCircuito', $directorio->dCircuito ?? '') }}"
                 class="form-control @error('dCircuito') is-invalid @enderror"
                 placeholder="Circuito del juzgado">
          @error('dCircuito')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dDistricto">Distrito <span class="badge-optional">Opcional</span></label>
          <input type="text" name="dDistricto" id="dDistricto" maxlength="50"
                 value="{{ old('dDistricto', $directorio->dDistricto ?? '') }}"
                 class="form-control @error('dDistricto') is-invalid @enderror"
                 placeholder="Distrito del juzgado">
          @error('dDistricto')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="dCreador">Creado por <span class="badge-optional">Sistema</span></label>
          <input type="text" name="dCreador" id="dCreador" maxlength="50"
                 value="{{ old('dCreador', $directorio->dCreador ??  auth()->user()->name) }}"
                 class="form-control" readonly>
        </div>
      </div>
    </div>

    <hr class="divider-modern">

    <div class="row">
      <div class="col-xs-12 col-sm-6" style="margin-bottom: 0.8rem;">
        <button type="submit" class="btn-modern btn-guardar btn-block">
          <i class="fa fa-save"></i> Actualizar Item Directorio
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

<script>
(function() {
  const form = document.getElementById('directorioForm');
  const inputs = form.querySelectorAll('input');
  const validators = {
    dDespacho: v => v.trim().length >= 2,
    dCiudad: v => v.trim().length >= 2,
    dDireccion: v => v.trim().length >= 3,
    dTelefono: v => /^\d{7,15}$/.test(v),
    dExtension: v => v === '' || v.length <= 20,
    dCircuito: v => v === '' || v.length <= 50,
    dDistricto: v => v === '' || v.length <= 50,
  };
  function mark(el, valid) {
    if (!el) return;
    el.classList.remove('is-valid', 'is-invalid');
    if (el.value.trim() !== '') el.classList.add(valid ? 'is-valid' : 'is-invalid');
  }
  inputs.forEach(input => {
    input.addEventListener('blur', function() {
      const name = this.name;
      if (validators[name]) mark(this, validators[name](this.value));
    });
    input.addEventListener('input', function() { this.classList.remove('is-invalid'); });
  });
  form.addEventListener('submit', function(e) {
    let ok = true;
    inputs.forEach(input => {
      const name = input.name;
      if (validators[name] && !validators[name](input.value)) {
        if (input.hasAttribute('required') || input.value.trim() !== '') {
          mark(input, false); ok = false;
        }
      }
    });
    if (!ok) { e.preventDefault(); const first = form.querySelector('.is-invalid'); if (first) first.focus(); }
  });
})();
</script>

@endsection
