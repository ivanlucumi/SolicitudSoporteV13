@extends('layouts.usuarios')

@section('content')
<div class="container" style="max-width:850px; margin-top:30px;">
  <h2 class="text-center" style="color:#0a2a4a; font-weight:700; margin-bottom:20px;">
    <i class="fa fa-sign-in"></i> Solicitud de Ingreso
  </h2>

  @if (session('success'))
    <div class="alert alert-success" style="border-left:5px solid #28a745; background:#f4fdf6;">
      <i class="fa fa-check-circle" style="font-size:1.2rem; color:#28a745;"></i> {{ session('success') }}
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger" style="border-left:5px solid #dc3545; background:#fff5f6;">
      <strong><i class="fa fa-exclamation-triangle"></i> Revisa los siguientes errores:</strong>
      <ul style="margin-top:8px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="form-ingreso" action="{{ route('solicitud_ingreso.store') }}" method="POST">
    @csrf

    {{-- ============================================================
         SECCIÓN 1: TITULAR DEL DESPACHO
    ============================================================ --}}
    <div class="panel panel-default" style="margin-bottom:16px;">
      <div class="panel-heading" style="background:#0a2a4a; color:#fff; padding:10px 16px;">
        <strong><i class="fa fa-user-circle"></i> 1. Identificación del Titular del Despacho</strong>
      </div>
      <div class="panel-body">
        <p style="font-size:0.85rem; color:#666; margin-bottom:12px;">Ingrese la cédula y presione la lupa para autocompletar.</p>
        
        <div class="row">
          {{-- Cédula --}}
          <div class="col-xs-12 col-sm-3" style="margin-bottom:10px;">
            <label>Cédula <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="number" id="cedula_juez" name="cedula_titular" class="form-control"
                     required placeholder="Ej: 12345678" value="{{ old('cedula_titular') }}">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="buscarTitular()">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            <small id="aviso_juez" class="text-danger" style="display:none;">No encontrado.</small>
          </div>
          {{-- Nombre --}}
          <div class="col-xs-12 col-sm-5" style="margin-bottom:10px;">
            <label>Nombre Completo <span class="text-danger">*</span></label>
            <input type="text" id="nombre_juez" name="nombre_titular" class="form-control" required readonly
                   placeholder="Se autocompleta al buscar..." value="{{ old('nombre_titular') }}">
          </div>
          {{-- Cargo --}}
          <div class="col-xs-12 col-sm-4" style="margin-bottom:10px;">
            <label>Cargo <span class="text-danger">*</span></label>
            <input type="text" id="cargo_titular" name="cargo_titular" class="form-control" required readonly
                   placeholder="Se autocompleta al buscar..." value="{{ old('cargo_titular') }}">
          </div>
        </div>
        <div class="row">
          {{-- Correo --}}
          <div class="col-xs-12 col-sm-6" style="margin-bottom:10px;">
            <label>Correo Institucional <span class="text-danger">*</span></label>
            <input type="email" id="correo_titular" name="correo_titular" class="form-control" required
                   placeholder="correo@ramajudicial.gov.co" value="{{ old('correo_titular') }}">
            <small class="text-muted">A este correo llegará la respuesta (Autorización/Rechazo).</small>
          </div>
        </div>
      </div>
    </div>

    {{-- ============================================================
         SECCIÓN 2: DATOS DEL EMPLEADO Y MOTIVO DE INGRESO
    ============================================================ --}}
    <div class="panel panel-default" style="margin-bottom:16px;">
      <div class="panel-heading" style="background:#0a2a4a; color:#fff; padding:10px 16px;">
        <strong><i class="fa fa-user"></i> 2. Datos del Empleado a Ingresar y Motivo</strong>
      </div>
      <div class="panel-body">
        
        <div class="row">
          <div class="col-xs-12 col-sm-3" style="margin-bottom:8px;">
            <label style="font-size:0.82rem;">Cédula Empleado <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="number" id="cedula_empleado" name="cedula_empleado"
                     class="form-control input-sm" required placeholder="CC" value="{{ old('cedula_empleado') }}">
              <span class="input-group-btn">
                <button class="btn btn-default btn-sm" type="button" onclick="buscarEmpleado()">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            <small id="error_empleado" class="text-danger" style="display:none;">No encontrado.</small>
          </div>
          <div class="col-xs-12 col-sm-5" style="margin-bottom:8px;">
            <label style="font-size:0.82rem;">Nombre Completo <span class="text-danger">*</span></label>
            <input type="text" id="nombre_empleado" name="nombre_empleado"
                   class="form-control input-sm" required readonly placeholder="Se autocompleta..." value="{{ old('nombre_empleado') }}">
          </div>
          <div class="col-xs-12 col-sm-4" style="margin-bottom:8px;">
            <label style="font-size:0.82rem;">Cargo <span class="text-danger">*</span></label>
            <input type="text" id="cargo_empleado" name="cargo_empleado"
                   class="form-control input-sm" required readonly placeholder="Cargo" value="{{ old('cargo_empleado') }}">
          </div>
        </div>

        <div class="row" style="margin-top:10px;">
            <div class="col-xs-12">
                <label style="font-size:0.82rem;">Motivo por el cual va a realizar el ingreso <span class="text-danger">*</span></label>
                <textarea name="motivo_ingreso" class="form-control" rows="4" required placeholder="Escriba aquí el motivo detallado de su solicitud de ingreso...">{{ old('motivo_ingreso') }}</textarea>
            </div>
        </div>

      </div>
    </div>

    <button type="submit" id="btn-submit" class="btn btn-primary btn-block"
            style="padding:14px; font-size:1.1rem; font-weight:700; background:#0a2a4a; border:none;">
      <i class="fa fa-send"></i> Registrar Solicitud de Ingreso
    </button>
  </form>
