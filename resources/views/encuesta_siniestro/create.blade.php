@extends('layouts.usuarios')

@section('title', 'Nuevo Registro de Siniestro')
@section('cabecera', 'Registrar Siniestro')

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
{{-- SignaturePad CSS/JS no requiere mucho CSS especial pero se cargará el JS abajo --}}


<style>
/* ═══════════════════════════════════════════════════════
   VARIABLES Y RESET
═══════════════════════════════════════════════════════ */
:root {
  --c-dark:    #0a2a4a;
  --c-mid:     #1a3f6f;
  --c-blue:    #2980b9;
  --c-green:   #27ae60;
  --c-red:     #c0392b;
  --c-amber:   #f39c12;
  --c-bg:      #f4f6fb;
  --c-border:  #dde4ef;
  --c-surface: #fff;
  --radius:    10px;
  --shadow:    0 2px 14px rgba(0,0,0,.07);
}

body { background: var(--c-bg); }
* { box-sizing: border-box; }

/* ═══════════════════════════════════════════════════════
   ENCABEZADO DE PÁGINA
═══════════════════════════════════════════════════════ */
.sin-page-header {
  background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-mid) 100%);
  color: #fff;
  padding: 18px 26px;
  border-radius: var(--radius);
  margin-bottom: 22px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: var(--shadow);
}
.sin-page-header h2 { margin: 0; font-size: 1.25rem; font-weight: 800; }
.sin-page-header small { opacity: .8; font-size: .8rem; }
.consec-display {
  background: rgba(255,255,255,.15);
  border: 1px solid rgba(255,255,255,.3);
  padding: 6px 16px; border-radius: 20px;
  font-family: monospace; font-size: 1rem; font-weight: 800;
  min-width: 180px; text-align: center;
}
.consec-display small { display: block; font-size: .65rem; opacity: .75; font-family: sans-serif; font-weight: 400; }

/* ═══════════════════════════════════════════════════════
   TARJETA DE SECCIÓN
═══════════════════════════════════════════════════════ */
.sin-card {
  background: var(--c-surface);
  border: 1px solid var(--c-border);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  margin-bottom: 18px;
  overflow: visible;
}
.sin-card-head {
  background: linear-gradient(135deg, var(--c-dark), var(--c-mid));
  color: #fff;
  padding: 12px 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  border-radius: var(--radius) var(--radius) 0 0;
}
.sin-card-head h4 { margin: 0; font-size: .95rem; font-weight: 700; }
.sin-card-body { padding: 20px 22px; }

/* ═══════════════════════════════════════════════════════
   CONTROLES DE FORMULARIO
═══════════════════════════════════════════════════════ */
.flabel {
  display: block;
  font-size: .78rem;
  font-weight: 700;
  color: #555;
  text-transform: uppercase;
  letter-spacing: .04em;
  margin-bottom: 4px;
}
.flabel .req { color: var(--c-red); }

.fcontrol {
  width: 100%;
  padding: 8px 12px;
  border: 1.5px solid var(--c-border);
  border-radius: 7px;
  font-size: .88rem;
  color: #222;
  background: #fff;
  transition: border-color .2s, box-shadow .2s;
  height: auto;
}
.fcontrol:focus {
  border-color: var(--c-blue);
  outline: none;
  box-shadow: 0 0 0 3px rgba(41,128,185,.12);
}
.fcontrol[readonly], .fcontrol:disabled {
  background: #f1f5f9;
  color: #888;
  cursor: default;
}
textarea.fcontrol { resize: vertical; min-height: 80px; }

/* Sobreescribir select2 para coincidir */
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
  border: 1.5px solid var(--c-border) !important;
  border-radius: 7px !important;
  min-height: 38px !important;
  font-size: .88rem !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 36px !important;
  padding-left: 12px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
  background: var(--c-dark) !important;
  border: none !important;
  color: #fff !important;
  border-radius: 20px !important;
  padding: 2px 10px !important;
  font-size: .78rem !important;
}
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--focus .select2-selection--multiple {
  border-color: var(--c-blue) !important;
  box-shadow: 0 0 0 3px rgba(41,128,185,.12) !important;
}
.select2-container { width: 100% !important; }

