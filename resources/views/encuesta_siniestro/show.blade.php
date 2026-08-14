@extends('layouts.SinSidebar')

@section('title', 'Detalle Siniestro – ' . $siniestro->consecutivo)
@section('cabecera', 'Detalle del Siniestro')

@push('style')
<style>
:root {
  --p: #0a2a4a; --pl: #1a3f6f; --ac: #c0392b;
  --gr: #27ae60; --bl: #2980b9; --bd: #e0e6ef; --r: 10px; --sh: 0 2px 14px rgba(0,0,0,0.07);
}
.det-header {
  background: linear-gradient(135deg, var(--p) 0%, #1a3f6f 100%);
  color:#fff; padding:22px 28px; border-radius: var(--r);
  margin-bottom:20px; display:flex; align-items:center; justify-content:space-between;
  box-shadow: var(--sh);
}
.det-header h2 { margin:0; font-size:1.4rem; font-weight:800; }
.consec-badge {
  font-family: monospace; font-size:1rem; background:rgba(255,255,255,0.15);
  padding:4px 12px; border-radius:20px; margin-top:6px; display:inline-block;
}
.info-card { background:#fff; border:1px solid var(--bd); border-radius: var(--r); box-shadow: var(--sh); margin-bottom:18px; }
.info-card-header { background:#f8fafd; padding:12px 20px; border-bottom:1px solid var(--bd); border-radius: var(--r) var(--r) 0 0; }
.info-card-header h5 { margin:0; font-size:0.95rem; font-weight:700; color: var(--p); }
.info-card-body { padding:18px 20px; }
.info-row { display:flex; flex-wrap:wrap; gap:0 24px; }
.info-item { min-width:180px; margin-bottom:14px; flex:1; }
.info-item label { display:block; font-size:0.76rem; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:0.04em; margin-bottom:3px; }
.info-item span { display:block; font-size:0.9rem; color:#222; font-weight:500; }

.elem-card {
  border:1.5px solid var(--bd); border-radius: var(--r); margin-bottom:16px; overflow:hidden;
}
.elem-card-header {
  background: linear-gradient(135deg, var(--p), var(--pl));
  color:#fff; padding:10px 18px; display:flex; align-items:center; gap:10px; font-size:0.9rem; font-weight:700;
}
.elem-card-body { padding:16px 18px; }

.foto-gallery { display:flex; flex-wrap:wrap; gap:10px; margin-top:12px; }
.foto-gallery img {
  width:120px; height:90px; object-fit:cover; border-radius:6px;
  border:2px solid var(--bd); cursor:pointer; transition: transform 0.2s;
}
.foto-gallery img:hover { transform:scale(1.04); border-color: var(--bl); }
.no-fotos { color:#bbb; font-size:0.85rem; font-style:italic; }

.badge-estado {
  display:inline-block; padding:4px 14px; border-radius:20px;
  font-size:0.82rem; font-weight:700; text-transform:uppercase;
}
.est-borrador    { background:#95a5a6; color:#fff; }
.est-registrado  { background: var(--bl); color:#fff; }
.est-enviado     { background: var(--gr); color:#fff; }
.est-en_revision { background:#f39c12; color:#333; }
.est-cerrado     { background: var(--ac); color:#fff; }

.correo-status {
  display:flex; align-items:center; gap:10px; padding:12px 18px;
  border-radius:8px; margin-bottom:16px; font-size:0.88rem; font-weight:600;
}
.correo-ok  { background:#eafaf1; border:1px solid #a9dfbf; color:#1e8449; }
.correo-err { background:#fdedec; border:1px solid #f1948a; color:#922b21; }

.btn-action {
  padding:9px 20px; border-radius:22px; font-weight:600; font-size:0.85rem;
  border:none; cursor:pointer; display:inline-flex; align-items:center; gap:7px;
  text-decoration:none; transition: all 0.2s; margin-right:8px; margin-bottom:8px;
}
.btn-action:hover { transform:translateY(-1px); opacity:0.9; }
.btn-pdf   { background:#e74c3c; color:#fff; }
.btn-email { background:#16a085; color:#fff; }
.btn-back  { background:#7f8c8d; color:#fff; }
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="det-header">
  <div>
    <h2><i class="fa fa-exclamation-triangle"></i> Siniestro Registrado</h2>
    <div class="consec-badge">{{ $siniestro->consecutivo }}</div>
    <div style="margin-top:6px;">
      <span class="badge-estado est-{{ $siniestro->estado }}">{{ $siniestro->estado_label }}</span>
    </div>
  </div>
  <div style="text-align:right;">
    <a href="{{ route('encuesta.siniestro.pdf', $siniestro->id) }}" class="btn-action btn-pdf" target="_blank">
      <i class="fa fa-file-pdf-o"></i> Descargar PDF
    </a>
    <button type="button" class="btn-action btn-email" onclick="reenviarCorreo({{ $siniestro->id }})">
      <i class="fa fa-envelope"></i> Reenviar Correo
    </button>
    <a href="{{ route('encuesta.siniestro.index') }}" class="btn-action btn-back">
      <i class="fa fa-arrow-left"></i> Volver
    </a>
  </div>
</div>

{{-- Estado del correo --}}
@if($siniestro->correo_enviado)
<div class="correo-status correo-ok">
  <i class="fa fa-check-circle fa-lg"></i>
  Correo enviado el {{ $siniestro->correo_enviado_at?->format('d/m/Y H:i') }} a: {{ $siniestro->correo_destinatarios }}
</div>
@else
<div class="correo-status correo-err">
  <i class="fa fa-times-circle fa-lg"></i>
  Correo no enviado.
  @if($siniestro->correo_error)
    Motivo: {{ $siniestro->correo_error }}
  @endif
</div>
@endif

{{-- Info General --}}
<div class="info-card">
  <div class="info-card-header">
    <h5><i class="fa fa-info-circle"></i> Información General</h5>
  </div>
  <div class="info-card-body">
    <div class="info-row">
      <div class="info-item">
        <label>Consecutivo</label>
        <span>{{ $siniestro->consecutivo }}</span>
      </div>
      <div class="info-item">
        <label>Fecha del Siniestro</label>
        <span>{{ $siniestro->fecha_siniestro?->format('d/m/Y') ?? '–' }}</span>
      </div>
      <div class="info-item">
        <label>Fecha de Registro</label>
        <span>{{ $siniestro->created_at->format('d/m/Y H:i') }}</span>
      </div>
      <div class="info-item">
        <label>Registrado por</label>
        <span>{{ $siniestro->user?->name }} {{ $siniestro->user?->lastname }}</span>
      </div>
    </div>
    @if($siniestro->observaciones_generales)
    <div style="margin-top:10px; padding:12px; background:#f8fafd; border-radius:8px; border-left:3px solid var(--bl);">
      <label style="font-size:0.76rem; font-weight:700; color:#888; text-transform:uppercase;">Observaciones Generales</label>
      <p style="margin:4px 0 0; font-size:0.9rem;">{{ $siniestro->observaciones_generales }}</p>
    </div>
    @endif
  </div>
</div>

{{-- Despacho --}}
<div class="info-card">
  <div class="info-card-header">
    <h5><i class="fa fa-building"></i> Información del Despacho</h5>
  </div>
  <div class="info-card-body">
    <div class="info-row">
      <div class="info-item">
        <label>Código</label><span>{{ $siniestro->despacho_codigo ?? '–' }}</span>
      </div>
      <div class="info-item" style="flex:3;">
        <label>Nombre del Despacho</label><span>{{ $siniestro->despacho_nombre ?? '–' }}</span>
      </div>
      <div class="info-item">
        <label>Ciudad</label><span>{{ $siniestro->despacho_ciudad ?? '–' }}</span>
      </div>
      <div class="info-item" style="flex:2;">
        <label>Dirección</label><span>{{ $siniestro->despacho_direccion ?? '–' }}</span>
      </div>
      <div class="info-item">
        <label>Correo</label><span>{{ $siniestro->despacho_correo ?? '–' }}</span>
      </div>
    </div>
  </div>
</div>

{{-- Titular --}}
@if($siniestro->titular_nombre)
<div class="info-card">
  <div class="info-card-header">
    <h5><i class="fa fa-user"></i> Titular del Despacho</h5>
  </div>
  <div class="info-card-body">
    <div class="info-row">
      <div class="info-item"><label>Nombre</label><span>{{ $siniestro->titular_nombre }}</span></div>
      <div class="info-item"><label>Cédula</label><span>{{ $siniestro->titular_cedula ?? '–' }}</span></div>
      <div class="info-item"><label>Cargo</label><span>{{ $siniestro->titular_cargo ?? '–' }}</span></div>
      <div class="info-item"><label>Correo</label><span>{{ $siniestro->titular_correo ?? '–' }}</span></div>
      <div class="info-item"><label>Teléfono</label><span>{{ $siniestro->titular_telefono ?? '–' }}</span></div>
    </div>
  </div>
</div>
@endif

{{-- Empleados --}}
@if($siniestro->empleados_json && count($siniestro->empleados_json))
<div class="info-card">
  <div class="info-card-header">
    <h5><i class="fa fa-users"></i> Empleados Involucrados ({{ count($siniestro->empleados_json) }})</h5>
  </div>
  <div class="info-card-body">
    <div class="info-row">
      @foreach($siniestro->empleados_json as $emp)
      <div class="info-item">
        <label>Empleado</label>
        <span>{{ $emp['nombre'] ?? '' }}</span>
        <span style="font-size:0.78rem; color:#888;">{{ $emp['cargo'] ?? '' }} – {{ $emp['cedula'] ?? '' }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif

{{-- Elementos --}}
<div style="margin-bottom:6px;">
  <h4 style="color:var(--p); font-weight:700;">
    <i class="fa fa-laptop"></i> Elementos Afectados ({{ $siniestro->elementos->count() }})
  </h4>
</div>

@forelse($siniestro->elementos as $i => $elem)
<div class="elem-card">
  <div class="elem-card-header">
    <i class="fa fa-cube"></i>
    Elemento {{ $i + 1 }}: {{ $elem->tipo_elemento }} – {{ $elem->nombre_elemento }}
    @if($elem->placa)
      <span style="font-size:0.8rem; opacity:0.8; margin-left:auto;">Placa: {{ $elem->placa }}</span>
    @endif
  </div>
  <div class="elem-card-body">
    <div class="info-row">
      <div class="info-item"><label>Tipo</label><span>{{ $elem->tipo_elemento ?? '–' }}</span></div>
      <div class="info-item"><label>Nombre</label><span>{{ $elem->nombre_elemento ?? '–' }}</span></div>
      <div class="info-item"><label>Placa</label><span>{{ $elem->placa ?? '–' }}</span></div>
      <div class="info-item"><label>Serial</label><span>{{ $elem->serial ?? '–' }}</span></div>
      <div class="info-item"><label>Marca</label><span>{{ $elem->marca ?? '–' }}</span></div>
      <div class="info-item"><label>Modelo</label><span>{{ $elem->modelo ?? '–' }}</span></div>
      <div class="info-item"><label>Estado Anterior</label><span>{{ $elem->estado_anterior ?? '–' }}</span></div>
      <div class="info-item"><label>Estado Posterior</label><span>{{ $elem->estado_posterior ?? '–' }}</span></div>
    </div>

    @if($elem->descripcion_dano)
    <div style="padding:10px; background:#fef9ec; border-radius:7px; border-left:3px solid #f39c12; margin-top:10px;">
      <label style="font-size:0.76rem; font-weight:700; color:#888; text-transform:uppercase;">Descripción del Daño</label>
      <p style="margin:4px 0 0; font-size:0.9rem;">{{ $elem->descripcion_dano }}</p>
    </div>
    @endif
    @if($elem->observaciones)
    <div style="padding:10px; background:#f8fafd; border-radius:7px; border-left:3px solid #aaa; margin-top:8px;">
      <label style="font-size:0.76rem; font-weight:700; color:#888; text-transform:uppercase;">Observaciones</label>
      <p style="margin:4px 0 0; font-size:0.9rem;">{{ $elem->observaciones }}</p>
    </div>
    @endif

    {{-- Galería de fotos --}}
    <div style="margin-top:14px;">
      <label style="font-size:0.82rem; font-weight:700; color:#555;">
        <i class="fa fa-camera"></i> Fotografías ({{ $elem->fotos->count() }})
      </label>
      @if($elem->fotos->count())
      <div class="foto-gallery">
        @foreach($elem->fotos as $foto)
          <a href="{{ asset('storage/'.$foto->ruta_archivo) }}" target="_blank" title="{{ $foto->nombre_archivo }}">
            <img src="{{ asset('storage/'.$foto->ruta_archivo) }}" alt="Foto siniestro">
          </a>
        @endforeach
      </div>
      @else
        <p class="no-fotos"><i class="fa fa-image"></i> Sin fotografías adjuntas.</p>
      @endif
    </div>
  </div>
</div>
@empty
<div style="text-align:center; padding:30px; color:#aaa;">
  <i class="fa fa-inbox fa-2x"></i>
  <p>No hay elementos registrados en este siniestro.</p>
</div>
@endforelse

@endsection

@push('scripts')
<script>
function reenviarCorreo(id) {
  Swal.fire({
    title:'¿Reenviar correo?', text:'Se enviará nuevamente al despacho.', icon:'question',
    showCancelButton:true, confirmButtonText:'Sí, reenviar', cancelButtonText:'Cancelar',
    confirmButtonColor:'#16a085'
  }).then(r => {
    if (!r.isConfirmed) return;
    Swal.fire({ title:'Enviando...', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });
    fetch(`/encuesta/siniestro/${id}/reenviar`, {
      method:'POST',
      headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}', 'Accept':'application/json' }
    }).then(r=>r.json()).then(data=>{
      Swal.fire({ icon:data.ok?'success':'warning', title:data.ok?'¡Enviado!':'Aviso', text:data.mensaje, timer:3000 })
        .then(()=>location.reload());
    });
  });
}
</script>
@endpush
