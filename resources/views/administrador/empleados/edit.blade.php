@extends('layouts.admin')

@section('title', 'Editar Empleado')
@section('cabecera', 'Editar Empleado')

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
  .photo-card {
    background: rgba(0, 63, 117, 0.03);
    border: 1px dashed rgba(0, 63, 117, 0.20);
    border-radius: 0.8rem;
    padding: 1.5rem;
    text-align: center;
  }
  .photo-card img {
    width: 200px; height: 266px; object-fit: cover;
    border: 2px solid #ccc; border-top: 5px solid #003f74; border-radius: 8px;
    transition: all 0.3s ease;
  }
  .photo-card img:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  }
  @media (max-width: 768px) {
    .despacho-card { padding: 1.2rem; }
  }
</style>

@include('../alerts.request')

<form action="{{ route('empleados.update', $empleado->id) }}" method="POST" id="formEmpleado" novalidate>
  @csrf
  @method('PUT')

  <div class="despacho-card">
    <div class="despacho-header">
      <h3>Editar Empleado</h3>
      <small>Complete los campos obligatorios marcados con <span class="req">*</span></small>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="section-title">Datos Personales</div>
        <div class="form-group-min">
          <label for="cedulaE">Cédula Empleado <span class="req">*</span></label>
          <input type="text" name="cedula" value="{{ $empleado->cedulaE }}" class="form-control" id="cedulaE" required>
        </div>

        <div class="form-group-min">
          <label for="nameE">Nombre(s) <span class="req">*</span></label>
          <input type="text" name="nombre" value="{{ $empleado->nameE }}" class="form-control" id="nameE" required>
        </div>

        <div class="form-group-min">
          <label for="lastnameE">Apellido(s) <span class="req">*</span></label>
          <input type="text" name="apellido" value="{{ $empleado->lastnameE }}" class="form-control" id="lastnameE" required>
        </div>

        <div class="form-group-min">
          <label for="cargo_titular">Cargo / Rol</label>
          <input type="text" name="cargo_titular" value="{{ $empleado->cargo_titular }}" class="form-control" id="cargo_titular" list="cargos-list" placeholder="Escribe o selecciona... (ej. JUEZ)">
          <datalist id="cargos-list">
            @if(isset($cargos))
              @foreach($cargos as $cargo)
                <option value="{{ $cargo }}">
              @endforeach
            @endif
          </datalist>
        </div>

        <div class="form-group-min">
          <label for="cod_despacho">Despacho Titular</label>
          <select name="cod_despacho" class="form-control" id="cod_despacho" style="width: 100%; border-radius: 0.6rem;">
            <option value="">--- Seleccione un Despacho ---</option>
            <option value="CONTRATISTA" {{ $empleado->cod_despacho == 'CONTRATISTA' ? 'selected' : '' }}>CONTRATISTA</option>
            @if(isset($despachos))
              @foreach($despachos as $d)
                <option value="{{ $d->codigoDespacho }}" {{ $empleado->cod_despacho == $d->codigoDespacho ? 'selected' : '' }}>
                  {{ $d->codigoDespacho }} - {{ $d->nombreDespacho }} (Sede: {{ $d->ciudad ?? 'N/A' }})
                </option>
              @endforeach
            @endif
          </select>
          <small class="text-muted" style="font-size: 0.75rem;">Aviso: Cambiar el despacho reemplazará automáticamente los campos de código y dependencia.</small>
        </div>

        <div class="form-group-min">
          <label for="ciudad_ubicacion_laboral">Ciudad / Ubicación Laboral Local</label>
          <input type="text" name="ciudad_ubicacion_laboral" value="{{ $empleado->ciudad_ubicacion_laboral }}" class="form-control" id="ciudad_ubicacion_laboral">
        </div>

        <div class="row">
          <div class="col-md-6 form-group-min">
            <label for="fecha_expedicion">Fecha de Expedición Carnet</label>
            <input type="date" name="fecha_expedicion" value="{{ $empleado->fecha_expedicion }}" class="form-control" id="fecha_expedicion">
          </div>
          <div class="col-md-6 form-group-min">
            <label for="fecha_retiro">Fecha de Vigencia/Expiración</label>
            <input type="date" name="fecha_retiro" value="{{ $empleado->fecha_retiro ? $empleado->fecha_retiro->format('Y-m-d') : '' }}" class="form-control" id="fecha_retiro">
          </div>
        </div>

        <div class="form-group-min">
          <label for="estado">Estado</label>
          <select name="estado" class="form-control" id="estado" style="border-radius: 0.6rem;">
            <option value="A" {{ $empleado->estaActivo() ? 'selected' : '' }}>ACTIVO</option>
            <option value="I" {{ !$empleado->estaActivo() ? 'selected' : '' }}>INACTIVO</option>
          </select>
        </div>
      </div>

      <div class="col-md-4 text-center">
        <div class="section-title" style="justify-content: center;">Foto de Carnet</div>
        <div class="photo-card">
          <img id="fotoPreview" src="/img/carnet/{{ $empleado->foto }}" alt="Foto">
          <div class="form-group-min" style="margin-top: 1rem; margin-bottom: 0;">
            <input type="file" id="fotoInput" accept="image/*" class="form-control" style="padding: 0.4rem;">
            <small class="text-muted" style="font-size: 0.75rem;">Se ajustará y comprimirá automáticamente</small>
          </div>
          <input type="hidden" name="foto_base64" id="foto_base64">
        </div>
      </div>
    </div>

    <hr class="divider-modern">

    <div class="row">
      <div class="col-xs-12 col-sm-6" style="margin-bottom: 0.8rem;">
        <button type="submit" class="btn-modern btn-guardar btn-block">
          <i class="fa fa-save"></i> Guardar Empleado
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
  document.getElementById('fotoInput').addEventListener('change', function(event){
    const file = event.target.files[0];
    if(!file) return;
    const reader = new FileReader();
    reader.onload = function(e){
      const img = new Image();
      img.onload = function(){
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        const targetWidth = 300;
        const targetHeight = 400;
        canvas.width = targetWidth;
        canvas.height = targetHeight;
        const imgAspect = img.width / img.height;
        const targetAspect = targetWidth / targetHeight;
        let drawWidth, drawHeight, offsetX = 0, offsetY = 0;
        if(imgAspect > targetAspect) {
          drawWidth = targetWidth;
          drawHeight = img.height * (targetWidth / img.width);
          offsetX = 0;
          offsetY = (targetHeight - drawHeight) / 2;
        } else {
          drawHeight = targetHeight;
          drawWidth = img.width * (targetHeight / img.height);
          offsetX = (targetWidth - drawWidth) / 2;
          offsetY = 0;
        }
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(0, 0, targetWidth, targetHeight);
        ctx.drawImage(img, offsetX, offsetY, drawWidth, drawHeight);
        const dataUrl = canvas.toDataURL('image/jpeg', 0.7);
        document.getElementById('fotoPreview').src = dataUrl;
        document.getElementById('foto_base64').value = dataUrl;
      }
      img.src = e.target.result;
    }
    reader.readAsDataURL(file);
  });
</script>

@endsection
