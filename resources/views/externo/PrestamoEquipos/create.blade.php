@extends('layouts.usuarios')
@section('title', 'Acta de Entrega Temporal de Equipos')
@section('cabecera','Acta de Entrega Temporal y Compromiso de Custodia')

@section('content')
<div class="container-fluid" style="background:#f8f9fc; min-height:80vh; padding:20px;">

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ route('prestamo.equipos.store') }}" method="POST" id="form-acta">
    @csrf

    {{-- ============================================================
         ENCABEZADO
    ============================================================ --}}
    <div class="panel panel-default" style="margin-bottom:16px;">
      <div class="panel-heading" style="background:linear-gradient(135deg,#0a2a4a,#0d3b66); color:#fff; padding:12px 20px;">
        <h4 style="margin:0; font-weight:700;"><i class="fa fa-file-text-o"></i> Acta de Entrega Temporal y Compromiso de Custodia</h4>
        <small style="opacity:0.8;">Dirección Seccional de Administración Judicial de Cali – Valle del Cauca</small>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label><i class="fa fa-calendar"></i> Fecha del Acta <span class="text-danger">*</span></label>
              <input type="date" name="fecha_acta" class="form-control" required value="{{ old('fecha_acta', date('Y-m-d')) }}">
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label><i class="fa fa-building"></i> Despacho / Dependencia</label>
              <input type="text" class="form-control" readonly
                     style="background:#d4edda; font-weight:700; color:#155724; cursor:not-allowed;"
                     value="{{ auth()->user()->name ?? '' }}">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label><i class="fa fa-map-marker"></i> Edificio / Dirección <span class="text-danger">*</span></label>
              <input type="text" name="edificio" class="form-control" required 
                     placeholder="Ej. Palacio de Justicia / Cra 10 #12-15"
                     value="{{ old('edificio', $despachoInfo->edificio ?? '') }}">
            </div>
          </div>
          <div class="col-xs-12 col-sm-2">
            <div class="form-group">
              <label><i class="fa fa-level-up"></i> Piso <span class="text-danger">*</span></label>
              <input type="text" name="piso" class="form-control" required 
                     placeholder="Ej. Piso 4"
                     value="{{ old('piso', $despachoInfo->piso ?? '') }}">
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- ============================================================
         SECCIÓN 1: DATOS DEL TITULAR DEL DESPACHO
    ============================================================ --}}
    <div class="panel panel-default" style="margin-bottom:16px;">
      <div class="panel-heading" style="background:#0a2a4a; color:#fff; padding:10px 16px;">
        <strong><i class="fa fa-user-circle"></i> 1. Datos del Servidor Titular del Despacho</strong>
      </div>
      <div class="panel-body">
        <div class="row">
          {{-- Cédula + buscar --}}
          <div class="col-xs-12 col-sm-3" style="margin-bottom:10px;">
            <label>Cédula del Titular <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="number" id="cedula_juez" name="cedula_juez" class="form-control" required
                     placeholder="Ej: 987654321" value="{{ old('cedula_juez') }}">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="buscarTitular()">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            <small id="aviso_juez" class="text-warning" style="display:none;">
              <i class="fa fa-exclamation-triangle"></i> No encontrado. Complete manualmente.
            </small>
          </div>
          {{-- Nombre --}}
          <div class="col-xs-12 col-sm-5" style="margin-bottom:10px;">
            <label>Nombre Completo <span class="text-danger">*</span></label>
            <input type="text" id="nombre_juez" name="nombre_juez" class="form-control" required readonly
                   placeholder="Se autocompleta al buscar..." value="{{ old('nombre_juez') }}">
          </div>
          <div class="col-xs-12 col-sm-4" style="margin-bottom:10px;">
            <label>Cargo <span class="text-danger">*</span></label>
            <input type="text" id="cargo_titular" name="cargo_titular" class="form-control" required readonly
                   placeholder="Se autocompleta al buscar..." value="{{ old('cargo_titular') }}">
            <small class="text-muted">Se autocompleta del sistema (no editable).</small>
          </div>
        </div>
        <div class="row">
          {{-- Correo --}}
          <div class="col-xs-12 col-sm-6" style="margin-bottom:10px;">
            <label>Correo Institucional <span class="text-danger">*</span></label>
            <input type="email" id="correo_titular" name="correo_titular" class="form-control" required
                   placeholder="correo@ramajudicial.gov.co" value="{{ old('correo_titular') }}">
          </div>
        </div>
      </div>
    </div>

    {{-- ============================================================
         SECCIÓN 2: EMPLEADOS Y SUS ELEMENTOS
    ============================================================ --}}
    <div class="panel panel-default" style="margin-bottom:16px;">
      <div class="panel-heading" style="background:#0a2a4a; color:#fff; padding:10px 16px;">
        <strong><i class="fa fa-users"></i> 2. Identificación de Elementos por Empleado</strong>
        <span style="font-size:0.8rem; opacity:0.8; margin-left:8px;">Agregue un empleado y los elementos que recibirá.</span>
      </div>
      <div class="panel-body">

        <div id="empleados-container">
          {{-- Primer bloque generado en el HTML --}}
          <div class="empleado-bloque" data-index="0"
               style="border:1px solid #dde3ec; border-radius:6px; padding:14px; margin-bottom:16px; background:#fafcff;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
              <strong style="color:#0a2a4a;"><i class="fa fa-user"></i> Empleado <span class="num-empleado">1</span></strong>
              <button type="button" class="btn btn-xs btn-danger btn-quitar-empleado" style="display:none;">
                <i class="fa fa-times"></i> Quitar empleado
              </button>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-3" style="margin-bottom:8px;">
                <label style="font-size:0.82rem;">Cédula <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="number" name="empleados[0][cedula]"
                         class="form-control input-sm cedula-empleado" required placeholder="CC">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-sm btn-buscar-empleado" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
                <small class="text-danger error-empleado" style="display:none;">No encontrado.</small>
              </div>
              <div class="col-xs-12 col-sm-4" style="margin-bottom:8px;">
                <label style="font-size:0.82rem;">Nombre Completo <span class="text-danger">*</span></label>
                <input type="text" name="empleados[0][nombre]"
                       class="form-control input-sm nombre-empleado" required readonly
                       placeholder="Se autocompleta...">
              </div>
              <div class="col-xs-12 col-sm-2" style="margin-bottom:8px;">
                <label style="font-size:0.82rem;">Cargo <span class="text-danger">*</span></label>
                <input type="text" name="empleados[0][cargo]"
                       class="form-control input-sm cargo-empleado" required readonly placeholder="Cargo">
              </div>
              <div class="col-xs-12 col-sm-3" style="margin-bottom:8px;">
                <label style="font-size:0.82rem;">Lugar de uso del equipo <span class="text-danger">*</span></label>
                <input type="text" name="empleados[0][lugar]"
                       class="form-control input-sm" required
                       placeholder="Dirección donde usará el equipo">
              </div>
            </div>

            {{-- Tabla de elementos --}}
            <div style="margin-top:10px;">
              <p style="font-size:0.8rem; font-weight:700; color:#555; margin-bottom:6px;">
                <i class="fa fa-list"></i> Elementos asignados:
              </p>
              <table class="table table-bordered table-condensed tabla-elementos"
                     style="font-size:0.82rem; margin-bottom:6px;">
                <thead style="background:#f1f5f9;">
                  <tr>
                    <th style="width:34%;">Elemento</th>
                    <th style="width:20%;">Placa</th>
                    <th style="width:20%;">Serial</th>
                    <th style="width:20%;">Marca</th>
                    <th style="width:40px; text-align:center;"><i class="fa fa-cog"></i></th>
                  </tr>
                </thead>
                <tbody class="cuerpo-elementos">
                  <tr>
                    <td>
                      <select name="empleados[0][elementos][0][elemento]"
                              class="form-control input-sm select-elemento" required>
                        <option value="">-- Seleccione --</option>
                        <option value="Todo en uno">Todo en uno</option>
                        <option value="Teclado">Teclado</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Escáner">Escáner</option>
                        <option value="Impresora">Impresora</option>
                        <option value="Portátil">Portátil</option>
                        <option value="Silla">Silla</option>
                        <option value="Mesa">Mesa</option>
                        <option value="Escritorio">Escritorio</option>
                        <option value="Diadema">Diadema</option>
                        <option value="Descansa pies">Descansa pies</option>
                        <option value="Elementos Personales">Elementos Personales</option>
                      </select>
                    </td>
                    <td><input type="text" name="empleados[0][elementos][0][placa]"
                               class="form-control input-sm" placeholder="Placa" required></td>
                    <td><input type="text" name="empleados[0][elementos][0][serial]"
                               class="form-control input-sm" placeholder="Serial"></td>
                    <td><input type="text" name="empleados[0][elementos][0][marca]"
                               class="form-control input-sm" placeholder="Marca"></td>
                    <td>
                      <button type="button" class="btn btn-xs btn-danger btn-quitar-elemento"
                              style="display:none;">
                        <i class="fa fa-minus"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button type="button" class="btn btn-xs btn-default btn-agregar-elemento"
                      style="border:1px dashed #aaa;">
                <i class="fa fa-plus"></i> Agregar elemento
              </button>
              <small class="text-danger alerta-duplicado" style="display:none; margin-left:8px;">
                <i class="fa fa-exclamation-triangle"></i> Este empleado ya tiene ese tipo de elemento.
              </small>
            </div>
          </div>
        </div>

        <button type="button" id="btn-agregar-empleado" class="btn btn-default"
                style="border:1px dashed #0a2a4a; color:#0a2a4a; width:100%; margin-top:4px;">
          <i class="fa fa-user-plus"></i> Agregar otro empleado
        </button>

      </div>
    </div>

    <button type="submit" id="btn-submit" class="btn btn-primary btn-block"
            style="padding:14px; font-size:1.1rem; font-weight:700; background:#0a2a4a; border:none;">
      <i class="fa fa-file-text-o"></i> Generar Acta de Entrega
    </button>
  </form>