</div>

<style>
  .form-control { border-radius: 4px; }
  .panel { border-radius: 6px; }
</style>

<script>
// ============================================================
// BÚSQUEDA DEL TITULAR
// ============================================================
function buscarTitular() {
  var cedula = document.getElementById('cedula_juez').value.trim();
  var aviso  = document.getElementById('aviso_juez');
  if (!cedula) return;

  fetch("{{ route('reporte.danos.buscar_empleado') }}?cedula=" + cedula)
    .then(r => r.json())
    .then(data => {
      if (data.encontrado) {
        document.getElementById('nombre_juez').value    = data.nombre_completo || '';
        document.getElementById('cargo_titular').value  = data.cargo || '';
        document.getElementById('correo_titular').value = data.correo || '';
        aviso.style.display = 'none';
      } else {
        document.getElementById('nombre_juez').value   = '';
        document.getElementById('cargo_titular').value = '';
        aviso.style.display = 'block';
      }
    })
    .catch(() => { aviso.style.display = 'block'; });
}

document.getElementById('cedula_juez').addEventListener('keydown', function(e) {
  if (e.key === 'Enter') { e.preventDefault(); buscarTitular(); }
});

// ============================================================
// BÚSQUEDA DEL EMPLEADO
// ============================================================
function buscarEmpleado() {
  var cedula = document.getElementById('cedula_empleado').value.trim();
  var aviso  = document.getElementById('error_empleado');
  if (!cedula) return;

  fetch("{{ route('reporte.danos.buscar_empleado') }}?cedula=" + cedula)
    .then(r => r.json())
    .then(data => {
      if (data.encontrado) {
        document.getElementById('nombre_empleado').value = data.nombre_completo || '';
        document.getElementById('cargo_empleado').value  = data.cargo || '';
        aviso.style.display = 'none';
      } else {
        document.getElementById('nombre_empleado').value = '';
        document.getElementById('cargo_empleado').value  = '';
        aviso.style.display = 'block';
      }
    })
    .catch(() => { aviso.style.display = 'block'; });
}

document.getElementById('cedula_empleado').addEventListener('keydown', function(e) {
  if (e.key === 'Enter') { e.preventDefault(); buscarEmpleado(); }
});

// ============================================================
// VALIDAR AL ENVIAR
// ============================================================
document.getElementById('form-ingreso').addEventListener('submit', function(e) {
  var nombreTitular = document.getElementById('nombre_juez').value.trim();
  var nombreEmpleado = document.getElementById('nombre_empleado').value.trim();

  if (nombreTitular === '' || nombreEmpleado === '') {
    e.preventDefault();
    alert('⚠️ Tanto el Titular como el Empleado deben estar registrados en el sistema. Asegúrese de buscarlos por cédula correctamente.');
  }
});
</script>
@endsection
