@extends('layouts.admin')

@section('title', 'Crear Ciudad')
@section('cabecera', 'Crear Ciudad')

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
  @media (max-width: 768px) {
    .despacho-card { padding: 1.2rem; }
  }
</style>

@include('../alerts.request')

<form action="{{ route('ciudad.store') }}" method="POST" id="ciudadForm" novalidate>
  @csrf

  <div class="despacho-card">
    <div class="despacho-header">
      <h3>Crear Ciudad</h3>
      <small>Complete los campos obligatorios marcados con <span class="req">*</span></small>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="codigoCiudad">Código Ciudad <span class="req">*</span></label>
          <input type="text" name="codigoCiudad" id="codigoCiudad" maxlength="20"
                 value="{{ old('codigoCiudad') }}"
                 class="form-control @error('codigoCiudad') is-invalid @enderror"
                 placeholder="Ej: 11001" required>
          @error('codigoCiudad')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="form-group-min">
          <label for="nombreCiudad">Nombre Ciudad <span class="req">*</span></label>
          <input type="text" name="nombreCiudad" id="nombreCiudad" maxlength="100"
                 value="{{ old('nombreCiudad') }}"
                 class="form-control @error('nombreCiudad') is-invalid @enderror"
                 placeholder="Ej: Cali" required>
          @error('nombreCiudad')<div class="error-text">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <hr class="divider-modern">

    <div class="row">
      <div class="col-xs-12 col-sm-6" style="margin-bottom: 0.8rem;">
        <button type="submit" class="btn-modern btn-guardar btn-block">
          <i class="fa fa-save"></i> Guardar Ciudad
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
  const form = document.getElementById('ciudadForm');
  const inputs = form.querySelectorAll('input');
  const validators = {
    codigoCiudad: v => v.trim().length >= 1 && v.length <= 20,
    nombreCiudad: v => v.trim().length >= 2 && v.length <= 100,
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
        mark(input, false); ok = false;
      }
    });
    if (!ok) { e.preventDefault(); const first = form.querySelector('.is-invalid'); if (first) first.focus(); }
  });
})();
</script>

@endsection
