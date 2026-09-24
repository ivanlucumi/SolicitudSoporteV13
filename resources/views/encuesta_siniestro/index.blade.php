@extends('layouts.SinSidebar')

@section('title', 'Encuesta de Siniestros')
@section('cabecera', 'Gestión de Siniestros')

@push('style')
<style>
:root {
  --sin-primary: #0a2a4a;
  --sin-accent:  #c0392b;
  --sin-blue:    #2980b9;
  --sin-green:   #27ae60;
  --sin-gold:    #f39c12;
  --sin-surface: #f8fafd;
  --sin-border:  #e2e8f0;
  --sin-radius:  10px;
  --sin-shadow:  0 2px 12px rgba(0,0,0,0.07);
}

.sin-header {
  background: linear-gradient(135deg, var(--sin-primary) 0%, #1a3f6f 100%);
  color:#fff; padding:20px 28px; border-radius: var(--sin-radius);
  margin-bottom:20px; display:flex; align-items:center; justify-content:space-between;
}
.sin-header h2 { margin:0; font-size:1.4rem; font-weight:700; }
.sin-header small { opacity:0.8; }

.filtros-card {
  background:#fff; border:1px solid var(--sin-border); border-radius: var(--sin-radius);
  padding:16px 20px; margin-bottom:20px; box-shadow: var(--sin-shadow);
}

.badge-borrador    { background:#95a5a6; }
.badge-registrado  { background: var(--sin-blue); }
.badge-enviado     { background: var(--sin-green); }
.badge-en_revision { background: var(--sin-gold); color:#333; }
.badge-cerrado     { background: var(--sin-accent); }

.btn-accion {
  padding:4px 10px; font-size:0.8rem; border-radius:20px; border:none; cursor:pointer;
  display:inline-flex; align-items:center; gap:4px; text-decoration:none;
  transition: all 0.2s;
}
.btn-accion:hover { transform: translateY(-1px); opacity: 0.9; }
.btn-ver   { background:#3498db; color:#fff; }
.btn-pdf   { background:#e74c3c; color:#fff; }
.btn-email { background:#16a085; color:#fff; }
.btn-nuevo {
  background: linear-gradient(135deg, var(--sin-accent), #e74c3c);
  color:#fff; padding:10px 22px; border-radius:24px; font-weight:600;
  border:none; cursor:pointer; display:inline-flex; align-items:center; gap:6px;
  font-size:0.9rem; box-shadow: 0 2px 8px rgba(192,57,43,0.3);
  text-decoration:none; transition: all 0.2s;
}
.btn-nuevo:hover { transform:translateY(-2px); box-shadow: 0 4px 14px rgba(192,57,43,0.4); color:#fff; }

table.sin-table { width:100%; border-collapse:collapse; }
table.sin-table thead { background: var(--sin-primary); color:#fff; }
table.sin-table th { padding:10px 12px; font-size:0.82rem; font-weight:600; }
table.sin-table td { padding:9px 12px; font-size:0.85rem; border-bottom:1px solid var(--sin-border); vertical-align:middle; }
table.sin-table tr:hover td { background:#f7fafd; }

.empty-state { text-align:center; padding:60px 20px; color:#999; }
.empty-state i { font-size:3rem; display:block; margin-bottom:12px; }
</style>
@endpush

@section('content')
<div class="sin-header">
  <div>
    <h2><i class="fa fa-exclamation-triangle"></i> Encuesta de Siniestros</h2>
    <small>Registre y gestione los siniestros de elementos del despacho</small>
  </div>
  <a href="{{ route('encuesta.siniestro.create') }}" class="btn-nuevo">
    <i class="fa fa-plus-circle"></i> Nuevo Siniestro
  </a>
</div>

{{-- Filtros --}}
<div class="filtros-card">
  <form method="GET" action="{{ route('encuesta.siniestro.index') }}" id="form-filtros">
    <div class="row">
      <div class="col-sm-3">
        <label style="font-size:0.82rem; font-weight:600; color:#555;">Despacho</label>
        <input type="text" name="despacho" class="form-control input-sm"
               value="{{ request('despacho') }}" placeholder="Buscar por despacho...">
      </div>
      <div class="col-sm-2">
        <label style="font-size:0.82rem; font-weight:600; color:#555;">Estado</label>
        <select name="estado" class="form-control input-sm">
          <option value="">Todos</option>
          @foreach(['borrador'=>'Borrador','registrado'=>'Registrado','enviado'=>'Enviado','en_revision'=>'En revisión','cerrado'=>'Cerrado'] as $val=>$label)
            <option value="{{ $val }}" {{ request('estado')==$val?'selected':'' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-2">
        <label style="font-size:0.82rem; font-weight:600; color:#555;">Desde</label>
        <input type="date" name="fecha_inicio" class="form-control input-sm"
               value="{{ request('fecha_inicio') }}">
      </div>
      <div class="col-sm-2">
        <label style="font-size:0.82rem; font-weight:600; color:#555;">Hasta</label>
        <input type="date" name="fecha_fin" class="form-control input-sm"
               value="{{ request('fecha_fin') }}">
      </div>
      <div class="col-sm-3" style="display:flex; align-items:flex-end; gap:8px;">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-search"></i> Filtrar
        </button>
        <a href="{{ route('encuesta.siniestro.index') }}" class="btn btn-default btn-sm">
          <i class="fa fa-times"></i> Limpiar
        </a>
      </div>
    </div>
  </form>
</div>

{{-- Tabla --}}
<div style="background:#fff; border-radius: var(--sin-radius); box-shadow: var(--sin-shadow); overflow:hidden; border:1px solid var(--sin-border);">
  @if($siniestros->count())
  <table class="sin-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Consecutivo</th>
        <th>Fecha</th>
        <th>Despacho</th>
        <th>Titular</th>
        <th>Elementos</th>
        <th>Estado</th>
        <th>Registrado por</th>
        <th>Correo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($siniestros as $s)
      <tr>
        <td>{{ $s->id }}</td>
        <td><strong style="color:#0a2a4a;">{{ $s->consecutivo }}</strong></td>
        <td>{{ $s->fecha_siniestro ? $s->fecha_siniestro->format('d/m/Y') : '–' }}</td>
        <td>{{ \Illuminate\Support\Str::limit($s->despacho_nombre, 35) }}</td>
        <td>{{ \Illuminate\Support\Str::limit($s->titular_nombre, 28) ?? '–' }}</td>
        <td style="text-align:center;">
          <span class="badge badge-info">{{ $s->elementos_count ?? $s->elementos()->count() }}</span>
        </td>
        <td>
          <span class="badge badge-{{ $s->estado_badge }}">{{ $s->estado_label }}</span>
        </td>
        <td style="font-size:0.78rem;">{{ $s->user?->name ?? '–' }}</td>
        <td style="text-align:center;">
          @if($s->correo_enviado)
            <i class="fa fa-check-circle text-success" title="Enviado {{ $s->correo_enviado_at?->format('d/m/Y H:i') }}"></i>
          @else
            <i class="fa fa-times-circle text-danger" title="{{ $s->correo_error ?? 'No enviado' }}"></i>
          @endif
        </td>
        <td style="white-space:nowrap;">
          @if($s->estado === 'borrador')
            <a href="{{ route('encuesta.siniestro.create') }}?edit_id={{ $s->id }}" class="btn-accion btn-ver" title="Continuar editando borrador" style="background:#f39c12;">
              <i class="fa fa-pencil"></i>
            </a>
          @else
            <a href="{{ route('encuesta.siniestro.show', $s->id) }}" class="btn-accion btn-ver" title="Ver detalle">
              <i class="fa fa-eye"></i>
            </a>
          @endif
          <a href="{{ route('encuesta.siniestro.pdf', $s->id) }}" class="btn-accion btn-pdf" title="Descargar PDF" target="_blank">
            <i class="fa fa-file-pdf-o"></i>
          </a>
          @if(!$s->correo_enviado || true)
          <button onclick="reenviarCorreo({{ $s->id }})" class="btn-accion btn-email" title="Reenviar correo">
            <i class="fa fa-envelope"></i>
          </button>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="padding:12px 20px;">
    {{ $siniestros->links() }}
  </div>
  @else
  <div class="empty-state">
    <i class="fa fa-folder-open-o"></i>
    <p>No hay siniestros registrados aún.</p>
    <a href="{{ route('encuesta.siniestro.create') }}" class="btn-nuevo" style="display:inline-flex;">
      <i class="fa fa-plus-circle"></i> Registrar primer siniestro
    </a>
  </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
function reenviarCorreo(id) {
  Swal.fire({
    title: '¿Reenviar correo?',
    text: 'Se enviará el reporte nuevamente al despacho.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#16a085',
    cancelButtonColor: '#95a5a6',
    confirmButtonText: 'Sí, reenviar',
    cancelButtonText: 'Cancelar'
  }).then(result => {
    if (result.isConfirmed) {
      Swal.fire({ title: 'Enviando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
      fetch(`/encuesta/siniestro/${id}/reenviar`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
          'Accept': 'application/json'
        }
      })
      .then(r => r.json())
      .then(data => {
        Swal.fire({
          icon: data.ok ? 'success' : 'warning',
          title: data.ok ? '¡Enviado!' : 'Aviso',
          text: data.mensaje,
          timer: 3000
        }).then(() => location.reload());
      });
    }
  });
}
</script>
@endpush