</div>

<style>
  .form-control { border-radius: 4px; }
  .panel { border-radius: 6px; }
  .tabla-elementos td, .tabla-elementos th { vertical-align: middle !important; padding: 4px 6px !important; }
  .elemento-duplicado { border: 2px solid #e74c3c !important; }
</style>

<script>
// ============================================================
// OPCIONES DISPONIBLES DE ELEMENTOS
// ============================================================
// ⬇️ [CÓMO AGREGAR MÁS ELEMENTOS MANUALMENTE] ⬇️
// 1. Añade el nombre del nuevo elemento al final de este listado (entre comillas simples, separado por coma).
// 2. NO OLVIDES añadir la etiqueta <option> en el HTML de arriba.
var OPCIONES_ELEMENTOS = [
  'Todo en uno', 'Teclado', 'Mouse', 'Escáner', 'Impresora', 'Portátil', 'Silla', 'Mesa', 'Escritorio', 'Diadema', 'Descansa pies','Elementos Personales'
];

function opcionesSelectHtml(nameAttr, selected) {
  var html = '<option value="">-- Seleccione --</option>';
  OPCIONES_ELEMENTOS.forEach(function(op) {
    html += '<option value="' + op + '"' + (op === selected ? ' selected' : '') + '>' + op + '</option>';
  });
  return html;
}

// ============================================================
// BÚSQUEDA DEL TITULAR (sección 1)
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

// Enter en cédula titular también busca
document.getElementById('cedula_juez').addEventListener('keydown', function(e) {
  if (e.key === 'Enter') { e.preventDefault(); buscarTitular(); }
});

// Limpiar campos de juez si cambia la cédula
document.getElementById('cedula_juez').addEventListener('input', function() {
  document.getElementById('nombre_juez').value = '';
  document.getElementById('cargo_titular').value = '';
});

// Limpiar campos de empleado si cambia la cédula (delegación de eventos)
document.getElementById('empleados-container').addEventListener('input', function(e) {
  if (e.target.classList.contains('cedula-empleado')) {
    var bloque = e.target.closest('.empleado-bloque');
    bloque.querySelector('.nombre-empleado').value = '';
    bloque.querySelector('.cargo-empleado').value = '';
  }
});

// ============================================================
// BÚSQUEDA DE EMPLEADO EN FILA (sección 2)
// ============================================================
function buscarEmpleadoFila(btn) {
  var bloque    = btn.closest('.empleado-bloque');
  var cedulaInp = bloque.querySelector('.cedula-empleado');
  var nombreInp = bloque.querySelector('.nombre-empleado');
  var cargoInp  = bloque.querySelector('.cargo-empleado');
  var errorEl   = bloque.querySelector('.error-empleado');
  var cedula    = cedulaInp.value.trim();
  if (!cedula) return;

  fetch("{{ route('reporte.danos.buscar_empleado') }}?cedula=" + cedula)
    .then(r => r.json())
    .then(data => {
      if (data.encontrado) {
        nombreInp.value = data.nombre_completo || '';
        cargoInp.value  = data.cargo || '';
        errorEl.style.display = 'none';
      } else {
        nombreInp.value = '';
        cargoInp.value  = '';
        errorEl.style.display = 'block';
      }
    });
}

// ============================================================
// VALIDAR DUPLICADO DE ELEMENTO POR EMPLEADO
// ============================================================
function validarDuplicadoElemento(bloque) {
  var selects     = bloque.querySelectorAll('.select-elemento');
  var alerta      = bloque.querySelector('.alerta-duplicado');
  var valores     = [];
  var hayDuplicado = false;

  selects.forEach(function(sel) {
    sel.classList.remove('elemento-duplicado');
    var v = sel.value;
    if (v && valores.includes(v)) {
      hayDuplicado = true;
      // Marcar ambos
      selects.forEach(function(s) {
        if (s.value === v) s.classList.add('elemento-duplicado');
      });
    }
    if (v) valores.push(v);
  });

  alerta.style.display = hayDuplicado ? 'inline' : 'none';
  return !hayDuplicado;
}

// Validar al enviar
document.getElementById('form-acta').addEventListener('submit', function(e) {
  var bloques = document.querySelectorAll('.empleado-bloque');
  var ok = true;
  var todosEmpleadosValidos = true;

  // Validar que el titular haya sido encontrado
  var nombreTitular = document.getElementById('nombre_juez').value.trim();
  if (nombreTitular === '') {
    e.preventDefault();
    alert('⚠️ El Servidor Titular no se encuentra registrado. Busque una cédula válida.');
    return;
  }

  bloques.forEach(function(b) {
    if (!validarDuplicadoElemento(b)) ok = false;
    
    // Validar que el empleado haya sido encontrado
    var nombreEmpleado = b.querySelector('.nombre-empleado').value.trim();
    if (nombreEmpleado === '') {
      todosEmpleadosValidos = false;
    }
  });

  if (!todosEmpleadosValidos) {
    e.preventDefault();
    alert('⚠️ Uno o más empleados no existen en la planta. Asegúrese de buscar cédulas válidas.');
    return;
  }

  if (!ok) {
    e.preventDefault();
    alert('⚠️ Un mismo empleado no puede recibir dos veces el mismo tipo de elemento. Corrija las filas marcadas en rojo.');
  }
});

// ============================================================
// ÍNDICE GLOBAL DE EMPLEADOS Y ELEMENTOS
// ============================================================
var empIdx = 1;

function generarFilaElemento(empI, elIdx) {
  return '<tr>' +
    '<td><select name="empleados[' + empI + '][elementos][' + elIdx + '][elemento]" ' +
    'class="form-control input-sm select-elemento" required>' +
    opcionesSelectHtml('', '') +
    '</select></td>' +
    '<td><input type="text" name="empleados[' + empI + '][elementos][' + elIdx + '][placa]" ' +
    'class="form-control input-sm" placeholder="Placa" required></td>' +
    '<td><input type="text" name="empleados[' + empI + '][elementos][' + elIdx + '][serial]" ' +
    'class="form-control input-sm" placeholder="Serial"></td>' +
    '<td><input type="text" name="empleados[' + empI + '][elementos][' + elIdx + '][marca]" ' +
    'class="form-control input-sm" placeholder="Marca"></td>' +
    '<td><button type="button" class="btn btn-xs btn-danger btn-quitar-elemento">' +
    '<i class="fa fa-minus"></i></button></td>' +
    '</tr>';
}

function generarBloqueEmpleado(idx) {
  return '<div class="empleado-bloque" data-index="' + idx + '" ' +
    'style="border:1px solid #dde3ec; border-radius:6px; padding:14px; margin-bottom:16px; background:#fafcff;">' +
    '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">' +
    '<strong style="color:#0a2a4a;"><i class="fa fa-user"></i> Empleado <span class="num-empleado"></span></strong>' +
    '<button type="button" class="btn btn-xs btn-danger btn-quitar-empleado">' +
    '<i class="fa fa-times"></i> Quitar empleado</button></div>' +
    '<div class="row">' +
    '<div class="col-xs-12 col-sm-3" style="margin-bottom:8px;">' +
    '<label style="font-size:0.82rem;">Cédula <span class="text-danger">*</span></label>' +
    '<div class="input-group">' +
    '<input type="number" name="empleados[' + idx + '][cedula]" ' +
    'class="form-control input-sm cedula-empleado" required placeholder="CC">' +
    '<span class="input-group-btn"><button class="btn btn-default btn-sm btn-buscar-empleado" type="button">' +
    '<i class="fa fa-search"></i></button></span></div>' +
    '<small class="text-danger error-empleado" style="display:none;">No encontrado.</small></div>' +
    '<div class="col-xs-12 col-sm-4" style="margin-bottom:8px;">' +
    '<label style="font-size:0.82rem;">Nombre Completo <span class="text-danger">*</span></label>' +
    '<input type="text" name="empleados[' + idx + '][nombre]" ' +
    'class="form-control input-sm nombre-empleado" required readonly placeholder="Se autocompleta..."></div>' +
    '<div class="col-xs-12 col-sm-2" style="margin-bottom:8px;">' +
    '<label style="font-size:0.82rem;">Cargo <span class="text-danger">*</span></label>' +
    '<input type="text" name="empleados[' + idx + '][cargo]" ' +
    'class="form-control input-sm cargo-empleado" required readonly placeholder="Cargo"></div>' +
    '<div class="col-xs-12 col-sm-3" style="margin-bottom:8px;">' +
    '<label style="font-size:0.82rem;">Lugar de uso del equipo <span class="text-danger">*</span></label>' +
    '<input type="text" name="empleados[' + idx + '][lugar]" ' +
    'class="form-control input-sm" required placeholder="Dirección / lugar"></div></div>' +
    '<div style="margin-top:10px;">' +
    '<p style="font-size:0.8rem; font-weight:700; color:#555; margin-bottom:6px;">' +
    '<i class="fa fa-list"></i> Elementos asignados:</p>' +
    '<table class="table table-bordered table-condensed tabla-elementos" style="font-size:0.82rem; margin-bottom:6px;">' +
    '<thead style="background:#f1f5f9;"><tr>' +
    '<th style="width:28%;">Elemento</th><th style="width:18%;">Placa</th>' +
    '<th style="width:18%;">Serial</th><th style="width:18%;">Marca</th>' +
    '<th style="width:14%;">Estado</th><th style="width:36px;"></th>' +
    '</tr></thead>' +
    '<tbody class="cuerpo-elementos">' +
    generarFilaElemento(idx, 0) +
    '</tbody></table>' +
    '<button type="button" class="btn btn-xs btn-default btn-agregar-elemento" ' +
    'style="border:1px dashed #aaa;"><i class="fa fa-plus"></i> Agregar elemento</button>' +
    '<small class="text-danger alerta-duplicado" style="display:none; margin-left:8px;">' +
    '<i class="fa fa-exclamation-triangle"></i> Este empleado ya tiene ese tipo de elemento.</small>' +
    '</div></div>';
}

// ============================================================
// BIND EVENTOS (se llama después de agregar nuevos bloques)
// ============================================================
function bindEventos() {
  // Buscar empleado
  document.querySelectorAll('.btn-buscar-empleado').forEach(function(btn) {
    btn.onclick = function() { buscarEmpleadoFila(this); };
  });

  // Enter en cédula de empleado
  document.querySelectorAll('.cedula-empleado').forEach(function(inp) {
    inp.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') { e.preventDefault(); buscarEmpleadoFila(this.nextElementSibling.querySelector('button')); }
    });
  });

  // Quitar empleado
  document.querySelectorAll('.btn-quitar-empleado').forEach(function(btn) {
    btn.onclick = function() {
      this.closest('.empleado-bloque').remove();
      actualizarNumerosEmpleados();
      actualizarBotonesQuitarEmpleado();
    };
  });

  // Agregar elemento
  document.querySelectorAll('.btn-agregar-elemento').forEach(function(btn) {
    btn.onclick = function() {
      var bloque = this.closest('.empleado-bloque');
      var empI   = bloque.getAttribute('data-index');
      var tbody  = bloque.querySelector('.cuerpo-elementos');
      var elIdx  = tbody.querySelectorAll('tr').length;
      tbody.insertAdjacentHTML('beforeend', generarFilaElemento(empI, elIdx));
      actualizarBotonesQuitarElemento(bloque);
      bindEventosElementos(bloque);
    };
  });

  // Quitar elemento
  document.querySelectorAll('.btn-quitar-elemento').forEach(function(btn) {
    btn.onclick = function() {
      var bloque = this.closest('.empleado-bloque');
      this.closest('tr').remove();
      actualizarBotonesQuitarElemento(bloque);
      validarDuplicadoElemento(bloque);
    };
  });

  // Cambio en select elemento → validar duplicado
  document.querySelectorAll('.select-elemento').forEach(function(sel) {
    sel.onchange = function() {
      validarDuplicadoElemento(this.closest('.empleado-bloque'));
    };
  });

  actualizarBotonesQuitarEmpleado();
  document.querySelectorAll('.empleado-bloque').forEach(function(b) {
    actualizarBotonesQuitarElemento(b);
  });
}