/* ═══════════════════════════════════════════════════════
   TARJETA DE ELEMENTO
═══════════════════════════════════════════════════════ */
.elem-wrap {
  border: 2px solid var(--c-border);
  border-radius: var(--radius);
  margin-bottom: 14px;
  overflow: hidden;
  transition: border-color .3s;
  position: relative;
}
.elem-wrap.guardado     { border-color: var(--c-green); }
.elem-wrap.guardando    { border-color: var(--c-blue);  animation: blink-border 1s infinite; }
.elem-wrap.sin-guardar  { border-color: #e74c3c; }

@keyframes blink-border {
  0%,100% { border-color: var(--c-blue); }
  50%      { border-color: #aed6f1; }
}

.elem-head {
  background: #f7fafd;
  padding: 10px 16px 10px 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid var(--c-border);
}
.elem-head .etitle { font-weight: 700; color: var(--c-dark); font-size: .88rem; }
.elem-badge {
  padding: 3px 10px; border-radius: 20px; font-size: .72rem; font-weight: 700;
}
.badge-sin  { background: #e74c3c; color: #fff; }
.badge-ok   { background: var(--c-green); color: #fff; }
.badge-spin { background: var(--c-blue); color: #fff; }

.elem-body { padding: 16px; }
.elem-remove {
  position: absolute; top: 8px; right: 10px;
  background: #fde; color: var(--c-red);
  border: 1px solid #f5b; border-radius: 50%;
  width: 24px; height: 24px; font-size: .85rem;
  cursor: pointer; display: flex; align-items: center; justify-content: center;
  font-weight: bold; z-index: 5; line-height: 1;
}
.elem-remove:hover { background: var(--c-red); color: #fff; }

/* ═══════════════════════════════════════════════════════
   ZONA DE FOTOS
═══════════════════════════════════════════════════════ */
.foto-zone {
  background: #f8fafd;
  border: 2px dashed var(--c-border);
  border-radius: 8px;
  padding: 14px;
  margin-top: 14px;
}
.foto-btns { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px; }
.btn-foto {
  padding: 7px 16px; border-radius: 20px; font-size: .8rem; font-weight: 600;
  border: none; cursor: pointer;
  display: inline-flex; align-items: center; gap: 6px; transition: all .2s;
}
.btn-foto-cam { background: var(--c-dark); color: #fff; }
.btn-foto-sel { background: var(--c-blue); color: #fff; }
.btn-foto:hover { opacity: .88; transform: translateY(-1px); }

.fotos-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
.foto-item  { position: relative; }
.foto-thumb {
  width: 90px; height: 72px; object-fit: cover;
  border-radius: 6px; border: 2px solid var(--c-border);
  cursor: pointer; display: block;
  transition: transform .2s;
}
.foto-thumb:hover { transform: scale(1.05); border-color: var(--c-blue); }
.foto-del {
  position: absolute; top: -6px; right: -6px;
  background: #e74c3c; color: #fff; border: none;
  border-radius: 50%; width: 19px; height: 19px;
  font-size: .72rem; cursor: pointer;
  display: flex; align-items: center; justify-content: center; font-weight: bold;
}
.foto-del:hover { background: #922b21; }

video.cam-video {
  width: 100%; max-height: 200px; border-radius: 6px;
  margin-bottom: 8px; display: none;
}

/* ═══════════════════════════════════════════════════════
   BOTONES PRINCIPALES
═══════════════════════════════════════════════════════ */
.btn-add-elem {
  background: var(--c-blue); color: #fff;
  border: none; padding: 9px 22px; border-radius: 22px;
  font-weight: 700; font-size: .85rem; cursor: pointer;
  display: inline-flex; align-items: center; gap: 7px;
  transition: all .2s;
}
.btn-add-elem:hover { background: #1a6fa0; transform: translateY(-1px); }

.btn-save-elem {
  background: var(--c-green); color: #fff;
  border: none; padding: 7px 20px; border-radius: 20px;
  font-weight: 700; font-size: .82rem; cursor: pointer;
  display: inline-flex; align-items: center; gap: 6px;
  transition: all .2s;
}
.btn-save-elem:hover  { background: #219a52; }
.btn-save-elem:disabled { background: #aaa; cursor: not-allowed; }

.btn-submit {
  background: linear-gradient(135deg, var(--c-red), #e74c3c);
  color: #fff; border: none; padding: 14px 36px; border-radius: 28px;
  font-weight: 800; font-size: 1rem; cursor: pointer;
  display: inline-flex; align-items: center; gap: 10px;
  box-shadow: 0 4px 18px rgba(192,57,43,.3);
  transition: all .2s;
}
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 22px rgba(192,57,43,.42); }

/* ═══════════════════════════════════════════════════════
   INDICADOR DE GUARDADO
═══════════════════════════════════════════════════════ */
.save-indicator {
  position: fixed; bottom: 24px; right: 24px; z-index: 9999;
  background: var(--c-dark); color: #fff;
  padding: 10px 20px; border-radius: 24px;
  font-size: .85rem; font-weight: 600;
  display: none; align-items: center; gap: 8px;
  box-shadow: 0 4px 18px rgba(0,0,0,.2);
}
.save-indicator.visible { display: flex; animation: fadeInUp .3s; }
@keyframes fadeInUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

/* info tip */
.tip {
  background: #eaf4fb; border: 1px solid #aed6f1;
  border-radius: 7px; padding: 9px 14px;
  font-size: .82rem; color: #1a5276; margin-bottom: 14px;
}
.tip i { margin-right: 4px; }

/* fila de grupo */
.fgroup { margin-bottom: 14px; }

/* ═══════════════════════════════════════════════════════
   BANNER DESPACHO YA REGISTRADO
═══════════════════════════════════════════════════════ */
.banner-dup {
  display: none;
  background: linear-gradient(135deg, #c0392b, #e74c3c);
  color: #fff;
  border-radius: 10px;
  padding: 18px 22px;
  margin-bottom: 4px;
  align-items: flex-start;
  gap: 16px;
  box-shadow: 0 4px 18px rgba(192,57,43,.3);
  animation: slideIn .35s ease;
}
.banner-dup.visible { display: flex; }
@keyframes slideIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
.banner-dup-icon { font-size: 2.2rem; line-height: 1; flex-shrink: 0; }
.banner-dup-body h5 { margin: 0 0 4px; font-size: 1rem; font-weight: 800; }
.banner-dup-body p  { margin: 0 0 10px; font-size: .85rem; opacity: .92; }
.banner-dup-info {
  display: flex; flex-wrap: wrap; gap: 6px 18px;
  font-size: .8rem; background: rgba(0,0,0,.15);
  padding: 8px 12px; border-radius: 7px; margin-bottom: 10px;
}
.banner-dup-info span { display: flex; align-items: center; gap: 4px; }
.btn-ver-dup {
  background: #fff; color: #c0392b;
  border: none; padding: 8px 20px; border-radius: 22px;
  font-weight: 700; font-size: .85rem; cursor: pointer;
  display: inline-flex; align-items: center; gap: 6px;
  text-decoration: none; transition: all .2s;
}
.btn-ver-dup:hover { background: #fde; color: #922b21; }

/* Bloqueo del resto del formulario */
.form-bloqueado {
  pointer-events: none;
  opacity: .45;
  user-select: none;
  position: relative;
}
.form-bloqueado::after {
  content: '';
  position: absolute; inset: 0;
  background: repeating-linear-gradient(45deg, transparent, transparent 8px, rgba(200,0,0,.04) 8px, rgba(200,0,0,.04) 16px);
  border-radius: 10px;
  z-index: 10;
}
</style>
@endpush

@section('content')

{{-- ── ENCABEZADO ── --}}
<div class="sin-page-header">
  <div>
    <h2><i class="fa fa-exclamation-triangle"></i>&nbsp; Registrar Nuevo Siniestro</h2>
    <small>Diligencie todos los campos y guarde cada elemento antes de enviar</small>
  </div>
  <div class="consec-display" id="consec-display">
    <small>No. Siniestro</small>
    —
  </div>
</div>

<input type="hidden" id="siniestro_id">

<div style="max-width:1080px; margin:0 auto; padding-bottom:80px;">

  {{-- ══════════════════════════════════════════
       SECCIÓN 1 – INFORMACIÓN GENERAL
  ══════════════════════════════════════════ --}}
  <div class="sin-card">
    <div class="sin-card-head">
      <i class="fa fa-calendar-check-o fa-lg"></i>
      <h4>Información General</h4>
    </div>
    <div class="sin-card-body">
      <div class="row">
        <div class="col-sm-4 fgroup">
          <label class="flabel">Fecha del Siniestro <span class="req">*</span></label>
          <input type="date" id="fecha_siniestro" class="fcontrol" value="{{ date('Y-m-d') }}">
        </div>
        <div class="col-sm-4 fgroup">
          <label class="flabel">Registrado por</label>
          <input type="text" class="fcontrol" value="{{ auth()->user()->name }} {{ auth()->user()->lastname }}" readonly>
        </div>
        <div class="col-sm-4 fgroup">
          <label class="flabel">Fecha Registro</label>
          <input type="text" class="fcontrol" value="{{ now()->format('d/m/Y H:i') }}" readonly>
        </div>
      </div>
    </div>
  </div>

  {{-- ══════════════════════════════════════════
       SECCIÓN 2 – DESPACHO
  ══════════════════════════════════════════ --}}
  <div class="sin-card">
    <div class="sin-card-head">
      <i class="fa fa-building fa-lg"></i>
      <h4>Despacho</h4>
    </div>
    <div class="sin-card-body">
      <div class="tip">
        <i class="fa fa-search"></i>
        Escriba para buscar el despacho por nombre o código. Los demás campos se llenan automáticamente.
      </div>
      <div class="row">
        <div class="col-sm-12 fgroup">
          <label class="flabel">Buscar Despacho <span class="req">*</span></label>
          <select id="sel-despacho" class="fcontrol select2" style="width: 100%;" onchange="onDespachoSeleccionado($(this).find(':selected'))">
            <option value="">Escriba para buscar...</option>
            @foreach($despachos as $d)
              <option value="{{ $d->codigoDespacho }}"
                data-nombre="{{ $d->nombreDespacho }}"
                data-correo="{{ $d->correoD }}"
                data-dir="{{ $d->direccion ?? '' }}"
                data-ciudad="{{ $d->ciudad ?? '' }}"
                data-telefono="{{ $d->telefono ?? '' }}"
                data-registrado="{{ in_array($d->codigoDespacho, $despachosRegistrados) ? '1' : '0' }}"
              >{{ $d->nombreDespacho }} ({{ $d->codigoDespacho }}){{ in_array($d->codigoDespacho, $despachosRegistrados) ? ' ✓ YA REGISTRADO' : '' }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- Banner: despacho ya registrado --}}
      <div class="banner-dup" id="banner-dup" role="alert">
        <div class="banner-dup-icon">🚫</div>
        <div class="banner-dup-body">
          <h5>Este despacho ya tiene un siniestro registrado</h5>
          <div class="banner-dup-info" id="dup-info">
            <span>📋 No. <strong id="dup-consec">—</strong></span>
            <span>📅 Fecha: <strong id="dup-fecha">—</strong></span>
            <span>🏷 Estado: <strong id="dup-estado">—</strong></span>
            <span>📦 Elementos: <strong id="dup-elem">—</strong></span>
          </div>
          <p>Solo se permite <strong>un siniestro por despacho</strong>. Para ver o modificar el existente, use el botón de abajo.</p>
          <a href="#" id="dup-link" class="btn-ver-dup" target="_blank">
            <i class="fa fa-eye"></i> Ver Siniestro Existente
          </a>
        </div>
      </div>
      <div class="row" id="despacho-info" style="display:none; margin-top:4px;">
        <div class="col-sm-2 fgroup">
          <label class="flabel">Código</label>
          <input type="text" id="d-codigo" class="fcontrol" readonly>
        </div>
        <div class="col-sm-5 fgroup">
          <label class="flabel">Nombre</label>
          <input type="text" id="d-nombre" class="fcontrol" readonly>
        </div>
        <div class="col-sm-3 fgroup">
          <label class="flabel">Ciudad</label>
          <input type="text" id="d-ciudad" class="fcontrol" readonly>
        </div>
        <div class="col-sm-2 fgroup">
          <label class="flabel">Teléfono</label>
          <input type="text" id="d-telefono" class="fcontrol" readonly>
        </div>
        <div class="col-sm-6 fgroup">
          <label class="flabel">Dirección</label>
          <input type="text" id="d-dir" class="fcontrol" readonly>
        </div>
        <div class="col-sm-6 fgroup">
          <label class="flabel">Correo del Despacho</label>
          <input type="text" id="d-correo" class="fcontrol" readonly>
        </div>
      </div>
    </div>
  </div>

  {{-- ══════════════════════════════════════════
       SECCIÓN 3 – TITULAR + EMPLEADOS
  ══════════════════════════════════════════ --}}
  <div class="sin-card" id="sec-titular-emp">
    <div class="sin-card-head">
      <i class="fa fa-user fa-lg"></i>
      <h4>Titular y Empleados Involucrados</h4>
    </div>
    <div class="sin-card-body">
      <div class="row">
        <!-- TITULAR DEL DESPACHO -->
        <div class="col-sm-6">
          <div class="tip"><i class="fa fa-info-circle"></i> Ingrese la cédula del titular y presione Enter o Buscar.</div>
          <div class="row">
            <div class="col-sm-6 fgroup">
              <label class="flabel">Cédula Titular</label>
              <div style="display:flex; gap:6px;">
                <input type="text" id="t-cedula" class="fcontrol" placeholder="Cédula" onkeypress="if(event.key==='Enter') buscarTitular()">
                <button type="button" class="btn btn-primary" onclick="buscarTitular()" style="border-radius:7px; padding:6px 12px;"><i class="fa fa-search"></i></button>
              </div>
            </div>
            <div class="col-sm-6 fgroup">
              <label class="flabel">Nombre</label>
              <input type="text" id="t-nombre" class="fcontrol" readonly placeholder="Autocompletado">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 fgroup">
              <label class="flabel">Cargo</label>
              <input type="text" id="t-cargo" class="fcontrol" readonly placeholder="Autocompletado">
            </div>
            <div class="col-sm-6 fgroup">
              <label class="flabel">Correo</label>
              <input type="email" id="t-correo" class="fcontrol" placeholder="Opcional">
            </div>
          </div>
        </div>

        <!-- EMPLEADOS INVOLUCRADOS -->
        <div class="col-sm-6" style="border-left: 1px solid var(--c-border); padding-left:20px;">
          <div class="tip"><i class="fa fa-users"></i> Agregue empleados involucrados buscando por cédula.</div>
          <div class="row">
            <div class="col-sm-6 fgroup">
              <label class="flabel">Cédula Empleado</label>
              <div style="display:flex; gap:6px;">
                <input type="text" id="emp-cedula-buscar" class="fcontrol" placeholder="Cédula" onkeypress="if(event.key==='Enter') buscarYAgregarEmpleado()">
                <button type="button" class="btn btn-primary" onclick="buscarYAgregarEmpleado()" style="border-radius:7px; padding:6px 12px;"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </div>
          <!-- Lista de empleados agregados -->
          <div id="lista-empleados-agregados" style="display:flex; flex-direction:column; gap:8px; margin-top:8px;">
            <span style="font-size:.8rem; color:#888;" id="emp-empty-msg">No hay empleados agregados.</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ══════════════════════════════════════════
       SECCIÓN 4 – ELEMENTOS AFECTADOS
  ══════════════════════════════════════════ --}}
  <div class="sin-card" id="sec-elementos">
    <div class="sin-card-head">
      <i class="fa fa-laptop fa-lg"></i>
      <h4>Elementos Afectados <span id="elem-count-badge" style="font-size:.75rem; background:rgba(255,255,255,.2); padding:2px 10px; border-radius:20px; margin-left:8px;">0 guardados</span></h4>
    </div>
    <div class="sin-card-body">
      <div class="tip">
        <i class="fa fa-lightbulb-o"></i>
        <strong>Guardado progresivo:</strong> Cada elemento se guarda de forma independiente al presionar
        <strong>"Guardar Elemento"</strong>. Puede agregar fotos después de guardar.
      </div>

      {{-- Contenedor dinámico --}}
      <div id="elementos-container"></div>

      <button type="button" class="btn-add-elem" onclick="agregarElemento()" id="btn-add-elem">
        <i class="fa fa-plus-circle"></i> Agregar Elemento Afectado
      </button>
    </div>
  </div>

  {{-- ══════════════════════════════════════════
       SECCIÓN 5 – OBSERVACIONES + FINALIZAR
  ══════════════════════════════════════════ --}}
  <div class="sin-card" id="sec-finalizar">
    <div class="sin-card-head">
      <i class="fa fa-pencil fa-lg"></i>
      <h4>Observaciones Generales y Envío</h4>
    </div>
    <div class="sin-card-body">
      <div class="row">
        <div class="col-sm-12 fgroup">
          <label class="flabel">Observaciones Generales del Siniestro</label>
          <textarea id="observaciones_generales" class="fcontrol" rows="3"
            placeholder="Describa las circunstancias del siniestro, daños generales, acciones tomadas, recomendaciones..."></textarea>
        </div>
      </div>
      <div class="row" style="margin-top:15px;">
        <div class="col-sm-6 fgroup">
          <label class="flabel">URL de Fotos / Archivos <span style="font-weight:normal;color:#888;">(Si no se suben fotos)</span></label>
          <input type="url" id="url_fotos" class="fcontrol" placeholder="https://drive.google.com/...">
        </div>
        <div class="col-sm-6 fgroup">
          <label class="flabel">Firma del Empleado (Opcional)</label>
          <div style="border: 1.5px solid var(--c-border); background: #fff; border-radius: 7px; overflow:hidden;">
            <canvas id="firma-pad" style="width: 100%; height: 160px; cursor: crosshair; touch-action: none;"></canvas>
          </div>
          <button type="button" class="btn btn-sm btn-default" onclick="limpiarFirma()" style="margin-top: 5px; border-radius:6px; font-size:.8rem;">
            <i class="fa fa-eraser"></i> Limpiar Firma
          </button>
        </div>
      </div>

      <div style="text-align:center; padding-top:12px;">
        <button type="button" class="btn-submit" onclick="finalizarSiniestro()">
          <i class="fa fa-paper-plane"></i>
          Registrar y Enviar Siniestro
        </button>
        <p style="margin-top:10px; font-size:.78rem; color:#888;">
          Se generará el PDF y se enviará correo automáticamente al despacho.
        </p>
      </div>
    </div>
  </div>

</div>

{{-- Indicador flotante de guardado --}}
<div class="save-indicator" id="save-indicator">
  <i class="fa fa-check-circle"></i>
  <span id="save-msg">Guardado</span>
</div>

@endsection

@push('scripts')
{{-- Select2 ya está cargado en el layout --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
let signaturePad;

document.addEventListener("DOMContentLoaded", function() {
    const canvas = document.getElementById('firma-pad');
    if(canvas) {
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            if (signaturePad) signaturePad.clear(); // clear on resize to avoid distortion
        }
        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();
        signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 1)'
        });
    }
});

function limpiarFirma() {
    if(signaturePad) signaturePad.clear();
}

// ═══════════════════════════════════════════════════════
// ESTADO GLOBAL
// ═══════════════════════════════════════════════════════
let siniestroId      = null;
let elementoCount    = 0;
let elemGuardados    = {};   // { localIdx: elementoId }
let inventarioCache  = [];
let empleadosCache   = [];
let streamActivo     = null;

const CSRF = () => document.querySelector('meta[name="csrf-token"]')?.content || '';

// ═══════════════════════════════════════════════════════
// SOPORTE CAMARA GLOBAL
// ═══════════════════════════════════════════════════════
const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || navigator.mozGetUserMedia || navigator.mediaDevices?.getUserMedia || navigator.webkitGetUserMedia || navigator.msGetUserMedia);

const _getUserMedia = (...args) => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        return navigator.mediaDevices.getUserMedia(args[0]).then(args[1]).catch(args[2]);
    } else {
        return (navigator.getUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, args);
    }
};

const obtenerDispositivos = () => navigator.mediaDevices && navigator.mediaDevices.enumerateDevices ? navigator.mediaDevices.enumerateDevices() : Promise.resolve([]);




// ═══════════════════════════════════════════════════════
// LÓGICA DESPACHO
// ═══════════════════════════════════════════════════════

// Lista de códigos ya registrados (del servidor)
const DESPACHOS_REGISTRADOS = @json($despachosRegistrados);

function onDespachoSeleccionado($opt) {
  const codigo = $opt.val();
  const nombre = $opt.data('nombre') || $opt.text().split('(')[0].trim();
  const correo = $opt.data('correo') || '';
  const dir    = $opt.data('dir')    || '';
  const ciudad = $opt.data('ciudad') || '';
  const telefono = $opt.data('telefono') || '';

  ocultarBannerDuplicado();
  verificarDespacho(codigo, nombre, correo, dir, ciudad, telefono);
}

async function verificarDespacho(codigo, nombre, correo, dir, ciudad, telefono) {
  $('#d-codigo').val(codigo);
  $('#d-nombre').val(nombre);
  $('#d-correo').val(correo);
  $('#d-dir').val(dir);
  $('#d-ciudad').val(ciudad);
  $('#d-telefono').val(telefono);
  $('#despacho-info').slideDown(200);

  try {
    const data = await fetch(`{{ url('/encuesta/siniestro/ajax/verificar') }}/${codigo}`, {
      headers: { 'Accept': 'application/json' }
    }).then(r => r.json());

    if (data.registrado) {
      mostrarBannerDuplicado(data);
      return; 
    }
  } catch(e) { console.warn('Verificación fallida:', e); }

  if (siniestroId) actualizarCabecera();
}

// ═══════════════════════════════════════════════════════
// LÓGICA TITULAR Y EMPLEADOS (NUEVA)
// ═══════════════════════════════════════════════════════

async function buscarTitular() {
  const ced = $('#t-cedula').val().trim();
  if (!ced) return;
  const btn = $('#t-cedula').next('button');
  btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
  
  try {
    const r = await fetch(`{{ url('/encuesta/siniestro/ajax/empleado/cedula') }}/${ced}`).then(res=>res.json());
    if (r.ok) {
      $('#t-nombre').val(r.empleado.nombre);
      $('#t-cargo').val(r.empleado.cargo);
      $('#t-correo').focus();
      scheduleAutosave();
    } else {
      Swal.fire('No encontrado', 'No se encontró un empleado activo con esa cédula.', 'info');
      $('#t-nombre, #t-cargo').val('');
    }
  } catch(e) {
    console.error(e);
  } finally {
    btn.html('<i class="fa fa-search"></i>').prop('disabled', false);
  }
}

let empleadosAgregados = [];

async function buscarYAgregarEmpleado() {
  const ced = $('#emp-cedula-buscar').val().trim();
  if (!ced) return;
  
  if (empleadosAgregados.find(e => e.cedula === ced)) {
    Swal.fire('Atención', 'Este empleado ya fue agregado.', 'warning');
    $('#emp-cedula-buscar').val('').focus();
    return;
  }

  const btn = $('#emp-cedula-buscar').next('button');
  btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
  
  try {
    const r = await fetch(`{{ url('/encuesta/siniestro/ajax/empleado/cedula') }}/${ced}`).then(res=>res.json());
    if (r.ok) {
      empleadosAgregados.push(r.empleado);
      renderizarEmpleados();
      $('#emp-cedula-buscar').val('').focus();
      scheduleAutosave();
    } else {
      Swal.fire('No encontrado', 'No se encontró un empleado activo con esa cédula.', 'info');
    }
  } catch(e) {
    console.error(e);
  } finally {
    btn.html('<i class="fa fa-plus"></i>').prop('disabled', false);
  }
}

function renderizarEmpleados() {
  const container = document.getElementById('lista-empleados-agregados');
  if (empleadosAgregados.length === 0) {
    container.innerHTML = `<span style="font-size:.8rem; color:#888;" id="emp-empty-msg">No hay empleados agregados.</span>`;
    return;
  }
  
  container.innerHTML = empleadosAgregados.map((emp, i) => `
    <div style="display:flex; justify-content:space-between; align-items:center; background:#f4f6fb; padding:8px 12px; border:1px solid #dde4ef; border-radius:6px;">
      <div>
        <strong style="font-size:.85rem;">${emp.nombre}</strong><br>
        <span style="font-size:.75rem; color:#666;">C.C: ${emp.cedula} &nbsp;|&nbsp; Cargo: ${emp.cargo}</span>
      </div>
      <button type="button" class="btn btn-sm btn-danger" onclick="quitarEmpleado(${i})" style="padding:2px 8px;"><i class="fa fa-trash"></i></button>
    </div>
  `).join('');
}

function quitarEmpleado(index) {
  empleadosAgregados.splice(index, 1);
  renderizarEmpleados();
  scheduleAutosave();
}

function mostrarBannerDuplicado(data) {
  // Rellenar datos del banner
  document.getElementById('dup-consec').textContent = data.consecutivo || '—';
  document.getElementById('dup-fecha').textContent  = data.fecha       || '—';
  document.getElementById('dup-estado').textContent = data.estado      || '—';
  document.getElementById('dup-elem').textContent   = data.elementos ?? '—';
  document.getElementById('dup-link').href          = data.siniestro_url || '#';

  // Mostrar banner
  const banner = document.getElementById('banner-dup');
  banner.classList.add('visible');

  // Bloquear las secciones del formulario (titular, empleados, elementos, finalizar)
  ['sec-titular-emp', 'sec-elementos', 'sec-finalizar'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.classList.add('form-bloqueado');
  });

  // Desactivar botón de agregar elemento y submit
  document.getElementById('btn-add-elem').disabled = true;

  // Scroll al banner
  banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function ocultarBannerDuplicado() {
  document.getElementById('banner-dup').classList.remove('visible');
  ['sec-titular-emp', 'sec-elementos', 'sec-finalizar'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.classList.remove('form-bloqueado');
  });
  const btnAdd = document.getElementById('btn-add-elem');
  if (btnAdd) btnAdd.disabled = false;
}

function limpiarDespacho() {
  $('#d-codigo, #d-nombre, #d-ciudad, #d-telefono, #d-dir, #d-correo').val('');
  $('#despacho-info').slideUp(200);
  
  $('#t-cedula, #t-nombre, #t-cargo, #t-correo, #emp-cedula-buscar').val('');
  empleadosAgregados = [];
  renderizarEmpleados();
}

// ═══════════════════════════════════════════════════════
// GUARDAR / ACTUALIZAR CABECERA (AJAX silencioso)
// ═══════════════════════════════════════════════════════
async function guardarOActualizarCabecera() {
  const fecha = document.getElementById('fecha_siniestro').value;
  const codigo = $('#d-codigo').val();

  if (!fecha || !codigo) return null; // nada que guardar

  const datos = {
    siniestro_id:       siniestroId,
    fecha_siniestro:    fecha,
    despacho_codigo:    codigo,
    despacho_nombre:    $('#d-nombre').val(),
    despacho_correo:    $('#d-correo').val(),
    despacho_ciudad:    $('#d-ciudad').val(),
    despacho_direccion: $('#d-dir').val(),
    titular_nombre:     $('#t-nombre').val(),
    titular_cedula:     $('#t-cedula').val(),
    titular_cargo:      $('#t-cargo').val(),
    titular_correo:     $('#t-correo').val(),
    empleados:          JSON.stringify(empleadosAgregados),
    observaciones_generales: $('#observaciones_generales').val(),
  };

  const resp = await fetch('{{ route("encuesta.siniestro.store") }}', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': CSRF(),
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(datos)
  }).then(r => r.json());

  if (resp.ok) {
    siniestroId = resp.siniestro_id;
    document.getElementById('siniestro_id').value = siniestroId;
    document.getElementById('consec-display').innerHTML = `<small>No. Siniestro</small>${resp.consecutivo}`;
    mostrarIndicador('✅ Información guardada');
  }
  return resp;
}

function actualizarCabecera() {
  // Actualizar sin mostrar alerta
  guardarOActualizarCabecera();
}

// ═══════════════════════════════════════════════════════
// MOSTRAR INDICADOR FLOTANTE
// ═══════════════════════════════════════════════════════
let _indTimer;
function mostrarIndicador(msg) {
  const el = document.getElementById('save-indicator');
  const ms = document.getElementById('save-msg');
  ms.textContent = msg;
  el.classList.add('visible');
  clearTimeout(_indTimer);
  _indTimer = setTimeout(() => el.classList.remove('visible'), 2500);
}

// ═══════════════════════════════════════════════════════
// AGREGAR ELEMENTO
// ═══════════════════════════════════════════════════════
const opcionesElementosHTML = `
  <option value="">Seleccione...</option>
  <option>ACCESS POINT UNIFI</option>
  <option>AIRE ACONDICIONADO</option>
  <option>ALICATE</option>
  <option>ALMACENAMIENTO NAS</option>
  <option>ALTAVOCES</option>
  <option>AMPLIFICADOR DE AUDIO</option>
  <option>ANDAMIO CERTIFICADO</option>
  <option>ARCHIVADOR</option>
  <option>ARCO DETECTOR DE METALES</option>
  <option>ASCENSORES</option>
  <option>ASIGNADOR DE TURNOS (DIGITURNO)</option>
  <option>ASTA PARA BANDERA</option>
  <option>AUDIFONOS</option>
  <option>AUTOMOVIL</option>
  <option>BAFLE</option>
  <option>BALSA SALVAVIDAS</option>
  <option>BANDEJAS DE EQUIPOS PARA SOPORTAR EQUIPOS CCTV</option>
  <option>BARANDA EN MADERA</option>
  <option>BASCULA ELECTRONICA INALAMBRICA CAP.300KG</option>
  <option>BASE</option>
  <option>BIBLIOTECA</option>
  <option>BOMBA PARA SUMINISTRO DE COMBUSTIBLE</option>
  <option>BOTIQUIN BRIGADISTA</option>
  <option>BUTACO CROMADO Y PLASTICO</option>
  <option>CAJA METALICA DE SEGURIDAD</option>
  <option>CAJA PARA HERRAMIENTAS</option>
  <option>CALCULADORA</option>
  <option>CAMARA</option>
  <option>CAMILLA PRIMEROS AUXILIOS</option>
  <option>CAMIONETA</option>
  <option>CAMPERO</option>
  <option>CARGADOR DE BATERIAS</option>
  <option>CARRETILLA</option>
  <option>CARRO DE SERVICIO DE CAFETERIA</option>
  <option>CAFETERA</option>
  <option>CARPA</option>
  <option>CCTV</option>
  <option>CHALECO BLINDADO</option>
  <option>CODEC</option>
  <option>COMPRESOR</option>
  <option>COMPUTADOR TODO EN UNO</option>
  <option>CONSOLA DE SONIDO</option>
  <option>CONTENEDOR (CANECA) PARA BASURA PLASTICO</option>
  <option>CONTROL DE ACCESO CON LECTOR BIOMETRICO</option>
  <option>CONTROLADOR INALAMBRICO</option>
  <option>CORTINA</option>
  <option>COSEDORA</option>
  <option>CPU</option>
  <option>DIADEMA USB</option>
  <option>DIADEMA LABORAL</option>
  <option>DESHUMIDIFICADOR PORTATIL</option>
  <option>DETECTOR SONIDO ILUMINADO</option>
  <option>DIADEMA PARA COMPUTADOR</option>
  <option>DISCO DURO EXTERNO</option>
  <option>DISPENSADOR DE AGUA</option>
  <option>DIVISION EN MODULAR PARA ESPACIOS</option>
  <option>ELECTROBOMBA</option>
  <option>EQUIPO DE CAFETERIA</option>
  <option>EQUIPO DE VIDEOCONFERENCIA</option>
  <option>ESCALERA</option>
  <option>ESCANER</option>
  <option>ESCRITORIO</option>
  <option>ESCUDO</option>
  <option>ESTACION DE TRABAJO</option>
  <option>ESTANTERIA</option>
  <option>ESTRADO</option>
  <option>EXTINTOR</option>
  <option>FAX</option>
  <option>FOTOCOPIADORA</option>
  <option>FUMIGADORA</option>
  <option>GABINETE</option>
  <option>GARRET</option>
  <option>GATO</option>
  <option>GRABADORA</option>
  <option>GUADAÑADORA</option>
  <option>GUILLOTINA</option>
  <option>IMPRESORA</option>
  <option>JUEGO DE ALCOBA</option>
  <option>JUEGO DE DESTORNILLADORES</option>
  <option>JUEGO DE SALA</option>
  <option>LAVAMANOS PORTATIL TOTALMENTE AUTONOMO</option>
  <option>LECTOR CODIGO DE BARRA</option>
  <option>LLAVERO ELECTRICO</option>
  <option>LINTERNA</option>
  <option>LLAVES ALLEN</option>
  <option>LOCALIZADOR</option>
  <option>LOCIONERA</option>
  <option>MAQUINA DE ESCRIBIR</option>
  <option>MARTILLO</option>
  <option>MATRIZ DE VIDEO</option>
  <option>MICROONDAS</option>
  <option>MESA</option>
  <option>MOTOR</option>
  <option>MEZCLADOR</option>
  <option>MICROFONO</option>
  <option>MODULO</option>
  <option>MOLINETE</option>
  <option>MONITOR</option>
  <option>MOTOCICLETA</option>
  <option>MOSTRADOR</option>
  <option>MOTOBOMBA DE AGUA POTABLE</option>
  <option>MOUSE</option>
  <option>MUEBLE</option>
  <option>MULTIMETRO DIGITAL</option>
  <option>NEVERA</option>
  <option>NUMERADOR AUTOMATICO 6 DIGITOS</option>
  <option>ODOMETRO MEDIDOR DE DISTANCIA</option>
  <option>ORGANIZADOR DE TORNILLOS</option>
  <option>PANTALLA VIDEOPROYECCION</option>
  <option>PAPELERA</option>
  <option>PARASOL</option>
  <option>PARLANTES</option>
  <option>PERCHERO - PARAGUERO - ROPERO</option>
  <option>PERFORADORA</option>
  <option>PERSIANA VERTICAL</option>
  <option>PISCINA</option>
  <option>PIZARRA</option>
  <option>PUNTO A PARA PINTURA ALTA CAPACIDAD</option>
  <option>PLACAS ACTIVO</option>
  <option>PLANTA ELECTRICA</option>
  <option>POLTRONA</option>
  <option>PONCHADORA PARA CABLE UTP</option>
  <option>PORTATIL</option>
  <option>PROCESADOR</option>
  <option>PROYECTOR WIFI</option>
  <option>PUESTO DE TRABAJO</option>
  <option>PULIDORA</option>
  <option>RACK</option>
  <option>RADIO TRANSMISOR - PORTATIL</option>
  <option>REGULADOR</option>
  <option>RELOJ CONTROL CORRESPONDENCIA</option>
  <option>REPISA METALICA</option>
  <option>RUTEADOR</option>
  <option>SACAGANCHOS</option>
  <option>SERVIDOR TIPO RACK</option>
  <option>SIRENAS</option>
  <option>SILLA</option>
  <option>SISTEMA ALMACENAMIENTO NAS</option>
  <option>SISTEMA DE SEGURIDAD Y CONTROL DE ACCESO</option>
  <option>SOFA</option>
  <option>SOLDADOR INVERSOR</option>
  <option>SONDA ELECTRICA PARA DESTAPAR CAÑERIAS</option>
  <option>SOPLADORA-ASPIRADORA</option>
  <option>SOPORTE</option>
  <option>SUBESTACION ELECTRICA</option>
  <option>SWITCH</option>
  <option>TABLERO</option>
  <option>TALADRO MANUAL</option>
  <option>TALADRO</option>
  <option>TAMBOR</option>
  <option>TANQUE DE POLIETILENO</option>
  <option>TECLADO</option>
  <option>TELEFAX</option>
  <option>TELEFONO</option>
  <option>TELEVISOR</option>
  <option>TIJERA</option>
  <option>TRINCHERO</option>
  <option>TRAILER DE CARGA</option>
  <option>TRANSFORMADOR</option>
  <option>TRANSMISOR Y RECEPTOR BLUETOOTH</option>
  <option>UNIDAD CENTRAL DE CONFERENCIA</option>
  <option>UNIDAD DE DVD EXTERNA USB</option>
  <option>UPS</option>
  <option>VALLA SEPARADORA</option>
  <option>VENTILADOR</option>
  <option>DVR</option>
  <option>VIDEO PROYECTOR</option>
  <option>VITRINA</option>
  <option>WORKSTATION</option>
`;

function agregarElemento() {
  elementoCount++;
  const idx = elementoCount;

  const html = `
<div class="elem-wrap sin-guardar" id="ew-${idx}">
  <button type="button" class="elem-remove" onclick="removerElemento(${idx})" title="Quitar elemento">×</button>

  <div class="elem-head">
    <span class="etitle"><i class="fa fa-cube"></i>&nbsp; Elemento&nbsp;${idx}</span>
    <span class="elem-badge badge-sin" id="eb-${idx}">⚠ Sin guardar</span>
  </div>

  <div class="elem-body">
    <input type="hidden" id="ei-${idx}">

    <div class="row">
      <div class="col-sm-4 fgroup">
        <label class="flabel">Tipo de Elemento <span class="req">*</span></label>
        <select id="et-${idx}" class="fcontrol">
          ${opcionesElementosHTML}
        </select>
      </div>
      <div class="col-sm-4 fgroup">
        <label class="flabel">Placa / No. Inventario</label>
        <input type="text" id="ep-${idx}" class="fcontrol" placeholder="Placa activo fijo">
      </div>
      <div class="col-sm-4 fgroup">
        <label class="flabel">Serial</label>
        <input type="text" id="es-${idx}" class="fcontrol" placeholder="No. de serie">
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 fgroup">
        <label class="flabel">Estado del Elemento</label>
        <input type="text" id="ed-${idx}" class="fcontrol" placeholder="Describa el estado actual o daño...">
      </div>
    </div>

    <div class="fgroup">
      <label class="flabel">Observaciones Adicionales</label>
      <textarea id="eo-${idx}" class="fcontrol" rows="2" placeholder="Otras observaciones..."></textarea>
    </div>

    <div style="text-align:right; margin-top:6px;">
      <button type="button" class="btn-save-elem" id="bs-${idx}" onclick="guardarElemento(${idx})">
        <i class="fa fa-save"></i> Guardar Elemento ${idx}
      </button>
    </div>

    <!-- Zona de fotos -->
    <div id="fz-${idx}" style="margin-top:15px; padding-top:15px; border-top:1px dashed #ccc;">
      <div class="foto-zone">
        <div class="foto-btns">
          <button type="button" class="btn-foto btn-foto-cam" onclick="abrirCamara(${idx})">
            <i class="fa fa-camera"></i> Tomar Foto
          </button>
          <button type="button" class="btn-foto btn-foto-sel" onclick="abrirSeleccionImagen(${idx})">
            <i class="fa fa-image"></i> Seleccionar Imagen
          </button>
        </div>
        <video id="fv-${idx}" class="cam-video" autoplay playsinline></video>
        <select class='fcontrol' id="listaDeDispositivos-${idx}" style="display:none; margin-bottom:8px;"></select>
        <div id="fcb-${idx}" style="display:none; margin-bottom:8px; gap:8px;">
          <button type="button" class="btn-foto btn-foto-cam" onclick="capturarFoto(${idx})">
            <i class="fa fa-circle"></i> Capturar
          </button>
          <button type="button" class="btn btn-default btn-xs" onclick="cerrarCamara(${idx})">Cancelar</button>
        </div>
        <input type="file" id="fi-${idx}" accept="image/*" style="display:none;" onchange="fotoSeleccionada(${idx}, this)">
        <div class="fotos-grid" id="fg-${idx}"></div>
        <p id="fc-${idx}" style="font-size:.75rem; color:#aaa; margin-top:4px;"></p>
      </div>
    </div>
  </div>
</div>`;

  document.getElementById('elementos-container').insertAdjacentHTML('beforeend', html);

  // Inicializar Select2 para permitir filtrado (buscador)
  if (typeof jQuery !== 'undefined' && jQuery.fn.select2) {
    jQuery(`#et-${idx}`).select2({
      placeholder: "Seleccione un elemento...",
      allowClear: true,
      width: '100%'
    });
  }

  // Scroll al nuevo elemento
  setTimeout(() => {
    document.getElementById(`ew-${idx}`).scrollIntoView({ behavior: 'smooth', block: 'center' });
    document.getElementById(`et-${idx}`).focus();
  }, 120);
}


function removerElemento(idx) {
  if (elemGuardados[idx]) {
    Swal.fire({
      title: '¿Eliminar elemento?',
      text: 'Este elemento ya fue guardado.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#c0392b',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then(r => {
      if (r.isConfirmed) document.getElementById(`ew-${idx}`)?.remove();
    });
    return;
  }
  document.getElementById(`ew-${idx}`)?.remove();
}

// ═══════════════════════════════════════════════════════
// GUARDAR ELEMENTO (AJAX progresivo)
// ═══════════════════════════════════════════════════════
async function guardarElemento(idx) {
  const elTipo = document.getElementById(`et-${idx}`);
  const tipo = elTipo ? elTipo.value.trim() : '';

  if (!tipo) {
    Swal.fire('Atención', 'El tipo de elemento es obligatorio.', 'warning');
    return;
  }


  // Asegurar que la cabecera esté guardada
  if (!siniestroId) {
    const r = await guardarOActualizarCabecera();
    if (!r || !r.ok) {
      Swal.fire('Atención', 'Complete y guarde la información general primero.', 'warning');
      return;
    }
  }

  const btn = document.getElementById(`bs-${idx}`);
  const ew  = document.getElementById(`ew-${idx}`);
  const eb  = document.getElementById(`eb-${idx}`);

  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
  ew.classList.remove('sin-guardar', 'guardado');
  ew.classList.add('guardando');
  eb.className = 'elem-badge badge-spin';
  eb.textContent = '⟳ Guardando...';

  const datos = {
    siniestro_id:    siniestroId,
    elemento_id:     document.getElementById(`ei-${idx}`).value || null,
    tipo_elemento:   tipo,
    placa:           document.getElementById(`ep-${idx}`) ? document.getElementById(`ep-${idx}`).value : '',
    serial:          document.getElementById(`es-${idx}`) ? document.getElementById(`es-${idx}`).value : '',
    descripcion_dano:document.getElementById(`ed-${idx}`) ? document.getElementById(`ed-${idx}`).value : '',
    observaciones:   document.getElementById(`eo-${idx}`) ? document.getElementById(`eo-${idx}`).value : '',
  };

  try {
    const data = await fetch('{{ route("encuesta.siniestro.elemento.store") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': CSRF(),
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(datos)
    }).then(r => r.json());

    btn.disabled = false;
    ew.classList.remove('guardando');

    if (data.ok) {
      document.getElementById(`ei-${idx}`).value = data.elemento_id;
      elemGuardados[idx] = data.elemento_id;

      ew.classList.add('guardado');
      eb.className = 'elem-badge badge-ok';
      eb.textContent = '✅ Guardado';
      btn.innerHTML = `<i class="fa fa-refresh"></i> Actualizar Elemento ${idx}`;

      // Mostrar zona de fotos
      document.getElementById(`fz-${idx}`).style.display = 'block';

      // Actualizar badge de elemento guardados
      const count = Object.keys(elemGuardados).length;
      document.getElementById('elem-count-badge').textContent = `${count} guardado(s)`;

      mostrarIndicador(`✅ Elemento ${idx} guardado`);
    } else {
      ew.classList.add('sin-guardar');
      eb.className = 'elem-badge badge-sin';
      eb.textContent = '⚠ Sin guardar';
      btn.innerHTML = `<i class="fa fa-save"></i> Guardar Elemento ${idx}`;
      const errorMsg = data.mensaje || data.message || 'Ocurrió un error al guardar el elemento.';
      Swal.fire('Error', errorMsg, 'error');
    }
  } catch (e) {
    btn.disabled = false;
    ew.classList.remove('guardando');
    ew.classList.add('sin-guardar');
    btn.innerHTML = `<i class="fa fa-save"></i> Guardar Elemento ${idx}`;
    Swal.fire('Error', 'Error de conexión o validación. Intente nuevamente.', 'error');
  }
}

// ═══════════════════════════════════════════════════════
// CÁMARA Y FOTOS
// ═══════════════════════════════════════════════════════
async function verificarGuardadoElemento(idx) {
  let elemId = document.getElementById(`ei-${idx}`).value;
  if (!elemId) {
    const r = await guardarElemento(idx);
    if (!r || !r.ok) return false;
  }
  return true;
}

async function abrirCamara(idx) {
  if (streamActivo) { cerrarCamara(idx); return; }
  
  const guardado = await verificarGuardadoElemento(idx);
  if (!guardado) {
    Swal.fire('Atención', 'Debe guardar el elemento antes de poder tomar fotos.', 'warning');
    return;
  }

  const esDispositivoMovil = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

  if (esDispositivoMovil) {
    const input = document.getElementById(`fi-${idx}`);
    input.setAttribute('capture', 'environment');
    input.click();
    return;
  }

  if (!tieneSoporteUserMedia()) {
    Swal.fire('Atención', 'Tu navegador no soporta acceso directo a cámara. Se usará la galería.', 'info');
    abrirSeleccionImagen(idx);
    return;
  }

  const $video = document.getElementById(`fv-${idx}`);
  const $listaDeDispositivos = document.getElementById(`listaDeDispositivos-${idx}`);
  const cb = document.getElementById(`fcb-${idx}`);

  const llenarSelectConDispositivosDisponibles = () => {
    while ($listaDeDispositivos.options.length > 0) {
      $listaDeDispositivos.remove(0);
    }
    obtenerDispositivos().then(dispositivos => {
      const dispositivosDeVideo = dispositivos.filter(d => d.kind === "videoinput");
      if (dispositivosDeVideo.length > 0) {
        dispositivosDeVideo.forEach(dispositivo => {
          const option = document.createElement('option');
          option.value = dispositivo.deviceId;
          option.text = dispositivo.label || `Cámara ${$listaDeDispositivos.options.length + 1}`;
          $listaDeDispositivos.appendChild(option);
        });
        $listaDeDispositivos.style.display = 'block';
      }
    });
  };

  const mostrarStream = (idDeDispositivo) => {
    _getUserMedia(
      {
        video: {
          deviceId: idDeDispositivo ? { exact: idDeDispositivo } : undefined,
          facingMode: "environment" // Por defecto cámara trasera en dispositivos con doble cámara
        }
      },
      (streamObtenido) => {
        llenarSelectConDispositivosDisponibles();
        
        $listaDeDispositivos.onchange = () => {
          if (streamActivo) {
            streamActivo.getTracks().forEach(track => track.stop());
          }
          mostrarStream($listaDeDispositivos.value);
        };

        streamActivo = streamObtenido;
        $video.srcObject = streamActivo;
        $video.style.display = 'block';
        cb.style.display = 'flex';
        cb.style.gap = '8px';
        $video.play();
      }, 
      (error) => {
        console.log("Permiso denegado o error: ", error);
        Swal.fire('Atención', 'No se puede acceder a la cámara o no diste permiso.', 'warning');
        cerrarCamara(idx);
      }
    );
  };

  obtenerDispositivos().then(dispositivos => {
    const dispositivosDeVideo = dispositivos.filter(d => d.kind === "videoinput");
    if (dispositivosDeVideo.length > 0) {
      mostrarStream(dispositivosDeVideo[0].deviceId);
    } else {
      mostrarStream(null);
    }
  });
}

function abrirSeleccionImagen(idx) {
  const input = document.getElementById(`fi-${idx}`);
  input.removeAttribute('capture');
  input.click();
}

function cerrarCamara(idx) {
  if (streamActivo) { streamActivo.getTracks().forEach(t => t.stop()); streamActivo = null; }
  const vid = document.getElementById(`fv-${idx}`);
  if (vid) { vid.style.display = 'none'; vid.srcObject = null; }
  const cb = document.getElementById(`fcb-${idx}`);
  if (cb) cb.style.display = 'none';
  const select = document.getElementById(`listaDeDispositivos-${idx}`);
  if (select) select.style.display = 'none';
}

function capturarFoto(idx) {
  const vid    = document.getElementById(`fv-${idx}`);
  const canvas = document.createElement('canvas');
  const MAX_W  = 1024;
  let w = vid.videoWidth, h = vid.videoHeight;
  if (w > MAX_W) { h = Math.floor(h * MAX_W / w); w = MAX_W; }
  canvas.width = w; canvas.height = h;
  canvas.getContext('2d').drawImage(vid, 0, 0, w, h);
  canvas.toBlob(blob => {
    cerrarCamara(idx);
    subirFoto(idx, blob, `captura-${Date.now()}.jpg`);
  }, 'image/jpeg', 0.62);
}

async function fotoSeleccionada(idx, input) {
  if (!input.files.length) return;
  
  const guardado = await verificarGuardadoElemento(idx);
  if (!guardado) {
    Swal.fire('Atención', 'Debe guardar el elemento antes de subir fotos.', 'warning');
    input.value = '';
    return;
  }

  comprimirYSubir(idx, input.files[0]);
  input.value = '';
}

function comprimirYSubir(idx, file) {
  const reader = new FileReader();
  reader.onload = e => {
    const img = new Image();
    img.onload = () => {
      const MAX_W = 1024;
      let w = img.width, h = img.height;
      if (w > MAX_W) { h = Math.floor(h * MAX_W / w); w = MAX_W; }
      const c = document.createElement('canvas');
      c.width = w; c.height = h;
      c.getContext('2d').drawImage(img, 0, 0, w, h);
      c.toBlob(blob => subirFoto(idx, blob, file.name), 'image/jpeg', 0.62);
    };
    img.src = e.target.result;
  };
  reader.readAsDataURL(file);
}

async function subirFoto(idx, blob, nombre) {
  const elemId = document.getElementById(`ei-${idx}`).value;
  if (!elemId) {
    Swal.fire('Atención', 'Primero guarde el elemento antes de subir fotos.', 'warning');
    return;
  }

  // Preview temporal
  const tmp = URL.createObjectURL(blob);
  const grid = document.getElementById(`fg-${idx}`);
  const tempDiv = document.createElement('div');
  tempDiv.className = 'foto-item foto-temp';
  tempDiv.innerHTML = `<img src="${tmp}" class="foto-thumb" style="opacity:.5; border-style:dashed;">
    <div style="font-size:.68rem; color:#aaa; text-align:center;">Subiendo...</div>`;
  grid.appendChild(tempDiv);

  const fd = new FormData();
  fd.append('elemento_id', elemId);
  fd.append('foto', blob, nombre || 'foto.jpg');

  try {
    const data = await fetch('{{ route("encuesta.siniestro.foto.store") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': CSRF(), 'Accept': 'application/json' },
      body: fd
    }).then(r => r.json());

    tempDiv.remove();
    URL.revokeObjectURL(tmp);

    if (data.ok) {
      agregarFotoGrid(idx, data.foto_id, data.url, data.tamanio);
      mostrarIndicador(`📷 Foto subida (${data.tamanio})`);
    } else {
      Swal.fire('Error', data.mensaje, 'error');
    }
  } catch(e) {
    tempDiv.remove();
    Swal.fire('Error', 'No se pudo subir la foto.', 'error');
  }
}

function agregarFotoGrid(idx, fotoId, url, tam) {
  const grid = document.getElementById(`fg-${idx}`);
  const d    = document.createElement('div');
  d.className = 'foto-item';
  d.id        = `fi-item-${fotoId}`;
  d.innerHTML = `
    <img src="${url}" class="foto-thumb" onclick="window.open('${url}','_blank')" title="Ver foto completa">
    <button type="button" class="foto-del" onclick="eliminarFoto(${fotoId}, ${idx})">×</button>
    <div style="font-size:.68rem; color:#888; text-align:center;">${tam}</div>`;
  grid.appendChild(d);

  const count = grid.querySelectorAll('.foto-item:not(.foto-temp)').length;
  document.getElementById(`fc-${idx}`).textContent = `${count} foto(s)`;
}

async function eliminarFoto(fotoId, idx) {
  const ok = await Swal.fire({
    title: '¿Eliminar foto?', icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e74c3c',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  });
  if (!ok.isConfirmed) return;

  const urlDel = '{{ route("encuesta.siniestro.foto.delete", ["id" => "FOTO_ID"]) }}'.replace('FOTO_ID', fotoId);
  const data = await fetch(urlDel, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': CSRF(), 'Accept': 'application/json' }
  }).then(r => r.json());

  if (data.ok) {
    document.getElementById(`fi-item-${fotoId}`)?.remove();
    const grid  = document.getElementById(`fg-${idx}`);
    const count = grid.querySelectorAll('.foto-item:not(.foto-temp)').length;
    document.getElementById(`fc-${idx}`).textContent = count ? `${count} foto(s)` : '';
    mostrarIndicador('🗑 Foto eliminada');
  }
}

// ═══════════════════════════════════════════════════════
// FINALIZAR Y ENVIAR
// ═══════════════════════════════════════════════════════
async function finalizarSiniestro() {
  // Validar campos mínimos
  const codigo = $('#d-codigo').val();
  const fecha  = document.getElementById('fecha_siniestro').value;

  if (!fecha) {
    Swal.fire('Atención', 'Ingrese la fecha del siniestro.', 'warning');
    document.getElementById('fecha_siniestro').focus();
    return;
  }
  if (!codigo) {
    Swal.fire('Atención', 'Seleccione el despacho afectado.', 'warning');
    return;
  }

  const guardados = Object.keys(elemGuardados).length;
  let sinGuardar = document.querySelectorAll('.elem-wrap.sin-guardar').length;

  if (guardados === 0 && sinGuardar > 0) {
    Swal.fire('Atención', 'Tiene un elemento agregado pero NO ha sido guardado. Por favor presione el botón "Guardar Elemento" antes de registrar el siniestro.', 'warning');
    return;
  }

  if (guardados === 0) {
    Swal.fire('Atención', 'Agregue y guarde al menos un elemento afectado.', 'warning');
    return;
  }

  // Validar que cada elemento tenga al menos una foto (comentado)
  let elementosSinFoto = 0;
  for (let idx in elemGuardados) {
    const grid = document.getElementById(`fg-${idx}`);
    if (grid) {
      const count = grid.querySelectorAll('.foto-item:not(.foto-temp)').length;
      if (count === 0) elementosSinFoto++;
    }
  }

  // Validación de fotos eliminada por requerimiento
  /*
  if (elementosSinFoto > 0) {
    Swal.fire('Atención', `Hay ${elementosSinFoto} elemento(s) sin foto. Es obligatorio subir al menos una foto por elemento.`, 'warning');
    return;
  }
  */

  // Verificar elementos sin guardar adicionales
  if (sinGuardar > 0) {
    const r = await Swal.fire({
      title: 'Hay elementos sin guardar',
      html: `Existen <strong>${sinGuardar}</strong> elemento(s) que no han sido guardados y no serán incluidos en el reporte.<br><br>¿Desea continuar de todas formas?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Continuar',
      cancelButtonText: 'Volver y guardar'
    });
    if (!r.isConfirmed) return;
  }

  // Confirmar
  const confirm = await Swal.fire({
    title: '¿Registrar y Enviar Siniestro?',
    html: `
      <div style="text-align:left; font-size:.88rem;">
        <p>📋 <strong>Despacho:</strong> ${$('#d-nombre').val()}</p>
        <p>📦 <strong>Elementos guardados:</strong> ${guardados}</p>
        <br>
        <p>Se realizarán las siguientes acciones:</p>
        <ul style="padding-left:20px; margin:6px 0 0;">
          <li>✅ Cambiar estado a "Registrado"</li>
          <li>📄 Generar PDF del reporte</li>
          <li>📧 Enviar correo al despacho</li>
        </ul>
      </div>`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '<i class="fa fa-paper-plane"></i> Sí, registrar y enviar',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#c0392b',
  });
  if (!confirm.isConfirmed) return;

  // Asegurar que la cabecera esté guardada con los últimos datos
  const r = await guardarOActualizarCabecera();
  if (!r || !r.ok) {
    Swal.fire('Error', 'No se pudo guardar la información base. Intente nuevamente.', 'error');
    return;
  }

  Swal.fire({
    title: 'Procesando...',
    html: '<p>Generando PDF y enviando correo, por favor espere.</p>',
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });

  try {
    const urlFin = '{{ route("encuesta.siniestro.finalizar", ["id" => "SIN_ID"]) }}'.replace('SIN_ID', siniestroId);
    const data = await fetch(urlFin, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': CSRF(),
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        observaciones_generales: document.getElementById('observaciones_generales').value,
        url_fotos: document.getElementById('url_fotos').value,
        firma_empleado: (signaturePad && !signaturePad.isEmpty()) ? signaturePad.toDataURL('image/png') : null
      })
    }).then(r => r.json());

    if (data.ok) {
      Swal.fire({
        icon: 'success',
        title: '¡Siniestro Registrado!',
        html: `
          <p><strong>No. ${data.consecutivo}</strong></p>
          <p>${data.pdf_msg}</p>
          <p>${data.correo_msg}</p>`,
        confirmButtonText: 'Ver Detalle',
        confirmButtonColor: '#0a2a4a'
      }).then(() => { window.location.href = data.redirect; });
    } else {
      Swal.fire('Error', data.mensaje || 'No se pudo finalizar.', 'error');
    }
  } catch(e) {
    Swal.fire('Error', 'Error de conexión. El siniestro pudo guardarse. Revise el listado.', 'error');
  }
}

// ═══════════════════════════════════════════════════════
// AUTO-GUARDAR CABECERA al cambiar campos clave
// ═══════════════════════════════════════════════════════
let _autosaveTimer;
function scheduleAutosave() {
  clearTimeout(_autosaveTimer);
  _autosaveTimer = setTimeout(() => {
    if ($('#d-codigo').val() && document.getElementById('fecha_siniestro').value) {
      guardarOActualizarCabecera();
    }
  }, 1500);
}

document.getElementById('fecha_siniestro').addEventListener('change', scheduleAutosave);
document.getElementById('observaciones_generales').addEventListener('input', scheduleAutosave);
$('#t-nombre, #t-cedula, #t-cargo, #t-correo').on('input', scheduleAutosave);
</script>
@endpush