function bindEventosElementos(bloque) {
  bloque.querySelectorAll('.btn-quitar-elemento').forEach(function(btn) {
    btn.onclick = function() {
      bloque.querySelector('tr').remove;
      this.closest('tr').remove();
      actualizarBotonesQuitarElemento(bloque);
      validarDuplicadoElemento(bloque);
    };
  });
  bloque.querySelectorAll('.select-elemento').forEach(function(sel) {
    sel.onchange = function() { validarDuplicadoElemento(bloque); };
  });
}

function actualizarNumerosEmpleados() {
  document.querySelectorAll('.empleado-bloque').forEach(function(b, i) {
    b.querySelector('.num-empleado').textContent = i + 1;
  });
}

function actualizarBotonesQuitarEmpleado() {
  var bloques = document.querySelectorAll('.empleado-bloque');
  bloques.forEach(function(b) {
    var btn = b.querySelector('.btn-quitar-empleado');
    if (btn) btn.style.display = bloques.length > 1 ? 'inline-block' : 'none';
  });
}

function actualizarBotonesQuitarElemento(bloque) {
  var filas = bloque.querySelectorAll('.cuerpo-elementos tr');
  filas.forEach(function(f) {
    var btn = f.querySelector('.btn-quitar-elemento');
    if (btn) btn.style.display = filas.length > 1 ? 'inline-block' : 'none';
  });
}

// Botón agregar empleado
document.getElementById('btn-agregar-empleado').addEventListener('click', function() {
  var idx = empIdx++;
  document.getElementById('empleados-container').insertAdjacentHTML('beforeend', generarBloqueEmpleado(idx));
  actualizarNumerosEmpleados();
  bindEventos();
});

// Inicializar
bindEventos();
</script>
@endsection
